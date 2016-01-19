<?php
//*****************************************************************************
//  парсинг текстов песен сайта http://www.lyricsmania.com
//  недделан, на сайте стоит защита от парсинга, блокирует по IP на сутки
//*****************************************************************************


		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$id = 1;
		$url = 'http://www.lyricsmania.com';
		
		$html = curl_get($url);
		
		
		$dom = str_get_html($html);
		
		$container = $dom->find('.search-nav a');
		
		foreach($container as $item){
			
			//echo $item->href . '<br>';			//
			$url_new = $item->href;
		}
		
		//***********************************************************************
		
		$html = curl_get($url . $url_new);
		
		$dom = str_get_html($html);
		
		$container = $dom->find('.col-left ul li a');
		
		foreach($container as $item){
			
			//echo $item->href . '<br>';			//
			$url_sing = $item->href;
		}
		
		//echo $dom;
		
		//***********************************************************************
		
				
		$html = curl_get($url . $url_sing);
		
		$dom = str_get_html($html);
		
		$container = $dom->find('.col-left ul li a');
		
		foreach($container as $item){
			
			//echo $item->href . '<br>';			//
			$url_alb = $item->href;
		}
		
		//echo $dom;

		
		//***********************************************************************
		
		$url_alb = "/bob_marley_lyrics.html";
		
		$sing_arr = array();
		
		$html = curl_get($url . $url_alb);
		
		$dom = str_get_html($html);
		
		echo  $dom->find('body h1',0) . "<br>";
		
		$container = $dom->find('.album');
		
		foreach($container as $item){
			
			$album = $item -> find('a h2',0);	
			
			echo $album ;//
			
			$single = $item -> find('ul',0);
			
				foreach($single->find('li') as $li) 
				{
					    //echo $li -> plaintext . "  ";
						
						$text_page = $url  . $li -> find(a,0)->href . "<br>";
						
						$sing_arr[] = $url  . $li -> find(a,0)->href; 
							
						//echo $text_page;
						
						
				}
					
			//$url_new = $item->href;
		}
		
		$url = "http://www.lyricsmania.com/want_more_lyrics_bob_marley.html";
		
		$html = curl_get($url);
		
		$dom = str_get_html($html);
			
			$sing =  $dom->find('.p402_premium');
			
			echo $sing -> plaintext;
		
		
/*		
		foreach( $sing_arr as $key => $val ) {
		
			echo $val . "<br>";
			
			$html = curl_get($val);
			
			$dom = str_get_html($html);
			
			$sing =  $dom->find('.p402_premium');
			
			echo $sing -> plaintext . "<br>";
			
			
			echo "************************ <br>";
			
		}
	*/	
		
		
?>