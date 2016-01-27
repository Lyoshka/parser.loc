<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/lib/PHPExcel.php';


function tovar_to_xlsx() {

		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Boy Gruv")
									 ->setLastModifiedBy("Boy Gruv")
									 ->setTitle("PHPExcel Document")
									 ->setSubject("PHPExcel Document")
									 ->setDescription("Document for PHPExcel, generated using PHP classes.")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("Result file");


								 
		// Заголовок страницы Products
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'name(en)')
					->setCellValue('C1', 'name(ru)')
					->setCellValue('D1', 'categories')
					->setCellValue('E1', 'sku')
					->setCellValue('F1', 'upc')
					->setCellValue('G1', 'ean')
					->setCellValue('H1', 'jan')
					->setCellValue('I1', 'isbn')
					->setCellValue('J1', 'mpn')
					->setCellValue('K1', 'location')
					->setCellValue('L1', 'quantity')
					->setCellValue('M1', 'model')
					->setCellValue('N1', 'manufacturer')
					->setCellValue('O1', 'image_name')
					->setCellValue('P1', 'shipping')
					->setCellValue('Q1', 'price')
					->setCellValue('R1', 'points')
					->setCellValue('S1', 'date_added')
					->setCellValue('T1', 'date_modified')
					->setCellValue('U1', 'date_available')
					->setCellValue('V1', 'weight')
					->setCellValue('W1', 'weight_unit')
					->setCellValue('X1', 'length')
					->setCellValue('Y1', 'width')
					->setCellValue('Z1', 'height')
					->setCellValue('AA1', 'length_unit')
					->setCellValue('AB1', 'status')
					->setCellValue('AC1', 'tax_class_id')
					->setCellValue('AD1', 'seo_keyword')
					->setCellValue('AE1', 'description(en)')
					->setCellValue('AF1', 'description(ru)')
					->setCellValue('AG1', 'meta_title(en)')
					->setCellValue('AH1', 'meta_title(ru)')
					->setCellValue('AI1', 'meta_description(en)')
					->setCellValue('AJ1', 'meta_description(ru)')
					->setCellValue('AK1', 'meta_keywords(en)')
					->setCellValue('AL1', 'meta_keywords(ru)')
					->setCellValue('AM1', 'stock_status_id')
					->setCellValue('AN1', 'store_ids')
					->setCellValue('AO1', 'layout')
					->setCellValue('AP1', 'related_ids')
					->setCellValue('AQ1', 'tags(en)')
					->setCellValue('AR1', 'tags(ru)')
					->setCellValue('AS1', 'sort_order')
					->setCellValue('AT1', 'subtract')
					->setCellValue('AU1', 'minimum');

		// Заполняем данные

		$i = 2;

		$arr = SQL_get_tovar();


			for($j=0;$j<count($arr);$j++) {

				$i = $j + 2;
				
				$s1 = $arr[$j]["catalog_id"] + 100;
				$s2 = $arr[$j]["parent_id"] + 100;
				

				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i, $arr[$j]["id"] + 100)
						->setCellValue('B'.$i, str_replace('&quot;','"',$arr[$j]["name"]))
						->setCellValue('C'.$i, str_replace('&quot;','"',$arr[$j]["name"]))
						->setCellValue('D'.$i, (string) $s1 . "," . (string) $s2)
						->setCellValue('L'.$i, '100')
						->setCellValue('M'.$i, $arr[$j]["tovar_id"])
						->setCellValue('N'.$i, $arr[$j]["brand"])
						->setCellValue('O'.$i, $arr[$j]["img_main"])
						->setCellValue('P'.$i, 'yes')
						->setCellValue('Q'.$i, $arr[$j]["price"])
						->setCellValue('S'.$i, date('Y-m-d H:i:s'))
						->setCellValue('T'.$i, date('Y-m-d H:i:s'))
						->setCellValue('U'.$i, date('Y-m-d'))
						->setCellValue('V'.$i, $arr[$j]["weight"])
						->setCellValue('AB'.$i, 'true')
						->setCellValue('AB'.$i, 'true')
						->setCellValue('AC'.$i, '0')
						->setCellValue('AE'.$i, $arr[$j]["memo1"])
						->setCellValue('AF'.$i, $arr[$j]["memo1"])
						->setCellValue('AM'.$i, '7')
						->setCellValue('AN'.$i, '0')
						->setCellValue('AS'.$i, '0')
						->setCellValue('AT'.$i, 'true')
						->setCellValue('AU'.$i, '1');
						

			}


		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Products');

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'AdditionalImages');
		$objPHPExcel->addSheet($MyWorkSheet,1);

		// Заголовок страницы AdditionalImages
		$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'image')
					->setCellValue('C1', 'sort_order');

				$i = 2;
				
			// Заполняем данные
				for($j=0;$j<count($arr);$j++) {

					$arr_img = array();
					
					$arr_img = img_pars($arr[$j]["img_med"]);

					for($k=0;$k<count($arr_img);$k++) {
						$objPHPExcel->setActiveSheetIndex(1)
								->setCellValue('A'.$i, $arr[$j]["id"] + 100 )
								->setCellValue('B'.$i, $arr_img[$k])
								->setCellValue('C'.$i, '0');
						$i = $i + 1;
								
					}
				
				}
				
					
					
		//***********************************************************************************************************

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Specials');
		$objPHPExcel->addSheet($MyWorkSheet,2);

		// Заголовок страницы Specials
		$objPHPExcel->setActiveSheetIndex(2)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'customer_group')
					->setCellValue('C1', 'priority')
					->setCellValue('D1', 'price')
					->setCellValue('E1', 'date_start')
					->setCellValue('F1', 'date_end');
		//***********************************************************************************************************

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Discounts');
		$objPHPExcel->addSheet($MyWorkSheet,3);

		// Заголовок страницы Discounts
		$objPHPExcel->setActiveSheetIndex(3)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'customer_group')
					->setCellValue('C1', 'quantity')
					->setCellValue('D1', 'priority')
					->setCellValue('E1', 'price')
					->setCellValue('F1', 'date_start')
					->setCellValue('G1', 'date_end');
		//***********************************************************************************************************

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Rewards');
		$objPHPExcel->addSheet($MyWorkSheet,4);

		// Заголовок страницы Rewards
		$objPHPExcel->setActiveSheetIndex(4)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'customer_group')
					->setCellValue('C1', 'points');
		//***********************************************************************************************************

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ProductOptions');
		$objPHPExcel->addSheet($MyWorkSheet,5);

		// Заголовок страницы ProductOptions
		$objPHPExcel->setActiveSheetIndex(5)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'option')
					->setCellValue('C1', 'default_option_value')
					->setCellValue('D1', 'required');
		//***********************************************************************************************************

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ProductOptionValues');
		$objPHPExcel->addSheet($MyWorkSheet,6);

		// Заголовок страницы ProductOptionValues
		$objPHPExcel->setActiveSheetIndex(6)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'option')
					->setCellValue('C1', 'option_value')
					->setCellValue('D1', 'quantity')
					->setCellValue('E1', 'subtract')
					->setCellValue('F1', 'price')
					->setCellValue('G1', 'price_prefix')
					->setCellValue('H1', 'points')
					->setCellValue('I1', 'points_prefix')
					->setCellValue('J1', 'weight')
					->setCellValue('K1', 'weight_prefix');
		//***********************************************************************************************************

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ProductAttributes');
		$objPHPExcel->addSheet($MyWorkSheet,7);

		// Заголовок страницы ProductAttributes
		$objPHPExcel->setActiveSheetIndex(7)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'attribute_group')
					->setCellValue('C1', 'attribute')
					->setCellValue('D1', 'text(en)')
					->setCellValue('E1', 'text(ru)');
		//***********************************************************************************************************

		//***********************************************************************************************************
		//Добавляем новую страницу
		$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ProductFilters');
		$objPHPExcel->addSheet($MyWorkSheet,8);

		// Заголовок страницы ProductFilters
		$objPHPExcel->setActiveSheetIndex(8)
					->setCellValue('A1', 'product_id')
					->setCellValue('B1', 'filter_group')
					->setCellValue('C1', 'filter');
		//***********************************************************************************************************



		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		$callEndTime = microtime(true);
		$callTime = $callEndTime - $callStartTime;

		//echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
	
		$ret_str = date('H:i:s') . " File written to " . str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
		
		return $ret_str;


}

//********************************************************************

function SQL_get_tovar () {		//Функция выборки каталогов для последующего экспорта в Excel

	include_once('lib\sql.php');

	$arr = array();
	
	$i = 0;
	
	// подключаемся к SQL серверу
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

		$query = 'select id,tovar_id,catalog_id,parent_id,name,brand,memo1,memo2,img_main,img_med,weight,price from bitrixshop.tovar';	
		
		$result = mysqli_query($link, $query);
		
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			
				$arr[$i]["id"] 			= $row["id"];
				$arr[$i]["tovar_id"] 	= $row["tovar_id"];
				$arr[$i]["catalog_id"] 	= $row["catalog_id"];
				$arr[$i]["parent_id"] 	= $row["parent_id"];
				$arr[$i]["name"] 		= $row["name"];
				$arr[$i]["brand"] 		= $row["brand"];
				$arr[$i]["memo1"] 		= $row["memo1"];
				$arr[$i]["memo2"] 		= $row["memo2"];
				$arr[$i]["img_main"] 	= $row["img_main"];
				$arr[$i]["img_med"] 	= $row["img_med"];
				$arr[$i]["weight"] 		= $row["weight"];
				$arr[$i]["price"] 		= $row["price"];
				$i = $i + 1;
				
		}
	
	$result->close();
	//Закрываем соединение с БД 
	$link->close();

	return $arr;
}

function img_pars ($str_in) {		//Функция разбора строки с разделителем |
	
	$arr = array();
	
	$arr = explode("|",$str_in);
	
	return $arr;
	
}
