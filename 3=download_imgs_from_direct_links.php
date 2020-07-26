<?php
	
	ob_implicit_flush(); ### Отключаем SAPI-буфер
	ob_end_flush();
	
	set_time_limit(0);
	
	//include "LIB_simple_html_dom.php";
	
	
	// СКАЧАНЫ файлы
	// 
	
	$file_path_img_urls = "res/urls-img-big-1.txt";
	$target_img_path = "images/1/";
	$sleep = 1;
	
	//exit("См код, перед запуском надо проверить пути.");
	
	
	####################
	
	$all_urls_from_file = file_get_contents($file_path_img_urls);
	
	$arr_all_urls_from_file = explode(PHP_EOL, $all_urls_from_file );
	
	
	
	echo "Количество ссылок:". count($arr_all_urls_from_file);
	echo "<hr>";
	
	//print_r($arr_all_urls_from_file); exit;
	
	
	$i=1;
	foreach ( $arr_all_urls_from_file as $one_page_link)
	{	
		echo "<hr>Начало круга для - $i -> <a href=\"$one_page_link\">$one_page_link</a>";
		
		###
		
		try	{
		
			echo "<br>Скачиваю эту картинку => $one_page_link";
			
			$arr_buf = explode( "/look.com.ua-" , $one_page_link); // "...download.php?file=202007/1920x1200/look.com.ua-356879.jpg"
			
			$img_id = explode( "." , $arr_buf[1] )[0]; // "356879.jpg"
			$img_resolution = explode( "/" , $arr_buf[0] )[4]; // "356879.jpg"
			$img_filename = "$img_id-$img_resolution.jpg";
			$imp_full_path = $target_img_path . $img_filename;
			
			echo "<br>Разбиваю ссылку:";
			echo "<br>img id = $img_id";
			echo "<br>resolution = $img_resolution";
			echo "<br>Итоговое имя = $img_filename";
			echo "<br>Полный путь = $imp_full_path";
			
			
			if( file_exists($imp_full_path) )
			{
				echo "<br>Файл уже существует - пропускаю.";
				$i++;
				continue;
			}
			
			echo "<br>Начинаю скачку";
			file_put_contents($imp_full_path, file_get_contents($one_page_link));
			echo " => Скачано";
			echo "<br>Размер файла = ". round(filesize($imp_full_path)/1024/1024 , 2) . " Mb";
			
			
			//exit;
		
		}catch(Error $e){
							echo "<br>Невалидный URL - пропускаю ($one_page_link)"; continue;
						}
		
		###
						
		echo "<br>Ложусь спать"; sleep($sleep);	echo " => Проснулся";
		
		$i++;
	} #End for
	
	
	EXIT("Конец = Вышел  из цикла");
	
	
?>