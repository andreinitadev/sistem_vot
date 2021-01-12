<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
 
if(!isset($_SESSION["autentificat"]) || $_SESSION["autentificat"] !== true){
    header("location: index.php");
    exit;
}
 
require_once "config/conexiune-bd.php";
include 'functii.php';
 
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["parolaPostata"]))){
        $new_password_err = "Parola nu poate fi goala.";     
    } elseif(strlen(trim($_POST["parolaPostata"])) < 6){
        $new_password_err = "Parola trebuie sa aiba minim 6 caractere.";
    } else{
        $new_password = trim($_POST["parolaPostata"]);
    }
    
    if(empty(trim($_POST["confirmareParolaPostata"]))){
        $confirm_password_err = "Te rugam sa introduci din nou parola.";
    } else{
        $confirm_password = trim($_POST["confirmareParolaPostata"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Parolele nu se potrivesc.";
        }
    }
        
    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE useri SET parola = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sd", $param_password, $param_id);
            
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                mesaj_blitz('Parola a fost schimbata cu succes.');
                header("location: autentificare.php");
                exit();
            } else{
                //echo "Instructiunea mysql nu s-a executat.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
 
 <!DOCTYPE html>
<html lang="ro">
<?php head("Resetare parola"); ?>

<body>
    <header>
        <?php meniu(); ?>
    </header>
<div class="d-flex justify-content-center">
<div class="wMic">
    <div class="wrapper">
        <h2>Resetare parola</h2>
        <p>Completeaz&#259; formularul de mai jos pentru a iti schimba parola.</p>
        <form action="" method="post"> 
            <div class="form-group">
                <label class="<?php echo (!empty($new_password_err)) ? 'text-danger' : ''; ?>">Parol&#259; nou&#259;</label>
                <input type="password" name="parolaPostata" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label class="<?php echo (!empty($confirm_password_err)) ? 'text-danger' : ''; ?>">Introdu inca o dat&#259; noua parol&#259;</label>
                <input type="password" name="confirmareParolaPostata" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Trimite">
                <a class="btn btn-link" href="index.php">Anulare</a>
            </div>
        </form>
    </div>    
</div>
</div>
</body>
</html>          