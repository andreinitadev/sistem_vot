<?php

include 'functii.php';
 
if (session_status() == PHP_SESSION_NONE) { session_start(); }
 
if(!isset($_SESSION["autentificat"]))
{
    header("location: index.php");
    exit;
} 

require_once "config/conexiune-bd.php";

        $sql = "SELECT * FROM voturi WHERE user_id = ?";
        if ($stmt = mysqli_prepare($link, $sql))
        {
            
            mysqli_stmt_bind_param($stmt, "d", $_SESSION['id']);
            
            if(mysqli_stmt_execute($stmt)){
                $result = $stmt->get_result();
                $nrVoturi = $result->num_rows;
            }
            mysqli_stmt_close($stmt);
        }


?>
 
<!DOCTYPE html>
<html lang="ro">
<?php head("Profil"); ?>

<body>
    <header>
        <?php meniu(); ?>
    </header>
    
<div class="d-flex justify-content-center">
<div class="wMic">
    <div class="wrapper">
        <?php
if(isset($_SESSION["autentificat"]) && $_SESSION["autentificat"] === true){
    $dir = substr($_SERVER['SCRIPT_NAME'],0,-10);
    $votez = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $dir . 'votez.php';

    echo "
    
    <h2>Salut ".$_SESSION['user']."</h2>
    <div class='alert alert-success' role='alert'>
        Nr voturi: ".$nrVoturi."
        </div>
        <div class='alert alert-success' role='alert'>Trimite urm&#259;torul link celor ce vrei sa te voteze:
        <br><br>
        <input type='text' class='form-control' value=".$votez."?id=".$_SESSION['id'].">
        <br>
        </div>

        ";
} 
?>
    </div>  
</div>
</div>
    

</body>
</html>