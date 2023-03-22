<?php
require_once("../database.php");

$base = new M152();

$base->beginTransaction();
try{
$id = filter_input(INPUT_GET, 'idPost', FILTER_SANITIZE_NUMBER_INT);
foreach ($base->readThisOne($id) as $key => $value) {
  if(!unlink("../ressources/". $value['nomFichierMedia'])) {
    throw new Exception("Failed to delete media file.");
  }

}
$base->deleteThisOne($id);
$base->commit();
header('Location: ../index.php');
} 
catch(Exception $e){
    $base->rollback();
    echo $e->getMessage();
}
?>
