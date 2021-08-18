<?php
// cette requete va permettre d'inserer les données dans la base de données
// verification du formulaire
     $errors=array(); //initialistion des erreurs
     //check for first name:
    $first_name=trim($_POST['first_name']);
     if(empty($first_name)){
        $errors[]='Vous avez oublié d inserer votre nom ';
    }
    //check for first name:
    $last_name=trim($_POST['last_name']);
    if(empty(last_name)){
        $errors[]='Vous avez oublié d inserer votre prenom ';
    }
    //check for email:
    $email=trim($_POST['email']);
    if(empty(email)){
        $errors[]='Vous avez oublié d inserer votre email ';
    }
    //verfication des mots de passse
    $password1=trim($_POST['password1']);
    $password2=trim($_POST['password2']);
    if ($password1 !== $password2) {
       $errors [] ='Vos mots de passe ne correspondent pas';
    }
    else {
        $errors [] = 'vous avez oublié d entrer votre de masse';
    }
    if (empty($errors)) {
        //si tout est ok!
    try {
        //enregistrement dans la base de donnée
        //crytage de la du mot de passe 
        $hashed_password=password_hash($password1, PASSWORD_DEFAULT);
        require('mysqli_connect.sql'); //connexion à la base donnée
        // execution de la requete
        $query = "INSERT TO users (userid, first_nmae, last_name, email, password, registration_date )";
            $query .="VALUES('',?,?,?,?,NOW() )";
        $q=mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        //utiliser l'instruction préparée pour s'assurer que seul du texte est inséré
        //lier les champs à l'instruction SQL
        mysqli_stmt_bin_param($q, 'ssss', $first_name, $last_nmae, $email, $hashed_password);
        // execution de la requette
        mysqli_stmt_excute($q);
    if (mysqli_stmt_affected_rows($q) == 1) //Un enregistrement inséré
    {
       header("location: register-thanks.php");
       exit();
    }
     else { // si l'enregistrement n'est pas bon
         $errorstring = "<p class='text-center col-sm-8'style='color:red'>";
         $errorstring .= "System Error<br />You could not be registered due ";
         $errorstring .= "to a system error. We apologize for anyinconvenience.</p>";
         echo "<p class=' text-center col-sm-2'style='color:red'>$errorstring</p>";
         // Debugging message below do not use in production
         //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
         mysqli_close($dbcon); // Close the database connection.
         // include footer then close program to stop execution
          echo '<footer class="jumbotron text-center col-sm-12"style="padding-bottom:1px; padding-top:8px;">
          include("footer.php");
          </footer>';
          exit();
     }
    } 
     catch(Exception $e) // We finally handle any problems here#11 
     {
      // print "An Exception occurred. Message: " . $e->getMessage();
      print "The system is busy please try later";
    }
      catch(Error $e)
      {
     //print "An Error occurred. Message: " . $e->getMessage();
     print "The system is busy please try again later.";
    }
    } 
     else { // Report the errors.                                                 #12
        $errorstring = "Error! The following error(s) occurred:<br>";
        foreach ($errors as $msg) { // Print each error.
            $errorstring .= " - $msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
    }
    
?>