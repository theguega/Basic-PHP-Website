<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>ajout_seance</title>
	</head>
	<body>
		<?php
  echo "<h1>Ajouter une séance</h1>";

	date_default_timezone_set('Europe/Paris');
  $date_jour = date("Y-m-d");

  include 'connexion.php'; //connexion à la base de donnée

  echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' > ";
  echo "<p><label for='date'>Date :</label> <input id='date' type='date' min='$date_jour' name='date' required /></p>";
  echo "<p><label for='effectif'>Effectif :</label> <input id='effectif' type='number' min=1 name='effectif' required /></p>";

	$query = "SELECT * FROM `themes` WHERE supprime=0"; //on recupere les thèmes activés
	// echo "<p>$query<p>";
  $result = mysqli_query($connect, $query);

  if (!$result) { //verification de potentielle erreurs
      echo "<br>Erreur : " . mysqli_error($connect);
  } else {

      $nb_themes = mysqli_num_rows($result);

      echo "<p><label for='menuChoixTheme'>Choisir un thème:</label> <br>";
      echo "<select name='menuChoixTheme' size='$nb_themes'>";

      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

          echo "<option value='$row[0]'>$row[1]</option>"; //proposition des différents thèmes

      }

      echo "</select> </p>";
      echo "<INPUT type='submit' value='Enregistrer séance'>";
      echo "</FORM>";
  }

  mysqli_close($connect); //fermeture de la connexion

  ?>
	</body>
</html>
