<?php
     //include mysql connect file
     require_once "mysql_connect.php";
     //declaration des variables et initialtion 
     $firstname = $lastname = $mail = $password = $confirm_password = "";
     $firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = "";
  
     if($_SERVER["REQUEST_METHOD"] == "POST"){

     //valid first name
     if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter firstanme.";     
     } elseif(strlen(trim($_POST["firstname"])) < 3){
        $firstname_err = "Password must have atleast 6 characters.";
      } else{
        $firstname = trim($_POST["firstname"]);
     }

     // valied lastname 
     if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter lastname.";     
     } elseif(strlen(trim($_POST["lastname"])) < 3){
        $lastname_err = "Password must have atleast 6 characters.";
      } else{
        $lastname = trim($_POST["lastname"]);
     }

     // valid email

     if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
     } 
     else{
         // Prepare a select statement
         $sql = "SELECT userid FROM users WHERE email = :email";
        
         if($stmt = $pdo->prepare($sql)){
             // Bind variables to the prepared statement as parameters
             $stmt->bindParam(":email", $param_username, PDO::PARAM_STR);
            
             // Set parameters
             $param_username = trim($_POST["email"]);
            
             // Attempt to execute the prepared statement
             if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
             } else{
                echo "Oops! Something went wrong. Please try again later.";
             }

             // Close statement
             unset($stmt);
        }
    }
       // Validate password
     if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
     } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
     } else{
        $password = trim($_POST["password"]);
     }
    
    // Validate confirm password
     if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
     } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
         }
         }

         // Check input errors before inserting in database
         if(empty($firstname_err) && empty($lastname_err) && empty($email_err)  && empty($password_err) && empty($confirm_password_err)){
        
         // Prepare an insert statement
         $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)";
         
         if($stmt = $pdo->prepare($sql)){
             // Bind variables to the prepared statement as parameters
             $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
             $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
             $stmt->bindParam(":email", $param_username, PDO::PARAM_STR);
             $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
             // Set parameters
             $param_username = $email;
             $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
             // Attempt to execute the prepared statement
             if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
             } else{
                echo "Oops! Something went wrong. Please try again later.";
             }

             // Close statement
             unset($stmt);
         }
     }
    
      // Close connection
     unset($pdo);
     
}
?>