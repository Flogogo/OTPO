<?php
require_once('./assets/api/SoundCloud/Services/Soundcloud.php');
?>
<body>
<div id="menuHaut" >
	<div class="container" >
			<?php 
			if($this->session->userdata('logged_in'))
			{?>
						<div id="logo">OTPO</div>
				        <div id="menuheader" ><a href="<?= base_url() ?>" id="linkMenu"> Accueil</a></div>
		              	<div id="menuheader" ><a href="<?= base_url('index.php/News/news_control/send_new')?>" id="linkMenu"> AddNews</a></div>
			            <div id="menuheader" ><a href="<?= base_url('index.php/News/news_control/all_new') ?>"  id="linkMenu"> ListNews</a></div>
			            <div id="menuheader" ><a href="<?= base_url('index.php/Users/user_control/logout') ?>" id="linkMenu"> Logout</a></div>
	        <?php
			}
			else
			{?>
						<div id="logo">OTPO</div>
		                <div id="menuheader" ><a href="<?= base_url() ?>"  id="linkMenu"> Accueil</a></div>
		                <div id="menuheader" ><a href="<?= base_url() ?>index.php/Users/user_control/verify_login"  id="linkMenu"> Admin</a></div>

	        <?php
			}
			?>     
	</div>
</div>
