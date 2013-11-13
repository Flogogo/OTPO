<div class="container" >
	<div class="hero-unit"  id="cadreSendUpdate">
		<?php echo validation_errors(); ?>
		<form action="<?php echo base_url('index.php/News/news_control/update_new') ?>" method="post" enctype="multipart/form-data">
			<input name="id_New" type="hidden" value="<?=$newById[0]['id_new']?>"/>
		 	<p><h5> <label for="author"> Autheur: </label> <input type="text" name="author" value="<?= $newById[0]['id_utilisateur'] ?>" disabled /></h5></p>
		 	<p>
		 		<h5 style="display:inline-block"> <label for="title">Titre de l'article: </label>  <input type="text" name="title" value="<?= $newById[0]['titre_new'] ?>"/></h5>
		 		<?php 
				if($newById[0]['url_youtube']!=""){?>
				<h5 style="display:inline-block"> <label for="youtube">URL youtube (format http) : </label>  <input type="text" name="youtube" value="<?= $newById[0]['url_youtube'] ?>"/></h5>
				<?php } 
				if($newById[0]['url_soundcloud']!=""){?>
				<h5 style="display:inline-block"> <label for="soundcloud">URL soundCloud : </label>  <input type="text" name="soundcloud" value="<?= $newById[0]['url_soundcloud'] ?>"/></h5>
				<?php } 
				if($newById[0]['url_diver']!=""){?>
				<h5 style="display:inline-block"> <label for="urlDiver">URL Diver : </label>  <input type="text" name="urlDiver" value="<?= $newById[0]['url_diver']?>"/></h5>
				<?php } ?>
				<h5 style="display:inline-block"> <label for="urlMp3">URL mp3 : </label>  <input type="text" name="urlMp3" value="<?= $newById[0]['url_mp3'] ?>"/></h5>
			</p>
			<p><h5> <label for="content">Texte de l'article: </label> <textarea  name="content" ><?php if($newById){echo $newById[0]['text_new'];}else{ echo "Veuillez rédiger votre article"; }?></textarea></h5></p>
			<p><input type="file" name="userfile" size="20" /></p>
			<p><input type="submit" class="btn btn-primary" value="Modifier"></p>
		</form>
	</div>
</div>