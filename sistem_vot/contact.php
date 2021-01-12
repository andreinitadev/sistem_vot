<?php

if (session_status() == PHP_SESSION_NONE) { session_start(); }
include 'functii.php';
include 'config/contact.php';

$user = $email = $msg = "";
$username_err = $email_err = $msg_err = "";



if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty(trim(($_POST["userPosted"])))){
        $username_err="Numele de utilizator nu poate fi gol.";
    } else {
        $user=trim($_POST['userPosted']);
    }

    if (empty(trim(($_POST["emailPosted"])))){
        $email_err="Emailul nu poate fi gol.";
    } else
    {
        $email = trim($_POST['emailPosted']);
    }

    if (empty(trim(($_POST["msgPosted"])))){
        $msg_err="Mesajul nu poate fi gol.";
    } else
    {
        $msg = $email." ti-a scris mesajul: \n\n";
        $msg = $msg.$_POST['msgPosted'];
        $msg = wordwrap($msg,70);
    }

    if (empty($username_err) && empty($email_err) && empty($msg_err))
    {
        mesaj_blitz("Mesajul tau a fost trimis cu succes.<br> Verificati folderul <b>Spam</b>. <br><br> Iti vom trimite un raspuns la ".$email." in cel mai scurt tip posibil");
        mail($destinatie,"Mesaj de la: ".$user,$msg);
    }
}


?>

<!DOCTYPE html>
<html lang="ro">
<?php head("Contact"); ?>

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
        <h2>Contact</h2>
        <p>Completeaz&#259; formularul de contact pentru a ne trimite un mail.</p>
        <form action="" method="post">
            <div class="form-group">
            <label class="<?php echo (!empty($username_err)) ? 'text-danger' : ''; ?>">Nume de utilizator</label>
                <input type="text" name="userPosted" class="form-control" placeholder="numele tau de utilizator">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label class="<?php echo (!empty($email_err)) ? 'text-danger' : ''; ?>">Email</label>
                <input type="text" name="emailPosted" class="form-control" placeholder="mailul@tau.com">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label class="<?php echo (!empty($msg_err)) ? 'text-danger' : ''; ?>">Mesaj</label>
                <textarea name="msgPosted" class="form-control" placeholder="Mesajul pe care vrei sa ni-l comunici." rows="3"></textarea>
                <span class="help-block"><?php echo $msg_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Trimite">
                <input type="reset" class="btn btn-default" value="Sterge valorile introduse">
            </div>
        </form>



    </div>  
</div>
</div>
    

</body>
</html>