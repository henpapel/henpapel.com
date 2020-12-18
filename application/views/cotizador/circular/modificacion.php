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
    .divContenido{

        display: block; text-align: center; width: 100%;
    }
</style>

<script type="text/javascript">

    var a = [<?php echo json_encode($aJson) ?>];

    console.log(a);
</script>

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

                <input class="cajas-input medidas-input" name="odt" id="odt" type="text" placeholder="ODT" tabindex="1" min="1" step="1" autofocus="" required="" value="<?= $aJson['num_odt']?>">
            </div>
        </div>

        <!-- id_odt anterior -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>ID: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="id_odt_anterior" id="id_odt_anterior" value="<?= $aJson['id_odt']?>" disabled>
            </div>
        </div>

        <!-- Diámetro -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Diámetro: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="diametro" id="diametro" type="number" placeholder="cm" tabindex="2" min="0.01" step="any" required value="<?= $aJson['diametro']?>">
            </div>
        </div>

        <!-- Profundidad -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Profundidad: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="profundidad" id="profundidad" type="number" step="any" min="0.01" tabindex="3" placeholder="cm" required value="<?= $aJson['profundidad']?>">
            </div>
        </div>

        <!-- Altura tapa -->
        <div class="input-group">

            <div class="cajas-col-input t-left">

                <span>Altura tapa: </span>
            </div>

            <div class="cajas-col-input t-right">

                <input class="cajas-input medidas-input" name="altura_tapa" id="altura_tapa" type="number" step="any" min="0.1" tabindex="4" placeholder="cm" required value="<?= $aJson['altura']?>">
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

                <input class="cajas-input" name="qty" id="qty" type="number" min="1" step="1" placeholder="Cantidad" tabindex="6" required="" value="<?= $aJson['tiraje']?>">
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

<?php
    if( $aJson ){?>
        <script type="text/javascript">

            var idCarton = "<?= $aJson['id_grosor_carton']?>";

            $("#grosor_carton option[data-id=" + idCarton +"]").attr("selected", true);

            var papel_elegido  = false;

            var idBaseCajon = parseInt(<?= $aJson['id_papel_bcaj']?>);
            var idCCajon    = parseInt(<?= $aJson['id_papel_circaj']?>);
            var idFECajon   = parseInt(<?= $aJson['id_papel_fextcaj']?>);
            var idPCajon    = parseInt(<?= $aJson['id_papel_pomcaj']?>);
            var idFICajon   = parseInt(<?= $aJson['id_papel_fintcaj']?>);
            var idBTapa     = parseInt(<?= $aJson['id_papel_bastap']?>);
            var idCTapa     = parseInt(<?= $aJson['id_papel_cirtap']?>);
            var idFTapa     = parseInt(<?= $aJson['id_papel_fortap']?>);
            var idFETapa    = parseInt(<?= $aJson['id_papel_fexttap']?>);
            var idFITapa    = parseInt(<?= $aJson['id_papel_finttap']?>);

            //muestra los papeles elegidos
            papel_elegido = true;

            $("#optBasCajon option[value='" + idBaseCajon +"']").prop("selected",true);
            $("#optCirCajon option[value='" + idCCajon +"']").prop("selected",true);
            $("#optExtCajon option[value='" + idFECajon +"']").prop("selected",true);
            $("#optPomCajon option[value='" + idPCajon +"']").prop("selected",true);
            $("#optIntCajon option[value='" + idFICajon +"']").prop("selected",true);
            $("#optBasTapa option[value='" + idBTapa +"']").prop("selected",true);
            $("#optCirTapa option[value='" + idCTapa +"']").prop("selected",true);
            $("#optForTapa option[value='" + idFTapa +"']").prop("selected",true);
            $("#optExtTapa option[value='" + idFETapa +"']").prop("selected",true);
            $("#optIntTapa option[value='" + idFITapa +"']").prop("selected",true);
        </script>
<?php    }
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
    setURL("<?= URL ?>?cliente="+cliente);

    //apendizaje de papeles;
    var AGlobal = <?php echo json_encode($aJson)?>;

    appndPapeles( AGlobal, "papel_BCaj");
    appndPapeles( AGlobal, "papel_BasTap");
    appndPapeles( AGlobal, "papel_CirCaj");
    appndPapeles( AGlobal, "papel_CirTap");
    appndPapeles( AGlobal, "papel_FexTap");
    appndPapeles( AGlobal, "papel_FextCaj");
    appndPapeles( AGlobal, "papel_FinTap");
    appndPapeles( AGlobal, "papel_FintCaj");
    appndPapeles( AGlobal, "papel_ForTap");
    appndPapeles( AGlobal, "papel_PomCaj");

    var aImpBcaj     = <?php echo json_encode($aJson['aImpbcaj']) ?>;
    var aImpCirCaj   = <?php echo json_encode($aJson['aImpcircaj']) ?>;
    var aImpFextCaj  = <?php echo json_encode($aJson['aImpfextcaj']) ?>;
    var aImpPomCaj   = <?php echo json_encode($aJson['aImppomcaj']) ?>;
    var aImpFintCaj  = <?php echo json_encode($aJson['aImpfintcaj']) ?>;
    var aImpBasTap   = <?php echo json_encode($aJson['aImpbastap']) ?>;
    var aImpCirTap   = <?php echo json_encode($aJson['aImpcirtap']) ?>;
    var aImpFTapa    = <?php echo json_encode($aJson['aImpfortap']) ?>;
    var aImpFextTapa = <?php echo json_encode($aJson['aImpfexttap']) ?>;
    var aImpFintTapa = <?php echo json_encode($aJson['aImpfinttap']) ?>;


    appndImpMod(aImpBcaj,"BCaj", aImpBC);
    appndImpMod( aImpCirCaj, "CirCaj", aImpCC );
    appndImpMod( aImpFextCaj, "FextCaj", aImpFEC );
    appndImpMod( aImpPomCaj, "PomCaj", aImpPC );
    appndImpMod( aImpFintCaj, "FintCaj", aImpFIC );
    appndImpMod( aImpBasTap, "BasTap", aImpBT );
    appndImpMod( aImpCirTap, "CirTap", aImpCT );
    appndImpMod( aImpFTapa, "FTap", aImpFT );
    appndImpMod( aImpFextTapa, "FexTap", aImpFET );
    appndImpMod( aImpFintTapa, "FinTap", aImpFIT );

    var aAcbBcaj     = <?php echo json_encode($aJson['aAcbbcaj']) ?>;
    var aAcbCirCaj   = <?php echo json_encode($aJson['aAcbcircaj']) ?>;
    var aAcbFextCaj  = <?php echo json_encode($aJson['aAcbfextcaj']) ?>;
    var aAcbPomCaj   = <?php echo json_encode($aJson['aAcbpomcaj']) ?>;
    var aAcbFintCaj  = <?php echo json_encode($aJson['aAcbfintcaj']) ?>;
    var aAcbBasTap   = <?php echo json_encode($aJson['aAcbbastap']) ?>;
    var aAcbCirTap   = <?php echo json_encode($aJson['aAcbcirtap']) ?>;
    var aAcbFTapa    = <?php echo json_encode($aJson['aAcbfortap']) ?>;
    var aAcbFextTapa = <?php echo json_encode($aJson['aAcbfexttap']) ?>;
    var aAcbFintTapa = <?php echo json_encode($aJson['aAcbfinttap']) ?>;

    appndAcbMod(aAcbBcaj,"BCaj", aAcbBC);
    appndAcbMod( aAcbCirCaj, "CirCaj", aAcbCC );
    appndAcbMod( aAcbFextCaj, "FextCaj", aAcbFEC );
    appndAcbMod( aAcbPomCaj, "PomCaj", aAcbPC );
    appndAcbMod( aAcbFintCaj, "FintCaj", aAcbFIC );
    appndAcbMod( aAcbBasTap, "BasTap", aAcbBT );
    appndAcbMod( aAcbCirTap, "CirTap", aAcbCT );
    appndAcbMod( aAcbFTapa, "FTap", aAcbFT );
    appndAcbMod( aAcbFextTapa, "FexTap", aAcbFET );
    appndAcbMod( aAcbFintTapa, "FinTap", aAcbFIT );


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

    //Boton Grabar
    $("#btnGrabarC").click( function() {

        showLoading();
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

        var id_odt_anterior = $("#id_odt_anterior").val();

        formData.push({name: 'id_cot_odt_ant', value: id_odt_anterior});

        var modificar_odt = "SI";

        formData.push({name: 'modificar', value: modificar_odt});

        var odt1 = $("#odt-1").val();

        var odtval = [];

        odtval.push({name: 'odt', value: odt1});

        //if( revisarImpAcb() == false ) return false;

        $.ajax({                                        // GRABAR
            type:"POST",
            async: false,
            //dataType: "json",
            url: $('#caja-form').attr('action'),
            data: formData,
        })
        .done(function( response ) {

            hideLoading();
            console.log("(3289) response: ");

            console.log(response);

            try {

                var js_respuesta = JSON.parse( response );
                //var error = js_respuesta.error;

                if (!js_respuesta.hasOwnProperty("error")) {

                    showModError("");
                    $("#txtContenido").html("(3301) " + js_respuesta);

                } else {

                    desactivarBtn();
                    showModCorrecto("Los datos han sido guardados correctamente...");
                }
            } catch(e) {

                desactivarBtn();
                showModError("");
                $("#txtContenido").html("(3310) Error..." + e);
            }
        })
        .fail(function(response) {

            console.log('(3315) Bug! Revisa...');
        });
    });
    $("#box-model").val("2");
</script>
