<?php
    session_start();
    if(isset($_SESSION['blad'])) unset($_SESSION['blad']);
?>
<!DOCTYPE HTML>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edege,chrome=1"/>
    <title>Piłkarze</title>
      <link rel="stylesheet" href="styl.css" type="text/css">
</head>
<body>
<?php
    require_once "dbinfo.php";
    $pdoAttributes = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    try {
        $pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
    $sort = "licencja";
        if(isset($_POST['lista']))
    {
        if($_POST['lista'] == 'dom') $sort = "licencja";
        if($_POST['lista'] == 'imieasc') $sort = "imie ASC";
        if($_POST['lista'] == 'imiedsc') $sort = "imie DESC";
        if($_POST['lista'] == 'nazwiskoasc') $sort = "nazwisko ASC";
        if($_POST['lista'] == 'nazwiskodsc') $sort = "nazwisko DESC";
        if($_POST['lista'] == 'alfasc') $sort = "imie ASC, nazwisko ASC";
        if($_POST['lista'] == 'alfdsc') $sort = "imie DESC, nazwisko DESC";
        if($_POST['lista'] == 'koszasc') $sort = "numer_koszulki ASC";
        if($_POST['lista'] == 'koszdsc') $sort = "numer_koszulki DESC";
        if($_POST['lista'] == 'wiekasc') $sort = "wiek ASC";
        if($_POST['lista'] == 'wiekdsc') $sort = "wiek DESC";
        if($_POST['lista'] == 'krajasc') $sort = "obywatelstwo ASC";
        if($_POST['lista'] == 'krajdsc') $sort = "obywatelstwo DESC";
    } else $sort = "licencja";
    $fimie = "";
    $fnazwisko = "";
    $fwiek= "";
    $flicencja = "";
    $fobywatelstwo = "";
    $fpozycja = "";
    $fnumer_koszulki = "";
    if(isset($_POST['imie'])) $fimie = $_POST['imie'];
    if(isset($_POST['nazwisko'])) $fnazwisko = $_POST['nazwisko'];
    if(isset($_POST['wiek'])) $fwiek = $_POST['wiek'];
    if(isset($_POST['licencja'])) $flicencja = $_POST['licencja'];
    if(isset($_POST['obywatelstwo'])) $fobywatelstwo = $_POST['obywatelstwo'];
    if(isset($_POST['pozycja'])) $fpozycja = $_POST['pozycja'];
    if(isset($_POST['numer_koszulki'])) $fnumer_koszulki = $_POST['numer_koszulki'];
    $fimie = htmlentities($fimie, ENT_QUOTES, "UTF-8");
    $fnazwisko = htmlentities($fnazwisko, ENT_QUOTES, "UTF-8");
    $fwiek = htmlentities($fwiek, ENT_QUOTES, "UTF-8");
    $flicencja = htmlentities($flicencja, ENT_QUOTES, "UTF-8");
    $fobywatelstwo = htmlentities($fobywatelstwo, ENT_QUOTES, "UTF-8");
    $fpozycja = htmlentities($fpozycja, ENT_QUOTES, "UTF-8");
    $fnumer_koszulki = htmlentities($fnumer_koszulki, ENT_QUOTES, "UTF-8");
?>
    <button onclick="window.location.href='logtoadmin.php'">Panel Admina</button>
    <h1 class="napis"><span style="background-color:#111111;">SUPER PIŁKARZE</span></h1>
    <h3 class="po"><span style="background-color:#111111;">Wybór Sortowania</span></h3>
    <form action="index.php" method="post">
    <input type="hidden" name="imie" value="<?php if(isset($_POST['imie'])) echo $_POST['imie']?>"/>
    <input type="hidden" name="nazwisko" value="<?php if(isset($_POST['nazwisko'])) echo $_POST['nazwisko']?>"/>
    <input type="hidden" name="wiek" value="<?php if(isset($_POST['wiek'])) echo $_POST['wiek']?>"/>
    <input type="hidden" name="licencja" value="<?php if(isset($_POST['licencja'])) echo $_POST['licencja']?>"/>
    <input type="hidden" name="obywatelstwo" value="<?php if(isset($_POST['obywatelstwo'])) echo $_POST['obywatelstwo']?>"/>
    <input type="hidden" name="pozycja" value="<?php if(isset($_POST['pozycja'])) echo $_POST['pozycja']?>"/>
    <input type="hidden" name="numer_koszulki" value="<?php if(isset($_POST['numer_koszulki'])) echo $_POST['numer_koszulki']?>"/>
    <div>
        <select style='font-size: 30px'; name="lista" id="wgtmsr">
        <option value="dom" <?php if($sort == 'licencja') echo "selected"; ?>>Domyślnie</option>
        <option value="imieasc" <?php if($sort == 'imie ASC') echo "selected"; ?>>Po imieniu rosnąco</option>
        <option value="imiedsc" <?php if($sort == 'imie DESC') echo "selected"; ?>>Po imieniu malejąco</option>
        <option value="nazwiskoasc" <?php if($sort == 'nazwisko ASC') echo "selected"; ?>>Po nazwisku rosnąco</option>
        <option value="nazwiskodsc" <?php if($sort == 'nazwisko DESC') echo "selected"; ?>>Po nazwisku malejąco</option>
        <option value="alfasc" <?php if($sort == 'imie ASC, nazwisko ASC') echo "selected"; ?>>Po imieniu i nazwisku rosnąco</option>
        <option value="alfdsc" <?php if($sort == 'imie DESC, nazwisko DESC') echo "selected"; ?>>Po imieniu i nazwisku malejąco</option>
        <option value="koszasc" <?php if($sort == 'numer_koszulki ASC') echo "selected"; ?>>Po numerze koszulki rosnąco</option>
        <option value="koszdsc" <?php if($sort == 'numer_koszulki DESC') echo "selected"; ?>>Po numerze koszulki malejąco</option>
        <option value="wiekasc" <?php if($sort == 'wiek ASC') echo "selected"; ?>>Po wieku rosnąco</option>
        <option value="wiekdsc" <?php if($sort == 'wiek DESC') echo "selected"; ?>>Po wieku malejąco</option>
        <option value="krajasc" <?php if($sort == 'obywatelstwo ASC') echo "selected"; ?>>Po kraju pochodzenia rosnąco</option>
        <option value="krajdsc" <?php if($sort == 'obywatelstwo DESC') echo "selected"; ?>>Po kraju pochodzenia malejąco</option>
        </select>
    </div>
    <div>
    <input class="przyc" type="submit" value="Sortuj!"/>
    </div>
   </form>
   <form action="index.php" method="post">
   <input type="hidden" name="lista" value = "<?php if(isset($_POST['lista'])) echo $_POST['lista']; else echo 'licencja';?>"/>
   <div>
    <input name="imie" type="text" placeholder="Filtruj imiona" <?php if($fimie != "") echo "value='$fimie'" ?>/>
    <input name="nazwisko" type="text" placeholder="Filtruj nazwiska" <?php if($fnazwisko != "") echo "value='$fnazwisko'" ?>/>
    <input name="wiek" type="text" placeholder="Filtruj wiek" <?php if($fwiek != "") echo "value='$fwiek'" ?>/>
    <input name="licencja" type="text" placeholder="Filtruj licencje" <?php if($flicencja != "") echo "value='$flicencja'" ?>/>
    <input name="obywatelstwo" type="text" placeholder="Filtruj kraj pochodzenia" <?php if($fobywatelstwo != "") echo "value='$fobywatelstwo'" ?>/>
    <input name="pozycja" type="text" placeholder="Filtruj pozycje" <?php if($fpozycja != "") echo "value='$fpozycja'" ?>/>
    <input name="numer_koszulki" type="text" placeholder="Filtruj numer koszulki" <?php if($fnumer_koszulki != "") echo "value='$fnumer_koszulki'" ?>/>
    <input type="submit" value="Zastosuj filtry!"/>
   </div>
   </form>
<?php
    
    echo "
    <table class='tab'>
    <thead>
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Wiek</th>
        <th>Numer licencji</th>
        <th>Kraj pochodzenia</th>
        <th>Pozycja</th>
        <th>Numer koszulki</th>
    </tr>
    </thead>
    <tbody>";
    $q = "SELECT * FROM pilkarze WHERE LOWER(imie) LIKE'%$fimie%' AND LOWER(nazwisko) LIKE '%$fnazwisko%' AND LOWER(wiek) LIKE '%$fwiek%' AND LOWER(licencja) LIKE '%$flicencja%' AND LOWER(obywatelstwo) LIKE '%$fobywatelstwo%' AND LOWER(pozycja) LIKE '%$fpozycja%' AND LOWER(numer_koszulki) LIKE '%$fnumer_koszulki%' ORDER BY $sort";
    $zapytanie = $pdo->prepare($q);
    $zapytanie->bindParam(':fimie', $fimie);
    $zapytanie->bindParam(':fnazwisko', $fnazwisko);
    $zapytanie->bindParam(':fwiek', $fwiek);
    $zapytanie->bindParam(':flicencja', $flicencja);
    $zapytanie->bindParam(':fobywatelstwo', $fobywatelstwo);
    $zapytanie->bindParam(':fpozycja', $fpozycja,);
    $zapytanie->bindParam(':fnumer_koszulki', $fnumer_koszulki,);
    $zapytanie->execute();
    $wynik = $zapytanie->fetchAll();
        foreach($wynik as $wiersz)
        {
          echo "<tr>
          <td>".$wiersz['imie']."</td>
          <td>".$wiersz['nazwisko']."</td>
          <td>".$wiersz['wiek']."</td>
          <td>".$wiersz['licencja']."</td>
          <td>".$wiersz['obywatelstwo']."</td>
          <td>".$wiersz['pozycja']."</td>
          <td>".$wiersz['numer_koszulki']."</td>"
         ."</tr>";
        }
    echo "</tbody>
        </table>";
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    } finally {
        $pdo = null;
    }
?>
</body>
</html>
