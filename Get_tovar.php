<?php
//*****************************************************************************
//  парсинг товаров сайта http://www.petshop.ru. Сайт BITRIX
//  Файл №2. Парсинг товаров
//*****************************************************************************
		
		set_time_limit(0);		//Убираем лимит работы скрипта PHP
		
		include_once('lib\sql.php');
		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');
		
		$save_dir = 'D:/OpenServer/domains/parser.loc/img/';		//Директория для сохранения файлов
		
		$k = 0;					// Индекс в массиве $arr_all по которому производимм выборку
		$limit = "";			//" LIMIT 120,20";	// Лимит выборки страниц (для тестирования), если надо выбрать все, то $limit = ""
		
		$arr_all = array(
			array("Товары для собак","http://www.petshop.ru/catalog/dogs/"),
			array("Товары для кошек","http://www.petshop.ru/catalog/cats/"),
			array("Для грызунов и хорьков","http://www.petshop.ru/catalog/rodents/"),
			array("Товары для рыб","http://www.petshop.ru/catalog/fish/"),
			array("Товары для птиц","http://www.petshop.ru/catalog/birds/")
		);

		$site = 'http://www.petshop.ru';	
		$url = 'http://www.petshop.ru/catalog/dogs/syxoi/vzroslye_1_6let/new_dlya_vzroslyh_sobak_malyh_porod_do_10_kg_10mes_8let_mini_adult_892/';
	

//*******************************************************************************************************
//	Процедура копирования карточек товаров 
//*******************************************************************************************************
		ob_start();

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
		$id_catalog = 6;

		$query = 'select tovar_id,catalog,parent_id,link from bitrixshop.compare where catalog = ' . $id_catalog . ' LIMIT 5'; 
		$result = mysqli_query($link, $query);

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			get_tovar($row['link'],$row['tovar_id'],$row['catalog'],$row['parent_id']);
				
		}

		
		//Закрываем соединение с БД 
		mysqli_close($link);
			
		ob_end_clean(); 
	
//*******************************************************************************************************
//	Процедура сравнения товаров (поиск новых товаров и добавления в "таблицу готовых к загрузке")
//*******************************************************************************************************
/*
		ob_start();
		
		for ($i=6;$i<=42;$i++) {  // 6 - 42 каталоги по каторым необходимо произвести сравнение
			
			compare_tovar($i);
			ob_flush();
			flush();
		}
		
		ob_end_clean(); 
		
*/

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
			
				$query = 'select exist (select 1 from bitrixshop.tovar where tovar_id = ' . $s1 . ')'; // Ищем ID товара в таблице Tovar если не найден, то добавляем в таблицу Compare
				$result = mysqli_query($link, $query);
				
				$commit = $commit + 1;	//Счетчик коммитов. Коммитим через 50 записей
				
				if ($result == 0) {
					
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
						//echo $i . "<br>";
					}
					
				}
				$i = $i + 1;
				
			}
		echo "Catalog: " . $s2 . " всего товаров: " . $i . "<br>";
		//Закрываем соединение с БД 
		mysqli_close($link);
	
}
	
		
function save_img ($img_url) {		//Функция скачивания файла изображения
		
		global $save_dir;

				
		$img_file = curl_get($img_url);
		
		file_put_contents($save_dir . basename($img_url), $img_file);
		
}
		
function get_tovar ($url, $tovar_id = '0', $catalog_id = 0, $parent_id = 0 ) {		// Функция парсинга катрочки товара

		$img_download = false;	// Скачивать картинки или нет
		$arr_tovar = array();	// Массив товаров
		$arr_art = array();		// Массив артукулов
		

		$html = curl_get($url);

		$dom = str_get_html($html);
		
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
			//echo $container->plaintext . "<br>";
			
		}
		
		//echo "************************************************************************<br>";	
			
		//************************************************
		// Артикулы товара
		$container = $dom->find('.card-choice ul li');
		
		foreach($container as $item){
		
				$arr_art["tovar_id"] = $tovar_id;	//ID товара
				
				$a = $item->find('.type-inst',0);	//Масса
				
				$arr_art["mass"] = $a->plaintext;
				//echo $a->plaintext . "<br>";
				
				$a = $item->find('.good-id',0);		//Артикул
				
				list($artikul) = sscanf($a->plaintext, "артикул: %d");	//Вырезаем из строки артикул
				$arr_art["artikul"] = $artikul;
				//echo $a->plaintext . "<br>";

				$a = $item->find('.price-new .offer_price',0);	//Цена
				
				$arr_art["price"] = (int) $a->attr['value'];
				//echo $a->attr['value'] . " руб.<br>";

				//var_dump($arr_art);
				save_art_to_SQL($arr_art);
				//echo "---------------------------<br>";
				
			}
		
		//echo "************************************************************************<br>";	
			
		
		//************************************************
		// Описание
		$container = $dom->find('div[id=product-features]',0);
		
		$arr_tovar["memo1"] = $container->outertext;
		//echo $container->outertext . "<br>";
		//echo "************************************************************************<br>";		
		
		//************************************************
		// Состав
		$container = $dom->find('.char-item',0);
		
		$arr_tovar["memo2"] = $container->outertext;
		//echo $container->outertext . "<br>";
		//echo "************************************************************************<br>";	

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
		echo "************************************************************************<br>";	
		*/
		
		//************************************************
		// Главная картинка
		$container = $dom->find('.product_photo',0);
		
		$img = "http:" . $container->src;
		
		$arr_tovar["img_main"] = "catalog/" . basename($img);
		//echo $img . "<br>";
		//echo "************************************************************************<br>";
		
		//************************************************
		// Картинки большие и средние
		$container = $dom->find('.js-preview-img li a');
				
			foreach($container as $item){
					
				$img = "http:" . $item->href;
				
				$img_big = $img_big . "catalog/" . basename($img) . "|";
				//echo $img . "<br>";
				
				if ($img_download) {
					save_img ($img);
				};
				
				//echo "---------------------------<br>";
				
				$a = $item->find('img',0);
				
				$img = "http:" . $a->src;
				
				$img_med = $img_med . "catalog/" . basename($img) . "|";
				//echo $img . "<br>";
				if ($img_download) {
					save_img ($img);
				};
				//echo "---------------------------<br>";
				
				
			}
		$arr_tovar["img_big"] = $img_big;
		$arr_tovar["img_med"] = $img_med;
		//echo "************************************************************************<br>";

		//************************************************
		// Галерея картинок (маленькие)
			$container = $dom->find('.js-small-img li');
			
			foreach($container as $item){
			
					
					$a = $item->find('img',0);
					
					$img = "http:" . $a->src;
					
					$img_small = $img_small . "catalog/" . basename($img) . "|";
					//echo $img . "<br>";
					if ($img_download) {
						save_img ($img);
					};
					//echo "---------------------------<br>";
				}
			$arr_tovar["img_small"] = $img_small;
		
		//var_dump($arr_tovar);
		save_tovar_to_SQL($arr_tovar);
		
	
}		

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
		
		
		$query = "INSERT INTO Bitrixshop.tovar (`tovar_id`,`catalog_id`,`parent_id`,`name`,`brand`,`memo1`,`memo2`,`img_main`,`img_big`,`img_med`,`img_small`) VALUES ('" . $s1 . "','" . $s10 . "','" . $s11 . "','" . $s2 . "','" . $s3 . "','" . $s4 . "','" . $s5 . "','" . $s6 . "','" . $s7 . "','" . $s8 . "','" . $s9 . "')";
		$res = mysqli_query($link,$query);
		if ($res) {
			// Удаляем из таблицы "На загрузку" (Compare)
			$query = "DELETE FROM Bitrixshop.Compare WHERE tovar_id = " . s1;
			//$res = mysqli_query($link,$query);
		} else {
			echo "Ошибка загрузки данных: " . $query . "<br>";
		}


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


?>