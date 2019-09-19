<?php

require_once('./settings.php');

$submitted = 0;
$error = [];

if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['retypepassword'];

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
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $appTitle ?> - Sign Up</title>


    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <div class="col-xl-9 mx-auto text-center">
                    <h1 class="mb-0"><a href="index.php" class="site-header"><?php echo $appTitle ?></a></h1>
                </div>
            </div>
        </div>

        
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <?php if($submitted == 0) { ?>

                            <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                                        </div>

                                        <!-- Error Message Here -->
                                        <?php if(!empty($error)) { ?> 
                                        <div class="card shadow mb-4 border-left-danger">
                                            <div class="card-body">
                                                <?php echo implode(", ", $error); ?>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <form class="user" method="post" action="signup.php">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"  placeholder="Email Address" name="email" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" placeholder="Username" name="username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" placeholder="Confirm Password" name="retypepassword">
                                            </div>
                                            <button type="submit" name="signup" class="btn btn-info btn-user btn-block">Create Account</button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="login.php">Already have an account? Login!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } else { ?>

                            <div class="col-lg-9 text-center mx-auto">
                                <div class="p-5">
                                    <div class="text-center">
                                        <i class="fa fa-check-circle fa-5x text-success"></i><br>
                                        <h1 class="h4 text-gray-900 mb-4">Signup Successful</h1>
                                    </div>
                                    <div>Congratulations <b>@<?php echo $username; ?></b>! Your signup was successful and you can now log in to your account. <a href='login.php'>Click here to login</a>
                                </div>
                            </div>

                            <?php } ?>
                        </div> <!-- Row -->
                    </div> <!-- CARD-BODY -->
                </div> <!-- CARD -->
            </div>
        </div>
    </div>

</body>

</html>
