<?php if (!defined('BASEPATH')) die();

class User_control extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->helper(array('form'));
   $this->load->model('user_model','',TRUE);
   $this->load->library('form_validation');

 }

 function index()
 {
 	// Si essai manuellement d'accéder a l'index de mon controlleur on le renvoie sur la page d'accueil
    redirect(base_url('index.php/home'), 'location');
 }

 function login()
 {
    $data['main_content']='Users/login';
    $this->load->view('page', $data);
 }

 function verify_login()
 {
   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
      $data['main_content']='Users/login';
      $this->load->view('page', $data);
   }
   else
   {
      redirect(base_url('index.php/News/news_control/all_new'), 'location');
   }

 }

 function check_database($password)
 {
   $username = $this->input->post('username');

   //query the database
   $result = $this->user_model->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id_utilisateur,
         'username' => $row->nom_utilisateur
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }

 function logout()
 {
   $this->session->unset_userdata('logged_in');
	redirect(base_url(), 'location');
 }

}

?>
