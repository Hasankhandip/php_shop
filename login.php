<?php
session_start();
@include 'config.php';

$empty_email = $empty_password = '';

if (isset($_POST['submit'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $md5_user_password = md5($user_password);

    if (empty($user_email)) {
        $empty_email = 'Fill up the field';
    }

    if (empty($user_password)) {
        $empty_password = 'Fill up the field';
    }

    if (!empty($user_email) && !empty($user_password)) {
        $user_query = mysqli_query($conn, "SELECT * FROM `users` WHERE user_email='$user_email' AND user_password='$md5_user_password'");
        if (mysqli_num_rows($user_query) > 0) {
            $_SESSION['login'] = 'login success';
            header('location:admin.php');
        } else {
            echo 'not found';
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- bootstrap cdn link -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="#" class="logo">FoodieBro</a>

            <nav class="navbar">
                <a href="user.php">register <i class="fa-regular fa-user"></i></a>
            </nav>
            <div id="menu-btn" class="fas fa-bars"></div>

        </div>
    </header>


    <section class="login-section">
        <div class="container">
            <?php
            if (isset($_GET['usercreated'])) {
                echo 'User Create Succesfully';
            }
            ?>
            <form action="login.php" method="post" class="login-form">
                <h3>User Login</h3>
                <div class="login-form-item">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="user_email" value="<?php if (isset($_POST['submit'])) {
                                                                                            echo $user_email;
                                                                                        } ?>">
                    <?php
                    if (isset($_POST['submit'])) {
                        echo "<span class='text-danger'>" . $empty_email . "</span>";
                    }
                    ?>
                </div>
                <div class="login-form-item">
                    <label class="form-label">password</label>
                    <input type="password" class="form-control" name="user_password" value="<?php if (isset($_POST['submit'])) {
                                                                                                echo $user_password;
                                                                                            } ?>">
                    <?php
                    if (isset($_POST['submit'])) {
                        echo "<span class='text-danger'>" . $empty_password . "</span>";
                    }
                    ?>
                </div>
                <div class="login-form-item">
                    <button class="btn btn-success" name="submit">Login</button>
                </div>
                <h5 class="login-form-alert">Not have account? <a href="user.php">Register</a></h5>
            </form>
        </div>
    </section>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>