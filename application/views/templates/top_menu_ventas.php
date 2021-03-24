<nav id="navbar">
    <div id="logo">

        <img src="<?= URL; ?>public/img/white-logo.png">
        <label for="drop" class="toggle burger">☰</label>
    </div>

    <input type="checkbox" id="drop" />

    <ul id="first-ul" class="menu">
        <li class="first-level">

            <a href="<?= BASE_URL; ?>">Inicio</a>
        </li>

        <li class="first-level"><a href="#" style="display: none;"></a>

            <label for="drop-9" class="toggle">Catálogo +</label>
            <a href="#">Catálogo</a>

            <input type="checkbox" id="drop-9" />
            <ul id="sec-ul">
                <li class="sec-level">

                    <a href="<?= URL; ?>cotizador/clientes">Clientes</a>
                </li>
            </ul>
        </li>
            

        <!-- Cotizaciones OK -->
        <li class="first-level">

            <label for="drop-2" class="toggle">Cotizaciones +</label>
            <a href="#">Cotizaciones</a>

            <input type="checkbox" id="drop-2" />

            <ul id="sec-ul">

                <li class="sec-level">

                    <a href="<?= URL; ?>cotizador/getCotizaciones">Cajas</a>
                </li>
                <li class="sec-level">

                    <a href="<?= URL; ?>cotizador/invitaciones">Invitaciones</a>
                </li>

                <!-- //para entregar -->
                <li class="sec-level">

                    <a href="<?= URL; ?>cotizador/getCotizacion">Formato Cotizaciones</a>
                </li>
            </ul>
        </li>

        <!-- Cambios -->
        <li class="first-level">

            <!-- First Tier Drop Down -->
            <label for="drop-5" class="toggle">Cambios +</label>

            <a href="#">Cambios

                <?php
                if (isset($_SESSION['cambios_pendientes']) && $_SESSION['cambios_pendientes'] > 0 && $_SESSION['user']['cambios_admin'] == 'true') { ?>

                    <div class="small-notif"><?= $_SESSION['cambios_pendientes'] ?></div>
                <?php
                }
                ?>
            </a>

            <input type="checkbox" id="drop-5" />

            <ul id="sec-ul">

                <li class="sec-level">

                    <a href="<?= BASE_URL; ?>ventas/cambios_pendientes">Pendientes</a>
                </li>

                <li class="sec-level ">

                    <a class="" href="<?= BASE_URL; ?>ventas/cambios_completados">Realizados</a>
                </li>
            </ul>
        </li>
    
        <!-- Salir -->
        <li class="exit first-level">

            <a href="<?= URL; ?>logout/">Salir</a>
        </li>
    </ul>

    <a href="<?= URL; ?>logout/" class="exitpc">Salir</a>
</nav>