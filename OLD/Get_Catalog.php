<?php
//*****************************************************************************
//  парсинг товаров сайта http://www.petshop.ru. Сайт BITRIX
//  Файл №1. Парсинг категорий
//*****************************************************************************

		set_time_limit(0);		//Убираем лимит работы скрипта PHP
		
		include_once('lib\sql.php');
		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$site = 'http://www.petshop.ru';
		$url = 'http://www.petshop.ru/catalog/birds/';	//1-й уровень
		
		//$cat = 4;		//Номер в массиве категорий $arr_all который будем обрабатывать
	
function start_get_catalog() {		
	
		global $host;
		global $user;
		global $password;
		global $database;	

	
		$arr_all = array(
			array("1","Товары для собак","http://www.petshop.ru/catalog/dogs/"),
			array("2","Товары для кошек","http://www.petshop.ru/catalog/cats/"),
			array("3","Для грызунов и хорьков","http://www.petshop.ru/catalog/rodents/"),
			array("4","Товары для рыб","http://www.petshop.ru/catalog/fish/"),
			array("5","Товары для птиц","http://www.petshop.ru/catalog/birds/")
		);
		
	
		ob_start();
		echo "Start script: " . date("H:i:s") . "<br>";
		ob_flush();
		flush();
		
	for ($cat=0;$cat<5;$cat++) {
		
		$arr_link = get_category ($arr_all[$cat][2]);
		
		
		$k = 0;
		$arr_to_sql = array();
		
		
		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
		
		$query = 'select max(id_cat) as count from bitrixshop.catalog';	//Берем максимальное значение ID каталога
		
		$result = mysqli_query($link, $query);
		
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			
				$id_max = $row["count"];
				
		}
		mysqli_free_result($result);
		
		//Закрываем соединение с БД 
		mysqli_close($link);

		
		for ($j=0;$j<count($arr_link);$j++) {		
		
			$name = $arr_link[$j][0];
			$arr_cat_link = $arr_link[$j][1];
			$id_max = $id_max + 1;
			
			
			//Сохраняем каталог Catalog
			save_catalog ($id_max,$arr_all[$cat][0],$name);
			
			for ($i=0;$i<count($arr_cat_link);$i++) {
			
				$arr_to_sql[$k][0] = $id_max;						//ID каталога
				$arr_to_sql[$k][1] = (int) $arr_all[$cat][0];		//ID родительского каталога	
				$arr_to_sql[$k][2] = $name;							//Название каталога
				$arr_to_sql[$k][3] = $arr_cat_link[$i];				//Ссылка на страницу
				
				$k = $k + 1;
				
			}
			
		
		}
		
		save_load_catalog($arr_to_sql);
		echo "Catalog:" . $cat . " load: " . $k . " <br>";
		ob_flush();
		flush();

	}	
	//ob_end_clean(); 
	echo "End script: " . date("H:i:s");
}

		
function save_catalog ($cat_id,$par_id,$name) {		//Функция сохранения каталога
	
		global $host;
		global $user;
		global $password;
		global $database;	

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));


			$query = "INSERT INTO bitrixshop.catalog (`id_cat`,`parent_id`,`name`) VALUES ('" . $cat_id . "','" . $par_id . "','" . $name . "');";
			$result = mysqli_query($link,$query);
			if (!$result) {
				echo "Ошибка загрузки данных: " . $query . "<br>";
			}

		//Закрываем соединение с БД 
		mysqli_close($link);
	
}
	

function save_load_catalog($arr) {		//Функция сохранения категори в БД

		global $host;
		global $user;
		global $password;
		global $database;	

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
 
		$i = 0;
		
		for ($j=0;$j<count($arr);$j++){
			$s1 = mysqli_real_escape_string($link,$arr[$i][0]);
			$s2 = mysqli_real_escape_string($link,$arr[$i][1]);
			$s3 = mysqli_real_escape_string($link,$arr[$i][2]);
			$s4 = mysqli_real_escape_string($link,$arr[$i][3]);
			
			

			//Сохраняем в таблицу ссылок на страницы каталога
			$query = "INSERT INTO bitrixshop.load_catalog (`id_cat`,`parent_id`,`lvl1`,`link`) VALUES ('" . $s1 . "','" . $s2 . "','" . $s3. "','" . $s4 . "');";
			$result = mysqli_query($link,$query);
			if ($result) {
				$i = $i+1; 
			} else {
				echo "Ошибка загрузки данных: " . $query . "<br>";
			}
			
		}


		//echo "В БД загружено " . $i . " записей";
		
		//Закрываем соединение с БД 
		mysqli_close($link);

}
//*********************************************************************************************************************		
		
		
		
function get_category ($url) {			//Функция получения категорий и ссылок на все страницы товара
	
		$arr_cat = get_lvl_1($url);		//Массив ссылок 1-го уровня
		
		$arr_link = array();
		
		for ($j=0;$j<count($arr_cat);$j++) {
			
			$arr_link[$j][0] = $arr_cat[$j][0];						//Название категории
			$arr_link[$j][1] = get_page_count($arr_cat[$j][1]);		//Массив ссылок на страницы категории
			
		}
		
	return $arr_link;
	
}
		
	
		
function get_page_count($url){	//Функция определения кол-ва страниц с товарами
	
		global $site;
		
		$html = curl_get($url);
		
		$arr_page = array();
		
		$arr_page[] = $url;
		
		$dom = str_get_html($html);
		
	if ($dom != null) {
		
		$pages = $dom->find('.page-navigation',0);

		
		if ($pages != null) {	//Проверяем наличие дополнительных страниц
		
				if ($pages->find('a[class="dots"]') == null) {		//Проверяем наличие большого кол-ва страниц
				
						$container = $pages->find('a[class!="next"]');
						
						foreach($container as $item){
							
							$arr_page[] = $site . $item->href;
							
						}
				} else {	//Много страниц, присутствуют свернутые номера страниц
				
					$a = $pages->find('a[!class]',0); //Получили кол-во страниц с товарами
					
					$page_count = $a -> plaintext;
					
					for ($i=2;$i<=$page_count;$i++) {
						
						$arr_page[] = $url . "?page=" . $i;
						
					}
					
				}
		}
		
	} else {	
		echo "Function: get_page_count(). Нет данных HTML на входе. DOM = NULL <br>";
	}
	
		return $arr_page;
	
}
		
function get_lvl_1($url) {	//Функция получения массива ссылок 1-го уровня

		global $site;		
		$html = curl_get($url);
		
		$arr_level11 = array();
		$arr_level_1 = array($arr_level11);
		
		$dom = str_get_html($html);
		
	if ($dom != null) {
		
		$container = $dom->find('.submenu-list a');
		
		$i = 0;
		
		foreach($container as $item){
			
			
			//echo $site . $item->href . '  ' . $item->plaintext . '<br>';
				$arr_level11[0] = $item->plaintext;
				$arr_level11[1] = $site . $item->href;
				
				$arr_level_1[$i] = $arr_level11;
				$i = $i + 1;
			
		}
	} else {
		echo "Function: get_lvl_1(). Нет данных HTML на входе. DOM = NULL <br>";
	}
	//Поучили 1-й уровень 
	
	return $arr_level_1;
	
}
		
		
?>