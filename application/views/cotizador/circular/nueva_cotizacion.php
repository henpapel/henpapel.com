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

<?php
    require "application/views/templates/cotizador/acabados.php";
    require "application/views/templates/cotizador/extras.php";
    require "application/views/templates/cotizador/impresiones.php";
?>
<script src="<?=URL?>public/js/cotizador/cajas.js"></script>
<script src="<?=URL?>public/js/cotizador/circular.js"></script>

<script type="text/javascript">

    var option = "";
    <?php foreach ($papers as $paper) {?>
        
        option += '<option value="<?=$paper['id_papel']?>" data-nombre="<?=$paper['nombre'] ?>"><?=$paper['nombre'] ?></option>';
    <?php }?>

    var baseImg = "<?=BASE_URL?>public/img/";
    
    var seccion = [
        { titulo: 'Base Cajón', img: baseImg+'2.png', option: 'optBasCajon', siglas: 'BC', chk: true, aAcb: [], aImp: [], 'siglasP': 'Emp' },
        { titulo: 'Circunferencia Cajón', img: baseImg+'2.png', option: 'optCirCajon', siglas: 'CC', chk: false, aAcb: [], aImp: [], 'siglasP': 'FCaj' },
        { titulo: 'Forro Exterior Cajón', img: baseImg+'2.png', option: 'optExtCajon', siglas: 'EC', chk: false, aAcb: [], aImp: [], 'siglasP': 'EmpTap' },
        { titulo: 'Pompa Cajón', img: baseImg+'2.png', option: 'optPomCajon', siglas: 'PC', chk: false, aAcb: [], aImp: [], 'siglasP': 'FTap' },

        { titulo: 'Forro Interior Cajón', img: baseImg+'2.png', option: 'optIntCajon', siglas: 'IC', chk: true, aAcb: [], aImp: [], 'siglasP': 'Emp' },
        { titulo: 'Base Tapa', img: baseImg+'2.png', option: 'optBasTapa', siglas: 'BT', chk: false, aAcb: [], aImp: [], 'siglasP': 'FCaj' },
        { titulo: 'Circunferencia Tapa', img: baseImg+'2.png', option: 'optCirTapa', siglas: 'CT', chk: false, aAcb: [], aImp: [], 'siglasP': 'EmpTap' },
        { titulo: 'Forro Tapa', img: baseImg+'2.png', option: 'optForTapa', siglas: 'FT', chk: false, aAcb: [], aImp: [], 'siglasP': 'FTap' },

        { titulo: 'Forro Exterior Tapa', img: baseImg+'2.png', option: 'optExtTapa', siglas: 'ET', chk: false, aAcb: [], aImp: [], 'siglasP': 'EmpTap' },
        { titulo: 'Forro Interior Tapa', img: baseImg+'2.png', option: 'optIntTapa', siglas: 'IT', chk: false, aAcb: [], aImp: [], 'siglasP': 'FTap' },
    ]

    let caja = new Circular( {secciones: seccion, papeles: option} );

    var contenidoIzquierdo = $("#divIzquierdo-slave").contents();
    $("#divIzquierdo").empty();
    $("#divIzquierdo").append(contenidoIzquierdo);
    $("#divDerecho").empty();

    caja.url="<?= URL ?>";
    //eligira a donde se enviara la informacion

    caja.changeData("circular/saveCaja");
    caja.constructSec();
    $("#box-model").val("2");
    history.forward();

    //Boton Guardar
    $("#btnGrabarC").click( function() {

        //El 'NO' especificado en la funcion sirve para decir si se modificara la odt. Esto sirve cuando se hace la modificacion de la caja. vease en modificacion caja regalo
        caja.saveCotizacion("NO");
    });
</script>
