<?php
require 'koneksi.php';
session_start(); // Pastikan session dimulai
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if($hitung>0){
        $_SESSION['log'] = 'true';
        header('location:index.php');
    }else{
        header('location:login.php');
    };
};

if(!isset($_SESSION['log'])){
    // User not logged in
} else {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Digital Store</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            /* CSS untuk loading circle */
            #loading {
                display: none; /* Sembunyikan secara default */
                position: fixed;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                z-index: 1000;
            }
        </style>
    </head>
    <body class="bg-dark">
        <div id="loading">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Digital Store</h3></div>
                                    <div class="card-body">
                                        <form method="POST" onsubmit="showLoading()">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="inputEmailAddress" type="text" placeholder="Enter your email" required />
                                                <label for="inputEmailAddress">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Enter your password" required />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="login" value="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Syawal Saputra Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            function showLoading() {
                console.log("Loading circle should appear now."); // Log untuk debugging
                document.getElementById('loading').style.display = 'block';
            }
        </script>
    </body>
</html>
