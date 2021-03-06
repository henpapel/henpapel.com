<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/cotizador.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="<?=URL?>public/css/style.css">
<style>

    .lista{

        cursor: pointer;
        -moz-user-select: none; 
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: black;
        margin-left: 5px;
    }

    .lista:hover{

        background-color: #315BB2;
        color: white;
    }

    #btnSelect{

        width: 100%;
        height: 100%;
        cursor: pointer;
        text-align: left;
        border: 1px rgb(0,0,0,0.5) solid;
        border-radius: 4px;
        background-color: white;
    }

    #divSelect2{

        height: 200px;
        background-color: white;
        text-align: left;
        overflow: auto;
    }

    #txtSearch{

        width: 90%;
        height: 25px;
        transition-duration: .5s;
        transition-property: width;
    }



    #btnCliente{

        width: 30%;
        cursor: pointer;
    }

    body{
        position: absolute;
        width: 100%;
        height: 92%;
        display: block;
    }
    a{

        text-decoration: none;
    }

    input[type=”file”] {

        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
     .lbl {

        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        background-color: #106BA0;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
        width: 60px;
        height: 24px;
    }
    .lbl:hover{

        background-color: #0F5E8C;
    }

    td{

        overflow: auto;
    }

    p{

        color: #fff;
        text-align: left;
        margin: none;
    }

    .negrita{

        font-weight: bold;
    }
</style>

<!-- modal ver pendiente -->
<div class="modal fade bd-example-modal-lg" id="modalVerPendiente" tabindex="-1" role="dialog" aria-labelledby="modalVerPendiente" aria-hidden="true">
      
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header azulWhi">

                <h5 class="modal-title" style="margin-right: auto; margin-left: auto;" id="lblCliente"></h5>

            </div>
    
            <div class="modal-body">
                
                
                <table class="table" id="tblContenido">
                    
                    <tr>
                        <td class="negrita">TELÉFONO:</td>
                        <td id="lblTelefono">
                            
                        </td>

                        <td class="negrita">EMAIL:</td>
                        <td id="lblEmail">
                            
                        </td>
                    </tr>

                    <tr>
                        <td class="negrita">RAZÓN SOCIAL:</td>
                        <td id="lblRSocial">
                            
                        </td>

                        <td class="negrita">RFC:</td>
                        <td id="lblRFC">
                            
                        </td>
                    </tr>

                    <tr>
                        <td class="negrita">CALLE:</td>
                        <td id="lblCalle">
                            
                        </td>
                        <td class="negrita">COLONIA:</td>
                        <td id="lblColonia">
                            
                        </td>
                    </tr>

                    <tr>
                        <td class="negrita">N° EXTERIOR:</td>
                        <td id="lblExterior">
                            
                        </td>
                        <td class="negrita">N° INTERIOR:</td>
                        <td id="lblInterior">
                            
                        </td>
                    </tr>

                    <tr>
                        <td class="negrita">CODIGO POSTAl:</td>
                        <td id="lblCP">
                            
                        </td>
                        <td class="negrita">ESTADO:</td>
                        <td id="lblEstado">
                            
                        </td>
                    </tr>

                    <tr>
                        <td class="negrita">MUNICIPIO:</td>
                        <td id="lblDelegacion">
                            
                        </td>
                        <td class="negrita">CFDI:</td>
                        <td id="lblCFDI">
                            
                        </td>
                    </tr>

                    <tr>
                        <td class="negrita">FORMA DE PAGO:</td>
                        <td id="lblFPago">
                            
                        </td>
                        <td class="negrita">MÉTODO DE PAGO:</td>
                        <td id="lblMPago">
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="negrita">ORDEN DE LA COMPRA:</td>
                        <td id="lblOCompra">
                            
                        </td>
                        <td class="negrita">ANTICIPO:</td>
                        <td id="lblAnticipo">
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="negrita">CLAVE DEL EVENTO:</td>
                        <td id="lblCEvento">
                            
                        </td>
                    </tr>
                </table>

                <table style="display: block; align-items: center;" id="tblDetalle">
                </table>
            </div>
    
            <div class="modal-footer">

                <button style="margin-left: auto; margin-right: auto;" type="button" data-dismiss="modal" class="btn azulWhi">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Contenido -->
<div class="table-section" style="height: 95%; display: block;">
    <form method="POST" id="frmDatos" enctype="multipart/form-data" method="POST" style="height: 95%; display: block;">

        <div class="table-controls">
        
            <div class="table-title">Solicitud Facturas</div>

                <button id="btnNvaCot" type="button" class="btn btn-primary btn-sm">Nueva Factura</button> 
                <input type="text" id="searcher" name="" placeholder="Buscar..">
        </div>
        
        <div class="table-container" style="height: 90%;">
        
            <table class="hep-table" id="tbeClientes">
            
                <thead>
                    <tr>
                        <th><strong>Estado</strong></th>
                        <th><strong>Cliente</strong></th>
                        <th><strong>Clave Evento</strong></th>
                        <th><strong>Fecha</strong></th>
                        <th><strong>Tienda</strong></th>
                        <th><strong>Orden Compra</strong></th>
                        <th><strong>Monto</strong></th>
                        <th style="width: 100px;"><strong>VER XML</strong></th>
                        <th style="width: 100px;"><strong>VER PDF</strong></th>
                        <th style="width: 100px;"><strong>subir XML</strong></th>
                        <th style="width: 100px;"><strong>subir PDF</strong></th>
                        
                    </tr>
                </thead>
                <tbody id="inv-body" >

                    <!-- loop de datos -->
                    <?php
                    foreach ($facturas as $row) { 
                        
                        $nombre = $row['nombre'];
                        $nombre = strval($nombre);
                        $nombre = trim($nombre);
                        //$nombre = utf8_encode($nombre);
                        $realizado = $row['enviada'];
                        $nombreArchivo = explode("/", $row['archivo_xml']);
                        $nombreArchivo = $nombreArchivo[3];
                        $urlArchivo = "";
                        if( $realizado == "true" ){
                            
                            $estado = "realizado";
                        }else{

                            $estado = "Pendiente";
                        }

                        ?>
                        <tr>
                            
                            <td id="<?= $row['id_factura'];?>" ><?= $estado;?></td>
                            <td >

                                <?= $nombre . ' ' . $apellido;?>
                            </td>
                            <td ><?= $row['clave_evento'];?></td>
                            <td ><?= $row['fecha_realizacion'];?></td>
                            <td ><?= $row['nombre_tienda'];?></td>
                            <td ><?= $row['orden_compra'];?></td>
                            <td >$<?= round(floatval($row['monto_total']),4);?></td>
                            <td>
                                
                                <a href="<?= URL . $row['archivo_xml']?>" id="vx<?= $row['id_factura'] ?>" download="<?=$nombreArchivo?>" data-id="<?= $row['id_factura'];?>" class="table-button green2">VER XML
                                </a>
                            </td>
                            <td>
                                <?php
                                    if( file_exists($row['archivo_pdf']) ){?>

                                        <button href="#" id="vp<?= $row['id_factura'] ?>" onclick="window.open('<?= URL . $row['archivo_pdf'] ?>', '_blank', 'fullscreen=yes'); return false;" data-id="<?= $row['id_factura'];?>" class="table-button green2">VER PDF
                                        </button>
                                <?php }else{?>

                                    <button href="#" id="vp<?= $row['id_factura'] ?>" onclick="unknowFile(); return false;" class="table-button green2" data-id="<?= $row['id_factura'];?>">VER PDF
                                    </button>
                                <?php } ?>
                                
                            </td>
                            
                            <td>

                                <label class="lbl" id="1<?= $row['id_factura'];?>"><img src="<?= URL ?>public/img/upfile.png" style="width: 30px; height: 20px;"><input id="xml<?= $row['id_factura'];?>" type="file" class="input" style="display: none" onchange="check(<?= $row['id_factura'];?>);" accept="text/xml"></label>
                            </td>

                            <td>

                                <label class="lbl" id="2<?= $row['id_factura'];?>"><img src="<?= URL ?>public/img/upfile.png" style="width: 30px; height: 20px;"><input id="pdf<?= $row['id_factura'];?>" type="file" class="input"  style=" display: none" onchange="check2(<?= $row['id_factura'];?>);" accept="application/pdf"></label>
                            </td>
                        </tr>
                        <script type="text/javascript">

                            if("<?= $estado;?>" == "Pendiente") {
                                
                                $("#<?= $row['id_factura'];?>").css("color","red");
                                $("#<?= $row['id_factura'];?>").click(function(){

                                resetLbl();

                                $("#lblCFDI").html("<?= $row['cfdi'];?>");
                                $("#lblFPago").html("<?= $row['fpago'];?>");
                                $("#lblMPago").html("<?= $row['mpago'];?>");
                                $("#lblOCompra").html("<?= $row['orden_compra'];?>");
                                $("#lblAnticipo").html("<?= $row['monto_anticipo'];?>");
                                $("#lblCEvento").html("<?= $row['clave_evento'];?>");

                                $("#lblCliente").html("<?= $nombre?>");
                                $("#lblTelefono").html("<?= $row['telefono']?>");
                                $("#lblEmail").html("<?= $row['email']?>");
                                $("#lblRFC").html("<?= $row['rfc']?>");
                                $("#lblRSocial").html("<?= $row['razon_social']?>");
                                $("#lblCalle").html("<?= $row['calle']?>");
                                $("#lblColonia").html("<?= $row['colonia']?>");
                                $("#lblExterior").html("<?= $row['no_ext']?>");
                                $("#lblInterior").html("<?= $row['no_int']?>");
                                $("#lblCP").html("<?= $row['cp']?>");
                                $("#lblEstado").html("<?= $row['estado']?>");
                                $("#lblDelegacion").html("<?= $row['delegacion']?>");


                                var formData = [];

                                formData.push({ name: "idFactura" , value: <?= $row['id_factura'];?> });

                                    $.ajax({

                                        url: "<?= URL ?>ventas/getFacturasByFactura",
                                        method: "POST",
                                        data: formData,
                                        success: function(respuesta){

                                            $("#tblDetalle tr").remove();
                                            var titulo = '<tr class="azulWhi"><td style=" border-right: 1px #999 solid; border-top-left-radius: 15px; width: 20%;"><p>ODT</p></td><td style=" border-right: 1px #999 solid; width: 50%;"><p>CONCEPTO</p></td><td style=" border-right: 1px #999 solid; width: 10%;"><p>CANT.</p></td><td style="width: 10%;"><p>PRECIO</p></td><td style="width: 10%; border-left: 1px #999 solid;"><p>IVA</p></td><td style=" border-left: 1px #999 solid; width: 20%; border-top-right-radius: 15px;"><p>SUBTOTAL</p></td></tr>';

                                            $("#tblDetalle").append(titulo);
                                            try{
                                                respuesta = JSON.parse(respuesta);

                                                for( var i=0; i < respuesta.length; i++ ){

                                                    var trDetalle = '<tr  style="border-bottom: 1px #999 dashed"><td style=" border-right: 1px #999 solid; ">' + respuesta[i]['odt'] + '</td><td style=" border-right: 1px #999 solid; ">' + respuesta[i]['servicio'] + '</td><td style=" border-right: 1px #999 solid; ">$' + respuesta[i]['cantidad'] + '</td><td style=" border-right: 1px #999 solid; ">' + respuesta[i]['precio'] + '</td><td style=" border-right: 1px #999 solid; ">' + respuesta[i]['iva'] + '</td><td>$' + respuesta[i]['monto'] + '</td></tr>';

                                                    $("#tblDetalle").append(trDetalle);
                                                }
                                                $("#modalVerPendiente").modal("show"); 
                                            }catch(e){
                                                showModError("No se pudo mostrar los datos.");
                                            }
                                        var trTotal = '<tr><td></td><td></td><td></td><td></td><td></td><td style=" border-left: 1px #999 solid">$<?= $row['monto_total']?></td></tr>';
                                                $("#tblDetalle").append(trTotal);
                                        }
                                    });
                                });
                            }else{

                                $("#pdf<?= $row['id_factura'];?>").prop("disabled", true);

                                $("#xml<?= $row['id_factura'];?>").prop("disabled", true);

                                $("#1<?= $row['id_factura'];?>").css("border-color", "#B5B5B5");
                                $("#1<?= $row['id_factura'];?>").css("background-color", "#B5B5B5");

                                $("#2<?= $row['id_factura'];?>").css("border-color", "#B5B5B5");
                                $("#2<?= $row['id_factura'];?>").css("background-color", "#B5B5B5");
                            }
                            var pdf = "<?= $row['archivo_pdf'];?>";
                            var xml = "<?= $row['archivo_xml'];?>";

                            if( pdf !== "" ){

                                $("#pdf<?= $row['id_factura'];?>").prop("disabled", true);
                                $("#2<?= $row['id_factura'];?>").css("border-color", "#B5B5B5");
                                $("#2<?= $row['id_factura'];?>").css("background-color", "#B5B5B5");
                            }else{

                                $("#vp<?=$row['id_factura']?>").prop("disabled", true);
                                $("#vp<?=$row['id_factura']?>").css("border-color", "#B5B5B5");
                                $("#vp<?=$row['id_factura']?>").css("background-color", "#B5B5B5");
                            }
                            if( xml !== "" ){

                                $("#xml<?= $row['id_factura'];?>").prop("disabled", true);
                                $("#1<?= $row['id_factura'];?>").css("border-color", "#B5B5B5");
                                $("#1<?= $row['id_factura'];?>").css("background-color", "#B5B5B5");
                            }else{

                                //$("#vx<?=$row['id_factura']?>").prop("disabled", true);
                                $("#vx<?= $row['id_factura'];?>").addClass("desactivar");
                                $("#vx<?=$row['id_factura']?>").css("border-color", "#B5B5B5");
                                $("#vx<?=$row['id_factura']?>").css("background-color", "#B5B5B5");
                            }
                        </script>
                    <?php } ?>
                </tbody>
            </table>
        
        </div>
    </form>
</div>
    
<div class="popup" style="display: none;"> 
</div>

<div class="backdrop"></div>

<!-- modal Eliminar-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminar" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #E53333; color: white;">

                <h5 class="modal-title">Confirmación</h5>
            </div>
    
            <div class="modal-body">

                <p style="color: black; font-size: 1.1em">¿Esta seguro de eliminar el cliente?</p>
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

        <div class="modal-content" style="height: 400px !important">

            <div class="modal-header azulWhi">

                <h5 class="modal-title" id="txtTitModCorrecto">SELECCIONA</h5>
            </div>
    
            <div class="modal-body">


                <div id="accordion" style="width: 90%; display: block; margin-left: auto; margin-right: auto;">
                    
                    <div class="card" style="border: none;">
                        
                        <div class="card-header" id="headingOne" style="padding: 0px; width: 100%; height: 40px; border: none; margin: 0px">

                            <input class="form-group" placeholder="Ingrese un cliente" onkeyup="searchClient();" type="text" name="txtSearch" id="txtSearch" autofocus="focus" style="width: 92%; height: 100%;" />
                            
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" style="height: 100%; float: right; width: 8%;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                        </div>
                        

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style=" margin: 0px; width: 100%;">
                            <div class="card-body" id="divSelect2" style=" border: 1px rgb(0,0,0,0.5) solid; padding: 0px;">

                                <script type="text/javascript">
                                    for (var i = 0; i < nombreCliente.length; i++) {

                                        var cliente = nombreCliente[i];
                                        var appnd = '<li style="list-style:none;" class="lista" data-id="' + idCliente[i] + '" onclick="enviar('+idCliente[i]+')">' + cliente +'</li>';
                                        $("#divSelect2").append(appnd);
                                    }    
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                
                <button style="display: none;" class="btn btn-success" id="btnCliente">Agregar Cliente</button>
                <button class="btn azulWhi" data-dismiss="modal">Cerrar</button>
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
</div>
<!-- modal correcto -->
<div class="modal fade" id="modalCorrecto" tabindex="-1" role="dialog" aria-labelledby="modalError" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header azulWhi">

                <h5 class="modal-title" id="lblModal"></h5>
            </div>
    
            <div class="modal-body">

                <label id="imgModal"></label>
                <label id="lblCorrecto" style="color: black; font-size: 1.1em"></label>
                <br>
                
            </div>
    
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<script>

    var id;
    var cliente;
    var formData = new FormData(document.getElementById("frmDatos"));
    var actBtn =0;

    function getId(id){

        this.id=parseInt(id);
    }

    $(".desactivar").click( function (){

        return false;
    });

    function showModError(texto) {

        $("#txtContenido").html(texto);
        $('#modalError').modal({backdrop: 'static', keyboard: false});
    }

    $("#frmDatos").on("submit", function(e){

        e.preventDefault();
        if( actBtn == 0 ){

            showModError("Debe de subir un archivo por lo menos");
        }else{
            
            $.ajax({

                url: "<?= URL ?>ventas/uploadFileFactura",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(respuesta){
                    console.log(respuesta);
                    respuesta = JSON.parse(respuesta);
                    if( respuesta == true ){

                        //location.href = "<?= URL ?>ventas/solicitud_facturas";
                    }
                }
            });
        }
    });

    $("#btnNvaCot").click(function(){

        $("#modalClientes").modal("show");
    });

    function check(id){

        actBtn = 1;
        $("#1"+id).css("background-color","green");
        var archivo = $('#xml'+id)[0].files[0];
        formData.append("xml-"+id,archivo);
        
        envio();
    }

    function envio(){

        if( actBtn == 0 ){

            showModError("Debe de subir un archivo por lo menos");
        }else{
            
            $("#modalCorrecto").modal({backdrop: 'static', keyboard: false});
            
            $("#lblModal").html("Cargando...");
            $("#imgModal").html("ESPERE UN MOMENTO");

            $.ajax({

                url: "<?= URL ?>ventas/uploadFileFactura",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(respuesta){
                    console.log(respuesta);
                    respuesta = JSON.parse(respuesta);
                    if( respuesta == true ){
                        
                        $("#lblModal").html('Registro Exitoso');
                        $("#imgModal").append('<img src="<?=URL?>public/img/correcto.gif" style="width: 120px; height: 90px">');

                        location.href = "<?= URL ?>ventas/solicitud_facturas";
                    }
                }
            });
        }
    }

    function check2(id){

        actBtn = 1;
        $("#2"+id).css("background-color","green");
        var archivo = $('#pdf'+id)[0].files[0];
        formData.append("pdf-"+id,archivo);

        envio();
    }

    $(document).on('keyup', '#searcher', function () {

        var parameter = $(this).val();
        var filtro = parameter.toUpperCase();
        var tabla = document.getElementById("tbeClientes");
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
    });

    function resetLbl(){

        $("#lblCFDI").html();
        $("#lblFPago").html();
        $("#lblMPago").html();
        $("#lblOCompra").html();
        $("#lblAnticipo").html();
        $("#lblCEvento").html();
        $("#lblCliente").html();
        $("#lblTelefono").html();
        $("#lblEmail").html();
        $("#lblRFC").html();
        $("#lblRSocial").html();
        $("#lblCalle").html();
        $("#lblColonia").html();
        $("#lblExterior").html();
        $("#lblInterior").html();
        $("#lblCP").html();
        $("#lblEstado").html();
        $("#lblDelegacion").html();
    }

    function enviar(id){
  
        location.href = '<?php echo URL; ?>ventas/newFactura/?cliente=' + id;
    }

    $("#txtSearch").keydown(function (tecla) {

        var ul = document.getElementById("divSelect2");
        var li = ul.getElementsByTagName("li");
        var id =$("#divSelect2 li:visible:eq(0)").data("id");

        if (tecla.keyCode == 13) {
            
            if( id == null || id == undefined ) return false;
            location.href = '<?php echo URL; ?>ventas/newFactura/?cliente=' + id;
        }
    });

    $("#btnSelect").click( function(){

        var vista = document.getElementById("divSelect").style.display;
        if( vista == "" || vista == "none" ){

           $("#divSelect").show();
           $("#btnSelect").css("border-bottom","none");
           $("#divSelect").css("border-top","none");
           $("#btnSelect").css("outline","none");
           $("#btnSelect").css("border-radius","0px");
        }else{

           $("#divSelect").hide();
           $("#btnSelect").css("border-bottom","1px rgb(0,0,0,0.5) solid");
           $("#btnSelect").css("outline","all");
           $("#btnSelect").css("border-radius","4px");
        }
        
    });


    function searchClient(){

        $("#collapseOne").show();
        var texto  = $("#txtSearch").val();
        var filtro = texto.toUpperCase();
        var ul     = document.getElementById("divSelect2");
        var li     = ul.getElementsByTagName("li");
        var len    = li.length;
        for (i = 0; i < len; i++) {

            var li1 = li[i];
            if (li1) {

                txtValue = li1.innerText;

                if (txtValue.toUpperCase().indexOf(filtro) > -1) {

                    $(li[i]).show();
                } else {

                    $(li[i]).hide();
                }
            }
        }
        var primerValor=$("#divSelect2 li:visible:eq(0)").html();
        console.log(primerValor);

        var cont = $("#divSelect2 li:visible").length;

        if( cont == 0){

            $("#btnCliente").show("normal");
        }else{

            $("#btnCliente").hide("normal");
        }
    }

    $("#btnCliente").click( function(){

        location.href = "<?= URL ?>cotizador/nuevo_cliente";
    });

    function unknowFile(){

        showModError("El archivo que esta buscando no existe.");
    }
</script>