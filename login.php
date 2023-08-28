<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body onload="usunLogin()">
    <form class="vh-100 gradient-custom" action="login.php" method="post">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                    <div class="form-outline form-white mb-4">
                        <input type="login" name="login" id="login" class="form-control form-control-lg" />
                        <label class="form-label" for="typeEmailX">Login</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input type="password" name="haslo" id="haslo" class="form-control form-control-lg" />
                        <label class="form-label" for="typePasswordX">Password</label>
                    </div>

                    <input class="btn btn-outline-light btn-lg px-5" type="submit" name="send_Submit" value="Log-in">

                    <div style="color: red" id="errorBox">
                    </div>

                    <div style="margin-top: 15px;">
                        <p>You don't have an account? <a href="rejestracja.php">Register here!</a></p>
                    </div>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </form> 

    <?php
        echo '<style>.gradient-custom {background: #6a11cb;background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))}</style>';

        $servername = "localhost";
        $username = "root";
        $password = "";
        $data_base = "baza_do_zadania_jsIphp";

        $conn = mysqli_connect($servername, $username, $password, $data_base);

        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        echo "";

        @$login = $_POST["login"];
        @$haslo = $_POST["haslo"];

        if (isset($_POST["send_Submit"])) {

            if (checkLoginAndPassword($login,$haslo)==1) {
                setcookie("zalogowano","1",time()+60*60*7,"/");
                setcookie("login","$login",time()+60*60*7,"/");
                $update_row = $conn ->query("UPDATE uzytkownicy SET ilosc_logowan = ilosc_logowan + 1, lastLogin = CURRENT_TIMESTAMP(0) WHERE login = '".$login."';");
                header("Location:index.php");
            }
            else {
                echo '<script>document.getElementById("errorBox").innerHTML="User with given login and password doesnt exist!"</script>';
                
            }
        }

        function checkLoginAndPassword($toCheckLogin,$toCheckPassword){
            $zapytanie_znajdzUzytkownika = "SELECT login,password FROM uzytkownicy WHERE login='".$toCheckLogin."' AND password='".$toCheckPassword."';";
            $znajdzUzytkownika = mysqli_query(mysqli_connect("localhost","root","","baza_do_zadania_jsIphp"),$zapytanie_znajdzUzytkownika);

            if($znajdzUzytkownika->num_rows>=1)
                return 1;
            else
                return 0;
        }

        echo '<script>function usunLogin() {document.cookie = "login=;path=/;max-age=0;";}</script>';
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>