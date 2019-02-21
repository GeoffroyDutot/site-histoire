<?php

session_start();
try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=site_histoire;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
 


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


<!--accès compte-->

<h1>Compte</h1>

<center><form action=""  method="post">  


<!-- Entrer son pseudo et son mot de passe -->

<?php
                        if(isset($_POST['Connexion'])) {
                           
                            $pseudoconnect = htmlspecialchars($_POST['pseudo']);
                            $mdpconnect = sha1($_POST['mdp']);
                           
                            if(!empty($pseudoconnect) && !empty($mdpconnect)) {
                              $requser = $bdd->prepare("SELECT * FROM compte WHERE pseudo = ? AND mdp = ?");
                              $requser->execute(array(
                                  $pseudoconnect,
                                  $mdpconnect
                              ));
                              $userexist = $requser->rowCount();
                              if($userexist == 1) {
                                 $userinfo = $requser->fetch();
                                 $_SESSION['id'] = $userinfo['id'];
                                 header("Location: profil.php?id=".$_SESSION['id']);
                              } else {
                                 $erreur_connexion = "Mauvais pseudo ou mot de passe !";
                              }
                           } else {
                              $erreur_connexion = "Tous les champs doivent être complétés !";
                           }
                        }
                    ?>








                        
  <label for="pseudo">Votre pseudo :</label> 
  <input type="text" name="pseudo" />


<p>
<label for="password">Mot de passe :</label>
<input type="password" name="mdp" id="mdp" />
</p><br>
 
<?php if (isset($erreur_connexion)) {
                        echo("<font color=\"red\">" . $erreur_connexion . "</font><br><br>");
                    } ?>



<input class="button" type="submit" name="Connexion" value="Connexion" <a href="profil.php"></a>
                        </form></center> 



<!--inscription-->
<!--sexe + pays + choix + pseudo + mot de passe + e-mail-->

<h1>Inscription </h1>

<div class="border_inscription"> 

	<center><form action="" method="post">

<?php

      if (isset($_POST['Valider']))
                        {
                        $pseudo = htmlspecialchars($_POST['pseudo']);
                        $mdp = sha1($_POST['mdp']);
                        $sexe = htmlspecialchars($_POST['sexe']);
                        $nationalite= htmlspecialchars($_POST['nationalite']);
                        $email = htmlspecialchars($_POST['email']);
                        $textarea = htmlspecialchars($_POST['textarea']);
                        $preferences = htmlspecialchars($_POST['preferences']);
 
                        if (!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['sexe']) && !empty($_POST['nationalite']) && !empty($_POST['email']) && !empty($_POST['textarea']) && !empty($_POST['preferences'])) {
                            
                                               $insertmbr = $bdd->prepare("INSERT INTO compte(pseudo, mdp, sexe, nationalite, email, textarea, preferences) VALUES(:pseudo, :mdp, :sexe, :nationalite, :email, :textarea, :preferences)");
                                               $insertmbr->execute(array(
                                                   'pseudo' => $_POST['pseudo'],
                                                   'mdp' => $mdp,
                                                   'sexe' => $_POST['sexe'],
                                                   'nationalite' => $_POST['nationalite'],
                                                   'email' => $_POST['email'],
                                                   'textarea' => $_POST['textarea'],
                                                   'preferences' => $_POST['preferences']
                                               ));

                                               header('location: Mon espace.php');

                                               }  else {
        $erreur = "Tous les champs doivent être complétés !";
         }
    }
                                               
                    

                      echo "Votre compte a bien été créer";
 
 
                    ?>



	<p>vous êtes :
		<input type="radio" name="sexe" value="Femme" id="Femme" checked="femme" />
		<label>Une femme</label>
		<input type="radio" name="sexe" value="Homme" id="Homme">
		<label>Un homme </label></p>
		<p><br>
        <label for="pays"> Quel est votre nationalité ? </label>
        <select name="nationalite" id="nationalite">
		<option>France</option>
		<option>Royaume-Unis</option>
		<option>Espagne</option>
		<option>USA</option>
		</select>
		</p><br>


<p>
<label for="pseudo">Votre pseudo :</label>
<input type="text" name="pseudo" id="pseudo" />
</p><br>
<p>
<label for="password">Mot de passe :</label>
<input type="password" name="mdp" id="mdp" />
</p><br>

<p>
<label for="email">Votre e-mail :</label>
<input type="text" name="email" id="email" tabindex="30" />
<br />
</p><br>


  <p>Vous aimez la ou les périodes ? <br><br>
         <input type="checkbox" name="preferences" checked="Préhistoire" value="Préhistoire"> <label for=preferences">Préhistoire </label><br>
         <input type="checkbox" name="preferences" value="Moyen-âge"> <label for="preferences">Moyen-âge</label> <br>
         <input type="checkbox" name="preferences" value="Antiquité"> <label for="preferences">Antiquité</label> <br>
         <input type="checkbox" name="preferences" value="Epoque moderne"> <label for="preferences">Epoque moderne</label><br>
     <input type="checkbox" name="preferences" value="Epoque Contemporaine"> <label for="preferences">Epoque Contemporaine</label></p><br>
    <p>

<textarea name="textarea"
   rows="10" cols="45">
  Vous pouvez écrire quelque
  chose ici.
</textarea><br><br>

<?php
                        if(isset($erreur)) {
                        echo '<font color="red">'.$erreur."</font>";
                         }elseif (isset($reussi)) {
                             echo($reussi);
                         } 
                     ?>    <br>      

<input class="button" type="submit" name="Valider" value="Valider" onclick="self.location.href='traitement.php'" style="background-color:#" style="color:white; font-weight:bold"onclick> </center></form> </div>

<br><br><br> 

<!--bas de page-->

<div class="footer">
   
  <p> A propos &nbsp &nbsp &nbsp &nbsp Confidentialité  &nbsp &nbsp &nbsp &nbsp &nbsp    Cookies   &nbsp  &nbsp &nbsp &nbsp &nbsp Condition générales    &nbsp &nbsp &nbsp &nbsp  Aide </a>
    
  </p>
</div>
 </body>
</html>