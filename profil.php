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


?>
    <div align="center">
        <h1>Profil de ...</h1>
        <br><br><br>
        <p class="error"><?php echo $error; ?></p>
        <br>
        <p>Pseudo = ...</p>
        <br>
        <p>Mail = ...</p>
    </div>
        
<?php
include 'Includes/footer.php'
?>