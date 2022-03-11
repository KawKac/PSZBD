<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title></title>
    <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=iso-8859-2"/>
    <link rel="stylesheet" href="css/css.css" type="text/css"/>
    <link rel="stylesheet" href="css/news.css" type="text/css"/>
    <link rel="stylesheet" href="css/ladowanie.css" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script type="text/javascript" language="javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="./js/skryptindex.js"></script>
    <script type="text/javascript" language="javascript" src="./js/application.js"></script>
</head>

<body>
    <div id="preloader">
        <div id="image">
            <div id="load">ŁADOWANIE</div>
        </div>
    </div>

    <div id="clock"></div>

    <div id="logo">
        <div id="ironnews">IRON NEWS</div>
        <div id="proba">
            <ol id="menu">
                <li class="button"><a href="index.php?filtrphp=wszystkie" class="span">WSZYSTKIE</a></li>
                <li class="button"><a href="index.php?filtrphp=zkraju" class="span">Z KRAJU</a></li>
                <li class="button"><a href="index.php?filtrphp=zeswiata" class="span">ZE ŚWIATA</a></li>
                <li class="button"><a href="index.php?filtrphp=sport" class="span">SPORT</a></li>
                <li class="button"><a href="index.php?filtrphp=gry" class="span">GRY</a></li>
             </ol>
        </div>
    </div> 
    
    <?php include("./php/loginSQL.php"); ?>
    
    <a href="#" id="nagore"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true" id="scrollToTop"></span></a>

    <noscript>Nie widzisz przycisku przeróć do góry? Zaktualizuj swoją przeglądarkę internetową.</noscript>
</body>
</html>							