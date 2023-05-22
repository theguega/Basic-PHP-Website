<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php

  @$choix_eleve = $_POST["menuChoixEleve"];

	include 'connexion.php';

  echo "<h1>Désinscription d'une séance</h1>";

  if (!isset($choix_eleve)) {

		  echo "<FORM METHOD='POST' ACTION='desinscription_seance.php' > ";
			$query = "SELECT * FROM eleves"; //on recupere la liste des élèves
			// echo "<p> $query </p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "<p> <label for='menuChoixEleve'>Choisir un élève :</label> <br />";
          $nb_eleves = mysqli_num_rows($result);
          echo "<select name='menuChoixEleve' size='$nb_eleves' required>";

          while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

              echo "<option value='$row[0]'>$row[1] $row[2]</option>";

          }

          echo "</select> </p>";
          echo "<INPUT type='submit' value='Suivant'>";
          echo "</FORM>";
      }
  } elseif (isset($choix_eleve)) {

		echo "<FORM METHOD='POST' ACTION='desinscrire_seance.php' > ";

		$query = "SELECT * FROM inscription INNER JOIN seances ON seances.idseance = inscription.idseance WHERE seances.DateSeance > CURDATE() AND ideleve = $choix_eleve";
		//on recupere les infos de inscriptions et seances (jointure)
		//echo "<p>$query</p>";
		$result = mysqli_query($connect, $query);

		if (!$result) {
				echo "<br>Erreur : " . mysqli_error($connect);
		} else {

				echo "<p> <label for='menuChoixSeance'>Choisir une séance :</label> <br />";
				$nb_seances = mysqli_num_rows($result);
				echo "<select name='menuChoixSeance' size='$nb_seances' required>";

				while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

					$query = "SELECT * FROM themes WHERE idtheme = '$row[6]'"; //recuperation des informations du thème pour l'affichage
					//echo "<p>$query</p>";
					$theme = mysqli_query($connect, $query);

					if (!$theme) {
							echo "<br>Erreur : " . mysqli_error($connect);
					}

					$info_theme = mysqli_fetch_array($theme, MYSQLI_NUM);
					echo "<option value='$row[0]'>$info_theme[1] | $row[4]</option>";

				}

				echo "</select> </p>";
				echo "<input name='eleve' type='hidden' value='$choix_eleve'>";
				echo "<INPUT type='submit' value='Désinscrire'>";
				echo "<a class='annuler' href='desinscription_seance.php' target='contenu'>Retour</a>";
				echo "</FORM>";

	}
}
  mysqli_close($connect);
  ?>
	</body>
</html>
