<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/lib/PHPExcel.php';


$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Boy Gruv")
							 ->setLastModifiedBy("Boy Gruv")
							 ->setTitle("PHPExcel Document")
							 ->setSubject("PHPExcel Document")
							 ->setDescription("Document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Result file");


						 
// Заголовок страницы Categories
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'category_id')
            ->setCellValue('B1', 'parent_id')
            ->setCellValue('C1', 'name(en)')
			->setCellValue('D1', 'name(ru)')
			->setCellValue('E1', 'top')
			->setCellValue('F1', 'columns')
			->setCellValue('G1', 'sort_order')
			->setCellValue('H1', 'image_name')
			->setCellValue('I1', 'date_added')
			->setCellValue('J1', 'date_modified')
			->setCellValue('K1', 'seo_keyword')
			->setCellValue('L1', 'description(en)')
			->setCellValue('M1', 'description(ru)')
			->setCellValue('N1', 'meta_title(en)')
			->setCellValue('O1', 'meta_title(ru)')
			->setCellValue('P1', 'meta_description(en)')
			->setCellValue('Q1', 'meta_description(ru)')
			->setCellValue('R1', 'meta_keywords(en)')
			->setCellValue('S1', 'meta_keywords(ru)')
			->setCellValue('T1', 'store_ids')
			->setCellValue('U1', 'layout')
			->setCellValue('V1', 'status');

// Заполняем данные
$i = 2;

$arr = SQL_get_catalog();


	for($j=0;$j<count($arr);$j++) {

		$i = $j + 2;

		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $arr[$j]["id_cat"] + 100)
				->setCellValue('B'.$i, $arr[$j]["parent_id"] + 100)
				->setCellValue('D'.$i, $arr[$j]["name"])
				->setCellValue('E'.$i, 'true')
				->setCellValue('F'.$i, '1')
				->setCellValue('G'.$i, '0')
				->setCellValue('I'.$i, date('Y-m-d H:i:s'))
				->setCellValue('J'.$i, date('Y-m-d H:i:s'))
				->setCellValue('K'.$i, '')
				->setCellValue('M'.$i, '')
				->setCellValue('T'.$i, '0')
				->setCellValue('V'.$i, 'true');

	}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Categories');


//Добавляем новую страницу
$MyWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'CategoryFilters');
$objPHPExcel->addSheet($MyWorkSheet,1);

// Заголовок страницы CategoryFilters
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'category_id')
            ->setCellValue('B1', 'filter_group')
            ->setCellValue('C1', 'filter');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;


//********************************************************************

function SQL_get_catalog () {		//Функция выборки каталогов для последующего экспорта в Excel

require_once dirname(__FILE__) . '/lib/sql.php';

	$arr = array();
	
	$i = 0;
	
	// подключаемся к SQL серверу
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

		$query = 'select id_cat,parent_id,name from bitrixshop.catalog';	
		
		$result = mysqli_query($link, $query);
		
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			
				$arr[$i]["id_cat"] = $row["id_cat"];
				$arr[$i]["parent_id"] = $row["parent_id"];
				$arr[$i]["name"] = $row["name"];
				$i = $i + 1;
				
		}
	
	$result->close();
	//Закрываем соединение с БД 
	$link->close();

	return $arr;
}
