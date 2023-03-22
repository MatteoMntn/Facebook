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

  private
    $psReadThisOne = null;

  private
    $psReadAll = null;

  public
    $lastInsertPostId = null;

  private
    $psDelPost = null;

  private
    $psDeleteMedia = null;

  public function __construct()
  {
    try {

      $this->pdo = new PDO(
        'mysql:host=' . 'localhost' . ';dbname=' . 'm152',
        'user',
        'Super',
        array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
          PDO::ATTR_PERSISTENT => true
        )
      );
      $this->pdo->beginTransaction();
      //Delete post
      $sql = "DELETE FROM POST WHERE POST . idPost = :ID";
      $this->psDelPost = $this->pdo->prepare($sql);

      //Delete media
      $sql = "DELETE FROM MEDIA WHERE MEDIA . idMedia = :ID";
      $this->psDeleteMedia = $this->pdo->prepare($sql);

      // Read all
      $sql = "SELECT  commentaire, nomFichierMedia, typeMedia
         FROM POST JOIN MEDIA ON POST.idPost = MEDIA.idPost
         WHERE MEDIA.idPost = :ID";
      $this->psReadThisOne = $this->pdo->prepare($sql);
      $this->psReadThisOne->setFetchMode(PDO::FETCH_ASSOC);

      // Read all
      $sql = "SELECT POST.idPost
         FROM POST INNER JOIN MEDIA ON POST.idPost = MEDIA.idPost ORDER BY MEDIA.idPost ";
      $this->psReadAll = $this->pdo->prepare($sql);
      $this->psReadAll->setFetchMode(PDO::FETCH_ASSOC);

      // Read
      $sql = "SELECT *
                FROM MEDIA";
      $this->psReadMedia = $this->pdo->prepare($sql);
      $this->psReadMedia->setFetchMode(PDO::FETCH_UNIQUE);

      // Read
      $sql = "SELECT idPost
          FROM POST";
      $this->psReadPost = $this->pdo->prepare($sql);
      $this->psReadPost->setFetchMode(PDO::FETCH_ASSOC);

      // Update
      $sql = "UPDATE POST SET 
       commentaire = :COMMENTAIRE , dateDeModification = :DATEDEMODIFICATION ";
      $this->psUpdatePost = $this->pdo->prepare($sql);


      //Create
      $sql = "INSERT INTO MEDIA (nomFichierMedia, typeMedia, idPost)
                VALUES (:NOMFICHIERMEDIA, :TYPEMEDIA, :IDPOST)";
      $this->psInsertMedia = $this->pdo->prepare($sql);


      //Create
      $sql = "INSERT INTO POST (commentaire)
                VALUES (:COMMENTAIRE)";
      $this->psInsertPost = $this->pdo->prepare($sql);
      $this->pdo->commit();
    } catch (PDOException $e) {
      // print "Erreur !: " . $e->getMessage() . "<br/>";
      $this->pdo->rollBack();
      die("Erreur !: " . $e->getMessage() . "<br/>");
    }
  }

  function deleteThisOne($id)
  {
    try {

      $this->psDelPost->bindParam(':ID', $id);


      $this->psDelPost->execute();
      return true;
    } catch (PDOException $e) {

      echo $e->getMessage();
      return false;
    };
  }
  function deleteThisMedia($id)
  {
    try {

      $this->psDeleteMedia->bindParam(':ID', $id);

      $this->psDeleteMedia->execute();
      return true;
    } catch (PDOException $e) {

      echo $e->getMessage();
      return false;
    };
  }

  function readAll()
  {
    try {

      if ($this->psReadAll->execute()) {
        $answer = $this->psReadAll->fetchAll();
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $answer;
  }

  function readThisOne($id)
  {
    try {

      $this->psReadThisOne->bindParam(':ID', $id);

      if ($this->psReadThisOne->execute()) {
        $answer = $this->psReadThisOne->fetchAll();
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $answer;
  }

  function readMedia()
  {
    try {

      if ($this->psReadMedia->execute()) {
        $answer = $this->psReadMedia->fetch();
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $answer;
  }
  //Lit si le velo est volé
  function readPost()
  {
    try {

      if ($this->psReadPost->execute()) {
        $answer = $this->psReadPost->fetchAll();
      }
    } catch (PDOException $e) {
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

  function insertMedia($nomMedia, $typeMedia, $lastPostId)
  {
    $answer = false;
    try {


      $this->psInsertMedia->bindParam(':NOMFICHIERMEDIA', $nomMedia);
      $this->psInsertMedia->bindParam(':TYPEMEDIA', $typeMedia);
      $this->psInsertMedia->bindParam(':IDPOST',  $lastPostId);

      if ($this->psInsertMedia->execute()) {
        $answer = true;
      }
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

      if ($this->psInsertPost->execute()) {
        $answer = $this->pdo->lastInsertId();
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $answer;
  }

  function beginTransaction()
  {
    $this->pdo->beginTransaction();
  }

  function commit()
  {
    $this->pdo->commit();
  }
  function rollback()
  {
    $this->pdo->rollBack();
  }
}
