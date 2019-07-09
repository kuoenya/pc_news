<?php

	include_once("../include/phpQuery-onefile.php");
	include_once('../simple_html_dom.php');

	function get_one_news($link){

		$conn = mysqli_connect('127.0.0.1', 'root','','pc_crawler');
		$opts = array(
		  'http'=>array(
		    'header'=>"User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53\r\n"
		  )
		);
		$context = stream_context_create($opts);
		$html = file_get_html($link, false, $context);
		// $str = $html->save();
		// var_dump($str);
		$title = $html->find('title',0)->plaintext;
		echo "1/title_ "; echo $title.'<br>';
		$content = $html->find('div[class="field-item even"]',2)->plaintext; //this shows no tag just the text!! 
		echo "2/content_ ".'<br>';
		echo $content;

		$date = $html->find('span[class="created"]',0)->plaintext;
		echo "3/date_ "; echo($date).'<br>';

		$praise =$html->find('span[class="_5n6h _2pih"]',0)->plaintext;
		echo "4/praise_ ";  echo $praise;

		$img = $html->find('img',1);
		echo "5/img_ "; echo $img.'<br>';

		$author = $html->find('span[class="author"]',0)->plaintext;
		echo "6/author_ "; echo($author).'<br>';

		$sql_title = "INSERT INTO 0708_news (title,content,thedate,img,author) VALUES 
		('".$title."','".mysqli_real_escape_string($conn,$content)."','".$date."','".$img."','".$author."')";	
		echo $sql_title.'<br>';
		mysqli_set_charset($conn,"utf8");  //IMPORTANT kill 亂碼!!
		$result = mysqli_query($conn,$sql_title);

		if ($result) {
			echo "ok conn!!";
		} else {
			echo "no conn.";
		}

		echo "conn__".'<br>';
		print_r ($conn);
		mysqli_close($conn);
	}

	function get_praise($link){

		$conn = mysqli_connect('127.0.0.1', 'root','','pc_crawler');
		$opts = array(
		  'http'=>array(
		    'header'=>"User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53\r\n"
		  )
		);
		$context = stream_context_create($opts);
		$html = file_get_html($link, false, $context);
		$praise =$html->find('span[class="_5n6h _2pih"]',0)->plaintext;
		echo "4/praise_ ";  echo $praise;
		$sql_title = "INSERT INTO 0708_news (praise) VALUES 
		('".$praise."')";	
		echo $sql_title.'<br>';
		mysqli_set_charset($conn,"utf8");  //IMPORTANT kill 亂碼!!
		$result = mysqli_query($conn,$sql_title);
		var_dump( $result);
		if ($result) {echo "ok conn!!"; } 
		else { echo "no conn.".mysqli_error($conn); }
		mysqli_close($conn);

	}

	for ($i=98679; $i < 98680; $i++) {

		get_praise("https://www.facebook.com/plugins/like.php?action=like&app_id=161989317205664&channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D44%23cb%3Df21d5aa2ae10654%26domain%3Dwww.ithome.com.tw%26origin%3Dhttps%253A%252F%252Fwww.ithome.com.tw%252Ff279ae60f5d6fec%26relation%3Dparent.parent&container_width=0&href=https%3A%2F%2Fwww.ithome.com.tw%2Fnews%2F".$i."&layout=button_count&locale=zh_TW&sdk=joey&share=true&show_faces=false");
 
		get_one_news("https://www.ithome.com.tw/news/".$i);
	}


	



?>

















