<?php

class News_model extends CI_Model {

    var $id_new  = '';
    var $id_cat_new = '';
    var $titre_new   = '';
    var $text_new = '';
    var $date_new    = '';
    var $id_utilisateur  = '';
    var $url_img = '';
    var $url_youtube = '';
    var $url_soundcloud = '';
    var $url_diver = '';
    var $url_mp3 = '';


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // On charge les librairie dans le constructeur
        $this->load->database();
        $this->load->helper('date');
        $this->load->helper("file");
    }
    
    function delete_news($id_new_l)
    {   
        // Delete le fichier avant d'effacer de la base de données la news
        $this ->db-> select('url_img');
        $this ->db-> from("news");
        $this ->db-> where('id_new', $id_new_l);
        $query = $this->db->get();
        $tab = $query->result_array();
        unlink("uploads/".$tab[0]["url_img"]);
        

        $this->db->delete("news", array('id_new' => $id_new_l));        
    }

    function get_all_news()
    {
        $this->db->order_by("id_new", "desc");
        $query = $this->db->get("news");

        $nom_file = "Liste.json";
        $texte =json_encode($query->result());
        $f = fopen($nom_file, "w");
        fputs($f, $texte);
        fclose($f);

        return $query->result_array();
    }

    function update_new($titre, $text, $urlImg, $idNews, $youtube, $soundcloud, $url_diver, $url_Mp3)
    {
        $data = array(
               'titre_new' => $titre,
               'text_new' => $text,
               'url_img' => $urlImg,
               'url_youtube' => $youtube,
               'url_soundcloud' => $soundcloud,
               'url_diver' => $url_diver,
               'url_mp3' => $url_Mp3
            );

        $this->db->where('id_new', $idNews);
        $this->db->update("news", $data); 
    }

    function update_new_withoutPicture($titre, $text, $idNews, $youtube, $soundcloud, $url_diver, $url_Mp3)
    {

        $data = array(
               'titre_new' => $titre,
               'text_new' => $text,
               'url_youtube' => $youtube,
               'url_soundcloud' => $soundcloud,
               'url_diver' => $url_diver,
               'url_mp3' => $url_Mp3
            );

        $this->db->where('id_new', $idNews);
        $this->db->update("news", $data); 
    }

    function get_new_by_id($idNew)
    {
        $this ->db-> select('*');
        $this ->db-> from("news");
        $this ->db-> where('id_new', $idNew);

        $query = $this->db->get();

       if($query -> num_rows() == 1)
       {
            $tabResult = $query->result_array();
            array_push($tabResult, $this->get_name_autheur($tabResult[0]['id_utilisateur']));

            return $tabResult;
       }
       else
       {
            return false;
       }
    }

    function get_last_six_news()
    {
        //On rajoute un order by pour prendre les news dans l'ordre de la plus récente a la place ancienne
        $this->db->order_by("id_new", "desc"); 
        $query = $this->db->get("news",6);

        return $query->result_array();
    }

    function insert_news($title_l, $author_l, $content_l, $urlImg_l, $youtube_l, $soundcloud_l, $url_diver_l, $url_Mp3)
    {
        // Regarder pourquoi il manque 2heures pour correspondre a l'heure réel.
        $format = 'DATE_W3C';
        $time = time();

        $this->titre_new = $title_l; 
        $this->text_new = $content_l;
        $this->id_utilisateur = $author_l;
        $this->id_cat_new = 1;
        $this->date_new = standard_date($format, $time);
        $this->url_img = $urlImg_l;
        $this->url_youtube = $youtube_l;
        $this->url_soundcloud = $soundcloud_l;
        $this->url_diver = $url_diver_l;
        $this->url_mp3 = $url_Mp3;


        $this->db->insert("news", $this);
    }

    function get_name_autheur($idUtilisateur)
    {
        $this ->db-> select('nom_public');
        $this ->db-> from("utilisateur");
        $this ->db-> where('id_utilisateur', $idUtilisateur);

        $query = $this->db->get();
        $tab = $query->result_array();

        return $tab;
    }

        function get_all_autheur()
    {
        $this ->db-> select('*');
        $this ->db-> from("utilisateur");
        $query = $this->db->get();
        $tab = $query->result_array();
        
        return $tab;
    }

    public function fetch_news($limit, $start) 
    {
        $this->db->order_by("id_new", "desc"); 
        $this->db->limit($limit, $start);
        $query = $this->db->get("news");
        $tab = $query->result_array();

        return $tab;
    }

    public function record_count() {
        return $this->db->count_all("news");
    }
}

?>