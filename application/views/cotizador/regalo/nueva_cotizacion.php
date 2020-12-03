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
        transition: background-color .4s;
    }
    .secciones:hover{

        background: #5B84B1;
    }

    .groupButton2{

        transition: 2s linear ;

    }

    .divContenido{

        display: block; text-align: center; width: 100%;
    }
</style>

<div id="divIzquierdo-slave" class="div-izquierdo" style="display: none; height: 98%; margin: 0px;">

    <div style="width: 100%; text-align: center; display: inline-block; background-image: url(<?=URL ;?>public/img/worn_dots.png); background-repeat: repeat; height: 25%;">
        <!-- imagenes de circular -->
        <div class="img" id="image_2" style="background-image:url(<?=URL ?>/public/img/regalo2.png); position: relative; width: 100%;"></div>

        <div class="img" id="image_1_ancho" style="display:none;background-image:url(<?=URL ?>/public/img/1_ancho.png);">
        </div>
        <div class="img" id="image_1_alto" style="display:none;background-image:url(<?=URL ?>/public/img/1_alto.png);">
        </div>
        <div class="img" id="image_1_profundidad" style="display:none;background-image:url(<?=URL ?>/public/img/1_profundidad.png);">
        </div>

        <br>
    </div>

    <!-- formulario de la caja circular -->
    <div class="form-content medidas" style="height: 50%; width: 100%;overflow: auto;">

        <div style="min-width: 200px; width: 100%;">

            <input type="hidden" name="modelo" id="modelo" value="<?=$id_modelo?>">

            <!-- ODT -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <input type="hidden" name="nombre_cliente" id="nombre_cliente" value="<?= $nombrecliente ?>">
                    <span>ODT: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <input class="cajas-input medidas-input" name="odt" id="odt" type="text" placeholder="ODT" tabindex="1" min="1" step="1" autofocus="" required="">
                </div>
            </div>

            <!-- Base -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <span>Base: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <input class="cajas-input medidas-input" name="base" id="base" type="number" placeholder="cm" tabindex="2" min="0.01" step="any" required>
                </div>
            </div>

            <!-- Alto -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <span>Alto: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <input class="cajas-input medidas-input" name="alto" id="alto" type="number" step="any" min="0.01" tabindex="3" placeholder="cm" required>
                </div>
            </div>

            <!-- Profundidad del Cajón -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <span>Profundidad Cajón: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <input class="cajas-input medidas-input" name="profundidad_cajon" id="profundidad_cajon" type="number" step="any" min="0.1" tabindex="4" placeholder="cm" required>
                </div>
            </div>

            <!-- Profundidad de la Tapa -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <span>Profundidad Tapa: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <input class="cajas-input medidas-input" name="profundidad_tapa" id="profundidad_tapa" type="number" step="any" min="0.1" tabindex="4" placeholder="cm" required>
                </div>
            </div>

            <!-- Grosor Cajón -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <span>Grosor Cartón: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <select class="cajas-input medidas-input" name="grosor_carton" id="grosor_carton" tabindex="5" required>

                        <option data-price="40" data-ancho="90" data-largo="130" selected="" value="" disabled>Elige</option>

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

            <!-- Grosor Tapa -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <span>Grosor Tapa: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <select class="cajas-input medidas-input" name="grosor_tapa" id="grosor_tapa" tabindex="5" required>

                        <option data-price="40" data-ancho="90" data-largo="130" selected="" value="" disabled>Elige</option>

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

            <!-- Cantidad -->
            <div class="input-group">

                <div class="cajas-col-input t-left">

                    <span>Cantidad: </span>
                </div>

                <div class="cajas-col-input t-right">

                    <input class="cajas-input" name="qty" id="qty" type="number" min="1" step="1" placeholder="Cantidad" tabindex="6" required="">
                </div>
            </div>
        </div>
        
    </div>

    <div class="div-buttons" style="height: 20%; margin-top: 4%; padding: 5px;">
        
        <button type="button" id="btnabrecierres" class="btn btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#cierres" ><img border="0" src="<?=URL ;?>public/img/add.png" style="width: 7%;"> Cierres</button>

        <div id="ListaCierres" class="">

            <table class="table" id="cieTable">

                <tbody id="listcierres"></tbody>
            </table>
        </div>


        <button type="button" id="btnabreaccesorios" class="btn btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#accesorios" ><img border="0" src="<?=URL ;?>public/img/add.png" style="width: 7%;"> Accesorios </button>

        <div id="ListaAccesoriosEmp" class="">

            <table class="table" id="accesoriosTable">
                <tbody id="listaccesorios">

                </tbody>
            </table>
        </div>

        <button id="btnabrebancoemp" type="button" class="btn btn-outline-primary chkSize  btn-sm text-left" data-toggle="modal" data-target="#bancoemp"><img border="0" src="<?=URL ;?>public/img/add.png" style="width: 7%;"> Banco</button>

        <div id="ListaBancoEmp" class="">
            <table class="table" id="banTable">
                <tbody id="listbancoemp">
                    <!-- contenido seleccionado -->
                </tbody>
            </table>
        </div>    
    </div>
</div>

<!-- Resumen -->
    <div id="resumentodocaja" style="display: none;">

        <button type="button" style="text-align: end; border: none; background: none; width: 100%;" id="btnQuitarResumen"><img border="0" src="<?=URL ;?>public/img/eliminar.png" style="width: 2%;">
        </button>

        <table class="table tableresumenn" id="ResumenCostos">

            <thead class="thead-dark">

                <tr>
                    <th style="width: 20%"></th>
                    <th>Adiciones</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                </tr>
            </thead>

            <thead id="resumenHead">
                <!-- -->
            </thead>

            <tbody id="resumenPapeles">
                <!-- -->
            </tbody>

            <tbody id="resumenEC">
                <!-- -->
            </tbody>

            <tbody id="resumenFC">
                <!-- -->
            </tbody>

            <tbody id="resumenET">
                <!-- -->
            </tbody>

            <tbody id="resumenFT">
                <!-- -->
            </tbody>

            <tbody id="resumenEncuadernacion">
                <!-- -->
            </tbody>

            <tbody id="resumenMensajeria">
                <!-- -->
            </tbody>

            <tbody id="resumenEmpaque">
                <!-- -->
            </tbody>

            <tbody id="resumenBancos">
                <!-- -->
            </tbody>

            <tbody id="resumenCierres">
                <!-- -->
            </tbody>

            <tbody id="resumenAccesorios">
                <!-- -->
            </tbody>

            <tbody id="resumenOtros">
                <!-- -->
            </tbody>
        </table>
        <img border="0" src="<?=URL ;?>public/img/henpp.png" style="width: 7%; margin: 2%"><small>Todos los derechos reservados. Historias En Papel 2019.</small>
    </div>

<?php
    require "application/views/templates/cotizador/acabados.php";
    require "application/views/templates/cotizador/extras.php";
    require "application/views/templates/cotizador/impresiones.php";
?>

<script type="text/javascript" src="<?= URL ?>public/js/cotizador/regalo.js"></script>

<script type="text/javascript">

    //checkDimensions();
    var contenidoIzquierdo = $("#divIzquierdo-slave").contents();
    $("#divIzquierdo").empty();
    $("#divIzquierdo").append(contenidoIzquierdo);

    /*var contenidoDerecho = $("#divDerecho-slave").contents();
    $("#divDerecho").empty();
    $("#divDerecho").append(contenidoDerecho);*/
    $("#divDerecho").empty();

    divSecciones("Empalme Cajón", "optEC" , "EC", "<?=URL ?>/public/images/regalo/regalo.png",true);
    divSecciones("Forro Cajón", "optFC" , "FC", "<?=URL ?>/public/images/regalo/regalo.png",false);
    divSecciones("Empalme Tapa", "optET" , "ET", "<?=URL ?>/public/images/regalo/regalo.png",false);
    divSecciones("Forro Tapa", "optFT" , "FT", "<?=URL ?>/public/images/regalo/regalo.png",false);

    var cliente = getIdClient();
    //eligira a donde se enviara la informacion
    changeData("<?=URL?>regalo/saveCaja");
    setClient( cliente );
    setURL("<?= URL ?>");

    //Boton Calcular
    $("#btnGrabarC").click( function() {

        var precio;
        var papel;

        var odt               = $("#odt").val();
        var base              = $("#base").val();
        var alto              = $("#alto").val();
        var profundidad_cajon = $("#profundidad_cajon").val();
        var profundidad_tapa  = $("#profundidad_tapa").val();
        var grosor_carton      = $("#grosor_carton").val();
        var grosor_tapa       = $("#grosor_tapa").val();
        var cantidad          = $("#qty").val();

        if( revisarPropiedades(odt,"ODT") == false ) return false;

        if( revisarPropiedades(base,"base") == false ) return false;
        
        if( revisarPropiedades(alto,"alto") == false ) return false;
        
        if( revisarPropiedades(profundidad_cajon,"Profundidad Cajón") == false ) return false;

        if( revisarPropiedades(profundidad_tapa,"Profundidad Tapa") == false ) return false;
        
        if( revisarPropiedades(grosor_carton,"Grosor Cartón") == false ) return false;

        if( revisarPropiedades(grosor_tapa,"Grosor Tapa") == false ) return false;

        if( revisarPropiedades(cantidad,"Cantidad") == false ) return false;
        //if( revisarImpAcb() == false ) return false;

        var grabar = "SI";
        var optEC  = $("#optEC").val();
        var optFC  = $("#optFC").val();
        var optET  = $("#optET").val();
        var optFT  = $("#optFT").val();

        if (typeof formData !== 'undefined' && formData.length > 0) {

            formData = [];
        }

        var formData      = $("#dataForm").serializeArray();

        // impresion
        var aImpEC_tmp  = JSON.stringify(aImpEC, null, 4);
        var aImpFC_tmp  = JSON.stringify(aImpFC, null, 4);
        var aImpET_tmp = JSON.stringify(aImpET, null, 4);
        var aImpFT_tmp  = JSON.stringify(aImpFT, null, 4);

        // acabados
        var aAcbEC_tmp  = JSON.stringify(aAcbEC, null, 4);
        var aAcbFC_tmp  = JSON.stringify(aAcbFC, null, 4);
        var aAcbET_tmp = JSON.stringify(aAcbET, null, 4);
        var aAcbFT_tmp  = JSON.stringify(aAcbFT, null, 4);

        // cierres
        var aCierres_tmp = JSON.stringify(aCierres, null, 4);


        // bancos
        var aBancos_tmp = JSON.stringify(aBancos, null, 4);


        // accesorios
        var aAccesorios_tmp = JSON.stringify(aAccesorios, null, 4);

        var id_cliente_tmp = JSON.stringify(cliente, null, 4);
        
        formData.push({name: 'id_cliente', value: id_cliente_tmp});
        
        formData.push({name: 'aImpEC', value: aImpEC_tmp});
        formData.push({name: 'aImpFC', value: aImpFC_tmp});
        formData.push({name: 'aImpET', value: aImpET_tmp});
        formData.push({name: 'aImpFT', value: aImpFT_tmp});

        formData.push({name: 'aAcbEC', value: aAcbEC_tmp});
        formData.push({name: 'aAcbFC', value: aAcbFC_tmp});
        formData.push({name: 'aAcbET', value: aAcbET_tmp});
        formData.push({name: 'aAcbFT', value: aAcbFT_tmp});

        formData.push({name: 'aCierres', value: aCierres_tmp});
        formData.push({name: 'aBancos', value: aBancos_tmp});
        formData.push({name: 'aAccesorios', value: aAccesorios_tmp});
        formData.push({name: 'descuento_pctje', value: descuento});
        formData.push({name: 'grabar', value: grabar});

        var modificar_odt = "NO";

        formData.push({name: 'modificar', value: modificar_odt});
        showLoading();
        $.ajax({
            type:"POST",
            //dataType: "json",
            url: $('#dataForm').attr('action'),
            data: formData,
        })
        .done(function(response) {

            console.log("(3033) response: ");
            console.log(response);
            hideLoading();
            try {

                var respuesta = JSON.parse( response );

                if (!respuesta.hasOwnProperty("error")) {

                    var error = respuesta.error;
                    showModError("");
                    $("#txtContenido").html("(2277) " + error);

                } else {

                    showModCorrecto("Los datos han sido guardados correctamente...");
                }
            } catch( e ) {

                showModError("");
                $("#txtContenido").html("(3310) Error..." + e);
            }
        })
        .fail(function(response) {

            console.log('(2307) Hubo un Error inesperado. Por favor llame a sistemas.');

            desactivarBtn();
        });
    });
    $("#box-model").val("4");
</script>


<script>

    /*
    //PROYECTO A FUTURO...
    var o = 1;
    $("#btnToggle").click( function(){

        if( o == 1 ){
            
            $("#btnToggle").text("▼");
            $("#divToggle").animate({ "top": "-=8%" }, 250 ,"");
            o = 0;
        }else{

            $("#btnToggle").text("▲");
            $("#divToggle").animate({ "top": "+=8%" }, 250 ,"");
            o = 1;
        }
        
    });*/

    history.forward();
</script>