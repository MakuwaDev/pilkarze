<?php
    session_start();
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
    header('Location: admin.php');
    exit();
    }
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="styl.css" type="text/css">
    <title>Logowanie do panelu administratora</title>
</head>
<body>
    <form action="zaloguj.php" method="post">
    <h1 class="napis"><span style="background-color:#111111;">LOGOWANIE</span></h1>
    <h3 class="po"><span style="background-color:#111111;">Login:</span></h3><br /> <input class="pole" type="text" name="login" /> <br />
    <h3 class="po"><span style="background-color:#111111;">Hasło:</span></h3> <br /> <input class="pole" type="password" name="haslo"/> <br /><br />
    <input class="guzik" type="submit" value="Zaloguj się!" />
    </form>
<?php
    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>
    <br></br>
    <button class="guzik" onclick="window.location.href='index.php'">Wróć na stronę główną</button>
</body>
</html>