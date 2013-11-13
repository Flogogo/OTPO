<div class="container">
	<div class="hero-unit" id="cadreSendUpdate">
		<?php echo validation_errors(); ?>	
		<form action="<?php echo base_url('index.php/News/news_control/do_upload') ?>" method="post" enctype="multipart/form-data">
		 	<select id="type" name="author" style="width: 200px;">
		 		<?php foreach ($autheur as $item): ?>	
					<option value="<?=$item['id_utilisateur']?>"> <?=$item['nom_utilisateur']?> </option>
		 		<?php endforeach; ?>
			</select>
		 	<p>
		 		<h5 style="display:inline-block"> <label for="title">Titre de l'article: </label>  <input type="text" name="title" /></h5>
		 	</p>
		 	Remplir une seule case : 
		 	<p>
		 		<h5 style="display:inline-block"> <label for="youtube">URL youtube (format http) : </label>  <input type="text" name="youtube" /></h5>
				<h5 style="display:inline-block"> <label for="soundcloud">URL soundCloud : </label>  <input type="text" name="soundcloud" /></h5>
				<h5 style="display:inline-block"> <label for="urlDiver">URL Diver : </label>  <input type="text" name="urlDiver" /></h5>
			</p>
			<p>
				<h5 style="display:inline-block"> <label for="urlMp3">URL mp3 : </label>  <input type="text" name="urlMp3" /></h5>
				<div style="vertical-align:top;display:inline-block;" > <h5> <label for="content">Texte de l'article: </label> <textarea rows="6" name="content"> Veuillez rédiger votre article</textarea></h5> </div>
		 	</p>

			<p><input type="file" name="userfile" size="20" /></p>
			<p><input type="submit" class="btn btn-primary" value="upload"></p>	
		</form>
	</div>
</div>