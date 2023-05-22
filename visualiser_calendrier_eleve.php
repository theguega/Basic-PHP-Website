<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php

  include 'connexion.php';

  $ideleve = $_POST["menuChoixEleve"];

  echo "<h1>Calendrier des séances</h1>";

  if (empty($ideleve)) {

      echo "Veuillez choisir un élève";
      echo "<a class='annuler' href='desinscription_eleve.php' target='contenu'>Retour</a>";

  } else {
			$query = "SELECT * FROM inscription INNER JOIN seances ON seances.idseance = inscription.idseance WHERE seances.DateSeance > CURDATE() AND ideleve = '$ideleve'";
			//on recupere toutes les inscriptions et les séances futur de l'élève
			// echo "<p> $query </p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "
			<table border='1'>
				<tr>
					<th> Date </th>
						<th> Thème </th>
				</tr> ";

          while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

              echo "<tr>";
              echo "<td> $row[4]";

							$query = "SELECT * FROM themes WHERE idtheme = '$row[6]'"; //on recupere les themes pour l'affichage
							// echo "<p> $query </p>";
              $theme = mysqli_query($connect, $query);

              if (!$theme) { //recuperation des informations du thème pour affichage
                  echo "<br>Erreur : " . mysqli_error($connect);
              }

              $info_theme = mysqli_fetch_array($theme, MYSQLI_NUM);
              echo "<td> $info_theme[1]";
              echo "</tr>";

          }
          echo "</table>";
      }
  }

  mysqli_close($connect);
  ?>
	</body>
</html>
