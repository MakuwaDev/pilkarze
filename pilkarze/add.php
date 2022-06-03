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
    if(!isset($_POST['addimie']))
    {
        header('Location: admin.php');
        exit();
    }
    if(!is_numeric($_POST['addwiek']) or $_POST['addwiek'] <= 0 or !is_numeric($_POST['addnumer_koszulki']) or $_POST['addnumer_koszulki'] <= 0)
    {
        if($_POST['addwiek'] == "" or $_POST['addnumer_koszulki'] == "" or $_POST['addimie'] == "" or $_POST['addnazwisko'] == "" or $_POST['addobywatelstwo'] == "" or $_POST['addpozycja'] == "")
        {
	    $_SESSION['dodawanie'] = '<span style="color:red">Wprowadzone dane nieprawidłowe!</span>';
	header('Location: admin.php');
	exit();	    
        }
    }
    $imie = $_POST['addimie'];
    $nazwisko = $_POST['addnazwisko'];
    $wiek = $_POST['addwiek'];
    $obywatelstwo = $_POST['addobywatelstwo'];
    $pozycja = $_POST['addpozycja'];
    $numer_koszulki = $_POST['addnumer_koszulki'];
    $imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
    $nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
    $wiek = htmlentities($wiek, ENT_QUOTES, "UTF-8");
    $obywatelstwo = htmlentities($obywatelstwo, ENT_QUOTES, "UTF-8");
    $pozycja = htmlentities($pozycja, ENT_QUOTES, "UTF-8");
    $numer_koszulki = htmlentities($numer_koszulki, ENT_QUOTES, "UTF-8");
    $q = "SELECT licencja FROM pilkarze ORDER BY licencja DESC LIMIT 1";
    $query = $pdo->prepare($q);
    $query->execute();
    $licencja = $query->fetchColumn() + 1;
    $q = "INSERT INTO pilkarze VALUES (:imie, :nazwisko, :wiek, :licencja, :obywatelstwo, :pozycja, :numer_koszulki)";
    $query = $pdo->prepare($q);
    $query->bindParam(':imie', $imie);
    $query->bindParam(':nazwisko', $nazwisko);
    $query->bindParam(':wiek', $wiek);
    $query->bindParam(':licencja', $licencja);
    $query->bindParam(':obywatelstwo', $obywatelstwo);
    $query->bindParam(':pozycja', $pozycja);
    $query->bindParam(':numer_koszulki', $numer_koszulki);
    $query->execute();
    $_SESSION['dodawanie'] = "<span style='color:green'>Pomyślnie dodano do bazy piłkarza o następujących danych: $imie $nazwisko $wiek $licencja $obywatelstwo $pozycja $numer_koszulki!</span>";
    } catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
    } finally {
    $pdo = null;
    }
    header('Location: admin.php');
?>