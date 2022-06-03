<?php
    session_start();
    if(!isset($_SESSION['zalogowany']))
    {
    header('Location: logtoadmin.php');
    exit();
    }
    require_once "dbinfo.php";
    $pdoAttributes = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    try {
    $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
    if(!isset($_POST['modlicencja']))
    {
        header('Location: admin.php');
        exit();
    }
    if(!is_numeric($_POST['modlicencja']))
    {
        $_SESSION['modyfikowanie'] = '<span style="color:red">Wprowadzony numer licencji nieprawidłowy</span>';
        header('Location: admin.php');
        exit();
    }
    $licencja = htmlentities($_POST['modlicencja'], ENT_QUOTES, "UTF-8");
    $q = "SELECT * FROM pilkarze WHERE licencja = :licencja";
    $query = $pdo->prepare($q);
    $query->bindParam(':licencja', $licencja);
    $query->execute();
    if($query->rowCount() != 1)
    {
        $_SESSION['modyfikowanie'] = '<span style="color:red">Piłkarz o podanej licencji nie istnieje!</span>';
        header('Location: admin.php');
        exit();
    }
    $result = $query->fetch();
    if($_POST['modimie'] != "") $imie = $_POST['modimie']; else $imie = $result['imie'];
    if($_POST['modnazwisko'] != "") $nazwisko = $_POST['modnazwisko']; else $nazwisko = $result['nazwisko'];
    if($_POST['modwiek'] != "") $wiek = $_POST['modwiek']; else $wiek = $result['wiek'];
    if($_POST['modobywatelstwo'] != "") $obywatelstwo = $_POST['modobywatelstwo']; else $obywatelstwo = $result['obywatelstwo'];
    if($_POST['modpozycja'] != "") $pozycja = $_POST['modpozycja']; else $pozycja = $result['pozycja'];
    if($_POST['modnumer_koszulki'] != "") $numer_koszulki = $_POST['modnumer_koszulki']; else $numer_koszulki = $result['numer_koszulki'];
    if(!is_numeric($wiek) or $wiek <= 0 or !is_numeric($numer_koszulki) or $numer_koszulki <= 0)
    {
        $_SESSION['modyfikowanie'] = '<span style="color:red">Wprowadzone dane nieprawidłowe!</span>';
        header('Location: admin.php');
        exit(); 
    }
    $imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
    $nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
    $wiek = htmlentities($wiek, ENT_QUOTES, "UTF-8");
    $obywatelstwo = htmlentities($obywatelstwo, ENT_QUOTES, "UTF-8");
    $pozycja = htmlentities($pozycja, ENT_QUOTES, "UTF-8");
    $numer_koszulki = htmlentities($numer_koszulki, ENT_QUOTES, "UTF-8");
    $q = "UPDATE pilkarze SET imie = :imie, nazwisko = :nazwisko, wiek = :wiek, obywatelstwo = :obywatelstwo, pozycja = :pozycja, numer_koszulki = :numer_koszulki WHERE licencja = :licencja";
    $query = $pdo->prepare($q);
    $query = $pdo->prepare($q);
    $query->bindParam(':imie', $imie);
    $query->bindParam(':nazwisko', $nazwisko);
    $query->bindParam(':licencja', $licencja);
    $query->bindParam(':wiek', $wiek);
    $query->bindParam(':licencja', $licencja);
    $query->bindParam(':obywatelstwo', $obywatelstwo);
    $query->bindParam(':pozycja', $pozycja);
    $query->bindParam(':numer_koszulki', $numer_koszulki);
    $query->execute();
    $_SESSION['modyfikowanie'] = "<span style='color:green'>Pomyślnie zmodyfikowano dane piłkarza o numerze licencji $licencja</span>";
    } catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
    } finally {
    $pdo = null;
    }
    header('Location: admin.php');
?>