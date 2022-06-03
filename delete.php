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
    if(!isset($_POST['id']))
    {
        header('Location: admin.php');
        exit();
    }
    if(!is_numeric($_POST['id']))
    {
        $_SESSION['usuwanie'] = '<span style="color:red">Wprowadzony numer licencji nieprawidłowy!</span>';
        header('Location: admin.php');
        exit();
    }
    $id = $_POST['id'];
    $id = htmlentities($id, ENT_QUOTES, "UTF-8");
    echo "$id";
    $q = "SELECT * FROM pilkarze WHERE licencja = :id";
    $query = $pdo->prepare($q);
    $query->bindParam(':id', $id);
    $query->execute();
    if($query->rowCount() == 0)
    {
        $_SESSION['usuwanie'] = '<span style="color:red">Piłkarz o podanej licencji nie istnieje!</span>';
        header('Location: admin.php');
        exit();
    }
    $q = "DELETE FROM pilkarze WHERE licencja = :id";
    $query = $pdo->prepare($q);
    $query->bindParam(':id', $id);
    $query->execute();
    $_SESSION['usuwanie'] = "<span style='color:green'>Pomyślnie usunięto z bazy piłkarza o numerze licencji $id!</span>";
    } catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
    } finally {
    $pdo = null;
    }
    header('Location: admin.php');
?>