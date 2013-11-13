<?php if (!defined('BASEPATH')) die();
class Home extends Main_Controller 
{

   public function index()
	{
		redirect(base_url('index.php/News/news_control/index/'), 'location');
	}
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
