<?php
	
	ob_implicit_flush(); ### Отключаем SAPI-буфер
	ob_end_flush();
	
	set_time_limit(0);
	
	include "LIB_simple_html_dom.php";
	
	
	// СКАЧАНЫ прямые ссылки
	// 1 2 3
	// 1 2 3 4
	
	$file_path_img_urls   = "res/urls-img-5.txt";
	$target_file_path = "res/urls-img-big-5.txt";
	$sleep = 1;
	
	//exit("См код, перед запуском надо проверить пути.");
	
	
	####################
	
	
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
	

	

	
	$all_urls_from_file = file_get_contents($file_path_img_urls);
	
	$arr_all_urls_from_file = explode(PHP_EOL, $all_urls_from_file );
	
	
	
	echo "Количество ссылок:". count($arr_all_urls_from_file);
	$time = count($arr_all_urls_from_file)*$sleep;
	echo "<br>Расчетное время = $time секунд = ". $time/60 . " минут";
	echo "<hr>";
	
	//print_r($arr_all_urls_from_file); exit;
	
	
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
		
		if( $BIGIMG_URL != 'https://www.look.com.ua' )
		{
			write_in_file( $target_file_path , $BIGIMG_URL );
			echo "<br>Записал в файл ссылку.";
			
		}
		else { echo "<br>Итоговая ссылка была пуста."; }
		
		echo "<br>Ложусь спать"; sleep($sleep);	echo " => Проснулся";
		
		
		$i++;
	} #End for
	
	
	EXIT("Конец = Вышел  из цикла");
	
	
?>