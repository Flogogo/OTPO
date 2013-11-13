<!-- Footer en bas de page tricks -->
<div class="wrapper">
<?php
	$this->load->view('include/header'); 
	$this->load->view('include/menu'); 
	if(isset($main_content))
	{
		$this->load->view($main_content);
	}
	else
	{
		$this->load->view('home');
	}
?>
<div class="push"></div>
</div>
<?php	
	$this->load->view('include/footer'); 
?>