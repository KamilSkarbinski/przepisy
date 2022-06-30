<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Dodaj przepis</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<style>
input[id=ilosc]{
    width: 20px;
} 
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
/* Żeby usunąć strzałki przy number */
}
</style>
    
    <ul>
        <li><a href="glowna.php">Strona główna</a></li>
        <li><a href="Dodajdobazyadmin.php">Dodaj do bazy</a></li>
        <li><a href="Usunzbazyadmin.php">Usuń z bazy</a></li>
    </ui>
        <h2>Dodaj przepis do bazy danych</h2>
        <form method="POST" action="">
        <table>
            <tr>
                <td><input type="text" name="nazwa" cols="50" placeholder="nazwa przepisu"></td>
            </tr>
            <tr>
                <td><input type="text" name="obraz" cols="50" placeholder="Url obrazka"></td>
            </tr>
            <tr>
                <td><textarea cols="50" rows="15" name="opis" placeholder="Opis przepisu"></textarea></td>
            </tr>
            <tr>
                <td><input type="number" size="10" name="wart_odz"  placeholder="Wartości odżywcze w cal"></td>
            </tr>
            <tr>
                <td><p>Wybierz kategorię:</p>
                    <select name="kategoria">
                <?php
            $baza=mysqli_connect("localhost","root","","przepisowo");
            $sql="select * from `kategoria`";
            $result = mysqli_query($baza,$sql);
            while($row=mysqli_fetch_array($result)){
                echo "<option value=\"$row[0]\">$row[1]</option>\n";
            }
            mysqli_close($baza);
        ?>
        </td></tr>
        <tr>
        <td><p>Wybierz składniki:</p>
            <table>
            <tr> <th> </th><th>ilość</th><th>nazwa</th></tr>
                    <checkbox name="skladniki">
                <?php
            $baza=mysqli_connect("localhost","root","","przepisowo");
            $sql="select * from `skladniki`";
            $result = mysqli_query($baza,$sql);
            while($row=mysqli_fetch_array($result)){
                echo "<tr><td><input type='checkbox' value=\"$row[0]\" name=id_skladnik[]></td><td><input type='number' name='il$row[0]' id='ilosc'></td><td> $row[1]</td></tr>";
            }
            mysqli_close($baza);
        ?>
        </table>
        </td>
            </tr>
            <tr>
                <br>
                <td><br>
                    <input type="submit" name="Dodaj_Przepis" value="Dodaj przepis">
                </td>
            </tr>
        </table>
    </form>
    <h2>Dodaj skladnik do bazy danych</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td><input type="text" name="nazwa_skl" cols="50" placeholder="Nazwa skladnika"></td>
            </tr>
            
            <tr>
                <td><input type="number" name="cena"  placeholder="Cena"></td>
            </tr>
        </table>
        </td>
            </tr>
            <tr>
                <br>
                <td><br>
                    <input type="submit" name="Dodaj_skladnik" value="Dodaj skladnik">
                </td>
            </tr>
        </table>
    </form>
    <h2>Dodaj kategorię do bazy danych</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td><input type="text" name="nazwa_kat" cols="50" placeholder="Nazwa kategorii"></td>
            </tr>
        </table>
        </td>
            </tr>
            <tr>
                <br>
                <td><br>
                    <input type="submit" name="Dodaj_kategorie" value="Dodaj kategorię">
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>

<?php
    if(isset($_POST['Dodaj_Przepis'])){
        $nazwa=$_POST['nazwa'];
        $obraz=$_POST['obraz'];
        $wart_odz=$_POST['wart_odz'];
        $opis=$_POST['opis'];
        $kategoria=$_POST['kategoria'];

        $base=mysqli_connect("localhost", "root","","przepisowo");
        $sql = "INSERT INTO `przepisy` VALUES (NULL, '$nazwa', '$obraz', '$wart_odz', '$opis','$kategoria',CURRENT_DATE() )";
        mysqli_query($base, $sql);
        $id_przepisu=mysqli_insert_id($base);
        
        foreach($_POST['id_skladnik'] as $id_skladnika){
            if($_POST['il'.$id_skladnika]>0){
            $ilosc=$_POST['il'.$id_skladnika];
            }else{$ilosc=1;}
            $sql = "INSERT INTO `skladniki_przepisy` VALUES (NULL,'$id_przepisu','$id_skladnika','$ilosc')";
            mysqli_query($base, $sql);
    }
        mysqli_close($base);
        
        header('location:Dodajdobazyadmin.php');
    }
    if(isset($_POST['Dodaj_skladnik'])){
        $nazwa_sk=$_POST['nazwa_skl'];
        $cena=$_POST['cena'];

        $base=mysqli_connect("localhost", "root","","przepisowo");
        $sql = "INSERT INTO `skladniki` VALUES (NULL, '$nazwa_sk', '$cena')";
        mysqli_query($base, $sql);
        mysqli_close($base);
        header('location:Dodajdobazyadmin.php');
    }
    if(isset($_POST['Dodaj_kategorie'])){
        $nazwa_kat=$_POST['nazwa_kat'];

        $base=mysqli_connect("localhost", "root","","przepisowo");
        $sql = "INSERT INTO `kategoria` VALUES (NULL, '$nazwa_kat')";
        mysqli_query($base, $sql);
        mysqli_close($base);
        header('location:Dodajdobazyadmin.php');
    }
?>