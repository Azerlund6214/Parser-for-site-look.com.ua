<?php
	### 120620 1128 - 
	
	
	ob_implicit_flush(); ### Отключаем SAPI-буфер
	ob_end_flush();
	
	
	set_time_limit(0);
	
	
	
	
	########################################################
	
	
	
	include "LIB_simple_html_dom.php";
	
	##########################################
	
	#Подготовка всех переменных
	
	function write_in_file( $filename, $text )
	{
		if ( ! $handle = fopen($filename, 'a+')) exit ("Не могу открыть файл ($filename)");
		if (fwrite($handle, $text . PHP_EOL ) === FALSE) exit ("Не могу произвести запись в файл ($filename)");
		fclose($handle);
	}
	

	


	
	
	
	$urls_file   = "res/urls-img-big-3.txt";
	$sleep = 1;
	
	//exit("см код");
	
	$all_urls_from_file = file_get_contents($urls_file);
	
	$arr_all_urls_from_file = explode(PHP_EOL, $all_urls_from_file );
	
	
	
	echo "Количество ссылок:". count($arr_all_urls_from_file);
	$time = count($arr_all_urls_from_file)*$sleep;
	//echo "<br>Расчетное время = $time секунд = ". $time/60 . " минут";
	echo "<hr>";
	//exit;
	
	//print_r($arr_all_urls_from_file); exit;
	
	
	/*
	$begin_page = 1;
	$arr_pages_links = array();
	for ( $i = $begin_page ; $i<=321 ; $i++ )
	{
		$arr_pages_links []= "https://www.look.com.ua/space/page/$i/";
	
	}
	*/
	
	
	//print_r($arr_pages_links); exit;
	
	
	
	//write_in_file( $txt_name_log , date("Y-m-d H:i")." = Запущен цикл для: $post_url" );
	$i=1;
	foreach ( $arr_all_urls_from_file as $one_page_link)
	{	
		echo "<hr>Начало круга для - $i -> $one_page_link";
		
		//https://www.look.com.ua/download/16166/2560x1600/
		//https://www.look.com.ua/download.php?file=201209/2560x1600/look.com.ua-16166.jpg
		$full_url = "":
		
		
		$pick_name = 
		
		
		### SHD
		$SHD_html = file_get_html( $one_page_link );
		
		$path = '/images/1/logo.png';
		file_put_contents($path, file_get_contents($one_page_link));
		ff 404
		
		//write_in_file( $target_file , $BIGIMG_URL );
		echo "<br>Записал в файл ссылку = $BIGIMG_URL";
		
		
		unset( $SHD_html );
		
		
		
		
		echo "<br>Ложусь спать";
		
		sleep($sleep);
		
		echo " = Проснулся";
		
		
		
		
		
		$i++;
		
	}
	
	exit("Вышел  из цикла");
	exit("exit");
	
	
	EXIT( ); EXIT( ); EXIT( ); EXIT( ); EXIT( );
	
	
	
	
	
	###############################
	
	
	
	
	
	
	
	
	
	
	
	########################################################
	
	
	
	echo "<hr>Выход за пределы цикла - в файле не стоит END !!!!!";
	
	
	
	echo "<hr>123";
	
	
	
?>