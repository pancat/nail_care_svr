<html>
<head>
<title>user Form</title>
</head>
<body>

<?php echo $error;?>

<?php 
echo form_open('user/update_password'); 
echo form_input('id', '4');
echo form_input('password', 'nickname_hehe');
// echo form_input('name', 'NAME');
echo form_input('sessionid', 'e0g90g5c9nl4fbh8btub8dlc40');
?>

<br /><br />

<input type="submit" value="submit" />

</form>

</body>
</html>