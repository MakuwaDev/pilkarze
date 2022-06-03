<?php
    session_start();
    if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
    {
    header('Location: logtoadmin.php');
    exit();
    }
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    if($login=="pasja" and $haslo=="informatyki")
    {
    $_SESSION['zalogowany'] = true;
    unset($_SESSION['blad']);
    header('Location: admin.php');
    } else {
    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
    header('Location: logtoadmin.php');
       }
?>