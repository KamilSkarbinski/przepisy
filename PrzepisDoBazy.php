<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Dodaj przepis</title>
</head>

<body>
<?php
    if(isset($_POST['Dodaj_Przepis'])){
        $nazwa=$_POST['nazwa'];
        $obraz=$_POST['obraz'];
        $wart_odz=$_POST['wart_odz'];
        $opis=$_POST['opis'];
        $kategoria=$_POST['kategoria'];
        $zatwierdzone="1";

        $base=mysqli_connect("localhost", "root","","przepisowo");
        $sql = "INSERT INTO `przepisy` VALUES (NULL, '$nazwa', '$obraz', '$wart_odz', '$opis','$kategoria','$zatwierdzone',CURRENT_DATE() )";
        mysqli_query($base, $sql);
        $id_przepisu=mysqli_insert_id($base);
        foreach($_POST['id_skladnik'] as $id_skladnika){
            $ilosc=$_POST['il'.$id_skladnika];
            echo "<p>".$id_przepisu."=".$id_skladnika." ".$ilosc;
            // $sql = "INSERT INTO `skladniki_przepisy` VALUES (NULL,'$id_przepisu','$id_skladnika','$ilosc')";
            // mysqli_query($base, $sql);
    }
        mysqli_close($base);
        
        
    }
    ?>
</body>
</html>