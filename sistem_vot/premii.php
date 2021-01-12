<?php

include 'functii.php';
include 'config/premii.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="ro">
<?php head("Premii"); ?>

<body>
    <header>
        <?php meniu(); ?>
    </header>


    <div class="d-flex justify-content-center">
        <div class="wMic-Premii">


            <div style="background:transparent url('img/premii-bg.png') no-repeat center center /cover">

                <div style="background:transparent url('img/premii-bg2.png') no-repeat center center /cover">

                    <div class="wrapper">
                        <h2 style="text-align:center;" class="glow">Premii</h2>



                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 rounded" src="img/premiu1_800x400.png" alt="Premiu 1">
                                    <div class="carousel-caption d-none d-md-block glow">
                                        <h5 onclick="window.location.href='<?php echo $premiu1_link; ?>'" style="padding-bottom: 150px;"><?php echo $premiu1; ?></h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 rounded" src="img/premiu2_800x400.png" alt="Premiu 2">
                                    <div class="carousel-caption d-none d-md-block glow">
                                        <h5 onclick="window.location.href='<?php echo $premiu2_link; ?>'" style="padding-bottom: 150px;"><?php echo $premiu2; ?></h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 rounded" src="img/premiu3_800x400.png" alt="Premiu 3">
                                    <div class="carousel-caption d-none d-md-block glow">
                                        <h5 onclick="window.location.href='<?php echo $premiu3_link; ?>'" style="padding-bottom: 150px;"><?php echo $premiu3; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>


        </div>
    </div>



</body>


</html>