


<!--  include_once "data_control.php"; ?> -->

<!doctype html>
<html lang="en">
  <head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	    <title>News!</title>
  </head>
  <body>

  	<br><br>

	 <table class="table" id="data">

	</table>
	


	<script>
		// call ajax
		var ajax = new XMLHttpRequest();
		var method = "GET";
		var url = "data_control.php";
		var asynchronous = true;
		ajax.open(method,url,asynchronous);

		//sending ajax request
		ajax.send();

		//receiving response from data_control.php

		ajax.onreadystatechange = function(){

			if (this.readyState == 4 && this.status == 200 ) {


				//JSON.parse  let 亂碼 transfer into correct!
				//convert json back to array
				var data = JSON.parse(this.responseText); 
				console.log(data);

				var html ="";
				// looping through the data
				for (var i = 0; i < data.length; i++) {

					var No = data[i].id;
					var title = data[i].title;
					var content = data[i].content;
					var thedate = data[i].thedate;
					var praise = data[i].praise;
					var img = data[i].img;
					var author = data[i].author;
					html += "<tr>";
						html += "<td>"+'No. '+No+"</td>";
						html += "<td>"+title+"</td>";
						html += "<td>"+author+"</td>";
						html += "<td>"+content+"</td>";
						html += "<td>"+thedate+"</td>";
						html += "<td>"+praise+"</td>";
						html += "<td>"+img+"</td>";

					html += "</tr>";

				}
				document.getElementById("data").innerHTML = html;


			}
		}

	</script>


	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>






<?php

/*	define('DB_HOST', '127.0.0.1');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'pc_crawler');
	// Create connection
	// $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

	$query = "SELECT * FROM news WHERE id = '113'";
	mysqli_set_charset($link,"utf8");
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_array($result);
	// print_r($row);
	$title = $row['title'];
	$content = $row['content'];
	$date = $row['thedate'];
	$img = $row['img'];
	$author = $row['author'];
	// echo 'News title is _ '.$title;
	// print_r($row);
*/

	define('DB_HOST', '127.0.0.1');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'pc_crawler');

	//資料庫連結
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("Error");
    
    $sql = "SELECT * FROM `0708_news` ORDER BY `id`"; // SQL 語法
    $result = mysqli_query($conn,$sql) or die("Error");
    mysqli_set_charset($conn,"utf8");  //亂碼 save hero

    $data_nums = mysqli_num_rows($result); //統計總比數
    $per = 10; //每頁顯示項目數量
    $pages = ceil($data_nums/$per); //取得不小於值的下一個整數
    if (!isset($_GET["page"])) { //假如$_GET["page"]未設置

        $page=1; //則在此設定起始頁數

    } else {
        
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
    $start = ($page-1)*$per; //每一頁開始的資料序號
    $result = mysqli_query($conn, $sql.' LIMIT '.$start.', '.$per) or die("Error");
?>



<table>
    <tr>
        <td style="text-align: center;">No.</td>
        <td style="text-align: center;">Title</td>
        <td style="text-align: center;">Author</td>
        <td style="text-align: center;">Content</td>
        <td style="text-align: center;">Date</td>
        <td style="text-align: center;">Praise</td>
        <td style="text-align: center;"></td>
    </tr>
    <?php
        //輸出資料內容
        while ($row = mysqli_fetch_array($result))
        {
            $id=$row['id'];
            $title=$row['title'];
            $author=$row['author'];
            $content=$row['content'];
            $thedate=$row['thedate'];
            $praise=$row['praise'];
            $img=$row['img'];
            ?>
            
            <tr>
                <td style="text-align: center;"><?php echo $id; ?></td>
                <td style="text-align: center;"><?php echo $title; ?></td>
                <td style="text-align: center;"><?php echo $author; ?></td>
                <td style="text-align: center;"><?php echo $content; ?></td>
                <td style="text-align: center;"><?php echo $thedate; ?></td>
                <td style="text-align: center;"><?php echo $praise; ?></td>
                <td style="text-align: center;"><?php echo $img; ?></td>

            </tr>

        <?php
            }
    ?>
</table>

<br />

<!-- <?php

	while( $row = mysqli_fetch_assoc($result) ) {
		
		$data[] = $row;
	}

	// return response in JSON format

	// echo json_encode($data);



?> -->


<?php
    //分頁頁碼
    echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br />"."<br >";
    echo "我要到 \t\t\t";
    echo "<a href=?page=1>首頁\t\t</a>";




    for( $i=2 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
    echo "<br />";
?>














