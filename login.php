<?php
session_start();

//File name
$fileName = 'users.json';
$foundUser = 0;

if(isset($_POST['login'])){
    $username = $_POST['Email'];
    $password = $_POST['Password'];

    if(empty($username) || empty($password)){
        $error = "All fields are required. Please check your username and/or password";
    }
    else{
        $jsonFile = file_get_contents($fileName);
        $userArray = json_decode($jsonFile, true);
        if(!empty($userArray[0])){
            foreach($userArray as $arr){
                if($arr['email'] == $username && $arr['password'] == $password){
                    $foundUser = 1;
                }
            }
        }
        else{
            $error = "Login Failed: You have entered invalid login details.";
        }

        if($foundUser == 1){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("location: dashboard.php");
            exit();
        }
        else{
            $error = "Login Failed: You have entered invalid login details.";
        }
    }

}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<title>Trailblazers - Login</title>

	<link rel="stylesheet" type="text/css" href="Trailblazers.css">

</head>

<body>
	
<h2 class="h2">TRAILBLAZER</h2>
<p class="User"> <img src="Vector.png" alt="User placeholder" </p>

<p class="Welcome"> Welcome back!</p>
<p class="New">New here? <a href="signup.php">Sign up</a> </p> 

<form action="" method="post">
    <?php if(isset($error)) { ?>
    <p class="text-danger" style="position: absolute; top:230px; left: 520px"> <?php echo $error ?> </p>
    <?php } ?>
	<p > <input type="text" name="Email" placeholder="    Email address" class="Email"> </p>
	<p > <input type="password" name="Password" placeholder="    Password" class="Password">  </p>
	
    <p > <button class="button1" type="submit" name="login">Sign in</button> </p>
</form>


<p class="checkmark"> <input type="checkbox" name=""> </p>  <p class="Remember">  Remember me  </p> <p class="Forgot"><span> Forgot Password? </span> </p>

<p ><button class="Social"> Continue with Google</button> </p> 

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>