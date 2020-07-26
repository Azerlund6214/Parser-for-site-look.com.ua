<?php
	
	ob_implicit_flush(); ### Отключаем SAPI-буфер
	ob_end_flush();
	
	set_time_limit(0);
	
	include "LIB_simple_html_dom.php";
	
	
	
	/**
	 * Записывает $text в файл $filename
	 * @param $filename string
	 * @param $text string
	 */
	function write_in_file( $filename, $text )
	{
		if ( ! $handle = fopen($filename, 'a+')) exit ("Не могу открыть файл ($filename)");
		if (fwrite($handle, $text . PHP_EOL ) === FALSE) exit ("Не могу произвести запись в файл ($filename)");
		fclose($handle);
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
	
	// СКАЧАНЫ прямые ссылки
	// 1 2
	
	$urls_file   = "res/urls-img-3.txt";
	$target_file = "res/urls-img-big-3.txt";
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
	
	
	$i=1;
	foreach ( $arr_all_urls_from_file as $one_page_link)
	{	
		echo "<hr>Начало круга для - $i -> <a href=\"$one_page_link\">$one_page_link</a>";
		
		###
		
		try	{
			echo "<br>Скачиваю общую страницу про картинку => ";
			$SHD_html = file_get_html( $one_page_link );
			echo "Скачал";
			
			
			$url_to_bigimg_page = $SHD_html -> find('div div span ul li a')[0] -> attr['href'];
			$url_to_bigimg_page = 'https://www.look.com.ua'.$url_to_bigimg_page;
		
		}catch(Error $e){
							echo "<br>Невалидный URL - пропускаю ($one_page_link)"; continue;
						}
		
		echo "<br>Вытащил ссылку на страницу хайреза = <a href=\"$url_to_bigimg_page\">$url_to_bigimg_page</a>";
		
		echo "<br>Ложусь спать"; sleep($sleep);	echo " => Проснулся";
		
		
		###
		
		
		echo "<br>Скачиваю страницу про хайрез => ";
		$SHD_html = file_get_html( $url_to_bigimg_page );
		echo "Скачал";
		
		$BIGIMG_URL = $SHD_html -> find('section main div div a')[0] -> attr['href'];
		$BIGIMG_URL = 'https://www.look.com.ua'.$BIGIMG_URL;
		
		echo "<br> Прямая ссылка на хайрез = <a href=\"$BIGIMG_URL\">$BIGIMG_URL</a>";
		
		###
		
		write_in_file( $target_file , $BIGIMG_URL );
		echo "<br>Записал в файл ссылку.";
		
		echo "<br>Ложусь спать"; sleep($sleep);	echo " => Проснулся";
		
		
		$i++;
	} #End for
	
	EXIT("Конец = Вышел  из цикла");
	
	
?>