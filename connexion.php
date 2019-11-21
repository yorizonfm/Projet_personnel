<?php
include 'Includes/head.php';
?>
    <title>Inscription</title>
<?php
include 'Includes/header.php';
?>
<?php
include 'Includes/nav.php';
?>
<?php
include 'Includes/menu-burger.php';
?>
<?php
include 'Includes/head.php';
?>
<?php
session_start();
try {
$bdd= new PDO("mysql:host=mysql-#.alwaysdata.net;dbname=#_projet_personel", "#", "#");
}
catch(PDOException $e){
    echo $e -> getMessage();
}

$pseudo = $_POST["pseudo"];
$mail = $_POST["mail"];
$password = $_POST["pwd"];
$submit = $_POST["submit"];

if(isset($submit)){
    if(!empty($mail) AND !empty($password)){
        $request = $bdd->prepare("SELECT * FROM MEMBRE WHERE mail = ? AND password = ?");
        $request->execute(array($mail, $password));
        $userexist = $request->rowCount();
        if($userexist == 1){
            $userinfo = $request->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("location: profil.php?=id=".$_SESSION['id']);
            

        }
        else{
                $error = "Mauvais mail ou mot de passe";
        }
    }
    else{
            $error = 'Veuillez remplire tout les champs';
    }
}

?>
    <div align="center">
        <h1>Connexion</h1>
        <br><br><br>
        <p class="error"><?php echo $error; ?></p>
        <form method="POST" action="">
            <table>
                <tr>
                    <td style="text-align:center;">
                        <label class="form-label">Mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Votre e-mail" id="mail" name="mail" value="<?php if(isset($mail)) {echo $mail;} ?>" class="form-input">
                    </td>
                </tr>
                <tr>
                        <td style="text-align:center;">
                            <label class="form-label">Mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Votre mot de passe" id="pwd" name="pwd" class="form-input">
                        </td>
                </tr>
            </table>
            <input type="submit" name="submit" value="connection">
        </form>
    </div>
        
<?php
include 'Includes/footer.php'
?>