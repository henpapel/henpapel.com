
<link rel="stylesheet" href="<?= URL; ?>public/css/cotizador.css">
<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/style.css">
<link rel="stylesheet" href="<?= URL; ?>public/css/bootstrap-theme.min.css">

<!-- Chosen -->
<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/chosen/chosen.css">
<script src="<?=URL?>public/js/chosen/chosen.jquery.js"></script>
<script src="<?=URL?>public/js/chosen/chosen.proto.js"></script>
<!-- Chosen -->
<style type="text/css">
    
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
    @media only screen and (max-width: 450px) {
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
        height: 93%;
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
        height: 96%;
        display: block;
        position: absolute;
        padding: 0px;
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
</style>
<div class="div-principal user-select-none">

    <form id="dataForm" method="post" action="">

        <div id="modLoading" style="display: none;">
            <img id="rotate1" class="imgr" src="<?= URL?>public/img/cargando.png">
            Cargando...
        </div>

        <div id="topCotizador" style="width: 100%; height: 5%;">
            <select  id="box-model" class="seleccionModelo">

                <option selected disabled>Seleccione Modelo de Caja</option>
                    <?php
                    foreach ($modeloscaj as $modelca) {   ?>
                    <option style="font-size: 1em" value="<?=$modelca['id_modelo']?>"><?=$modelca['nombre']?></option>
                    <?php
                      } ?>
            </select>
            <div class="divCliente text-center">
                <div id="divCliente" class="mt-1">
                    Cliente: <?= $nombrecliente; ?>    
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

            <button id="btnCalcularC" class="btn btn-primary btn-sm" style="font-size: 10px;">CALCULAR</button>

            <button id="btnActG" class="btn btn-success btn-sm" style="font-size: 10px;" data-toggle="modal" data-target="#modalSaveAll" disabled="">GUARDAR</button>

            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#procesosModal" style="font-size: 10px;">TABLAS</button>

            <button class="btn btn-warning btn-sm" id="btnResumen" style="font-size: 10px;">RESUMEN</button>

            <button type="button" id="btnImprimir" disabled="" class="btn btn-info btn-sm" style="font-size: 10px;">IMPRIMIR</button>
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

<script>

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
