<?php
session_start();

require_once('./settings.php');
$foundUser = 0;

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    
    foreach($userArray as $arr){
        if($arr['email'] == $email && $arr['password'] == $password){
            $foundUser = 1;
            $username = $arr['username'];
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

    <title><?php echo $appTitle ?></title>


    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles.css" rel="stylesheet">

</head>

<body>
  <!-- Masthead -->
    <header class="masthead text-white">
        <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto text-center">
                        <h1 class="mb-5"><a href="index.php" class="site-header"><?php echo $appTitle ?></a></h1>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-md-10 col-lg-6 col-xl-6 mx-auto">

                        <?php if($foundUser == 1) { ?>

                        <i class="fa fa-user-circle-o fa-5x mb-5"></i>
                        <h3>Welcome back @<?php echo $username ?>!</h3>
                        <p>
                            Hello @<?php echo $username ?>. Welcome back to your dashboard
                        </p>
                        <div class="mt-5">
                            <a href="logout.php" class="btn btn-info" onclick="confirmLogout(event);">Logout</a><br>
                        </div>

                        <?php } else { ?>

                        <div class="form-row">
                            <div class="col-6 col-md-6">
                                <a href="login.php" class="btn btn-block btn-lg btn-info">Login</a><br>
                            </div>
                            <div class="col-6 col-md-6">
                                <a href="signup.php" class="btn btn-block btn-lg btn-info">Sign Up</a><br>
                            </div>
                        </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        function confirmLogout(event){
            event.preventDefault();
            var ans = confirm("Are you sure you want to sign out?");
            if(ans === true){
                window.location = "logout.php";
            }
        }
    </script>
</body>

</html>
</html>
