<?php

		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		
//$url = 'http://optovik.biz.ua/Group/%D0%A7%D0%B0%D0%B9%D0%BD%D0%B8%D0%BA%D0%B8/10061';
$url = 'http://optovik.biz.ua/Group/%D0%9C%D1%8F%D1%81%D0%BE%D1%80%D1%83%D0%B1%D0%BA%D0%B8/10034';

$arr = array();

$arr_item = pagenator($url);

if ( $arr_item != null) {

	$arr = get_content($url);	//1-я страница

	foreach ($arr_item as $value) {
		$arr[] = get_content($value);	// последующие страницы
	}
//var_dump ($arr_item);	
	
} else {
	
	$arr = get_content($url);	//если только одна страница
	
}

saveSQL($arr);

//var_dump($arr);

function pagenator($url) { //Находим массив страниц

		//$url = 'http://optovik.biz.ua/Group/%D0%A7%D0%B0%D0%B9%D0%BD%D0%B8%D0%BA%D0%B8/10061';
		
		$html = curl_get($url);
		
		$dom = str_get_html($html);

		//************************************************************
		// Pagenator
		//************************************************************

		$pager_ul = $dom->find('ul.pager',0);
		
		$arr_page = array();

		$pager = $pager_ul->find('li');

		foreach($pager as $page){
		
			$attr_cl = $page->attr["class"];
		
			if ( $attr_cl != "r-arr" and $attr_cl != "l-arr" )  {
				
				$a = $page -> find('a.pager-item',0);
				
				//echo $a->href . "<br>";	
				
				$link = $a->href;
				
				if ($link != null) {
				
					$arr_page[] = "http://optovik.biz.ua" .  $link;
				}
			}

		}

		return $arr_page;
}



function get_content($url) {

		$arrstr = array();
		
		$arr_all = array($arrstr);
		
		//$all_str = "";

		$html = curl_get($url);
		
		$dom = str_get_html($html);


		$container = $dom->find('.sale-item');
		
		foreach($container as $item){
			
			$a = $item -> find("p",0);

			//$all_str = $a->plaintext . ";";
			$arrstr[0] = $a->plaintext;

			//echo "*************" . '<br>';
			$a = $item -> find("p",1);
			//$all_str = $all_str . $a->plaintext . ";";
			$arrstr[1] = $a->plaintext;

			//echo "*************" . '<br>';
			$a = $item -> find("img",0);
			//$all_str = $all_str . $a->src . ";";
			$arrstr[2] = $a->src;

			//echo "*************" . '<br>';
			$a = $item -> find("p.price",0);
			//$all_str = $all_str . $a->plaintext . ";";
			$arrstr[3] = $a->plaintext;

			//echo "*************" . '<br>';
			$a = $item -> find("a.to-cart",0);
			//$all_str = $all_str . $a->attr['product-id'] . ";";
			$arrstr[4] = $a->attr['product-id'];
			
			//$all_str = $all_str . $a->plaintext  . ";";
			$arrstr[5] = $a->plaintext;
			
			$a = $item -> find("a",0);
			//$all_str = $all_str . $a->href;
			$arrstr[5] = $a->href;

			//echo $all_str . '<br>';
			
			$arr_all[] = $arrstr;
		}
				
	return $arr_all;
}		
		
		
		//echo $html;
		//file_put_contents('1.txt', $html);


function saveSQL($arr) {
//*********************************************************************************************************************
// Выгрузка данных в БД
//*********************************************************************************************************************
		include_once('lib\sql.php');

		// подключаемся к SQL серверу
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
 
		$i = 0;

		for ($j=0;$j<count($arr);$j++){
			$s1 = mysqli_real_escape_string($link,$arr[$i][0]);
			$s2 = mysqli_real_escape_string($link,$arr[$i][1]);
			$s3 = mysqli_real_escape_string($link,$arr[$i][2]);
			$s4 = mysqli_real_escape_string($link,$arr[$i][3]);
			$s5 = mysqli_real_escape_string($link,$arr[$i][4]);
			$s6 = mysqli_real_escape_string($link,$arr[$i][5]);
			$s7 = mysqli_real_escape_string($link,$arr[$i][6]);

			$query = "INSERT INTO `test1` (`s1`,`s2`,`s3`,`s4`,`s5`,`s6`,`s7`) VALUES ('" . $s1 . "','" . $s2 . "','" . $s3 . "','" . $s4 . "','" . $s5 . "','" . $s6 . "','" . $s7 . "');";
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

}
//*********************************************************************************************************************		


		

?>