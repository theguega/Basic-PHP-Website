<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<?php
  echo "<h1>Récapitulatif de l'inscription</h1>";

  include 'connexion.php';

  $seance = $_POST['menuChoixSeance'];
  $eleve = $_POST['menuChoixEleve'];

  $seance = mysqli_real_escape_string($connect, $seance);
  $eleve = mysqli_real_escape_string($connect, $eleve);

  if (empty($seance) || empty($eleve)) {

      echo "<p> Veuillez rentrer la séance et le nom de l'élève </p>";
	    echo "<a class='annuler' href='inscription_eleve.php' target='contenu'>Retour</a>";

  } else {
		
			$query = "SELECT EffMax FROM `seances` WHERE idseance = $seance"; //on recupere l'effectif max
			// echo "<p> $query </p>";
			$effectifmax = mysqli_query($connect, $query);
			$effectifmax = mysqli_fetch_array($effectifmax, MYSQLI_NUM);

			if (!$effectifmax) {
          echo "<br>Erreur : " . mysqli_error($connect);
      }

			$query = "SELECT COUNT(idseance) FROM `inscription` WHERE idseance = $seance"; //on compte le nom d'élèves inscrit à la séance
			// echo "<p> $query </p>";
			$effectifactuel = mysqli_query($connect, $query);
			$effectifactuel = mysqli_fetch_array($effectifactuel, MYSQLI_NUM);

			if (!$effectifactuel) {
          echo "<br>Erreur : " . mysqli_error($connect);
      }

			if ($effectifactuel[0] >= $effectifmax[0]) {

				echo "<p> La séance est déjà pleine </p>";
	      echo "<a class='annuler' href='inscription_eleve.php' target='contenu'>Retour</a>";

			} else {

      $query = "INSERT INTO `inscription` VALUES ($seance,$eleve,-1)";
      echo "<p>$query</p>";
      $result = mysqli_query($connect, $query);

      if (!$result) {
          echo "<br>Erreur : " . mysqli_error($connect);
      } else {

          echo "L'élève à bien été inscrit à la séance";

      }
		}
  }

  mysqli_close($connect);
  ?>
	</body>
</html>
