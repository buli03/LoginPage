<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalogowano</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="gradient-custom" onload="loadCookies()">
<form action="index.php">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <h2 class="fw-bold mb-2 text-uppercase">Logged in.</h2>
                    <p class="text-white-50 mb-5">Click the button below to log out.</p>

                    <p class="text-white-50 " id="cookieLoginToLoad">Login:</p>
                <div class="mb-md-5 mt-md-4 pb-5">
                    <input class="btn btn-outline-light btn-lg px-5" type="submit" name="signOutSubmitBtn" value="Sign-out" onclick="usunCiasteczka()">
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $data_base = "baza_do_zadania_jsIphp";

        $conn = mysqli_connect($servername, $username, $password, $data_base);

        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        echo "";

        if (isset($_COOKIE['zalogowano'])==false) {
            $update_row = $conn ->query("UPDATE uzytkownicy SET lastSignOut = CURRENT_TIMESTAMP(0) WHERE login = '".$_COOKIE["login"]."';");
            header("Location: login.php");
        }

        echo '<style>.gradient-custom {background: #6a11cb;background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))}</style>';
        echo '<script>function usunCiasteczka() {document.cookie = "zalogowano=;path=/;max-age=0;";}</script>';
    
        echo "<script> function getCookie(cname) { let name = cname + '='; let decodedCookie = decodeURIComponent(document.cookie); let ca = decodedCookie.split(';'); for(let i = 0; i <ca.length; i++) { let c = ca[i]; while (c.charAt(0) == ' ') { c = c.substring(1); } if (c.indexOf(name) == 0) { return c.substring(name.length, c.length); } } return ''; } function loadCookies(){ document.getElementById('cookieLoginToLoad').innerHTML = 'Login: '+getCookie('login'); } </script>";
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>