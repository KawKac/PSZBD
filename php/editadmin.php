<?php
$connect = @mysql_connect("localhost", "infoprem_szym", "szym15");
$select_db = @mysql_select_db("infoprem_szym");

$id_user = $_GET["id_user"];
$akcja = $_GET["akcja"];

$login = $_GET["login"];
$haslo = $_GET["haslo"];
$wiek = $_GET["wiek"];
$e_mail = $_GET["e_mail"];
$admin = $_GET["permission"];
$ban = $_GET["ban"];

if ($akcja=="zmiana" && $id_user!="")
{
    $update = mysql_query("UPDATE user SET login='$login', haslo='$haslo', wiek='$wiek', e_mail='$e_mail', permission='$admin', ban='$ban' WHERE id_user='$id_user';");
    if ($update)
    {
        ?><div class="infog"><?php echo "Zapisano pomyslnie."."</div>";
    }
    else
    {
        ?><div class="infob"><?php echo "Wystapil blad."."</div>";
    }
}

$select = mysql_query("SELECT * FROM user WHERE id_user='$id_user';");
$answer = mysql_fetch_array($select);
if ($answer[permission]==1)
{
    $cper1 = "checked";
}
else
{
    $cper0 = "checked";
}
if($answer[ban]==1)
{
    $cban1 = "checked";
}
else
{
    $cban0 = "checked";
}
echo <<<HTML
<meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2"/>
<title>EditAdmin</title>
<link rel="stylesheet" href="../css/editadmin.css" type="text/css"/>
<div id="edit">
    <form method="get" action="?">
        <input class="inpt" type="hidden" name="akcja" value="zmiana"/>
        <input class="inpt" type="hidden" name="id_user" value="$answer[id_user]"/>
        <div class="for">Login:<input class="inpt" type="text" name="login" value="$answer[login]"/><br/></div>
        <div class="for">Haslo:<input class="inpt" type="text" name="haslo" value="$answer[haslo]"/><br/></div>
        <div class="for">Wiek:<input class="inpt" type="test" name="wiek" value="$answer[wiek]"/><br/></div>
        <div class="for">E-mail:<input class="inpt" type="text" name="e_mail" value="$answer[e_mail]"/><br/></div><hr/>
        <div class="for">Uprawnienia:<br/>
        <input type="radio" name="permission" value="1" $cper1 />Administrator<br/>
        <input type="radio" name="permission" value="0" $cper0 />User<br/></div><hr/>
        <div class="for">Ban:<br/>
        <input type="radio" name="ban" value="1" $cban1 />Ban<br/>
        <input type="radio" name="ban" value="0" $cban0 />NotBan<br/><hr/>
        <div id="press"><input id="press" type="submit" value="Zapisz zmiany" /></div>
    </form>
    <div id="back"><a href="useradmin.php">Powrót</a></div>
</div>
HTML;
?>