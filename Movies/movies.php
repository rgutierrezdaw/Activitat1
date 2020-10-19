<?php

$films= array(
        ["name"=>"Iron man 2", "year"=> "2010", "productora"=>"Marvel Studios"],
        ["name"=>"Amelie","year"=> "2001", "productora"=>"Claude Ossard"],
        ["name"=>"Eduardo manos tijeras","year"=> "1990", "productora"=>"Tim Burton"],
        ["name"=>"Thor","year"=> "2010", "productora"=>"Marvel Studios"]
);
$name="";
$year="";
$produced="";
$noresult="";

  if(isset($_GET["film"])){
    $film=$_GET["film"];

    foreach($films as $peli){             
              if(array_search($film, $peli)){
                $name= "<h1>".$peli['name']."</h1>";
                $year= "<h3>Año de la película: ".$peli['year']."</h3>";
                $produced="<h3>Producida por: ".$peli['productora']."</h3>";
                $result=true; 
              break;                           
              }else {                    
                    $result=false;                    
              }
           }
           if($result==false){
                   $noresult= "<h1>Título no encontrado</h1>";
           }
        }

      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario php</title>
</head>
<body>
    <form action="<?= htmlentities($_SERVER["PHP_SELF"]);?>" method="GET">
        <label for="film">Search film:</label>
        <input type="text" name="film" >
        <input type="submit" value="Busca">
    </form>
    <?php echo $name.$year.$produced.$noresult?>
</body>
</html>
