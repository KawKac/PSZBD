<?php
$connect = @mysql_connect("localhost", "infoprem_szym", "szym15");
$select_db = @mysql_select_db("infoprem_szym");
if (!$select_db) { echo "Przerwa techniczna..."; }

if ($_GET["usun"]!="")
{
    $usun = $_GET["usun"];
    $delete = mysql_query("DELETE FROM user WHERE id_user='$usun';");
    if ($delete)
    {
        ?><div class="infogdo"><?php echo "U¿ytkownik usuniety!"."</div>";
    }
    else
    {
        ?><div class="infobdo"><?php echo "Wystapil blad!"."</div>";
    }
}

if(isset ($_POST['login'], $_POST['haslo'], $_POST['haslo2'], $_POST['wiek'], $_POST['e_mail']))
{
    $login = $_POST["login"];
    $haslo = md5($_POST["haslo"]);
    $haslo2 = md5($_POST["haslo2"]);
    $wiek = $_POST["wiek"];
    $e_mail = $_POST["e_mail"];
    $per = $_POST["permission"];
    $l = mysql_query("SELECT * FROM user WHERE login='$login';");
    $e = mysql_query("SELECT * FROM user WHERE e_mail='$e_mail';");
    
    if($login!="" && $haslo!="")
    {
        if(mysql_num_rows($l)!=1  && mysql_num_rows($e)!=1)
        {
            if($haslo == $haslo2)
            {
                if(preg_match('/^[0-9]+$/', $wiek) && $wiek>=18)
                {
                    if(filter_var($e_mail, FILTER_VALIDATE_EMAIL)== TRUE)
                    {
                        $insert = mysql_query("INSERT INTO user SET login='$login', haslo='$haslo', wiek='$wiek', e_mail='$e_mail', permission='$per', ban='0';");
                        if($insert){?><div class="infog"><?php echo "Utworzono usera."."</div>";}
                    }
                    else
                    {
                        ?><div class="infob"><?php echo "Niepoprawny e_mail."."</div>";
                    }
                }
                else
                {
                    ?><div class="infob"><?php echo "Wiek ma byc liczba>18."."</div>";
                }
            }
            else
            {
                ?><div class="infob"><?php echo "Hasla sa ró¿ne."."</div>";
            }
        }
        else
        {
            ?><div class="infob"><?php echo "U¿ytkownik ju¿ istnieje."."</div>";
        }
    }
    else
    { 
        ?><div class="infob"><?php echo "Brak loginu lub hasla."."</div>";
    }
}
else
{
    ?><div class="infob">
    <?php
    echo "Nie podano danych."."</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta HTTP-EQUIV="content-type" CONTENT="text/html charset=iso-8859-2"/>
    <title>UserAdmin</title>
    <link rel="stylesheet" href="../css/useradmin.css" type="text/css"/>
</head>
<body>
    <div id="div">
        <form method="post" action="?"> 
            <div class="for">Login:<input class="inpt" type="text" name="login"/><br/></div>
            <div class="for">Haslo:<input class="inpt" type="password" name="haslo"/><br/></div>
            <div class="for">Powtórz haslo:<input class="inpt" type="password" name="haslo2"/><br/></div>
            <div class="for">Wiek:<input class="inpt" type="test" name="wiek"/><br/></div>
            <div class="for">E-mail:<input class="inpt" type="text" name="e_mail"/><br/></div><hr/>
            <div class="for">Uprawnienia:<br/>
            <input type="radio" name="permission" value="1"/>Administrator<br/>
            <input type="radio" name="permission" value="0"/>User<br/></div><hr/>
            <div id="press"><input id="press" type="submit" value="Dodaj"/></div>
        </form>
        <div id="back"><a href="../index.php">Powrót</a></div>
    </div>
    <table>
        <tr>
            <td>Id:</td>
            <td>Login:</td>
            <td>Haslo:</td>
            <td>Wiek:</td>
            <td>E-mail:</td>
            <td>Uprawnienia:</td>
            <td>Bany</td>
            <td>Co zrobiæ?</td>
        </tr>
<?php
$select = mysql_query("SELECT * FROM user");
while($answer=mysql_fetch_array($select))
{
if ($answer[permission]==1) { $per = "admin"; } else { $per = "user"; }
echo <<<HTML
    <tr>
        <td>$answer[id_user]</td>
        <td>$answer[login]</td>
        <td>$answer[haslo]</td>
        <td>$answer[wiek]</td>
        <td>$answer[e_mail]</td>
        <td>$per</td>
        <td>$answer[ban]</td>
        <td>
            <a class="do" href="editadmin.php?id_user=$answer[id_user]">Edytuj</a>
            <a class="do" href="?usun=$answer[id_user]">Usuñ</a>
        </td>
    </tr>
HTML;
}
?>
</table>
</body>
</html>