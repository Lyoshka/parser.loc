<?php

		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');
		

		header('Content-type: text/html; charset=utf-8');
		mb_internal_encoding('UTF-8');
		
		$id = 1;
		$maxpost = '5';
		
		for($j = 0; $j < $maxpost; $j++) {
			
			$arr = array();	
			
			$url = 'http://www.imdb.com/search/title?sort=moviemeter,asc&start=' . $id . '&title_type=feature';
			
			$html = curl_get($url);
			
			
			$dom = str_get_html($html);
			
			$films = $dom->find('.title');
			
			foreach($films as $film){
				
				$a = $film -> find('a',0);
				//echo $a->href . '<br>';			//Ссылки
				
				//$str = $a->plaintext . '<br>';		//Значения тега 
				$str = $a->plaintext;		//Значения тега 
							
				
				//echo Unicode2Charset($str);
				$arr[] = Unicode2Charset($str)."\r\n";
				
				//break;
				
			}
			
			file_put_contents('1.txt', $arr, FILE_APPEND);			
			//echo $html;
			//file_put_contents('1.txt', $html);

			$id = $id + 50;
			
			//$html->clear();
			//unset($html);
		
		}
		
		
		function Unicode2Charset($str, $charset = 'UTF-8') { 
		  return preg_replace(
			'~&#(?:x([\da-f]+)|(\d+));~ie',
			'iconv("UTF-16LE", $charset, pack("v", "$1" ? hexdec("$1") : "$2"))',
			$str
		  );
		}

?>