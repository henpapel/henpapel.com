
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- timepicker -->
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.es-es.js" type="text/javascript"></script>
<!-- timepicker -->

<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/style.css">
<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/cotizador.css">

<!-- Chosen -->
<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/chosen/chosen.css">
<script src="<?=URL?>public/js/chosen/chosen.jquery.js"></script>
<script src="<?=URL?>public/js/chosen/chosen.proto.js"></script>
<!-- Chosen -->

<div class="table-section">

    <div class="table-controls">
        
        <div class="table-title">
            Cotizaciones
        </div>

        <label>
            
            <button class="btn btn-primary btn-sm" id="btnNvaCot" data-toggle="modal" data-target="#modalClientes">+ Nueva Cotizacion</button>
            <input type="text" style="width: 110px;" id="txtSearchODT" onkeyup="buscarODT()" name="txtSearchODT" placeholder="Buscar ODT">
        </label>
        <label>

            <div class="gj-margin-top-10">

                <input id="datepicker" style="width: 150px;" onchange="buscarFecha()" placeholder="YYYY/MM/DD" />
            </div>
        </label>

        <script type="text/javascript">
            var config;
            config = {
                locale: 'es-es',
                format: "yyyy/mm/dd",
                uiLibrary: 'bootstrap4'
            };
            $(document).ready(function () {

                $('#datepicker').datepicker(config);
            });
        </script>

        <div class="table-container">

            <table class="hep-table" id="tbeCotizaciones">
                <thead>
                    <tr>
                        <th><strong>ODT</strong></th>
                        <th><strong>Modelo</strong></th>
                        <th><strong>Cliente</strong></th>
                        <th><strong>Cantidad</strong></th>
                        <th><strong>Fecha de cotizacion</strong></th>
                        
                        <th style="width: 110px;" colspan="3"><strong>Acciones</strong></th>
                    </tr>
                </thead>
                <tbody id="inv-body">

                    <?php $i = 0;?>
                    <?php foreach ($cotizaciones as $row) {

                        ?>
                        <tr>
                            <td ><?= $row['num_odt'];?></td>
                            <td ><?= $row['nombre_caja'];?></td>
                            <td ><?= $row['nombre_cliente'] ?></td>
                            <td ><?= $row['tiraje'];?></td>
                            <td ><?= $row['fecha_odt'];?></td>
                            <td>

                                <a href="<?=URL; ?>cotizador/imprimir?ct=<?= $row['id_cotizacion'];?>&c=<?= $_GET['c'];?>" data-id="<?= $row['id_cliente'];?>" class="table-button blue3 nueva">Imprimir</a>
                            </td>
                            <td>

                                <!-- <?=URL; ?>cotizador/modCajaAlmeja?num_odt=<?= $row['num_odt'];?> -->
                                <a id="<?= $row['id_odt']; ?>" href="#" data-id="<?= $row['num_odt'];?>" data-caja="<?=$row['nombre_caja']?>" onclick="vistaAct('<?= $row['id_odt']; ?>');" class="table-button orange2">Modificar</a>
                            </td>
                            <td>
                                <a href="#" onclick="getId('<?= $row['id_odt'] ?>')" data-toggle="modal" data-target="#modalEliminar" class="table-button red2" >Eliminar</a>
                            </td>
                        </tr>
                    <?php
                    }

                    if (count($cotizaciones) == 0) {

                        ?>
                        <tr>

                            <td colspan="5">No hay cotizaciones guardadas
                            </td>
                        </tr>
                    <?php  }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal Eliminar-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminar" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #E53333; color: white;">

                <h5 class="modal-title">Confirmación</h5>
                <!--
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
                -->
            </div>
    
            <div class="modal-body">

                <p style="color: black; font-size: 1.1em">¿Esta seguro de eliminar la cotizacion?</p>
            </div>
    
            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnEliminar">Si</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    var nombreCliente = [];
    var idCliente = [];
</script>
<?php

    for ($i=0; $i < count($clientes) ; $i++) {

        $nombre = $clientes[$i]['nombre'];
        $id = $clientes[$i]['id_cliente'];
?>

        <script type="text/javascript">
            
            nombreCliente[<?=$i?>] = "<?= $nombre ?>";
            idCliente[<?=$i?>] = "<?= $id ?>";
        </script>
<?php

    }
?>
<!-- modal muestra clientes para cotizacion-->
<div class="modal fade" id="modalClientes" tabindex="-1" role="dialog" aria-labelledby="modalClientes" aria-hidden="true">
        
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" style="height: 300px !important">

            <div class="modal-header azulWhi">

                <h5 class="modal-title" id="txtTitModCorrecto">SELECCIONA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button>
            </div>
    
            <div class="modal-body">

                <select class="chosen-select" name="optCliente" id="optCliente" required>
                    <option selected disabled>Elija un cliente para continuar</option>
                    <?php
                        foreach ($clientes as $cliente) { ?>
                            
                            <option value="<?=$cliente['id_cliente']?>"><?=$cliente['nombre']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                
                <button style="display: none; transition: background-color .6s;" class="btn btn-outline-success" id="btnCliente">+ Cliente</button>
                <button id="btnContinuar" class="btn btn-outline-primary " onclick="enviar()" style="transition: background-color .6s; display: none;">Continuar</button>
            </div>
        </div>
    </div>
</div>

<!-- modal error-->
<div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="modalError" aria-hidden="true">
    
<div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

        <div class="modal-header azulWhi" style="background-color: #E53333; color: white;">

            <h5 class="modal-title" id="txtTituloModal">Error</h5>
        </div>

        <div class="modal-body">

            <p id="txtContenido" style="color: black; font-size: 1.1em"></p>
        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>


<script type="text/javascript">

    $("#optCliente").chosen({width: "95%",no_results_text: "Ups! No hay resultados para."});

    var id;
    function getId(id){

        this.id = parseInt(id);

        console.log(id);
    }

    $("#btnEliminar").click( function() {

        var url = location.href;
        $.ajax({

            type: "POST",
            url: "<?= URL ?>cotizador/deleteCotizacion/",
            data: {id: id},
            
            success: function(response) {
                
                if( response == "true" ){

                    location.href="<?=URL?>cotizador/getCotizaciones/";
                }else{
                    console.log(response);
                    showModError("No se pudo eliminar la cotización");
                }
            }

        });
    });

    function showModError(texto) {

        $("#txtContenido").html(texto);
        $('#modalError').modal({backdrop: 'static', keyboard: false});
    }

    function vistaAct(id){

        var num_odt = $("#"+id).data("id");
        var caja = $("#"+id).data("caja");
        switch( caja ){

            case"Almeja":

                location.href = "<?php echo URL; ?>cotizador/modCajaAlmeja/?num_odt=" + num_odt + "&caja=" +caja;
            break;
            case"Circular":

                location.href = "<?php echo URL; ?>circular/modCajaCircular/?num_odt=" + num_odt + "&caja=" +caja;
            break;
            case"Libro":
            break;
            case"Regalo":

                location.href = "<?php echo URL; ?>regalo/modCajaRegalo/?num_odt=" + num_odt + "&caja=" +caja;
            break;
            case"Marco":
            break;
            case"Cerillera":
            break;
            case"Vino":
            break;
        }
        
    }

    function buscarODT(){

        var text   = $("#txtSearchODT").val();
        var filtro = text.toUpperCase();
        var tabla  = document.getElementById("tbeCotizaciones");

        tr = tabla.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {

            td = tr[i].getElementsByTagName("td")[0];

            if (td) {

                txtValue = td.textContent || td.innerText;

                if (txtValue.toUpperCase().indexOf(filtro) > -1) {

                    tr[i].style.display = "";
                } else {

                    tr[i].style.display = "none";
                }
            }       
        }
    }

    function buscarFecha(){

        var text    = $("#datepicker").val();
        var limpiar = text.split("/");
        var text    = limpiar[0] + "-" + limpiar[1] + "-" + limpiar[2];
        var tabla   = document.getElementById("tbeCotizaciones");

        tr = tabla.getElementsByTagName("tr");

        if( limpiar[0] == undefined || limpiar[1] == undefined || limpiar[2] == undefined){

            for (i = 0; i < tr.length; i++) {

                    tr[i].style.display = "";
            }
        } else {

            for (i = 0; i < tr.length; i++) {

                td = tr[i].getElementsByTagName("td")[4];

                if (td) {

                    txtValue = td.textContent || td.innerText;

                    if (txtValue.indexOf(text) > -1) {

                        tr[i].style.display = "";
                    } else {

                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    }

    $("#btnCliente").click( function(){

        location.href = "<?= URL ?>cotizador/nuevo_cliente";
    });

    function enviar(){

        let id = parseInt($("#optCliente").val())

        location.href = '<?php echo URL; ?>cotizador/cajas/?cliente=' + id;
    }


    $("#optCliente").chosen().change( function(){

        $("#btnContinuar").show();
    });

    $(document).on('keyup', '.chosen-search input', function (e) {
        
        let noResult = $('.chosen-results li').hasClass('no-results')
        if ( noResult == true ){

            $("#btnCliente").show("normal");
        }else{

            $("#btnCliente").hide("normal");
        }
    });
</script>
