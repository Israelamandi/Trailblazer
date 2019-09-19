<?php
session_start();

require_once('./settings.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        $error = "All fields are required. Please check your email and/or password";
    }
    else{
        if(!empty($userArray[0])){
            foreach($userArray as $arr){
                if($arr['email'] == $email && $arr['password'] == $password){
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header("location: index.php");
                    exit();
                }
                else{
                    $error = "Login Failed: You have entered invalid login details.";
                }
            }
        }
        else{
            $error = "Login Failed: You have entered invalid login details.";
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

    <title><?php echo $appTitle ?> - Login</title>


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
                            <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4">Login to your Account</h1>
                                    </div>

                                    <!-- Error Message Here -->
                                    <?php if(isset($error)) { ?> 
                                    <div class="card shadow mb-4 border-left-danger">
                                        <div class="card-body"><?php echo $error ?></div>
                                    </div>
                                    <?php } ?>

                                    <form class="user" method="post" action="login.php">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-info btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="signup.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>

</html>
