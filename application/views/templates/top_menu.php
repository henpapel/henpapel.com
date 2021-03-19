<?php
$area = $_SESSION['user']['area'];
$ventas = ($area == 'ventas') ? 'ventas' : '';
$produccion = ($area == 'produccion') ? 'produccion' : 'no-produccion';
$superadmin = ($area == 'superadmin') ? 'superadmin' : 'no-superadmin';
?>

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

        <?php
        error_reporting(0);

        $m_usuario = "";
        $m_usuario = $_SESSION['user']['nombre_usuario'];
        $m_usuario = strval($m_usuario);
        $m_usuario = trim($m_usuario);

        if ($m_usuario != "Eduardo") { ?>

            <li class="first-level secTop <?= $produccion ?> <?= $ventas ?> <?= $superadmin ?>"><a href="#" style="display: none;"></a>

                <label for="drop-9" class="toggle">Catálogo +</label>
                <a href="#">Catálogo</a>

                <input type="checkbox" id="drop-9" />
                <ul id="sec-ul">
                    <li class="sec-level">

                        <a href="<?= URL; ?>cotizador/clientes">Clientes</a>
                    </li>
                    <li class="sec-level <?= $produccion ?> <?= $superadmin ?>">

                        <a href="<?= URL; ?>crud/">Papeles</a>
                    </li>
                    <li class="sec-level <?= $produccion ?> <?= $superadmin ?>">
                        <a href="<?= BASE_URL; ?>modificaprocesos/cambioprocesos">Procesos</a>
                    </li>
                    <li class="sec-level <?= $superadmin ?>">

                        <a href="<?= URL; ?>ventas/productos">Productos</a>
                    </li>
                    <li class="sec-level <?= $superadmin ?>">

                        <a href="<?= URL; ?>ventas/invitaciones">Catálogo invitaciones</a>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <!-- Cotizaciones OK -->
            <li class="first-level secTop <?= $ventas ?>  <?= $superadmin ?>">

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

            <!-- //Cambios -->
            <li class="first-level secTop <?= $ventas ?>  <?= $superadmin ?>">

                <!-- //First Tier Drop Down -->
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
                    <li class="sec-level">

                        <a href="<?= URL; ?>ventas/archivos_cargados">Archivos</a>
                    </li>
                </ul>
            </li>

<!--
        $development = ($_SESSION['user']['nombre_usuario'] == 'developer') ? '' : 'style="display:none;"';

        if ($_SESSION['area'] == 'ventas') {

            if (isset($_SESSION['tienda'])) {

                if ($_SESSION['tienda'] == 1) { ?>

                    <li class="first-level secTop">

                        <label for="drop-1" class="toggle">Mostrador +</label>
                        <a href="#">Mostrador</a>
                        <input type="checkbox" id="drop-1" />

                        <ul id="sec-ul">
                            <li class="sec-level">

                                <a href="<?= BASE_URL; ?>ventas/">Punto de Venta</a>
                            </li>
                            <li class="sec-level" style="display: none;">

                                <a href="<?= BASE_URL; ?>uploads/newProduct.php">Agregar Productos</a>
                            </li>
                            <li class="sec-level">

                                <a href="<?= BASE_URL; ?>ventas/movimientos.php">Movimientos</a>
                            </li>
                        </ul>
                    </li>
            <p }
            }?>

            //Cotizaciones OK
            <li class="first-level secTop <?= $ventas ?>  <?= $superadmin ?>">

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

                    //para entregar
                    <li class="sec-level">

                        <a href="<?= URL; ?>cotizador/getCotizacion">Formato Cotizaciones</a>
                    </li>
                </ul>
            </li>

            //Cambios
            <li class="first-level secTop <?= $ventas ?>  <?= $superadmin ?>">

                //First Tier Drop Down
                <label for="drop-5" class="toggle">Cambios +</label>

                <a href="#">Cambios

                    <?p
                    if (isset($_SESSION['cambios_pendientes']) && $_SESSION['cambios_pendientes'] > 0 && $_SESSION['user']['cambios_admin'] == 'true') { ?>

                        <div class="small-notif"><?= $_SESSION['cambios_pendientes'] ?></div>
                    <?p
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
                    <li class="sec-level">

                        <a href="<?= URL; ?>ventas/archivos_cargados">Archivos</a>
                    </li>
                </ul>
            </li>
        <?p  } elseif ($_SESSION['area'] == 'cajas') { ?>

            <li class="first-level">

                <a href="<?= BASE_URL; ?>cajas/guardados">Calculos guardados</a>
            </li>
        <?p } ?>
-->

        <?php if ($_SESSION['user']['cajas_calc'] == 'true') { ?>

            <!-- Cajas -->
            <li class="first-level">

                <!-- First Tier Drop Down -->
                <label for="drop-8" class="toggle">Cajas +</label>
                <a href="#">Cajas</a>

                <input type="checkbox" id="drop-8" />

                <ul id="sec-ul">

                    <li class="sec-level">

                        <a href="<?= BASE_URL; ?>cajas/">Calculadora de cajas</a>
                    </li>
                    <li class="sec-level ">

                        <a class="" href="<?= BASE_URL; ?>cajas/guardados">Calculos guardados</a>
                    </li>
                </ul>
            </li>
        <?php } ?>

        <!-- Producción -->
        <li class="first-level secTop <?= $produccion ?>  <?= $superadmin ?>">

            <label for="drop-10" class="toggle">Producción </label>
            <a href="#">Producción</a>

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
                <li class="sec-level" <?= $development ?>>

                    <a href="<?= URL; ?>remaquila/maquila">Registros Maquila</a>
                </li>
            </ul>
        </li>

        <?php

        error_reporting(0);

        $m_usuario = "";
        $m_usuario = $_SESSION['user']['nombre_usuario'];
        $m_usuario = strval($m_usuario);
        $m_usuario = trim($m_usuario);

        if ($m_usuario != "Eduardo") { ?>

            <!-- Reporte Errores -->
            <li class="first-level" style="display: none">

                <label for="drop-10" class="toggle">Reporte Errores</label>
                <a href="#">Reporte Errores</a>
                <input type="checkbox" id="drop-10" />

                <ul id="sec-ul">

                    <li class="sec-level">
                        <a href="<?= URL; ?>eeerrores/">Reportar errores</a>
                    </li>
                </ul>
            </li>

        <?php } ?>

        <!-- Salir -->
        <li class="exit first-level">

            <a href="<?= URL; ?>logout/">Salir</a>
        </li>

        <?php
        if ($_SESSION['user']['nombre_usuario'] == 'developer' or $_SESSION['user']['nombre_usuario'] == 'developer-prueba' or $_SESSION['user']['nombre_usuario'] == 'developer2') { ?>

            <!-- Cajas -->
            <li class="first-level secTop <?= $produccion ?> <?= $superadmin?>">

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
                    <li class="sec-level">

                        <a href="<?=URL?>/pedidos">Pedidos</a>
                    </li>
                    <li class="sec-level">

                        <a href="#">Compras</a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>

    <a href="<?= URL; ?>logout/" class="exitpc">Salir</a>
</nav>

<script>
    $('.secTop').css('display', 'none');

    $('.no-produccion').css('display', 'none');
    $('.no-superadmin').css('display', 'none');

    $('.produccion').css('display', '');
    $('.ventas').css('display', '');
    $('.superadmin').css('display', '');
</script>