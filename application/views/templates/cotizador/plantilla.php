<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="<?= URL; ?>public/css/cotizador.css">
<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/style.css">
<!--<link rel="stylesheet" href="<?= URL; ?>public/css/bootstrap-theme.min.css">-->

<!-- Chosen -->
<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/chosen/chosen.css">
<script src="<?=URL?>public/js/chosen/chosen.jquery.js"></script>
<script src="<?=URL?>public/js/chosen/chosen.proto.js"></script>
<!-- Chosen -->

<!-- iconos -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<!-- iconos -->

<style type="text/css">

    /*se importan los iconos*/
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");
    
    #modLoading{
        color: #fff;
        font-size: 30px;
        display: flex;
        align-items: center;
        justify-content: center; 
        position: fixed; 
        z-index: 10; 
        padding-top: 100px; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto;
        background-color: rgba(0,0,0,0.7); 
    }
    @keyframes rotate {
        from {transform: rotate(1deg);}
        to {transform: rotate(360deg);}
    }

    @-webkit-keyframes rotate {
        from {-webkit-transform: rotate(1deg);}
        to {-webkit-transform: rotate(360deg);}
    }
    .imgr{
        -webkit-animation: 1s rotate linear infinite;
        animation: 1s rotate linear infinite;
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
        width: 80px;
        height: 80px;
    }
    @media only screen and (max-width: 660px) {
        #divFooter {
            
             min-width: 100px;
             width: 79%;
        }
    }

    @media only screen and (max-width: 600px) {
        #divCliente {
            
             width: 600px;
        }
    }
    .seleccionModelo{

        background: #1A2C4C;
        color:#fff;
        font-size: 16px;
        width: 20%;
        border: none;
        height: 100%;
        cursor: pointer;
    }
    .divCliente{

        background: cornflowerblue;
        border: none;
        color: white;
        width: 80%;
        height: 100%;
        float: right;
        overflow: auto;
        overflow-y: hidden;
    }
    .div-principal{

        width: 100%;
        height: 95%;
        position: absolute;
        overflow-y: hidden;
    }
    #dataForm{

        width: 100%;
        height: 100%;
        position: absolute;
        overflow: hidden;
    }
    .div-izquierdo{

        width: 20%;
        height: 92%;
        display: block;
        position: absolute;
        padding: 0px;
        transition: transform .5s
    }
    .div-total{

        cursor: pointer;
        width: 250px;
        font-size: 25px;
        transition: border .5s;
        float: right;
    }
    .c-pointer{

        cursor: pointer;
    }
    .div-derecho {

        z-index: 0
    }

    body{

        height: 100%;
        overflow-y: hidden;
    }
</style>
<div class="div-principal user-select-none">

    <form id="dataForm" method="post" action="">

        <div id="modLoading" style="display: none;">
            <img id="rotate1" class="imgr" src="<?= URL?>public/img/cargando.png">
            Cargando...
        </div>

        <div id="topCotizador" style="width: 100%; height: 4%;">
            <select  id="box-model" class="seleccionModelo">

                <option selected disabled>Seleccione Modelo de Caja</option>
                    <?php
                    foreach ($modeloscaj as $modelca) {   ?>
                    <option style="font-size: 1em" value="<?=$modelca['id_modelo']?>"><?=$modelca['nombre']?></option>
                    <?php
                      } ?>
            </select>
            <div class="divCliente text-center">
                <div id="divCliente">
                    
                    <!-- <label class="btn btn-sm btn-warning float-left";"><i class="bi bi-list"></i><input style="display: none;" type="checkbox" id="btnHamburguer"></label> -->
                    <label class="mt-1"><?= $nombrecliente; ?></label>
                </div>
            </div>
        </div>
        
        <div id="divIzquierdo" class="div-izquierdo"></div>

        <div id="divDerecho" class="grid div-derecho" style=" width: 80%; height: 79%; position: relative;">

            <img id="imgPrincipal" border="0" src="<?=URL ;?>public/img/henpp.png" style="">
        </div>
    </form>

    <div id="divFooter" class="mx-1" style="position:fixed; right:0%; top:85%;">
        <div id="groupButton1">

            <button id="btnCalcularC" class="btn btn-primary btn-sm" style="font-size: 10px;"><i class="bi bi-calculator-fill" style="color: #000"></i> CALCULAR</button>

            <button id="btnActG" class="btn btn-success btn-sm" style="font-size: 10px;" data-toggle="modal" data-target="#modalSaveAll" disabled=""><i class="bi bi-save"></i> GUARDAR</button>

            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#procesosModal" style="font-size: 10px;"><i class="bi bi-table"></i> TABLAS</button>

            <button class="btn btn-warning btn-sm" id="btnResumen" style="font-size: 10px;"><i class="bi bi-file-earmark"></i>RESUMEN</button>

            <!--<button id="btnCalculadora" disabled="" class="btn btn-warning btn-sm" style="font-size: 10px;"><i class="bi bi-calculator"></i> CALCULADORA</button>-->

            <button type="button" id="btnImprimir" disabled="" class="btn btn-info btn-sm" style="font-size: 10px;"><i class="bi bi-printer"></i> IMPRIMIR</button>

            <button type="button" id="btnSalir" data-toggle="modal" data-target="#modalSalida" class="btn btn-danger btn-sm" style="font-size: 10px;"><i class="bi bi-door-open"></i> SALIR</button>

            <br>

            <div class="div-total mt-2 rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                <label id="Totalplus" class="c-pointer mb-0 float-right">$0.00</label>
                <label  class="mx-2 mb-0 c-pointer float-right">Total: </label>
                <small class="form-text text-muted float-right mt-0" style="font-size: 12px;">Click para más información.</small>
            </div>

            <div class="dropdown-menu" style="width: 100%; min-width: 200px; max-width: 350px;">

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
                            <button type="button" id="descuentoModal" data-toggle="modal" data-target="#descuentos" style="border: none; background: white;">Descuento: (0%) </button>
                        </td>
                        <td id="DescuentoDrop">$0.00</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Salida -->
<div class="modal fade" id="modalSalida" tabindex="-1" aria-labelledby="lblSalidaModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="lblSalidaModal"><i class="bi bi-exclamation-triangle"></i> Advertencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Los cambios no guardados se perderan. <br>¿Desea continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a type="button" href="<?=URL?>cotizador/getCotizaciones" class="btn btn-warning">Salir</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Banco -->
<div class="modal fade" id="modalDelBanco" tabindex="-1" aria-labelledby="lblSalidaModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="lblSalidaModal"><i class="bi bi-exclamation-triangle"></i> Advertencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Esta a punto de eliminar el banco: <br>¿Desea continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="caja.delSecBanco()" class="btn btn-warning">Continuar</button>
            </div>
        </div>
    </div>
</div>

<script>
    

    const heightDisplay = parseFloat($(".div-principal").css("height"));
    $(document).ready( () =>{

        $("#resumentodocaja").css("transform","translateY(" + heightDisplay + "px)");
        $("#resumentodocaja").css("display","none");
    });

    /*$("#btnHamburguer").click(function() {
        $(".div-derecho").css("transition","width .5s");
        let large = parseInt($(".div-izquierdo").css("width"));
        let check = $("#btnHamburguer").prop("checked");
        
        if( check == true ){

            $(".div-izquierdo").css("transform",`translateX(-${large}px)`);
            $(".div-derecho").css("width","100%");
        }else{
            
            $(".div-izquierdo").css("transform","translateX(0px)");
            $(".div-derecho").css("width","80%");
        }   
    });*/

    $("body").append(
        `<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 1px; z-index: 10">
            
            <div id="toastPrincipal" class="toast fade hide" style="position: absolute; top: ${(heightDisplay-200)}px; right: 0;">
                
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check2 mx-1"></i> 
                    <strong class="mr-auto"> Exito!</strong>
                    <small>1 minuto atras</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                
                <div class="toast-body" id="lblToast">
                    
                    Los datos han sido guardados
                </div>
            </div>
        </div>`)
    $('.toast').toast({delay:5000})

    document.getElementById('box-model').onchange = function(event){

        var model = parseInt(document.getElementById('box-model').value);
        var link  = "" + window.location;
        var datos = link.split("/");
        if( datos[6] == undefined ){

            datos[6] = datos[5];
        }
        switch(model){

            case 1:
                
                location.href = "<?=URL?>cotizador/caja_almeja/" + datos[6];

            break;
            case 2:

                location.href = "<?=URL?>circular/caja_circular/" + datos[6];

            break;
            case 3:

                location.href = "<?=URL?>cotizador/caja_libro/" + datos[6];

            break;
            case 4:

                location.href = "<?=URL?>regalo/" + datos[6];

            break;
            case 5:

                location.href = "<?=URL?>cotizador/caja_marco/" + datos[6];

            break;
            case 6:

                location.href = "<?=URL?>cotizador/caja_cerillera/" + datos[6];

            break;
            case 7:

                location.href = "<?=URL?>cotizador/caja_vino/" + datos[6];

            break;
            default:

                alert("El modelo de caja no existe");
            break;
        }
    };

</script>
