<?php

		include_once('lib\sql.php');
		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$url = 'https://socialblade.com/youtube/top/50030d';
		
		$html = curl_get($url);
		
		$arr = array();	
	
		$dom = str_get_html($html);
		
		$films = $dom->find('.TableMonthlyStats');
		
		foreach($films as $film){
			
			$a = $film -> find('a',0);
			//echo $a->href . '<br>';			
			//echo $a->plaintext . '<br>';	
			$str = $a->plaintext;

			if (!empty($str)) {
			//$arr[] = $str."\r\n";
			$arr[] = $str;
			}

						
		}

//*********************************************************************************************************************
// Вывод массива на экран
//*********************************************************************************************************************
		foreach ($arr as $key => $value){

			echo "www.youtube.com/channel/".$value."/about<br>";
		
		}
		
//*********************************************************************************************************************
// Выгрузка данных в TXT - файл
//*********************************************************************************************************************
		
		//file_put_contents('1.txt', $arr, FILE_APPEND);			

//*********************************************************************************************************************
// Выгрузка данных в БД
//*********************************************************************************************************************

/*
		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
 
		$i = 0;
 
		//Загружаем данные в БД
		foreach ($arr as $key => $value){
			$value = mysqli_real_escape_string($link,$value);
			$query = "INSERT INTO `test1` (`s1`) VALUES ('" . $value . "');";
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
*/	
//*********************************************************************************************************************		

?>