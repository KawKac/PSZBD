<?php
ob_start();

$connect = @mysql_connect("localhost", "infoprem_szym", "szym15");
$select_db = @mysql_select_db("infoprem_szym");
$phpfiltr = $_GET["filtrphp"];
$b=0;

function array2table($arr,$width)
   {
   $count = count($arr);
   if($count > 0){
       reset($arr);
       $num = count(current($arr));
       while ($curr_row = current($arr))
       {
           echo "<div class='news'>";
           $col = 1;
           $b = 0;
           while (false !== ($curr_field = current($curr_row))) 
           {
                if($b==2){
                    echo '<p class="tytul">';
                    echo "$curr_field";
                    echo '</p>';
                }
                if($b==3){
                    echo '<p class="text">';
                    echo "$curr_field";
                    echo '</p>';
                }
                if($b==4){ 
                    echo '<p class="date">';
                    echo "$curr_field";
                    echo '</p>';
                }
                next($curr_row);
                $b++;
                $col++;
            } 
            while($col <= $num){
               $col++;       
            }
           echo "</div>";
           next($arr);
           }
       }
   }

if($phpfiltr=='wszystkie' OR $phpfiltr=='')
{
    $query = "SELECT * FROM `news`;";
}
else
{
    $query = "SELECT * FROM `news` WHERE filtr='$phpfiltr'";
}

$result = mysql_query($query);


while($row = mysql_fetch_assoc($result))
{
  $array[] = $row;
}
      
array2table($array,600);
ob_end_flush();
?>