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
    <div class="form-content medidas" style="height: 50%; overflow-y: auto;margin-left: 5px;">

        <input type="hidden" name="modelo" id="modelo" value="$id_modelo">

        <!-- ODT -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <input type="hidden" name="nombre_cliente" id="nombre_cliente" value="<?= $nombrecliente ?>">
                <span>ODT: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="odt" id="odt" type="text" placeholder="ODT" tabindex="1" min="1" step="1" autofocus="" required="" value="<?= $aJson['num_odt']?>">
            </div>


        </div>

        <!-- Base -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Base: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="base" id="base" type="number" placeholder="cm" tabindex="2" min="0.01" step="any" required value="<?= $aJson['base']?>">
            </div>
        </div>

        <!-- Alto -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Alto: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="alto" id="alto" type="number" step="any" min="0.01" tabindex="3" placeholder="cm" required value="<?= $aJson['alto']?>">
            </div>
        </div>

        <!-- Profundidad del Cajón -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Profundidad Cajón: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="profundidad_cajon" id="profundidad_cajon" type="number" step="any" min="0.1" tabindex="4" placeholder="cm" required value="<?= $aJson['profundidad_cajon']?>">
            </div>
        </div>

        <!-- Profundidad de la Tapa -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Profundidad Tapa: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="profundidad_tapa" id="profundidad_tapa" type="number" step="any" min="0.1" tabindex="4" placeholder="cm" required value="<?= $aJson['profundidad_tapa']?>">
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

                <input class="cajas-input" name="qty" id="qty" type="number" min="1" step="1" placeholder="Cantidad" tabindex="6" required="" value="<?= $aJson['tiraje']?>">
            </div>
        </div>

        <!-- Mismo papel para todos -->
        <div class="input-group custom-control custom-checkbox mr-sm-2">
            
            <input type="checkbox" name="btnCheckPaper" id="btnCheckPaper" class="custom-control-input">
            <label class="custom-control-label" for="btnCheckPaper"style="font-size: 15px; cursor: pointer;" class="btn btn-outline-primary">Mismo Papel P/Todos</label>
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

<div id="groupButton1" style="position:fixed; top:90%; right:0; float: right; width: 70%;text-align: right;">

    <button id="papeles_submit" type="button" class="btn btn-primary" style="font-size: 10px;">CALCULAR</button>

    <button id="subForm" type="button" class="btn btn-success" style="font-size: 10px;" enabled="" data-toggle="modal" data-target="#modalSaveAll" disabled="">ACUALIZAR</button>

    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#procesosModal" style="font-size: 10px;">TABLAS</button>

    <button type="button" class="btn btn-warning" id="btnResumen" style="font-size: 10px;">RESUMEN</button>

    <button id="btnImprimir" class="btn btn-info" style="font-size: 10px; border: none;" href="<?=URL ;?>cajas/impre_cajas" target="_blank" disabled="">IMPRIMIR</button>
    <br>

    <button type="button" class="btn btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: left;">
        <label style="font-size: 25px; margin-right: 100px;">Total: </label>
        <label id="Totalplus" style="font-size: 25px;">$<?= $aJson['costo_odt']?></label>
    </button>

    <div class="dropdown-menu" style="width: 350px;">

        <table class="table">
            <tr>
                <td>Subtotal: </td>
                <td id="tdSubtotalCaja" class="grand-total">$<?= $aJson['costo_subtotal']?></td>
            </tr>
            <tr>
                <td>Utilidad: </td>
                <td id="UtilidadDrop">$<?= $aJson['Utilidad']?></td>
            </tr>
            <tr>
                <td>IVA:</td>
                <td id="IVADrop">$<?= $aJson['iva']?></td>
            </tr>

            <tr>
                <td>ISR: </td>
                <td id="ISRDrop">$<?= $aJson['ISR']?></td>
            </tr>
            <tr>
                <td>Comisiones: </td>
                <td id="ComisionesDrop">$<?= $aJson['comisiones']?></td>
            </tr>
            <tr>
                <td>% Indirecto: </td>
                <td id="IndirectoDrop">$<?= $aJson['indirecto']?></td>
            </tr>
            <tr>
                <td>Ventas: </td>
                <td id="VentasDrop">$<?= $aJson['ventas']?></td>
            </tr>
            <tr>
                <td>
                    <button type="button" id="descuentoModal" style="border: none; background: white;">Descuento: (<?= $aJson['descuento_pctje']?>%) </button>
                </td>
                <td id="DescuentoDrop">$<?= $aJson['descuento']?></td>
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

            <thead id="resumenHead"></thead>

            <tbody id="resumenPapeles"></tbody>

            <tbody id="resumenEC"></tbody>

            <tbody id="resumenFC"></tbody>

            <tbody id="resumenET"></tbody>

            <tbody id="resumenFT"></tbody>

            <tbody id="resumenEncuadernacion"></tbody>

            <tbody id="resumenMensajeria"></tbody>

            <tbody id="resumenEmpaque"></tbody>

            <tbody id="resumenBancos"></tbody>

            <tbody id="resumenCierres"></tbody>

            <tbody id="resumenAccesorios"></tbody>

            <tbody id="resumenOtros"></tbody>
        </table>
        <img border="0" src="<?=URL ;?>public/img/henpp.png" style="width: 7%; margin: 2%"><small>Todos los derechos reservados. Historias En Papel 2019.</small>
    </div>

<?php require "application/views/templates/cotizador/acabados.php"?>
<?php require "application/views/templates/cotizador/extras.php"?>
<?php require "application/views/templates/cotizador/impresiones.php"?>

<!--

    Al parecer se debe de hacer los require primero y despues el script que
    se hace referencia al modelo de caja.
-->
<script type="text/javascript" src="<?= URL ?>public/js/cotizador/regalo.js"></script>

<script type="text/javascript">

    var a = [<?php echo json_encode($aJson) ?>];

    console.log(a);
</script>

<script type="text/javascript">
    

    var idCarton = parseInt("<?= $aJson['costo_grosor_carton']['id_cajon']?>");
    var idTapa = parseInt("<?= $aJson['costo_grosor_tapa']['id_cajon']?>");

    $("#grosor_carton option[data-id=" + idCarton +"]").attr("selected", true);

    $("#grosor_tapa option[data-id=" + idTapa +"]").attr("selected", true);

    var idEC = parseInt("<?= $aJson['id_papel_emp']?>");
    var idFC = parseInt("<?= $aJson['id_papel_fcaj']?>");
    var idET = parseInt("<?= $aJson['id_papel_emptap']?>");
    var idFT = parseInt("<?= $aJson['id_papel_ftap']?>");

    //muestra los papeles elegidos
    $("#divDerecho").empty();
    divSeccionesA("Empalme Cajón", "optEC" , "EC", "<?=URL ?>/public/images/regalo/regalo.png", idEC);
    divSeccionesA("Forro Cajón", "optFC" , "FC", "<?=URL ?>/public/images/regalo/regalo.png", idFC);
    divSeccionesA("Empalme Tapa", "optET" , "ET", "<?=URL ?>/public/images/regalo/regalo.png", idET);
    divSeccionesA("Forro Tapa", "optFT" , "FT", "<?=URL ?>/public/images/regalo/regalo.png", idFT);
    /*$("#optEC option[value='" + idEC +"']").prop("selected",true);
    $("#optFC option[value='" + idFC +"']").prop("selected",true);
    $("#optET option[value='" + idET +"']").prop("selected",true);
    $("#optFT option[value='" + idFT +"']").prop("selected",true);*/
</script>

<script type="text/javascript">


    //checkDimensions();
    var contenidoIzquierdo = $("#divIzquierdo-slave").contents();
    //var contenidoDerecho = $("#divDerecho-slave").contents();
    $("#divIzquierdo").empty();
    $("#divIzquierdo").append(contenidoIzquierdo);

    //$("#divDerecho").append(contenidoDerecho);
    
    var cliente = getIdClient();
    //eligira a donde se enviara la informacion
    changeData("<?=URL?>regalo/saveCaja");
    setClient( cliente );
    setURL("<?= URL ?>");

    var trEC   = '<tr><td><b>Empalme Cajón</b></td><td></td><td></td><td></td></tr>';
    var trFC    = '<tr><td><b>Forro Cajón</b></td><td></td><td></td><td></td></tr>';
    var trET  = '<tr><td><b>Empalme Tapa</b></td><td></td><td></td><td></td></tr>';
    var trFT    = '<tr><td><b>Forro Tapa</b></td><td></td><td></td><td></td></tr>';

    var trMensajeria = '<tr><td><b>Costo Mensajería</b></td><td></td><td></td><td></td></tr>';
    var trEmpaque = '<tr><td><b>Costo Empaque</b></td><td></td><td></td><td></td></tr>';
    var trEncuadernacion = '<tr><td><b>Encuadernación</b></td><td></td><td></td><td></td></tr>';

    //imprime titulos para resumen
    $('#resumenEC').append(trEC);
    $('#resumenFC').append(trFC);
    $('#resumenET').append(trET);
    $('#resumenFT').append(trFT);

    $('#resumenMensajeria').append(trMensajeria);
    $('#resumenEmpaque').append(trEmpaque);
    $('#resumenEncuadernacion').append(trEncuadernacion);

    var AGlobal = <?php echo json_encode($aJson)?>;

    descuento = AGlobal['descuento_pctje'];

    appndPapeles( AGlobal, "papel_Emp");
    appndPapeles( AGlobal, "papel_FCaj");
    appndPapeles( AGlobal, "papel_EmpTap");
    appndPapeles( AGlobal, "papel_FTap");

    /*appndPapelCarton( AGlobal, AGlobal['costo_grosor_carton'], "Cartón Cajón" );
    appndPapelCarton( AGlobal, AGlobal['papel_Emp'], "Empalme Cajón" );
    appndPapelCarton( AGlobal, AGlobal['papel_FCaj'], "Forro Cajón" );
    appndPapelCarton( AGlobal, AGlobal['costo_grosor_tapa'], "Cartón Tapa" );
    appndPapelCarton( AGlobal, AGlobal['papel_EmpTap'], "Empalme Tapa" );
    appndPapelCarton( AGlobal, AGlobal['papel_FTap'], "Forro Tapa" );*/

    var aImpEC1 = <?php echo json_encode($aJson['aImpempcaj']) ?>;
    var aImpFC1 = <?php echo json_encode($aJson['aImpfcaj']) ?>;
    var aImpET1 = <?php echo json_encode($aJson['aImpemptap']) ?>;
    var aImpFT1 = <?php echo json_encode($aJson['aImpftap']) ?>;

    appndImpMod(aImpEC1,"EC", aImpEC);
    appndImpMod( aImpFC1, "FC", aImpFC );
    appndImpMod( aImpET1, "ET", aImpET );
    appndImpMod( aImpFT1, "FT", aImpFT );

    var aAcbEC1 = <?php echo json_encode($aJson['aAcbecaj']) ?>;
    var aAcbFC1 = <?php echo json_encode($aJson['aAcbfcaj']) ?>;
    var aAcbET1 = <?php echo json_encode($aJson['aAcbemptap']) ?>;
    var aAcbFT1 = <?php echo json_encode($aJson['aAcbftap']) ?>;

    appndAcbMod( aAcbEC1,"EC", aAcbEC);
    appndAcbMod( aAcbFC1, "FC", aAcbFC );
    appndAcbMod( aAcbET1, "ET", aAcbET );
    appndAcbMod( aAcbFT1, "FT", aAcbFT );

    var cierres    = <?php echo json_encode($aJson['Cierres'])?>;
    var accesorios = <?php echo json_encode($aJson['Accesorios'])?>;
    var bancos     = <?php echo json_encode($aJson['Bancos'])?>;

    if( cierres !== undefined && cierres !== null ){

        for (var i = 0; i < cierres.length; i++) {

            var tr ="";
            var opCie = cierres[i]['Tipo_cierre'];
            switch(opCie){

                case "Iman":

                    var numpares = cierres[i]['numpares'];

                    tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Numero de Pares: '+ numpares +'</span></td><td style="display: none">'+ numpares +'</td><td class="listcierres img_delete"></td></tr>';
                    aCierres.push({"Tipo_cierre": opCie, "numpares": numpares, "largo": null, "ancho": null, "tipo": null, "color": null});
                break;
                case "Liston":

                    var LarListon = cierres[i]['largo'];
                    var AnchListon = cierres[i]['ancho'];
                    var tipoListon = cierres[i]['tipo'];
                    var colorListon = cierres[i]['color'];
                    tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Largo: '+ LarListon +', Ancho: '+ AnchListon +', Tipo: '+ tipoListon +', Color: '+ colorListon +' </span></td><td style="display: none">'+ LarListon +'</td><td style="display: none">'+ AnchListon +'</td><td style="display: none">'+ tipoListon +'</td><td style="display: none">'+ colorListon +'</td><td class="listcierres img_delete"></td></tr>';
                    aCierres.push({"Tipo_cierre": opCie, "numpares": 1, "largo": LarListon, "ancho": AnchListon, "tipo": tipoListon, "color": colorListon});

                break;
                case "Marialuisa":

                    tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Se agrego un cierre Marialuisa</span></td><td class="listcierres img_delete"></td></tr>';
                    aCierres.push({"Tipo_cierre": opCie, "numpares": 1, "largo": null, "ancho": null, "tipo": null, "color": null});

                break;
                case "Suaje calado":

                    var LarSuajCal = cierres[i]['largo'];
                    var AnchSuajCal = cierres[i]['ancho'];
                    var tipoSuajCal = cierres[i]['tipo'];
                    tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Largo: '+ LarSuajCal +', Ancho: '+ AnchSuajCal +', Tipo: '+ tipoSuajCal +'</span></td><td style="display: none">'+ LarSuajCal +'</td><td style="display: none">'+ AnchSuajCal +'</td><td style="display: none">'+ tipoSuajCal +'</td><td class="listcierres img_delete"></td></tr>';
                    aCierres.push({"Tipo_cierre": opCie, "numpares": 1, "largo": LarSuajCal, "ancho": AnchSuajCal, "tipo": tipoSuajCal, "color": null});

                break;
                case "Velcro":

                    var numpares = cierres[i]['numpares'];
                    tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Numero de Pares: '+ numpares +'</span></td><td style="display: none">'+ numpares +'</td><td class="listcierres img_delete"></td></tr>';
                    aCierres.push({"Tipo_cierre": opCie, "numpares": numpares, "largo": null, "ancho": null, "tipo": null, "color": null});

                break;
            }
            $('#listcierres').append(tr);
        }
    }

    if( accesorios !== undefined && accesorios !== null ){

        for (var i = 0; i < accesorios.length; i++) {

            var tr ="";
            var nombreAccesorio = accesorios[i]['Tipo_accesorio'];
            switch(nombreAccesorio){

                case "Lengueta de Liston":

                    var largo = accesorios[i]['Largo'];
                    var ancho = accesorios[i]['Ancho'];
                    var color = accesorios[i]['Color'];
                    var precio = accesorios[i]['costo_unit_accesorio'];

                    tr = '<tr><td style="text-align: left;">' + nombreAccesorio +'</td><td class="CellWithComment">...<span class="CellComment">Largo: ' + largo + ' Ancho: ' + ancho + ' Color: ' + color + '</span></td><td style="display:none">'+ largo +'</td><td style="display:none">'+ancho+'</td><td style="display:none">'+ color +'</td><td style="display:none"></td><td style="display:none">'+herraje+'</td><td style="display:none">'+precio+'</td><td class="listaccesorios img_delete"></td></tr>';
                    aAccesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": largo, "Ancho": ancho, "Color": color, "Herraje": null, "Precio": precio});
                break;
                case "Herraje":

                    var herraje = accesorios[i]['Tipo'];
                    var precio = accesorios[i]['costo_unit_accesorio'];
                    tr = '<tr><td style="text-align: left;">' + nombreAccesorio + '</td><td class="CellWithComment">...<span class="CellComment">Herraje: ' + herraje + '</span></td><td style="display:none"></td><td style="display:none"></td><td style="display:none"></td><td style="display:none">'+herraje+'</td><td style="display:none">'+precio+'</td><td class="listaccesorios img_delete"></td></tr>';

                    aAccesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": null, "Ancho": null, "Color": null, "Herraje": herraje, "Precio": precio});

                break;
                case "Ojillos":

                    var precio = accesorios[i]['costo_unit_accesorio'];
                    tr = '<tr><td style="text-align: left;">' + nombreAccesorio + '</td><td style=""></td><td style="display:none"></td><td style="display:none"></td><td style="display:none"></td><td style="display:none"></td><td style="display:none">'+precio+'</td><td class="listaccesorios img_delete"></td></tr>';

                    aAccesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": null, "Ancho": null, "Color": null, "Herraje": null, "Precio": precio});

                break;
                case "Resorte":

                    var largo = accesorios[i]['Largo'];
                    var ancho = accesorios[i]['Ancho'];
                    var color = accesorios[i]['Color'];
                    var precio = accesorios[i]['costo_unit_accesorio'];
                    tr = '<tr><td style="text-align: left;">' + nombreAccesorio +'</td><td class="CellWithComment">...<span class="CellComment">Largo: ' + largo + ' Ancho: ' + ancho + ' Color: ' + color + '</span></td><td style="display:none">'+ largo +'</td><td style="display:none">'+ancho+'</td><td style="display:none">'+ color +'</td><td style="display:none"></td><td style="display:none">'+herraje+'</td><td style="display:none">' + precio + '</td><td class="listaccesorios img_delete"></td></tr>';

                    aAccesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": largo, "Ancho": ancho, "Color": color, "Herraje": null, "Precio": precio});

                break;
            }
            $('#listaccesorios').append(tr);
        }
    }

    if( bancos !== undefined && bancos !== null ){

        for (var i = 0; i < bancos.length; i++) {

            var opBan = bancos[i]['Tipo_banco'];
            var tr = "";
            if( opBan === 'Carton' || opBan === 'Eva' || opBan === 'Espuma' || opBan === 'Empalme Banco' ){

                var LargoMBanco = bancos[i]['largo'];
                var AnchoMBanco = bancos[i]['ancho'];
                var ProfundidadMBanco = bancos[i]['profundidad'];
                var LLevaSuajeM = bancos[i]['Suaje'];
                tr  = '<tr><td style="text-align: left;">Banco</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ opBan +', Largo: '+ LargoMBanco +', Ancho: '+ AnchoMBanco +', Profundidad: '+ ProfundidadMBanco +', Suaje: '+ LLevaSuajeM +'</span></td><td style="display: none">'+ opBan +'</td><td style="display: none">'+ LargoMBanco +'</td><td style="display: none">'+ AnchoMBanco +'</td><td style="display: none">'+ ProfundidadMBanco +'</td><td style="display: none">'+ LLevaSuajeM +'</td><td class="listbancoemp img_delete"></td></tr>';
                aBancos.push({"Tipo_banco": opBan, "largo": LargoMBanco, "ancho": AnchoMBanco, "Profundidad": ProfundidadMBanco, "Suaje": LLevaSuajeM});
            }else if( opBan === 'Cartulina Suajada' ){

                var LargoMBanco = bancos[i]['largo'];
                var AnchoMBanco = bancos[i]['ancho'];
                var ProfundidadMBanco = bancos[i]['profundidad'];
                tr  = '<tr><td style="text-align: left;">Banco</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ opBan +', Largo: '+ LargoMBanco +', Ancho: '+ AnchoMBanco +', Profundidad: '+ ProfundidadMBanco +'</span></td><td style="display: none">'+ opBan +'</td><td style="display: none">'+ LargoMBanco +'</td><td style="display: none">'+ AnchoMBanco +'</td><td style="display: none">'+ ProfundidadMBanco +'</td><td class="listbancoemp img_delete"></td></tr>';
                aBancos.push({"Tipo_banco": opBan, "largo": LargoMBanco, "ancho": AnchoMBanco, "Profundidad": ProfundidadMBanco, "Suaje": null});
            }
            $('#listbancoemp').append(tr);
        }
    }

    //Boton Guardar
    $("#subForm2").click( function() {

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
        showLoading();
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

        var modificar_odt = "SI";

        formData.push({name: 'modificar', value: modificar_odt});

        var id_odt = "<?=$aJson['id_odt']?>";

        formData.push({name: 'id_odt_ant', value: id_odt});

        $.ajax({
            type:"POST",
            //dataType: "json",
            url: $('#dataForm').attr('action'),
            data: formData,
        })
        .done(function(response) {
            hideLoading();
            console.log("(1876) response: ");
            console.log(response);

            try {

                var respuesta = JSON.parse( response );

                if (!respuesta.hasOwnProperty("error")) {

                    var error = respuesta.error;
                    showModError("");
                    $("#txtContenido").html("(1887) " + error);
                } else {

                    showModCorrecto("Los datos han sido actualizados correctamente...");
                }
            } catch( e ) {

                showModError("");
                $("#txtContenido").html("(1895) Error..." + e);
            }
        })
        .fail(function(response) {

            console.log('(1900) Hubo un Error inesperado. Por favor llame a sistemas.');

            desactivarBtn();
        });
    });

    history.forward();
    $("#box-model").val("4");
</script>