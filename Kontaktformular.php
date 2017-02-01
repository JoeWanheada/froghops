<?php



	  $vorname = isset($_POST["vorname"]);

	  $nachname = isset($_POST["nachname"]);

	  $email = isset($_POST["Mail"]);

	  $betreff = isset($_POST["Betreff"]);

	  $nachricht = isset($_POST["nachricht"]);

      $returnPage= "Erfolgreich.html";
      $returnErrorPage = "Fehlgeschlagen.html";


	  $name = $vorname.' '.$nachname;





	  $an = 'as272@hdm-stuttgart.de';

	  $betreff = "Kontaktformularnachricht";




$mailSent = @mail($an, $email, $nachricht, "From: ".$vorname.''.$nachname);


if($mailSent == TRUE) {

    header("Location: " . $returnPage);
}

else {

    header("Location: " . $returnErrorPage);
}


exit();


?>



