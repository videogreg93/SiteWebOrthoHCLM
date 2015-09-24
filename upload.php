<?php
$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

$temp2 = explode(".", $_FILES["file2"]["name"]);
$extension2 = end($temp);



$field_prenom = $_POST['prenom'];
$field_nom = $_POST['nom'];
$field_adresse = $_POST['adresse'];
$field_adresse2 = $_POST['adresse2'];
$field_ville = $_POST['ville'];
$field_etat = $_POST['etat'];
$field_ramq = $_POST['ramq'];
$field_date = $_POST['date'];
$field_medecin = $_POST['nomMedecin'];
$field_diagnostic = $_POST['diagonstic'];
$field_dispo = $_POST['dispo'];
$field_email = $_POST['email'];

$mail_to = "gregorykarlfournier@gmail.com";
$subject = "Demande de rendez-vous";

$directory = "files/".$field_prenom."_".$field_nom."/";
mkdir($directory);

$body_message = 'De: '.$field_prenom." ".$field_nom."\n";
$body_message .= 'Email: '.$field_email."\n\n";
$body_message .= 'Adresse: '.$field_adresse." ".$field_adresse2."\n".$field_ville.", ".$field_etat."\n";
$body_message .= "No RAMQ: ".$field_ramq."\n";
$body_message .= "Date d'expiration: ".$field_date."\n";
$body_message .="Nom du medecin: ".$field_medecin."\n";
$body_message .="Diagonistic: ".$field_diagnostic."\n";
$body_message .="Disponibilités: ".$field_dispo."\n"; 
if ($temp == "") {
	$body_message .="Les documents seront envoyes par la poste."; 
}

//$headers = 'From: '.$field_email."\r\n";
//$headers .= 'Reply-To: '.$field_email."\r\n";

$fp = fopen($directory.$field_prenom."_".$field_nom.".txt","wb");
fwrite($fp,$body_message);
fclose($fp);


if (($_FILES["file"]["size"] < 50000000)
&& in_array($extension, $allowedExts) && ($_FILES["file2"]["size"] < 50000000)
&& in_array($extension2, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0 || $_FILES["file2"]["error"] > 0 ) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	echo "Return Code: " . $_FILES["file2"]["error"] . "<br>";
  } else { /* everything is good, check captcha then create and send the email */
	  
  		
		
		
		if(empty($errors)) {
		if (file_exists("files/" . $_FILES["file"]["name"])) {
      		echo $_FILES["file"]["name"] . " already exists. ";
    	} else {
      		move_uploaded_file($_FILES["file"]["tmp_name"],
      		$directory . $_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file2"]["tmp_name"],
      		$directory . $_FILES["file2"]["name"]);
      		echo "Stored in: " .$directory . $_FILES["file"]["name"];
    	  }
		
  		
     
	?><script language="javascript" type="text/javascript">
		localStorage.setItem("result","success");
		window.location = "rendez-vous.html";
	  </script> <?
  }}
} else { 
	if ($_FILES["file"]["size"] > 50000000) { ?> 	
  <script language="javascript" type="text/javascript">
  	localStorage.setItem("result","fail");
	localStorage.setItem("uploadError","le fichier doit etre inferieur a 50mb");
	window.location = "rendez-vous.html";
  </script>
	<?}
	?>
	<script language="javascript" type="text/javascript">
	localStorage.setItem("result","success");
	window.location = "rendez-vous.html";
  </script>
	<?
	
}
?>