<div class="container">
	<div class="hero-unit">
		<h4>Votre article à été mis en ligne !</h4>

		<ul>
		<?php foreach ($upload_data as $item => $value):?>
		<li><?php echo $item;?>: <?php echo $value;?></li>
		<?php endforeach; ?>
		</ul>

		<p><?php echo anchor('upload', 'Ecrire un nouvel article'); ?></p>
	</div>
</div>