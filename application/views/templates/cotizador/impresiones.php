
<!-- ******* Todos los Modales Impresiones ******* -->
    <div class="modal fade" id="Impresiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header azulWhi">
                    <h5 class="modal-title" id="exampleModalLongTitle">Impresiones</h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div id="alerterrorimp">

                    </div>

                    <div>

                        <select id="miSelect" class="SelectTSM">

                            <option selected value="selected" disabled>Elige el tipo de impresión</option>

                            <?php
                            foreach ($impresiones as $impresion) {   ?>

                                <option id="Imp" value="<?=$impresion['nombre']?>" data-precio="<?=$impresion['precio']?>" data-id="<?=$impresion['id_impresion']?>"><?=$impresion['nombre']?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>

                    <div id="opImpresionOffset" style="display: none;">

                        <table class="table" style="text-align: left;" >

                            <tbody>

                                <tr>

                                    <td>Número de tintas:</td>
                                    <td>

                                        <input type="number" id="tintasO" value="1" style="width: 50px;" min="1" max="6">
                                    </td>
                                </tr>

                                <tr>

                                    <td colspan="2">

                                        <select  id="SelectImpTipoOff" class="SelectTSM">

                                            <option selected value="selected" disabled>Elige el tipo de offset</option>

                                            <?php
                                            foreach ($TipoImp as $TipoImps) {   ?>

                                                <option id="Imp" value="<?=$TipoImps['nombre']?>" data-precio="<?=$TipoImps['precio']?>" data-id="<?=$TipoImps['id_impresiones_slave']?>"><?=$TipoImps['nombre']?></option>
                                            <?php
                                            }

                                        ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opImpresionDigital" style="display: none;">

                        <table class="table" style="text-align: left;">

                            <tbody>

                                <tr>

                                    <td colspan="2">

                                        <label>Se agregará una impresión digital</label>
                                        <!--<select  id="SelectImpDigital" class="SelectTSM">

                                            <option selected value="selected" disabled>Elige el tipo de Digital</option>

                                            <?php
                                            foreach ($Digital as $dig) {   ?>

                                                <option id="ImpDig" value="<?=$dig['nombre']?>"  data-id="<?=$dig['id_proc_digital']?>"><?=$dig['nombre']?></option>
                                            <?php
                                            }

                                        ?>-->
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opImpresionSerigrafia" style="display: none;">

                        <table class="table" style="text-align: left;">

                            <tbody>

                                <tr>

                                    <td>Número de tintas:</td>
                                    <td>

                                        <input type="number" value="1" id="tintasS" style="width: 50px;" min="1" max="6">
                                    </td>
                                </tr>

                                <tr>

                                    <td colspan="2">

                                        <select  id="SelectImpTipoSeri" class="SelectTSM">

                                            <option selected value="selected" disabled>Elige el tipo de serigrafia</option>

                                            <?php
                                            foreach ($TipoImp as $TipoImps) {   ?>

                                                <option id="Imp" value="<?=$TipoImps['nombre']?>" data-precio="<?=$TipoImps['precio']?>" data-id="<?=$TipoImps['id_impresiones_slave']?>"><?=$TipoImps['nombre']?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" id="btnImpresiones" class="btn btn-guardar-blues">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    
    /* -------- Activa los div de los select impresiones ---------*/
    document.getElementById('miSelect').onchange = function(event) {

        var opcionact = document.getElementById('miSelect').value;


        if (opcionact == 'Offset') {

            $('#opImpresionOffset').show('slow');
            $('#opImpresionDigital').hide('slow');
            $('#opImpresionSerigrafia').hide('slow');
        }


        if (opcionact == 'Digital') {

            $('#opImpresionDigital').show('slow');
            $('#opImpresionOffset').hide('slow');
            $('#opImpresionSerigrafia').hide('slow');
        }


        if (opcionact == 'Serigrafia') {

            $('#opImpresionSerigrafia').show('slow');
            $('#opImpresionOffset').hide('slow');
            $('#opImpresionDigital').hide('slow');
        }
    }

    function divisionesImp(opcion) {

        divisionesImps=opcion;
    }

    function saveBtnImpresiones(arrpapeles, tabla) {


        var IDopImp  = $("#miSelect option:selected").data('id');
        var opImp    = $("#miSelect option:selected").text();
        var precio   = $("#miSelect option:selected").data('precio'); //precio unitario
        var alertDiv = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Problemas!</strong> No seleccionaste todos los elementos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        if (opImp == 'Offset') {

            var tipo   = $("#SelectImpTipoOff option:selected").text();
            var precio = $("#SelectImpTipoOff option:selected").data('precio');
            var idTipo = $("#SelectImpTipoOff option:selected").data('id');
            var tintas = document.getElementById('tintasO').value;
            var nuloo  = document.getElementById('SelectImpTipoOff').value;

            if (nuloo == 'selected') {

                document.getElementById('alerterrorimp').innerHTML = alertDiv;

            } else {

                document.getElementById('alerterrorimp').innerHTML = "";

                var imp  = '<tr><td class="textImp">' + opImp + '</td></td><td class="CellWithComment" >...<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td style="display: none;">'+ tintas +'</td><td style="display: none;">'+ tipo +'</td><td class="' + tabla +' img_delete"></td></tr>';

                arrpapeles.push({"Tipo_impresion": opImp, "tintas": tintas, "tipo_offset": tipo});

                $('#Impresiones').modal('hide');

                $('#' + tabla).append(imp);

                vacioModalImpresiones();
            }
        }

        if (opImp == 'Digital') {

            var tipo   = $("#SelectImpDigital option:selected").text();

            var imp  = '<tr><td class="textImp">' + opImp + '</td><td class="CellWithComment">...<span class="CellComment">Se agregó una impresión digital</span></td><td class="' + tabla +' img_delete"></td></tr>';
            arrpapeles.push({"Tipo_impresion": opImp});

            $('#Impresiones').modal('hide');

            $('#' + tabla).append(imp);

            vacioModalImpresiones();
        }

        if (opImp == 'Serigrafia') {

            var tipo   = $("#SelectImpTipoSeri option:selected").text();
            var precio = $("#SelectImpTipoSeri option:selected").data('precio');
            var tintas = document.getElementById('tintasS').value;
            var nuloo  = document.getElementById('SelectImpTipoSeri').value;

            if (nuloo == 'selected') {

                document.getElementById('alerterrorimp').innerHTML = alertDiv;

            } else {

                document.getElementById('alerterrorimp').innerHTML = "";

                var imp  = '<tr><td class="textImp">' + opImp +'</td></td><td class="CellWithComment">...<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td style="display: none;">'+ tintas +'</td><td style="display: none;">'+ tipo +'</td><td class="' + tabla +' img_delete"></td></tr>';

                arrpapeles.push({"Tipo_impresion": opImp,  "tintas": tintas, "tipo_offset": tipo});

                $('#Impresiones').modal('hide');

                jQuery214('#' + tabla).append(imp);

                vacioModalImpresiones();
            }
        }
    }

    function delBtnImpresiones(arrPapeles, tabla) {

        var TableData       = "";
        var tipo_imp_offset = "";

        $("#" + tabla + " tr").each(function(row, tr) {

            var opImp   = $(tr).find('td:eq(0)').text();
            var tintas  = parseInt($(tr).find('td:eq(2)').text(),10);
            var tipo    = $(tr).find('td:eq(3)').text();

            switch( opImp ){

                case "Offset":

                    var idtipoOff = parseInt($("#tipoOffEmp").val());

                    arrPapeles.push({"Tipo_impresion": opImp, "tintas": tintas, "tipo_offset": tipo});
                break;
                case "Digital":

                    arrPapeles.push({"Tipo_impresion": opImp});
                break;
                case "Serigrafia":

                    var idtipoSeri = parseInt($("#tipoSeriEmp").val());

                    arrPapeles.push({"Tipo_impresion": opImp,  "tintas": tintas, "tipo_offset": tipo});
                break;
            }
        });
    }

    function vacioModalImpresiones() {

        document.getElementById('miSelect').value                      = "selected";
        document.getElementById('SelectImpTipoOff').value              = "selected";
        document.getElementById('SelectImpTipoSeri').value             = "selected";
        document.getElementById('opImpresionSerigrafia').style.display = "none";
        document.getElementById('opImpresionOffset').style.display     = "none";
        document.getElementById('opImpresionDigital').style.display    = "none";
    }
</script>