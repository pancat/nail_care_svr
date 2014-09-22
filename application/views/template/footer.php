<!-- Common footer -->

<!-- footer JS Load -->
			<?php if(isset($fjs)):?>
			<?php foreach ($fjs as $fjs_item): ?>
			<script type="text/javascript" src="<?php echo $fjs_item; ?>"></script>
			<?php endforeach;?>
			<?php endif; ?>
</body>
</html>