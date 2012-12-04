<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");				// Data no passado
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  // Sempre modificado
header("Cache-Control: no-store, no-cache, must-revalidate");   // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);      // HTTP/1.1
header("Pragma: no-cache");										// HTTP/1.0
?>

<html>
	<head>
		<style>
			* {
				font-family: Calibri,Verdana, Geneva, Arial, Helvetica, sans-serif;
			}
			.fileitem {
				border-style: solid;
				border-width: 1px;
				border-color: black;
				width: 500px;
				margin-top: 2px;
			}
			.filename {
				background-color: #819cc4;
				color:#444;
			}
			.filecontent {
				font-size:smaller;
				background-color: #DDD;
				color: navy;
				margin:2px;
				display:none;
			}
			
		</style>
		<script>
			function init() {
				//debugger;
				// obtem colecao dos elementos da class 'filename'
				// get all elements from class 'filename'
				filecol = document.getElementsByClassName('filename');
				// e regista a funcao getdetail no evento click
				// register 'getdetail' on the click event
				for(var f=0; f < filecol.length; f++) {
					filecol[f].onclick = getdetail;
				}
			}

			function getdetail(e) {
				// qual o elemento sobr o qual ocorreu o click
				// get the element that was the target of the event
				var thediv 			= e.target;
				// obtem a partir do conteudo o nome do ficheiro
				// obtains from the content the file name
				var thefilename 	= thediv.innerHTML;
				// uma referencia para o no pai (div class=fileitem)
				// a reference to the parent node (div class=fileitem)
				var thedivcontainer = thediv.parentNode;
				// uma referencia para o no de conteudo (div class=filecontent)
				// a reference to the content div node (div class=filecontent)
				var thedivcontent   = thedivcontainer.getElementsByClassName('filecontent')[0];
				
				// se visivel -> esconde senao carrega conteudo etorna visivel
				// if visible -> hides else loads content and makes it visible
				if (thedivcontent.style.display == "block"   ) {
					thedivcontent.style.display = "none";
				} else {
					thedivcontent.style.display = "block";
					thedivcontent.innerHTML = "Loading ...";
					fillcontent(thefilename,thedivcontent);
				}


			}

			function fillcontent(file, thedivcontent) {
				debugger;
				// instancia um objecto 'ajax'
				// instantiates an 'ajax' object
				var objAJAX = ajax();
				// define o pedido : método, url, assincrono
				// sets the request: method, url, asynchronous
				objAJAX.open('POST','getfilecontentPOSTXML.php',true);
				
				//---
				objAJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				
				//---
				var data = "f="+file;
				//alert(data);
				
				// refgista a funcao que ira processar o pedido
				// registers and defines the function that will process the request
				objAJAX.onreadystatechange = function () {
					debugger;
					// a var reservada 'this' corresponde ao objecto onde o evento ocorreu
					// the reserved var 'this' is the object where the event was triggered
					if (this.readyState == 4) {
						thedivcontent.innerHTML = this.responseText;
					}
				}
				// faz o pedido com dados (POST)
				// make the request without data (GET requests only send data in the URL)
				//---
				objAJAX.send(data);
				
			}

			function ajax() {
				var xmlHttp;
				try {
				// Firefox, Opera 8.0+, Safari
				xmlHttp=new XMLHttpRequest();
				}
				catch (e) {
				// Internet Explorer
					try {
						xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					}
					catch (e) {
						try {
							xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e) {
							alert("Your browser does not support AJAX!");
							return false;
						}
					}
				}
				return xmlHttp;
			}
		</script>

	</head>
	<body onload="init();">
		<?php

		$d = dir("./files");

		echo "<div class='filecontainer'>";
		while ($entry = $d -> read()) {
			echo "<div class='fileitem'>";
			echo "<div class='filename'>$entry</div>";
			echo "<div class='filecontent'></div>";
			echo "</div>";
		}
		echo "</div>";
		$d -> close();
	?>
	</body>
</html>

