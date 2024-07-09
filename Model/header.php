<?php
require_once ('param_sql.php'); /*appel du fichier parametrage*/
$objDb = @new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_BDD);/* connection à la base de données*/
if ($objDb->connect_errno) {
    error_log('Connection error:' . $objDb->connect_error);
    exit;
}
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

// $firstName = $_SESSION['first_name'];
// $lastName = $_SESSION['last_name'];
// $email = $_SESSION['email'];
// $isAdmin = $_SESSION['is_admin'];

if (isset($_POST['deconnexion'])) {
    session_destroy();
    header('Location: page_accueil.php');
}

?>





<header>
    <div class="title">
        <img src="./img/wrapper/Logo.svg" alt="logo du site" />
        <p>
            De l'intrusion à la prévention : Security Shield, votre gardien
            ultime.
        </p>
    </div>


</header>
<nav>
    <div class="menu">
        <ul>
            <li> <button class="panier">
                    <img src="./img/navbar/icone-caddy.svg" alt="icone d'un caddy" />
                    <p>0,00€</p>
                </button>
                <dialog class="panier-dialog">
                    <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);


                    include ('panier.php');

                    ?>
                </dialog>
            </li>
            <li class="break">
                <img src="./img/navbar/ligne.svg" alt="séparateur" />
            </li>
            <li>
                <a href="page_accueil.php"><img src="./img/navbar/logominiature.svg" alt="icone logo" /></a>
            </li>
            <li class="break">
                <img src="./img/navbar/ligne.svg" alt="séparateur" />
            </li>
            <li><a href="camerawifi.php">Caméra Wifi</a></li>
            <li class="break">
                <img src="./img/navbar/ligne.svg" alt="séparateur" />
            </li>
            <li><a href="camera_espion.php">Caméra Espion</a></li>
            <li class="break">
                <img src="./img/navbar/ligne.svg" alt="séparateur" />
            </li>
            <li><a href="kitvideosurveillance.php">Kit video surveillance</a></li>
            <li class="break">
                <img src="./img/navbar/ligne.svg" alt="séparateur" />
            </li>
            <li><a href="accessoires.php">Accessoires</a></li>
            <li class="break">
                <img src="./img/navbar/ligne.svg" alt="séparateur" />
            </li>
            <form class="search">
                <input type="rechercher" name="rechercher" id="rechercher" placeholder="rechercher" />
                <img src="./img/navbar/icone-loupe.svg" alt="icone de loupe" />
            </form>
            <li class="break">
                <img src="./img/navbar/ligne.svg" alt="séparateur" />
            </li>
            <div class="dropdown-all">
                <div class="Connexion">
                    <?php if (!$loggedIn): ?>
                        <button class="connexion-button">
                            <img src="./img/wrapper/icone-connexion.svg" alt="" />Connexion
                        </button>
                    <?php else: ?>
                        <div class="dropdown-hidden">
                            <button class="dropbtn">
                                <img src="./img/wrapper/icone-connexion.svg" alt="" />
                                <?= htmlspecialchars($_SESSION['first_name']) ?>
                                <?= htmlspecialchars(substr($_SESSION['last_name'], 0, 1)) ?>.
                                <!-- ($_SESSION['is_admin'] ? 'Administrateur' : 'Utilisateur');  -->
                            </button>
                            <div class="dropdown-content">
                                <li class="mon_compte"><a href="moncompte.php">Mon compte</a></li>
                                <li class="admin">
                                    <?php if ($_SESSION['is_admin'] == '1'): ?>
                                        <a href="admin.php">Admin</a>
                                    <?php endif; ?>
                                </li>
                                <div class="deconnexion">
                                    <form action="" method="post">
                                        <button type="submit" name="deconnexion"
                                            class="deconnexion-link">Déconnexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <script>
                // JavaScript to handle the dropdown
                document.querySelector('.dropbtn').addEventListener('click', function () {
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "none" || dropdownContent.style.display === "") {
                        dropdownContent.style.display = "block";
                    } else {
                        dropdownContent.style.display = "none";
                    }
                });
            </script>


    </div>





    <dialog class="connexion-dialog">
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);


        include ('connexion.php');

        ?>
    </dialog>
    </li>

    </ul>
    </div>
</nav>