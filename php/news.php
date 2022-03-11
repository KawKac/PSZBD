<?php
session_start();
$log = $_SESSION["login"];
$connect = @mysql_connect("localhost", "infoprem_szym", "szym15");
$select_db = @mysql_select_db("infoprem_szym");
if (!$select_db) { echo "Przerwa techniczna..."; }
    
/* Usun news */

if($_GET["usun"]!="")
{
    $usun = $_GET["usun"];
    $delete = mysql_query("DELETE FROM news WHERE id_news='$usun';");
    if ($delete)
    {
        ?><div class="infog"><?php echo "News usuniety."."</div>"; 
    }
}

/* Usun komentarz */

if($_GET["delete"]!="")
{
    $delete = $_GET["delete"];
    $del = mysql_query("DELETE FROM comment WHERE id_comment='$delete';");
    if ($del)
    {
        ?><div class="infog"><?php echo "Komentarz usuniety."."</div>"; 
    }
}

/* Filtry */

$phpfiltr = $_GET["filtrphp"];

if($phpfiltr=='wszystkie' OR $phpfiltr=='')
{
    $select = mysql_query("SELECT * FROM `news`;");
}
else
{
    $select = mysql_query("SELECT * FROM `news` WHERE filtr='$phpfiltr';");
}

/* Komentarze */

$tresc = $_POST['comment'];
$idnews = $_POST['idnews'];
$data = date("Y-m-d");
$czas = date("G:i:s");
if($tresc != "")
{
    $q = @mysql_query("INSERT INTO comment SET login='$log', tresc='$tresc', data='$data', czas='$czas', id_news='$idnews';"); 
}

/* Wypisz newsy */

while($answer=mysql_fetch_array($select))
{
    echo "<div class='news'>
            <p class='tytul'>$answer[tytul]</p>
            $answer[tresc]
            <p class='date'>$answer[date]</p>";
    if($log == $answer[login] || $_SESSION[permission] == '1')
    {
        echo "<div class='lewa'><a href='./php/edit.php?id_news=$answer[id_news]' >Edytuj</a>
        <a href='?usun=$answer[id_news]'>Usuñ</a></div>";
    }

/* Wypisz komentarze */    
    
    $sel = mysql_query("SELECT * FROM `comment` WHERE id_news='$answer[id_news]';");
    while($write = mysql_fetch_array($sel))
    {
        echo "<div class='comment'>
            <p class='login'>$write[login]:</p>
            <p class='contents'>$write[tresc]</p>";
        if($log == $write[login] || $_SESSION[permission] == '1')
        {
           echo "<div id='del'><a href='?delete=$write[id_comment]'>Usuñ komentarz</a></div>";
        }   
        echo "</div>";
    }
    
/* Dodaj komentarz */    
    
        echo "<div id='addcom'>
            <form action='?' method='post'>
                <input type='hidden' name='idnews' value='$answer[id_news]'/> 
                <input class='inpt' type='text' name='comment' placeholder='Dodaj komentarz'/>
                <input id='press' type='submit' value='Skomentuj'/>
            </form>
        </div>
        </div>";
}
?>
