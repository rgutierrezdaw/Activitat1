<?php

include "calc.php";

$result="";

if($_POST['form1']){
    $num1=$_POST['val1'];
    $num2=$_POST['val2'];
    $result=performOperation("sum", $num1, $num2);
    
}else if($_POST['form2']){
    $value=$_POST['val1'];
    $result=performOperation("factorial", $value);
   
}else if($_POST['form3']){
    $value=$_POST['val1'];
    $result=performOperation("prime", $value);
  
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Document</title>
</head>
<body>
    <section>
    <h1>Quina operació vols realitzar?</h1>
       
        <article>
            <form id="form1" action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                <label><h3>Introdueïx els dos valors a sumar:</h3></label>
                <div class="inp">
                    <label><p>Valor 1:</p></label>
                    <input class="numbers" type="number" name="val1" required>
                    <p>+</p>
                    <label><p>Valor 2:</p></label>
                    <input class="numbers"  type="number" name="val2" required>
                    <input type="hidden" name="form1" value="myform">
                </div>               
                <input class="submit" type="submit" name="enviar" value="Calcular">
            </form>
            
            <form id="form2" action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                <label><h3>Veure el factorial de:</h3></label>
                <div class="inp">
                    <label><p>Número</p></label>
                    <input class="numbers" type="number" name="val1" required> 
                    <input type="hidden" name="form2" value="myform">
                </div>                           
                <input class="submit" type="submit" name="enviar" value="Calcular">                
            </form>

            <form id="form3" action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                <label><h3>Comprova si es un nombre primer:</h3></label>
                <div class="inp">
                    <label><p>Número</p></label>
                    <input class="numbers" type="number" name="val1" required>      
                    <input type="hidden" name="form3" value="myform">    
                </div>                               
                <input class="submit" type="submit" name="enviar" value="Calcular">
            </form>
            
        </article>
        <article>
            <div><h3><?php echo $result;?></h3></div>
        </article>
    </section>
    <script>
        function tryForm(){
            document.POSTElementById('form1').style.display="flex";
        }
    </script>
</body>
</html>