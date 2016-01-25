<?php

		include_once('lib\sql.php');
		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$url = 'https://socialblade.com/youtube/top/50030d';
		
		$html = curl_get($url);
		
		$arrstr = array(6);
		
		
		$arr = array($arrstr);
			
	
		$dom = str_get_html($html);
		
		$films = $dom->find('.TableMonthlyStats');
		
		$i = 0;
		$j = 0;
		
		foreach($films as $film){

			if ($j == 2) {
				$string =  $film -> find('a',0) -> plaintext;
			} else {
				$string = $film -> plaintext;
			}
						
		
			if (!empty($string)) {
				$arr[$i][$j] = $string;
			}
			
			$j = $j + 1;
			
			if ($j == 5) {
				$i = $i + 1;
				$j = 0;
			}
					
					
					//$a = $film -> find('a',0);
					//echo $a->href . '<br>';			
					//echo $a->plaintext . '<br>';	
					//$str = $a->plaintext;

					//if (!empty($str)) {
					//$arr[] = $str."\r\n";
					//$arr[] = $str;
					//}

						
		}

		
//*********************************************************************************************************************
// Вывод массива на экран
//*********************************************************************************************************************
/*
		for ($i=0;$i<count($arr);$i++){

			echo $arr[$i][0]."  ".$arr[$i][2]."  ".$arr[$i][3]."  ".$arr[$i][4]. "<br>";
		
		}
*/	
//*********************************************************************************************************************
// Выгрузка данных в TXT - файл
//*********************************************************************************************************************
		
		//file_put_contents('1.txt', $arr, FILE_APPEND);			

//*********************************************************************************************************************
// Выгрузка данных в БД
//*********************************************************************************************************************



		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
 
		$i = 0;

		for ($j=0;$j<count($arr);$j++){
			$s1 = mysqli_real_escape_string($link,$arr[$i][0]);
			$s2 = mysqli_real_escape_string($link,$arr[$i][2]);
			$s3 = mysqli_real_escape_string($link,$arr[$i][3]);
			$s4 = mysqli_real_escape_string($link,$arr[$i][4]);

			$query = "INSERT INTO `test1` (`s1`,`s2`,`s3`,`s4`) VALUES ('" . $s1 . "','" . $s2 . "','" . $s3 . "','" . $s4 . "');";
			$res = mysqli_query($link,$query);
			if ($res) {
				$i = $i+1; 
			} else {
				echo "Ошибка загрузки данных: " . $query . "<br>";
			}
		
		}


/*		
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
*/

		echo "В БД загружено " . $i . " записей";
		
		//Закрываем соединение с БД 
		mysqli_close($link);

//*********************************************************************************************************************		

?>