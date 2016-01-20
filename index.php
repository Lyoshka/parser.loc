<?php
//*****************************************************************************
//  парсинг товаров сайта http://www.petshop.ru. Сайт BITRIX
//  Файл №2. Парсинг товаров
//*****************************************************************************


		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		//$url = 'http://www.petshop.ru/catalog/dogs/lezaki/';	
		//$url = 'http://ibody.ru/catalog/instrumenty/facial/';	
		$url = 'http://www.petshop.ru/catalog/dogs/kosti/hrustyashki/lakomstvo_dlya_sobak_vozdushnye_shariki_delizie_pcat207_22730/';

		
		$html = curl_get($url);

		$dom = str_get_html($html);
		
		//************************************************
		$container = $dom->find('.card-header h1',0);
		
		echo $container->plaintext . "<br>";
		echo "************************************************************************<br>";	
			
		//************************************************
		$container = $dom->find('.good-brand a',0);
		
		echo $container->plaintext . "<br>";
		echo "************************************************************************<br>";	
			
		//************************************************
		$container = $dom->find('.j_offer_price',0);
					
		echo $container->attr['value'] . "<br>";
		echo "************************************************************************<br>";	
			
		//************************************************
		$container = $dom->find('.type-inst',0);
		
		echo $container->plaintext . "<br>";
		echo "************************************************************************<br>";	
		
		//************************************************
		$container = $dom->find('div[id=product-features]',0);
		
		echo $container->outertext . "<br>";
		echo "************************************************************************<br>";		
		
		//************************************************
		$container = $dom->find('.char-item',0);
		
		echo $container->outertext . "<br>";
		echo "************************************************************************<br>";	

		//************************************************
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
		
		
		
		//************************************************
		$container = $dom->find('.product_photo',0);
		
		echo $container->src . "<br>";
		echo "************************************************************************<br>";
		
		//************************************************
		$container = $dom->find('.js-preview-img li a',0);
		
		echo $container->href . "<br>";
		echo "************************************************************************<br>";

		//************************************************
		$container = $dom->find('.js-small-img li');
		
		foreach($container as $item){
		
				
				$a = $item->find('img',0);
				
				echo $a->src . "<br>";
				echo "---------------------------<br>";
			}
		
		
		
		

function list_item() {		
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
}		
		
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