<?php
session_start();
$log = $_SESSION["login"];
$connect = @mysql_connect("localhost", "infoprem_szym", "szym15") or die("Brak polaczenia z szym.");
$select_db = @mysql_select_db("infoprem_szym") or die("Brak polaczenia z baza.");
    
    
    if(isset($_POST['text']))
    {            
        $text = htmlspecialchars(mysql_real_escape_string($_POST['text']));
        $data = date("Y-m-d");
        $czas = date("G:i:s");
        $sql = "INSERT INTO czat SET login='$log', tresc='$text', data='$data', czas='$czas';";
        if($text != "")
        {
            @mysql_query($sql);
        }
    }
    function wypisz()
    {
        $query = "SELECT * FROM czat ORDER BY id_czat DESC;";
        $result = @mysql_query($query) or die("Blad pobrania wpisow z bazy.");
        echo "<div id='answ'>";
    
        while ($row = mysql_fetch_array($result))
        {
            $elogin = stripslashes($row['login']);
            $etxt = stripslashes($row['tresc']);
            $eczas = stripslashes($row['czas']);
            echo "<li class='bubble'>"."<p class='czatuzytkownik'>".$elogin.":"."</p>".$etxt. "<br><p class='godzina'>" .$eczas. "</p></li>";
        } 
        echo "</div>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2"/>
    <title>Czat</title>
    <link rel="stylesheet" href="../css/czat.css" type="text/css" />
</head>
<body>
    <div id="czat">
        <?php wypisz(); ?>
        <form action="?" method="post">
            <div id="info">
                <input id="inpt" type="text" name="text"/>
                <input id="press" type="submit" value="&#8629;"/>
            </div>
        </form>
    </div>
    </body>
</html>
