<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php 
echo form_open_multipart('business/add_product_image'); 
echo form_input('uid', '9');
echo form_input('utype', '2');
echo form_input('pid', '11');
echo form_input('sessionid', 'e0g90g5c9nl4fbh8btub8dlc40');
?>

<input type="file" name="uploadfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>