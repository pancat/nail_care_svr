
<html>
<head>
<title>Test For Model</title>
</head>
<body>
<?php foreach ($res as $item):?>
<p>	<?php echo $item[Fileupload_model::FILE_DOWNLOAD_ADDR];?></p><br />
<?php endforeach;?>
</body>
</html>