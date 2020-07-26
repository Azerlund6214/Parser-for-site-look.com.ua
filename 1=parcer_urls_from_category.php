<?php
	
	ob_implicit_flush(); ### Отключаем SAPI-буфер
	ob_end_flush();
	
	set_time_limit(0);
	
	include "LIB_simple_html_dom.php";
	
	####################
	
	$file_for_urls_path = "urls.txt";
	$sleep = 1;
	
	# Шаблон для генерации вставлять вручную в коде (48 строка)
	
	exit("См код, перед запуском надо проверить пути.");
	
	###
	
	
	/**
	 * Записывает $text в файл $filename
	 * @param $filename string
	 * @param $text string
	 */
	function write_in_file( $filename, $text )
	{
		if ( ! $handle = fopen($filename, 'a+'))
			exit ("Не могу открыть файл ($filename)");
		
		if ( ! fwrite($handle, $text . PHP_EOL ) )
			exit ("Не могу произвести запись в файл ($filename)");
		
		fclose($handle);
	}
	

	
	$page_begin = 1;
	$page_end = 321;
	
	$arr_pages_links = array();
	for ( $i = $page_begin ; $i<=$page_end ; $i++ ) # Генерируем ссылки
	{
		$arr_pages_links []= "https://www.look.com.ua/space/page/$i/";
	}
	
	
	
	echo "Сгенерировано ". count($arr_all_urls_from_file) . " ссылок";

	echo "<hr>";
		
	
	$i=1;
	foreach ( $arr_all_urls_from_file as $one_page_link)
	{	
		echo "<hr>Начало круга для - $i -> <a href=\"$one_page_link\">$one_page_link</a>";
		
		###
		
		$SHD_html = file_get_html( $one_page_link );
		
		$shd_arr_page_urls = $SHD_html -> find('.gallery_image');
		
		###
		
		$arr_page_urls = array();
		foreach ( $shd_arr_page_urls as $url )
		{
			$arr_page_urls []= $url-> attr['href'];
		}
		
		echo "<pre>";
		print_r(  $arr_page_urls );
		echo "</pre>";
		
		
		foreach ( $arr_page_urls as $url )
		{
			write_in_file( $file_for_urls_path , $url );
			echo "<br>Записал в файл ссылку = $url";
		}
		
		###
		
		echo "<br>Ложусь спать"; sleep($sleep);	echo " => Проснулся";
		
		$i++;
	} #End for
	
	
	EXIT("<br>Конец = Вышел  из цикла");
	
	
?>