<!--  
 Common html header
-->


<!Doctype html>
<html xmlns=http://www.w3.org/1999/xhtml>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<base href="<?php  echo base_url();?>"/>
			<!-- Title Load -->
			
			<?php if(isset($title)):?>
			<title> <?php echo $title; ?> </title>
			<?php else :?>
			<title>Unkown Page</title>
			<?php endif;?>
			
			<!-- CSS Style Load -->
			
			
			<!-- JS Load -->
			
			<script src="assets/js/common/jquery.js" type="text/javascript"></script>
	</head>
	<body>