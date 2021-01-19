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
        color: #fff;
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
    <div id="divContentI" class="form-content medidas" style="height: 50%; width: 100%; overflow: auto;">
        <div style="min-width: 100px; width: 92%;">

            <input type="hidden" name="modelo" id="modelo" value="<?=$id_modelo?>">
            <input type="hidden" name="nombre_cliente" id="nombre_cliente" value="<?= $nombrecliente ?>">
            <!--ODT-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="odt" class="col-sm-4 col-form-label col-form-label-sm text-secondary">ODT: </label>
                <div class="col-sm-8">
                    
                    <input type="text" class="form-control form-control-sm" name="odt" id="odt" placeholder="ODT" tabindex="1" value="<?= $aJson['num_odt']?>">
                </div>
            </div>
            <!--Base-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="base" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Base: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="base" id="base" placeholder="cm" tabindex="2" value="<?= $aJson['base']?>" min="1">
                </div>
            </div>
            <!--Alto-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="alto" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Alto: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="alto" id="alto" placeholder="cm" tabindex="3" value="<?= $aJson['alto']?>" min="1">
                </div>
            </div>
            <!--Prof Cajon-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="profundidad_cajon" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Prof Cajón: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="profundidad_cajon" id="profundidad_cajon" placeholder="cm" tabindex="4" value="<?= $aJson['profundidad_cajon']?>" min="1">
                </div>
            </div>
            <!--Prof Tapa-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="profundidad_tapa" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Prof Tapa: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="profundidad_tapa" id="profundidad_tapa" placeholder="cm" tabindex="5" value="<?= $aJson['profundidad_tapa']?>" min="1">
                </div>
            </div>
            <!--G Cajon-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Grosor Cajón: </label>
                <div class="col-sm-8">
                    
                    <select class="custom-select custom-select-sm" name="grosor_carton" id="grosor_carton" tabindex="6" required>
                        
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
            <!--G Carton-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Grosor Tapa: </label>
                <div class="col-sm-8">
                    
                    <select class="custom-select custom-select-sm"name="grosor_tapa" id="grosor_tapa" tabindex="7" required>
                        
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
            <!--Cantidad-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="qty" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Cantidad: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="qty" id="qty" placeholder="Cantidad" tabindex="8" value="<?= $aJson['tiraje']?>" min="1">
                </div>
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

        <div id="ListaBancoEmp" class="">
            <table class="table" id="banTable">
                <tbody id="listbancoemp">
                    <!-- contenido seleccionado -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require "application/views/templates/cotizador/acabados.php"?>
<?php require "application/views/templates/cotizador/extras.php"?>
<?php require "application/views/templates/cotizador/impresiones.php"?>

<!--

    Se debe de hacer los require primero y despues el script que
    se hace referencia al modelo de caja.
-->
<script src="<?=URL?>public/js/cotizador/cajas.js"></script>
<script src="<?=URL?>public/js/cotizador/regalo.js"></script>

<script type="text/javascript">

    var option = "";
    var papeles = <?php echo json_encode($papers);?>;

    papeles.forEach( function(papel){

        option += '<option value="' + papel.id_papel + '" data-nombre="' + papel.nombre + '">' + papel.nombre + '</option>';
    });

    var baseImg = "<?=BASE_URL?>public/images/regalo/";

    var seccion = [
        { titulo: 'Empalme Cajón', img: baseImg+'regalo.png', option: 'optEC', siglas: 'EC', chk: true, aAcb: [], aImp: [], 'siglasP': 'Emp' },
        { titulo: 'Forro Cajón', img: baseImg+'regalo.png', option: 'optFC', siglas: 'FC', chk: false, aAcb: [], aImp: [], 'siglasP': 'FCaj' },
        { titulo: 'Empalme Tapa', img: baseImg+'regalo.png', option: 'optET', siglas: 'ET', chk: false, aAcb: [], aImp: [], 'siglasP': 'EmpTap' },
        { titulo: 'Forro Tapa', img: baseImg+'regalo.png', option: 'optFT', siglas: 'FT', chk: false, aAcb: [], aImp: [], 'siglasP': 'FTap' }
    ]

    let caja = new Regalo( {secciones: seccion, papeles: option} );

    var contenidoIzquierdo = $("#divIzquierdo-slave").contents();
    $("#divIzquierdo").empty();
    $("#divIzquierdo").append(contenidoIzquierdo);
    $("#divDerecho").empty();

    caja.url="<?= URL ?>";

    //eligira a donde se enviara la informacion
    caja.changeData("regalo/saveCaja");

    $("#box-model").hide()
    history.forward();

    var AGlobal = <?php echo json_encode($aJson)?>;
    caja.printCotizacion(AGlobal);
    console.log(AGlobal);

    //Boton Guardar
    $("#btnGrabarC").click( function() {

        // sus argumentos son: grabar, modificar
        caja.saveCotizacion("NO",'SI');
    });
</script>