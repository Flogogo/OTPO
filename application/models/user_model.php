<?php
class User_model extends CI_Model
{
  var $id_utilisateur = '';
  var $nom_utilisateur = '';
  var $pass_utilisateur = '';
  var $nom_public = '';

 function login($username, $password)
 {
   $this -> db -> select('id_utilisateur, nom_utilisateur, pass_utilisateur');
   $this -> db -> from('utilisateur');
   $this -> db -> where('nom_utilisateur', $username);
   $this -> db -> where('pass_utilisateur', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

}
?>
