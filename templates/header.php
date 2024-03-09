<header>
    <div class="inner-width">
        <p style="color: white; text-align: center;">You need to Log In to access maintenance</p>
        <div class="logo">
            <img src="img/logo.jpg" alt="Logo">
        </div>
        <i class="menu-toggle-btn fas fa-bars"></i>
        <nav class="navigation-menu">
            <a href="?home/show"><i class="fas fa-home home"></i><?= isset($lang['home']) ? $lang['home'] : '' ?></a>
            <a href="?projects/show"><i class="fab fa-buffer works"></i><?= isset($lang['projects']) ? $lang['projects'] : '' ?></a>
            <a href="?contact/form"><i class="fas fa-headset contact"></i><?= isset($lang['contact']) ? $lang['contact'] : '' ?></a>
            
            <?php
                if (isset($_SESSION["logued_user"])) {
                    echo '<a href="?entrada/show"><i class="fas fa-align-left about"></i>' . (isset($lang['maintenance']) ? $lang['maintenance'] : '') . '</a>';
                    echo '<a href="?idiomaManteniment/show"><i class="fas fa-language"></i>' . (isset($lang['language']) ? $lang['language'] : '') . '</a>';
                }
            ?>


            <?php
            $idioma = new Idioma();
            $idiomaModel = new IdiomaModel();
            $arrayIdiomes = $idiomaModel->read();

            $idiomasISO = [];

            foreach ($arrayIdiomes as $idiomaDB) {
                $idiomasISO[] = array($idiomaDB->iso, $idiomaDB->actiu);
            }

            $traduccioModel = new TraduccioModel();
            $arrayTraduccions = [];
            
            $idioma_cookie = '';

            if (isset($_COOKIE['lang'])) {
                if (($_COOKIE['lang'])) {
                    $idioma_cookie =  $_COOKIE['lang'];
                } else {
                    $idioma_cookie = "gb";
                }
            } else {
                $idioma_cookie = "gb";
            }
                
            $idioma->iso = $idioma_cookie;
                
            $idiomaWithId = $idiomaModel->getByIso($idioma);
                
            $arrayTraduccions = $traduccioModel->getByLanguageIdiomaId($idiomaWithId->id);
            
            ?>

            <div class="select-dropdown">
                <form method="get" action="">
                    <select id="lang" name="idioma" onchange="updateLanguage()">
                        <?php
                        
                        if (isset($arrayTraduccions)) {
                        
                            foreach ($arrayTraduccions as $traduccio) {
                                foreach ($idiomasISO as $idiomaISO) {
                                    if ($idiomaISO[0] == $traduccio->variable && $idiomaISO[1] == 1) {
                                        $selected = ($selected_lang === $traduccio->variable) ? 'selected' : '';
                                        echo '<option value="' . $traduccio->variable . '" ' . $selected . '>' . $traduccio->valor . '</option>';
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </form>
            </div>
            <div id="login">
                <?php
                if (!isset($_SESSION["logued_user"])) {
                    echo "<a href=\"?user/login\"><i class=\"fas fa-user\"></i>Login</a>";
                } else {
                    $img = $_SESSION["logued_user"]["imatge"];
                    echo "<a href=\"?user/logout\"><img class=\"user\" src=\"" . $img . "\"></a>";
                }
                ?>
            </div>
            <script>
                function updateLanguage() {
                    var selectedLanguage = document.getElementById('lang').value;
                    window.location.href = '?lang/set/' + selectedLanguage;
                }
            </script>
            <script>
              var navigationMenu = document.querySelector('.navigation-menu');
            
              var numberOfElements = navigationMenu.children.length;
            
              var innerWidthElement = document.querySelector('.inner-width');
            
              if (numberOfElements > 7) {
                innerWidthElement.classList.add('more-than-7');
              }
            </script>
        </nav>
    </div>
</header>
