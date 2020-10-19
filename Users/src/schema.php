<?php


function schemaGenerator(PDO $db){ 
    $command=' 
    CREATE TABLE IF NOT EXISTS users(username VARCHAR(100) NOT NULL, pwd VARCHAR(100) NOT NULL, logs VARCHAR(100) NULL);';    
    try{ 
        $db->exec($command); 
    }catch(PDOException $e){ 
        die($e->getMessage()); 
    } 
} 
//resgistrem usuari sempre i quan no existeixi un igual
function insertSchema($db, $datos): string{
    if($datos){
        $name=$datos['username'];
        $password=$datos['password'];
        $date=$datos['logs'];
        $checkName = checkUserName($db,$name);
        if($checkName == true){
            return "Aquest nom d'usuari ja existeix, escull un altre.";
        } else {
           $insertCommand="INSERT INTO users(username, pwd, logs) VALUES ('$name', '$password', '$date');";           
            try{ 
                $db->exec($insertCommand); 
                return $name.": T'has registrat correctament";
            }catch(PDOException $e){ 
                die($e->getMessage()); 
                return "Hi ha hagut un problema, torna a intentar-ho.";
            }  
        }        
                     
    } 
} 
//sel·lecció d'usuari
function selectUser($db, $user):array{
    if($user){
        $sql="SELECT username, PWD, logs FROM users where username = :username";
        $stmt=$db->prepare($sql); 
        $stmt->execute([':username'=>$user]); 
        return $data=$stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

//comprova si el nickname existeix
function checkUserName($db, $user){
    $data=selectUser($db, $user);
    $check=false;
    foreach($data as $name){
        if($name['username'] == $user && $check == false){
            $check= true;
        }
    }
    if($check==true){
        return true;
    }else{return false;}
}


