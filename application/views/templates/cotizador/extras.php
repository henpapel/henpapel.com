<!-- ******* Modal Guardar Todo ******** -->
<div class="modal fade" id="modalSaveAll" tabindex="-1" role="dialog" aria-labelledby="modalSaveAll" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header azulWhi">

                <h5 class="modal-title">Cotizacion</h5>
                <!--
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
                -->
            </div>

            <div class="modal-body">

                <p style="color: black; font-size: 1.1em">¿Esta seguro de guardar la cotizacion?</p>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-primary azulWhi" data-dismiss="modal" id="btnGrabarC">Si</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- ******* Todos los modales Banco ******** -->
    <!-- Banco Empalme -->
    <div class="modal fade" id="bancoemp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header azulWhi">
            <h5 class="modal-title" id="exampleModalLongTitle">Banco</h5>
            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">

                <div id="alerterror5">

                </div>
                <div>
                    <select id="SelectBanEmp" class="SelectTSM">
                        <option selected value="selected" disabled>Elige un material</option>
                        <?php
                        foreach ($bancos as $banco) {   ?>
                        <option id="Ban" value="<?=$banco['nombre']?>" data-precio="<?=$banco['precio']?>" data-id="<?=$banco['id_acabados']?>"><?=$banco['nombre']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <br>

                <div>
                    <table class="table" style="text-align: left;">
                        <tbody>
                            <tr>
                                <td>Largo: </td><td><input type="number" id="LargoBanco" name="LargoBanco" value="1" style="width: 70px;" min="1">cm</td>
                            </tr>
                                <td>Ancho: </td><td><input type="number" id="AnchoBanco" name="AnchoBanco" value="1" style="width: 70px;" min="1">cm</td>
                            <tr>
                                <td>Profundidad: </td><td><input type="number" id="ProfundidadBanco" name="ProfundidadBanco" value="1" style="width: 70px;" min="1">cm</td>
                            </tr>
                            <tr id="llevasuajemodBanco" style="display: none;">
                                <td>¿Lleva Suaje?: </td>
                                <td>
                                    <select class="SelectTSM" id="SelectSuajeBanco">

                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" id="footerBancoEmp">
                <button type="button" id="btnBancoEmp" name="btnBancoEmp" class="btn btn-guardar-blues">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
      </div>
    </div>

<!-- ******* Todo el Modal Cierres ******* -->
    <div class="modal fade" id="cierres" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            
            <div class="modal-content">
                <div class="modal-header azulWhi">

                    <h5 class="modal-title" id="exampleModalLongTitle">Cierres</h5>
                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <div id="alerterror6"></div>
                    <div>
                        <select  id="SelectCieEmp" class="SelectTSM">
                            <option selected value="selected" disabled>Elige el tipo de cierre</option>
                            <?php
                            foreach ($cierres as $cierre) {   ?>
                            <option id="Acb" value="<?=$cierre['nombre']?>" data-precio="<?=$cierre['precio']?>" data-id="<?=$cierre['id_cierres']?>"><?=$cierre['nombre']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div id="opCieParaPares" style="display: none;">
                        
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Número de pares:</td>
                                    <td>
                                        <input type="number" id="paresCierre" value="1" style="width: 50px;" min="1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opCieListon" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Largo: <input type="number" id="LargoListon" name="LargoHS_ver" value="1" style="width: 70px;" min="1">cm</td>
                                    <td>Ancho: <input type="number" id="AnchoListon" name="AnchoHS_ver" value="1" style="width: 70px;" min="1">cm</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectListonEmp" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo de liston</option>
                                            <?php
                                            foreach ($TipoListon as $tipliston) {   ?>
                                            <option id="listontip" value="<?=$tipliston['nombre']?>" data-precio="<?=$tipliston['precio']?>" data-id="<?=$tipliston['id_liston']?>"><?=$tipliston['nombre']?></option>
                                            <?php
                                            }   ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectColorListon" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un color</option>
                                            <?php
                                            foreach ($ColoresListon as $coloresls) {   ?>
                                            <option id="clis" value="<?=$coloresls['nombre']?>" data-precio="<?=$coloresls['precio']?>"><?=$coloresls['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opCieMarialuisa" style="display: none;">

                        <table class="table" style="text-align: left;">

                            <tbody>

                                <tr>

                                    <td colspan="2">Se agregará un cierre Marialuisa
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="opCieSuajeCalado" style="display: none;">
                        <br>
                        <table class="table" style="text-align: left;">
                            <tbody>
                                <tr>
                                    <td>Largo: <input type="number" id="LargoSCalado" name="LargoSCalado" value="1" style="width: 70px;" min="1">cm</td>
                                    <td>Ancho: <input type="number" id="AnchoSCalado" name="AnchoSCalado" value="1" style="width: 70px;" min="1">cm</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <select  id="SelectSCalado" class="SelectTSM">
                                            <option selected value="selected" disabled>Elige un tipo</option>
                                            <?php
                                            foreach ($ALaser as $alaser) {   ?>
                                            <option id="liston" value="<?=$alaser['nombre']?>" data-precio="<?=$alaser['precio']?>"><?=$alaser['nombre']?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnCierres" class="btn btn-guardar-blues">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

<!-- ******* Todo el Modal Accesorios ******* -->
    <div class="modal fade" id="accesorios" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header azulWhi">
            <h5 class="modal-title" id="exampleModalLongTitle">Accesorios</h5>
            <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">

                <div id="alerterror7">

                </div>


                <div>
                    <table class="table">
                        <tr>
                            <td>
                                <select  id="SelectAccesorio" class="SelectTSM">
                                    <option selected value="selected" disabled>Elige un tipo</option>
                                    <?php
                                        foreach ($accesorios as $accesorio) {
                                    ?>
                                            <option id="idAccesorio" data-id="<?=$accesorio['id_accesorios']?>" data-group="accesorios" data-price="<?=$accesorio['precio']?>"><?=$accesorio['nombre']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="opMedidas" style="display: none;">
                    <br>
                    <table class="table" style="text-align: left;">
                        <tbody>
                            <tr>
                                <td>Largo: <input type="number" id="LargoAcc" name="LargoAcc" value="1" style="width: 70px;" min="1">cm</td>
                                <td>Ancho: <input type="number" id="AnchoAcc" name="AnchoAcc" value="1" style="width: 70px;" min="1">cm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="opOjillo" style="display: none;">
                    <table class="table" style="text-align: left;">
                        <tbody>
                            <tr>
                                <td colspan="2">se agregará un accesorio Ojillo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="opColores" style="display: none;">
                    <br>
                    <table class="table" style="text-align: left;">
                        <tbody>
                            <tr>
                                <td>
                                    <select id="SelectColor" class="SelectTSM">
                                        <option selected value="selected" disabled>Elige un color</option>
                                            <?php
                                                foreach ($ColoresListon as $Colores) {
                                            ?>
                                                    <option id="cl" value="<?=$Colores['nombre']?>" data-precio="<?=$Colores['precio']?>"><?=$Colores['nombre']?></option>
                                            <?php
                                                }
                                            ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="opHerraje" style="display: none;">
                    <br>
                    <table class="table" style="text-align: left;">
                        <tbody>
                            <tr>
                                <td>
                                    <select  id="SelectHerraje" class="SelectTSM">
                                        <option selected value="selected" disabled>Elige un herraje</option>
                                            <?php
                                                foreach ($Herrajes as $herraje) {
                                            ?>
                                                    <option id="h" value="<?=$herraje['nombre']?>" data-precio="<?=$herraje['precio']?>"><?=$herraje['nombre']?></option>
                                            <?php
                                                }
                                            ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <div class="modal-footer">
                <button type="button" id="btnAccesorios" class="btn btn-guardar-blues">Guardar</button>
                <button type="button" id="btnCancelAccesorios" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
      </div>
    </div>
    </div>

<!-- ******* Modal Error ******* -->
    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="modalError" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header azulWhi" style="background: red">

                    <h5 class="modal-title" id="txtTituloModal">Error</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true" style="color: #fff">&times;</span>
                    </button>
                    
                </div>

                <div id="modBody" class="modal-body">

                    <p id="txtContenido" style="color: black; font-size: 1.1em"></p>
                    
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary azulWhi" data-dismiss="modal" onclick="cleanModError();">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<!-- ******* Modal Correcto ******* -->
    <div class="modal fade" id="modalCorrecto" tabindex="-1" role="dialog" aria-labelledby="modalCorrecto" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header azulWhi">

                    <h5 class="modal-title" id="txtTitModCorrecto">Registro Exitoso</h5>

                </div>

                <div class="modal-body">

                    <p id="txtContCorrecto" style="color: black; font-size: 1.1em"></p>
                </div>

                <div class="modal-footer">

                    <button id="btnModCorrecto" type="button" class="btn btn-primary azulWhi" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<!-- Descuentos y botones de Guardar y Cancelar del modal "Descuentos" -->
    <div class="modal fade" id="descuentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header azulWhi">

                    <h5 class="modal-title" id="exampleModalLongTitle">Descuentos</h5>

                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Descuentos: 3%; 5%; 10%; 15%; 20% -->
                    <div>
                        <table>
                            <?php
                            foreach ($descuentos as $descuento) { ?>

                                <tr>
                                    <td>
                                        Aplicar el <?=$descuento['cantidad']?>%
                                    </td>
                                    <td>
                                        <input class="d-check" type="radio" name="desc" data-discount="<?=$descuento['cantidad']?>" data-value="1"  value="<?=$descuento['cantidad']?>">
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" data-dismiss="modal" class="btn btn-guardar-blues">Guardar</button>

                    <button type="button" id="btnDeleteDescuento" class="btn btn-danger" data-dismiss="modal">Eliminar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Tablas (Tablas de Registros) -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="procesosModal">

        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header azulWhi">

                    <h5 class="modal-title" id="exampleModalLongTitle">Tablas de Registros</h5>

                    <button type="button" class="close" style="color: white;" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Tabla de Registros -->
                <div class="modal-body">

                    <div class="accordion" id="accordionExample">

                        <!-- Cortes de Hojas -->
                        <div class="card">

                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onmouseover="this.style.cursor='pointer'">

                                <h2 class="mb-0">

                                    <button class="btn btn-link" type="button" style="text-decoration: none;">
                                        Cortes de Hojas
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

                                <div class="card-body">

                                    <table class="t-resume" style="text-align: center;">

                                        <tbody id="table_papeles_tr">
                                            <!-- Aquí se registran los datos -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <!-- Procesos Default -->
                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" onmouseover="this.style.cursor='pointer'">

                                <h2 class="mb-0">

                                    <button class="btn btn-link collapsed" type="button" style="text-decoration: none;">
                                        Procesos Default
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">

                                <div class="card-body">

                                    <table class="t-resume" style="text-align: center;">

                                        <tbody id="table_adicionales_tr">
                                            <!-- Aquí se registran los procesos default -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Mermas Integradas -->
                        <div class="card">

                            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" onmouseover="this.style.cursor='pointer'">

                                <h2 class="mb-0">

                                    <button class="btn btn-link collapsed" type="button" style="text-decoration: none;">
                                        Mermas Integradas
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">

                                <div class="card-body">

                                    <!-- tabla de mermas resumen -->
                                    <table class="t-resume" style="text-align: center;">

                                        <thead style="background: darkslateblue; color: white;">

                                            <tr>
                                                <td></td>
                                                <td style="color: white;">Proceso</td>
                                                <td style="color: white;">Minima</td>
                                                <td style="color: white;">Adicional</td>
                                                <td style="color: white;">Total</td>
                                                <td style="color: white;">Costo Unitario</td>
                                                <td style="color: white;">Costo Total</td>
                                            </tr>
                                        </thead>

                                        <tbody id="table_mermas_tr">
                                            <!-- Aquí se registran los datos -->
                                        </tbody>

                                        <tfoot>

                                            <tr>
                                                <td colspan="7" style="font-size: x-small;">E: Empalme | Fj: Forro del Cajón | Fr: Forro de la Cartera | G: Guarda</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Procesoso deImpresión -->
                        <div class="card">

                            <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" onmouseover="this.style.cursor='pointer'">

                                <h2 class="mb-0">

                                    <button class="btn btn-link collapsed" type="button" style="text-decoration: none;">
                                        Procesos de Impresión
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">

                                <div class="card-body">

                                    <!-- procesos offset Empalme-->
                                    <div class="container" id="proceso_offset_M1" style="display: none;">
                                        <h5>Offset</h5>

                                        <table id="tabla_view_offset_emp" class="t-resume" style="text-align: center;">

                                            <tbody id="table_proc_offset">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Serigrafia -->
                                    <div class="container" id="proceso_serigrafia_M1" style="display: none;">

                                        <h5>Serigrafia</h5>

                                        <table id="tabla_aj_serigrafia_emp" class="t-resume" style="text-align: center;">

                                            <tbody id="table_proc_serigrafia">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Digital -->
                                    <div class="container" id="proceso_digital_M1" style="display: none;">

                                        <h5>Digital</h5>

                                        <table id="tabla_aj_digital_emp" class="t-resume" style="text-align: center;">

                                            <tbody id="table_proc_digital">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Procesos de Acabados -->
                        <div class="card">

                            <div class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive" onmouseover="this.style.cursor='pointer'">

                                <h2 class="mb-0">

                                    <button class="btn btn-link" type="button" style="text-decoration: none;">
                                        Procesos de Acabados
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">

                                <div class="card-body">
                                    <!-- proceso laminado-->
                                    <div class="container" id="proceso_lam_M1" style="display: none;">

                                        <h5>Laminado</h5>

                                        <table id="tabla_view_Lam" class="t-resume" style="text-align: center;">

                                            <tbody id="table_proc_Lam">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- proceso hot stamping-->
                                    <div class="container" id="proceso_hs_M1" style="display: none;">

                                        <h5>HotStamping</h5>

                                        <table id="tabla_view_HS" class="t-resume" style="text-align: center;">

                                            <tbody id="table_proc_HS">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- proceso grabados-->
                                    <div class="container" id="proceso_grab_M1" style="display: none;">

                                        <h5>Grabados</h5>

                                        <table id="tabla_view_Grab" class="t-resume" style="text-align: center;">

                                            <tbody id="table_proc_Grab">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- proceso suaje-->
                                    <div class="container" id="proceso_suaje_M1" style="display: none;">
                                        <h5>Suaje</h5>

                                        <table id="tabla_view_Suaje" class="t-resume" style="text-align: center;">
                                            <tbody id="table_proc_Suaje">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- proceso corte laser-->
                                    <div class="container" id="proceso_laser_M1" style="display: none;">
                                        <h5>Corte Laser</h5>

                                        <table id="tabla_view_Laser" class="t-resume" style="text-align: center;">
                                            <tbody id="table_proc_Laser">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- proceso barniz uv -->
                                    <div class="container" id="proceso_barnizuv_M1" style="display: none;">
                                        <h5>Barniz UV</h5>

                                        <table id="tabla_view_BarnizUV" class="t-resume" style="text-align: center;">
                                            <tbody id="table_proc_BarnizUV">
                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Procesos Banco -->
                        <div class="card">

                            <div class="card-header" id="headingSix" onmouseover="this.style.cursor='pointer'"  data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">

                                <h2 class="mb-0">

                                    <button class="btn btn-link" type="button" style="text-decoration: none;">Bancos
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">

                                <div class="card-body">

                                    <!-- proceso laminado-->
                                    <div class="container" id="bancos" style="display:none;">

                                        <table id="" class="t-resume" style="text-align: center;">
                                            <thead style="background: steelblue;color: white;">
                                                <td style="color: white">Tipo</td>
                                                <td style="color: white">Suaje</td>
                                                <td style="color: white">Costo Unitario</td>
                                                <td style="color: white">Total</td>
                                            </thead>

                                            <tbody id="tabla_bancos">

                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Procesos Cierres -->
                        <div class="card">

                            <div class="card-header" id="headingSeven" onmouseover="this.style.cursor='pointer'"  data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">

                                <h2 class="mb-0">

                                    <button class="btn btn-link" type="button" style="text-decoration: none;">Cierres
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">

                                <div class="card-body">

                                    <div class="container" id="divCierres" style="display:none;">

                                        <table id="" class="t-resume" style="text-align: center;">

                                            <tbody id="tabla_cierres">

                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Procesos Accesorios -->
                        <div class="card">

                            <div class="card-header" id="headingEight" onmouseover="this.style.cursor='pointer'"  data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">

                                <h2 class="mb-0">

                                    <button class="btn btn-link" type="button" style="text-decoration: none;">Accesorios
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">

                                <div class="card-body">

                                    <!-- proceso laminado-->
                                    <div class="container" id="divAccesorios" style="display:none;">

                                        <table id="" class="t-resume" style="text-align: center;">

                                            <tbody id="tabla_accesorios">

                                                <!-- Aquí se registran los datos -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    
    //Activa los div de los select cierres------
    document.getElementById('SelectCieEmp').onchange = function(event) {

        var opcioncierre = document.getElementById('SelectCieEmp').value;

        $('#opCieParaPares').hide('slow');
        $('#opCieListon').hide('slow');
        $('#opCieMarialuisa').hide('slow');
        $('#opCieSuajeCalado').hide('slow');


        if (opcioncierre == 'Iman') {

            $('#opCieParaPares').show('normal');
        }


        if (opcioncierre == 'Liston') {

            $('#opCieListon').show('normal');
        }


        if (opcioncierre == 'Marialuisa') {

            $('#opCieMarialuisa').show('normal');
        }


        if (opcioncierre == 'Suaje calado') {

            $('#opCieSuajeCalado').show('normal');
        }


        if (opcioncierre == 'Velcro') {

            $('#opCieParaPares').show('normal');
        }
    }

    //Activa los div de los select bancos------
    document.getElementById('SelectBanEmp').onchange = function(event) {

        var opcionbanco = document.getElementById('SelectBanEmp').value;


        if (opcionbanco === 'Carton Suajado' || opcionbanco === 'Cartulina Suajada') {

            $('#llevasuajemodBanco').hide('normal');
        }


        if (opcionbanco === 'Carton' || opcionbanco === 'Eva' || opcionbanco === 'Espuma' || opcionbanco === 'Empalme Banco') {

            $('#llevasuajemodBanco').show('slow');
        }
    }

    document.getElementById('SelectAccesorio').onchange = function(event) {

        var opcion = document.getElementById('SelectAccesorio').value;

        $('#opColores').hide('slow');
        $('#opMedidas').hide('slow');
        $('#opHerraje').hide('slow');
        $('#opOjillo').hide('slow');


        if (opcion == 'Herraje') {

            $('#opHerraje').show('normal');
        }


        if (opcion == 'Ojillos') {

            $('#opOjillo').show('normal');
        }


        if (opcion == 'Resorte') {

            $('#opMedidas').show('normal');
            $('#opColores').show('normal');
        }


        if (opcion == 'Lengueta de Liston') {

            $('#opMedidas').show('normal');
            $('#opColores').show('normal');
        }
    }

    //vacio de select en banco, accesorios y cierres
    function vacioModalBancos() {

        document.getElementById('SelectBanEmp').value = "selected";

        document.getElementById('llevasuajemodBanco').style.display = "none";

        document.getElementById('SelectSuajeBanco').value = "No";
        document.getElementById('LargoBanco').value       = 1;
        document.getElementById('AnchoBanco').value       = 1;
        document.getElementById('ProfundidadBanco').value = 1;
    }

    function vacioModalAccesorios() {

        document.getElementById('LargoAcc').value = 1;
        document.getElementById('AnchoAcc').value = 1;

        document.getElementById('SelectAccesorio').value = "selected";
        document.getElementById('SelectHerraje').value   = "selected";
        document.getElementById('SelectColor').value     = "selected";

        $('#opColores').hide('slow');
        $('#opMedidas').hide('slow');
        $('#opHerraje').hide('slow');
        $('#opOjillo').hide('slow');
        $('#alerterror7').empty();
    }

    function cleanModError(){

        $("#modError").remove();
    }

    //eventos onclick

    $("#btnCancelAccesorios").click( function () {

        vacioModalAccesorios();
    });

    //Accesorios
    $(document).on("click", "#btnAccesorios", function () {

        var idAccesorio     = $("#SelectAccesorio option:selected").data('id');
        var precio          = $("#SelectAccesorio option:selected").data('price');
        var nombreAccesorio = $("#SelectAccesorio option:selected").text();
        var herraje         = $("#SelectHerraje option:selected").text();
        var largo           = $('#LargoAcc').val();
        var ancho           = $('#AnchoAcc').val();
        var color           = $("#opColores option:selected").text();

        var accesorio       = "";

        var alertmesserror  = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Atencion!</strong> No seleccionaste todos los elementos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        switch(nombreAccesorio) {

            case "Herraje":

                if( $("#SelectHerraje option:selected").val() != "selected") {

                    accesorio = '<tr><td style="text-align: left;">' + nombreAccesorio + '</td><td class="CellWithComment">...<span class="CellComment">Herraje: ' + herraje + '</span></td><td class="img_delete delAcc"></td></tr>';

                    var push = {"Tipo_accesorio": nombreAccesorio, "Largo": null, "Ancho": null, "Color": null, "Herraje": herraje, "Precio": precio};
                    caja.accesorio = push;

                    $('#listaccesorios').append(accesorio);

                    $('#accesorios').modal('hide');

                    vacioModalAccesorios();
                } else {

                    document.getElementById('alerterror7').innerHTML = alertmesserror;
                }
                
                break;
            case "Ojillos":

                accesorio = '<tr><td style="text-align: left;">' + nombreAccesorio + '</td><td class="img_delete delAcc"></td></tr>';

                var push = {"Tipo_accesorio": nombreAccesorio, "Largo": null, "Ancho": null, "Color": null, "Herraje": null, "Precio": precio};
                caja.accesorio = push;

                $('#listaccesorios').append(accesorio);

                $('#accesorios').modal('hide');

                vacioModalAccesorios();
                
                break;
            case "Resorte":

                if( $("#SelectColor option:selected").val() != "selected") {

                    accesorio = '<tr><td style="text-align: left;">' + nombreAccesorio +'</td><td class="CellWithComment">...<span class="CellComment">Largo: ' + largo + ' Ancho: ' + ancho + ' Color: ' + color + '</span></td><td class="img_delete delAcc"></td></tr>';

                    var push = {"Tipo_accesorio": nombreAccesorio, "Largo": largo, "Ancho": ancho, "Color": color, "Herraje": null, "Precio": precio};
                    caja.accesorio = push;

                    $('#listaccesorios').append(accesorio);

                    $('#accesorios').modal('hide');

                    vacioModalAccesorios();
                } else {

                    document.getElementById('alerterror7').innerHTML = alertmesserror;
                }
                
                break;
            case "Lengueta de Liston":

                if( $("#SelectColor option:selected").val() != "selected") {

                    accesorio = '<tr><td style="text-align: left;">' + nombreAccesorio +'</td><td class="CellWithComment">...<span class="CellComment">Largo: ' + largo + ' Ancho: ' + ancho + ' Color: ' + color + '</span></td><td class="img_delete delAcc"></td></tr>';

                    var push = {"Tipo_accesorio": nombreAccesorio, "Largo": largo, "Ancho": ancho, "Color": color, "Herraje": null, "Precio": precio};
                    caja.accesorio = push;

                    $('#listaccesorios').append(accesorio);

                    $('#accesorios').modal('hide');

                    vacioModalAccesorios();
                } else {

                    document.getElementById('alerterror7').innerHTML = alertmesserror;
                }
                
                break;
        }
        caja.desactivarBtn();
    });

    //Banco
    $(document).on('click', '#btnBancoEmp', function(event) {

        var IDopBan = $("#SelectBanEmp option:selected").data('id');
        var opBan   = $("#SelectBanEmp option:selected").text();

        var LargoMBanco       = document.getElementById('LargoBanco').value;
        var AnchoMBanco       = document.getElementById('AnchoBanco').value;
        var ProfundidadMBanco = document.getElementById('ProfundidadBanco').value;
        var LLevaSuajeM       = $("#SelectSuajeBanco option:selected").text();

        var nuloo = document.getElementById('SelectBanEmp').value;

        var alertDiv = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Atencion!</strong> No seleccionaste todos los elementos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        if (nuloo === 'selected') {

            document.getElementById('alerterror5').innerHTML = alertDiv;

        } else if (opBan === 'Carton' || opBan === 'Eva' || opBan === 'Espuma' || opBan === 'Empalme Banco') {

            document.getElementById('alerterror5').innerHTML = "";

            var ban  = '<tr><td style="text-align: left;">Banco</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ opBan +', Largo: '+ LargoMBanco +', Ancho: '+ AnchoMBanco +', Profundidad: '+ ProfundidadMBanco +', Suaje: '+ LLevaSuajeM +'</span></td><td class="img_delete delBan"></td></tr>';

            var push ={"Tipo_banco": opBan, "largo": LargoMBanco, "ancho": AnchoMBanco, "Profundidad": ProfundidadMBanco, "Suaje": LLevaSuajeM};
            caja.banco = push;

            $('#bancoemp').modal('hide');

            jQuery214('#listbancoemp').append(ban);

            vacioModalBancos();
        } else if (opBan === 'Cartulina Suajada') {

            document.getElementById('alerterror5').innerHTML = "";

            var ban  = '<tr><td style="text-align: left;">Banco</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ opBan +', Largo: '+ LargoMBanco +', Ancho: '+ AnchoMBanco +', Profundidad: '+ ProfundidadMBanco +'</span></td><td class="img_delete delBan"></td></tr>';

            var push = {"Tipo_banco": opBan, "largo": LargoMBanco, "ancho": AnchoMBanco, "Profundidad": ProfundidadMBanco, "Suaje": null};

            caja.banco = push;

            $('#bancoemp').modal('hide');

            jQuery214('#listbancoemp').append(ban);

            vacioModalBancos();
        }
        caja.desactivarBtn();
    });

    //Cierres
    $(document).on("click", "#btnCierres", function () {

        var IDopCie  = $("#SelectCieEmp option:selected").data('id');
        var opCie    = $("#SelectCieEmp option:selected").text();

        var numpares = document.getElementById('paresCierre').value;

        // para liston
        var LarListon    = document.getElementById('LargoListon').value;
        var AnchListon   = document.getElementById('AnchoListon').value;
        var tipoListon   = $("#SelectListonEmp option:selected").text();
        var colorListon  = $("#SelectColorListon option:selected").text();

        // para Suaje calado
        var LarSuajCal   = document.getElementById('LargoSCalado').value;
        var AnchSuajCal  = document.getElementById('AnchoSCalado').value;
        var tipoSuajCal  = $("#SelectSCalado option:selected").text();

        var alertmesserror = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Atencion!</strong> No seleccionaste todos los elementos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';


        if (opCie == 'Iman' || opCie == 'Velcro') {

            document.getElementById('alerterror6').innerHTML = "";

            var cie = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Numero de Pares: '+ numpares +'</span></td><td class="img_delete delCie"></td></tr>';

            var push = {"Tipo_cierre": opCie, "numpares": numpares, "largo": null, "ancho": null, "tipo": null, "color": null};
            caja.cierre = push;

            $('#cierres').modal('hide');

            $('#listcierres').append(cie);


            //vacioModalCierres();
        }


        if (opCie == 'Marialuisa') {

            document.getElementById('alerterror6').innerHTML = "";

            var cie = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Se agrego un cierre Marialuisa</span></td><td class="img_delete  delCie"></td></tr>';

            var push = {"Tipo_cierre": opCie, "numpares": 1, "largo": null, "ancho": null, "tipo": null, "color": null};
            caja.cierre = push;
            $('#cierres').modal('hide');

            $('#listcierres').append(cie);

            //vacioModalCierres();
        }


        if (opCie == 'Liston') {

            var nulo1 = document.getElementById('SelectCieEmp').value;
            var nulo2 = document.getElementById('SelectListonEmp').value;
            var nulo3 = document.getElementById('SelectColorListon').value;

            if (nulo1 == 'selected' || nulo2 == 'selected' || nulo3 == 'selected' ) {

                document.getElementById('alerterror6').innerHTML = alertmesserror;

            } else {

                document.getElementById('alerterror6').innerHTML = "";

                var cie = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Largo: '+ LarListon +', Ancho: '+ AnchListon +', Tipo: '+ tipoListon +', Color: '+ colorListon +' </span></td><td class="img_delete delCie"></td></tr>';

                var push = {"Tipo_cierre": opCie, "numpares": 1, "largo": LarListon, "ancho": AnchListon, "tipo": tipoListon, "color": colorListon};
                caja.cierre = push;

                $('#cierres').modal('hide');

                $('#listcierres').append(cie);

                //vacioModalCierres();
            }
        }


        if (opCie == 'Suaje calado') {

            var nulo1 = document.getElementById('SelectCieEmp').value;
            var nulo2 = document.getElementById('SelectSCalado').value;

            if (nulo1 == 'selected' || nulo2 == 'selected') {

                document.getElementById('alerterror6').innerHTML = alertmesserror;

            } else {

                document.getElementById('alerterror6').innerHTML = "";

                var cie = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">...<span class="CellComment">Largo: '+ LarSuajCal +', Ancho: '+ AnchSuajCal +', Tipo: '+ tipoSuajCal +'</span></td><td class="img_delete delCie"></td></tr>';

                var push = {"Tipo_cierre": opCie, "numpares": 1, "largo": LarSuajCal, "ancho": AnchSuajCal, "tipo": tipoSuajCal, "color": null};
                caja.cierre = push;
                $('#cierres').modal('hide');

                $('#listcierres').append(cie);

                //vacioModalCierres();
            }
        }
        caja.desactivarBtn();
    });

    //boton Correcto
    $("#btnModCorrecto").click( function() {

        location.href= "<?=URL?>" + "cotizador/getCotizaciones/";
    });

    jQuery214(document).on("click", "#btnDeleteDescuento", function (){
        
        $('#DescuentoDrop').html("$0.00");

        $('#descuentos').find("input:checked").prop("checked", false);

        $("#descuentoModal").html("Descuento: (0%)");
        
        caja.descuento = 0;
    });

    jQuery214(document).on("click", ".d-check", function (){

        caja.descuento = $(this).val();
        $("#descuentoModal").html("Descuento: (" + caja.descuento + "%)");
    });

    //resumen
    $(document).on('click', '#btnResumen', function(event) {

        $('#divDerecho').hide();
        $('#divIzquierdo').hide();
        $('#topCotizador').hide();
        $('#groupButton1').hide();
        $('#resumentodocaja').css("position","absolute");
        $('#resumentodocaja').show();

    }); 

    $(document).on('click', '#btnQuitarResumen', function(event) {

        $('#divDerecho').show("normal");
        $('#divIzquierdo').show();
        $('#topCotizador').show();
        $('#resumentodocaja').css("position","none");
        $('#resumentodocaja').hide();
        $('#groupButton1').show();
    });

    //boton eliminar. Es el que hace la magia ;)
    jQuery214(document).on("click", ".delete", function () {
        
        $(this).closest('table').find('tr').each(function(e){

            $(this).data('len',e);
        });

        var index = $(this).closest('tr').data('len');
        var tabla = $(this).closest('tr').parent().prop('id');

        caja.delBtnSec(tabla,index);
        $(this).closest('tr').remove();
    });

    jQuery214(document).on("click", ".delAcc", function () {
        
        $(this).closest('table').find('tr').each(function(e){

            $(this).data('len',e);
        });

        var index = $(this).closest('tr').data('len');
        caja.delBtnAcc(index);
        $(this).closest('tr').remove();
    });

    jQuery214(document).on("click", ".delCie", function () {
        
        $(this).closest('table').find('tr').each(function(e){

            $(this).data('len',e);
        });

        var index = $(this).closest('tr').data('len');
        caja.delBtnCie(index);
        $(this).closest('tr').remove();
    });

    jQuery214(document).on("click", ".delBan", function () {
        
        $(this).closest('table').find('tr').each(function(e){

            $(this).data('len',e);
        });

        var index = $(this).closest('tr').data('len');
        caja.delBtnBan(index);
        $(this).closest('tr').remove();
    });
</script>