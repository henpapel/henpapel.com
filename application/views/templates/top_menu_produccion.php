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
                <li class="sec-level">

                    <a href="<?= URL; ?>crud/index.php">Papeles</a>
                </li>
                <li class="sec-level">
                    <a href="<?= BASE_URL; ?>modificaprocesos/cambioprocesos">Procesos</a>
                </li>
            </ul>
        </li>

        <!-- Produccion -->
        <li class="first-level">

            <label for="drop-10" class="toggle">Produccion </label>
            <a href="#">Produccion</a>

            <input type="checkbox" id="drop-10" />

            <ul id="sec-ul">

                <li class="sec-level">

                    <a href="<?= URL; ?>velada/">Registro</a>
                </li>
                <li class="sec-level">

                    <a href="<?= URL; ?>velada/editar">Editar</a>
                </li>
                <li class="sec-level">

                    <a href="<?= URL; ?>velada/reporte ">Detalles</a>
                </li>
            </ul>
        </li>

        <!-- Cajas -->
        <li class="first-level">

            <label for="drop-11" class="toggle">Cajas +</label>
            <a href="#">Cajas</a>

            <input type="checkbox" id="drop-11" />

            <ul id="sec-ul">

                <li class="sec-level">

                    <a href="<?= BASE_URL; ?>cajas/">Calculadora</a>
                </li>
                <li class="sec-level ">

                    <a class="" href="<?= BASE_URL; ?>cajas/guardados">Calculos guardados</a>
                </li>
                <li class="sec-level ">

                    <a class="" href="#">Pedidos</a>
                </li>
                <li class="sec-level ">

                    <a class="" href="#">Compras</a>
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