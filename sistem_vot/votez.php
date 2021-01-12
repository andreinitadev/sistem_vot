<?php
require_once 'config/conexiune-bd.php';
include 'functii.php';
if (session_status() == PHP_SESSION_NONE) { session_start(); }
$potVota = 0;
$msg = "";

if (!empty($_GET["id"])) {
    $sql = "SELECT CURRENT_TIMESTAMP() timpCurent";
    if ($stmt = mysqli_prepare($link, $sql)) {

        if (mysqli_stmt_execute($stmt)) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $timpCurent = $row['timpCurent'];
            }
        }
        mysqli_stmt_close($stmt);
    }


    $sql = "SELECT timpul_votarii FROM voturi WHERE guest_ip = ? ORDER BY timpul_votarii DESC LIMIT 1";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_guestip);

        $param_guestip = $_SERVER['REMOTE_ADDR'];

        if (mysqli_stmt_execute($stmt)) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $ultimulVot = $row['timpul_votarii'];

                require_once 'config/voturi.php';
                


                $diferenta = strtotime($timpCurent) - strtotime($ultimulVot);
                if ($diferenta > 3600 * $oreIntreVoturi) {
                    $potVota = 1;
                } else {

                    $timpAsteptare = 3600 * $oreIntreVoturi - $diferenta;
                    $msg = "Este permis un singur vot la interval de " . $oreIntreVoturi . " ore.
                        Timp de asteptare ramas: " . gmdate("H:i:s", $timpAsteptare) ;
                }
            } elseif ($result->num_rows == 0) {
                $potVota = 1;
            }
        } else {
            $msg="Instructiunea mysql nu s-au executat";
        }
        mysqli_stmt_close($stmt);
    }

    if ($potVota) {
        $sql = "INSERT INTO voturi (user_id, guest_ip) VALUES (?, ?);";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ds", $param_userid, $param_guestip);

            $param_userid = $_GET["id"];
            $param_guestip = $_SERVER['REMOTE_ADDR'];

            if (mysqli_stmt_execute($stmt)) {
                $msgSucces="Votul a fost inregistrat cu succes.";
            } else {
                $msg="Id-ul utilizatorului nu exista in baza de date. Votul nu a fost inregistrat.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<?php head("Voteaz&#259;"); ?>
</head>

<body>
    <header>
        <?php meniu(); ?>
    </header>

    <div class="d-flex justify-content-center">
        <div class="wMic">
            <div class="wrapper">
                <?php
                if (!empty($msg))
                echo "<div class='alert alert-danger' role='alert'>
                ".$msg."
                </div>";
                elseif (!empty($msgSucces))
                echo "<div class='alert alert-success' role='alert'>
                ".$msgSucces."
                </div>";
                ?>

            </div>
        </div>
    </div>


</body>

</html>