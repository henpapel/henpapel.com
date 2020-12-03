
// matriz de Impresiones
var aImpEC  = [];
var aImpFC  = [];
var aImpET  = [];
var aImpFT  = [];

// matriz de acabados
var aAcbEC  = [];
var aAcbFC  = [];
var aAcbET  = [];
var aAcbFT  = [];

// matriz de cierres y accesorios y bancos
var aCierres    = [];
var aAccesorios = [];
var aBancos     = [];

//se aloja las impresiones o acabados. No borrar.
var divisionesImps = "";
var divisionesAcbs = "";

//para descuento
var descuento = 0;

var cliente = "";
var url     = "";

jQuery214(".chosen").chosen();

function appndPapeles(arrPapel, seccion){

    var sec = "";
    if( arrPapel[seccion] == undefined || arrPapel[seccion] == null ) return false;

    var nombreP      = arrPapel[seccion]['nombre'];
    var ancho        = arrPapel[seccion]['corte_ancho'];
    var largo        = arrPapel[seccion]['corte_largo'];
    var cortes       = arrPapel[seccion]['cortes'];
    var totalPliegos = arrPapel[seccion]['costo_tot_pliegos'];
    var costoTotal   = parseFloat(arrPapel[seccion]['costo_unitario']);
    var titulo       = "";

    if (nombreP == undefined ) {
        
        var nombreP      = arrPapel[seccion]['nombre'];
        var ancho      = arrPapel[seccion]['ancho'];
        var largo      = arrPapel[seccion]['largo'];
        var cortes       = arrPapel[seccion]['cortes'];
        var totalPliegos = arrPapel[seccion]['pliegos'];
        var costoTotal   = parseFloat(arrPapel[seccion]['costo_tot_pliegos']);
    }

    switch(seccion){

        case "papel_Emp":

            titulo = "Empalme cajon";
            sec = "EC";
        break;

        case "papel_FCaj":

            titulo = "Forro del cajon";
            sec = "FC";
        break;

        case "papel_EmpTap":

            titulo = "Empalme tapa";
            sec = "ET";
        break;

        case "papel_FTap":

            titulo = "Forro Tapa";
            sec = "FT";
        break;
    }

    var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr><td>Material</td><td>'+ nombreP +'</td></tr><tr><td>Cortes Aplicados</td><td>Largo: '+ largo +' Ancho: '+ ancho +'</td></tr><tr><td>Piezas por Hoja</td><td>'+ cortes +'</td></tr><tr><td>Hojas necesarias (sin merma)</td><td>'+ totalPliegos +'</td></tr><tr><td>Costo Total</td><td>$'+ costoTotal +'<input type="hidden" class="prices" value="' + costoTotal + '"></td></tr>';

    $('#table_papeles_tr').append(tr);

    var trResumen = '<tr><td></td><td>Papel '+ nombreP +'</td><td>$'+ costoTotal +'<input type="hidden" class="pricesresumenempalme" value="' + costoTotal + '"></td><td></td></tr>';

    $('#resumen'+sec).append(trResumen);
}

function chkPaper(){

    var chk   =$("#btnCheckPaper").prop("checked");
    //este id se genera con el plugin chosen
    var texto = $("#optEC_chosen span").html();

    if(chk) {

        $("#optEC_chosen span").html(texto);
        $("#optFC_chosen span").html(texto);
        $("#optET_chosen span").html(texto);
        $("#optFT_chosen span").html(texto);

        $("#optEC option[data-nombre='" + texto +"']").prop("selected",true);
        $("#optFC option[data-nombre='" + texto +"']").prop("selected",true);
        $("#optET option[data-nombre='" + texto +"']").prop("selected",true);
        $("#optFT option[data-nombre='" + texto +"']").prop("selected",true);
    } else {

        $("#optFC_chosen span").html("Elegir tipo de papel");
        $("#optET_chosen span").html("Elegir tipo de papel");
        $("#optFT_chosen span").html("Elegir tipo de papel");

        $("#optFC option[data-nombre='" + texto +"']").prop("selected",false);
        $("#optET option[data-nombre='" + texto +"']").prop("selected",false);
        $("#optFT option[data-nombre='" + texto +"']").prop("selected",false);
    }
}

function setURL( url ){

    this.url = url;
}

function emptyTables(){

    $('#table_adicionales_tr').empty();
    $('#resumenEC').empty();
    $('#resumenFC').empty();
    $('#resumenET').empty();
    $('#resumenFT').empty();
    $('#resumenCartones').empty();
    $('#resumenOtros').empty();
    $("#resumenHead").empty();
    $("#resumenMensajeria").empty();
    $("#resumenEmpaque").empty();
    $('#resumenEncuadernacion').empty();
    $('#table_papeles_tr').empty();
    $('#proceso_offset_M1').hide();
    $('#proceso_serigrafia_M1').hide();
    $('#proceso_digital_M1').hide();
    $('#table_proc_offset').empty();
    $('#table_proc_serigrafia').empty();
    $('#table_proc_digital').empty();
    $('#proceso_hs_M1').hide();
    $('#proceso_grab_M1').hide();
    $('#proceso_lam_M1').hide();
    $('#proceso_suaje_M1').hide();
    $('#proceso_laser_M1').hide();
    $('#proceso_barnizuv_M1').hide();
    $('#table_proc_HS').empty();
    $('#table_proc_Grab').empty();
    $('#table_proc_Lam').empty();
    $('#table_proc_Suaje').empty();
    $('#table_proc_Laser').empty();
    $('#table_proc_BarnizUV').empty();
    $('#bancos').hide();
    $('#tabla_bancos').empty();
    $('#resumenBancos').empty();
    $('#divCierres').hide();
    $('#tabla_cierres').empty();
    $('#resumenCierres').empty();
    $('#divAccesorios').hide();
    $('#tabla_accesorios').empty();
    $('#resumenAccesorios').empty();
}

//funciona para decir a que tabla se apendizara
function setTableBtn(texto, impAcb){

    switch(texto){

        case "EC":
            return 'list'+impAcb+'EC';
        break;

        case "FC":
            return 'list'+impAcb+'FC';
        break;

        case "ET":
            return 'list'+impAcb+'ET';
        break;

        case "FT":
            return 'list'+impAcb+'FT';
        break;
    }
}

function revisarImpAcb(){

    if( aImpEC.length == 0 && aImpFC.length == 0 && aImpET.length == 0 && aImpFT.length == 0 && aAcbEC.length == 0 && aAcbFC.length == 0 && aAcbET.length == 0 && aAcbFT.length == 0 ){

        showModError("");
        $("#txtContenido").html();
        $("#txtContenido").html("Ingrese por lo menos un proceso");
        return false;
    }
}

function appndImp( aImp, lblaImp ){

    if ( aImp == undefined ) return false;
    if ( aImp['Offset'] !== undefined ) var offset        = aImp['Offset'];
    if ( aImp['Maquila'] !== undefined ) var offsetMaquila = aImp['Maquila'];
    if ( aImp['Digital'] !== undefined ) var digital       = aImp['Digital'];
    if ( aImp['Serigrafia'] !== undefined )var serigrafia    = aImp['Serigrafia'];
    
    var titulo        = insrtTitulo(lblaImp);
    var tabla         = "";

    if( offset ){

        for( var i = 0; i < offset.length; i++ ){

            var cantidad  = offset[i]['cantidad'];
            var tintas    = offset[i]['num_tintas'];
            var tipo      = offset[i]['tipo_offset'];
            var cULam     = offset[i]['costo_unitario_laminas'];
            var cTLam     = offset[i]['costo_tot_laminas'];
            var cUArr     = offset[i]['costo_unitario_arreglo'];
            var cTArr     = offset[i]['costo_tot_arreglo'];
            var cUTir     = offset[i]['costo_unitario_tiro'];
            var cTTir     = offset[i]['costo_tiro'];
            var total     = parseFloat(offset[i]['costo_tot_proceso']);

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ cULam +'</td><td>$'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                $('#table_proc_offset').append(tr);
                $('#proceso_offset_M1').show();

                var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                $('#resumen'+lblaImp).append(trResumen);
        }
    }else{

        if( offsetMaquila !== undefined ){

            for( var i = 0; i < offsetMaquila.length; i++ ){
                
                var cantidad  = offsetMaquila[i]['cantidad'];
                var tintas    = offsetMaquila[i]['num_tintas'];
                var tipo      = offsetMaquila[i]['Tipo'];
                var cULam     = offsetMaquila[i]['costo_unitario_laminas'];
                var cTLam     = offsetMaquila[i]['costo_laminas'];
                var cUArr     = offsetMaquila[i]['arreglo_costo_unitario'];
                var cTArr     = offsetMaquila[i]['arreglo_costo'];
                var total     = parseFloat(offsetMaquila[i]['costo_tot_proceso']);

                var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + ' - Maquila</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>'+ cULam +'</td><td>'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                $('#table_proc_offset').append(tr);

                $('#proceso_offset_M1').show();

                var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                $('#resumen'+lblaImp).append(trResumen);
            }
        }
    }

    if( digital ){

        for( var i = 0; i < digital.length; i++ ){

            var cantidad = digital[i]['cantidad'];
            var cUDig    = digital[i]['costo_unitario'];
            var cTDig    = digital[i]['costo_tot_proceso'];
            var cabe     = digital[i]['cabe_digital'];
            if ( cabe == "NO" ){

                var tr = '';
            }else{

                var tr = '<tr><td colspan="4" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Costo Total</td></tr><tr><td>'+ cantidad +'</td><td>$'+ cUDig +'</td><td>$'+ cTDig +'</td></tr><tr><td colspan="4"></td></tr>';
            }
            
            $('#table_proc_digital').append(tr);

            $('#proceso_digital_M1').show();

            var trResumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ cTDig +'<input type="hidden" class="pricesresumenempalme" value="'+ cTDig +'"></td><td></td></tr>';

            $('#resumen'+lblaImp).append(trResumen);
        }
    }

    if( serigrafia ){

        for( var i = 0; i < serigrafia.length; i++ ){

            var cantidad  = serigrafia[i]['cantidad'];
            var tintas    = serigrafia[i]['num_tintas'];
            var tipo      = serigrafia[i]['tipo'];
            var cUArr     = serigrafia[i]['costo_unit_arreglo'];
            var cTArr     = serigrafia[i]['costo_arreglo'];
            var cUTir     = serigrafia[i]['costo_unitario_tiro'];
            var cTTir     = serigrafia[i]['costo_tiro'];
            var total     = parseFloat(serigrafia[i]['costo_tot_proceso']);

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_serigrafia').append(tr);

            $('#proceso_serigrafia_M1').show();

            var trResumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaImp).append(trResumen);
        }
    }
}

/*la funcion appndImp con 3 argumentos es para la modificación y apendizacion
del mismo*/
function appndImpMod( aImp, lblaImp, arrPrincipal ){


    if ( aImp == undefined ) return false;
    if ( aImp['Offset'] !== undefined ) var offset        = aImp['Offset'];
    if ( aImp['maquila'] !== undefined ) var offsetMaquila = aImp['maquila'];
    if ( aImp['Digital'] !== undefined ) var digital       = aImp['Digital'];
    if ( aImp['Serigrafia'] !== undefined )var serigrafia    = aImp['Serigrafia'];
    
    var titulo        = insrtTitulo(lblaImp);
    var tabla         = "";
    tabla = setTableBtn(lblaImp,'Imp');

    if( offset ){

        for( var i = 0; i < offset.length; i++ ){

            var cantidad  = offset[i]['cantidad'];
            var tintas    = offset[i]['num_tintas'];
            var tipo      = offset[i]['tipo_offset'];
            var cULam     = offset[i]['costo_unitario_laminas'];
            var cTLam     = offset[i]['costo_tot_laminas'];
            var cUArr     = offset[i]['costo_unitario_arreglo'];
            var cTArr     = offset[i]['costo_tot_arreglo'];
            var cUTir     = offset[i]['costo_unitario_tiro'];
            var cTTir     = offset[i]['costo_tiro'];

            if( cTTir == undefined ) {

                cTTir = offset[i]['costo_tot_tiro'];
                tipo  = offset[i]['tipo'];

                id =0;
            }
            
            var imp  = '<tr><td class="textImp">Offset</td><td style="display: none">'+ id +'<input name="IDopImpSerEmp" style="display:none" type="hidden" value="'+ id +'"></td><td class="CellWithComment">...<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="tintasImp" style="display: none;">'+ tintas +'<input name="tintasselSerEmp" type="hidden" value="'+ tintas +'"></td><td class="tipoSeri" style="display: none;">'+ tipo +'<input name="tipoSeriEmp" type="hidden" value="'+ id +'"></td><td class="' + tabla +' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_impresion": "Offset", "tintas": tintas, "tipo_offset": tipo, "IDopImp": id, "idtipoOff": id});

            $("#"+tabla).append(imp);

            var total     = parseFloat(offset[i]['costo_tot_proceso']);

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>'+ cULam +'</td><td>'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr><td>Tiro</td><td>'+ cUTir +'</td><td>'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ total +'"></td></tr><tr><td colspan="3"></td></tr>';

                $('#table_proc_offset').append(tr);

                $('#proceso_offset_M1').show();

                var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                $('#resumen'+lblaImp).append(trResumen);
        }
    }else{

        if( offsetMaquila !== undefined ){

            for( var i = 0; i < offsetMaquila.length; i++ ){
                
                var cantidad  = offsetMaquila[i]['cantidad'];
                var tintas    = offsetMaquila[i]['num_tintas'];
                var tipo      = offsetMaquila[i]['Tipo'];
                var cULam     = offsetMaquila[i]['costo_unitario_laminas'];
                var cTLam     = offsetMaquila[i]['costo_laminas'];
                var cUArr     = offsetMaquila[i]['arreglo_costo_unitario'];
                var cTArr     = offsetMaquila[i]['arreglo_costo'];
                var total     = parseFloat(offsetMaquila[i]['costo_tot_proceso']);

                var imp  = '<tr><td class="textImp">Offset</td><td style="display: none">'+ id +'<input name="IDopImpSerEmp" style="display:none" type="hidden" value="'+ id +'"></td><td class="CellWithComment">...<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="tintasImp" style="display: none;">'+ tintas +'<input name="tintasselSerEmp" type="hidden" value="'+ tintas +'"></td><td class="tipoSeri" style="display: none;">'+ tipo +'<input name="tipoSeriEmp" type="hidden" value="'+ id +'"></td><td class="' + tabla +' img_delete"></td></tr>';

                arrPrincipal.push({"Tipo_impresion": "Offset", "tintas": tintas, "tipo_offset": tipo, "IDopImp": id, "idtipoOff": id});

                $("#"+tabla).append(imp);

                var total     = parseFloat(offset[i]['costo_tot_proceso']);

                var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>'+ cULam +'</td><td>'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                $('#table_proc_offset').append(tr);

                $('#proceso_offset_M1').show();

                var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'</td><td></td></tr>';

                $('#resumen'+lblaImp).append(trResumen);
            }
        }
    }

    if( digital ){

        for( var i = 0; i < digital.length; i++ ){

            var cantidad = digital[i]['cantidad'];
            var cUDig    = digital[i]['costo_unitario'];
            var cTDig    = digital[i]['costo_tot_proceso'];
            var cabe     = digital[i]['cabe_digital'];

            if( cantidad == undefined ){

                cantidad = digital[i]['tiraje'];
                tipo     = digital[i]['impresion'];
                id = 0;
            }

            var imp  = '<tr><td class="textImp">Digital</td><td style="display: none"><input  name="IDopImpDiEmp" type="hidden" value="'+ id +'"></td><td class="CellWithComment" >...<span class="CellComment">Tipo: ' + tipo + '</span></td><td class="tipoDig" style="display: none;">'+ tipo +'<input name="tipoDigEmp" type="hidden" value="'+ id +'"></td><td class="' + tabla +' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_impresion": "Digital", "tipo_digital": tipo, "idtipoDig": id});

            $("#"+tabla).append(imp);

            if ( cabe == "NO" ){

                var tr = '';
            }else{

                var tr = '<tr><td colspan="4" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Costo Total</td></tr><tr><td>'+ cantidad +'</td><td>'+ cUDig +'</td><td>$'+ cTDig +'<input type="hidden" class="prices" value=" '+ cTDig +'"></td></tr><tr><td colspan="4"></td></tr>';
            }
            

            $('#table_proc_digital').append(tr);

            $('#proceso_digital_M1').show();

            var trResumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ cTDig +'<input type="hidden" class="pricesresumenempalme" value="'+ cTDig +'"></td><td></td></tr>';

            $('#resumen'+lblaImp).append(trResumen);
        }
    }

    if( serigrafia ){

        for( var i = 0; i < serigrafia.length; i++ ){

            var cantidad  = serigrafia[i]['cantidad'];
            var tintas    = serigrafia[i]['num_tintas'];
            var tipo      = serigrafia[i]['tipo'];
            var cUArr     = serigrafia[i]['costo_unit_arreglo'];
            var cTArr     = serigrafia[i]['costo_arreglo'];
            var cUTir     = serigrafia[i]['costo_unitario_tiro'];
            var cTTir     = serigrafia[i]['costo_tiro'];
            var total     = parseFloat(serigrafia[i]['costo_tot_proceso']);


            if( cantidad == undefined ){

                cantidad = serigrafia[i]['tiraje'];
                cUTir    = serigrafia[i]['costo_unitario_tiro'];
                cUTir    = serigrafia[i]['costo_unit_tiro'];
                id       = 0;
            }

            var imp  = '<tr><td class="textImp">Serigrafia</td><td style="display: none">'+ id +'<input name="IDopImpSerEmp" style="display:none" type="hidden" value="'+ id +'"></td><td class="CellWithComment">...<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="tintasImp" style="display: none;">'+ tintas +'<input  name="tintasselSerEmp" type="hidden" value="'+ tintas +'"></td><td class="tipoSeri" style="display: none;">'+ tipo +'<input name="tipoSeriEmp" type="hidden" value="'+ id +'"></td><td class="' + tabla +' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_impresion": "Serigrafia",  "tintas": tintas, "tipo_offset": tipo, "IDopImp": id, "idtipoSeri": id});
            $("#"+tabla).append(imp);

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr><td>Tiro</td><td>'+ cUTir +'</td><td>'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ total +'"></td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_serigrafia').append(tr);

            $('#proceso_serigrafia_M1').show();

            var trResumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaImp).append(trResumen);
        }
    }
}


function insrtTitulo(lbl){

    var titulo = "";

    switch( lbl ){

        case "EC":

            titulo = "Empalme Cajón";
        break;

        case "FC":

            titulo = "Forro Cajón";
        break;

        case "ET":
        
            titulo = "Empalme Tapa";
        break;

        case "FT":
        
            titulo = "Forro Tapa";
        break;
    }

    return titulo;
}

function appndAcb( aAcb, lblaAcb ){

    var arrAcbTmp =[];

    var titulo = insrtTitulo(lblaAcb);

    if ( aAcb == undefined ) return false;

    var barniz      = aAcb['Barniz_UV'];
    var laser       = aAcb['Corte_Laser'];
    var grabado     = aAcb['Grabado'];
    var hotStamping = aAcb['HotStamping'];
    var laminado    = aAcb['Laminado'];
    var suaje       = aAcb['Suaje'];

    if ( barniz !== undefined ) {

        for (var i = 0; i < barniz.length ; i++) {

            var nombre = "Barniz UV";
            var tipo   = barniz[i]['tipoGrabado'];
            var largo  = barniz[i]['Largo'];
            var ancho  = barniz[i]['Ancho'];
            var cUnitario  = barniz[i]['costo_unitario'];
            var total  = barniz[i]['costo_tot_proceso'];

            var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';

            $('#table_proc_BarnizUV').append(tr);

            $('#proceso_barnizuv_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);
        }   
    }

    if ( laser !== undefined ) {

        //arrAcbTmp[i++]['nombre']     = "Laser";
        for (var i = 0; i < laser.length ; i++) {

            var nombre = "Corte Laser";
            var tipo   = laser[i]['tipo_grabado'];
            var largo  = laser[i]['Largo'];
            var ancho  = laser[i]['Ancho'];
            var cUnitario  = laser[i]['costo_unitario'];
            var total  = laser[i]['costo_tot_proceso'];

            var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo + 'x' + ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';
            
            $('#table_proc_Laser').append(tr);

            $('#proceso_laser_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);
        }
    }

    if ( grabado !== undefined ) {

        for (var i = 0; i < grabado.length ; i++) {

            var nombre    = "Grabado";
            var tipo      = grabado[i]['tipoGrabado'];
            var largo     = grabado[i]['Largo'];
            var ancho     = grabado[i]['Ancho'];
            var ubicacion = grabado[i]['ubicacion'];
            var cUPlaca   = grabado[i]['placa_costo_unitario'];
            var cTPlaca   = grabado[i]['placa_costo'];
            var cUArr     = grabado[i]['arreglo_costo_unitario'];
            var cTArr     = grabado[i]['arreglo_costo'];
            var total     = grabado[i]['costo_tot_proceso'];
            var cUTir     = grabado[i]['costo_unitario'];
            var cTTir     = grabado[i]['costo_tiro'];

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td><td>Ubicacion: '+ ubicacion +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>$'+ cUPlaca +'</td><td>$'+ cTPlaca +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_Grab').append(tr);

            $('#proceso_grab_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);

        }
    }

    if ( hotStamping !== undefined ) {

        for (var i = 0; i < hotStamping.length ; i++) {

            var nombre    = "Hot Stamping";
            var tipo      = hotStamping[i]['tipoGrabado'];
            var largo     = hotStamping[i]['Largo'];
            var ancho     = hotStamping[i]['Ancho'];
            var color     = hotStamping[i]['Color'];
            //var ubicacion = aAcb['HotStamping'][i]['ubicacion'];
            var cUPlaca   = hotStamping[i]['placa_costo_unitario'];
            var cTPlaca   = hotStamping[i]['placa_costo'];
            var cUPel     = hotStamping[i]['pelicula_costo_unitario'];
            var cTPel     = hotStamping[i]['pelicula_costo'];
            var cUArr     = hotStamping[i]['arreglo_costo_unitario'];
            var cTArr     = hotStamping[i]['arreglo_costo'];
            var total     = hotStamping[i]['costo_tot_proceso'];
            var cUTir     = hotStamping[i]['costo_unitario'];
            var cTTir     = hotStamping[i]['costo_tiro'];

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Color: '+ color +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>$'+ cUPlaca +'</td><td>$'+ cTPlaca +'</td></tr><tr><td>Pelicula</td><td>$'+ cUPel +'</td><td>$'+ cTPel +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_HS').append(tr);

            $('#proceso_hs_M1').show();

            var trResumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);  
        }
    }

    if ( laminado !== undefined ) {

        for (var i = 0; i < laminado.length ; i++) {

            var nombre    = "Laminado";
            var tipo      = laminado[i]['tipoGrabado'];
            var largo     = laminado[i]['Largo'];
            var ancho     = laminado[i]['Ancho'];
            var total     = laminado[i]['costo_tot_proceso'];
            var costo     = laminado[i]['costo_unitario'];

            var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ costo +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';

            $('#table_proc_Lam').append(tr);

            $('#proceso_lam_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);
        }
    }

    if ( suaje !== undefined ) {

        for (var i = 0; i < suaje.length ; i++) {

            var nombre    = "Suaje";
            var tipo      = suaje[i]['tipoGrabado'];
            var largo     = suaje[i]['Largo'];
            var ancho     = suaje[i]['Ancho'];
            var total     = suaje[i]['costo_tot_proceso'];
            var costo     = suaje[i]['costo_unitario'];
            var cUArr     = suaje[i]['costo_unitario_arreglo'];
            var cTArr     = suaje[i]['arreglo'];
            var cUTir     = suaje[i]['tiro_costo_unitario'];
            var cTTir     = suaje[i]['costo_tiro'];

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_Suaje').append(tr);

            $('#proceso_suaje_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen );      
        }
    }
}

function appndAcbMod( aAcb, lblaAcb, arrPrincipal ){

    if ( aAcb == undefined ) return false;
    
    var barniz      = aAcb['Barniz'];
    var laser       = aAcb['Laser'];
    var grabado     = aAcb['Grabado'];
    var hotStamping = aAcb['HotStamping'];
    var laminado    = aAcb['Laminado'];
    var suaje       = aAcb['Suaje'];

    var titulo = insrtTitulo(lblaAcb);
    var tabla = setTableBtn(lblaAcb,'Acb');

    if ( barniz !== undefined ) {

        for (var i = 0; i < barniz.length ; i++) {

            var nombre    = "Barniz UV";
            var tipo      = barniz[i]['tipo_grabado'];
            var largo     = barniz[i]['largo'];
            var ancho     = barniz[i]['ancho'];
            var cUnitario = barniz[i]['costo_unitario'];
            var total     = barniz[i]['costo_tot_proceso'];

            if(tipo == "Registro Mate" || tipo == "Registro Brillante") {

                var tr  = '<tr id="AcBarnizUVEmp"><td style="text-align: left;" class="textAcb">' + nombre +'</td><td class="CellWithComment">...<span class="CellComment">Tipo: ' +  tipo + ', Medidas: ' + largo + 'x' + ancho +'</span></td><td style="display: none">' + tipo + '</td><td style="display: none">' + largo + '</td><td style="display: none">' + ancho + '</td><td class="' + tabla + ' img_delete"></td></tr>';

                arrPrincipal.push({"Tipo_acabado": nombre, "tipoGrabado": tipo, "Largo": largo, "Ancho": ancho});
            } else {

                var tr  = '<tr id="AcBarnizUVEmp"><td style="text-align: left;" class="textAcb">' + nombre +'</td><td class="CellWithComment">...<span class="CellComment">Tipo: ' +  tipo + '</span></td><td style="display: none">' + tipo + '</td><td class="' + tabla + ' img_delete"></td></tr>';

                arrPrincipal.push({"Tipo_acabado": nombre, "tipoGrabado": tipo, "Largo": null, "Ancho": null});
            }

            $('#' + tabla).append(tr);

            var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ total +'"></td></tr><tr><td colspan="2"></td></tr>';

            $('#table_proc_BarnizUV').append(tr);

            $('#proceso_barnizuv_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);
        }   
    }

    if ( laser !== undefined ) {

        for (var i = 0; i < laser.length ; i++) {

            var nombre = "Corte Laser";
            var tipo   = laser[i]['tipo_grabado'];
            var largo  = laser[i]['largo'];
            var ancho  = laser[i]['ancho'];
            var cUnitario  = laser[i]['costo_unitario'];
            var total  = laser[i]['costo_tot_proceso'];
            var opAcb = "Corte Laser";
            var acb = '<tr id="AcLaserEmp"><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">...<span class="CellComment">Tipo: ' + tipo + ', Medidas: ' + largo + 'x' +  ancho + '</span></td><td class="tipoLaser" style="display: none;">' + tipo + '</td><td class="LargoLaser" style="display: none;">' + largo + '</td><td class="AnchoLaser" style="display: none;">' + ancho + '</td><td class="' + tabla + ' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo, "LargoLaser": largo, "AnchoLaser": ancho});

            jQuery214('#' + tabla).append(acb);

            var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo + 'x' + ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ cUnitario +'"></td></tr><tr><td colspan="2"></td></tr>';
            
            $('#table_proc_Laser').append(tr);

            $('#proceso_laser_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);
        }
    }

    if ( grabado !== undefined ) {

        for (var i = 0; i < aAcb['Grabado'].length ; i++) {

            var nombre    = "Grabado";
            var tipo      = grabado[i]['tipo_grabado'];
            var largo     = grabado[i]['largo'];
            var ancho     = grabado[i]['ancho'];
            var ubicacion = grabado[i]['ubicacion'];
            var cUPlaca   = grabado[i]['placa_costo_unitario'];
            var cTPlaca   = grabado[i]['placa_costo'];
            var cUArr     = grabado[i]['arreglo_costo_unitario'];
            var cTArr     = grabado[i]['arreglo_costo'];
            var total     = grabado[i]['costo_tot_proceso'];
            var cUTir     = grabado[i]['costo_unitario'];
            var cTTir     = grabado[i]['costo_tiro'];

            var tr  = '<tr id="AcGrabEmp"><td style="text-align: left;" class="textAcb">' + nombre +'</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ tipo +', Medidas: '+ largo +'x'+ ancho +', Ubicacion: '+ ubicacion +'</span></td><td style="display: none;">'+ tipo +'</td><td style="display: none;">'+ largo +'</td><td style="display: none;">'+ ancho +'</td><td style="display: none;">'+ ubicacion +'</td><td class="' + tabla + ' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_acabado": nombre, "tipoGrabado": tipo, "Largo": largo, "Ancho": ancho, "ubicacion": ubicacion});

            $('#' + tabla).append(tr);

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td><td>Ubicacion: '+ ubicacion +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>'+ cUPlaca +'</td><td>'+ cTPlaca +'</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr><td>Tiro</td><td>'+ cUTir +'</td><td>'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ total +'"></td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_Grab').append(tr);

            var trResumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);

        }
    }

    if ( hotStamping !== undefined ) {

        for (var i = 0; i < hotStamping.length ; i++) {

            var nombre    = "Hot Stamping";
            var tipo      = hotStamping[i]['tipo_grabado'];
            var largo     = hotStamping[i]['largo'];
            var ancho     = hotStamping[i]['ancho'];
            var color     = hotStamping[i]['color'];
            var cUPlaca   = hotStamping[i]['placa_costo_unitario'];
            var cTPlaca   = hotStamping[i]['placa_costo'];
            var cUPel     = hotStamping[i]['pelicula_costo_unitario'];
            var cTPel     = hotStamping[i]['pelicula_costo'];
            var cUArr     = hotStamping[i]['arreglo_costo_unitario'];
            var cTArr     = hotStamping[i]['arreglo_costo'];
            var total     = hotStamping[i]['costo_tot_proceso'];
            var cUTir     = hotStamping[i]['costo_unitario'];
            var cTTir     = hotStamping[i]['costo_tiro'];
            var opAcb     = "HotStamping";

            var tr  = '<tr id="AcHSEmp"><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ tipo +', Color: '+ color +', Medidas: '+ largo +'x'+ ancho +'</span></td><td style="display: none;" >'+ tipo +'</td><td style="display: none;" ></td><td style="display: none;" >' + color + '</td><td style="display: none;">'+ largo +'</td><td style="display: none;">'+ ancho +'</td><td class="' + tabla + ' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo, "ColorHS": color, "LargoHS": largo, "AnchoHS": ancho});

            $('#' + tabla).append(tr);

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Color: '+ color +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>'+ cUPlaca +'</td><td>'+ cTPlaca +'</td></tr><tr><td>Pelicula</td><td>'+ cUPel +'</td><td>'+ cTPel +'</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr><td>Tiro</td><td>'+ cUTir +'</td><td>'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ total +'"></td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_HS').append(tr);

            $('#proceso_hs_M1').show();

            var trResumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);  
        }
    }

    if ( laminado !== undefined ) {

        for (var i = 0; i < laminado.length ; i++) {

            var nombre    = "Laminado";
            var tipo      = laminado[i]['tipo_grabado'];
            var largo     = laminado[i]['largo'];
            var ancho     = laminado[i]['ancho'];
            var total     = laminado[i]['costo_tot_proceso'];
            var costo     = laminado[i]['costo_unitario'];

            var tr  = '<tr id="AcLamEmp"><td style="text-align: left;" class="textAcbEmp">' + nombre +'</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ tipo +'</span></td><td class="tipoLamEmp" style="display: none">'+ tipo +'</td><td class="' + tabla + ' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_acabado": nombre, "tipo": tipo});

            jQuery214('#' + tabla).append(tr);

            var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ costo +'</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ total +'"></td></tr><tr><td colspan="2"></td></tr>';

            $('#table_proc_Lam').append(tr);

            $('#proceso_lam_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen);    
        }
    }

    if ( suaje !== undefined ) {

        for (var i = 0; i < aAcb['Suaje'].length ; i++) {

            var nombre    = "Suaje";
            var tipo      = suaje[i]['tipo_grabado'];
            var largo     = suaje[i]['largo'];
            var ancho     = suaje[i]['ancho'];
            var total     = suaje[i]['costo_tot_proceso'];
            var costo     = suaje[i]['costo_unitario'];
            var cUArr     = suaje[i]['costo_unitario_arreglo'];
            var cTArr     = suaje[i]['arreglo'];
            var cUTir     = suaje[i]['tiro_costo_unitario'];
            var cTTir     = suaje[i]['costo_tiro'];

            var tr  = '<tr id="AcSuajeEmp"><td style="text-align: left;" class="textAcb">' + nombre +'</td><td class="CellWithComment">...<span class="CellComment">Tipo: '+ tipo +', Medidas: '+ largo +'x'+ ancho +'</span></td><td style="display: none;">'+ tipo +'</td><td style="display: none;">'+ largo +'</td><td style="display: none;">'+ ancho +'</td><td class="' + tabla + ' img_delete"></td></tr>';

            arrPrincipal.push({"Tipo_acabado": nombre, "tipoGrabado": tipo, "LargoSuaje": largo, "AnchoSuaje": ancho});

            $('#acabados').modal('hide');

            $('#' + tabla).append(tr);

            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr><td>Tiro</td><td>'+ cUTir +'</td><td>'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'<input type="hidden" class="prices" value="'+ total +'"></td></tr><tr><td colspan="3"></td></tr>';

            $('#table_proc_Suaje').append(tr);

            $('#proceso_suaje_M1').show();

            var trResumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

            $('#resumen'+lblaAcb).append(trResumen );      
        }
    }
}

function appndPapelCarton(arrPrincipal, arrPapel, parte ){

    if (  arrPapel == "" ||  arrPapel == undefined ) return false;

    var nombre        = arrPapel['nombre_papel'];
    var ancho         = arrPapel['calculadora']['corte_ancho'];
    var largo         = arrPapel['calculadora']['corte_largo'];
    var costoUnitario = arrPapel['costo_unit_papel'];
    var costoTotal    = arrPapel['tot_costo'];
    var corte         = arrPapel['corte'];
    var pliegos       = arrPapel['tot_pliegos'];

    var tr = '<tr><td>' + parte + '</td><td>' + nombre + '</td><td>$' + costoUnitario + '</td><td>Largo: ' + largo + ' Ancho: ' + ancho + '</td><td>' + corte + '</td><td>' + pliegos + '</td><td>$' + costoTotal + '<input type="hidden" class="prices" value="' + costoTotal + '"></td></tr>';

    $('#table_papeles_tr').append(tr);

    var trResumen = '<tr><td></td><td>Papel '+ nombre +'</td><td>$'+ costoTotal +'</td><td></td></tr>';
    var tabla = "";
    switch( parte ){

        case "Cartón Cajón":
            tabla = "EC";
            trResumen = '<tr><td></td><td>'+ nombre +'</td><td>$'+ costoTotal +'</td><td></td></tr>';
        break;
        case "Empalme Cajón":
            tabla = "EC";
            var precioEnc = arrPrincipal['encuadernacion']['costo_tot_proceso'];
            var trEnc = "<tr><td></td><td>Encuadernación</td><td>$" + precioEnc + "</td><td></td></tr>";
            $('#resumen'+tabla).append(trEnc);
        break;
        case "Forro Cajón":
            tabla = "FC";
            var precioElab = arrPrincipal['elab_FCaj']['costo_tot_proceso'];
            var trElab = "<tr><td></td><td>Elaboración</td><td>$" + precioElab + "</td><td></td></tr>";
            $('#resumen'+tabla).append(trElab);
            
            var precioRanurado = arrPrincipal['ranurado']['costo_tot_proceso'];
            var trRan = "<tr><td></td><td>Ranurado</td><td>$" + precioRanurado + "</td><td></td></tr>";
            $('#resumen'+tabla).append(trRan);

            var precioEnc = arrPrincipal['encuadernacion']['costo_tot_proceso'];
            var trEnc = "<tr><td></td><td>Encuadernación</td><td>$" + precioEnc + "</td><td></td></tr>";
            $('#resumen'+tabla).append(trEnc);
        break;
        case "Empalme Tapa":
            tabla = "ET";
        break;
        case "Carton Tapa":
            tabla = "ET";
            trResumen = '<tr><td></td><td>'+ nombre +'</td><td>$'+ costoTotal +'</td><td></td></tr>';
        break;
        case "Forro Tapa":
            tabla = "FT";
            var precioElab = arrPrincipal['elab_FTap']['costo_tot_proceso'];
            var trElab = "<tr><td></td><td>Elaboración</td><td>$" + precioElab + "</td><td></td></tr>";
            $('#resumen'+tabla).append(trElab);

            var precioRanurado = arrPrincipal['ranurado']['costo_tot_proceso'];
            var trRan = "<tr><td></td><td>Ranurado</td><td>$" + precioRanurado + "</td><td></td></tr>";
            $('#resumen'+tabla).append(trRan);
        break;
    }
    $('#resumen' + tabla ).append(trResumen);
}

//apendizacion de procesos por default
function appndPD(aGlobal){

    if( aGlobal == undefined || aGlobal == null ) return false;

    var cantidad = aGlobal['tiraje'];
    //Elaboracion

        var elabFC = aGlobal['elab_FCaj'];
        var elabFT = aGlobal['elab_FTap'];
        
        var trFC = appndE(elabFC,'Forro Cajón');
        var trFT = appndE(elabFT, 'Forro Tapa');

        var suma = parseInt( parseInt(elabFC['costo_tot_proceso']) + parseInt(elabFT['costo_tot_proceso']));
        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Elaboración</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ cantidad +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Totales</td></tr>' + trFC + trFT + '<tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ suma +'<input type="hidden" class="prices" value="'+ suma +'"></td></tr><tr><td colspan="3"></td></tr>';
        $("#table_adicionales_tr").append(tr);
        function appndE(proceso, titulo){

            var costoT = parseInt(proceso['costo_tot_proceso']);
            var costoU = parseInt(proceso['costo_unit_forrado_cajon']);
            var tr = '<tr><td>' + titulo + '</td><td>$'+ costoU +'</td><td>$'+ costoT +'</td></tr>';
            return tr;
        }
    //Ranurado

        var ranFC = aGlobal['ranurado'];
        //var ranFT = aGlobal['elab_FTap'];
        
        var trFC = appndR(ranFC,'Arreglo');
        //var trFT = appndE(ranFT, 'Forro Tapa');

        var suma = parseInt( parseInt(ranFC['costo_tot_proceso']));
        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Ranura</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ cantidad +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Totales</td></tr>' + trFC + '<tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ suma +'<input type="hidden" class="prices" value="'+ suma +'"></td></tr><tr><td colspan="3"></td></tr>';
        $("#table_adicionales_tr").append(tr);
        function appndR(proceso, titulo){

            var costoU = proceso['costo_unit_por_ranura'];
            var costoT = proceso['costo_tot_proceso'];
            return tr = '<tr><td>' + titulo + '</td><td>$'+ costoU +'</td><td>$'+ costoT +'</td></tr>'
        }
    //Encuadernacion
        var enc        = aGlobal['encuadernacion'];
        var cUDespunte = enc['despunte_costo_unitario'];
        var cTDespunte = enc['despunte_de_esquinas_para_cajon'];
        var cUEncajada = enc['encajada_costo_unitario'];
        var cTEncajada = enc['costo_encajada'];
        var total      = enc['costo_tot_proceso'];
        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Encuadernación</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ cantidad +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Despunte</td><td>$'+ cUDespunte +'</td><td>$'+ cTDespunte +'</td></tr><tr><td>Encajada</td><td>$'+ cUEncajada +'</td><td>$'+ cTEncajada +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr>';
        $("#table_adicionales_tr").append(tr);
}

function getIdClient() {

    var url     = location.href;
    var cliente = url.split("?");

    cliente = cliente[1].split("=");
    cliente = cliente[1].split("&");
    cliente = parseInt(cliente[0]);

    return cliente;
}

function appndImg(div, src){

	$(div).html(src)
}

//accion onclick botones

/*

    Esta funcion del boton acabados e impresiones
    FAVOR DE NO MOVERLAS
    explicacion:
    cada caja tiene secciones entonces en btnacabados se le especifica
    ciertas secciones en concreto para el modelo regalo.
    esta diseñado solamente para caja regalo

*/
//Acabados
$('#btnAcabados').click(function() {

    switch(divisionesAcbs){

        case "EC":

            saveBtnAcabados(aAcbEC,"listAcbEC");    
        break;
        case "FC":

            saveBtnAcabados(aAcbFC,"listAcbFC");
        break;
        case "ET":

            saveBtnAcabados(aAcbET,"listAcbET");    
        break;
        case "FT":

            saveBtnAcabados(aAcbFT,"listAcbFT");
        break;
    }
});

//Impresiones
$("#btnImpresiones").click( function () {

    switch(divisionesImps){

        case "EC":

            saveBtnImpresiones(aImpEC,"listImpEC");
        break;
        case "FC":

            saveBtnImpresiones(aImpFC,"listImpFC");
        break;
        case "ET":

            saveBtnImpresiones(aImpET,"listImpET");
        break;
        case "FT":

            saveBtnImpresiones(aImpFT,"listImpFT");
        break;
    }
});


//Boton Calcular
jQuery214(document).on("click", "#btnCalcularC", function () {

    var odt               = $("#odt").val();
    var base              = $("#base").val();
    var alto              = $("#alto").val();
    var profundidad_cajon = $("#profundidad_cajon").val();
    var profundidad_tapa  = $("#profundidad_tapa").val();
    var grosor_carton      = $("#grosor_carton").val();
    var grosor_tapa       = $("#grosor_tapa").val();
    var cantidad          = $("#qty").val();

    if( revisarPropiedades(odt,"ODT") == false ) return false;

    if( revisarPropiedades(base,"base") == false ) return false;
    
    if( revisarPropiedades(alto,"alto") == false ) return false;
    
    if( revisarPropiedades(profundidad_cajon,"Profundidad Cajón") == false ) return false;

    if( revisarPropiedades(profundidad_tapa,"Profundidad Tapa") == false ) return false;
    
    if( revisarPropiedades(grosor_carton,"Grosor Cartón") == false ) return false;

    if( revisarPropiedades(grosor_tapa,"Grosor Tapa") == false ) return false;

    if( revisarPropiedades(cantidad,"Cantidad") == false ) return false;
    //if( revisarImpAcb() == false ) return false;


    var grabar      = "NO";
    var optEC = $("#optEC").val();
    var optFC = $("#optFC").val();
    var optET = $("#optET").val();
    var optFT = $("#optFT").val();

    if( optEC == null || optFC == null || optET == null || optFT == null ){
        
        var cadena = "";

        if( optEC == null ) cadena += "Empalme Cajón <br>";
        if( optFC == null ) cadena += "Forro Cajón <br>";
        if( optET == null ) cadena += "Empalme Tapa <br>";
        if( optFT == null ) cadena += "Forro Tapa";

        showModError("");
        $("#txtContenido").attr("align", "left");
        $("#txtContenido").html("");
        $("#txtContenido").html("Debe de seleccionar un papel para las siguientes secciones: " + cadena + ".");

    } else {

        if (typeof formData !== 'undefined' && formData.length > 0) {

            formData = [];
        }

        var formData      = $("#dataForm").serializeArray();

        // impresion
        var aImpEC_tmp  = JSON.stringify(aImpEC, null, 4);
        var aImpFC_tmp  = JSON.stringify(aImpFC, null, 4);
        var aImpET_tmp = JSON.stringify(aImpET, null, 4);
        var aImpFT_tmp  = JSON.stringify(aImpFT, null, 4);

        // acabados
        var aAcbEC_tmp  = JSON.stringify(aAcbEC, null, 4);
        var aAcbFC_tmp  = JSON.stringify(aAcbFC, null, 4);
        var aAcbET_tmp = JSON.stringify(aAcbET, null, 4);
        var aAcbFT_tmp  = JSON.stringify(aAcbFT, null, 4);

        // cierres
        var aCierres_tmp = JSON.stringify(aCierres, null, 4);


        // bancos
        var aBancos_tmp = JSON.stringify(aBancos, null, 4);


        // accesorios
        var aAccesorios_tmp = JSON.stringify(aAccesorios, null, 4);

        var id_cliente_tmp = JSON.stringify(cliente, null, 4);
        
        formData.push({name: 'id_cliente', value: id_cliente_tmp});
        
        formData.push({name: 'aImpEC', value: aImpEC_tmp});
        formData.push({name: 'aImpFC', value: aImpFC_tmp});
        formData.push({name: 'aImpET', value: aImpET_tmp});
        formData.push({name: 'aImpFT', value: aImpFT_tmp});

        formData.push({name: 'aAcbEC', value: aAcbEC_tmp});
        formData.push({name: 'aAcbFC', value: aAcbFC_tmp});
        formData.push({name: 'aAcbET', value: aAcbET_tmp});
        formData.push({name: 'aAcbFT', value: aAcbFT_tmp});

        formData.push({name: 'aCierres', value: aCierres_tmp});
        formData.push({name: 'aBancos', value: aBancos_tmp});
        formData.push({name: 'aAccesorios', value: aAccesorios_tmp});
        formData.push({name: 'descuento_pctje', value: descuento});
        formData.push({name: 'grabar', value: grabar});

        var modificar_odt = "NO";

        formData.push({name: 'modificar', value: modificar_odt});

        aCierres_tmp    = [];
        aBancos_tmp     = [];
        aAccesorios_tmp = [];

        showLoading();
        $.ajax({
            type:"POST",
            //dataType: "json",
            url: $('#dataForm').attr('action'),
            data: formData,
        })
        .done(function(response) {

            console.log(response);
            hideLoading();
            if (response !== " " && response !== "" && response !== undefined) {

                
                try {

                    var respuesta = JSON.parse(response);
                    var resp      = JSON.stringify(respuesta,null,4);
                    console.log(resp);
                    var error     = respuesta.error;
                    if (error.length > 0 || respuesta.mensaje === "ERROR") {

                        showModError("");
                        $("#txtContenido").html("");
                        $("#txtContenido").html(error);

                        return false;
                    }
                    
                    emptyTables();
                    // (RESUMEN)
                        
                        var trEC   = '<tr><td><b>Empalme Cajón</b></td><td></td><td></td><td></td></tr>';
                        var trFC    = '<tr><td><b>Forro Cajón</b></td><td></td><td></td><td></td></tr>';
                        var trET  = '<tr><td><b>Empalme Tapa</b></td><td></td><td></td><td></td></tr>';
                        var trFT    = '<tr><td><b>Forro Tapa</b></td><td></td><td></td><td></td></tr>';

                        var trMensajeria = '<tr><td><b>Costo Mensajería</b></td><td></td><td></td><td></td></tr>';
                        var trEmpaque = '<tr><td><b>Costo Empaque</b></td><td></td><td></td><td></td></tr>';
                        var trEncuadernacion = '<tr><td><b>Encuadernación</b></td><td></td><td></td><td></td></tr>';

                        //imprime titulos para resumen
                        $('#resumenEC').append(trEC);
                        $('#resumenFC').append(trFC);
                        $('#resumenET').append(trET);
                        $('#resumenFT').append(trFT);

                        $('#resumenMensajeria').append(trMensajeria);
                        $('#resumenEmpaque').append(trEmpaque);
                        $('#resumenEncuadernacion').append(trEncuadernacion);

                    // (MENSAJERIA)
                        var costo_msj = "<tr><td></td><td></td><td></td><td>$" + respuesta['mensajeria'] + "</td></tr>";
                        $('#resumenMensajeria').append(costo_msj);

                    // (EMPAQUE)
                        var costo_emp = "<tr><td></td><td></td><td></td><td>$" + respuesta['empaque'] + "</td></tr>";
                        $('#resumenEmpaque').append(costo_emp);

                    //ENCUADERNACION
                        var trEncuadernacion = "<tr><td></td><td></td><td></td><td>$" + respuesta['encuadernacion']['costo_tot_proceso'] + "</td></tr>";
                        $("#resumenEncuadernacion").append(trEncuadernacion);

                    // PAPELES Y CARTONES

                        $('#table_papeles_tr').empty();

                        var tr = '<tr style="background: steelblue;color: white;"><td class="text-light">Parte</td><td class="text-light">Material</td><td class="text-light">C. Unitario</td><td class="text-light">Cortes</td><td class="text-light">P. por hoja</td><td class="text-light">H. sin merma</td><td class="text-light">C. Total</td></tr>';

                        $('#table_papeles_tr').append(tr);

                        appndPapelCarton( respuesta, respuesta['costo_grosor_carton'], "Cartón Cajón" );
                        appndPapelCarton( respuesta, respuesta['papel_Emp'], "Empalme Cajón" );
                        appndPapelCarton( respuesta, respuesta['papel_FCaj'], "Forro Cajón" );
                        appndPapelCarton( respuesta, respuesta['costo_grosor_tapa'], "Cartón Tapa" );
                        appndPapelCarton( respuesta, respuesta['papel_EmpTap'], "Empalme Tapa" );
                        appndPapelCarton( respuesta, respuesta['papel_FTap'], "Forro Tapa" );

                    // (PROCESOS DEFAULT)

                        appndPD(respuesta);
                    // IMPRESIONES
                    
                        appndImp( respuesta['aImpEmp'], "EC" );
                        appndImp( respuesta['aImpFCaj'], "FC" );
                        appndImp( respuesta['aImpEmpTap'], "ET" );
                        appndImp( respuesta['aImpFTap'], "FT" );

                    // ACABADOS
                        appndAcb( respuesta['aAcbEmp'], "EC" );
                        appndAcb( respuesta['aAcbFCaj'], "FC" );
                        appndAcb( respuesta['aAcbEmpTap'], "ET" );
                        appndAcb( respuesta['aAcbFTap'], "FT" );

                    // BANCOS
                        
                        if(respuesta['Bancos']) {

                            var titulo = '<tr><td><b>Bancos</b></td><td></td><td></td><td></td></tr>';
                            $('#resumenBancos').append(titulo);

                            for(var cont = 0; cont < respuesta['Bancos'].length; cont++) {

                                var tipo = respuesta['Bancos'][cont]['Tipo_banco'];
                                var costoU = parseFloat(respuesta['Bancos'][cont]['costo_unit_banco']);
                                var costoT = parseFloat(respuesta['Bancos'][cont]['costo_tot_proceso']);

                                tr = '<tr><td>' + tipo +'</td><td>' + respuesta['Bancos'][cont]['Suaje'] + '</td><td>$' + costoU +'<td>$' + costoT + '</td><td style="display: none;"></td></tr>';

                                $('#tabla_bancos').append(tr);
                                
                                var resumen = '<tr><td></td><td>' + tipo +'</td><td>$'+ costoT +'</td><td></td></tr>';

                                $('#resumenBancos').append(resumen);
                            }

                            $('#resumenBancos').append("<tr><td></td><td></td><td></td><td>$" + respuesta['costo_bancos'] + "</td></tr>");
                            $('#bancos').show();
                        }

                    // CIERRES
                        
                        if(respuesta['Cierres']) {

                            var titulo = '<tr><td><b>Cierres</b></td><td></td><td></td><td></td></tr>';
                            $('#resumenCierres').append(titulo);

                            for(var cont = 0; cont < respuesta['Cierres'].length; cont++) {

                                var largoAncho = "N/A";
                                var color = "N/A";
                                var tipoCierre = "N/A";
                                var tipo = respuesta['Cierres'][cont]['Tipo_cierre'];
                                var costoU = parseFloat(respuesta['Cierres'][cont]['costo_unitario']);
                                var costoT = parseFloat(respuesta['Cierres'][cont]['costo_tot_proceso']);


                                if( respuesta['Cierres'][cont]['color'] != null ){

                                    color = respuesta['Cierres'][cont]['color'];
                                }
                                if( respuesta['Cierres'][cont]['largo'] != null ){

                                    largoAncho = respuesta['Cierres'][cont]['largo'] + "x" + respuesta['Cierres'][cont]['ancho'];
                                }
                                if( respuesta['Cierres'][cont]['tipo'] != null ){

                                    tipoCierre = respuesta['Cierres'][cont]['tipo'];
                                }
                                
                                tr = '<tr style="background: steelblue;color: white;"><td style="color: white">Tipo: ' + tipo + '</td><td style="color: white">Color: ' + color + ' </td><td style="color: white">Tamaño: ' + largoAncho + ' </td></tr><tr><td></td><td>Costo Unitario</td><td>Total</td></tr><tr><td>' + tipoCierre + '</td><td>$' + costoU +'</td><td>$' + costoT + '</td><td style="display: none;"></td></tr>';

                                $('#tabla_cierres').append(tr);

                                var resumen = '<tr><td></td><td>' + tipo +'</td><td>$'+ costoT +'</td><td></td></tr>';

                                $('#resumenCierres').append(resumen);
                            }

                            $('#resumenCierres').append("<tr><td></td><td></td><td></td><td>$" + respuesta['costo_cierres'] + "</td></tr>");

                            $('#divCierres').show();
                        }

                    // ACCESORIOS
                        
                        if(respuesta['Accesorios']) {

                            var titulo = '<tr><td><b>Accesorios</b></td><td></td><td></td><td></td></tr>';
                            $('#resumenAccesorios').append(titulo);

                            for(var cont = 0; cont < respuesta['Accesorios'].length; cont++) {

                                var largoAncho = "N/A";
                                var color = "N/A";
                                var tipoAccesorio = "N/A";
                                var tipo = respuesta['Accesorios'][cont]['Tipo_accesorio'];
                                var costoU = parseFloat(respuesta['Accesorios'][cont]['costo_unit_accesorio']);
                                var costoT = parseFloat(respuesta['Accesorios'][cont]['costo_tot_proceso']);
                                if( respuesta['Accesorios'][cont]['Color'] != null ){

                                    color = respuesta['Accesorios'][cont]['Color'];
                                }
                                if( respuesta['Accesorios'][cont]['Largo'] != null ){

                                    largoAncho = respuesta['Accesorios'][cont]['Largo'] + "x" + respuesta['Accesorios'][cont]['Ancho'];
                                }
                                if( respuesta['Accesorios'][cont]['Tipo'] != null ){

                                    tipoAccesorio = respuesta['Accesorios'][cont]['Tipo'];
                                }

                                tr = '<tr style="background: steelblue;color: white;"><td style="color: white">Tipo: ' + tipo + '</td><td style="color: white">Color: ' + color + ' </td><td style="color: white">Tamaño: ' + largoAncho + ' </td></tr><tr><td></td><td>Costo Unitario</td><td>Total</td></tr><tr><td>' + tipo +'</td><td>$' + costoU +'<td>$' + costoT + '</td><td style="display: none;"></td></tr>';

                                $('#tabla_accesorios').append(tr);

                                var resumen = '<tr><td></td><td>' + tipo +'</td><td>$'+ costoT +'</td><td></td></tr>';

                                $('#resumenAccesorios').append(resumen);
                            }

                            $('#resumenAccesorios').append("<tr><td></td><td></td><td></td><td>$" + respuesta['costo_accesorios'] + "</td></tr>");

                            $('#divAccesorios').show();
                        }

                    // COSTOS
                        $("#tdSubtotalCaja").html("$" + respuesta['costo_subtotal']);
                        $("#UtilidadDrop").html("$" + respuesta['Utilidad']);
                        $("#Totalplus").html("$" + respuesta['costo_odt']);
                        $("#IVADrop").html("$" + respuesta['iva']);
                        $("#ComisionesDrop").html("$" + respuesta['comisiones']);
                        $("#IndirectoDrop").html("$" + respuesta['indirecto']);
                        $("#VentasDrop").html("$" + respuesta['ventas']);
                        $("#ISRDrop").html("$" + respuesta['ISR']);
                        $("#DescuentoDrop").html("$" + respuesta['descuento']);

                    //RESUMEN

                        var parteresumen;

                        parteresumen = '<tr><td></td><td></td><td></td><td class="totalEmpalme">$0.00</td></tr>';

                        jQuery214('#resumenEmpalme').append(parteresumen); //imprime para el resumen

                        parteresumen = '<tr><td></td><td></td><td></td><td class="totalFcajon">$0.00</td></tr>';

                        parteresumen = '<tr><td></td><td></td><td><b>Subtotal:</b></td><td class="grand-total"><b>$' + respuesta['costo_subtotal'] +'</b></td></tr><tr><td></td><td></td><td>Utilidad: </td><td id="UtilidadResumen">$' + respuesta['Utilidad'] + '</td></tr><tr><td></td><td></td><td>IVA:</td><td id="IVAResumen">$' + respuesta['iva'] + '</td></tr><tr><td></td><td></td><td>ISR: </td><td id="ISResumen">$' + respuesta['ISR'] + '</td></tr><tr><td></td><td></td><td>Comisiones: </td><td id="ComisionesResumen">$ ' + respuesta['comisiones'] + '</td></tr><tr><td></td><td></td><td>% Indirecto: </td><td id="IndirectoResumen">$' + respuesta['indirecto'] + '</td></tr><tr><td></td><td></td><td>Ventas: </td><td id="ventaResumen">$' + respuesta['ventas'] + '</td></tr><tr><td></td><td></td><td>Descuento: </td><td id="descuentoResumen">$' + respuesta['descuento'] + '</td></tr><tr><tr><td></td><td></td><td><b>Total: </b></td><td id="TotalResumen"><b>$' + respuesta['costo_odt'] + '</b></td></tr>';

                            //<tr><td></td><td></td><td>Descuento: </td><td id="DescuentoResumen" style="color: red;">$0.00</td></tr>

                        $('#resumenOtros').append(parteresumen); //imprime para el resumen

                        activarBtn();
                } catch {

                    try{

                        var error = response.split("<br />");
                        error = error[1].split("<b>").join("");
                        error = error.split("</b>").join("");
                        showModError("");

                        $("#txtContenido").html("(3668) Hubo un error al cotizar la caja.");
                        appndMsgError(error);
                    }catch {

                        showModError("");

                        $("#txtContenido").html("(3674) Hubo un error al cotizar la caja.");
                    } finally{

                        return false;    
                    }
                }
            }else{

                showModError("");

                $("#txtContenido").html("(3685) Hubo un error al cotizar la caja.");
                appndMsgError("No se regresa ningun valor. Favor de llamar a sistemas");
                desactivarBtn();
                return false;
            }
        })
        .fail(function(response) {

            console.log('(7257) Error. Revisa.');

            desactivarBtn();
        });
    }
});

//Eliminacion de Impresiones
jQuery214(document).on("click", ".listImpEC", function () {

    $(this).closest('tr').remove();
    aImpEC = [];
    delBtnImpresiones(aImpEC, "listImpEC");
});

jQuery214(document).on("click", ".listImpFC", function () {

    $(this).closest('tr').remove();
    aImpFC = [];
    delBtnImpresiones(aImpFC, "listImpFC");
});

jQuery214(document).on("click", ".listImpET", function () {

    $(this).closest('tr').remove();
    aImpET = [];
    delBtnImpresiones(aImpET, "listImpET");
});

jQuery214(document).on("click", ".listImpFT", function () {

    $(this).closest('tr').remove();
    aImpFT = [];
    delBtnImpresiones(aImpFT, "listImpFT");
});


//Eliminacion de Acabados

jQuery214(document).on("click", ".listAcbEC", function () {

    $(this).closest('tr').remove();
    aAcbEC = [];
    delBtnAcabados(aAcbEC, "listAcbEC");
});

jQuery214(document).on("click", ".listAcbFC", function () {

    $(this).closest('tr').remove();
    aAcbFC = [];
    delBtnAcabados(aAcbFC, "listAcbFC");
});

jQuery214(document).on("click", ".listAcbET", function () {

    $(this).closest('tr').remove();
    aAcbET = [];
    delBtnAcabados(aAcbET, "listAcbET");
});

jQuery214(document).on("click", ".listAcbFT", function () {

    $(this).closest('tr').remove();
    aAcbFT = [];
    delBtnAcabados(aAcbFT, "listAcbFT");
});

$("#btnImprimir").click( function(){

    var ventana = window.open(url +"cotizador/imprCaja", "Impresion", "width=600, height=600");
    return true;
});
