<?php
require_once("database.php");
//(\.jpg|\.jpeg|\.png|\.gif|\.jfif|\.mp4|\.mp3|\.oga|\.midi|\.weba|\.wav|\.mid)$/i;


function showPost()
{
	$base = new M152();

	$tableauExtensionImage = [
		'jpg',
		'jpeg',
		'png',
		'gif',
		'jfif'
	];

	$tableauExtensionAudio = [
		'mp3',
		'oga',
		'midi',
		'weba',
		'wav',
		'mid'
	];
	$tableauExtensionVideo = [
		'mp4'
	];

	foreach ($base->readPost() as $keys => $idPost) {
		//debut div 1
		echo "<div class=\"panel panel-default\">";
		//btn delete
		echo "<a href=\"delete/deletePost.php?idPost='" . urlencode($idPost['idPost']) . "\" class=\"btn btn-primary\">Delete</a>";
		//debut div 2
		echo "<div class=\"panel-thumbnail\">";

		foreach ($base->readThisOne($idPost['idPost']) as $key => $value) {

			if (in_array($value['typeMedia'], $tableauExtensionImage)) {
				//Affiche une image si c'est une des bonne extension
				echo "<img src=\"ressources/" . $value['nomFichierMedia']  . "\" style=\"width: 400px;\" class=\"img-responsive\" style>";

			} else if (in_array($value['typeMedia'], $tableauExtensionAudio)) {
				//affiche un audio si l'extension correspond une dans le tableau
				echo "<audio controls src=\"ressources/" . $value['nomFichierMedia'] . "\"></audio>";
				
			} else if (in_array($value['typeMedia'], $tableauExtensionVideo)) {
				//affcihe une video si l'extension est un mp4
				echo "<video autoplay loop muted src=\"ressources/" . $value['nomFichierMedia'] . "\" width=\"400px\"></video>";
			}
		}
		//fin div 2
		echo "</div>";
		//debut div 3
		echo "<div class=\"panel-body\">";
		//affichage du commentaire du post
		echo "<p class=\"lead\">" . $value['commentaire'] . "</p>";
		//fin div 3 et fin div 1
		echo "</div></div>";
	}
}

function uploadFile()
{
	$base = new M152();
	$listMime = [
		'image/jpg',
		'image/jpeg',
		'image/png',
		'image/gif',
		'image/jfif',
		'video/mp4',
		'audio/x-wav',
		'audio/webm',
		'audio/ogg',
		'audio/midi',
		'audio/mpeg'
	];
	$base->beginTransaction();
	try {

		if (filter_input(INPUT_POST, 'btnPost') && $_FILES["userfile"]["name"][0] != '') {

			$texte = filter_input(INPUT_POST, 'texte');
			var_dump($_FILES);

			$tmp = array_count_values($_FILES['userfile']['error']);

			if (isset($tmp[1])) {
				$cnt = $tmp[1];
			}


			if ($cnt != count($_FILES['userfile']['error'])) {
				$lastPostId = $base->insertPost($texte);
			}
			if($lastPostId !== false ){

		
			foreach ($_FILES["userfile"]["error"] as $key => $error) {


				$fileTmpName = $_FILES['userfile']['tmp_name'][$key];
				$uploads_dir = 'ressources/';


				$name = basename($_FILES["userfile"]["name"][$key]);
				if (in_array(mime_content_type($fileTmpName), $listMime) && is_uploaded_file($fileTmpName)) {
					$nomUnique = uniqid('', true) . $name;
					$info = new SplFileInfo($name);
					$base->insertMedia($nomUnique, $info->getExtension(), $lastPostId);
					move_uploaded_file($fileTmpName, $uploads_dir . $nomUnique);
				}
			
			}
			$base->commit();
			header('Location: index.php');
		}
		}
	} catch (Throwable $e) {
		$base->rollback();
		echo $e->getMessage();
	}
}


//En cours de dev
function ShowMediaForEdit($idPost)
{

	$base = new M152();

	$tableauExtensionImage = [
		'jpg',
		'jpeg',
		'png',
		'gif',
		'jfif'
	];

	$tableauExtensionAudio = [
		'mp3',
		'oga',
		'midi',
		'weba',
		'wav',
		'mid'
	];
	$extensionVideo = 'mp4';


	//debut div 2
	echo "<div class=\"panel-thumbnail\">";

	    foreach ( $base->readThisOne($idPost) as $key => $value) {
			echo "<a href=\"delete/deleteMedia.php?idPost='" . urlencode($idPost) . "\" class=\"btn btn-primary\">Delete</a>";
		if (in_array($value['typeMedia'], $tableauExtensionImage)) {
			//Affiche une image si c'est une des bonne extension
			echo "<img src=\"ressources/" . $value['nomFichierMedia']  . "\" style=\"width: 400px;\" class=\"img-responsive\" style>";
		} else if (in_array($value['typeMedia'], $tableauExtensionAudio)) {
			//affiche un audio si l'extension correspond une dans le tableau
			echo "<audio controls src=\"ressources/" . $value['nomFichierMedia'] . "\"></audio>";
		} else if ($value['typeMedia'] == $extensionVideo) {
			//affcihe une video si l'extension est un mp4
			echo "<video autoplay loop muted src=\"ressources/" . $value['nomFichierMedia'] . "\" width=\"400px\"></video>";
		}

	}
	//fin div 2
	echo "</div>";
	//debut div 3
	echo "<div class=\"panel-body\">";

	echo "<form action=\"\" method=\"post\">";
	//affichage du commentaire du post
	echo "<input type=\"text\" name=\"\" value=\"" . $value['commentaire'] . "\" placeholder=\"" . $value['commentaire'] . "\">";
	
	echo "</form>";
	//fin div 3 
	echo "</div>";
}

function deleteMedia(){
	$base = new M152();

$base->beginTransaction();
try{
$id = filter_input(INPUT_GET, 'idPost', FILTER_SANITIZE_NUMBER_INT);
foreach ($base->readThisOne($id) as $key => $value) {
  if(!unlink("ressources/". $value['nomFichierMedia'])) {
    throw new Exception("Failed to delete media file.");
  }

}
$base->deleteThisOne($id);
$base->commit();
header('Location: index.php');
} 
catch(Exception $e){
    $base->rollback();
    echo $e->getMessage();
}
}