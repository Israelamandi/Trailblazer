<?php

//File name
$fileName = 'users.json';
$submitted = 0;
$error = [];

if(isset($_POST['signup'])){
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $password2 = $_POST['Retypepassword'];

    if(empty($username) || empty($email) || empty($password) || empty($password2)){
        array_push($error, "All fields are required. Kindly check your form again");
    }
    else{
        $jsonFile = file_get_contents($fileName);
        $userArray = json_decode($jsonFile, true);
        if(!empty($userArray[0])){
            foreach($userArray as $arr){
                if($arr['email'] == $email){
                    array_push($error, "Sorry, you have entered an email that is already registered");
                }
                if($arr['username'] == $username){
                    array_push($error, "Sorry, the username has already been taken. Try using another username.");
                }
            }
        }

        if($password != $password2){
            array_push($error, "Your passwords don't match. Check again!");
        }
    }

    if(empty($error)){
        $newUserArray = array(
            "username" => $username,
            "email" => $email,
            "password" => $password
        );

        if(!empty($userArray[0])){
            array_push($userArray, $newUserArray);
        }
        else{
            $userArray = array($newUserArray);
        }

        $newUsersJSON = json_encode($userArray);
        if(file_put_contents($fileName, $newUsersJSON)){
            $submitted = 1;
        }
        else{
            array_push($error, "Could not create user account");
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
	
	<title>Signup- We Lead</title>
	<link rel="stylesheet" type="text/css" href="trailblazersignup.css">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
<?php if($submitted == 0) { ?>
<div class="Rectangle">
	

		<p class="Signup"> SIGN UP</p>

<form action="" method="post" class="form">
<?php if(!empty($error)) { ?><p class="text-danger" style="position:absolute; top: 110px; left: 120px">
    <?php
    //$lastErrorIndex = count($error) - 1;
    echo implode(", ", $error);
    ?>
</p><?php } ?>
<p > <input type="text" name="Username" placeholder="   USERNAME" class="USERNAME"> </p>
<p > <input type="text" name="Email" placeholder="   EMAIL" class="EMAIL">  </P>
<p > <input type="text" name="Password" placeholder="   PASSWORD" class="PASSWORD"> </p>
<p > <input type="text" name="Retypepassword" placeholder="   RE-TYPE PASSWORD" class="RE-TYPEPASSWORD"> </p>

<p > <button class="button1" type="submit" name="signup">CREATE MY TRAILBLAZER ACCOUNT</button> </p>
</form>


	

</div>

<div id="Circle">
	<div id="Text"> OR</div>
</div>


<div class="Rectangle2">
	
	<p class="Signup1"> SIGN IN WITH SOCIAL NETWORK</p>



<p > <button class="button2">Login with Facebook</button> </p>
<p > <button class="button3">Login with Twitter</button> </p>
<p > <button class="button4">Login with Google+</button> </p>
</div>

<?php }else{ ?>
<h2>Congratulations <?php echo $username ?>! Your signup was successful.</h2>
<h4><a href="login.php">Click here to login to your account</a></h4>
<?php } ?>


</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>