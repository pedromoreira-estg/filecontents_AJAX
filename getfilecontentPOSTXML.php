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


header("Content-Type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo "<filecontent>";
echo "<filename>$file</filename>";
echo "<content>";
echo $content;
echo "</content>";
echo "</filecontent>";

?>