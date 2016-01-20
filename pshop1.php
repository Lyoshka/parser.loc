<?php
//*****************************************************************************
//  парсинг товаров сайта http://www.petshop.ru. Сайт BITRIX
//  Файл №1. Парсинг категорий
//*****************************************************************************


		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$site = 'http://www.petshop.ru';
		$url = 'http://www.petshop.ru/catalog/birds/';	//1-й уровень
		
		$cat = 4;		//Номер в массиве категорий $arr_all который будем обрабатывать
		
		$arr_all = array(
			array("Товары для собак","http://www.petshop.ru/catalog/dogs/"),
			array("Товары для кошек","http://www.petshop.ru/catalog/cats/"),
			array("Для грызунов и хорьков","http://www.petshop.ru/catalog/rodents/"),
			array("Товары для рыб","http://www.petshop.ru/catalog/fish/"),
			array("Товары для птиц","http://www.petshop.ru/catalog/birds/")
		);
		
	
		$arr_to_sql = array();
		
		$arr_link = get_category ($arr_all[$cat][1]);
		
		$k = 0;

		for ($j=0;$j<count($arr_link);$j++) {		
		
			$link_1 = $arr_link[$j][0];
			$arr_cat_link = $arr_link[$j][1];
			
			for ($i=0;$i<count($arr_cat_link);$i++) {
			
				$arr_to_sql[$k][0] = $arr_all[$cat][0];
				$arr_to_sql[$k][1] = $link_1;
				$arr_to_sql[$k][2] = $arr_cat_link[$i];
				
				$k = $k + 1;
			}
		
		}

		
		saveSQL($arr_to_sql);
		//var_dump($arr_to_sql);
		//var_dump($arr_link);

function saveSQL($arr) {		//Функция сохранения категори в БД

		include_once('lib\sql.php');

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
 
		$i = 0;

		for ($j=0;$j<count($arr);$j++){
			$s1 = mysqli_real_escape_string($link,$arr[$i][0]);
			$s2 = mysqli_real_escape_string($link,$arr[$i][1]);
			$s3 = mysqli_real_escape_string($link,$arr[$i][2]);

			$query = "INSERT INTO `test1` (`s1`,`s2`,`s3`) VALUES ('" . $s1 . "','" . $s2 . "','" . $s3 . "');";
			$res = mysqli_query($link,$query);
			if ($res) {
				$i = $i+1; 
			} else {
				echo "Ошибка загрузки данных: " . $query . "<br>";
			}
		
		}


		echo "В БД загружено " . $i . " записей";
		
		//Закрываем соединение с БД 
		mysqli_close($link);

}
//*********************************************************************************************************************		
		
		
		
function get_category ($url) {	//Функция получения категорий и ссылок на все страницы товара
	
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
		
		$pages = $dom->find('.page-navigation',0);

		
		if ($pages != null) {	//Проверяем наличие дополнительных страниц
		
				if ($pages->find('a[class="dots"]') == null) {		//Проверяем наличие большого кол-ва страниц
				
						$container = $pages->find('a[class!="next"]');
						
						foreach($container as $item){
							
							//echo $item->href .  '<br>';
							$arr_page[] = $site . $item->href;
							
						}
				} else {	//Много страниц, присутствуют свернутые номера страниц
				
					$a = $pages->find('a[!class]',0); //Получили кол-во страниц с товарами
					
					$page_count = $a -> plaintext;
					
					for ($i=2;$i<=$page_count;$i++) {
						
						//echo $url . "?page=" . $i. "<br>";
						$arr_page[] = $url . "?page=" . $i;
						
					}
					
				}
		}
		
		return $arr_page;
	
}
		
function get_lvl_1($url) {	//Функция получения массива ссылок 1-го уровня

		global $site;		
		$html = curl_get($url);
		
		$arr_level11 = array();
		$arr_level_1 = array($arr_level11);
		
		$dom = str_get_html($html);
		
		$container = $dom->find('.submenu-list a');
		
		$i = 0;
		
		foreach($container as $item){
			
			
			//echo $site . $item->href . '  ' . $item->plaintext . '<br>';
				$arr_level11[0] = $item->plaintext;
				$arr_level11[1] = $site . $item->href;
				
				$arr_level_1[$i] = $arr_level11;
				$i = $i + 1;
			
		}
	
	//Поучили 1-й уровень 
	
	return $arr_level_1;
	
}
		
		
?>