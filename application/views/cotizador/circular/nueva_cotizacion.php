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

<div id="divIzquierdo-slave" class="div-izquierdo" style="display: none; height: 98%;">

    <!-- muestra imagenes -->
    <div style="width: 100%; text-align: center; display: inline-block; background-image: url(<?=URL ;?>public/img/worn_dots.png); background-repeat: repeat; height: 25%;">
        <!-- imagenes de circular -->
        <div class="img" id="image_2" style="background-image:url(<?=URL ?>/public/img/2.png); position: relative; width: 200px;"></div>

        <div class="img" id="image_1_ancho" style="display:none;background-image:url(<?=URL ?>/public/img/1_ancho.png);">
        </div>
        <div class="img" id="image_1_alto" style="display:none;background-image:url(<?=URL ?>/public/img/1_alto.png);">
        </div>
        <div class="img" id="image_1_profundidad" style="display:none;background-image:url(<?=URL ?>/public/img/1_profundidad.png);">
        </div>

        <br>
    </div>

    <!-- formulario de la caja circular -->
    <div class="form-content medidas" style="height: 50%; overflow-y: auto;margin-left: 5px;">

        <input type="hidden" name="modelo" id="modelo" value="2">

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

        <!-- Diámetro -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Diámetro: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="diametro" id="diametro" type="number" placeholder="cm" tabindex="2" min="0.01" step="any" required>
            </div>
        </div>

        <!-- Profundidad -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Profundidad: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="profundidad" id="profundidad" type="number" step="any" min="0.01" tabindex="3" placeholder="cm" required>
            </div>
        </div>

        <!-- Altura tapa -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Altura tapa: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="altura_tapa" id="altura_tapa" type="number" step="any" min="0.1" tabindex="4" placeholder="cm" required>
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

    <div class="div-buttons" style="height: 20%; margin-top: 4%; padding: 5px;">
        
        <button type="button" id="btnabrecierres" class="btn btn-outline-primary chkSize btn-sm" data-toggle="modal" data-target="#cierres" >Añadir Cierres <img border="0" src="<?=URL ;?>public/img/add.png" style="width: 7%;"></button>

        <div id="ListaCierres" class="">

            <table class="table" id="cieTable">

                <tbody id="listcierres"></tbody>
            </table>
        </div>


        <button type="button" id="btnabreaccesorios" class="btn btn-outline-primary chkSize btn-sm" data-toggle="modal" data-target="#accesorios" >Añadir Accesorios <img border="0" src="<?=URL ;?>public/img/add.png" style="width: 7%;"></button>

        <div id="ListaAccesoriosEmp" class="">

            <table class="table" id="accesoriosTable">
                <tbody id="listaccesorios">

                </tbody>
            </table>
        </div>

        <button id="btnabrebancoemp" type="button" class="btn btn-outline-primary chkSize  btn-sm" data-toggle="modal" data-target="#bancoemp">Añadir Banco <img border="0" src="<?=URL ;?>public/img/add.png" style="width: 7%;"></button>

        <div id="ListaBancoEmp" class="">
            <table class="table" id="banTable">
                <tbody id="listbancoemp">
                    <!-- contenido seleccionado -->
                </tbody>
            </table>
        </div>    
    </div>
</div>

<div id="groupButton1" style="position:fixed; top:90%; right:0; float: right; width: 40%;text-align: right;">

    <button id="papeles_submit" type="button" class="btn btn-primary" style="font-size: 10px;">CALCULAR</button>

    <button id="subForm" type="button" class="btn btn-success" style="font-size: 10px;" enabled="" data-toggle="modal" data-target="#modalSaveAll" disabled="">GUARDAR</button>

    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#procesosModal" style="font-size: 10px;">TABLAS</button>

    <button type="button" class="btn btn-warning" id="btnResumen" style="font-size: 10px;">RESUMEN</button>

    <button id="btnImprimir" class="btn btn-info" style="font-size: 10px; border: none;" href="<?=URL ;?>cajas/impre_cajas" target="_blank">IMPRIMIR</button>
    <br>

    <button type="button" class="btn btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left;">
        <label style="font-size: 25px; margin-right: 100px;">Total: </label>
        <label id="Totalplus" style="font-size: 25px;">$0.00</label>
    </button>

    <div class="dropdown-menu" style="width: 350px;">

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

            <tbody id="resumenBCaj">
                <!-- -->
            </tbody>

            <tbody id="resumenCirCaj">
                <!-- -->
            </tbody>

            <tbody id="resumenFextCaj">
                <!-- -->
            </tbody>

            <tbody id="resumenPomCaj">
                <!-- -->
            </tbody>

            <tbody id="resumenFintCaj">
                <!-- -->
            </tbody>

            <tbody id="resumenBasTap">
                <!-- -->
            </tbody>

            <tbody id="resumenCirTap">
                <!-- -->
            </tbody>

            <tbody id="resumenFTap">
                <!-- -->
            </tbody>
            <tbody id="resumenFexTap">
                <!-- -->
            </tbody>

            <tbody id="resumenFinTap">
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

<script type="text/javascript" src="<?= URL ?>public/js/cotizador/circular.js"></script>

<script type="text/javascript">

    var contenidoIzquierdo = $("#divIzquierdo-slave").contents();
    $("#divIzquierdo").empty();
    $("#divIzquierdo").append(contenidoIzquierdo);
    $("#divDerecho").empty();

    divSecciones("Base Cajón", "optBasCajon" , "BC", "<?=URL ?>/public/img/2.png",true);
    divSecciones("Circunferencia Cajón", "optCirCajon" , "CC", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Forro Exterior Cajón", "optExtCajon" , "EC", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Pompa Cajón", "optPomCajon" , "PC", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Forro Interior Cajón", "optIntCajon" , "IC", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Base Tapa", "optBasTapa" , "BT", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Circunferencia Tapa", "optCirTapa" , "CT", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Forro Tapa", "optForTapa" , "FT", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Forro Exterior Tapa", "optExtTapa" , "ET", "<?=URL ?>/public/img/2.png",false);
    divSecciones("Forro Interior Tapa", "optIntTapa" , "IT", "<?=URL ?>/public/img/2.png",false);

    var cliente = getIdClient();
    //eligira a donde se enviara la informacion
    changeData("<?=URL?>circular/saveCaja");
    setClient( cliente );
    setURL("<?= URL ?>");

    //Boton Grabar
    $("#subForm2").click( function() {

        if(formData){

            if (formData.length > 0) {

                formData = [];
            }
        }

        var odt         = $("#odt").val();
        var diametro    = $("#diametro").val();
        var profundidad = $("#profundidad").val();
        var altura      = $("#altura_tapa").val();
        var grosor      = $("#grosor_carton").val();
        var cantidad    = $("#qty").val();

        var optBasCajon = $("#optBasCajon").val();
        var optCirCajon = $("#optCirCajon").val();
        var optExtCajon = $("#optExtCajon").val();
        var optPomCajon = $("#optPomCajon").val();
        var optIntCajon = $("#optIntCajon").val();
        var optBasTapa  = $("#optBasTapa").val();
        var optCirTapa  = $("#optCirTapa").val();
        var optForTapa  = $("#optForTapa").val();
        var optExtTapa  = $("#optExtTapa").val();
        var optIntTapa  = $("#optIntTapa").val();

        var grabar = "SI";

        var formData = $("#caja-form").serializeArray();

        var formData      = $("#caja-form").serializeArray();

        // impresion
        var aImpBC_tmp  = JSON.stringify(aImpBC, null, 4);
        var aImpCC_tmp  = JSON.stringify(aImpCC, null, 4);
        var aImpFEC_tmp = JSON.stringify(aImpFEC, null, 4);
        var aImpPC_tmp  = JSON.stringify(aImpPC, null, 4);
        var aImpFIC_tmp = JSON.stringify(aImpFIC, null, 4);
        var aImpBT_tmp  = JSON.stringify(aImpBT, null, 4);
        var aImpCT_tmp  = JSON.stringify(aImpCT, null, 4);
        var aImpFT_tmp  = JSON.stringify(aImpFT, null, 4);
        var aImpFET_tmp = JSON.stringify(aImpFET, null, 4);
        var aImpFIT_tmp = JSON.stringify(aImpFIT, null, 4);

        // acabados
        var aAcbBC_tmp  = JSON.stringify(aAcbBC, null, 4);
        var aAcbCC_tmp  = JSON.stringify(aAcbCC, null, 4);
        var aAcbFEC_tmp = JSON.stringify(aAcbFEC, null, 4);
        var aAcbPC_tmp  = JSON.stringify(aAcbPC, null, 4);
        var aAcbFIC_tmp = JSON.stringify(aAcbFIC, null, 4);
        var aAcbBT_tmp  = JSON.stringify(aAcbBT, null, 4);
        var aAcbCT_tmp  = JSON.stringify(aAcbCT, null, 4);
        var aAcbFT_tmp  = JSON.stringify(aAcbFT, null, 4);
        var aAcbFET_tmp = JSON.stringify(aAcbFET, null, 4);
        var aAcbFIT_tmp = JSON.stringify(aAcbFIT, null, 4);

        // cierres
        var aCierres_tmp = JSON.stringify(aCierres, null, 4);


        // bancos
        var aBancos_tmp = JSON.stringify(aBancos, null, 4);


        // accesorios
        var aAccesorios_tmp = JSON.stringify(aAccesorios, null, 4);

        var cliente  = getIdClient();

        var id_cliente_tmp = JSON.stringify(cliente, null, 4);

        formData.push({name: 'id_cliente', value: id_cliente_tmp});   // calculadora

        formData.push({name: 'aImpBCaj', value: aImpBC_tmp});
        formData.push({name: 'aImpCirCaj', value: aImpCC_tmp});
        formData.push({name: 'aImpFextCaj', value: aImpFEC_tmp});
        formData.push({name: 'aImpPomCaj', value: aImpPC_tmp});
        formData.push({name: 'aImpFintCaj', value: aImpFIC_tmp});
        formData.push({name: 'aImpBTapa', value: aImpBT_tmp});
        formData.push({name: 'aImpCirTapa', value: aImpCT_tmp});
        formData.push({name: 'aImpFTapa', value: aImpFT_tmp});
        formData.push({name: 'aImpFextTapa', value: aImpFET_tmp});
        formData.push({name: 'aImpFintTapa', value: aImpFIT_tmp});

        formData.push({name: 'aAcbBCaj', value: aAcbBC_tmp});
        formData.push({name: 'aAcbCirCaj', value: aAcbCC_tmp});
        formData.push({name: 'aAcbFextCaj', value: aAcbFEC_tmp});
        formData.push({name: 'aAcbPomCaj', value: aAcbPC_tmp});
        formData.push({name: 'aAcbFintCaj', value: aAcbFIC_tmp});
        formData.push({name: 'aAcbBTapa', value: aAcbBT_tmp});
        formData.push({name: 'aAcbCirTapa', value: aAcbCT_tmp});
        formData.push({name: 'aAcbFTapa', value: aAcbFT_tmp});
        formData.push({name: 'aAcbFextTapa', value: aAcbFET_tmp});
        formData.push({name: 'aAcbFintTapa', value: aAcbFIT_tmp});

        formData.push({name: 'aCierres', value: aCierres_tmp});
        formData.push({name: 'aBancos', value: aBancos_tmp});
        formData.push({name: 'aAccesorios', value: aAccesorios_tmp});

        // descuento
        formData.push({name: 'descuento_pctje', value: descuento});
        formData.push({name: 'grabar', value: grabar});

        var modificar_odt = "NO";

        formData.push({name: 'modificar', value: modificar_odt});

        //$("#subForm").prop("disabled", true);

        var odt1 = $("#odt").val();

        var odtval = [];

        odtval.push({name: 'odt', value: odt1});

        //if( revisarImpAcb() == false ) return false;

        $.ajax({                                // GRABAR
            type:"POST",
            async: false,
            //dataType: "json",
            url: $('#caja-form').attr('action'),
            data: formData,
        })
        .done(function( response ) {

            console.log("(3033) response: ");
            console.log(response);

            try {

                var js_respuesta = JSON.parse( response );
                var error        = js_respuesta.error;

                if (error.length > 0) {

                    document.getElementsByName("subForm").disabled = true;

                    showModError("");
                    $("#txtContenido").html("(3046 " + error);

                } else {

                    showModCorrecto("Los datos han sido guardados correctamente...");
                }
            } catch(e) {

                var js_respuesta = JSON.parse( response );
                var error        = js_respuesta.error;

                if (error.length > 0) {

                    document.getElementsByName("subForm").disabled = true;

                    showModError("");
                    $("#txtContenido").html("(3062) " + error);
                } else {

                    document.getElementsByName("subForm").disabled = true;

                    showModError("");
                    $("#txtContenido").html("(3068) Error al grabar en la Base de Datos");
                }
            }
        })
        .fail(function(response) {

            console.log('(3074) Bug! revisa...');
        });
    });
    $("#box-model").val("2");
</script>