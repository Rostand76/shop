<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <title>Enregistrer un Compte</title>
    <script src="../js/verify.js"></script>
</head>
       
 <body>
    
     <?php
     if($_SERVER['REQUEST_METHOD'] == 'POST') {
         require('process-register-page.php');
        } // End of the main Submit conditional.
        ?>
     <div class="wrapper">
         <h2>Sign Up</h2>
        <p>Veuillez remplir le formulaire pour créer un compte.</p>
        <form action="register.php"  method="post" onsubmit="return checked();">
            <div class="form-group">
                <label> Fisrt Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                placeholder="first Name" maxlength="30" required
                value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" >
            </div>    

            <div class="form-group">
                <label>Last_namae</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                placeholder="Last Name" maxlength="40" required
                value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="email" name="email"
                placeholder="test@example.com" maxlength="40" required
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password1" name="password1"
                placeholder="Pawword" maxlength="8" required
                value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; ?>">
                <span id='message'>Between 8 and 12 characters.</span>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2"
                placeholder="Confirm Pawword" maxlength="8" required
                value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>">
            </div>
          
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="../login/login.php">Login here</a>.</p>
        </form>

       
    </div>    
    
</body>
</html>