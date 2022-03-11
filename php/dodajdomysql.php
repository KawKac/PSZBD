<?php 
session_start();
$log = $_SESSION["login"];
$tytul = $_POST['title'];
$news = $_POST['notatka'];
$data = date("Y-m-d");
$filtr = $_POST['skad']; 

if($tytul!="")
{
    if($news!="")
    {
		if($filtr!="")
        { 
            $connection = @mysql_connect('localhost', 'infoprem_szym', 'szym15') or die('Brak po³±czenia z serwerem MySQL'); 
    		$db = @mysql_select_db('infoprem_szym', $connection) or die('Nie mogê po³±czyæ siê z baz± danych'); 
    		$ins = @mysql_query("INSERT INTO news SET id_news='', login='$log', tytul='$tytul', tresc='$news', date='$data', filtr='$filtr'"); 
     		if($ins)
            {
                ?><div class="infog"><?php echo "News zostal dodany poprawnie."."</div>"; 
            }
        	else
            {
                ?><div class="infob"><?php echo "B³±d nie uda³o siê dodaæ nowego rekordu."."</div>";
            }
    		mysql_close($connection);
		    $message = "Uzupe³niono poprawnie";
		}
        else
        {
    	    $message = "Nie wybrano filtra";
        }
    }
    else
    {
         $message ="Nie podano tre¶ci newsa";
	}
}
else
{    	
    $message = "Nie podano tre¶ci tytu³u";
}
?> 
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
        <form action="?" method="post">
            <textarea id="tytul" name="title" placeholder="Tytul..."></textarea><br/>
		    <textarea id="tresc" name="notatka" placeholder="Tresc..."></textarea><br/>
		    Czego dotyczy news<br/>
		    <input class="rad" type="radio" name="skad" value="zeswiata"/>Ze ¶wiata<br/>
		    <input class="rad" type="radio" name="skad" value="zkraju"/>Z kraju<br/>
		    <input class="rad" type="radio" name="skad" value="sport"/>Sport<br/>
    		<input class="rad" type="radio" name="skad" value="gry"/>Gry<br/>
		    <input class="press" type="submit" value="Wy¶lij formularz"/>
	    	<input class="press" type="reset" value="Wyczy¶æ dane"/>
            <a id="back" href="../index.php">Powrót</a>
    	</form>
    </div>
</body>
</html>