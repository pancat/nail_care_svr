<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php 
echo form_open_multipart('user/upload_avatar'); 
echo form_input('id', '4');
echo form_input('sessionid', 'e0g90g5c9nl4fbh8btub8dlc40');
?>

<input type="file" name="uploadavatar" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>