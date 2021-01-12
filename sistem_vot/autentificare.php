<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
 
if(isset($_SESSION["autentificat"]) && $_SESSION["autentificat"] === true){
    header("location: index.php");
    exit;
}
 
require_once "config/conexiune-bd.php";
include 'functii.php';
 
$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    

    if(empty(trim($_POST["userPosted"]))){
        $username_err = "Numele de utilizator nu poate fi gol.";
    } else{
        $username = trim($_POST["userPosted"]);
    }
    
    if(empty(trim($_POST["passwordPosted"]))){
        $password_err = "Parola nu poate fi goala.";
    } else{
        $password = trim($_POST["passwordPosted"]);
    }
    


    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, user, parola FROM useri WHERE user = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            if (session_status() == PHP_SESSION_NONE) { session_start(); }
                            
                            $_SESSION["autentificat"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user"] = $username;                            
                            
                            header("location: profil.php");
                        } else{
                            $password_err = "Parola nu e corecta.";
                        }
                    }
                } else{
                    $username_err = "Numele de utilizator nu e corect.";
                }
            } else{
                //echo "Instructiunea mysql nu s-a executat";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($link);
}


?>
 
<!DOCTYPE html>
<html lang="ro">
<?php head("Autentificare"); ?>
<body>
    <header>
        <?php meniu(); ?>
    </header>

<div class="d-flex justify-content-center">
<div class="wMic">
    <?php
    if(isset($_SESSION['mesajBlitz'])) {
        echo "<div class='alert alert-success' role='alert'>
        ".$_SESSION['mesajBlitz']['mesaj']."
        </div>
        ";
        unset($_SESSION['mesajBlitz']);
    }
    ?>

    <div class="wrapper">
        <h2>Autentificare</h2>
        <p>Completeaz&#259; formularul pentru a intra in contul tau.</p>
        <form action="" method="post">
            <div class="form-group">
                <label class="<?php echo (!empty($username_err)) ? 'text-danger' : ''; ?>">Nume de utilizator</label>
                <input type="text" name="userPosted" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label class="<?php echo (!empty($password_err)) ? 'text-danger' : ''; ?>">Parol&#259;</label>
                <input type="password" name="passwordPosted" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Autentificare">
            </div>
            <p>Nu ai cont? <a href="inregistrare.php">&#206;nregistreaz&#259;-te</a>.</p>
        </form>
    </div> 

</div>
</div>
     
</body>
</html>