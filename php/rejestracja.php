<?php
$connect = @mysql_connect("localhost", "infoprem_szym", "szym15");
$select_db = @mysql_select_db("infoprem_szym");
if (!$select_db) { echo "Przerwa techniczna..."; }

function captcha(){
        $answer="";
        $ile_pytan = mysql_query("SELECT COUNT(*) FROM captcha");
        $ilepytan = intval($ile_pytan);
        $pytanie=rand(1,$ilepytan);
        $pobranepytanie=mysql_fetch_row(mysql_query("SELECT * FROM captcha WHERE id_captcha=$pytanie;"));
        $answer=$_POST["odpowiedz"];
        $answer = strtolower($answer);
        $answermysql = strtolower($pobranepytanie[2]);
        echo "<div class='for'>".$pobranepytanie[1]."</div>"."<input type='text' name='odpowiedz' class='inpt'></input>";
}

$login = $_POST["login"];
$haslo = md5($_POST["haslo"]);
$haslo2 = md5($_POST["haslo2"]);
$wiek = $_POST["wiek"];
$e_mail = $_POST["e_mail"];
$adres = $_SERVER["REMOTE_ADDR"];
$l = mysql_query("SELECT * FROM user WHERE login='$login';");
$e = mysql_query("SELECT * FROM user WHERE e_mail='$e_mail';");
if(isset ($_POST['login'], $_POST['haslo'], $_POST['haslo2'], $_POST['wiek'], $_POST['e_mail']))
{
    if($login!="" && $haslo!="")
    {
        if(mysql_num_rows($l)!=1  && mysql_num_rows($e)!=1)
        {
            if($haslo == $haslo2)
            {
                if(preg_match('/^[0-9]+$/', $wiek) && $wiek>=18)
                {
                    if($answermysql==$answer)
                    {
                        if(filter_var($e_mail, FILTER_VALIDATE_EMAIL)== TRUE)
                        {
                            $insert = mysql_query("INSERT INTO user SET login='$login', haslo='$haslo', wiek='$wiek', e_mail='$e_mail', permission='0', ban='0';");
                            if($insert){?><div class="infog"><?php echo "Zarejestrowano pomylnie."."</div>";}
                        }
                        else
                        {
                            ?><div class="infob"><?php echo "Niepoprawny e_mail."."</div>";
                        }
                    }
                    else
                    {
                        ?><div class="infob"><?php echo "B³êdna captcha."."</div>";
                        captcha();  
                    }
                }
                else
                {
                    ?><div class="infob"><?php echo "Wiek musi byc liczba, a ty pelnoletni."."</div>";
                }
            }
            else
            {
                ?><div class="infob"><?php echo "Hasla sa ró¿ne."."</div>";
            }
        }
        else
        {
            ?><div class="infob"><?php echo "U¿ytkownik o podanym loginie/mailu ju¿ istnieje."."</div>";
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
<head>
    <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2"/>
    <title>Rejestracja.php</title>
    <link rel="stylesheet" href="../css/cssrejestracja.css" type="text/css"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../css/ladowanie.css" rel="stylesheet"/>
    <script type="text/javascript" language="javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/skryptindex.js"></script>
    <script type="text/javascript" language="javascript" src="../js/application.js"></script>
</head>
<body>
<div id="preloader">
  <div id="image">
    <div id="load">£ADOWANIE</div>
  </div>
</div>  

    <div id="clock"></div>

    <div id="div">
        <form action="?" method="post">
    		<div class="for">Login:<input class="inpt" type="text" name="login"/></div>
			<div class="for">Haslo:<input class="inpt" type="password" name="haslo"/></div>
            <div class="for">Powtorz haslo:<input class="inpt" type="password" name="haslo2"/></div>
			<div class="for">Wiek:<input class="inpt" type="text" name="wiek"/></div>
		    <div class="for">E_mail:<input class="inpt" type="text" name="e_mail"/></div>
            <div class="for"><?php captcha();?></div>
		    <div id="press"><input id="press" type="submit" name="rejestracja" value="Zarejestruj"></div>
            <div id="back"><a href="../index.php">Powrót</a></div>
	    </form>
    </div>
</body>
</html>	