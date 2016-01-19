<?php
//*****************************************************************************
//  ������� ������� ����� http://www.petshop.ru. ���� BITRIX
//  
//*****************************************************************************


		include_once('lib\curl_query.php');
		include_once('lib\simple_html_dom.php');

		$site = 'http://www.petshop.ru';
		//$url = 'http://www.petshop.ru/catalog/fish/';	//1-� �������
		$url = 'http://www.petshop.ru/catalog/cats/syxkor/';	//2-� �������
		
		
		$arr = get_page_count($url);
		
		//var_dump($arr);
		
		
function get_page_count($url){	//������� ����������� ���-�� ������� � ��������
	
		global $site;
		
		$html = curl_get($url);
		
		$arr_page = array();
		
		$arr_page[] = $url;
		
		$dom = str_get_html($html);
		
		$pages = $dom->find('.page-navigation',0);
		
		if ($pages != null) {
		
				$container = $pages->find('a[class!="next"]');
				
				foreach($container as $item){
					
					//echo $item->href .  '<br>';
					$arr_page[] = $site . $item->href;
					
				}
		
		}
		
		return $arr_page;
	
}
		
function get_lvl_1($url) {	//������� ��������� ������� ������ 1-�� ������

		$html = curl_get($url);
		
		$arr_level11 = array();
		$arr_level_1 = array($arr_level11);
		
		$dom = str_get_html($html);
		
		$container = $dom->find('.submenu-list a');
		
		$i = 0;
		
		foreach($container as $item){
			
			
			//echo $site . $item->href . '  ' . $item->plaintext . '<br>';
				$arr_level11[0] = $item->plaintext;
				$arr_level11[1] = $item->href;
				
				$arr_level_1[$i] = $arr_level11;
				$i = $i + 1;
			
		}
	
	//������� 1-� ������� 
	
	return $arr_level_1;
}
		
		
?>