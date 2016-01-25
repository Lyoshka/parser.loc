<?php

		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$id = 1;
		$url = 'http://optovik.biz.ua/Destination/%D0%9C%D0%B5%D0%BB%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%8B%D1%82%D0%BE%D0%B2%D0%B0%D1%8F%20%D1%82%D0%B5%D1%85%D0%BD%D0%B8%D0%BA%D0%B0/10002';
		
		$html = curl_get($url);
		
		
		$dom = str_get_html($html);
		
		$films = $dom->find('.title');
		
		foreach($films as $film){
			
			$a = $film -> find('a',0);
			//echo $a->href . '<br>';			//Ссылки
			echo $a->plaintext . '<br>';	//Значения тега 
						
		}
		
		//echo $html;
		//file_put_contents('1.txt', $html);

		$html->clear();
		unset($html);
		
		

?>