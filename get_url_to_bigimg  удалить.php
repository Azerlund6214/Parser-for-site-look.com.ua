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
	
	/*
	echo "<hr color=red>";
	echo "<br>".$post_url;
	echo "<br>".$target_file_name;
	echo "<br>".$post_date;
	echo "<br>";
	echo "<pre>"; print_r( explode( PHP_EOL , $txt_data ) ); echo "</pre>"; // Построчно, без разбивки, для наглядности
	echo "<hr color=red>";
	*/
	
	


	
	
	/*
		// Поиск по тегам и классам
		#########
		#$html = file_get_contents( $post_url );
		
		### Explode
		#$current_likes = explode( '</b>' , explode( '<b class="v_like" aria-hidden="true">' , $html )[1] )[0]   ;
		#$current_views = explode( '</b>' , explode( '<b class="v_views">' , $html )[1] )[0]   ;
		
		### RegExp (робит, но кривовато)
		#preg_match_all('|<b class="v_like" aria-hidden="true">(.+?)</b>|isU', $html, $current_likes);
		#preg_match_all('|<b class="v_views">(.+?)</b>|isU', $html, $current_views);
		
		#unset( $html );
		#########
	
	*/
	
	// СКАЧАНЫ прямые ссылки
	//
	
	$urls_file   = "res/urls-img-1.txt";
	$target_file = "res/urls-img-big-1.txt";
	$sleep = 1;
	
	//exit("см код");
	
	$all_urls_from_file = file_get_contents($urls_file);
	
	$arr_all_urls_from_file = explode(PHP_EOL, $all_urls_from_file );
	
	
	
	echo "Количество ссылок:". count($arr_all_urls_from_file);
	$time = count($arr_all_urls_from_file)*$sleep;
	echo "<br>Расчетное время = $time секунд = ". $time/60 . " минут";
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
		
		### SHD
		$SHD_html = file_get_html( $one_page_link );
		
		//$BIGIMG_URL = $SHD_html -> find('div span div a[rel=nofollow]')[0] -> attr['href'];
		$BIGIMG_URL = $SHD_html -> find('div div span ul li a')[0] -> attr['href'];
		
		$BIGIMG_URL = 'https://www.look.com.ua'.$BIGIMG_URL;
		
		//echo "<br> $BIGIMG_URL";
		//exit;
		
		write_in_file( $target_file , $BIGIMG_URL );
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