<?php
		//************************************************************************
		// Главный скрипт запуска всех скриптов
		//************************************************************************

		//require_once dirname(__FILE__) . '/lib/sql.php';
		require_once dirname(__FILE__) . '/lib/curl_query.php';
		require_once dirname(__FILE__) . '/lib/simple_html_dom.php';
		//require_once dirname(__FILE__) . '/Get_Catalog.php';
		require_once dirname(__FILE__) . '/Get_tovar.php';
		require_once dirname(__FILE__) . '/export_catalog_to_xls.php';
		require_once dirname(__FILE__) . '/export_tovar_to_xls.php';
		

		echo "<style>form{margin:0}td{border-bottom: 1px solid grey;}</style>";
		
		echo "<h2>Main Script</h2>";
	

		echo '<table>';
		echo '<tr><td style="border-style:hidden;width:200px">';
		echo '<form method = "post">';
		echo '<input type = "submit" name = "button4" value = "Load Catalog">';
		echo '</td>';
		echo '<td width="300px">';
		echo '<div id="proc4">:</div>';
		echo '</td></tr></table>';

		echo '<br>';
		echo '<br>';

		echo '<table>';
		echo '<tr><td style="border-style:hidden;width:200px">';
		echo '<form method = "post">';
		echo '<input type = "submit" name = "button5" value = "Load Tovar">';
		echo '</td>';
		echo '<td width="300px">';
		echo '<div id="proc5">:</div>';
		echo '</td></tr></table>';

		echo '<br>';
		echo '<br>*************************************************************************************************************************************';
		echo '<br>';
		echo '<br>';
		echo '<br>';
		echo '<br>';

		echo '<table>';
		echo '<tr><td style="border-style:hidden;width:200px">';
		echo '<form method = "post">';
		echo '<input type = "submit" name = "button3" value = "Compare Tovar">';
		echo '</td>';
		echo '<td width="300px">';
		echo '<div id="proc3">:</div>';
		echo '</td></tr></table>';

		echo '<br>';
		echo '<br>';
		echo '<br>*************************************************************************************************************************************';
		echo '<br>';
		echo '<br>';

		echo '<table>';
		echo '<tr><td style="border-style:hidden;width:200px">';
		echo '<form method = "post">';
		echo '<input type = "submit" name = "button1" value = "Export Catalog to Excel">';
		echo '</td>';
		echo '<td width="300px">';
		echo '<div id="proc1">:</div>';
		echo '</td></tr></table>';

		echo '<br>';
		echo '<br>';

		
		echo '<table>';
		echo '<tr><td style="border-style:hidden;width:200px">';
		echo '<form method = "post">';
		echo '<input type = "submit" name = "button2" value = "Export Tovar to Excel">';
		echo '</td>';
		echo '<td width="300px">';
		echo '<div id="proc2">:</div>';
		echo '</td></tr></table>';
		
		echo '<br>';
		echo '<br>';
		echo '<br>*************************************************************************************************************************************';
		echo '<br>Log area:';
		echo '<br>*************************************************************************************************************************************';
		echo '<br>';
		echo '<br>';



		
		if ( isset ( $_POST['button1'] )) {		//Export Catalog to Excel
	
			echo '<script>
			document.all.proc1.innerHTML = "'. catalog_to_xlsx () .' ";
			</script>'; 
			flush();
	
		}

		if ( isset ( $_POST['button2'] )) {		//Export Tovar to Excel
	
			echo '<script>
			document.all.proc2.innerHTML = "'. tovar_to_xlsx () .' ";
			</script>'; 
			flush();

		}

		if ( isset ( $_POST['button3'] )) {		//Compare Tovar
	
			echo '<script>
			document.all.proc3.innerHTML = "'. start_compare_tovar() .' ";
			</script>'; 
			flush();

		}

		if ( isset ( $_POST['button4'] )) {		//Load Catalog
	
			echo '<script>
			document.all.proc4.innerHTML = "'. start_get_catalog() .' ";
			</script>'; 
			flush();

		}

		if ( isset ( $_POST['button5'] )) {		//Load Tovar
	
			echo "Start Load Tovar:";
			echo '<script>
			document.all.proc5.innerHTML = "'. start_get_tovar() .' ";
			</script>'; 
			flush();

		}

		
?>