<?php
//*****************************************************************************
//  парсинг товаров сайта http://www.petshop.ru. Сайт BITRIX
//  Файл №2. Парсинг товаров
//*****************************************************************************


		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		//$url = 'http://www.petshop.ru/catalog/dogs/lezaki/';	
		$url = 'http://ibody.ru/catalog/instrumenty/facial/';	
		

		include_once('lib\sql.php');

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	
			
	
			$query = 'select s3 from bitrixshop.catalog where s1 = "Товары для рыб"';
			$result = mysqli_query($link, $query);
			
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
				//echo $row['s3'] . "<br>";
				getItem($row['s3']);
				
			}
			

			//var_dump($arr_res);

	
		//Закрываем соединение с БД 
		mysqli_close($link);
		
		
function getItem($url) {
	
	
		$html = curl_get($url);

		$dom = str_get_html($html);
		
		$container = $dom->find('.product-item');
		
			foreach($container as $item){

				echo $item->attr['data-id'] . "   ";		
				
				$a = $item->find('a',0);
				
				echo $a->href . "<br>";
		
			}
}	


?>