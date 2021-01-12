<?php

function head($titlu){
    echo '<head>
    <meta charset="UTF-8">
    <title>'.$titlu.'</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>';
}

function meniu()
{
    require_once 'config/meniu.php';

    
    $nr_meniuri = count($meniu);

    

    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="d-flex justify-content-center collapse navbar-collapse">
      ';
    for ($i = 1; $i <= $nr_meniuri; $i++) {
        
        if ($meniu[$i][0]=='Contul meu') {
            echo "
        <div class='d-inline-flex p-2 btn-group'>
            <button type='button' id='dropdownMenuButton' class='btn btn-outline-" . $meniu[$i][3] . " dropdown-toggle' data-toggle='dropdown'>
                <i class='" . $meniu[$i][2] . "'></i><a class='nav-link'>" . $meniu[$i][0] . "</a>
            </buton>
";
            if (!isset($_SESSION['autentificat'])) 
                echo "
        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
            <a class='dropdown-item' onclick=\"window.location.href='inregistrare.php'\">Inregistrare</a>
            <div class=dropdown-divider></div>
            <a class='dropdown-item' onclick=\"window.location.href='autentificare.php'\">Autentificare</a>
        </div>"; 
            elseif (isset($_SESSION['autentificat']) && $_SESSION['autentificat']==true)
                echo "
        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
            <a class='dropdown-item' onclick=\"window.location.href='profil.php'\">Profil</a>
            <a class='dropdown-item' onclick=\"window.location.href='schimbare-parola.php'\">Schimbare parola</a>
            <div class=dropdown-divider></div>
            <a class='dropdown-item' onclick=\"window.location.href='logout.php'\">Iesire din cont</a>
        </div>"; 

        echo "
        </div>
        ";
        } else
        echo "
        <div class='d-inline-flex p-2'>
            <button onclick=\"window.location.href='" . $meniu[$i][1] . "'\" type='button' class='btn btn-outline-" . $meniu[$i][3] . "'>
                <i class='" . $meniu[$i][2] . "'></i><a class='nav-link'>" . $meniu[$i][0] . "</a>
            </buton>
        </div>
        ";
    }
    echo '
                </div>
            </div>
        </nav>';
}

function mesaj_blitz($mesaj)
{
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    $_SESSION['mesajBlitz']=array('mesaj'=>$mesaj);
}

?>