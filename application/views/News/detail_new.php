<div class="container">
	<div  style="text-align: center;">

		<h2> <?=$news[0]['titre_new']?> </h2>
		
		<?php 
		if ($news[0]['url_youtube']!=NULL) 
		{
		?>
			<iframe width="600" height="480" src="<?= str_replace("watch?v=", "embed/", substr($news[0]['url_youtube'], 5))?>" frameborder="0" allowfullscreen></iframe>
		<?php
		}
		if ($news[0]['url_diver']!=NULL) 
		{ ?>
			<iframe width="600" height="480" src="<?= $news[0]['url_diver']?>" frameborder="0" allowfullscreen></iframe>
		<?php 
		}
		if ($news[0]['url_soundcloud']!=NULL) 
		{
		// create a client object with your app credentials
		$client = new Services_Soundcloud('YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET');
		$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));
		// get a tracks oembed data
		$track_url = $news[0]['url_soundcloud'];
		$embed_info = json_decode($client->get('oembed', array('url' => $track_url)));
		// render the html for the player widget
		print $embed_info->html;
		}
		?>

		<?php echo "<br/>"; ?>
		<?=$news[0]['text_new']?>
		<?php echo "<br/>"; ?>

		<?php echo "<br/>"; ?>
		<p style="text-align: center;"> Publié par : 
			<b>
				<?=$news[1][0]['nom_public']?> 
			<b>
		</p>
		

	</div>
</div>