<?php
    session_start();
    if (!isset($_SESSION['zalogowany']))
    {
    header('Location: logtoadmin.php');
    exit();
    }
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Panel Admina</title>
    <link rel="stylesheet" href="styl2.css" type="text/css">
</head>
<body>
    <h1 class="napis"><span>WITAJ ADMINIE</span></h1>
    <h3 class="po"><a href='logout.php'>Wyloguj się!</a> </h3>
    <button onclick="window.location.href='index.php'">Wróć na stronę główną</button>
    <br></br>
    <form action ="delete.php" method="post">
    <input name="id" type="text" placeholder="Numer Licencji"/>
    <input type="submit" value="Usuń!"/>
    </form>
<?php
    if(isset($_SESSION['usuwanie']))
    {
    echo $_SESSION['usuwanie'];
    unset($_SESSION['usuwanie']);
    }
?>
    <br><br>
    <form action="add.php" method="post">
    <input name="addimie" type="text" placeholder="Imie"/>
    <input name="addnazwisko" type="text" placeholder="Nazwisko"/>
    <input name="addwiek" type="text" placeholder="Wiek"/>
    <input name="addobywatelstwo" type="text" placeholder="Kraj pochodzenia"/>
    <select name="addpozycja">
        <option value="" selected>Pozycja</option>
        <option value="Bramkarz">Bramkarz</option>
        <option value="Defensor">Defensor</option>
        <option value="Pomocnik">Pomocnik</option>
        <option value="Napastnik">Napastnik</option>
    </select>
    <input name="addnumer_koszulki" type="text" placeholder="Numer Koszulki"/>
    <input type="submit" value="Dodaj Piłkarza!"/>
    </form>
<?php
    if(isset($_SESSION['dodawanie']))
    {
    echo $_SESSION['dodawanie'];
    unset($_SESSION['dodawanie']);
    }
?>
    <br><br>
    <form action="modify.php" method="post">
    <input name="modlicencja" type="text" placeholder="Numer Licencji" value=""/>
    <input name="modimie" type="text" placeholder="Imie" value=""/>
    <input name="modnazwisko" type="text" placeholder="Nazwisko" value=""/>
    <input name="modwiek" type="text" placeholder="Wiek" value=""/>
    <input name="modobywatelstwo" type="text" placeholder="Kraj pochodzenia" value=""/>
    <select name="modpozycja">
        <option value="" selected>Pozycja</option>
        <option value="Bramkarz">Bramkarz</option>
        <option value="Defensor">Defensor</option>
        <option value="Pomocnik">Pomocnik</option>
        <option value="Napastnik">Napastnik</option>
    </select>
    <input name="modnumer_koszulki" type="text" placeholder="Numer Koszulki" value=""/>
    <input type="submit" value="Modyfikuj Piłkarza!"/>
    </form>
<?php
    if(isset($_SESSION['modyfikowanie']))
    {
    echo $_SESSION['modyfikowanie'];
    unset($_SESSION['modyfikowanie']);
    }
?>
</body>
</html>