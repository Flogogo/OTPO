<div class="container">
	<div class="row" id="blocNews">   
		<?php foreach ($news as $item): ?>	
		  	<div class="span4" id="cadreNew">
		  		<div id="picture">
		  			<a href="<?=base_url()?>index.php/News/news_control/newById/<?=$item['id_new']?>"> <img id="imageNews" src="<?=base_url()?>uploads/<?=$item['url_img']?>"> </a>	
		  		</div>
		  		<div id="titre">
		  			<?= character_limiter($item['titre_new'], 60) ?>
		  		</div>
		  		<div id="text_news" >
		  			<?= character_limiter($item['text_new'],68); ?>
		  		</div>
		  		<div id="datePost">
		  			Publié le : <?= $item['date_new'] ?> 
		  		</div>
		  	</div>
		<?php endforeach; ?>
	</div>

	<div style="clear:both;" > </div>

	<div  id="pagination">
		 <p><?php echo $links; ?></p>
	</div>
</div>
