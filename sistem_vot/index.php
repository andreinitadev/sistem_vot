<?php

include 'functii.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="ro">
<?php head("Sistem de vot cu premii"); ?>

<body>
    <header>
        <?php meniu(); ?>
    </header>

    <div class="d-flex justify-content-center">
        <div class="wMic-Acasa">
            <div class="wrapper">
                <h2 style="text-align: center;">Sistem de vot cu premii</h2>
<p>Regulile jocului sunt simple:</p>
<p>1. Creaza-ti un cont</p>
<p>2. Distribuie prietenilor link-ul tau de vot pe care il gasesti in pagina de profil, dupa autentificare.</p>
<p>3. Acumuleaza cat mai multe voturi</p>
<br>
<p>Extragerea castigatorilor se va face o data la 30 zile. Dupa extragere, toate voturile vor fi resetate.<br> Stocurile premiilor sunt nelimitate</p>
<p>Locul 1 = minim 500 voturi</p>
<p>Locul 2 = minim 400 voturi</p>
<p>Locul 3 = minim 300 voturi</p>
<br>
<p>Daca exista mai multi participanti pe un loc, toti vor fi castigatori.<br> Spre exemplu, daca exista 5 participanti cu minim 500 voturi, toti 5 vor fi castiga premiul pentru Locul 1. La fel pentru locurile 2 si 3.</p>
<br>
<p>Castigatorii au obligatia de a completa un formular de contact in care sa specifice in mesaj: prenume, nume si numarul de telefon.


            </div>
        </div>
    </div>


</body>

</html>