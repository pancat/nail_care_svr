<!--  
 Common html header
-->


<!Doctype html>
<html xmlns=http://www.w3.org/1999/xhtml>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
			<!-- Title Load -->
			
			<?php if(isset($title)):?>
			<title> <?php echo $title; ?> </title>
			<?php else :?>
			<title>Unkown Page</title>
			<?php endif;?>
			
			<!-- CSS Style Load -->
			<?php if(isset($css)):?>
			<?php foreach ($css as $css_item): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $css_item; ?>" />
			<?php endforeach;?>
			<?php endif;?>
			
			<!-- JS Load -->
			<?php if(isset($js)):?>
			<?php foreach ($js as $js_item): ?>
			<script type="text/javascript" src="<?php echo $js_item; ?>"></script>
			<?php endforeach;?>
			<?php endif;?>
			
	</head>
	<body>