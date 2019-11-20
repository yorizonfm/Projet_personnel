<?php
include 'Includes/head.php';
try {
$bdd= new PDO("mysql:host=mysql-yorizon.alwaysdata.net;dbname=yorizon_projet_personel", "yorizon", "Lena15071991");
}
catch(PDOException $e){
    echo $e -> getMessage();
}

$pseudo = $_POST["pseudo"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$submit = $_POST["submit"];

if(isset($submit)){
    if(!empty($pseudo) AND !empty($mail) AND !empty($password) AND !empty($repassword)){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            if($password == $repassword){
                $request = $bdd ->prepare("SELECT * FROM MEMBRE WHERE mail = ? AND pseudo = ?");
                $request->execute(array($mail, $pseudo));
                $requestexist = $request->rowCount();

                if($requestexist == 0){
                    $insert = $bdd->prepare("INSERT INTO MEMBRE(pseudo, mail, password) VALUES(?, ?, ?)");
                    $insert->execute(array($pseudo, $mail, $password));
                    header("Location: acceuil.php");
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
</head>
<body>
    <header>
        <div class="tpl-header">
            <img class="logo" src="Images/Header.png">
        </div>
        <div class="login">
            <a class="log-pwd" href="#">
                S'identifier
            </a>
            &nbsp;&nbsp;&nbsp;
            <!-- Trigger/Open The Modal -->
            <button id="myBtn">S'enregistrer</button>
            <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <div class="form">
      <form method ="POST" action="">
          <p style="text-align: center;">pseudo :</p>
          <div class="pseudo">
              <input type="text" name="pseudo">
          </div>
          <p style="text-align: center;">email :</p>
          <div class="mail">
              <input type="email" name="mail">
          </div>
          <p style="text-align: center;" >mot de passe :</p>
          <div class="password">
              <input  type="password" name="password">
          </div><br>
          <p style="text-align: center;" >retaper mot de passe :</p>
          <div class="password">
              <input  type="password" name="repassword">
          </div><br>
          <div class="submit" ><input type="submit" name ="submit" value ="connexion"></div><br>
      </form>
      <p class="error"><?php echo $error; ?></p>
    </div>
    </div>

</div>

</div>
    </header>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
        </script>
