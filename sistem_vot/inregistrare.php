<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if(isset($_SESSION["autentificat"]) && $_SESSION["autentificat"] === true){
    header("location: index.php");
    exit;
}
require_once "config/conexiune-bd.php";
include 'functii.php'; 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    

    if(empty(trim($_POST["userPosted"]))){
        $username_err = "Numele de utilizator nu poate fi gol.";
    } else{
        $sql = "SELECT id FROM useri WHERE user = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["userPosted"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Numele de utilizator exista deja.";
                } else{
                    $username = trim($_POST["userPosted"]);
                }
            } else{
                //echo "Instructiunea mysql nu s-a executat.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    

    if(empty(trim($_POST["passwordPosted"]))){
        $password_err = "Parola nu poate fi goala.";     
    } elseif(strlen(trim($_POST["passwordPosted"])) < 6){
        $password_err = "Parola trebuie sa aiba minim 6 caractere.";
    } else{
        $password = trim($_POST["passwordPosted"]);
    }
    


    if(empty(trim($_POST["confirmPasswordPosted"]))){
        $confirm_password_err = "Te rugam sa introduci din nou parola.";     
    } else{
        $confirm_password = trim($_POST["confirmPasswordPosted"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Parolele nu se potrivesc.";
        }
    }
    


    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO useri (user, parola) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            if(mysqli_stmt_execute($stmt)){
                mesaj_blitz('Contul a fost creat cu success');
                header("location: autentificare.php");
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
<?php head("&#206;nregistrare"); ?>

<body>
    <header>
        <?php meniu(); ?>
    </header>
    
<div class="d-flex justify-content-center">
<div class="wMic">
    <div class="wrapper">
        <h2>&#206;nregistrare</h2>
        <p>Completeaz&#259; formularul inregistrare pentru a iti crea un cont.</p>
        <form action="" method="post">
            <div class="form-group">
            <label class="<?php echo (!empty($username_err)) ? 'text-danger' : ''; ?>">Nume de utilizator</label>
                <input type="text" name="userPosted" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label class="<?php echo (!empty($password_err)) ? 'text-danger' : ''; ?>">Parol&#259;</label>
                <input type="password" name="passwordPosted" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label class="<?php echo (!empty($confirm_password_err)) ? 'text-danger' : ''; ?>">Introdu parola din nou</label>
                <input type="password" name="confirmPasswordPosted" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Trimite">
                <input type="reset" class="btn btn-default" value="Sterge valorile introduse">
            </div>
            <p>Ai deja un cont? <a href="autentificare.php">Intr&#259; in cont</a>.</p>
        </form>
    </div>  
</div>
</div>
    

</body>
</html>