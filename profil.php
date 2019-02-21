

<?php

try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=site_histoire;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

  session_start();


          

?>

<!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>World Wars history</title>
<link rel="stylesheet" href="CSS/menu.css">
<link rel="stylesheet" href="CSS/styles.css">
<link rel="stylesheet" href="CSS/images.css">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
<link rel="icon" type="image/gif" href="images/favicon.png" />

 </head>
 <body>


<div class="nav">
    <ul>

<!--Menu-->

        <li><a href="index.php">Accueil</a></li> <!--Actualités-->
        <li><a href="premiere_guerre.php">Première guerre mondiale</a></li> <!--article-->
        <li><a href="deuxieme_guerre.php">Seconde guerre mondiale</a></li> <!--article-->
        <li><a href="Galerie.php">Galerie</a></li> <!--photo-->
        <li><a href="Vidéos.php">Vidéos</a></li> <!--vidéos youtube-->
        <li><a href="Mon espace.php">Mon espace</a></li> <!--accès compte ou inscription-->
    <div class="logo_user"> <a href="acces_parametre.php"><img src="images/user.svg" width="30px" height="30px"></a></div>
    
    </ul>
</div>

<h1>Profil</h1>

<?php
/* Remplir le champ connexion avec son pseudo et son mdp sinon erreur */

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM compte WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
}



echo $userinfo["pseudo"] . "<br>";
echo $userinfo["email"] . "<br>";
echo $userinfo["sexe"] . "<br>";
echo $userinfo["nationalite"] . "<br>";
echo $userinfo["preferences"] . "<br>";
?>

</html>