<?php if (!defined('BASEPATH')) die();

class News_control extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'text', 'array'));
		$this->load->model('news_model', 'gestionNew');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}

	function index()
	{	
		// Sert a choper le numero dans l'url
		$UrlNumberURI = 4;

		$config = array();
        $config["base_url"] = base_url()."index.php/News/news_control/index/";
        $config["total_rows"] = $this->gestionNew->record_count();
        $config["per_page"] = 6;
        $config["uri_segment"] = $UrlNumberURI ;
 		$choice = $config["total_rows"] / $config["per_page"];
    	$config["num_links"] = round($choice);
        $this->pagination->initialize($config);
        $page = ($this->uri->segment($UrlNumberURI )) ? $this->uri->segment($UrlNumberURI ) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['UpdateJson'] = $this->gestionNew->get_all_news();
 		$data["news"] = $this->gestionNew->fetch_news($config["per_page"], $page);
	    $data['main_content'] = 'home';

        $this->load->view("page", $data);
	}

	function modif_new($idNew)
	{
		if($this->session->userdata('logged_in'))
		{
			$data['newById'] = $this->gestionNew->get_new_by_id($idNew);
			$data['main_content']='News/modif_new';
			$this->load->view('page', $data);
	    }
	    else
	    {
			//If no session, redirect to login page
			redirect(base_url(), 'refresh');
		}	
	}

	function update_new()
	{		
			// On configure l'objet config pour l'upload d'image lié a la new.
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2000';
			$config['max_width']  = '1920';
			$config['max_height']  = '1600';

			// On met en place le systeme de verification qu'l y aura sur l'upload
			$this->form_validation->set_rules('author', 'Auteur new', 'trim|xss_clean');
			$this->form_validation->set_rules('title', 'Titre de la new', 'trim|required|xss_clean');
   			$this->form_validation->set_rules('content', 'Contenue de la new', 'trim|required|xss_clean');
   			$this->form_validation->set_rules('youtube', 'Lien youtube', 'trim|xss_clean');
   			$this->form_validation->set_rules('soundcloud', 'Lien soundcloud', 'trim|xss_clean');
   			$this->form_validation->set_rules('urlDiver', 'Lien soundcloud', 'trim|xss_clean');
   			$this->form_validation->set_rules('urlMp3', 'Lien mp3', 'trim|xss_clean');

   			//Récupration des variables de POST (plus simple si besoin de passer en argument de fonctions.)
			$title = $this->input->post("title");
		   	$content = $this->input->post("content");
		   	$idNew = $this->input->post("id_New");
		   	$youtube = $this->input->post("youtube");
		   	$soundcloud = $this->input->post("soundcloud");
		   	$urlDiver = $this->input->post("urlDiver");
		   	$imageNew = $this->input->post("userfile");
		   	$urlMp3 = $this->input->post("urlMp3");

			// Si les champs n'ont pas été remplie on ne passe pas !
		   	if ($this->form_validation->run())
		   	{
				$this->load->library('upload', $config);

				if ($_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE)
				{
				    // Ajout dans la BDD des informations de la news
					$this->gestionNew->update_new_withoutPicture($title, $content, $idNew, $youtube, $soundcloud, $urlDiver, $urlMp3);
					$data = array('upload_data' => $this->upload->data());
					$this->load->helper('text');
					$data['news'] = $this->gestionNew->get_all_news();
					$data['main_content']='News/all_new';
					$this->load->view('page', $data);
				} 
				else 
				{
				    if ($this->upload->do_upload())
					{
						// Puis envoie de l'image dans le dossier Upload
						$data['upload_data'] = $this->upload->data();
						// Modification de urlImg
						$urlImg = $data['upload_data']['file_name'];
						// Ajout dans la BDD des informations de la news
				   		$this->gestionNew->update_new($title, $content, $urlImg, $idNew, $youtube, $soundcloud, $urlDiver, $urlMp3);

				   		$this->all_new();
					}
					else
					{
						$data['newById'] = $this->gestionNew->get_new_by_id($idNew);
						$data['error'] = $this->upload->display_errors();  // array('error' => $this->upload->display_errors()); AU CAS OU 
				    	$data['main_content']='News/modif_new';
						$this->load->view('page', $data);
					}
				}
				
			}
			else
			{
				$data['main_content']='News/modif_new';
				$this->load->view('page', $data);
			}
	}

	function delete_new($id_new)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->gestionNew->delete_news($id_new);

			// On relance la page pour voir que la suppression a été faite.
       		redirect(base_url('index.php/News/news_control/all_new'), 'location');
		}
		else
		{
			//If no session, redirect to login page
			redirect(base_url(), 'refresh');
		}
	}

	// Fonction permettant l'affichage de la vue d'ajout d'article
	function send_new()
	{

		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['autheur'] = $this->gestionNew->get_all_autheur();
			$data['username'] = $session_data['username'];
			$data['error'] = "";
			$data['main_content']='News/send_new';

			$this->load->view('page', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect(base_url(), 'refresh');
		}
    }

    // Fonction permettant de récupérer de la base de donné toute les news (On s'en sert pour les afficher dans le back end et modifier ou supprimer une news)
    function all_new()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('text');
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['news'] = $this->gestionNew->get_all_news();
			$data['main_content']='News/all_new';
			$this->load->view('page', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect(base_url(), 'refresh');
		}
    }

    // Fonction permettant l'envoie d'un article dans la base de donnée et en meme temp du fichier image dans le dossier Upload
	function do_upload()
	{
		if($this->session->userdata('logged_in'))
		{
			// On configure l'objet config pour l'upload d'image lié a la new.
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2000';
			$config['max_width']  = '1920';
			$config['max_height']  = '1600';

			// On met en place le systeme de verification qu'l y aura sur l'upload
			$this->form_validation->set_rules('author', 'Auteur new', 'trim|xss_clean');
			$this->form_validation->set_rules('title', 'Titre de la new', 'trim|required|xss_clean');
   			$this->form_validation->set_rules('content', 'Contenue de la new', 'trim|required|xss_clean');
   			$this->form_validation->set_rules('youtube', 'Lien youtube', 'trim|xss_clean');
   			$this->form_validation->set_rules('soundcloud', 'Lien soundcloud', 'trim|xss_clean');
   			$this->form_validation->set_rules('userfile', 'Lien fichier image', 'trim|xss_clean');
   			$this->form_validation->set_rules('urlDiver', 'Lien soundcloud', 'trim|xss_clean');
   			$this->form_validation->set_rules('urlMp3', 'Lien mp3', 'trim|xss_clean');

   			// Récupération des variables (plus simple si besoin de passer en argument de fonctions.)
			$title = $this->input->post("title");
		   	$author = $this->input->post("author");
		   	$content = $this->input->post("content");
		   	$youtube = $this->input->post("youtube");
		   	$soundcloud = $this->input->post("soundcloud");
		   	$urlDiver = $this->input->post("urlDiver");
		   	$urlMp3 = $this->input->post("urlMp3");


		   	// Si les champs n'ont pas été remplie on ne passe pas !
		   	if ($this->form_validation->run())
		   	{
				$this->load->library('upload', $config);

				// Si les champs on été remplie mais que le fichier n'est pas correct !
				if (!$this->upload->do_upload())
				{
					$data['error'] =  $this->upload->display_errors();
					$data['autheur'] = $this->gestionNew->get_all_autheur();
					$data['main_content']='News/send_new';

					$this->load->view('page', $data);
				}
				// Finalement si tout est ok 
				if($this->upload->do_upload())
				{	
			   		// Puis envoie de l'image dans le dossier Upload
					$data['upload_data'] = $this->upload->data();
					// Modification de urlImg
					$urlImg = $data['upload_data']['file_name'];
					// Ajout dans la BDD des informations de la news
			   		$this->gestionNew->insert_news($title, $author, $content, $urlImg, $youtube, $soundcloud, $urlDiver, $urlMp3);
					$data['main_content']='News/upload_success';

					$this->load->view('page', $data);
				}
			}
			// On envoie donc a la page l'erreur indiquant que les champs n'ont pas tous été remplie
			else
			{
				$data['main_content']='News/send_new';
				$data['autheur'] = $this->gestionNew->get_all_autheur();
				$this->load->view('page', $data);
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect(base_url(), 'refresh');
		}
	}

	// Affiche le détail d'une new
	function newById($id_new)
    {
    	$data['news'] = $this->gestionNew->get_new_by_id($id_new);	
    	$data['main_content'] = 'News/detail_new';

		$this->load->view('page', $data);
    }
}


?>

		

   		

      