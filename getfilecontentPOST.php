<?php
$dirpref  ="./files/";
$file = "";
$content = "file not found";

if (isset($_POST['f'])) {
	$file = trim($_POST['f']);
}

if (!empty($file)) {
	$content = file_get_contents($dirpref.$file);
}

echo $content;

?>