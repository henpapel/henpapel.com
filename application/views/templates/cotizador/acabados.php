
<!-- ******* Todos los Modales Acabados ******* -->
    <div class="modal fade" id="acabados" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header azulWhi">

                    <h5 class="modal-title" id="exampleModalLongTitle">Acabados</h5>

                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div id="alerterror">

                    </div>

                    <div>

                        <select  id="SelectAcEmp" class="SelectTSM">

                            <option selected value="selected" disabled>Elige el tipo de acabado</option>

                            <?php
                            foreach ($acabados as $acabado) {   ?>

                                <option id="Acb" value="<?=$acabado['nombre']?>" data-precio="<?=$acabado['precio']?>" data-id="<?=$acabado['id_acabados']?>"><?=$acabado['nombre']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div id="opAcLaminadoEmp" style="display: none;">

                        <br>
                        <table class="table" style="text-align: left;">

                            <tbody>
                                <tr>
                                    <td>
                                        <select  id="SelectLaminadoEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo de laminado</option>
                                            <?php
                                            foreach ($ALaminados as $alaminado) {   ?>
                                            <option id="aLam" value="<?=$alaminado['nombre']?>" data-precio="<?=$alaminado['precio']?>" data-id="<?=$alaminado['id_proc_laminado']?>"><?=$alaminado['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opAcHotStampingEmp" style="display: none;">

                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Largo: <input type="number" id="LargoHS_ver" name="LargoHS_ver" value="1" style="width: 70px;" min="1">cm</td>
                                    <td>Ancho: <input type="number" id="AnchoHS_ver" name="AnchoHS_ver" value="1" style="width: 70px;" min="1">cm</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectHSEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo de HotStamping</option>
                                            <?php
                                            foreach ($AHotStamping as $ahotstam) {   ?>
                                            <option id="aHS" value="<?=$ahotstam['nombre']?>" data-precio="<?=$ahotstam['precio']?>" data-id="<?=$ahotstam['id_slave_hs']?>"><?=$ahotstam['nombre']?></option>
                                            <?php
                                            }   ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectColorHSEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un color</option>
                                            <?php
                                            foreach ($Colores as $Coloress) {   ?>
                                            <option id="cHS" value="<?=$Coloress['nombre']?>" data-precio="<?=$Coloress['precio']?>"><?=$Coloress['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opAcGrabadoEmp" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Largo: <input type="number" id="LargoGrab" value="1" style="width: 70px;" min="1">cm</td>
                                    <td>Ancho: <input type="number" id="AnchoGrab" value="1" style="width: 70px;" min="1">cm</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectGrabEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo de grabado</option>
                                            <?php
                                            foreach ($AGrabados as $agrabado) {   ?>
                                            <option id="Grab" value="<?=$agrabado['nombre']?>" data-precio="<?=$agrabado['precio']?>"><?=$agrabado['nombre']?></option>
                                            <?php
                                            }   ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectUbiGrabEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige la ubicación del grabado</option>
                                            <option id="Ubi" value="Lomo" data-precio="">En el Lomo</option>
                                            <option id="Ubi" value="Cierre" data-precio="">En el cierre</option>
                                            <option id="Ubi" value="Tapa" data-precio="">En la Tapa</option>
                                            <option id="Ubi" value="Izquierdo" data-precio="">Lado Izquierdo</option>
                                            <option id="Ubi" value="Derecho" data-precio="">Lado Derecho</option>
                                            <option id="Ubi" value="Fondo" data-precio="">En el Fondo</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="imagengrabados">
                            <img border="0" src="<?=URL ;?>public/img/1.png" style="width: 70%">
                        </div>
                    </div>

                    <div id="opAcEspecialesEmp" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>
                                        <select  id="SelectEspecialesEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo de Pegado Especial</option>
                                            <?php
                                            foreach ($APEspeciales as $aespeciales) {   ?>
                                            <option id="aLam" value="<?=$aespeciales['nombre']?>" data-precio="<?=$aespeciales['precio']?>"><?=$aespeciales['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opAcBarnizUVEmp" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>
                                        <select  id="SelectBarnizUVEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo</option>
                                            <?php
                                            foreach ($ABarnizUV as $aBarniz) {   ?>
                                            <option id="aBar" value="<?=$aBarniz['nombre']?>" data-precio="<?=$aBarniz['precio']?>"><?=$aBarniz['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opAcSuajeEmp" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Largo: <input type="number" id="LargoSuaje" value="1" style="width: 70px;" min="1">cm</td>
                                    <td>Ancho: <input type="number" id="AnchoSuaje" value="1" style="width: 70px;" min="1">cm</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectSuajeEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo de Suaje</option>
                                            <?php
                                            foreach ($ASuaje as $asuaj) {   ?>
                                            <option id="aSuaj" value="<?=$asuaj['nombre']?>"><?=$asuaj['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opAcLaserEmp" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Largo: <input type="number" id="LargoLaser1" value="1" style="width: 70px;" min="1">cm</td>
                                    <td>Ancho: <input type="number" id="AnchoLaser1" value="1" style="width: 70px;" min="1">cm</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectLaserEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo de laser</option>
                                            <?php
                                            foreach ($ALaser as $alaser) {   ?>
                                            <option id="alaser" value="<?=$alaser['nombre']?>" data-precio="<?=$alaser['precio']?>"><?=$alaser['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opAcBarUVEmp" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Largo: <input type="number" id="LargoBarUVEmp" value="1" style="width: 70px;" min="1">cm</td>
                                    <td>Ancho: <input type="number" id="AnchoBarUVEmp" value="1" style="width: 70px;" min="1">cm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="caja.saveAcabado()" id="btnAcabados" class="btn btn-guardar-blues">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
          </div>
      </div>
    </div>

<script type="text/javascript">
    
    document.getElementById('SelectAcEmp').onchange = function(event) {

        var opcionact = document.getElementById('SelectAcEmp').value;

        $('#opAcLaminadoEmp').hide('slow');
        $('#opAcHotStampingEmp').hide('slow');
        $('#opAcGrabadoEmp').hide('slow');
        $('#opAcEspecialesEmp').hide('slow');
        $('#opAcBarnizUVEmp').hide('slow');
        $('#opAcSuajeEmp').hide('slow');
        $('#opAcLaserEmp').hide('slow');
        $('#opAcBarUVEmp').hide('slow');

        switch(opcionact){

            case "Laminado":
                $('#opAcLaminadoEmp').show('normal');
            break;

            case "HotStamping":
                $('#opAcHotStampingEmp').show('normal');
            break;

            case "Grabado":
                $('#opAcGrabadoEmp').show('normal');
            break;

            case "Pegados Especiales":
                $('#opAcEspecialesEmp').show('normal');
            break;

            case "Barniz UV":
                $('#opAcBarnizUVEmp').show('normal');
            break;

            case "Suaje":
                $('#opAcSuajeEmp').show('normal');
            break;

            case "Corte Laser":
                $('#opAcLaserEmp').show('normal');
            break;
        }

        function appndImg(div, src){

            $(div).html(src)
        }

        document.getElementById('SelectUbiGrabEmp').onchange = function(event) {

            var ubicacion = document.getElementById('SelectUbiGrabEmp').value;

            switch( ubicacion ){

                case "Lomo":
                    appndImg('#imagengrabados', '<img style="width: 70%" border="0" src="<?=URL ;?>public/img/lomo.png" >');
                break;

                case "Cierre":
                    appndImg('#imagengrabados', '<img style="width: 70%" border="0" src="<?=URL ;?>public/img/cierre.png" >');
                break;

                case "Tapa":
                    appndImg('#imagengrabados', '<img style="width: 70%" border="0" src="<?=URL ;?>public/img/tapa.png">')
                break;

                case "Izquierdo":
                    appndImg('#imagengrabados', '<img style="width: 70%" border="0" src="<?=URL ;?>public/img/izquierdo.png">')
                break;

                case "Derecho":
                    appndImg('#imagengrabados', '<img style="width: 70%" border="0" src="<?=URL ;?>public/img/derecho.png">')
                break;

                case "Fondo":
                    appndImg('#imagengrabados', '<img style="width: 70%" border="0" src="<?=URL ;?>public/img/fondo.png">')
                break;
            }
        }
    }

    document.getElementById('SelectBarnizUVEmp').onchange = function(event) {

        var seleccion = document.getElementById('SelectBarnizUVEmp').value;


        if (seleccion == 'Registro Mate' || seleccion == 'Registro Brillante') {

            $('#opAcBarUVEmp').show('normal');
        }


        if (seleccion == 'Mate' || seleccion == 'Brillante') {

            $('#opAcBarUVEmp').hide('normal');
        }
    }

    function vacioModalAcabados() {

        document.getElementById('SelectAcEmp').value                = "selected";
        document.getElementById('SelectLaminadoEmp').value          = "selected";
        document.getElementById('SelectHSEmp').value                = "selected";
        document.getElementById('SelectColorHSEmp').value           = "selected";
        document.getElementById('SelectGrabEmp').value              = "selected";
        document.getElementById('SelectEspecialesEmp').value        = "selected";
        document.getElementById('SelectBarnizUVEmp').value          = "selected";
        document.getElementById('SelectSuajeEmp').value             = "selected";
        document.getElementById('SelectLaserEmp').value             = "selected";
        document.getElementById('SelectUbiGrabEmp').value           = "selected";
        document.getElementById('opAcLaminadoEmp').style.display    = "none";
        document.getElementById('opAcHotStampingEmp').style.display = "none";
        document.getElementById('opAcGrabadoEmp').style.display     = "none";
        document.getElementById('opAcEspecialesEmp').style.display  = "none";
        document.getElementById('opAcBarnizUVEmp').style.display    = "none";
        document.getElementById('opAcSuajeEmp').style.display       = "none";
        document.getElementById('opAcLaserEmp').style.display       = "none";
        document.getElementById('opAcBarUVEmp').style.display       = "none";
        document.getElementById('LargoLaser1').value                = "1";
        document.getElementById('AnchoLaser1').value                = "1";
        document.getElementById('LargoGrab').value                  = "1";
        document.getElementById('AnchoGrab').value                  = "1";
        document.getElementById('LargoHS_ver').value                = "1";
        document.getElementById('AnchoHS_ver').value                = "1";
        document.getElementById('LargoSuaje').value                 = "1";
        document.getElementById('AnchoSuaje').value                 = "1";
        document.getElementById('LargoBarUVEmp').value              = "1";
        document.getElementById('AnchoBarUVEmp').value              = "1";
    }
</script>