<?php
require_once("database.php");
//(\.jpg|\.jpeg|\.png|\.gif|\.jfif|\.mp4|\.mp3|\.oga|\.midi|\.weba|\.wav|\.mid)$/i;


function showPost(){
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
	
	foreach ($base->readPost() as $keys => $idPost) {

		echo "<div class=\"panel panel-default\">";
		echo " <form action=\"#\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"id\" value=\"" . $idPost['idPost'] ."\">";
		echo "<button type=\"submit\" value=\"del\">Delete</button>";
		echo "<button type=\"submit\" value=\"edit\">Edit</button>";
		echo "</form>";
		echo "<div class=\"panel-thumbnail\">";
		
		foreach ($base->readThisOne($idPost['idPost']) as $key => $value) {
		if(in_array($value['typeMedia'],$tableauExtensionImage)){
			echo "<img src=\"ressources/" . $value['nomFichierMedia']  ."\" style=\"width: 400px;\" class=\"img-responsive\" style>";
		}
		else if(in_array($value['typeMedia'], $tableauExtensionAudio)){
			echo "<audio controls src=\"ressources/" . $value['nomFichierMedia'] . "\"></audio>";
		}
		else if($value['typeMedia'] == $extensionVideo){
			echo "<video autoplay loop muted src=\"ressources/" . $value['nomFichierMedia'] . "\" width=\"400px\"></video>";
		}
		
			 } 
			 echo"</div>";
			 echo "<div class=\"panel-body\">";
			 echo "<p class=\"lead\">" . $value['commentaire'] . "</p>";
			 echo"</div></div>";
			
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
	try{

	if (filter_input(INPUT_POST, 'btnPost') && $_FILES["userfile"]["name"][0] != '') {
		$texte = filter_input(INPUT_POST, 'texte');
		var_dump($_FILES);

		$tmp = array_count_values($_FILES['userfile']['error']);

		if (isset($tmp[1])) {
			$cnt = $tmp[1];
		}


		if ($cnt != count($_FILES['userfile']['error'])) {
			$base->insertPost($texte);
		}

		foreach ($_FILES["userfile"]["error"] as $key => $error) {
			$error = false;

			$fileTmpName = $_FILES['userfile']['tmp_name'][$key];
			$uploads_dir = 'ressources/';
		

			$name = basename($_FILES["userfile"]["name"][$key]);
			if (in_array( mime_content_type($fileTmpName), $listMime)) {
				$idUnique = uniqid('', true) . $name;
				$info = new SplFileInfo($name);
				$base->insertMedia($idUnique, $info->getExtension(), $base->lastInsertId);
				move_uploaded_file($fileTmpName, $uploads_dir . $idUnique);
			}
			header('Location: index.php');
		}
	}
}	catch(Throwable $e){
	   echo $e->getMessage();
	}
}
