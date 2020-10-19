<?php
session_start();
ini_set('display_errors', 'On');

require __DIR__.'/src/connection.php';
require __DIR__.'/src/schema.php';

$dbname="users";
$db=connectSqlite($dbname);
schemaGenerator($db);

$user=filter_input(INPUT_POST, 'username');
$passwd=filter_input(INPUT_POST, 'userpwd');
$valueUser=null;
$valuePwd=null;
$lastconnection="";
$message="";


//COMPROVACIÓ D'USUARI RECORDAT
/*Es comprova si existeix la cookie d'user i si és així es carreguen els valor s'usuari i contrasenya al formulari
, també carreguem els inputs que es mostrarán en aqest cas.*/
if(isset($_COOKIE['user'])){
    $valueUser=$_COOKIE['user'];
    $valuePwd=$_COOKIE['pwd']; 
    $lastconnection="<h3>Última connexió realitzada el: </h3>".$_COOKIE['lastconnection'];
    $label="<label for='newLogin'><h3>Inicia sessió amb altre compte</h3></label>";
    $input= "<input type='submit' name='newLogin' value='Canvia de compte'>";    
}else{
    $label= "<label for='rememberUser'>Guarda l'usuari en aquest equip</label>";
    $input= "<input type='checkbox' name='rememberUser'>";  
}
/*Borrar les dades en cas de que l'usuari vulgui borrar el compte i inciar sessió amb altres credencials*/
if(isset($_POST["newLogin"]) && $_POST["newLogin"] != NULL){
    deleteCookie();
    $valueUser=null;
    $valuePwd=null;
    $user=null;
    $passwd=null;
    $lastconnection="";
    $label= "<label for='rememberUser'>Guarda l'usuari en aquest equip</label>";
    $input= "<input type='checkbox' name='rememberUser'>";
}

//REGISTRE DE NOU USUARI
$newUser=filter_input(INPUT_POST, 'user');
$newPwd=filter_input(INPUT_POST, 'pwd');

if($newUser != null &&  $newPwd != null){
   $data= [
        'username'=>$newUser, 
        'password'=>$newPwd,
        'logs'=> date("F j, Y, g:i a")
    ];
   $message= insertSchema($db, $data);
}

//INICI DE SESSIÓ: 

if($user != null && $passwd!= null){       
    if(login($db, $user, $passwd) == true){
        if(filter_input(INPUT_POST,"rememberUser") != NULL){
            saveUser($user, $passwd);                               
        }
        if(!isset($_SESSION["user"])){
            $_SESSION["user"]=$user;
        }  
        header('location: userpage.php'); 
    }else{$message= "Usuari o contrasenya incorrectes";}
} 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Users login</title>
</head>
<body>
    <header>
        <h1>Welcome to your page!</h1>
    </header>
    <section>
        <article>
            <form class="register" action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                <label><h2>Et vols registrar?</h2></label>
                <label>Nom d'usuari:</label>
                <input type="text" name='user' required>
                <label>Contrasenya: (Recorda que majúscules i minúscules compten)</label>
                <input type="text" name='pwd' required>
                <label><p></p>  </label>
                <input type="submit" name="login" value="Registra">               
            </form>
        </article>
        <?php echo $message;?>
        <article>
            <form class="firstlogin" action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                <label><h2>Ja ets membre?</h2></label>
                <label><h3>Inicia sessió:</h3></label>              
                <label for="username">Usuari:</label><br><br>
                <input type="text" name='username'required value="<?php echo $valueUser?>" >
                <label for="password">Contrasenya</label>
                <input type="password" name='userpwd'required value="<?php echo $valuePwd?>" >
                <label><p></p>  </label>
                <input type='submit' name='login' value='Inicia sessió'>              
                <?php
                    echo $lastconnection;
                    echo $label;
                    echo $input;
                ?>                              
            </form>
        </article>
       
    </section>

</body>
</html>
<?php
//FUNCIONS

//per comprovar usuari i contrasenya correctes
function login($db, $user, $password): bool{
    $session=selectUser($db, $user);
    $logok=false;
        foreach($session as $log){             
            if($log['username'] == $user && $log['pwd'] == $password && $logok==false){
                $logok=true;                       
            } 
        }
        if($logok==true){
            return true;
        }else{return false;}
}

//funció per generar les cookies d'usuari recordat:
function saveUser($user, $pwd){
    $date=date("F j, Y, g:i a");           
    setcookie('lastconnection', $date, time()+5000);
    setcookie('user', $user, time()+5000);
    setcookie('pwd', $pwd, time()+5000);   
}

//funció per esborrar dades d'usuari:
function deleteCookie(){
    if(isset($_COOKIE['user']) && isset($_COOKIE['pwd']) && isset($_COOKIE['pwd'])){
        setcookie('lastconnection',null, time()-6000);
        setcookie('user',null, time()-6000);
        setcookie('pwd',null, time()-6000);
       
    }
}

?>