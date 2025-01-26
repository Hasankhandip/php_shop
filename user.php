<?php
@include 'config.php';

$empmsg_firstname = $empmsg_lastname = $empmsg_email = $empmsg_password = $empmsg_pass_again = '';

if (isset($_POST['submit'])) {
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password_again = $_POST['user_password_again'];

    $md5_user_password = md5($user_password);

    if (empty($user_first_name)) {
        $empmsg_firstname = 'Fill up this field.';
    }
    if (empty($user_last_name)) {
        $empmsg_lastname = 'Fill up this field.';
    }
    if (empty($user_email)) {
        $empmsg_email = 'Fill up this field.';
    }
    if (empty($user_password)) {
        $empmsg_password = 'Fill up this field.';
    }
    if (empty($user_password_again)) {
        $empmsg_pass_again = 'Fill up this field.';
    }

    if (!empty($user_first_name) && !empty($user_last_name) && !empty($user_email) && !empty($user_password) && !empty($user_password_again)) {
        if ($user_password === $user_password_again) {
            $user_query = mysqli_query($conn, "INSERT INTO `users`(user_first_name,user_last_name,user_email,user_password) VALUES('$user_first_name','$user_last_name','$user_email','$md5_user_password')");
            if ($user_query) {
                header('location:login.php?usercreated');
            }
        } else {
            echo 'Password Not Match';
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
                <a href="login.php">Login <i class="fa-regular fa-user"></i></a>
            </nav>
            <div id="menu-btn" class="fas fa-bars"></div>

        </div>
    </header>


    <section class="login-section">
        <div class="container">

            <form action="user.php" method="post" class="login-form">
                <h3>User Register</h3>
                <div class="login-form-item">
                    <label class="form-label">First Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="user_first_name"
                        value="<?php if (isset($_POST['submit'])) {
                                    echo $user_first_name;
                                } ?>">
                    <?php
                    if (isset($_POST['submit'])) {
                        echo "<span class='text-danger'>" . $empmsg_firstname . "</span>";
                    }
                    ?>
                </div>
                <div class="login-form-item">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="user_last_name" value="<?php if (isset($_POST['submit'])) {
                                                                                                echo $user_last_name;
                                                                                            } ?>">
                    <?php
                    if (isset($_POST['submit'])) {
                        echo "<span class='text-danger'>" . $empmsg_lastname . "</span>";
                    }
                    ?>
                </div>
                <div class="login-form-item">
                    <label class="form-label">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        name="user_email"
                        value="<?php if (isset($_POST['submit'])) {
                                    echo $user_email;
                                } ?>">
                    <?php
                    if (isset($_POST['submit'])) {
                        echo "<span class='text-danger'>" . $empmsg_email . "</span>";
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
                        echo "<span class='text-danger'>" . $empmsg_password . "</span>";
                    }
                    ?>
                </div>
                <div class="login-form-item">
                    <label class="form-label">password again</label>
                    <input type="password" class="form-control" name="user_password_again" value="<?php if (isset($_POST['submit'])) {
                                                                                                        echo $user_password_again;
                                                                                                    } ?>">
                    <?php
                    if (isset($_POST['submit'])) {
                        echo "<span class='text-danger'>" . $empmsg_pass_again . "</span>";
                    }
                    ?>
                </div>
                <div class="login-form-item">
                    <button class="btn btn-success" name="submit">Register</button>
                </div>
                <h5 class="login-form-alert">have an account? <a href="login.php">Login</a></h5>
            </form>
        </div>
    </section>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>