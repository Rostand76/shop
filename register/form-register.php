<?php
     session_start();
      //initialisation  des veriables;
     $first_name ="";
     $last_name= "";
     $email="";
     $errors = array();

     //connexction ç la base de donnée
     $db = mysqli_connect('localhost','admin','jhqQ1hP7e)Q/msU-','members');

     if (isset($_POST['submit'])) {
        
     //enregistrement utilisateur 
     $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
     $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
     $email = mysqli_real_escape_string($db, $_POST['email']);
     $password1 = mysqli_real_escape_string($db, $_POST['password1']);
     $password2= mysqli_real_escape_string($db, $_POST['password2']);
     
     // test des variables
     if (empty($first_name)) {
         array_push($errors, "le nom est obligatoire");
     }
     if (empty($last_name)) {
        array_push($errors, "le prenom est obligatoire");
     }
     if (empty($email)) {
        array_push($errors, "le mail est obligatoire");
     }
     if (empty($first_name)) {
        array_push($errors, "le nom est obligatoire");
     }
     if ($password1 != $password2) {
        array_push($errors, "les mots de passe ne correspondent pas");
     }

     //requette de l'existance d'un utlisateur
     $user_check_query= "SELECT * from users WHERE username='$firs_name' OR email='$email' LIMIT 1";
     $result=mysqli_query($sdb, $user_check_query);
     $user= mysql_fetch_assoc($result);
     
      if ($user) {
          if ($oser['first_name'] === $first_name) {
              array_push($errors, 'ce nom extiste deja');
          }
          if ($oser['email'] === $email) {
            array_push($errors, 'cet email exite deja');
         }
      }
     
      // requette pour insertion des données dans la base de donnée
      if (count($errors) == 0) {
          # crypthage du mot de passe 
          $password = password_hash($password1, PASSWORD_DEFAULT);
          $query = "INSERT INTO users (first_name, last_name, email, passwd)
                 VALUES('$first_name','$last_name','$email','$password')";
         mysqli_query($db, $query);
         $_SESSION['first_name'] = $first_name;
         $_SESSION['success'] = "vous etes connecté";
         header("location: register-thanks.php");
      }
     }
?>