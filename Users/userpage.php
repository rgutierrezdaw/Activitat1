<?php
session_start();

if($_POST["logout"] != NULL){
    unset($_SESSION['user']);
    session_destroy();    
    header('location: Index.php');
}




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>User page</title>
</head>
<body>
    <header>
        <h1>Welcome <?php echo $_SESSION["user"];?>!</h1>
    </header>
    <section>
        <form class="logout" action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
            <label>Tanca la sessió</label><br><br>
            <input type="submit" name="logout" value="Tanca sessió">
        </form>
    </section>
</body>
</html>