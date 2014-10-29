<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php 
echo form_open_multipart('user/add_circle_image'); 
echo form_input('uid', '4');
echo form_input('cid', '43');
echo form_input('sessionid', 'e0g90g5c9nl4fbh8btub8dlc40');
?>

<input type="file" name="uploadfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>