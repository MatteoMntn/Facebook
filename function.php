<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
// Les réglages de la base


class M152
{

  private
    $pdo = null;
  private
    $psReadMedia = null;

    private
    $psReadPost = null;

    private
    $psUpdatePost = null;

    private
    $psInsertMedia = null;

    private
    $psInsertPost = null;

  public function __construct()
  {
      try {
        $this->pdo = new PDO('mysql:host=' . 'localhost' . ';dbname=' . 'm152', 'user', 'Super', 
        array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
          PDO::ATTR_PERSISTENT => true
        ));

        // Read
        $sql = "SELECT *
                FROM MEDIA" ;
        $this->psReadMedia = $this->pdo->prepare($sql);
        $this->psReadMedia->setFetchMode(PDO::FETCH_UNIQUE);

          // Read
          $sql = "SELECT *
          FROM POST" ;
         $this->psReadPost = $this->pdo->prepare($sql);
         $this->psReadPost->setFetchMode(PDO::FETCH_UNIQUE);



       // Update
       $sql = "UPDATE POST SET 
       commentaire = :COMMENTAIRE , dateDeModification = :DATEDEMODIFICATION  ";
       $this->psUpdatePost = $this->pdo->prepare($sql);
 

        //Create
        $sql = "INSERT INTO MEDIA (nomFichierMedia, typeMedia, idPost)
                VALUES (:NOMFICHIERMEDIA, :TYPEMEDIA, :IDPOST)";
        $this->psInsertMedia = $this->pdo->prepare($sql);

        
        //Create
        $sql = "INSERT INTO POST (commentaire)
                VALUES (:COMMENTAIRE)";
        $this->psInsertPost = $this->pdo->prepare($sql);
        
      } catch (PDOException $e) {
        // print "Erreur !: " . $e->getMessage() . "<br/>";
        die("Erreur !: " . $e->getMessage() . "<br/>");
      }
    }
  
//Lit si le cadena est actif
  function readMedia(){
    try {

        if($this->psReadMedia->execute()){
            $answer = $this->psReadMedia->fetch();
        }
    
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    return $answer;

  }
  //Lit si le velo est volé
  function readPost(){
    try {

        if($this->psReadPost->execute()){
            $answer = $this->psReadPost->fetch();
        }
    
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    return $answer;

  }

  //met a jour le cadena
  function updatePost($commentaire, $dateDeModif)
  {
    $answer = false;
    try {

  
      $this->psUpdatePost->bindParam(':COMMENTAIRE', $commentaire);
      $this->psUpdatePost->bindParam(':DATEDEMODIFICATION', $dateDeModif);
 

      if ($this->psUpdatePost->execute())
        $answer = true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $answer;
  }
//Simule le vol du vélo

  function insertMedia($nomMedia, $typeMedia, $idPost)
  {
    $answer = false;
    try {
  
      $this->psInsertMedia->bindParam(':NOMFICHIERMEDIA', $nomMedia);
      $this->psInsertMedia->bindParam(':TYPEMEDIA', $typeMedia);
      $this->psInsertMedia->bindParam(':IDPOST', $idPost);

      if ($this->psInsertMedia->execute())
        $answer = true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $answer;
  }

  function insertPost($commentaire)
  {
    $answer = false;
    try {
  
      $this->psInsertPost->bindParam(':COMMENTAIRE', $commentaire);

      if ($this->psInsertPost->execute())
        $answer = true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $answer;
  }
}