<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- timepicker -->
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.es-es.js" type="text/javascript"></script>
<!-- timepicker -->

<link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/style.css">
<link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/cotizador.css">

<!-- Chosen -->
<link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/chosen/chosen.css">
<script src="<?= URL ?>public/js/chosen/chosen.jquery.js"></script>
<script src="<?= URL ?>public/js/chosen/chosen.proto.js"></script>
<!-- Chosen -->

<!-- iconos -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<!-- iconos -->

<style>
    /*se importan los iconos*/
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");
</style>

<div class="table-section">

    <div class="table-controls">

        <div class="table-title">
            Pedidos
        </div>

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
            $(document).ready(function() {

                $('#datepicker').datepicker(config);
            });
        </script>

        <div class="table-container">

            <table class="hep-table" id="tbeCotizaciones">
                <thead>
                    <tr>
                        <th><strong>N° Pedido.</strong></th>
                        <th><strong>Modelo</strong></th>
                        <th><strong>Cliente</strong></th>
                        <th><strong>Cantidad</strong></th>
                        <th><strong>Fecha de cotizacion</strong></th>

                        <th style="width: 110px;" colspan="2"><strong>Acciones</strong></th>
                    </tr>
                </thead>
                <tbody id="inv-body">

                    <?php $i = 0; ?>
                    <?php foreach ($cotizaciones as $row) {

                    ?>
                        <tr>
                            <td><?= $row['num_odt']; ?></td>
                            <td><?= $row['tipo_costo']; ?></td>
                            <td><?= $row['nombre_caja']; ?></td>
                            <td><?= $row['nombre_cliente'] ?></td>
                            <td><?= $row['tiraje']; ?></td>
                            <td><?= $row['fecha_odt']; ?></td>
                            <td>

                                <a href="#" onclick="printCalc('<?=$row['id_odt']?>','<?=$row['nombre_caja']?>')" class="table-button green2">Calculadora</a>
                            </td>
                            <td>

                                <button class="table-button blue3 nueva" onclick="impr('<?=$row['id_odt']?>','<?=$row['nombre_caja']?>')">Imprimir</button>
                            </td>
                        </tr>
                    <?php
                    }

                    if (count($cotizaciones) == 0) {

                    ?>
                        <tr>

                            <td colspan="5">No hay pedidos guardados
                            </td>
                        </tr>
                    <?php  }
                    ?>
                </tbody>
            </table>
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
</div>


<script type="text/javascript">

    var id;

    function getId(id) {

        this.id = parseInt(id);

        console.log(id);
    }

    $("#btnEliminar").click(function() {

        var url = location.href;
        $.ajax({

            type: "POST",
            url: "<?= URL ?>cotizador/deleteCotizacion/",
            data: {
                id: id
            },

            success: function(response) {

                if (response == "true") {

                    location.href = "<?= URL ?>cotizador/getCotizaciones/";
                } else {
                    console.log(response);
                    showModError("No se pudo eliminar la cotización");
                }
            }

        });
    });

    function showModError(texto) {

        $("#txtContenido").html(texto);
        $('#modalError').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function vistaAct(id) {

        var num_odt = $("#" + id).data("id");
        var caja = $("#" + id).data("caja");
        switch (caja) {

            case "Almeja":

                location.href = "<?= URL ?>cotizador/modCajaAlmeja/?num_odt=" + num_odt + "&caja=" + caja;
                break;
            case "Circular":

                location.href = "<?= URL ?>circular/modCajaCircular/?num_odt=" + num_odt + "&caja=" + caja;
                break;
            case "Libro":


                break;
            case "Regalo":

                location.href = "<?= URL ?>regalo/modCajaRegalo/?num_odt=" + num_odt + "&caja=" + caja;
                break;
            case "Marco":
                break;
            case "Cerillera":
                break;
            case "Vino":
                break;
        }

    }

    function buscarODT() {

        var text = $("#txtSearchODT").val();
        var filtro = text.toUpperCase();
        var tabla = document.getElementById("tbeCotizaciones");

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

    function buscarFecha() {

        var text = $("#datepicker").val();
        var limpiar = text.split("/");
        var text = limpiar[0] + "-" + limpiar[1] + "-" + limpiar[2];
        var tabla = document.getElementById("tbeCotizaciones");

        tr = tabla.getElementsByTagName("tr");

        if (limpiar[0] == undefined || limpiar[1] == undefined || limpiar[2] == undefined) {

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


    $(document).on('keyup', '.chosen-search input', function(e) {

        let noResult = $('.chosen-results li').hasClass('no-results')
        if (noResult == true) {

            $("#btnCliente").show("normal");
        } else {

            $("#btnCliente").hide("normal");
        }
    });

    function printCalc(odt,model){

        /*<?= URL; ?>cotizador/printCalc/?id=<?= $row['id_odt']; ?>*/

        switch(model){

            case 'Almeja':
                window.open("<?= URL; ?>cotizador/printCalc/?id="+odt);
            break;
            case 'Regalo':
                window.open("<?= URL; ?>regalo/printCalc/?id="+odt);
            break;
        }
    }

    function impr(id,model){

        switch(model){

            case 'Almeja':
                window.open("<?= URL; ?>cotizador/impCajaAlmeja/?num_odt="+id, "Impresion", "width=600, height=600");
            break;
            case 'Regalo':
                window.open("<?= URL; ?>regalo/impCajaRegalo/?num_odt="+id, "Impresion", "width=600, height=600");
            break;
        }
    }
</script>