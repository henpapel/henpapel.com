<style type="text/css">
    
    .lblTituloSec{

        align-content: center;
    }
    .panel{

        align-content: center;
    }
    .secciones{

        background-color: lightsteelblue;
        padding: 10px 0;
        border-radius: 5px;
        transition: background-color .5s, color .5s;
    }
    .secciones:hover{

        background: #5B84B1;
        color: #fff;
    }
    .divContenido{

        display: block; text-align: center; width: 100%;
    }

    #divContentI{

        transition: width .2s        
    }

    .divImgC {

        width: 100%;
        text-align: center;
        display: inline-block;
        background-image: url(<?=URL ;?>public/img/worn_dots.png);
        background-repeat: repeat;
        height: 25%;
    }

    @media all and ( max-width: 580px ) {

        .divImgC {

            height: 100px;
        }
    }
</style>

<!-- ******* Formulario de Almeja modelo (1) -->

    <div id="divIzquierdo-slave" class="div-izquierdo" style="display: none; height: 98%; margin: 0px;">

        <div class="divImgC">
            <!-- imagenes de almeja -->
            <div class="img" id="image_1" style="background-image:url(<?=URL ?>public/img/1.png); position: relative; width: 100%;"></div>

            <div class="img" id="image_1_alto" style="display:none;background-image:url(<?=URL ?>public/img/1_alto.png); position: relative; width: 100%;">
            </div>

            <div class="img" id="image_1_ancho" style="display:none;background-image:url(<?=URL ?>public/img/1_ancho.png); position: relative; width: 100%;">
            </div>

            <div class="img" id="image_1_profundidad" style="display:none;background-image:url(<?=URL ?>public/img/1_profundidad.png); position: relative; width: 100%;">
            </div>

            <br>
        </div>

        <!-- formulario de la caja regalo -->
        <div id="divContentI" class="form-content medidas">
            <div class="scroll-plantilla" style="min-width: 120px; width: 92%;">

                <input type="hidden" name="modelo" id="modelo" value="<?=$id_modelo?>">
                <input type="hidden" name="nombre_cliente" id="nombre_cliente" value="<?= $nombrecliente ?>">
                <!--N° Cot-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="odt" class="col-sm-4 col-form-label col-form-label-sm text-secondary">N° Cot: </label>
                    <div class="col-sm-8">
                        
                        <input type="text" class="form-control form-control-sm" name="odt" id="odt" placeholder="######" tabindex="1" onkeyup="caja.desactivarBtn()">
                    </div>
                </div>

                <!--ODT ID-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="id_odt_anterior" class="col-sm-4 col-form-label col-form-label-sm text-secondary">ID: </label>
                    <div class="col-sm-8">
                        
                        <input type="text" class="form-control form-control-sm" name="id_odt_anterior" id="id_odt_anterior" placeholder="ID" tabindex="1" value="" disabled>
                    </div>
                </div>

                <!--Base-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="corte_largo" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Base: </label>
                    <div class="col-sm-8">
                        
                        <input type="number" class="form-control form-control-sm" name="base" id="corte_largo" placeholder="cm" tabindex="2" min="1" onkeyup="caja.desactivarBtn()">
                    </div>
                </div>
                <!--Alto-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="corte_ancho" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Alto: </label>
                    <div class="col-sm-8">
                        
                        <input type="number" class="form-control form-control-sm" name="alto" id="corte_ancho" placeholder="cm" tabindex="3" min="1" onkeyup="caja.desactivarBtn()">
                    </div>
                </div>
                <!--Profundidad-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="profundidad_1" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Prof: </label>
                    <div class="col-sm-8">
                        
                        <input type="number" class="form-control form-control-sm" name="profundidad" id="profundidad_1" placeholder="cm" tabindex="4" min="1" onkeyup="caja.desactivarBtn()">
                    </div>
                </div>
                
                <!--G Cajon-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="grosor_cajon_1" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Grosor Cajón: </label>
                    <div class="col-sm-8">
                        
                        <select class="custom-select custom-select-sm" name="grosor-cajon" id="grosor_cajon_1" tabindex="6" required onchange="caja.desactivarBtn();">
                            
                            <option selected="" value="" disabled>Elige</option>
                            <?php
                                foreach ($cartones as $carton) {

                                    $expensive = $options_model->mostExpensive($carton['numcarton'], round($carton['costo_unitario'], 2));

                                    if ($expensive) {

                                        ?>
                                        <option value="<?=$carton['numcarton']?>"  data-id="<?=$carton['id_papel']?>" data-ancho="<?=$carton['ancho']?>" data-largo="<?=$carton['largo']?>" data-price="<?=$carton['costo_unitario']?>" ><?=$carton['numcarton'] ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--G Cartera-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="grosor_cartera_1" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Grosor Cartera: </label>
                    <div class="col-sm-8">
                        
                        <select class="custom-select custom-select-sm"name="grosor-cartera" id="grosor_cartera_1" tabindex="7" required onchange="caja.desactivarBtn();">
                            
                            <option selected="" value="" disabled>Elige</option>
                            <?php
                            foreach ($cartones as $carton) {

                                $expensive = $options_model->mostExpensive($carton['numcarton'], round($carton['costo_unitario'], 2));

                                if ($expensive) {

                                    ?>
                                    <option value="<?=$carton['numcarton']?>"  data-id="<?=$carton['id_papel']?>" data-ancho="<?=$carton['ancho']?>" data-largo="<?=$carton['largo']?>" data-price="<?=$carton['costo_unitario']?>" ><?=$carton['numcarton'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
<<<<<<< HEAD

<<<<<<< HEAD
                <!-- Botones de CALCULAR, GUARDAR, TABLAS, RESUMEN e IMPRESION -->
                <div id="social" class="social" style="/*width: 45%;*/ float: right; /*display: none;*/">

                    <button id="papeles_submit" type="button" class="btn btn-primary" style="font-size: 10px;" enabled="">CALCULAR</button>

                    <button id="subForm" name="subForm" type="button" class="btn btn-success" style="font-size: 10px;" disabled="" data-toggle="modal" data-target="#modalSaveAll">GUARDAR</button>

                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#procesosModal" style="font-size: 10px;">TABLAS</button>

                    <button type="button" class="btn btn-warning" id="btnResumen" style="font-size: 10px;">RESUMEN</button>

                    <button type="button" id="btnImprimir" class="btn btn-info" style="font-size: 10px;" disabled="">Imprimir</button>
                    <br>

                    <!--<div style="float: left; font-size: 18px; text-align: right; margin-right: 375px;">Cantidad: <input class="cajas-input" name="qty" id="qty" type="number" min="1" step="1" placeholder="Cantidad" tabindex="7" required></div>-->

                    <!-- Suma de la ODT(Total)  -->
                    <div class="btn-group dropup" style="width: 100%; max-width: 400px;">

                        <button type="button" class="btn btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left;">
                            <label style="font-size: 25px; margin-right: 100px;">Total: </label>
                            <label id="Totalplus" style="font-size: 25px;">$0.00</label>
                        </button>

                        <div class="dropdown-menu">

                            <table class="table">
                                <tr>
                                    <td>Subtotal: </td>
                                    <td id="tdSubtotalCaja" class="grand-total">$0.00</td>
                                </tr>
                                <tr>
                                    <td>Utilidad: </td>
                                    <td id="UtilidadDrop">$0.00</td>
                                </tr>
                                <tr>
                                    <td>IVA:</td>
                                    <td id="IVADrop">$0.00</td>
                                </tr>

                                <tr>
                                    <td>ISR: </td>
                                    <td id="ISRDrop">$0.00</td>
                                </tr>
                                <tr>
                                    <td>Comisiones: </td>
                                    <td id="ComisionesDrop">$0.00</td>
                                </tr>
                                <tr>
                                    <td>% Indirecto: </td>
                                    <td id="IndirectoDrop">$0.00</td>
                                </tr>
                                <tr>
                                    <td>Ventas: </td>
                                    <td id="VentasDrop">$0.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" id="descuentoModal" style="border: none; background: white;">Descuento: (0%) </button>
                                    </td>
                                    <td id="DescuentoDrop">$0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!--<div style="float: left; font-size: 25px;">Total: </div>-->
=======
        <div class="div-buttons mt-1 p-1 mb-5" style="height: 20%;">
            
            <button type="button" id="btnabrecierres" class="btn btn-block btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#cierres" ><img border="0" src="<?=URL ;?>public/img/add.png" style="width: 15px;"> Cierre</button>
>>>>>>> parent of 29fd04d (Revert "Avances almeja hasta la fecha")

                    <!--<div  id="gran_total">$0.00</div>-->
=======
                <!--Cantidad-->
                <div class="form-group row mt-2 ml-0">
                    
                    <label for="qty" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Cantidad: </label>
                    <div class="col-sm-8">
                        
                        <input type="number" class="form-control form-control-sm" name="qty" id="qty" placeholder="Cantidad" tabindex="8" min="1" onkeyup="caja.desactivarBtn();">
                    </div>
>>>>>>> parent of e968c60 (Revert "avances 5 de marzo 2021")
                </div>
            </div>
        </div>

        <div class="div-buttons" style="height: 20%; margin-top: 4%; padding: 5px;">
            
            <button type="button" id="btnabrecierres" class="btn btn-block btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#cierres" ><img border="0" src="<?=URL ;?>public/img/add.png" style="width: 15px;"> Cierre</button>

            <div id="ListaCierres" class="">

                <table class="table" id="cieTable">

                    <tbody id="listcierres"></tbody>
                </table>
            </div>


            <button type="button" id="btnabreaccesorios" class="btn btn-block btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#accesorios" ><img border="0" src="<?=URL ;?>public/img/add.png" style="width: 15px;"> Accesorio</button>

            <div id="ListaAccesoriosEmp" class="">

                <table class="table" id="accesoriosTable">
                    <tbody id="listaccesorios">

                    </tbody>
                </table>
            </div>

            <button id="btnabrebancoemp" type="button" class="btn btn-block btn-outline-primary chkSize  btn-sm text-left" data-toggle="modal" data-target="#bancoemp"><img border="0" src="<?=URL ;?>public/img/add.png" style="width: 15px"> Banco</button>

<<<<<<< HEAD
<<<<<<< HEAD
                                        <input name="offsetadic" id="offsetadic" type="text" style="border: none;" readonly>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="offset" id="offset" type="text" style="border: none;" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Digital</td>
                                    <td>

                                        <input name="digital1" id="digital1" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="digitaladic" id="digitaladic" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="digital" id="digital" type="text" style="border: none;" readonly required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Serigrafia</td>
                                    <td>

                                        <input name="serigrafia1" id="serigrafia1" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="serigrafiaadic" id="serigrafiaadic" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="serigrafia" id="serigrafia" type="text" style="border: none;" readonly required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>HS</td>
                                    <td>

                                        <input name="hs1" id="hs1" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="hsadic" id="hsadic" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="hs" id="hs" type="text" style="border: none;" readonly required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Laminado</td>
                                    <td>

                                        <input name="laminado1" id="laminado1" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="laminadoadic" id="laminadoadic" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="laminado" id="laminado" type="text" style="border: none;" readonly required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Barniz UV</td>
                                    <td>

                                        <input name="barniz1" id="barniz1" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="barnizadic" id="barnizadic" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="barniz" id="barniz" type="text" style="border: none;" readonly required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Suaje</td>
                                    <td>

                                        <input name="suaje1" id="suaje1" type="text" style="border: none;" readonly>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="suajeadic" id="suajeadic" type="text" style="border: none;" readonly>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="suaje" id="suaje" type="text" style="border: none;" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Forrado</td>
                                    <td>

                                        <input name="forrado1" id="forrado1" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="forradoadic" id="forradoadic" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="forrado" id="forrado" type="text" style="border: none;" readonly required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Grabado</td>
                                    <td>

                                        <input name="grabadomin" id="grabadomin" type="text" readonly style="border: none;">
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="grabadoadic" id="grabadoadic" type="text" style="border: none;" readonly required>
                                    </td>
                                    <td></td>
                                    <td>

                                        <input name="grabadotot" id="grabadotot" type="text" style="border: none;" readonly required>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="canvacero">

                            <p>Cajon</p>
                            <canvas height="175" width="250" id="cajon" style="margin-right:15px;background-color: #fff;">
                                Su navegador no soporta en elemento CANVAS
                            </canvas>
                        </div>

                        <div class="canvacero">

                            <p>Forro cajon</p>
                            <canvas height="175" width="250" id="forro_cajon" style="margin-right:15px;background-color: #fff;">
                                Su navegador no soporta en elemento CANVAS
                            </canvas>
                        </div>

                        <div class="canvacero">

                            <p>Guarda Cajon</p>
                            <canvas height="175" width="250" id="guarda_cajon" style="margin-right:15px;background-color: #fff;">
                                Su navegador no soporta en elemento CANVAS
                            </canvas>
                        </div>

                        <div class="canvacero">

                            <p>Cartera</p>
                            <canvas height="175" width="250" id="cartera" style="margin-right:15px;background-color: #fff;">
                                Su navegador no soporta en elemento CANVAS
                            </canvas>
                        </div>

                        <div class="canvacero">

                            <p>Forro exterior cartera</p>
                            <canvas height="175" width="250" id="forro_cartera" style="margin-right:15px;background-color: #fff;">
                                Su navegador no soporta en elemento CANVAS
                            </canvas>
                        </div>

                        <div class="canvacero">

                            <p>Forro interior Cartera</p>
                            <canvas height="175" width="250" id="guarda" style="margin-right:15px;background-color: #fff;">
                                Su navegador no soporta en elemento CANVAS
                            </canvas>
                        </div>
                    </div>
                </div>
=======
            <div id="ListaBancoEmp">
=======
            <div id="ListaBancoEmp" class="">
>>>>>>> parent of e968c60 (Revert "avances 5 de marzo 2021")
                <table class="table" id="banTable">
                    <tbody id="listbancoemp">
                        <!-- contenido seleccionado -->
                    </tbody>
                </table>
<<<<<<< HEAD
>>>>>>> parent of 29fd04d (Revert "Avances almeja hasta la fecha")
=======
>>>>>>> parent of e968c60 (Revert "avances 5 de marzo 2021")
            </div>
        </div>
    </div>

<<<<<<< HEAD
<!-- ******* Todos los Modales Impresiones ******* -->
    <!-- Modal Impresiones Empalme -->

    <div class="modal fade" id="Impresiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

<<<<<<< HEAD
            <div class="modal-content">

                <div class="modal-header azulWhi">
                    <h5 class="modal-title" id="exampleModalLongTitle">Impresiones</h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div id="alerterrorimp">

                    </div>

                    <div>

                        <select id="miSelect" class="SelectTSM">

                            <option selected value="selected" disabled>Elige el tipo de impresión</option>

                            <?php
                            foreach ($impresiones as $impresion) {   ?>

                                <option id="Imp" value="<?=$impresion['nombre']?>" data-precio="<?=$impresion['precio']?>" data-id="<?=$impresion['id_impresion']?>"><?=$impresion['nombre']?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>

                    <div id="opImpresionOffset" style="display: none;">

                        <table class="table" style="text-align: left;" >

                            <tbody>

                                <tr>

                                    <td>Número de tintas:</td>
                                    <td>

                                        <input type="number" id="tintasO" value="1" style="width: 50px;" min="1" max="6">
                                    </td>
                                </tr>

                                <tr>

                                    <td colspan="2">

                                        <select  id="SelectImpTipoOff" class="SelectTSM">

                                            <option selected value="selected" disabled>Elige el tipo de offset</option>

                                            <?php
                                            foreach ($TipoImp as $TipoImps) {   ?>

                                                <option id="Imp" value="<?=$TipoImps['nombre']?>" data-precio="<?=$TipoImps['precio']?>" data-id="<?=$TipoImps['id_impresiones_slave']?>"><?=$TipoImps['nombre']?></option>
                                            <?php
                                            }

                                        ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opImpresionDigital" style="display: none;">

                        <table class="table" style="text-align: left;">

                            <tbody>

                                <tr>
=======
<?php
    require "application/views/templates/cotizador/acabados.php";
    require "application/views/templates/cotizador/extras.php";
    require "application/views/templates/cotizador/impresiones.php";
?>
>>>>>>> parent of e968c60 (Revert "avances 5 de marzo 2021")

<script src="<?=URL?>public/js/cotizador/cajas.js"></script>
<script src="<?=URL?>public/js/cotizador/almeja.js"></script>

<script>

    

    // papel(es) seleccionado(s)
    $(document).on("click", "#papeles_submit", function () {

        var grabar = "NO";

        var empalme       = $("#interior_cajon").val();             // empalme
        var forro_cajon   = $("#exterior_cajon").val();             // forro cajon
        var forro_cartera = $("#exterior_cartera").val();           // forro cartera
        var guarda        = $("#interior_cartera").val();          // guarda

        var odt         = $("#odt-1").val();
        var base        = $("#corte_largo").val();
        var altura      = $("#corte_ancho").val();
        var profundidad = $("#profundidad_1").val();
        var gCajon      = $("#grosor_cajon_1").val();
        var gCartera      = $("#grosor_cartera_1").val();
        var cantidad    = $("#qty").val();

        if( revisarPropiedades(odt,"ODT") == false ) return false;

        if( revisarPropiedades(base,"base") == false ) return false;

        if( revisarPropiedades(altura,"altura") == false ) return false;

        if( revisarPropiedades(profundidad,"profundidad") == false ) return false;

        if( revisarPropiedades(gCajon,"grosor cajon") == false ) return false;

        if( revisarPropiedades(gCartera,"grosor cartera") == false ) return false;

        if( revisarPropiedades(cantidad,"cantidad") == false ) return false;

        if( empalme == null || forro_cajon == null || forro_cartera == null || guarda == null ){

            var cadena = "";

            if( empalme == null ) cadena += "empalme <br>";
            if( forro_cajon == null ) cadena += "forro cajon <br>";
            if( forro_cartera == null ) cadena += "forro cartera <br>";
            if( guarda == null ) cadena += "guarda";

            showModError("");

            $("#txtContenido").attr("align", "left");
            $("#txtContenido").html("");
            $("#txtContenido").html("Debe de seleccionar un papel para las siguientes secciones: " + cadena + ".");
        } else {

            if (typeof formData !== 'undefined' && formData.length > 0) {

                formData = [];
            }

            var formData      = $("#caja-form").serializeArray();

            // impresion
            var aImp_tmp     = JSON.stringify(aImp, null, 4);
            var aImpFCaj_tmp = JSON.stringify(aImpFCaj, null, 4);
            var aImpFCar_tmp = JSON.stringify(aImpFCar, null, 4);
            var aImpG_tmp    = JSON.stringify(aImpG, null, 4);

            // acabados
            var aAcb_tmp     = JSON.stringify(aAcb, null, 4);
            var aAcbFCaj_tmp = JSON.stringify(aAcbFCaj, null, 4);
            var aAcbFCar_tmp = JSON.stringify(aAcbFCar, null, 4);
            var aAcbG_tmp    = JSON.stringify(aAcbG, null, 4);

            // cierres
            var aCierres_tmp = JSON.stringify(aCierres, null, 4);


            // bancos
            var aBancos_tmp = JSON.stringify(aBancos, null, 4);


            // accesorios
            var aAccesorios_tmp = JSON.stringify(aAccesorios, null, 4);


            var cliente        = getIdClient();
            var id_cliente_tmp = JSON.stringify(cliente, null, 4);

            formData.push({name: 'id_cliente', value: id_cliente_tmp});
            
            formData.push({name: 'aImp', value: aImp_tmp});
            formData.push({name: 'aImpFCaj', value: aImpFCaj_tmp});
            formData.push({name: 'aImpFCar', value: aImpFCar_tmp});
            formData.push({name: 'aImpG', value: aImpG_tmp});

            formData.push({name: 'aAcb', value: aAcb_tmp});
            formData.push({name: 'aAcbFCaj', value: aAcbFCaj_tmp});
            formData.push({name: 'aAcbFCar', value: aAcbFCar_tmp});
            formData.push({name: 'aAcbG', value: aAcbG_tmp});

            formData.push({name: 'aCierres', value: aCierres_tmp});
            formData.push({name: 'aBancos', value: aBancos_tmp});
            formData.push({name: 'aAccesorios', value: aAccesorios_tmp});

            // descuento

            formData.push({name: 'descuento_pctje', value: descuento});
            formData.push({name: 'grabar', value: grabar});

            var modificar_odt = "NO";

            formData.push({name: 'modificar', value: modificar_odt});


            aCalculos_tmp   = [];
            aCortes_tmp     = [];
            aTr3_tmp        = [];
            aImp_tmp        = [];
            aImpFCaj_tmp    = [];
            aImpFCar_tmp    = [];
            aImpG_tmp       = [];
            aAcb_tmp        = [];
            aAcbFCaj_tmp    = [];
            aAcbFCar_tmp    = [];
            aAcbG_tmp       = [];
            aCierres_tmp    = [];
            aBancos_tmp     = [];
            aAccesorios_tmp = [];
            $("#modLoading").show();
            $.ajax({                    // boton CALCULAR
                type:"POST",
                //dataType: "json",
                url: $('#caja-form').attr('action'),
                data: formData,
            })
            .done(function(response) {

                $("#modLoading").hide();

                console.log(response);

                if ( response ) {

                    try {

                        var js_respuesta = JSON.parse(response); // trae toda la matriz
                        var error        = js_respuesta.error;

                        if (error.length > 0) {

                            showModError("");
                            //$("#txtContenido").html("");
                            $("#txtContenido").html("(3695) " + error);

                            return false;
                        } else {

                            var aJson_stringify = JSON.stringify(js_respuesta, null, 4);

                            console.log('(3706) aJson_stringify: ' + aJson_stringify);
                        }

                        $('#table_adicionales_tr').empty();

                        // (RESUMEN)

                            $('#resumenEmpalme').empty();
                            $('#resumenFcajon').empty();
                            $('#resumenFcartera').empty();
                            $('#resumenGuarda').empty();
                            $('#resumenCartones').empty();
                            $('#resumenOtros').empty();
                            $("#resumenHead").empty();
                            $("#resumenMensajeria").empty();
                            $("#resumenEmpaque").empty();
                            $('#resumenEncuadernacion').empty();

                            var rm_empalme   = '<tr><td><b>Empalme del Cajón</b></td><td></td><td></td><td></td></tr>';
                            var rm_fcajon    = '<tr><td><b>Forro del Cajón</b></td><td></td><td></td><td></td></tr>';
                            var rm_fcartera  = '<tr><td><b>Forro de la Cartera</b></td><td></td><td></td><td></td></tr>';
                            var rm_guarda    = '<tr><td><b>Guarda</b></td><td></td><td></td><td></td></tr>';
                            var rm_cartoncaj = '<tr><td><b>Cartón Cajón</b></td><td></td><td></td><td></td></tr>';
                            var rm_cartoncar = '<tr><td><b>Cartón Cartera</b></td><td></td><td></td><td></td></tr>';
                            var rm_head = "<tr><td><b>ODT: </b>" + js_respuesta['nomb_odt'] + "</td><td><b>Cantidad: </b>" + js_respuesta['tiraje'] + "</td><td><b>Cliente: </b>" + js_respuesta['Nombre_cliente'] + "</td><td><b>Fecha: " + js_respuesta['Fecha'] + "</b></td></tr>";
                            var rm_msj = '<tr><td><b>Costo Mensajería</b></td><td></td><td></td><td></td></tr>';
                            var rm_emp = '<tr><td><b>Costo Empaque</b></td><td></td><td></td><td></td></tr>';
                            var rm_enc = '<tr><td><b>Encuadernación</b></td><td></td><td></td><td></td></tr>';


                            jQuery214('#resumenEmpalme').append(rm_empalme); //imprime para el resumen
                            jQuery214('#resumenFcajon').append(rm_fcajon); //imprime para el resumen
                            jQuery214('#resumenFcartera').append(rm_fcartera); //imprime para el resumen
                            jQuery214('#resumenGuarda').append(rm_guarda); //imprime para el resumen

                            $('#resumenMensajeria').append(rm_msj);
                            $('#resumenEmpaque').append(rm_emp);
                            $('#resumenEncuadernacion').append(rm_enc);


                        // (MENSAJERIA)

                            var costo_msj = "<tr><td></td><td></td><td></td><td>$" + js_respuesta['mensajeria'] + "</td></tr>";
                            $('#resumenMensajeria').append(costo_msj);

                        // (EMPAQUE)

                            var costo_emp = "<tr><td></td><td></td><td></td><td>$" + js_respuesta['empaque'] + "</td></tr>";
                            $('#resumenEmpaque').append(costo_emp);


                        //Papeles y Cartones
                            $('#table_papeles_tr').empty();

                            var tr = '<tr style="background: steelblue;color: white;"><td class="text-light">Parte</td><td class="text-light">Material</td><td class="text-light">C. Unitario</td><td class="text-light">Cortes</td><td class="text-light">P. por hoja</td><td class="text-light">H. sin merma</td><td class="text-light">C. Total</td></tr>';

                            $('#table_papeles_tr').append(tr);

                            appndPapelCarton( js_respuesta['CartonCaj'], "Cartón Cajón" );
                            appndPapelCarton( js_respuesta['Papel_Empalme'], "Empalme Cajón" );
                            appndPapelCarton( js_respuesta['Papel_FCaj'], "Forro Cajón" );
                            appndPapelCarton( js_respuesta['CartonCar'], "Cartón Cartera" );
                            appndPapelCarton( js_respuesta['Papel_FCar'], "Forro Cartera" );
                            appndPapelCarton( js_respuesta['Papel_Guarda'], "Guarda" );

                        // Elaboración cartera

                            var js_elab_car_tiraje = js_respuesta.Elab_Car['tiraje'];


                            var js_elab_car_forro_costo_unit  = js_respuesta.Elab_Car['costo_unit'];


                            if (js_elab_car_forro_costo_unit <= 0) {

                                showModError("Elaboracion Cartera (costo unitario forro)");
                            }


                            var js_elab_car_forro_car = js_respuesta.Elab_Car['forro_costo_tot'];

                            var js_elab_car_guarda_costo_unit = js_respuesta.elab_guarda['costo_unit'];


                            if (js_elab_car_guarda_costo_unit <= 0) {

                                showModError("Elaboracion Guarda (costo unitario guarda");
                            }

                            var js_elab_car_guarda = js_respuesta.elab_guarda['forro_costo_tot'];

                            var js_elab_costo_tot_elab_car = js_elab_car_forro_car + js_elab_car_guarda;


                            var elab_car_tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Elaboración</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ js_elab_car_tiraje +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Totales</td></tr><tr><td>Forro</td><td>$'+ js_elab_car_forro_costo_unit +'</td><td>$'+ js_elab_car_forro_car +'</td></tr><tr><td>Guarda</td><td>$'+ js_elab_car_guarda_costo_unit +'</td><td>$'+ js_elab_car_guarda +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_elab_costo_tot_elab_car +'<input type="hidden" class="prices" value="'+ js_elab_costo_tot_elab_car +'"></td></tr><tr><td colspan="3"></td></tr>';

                            jQuery214('#table_adicionales_tr').append(elab_car_tr);

                            var parteresumen = '<tr><td></td><td>Elaboración</td><td>$'+ js_elab_car_forro_car +'<input type="hidden" class="pricesresumenfcartera" value="' + js_elab_car_forro_car + '"></td><td></td></tr>';

                            jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen

                            var parteresumen = '<tr><td></td><td>Elaboración</td><td>$'+ js_elab_car_guarda +'<input type="hidden" class="pricesresumenguarda" value="' + js_elab_car_guarda + '"></td><td></td></tr>';

                            jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen


                        // Ranurado

                            var js_ranurado_tiraje  = js_respuesta.arreglo_ranurado_hor_emp['tiraje'];
                            var js_ranurado_arreglo = js_respuesta.arreglo_ranurado_hor_emp['arreglo'];


                            var js_ranurado_costo_unit_por_ranura = js_respuesta.arreglo_ranurado_hor_emp['costo_unit_por_ranura'];


                            if (js_ranurado_costo_unit_por_ranura <= 0) {

                                showModError("Ranurado (costo unitario por ranura)");
                            }


                            var js_ranurado_costo_por_ranura      = js_respuesta.arreglo_ranurado_hor_emp['costo_por_ranura'];
                            var js_ranurado_costo_tot_ranurado    = js_respuesta.arreglo_ranurado_hor_emp['costo_tot_proceso'];



                            var js_ranurado_costo_unit_por_ranura2 = js_respuesta.arreglo_ranurado_hor_fcar['costo_unit_por_ranura'];


                            if (js_ranurado_costo_unit_por_ranura2 <= 0) {

                                showModError("Ranurado Forro Cartera (costo unitario por ranura)");
                            }


                            var js_ranurado_costo_por_ranura2 = js_respuesta.arreglo_ranurado_hor_fcar['costo_por_ranura'];


                            var js_ranurado_costo_tot_todo_ranura  = js_ranurado_costo_tot_ranurado + js_ranurado_costo_por_ranura2;

                            var ranurado_tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Ranurado</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ js_ranurado_tiraje +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ js_ranurado_arreglo +'</td><td>$'+ js_ranurado_arreglo +'</td></tr><tr><td>Ranurado Cajón</td><td>$'+ js_ranurado_costo_unit_por_ranura +'</td><td>$'+ js_ranurado_costo_por_ranura +'</td></tr><tr><td>Ranurado Cartera</td><td>$'+ js_ranurado_costo_unit_por_ranura2 +'</td><td>$'+ js_ranurado_costo_por_ranura2 +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_ranurado_costo_tot_todo_ranura +'<input type="hidden" class="prices" value="'+ js_ranurado_costo_tot_todo_ranura +'"></td></tr><tr><td colspan="3"></td></tr>';

                            jQuery214('#table_adicionales_tr').append(ranurado_tr);

                            var parteresumen = '<tr><td></td><td>Ranurado</td><td>$'+ js_ranurado_costo_tot_ranurado +'<input type="hidden" class="pricesresumenfcajon" value="' + js_ranurado_costo_tot_ranurado + '"></td><td></td></tr>';

                            jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen

                            var parteresumen = '<tr><td></td><td>Ranurado</td><td>$'+ js_ranurado_costo_por_ranura2 +'<input type="hidden" class="pricesresumenfcartera" value="' + js_ranurado_costo_por_ranura2 + '"></td><td></td></tr>';

                            jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen


                        // Encuadernacion

                            var js_encuadernacionranurado_tiraje = js_respuesta.Encuadernacion_emp['tiraje'];


                            var js_encuadernacion_encajada_costo_unitario = js_respuesta['encajada']['costo_unitario'];


                            if (js_encuadernacion_encajada_costo_unitario <= 0) {

                                showModError("Encuadernacion (costo unitario encajada)");
                            }



                            var js_encuadernacion_Encajada = js_respuesta['encajada']['costo_tot_proceso'];

                            var js_encuadernacion_costo_tot_proceso = js_respuesta.Encuadernacion_emp['costo_tot_proceso'];


                            var js_encuadernacion_puesta_banco_costo_unit = js_respuesta.Encuadernacion_emp['puesta_banco_costo_unit'];


                            if (js_encuadernacion_puesta_banco_costo_unit <= 0) {

                                showModError("Encuadernacion (costo unitario puesta banco)");
                            }


                            var js_encuadernacion_Puesta_de_banco = js_respuesta.Encuadernacion_emp['puesta_de_banco'];

                            var js_encuadernacion_costo_tot_proceso = js_respuesta.Encuadernacion_emp['costo_tot_proceso'];

                            var js_encuadernacion_costo_unitario_iman = js_respuesta.Encuadernacion_emp['costo_unitario_iman'];


                            if (js_encuadernacion_costo_unitario_iman <= 0) {

                                showModError("Encuadernacion (costo unitario iman)");
                            }


                            var js_encuadernacion_Perforado_para_iman_y_puesta_de_iman = js_respuesta.Encuadernacion_emp['perforado_para_iman_y_puesta_de_iman'];


                            var js_encuadernacion_despunte_costo_unitario = js_respuesta.despunte_esquinas['costo_unitario_esquinas'];


                            if (js_encuadernacion_despunte_costo_unitario <= 0) {

                                showModError("Encuadernacion (costo unitario despunte)");
                            }


                            var js_encuadernacion_Despunte_de_esquinas_para_cajon = js_respuesta.despunte_esquinas['costo_tot_proceso'];



                            var js_encuadernacion_costo_unitario_Forrado_de_cajon = js_respuesta.Encuadernacion_FCaj['forrado_cajon_costo_unit'];


                            if (js_encuadernacion_costo_unitario_Forrado_de_cajon <= 0) {

                                showModError("Encuadernacion (costo unitario Forrado de Cajon");
                            }


                            var js_encuadernacion_Forrado_de_cajon = js_respuesta.Encuadernacion_FCaj['forrado_de_cajon'];

                            var js_encuadernacion_Arreglo_de_Forrado_de_cajon = js_respuesta.Encuadernacion_FCaj['arreglo_costo_unitario'];


                            var js_encuadernacion_empalme_cajon_costo_unitario = js_respuesta.Encuadernacion_FCaj['empalme_cajon_costo_unitario'];

                            if (js_encuadernacion_empalme_cajon_costo_unitario <= 0) {

                                showModError("Encuadernacion (costo unitario empalme cajon)");
                            }


                            var js_encuadernacion_Empalme_de_cajon = js_respuesta.Encuadernacion_FCaj['empalme_de_cajon'];


                            var ranurado_tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Encuadernación</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ js_encuadernacionranurado_tiraje +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Despunte</td><td>$'+ js_encuadernacion_despunte_costo_unitario +'</td><td>$'+ js_encuadernacion_Despunte_de_esquinas_para_cajon +'</td></tr><tr><td>Forrado</td><td>$'+ js_encuadernacion_costo_unitario_Forrado_de_cajon +'</td><td>$'+ js_encuadernacion_Forrado_de_cajon +'</td></tr><tr><td>Arreglo Forrado</td><td>$'+ js_encuadernacion_Arreglo_de_Forrado_de_cajon +'</td><td>$'+ js_encuadernacion_Arreglo_de_Forrado_de_cajon +'</td></tr><tr><td>Encajada</td><td>$'+ js_encuadernacion_encajada_costo_unitario +'</td><td>$'+ js_encuadernacion_Encajada +'</td></tr><tr><td>Empalme</td><td>$'+ js_encuadernacion_empalme_cajon_costo_unitario +'</td><td>$'+ js_encuadernacion_Empalme_de_cajon +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_encuadernacion_costo_tot_proceso +'<input type="hidden" class="prices" value="'+ js_encuadernacion_costo_tot_proceso +'"></td></tr><tr><td colspan="3"></td></tr>';

                            var parteresumen = '<tr><td></td><td></td><td></td><td>$'+ js_respuesta['Encuadernacion_emp']['costo_tot_proceso'] +'</td></tr>';

                            $('#resumenEncuadernacion').append(parteresumen); //imprime para el resumen
                            $('#resumenFcajon').append("<tr><td></td><td>Encuadernación</td><td>$" + js_respuesta['Encuadernacion_FCaj']['costo_tot_proceso'] + " <input type='hidden' class='pricesresumenfcajon' value=" + js_respuesta['Encuadernacion_FCaj']['costo_tot_proceso'] + "></td><td></td></tr>");
                            $('#resumenEmpalme').append("<tr><td></td><td>Encuadernación</td><td>$" + js_respuesta['Encuadernacion_emp']['costo_tot_proceso'] + " <input type='hidden' class='pricesresumenempalme' value=" + js_respuesta['Encuadernacion_emp']['costo_tot_proceso'] + "</td><td></td></tr>");
                            $('#table_adicionales_tr').append(ranurado_tr);


                        //Variables gral de IMPRESIONES

                            $('#proceso_offset_M1').hide();

                            $('#proceso_serigrafia_M1').hide();

                            $('#proceso_digital_M1').hide();

                            $('#table_proc_offset').empty();

                            $('#table_proc_serigrafia').empty();

                            $('#table_proc_digital').empty();


                            // Empalme Proceso Offset

                            if ("OffEmp" in js_respuesta) {

                                var js_variable_extra1 = js_respuesta.OffEmp; //trae los valores de OffEmp

                                for ( a in js_variable_extra1 ) {

                                    var js_costo_unitario_laminas_emp = js_variable_extra1[a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Empalme (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra1[a]['costo_tot_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra1[a]['costo_unitario_arreglo'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Ofsset Empalme (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra1[a]['costo_tot_arreglo'];


                                    var js_costo_unitario_tiro_emp = js_variable_extra1[a]['costo_unitario_tiro'];


                                    if (js_costo_unitario_tiro_emp <= 0) {

                                        showModError("Offset Empalme (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_emp = js_variable_extra1[a]['costo_tiro'];

                                    //*** otros datos ****
                                    var js_cantidad_emp   = js_variable_extra1[a]['cantidad'];
                                    var js_tipo_emp       = js_variable_extra1[a]['tipo_offset'];
                                    var js_num_tintas_emp = js_variable_extra1[a]['num_tintas'];


                                    var js_total_offset_emp = js_costo_tot_laminas_emp + js_costo_tot_arreglo_emp + js_costo_tot_tiro_emp;


                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Empalme del Cajón</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>'+ js_costo_unitario_laminas_emp +'</td><td>'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>'+ js_costo_unitario_arreglo_emp +'</td><td>'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Tiro</td><td>'+ js_costo_unitario_tiro_emp +'</td><td>'+ js_costo_tot_tiro_emp +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                }
                            } else if ( js_respuesta.Off_maq_Emp ){

                                var js_variable_extra1_1 = js_respuesta.Off_maq_Emp; //trae los valores de Off_maq_Emp

                                for ( a_a in js_variable_extra1_1 ) {

                                    var js_costo_unitario_laminas_emp = js_variable_extra1_1[a_a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra1_1[a_a]['costo_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo_unitario'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo'];


                                    var js_costo_unitario_maquila = js_variable_extra1_1[a_a]['costo_unitario_maq'];


                                    if (js_costo_unitario_maquila <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario tiro)");
                                    }


                                    var js_costo_tot_maquila = js_variable_extra1_1[a_a]['costo_tot_maq'];

                                    //*** otros datos ****
                                    var js_cantidad_emp   = js_variable_extra1_1[a_a]['cantidad'];
                                    var js_tipo_emp       = js_variable_extra1_1[a_a]['Tipo'];
                                    var js_num_tintas_emp = js_variable_extra1_1[a_a]['num_tintas'];

                                    var js_total_offset_emp = js_costo_tot_laminas_emp + js_costo_tot_arreglo_emp + js_costo_tot_maquila;

                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Empalme del Cajón</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ js_costo_unitario_laminas_emp +'</td><td>$'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_costo_unitario_arreglo_emp +'</td><td>$'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Maquila</td><td>$'+ js_costo_unitario_maquila +'</td><td>$'+ js_costo_tot_maquila +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    //$('#table_proc_offset').empty();

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                }
                            }



                            // Empalme Proceso Serigrafia

                            if ("SerEmp" in js_respuesta) {

                                var js_variable_extra2 = js_respuesta.SerEmp; //trae los valores de SerEmp

                                for ( b in js_variable_extra2 ) {

                                    var js_cantidad_seri = js_variable_extra2[b]['cantidad'];

                                    var js_tipo_seri = js_variable_extra2[b]['tipo'];

                                    var js_num_tintas_seri = js_variable_extra2[b]['num_tintas'];


                                    var js_costo_unitario_arreglo_seri = js_variable_extra2[b]['costo_unit_arreglo'];


                                    if (js_costo_unitario_arreglo_seri <= 0) {

                                        showModError("Serigrafia Empalme (costo unitario arreglo)");
                                    }


                                    var js_costo_arreglo_seri = js_variable_extra2[b]['costo_arreglo'];


                                    var js_costo_unitario_tiro_seri = js_variable_extra2[b]['costo_unitario_tiro'];


                                    if (js_costo_unitario_tiro_seri <= 0) {

                                        showModError("Serigrafia Empalme (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_serigrafia = js_variable_extra2[b]['costo_tiro']; //js_variable_extra2[b]['costo_tiro'];


                                    var js_tot_serigrafia_emp = js_costo_arreglo_seri + js_costo_tot_tiro_serigrafia;


                                    var processserigrafia = '<tr><td colspan="3" style="background: steelblue;color: white;">Empalme del Cajón</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_seri +'</td><td>Tipo: '+ js_tipo_seri +'</td><td>Tintas: '+ js_num_tintas_seri +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>'+ js_costo_unitario_arreglo_seri +'</td><td>'+ js_costo_arreglo_seri +'</td></tr><tr><td>Tiro</td><td>'+ js_costo_unitario_tiro_seri +'</td><td>'+ js_costo_tot_tiro_serigrafia +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="prices" value="'+ js_tot_serigrafia_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_serigrafia').append(processserigrafia);

                                    $('#proceso_serigrafia_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_tot_serigrafia_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                }
                            }


                            // Empalme Proceso Digital
                            if ("DigEmp" in js_respuesta) {

                                var js_variable_extra3 = js_respuesta.DigEmp; //trae los valores de DigEmp

                                if ("impresion_digital" in js_variable_extra3) {

                                    showModError("No cabe la impresión en Digital(Empalme) con estas medidas.");
                                } else  {

                                    for ( c in js_variable_extra3 ) {

                                        var js_cantidad_con_merma_digital = js_variable_extra3[c]['tiraje'];


                                        var js_costo_unitario_digital = js_variable_extra3[c]['costo_unitario'];


                                        if (js_costo_unitario_digital <= 0) {

                                            showModError("Digital Empalme (costo unitario tiro)");
                                        }


                                        var js_costo_tot_digital = js_variable_extra3[c]['costo_tot_proceso'];

                                        var processdigital = '<tr><td colspan="4" style="background: steelblue;color: white;">Empalme del Cajón</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Costo Total</td></tr><tr><td>'+ js_cantidad_con_merma_digital +'</td><td>'+ js_costo_unitario_digital +'</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="prices" value=" '+ js_costo_tot_digital +'"></td></tr><tr><td colspan="4"></td></tr>';

                                        jQuery214('#table_proc_digital').append(processdigital);

                                        $('#proceso_digital_M1').show();

                                        var parteresumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_digital +'"></td><td></td></tr>';

                                        jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                    }
                                }
                            }



                        //Forro del Cajón (IMPRESIONES)

                            // Fcajon Proceso Offset

                            if ("OffFCaj" in js_respuesta) {

                                var js_variable_extra4 = js_respuesta.OffFCaj; //trae los valores de OffFCaj

                                for ( a in js_variable_extra4 ) {

                                    var js_costo_unitario_laminas_emp = js_variable_extra4[a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Forro del Cajon (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra4[a]['costo_tot_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra4[a]['costo_unitario_arreglo'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Offset Forro del Cajon (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra4[a]['costo_tot_arreglo'];


                                    var js_costo_unitario_tiro_emp = js_variable_extra4[a]['costo_unitario_tiro'];


                                    if (js_costo_unitario_tiro_emp <= 0) {

                                        showModError("Offset Forro del Cajon (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_emp = js_variable_extra4[a]['costo_tiro'];
                                    //js_variable_extra4[a]['costo_tot_tiro'];


                                    // *** otros datos ****
                                    var js_cantidad_emp = js_variable_extra4[a]['cantidad'];

                                    var js_tipo_emp = js_variable_extra4[a]['tipo_offset'];

                                    var js_num_tintas_emp = js_variable_extra4[a]['num_tintas'];


                                    var js_total_offset_emp = js_variable_extra4[a]['costo_tot_proceso'];

                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Forro del Cajón</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ js_costo_unitario_laminas_emp +'</td><td>$'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_costo_unitario_arreglo_emp +'</td><td>$'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Tiro</td><td>$'+ js_costo_unitario_tiro_emp +'</td><td>$'+ js_costo_tot_tiro_emp +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();


                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                }
                            } else if ( js_respuesta.Off_maq_FCaj ){

                                var js_variable_extra1_1 = js_respuesta.Off_maq_FCaj; //trae los valores de Off_maq_FCaj

                                for ( a_a in js_variable_extra1_1 ) {

                                    var js_costo_unitario_laminas_emp = js_variable_extra1_1[a_a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra1_1[a_a]['costo_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo_unitario'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo'];


                                    var js_costo_unitario_maquila = js_variable_extra1_1[a_a]['costo_unitario_maq'];


                                    if (js_costo_unitario_maquila <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario tiro)");
                                    }


                                    var js_costo_tot_maquila = js_variable_extra1_1[a_a]['costo_tot_maq'];

                                    //*** otros datos ****
                                    var js_cantidad_emp   = js_variable_extra1_1[a_a]['cantidad'];
                                    var js_tipo_emp       = js_variable_extra1_1[a_a]['Tipo'];
                                    var js_num_tintas_emp = js_variable_extra1_1[a_a]['num_tintas'];

                                    var js_total_offset_emp = js_variable_extra1_1[a_a]['costo_tot_proceso'];

                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Forro del Cajón</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ js_costo_unitario_laminas_emp +'</td><td>$'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_costo_unitario_arreglo_emp +'</td><td>$'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Maquila</td><td>$'+ js_costo_unitario_maquila +'</td><td>$'+ js_costo_tot_maquila +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    //$('#table_proc_offset').empty();

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                }
                            }


                            // Fcajon Proceso Serigrafia

                            if ("SerFCaj" in js_respuesta) {

                                var js_variable_extra5 = js_respuesta.SerFCaj; //trae los valores de SerFCaj

                                for ( b in js_variable_extra5 ) {

                                    var js_cantidad_seri = js_variable_extra5[b]['cantidad'];

                                    var js_tipo_seri = js_variable_extra5[b]['tipo'];

                                    var js_num_tintas_seri = js_variable_extra5[b]['num_tintas'];


                                    var js_costo_unitario_arreglo_seri = js_variable_extra5[b]['costo_unit_arreglo'];


                                    if (js_costo_unitario_arreglo_seri <= 0) {

                                        showModError("Serigrafia Forro del Cajon (costo unitario arreglo)");
                                    }


                                    var js_costo_arreglo_seri = js_variable_extra5[b]['costo_arreglo'];


                                    var js_costo_unitario_tiro_seri = js_variable_extra5[b]['costo_unitario_tiro'];

                                    if (js_costo_unitario_tiro_seri <= 0) {

                                        showModError("Serigrafia Forro del Cajon (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_serigrafia = js_variable_extra5[b]['costo_tiro'];


                                    var js_tot_serigrafia_emp = js_costo_arreglo_seri + js_costo_tot_tiro_serigrafia;


                                    var processserigrafia = '<tr><td colspan="3" style="background: steelblue;color: white;">Forro del Cajón</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_seri +'</td><td>Tipo: '+ js_tipo_seri +'</td><td>Tintas: '+ js_num_tintas_seri +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>'+ js_costo_unitario_arreglo_seri +'</td><td>'+ js_costo_arreglo_seri +'</td></tr><tr><td>Tiro</td><td>'+ js_costo_unitario_tiro_seri +'</td><td>'+ js_costo_tot_tiro_serigrafia +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="prices" value="'+ js_tot_serigrafia_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_serigrafia').append(processserigrafia);

                                    $('#proceso_serigrafia_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_tot_serigrafia_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                }
                            }

                            // Fcajon Proceso Digital

                            if ("DigFCaj" in js_respuesta) {

                                var js_variable_extra6 = js_respuesta.DigFCaj; //trae los valores de DigFCaj

                                if ("impresion_digital" in js_variable_extra6) {

                                    showModError("No cabe la impresión Digital(Forro del Cajon) con estas medidas.");
                                } else  {

                                    for ( c in js_variable_extra6 ) {

                                        var js_cantidad_con_merma_digital = js_variable_extra6[c]['tiraje'];


                                        var js_costo_unitario_digital = js_variable_extra6[c]['costo_unitario'];


                                        if (js_costo_unitario_digital <= 0) {

                                            showModError("Digital Forro del Cajon (costo unitario tiro)");
                                        }


                                        var js_costo_tot_digital = js_variable_extra6[c]['costo_tot_proceso'];

                                        var processdigital = '<tr><td colspan="4" style="background: steelblue;color: white;">Forro del Cajón</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Coto Total</td></tr><tr><td>'+ js_cantidad_con_merma_digital +'</td><td>'+ js_costo_unitario_digital +'</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="prices" value="'+ js_costo_tot_digital +'"></td></tr><tr><td colspan="4"></td></tr>';

                                        jQuery214('#table_proc_digital').append(processdigital);

                                        $('#proceso_digital_M1').show();

                                        var parteresumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_digital +'"></td><td></td></tr>';

                                        jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                    }
                                }
                            }

                        // Forro de la Cartera (IMPRESIONES)

                            // Fcartera Proceso Offset

                            if ("OffFCar" in js_respuesta) {

                                var js_variable_extra7 = js_respuesta.OffFCar; //trae los valores de OffFCar

                                for ( a in js_variable_extra7 ) {

                                    var js_costo_unitario_laminas_emp = js_variable_extra7[a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Forro Cartera (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra7[a]['costo_tot_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra7[a]['costo_unitario_arreglo'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Offset Forro Cartera (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra7[a]['costo_tot_arreglo'];


                                    var js_costo_unitario_tiro_emp = js_variable_extra7[a]['costo_unitario_tiro'];


                                    if (js_costo_unitario_tiro_emp <= 0) {

                                        showModError("Offset Forro Cartera (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_emp = js_variable_extra7[a]['costo_tiro'];


                                    //*** otros datos ****
                                    var js_cantidad_emp     = js_variable_extra7[a]['cantidad'];
                                    var js_tipo_emp         = js_variable_extra7[a]['tipo_offset'];
                                    var js_num_tintas_emp   = js_variable_extra7[a]['num_tintas'];

                                    var js_total_offset_emp = js_variable_extra7[a]['costo_tot_proceso'];


                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Forro de la Cartera</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ js_costo_unitario_laminas_emp +'</td><td>$'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_costo_unitario_arreglo_emp +'</td><td>$'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Tiro</td><td>$'+ js_costo_unitario_tiro_emp +'</td><td>$'+ js_costo_tot_tiro_emp +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                }
                            } else if ( js_respuesta.Off_maq_FCar ){

                                var js_variable_extra1_1 = js_respuesta.Off_maq_FCar; //trae los valores de Off_maq_FCar

                                for ( a_a in js_variable_extra1_1 ) {

                                    var js_costo_unitario_laminas_emp = js_variable_extra1_1[a_a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra1_1[a_a]['costo_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo_unitario'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo'];


                                    var js_costo_unitario_maquila = js_variable_extra1_1[a_a]['costo_unitario_maq'];


                                    if (js_costo_unitario_maquila <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario tiro)");
                                    }


                                    var js_costo_tot_maquila = js_variable_extra1_1[a_a]['costo_tot_maq'];

                                    //*** otros datos ****
                                    var js_cantidad_emp   = js_variable_extra1_1[a_a]['cantidad'];
                                    var js_tipo_emp       = js_variable_extra1_1[a_a]['Tipo'];
                                    var js_num_tintas_emp = js_variable_extra1_1[a_a]['num_tintas'];

                                    var js_total_offset_emp = js_variable_extra1_1[a_a]['costo_tot_proceso'];

                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Forro de la Cartera</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ js_costo_unitario_laminas_emp +'</td><td>$'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_costo_unitario_arreglo_emp +'</td><td>$'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Maquila</td><td>$'+ js_costo_unitario_maquila +'</td><td>$'+ js_costo_tot_maquila +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    //$('#table_proc_offset').empty();

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                }
                            }


                            // Fcartera Proceso Serigrafia

                            if ("SerFCar" in js_respuesta) {

                                var js_variable_extra8 = js_respuesta.SerFCar; //trae los valores de SerFCar

                                for ( b in js_variable_extra8 ) {

                                    var js_cantidad_seri   = js_variable_extra8[b]['cantidad'];
                                    var js_tipo_seri       = js_variable_extra8[b]['tipo'];
                                    var js_num_tintas_seri = js_variable_extra8[b]['num_tintas'];


                                    var js_costo_unitario_arreglo_seri = js_variable_extra8[b]['costo_unit_arreglo'];


                                    if (js_costo_unitario_arreglo_seri <= 0) {

                                        showModError("Serigrafia Forro Cartera (costo unitario arreglo)");
                                    }


                                    var js_costo_arreglo_seri = js_variable_extra8[b]['costo_arreglo'];

                                    var js_costo_unitario_tiro_seri  = js_variable_extra8[b]['costo_unitario_tiro'];


                                    if (js_costo_unitario_tiro_seri <= 0) {

                                        showModError("Serigrafia Forro Cartera (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_serigrafia = js_variable_extra8[b]['costo_tiro'];

                                    var js_tot_serigrafia_emp  = js_costo_arreglo_seri + js_costo_tot_tiro_serigrafia

                                    var processserigrafia = '<tr><td colspan="3" style="background: steelblue;color: white;">Forro de la Cartera</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_seri +'</td><td>Tipo: '+ js_tipo_seri +'</td><td>Tintas: '+ js_num_tintas_seri +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>'+ js_costo_unitario_arreglo_seri +'</td><td>'+ js_costo_arreglo_seri +'</td></tr><tr><td>Tiro</td><td>'+ js_costo_unitario_tiro_seri +'</td><td>'+ js_costo_tot_tiro_serigrafia +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="prices" value="'+ js_tot_serigrafia_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_serigrafia').append(processserigrafia);

                                    $('#proceso_serigrafia_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_tot_serigrafia_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                }
                            }

                            // Fcartera Proceso Digital

                            if ("DigFCar" in js_respuesta) {

                                var js_variable_extra9 = js_respuesta.DigFCar; //trae los valores de DigFCar

                                if ("impresion_digital" in js_variable_extra9) {

                                    showModError("No cabe la impresión en Digital(Forro Cartera) con estas medidas.");
                                } else  {

                                    for ( c in js_variable_extra9 ) {

                                        var js_cantidad_con_merma_digital = js_variable_extra9[c]['tiraje'];


                                        var js_costo_unitario_digital = js_variable_extra9[c]['costo_unitario'];


                                        if (js_costo_unitario_digital <= 0) {

                                            showModError("Digital Forro Cartera (costo unitario tiro)");
                                        }


                                        var js_costo_tot_digital = js_variable_extra9[c]['costo_tot_proceso'];

                                        var processdigital = '<tr><td colspan="4" style="background: steelblue;color: white;">Forro de la Cartera</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Coto Total</td></tr><tr><td>'+ js_cantidad_con_merma_digital +'</td><td>'+ js_costo_unitario_digital +'</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="prices" value="'+ js_costo_tot_digital +'"></td></tr><tr><td colspan="4"></td></tr>';

                                        jQuery214('#table_proc_digital').append(processdigital);

                                        $('#proceso_digital_M1').show();

                                        var parteresumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_digital +'"></td><td></td></tr>';

                                        jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                    }
                                }
                            }

                        // Guarda (IMPRESIONES)

                            // Guarda Proceso Offset

                            if ("OffG" in js_respuesta) {

                                var js_variable_extra10 = js_respuesta.OffG; //trae los valores de OffG

                                for ( a in js_variable_extra10 ) {


                                    var js_costo_unitario_laminas_emp = js_variable_extra10[a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Guarda (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra10[a]['costo_tot_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra10[a]['costo_unitario_arreglo'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Offset Guarda (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra10[a]['costo_tot_arreglo'];


                                    var js_costo_unitario_tiro_emp = js_variable_extra10[a]['costo_unitario_tiro'];

                                    if (js_costo_unitario_tiro_emp <= 0) {

                                        showModError("Offset Guarda (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_emp = js_variable_extra10[a]['costo_tiro'];


                                    //*** otros datos ****
                                    var js_cantidad_emp    = js_variable_extra10[a]['cantidad'];
                                    var js_tipo_emp        = js_variable_extra10[a]['tipo_offset'];
                                    var js_num_tintas_emp  = js_variable_extra10[a]['num_tintas'];

                                    var js_total_offset_emp = js_variable_extra10[a]['costo_tot_proceso'];


                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Guarda</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ js_costo_unitario_laminas_emp +'</td><td>$'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_costo_unitario_arreglo_emp +'</td><td>$'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Tiro</td><td>$'+ js_costo_unitario_tiro_emp +'</td><td>$'+ js_costo_tot_tiro_emp +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                }
                            } else if ( js_respuesta.Off_maq_G ){

                                var js_variable_extra1_1 = js_respuesta.Off_maq_G; //trae los valores de Off_maq_G

                                for ( a_a in js_variable_extra1_1 ) {

                                    var js_costo_unitario_laminas_emp = js_variable_extra1_1[a_a]['costo_unitario_laminas'];


                                    if (js_costo_unitario_laminas_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario laminas)");
                                    }


                                    var js_costo_tot_laminas_emp = js_variable_extra1_1[a_a]['costo_laminas'];


                                    var js_costo_unitario_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo_unitario'];


                                    if (js_costo_unitario_arreglo_emp <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario arreglo)");
                                    }


                                    var js_costo_tot_arreglo_emp = js_variable_extra1_1[a_a]['arreglo_costo'];


                                    var js_costo_unitario_maquila = js_variable_extra1_1[a_a]['costo_unitario_maq'];


                                    if (js_costo_unitario_maquila <= 0) {

                                        showModError("Offset Empalme Maquila (costo unitario tiro)");
                                    }


                                    var js_costo_tot_maquila = js_variable_extra1_1[a_a]['costo_tot_maq'];

                                    //*** otros datos ****
                                    var js_cantidad_emp   = js_variable_extra1_1[a_a]['cantidad'];
                                    var js_tipo_emp       = js_variable_extra1_1[a_a]['Tipo'];
                                    var js_num_tintas_emp = js_variable_extra1_1[a_a]['num_tintas'];

                                    var js_total_offset_emp = js_costo_tot_laminas_emp + js_costo_tot_arreglo_emp + js_costo_tot_maquila;

                                    // imprime en la tabla de procesos añadidos Offset
                                    var processoffset = '<tr><td colspan="3" style="background: steelblue;color: white;">Guardado</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_emp +'</td><td>Tipo: '+ js_tipo_emp +'</td><td>Tintas: '+ js_num_tintas_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ js_costo_unitario_laminas_emp +'</td><td>$'+ js_costo_tot_laminas_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_costo_unitario_arreglo_emp +'</td><td>$'+ js_costo_tot_arreglo_emp +'</td></tr><tr><td>Maquila</td><td>$'+ js_costo_unitario_maquila +'</td><td>$'+ js_costo_tot_maquila +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="prices" value="'+ js_total_offset_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    //$('#table_proc_offset').empty();

                                    jQuery214('#table_proc_offset').append(processoffset);

                                    $('#proceso_offset_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ js_total_offset_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_total_offset_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                }
                            }



                            // Guarda Proceso Serigrafia
                            if ("SerG" in js_respuesta) {

                                var js_variable_extra11 = js_respuesta.SerG; //trae los valores de SerG

                                for ( b in js_variable_extra11 ) {

                                    var js_cantidad_seri   = js_variable_extra11[b]['cantidad'];
                                    var js_tipo_seri       = js_variable_extra11[b]['tipo'];
                                    var js_num_tintas_seri = js_variable_extra11[b]['num_tintas'];


                                    var js_costo_unitario_arreglo_seri = js_variable_extra11[b]['costo_unit_arreglo'];


                                    if (js_costo_unitario_arreglo_seri <= 0) {

                                        showModError("Serigrafia Guarda (costo unitario arreglo)");
                                    }


                                    var js_costo_arreglo_seri = js_variable_extra11[b]['costo_arreglo'];


                                    var js_costo_unitario_tiro_seri  = js_variable_extra11[b]['costo_unitario_tiro'];

                                    if (js_costo_unitario_tiro_seri <= 0) {

                                        showModError("Serigrafia Guarda (costo unitario tiro)");
                                    }


                                    var js_costo_tot_tiro_serigrafia = js_variable_extra11[b]['costo_tiro'];


                                    var js_tot_serigrafia_emp = js_costo_arreglo_seri + js_costo_tot_tiro_serigrafia

                                    var processserigrafia = '<tr><td colspan="3" style="background: steelblue;color: white;">Guarda</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ js_cantidad_seri +'</td><td>Tipo: '+ js_tipo_seri +'</td><td>Tintas: '+ js_num_tintas_seri +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>'+ js_costo_unitario_arreglo_seri +'</td><td>'+ js_costo_arreglo_seri +'</td></tr><tr><td>Tiro</td><td>'+ js_costo_unitario_tiro_seri +'</td><td>'+ js_costo_tot_tiro_serigrafia +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="prices" value="'+ js_tot_serigrafia_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                    jQuery214('#table_proc_serigrafia').append(processserigrafia);

                                    $('#proceso_serigrafia_M1').show();

                                    var parteresumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ js_tot_serigrafia_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_tot_serigrafia_emp +'"></td><td></td></tr>';

                                    jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                }
                            }


                            // Guarda Proceso Digital

                            if ("DigG" in js_respuesta) {

                                var js_variable_extra12 = js_respuesta.DigG; //trae los valores de DigG

                                if ("impresion_digital" in js_variable_extra12) {

                                    showModError("No cabe la impresión en Digital(Guada) con estas medidas.");
                                } else  {

                                    for ( c in js_variable_extra12 ) {

                                        var js_cantidad_con_merma_digital = js_variable_extra12[c]['tiraje'];


                                        var js_costo_unitario_digital = js_variable_extra12[c]['costo_unitario'];


                                        if (js_costo_unitario_digital <= 0) {

                                            showModError("Digital Guarda (costo unitario tiro)");
                                        }


                                        var js_costo_tot_digital = js_variable_extra12[c]['costo_tot_proceso'];


                                        var processdigital = '<tr><td colspan="4" style="background: steelblue;color: white;">Guarda</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Coto Total</td></tr><tr><td>'+ js_cantidad_con_merma_digital +'</td><td>'+ js_costo_unitario_digital +'</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="prices" value="'+ js_costo_tot_digital +'"></td></tr><tr><td colspan="4"></td></tr>';

                                        jQuery214('#table_proc_digital').append(processdigital);

                                        $('#proceso_digital_M1').show();

                                        var parteresumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ js_costo_tot_digital +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_digital +'"></td><td></td></tr>';

                                        jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                    }
                                }
                            }



                        // oculta
                            $('#proceso_hs_M1').hide();

                            $('#proceso_grab_M1').hide();

                            $('#proceso_lam_M1').hide();

                            $('#proceso_suaje_M1').hide();

                            $('#table_proc_Lam').empty();

                            //aqui me quede 
                            $('#proceso_laser_M1').empty();

                            $('#table_proc_HS').empty();

                            $('#table_proc_Grab').empty();

                            $('#table_proc_Suaje').empty();
                            $('#table_proc_Laser').empty();
                            $('#table_proc_BarnizUV').empty();

                            $('#proceso_barnizuv_M1').hide();


                        // (ACABADOS)

                            var respuestaacabados;
                            var js_parte_nombre;

                            for (c in js_respuesta) {

                                // js_parte_nombre
                                //titulos nombre parte en Empalme
                                if (c === 'Laminado' || c === 'HotStamping' || c === 'Grabado' || c === 'Suaje' || c === 'Barniz_UV' || c === 'Laser' || c === 'Pegados Especiales' || c === 'Retractilado') {

                                    js_parte_nombre = "Empalme del Cajón";
                                }


                                // titulos en el Forro del Cajon
                                if (c === 'LaminadoFcaj' || c === 'HotStampingFcaj' || c === 'GrabadoFcaj' || c === 'SuajeFcaj' || c === 'BarnizFcaj' || c === 'LaserFcaj') {

                                    js_parte_nombre = "Forro del Cajón";
                                }


                                // titulos en el Forro de la Cartera
                                if (c === 'LaminadoFcar' || c === 'HotStampingFcar' || c === 'GrabadoFcar' || c === 'SuajeFcar' || c === 'BarnizFcar' || c === 'LaserFcar') {

                                    js_parte_nombre = "Forro de la Cartera";
                                }


                                // titulos en la Guarda
                                if (c === 'LaminadoG' || c === 'HotStampingG' || c === 'BarnizG' || c === 'GrabadoG' || c === 'SuajeG' || c === 'LaserG') {

                                    js_parte_nombre = "Guarda";
                                }


                                respuestaacabados = js_respuesta[c];

                                for (a in respuestaacabados) {

                                    //listado de acabados

                                    // Acabados Laminado todos
                                    if (c === 'Laminado' || c === 'LaminadoFcaj' || c === 'LaminadoFcar' || c === 'LaminadoG') {

                                        var js_tipoGrabadoLam_emp = js_respuesta[c][a]['tipoGrabado'];
                                        var js_LargoLam_emp       = js_respuesta[c][a]['Largo'];
                                        var js_AnchoLam_emp       = js_respuesta[c][a]['Ancho'];
                                        var tiraje       = js_respuesta[c][a]['tiraje'];


                                        var js_costo_unitario_lam_emp = js_respuesta[c][a]['costo_unitario'];


                                        if (js_costo_unitario_lam_emp <= 0) {

                                            showModError("Acabados (costo unitario laminado " + js_tipoGrabadoLam_emp + ")");
                                        }


                                        var js_costo_tiro_lam_emp = js_respuesta[c][a]['costo_tot_proceso'];
                                        js_costo_tiro_lam_emp = js_costo_tiro_lam_emp;


                                        if (js_tipoGrabadoLam_emp === undefined || js_LargoLam_emp === undefined || js_AnchoLam_emp === undefined || js_costo_unitario_lam_emp === undefined || js_costo_tiro_lam_emp === undefined) {

                                            console.log('(6283) Buscando los laminados agregados');

                                        } else {

                                            var acabadoTr = `<tr><td colspan="3" style="background: steelblue;color: white;">${js_parte_nombre}</td></tr><tr style="background: #87ceeb73;"><td>Tipo: ${js_tipoGrabadoLam_emp}</td><td>Tiraje: ${tiraje}</td><td>Tamaño: ${js_LargoLam_emp}x${js_AnchoLam_emp}</td></tr><tr><td>Costo Unitario</td><td></td><td>Total</td></tr><tr><td>$${js_costo_unitario_lam_emp}</td><td></td><td>$${ js_costo_tiro_lam_emp}<input type="hidden" class="prices" value="${js_costo_tiro_lam_emp}"></td></tr><tr><td colspan="2"></td></tr>`;

                                            jQuery214('#table_proc_Lam').append(acabadoTr);

                                            $('#tabla_view_acabados').show();   // donde esta este id?

                                            $('#proceso_lam_M1').show();


                                            var parteresumen;

                                            if (js_parte_nombre == 'Empalme del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro de la Cartera') {

                                               parteresumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Guarda') {

                                                parteresumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }
                                    }

                                    // Acabados HotStamping todos
                                    if (c === 'HotStamping' || c === 'HotStampingFcaj' || c === 'HotStampingFcar' || c === 'HotStampingG') {

                                        var js_tipoGrabadoHS_emp = js_respuesta[c][a]['tipoGrabado'];
                                        var js_ColorHS_emp       = js_respuesta[c][a]['Color'];
                                        var js_LargoHS_emp       = js_respuesta[c][a]['Largo'];
                                        var js_AnchoHS_emp       = js_respuesta[c][a]['Ancho'];


                                        var js_placa_costo_unitario_emp = js_respuesta[c][a]['placa_costo_unitario'];


                                        if (js_placa_costo_unitario_emp <= 0) {

                                            showModError("HotStamping (costo unitario placa)");
                                        }


                                        var js_placa_costo_emp = js_respuesta[c][a]['placa_costo'];


                                        var js_pelicula_costo_unitario_emp = js_respuesta[c][a]['pelicula_costo_unitario'];

                                        js_pelicula_costo_unitario_emp = js_pelicula_costo_unitario_emp;


                                        if (js_pelicula_costo_unitario_emp <= 0) {

                                            showModError("HotStamping (costo unitario pelicula)");
                                        }



                                        var js_pelicula_costo_emp = js_respuesta[c][a]['pelicula_costo'];


                                        var js_arreglo_costo_unitario_emp = js_respuesta[c][a]['arreglo_costo_unitario'];


                                        if (js_arreglo_costo_unitario_emp <= 0) {

                                            showModError("HotStamping (costo unitario " + js_tipoGrabadoHS_emp + ")");
                                        }


                                        var js_arreglo_costo_emp = js_respuesta[c][a]['arreglo_costo'];


                                        var js_estampado_costo_unitario_emp = js_respuesta[c][a]['costo_unitario'];

                                        if (js_estampado_costo_unitario_emp <= 0) {

                                            showModError("HotStamping (costo unitario " + js_tipoGrabadoHS_emp + ")");
                                        }


                                        var js_estampado_costo_tiro_emp = js_respuesta[c][a]['costo_tiro'];
                                        var js_costo_acabadohs_emp      = js_respuesta[c][a]['costo_tot_proceso'];


                                        if (js_tipoGrabadoHS_emp === undefined || js_ColorHS_emp === undefined || js_LargoHS_emp === undefined || js_placa_costo_unitario_emp === undefined || js_placa_costo_emp === undefined || js_pelicula_costo_unitario_emp === undefined || js_pelicula_costo_emp === undefined || js_arreglo_costo_unitario_emp === undefined || js_arreglo_costo_emp === undefined || js_estampado_costo_unitario_emp === undefined || js_estampado_costo_tiro_emp === undefined || js_costo_acabadohs_emp === undefined) {

                                            console.log('(6389) Buscando los hoststamping agregados');

                                        } else {

                                            var acabadoTr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ js_parte_nombre +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ js_tipoGrabadoHS_emp +'</td><td>Color: '+ js_ColorHS_emp +'</td><td>Tamaño: '+ js_LargoHS_emp +'x'+ js_AnchoHS_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>'+ js_placa_costo_unitario_emp +'</td><td>'+ js_placa_costo_emp +'</td></tr><tr><td>Pelicula</td><td>'+ js_pelicula_costo_unitario_emp +'</td><td>'+ js_pelicula_costo_emp +'</td></tr><tr><td>Arrego</td><td>'+ js_arreglo_costo_unitario_emp +'</td><td>'+ js_arreglo_costo_emp +'</td></tr><tr><td>Tiro</td><td>'+ js_estampado_costo_unitario_emp +'</td><td>'+ js_estampado_costo_tiro_emp +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_costo_acabadohs_emp +'<input type="hidden" class="prices" value="'+ js_costo_acabadohs_emp +'"></td></tr><tr><td colspan="3"></td></tr>';

                                            jQuery214('#table_proc_HS').append(acabadoTr);

                                            $('#tabla_view_acabados').show();

                                            $('#proceso_hs_M1').show();

                                            var parteresumen;

                                            console.log(js_parte_nombre)


                                            if (js_parte_nombre == 'Empalme del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ js_costo_acabadohs_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_acabadohs_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ js_costo_acabadohs_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_acabadohs_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro de la Cartera') {

                                               parteresumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ js_costo_acabadohs_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_acabadohs_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Guarda') {

                                                parteresumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ js_costo_acabadohs_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_acabadohs_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }
                                    }


                                    // Acabados Grabados todos
                                    if (c === 'Grabado' || c === 'GrabadoFcaj' || c === 'GrabadoFcar' || c === 'GrabadoG') {

                                        var js_tipoGrabadoGrab_emp = js_respuesta[c][a]['tipoGrabado'];
                                        var js_LargoGrab_emp       = js_respuesta[c][a]['Largo'];
                                        var js_AnchoGrab_emp       = js_respuesta[c][a]['Ancho'];
                                        var js_Ubicacion_grab_emp  = js_respuesta[c][a]['ubicacion'];


                                        var js_placa_costo_unitario_grab_emp = js_respuesta[c][a]['placa_costo_unitario'];


                                        if (js_placa_costo_unitario_grab_emp <= 0) {

                                            showModError("Grabado (costo unitaio " + js_tipoGrabadoGrab_emp + ")")
                                        }


                                        var js_placa_costo_grab_emp = js_respuesta[c][a]['placa_costo'];


                                        var js_arreglo_costo_unitario_grab_emp = js_respuesta[c][a]['arreglo_costo_unitario'];


                                        if (js_arreglo_costo_unitario_grab_emp <= 0) {

                                            showModError("Grabado (costo unitario arreglo)");
                                        }


                                        var js_arreglo_costo_grab_emp = js_respuesta[c][a]['arreglo_costo'];



                                        var js_estampado_costo_unitario_grab_emp = js_respuesta[c][a]['costo_unitario'];


                                        if (js_estampado_costo_unitario_grab_emp <= 0) {

                                            showModError("Grabado (costo unitario " + js_tipoGrabadoGrab_emp + ")");
                                        }


                                        var js_estampado_costo_tiro_grab_emp = js_respuesta[c][a]['costo_tiro'];
                                        var js_costo_acabado_grab_emp        = js_respuesta[c][a]['costo_tot_proceso'];

                                        if (js_tipoGrabadoGrab_emp === undefined || js_LargoGrab_emp === undefined || js_AnchoGrab_emp === undefined || js_Ubicacion_grab_emp === undefined || js_placa_costo_unitario_grab_emp === undefined || js_placa_costo_grab_emp === undefined || js_arreglo_costo_unitario_grab_emp === undefined || js_arreglo_costo_grab_emp === undefined || js_estampado_costo_unitario_grab_emp === undefined || js_estampado_costo_tiro_grab_emp === undefined || js_costo_acabado_grab_emp === undefined) {

                                            console.log('(6481) Buscando los hoststamping agregados');

                                        } else {

                                            var acabadoTr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ js_parte_nombre +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ js_tipoGrabadoGrab_emp +'</td><td>Tamaño: '+ js_LargoGrab_emp +'x'+ js_AnchoGrab_emp +'</td><td>Ubicacion: '+ js_Ubicacion_grab_emp +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>$'+ js_placa_costo_unitario_grab_emp +'</td><td>$'+ js_placa_costo_grab_emp +'</td></tr><tr><td>Arreglo</td><td>$'+ js_arreglo_costo_unitario_grab_emp +'</td><td>$'+ js_arreglo_costo_grab_emp +'</td></tr><tr><td>Tiro</td><td>$'+ js_estampado_costo_unitario_grab_emp +'</td><td>$'+ js_estampado_costo_tiro_grab_emp +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_costo_acabado_grab_emp +'<input type="hidden" class="prices" value="'+ js_costo_acabado_grab_emp +'"></td></tr><tr><td colspan="3"></td></tr>';


                                            jQuery214('#table_proc_Grab').append(acabadoTr);

                                            $('#tabla_view_acabados').show();

                                            $('#proceso_grab_M1').show();


                                            var parteresumen;

                                            if (js_parte_nombre == 'Empalme del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ js_costo_acabado_grab_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_acabado_grab_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ js_costo_acabado_grab_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_acabado_grab_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro de la Cartera') {

                                               parteresumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ js_costo_acabado_grab_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_acabado_grab_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Guarda') {

                                                parteresumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ js_costo_acabado_grab_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_acabado_grab_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }
                                    }


                                    // Acabados Suaje todos
                                    if (c === 'Suaje' || c === 'SuajeFcaj' || c === 'SuajeFcar' || c === 'SuajeG') {

                                        var js_tipoGrabadoSuaje = js_respuesta[c][a]['tipoGrabado'];
                                        var js_LargoSuaje       = js_respuesta[c][a]['Largo'];
                                        var js_AnchoSuaje       = js_respuesta[c][a]['Ancho'];


                                        //var js_arreglo_costo_unitario_suaje = js_respuesta[c][a]['arreglo_costo_unitario'];
                                        var js_arreglo_costo_unitario_suaje = js_respuesta[c][a]['arreglo'];


                                        if (js_arreglo_costo_unitario_suaje <= 0) {

                                            showModError("Suaje (costo unitario arreglo)");
                                        }


                                        //var js_arreglo_costo_suaje = js_respuesta[c][a]['arreglo_costo_unitario'];
                                        var js_arreglo_costo_suaje = js_respuesta[c][a]['arreglo'];
                                        var js_estampado_costo_unitario_suaje = js_respuesta[c][a]['tiro_costo_unitario'];


                                        if (js_estampado_costo_unitario_suaje <= 0) {

                                            showModError("Suaje (costo unitario " + js_tipoGrabadoSuaje + ")");
                                        }


                                        var js_estampado_costo_tiro_suaje = js_respuesta[c][a]['costo_tiro'];
                                        var js_costo_acabado_suaje = js_respuesta[c][a]['costo_tot_proceso'];

                                        if (js_tipoGrabadoSuaje === undefined || js_LargoSuaje === undefined || js_AnchoSuaje === undefined || js_arreglo_costo_unitario_suaje === undefined || js_arreglo_costo_suaje === undefined || js_estampado_costo_unitario_suaje === undefined || js_estampado_costo_tiro_suaje === undefined || js_costo_acabado_suaje === undefined) {

                                            showModError('');
                                            $("#txtContenido").html("");
                                            $("#txtContenido").html("Hay una variable indefinida.");
                                        } else {

                                            var acabadoTr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ js_parte_nombre +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ js_tipoGrabadoSuaje +'</td><td>Tamaño: '+ js_LargoSuaje +'x'+ js_AnchoSuaje +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ js_arreglo_costo_unitario_suaje +'</td><td>$'+ js_arreglo_costo_suaje +'</td></tr><tr><td>Tiro</td><td>$'+ js_estampado_costo_unitario_suaje +'</td><td>$'+ js_estampado_costo_tiro_suaje +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ js_costo_acabado_suaje +'<input type="hidden" class="prices" value="'+ js_costo_acabado_suaje +'"></td></tr><tr><td colspan="3"></td></tr>';


                                            jQuery214('#table_proc_Suaje').append(acabadoTr);

                                            $('#tabla_view_acabados').show();

                                            $('#proceso_suaje_M1').show();

                                            var parteresumen;

                                            if (js_parte_nombre == 'Empalme del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ js_costo_acabado_suaje +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_acabado_suaje +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ js_costo_acabado_suaje +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_acabado_suaje +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro de la Cartera') {

                                               parteresumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ js_costo_acabado_suaje +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_acabado_suaje +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Guarda') {

                                                parteresumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ js_costo_acabado_suaje +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_acabado_suaje +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }
                                    }


                                    // Acabados Barniz UV (desarrollar)
                                    if (c === 'Barniz_UV' || c === 'BarnizFcaj' || c === 'BarnizFcar' || c === 'BarnizG') {

                                        var js_tipoGrabadoBUV_emp = js_respuesta[c][a]['tipoGrabado'];
                                        var js_LargoBUV_emp       = js_respuesta[c][a]['Largo'];
                                        var js_AnchoBUV_emp       = js_respuesta[c][a]['Ancho'];
                                        var js_costo_unitario_buv_emp = js_respuesta[c][a]['costo_unitario'];

                                        if (js_costo_unitario_buv_emp <= 0) {

                                            showModError("Acabados (costo unitario barniz uv " + js_tipoGrabadoBUV_emp + ")");
                                        }


                                        var js_costo_tiro_buv_emp = js_respuesta[c][a]['costo_tot_proceso'];

                                        js_costo_tiro_buv_emp     = js_costo_tiro_buv_emp;


                                        if (js_tipoGrabadoBUV_emp === undefined || js_LargoBUV_emp === undefined || js_AnchoBUV_emp === undefined || js_costo_unitario_buv_emp === undefined || js_costo_tiro_buv_emp === undefined) {

                                            console.log('(6626) Buscando barniz agregados');

                                        } else {

                                            var tr = '';

                                            if( js_tipoGrabadoBUV_emp == 'Brillante' || js_tipoGrabadoBUV_emp == 'Mate' ){

                                                var tr = `<tr><td colspan="2" style="background: steelblue;color: white;">${js_parte_nombre}</td></tr><tr style="background: #87ceeb73;"><td>Tipo: ${js_tipoGrabadoBUV_emp}</td><td>Tamaño: N/A</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$${js_costo_unitario_buv_emp}</td><td>$${js_costo_tiro_buv_emp}<input type="hidden" class="prices" value="${js_costo_tiro_buv_emp}"></td></tr><tr><td colspan="2"></td></tr>`;
                                            }else{

                                                tr = `<tr><td colspan="2" style="background: steelblue;color: white;">${js_parte_nombre}</td></tr><tr style="background: #87ceeb73;"><td>Tipo: ${js_tipoGrabadoBUV_emp}</td><td>Tamaño: ${js_LargoBUV_emp} x ${js_AnchoBUV_emp}</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$${js_costo_unitario_buv_emp}</td><td>$${js_costo_tiro_buv_emp}<input type="hidden" class="prices" value="${js_costo_tiro_buv_emp}"></td></tr><tr><td colspan="2"></td></tr>`;
                                            }

                                            jQuery214('#table_proc_BarnizUV').append(tr);

                                            $('#tabla_view_acabados').show();   // donde esta este id?

                                            $('#proceso_barnizuv_M1').show();


                                            var parteresumen;
                                            var js_costo_tiro_lam_emp = js_respuesta[c][a]['costo_tot_proceso'];

                                            js_costo_tiro_lam_emp = js_costo_tiro_lam_emp;


                                            if (js_parte_nombre == 'Empalme del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro de la Cartera') {

                                               parteresumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Guarda') {

                                                parteresumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ js_costo_tiro_lam_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tiro_lam_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }
                                    }


                                    // Acabados Corte Laser (desarrollar)
                                    if (c === 'Laser' || c === 'LaserFcaj' || c === 'LaserFcar' || c === 'LaserG') {

                                        var js_tipoGrabadoLaser = js_respuesta[c][a]['tipo_grabado'];

                                        var js_costo_unitario_Laser_emp = js_respuesta[c][a]['costo_unitario'];


                                        if (js_costo_unitario_Laser_emp <= 0) {

                                            showModError("Acabados (costo unitario Corte Laser " + js_costo_unitario_BarnizUV_emp + ")");
                                        }


                                        var js_costo_Laser_emp = parseFloat(js_respuesta[c][a]['costo_tot_proceso']);


                                        if (js_tipoGrabadoLaser === undefined || js_costo_unitario_Laser_emp === undefined || js_costo_Laser_emp === undefined) {

                                            console.log('(6697) Buscando Corte Laser agregados');

                                        } else {

                                            var acabadoTr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ js_parte_nombre +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ js_tipoGrabadoLaser +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ js_costo_unitario_Laser_emp +'</td><td>$'+ js_costo_Laser_emp +'<input type="hidden" class="prices" value="'+ js_costo_unitario_Laser_emp +'"></td></tr><tr><td colspan="2"></td></tr>';

                                            jQuery214('#table_proc_Laser').append(acabadoTr);

                                            $('#tabla_view_acabados').show();   // donde esta este id?

                                            $('#proceso_laser_M1').show();


                                            var parteresumen;

                                            if (js_parte_nombre == 'Empalme del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ js_costo_Laser_emp +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_Laser_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro del Cajón') {

                                                parteresumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ js_costo_Laser_emp +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_Laser_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Forro de la Cartera') {

                                               parteresumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ js_costo_Laser_emp +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_Laser_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (js_parte_nombre == 'Guarda') {

                                                parteresumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ js_costo_Laser_emp +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_Laser_emp +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }
                                    }


                                    // Acabados Pegados Especiales (desarrollar)
                                    if (c === 'Pegados Especiales') {

                                        var js_tipoGrabadoLaser = js_respuesta[c][a]['tipoGrabado'];
                                        var js_LargoLaser       = js_respuesta[c][a]['Largo'];
                                        var js_AnchoLaser       = js_respuesta[c][a]['Ancho'];

                                    }


                                    // Acabados Retractilado (desarrollar)
                                    if (c === 'Retractilado') {

                                        var js_tipoGrabadoLaser = js_respuesta[c][a]['tipoGrabado'];
                                        var js_LargoLaser       = js_respuesta[c][a]['Largo'];
                                        var js_AnchoLaser       = js_respuesta[c][a]['Ancho'];

                                    }
                                }
                            }

                        //costo totales para boton resumen:
                        let step = 6

                        let seccion = (nombreResumen) =>{
                            let precioTotal = 0;
                            try{

                                $(`#${nombreResumen} tr`).find('td').each(function(td){
                            
                                    let td1 = parseInt(td);
                                    
                                    if(td1 == step){

                                        let valorTD = $(this).html()
                                        
                                        let datosSplit = valorTD.split('<')
                                        datosSplit = datosSplit[0].split('$')
                                        precio = parseFloat(datosSplit[1])
                                        precioTotal += precio;
                                        step += 4;
                                    }
                                })
                                return precioTotal.toFixed(2)
                            }catch(e){

                                console.log('No se pudo obtener el valor del td. \n' + e)
                            }finally{

                                step = 6;
                            }
                            return 0;
                        }

                        let pTotalE = seccion('resumenEmpalme')
                        let pTotalFCaj = seccion('resumenFcajon')
                        let pTotalFCar = seccion('resumenFcartera')
                        let pTotalG = seccion('resumenGuarda')

                        // (MERMAS)
                            $('#table_mermas_tr').empty();

                            var respuestamermas;

                            var js_color_parte;

                            for (c in js_respuesta) {

                                respuestamermas = js_respuesta[c];

                                //titulos nombre parte
                                if (c == 'OffEmp' || c == 'SerEmp' || c == 'DigEmp' || c == 'Laminado' || c == 'HotStamping' || c == 'Grabado' || c == 'Suaje' || c == 'Barniz UV' || c == 'Corte Laser' || c == 'Barniz_UV' || c  == 'Laser' || c === 'Off_maq_Emp') {

                                    js_parte_nombre = "Empalme del Cajón";

                                    js_color_parte  = '<td style="background: paleturquoise;">E</td>';
                                }


                                if (c == 'OffFCaj' || c == 'SerFCaj' || c == 'DigFCaj' || c == 'LaminadoFcaj' || c == 'HotStampingFcaj' || c == 'GrabadoFcaj' || c == 'SuajeFcaj' || c == 'BarnizFcaj' || c  == 'LaserFcaj' || c === 'Off_maq_FCaj') {

                                    js_parte_nombre = "Forro del Cajón";

                                    js_color_parte  = '<td style="background: thistle;">Fj</td>';
                                }


                                if (c == 'OffFCar' || c == 'SerFCar' || c == 'DigFCar' || c == 'LaminadoFcar' || c == 'HotStampingFcar' || c == 'GrabadoFcar' || c == 'SuajeFcar' || c == 'BarnizFcar'  || c  == 'LaserFcar') {

                                    js_parte_nombre = "Forro de la Cartera";

                                    js_color_parte  = '<td style="background: wheat;">Fr</td>';
                                }


                                if (c == 'OffG' || c == 'SerG' || c == 'DigG' || c == 'LaminadoG' || c == 'HotStampingG' || c == 'GrabadoG' || c == 'SuajeG' || c == 'BarnizG' || c  == 'LaserG') {

                                    js_parte_nombre = "Guarda";

                                    js_color_parte  = '<td style="background: # a5e8a5;">G</td>';
                                }


                                for (a in respuestamermas) {

                                    if (c === "OffEmp" || c === "SerEmp" || c === "DigEmp"
                                        || c === "OffFCaj" || c === "SerFCaj" || c === "DigFCaj"

                                        || c === "OffFCar" || c === "SerFCar" || c === "DigFCar"

                                        || c === "OffG" || c === "SerG" || c === "DigG"

                                        || c == 'Laminado' || c == 'HotStamping' || c == 'Grabado'
                                        || c == 'Suaje'

                                        || c == 'OffFCaj' || c == 'SerFCaj' || c == 'DigFCaj'
                                        || c == 'LaminadoFcaj' || c == 'HotStampingFcaj'
                                        || c == 'GrabadoFcaj' || c == 'SuajeFcaj'

                                        || c == 'OffFCar' || c == 'SerFCar' || c == 'DigFCar'
                                        || c == 'LaminadoFcar' || c == 'HotStampingFcar'
                                        || c == 'GrabadoFcar' || c == 'SuajeFcar'

                                        || c == 'OffG' || c == 'SerG' || c == 'DigG'
                                        || c == 'LaminadoG' || c == 'HotStampingG'
                                        || c == 'GrabadoG' || c == 'SuajeG'

                                        || c === "Barniz_UV" || c === "BarnizFcaj" || c === "BarnizFcar" || c === "BarnizG"

                                        || c === "Laser" || c === "LaserFcaj" || c === "LaserFcar" || c === "LaserG"

                                        || c === 'Off_maq_Emp' || c === 'Off_maq_FCaj'
                                        ) {

                                        var js_tiraje_mm           = js_respuesta[c][a]['cantidad'];
                                        var js_merma_min_mm        = js_respuesta[c][a]['mermas']['merma_min']; //minima
                                        var js_merma_adic_mm       = js_respuesta[c][a]['mermas']['merma_adic']; // adicional
                                        var js_merma_tot_mm        = js_respuesta[c][a]['mermas']['merma_tot']; // total merma
                                        var js_costo_unit_merma_mm = js_respuesta[c][a]['mermas']['costo_unit_papel_merma'];
                                        var js_costo_unit_merma_2m = js_respuesta[c][a]['mermas']['costo_unit_merma'];
                                        var js_costo_tot_merma_mm  = js_respuesta[c][a]['mermas']['costo_tot_pliegos_merma'];


                                        // Offset
                                        if (c === "OffEmp" || c === "OffFCaj" || c === "OffFCar" || c === "OffG" || c === "Off_maq_Emp" || c === "Off_maq_FCaj") {

                                            var mermastr = '<tr>'+ js_color_parte +'<td>Offset</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_mm +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';


                                            if (c == "OffEmp") {

                                                parteresumen = '<tr><td></td><td>Merma Offset</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "OffFCaj") {

                                                parteresumen = '<tr><td></td><td>Merma Offset</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "OffFCar") {

                                               parteresumen = '<tr><td></td><td>Merma Offset</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "OffG") {

                                                parteresumen = '<tr><td></td><td>Merma Offset</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "Off_maq_Emp") {

                                                parteresumen = '<tr><td></td><td>Merma Offset</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen);
                                            }

                                            if (c == "Off_maq_FCaj") {

                                                parteresumen = '<tr><td></td><td>Merma Offset</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen);
                                            }
                                        }


                                        //digital
                                        if (c === "DigEmp" || c === "DigFCaj" || c === "DigFCar" || c === "DigG") {

                                            let js_costo_unit_merma_mm = js_respuesta[c][a]['mermas']['costo_unitario'];
                                            let js_costo_tot_merma_mm = js_respuesta[c][a]['mermas']['costo_tot'];
                                            var mermastr = '<tr>'+ js_color_parte +'<td>Digital</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_mm +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';


                                            if (c == "DigEmp") {

                                                parteresumen = '<tr><td></td><td>Merma Digital</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "DigFCaj") {

                                                parteresumen = '<tr><td></td><td>Merma Digital</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "DigFCar") {

                                               parteresumen = '<tr><td></td><td>Merma Digital</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "DigG") {

                                                parteresumen = '<tr><td></td><td>Merma Digital</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }


                                        //serigrafia
                                        if (c === "SerEmp" || c === "SerFCaj" || c === "SerFCar" || c === "SerG") {

                                            var mermastr = '<tr>'+ js_color_parte +'<td>Serigrafia</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_mm +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';


                                            if (c == "SerEmp") {

                                                parteresumen = '<tr><td></td><td>Merma Serigrafia</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "SerFCaj") {

                                                parteresumen = '<tr><td></td><td>Merma Serigrafia</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "SerFCar") {

                                               parteresumen = '<tr><td></td><td>Merma Serigrafia</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "SerG") {

                                                parteresumen = '<tr><td></td><td>Merma Serigrafia</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }


                                        //Laminado
                                        if (c === "Laminado" || c === "LaminadoFcaj" || c === "LaminadoFcar" || c === "LaminadoG") {

                                            var mermastr = '<tr>'+ js_color_parte +'<td>Laminado</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_2m +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';

                                            if (c == "Laminado") {

                                                parteresumen = '<tr><td></td><td>Merma Laminado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "LaminadoFcaj") {

                                                parteresumen = '<tr><td></td><td>Merma Laminado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "LaminadoFcar") {

                                               parteresumen = '<tr><td></td><td>Merma Laminado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }


                                            if (c == "LaminadoG") {

                                                parteresumen = '<tr><td></td><td>Merma Laminado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }


                                        //HotStamping
                                        if (c === "HotStamping" || c === "HotStampingFcaj" || c === "HotStampingFcar" || c === "HotStampingG") {

                                            var mermastr = '<tr>'+ js_color_parte +'<td>HotStamping</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_2m +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';

                                            if (c == "HotStamping") {

                                                parteresumen = '<tr><td></td><td>Merma HotStamping</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "HotStampingFcaj") {

                                                parteresumen = '<tr><td></td><td>Merma HotStamping</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "HotStampingFcar") {

                                               parteresumen = '<tr><td></td><td>Merma HotStamping</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "HotStampingG") {

                                                parteresumen = '<tr><td></td><td>Merma HotStamping</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }

                                        //Grabado
                                        if (c === "Grabado" || c === "GrabadoFcaj" || c === "GrabadoFcar" || c === "GrabadoG") {

                                            var mermastr = '<tr>'+ js_color_parte +'<td>Grabado</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_2m +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';

                                            if (c == "Grabado") {

                                                parteresumen = '<tr><td></td><td>Merma Grabado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "GrabadoFcaj") {

                                                parteresumen = '<tr><td></td><td>Merma Grabado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "GrabadoFcar") {

                                               parteresumen = '<tr><td></td><td>Merma Grabado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "GrabadoG") {

                                                parteresumen = '<tr><td></td><td>Merma Grabado</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }

                                        //Suaje
                                        if (c === "Suaje" || c === "SuajeFcaj" || c === "SuajeFcar" || c === "SuajeG") {

                                            var mermastr = '<tr>'+ js_color_parte +'<td>Suaje</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_2m +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';

                                            if (c == "Suaje") {

                                                parteresumen = '<tr><td></td><td>Merma Suaje</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "SuajeFcaj") {

                                                parteresumen = '<tr><td></td><td>Merma Suaje</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "SuajeFcar") {

                                               parteresumen = '<tr><td></td><td>Merma Suaje</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "SuajeG") {

                                                parteresumen = '<tr><td></td><td>Merma Suaje</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }

                                        //Barniz UV

                                        if (c === "Barniz_UV" || c === "BarnizFcaj" || c === "BarnizFcar" || c === "BarnizG") {
                                            
                                            var mermastr = '<tr>'+ js_color_parte +'<td>Barniz UV</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_2m +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';

                                            if (c == "Barniz_UV") {

                                                parteresumen = '<tr><td></td><td>Merma Barniz UV</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "BarnizFcaj") {

                                                parteresumen = '<tr><td></td><td>Merma Barniz UV</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "BarnizFcar") {

                                               parteresumen = '<tr><td></td><td>Merma Barniz UV</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "BarnizG") {

                                                parteresumen = '<tr><td></td><td>Merma Barniz UV</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }

                                        //Corte Laser

                                        if (c === "Laser" || c === "LaserFcaj" || c === "LaserFcar" || c === "LaserG") {

                                            js_merma_adic_mm = 'N/A';
                                            
                                            var mermastr = '<tr>'+ js_color_parte +'<td>Corte Laser</td><td>'+ js_merma_min_mm +'</td><td>'+ js_merma_adic_mm +'</td><td>'+ js_merma_tot_mm +'</td><td>$'+ js_costo_unit_merma_2m +'</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="prices" value="'+ js_costo_tot_merma_mm +'"></td></tr>';

                                            if (c == "Laser") {

                                                parteresumen = '<tr><td></td><td>Merma Corte Laser</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenempalme" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "LaserFcaj") {

                                                parteresumen = '<tr><td></td><td>Merma Corte Laser</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcajon" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcajon').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "LaserFcar") {

                                               parteresumen = '<tr><td></td><td>Merma Corte Laser</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenfcartera" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenFcartera').append(parteresumen); //imprime para el resumen
                                            }

                                            if (c == "LaserG") {

                                                parteresumen = '<tr><td></td><td>Merma Corte Laser</td><td>$'+ js_costo_tot_merma_mm +'<input type="hidden" class="pricesresumenguarda" value="'+ js_costo_tot_merma_mm +'"></td><td></td></tr>';

                                                jQuery214('#resumenGuarda').append(parteresumen); //imprime para el resumen
                                            }
                                        }

                                        jQuery214('#table_mermas_tr').append(mermastr);
                                    }
                                }
                            }


                        // BANCOS
                            $('#bancos').hide();
                            $('#tabla_bancos').empty();
                            $('#resumenBancos').empty();

                            if(js_respuesta['Bancos']) {

                                var titulo = '<tr><td><b>Bancos</b></td><td></td><td></td><td></td></tr>';
                                $('#resumenBancos').append(titulo);
                                for(var cont = 0; cont < js_respuesta['Bancos'].length; cont++) {

                                    tr = '<tr><td>' + js_respuesta['Bancos'][cont]['Tipo_banco'] +'</td><td>' + js_respuesta['Bancos'][cont]['Suaje'] + '</td><td>$' + js_respuesta['Bancos'][cont]['costo_unit_banco'] +'<td>' + js_respuesta['Bancos'][cont]['costo_bancos'] + '</td><td style="display: none;"><input type="hidden" class="prices" value="'+ js_respuesta['Bancos'][cont]['costo_bancos'] +'"></td></tr>';

                                    $('#tabla_bancos').append(tr);

                                    var resumen = '<tr><td></td><td>' + js_respuesta['Bancos'][cont]['Tipo_banco'] +'</td><td></td><td>$'+ js_respuesta['Bancos'][cont]['costo_bancos'] +'<input type="hidden" class="pricesresumenbancos" value="'+ js_respuesta['Bancos'][cont]['costo_bancos'] +'"></td></tr>';

                                    $('#resumenBancos').append(resumen);

                                }


                                $('#resumenBancos').append("<tr><td></td><td></td><td></td><td>$" + js_respuesta['costo_bancos'] + "</td></tr>");
                                $('#bancos').show();
                            }

                        //CIERRES
                            $('#divCierres').hide();
                            $('#tabla_cierres').empty();
                            $('#resumenCierres').empty();

                            if(js_respuesta['Cierres']) {

                                var titulo = '<tr><td><b>Cierres</b></td><td></td><td></td><td></td></tr>';
                                $('#resumenCierres').append(titulo);

                                for(var cont = 0; cont < js_respuesta['Cierres'].length; cont++) {

                                    var largoAncho = "N/A";
                                    var color = "N/A";
                                    var tipo = "N/A";
                                    if( js_respuesta['Cierres'][cont]['color'] != null ){

                                        color = js_respuesta['Cierres'][cont]['color'];
                                    }
                                    if( js_respuesta['Cierres'][cont]['largo'] != null ){

                                        largoAncho = js_respuesta['Cierres'][cont]['largo'] + "x" + js_respuesta['Cierres'][cont]['ancho'];
                                    }
                                    if( js_respuesta['Cierres'][cont]['tipo'] != null ){

                                        tipo = js_respuesta['Cierres'][cont]['tipo'];
                                    }

                                    tr = '<tr style="background: steelblue;color: white;"><td style="color: white">Tipo: ' + tipo + '</td><td style="color: white">Color: ' + color + ' </td><td style="color: white">Tamaño: ' + largoAncho + ' </td></tr><tr><td></td><td>Costo Unitario</td><td>Total</td></tr><tr><td>' + js_respuesta['Cierres'][cont]['Tipo_cierre'] +'</td><td>$' + js_respuesta['Cierres'][cont]['costo_unitario'] +'<td>' + js_respuesta['Cierres'][cont]['costo_cierre'] + '</td><td style="display: none;"><input type="hidden" class="prices" value="'+ js_respuesta['Cierres'][cont]['costo_cierre'] +'"></td></tr>';

                                    $('#tabla_cierres').append(tr);

                                    var resumen = '<tr><td></td><td>' + js_respuesta['Cierres'][cont]['Tipo_cierre'] +'</td><td>$'+ js_respuesta['Cierres'][cont]['costo_cierre'] +'<input type="hidden" class="pricesresumenbancos" value="'+ js_respuesta['Cierres'][cont]['costo_cierre'] +'"></td><td></td></tr>';
                                    $('#resumenCierres').append(resumen);
                                }

                                $('#resumenCierres').append("<tr><td></td><td></td><td></td><td>$" + js_respuesta['costo_cierres'] + "</td></tr>");

                                $('#divCierres').show();
                            }

                        //ACCESORIOS
                            $('#divAccesorios').hide();
                            $('#tabla_accesorios').empty();
                            $('#resumenAccesorios').empty();


                            if(js_respuesta['Accesorios']) {

                                var titulo = '<tr><td><b>Accesorios</b></td><td></td><td></td><td></td></tr>';
                                $('#resumenAccesorios').append(titulo);

                                for(var cont = 0; cont < js_respuesta['Accesorios'].length; cont++) {

                                    var largoAncho = "N/A";
                                    var color = "N/A";
                                    var tipo = "N/A";
                                    if( js_respuesta['Accesorios'][cont]['Color'] != null ){

                                        color = js_respuesta['Accesorios'][cont]['Color'];
                                    }
                                    if( js_respuesta['Accesorios'][cont]['Largo'] != null ){

                                        largoAncho = js_respuesta['Accesorios'][cont]['Largo'] + "x" + js_respuesta['Accesorios'][cont]['Ancho'];
                                    }
                                    if( js_respuesta['Accesorios'][cont]['Tipo'] != null ){

                                        tipo = js_respuesta['Accesorios'][cont]['Tipo'];
                                    }

                                    tr = '<tr style="background: steelblue;color: white;"><td style="color: white">Tipo: ' + tipo + '</td><td style="color: white">Color: ' + color + ' </td><td style="color: white">Tamaño: ' + largoAncho + ' </td></tr><tr><td></td><td>Costo Unitario</td><td>Total</td></tr><tr><td>' + js_respuesta['Accesorios'][cont]['Tipo_accesorio'] +'</td><td>$' + js_respuesta['Accesorios'][cont]['costo_unit_accesorio'] +'<td>' + js_respuesta['Accesorios'][cont]['costo_accesorios'] + '</td><td style="display: none;"><input type="hidden" class="prices" value="'+ js_respuesta['Accesorios'][cont]['costo_accesorios'] +'"></td></tr>';

                                    $('#tabla_accesorios').append(tr);

                                    var resumen = '<tr><td></td><td>' + js_respuesta['Accesorios'][cont]['Tipo_accesorio'] +'</td><td></td><td>$'+ js_respuesta['Accesorios'][cont]['costo_accesorios'] +'<input type="hidden" class="pricesresumenbancos" value="'+ js_respuesta['Accesorios'][cont]['costo_accesorios'] +'"></td></tr>';

                                    $('#resumenAccesorios').append(resumen);
                                }

                                $('#resumenAccesorios').append("<tr><td></td><td></td><td></td><td>$" + js_respuesta['costo_accesorios'] + "</td></tr>");

                                $('#divAccesorios').show();
                            }

                        //DESCUENTOSMIO
                            $("#tdSubtotalCaja").html("$" + js_respuesta['costo_subtotal']);

                            $("#UtilidadDrop").html("$" + js_respuesta['Utilidad']);

                            $("#Totalplus").html("$" + js_respuesta['costo_odt']);

                            $("#IVADrop").html("$" + js_respuesta['iva']);

                            $("#ComisionesDrop").html("$" + js_respuesta['comisiones']);

                            $("#IndirectoDrop").html("$" + js_respuesta['indirecto']);

                            $("#VentasDrop").html("$" + js_respuesta['ventas']);

                            $("#ISRDrop").html("$" + js_respuesta['ISR']);


                            $("#DescuentoDrop").html("$" + js_respuesta['descuento']);


                        //final

                            var parteresumen;

                            parteresumen = `<tr><td></td><td></td><td></td><td class="totalEmpalme">$ ${pTotalE}</td></tr>`;

                            $('#resumenEmpalme').append(parteresumen); //imprime para el resumen

                            parteresumen = `<tr><td></td><td></td><td></td><td class="totalFcajon">$ ${pTotalFCaj}</td></tr>`;

                            $('#resumenFcajon').append(parteresumen); //imprime para el resumen

                            parteresumen = `<tr><td></td><td></td><td></td><td class="totalFcartera">$ ${pTotalFCar}</td></tr>`

                            $('#resumenFcartera').append(parteresumen); //imprime para el resumen

                            parteresumen = `<tr><td></td><td></td><td></td><td class="totalGuarda">$ ${pTotalG}</td></tr>`;

                            $('#resumenGuarda').append(parteresumen); //imprime para el resumen

                           parteresumen = '<tr><td></td><td></td><td><b>Subtotal:</b></td><td class="grand-total"><b>$' + js_respuesta['costo_subtotal'] +'</b></td></tr><tr><td></td><td></td><td>Utilidad: </td><td id="UtilidadResumen">$' + js_respuesta['Utilidad'] + '</td></tr><tr><td></td><td></td><td>IVA:</td><td id="IVAResumen">$' + js_respuesta['iva'] + '</td></tr><tr><td></td><td></td><td>ISR: </td><td id="ISResumen">$' + js_respuesta['ISR'] + '</td></tr><tr><td></td><td></td><td>Comisiones: </td><td id="ComisionesResumen">$ ' + js_respuesta['comisiones'] + '</td></tr><tr><td></td><td></td><td>% Indirecto: </td><td id="IndirectoResumen">$' + js_respuesta['indirecto'] + '</td></tr><tr><td></td><td></td><td>Ventas: </td><td id="ventaResumen">$' + js_respuesta['ventas'] + '</td></tr><tr><td></td><td></td><td>Descuento: </td><td id="descuentoResumen">$' + js_respuesta['descuento'] + '</td></tr><tr><tr><td></td><td></td><td><b>Total: </b></td><td id="TotalResumen"><b>$' + js_respuesta['costo_odt'] + '</b></td></tr>';

                                //<tr><td></td><td></td><td>Descuento: </td><td id="DescuentoResumen" style="color: red;">$0.00</td></tr>

                            jQuery214('#resumenOtros').append(parteresumen); //imprime para el resumen

                            $("#subForm").prop("disabled",false);
                        
                            localStorage.setItem('js_respuesta',aJson_stringify);
                            localStorage.setItem('controlador','no');
                    } catch(e) {

                        try{
                            
                            var error = response.split("<br />");
                            error = error[1].split("<b>").join("");
                            error = error.split("</b>").join("");
                            showModError("");

                            $("#txtContenido").html("(5965) Hubo un error al cotizar la caja.");
                            appndMsgError(error);
                            console.log(e);
                        }catch {
                            
                            try{

                                showModError("");
                                $("#txtContenido").html("(5965) Hubo un error al cotizar la caja.");
                                appndMsgError(e);
                                console.log(e);
                            }catch {
                                
                                showModError("");

                                $("#txtContenido").html("(5971) Hubo un error al cotizar la caja.");
                            }
                        } finally{

                            return false;    
                        }
                    }
                } else {

                    showModError("");

                    $("#txtContenido").html("(5981) Hubo un error al cotizar la caja.");
                    appndMsgError("Favor de llamar a sistemas");
                    desactivarBtn();
                    return false;
                }
            })
            .fail(function(response) {

                console.log('(6112) Error. Revisa.');

                desactivarBtn();
            });
        }
    });


    // graba en la Base de Datos
    $("#subForm2").click( function() {

        if(formData){

            if (formData.length > 0) {

                formData = [];
            }
        }


        var grabar = "SI";

        var formData = $("#caja-form").serializeArray();

        // impresion
        var aImp_tmp     = JSON.stringify(aImp, null, 4);
        var aImpFCaj_tmp = JSON.stringify(aImpFCaj, null, 4);
        var aImpFCar_tmp = JSON.stringify(aImpFCar, null, 4);
        var aImpG_tmp    = JSON.stringify(aImpG, null, 4);


        // acababos
        var aAcb_tmp     = JSON.stringify(aAcb, null, 4);
        var aAcbFCaj_tmp = JSON.stringify(aAcbFCaj, null, 4);
        var aAcbFCar_tmp = JSON.stringify(aAcbFCar, null, 4);
        var aAcbG_tmp    = JSON.stringify(aAcbG, null, 4);


        // cierres
        var aCierres_tmp = JSON.stringify(aCierres, null, 4);


        // bancos
        var aBancos_tmp = JSON.stringify(aBancos, null, 4);


        // accesorios
        var aAccesorios_tmp = JSON.stringify(aAccesorios, null, 4);

        var cliente  = getIdClient();

        var id_cliente_tmp = JSON.stringify(cliente, null, 4);

        formData.push({name: 'id_cliente', value: id_cliente_tmp});   // calculadora

        formData.push({name: 'aImp', value: aImp_tmp});
        formData.push({name: 'aImpFCaj', value: aImpFCaj_tmp});
        formData.push({name: 'aImpFCar', value: aImpFCar_tmp});
        formData.push({name: 'aImpG', value: aImpG_tmp});

        formData.push({name: 'aAcb', value: aAcb_tmp});
        formData.push({name: 'aAcbFCaj', value: aAcbFCaj_tmp});
        formData.push({name: 'aAcbFCar', value: aAcbFCar_tmp});
        formData.push({name: 'aAcbG', value: aAcbG_tmp});

        formData.push({name: 'aCierres', value: aCierres_tmp});
        formData.push({name: 'aBancos', value: aBancos_tmp});
        formData.push({name: 'aAccesorios', value: aAccesorios_tmp});

        // descuento
        formData.push({name: 'descuento_pctje', value: descuento});
        formData.push({name: 'grabar', value: grabar});

        var modificar_odt = "NO";

        //checa si ya se grabo una vez.
        let odtAnt = parseInt($("#id_odt_anterior").val())
        console.log(odtAnt)
        if( odtAnt > 0 ){

            modificar_odt = "SI";
            formData.push({name: 'id_cot_odt_ant', value: odtAnt});
        }

        formData.push({name: 'modificar', value: modificar_odt});

        var odt1 = $("#odt-1").val();

        var odtval = [];

        odtval.push({name: 'odt', value: odt1});
        
        desactivarBtn();
        $("#modLoading").show();
        $.ajax({                    // boton GUARDAR(grabar)
            type:"POST",
            async: false,
            //dataType: "json",
            url: $('#caja-form').attr('action'),
            data: formData,
        })
        .done(function( response ) {

            $("#modLoading").hide();
            console.log(response);

            try {

                var js_respuesta = JSON.parse( response );
                var error        = js_respuesta.error;

                if (error.length > 0) {

                    showModError("");
                    $("#txtContenido").html("(6231) " + error);

                } else {

                    let idAnt = js_respuesta.id_odt_act
                    $("#id_odt_anterior").val(idAnt)

                    showModCorrecto("Los datos han sido guardados correctamente...");
                    activarBtn();
                }
            } catch(e) {
                console.log(e)
                showModError("");
                $("#txtContenido").html("(6240) Error al grabar en la Base de Datos");
            }
        })
        .fail(function(response) {

            console.log('(6245) Bug!');
        });
    });


<<<<<<< HEAD
        $("#imgEC").find("img").prop("src", "<?=URL?>public/img/almeja-EC.gif");
    });
=======
    var option = "";
    var papeles = <?php echo json_encode($papers);?>;
>>>>>>> parent of 29fd04d (Revert "Avances almeja hasta la fecha")

    $("#imgEC").mouseout( function(){
=======
>>>>>>> parent of e968c60 (Revert "avances 5 de marzo 2021")

    var option = "";
    var papeles = <?php echo json_encode($papers);?>;

    papeles.forEach( function(papel){

        option += '<option value="' + papel.id_papel + '" data-nombre="' + papel.nombre + '">' + papel.nombre + '</option>';
    });

    var baseImg = "<?=BASE_URL?>public/img/";

    var seccion = [
        { titulo: 'Empalme Cajón', img: baseImg+'banco.png', option: 'optEC', siglas: 'EC', aAcb: [], aImp: [], 'siglasP': 'Empalme' },
        { titulo: 'Forro Cajón', img: baseImg+'banco2.png', option: 'optFCaj', siglas: 'FCaj', aAcb: [], aImp: [], 'siglasP': 'FCaj' },
        { titulo: 'Forro Cartera', img: baseImg+'banco.png', option: 'optFCar', siglas: 'FCar', aAcb: [], aImp: [], 'siglasP': 'FCar' },
        { titulo: 'Guarda', img: baseImg+'banco2.png', option: 'optG', siglas: 'G', aAcb: [], aImp: [], 'siglasP': 'Guarda' },
        /*{ titulo: 'Prueba', img: baseImg+'regalo.png', option: 'optP', siglas: 'P', aAcb: [], aImp: [], 'siglasP': 'pt' },*/
    ];

    let caja = new Almeja( {secciones: seccion, papeles: option, url: "<?=URL?>"} );

    var contenidoIzquierdo = $("#divIzquierdo-slave").contents();
    $("#divIzquierdo").empty();
    $("#divIzquierdo").append(contenidoIzquierdo);
    $("#divDerecho").empty();

    //eligira a donde se enviara la información
    caja.changeData("cotizador/saveCaja");

    //construye las secciones respecto a las divisiones que se ha declarado en la variable seccion
    caja.constructSec();

    //se asigna en que modelo esta para el select
    $("#box-model").val("1");

    //olvida el historial
    history.forward();

    //Boton Guardar
    $("#btnGrabarC").click( function() {

        // sus argumentos son: grabar, modificar. busque la funcion para entender como funciona
        caja.saveCotizacion("SI",'NO');
    });

<<<<<<< HEAD
<<<<<<< HEAD
    //history.forward();

    $("#btnImprimir").click( function(){
            
        var ventana = window.open("<?=URL?>cotizador/imprCaja/?model=1", "Impresion", "width=600, height=600");
        return true;
    });
=======
    //funciones para gift
    $("#imgEC").mouseover( function(){
>>>>>>> parent of 29fd04d (Revert "Avances almeja hasta la fecha")

        $("#imgEC").find("img").prop("src", "<?=URL?>public/img/almeja-EC.gif");
    });

    $("#imgEC").mouseout( function(){

        $("#imgEC").find("img").prop("src", "<?=URL?>public/img/banco.png");
    });
=======
>>>>>>> parent of e968c60 (Revert "avances 5 de marzo 2021")

    $("#imgFCaj").mouseover( function(){

<<<<<<< HEAD
<<<<<<< HEAD
    $(document).on('click', '.active-result', function (e) {
        
        desactivarBtn();
    });

    $(document).on('keyup', '.chosen-container', function (e) {
        
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
            desactivarBtn();
        }
    });

</script>
=======
        $("#imgFCaj").find("img").prop("src", "<?=URL?>public/img/almeja-FCaj.gif");
    });

    $("#imgFCaj").mouseout( function(){

        $("#imgFCaj").find("img").prop("src", "<?=URL?>public/img/banco2.png");
    });

    $("#imgFCar").mouseover( function(){

        $("#imgFCar").find("img").prop("src", "<?=URL?>public/img/almeja-G.gif");
    });

    $("#imgFCar").mouseout( function(){

        $("#imgFCar").find("img").prop("src", "<?=URL?>public/img/banco.png");
    });

    $("#imgG").mouseover( function(){

        $("#imgG").find("img").prop("src", "<?=URL?>public/img/almeja-FCar.gif");
    });

    $("#imgG").mouseout( function(){

        $("#imgG").find("img").prop("src", "<?=URL?>public/img/banco2.png");
    });
</script>
>>>>>>> parent of 29fd04d (Revert "Avances almeja hasta la fecha")
=======
</script>
>>>>>>> parent of e968c60 (Revert "avances 5 de marzo 2021")
