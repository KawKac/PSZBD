<?php
$connect = @mysql_connect("localhost", "infoprem_szym", "szym15");
$select_db = @mysql_select_db("infoprem_szym");

$id_news = $_GET["id_news"];
$akcja = $_GET["akcja"];

$tytul = $_GET["tytul"];
$tresc = $_GET["tresc"];
$filtr = $_GET["filtr"];

if ($akcja=="zmiana" && $id_news!="")
{
    $update = mysql_query("UPDATE news SET tytul='$tytul', tresc='$tresc', filtr='$filtr' WHERE id_news='$id_news';");
    if ($update)
    {
        ?><div class="infog"><?php echo "Zapisano pomyslnie."."</div>";
    }
    else
    {
        ?><div class="infob"><?php echo "Wystapil blad."."</div>";
    }  
}

$select = mysql_query("SELECT * FROM news WHERE id_news='$id_news';");
$answer = mysql_fetch_array($select);
if ($answer[filtr]=="zeswiata") {$checked0 = "checked";} elseif($answer[filtr]=="zkraju") {$checked1 = "checked";} elseif($answer[filtr]=="sport") {$checked2 = "checked";}
elseif($answer[filtr]=="gry") {$checked3 = "checked";}
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/edit.css" type="text/css"/>
    <link rel="stylesheet" href="../css/ladowanie.css" type="text/css"/>
    <script type="text/javascript" language="javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/application.js"></script>
</head>
    <body>
    <div id="preloader">
        <div id="image">
            <div id="load">£ADOWANIE</div>
        </div>
    </div>

    <div id="edit">
        <form action="?" method="get">
            <input type="hidden" name="akcja" value="zmiana"/>
            <input type="hidden" name="id_news" value="$answer[id_news]"/>
            Tytul:<br/>
            <textarea id="tytul" name="tytul">$answer[tytul]</textarea><br/>
            Tresc:<br/>
            <textarea id="tresc" name="tresc">$answer[tresc]</textarea><br/>
            Filtr:<br/>
            <input class="rad" type="radio" name="filtr" value="zeswiata" $checked0/>Ze swiata<br/>
            <input class="rad" type="radio" name="filtr" value="zkraju" $checked1/>Z kraju<br/>
            <input class="rad" type="radio" name="filtr" value="sport" $checked2/>Sport<br/>
            <input class="rad" type="radio" name="filtr" value="gry" $checked3/>Gry<br/>
            <input class="press" type="submit" value="Zapisz"/>
            <a id="back" href="../index.php">Powrót</a>
        </form>
    </div>
</body>
</html>
HTML;
?>