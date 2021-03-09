class Almeja extends Cajas{

    constructor( params = {} ) {
        
        super( params );
    }

    //esta funcion sirve al cotizar una caja regalo. Se encuentra en el ajax
    appndPapelCarton(arrPrincipal, arrPapel, parte ){

        if (  arrPapel == "" ||  arrPapel == undefined ) return false;

        //Esta pequeña parte pega en el boton tablas en la seccion cortes de hojas los papeles y cartones.
        var nombre = '';
        var ancho = ''
        var largo = ''
        var costoUnitario = '';
        var costoTotal    = '';
        var corte         = '';
        var pliegos       = '';

        let isCot = () =>{

            ancho         = arrPapel['calculadora']['corte_ancho'];
            largo         = arrPapel['calculadora']['corte_largo'];
            nombre        = arrPapel['nombre_papel'];
            costoUnitario = arrPapel['costo_unit_papel'];
            costoTotal    = arrPapel['tot_costo'];
            corte         = arrPapel['corte'];
            pliegos       = arrPapel['tot_pliegos'];
        }
        let isModCartones = () =>{

            ancho         = arrPapel['corte_ancho'];
            largo         = arrPapel['corte_largo'];
            nombre        = arrPapel['nombre'];
            costoUnitario = arrPapel['precio'];
            costoTotal    = arrPapel['costo_tot_carton'];
            pliegos       = arrPapel['num_pliegos'];
            corte         = arrPapel['piezas_por_pliego'];
        }
        let isModPapers = () =>{

            ancho         = arrPapel['corte_ancho'];
            largo         = arrPapel['corte_largo'];
            nombre        = arrPapel['nombre'];
            costoUnitario = arrPapel['costo_unitario'];
            costoTotal    = arrPapel['costo_tot_pliegos'];
            pliegos       = arrPapel['pliegos'];
            corte         = arrPapel['cortes'];
        }
        if( arrPapel['calculadora'] !== undefined ) isCot();
        if( arrPapel['precio'] !== undefined ) isModCartones();
        if( arrPapel['costo_tot_pliegos'] !== undefined ) isModPapers();

        
        var tr = '<tr><td>' + parte + '</td><td>' + nombre + '</td><td>$' + costoUnitario + '</td><td>Largo: ' + largo + ' Ancho: ' + ancho + '</td><td>' + corte + '</td><td>' + pliegos + '</td><td>$' + costoTotal + '<input type="hidden" class="prices" value="' + costoTotal + '"></td></tr>';

        $('#table_papeles_tr').append(tr);

        //La parte siguiente es para el boton resumen
        var trResumen = '<tr><td></td><td>Papel '+ nombre +'</td><td>$'+ costoTotal +'</td><td></td></tr>';
        var tabla = "";

        this._secciones.find( function(sec){

            if( sec['titulo'].indexOf(parte) == 0 ){

                tabla  = sec['siglas'];
                return true;
            }
        });

        let appndPD = parte => {

            switch( parte ){

                case "Cartón Cajón":
                    trResumen = '<tr><td></td><td>'+ nombre +'</td><td>$'+ costoTotal +'</td><td></td></tr>';
                break;
                case "Empalme Cajón":
    
                    var precioEnc = arrPrincipal['Encuadernacion_emp']['costo_tot_proceso'];
                    var trEnc = "<tr><td></td><td>Encuadernación</td><td>$" + precioEnc + "</td><td></td></tr>";
                    $('#resumen'+tabla).append(trEnc);
                break;
                case "Forro Cajón":
                    var precioElab = arrPrincipal['Elab_Car']['forro_costo_tot'];
                    var trElab = "<tr><td></td><td>Elaboración</td><td>$" + precioElab + "</td><td></td></tr>";
                    $('#resumen'+tabla).append(trElab);
                    
                    var precioRanurado = arrPrincipal['arreglo_ranurado_hor_fcar']['costo_tot_proceso'];
                    var trRan = "<tr><td></td><td>Ranurado</td><td>$" + precioRanurado + "</td><td></td></tr>";
                    $('#resumen'+tabla).append(trRan);
    
                    var precioEnc = arrPrincipal['Encuadernacion_FCaj']['costo_tot_proceso'];
                    var trEnc = "<tr><td></td><td>Encuadernación</td><td>$" + precioEnc + "</td><td></td></tr>";
                    $('#resumen'+tabla).append(trEnc);
                break;
                case "Empalme Tapa":
                break;
                case "Carton Tapa":
                    trResumen = '<tr><td></td><td>'+ nombre +'</td><td>$'+ costoTotal +'</td><td></td></tr>';
                break;
                case "Forro Tapa":
                    var precioElab = arrPrincipal['elab_FTap']['costo_tot_proceso'];
                    var trElab = "<tr><td></td><td>Elaboración</td><td>$" + precioElab + "</td><td></td></tr>";
                    $('#resumen'+tabla).append(trElab);
    
                    var precioRanurado = arrPrincipal['ranurado']['costo_tot_proceso'];
                    var trRan = "<tr><td></td><td>Ranurado</td><td>$" + precioRanurado + "</td><td></td></tr>";
                    $('#resumen'+tabla).append(trRan);
                break;
            }
        }

        if( arrPapel['calculadora'] !== undefined ) appndPD(parte);
        
        $('#resumen' + tabla ).append(trResumen);
    }

    //Apendizacion de procesos por default. Se utiliza al cotizar una caja - ajax
    appndPD(aGlobal){

        if( aGlobal == undefined || aGlobal == null ) return false;

        var cantidad = aGlobal['tiraje'];

        //Elaboracion

            var elabC = aGlobal['Elab_Car'];
            var elabG = aGlobal['elab_guarda'];

            let appndE = (proceso, titulo) => {

                var costoT = parseFloat(proceso['forro_costo_tot'],2);
                var costoU = parseFloat(proceso['costo_unit'],2);
                var tr = '<tr><td>' + titulo + '</td><td>$'+ costoU +'</td><td>$'+ costoT +'</td></tr>';
                return tr;
            }
            
            var trFC = appndE(elabC,'Forro Cartera');
            var trFT = appndE(elabG, 'Forro Guarda');

            var suma = parseFloat( parseFloat(elabC['forro_costo_tot']) + parseFloat(elabG['forro_costo_tot']),2);
            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Elaboración</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ cantidad +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Totales</td></tr>' + trFC + trFT + '<tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ suma +'<input type="hidden" class="prices" value="'+ suma +'"></td></tr><tr><td colspan="3"></td></tr>';
            $("#table_adicionales_tr").append(tr);
            
        //Ranurado

            var ranFC = aGlobal['arreglo_ranurado_hor_fcar'];
            //var ranFT = aGlobal['elab_FTap'];
            
            var trFC = appndR(ranFC,'Arreglo Cartera');
            //var trFT = appndE(ranFT, 'Forro Tapa');

            var suma = parseFloat( ranFC['costo_tot_proceso'])
            ;
            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">Ranura</td></tr><tr style="background: #87ceeb73;"><td colspan="3">Cantidad: '+ cantidad +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Totales</td></tr>' + trFC + '<tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ suma +'<input type="hidden" class="prices" value="'+ suma +'"></td></tr><tr><td colspan="3"></td></tr>';
            $("#table_adicionales_tr").append(tr);
            function appndR(proceso, titulo){

                var costoU = proceso['costo_unit_por_ranura'];
                var costoT = proceso['costo_tot_proceso'];
                return tr = '<tr><td>' + titulo + '</td><td>$'+ costoU +'</td><td>$'+ costoT +'</td></tr>'
            }
        //Encuadernacion
            var encEmp        = aGlobal['Encuadernacion_emp'];
            var encFC = aGlobal['Encuadernacion_FCaj'];

            var cUDespunte = aGlobal['despunte_esquinas']['costo_unitario_esquinas'];
            var cTDespunte = aGlobal['despunte_esquinas']['costo_tot_proceso'];

            var cUEncajada = aGlobal['encajada']['costo_unitario'];
            var cTEncajada = aGlobal['encajada']['costo_tot_proceso'];

            var cUForrado = encEmp['forrado_cajon_costo_unitario'];
            var cTForrado = encEmp['forrado_cajon_costo'];

            var cUArreglo = encEmp['arreglo_costo_unitario'];
            var cTArreglo = encEmp['arreglo_forrado_cajon_costo'];

            var total      = encEmp['costo_tot_proceso'];
            var tr = `
            <tr>
                <td colspan="3" style="background: steelblue;color: white;">Encuadernación</td>
            </tr>
            <tr style="background: #87ceeb73;">
                <td colspan="3">Cantidad: ${cantidad}</td>
            </tr>
            <tr>
                <td></td>
                <td>Costo Unitario</td>
                <td>Subtotal</td>
            </tr>
            <tr>
                <td>Despunte</td>
                <td>$${cUDespunte}</td>
                <td>$${cTDespunte}</td>
            </tr>
            <tr>
                <td>Forrado</td>
                <td>$${cUForrado}</td>
                <td>$${cTForrado}</td>
            </tr>
            <tr>
                <td>Arreglo Forrado</td>
                <td>$${cUArreglo}</td>
                <td>$${cTArreglo}</td>
            </tr>
            <tr>
                <td>Encajada</td>
                <td>$${cUEncajada}</td>
                <td>$${cTEncajada}</td>
            </tr>
            <!--<tr>
                <td>Empalme</td>
                <td>$${cUEncajada}</td>
                <td>$${cTEncajada}</td>
            </tr>-->
            <tr style="border-top: 2px solid #cccc;">
                <td></td>
                <td>Total</td>
                <td>$${total}</td>
            </tr>`;

            $("#table_adicionales_tr").append(tr);
    }

    appndImp( aImp, secciones ){

        if ( aImp == undefined ) return false;
                
        let offset     = null;
        let digital    = null;
        let serigrafia = null;

        //Se divide en partes todos los indices de impresiones y se hace un ciclo for para cada uno
        let partes = secciones.split(' ');
        for( let i = 0; i < partes.length; i++ ){

            //se obtiene el tipo de proceso. Ej: Off Dig Ser
            let parte = partes[i];
            let impresion = partes[i].slice(0,3);
            
            //identifica si el arreglo esta vacio
            let arreglo = aImp[parte];
            if ( arreglo == undefined ) continue;

            //Se obtiene el titulo y a que tabla corresponde
            let titulo = '';
            let lblaImp = ''
            let seccion = parte.slice(3)
            if ( seccion == 'Emp' ) seccion = 'EC'
            //if ( seccion == 'Guarda' ) seccion = 'G'
            this._secciones.find(function(sec){

                if( sec['siglas'].indexOf(seccion) == 0 ){
                    titulo = sec['titulo'];
                    return true;
                }
            });

            if( parte == 'Off_maq_Emp' ) titulo = 'Empalme Cajón'
            if( parte == 'Off_maq_FCaj' ) titulo = 'Forro Cajón'
            
            switch( impresion ){

                case 'Off':

                    if( parte == 'Off_maq_Emp' || parte == 'Off_maq_FCaj' ){

                        for( let j = 0; j < arreglo.length; j++ ){
                    
                            var cantidad  = arreglo[j]['cantidad'];
                            var tintas    = arreglo[j]['num_tintas'];
                            var tipo      = arreglo[j]['Tipo'];
                            var cULam     = arreglo[j]['costo_unitario_laminas'];
                            var cTLam     = arreglo[j]['costo_laminas'];
                            var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                            var cTArr     = arreglo[j]['arreglo_costo'];
                            var total     = parseFloat(arreglo[j]['costo_tot_proceso']);

                            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + ' - Maquila</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>'+ cULam +'</td><td>'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                            $('#table_proc_offset').append(tr);

                            $('#proceso_offset_M1').show();

                            var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                            $('#resumen'+seccion).append(trResumen);
                        }
                    }else{

                        for( let j = 0; j < arreglo.length; j++ ){

                            var cantidad  = arreglo[j]['cantidad'];
                            var tintas    = arreglo[j]['num_tintas'];
                            var tipo      = arreglo[j]['tipo_offset'];
                            var cULam     = arreglo[j]['costo_unitario_laminas'];
                            var cTLam     = arreglo[j]['costo_tot_laminas'];
                            var cUArr     = arreglo[j]['costo_unitario_arreglo'];
                            var cTArr     = arreglo[j]['costo_tot_arreglo'];
                            var cUTir     = arreglo[j]['costo_unitario_tiro'];
                            var cTTir     = arreglo[j]['costo_tiro'];
                            var total     = parseFloat(arreglo[j]['costo_tot_proceso']);

                            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ cULam +'</td><td>$'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                                $('#table_proc_offset').append(tr);
                                $('#proceso_offset_M1').show();

                                var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                                $('#resumen'+seccion).append(trResumen);
                        }
                    }
                break;
                case 'Dig':

                    for( let j = 0; j < arreglo.length; j++ ){

                        var cantidad = arreglo[j]['tiraje'];
                        var cUDig    = arreglo[j]['costo_unitario'];
                        var cTDig    = arreglo[j]['costo_tot_proceso'];
                        var cabe     = arreglo[j]['cabe_digital'];
                        if ( cabe == "NO" ){

                            var tr = '';
                        }else{

                            var tr = '<tr><td colspan="4" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Costo Total</td></tr><tr><td>'+ cantidad +'</td><td>$'+ cUDig +'</td><td>$'+ cTDig +'</td></tr><tr><td colspan="4"></td></tr>';
                        }
                        
                        $('#table_proc_digital').append(tr);

                        $('#proceso_digital_M1').show();

                        var trResumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ cTDig +'<input type="hidden" class="pricesresumenempalme" value="'+ cTDig +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);
                    }
                break;
                case 'Ser':

                    for( let j = 0; j < arreglo.length; j++ ){

                        var cantidad  = arreglo[j]['cantidad'];
                        var tintas    = arreglo[j]['num_tintas'];
                        var tipo      = arreglo[j]['tipo'];
                        var cUArr     = arreglo[j]['costo_unit_arreglo'];
                        var cTArr     = arreglo[j]['costo_arreglo'];
                        var cUTir     = arreglo[j]['costo_unitario_tiro'];
                        var cTTir     = arreglo[j]['costo_tiro'];
                        var total     = parseFloat(arreglo[j]['costo_tot_proceso']);

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_serigrafia').append(tr);

                        $('#proceso_serigrafia_M1').show();

                        var trResumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);
                    }
                break;
            }
        }
    }

    appndAcb( aAcb, secciones ){

        if ( aAcb == undefined ) return false;

        //Se divide en partes todos los indices de acabados y se hace un ciclo for para cada uno
        let partes = secciones.split(' ');
        
        for( let i = 0; i < partes.length; i++ ){

            //se obtiene el tipo de proceso. Ej: Lam, Sua, etc.
            let parte = partes[i];
            let acabado = partes[i].slice(0,3);
            
            //identifica si el arreglo esta vacio
            let arreglo = aAcb[parte];
            if ( arreglo == undefined ) continue;

            //Se obtiene el titulo y a que tabla corresponde
            let titulo = ''
            let lblaImp = ''
            
            let barniz   = parte.search('Barniz')
            let laser    = parte.search('Laser')
            let grabado  = parte.search('Grabado')
            let hs       = parte.search('HotStamping')
            let laminado = parte.search('Laminado')
            let suaje    = parte.search('Suaje')
            
            let seccion = ''
            
            //bloque barniz - si encuentra barniz entonces parte la seccion osea Barniz_UV en solo _UV y de ahi se define a que seccino va
            if ( barniz == 0 ) seccion = parte.slice(6);
            
            //bloque laser
            if ( laser == 0 ) seccion = parte.slice(5);

            //bloque grabado
            if ( grabado == 0 ) seccion = parte.slice(7);

            //bloque hs
            if ( hs == 0 ) seccion = parte.slice(11);

            //bloque laminado
            if ( laminado == 0 ) seccion = parte.slice(8);

            //bloque laminado
            if ( suaje == 0 ) seccion = parte.slice(5);

            if ( seccion == '_UV' || seccion == '' ) seccion = 'EC';
            if ( seccion == 'Fcaj' ) seccion = 'FCaj';
            if ( seccion == 'Fcar' ) seccion = 'FCar';
            //se busca el titulo por ultimo
            this._secciones.find(function(sec){

                if( sec['siglas'].indexOf(seccion) == 0 ){
                    titulo = sec['titulo'];
                    return true;
                }
            });
            
            switch( acabado ){

                case 'Bar':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Barniz UV";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var cUnitario = arreglo[j]['costo_unitario'];
                        var total     = arreglo[j]['costo_tot_proceso'];

                        var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';

                        $('#table_proc_BarnizUV').append(tr);

                        $('#proceso_barnizuv_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);
                    }
                break;
                case 'Las':

                    for (var j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Corte Laser";
                        var tipo      = arreglo[j]['tipo_grabado'];
                        var cUnitario = arreglo[j]['costo_unitario'];
                        var total     = arreglo[j]['costo_tot_proceso'];

                        var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ tipo +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';
                        
                        $('#table_proc_Laser').append(tr);

                        $('#proceso_laser_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);
                    }
                break;
                case 'Gra':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Grabado";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var ubicacion = arreglo[j]['ubicacion'];
                        var cUPlaca   = arreglo[j]['placa_costo_unitario'];
                        var cTPlaca   = arreglo[j]['placa_costo'];
                        var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                        var cTArr     = arreglo[j]['arreglo_costo'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var cUTir     = arreglo[j]['costo_unitario'];
                        var cTTir     = arreglo[j]['costo_tiro'];

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td><td>Ubicacion: '+ ubicacion +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>$'+ cUPlaca +'</td><td>$'+ cTPlaca +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_Grab').append(tr);

                        $('#proceso_grab_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);
                    }
                break;
                case 'Hot':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Hot Stamping";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var color     = arreglo[j]['Color'];
                        //var ubicacion = aAcb['HotStamping'][i]['ubicacion'];
                        var cUPlaca   = arreglo[j]['placa_costo_unitario'];
                        var cTPlaca   = arreglo[j]['placa_costo'];
                        var cUPel     = arreglo[j]['pelicula_costo_unitario'];
                        var cTPel     = arreglo[j]['pelicula_costo'];
                        var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                        var cTArr     = arreglo[j]['arreglo_costo'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var cUTir     = arreglo[j]['costo_unitario'];
                        var cTTir     = arreglo[j]['costo_tiro'];

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Color: '+ color +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>$'+ cUPlaca +'</td><td>$'+ cTPlaca +'</td></tr><tr><td>Pelicula</td><td>$'+ cUPel +'</td><td>$'+ cTPel +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_HS').append(tr);

                        $('#proceso_hs_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);  
                    }
                break;
                case 'Lam':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Laminado";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var costo     = arreglo[j]['costo_unitario'];

                        var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ costo +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';

                        $('#table_proc_Lam').append(tr);

                        $('#proceso_lam_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);
                    }
                break;
                case 'Sua':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Suaje";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var costo     = arreglo[j]['costo_unitario'];
                        var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                        var cTArr     = arreglo[j]['arreglo'];
                        var cUTir     = arreglo[j]['tiro_costo_unitario'];
                        var cTTir     = arreglo[j]['costo_tiro'];

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_Suaje').append(tr);

                        $('#proceso_suaje_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen );      
                    }
                break;
            }
        }
    }

    //Checa los datos ingresados en la interfaz que se le presenta al usuario. avalando los campos y arrojando un mensaje de error.
    checkDatosI(grabar, modificar){

        let formData      = $("#dataForm").serializeArray();
        let odt           = $("#odt").val();
        let base          = $("#corte_largo").val();
        let alto          = $("#corte_ancho").val();
        let profundidad   = $("#profundidad_1").val();
        let grosor_cajon = $("#grosor_cajon_1").val();
        let grosor_cartera   = $("#grosor_cartera_1").val();
        let cantidad      = $("#qty").val();


        $(".is-invalid").removeClass('is-invalid');

        if( this.revisarPropiedades(odt,"ODT") == false ) {
            
            $("#odt").addClass('is-invalid');
            return false;
        }

        if( this.revisarPropiedades(base,"base") == false ) {
            
            $("#corte_largo").addClass('is-invalid');
            return false;
        }
        
        if( this.revisarPropiedades(alto,"alto") == false ) {
            
            $("#corte_ancho").addClass('is-invalid');
            return false;
        }
        
        if( this.revisarPropiedades(profundidad,"Profundidad") == false ) {
            
            $("#profundidad_1").addClass('is-invalid');
            return false;
        }

        if( this.revisarPropiedades(grosor_cajon,"Grosor Cajón") == false ) {
            
            $("#grosor_cajon_1").addClass('is-invalid');
            return false;
        }

        if( this.revisarPropiedades(grosor_cartera,"Grosor Cartera") == false ) {
            
            $("#grosor_cartera_1").addClass('is-invalid');
            return false;
        }

        if( this.revisarPropiedades(cantidad,"Cantidad") == false ) {
            
            $("#qty").addClass('is-invalid');
            return false;
        }

        var cadena = "";

        this._secciones.forEach( function(sec){

            var opt = $("#"+sec['option']).val();
            if( opt == null ) {

                cadena += sec['titulo'] + " <br>";
            }
        });

        if( cadena.length > 0 ) {

            this.showModError("");
            $("#txtContenido").attr("align", "left");
            $("#txtContenido").html("");
            $("#txtContenido").html("Debe de seleccionar un papel para las siguientes secciones: <br>" + cadena);
            return false;
        }

        this._secciones.forEach( function(sec){

            let partImp = 'aImp' +sec['siglas'];
            let partAcb = 'aAcb' +sec['siglas'];
            let aImp_tmp = JSON.stringify(sec['aImp'], null, 4);
            let aAcb_tmp = JSON.stringify(sec['aAcb'], null, 4);
            formData.push(
                {name: partImp, value: aImp_tmp},
                {name: partAcb, value: aAcb_tmp}
            );
        });
        
        var aCierres_tmp = JSON.stringify(this._cierres, null, 4);
        var aBancos_tmp = JSON.stringify(this._bancos, null, 4);
        var aAccesorios_tmp = JSON.stringify(this._accesorios, null, 4);

        var id_cliente_tmp = JSON.stringify(this._idCliente, null, 4);
        var id_odt_anterior = parseInt($("#id_odt_anterior").val());
        var modificar_odt = modificar;

        id_odt_anterior > 0 ? modificar_odt = "SI" : "NO";
        console.log(id_odt_anterior);
        console.log(modificar_odt);

        formData.push(
            {name: 'id_cliente', value: id_cliente_tmp},
            {name: 'aCierres', value: aCierres_tmp},
            {name: 'aBancos', value: aBancos_tmp},
            {name: 'aAccesorios', value: aAccesorios_tmp},
            {name: 'descuento_pctje', value: this._descuento},
            {name: 'grabar', value: grabar},
            {name: 'id_odt_ant', value: id_odt_anterior},
            {name: 'modificar', value: modificar_odt}
        );

        formData.push(

            {name: 'offset', value: ''},
            {name: 'digital', value: ''},
            {name: 'serigrafia', value: ''},
            {name: 'hs', value: ''},
            {name: 'laminado', value: ''},
            {name: 'barnizadic', value: ''},
            {name: 'barniz', value: ''},
            {name: 'suaje', value: ''},
            {name: 'forrado', value: ''},
            {name: 'id_cliente', value: ''},
            {name: 'barniz', value: ''},
        );

        this.showLoading();
        this.desactivarBtn();
        return formData;
    }

    calculateCotizacion(){

        var formData = this.checkDatosI("NO",'NO');

        if( formData == false ){

            return false;
        }

        $.ajax({
            type:"POST",
            //dataType: "json",
            url: $('#dataForm').attr('action'),
            data: formData,
        })
        .done(function(response) {

            this.postAjax(response);
        }.bind(this))
        .fail(function(response) {

            console.log('(7257) Error. Revisa.');

            caja.desactivarBtn();
        });
    }

    saveCotizacion(grabar, modificar){

		var formData = this.checkDatosI(grabar, modificar);

	    if( formData == false ){

	    	return false;
	    }

	    $.ajax({
	        type:"POST",
	        //dataType: "json",
	        url: $('#dataForm').attr('action'),
	        data: formData,
	    })
	    .done(function(response) {

	        console.log(response);
	        caja.hideLoading();
	        try {

	            var respuesta = JSON.parse( response );

	            if (!respuesta.hasOwnProperty("error")) {

	                var error = respuesta.error;
	                caja.showModError("");
	                $("#txtContenido").html("(732) " + error);

	            } else {

	            	let idAnt = respuesta.id_odt_act;
	            	$("#id_odt_anterior").val(idAnt);
	            	if( modificar == "NO" ){

	            		//caja.showModCorrecto("Los datos han sido guardados correctamente...");
	            		$('#toastPrincipal').toast('show')
	            		$('#lblToast').html('Los datos han sido guardados!')
	            	}else{

	            		//caja.showModCorrecto("Los datos han sido actualizados correctamente...");
	            		$('#toastPrincipal').toast('show')
	            		$('#lblToast').html('Los datos han sido actualizados!')
	            	}
	                caja.activarBtn();
	            }
	        } catch( e ) {

	            /*
		    		Intenta capturar el error del controlador.
		    		Entra aqui cuando no se pudo parsear la variable retornada del controlador,
		    		en dado caso de que no funcione entonces solo muestra un error de cotizacion de caja.
		    	*/

		    	try{
		    		
		            var error = response.split("<br />");
		            error = error[1].split("<b>").join("");
		            error = error.split("</b>").join("");
		            this.showModError("");
		            $("#txtContenido").html("(1326) Hubo un error al guardar la cotizacion.");
		            this.appndMsgError(error);
		        }catch(ex) {
		        	console.log(response);
		        	console.log(e);
		        	console.log('puede que este en modo debug');
		            caja.showModError("");
		            $("#txtContenido").html("(1333) Hubo un error al guardar la cotizacion.");
		        }
	        }
	    })
	    .fail(function(response) {

	        console.log('(2307) Hubo un Error inesperado. Por favor llame a sistemas.');

	        caja.desactivarBtn();
	    });
	}

    //El nombre lo dice todo. solo sirve para la cotizacion de una caja pues despues de esta no se utiliza mas
    postAjax(response){

        this.hideLoading();

        if ( response == " " && response == "" && response == undefined ) return false;

        try{
            
            var respuesta = JSON.parse(response);
            var resp      = JSON.stringify(respuesta,null,4);
            console.log(resp);
            var error     = respuesta.error;
            if (error.length > 0 || respuesta.mensaje === "ERROR") {

                this.showModError("");
                $("#txtContenido").html("");
                $("#txtContenido").html(error);

                return false;
            }
            
            this.emptyTables();
            // (RESUMEN)

                //PAPELES Y TITULOS
                $('#table_papeles_tr').empty();
                var tr = '<tr style="background: steelblue;color: white;"><td class="text-light">Parte</td><td class="text-light">Material</td><td class="text-light">C. Unitario</td><td class="text-light">Cortes</td><td class="text-light">P. por hoja</td><td class="text-light">H. sin merma</td><td class="text-light">C. Total</td></tr>';
                $('#table_papeles_tr').append(tr);

                //imprime titulos para resumen
                this._secciones.forEach( function(sec) {
                    var titulo = '<tr><td><b>' + sec['titulo'] + '</b></td><td></td><td></td><td></td></tr>';
                    $('#resumen'+sec['siglas']).append(titulo);
                    var papel = "Papel_"+sec['siglasP'];
                    this.appndPapelCarton( respuesta, respuesta[papel], sec['titulo'] );
                }.bind(this));

                var trMensajeria = '<tr><td><b>Costo Mensajería</b></td><td></td><td></td><td></td></tr>';
                var trEmpaque = '<tr><td><b>Costo Empaque</b></td><td></td><td></td><td></td></tr>';
                var trEncuadernacion = '<tr><td><b>Encuadernación</b></td><td></td><td></td><td></td></tr>';

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
                var trEncuadernacion = "<tr><td></td><td></td><td></td><td>$" + respuesta['Encuadernacion_emp']['costo_tot_proceso'] + "</td></tr>";
                $("#resumenEncuadernacion").append(trEncuadernacion);

            // CARTONES

                this.appndPapelCarton( respuesta, respuesta['CartonCar'], "Cartón Cajón" );
                this.appndPapelCarton( respuesta, respuesta['CartonCaj'], "Cartón Tapa" );
            
            // (PROCESOS DEFAULT)
                
                this.appndPD(respuesta);

            //IMPRESIONES Y ACABADOS


                this.appndImp(respuesta, 'OffEmp DigEmp SerEmp OffFCaj DigFCaj SerFCaj OffFCar DigFCar SerFCar OffG DigG SerG Off_maq_Emp Off_maq_FCaj');
                
                this.appndAcb(respuesta, 'Barniz_UV Laser Grabado HotStamping Laminado Suaje BarnizFcaj LaserFcaj GrabadoFcaj HotStampingFcaj LaminadoFcaj SuajeFcaj BarnizFcar LaserFcar GrabadoFcar HotStampingFcar LaminadoFcar SuajeFcar BarnizG LaserG GrabadoG HotStampingG LaminadoG SuajeG');

            // BANCOS
                
                if(respuesta['Bancos']) {

                    var titulo = '<tr><td><b>Bancos</b></td><td></td><td></td><td></td></tr>';
                    $('#resumenBancos').append(titulo);

                    for(var cont = 0; cont < respuesta['Bancos'].length; cont++) {

                        var tipo = respuesta['Bancos'][cont]['Tipo_banco'];
                        var costoU = parseFloat(respuesta['Bancos'][cont]['costo_unit_banco']);
                        var costoT = parseFloat(respuesta['Bancos'][cont]['costo_bancos']);

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
                        var costoT = parseFloat(respuesta['Cierres'][cont]['costo_cierre']);


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
                        var costoT = parseFloat(respuesta['Accesorios'][cont]['costo_accesorios']);
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
            
            //funcion para costo totales para sumas del resumen:
            let step = 6
            
            let seccion = (nombreResumen) =>{
                let precioTotal = 0;
                let precio = 0;
                try{

                    $(`#${nombreResumen} tr`).find('td').each(function(td){
                
                        let td1 = parseInt(td);
                        
                        if(td1 == step){

                            let valorTD = $(this).html()
                            
                            let datosSplit = valorTD.split('<')
                            datosSplit = datosSplit[0].split('$')
                            precio = parseFloat(datosSplit[1])
                            precioTotal += precio;
                            step += 4;
                        }
                    })

                    let parteresumen = `<tr><td></td><td></td><td></td><td class="totalEmpalme">$ ${precioTotal.toFixed(2)}</td></tr>`;

                    $('#'+nombreResumen).append(parteresumen); //imprime para el resumen
                    return precioTotal.toFixed(2)
                }catch(e){

                    console.log('No se pudo obtener el valor del td. \n' + e)
                }finally{

                    step = 6;
                }
                return 0;
            }

            //RESUMEN

                this._secciones.forEach( function(sec){

                    let tablaResumen = 'resumen' + sec['siglas']
                    seccion(tablaResumen)
                });

                let parteresumen;

                parteresumen = '<tr><td></td><td></td><td><b>Subtotal:</b></td><td class="grand-total"><b>$' + respuesta['costo_subtotal'] +'</b></td></tr><tr><td></td><td></td><td>Utilidad: </td><td id="UtilidadResumen">$' + respuesta['Utilidad'] + '</td></tr><tr><td></td><td></td><td>IVA:</td><td id="IVAResumen">$' + respuesta['iva'] + '</td></tr><tr><td></td><td></td><td>ISR: </td><td id="ISResumen">$' + respuesta['ISR'] + '</td></tr><tr><td></td><td></td><td>Comisiones: </td><td id="ComisionesResumen">$ ' + respuesta['comisiones'] + '</td></tr><tr><td></td><td></td><td>% Indirecto: </td><td id="IndirectoResumen">$' + respuesta['indirecto'] + '</td></tr><tr><td></td><td></td><td>Ventas: </td><td id="ventaResumen">$' + respuesta['ventas'] + '</td></tr><tr><td></td><td></td><td>Descuento: </td><td id="descuentoResumen">$' + respuesta['descuento'] + '</td></tr><tr><tr><td></td><td></td><td><b>Total: </b></td><td id="TotalResumen"><b>$' + respuesta['costo_odt'] + '</b></td></tr>';

                $('#resumenOtros').append(parteresumen); //imprime para el resumen

                $("#btnActG").prop("disabled",false);
                
                localStorage.setItem('js_respuesta',resp);
        }catch(e) {
            
            /*
                Intenta capturar el error del controlador.
                Entra aqui cuando no se pudo parsear la variable retornada del controlador,
                en dado caso de que no funcione entonces solo muestra un error de cotizacion de caja.
            */

            try{
                
                var error = response.split("<br />");
                error = error[1].split("<b>").join("");
                error = error.split("</b>").join("");
                this.showModError("");
                $("#txtContenido").html("(3668) Hubo un error en la cotizacion.");
                this.appndMsgError(error);
            }catch(ex) {
                console.log(response);
                console.log(e);
                console.log('puede que este en modo debug');
                this.showModError("");
                $("#txtContenido").html("(1114) Hubo un error en la cotizacion.");
            } finally{

                return false;    
            }
        }
    }

    /*la funcion appndImp con 3 argumentos es para la modificación y apendizacion
	del mismo*/
	appndImpMod( aImp, secciones ){

        if ( aImp == undefined ) return false;
        
        //Se divide en partes todos los indices de impresiones y se hace un ciclo for para cada uno
        let partes = secciones.split(' ');
        for( let i = 0; i < partes.length; i++ ){

            //se obtiene el tipo de proceso. Ej: Off Dig Ser
            let parte = partes[i];
            let impresion = partes[i].slice(0,3);
            
            //identifica si el arreglo esta vacio
            let arreglo = aImp[parte];
            if ( arreglo == undefined ) continue;

            //Se obtiene el titulo y a que tabla corresponde
            let titulo = '';
            let lblaImp = ''
            let seccion = parte.slice(3)
            if ( seccion == 'Emp' ) seccion = 'EC'
            //if ( seccion == 'Guarda' ) seccion = 'G'
            let arrPrincipal = []
            this._secciones.find(function(sec){

                if( sec['siglas'].indexOf(seccion) == 0 ){
                    titulo = sec['titulo'];
                    arrPrincipal = sec['aImp'];
                    return true;
                }
            });

            if( parte == 'Off_maq_Emp' ) titulo = 'Empalme Cajón'
            if( parte == 'Off_maq_FCaj' ) titulo = 'Forro Cajón'
            
            switch( impresion ){

                case 'Off':

                    if( parte == 'Off_maq_Emp' || parte == 'Off_maq_FCaj' ){

                        for( let j = 0; j < arreglo.length; j++ ){
                    
                            var cantidad  = arreglo[j]['cantidad'];
                            var tintas    = arreglo[j]['num_tintas'];
                            var tipo      = arreglo[j]['Tipo'];
                            var cULam     = arreglo[j]['costo_unitario_laminas'];
                            var cTLam     = arreglo[j]['costo_laminas'];
                            var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                            var cTArr     = arreglo[j]['arreglo_costo'];
                            var total     = parseFloat(arreglo[j]['costo_tot_proceso']);

                            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + ' - Maquila</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>'+ cULam +'</td><td>'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>'+ cUArr +'</td><td>'+ cTArr +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                            $('#table_proc_offset').append(tr);

                            $('#proceso_offset_M1').show();

                            var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                            $('#resumen'+seccion).append(trResumen);
                        
                            //necesito las siguientes 3 lineas para apendizar en el arreglo que corresponde y tambien en la tabla para el front end
                            var imp  = '<tr><td class="textImp">' + opImp + '</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="img_delete delete"></td></tr>';

                            arrPrincipal.push({"Tipo_impresion": "Offset", "tintas": tintas, "tipo_offset": tipo});

                            $("#listImp"+seccion).append(imp);

                        }
                    }else{

                        for( let j = 0; j < arreglo.length; j++ ){

                            var cantidad  = arreglo[j]['cantidad'];
                            var tintas    = arreglo[j]['num_tintas'];
                            var tipo      = arreglo[j]['Tipo'];
                            var cULam     = arreglo[j]['costo_unitario_laminas'];
                            var cTLam     = arreglo[j]['costo_tot_laminas'];
                            var cUArr     = arreglo[j]['costo_unitario_arreglo'];
                            var cTArr     = arreglo[j]['costo_tot_arreglo'];
                            var cUTir     = arreglo[j]['costo_unitario_tiro'];
                            var cTTir     = arreglo[j]['costo_tot_tiro'];
                            var total     = parseFloat(arreglo[j]['costo_tot_proceso']);

                            var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Laminas</td><td>$'+ cULam +'</td><td>$'+ cTLam +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                            $('#table_proc_offset').append(tr);

                            $('#proceso_offset_M1').show();

                            var trResumen = '<tr><td></td><td>Impresión Offset</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                            $('#resumen'+seccion).append(trResumen);
                            //necesito las siguientes 3 lineas para apendizar en el arreglo que corresponde y tambien en la tabla para el front end
                            var imp  = '<tr><td class="textImp">Offset</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="img_delete delete"></td></tr>';

                            arrPrincipal.push({"Tipo_impresion": "Offset", "tintas": tintas, "tipo_offset": tipo});

                            $("#listImp"+seccion).append(imp);
                        }
                    }
                break;
                case 'Dig':

                    for( let j = 0; j < arreglo.length; j++ ){

                        var cantidad = arreglo[j]['tiraje'];
                        var cUDig    = arreglo[j]['costo_unitario'];
                        var cTDig    = arreglo[j]['costo_tot_proceso'];
                        var cabe     = arreglo[j]['cabe_digital'];
                        if ( cabe == "NO" ){

                            var tr = '';
                        }else{

                            var tr = '<tr><td colspan="4" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr><td>Cantidad</td><td>Costo Unitario</td><td>Costo Total</td></tr><tr><td>'+ cantidad +'</td><td>$'+ cUDig +'</td><td>$'+ cTDig +'</td></tr><tr><td colspan="4"></td></tr>';
                        }
                        
                        $('#table_proc_digital').append(tr);
                        $('#proceso_digital_M1').show();

                        var trResumen = '<tr><td></td><td>Impresión Digital</td><td>$'+ cTDig +'<input type="hidden" class="pricesresumenempalme" value="'+ cTDig +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);

                        var imp  = '<tr><td class="textImp">Digital</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Se agregó una impresión digital</span></td><td class="img_delete delete"></td></tr>';
                        arrPrincipal.push({"Tipo_impresion": 'Digital'});
                        $("#listImp"+seccion).append(imp);
                    }
                break;
                case 'Ser':

                    for( let j = 0; j < arreglo.length; j++ ){

                        var cantidad  = arreglo[j]['cantidad'];
                        var tintas    = arreglo[j]['num_tintas'];
                        var tipo      = arreglo[j]['tipo'];
                        var cUArr     = arreglo[j]['costo_unit_arreglo'];
                        var cTArr     = arreglo[j]['costo_arreglo'];
                        var cUTir     = arreglo[j]['costo_unitario_tiro'];
                        var cTTir     = arreglo[j]['costo_tiro'];
                        var total     = parseFloat(arreglo[j]['costo_tot_proceso']);

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">' + titulo + '</td></tr><tr style="background: #87ceeb73;"><td>Cantidad: '+ cantidad +'</td><td>Tipo: '+ tipo +'</td><td>Tintas: '+ tintas +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_serigrafia').append(tr);
                        $('#proceso_serigrafia_M1').show();

                        var trResumen = '<tr><td></td><td>Impresión Serigrafia</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);

                        var imp  = '<tr><td class="textImp">Serigrafia</td></td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="img_delete delete"></td></tr>';

                        arrPrincipal.push({"Tipo_impresion": 'Serigrafia',  "tintas": tintas, "tipo_offset": tipo});
                    }
                break;
            }
        }
	}

    //testear - 07/marzo/2021 checar que al modificar se apendiza todo bien
    appndAcbMod( aAcb, secciones ){

        if ( aAcb == undefined ) return false;

        //Se divide en partes todos los indices de acabados y se hace un ciclo for para cada uno
        let partes = secciones.split(' ');
        
        for( let i = 0; i < partes.length; i++ ){

            //se obtiene el tipo de proceso. Ej: Lam, Sua, etc.
            let parte = partes[i];
            let acabado = partes[i].slice(0,3);
            
            //identifica si el arreglo esta vacio
            let arreglo = aAcb[parte];
            if ( arreglo == undefined ) continue;

            //Se obtiene el titulo y a que tabla corresponde
            let titulo = ''
            let lblaImp = ''
            
            let barniz   = parte.search('Barniz')
            let laser    = parte.search('Laser')
            let grabado  = parte.search('Grabado')
            let hs       = parte.search('HotStamping')
            let laminado = parte.search('Laminado')
            let suaje    = parte.search('Suaje')
            
            let seccion = ''
            
            //bloque barniz - si encuentra barniz entonces parte la seccion osea Barniz_UV en solo _UV y de ahi se define a que seccino va
            if ( barniz == 0 ) seccion = parte.slice(6);
            
            //bloque laser
            if ( laser == 0 ) seccion = parte.slice(5);

            //bloque grabado
            if ( grabado == 0 ) seccion = parte.slice(7);

            //bloque hs
            if ( hs == 0 ) seccion = parte.slice(11);

            //bloque laminado
            if ( laminado == 0 ) seccion = parte.slice(8);

            //bloque laminado
            if ( suaje == 0 ) seccion = parte.slice(5);

            if ( seccion == '_UV' || seccion == '' ) seccion = 'EC';
            if ( seccion == 'Fcaj' ) seccion = 'FCaj';
            if ( seccion == 'Fcar' ) seccion = 'FCar';
            
            let arrPrincipal = []
            //se busca el titulo por ultimo
            this._secciones.find(function(sec){

                if( sec['siglas'].indexOf(seccion) == 0 ){
                    titulo = sec['titulo'];
                    arrPrincipal = sec['aAcb'];
                    return true;
                }
            });
            let imgInfo = this.imgInfo;
            
            switch( acabado ){

                case 'Bar':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Barniz UV";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var cUnitario = arreglo[j]['costo_unitario'];
                        var total     = arreglo[j]['costo_tot_proceso'];

                        var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';

                        $('#table_proc_BarnizUV').append(tr);

                        $('#proceso_barnizuv_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Barniz UV</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);

                        if(tipo == "Registro Mate" || tipo == "Registro Brillante") {

                            var tr  = '<tr><td style="text-align: left;" class="textAcb">' + nombre +'</td><td class="CellWithComment">' + imgInfo + '<span class="CellComment">Tipo: ' +  tipo + ', Medidas: ' + largo + 'x' + ancho +'</span></td><td class="img_delete delete"></td></tr>';
        
                            arrPrincipal.push({"Tipo_acabado": nombre, "tipoGrabado": tipo, "Largo": largo, "Ancho": ancho});
                        } else {
        
                            var tr  = '<tr><td style="text-align: left;" class="textAcb">' + nombre +'</td><td class="CellWithComment">' + imgInfo + '<span class="CellComment">Tipo: ' +  tipo + '</span></td><td class="img_delete delete"></td></tr>';
        
                            arrPrincipal.push({"Tipo_acabado": nombre, "tipoGrabado": tipo, "Largo": null, "Ancho": null});
                        }
        
                        $('#listAcb' + seccion).append(tr);
                    }
                break;
                case 'Las':

                    for (var j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Corte Laser";
                        var tipo      = arreglo[j]['tipo_grabado'];
                        var cUnitario = arreglo[j]['costo_unitario'];
                        var total     = arreglo[j]['costo_tot_proceso'];

                        var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ tipo +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ cUnitario +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';
                        
                        $('#table_proc_Laser').append(tr);

                        $('#proceso_laser_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Corte Laser</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);

                        var tr = '<tr><td style="text-align: left;" class="textAcb">Corte Laser</td><td class="CellWithComment">' + imgInfo + '<span class="CellComment">Tipo: ' + tipo + '</span></td><td class="img_delete delete"></td></tr>';

	                    arrPrincipal.push({"Tipo_acabado": 'Corte Laser', "tipoGrabado": tipo});

	                    $('#listAcb' + seccion).append(tr);
                    }
                break;
                case 'Gra':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Grabado";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var ubicacion = arreglo[j]['ubicacion'];
                        var cUPlaca   = arreglo[j]['placa_costo_unitario'];
                        var cTPlaca   = arreglo[j]['placa_costo'];
                        var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                        var cTArr     = arreglo[j]['arreglo_costo'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var cUTir     = arreglo[j]['costo_unitario'];
                        var cTTir     = arreglo[j]['costo_tiro'];

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td><td>Ubicacion: '+ ubicacion +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>$'+ cUPlaca +'</td><td>$'+ cTPlaca +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_Grab').append(tr);

                        $('#proceso_grab_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Grabado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);

                        var tr  = '<tr><td style="text-align: left;" class="textAcb">Grabado</td><td class="CellWithComment">' + imgInfo + '<span class="CellComment">Tipo: '+ tipo +', Medidas: '+ largo +'x'+ ancho +', Ubicacion: '+ ubicacion +'</span></td><td class="img_delete delete"></td></tr>';

	                    arrPrincipal.push({"Tipo_acabado": 'Grabado', "tipoGrabado": tipo, "Largo": largo, "Ancho": ancho, "ubicacion": ubicacion});

	                    $('#listAcb' + seccion).append(tr);
                    }
                break;
                case 'Hot':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Hot Stamping";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var color     = arreglo[j]['Color'];
                        //var ubicacion = aAcb['HotStamping'][i]['ubicacion'];
                        var cUPlaca   = arreglo[j]['placa_costo_unitario'];
                        var cTPlaca   = arreglo[j]['placa_costo'];
                        var cUPel     = arreglo[j]['pelicula_costo_unitario'];
                        var cTPel     = arreglo[j]['pelicula_costo'];
                        var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                        var cTArr     = arreglo[j]['arreglo_costo'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var cUTir     = arreglo[j]['costo_unitario'];
                        var cTTir     = arreglo[j]['costo_tiro'];

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Color: '+ color +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Placa</td><td>$'+ cUPlaca +'</td><td>$'+ cTPlaca +'</td></tr><tr><td>Pelicula</td><td>$'+ cUPel +'</td><td>$'+ cTPel +'</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_HS').append(tr);

                        $('#proceso_hs_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado HotStamping</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen); 

                        var tr  = '<tr><td style="text-align: left;" class="textAcb">Hot Stamping</td><td class="CellWithComment">' + imgInfo + '<span class="CellComment">Tipo: '+ tipo +', Color: '+ color +', Medidas: '+ largo +'x'+ ancho +'</span></td><td class="img_delete delete"></td></tr>';

	                    arrPrincipal.push({"Tipo_acabado": 'Hot Stamping', "tipoGrabado": tipo, "ColorHS": color, "LargoHS": largo, "AnchoHS": ancho});

	                    $('#listAcb' + seccion).append(tr); 
                    }
                break;
                case 'Lam':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Laminado";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var costo     = arreglo[j]['costo_unitario'];

                        var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td>Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td>Costo Unitario</td><td>Total</td></tr><tr><td>$'+ costo +'</td><td>$'+ total +'</td></tr><tr><td colspan="2"></td></tr>';

                        $('#table_proc_Lam').append(tr);

                        $('#proceso_lam_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Laminado</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen);

                        var tr  = '<tr><td style="text-align: left;" class="textAcbEmp">Laminado</td><td class="CellWithComment">' + imgInfo + '<span class="CellComment">Tipo: '+ tipo +'</span></td><td class="img_delete delete"></td></tr>';

	                    arrPrincipal.push({"Tipo_acabado": 'Laminado', "tipo": tipo});

	                    $('#listAcb' + seccion).append(tr); 
                    }
                break;
                case 'Sua':

                    for (let j = 0; j < arreglo.length ; j++) {

                        var nombre    = "Suaje";
                        var tipo      = arreglo[j]['tipoGrabado'];
                        var largo     = arreglo[j]['Largo'];
                        var ancho     = arreglo[j]['Ancho'];
                        var total     = arreglo[j]['costo_tot_proceso'];
                        var costo     = arreglo[j]['costo_unitario'];
                        var cUArr     = arreglo[j]['arreglo_costo_unitario'];
                        var cTArr     = arreglo[j]['arreglo'];
                        var cUTir     = arreglo[j]['tiro_costo_unitario'];
                        var cTTir     = arreglo[j]['costo_tiro'];

                        var tr = '<tr><td colspan="3" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr style="background: #87ceeb73;"><td colspan="2">Tipo: '+ tipo +'</td><td>Tamaño: '+ largo +'x'+ ancho +'</td></tr><tr><td></td><td>Costo Unitario</td><td>Subtotal</td></tr><tr><td>Arreglo</td><td>$'+ cUArr +'</td><td>$'+ cTArr +'</td></tr><tr><td>Tiro</td><td>$'+ cUTir +'</td><td>$'+ cTTir +'</td></tr><tr style="border-top: 2px solid #cccc;"><td></td><td>Total</td><td>$'+ total +'</td></tr><tr><td colspan="3"></td></tr>';

                        $('#table_proc_Suaje').append(tr);

                        $('#proceso_suaje_M1').show();

                        var trResumen = '<tr><td></td><td>Acabado Suaje</td><td>$'+ total +'<input type="hidden" class="pricesresumenempalme" value="'+ total +'"></td><td></td></tr>';

                        $('#resumen'+seccion).append(trResumen );

                        var tr  = '<tr><td style="text-align: left;" class="textAcb">' + nombre +'</td><td class="CellWithComment">' + imgInfo + '<span class="CellComment">Tipo: '+ tipo +', Medidas: '+ largo +'x'+ ancho +'</span></td><td class="img_delete delete"></td></tr>';

	                    arrPrincipal.push({"Tipo_acabado": nombre, "tipoGrabado": tipo, "LargoSuaje": largo, "AnchoSuaje": ancho});

	                    $('#listAcb' + seccion).append(tr); 
                    }
                break;
            }
        }
	}

    // esta funcion sirve para la modificacion de regalo. Se utiliza en modificacion regalo
	appndPapeles(arrPapel, seccion){

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

	    this._secciones.find( function(sec){

	    	var tmp = seccion.split('_')[1];

	    	if( sec['siglasP'].indexOf(tmp) == 0 ){

	    		titulo = sec['titulo'];
	    		return true;
	    	}
	    });
	    var tr = '<tr><td colspan="2" style="background: steelblue;color: white;">'+ titulo +'</td></tr><tr><td>Material</td><td>'+ nombreP +'</td></tr><tr><td>Cortes Aplicados</td><td>Largo: '+ largo +' Ancho: '+ ancho +'</td></tr><tr><td>Piezas por Hoja</td><td>'+ cortes +'</td></tr><tr><td>Hojas necesarias (sin merma)</td><td>'+ totalPliegos +'</td></tr><tr><td>Costo Total</td><td>$'+ costoTotal +'<input type="hidden" class="prices" value="' + costoTotal + '"></td></tr>';

	    $('#table_papeles_tr').append(tr);

	    var trResumen = '<tr><td></td><td>Papel '+ nombreP +'</td><td>$'+ costoTotal +'<input type="hidden" class="pricesresumenempalme" value="' + costoTotal + '"></td><td></td></tr>';

	    $('#resumen'+seccion).append(trResumen);
	}

    //Se utiliza en modificacion caja regalo. Muestra toda la cotizacion guardada
	printCotizacion(AGlobal){

		var idCajon = parseInt(AGlobal['CartonCaj']['id_cajon']);
	    var idCartera = parseInt(AGlobal['CartonCar']['id_cartera']);

	    $("#grosor_cajon_1 option[data-id=" + idCajon +"]").attr("selected", true);

	    $("#grosor_cartera_1 option[data-id=" + idCartera +"]").attr("selected", true);

		this.odtAnt = AGlobal['id_odt'];
	    
	    this._descuento = AGlobal['descuento_pctje'];
	    this._cliente = this.getIdClient();
        var i = 0;
        var tableresumen = "";

        this._secciones.forEach( function(sec){

        	tableresumen += 
	    	`
	    		<tbody id="resumen` + sec['siglas'] + `">
                    <!-- -->
                </tbody>
	    	`;
        });

        this.appendResumen(tableresumen);

        //imprime titulos para resumen

        var tr = '<tr style="background: steelblue;color: white;"><td class="text-light">Parte</td><td class="text-light">Material</td><td class="text-light">C. Unitario</td><td class="text-light">Cortes</td><td class="text-light">P. por hoja</td><td class="text-light">H. sin merma</td><td class="text-light">C. Total</td></tr>';
        $('#table_papeles_tr').append(tr);

	    this._secciones.forEach( function(sec){

	    	var tr = '<tr><td><b>' + sec['titulo'] + '</b></td><td></td><td></td><td></td></tr>';
	    	$('#resumen'+sec['siglas']).append(tr);
	    });
        
        var trMensajeria = '<tr><td><b>Costo Mensajería</b></td><td></td><td></td><td></td></tr>';
	    var trEmpaque = '<tr><td><b>Costo Empaque</b></td><td></td><td></td><td></td></tr>';
	    var trEncuadernacion = '<tr><td><b>Encuadernación</b></td><td></td><td></td><td></td></tr>';

	    // (MENSAJERIA)
            var costo_msj = "<tr><td></td><td></td><td></td><td>$" + AGlobal['mensajeria'] + "</td></tr>";
            $('#resumenMensajeria').append(costo_msj);

        // (EMPAQUE)
            var costo_emp = "<tr><td></td><td></td><td></td><td>$" + AGlobal['empaque'] + "</td></tr>";
            $('#resumenEmpaque').append(costo_emp);

        //ENCUADERNACION
            //esperar a que me pase los datos el señor pablito
            //var trEncuadernacion = "<tr><td></td><td></td><td></td><td>$" + AGlobal['Encuadernacion_emp']['costo_tot_proceso'] + "</td></tr>";
            //$("#resumenEncuadernacion").append(trEncuadernacion);


	    $('#resumenMensajeria').append(trMensajeria);
	    $('#resumenEmpaque').append(trEmpaque);
	    $('#resumenEncuadernacion').append(trEncuadernacion);

	    this._secciones.forEach( function(sec){

	    	var texto = "Papel_" + sec['siglasP'];
	    	var siglMin = sec['siglasP'].toLowerCase();
	    	var papel = AGlobal[texto]['id_papel'];
	    	var toggle = false;
            if ( i == 0 ) toggle = true; i++;
            if (siglMin == "emp" ) siglMin = "empcaj";

            this.divSeccionesA(sec['titulo'], sec['option'] ,sec['siglas'], sec['img'], toggle,papel);
	    	//apendizacion de papeles
            this.appndPapelCarton( AGlobal, AGlobal[texto], sec['titulo'] );
	    }.bind(this));

        // CARTONES
        this.appndPapelCarton( AGlobal, AGlobal['CartonCaj'], "Cartón Cajón" );
        this.appndPapelCarton( AGlobal, AGlobal['CartonCar'], "Cartón Tapa" );

        //IMPRESIONES Y ACABADOS
        this.appndImpMod(AGlobal, 'OffEmp DigEmp SerEmp OffFCaj DigFCaj SerFCaj OffFCar DigFCar SerFCar OffG DigG SerG Off_maq_Emp Off_maq_FCaj');
                
        this.appndAcbMod(AGlobal, 'Barniz_UV Laser Grabado HotStamping Laminado Suaje BarnizFcaj LaserFcaj GrabadoFcaj HotStampingFcaj LaminadoFcaj SuajeFcaj BarnizFcar LaserFcar GrabadoFcar HotStampingFcar LaminadoFcar SuajeFcar BarnizG LaserG GrabadoG HotStampingG LaminadoG SuajeG');
	    
	    var cierres    = AGlobal['Cierres'];
	    var accesorios = AGlobal['Accesorios'];
	    var bancos     = AGlobal['Bancos'];

	    this.prinCie(cierres);
	    this.prinBan(bancos);
	    this.prinAcc(accesorios);

        let parteresumen = '<tr><td></td><td></td><td><b>Subtotal:</b></td><td class="grand-total"><b>$' + AGlobal['costo_subtotal'] +'</b></td></tr><tr><td></td><td></td><td>Utilidad: </td><td id="UtilidadResumen">$' + AGlobal['Utilidad'] + '</td></tr><tr><td></td><td></td><td>IVA:</td><td id="IVAResumen">$' + AGlobal['iva'] + '</td></tr><tr><td></td><td></td><td>ISR: </td><td id="ISResumen">$' + AGlobal['ISR'] + '</td></tr><tr><td></td><td></td><td>Comisiones: </td><td id="ComisionesResumen">$ ' + AGlobal['comisiones'] + '</td></tr><tr><td></td><td></td><td>% Indirecto: </td><td id="IndirectoResumen">$' + AGlobal['indirecto'] + '</td></tr><tr><td></td><td></td><td>Ventas: </td><td id="ventaResumen">$' + AGlobal['ventas'] + '</td></tr><tr><td></td><td></td><td>Descuento: </td><td id="descuentoResumen">$' + AGlobal['descuento'] + '</td></tr><tr><tr><td></td><td></td><td><b>Total: </b></td><td id="TotalResumen"><b>$' + AGlobal['costo_odt'] + '</b></td></tr>';

        $('#resumenOtros').append(parteresumen); //imprime para el resumen

	    $("#tdSubtotalCaja").html("$" + AGlobal['costo_subtotal']);
        $("#UtilidadDrop").html("$" + AGlobal['Utilidad']);
        $("#Totalplus").html("$" + AGlobal['costo_odt']);
        $("#IVADrop").html("$" + AGlobal['iva']);
        $("#ComisionesDrop").html("$" + AGlobal['comisiones']);
        $("#IndirectoDrop").html("$" + AGlobal['indirecto']);
        $("#VentasDrop").html("$" + AGlobal['ventas']);
        $("#ISRDrop").html("$" + AGlobal['ISR']);
        $("#DescuentoDrop").html("$" + AGlobal['descuento']);

        let descuento = parseInt(AGlobal['descuento']);
        
        if( descuento !== 0 ) $(".d-check[value=" + descuento +"]").prop('checked',true);
	}
}


//accion onclick botones

//Boton Calcular
$("#btnCalcularC").click( function() {

    caja.calculateCotizacion();
});

$("#btnImprimir").click( function(){

    var ventana = window.open(caja._url +"cotizador/imprCaja/?model=1", "Impresion", "width=600, height=600");
    return true;
});

$("#btnCalculadora").click( function(){

    var ventana = window.open(caja._url +"regalo/printBoxCalculate");
    return true;
});

$(document).on('click', '.active-result', function (e) {
        
    caja.desactivarBtn();
});

$(document).on('keyup', '.chosen-container', function (e) {
        
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code==13){
        caja.desactivarBtn();
    }
});

// focus => Ancho Interior
$(document).on("focus", "#corte_ancho", function () {

    $('#image_1_ancho').show();
    $('#image_1').hide();
});


// focus => Alto Interior
$(document).on("focus", "#corte_largo", function () {

    $('#image_1_alto').show();
    $('#image_1').hide();
});


// focus => profundidad
$(document).on("focus", "#profundidad_1", function () {

    $('#image_1_profundidad').show();
    $('#image_1').hide();
});


// focusout
$(document).on("focusout", "#corte_largo", function () {

    $('#image_1_alto').hide();
    $('#image_1').show();
});


// focusout => Ancho Interior
$(document).on("focusout", "#corte_ancho", function () {

    $('#image_1_ancho').hide();
    $('#image_1').show();
});


// focusout => profundidad
$(document).on("focusout", "#profundidad_1", function () {

    $('#image_1_profundidad').hide();
    $('#image_1').show();
});
