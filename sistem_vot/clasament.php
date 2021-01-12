<?php
require_once "config/conexiune-bd.php";
include 'functii.php';
include 'config/voturi.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql = "SELECT * FROM useri";
if ($stmt = mysqli_prepare($link, $sql)) {

    if (mysqli_stmt_execute($stmt)) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $voturi = array();
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $user = $row['user'];
                $sql2 = "SELECT * FROM voturi WHERE user_id = ?";
                if ($stmt2 = mysqli_prepare($link, $sql2)) {
                    mysqli_stmt_bind_param($stmt2, "d", $id);
                    if (mysqli_stmt_execute($stmt2)) {
                        $result2 = $stmt2->get_result();
                        $nrVoturi = $result2->num_rows;
                    }
                    mysqli_stmt_close($stmt2);
                }
                $vot = array('id' => $id, 'user' => $user, 'nrVoturi' => $nrVoturi);
                array_push($voturi, $vot);
            }
            $sortArray = array();
            foreach ($voturi as $vot) {
                foreach ($vot as $key => $value) {
                    if (!isset($sortArray[$key])) {
                        $sortArray[$key] = array();
                    }
                    $sortArray[$key][] = $value;
                }
            }
            $orderBy="nrVoturi";
            array_multisort($sortArray[$orderBy], SORT_DESC, $voturi);
            
            
        }
    }
    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="ro">
<?php head("Clasament"); ?>

<body>
    <header>
        <?php meniu(); ?>
    </header>
    
<div class="d-flex justify-content-center">
<div class="wMic">
    <div class="wrapper">
        <h5 style="text-align:center;">Urm&#259;toarea extragere: <br><?php echo $urmatoarea_extragere; ?> </h5>
        <br>
        <h2>Clasament</h2>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nume</th>
      <th scope="col">Voturi</th>
      <th scope="col">Link vot</th>
    </tr>
  </thead>
  <tbody>

<?php

$dir = substr($_SERVER['SCRIPT_NAME'],0,-13);
$votez = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $dir . 'votez.php';
$i=1;
foreach ($voturi as $vot)
            {
                echo "<tr>
                        <th scope=row>".$i++."</th>
                        <td>".$vot['user']."</td>
                        <td>".$vot['nrVoturi']."</td>
                        <td><a href=".$votez."?id=".$vot['id']."><i class='fa fa-check'></i></a></td>
                    </tr>";
            }
            ?>
    
  </tbody>
</table>


    </div>  
</div>
</div>
    

</body>
</html>