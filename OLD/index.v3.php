<?php

		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');
		

		
		$id = 1;
		$maxpost = 2;
		
		for($j = 0; $j < $maxpost; $j++) {
			
			$arr = array();	
			//$url = 'http://www.imdb.com/search/title?at=0&num_votes=5000,&sort=moviemeter&start=' . $id . '&title_type=tv_series,mini_series';
			$url = 'http://www.imdb.com/search/title?sort=moviemeter,asc&start=' . $id . '&title_type=feature';
			
			$html = curl_get($url);
			
			
			$dom = str_get_html($html);
			
			$films = $dom->find('.image');
			
			foreach($films as $film){
				
				$a = $film -> find('a',0);
				//echo $a->href . '<br>';			//Ссылки
				
				//$str = $a->plaintext . '<br>';		//Значения тега 
				$str = $a->title;		//Значения тега 
							
				
				//echo Unicode2Charset($str);
				$arr[] = Unicode2Charset($str)."\r\n";
				
				//break;
				
			}
			
			file_put_contents('1.txt', $arr, FILE_APPEND);			
			//echo $html;
			//file_put_contents('1.txt', $html);
			echo $id . '<br>';
			$id = $id + 50;
			
			//$dom->clear();
			//unset($dom);
		
		}
		
		
		function Unicode2Charset($str, $charset = 'UTF-8') { 
		  return preg_replace(
			'~&#(?:x([\da-f]+)|(\d+));~ie',
			'iconv("UTF-16LE", $charset, pack("v", "$1" ? hexdec("$1") : "$2"))',
			$str
		  );
		}

?>