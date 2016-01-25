<?php

		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$url = 'http://www.imdb.com/search/title?sort=moviemeter,asc&start=1&title_type=feature';
		
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