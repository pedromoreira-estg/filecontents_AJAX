<?php
$dirpref  ="./files/";
$file = "";
$content = "file not found";

if (isset($_GET['f'])) {
	$file = trim($_GET['f']);
}

if (!empty($file)) {
	$content = file_get_contents($dirpref.$file);
}

echo $content;
?>