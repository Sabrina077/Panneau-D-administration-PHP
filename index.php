  <?php
    ob_start();
    session_start()
  ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panneau Administration</title>
        <link rel="stylesheet" href="style/styles.css">
    </head>
    <body>
        <header>
            <p class="headerP">Panneau d'aministration</p>
            <nav>
            <div class="nav-box">
                <ul class="onglet">
                    <a href="?page=accueil"><li>Acceuil</li></a>
                    <a href="?page=utilisateur"><li>Utilisateur</li></a>
                    <a href="?page=parametre"><li>Parametre</li></a>
                    <?php
                    if (isset($_SESSION["id"])){
                        echo '<a href="?page=deconnexion"><li>Deconnexion</li></a>';
                    }
                    else{
                        echo '<a href="?page=connexion"><li>Connexion</li></a>';
                    }
                    ?>
                </ul>
                </div>
            </nav> 
        </header>
     <?php
        if (isset($_GET['page']) && $_GET['page'] == "connexion"){
            echo '<form method="POST">
            <label>Identifiant</label>
            <input type="text" name="inputId">
            <label>Mot de passe</label>
            <input type="password" name="inputPassw">
            <input type="submit" name="submitConnect">
            </form>';
    }

       if (isset($_POST['submitConnect'])){

        if ($_POST["inputId"] == "sabrina" && $_POST["inputPassw"] == "012345"){
             echo "Vous etes connectée";

             $_SESSION["id"] = $_POST["inputId"];
             $_SESSION["nom"] = "calesse";
             $_SESSION["prenom"] ="sabrina";
             $_SESSION["age"] = "30";
             $_SESSION["mail"] = "mellesampedro@icloud.com";
             header('Location: ?page=accueil');
        }
    
        else {
            echo "Mauvais id ou mdp";
        }
    }
       if (isset($_GET['page']) && $_GET['page'] == "deconnexion"){
        session_destroy();
        header('Location: ?page=connexion');
    } 

       if (isset($_GET['page']) && $_GET['page'] == "utilisateur"){
        
         if (isset($_SESSION['id'])){
            echo '<p>Nom : ' . $_SESSION["nom"] . '</p>
            <p>Prenom : ' . $_SESSION["prenom"] . '</p>
            <p>Age : ' . $_SESSION["age"] . '</p> 
            <p>Mail : ' . $_SESSION["mail"] . '</p>';
         }
         else{
            echo "Vous n'etes pas connecté";
         }
    }

        if (isset($_GET['page']) && $_GET['page'] == "accueil"){
            if (isset($_SESSION['id'])){
                echo '<p>Bonjour ' . $_SESSION["nom"] . " " . $_SESSION["prenom"] . '. Vous etes connecté</p>';
            }
             else{
                echo "Vous n'etes pas connecté";
             }
    }
        if (isset($_GET['page']) && $_GET['page'] == "parametre"){
            if (isset($_SESSION['id'])){
               echo '<form method="post" class="formModif">
                <label>Nom</label>
                <input type="text" name="lastNameModif" value="' . $_SESSION["nom"] . '">
                <label>Prenom</label>
                <input type="text" name="firstNameModif" value="' . $_SESSION["prenom"] . '">
                <label>Age</label>
                <input type="text" name="ageModif" value="' . $_SESSION["age"] . '">
                <label>Mail</label>
                <input type="text" name="emailModif" value="' . $_SESSION["mail"] . '">
                <input type="submit" value="Modifier les infos"  name="submitModif">
              </form>';
            }
             else {

                echo "Vous devez etres connecté pour avoir accès aux modification";
            }
    

        if (isset($_POST['submitModif'])){
            $_SESSION["nom"] = $_POST['lastNameModif'];
            $_SESSION["Prenom"] = $_POST['firstNameModif'];
            $_SESSION["age"] = $_POST['ageModif'];
            $_SESSION["mail"] = $_POST['emailModif'];
            header('Location: ?page=parametre');
            echo "J'appuie sur le boutuon modifier";

        }
    }
    ?>
        
    </body>
    </html>
