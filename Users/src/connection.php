<?php
function connectSqlite(string $dbname){ 
    try{ 
        $db=new PDO('sqlite:'.__DIR__.'/database/'.$dbname.'.sqlite'); 
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}catch(PDOException $e){ 
    echo $e-> getMessage(); die; 
} 
return $db; 
}  