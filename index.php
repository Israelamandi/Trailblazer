<?php
session_start();
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $fileName = 'users.json';
    $foundUser = 0;

    $jsonFile = file_get_contents($fileName);
    $userArray = json_decode($jsonFile, true);
    
    foreach($userArray as $arr){
        if($arr['email'] == $username && $arr['password'] == $password){
            $foundUser = 1;
            $fullName = $arr['username'];
        }
    }

    if($foundUser == 0){
        header("location: login.php");
        exit();
    }
}
else{
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Trailblazer - Dashboard</title>
</head>

<body>
    <div class="container full_page">
        <div class="row">
            <div class="col" id="right">
                <h1 id="logo">TRAILBLAZER</h1>
                <div><img src="Group 2.png" alt="user logo"></div>
                <div>
                    <h4><?php echo $fullName ?></h4>
                    <?php echo "<a href='mailto:$username'>$username</a>" ?>
                    <br><a href="#" onclick="confirmLogout(event);">Logout</a>
                </div>
            </div>
            <div class="col" id="left">
                <div class="bio row">
                    <div class="col">
                        <h5>Bio</h5>
                    </div>
                    <div class="col">
                        <p>
                            UX/UI DESIGN ENGINEER <br>
                            FRONTEND ENGINEER <br>
                            BACKEND ENGINEER <br>
                            FULLSTACK ENGINEER <br>
                        </p>
                    </div>
                </div>
                <div class="portfolio row">
                    <div class="col">
                        <h5>Portfolio</h5>
                    </div>
                    <div class="col">
                        <p>
                            FIGMA,NODE JS, HTML,CSS, <br>
                            JAVASCRIPT,BOOTSTRAP,PHP. <br>
                        </p>
                    </div>
                </div>
                <div class="contact row">
                    <div class="col">
                        <h5>Contact</h5>
                    </div>
                    <div class="col">
                        <form action="">
                            <div class="form-group">
                                <input type="text" placeholder="NAME" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="10" class="form-control">...LEAVE A MESSAGE</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit">send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

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