<?php
	### 120620 1128 - 
	
	
	ob_implicit_flush(); ### Отключаем SAPI-буфер
	ob_end_flush();
	
	
	set_time_limit(0);
	
	$debug_mode = true; // Не будет реального перехода
	
	
	$txt_name_log = "0=logs.txt";
	
	
	$TARGET_URL = "https://www.look.com.ua/space/page/2/";
	
	//$curr_file_url = $_SERVER['PHP_SELF'];
	
	
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
	
	

	
	
	// убрать
	function getTags( $some_link, $tagName, $attrName, $attrValue )
	{
		/*
		$tagName = 'div';
		$attrName = 'class';
		$attrValue = 'like_button_count';
		*/
		$dom = new DOMDocument;
		$dom->preserveWhiteSpace = false;
		$dom->loadHTMLFile($some_link);
		
		
		$html = '';
		$domxpath = new DOMXPath($dom);
		$newDom = new DOMDocument;
		$newDom->formatOutput = true;
		
		$filtered = $domxpath->query("//$tagName" . '[@' . $attrName . "='$attrValue']");
		// $filtered =  $domxpath->query('//div[@class="className"]');
		// '//' when you don't know 'absolute' path
		
		// since above returns DomNodeList Object
		// I use following routine to convert it to string(html); copied it from someone's post in this site. Thank you.
		$i = 0;
		while( $myItem = $filtered->item($i++) ){
			$node = $newDom->importNode( $myItem, true );    // import node
			$newDom->appendChild($node);                    // append node
		}
		$html = $newDom->saveHTML();
		
		return $html;
	}
	
	
	
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
	
	$begin_page = 1;
	
	$arr_pages_links = array();
	for ( $i = $begin_page ; $i<=321 ; $i++ )
	{
		$arr_pages_links []= "https://www.look.com.ua/space/page/$i/";
	
	}
	
	//print_r($arr_pages_links); exit;
	
	
	
	//write_in_file( $txt_name_log , date("Y-m-d H:i")." = Запущен цикл для: $post_url" );
	
	foreach ( $arr_pages_links as $one_page_link)
	{	
		echo "<hr>Начало круга для -> $one_page_link";
		
		### SHD
		$SHD_html = file_get_html( $one_page_link );
		
		
		
		$IMG_PAGE_URLS = $SHD_html -> find('.gallery_image');// -> attr['href'];
		
		$arr_page_urls = array();
		
		foreach ( $IMG_PAGE_URLS as $url )
		{
			$arr_page_urls []= $url-> attr['href'];
		
		}
		
		echo "<pre>";
		print_r(  $arr_page_urls );
		echo "</pre>";
		
		
		
		foreach ( $arr_page_urls as $url )
		{
			write_in_file( "urls.txt" , $url );
			echo "<br>Записал в файл ссылку = $url";
		}
		
		
		unset( $SHD_html );
		unset( $arr_page_urls );
		
		
		echo "<br>Ложусь спать";
		
		sleep(2);
		
		echo "<br>Проснулся";
		
		
		
		
		
		
		
	}
	
	exit("Вышел  из циклв");
	exit("exit");
	
	
	EXIT( ); EXIT( ); EXIT( ); EXIT( ); EXIT( );
	
	
	
	
	
	###############################
	
	
	
	
	
	
	
	
	
	
	
	########################################################
	
	
	
	echo "<hr>Выход за пределы цикла - в файле не стоит END !!!!!";
	
	
	
	echo "<hr>123";
	
	
	
?>