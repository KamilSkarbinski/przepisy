<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Usuń przepis</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<section class="sekcja1">
<ul class="lista1">
            <li><a id="list1" href="glowna.php">Strona główna</a></li>
            <li><a id="list1" href="Dodajdobazyadmin.php">Dodaj do bazy</a></li>
            <li><a id="list1" href="Usunzbazyadmin.php">Usuń z bazy</a></li>
        </ul>
</br>
</br>
<div id="uklad">
    <div id="przepis">
    <form method="POST" action="Usunzbazyadmin.php">
            <p>Wybierz przepis do usunięcia:</p>
                    <select name="usun_przepis">
            <?php
            $baza=mysqli_connect("localhost","root","","przepisowo");
            $sql="SELECT id_przepisu,nazwa from `przepisy`";
            $result = mysqli_query($baza,$sql);
            while($row=mysqli_fetch_array($result)){
                echo "<option value=\"$row[0]\">$row[1]</option>\n";
            }
            mysqli_close($baza);
        ?>
          <input type="submit" name="Usun-Prz" value="Usuń">
    </form>
        </div>
        <div id="kategoria">
    <p>Wybierz kategorię do usunięcia:</p>
                    <select name="usun_kategorie">
            <?php
            $baza=mysqli_connect("localhost","root","","przepisowo");
            $sql="SELECT id_kategorii,nazwa_kategorii from `kategoria`";
            $result = mysqli_query($baza,$sql);
            while($row=mysqli_fetch_array($result)){
                echo "<option value=\"$row[0]\">$row[1]</option>\n";
            }
            mysqli_close($baza);
        ?>
          <input type="submit" name="Usun-Kat" value="Usuń">
    </form>
    </div>
    <div id="skladnik">
    <p>Wybierz składnik do usunięcia:</p>
                    <select name="usun_skladnik">
            <?php
            $baza=mysqli_connect("localhost","root","","przepisowo");
            $sql="SELECT id_skladnika,nazwa from `skladniki`";
            $result = mysqli_query($baza,$sql);
            while($row=mysqli_fetch_array($result)){
                echo "<option value=\"$row[0]\">$row[1]</option>\n";
            }
            mysqli_close($baza);
        ?>
          <input type="submit" name="Usun-Skl" value="Usuń">
    </form>
        </form>
        </section>
</body>

</html>

<?php
    if(isset($_POST['Usun-Prz'])){
        $del=$_POST['usun_przepis'];

        $base=mysqli_connect("localhost", "root","","przepisowo");
        $sql = "DELETE FROM `przepisy` WHERE `przepisy`.`id_przepisu` = $del";
        mysqli_query($base, $sql);
        mysqli_close($base);

        header('location:Usunzbazyadmin.php');
    }
    if(isset($_POST['Usun-Kat'])){
        $del=$_POST['usun_kategorie'];

        $base=mysqli_connect("localhost", "root","","przepisowo");
        $sql = "DELETE FROM `kategoria` WHERE `kategoria`.`id_kategorii` = $del";
        mysqli_query($base, $sql);
        mysqli_close($base);

        header('location:Usunzbazyadmin.php');
    }
    if(isset($_POST['Usun-Skl'])){
        $del=$_POST['usun_skladnik'];

        $base=mysqli_connect("localhost", "root","","przepisowo");
        $sql = "DELETE FROM `skladniki` WHERE `skladniki`.`id_przepisu` = $del";
        mysqli_query($base, $sql);
        mysqli_close($base);

        header('location:Usunzbazyadmin.php');
    }
?>