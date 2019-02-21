<?php
 
try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=site_histoire;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
 
      /* Formulaire d'inscription relié à la base de donnée */


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
                                               
                        }
                      }

                      echo "Votre compte a bien été créer";
 
 
                    ?>