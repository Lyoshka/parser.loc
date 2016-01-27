<?php
//*****************************************************************************
//  парсинг товаров сайта http://www.petshop.ru. Сайт BITRIX
//  Файл №2. Парсинг товаров
//*****************************************************************************
		
		set_time_limit(0);		//Убираем лимит работы скрипта PHP
		
		include_once('lib\sql.php');
		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');
		
		$save_dir = 'D:/OpenServer/domains/opencart.loc/image/catalog/';		//Директория для сохранения файлов
		$img_download = true;	// Скачивать картинки или нет		
		
		
		$k = 0;					// Индекс в массиве $arr_all по которому производимм выборку
		$limit = "";			//" LIMIT 120,20";	// Лимит выборки страниц (для тестирования), если надо выбрать все, то $limit = ""
		
		$arr_all = array(
			array("1","Товары для собак","http://www.petshop.ru/catalog/dogs/"),
			array("2","Товары для кошек","http://www.petshop.ru/catalog/cats/"),
			array("3","Для грызунов и хорьков","http://www.petshop.ru/catalog/rodents/"),
			array("4","Товары для рыб","http://www.petshop.ru/catalog/fish/"),
			array("5","Товары для птиц","http://www.petshop.ru/catalog/birds/")
		);

		$site = 'http://www.petshop.ru';	
	

//*******************************************************************************************************
//	Процедура копирования карточек товаров 
//*******************************************************************************************************
function start_get_tovar() {
	
		global $host;
		global $user;
		global $password;
		global $database;	

		ob_start();
		
		echo "Start script: " . date("H:i:s") . "<br>";
		ob_flush();
		flush();

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
		//$id_catalog = 6;

		$query = 'select tovar_id,catalog,parent_id,link from bitrixshop.compare'; // LIMIT 200'; 
		$result = mysqli_query($link, $query);
		
		$i = 0;

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			get_tovar($row['link'],$row['tovar_id'],$row['catalog'],$row['parent_id']);
			
			$i = $i + 1;
			
			echo "Load: " . $i . " Tovar_id: " . $row['tovar_id'] . " Catalog: " . $row['catalog'] . "<br>";
			ob_flush();
			flush();
				
		}

		
		//Закрываем соединение с БД 
		mysqli_close($link);
		
		echo "Stop script: " . date("H:i:s") . "<br>";
		ob_flush();
		flush();
		ob_end_clean(); 

}
	
//*******************************************************************************************************
//	Процедура сравнения товаров (поиск новых товаров и добавления в "таблицу готовых к загрузке")
//*******************************************************************************************************
function start_compare_tovar() {
	
		global $host;
		global $user;
		global $password;
		global $database;	

	
		ob_start();
		
		echo "Запускаем процедуру загрузки каталогов<br>";
		echo "Start script: " . date("H:i:s") . "<br>";
		ob_flush();
		flush();
		
		// Загружаем каталоги
		start_get_catalog();

		// Определяем кол-во загруженных каталогов
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


		
		for ($i=6;$i<=$id_max;$i++) {  // 6 - $id_max  каталоги по каторым необходимо произвести сравнение
			
			compare_tovar($i);
			ob_flush();
			flush();
		}
		
		echo "Stop script: " . date("H:i:s") . "<br>";
		ob_flush();
		flush();
		ob_end_clean(); 

		
}

//*******************************************************************************************************
//	Процедура загрузки каталогов
//*******************************************************************************************************

function start_get_catalog() {		
	
		global $host;
		global $user;
		global $password;
		global $database;	
		global $arr_all;
	
		ob_start();
		echo "Start script: " . date("H:i:s") . "<br>";
		ob_flush();
		flush();
		
				
		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
		
		//Чистим каталоги
		$query = 'DELETE from bitrixshop.catalog WHERE parent_id <> 0';
		$result = mysqli_query($link, $query);
		
		$query = 'DELETE from bitrixshop.load_catalog';
		$result = mysqli_query($link, $query);
		
		mysqli_free_result($result);
		//Закрываем соединение с БД 
		mysqli_close($link);


		
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



//*******************************************************************************************************
	
function compare_tovar ($catalog_id) {		//Функция поиска новых товаров на сайте и скачки ID товара в таблицу "Товары на загрузку"
	
		global $host;
		global $user;
		global $password;
		global $database;

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

		$i = 0;
		$commit = 0;
		$arr_tovar = list_item($catalog_id);	// Получаем массив ID товаров по каталогу с сайта
		
		
			for ($j=0;$j<count($arr_tovar);$j++) {
			
				$s1   = $arr_tovar[$j]["tovar_id"];
				$s2   = $arr_tovar[$j]["catalog_id"];
				$s3   = $arr_tovar[$j]["link"];
				$s4	  = $arr_tovar[$j]["parent_id"];
				$new = 0;
			
				$query = 'select DISTINCT tovar_id from bitrixshop.tovar where tovar_id = ' . $s1 ; // Ищем ID товара в таблице Tovar если не найден, то добавляем в таблицу Compare
				$result = mysqli_query($link, $query);
				
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
					$new = $row['tovar_id'];
				}
				
				
				$query = 'select DISTINCT tovar_id from bitrixshop.compare where tovar_id = ' . $s1; // Ищем ID товара в таблице Tovar если не найден, то добавляем в таблицу Compare
				$result = mysqli_query($link, $query);
				
				
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
					$new = $row['tovar_id'];
				}
				


				$commit = $commit + 1;	//Счетчик коммитов. Коммитим через 50 записей
				
				if ($new == null) {
					
					//Здесь инсертим в базу новые ID товаров для последующей загрузки
					
					$query = "INSERT INTO Bitrixshop.compare (`tovar_id`,`parent_id`,`catalog`,`link`) VALUES ('" . $s1 . "','" . $s4 . "','" . $s2 . "','" . $s3 . "')"; 
					
					$res = mysqli_query($link, $query);
					if (!$res) {
						echo "Ошибка загрузки данных: " . $query . "<br>";
					} 
					
					if ($commit == 51) {
						$query = "COMMIT";
						$res = mysqli_query($link, $query);
						$commit = 0;
						flush();
						echo $i . "<br>";
					}
					
				}
				$i = $i + 1;
				
			}
		echo "Catalog: " . $s2 . " всего товаров: " . $i . "<br>";
		ob_flush();
		flush();
		//Закрываем соединение с БД 
		mysqli_close($link);
	
}
	
		
function save_img ($img_url) {		//Функция скачивания файла изображения
		
		global $save_dir;

				
		$img_file = curl_get($img_url);
		
		file_put_contents($save_dir . basename($img_url), $img_file);
		
}
		
function get_tovar ($url, $tovar_id = '0', $catalog_id = 0, $parent_id = 0 ) {		// Функция парсинга катрочки товара

		global $img_download;
		$arr_tovar = array();	// Массив товаров
		$arr_art = array();		// Массив артукулов
		

		$html = curl_get($url);

		$dom = str_get_html($html);
		
	if ($dom != null) {
		
		$arr_tovar["tovar_id"] = $tovar_id;
		$arr_tovar["catalog_id"] = $catalog_id;
		$arr_tovar["parent_id"] = $parent_id;
		
		//************************************************
		// Наименование
		$container = $dom->find('.card-header h1',0);
		
		$arr_tovar["name"] = $container->plaintext;
		//echo $container->plaintext . "<br>";
		//echo "************************************************************************<br>";	
			
		//************************************************
		// Бренд
		
		$container = $dom->find('.good-brand a img',0);
		
		if ($container != null) {

			$arr_tovar["brand"] = trim($container->attr['title']);
			//echo $container->attr['title'] . "<br>";
			
		} else {

			$container = $dom->find('.good-brand a',0);
			
			$arr_tovar["brand"] = trim($container->plaintext);
			
		}
		
			

		
		//************************************************
		// Описание
		$container = $dom->find('div[id=product-features]',0);
		
		$arr_tovar["memo1"] = $container->outertext;
		
		//************************************************
		// Состав
		$container = $dom->find('.char-item',0);
	
		$arr_tovar["memo2"] = $container->outertext;

		//************************************************
		// Отзывы
		/*
		$container = $dom->find('.review-elem');
		
		foreach($container as $item){
				
				$a = $item->find('.text-name',0);
				
				echo $a->outertext . "<br>";
				
				$a = $item->find('.review-body',0);
				
				echo $a->outertext . "<br>";
				echo "---------------------------<br>";
		
			}
		
		echo $container->outertext . "<br>";

		*/
		
		//************************************************
		// Главная картинка
		$container = $dom->find('.product_photo',0);
		
		$img = "http:" . $container->src;
		
		$arr_tovar["img_main"] = "catalog/" . basename($img);
		
		//************************************************
		// Картинки большие и средние
		$container = $dom->find('.js-preview-img li a');
				
			foreach($container as $item){
					
				
				$img = "http:" . $item->href;
				
				if ($img_big != null) {
					$separator = "|";
				} else {
					$separator = "";
				}
				
				$img_big = $img_big . $separator . "catalog/" . basename($img);
				//echo $img . "<br>";
				
				if ($img_download) {
					save_img ($img);
				};
				
				$a = $item->find('img',0);
				
				$img = "http:" . $a->src;

				if ($img_med != null) {
					$separator = "|";
				} else {
					$separator = "";
				}
				
				$img_med = $img_med . $separator . "catalog/" . basename($img) ;
				//echo $img . "<br>";
				if ($img_download) {
					save_img ($img);
				};
				
				
			}
		$arr_tovar["img_big"] = $img_big;
		$arr_tovar["img_med"] = $img_med;


		//************************************************
		// Галерея картинок (маленькие)
			$container = $dom->find('.js-small-img li');
			
			foreach($container as $item){
			
					
					$a = $item->find('img',0);
					
					$img = "http:" . $a->src;
					
					if ($img_small != null) {
						$separator = "|";
					} else {
						$separator = "";
					}

					if (basename($img) != "0.jpg") {
					
						$img_small = $img_small . $separator . "catalog/" . basename($img) ;
						
						if ($img_download) {
							save_img ($img);
						};
					
					}
	
				}
			$arr_tovar["img_small"] = $img_small;
		

		//************************************************
		// Артикулы товара
		$container = $dom->find('.card-choice ul li');
		
		foreach($container as $item){
		
				//$arr_art["tovar_id"] = $tovar_id;	//ID товара
				
				
				$a = $item->find('.type-inst',0);	
				
				//$arr_art["mass"] = $a->plaintext;
				
				$massa = $a->plaintext;
				
				if ($massa <= 100) {
					$arr_tovar["weight"] = $a->plaintext;			//Масса
				} else {
					$arr_tovar["weight"] = $a->plaintext / 1000;
				}
				
				
				//***********************************
				//$a = $item->find('.good-id',0);				//Артикул
				
				//list($artikul) = sscanf($a->plaintext, "артикул: %d");	//Вырезаем из строки артикул
				//$arr_art["artikul"] = $artikul;
				
				//************************************

				$a = $item->find('.price-new .offer_price',0);	
				
				//$arr_art["price"] = (int) $a->attr['value'];
				$arr_tovar["price"] = (int) $a->attr['value'];	//Цена

				//save_art_to_SQL($arr_art);
				
				save_tovar_to_SQL($arr_tovar);

			}

	} else {
		echo "Function: get_tovar(). Нет данных HTML на входе. DOM = NULL <br>";
	}
		
		
		
	
}		

/*
function save_art_to_SQL ($arr) {		//Функция сохранения в БД артукулов
	
		global $host;
		global $user;
		global $password;
		global $database;

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

		$s1 = mysqli_real_escape_string($link,$arr["tovar_id"]);
		$s2 = mysqli_real_escape_string($link,$arr["artikul"]);
		$s3 = mysqli_real_escape_string($link,$arr["price"]);
		$s4 = mysqli_real_escape_string($link,$arr["mass"]);

		$query = "INSERT INTO Bitrixshop.artikul (`tovar_id`,`artikul`,`price`,`mass`) VALUES ('" . $s1 . "','" . $s2 . "','" . $s3 . "','" . $s4 . "');";
		$res = mysqli_query($link,$query);
		if (!$res) {
			echo "Ошибка загрузки данных: " . $query . "<br>";
		}
		

		//Закрываем соединение с БД 
		mysqli_close($link);

}

*/

function save_tovar_to_SQL ($arr) {		//Функция сохранения в БД товаров
	
		global $host;
		global $user;
		global $password;
		global $database;

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	
		$s1 = mysqli_real_escape_string($link,$arr["tovar_id"]);
		$s2 = trim(mysqli_real_escape_string($link,$arr["name"]));
		$s3 = mysqli_real_escape_string($link,$arr["brand"]);
		$s4 = mysqli_real_escape_string($link,$arr["memo1"]);
		$s5 = mysqli_real_escape_string($link,$arr["memo2"]);
		$s6 = mysqli_real_escape_string($link,$arr["img_main"]);
		$s7 = mysqli_real_escape_string($link,$arr["img_big"]);
		$s8 = mysqli_real_escape_string($link,$arr["img_med"]);
		$s9 = mysqli_real_escape_string($link,$arr["img_small"]);
		$s10 = mysqli_real_escape_string($link,$arr["catalog_id"]);
		$s11 = mysqli_real_escape_string($link,$arr["parent_id"]);
		$s12 = mysqli_real_escape_string($link,$arr["weight"]);
		$s13 = mysqli_real_escape_string($link,$arr["price"]);
		
		
		$query = "INSERT INTO Bitrixshop.tovar (`tovar_id`,`catalog_id`,`parent_id`,`name`,`brand`,`memo1`,`memo2`,`img_main`,`img_big`,`img_med`,`img_small`,`weight`,`price`) VALUES ('" . $s1 . "','" . $s10 . "','" . $s11 . "','" . $s2 . "','" . $s3 . "','" . $s4 . "','" . $s5 . "','" . $s6 . "','" . $s7 . "','" . $s8 . "','" . $s9 . "','" . $s12 . "','" . $s13 . "')";
		$res = mysqli_query($link,$query);
		if ($res) {
			// Удаляем из таблицы "На загрузку" (Compare)
			$query = "DELETE FROM Bitrixshop.Compare WHERE tovar_id = " . $s1;
			$res = mysqli_query($link,$query);
			
			if (!$res) {
				echo "Ошибка удаления из таблицы Compare данных: " . $query . "<br>";
			}
			
		} else {
			echo "Ошибка загрузки данных: " . $query . "<br>";
		}
		ob_flush();
		flush();

		//Закрываем соединение с БД 
		mysqli_close($link);
	
}

function list_item($catalog) {		// Функция сбора ID товара по указанному каталогу (цикл по всем страницам каталога)
		
		global $host;
		global $user;
		global $password;
		global $database;
		global $limit;
		
		$arr = array();


		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	
			$query = 'select link, parent_id from bitrixshop.load_catalog where id_cat = "' . $catalog . '"' . $limit; //Не забыть убрать ЛИМИТ
			$result = mysqli_query($link, $query);
			
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
				//echo $row['s3'] . "<br>";
				$arr_art = getItem($row['link'],$catalog);
				$parent_id = $row['parent_id'];
								
				for($j=0;$j<count($arr_art);$j++) {
					
					$s1 = $arr_art[$j]["tovar_id"];
					$s2 = $arr_art[$j]["catalog_id"];
					$s3 = $arr_art[$j]["link"];
					$s4 = $parent_id;
					

				
					$arr[] = array("tovar_id" 		=> $s1,
									"catalog_id" 	=> $s2,
									"link" 			=> $s3,
									"parent_id" 	=> $s4);
					
				}
				
				
			}

		//Закрываем соединение с БД 
		mysqli_close($link);
		
		
		
		return $arr;
}		
		
function getItem($url,$catalog_id = 0) {	//Доп. функция для list_item() сбора ID товара с одной страницы. 
	
		global $site;
		
		$html = curl_get($url);

		$arr_tovar = array();
		
		$dom = str_get_html($html);
		
		$container = $dom->find('.product-item');
		
		$i = 0;
		
			foreach($container as $item){

				//echo $item->attr['data-id'] . "   ";		
				$arr_tovar[$i]["tovar_id"] = $item->attr['data-id'];	//ID товара
				
				//echo $catalog_id . "   ";					
				$arr_tovar[$i]["catalog_id"] = $catalog_id;				//ID каталога
				
				$a = $item->find('a',0);					
				
				//echo $site . $a->href . "<br>";			
				$arr_tovar[$i]["link"] = $site . $a->href;				// Ссылка на страницу товара
				
				$i = $i + 1;
			}
			
		return $arr_tovar;
		
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