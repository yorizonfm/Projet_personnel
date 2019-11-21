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
try {
$bdd= new PDO("mysql:host=mysql-#.alwaysdata.net;dbname=#_projet_personel", "#", "#");
}
catch(PDOException $e){
    echo $e -> getMessage();
}

$pseudo = $_POST["pseudo"];
$mail = $_POST["mail"];
$password = $_POST["pwd"];
$repassword = $_POST["pwd2"];
$submit = $_POST["submit"];

if(isset($submit)){
    if(!empty($pseudo) AND !empty($mail) AND !empty($password) AND !empty($repassword)){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            if($password == $repassword){
                $request = $bdd ->prepare("SELECT * FROM MEMBRE WHERE mail = ? AND pseudo = ?");
                $request->execute(array($mail, $pseudo));
                $requestexist = $request->rowCount();
                $error = "Votre compte a bien été créé";

                if($requestexist == 0){
                    $insert = $bdd->prepare("INSERT INTO MEMBRE(pseudo, mail, password) VALUES(?, ?, ?)");
                    $insert->execute(array($pseudo, $mail, $password));
                }
                else{
                    $error = 'Cette email est déjà utilisé';
                }
            }
            else{
                $error = 'Les mots de passe ne correspondent pas';
            }
        }
        else{
            $error = 'Email non valide';
        }
    }
    else{
        $error = 'Veuillez remplire tout les champs';
    }
}
?>
    <div align="center">
        <h1>Inscription</h1>
        <br><br><br>
        <p class="error"><?php echo $error; ?></p>
        <form method="POST" action="">
            <table>
                <tr>
                    <td style="text-align:center;">
                        <label class="form-label">Pseudo :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>" class="form-input">
                    </td>
                </tr>
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
                <tr>
                        <td style="text-align:center;">
                            <label class="form-label">Confirmez mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Confirmez mot de passe" id="pwd2" name="pwd2" class="form-input">
                        </td>
                </tr>
            </table>
            <input type="submit" name="submit" value="S'inscrire">
        </form>
    </div>
        
<?php
include 'Includes/footer.php'
?>