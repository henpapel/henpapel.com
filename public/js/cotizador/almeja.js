class Almeja extends Cajas{

    constructor( params = {} ) {
        
        super( params );
    }

    //esta funcion sirve al cotizar una caja regalo. Se encuentra en el ajax
    appndPapelCarton(arrPrincipal, arrPapel, parte ){

        if (  arrPapel == "" ||  arrPapel == undefined ) return false;

        //Esta pequeña parte pega en el boton tablas en la seccion cortes de hojas los papeles y cartones.
        var nombre        = arrPapel['nombre_papel'];
        var ancho         = arrPapel['calculadora']['corte_ancho'];
        var largo         = arrPapel['calculadora']['corte_largo'];
        var costoUnitario = arrPapel['costo_unit_papel'];
        var costoTotal    = arrPapel['tot_costo'];
        var corte         = arrPapel['corte'];
        var pliegos       = arrPapel['tot_pliegos'];

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
        $('#resumen' + tabla ).append(trResumen);
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
            
            let barniz   = parte.search('barniz')
            let laser    = parte.search('laser')
            let grabado  = parte.search('grabado')
            let hs       = parte.search('laser')
            let laminado = parte.search('laser')
            let suaje    = parte.search('laser')
            
            console.log(parte)
            
            let seccion = ''
            
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

                this.appndPapelCarton( respuesta, respuesta['costo_grosor_carton'], "Cartón Cajón" );
                this.appndPapelCarton( respuesta, respuesta['costo_grosor_tapa'], "Cartón Tapa" );
            
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

            //RESUMEN

                var parteresumen = '<tr><td></td><td></td><td></td><td class="totalEmpalme">$0.00</td></tr>';

                $('#resumenEmpalme').append(parteresumen); //imprime para el resumen

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

$("#imgEC").mouseover( function(){

    $("#imgEC").find("img").prop("src", "<?=URL?>public/img/almeja-EC.gif");
});

$("#imgEC").mouseout( function(){

    $("#imgEC").find("img").prop("src", "<?=URL?>public/img/banco.png");
});

$("#imgFCaj").mouseover( function(){

    $("#imgFCaj").find("img").prop("src", "<?=URL?>public/img/almeja-FCaj.gif");
});

$("#imgFCaj").mouseout( function(){

    $("#imgFCaj").find("img").prop("src", "<?=URL?>public/img/banco2.png");
});

$("#imgFCar").mouseover( function(){

    $("#imgFCar").find("img").prop("src", "<?=URL?>public/img/almeja-G.gif");
});

$("#imgFCar").mouseout( function(){

    $("#imgFCar").find("img").prop("src", "<?=URL?>public/img/banco.png");
});

$("#imgG").mouseover( function(){

    $("#imgG").find("img").prop("src", "<?=URL?>public/img/almeja-FCar.gif");
});

$("#imgG").mouseout( function(){

    $("#imgG").find("img").prop("src", "<?=URL?>public/img/banco2.png");
});