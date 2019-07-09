
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































