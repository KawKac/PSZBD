<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$connect = @mysql_connect("localhost", "infoprem_szym", "szym15");
$select_db = @mysql_select_db("infoprem_szym");
if (!$select_db) { echo "Przerwa techniczna..."; }

if ($_GET["wyloguj"]==1)
{
    session_unset();
    session_destroy();
}

    
if ($_GET["akcja"]=="zaloguj")
{
    $name = $_POST["login"];
    $pass = $_POST["haslo"];
    $pass = md5($pass);
    $q = mysql_query("SELECT * FROM `user` WHERE login='$name' AND haslo='$pass'");
   
    if (mysql_num_rows($q)==1)
    {
        $per = mysql_fetch_array($q);
        $_SESSION["permission"] = $per[permission];
        $_SESSION["login"] = $name;
        if($per[ban]=='0')
        {
            $_SESSION["zalogowany"]="tak";
        }
        else
        {
            echo "<div class='infb'>"."Jestes zbanowany. Powtarzaj za mna: admin jest moim panem, admin rzadzi, admin ma zawsze racje."."</div>";
        }
    }
    else 
    {
        echo "<div class='infb'>"."Bledne dane."."</div>";
    }
}

if ($_SESSION["zalogowany"]!="tak")
{
echo <<<HTML
<div id="opcje"><div><a id="user" href="#" onclick="login()"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></div></div>
<div id="login">
    <div id="login2">
        <form action="?akcja=zaloguj" method="post">
            <div class="log">Login:<input class="inpt" type="text" name="login" placeholder="Login"/></div>
            <div class="log">Haslo:<input class="inpt" type="password" name="haslo" placeholder="Password"/></div>
            <div id="press"><input id="zaloguj" type="submit" value='Zaloguj'/></div>
            <div id="rejestracja"><a href="php/rejestracja.php"><span class="glyphicon glyphicon-user"></span> Rejestracja</a></div>
        </form>
    </div>
</div>
HTML;
include("news2.php");
}
else
{
    ?>
    <div class="infg"><?php echo "Zalogowany jako: ".$_SESSION["login"].".";?></div>
    <iframe id="chatt" src="./php/czat.php" scrolling="no"></iframe>
    <div id="opcje">
        <div><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></div>
        <div><a href="./php/dodajdomysql.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></div>
        <div><a id="c" href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a></div>
        <div><a href="?wyloguj=1;"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></div>
    <?php if($_SESSION["permission"]=='1')
    {
        echo "<div><a href='./php/useradmin.php'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></div>";
    }
    ?>
    </div>
    <?php
    include("news.php");
}
?>