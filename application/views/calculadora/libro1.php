﻿
    <link rel="stylesheet" href="<?= URL; ?>public/css/960.css" type="text/css" media="screen">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URL; ?>public/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?= URL; ?>public/css/screen.css" type="text/css" media="screen" />
    <link rel="stylesheet" href= "<?= URL; ?>public/css/print-preview.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?= URL; ?>public/css/print.css" type="text/css" media="print" />

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?= URL; ?>public/js/mi.jquery.tools.min.js"></script>
    <script src="<?= URL; ?>public/js/jquery.print-preview.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    $(function() {
/*
        $('#aside').prepend('<a class="print-preview"><img src="<?= URL; ?>public/images/icon-print-preview.png" width="40" heigh="40">&nbsp;Imprimir</img></a>');
*/
        $('#aside').prepend('<a class="print-preview"><img src="<?= URL; ?>public/images/icon-print-preview.png" width="20" heigh="20">&nbsp;</img></a>');
        $('a.print-preview').printPreview();
    });
</script>

<style>

    #navbar {
        display: none;
    }
    
    .items {
        margin: 0 auto;
        align-self: center;
    }

    .items div img {
        height: 350px;
        width: 350px;
        margin: 0 auto 10px auto;
    }

    h2 {
        margin: 0 auto 10px auto;
    }

    p {
        margin: 0 auto 10px auto;
    }

    .resume1{
        font-size: 1em;
        font-family: Arial, sans-serif, 'Trebuchet MS', Futura;
        color:#D0E2F4;
        padding-left: 60px;
        background: transparent;    /* #2A3F54; */
        border-radius: 3px;
    }

    .resume1 div{
        width: auto!important;
        display: inline-block;
        vertical-align: top;
        padding: 10px auto 5px auto;
        margin: 8px 0;
    }

    .grid_3_1{
        width:30px;
    }

</style>

<!--
<div id="header" class="container_12" align="center">

    <strong>:: Libro ::</strong>
</div>
-->

<div id="content" class="container_12 clearfix">

    <div class="resume1">
        
        <div>Caja Libro. ODT: <span><?=$odt ?> | </span></div>
        <div>Base: <span><?=$b ?></span> cm | </div>
        <div>Alto: <span><?=$h ?></span> cm | </div>
        <div>Profundidad: <span><?=$p ?></span> cm | </div>
        <div>Grosor cartón: <span><?=$g ?></span> | </div>
        <div>Grosor cartera: <span><?=$G ?> | </span></div>
    </div>

    <!-- imagen de impresion -->
    <div id="aside" class="grid_3_1"></div>

    <div><?php echo "<br /><br /><br />"; ?></div>

	<!-- Cajón -->
    <div id="content-main" class="grid_12 clearfix">

        <div class="gallery">

            <div class="items">

                <div class="grid_6">

                    <img src="<?= URL; ?>public/images/libro/Cajon_Tipo_Libro-16.jpg" style="width: 350px; height: 350px" />
                </div>

                <div class="grid_6">

                    <div class="print">
                        <div>
                            <table class="print-tabla">
                                <tr>
                                    <td colspan="2" class="print-titulo">
                                        <h2 style="text-align: center;">Cajón</h2>
                                    </td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base del cajón</td>
                                    <td class="nomenclatura_2">b'</td>
                                    <td class="print-td"><?= round($b1,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Altura del cajón</td>
                                    <td class="nomenclatura_2">h'</td>
                                    <td class="print-td"><?=round($h1,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Profundidad del cajón</td>
                                    <td class="nomenclatura_2">p'</td>
                                    <td class="print-td"><?=round($p1,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base extendida del cajón</td>
                                    <td class="nomenclatura_2">x</td>
                                    <td class="print-td"><?php echo round($x,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Altura extendida del cajón</td>
                                    <td class="nomenclatura_2">y</td>
                                    <td class="print-td"><?php echo round($y,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base de cartón para empalme</td>
                                    <td class="nomenclatura_2">x'</td>
                                    <td class="print-td"><?php echo round($x1,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Alto de cartón para empalme</td>
                                    <td class="nomenclatura_2">y'</td>
                                    <td class="print-td"><?php echo round($y1,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base empalme papel</td>
                                    <td class="nomenclatura_2">x''</td>
                                    <td class="print-td"><?php echo round($x11,2) ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Alto empalme papel</td>
                                    <td class="nomenclatura_2">y''</td>
                                    <td class="print-td"><?php echo round($y11,2) ?> cm</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forro -->
    <div id="content-main" class="grid_12 clearfix">

        <div class="gallery">

            <div class="items">

                <div class="grid_6">

                    <img src="<?= URL; ?>public/images/libro/Forro_Cajon_Tipo_Libro-17.jpg" style="width: 350px; height: 350px" />
                </div>

                <div class="grid_6">

                    <div class="print">
                        <div>
                            <table class="print-tabla">
                                <tr>
                                    <td colspan="2" class="print-titulo">
                                        <h2 style="text-align: center;">Forro</h2>
                                    </td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base forro del cajón</td>
                                    <td class="nomenclatura_2">b''</td>
                                    <td class="print-td"><?php echo round($b11, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Alto forro del cajón</td>
                                    <td class="nomenclatura_2">h''</td>
                                    <td class="print-td"><?php echo round($h11, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base del material rebasado para suajar forro</td>
                                    <td class="nomenclatura_2">f</td>
                                    <td class="print-td"><?php echo round($f, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Altura del material rebasado para suajar forro</td>
                                    <td class="nomenclatura_2">k</td>
                                    <td class="print-td"><?php echo round($k, 2); ?> cm</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pagebreak"></div>

    <div class="resume1">
        
        <div>Caja Libro. ODT: <span><?=$odt ?> | </span></div>
        <div>Base: <span><?=$b ?></span> cm | </div>
        <div>Alto: <span><?=$h ?></span> cm | </div>
        <div>Profundidad: <span><?=$p ?></span> cm | </div>
        <div>Grosor cartón: <span><?=$g ?></span> | </div>
        <div>Grosor cartera: <span><?=$G ?> | </span></div>
    </div>

    <div><?php echo "<br /><br /><br />"; ?></div>

    <!-- Cartera -->
    <div id="content-main" class="grid_12 clearfix">

        <div class="gallery">

            <div class="items">

                <div class="grid_6">

                    <img src="<?= URL; ?>public/images/libro/Forro_Tira_Tipo_Libro-18.jpg" style="width: 350px; height: 350px" />
                </div>

                <div class="grid_6">

                    <div class="print">
                        <div>
                            <table class="print-tabla">
                                <tr>
                                    <td colspan="2" class="print-titulo">
                                        <h2 style="text-align: center;">Forro Cajón Tira</h2>
                                    </td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Profundidad del Forro del cajón en Tira</td>
                                    <td class="nomenclatura_2">p''</td>
                                    <td class="print-td"><?php echo round($p11, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Largo de Forro en Tira con pestañas</td>
                                    <td class="nomenclatura_2">l</td>
                                    <td class="print-td"><?php echo round($l, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Largo de Forro en Tira</td>
                                    <td class="nomenclatura_2">l'</td>
                                    <td class="print-td"><?php echo round($l1, 2); ?> cm</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartera -->
    <div id="content-main" class="grid_12 clearfix">

        <div class="gallery">

            <div class="items">

                <div class="grid_6">

                    <img src="<?= URL; ?>public/images/libro/Cartera_Tipo_Libro-19.jpg" style="width: 350px; height: 350px" />
                </div>

                <div class="grid_6">

                    <div class="print">
                        <div>
                            <table class="print-tabla">
                                <tr>
                                    <td colspan="2" class="print-titulo">
                                        <h2 style="text-align: center;">Cartera</h2>
                                    </td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base de la tapa</td>
                                    <td class="nomenclatura_2">B</td>
                                    <td class="print-td"><?php echo round($B, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Alto de la tapa</td>
                                    <td class="nomenclatura_2">H</td>
                                    <td class="print-td"><?php echo round($H, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Profundidad lomo de la cartera</td>
                                    <td class="nomenclatura_2">P</td>
                                    <td class="print-td"><?php echo round($P, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Altura total de la cartera</td>
                                    <td class="nomenclatura_2">Y</td>
                                    <td class="print-td"><?php echo round($Y, 2); ?> cm</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pagebreak"></div>

    <div class="resume1">
        
        <div>Caja Libro. ODT: <span><?=$odt ?> | </span></div>
        <div>Base: <span><?=$b ?></span> cm | </div>
        <div>Alto: <span><?=$h ?></span> cm | </div>
        <div>Profundidad: <span><?=$p ?></span> cm | </div>
        <div>Grosor cartón: <span><?=$g ?></span> | </div>
        <div>Grosor cartera: <span><?=$G ?> | </span></div>
    </div>

    <div><?php echo "<br /><br /><br />"; ?></div>

    <!-- Forro Cartera -->
    <div id="content-main" class="grid_12 clearfix">

        <div class="gallery">

            <div class="items">

                <div class="grid_6">

                    <img src="<?= URL; ?>public/images/libro/Forro_Cartera_Tipo_Libro-20.jpg" style="width: 350px; height: 350px" />
                </div>

                <div class="grid_6">

                    <div class="print">
                        <div>
                            <table class="print-tabla">
                                <tr>
                                    <td colspan="2" class="print-titulo">
                                        <h2 style="text-align: center;">Forro Cartera</h2>
                                    </td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base del forro cartera</td>
                                    <td class="nomenclatura_2">B'</td>
                                    <td class="print-td"><?php echo round($B1, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Altura total del forro de la cartera</td>
                                    <td class="nomenclatura_2">Y'</td>
                                    <td class="print-td"><?php echo round($Y1, 2); ?> cm</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forro Cartera -->
    <div id="content-main" class="grid_12 clearfix">

        <div class="gallery">

            <div class="items">

                <div class="grid_6">

                    <img src="<?= URL; ?>public/images/libro/Guarda_Tipo_Libro-21.jpg" style="width: 350px; height: 350px" />
                </div>

                <div class="grid_6">

                    <div class="print">
                        <div>
                            <table class="print-tabla">
                                <tr>
                                    <td colspan="2" class="print-titulo">
                                        <h2 style="text-align: center;">Forro Cartera</h2>
                                    </td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Base de guarda</td>
                                    <td class="nomenclatura_2">B''</td>
                                    <td class="print-td"><?php echo round($B11, 2); ?> cm</td>
                                </tr>
                                <tr class="print-reng">
                                    <td class="print-td">Alto de la guarda</td>
                                    <td class="nomenclatura_2">Y''</td>
                                    <td class="print-td"><?php echo round($Y11, 2); ?> cm</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

