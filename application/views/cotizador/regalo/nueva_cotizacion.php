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

<div id="divIzquierdo-slave" class="div-izquierdo" style="display: none; height: 98%; margin: 0px;">

    <div class="divImgC">
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
                
                <label for="odt" class="col-sm-4 col-form-label col-form-label-sm text-secondary">ID: </label>
                <div class="col-sm-8">
                    
                    <input type="text" class="form-control form-control-sm" name="id_odt_anterior" id="id_odt_anterior" placeholder="ID" tabindex="1" value="" disabled>
                </div>
            </div>

            <!--Base-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="base" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Base: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="base" id="base" placeholder="cm" tabindex="2" min="1" onkeyup="caja.desactivarBtn()">
                </div>
            </div>
            <!--Alto-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="alto" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Alto: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="alto" id="alto" placeholder="cm" tabindex="3" min="1" onkeyup="caja.desactivarBtn()">
                </div>
            </div>
            <!--Prof Cajon-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="profundidad_cajon" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Prof Cajón: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="profundidad_cajon" id="profundidad_cajon" placeholder="cm" tabindex="4" min="1" onkeyup="caja.desactivarBtn()">
                </div>
            </div>
            <!--Prof Tapa-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="profundidad_tapa" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Prof Tapa: </label>
                <div class="col-sm-8">
                    
                    <input type="number" class="form-control form-control-sm" name="profundidad_tapa" id="profundidad_tapa" placeholder="cm" tabindex="5" min="1" onkeyup="caja.desactivarBtn()">
                </div>
            </div>
            <!--G Cajon-->
            <div class="form-group row mt-2 ml-0">
                
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-secondary">Grosor Cajón: </label>
                <div class="col-sm-8">
                    
                    <select class="custom-select custom-select-sm" name="grosor_carton" id="grosor_carton" tabindex="6" required onchange="caja.desactivarBtn();">
                        
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
                    
                    <select class="custom-select custom-select-sm"name="grosor_tapa" id="grosor_tapa" tabindex="7" required onchange="caja.desactivarBtn();">
                        
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
                    
                    <input type="number" class="form-control form-control-sm" name="qty" id="qty" placeholder="Cantidad" tabindex="8" min="1" onkeyup="caja.desactivarBtn();">
                </div>
            </div>
        </div>
    </div>

    <div class="div-buttons mt-1 p-1 mb-5" style="height: 20%;">
        
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

<?php
    require "application/views/templates/cotizador/acabados.php";
    require "application/views/templates/cotizador/extras.php";
    require "application/views/templates/cotizador/impresiones.php";
?>
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
        { titulo: 'Empalme Cajón', img: baseImg+'regalo.png', option: 'optEC', siglas: 'EC', aAcb: [], aImp: [], 'siglasP': 'Emp' },
        { titulo: 'Forro Cajón', img: baseImg+'regalo.png', option: 'optFC', siglas: 'FC', aAcb: [], aImp: [], 'siglasP': 'FCaj' },
        { titulo: 'Empalme Tapa', img: baseImg+'regalo.png', option: 'optET', siglas: 'ET', aAcb: [], aImp: [], 'siglasP': 'EmpTap' },
        { titulo: 'Forro Tapa', img: baseImg+'regalo.png', option: 'optFT', siglas: 'FT', aAcb: [], aImp: [], 'siglasP': 'FTap' },
        /*{ titulo: 'Prueba', img: baseImg+'regalo.png', option: 'optP', siglas: 'P', aAcb: [], aImp: [], 'siglasP': 'pt' },*/
    ];

    let caja = new Regalo( {secciones: seccion, papeles: option, url: "<?=URL?>"} );

    var contenidoIzquierdo = $("#divIzquierdo-slave").contents();
    $("#divIzquierdo").empty();
    $("#divIzquierdo").append(contenidoIzquierdo);
    $("#divDerecho").empty();

    //eligira a donde se enviara la información
    caja.changeData("regalo/saveCaja");

    //construye las secciones respecto a las divisiones que se ha declarado en la variable seccion
    caja.constructSec();

    //se asigna en que modelo esta para el select
    $("#box-model").val("4");

    //olvida el historial
    history.forward();

    //Boton Guardar
    $("#btnGrabarC").click( function() {

        // sus argumentos son: grabar, modificar. busque la funcion para entender como funciona
        caja.saveCotizacion("SI",'NO');
    });

</script>