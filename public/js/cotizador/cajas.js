class Cajas {

	constructor( params = {} ){

		( {
			nombCliente: this._nombCliente = 0,
			odt: this._odt = 0,
			base: this._base = 0,
			alto: this._alto = 0,
			tiraje: this._tiraje = 0,
			secciones: this._secciones = [],
			bancos: this._bancos = [],
			cierres: this._cierres = [],
			accesorios: this._accesorios = [],
			idCliente: this._idCliente = 0,
			url: this._url = '',
			descuento: this._descuento = 0,
			nvaImp: this._nvaImp = '',
			nvaAcb: this._nvaAcb = '',
			grabar: this._grabar = '',
			modificar: this._modificar = '',
            papeles: this._papeles = [],
            odtAnt: this._odtAnt = 0
		} = params );
	}

	get banco (){

		return this._bancos;
	}

	get accesorio (){

		return this._accesorios;
	}

    set accesorio( accesorio ){

        this._accesorios.push(accesorio);
    }

    set banco( banco ){

        this._bancos.push(banco);
    }

    set cierre( cierre ){

        this._cierres.push(cierre);
    }

	get cierre (){

		return this._cierres;
	}

	get cliente (){

		return this._idCliente;
	}

    set cliente ( cliente ){

        this._idCliente = cliente;
    }

    set odtAnt( odtAnt ){

        this._odtAnt = odtAnt;
    }
    get odtAnt(){

        return this._odtAnt;
    }

	get secciones(){

		return this._secciones;
	}

	get descuento(){

		return this._descuento;
	}

	set descuento( descuento ){

		this._descuento = descuento;
	}

	set url( url ){

		this._url = url;
	}

	set nvaImp( nvaImp ){

		this._nvaImp = nvaImp; 
	}

	set nvaAcb( nvaAcb ){

		this._nvaAcb = nvaAcb; 
	}

	getIdClient() {

	    var url     = location.href;
	    var cliente = url.split("?");

	    cliente = cliente[1].split("=");
	    cliente = cliente[1].split("&");
	    cliente = parseInt(cliente[0]);

	    return cliente;
	}

    emptyTables(){

        $('#table_adicionales_tr').empty();
        this._secciones.forEach( function(sec){

            $('#resumen'+ sec['siglas']).empty();
        })
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

    chkPaper(){

        var chk   =$("#btnCheckPaper").prop("checked");
        //este id se genera con el plugin chosen
        var option = this._secciones[0]['option'];

        var texto = $("#" + option + "_chosen span").html();

        if(chk) {

            this._secciones.forEach( function(sec){

                var opt = sec['option'] + " option[data-nombre='" + texto +"']";
                $("#" + opt).prop("selected",true);
                $("#" + sec['option'] + "_chosen span").html(texto);
            })

        } else {
            var i = 0;
            this._secciones.forEach( function(sec){

                if ( i !== 0 ) {
                    
                    $("#" + sec['option'] + "_chosen span").html("Elegir tipo de papel");
                    $("#" + sec['option']).val(null);
                }
                i++;
            })
        }
    }

    saveImpresion(){

        var nva = this._nvaImp;

        this._secciones.find( function(sec){

            if( sec['siglas'].indexOf(nva) == 0 ){

                this.saveBtnImpresiones(sec['aImp'],"listImp"+sec['siglas']);
                this.desactivarBtn();
                return true;
            }
        }.bind(this));
    }

	saveAcabado(){

		var nva = this._nvaAcb;

		this._secciones.find( function(sec){

	    	if( sec['siglas'].indexOf(nva) == 0 ){
	    			
	    		this.saveBtnAcabados(sec['aAcb'],"listAcb"+sec['siglas']);
                this.desactivarBtn();
	    		return true;
	    	}
	    }.bind(this));
	}

	saveBtnImpresiones(arrpapeles, tabla) {

        var IDopImp  = $("#miSelect option:selected").data('id');
        var opImp    = $("#miSelect option:selected").text();
        var precio   = $("#miSelect option:selected").data('precio'); //precio unitario
        var alertDiv = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Atencion!</strong> No seleccionaste todos los elementos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

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

                var imp  = '<tr><td class="textImp">' + opImp + '</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="' + tabla +' img_delete delete"></td></tr>';
                
                arrpapeles.push({"Tipo_impresion": opImp, "tintas": tintas, "tipo_offset": tipo});

                $('#Impresiones').modal('hide');

                $('#' + tabla).append(imp);

                vacioModalImpresiones();
            }
        }

        if (opImp == 'Digital') {

            var tipo   = $("#SelectImpDigital option:selected").text();
            var imp  = '<tr><td class="textImp">' + opImp + '</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Se agregó una impresión digital</span></td><td class="' + tabla +' img_delete delete"></td></tr>';
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

                var imp  = '<tr><td class="textImp">' + opImp +'</td></td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Numero de Tintas: '+ tintas +', Tipo: '+ tipo +'</span></td><td class="' + tabla +' img_delete delete"></td></tr>';

                arrpapeles.push({"Tipo_impresion": opImp,  "tintas": tintas, "tipo_offset": tipo});

                $('#Impresiones').modal('hide');

                $('#' + tabla).append(imp);

                vacioModalImpresiones();
            }
        }
    }

    saveBtnAcabados(arrPapeles, tabla) {


        var IDopAcb  = $("#SelectAcEmp option:selected").data('id');
        var opAcb    = $("#SelectAcEmp option:selected").text();

        var alertDiv = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Atencion!</strong> No seleccionaste todos los elementos.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        switch(opAcb){

            case "Laminado":

                var tipo  = $("#SelectLaminadoEmp option:selected").text();
                var id    = $("#SelectLaminadoEmp option:selected").data('id');
                var nuloo = document.getElementById('SelectLaminadoEmp').value;

                if (nuloo == 'selected') {

                    document.getElementById('alerterror').innerHTML = alertDiv;

                } else {

                    document.getElementById('alerterror').innerHTML = "";

                    var tr  = '<tr><td style="text-align: left;" class="textAcbEmp">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: '+ tipo +'</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                    arrPapeles.push({"Tipo_acabado": opAcb, "tipo": tipo});

                    $('#acabados').modal('hide');

                    $('#' + tabla).append(tr);

                    vacioModalAcabados();
                }
            break;

            case "HotStamping":

                var tipo    = $("#SelectHSEmp option:selected").text();
                var id      = $("#SelectHSEmp option:selected").data('id');
                var color   = $("#SelectColorHSEmp option:selected").text();
                var idColor = $("#SelectHSEmp option:selected").data('id');
                var largo   = parseFloat(document.getElementById('LargoHS_ver').value,10);
                var ancho   = parseFloat(document.getElementById('AnchoHS_ver').value,10);
                var nulo1   = document.getElementById('SelectHSEmp').value;
                var nulo2   = document.getElementById('SelectColorHSEmp').value;

                if (nulo1 == 'selected' || nulo2 == 'selected' ) {

                    document.getElementById('alerterror').innerHTML = alertDiv;

                } else {

                    document.getElementById('alerterror').innerHTML = "";

                    var tr  = '<tr><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: '+ tipo +', Color: '+ color +', Medidas: '+ largo +'x'+ ancho +'</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                    arrPapeles.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo, "ColorHS": color, "LargoHS": largo, "AnchoHS": ancho});

                    $('#acabados').modal('hide');

                    $('#' + tabla).append(tr);

                    vacioModalAcabados();
                }
            break;

            case "Grabado":

                var tipo      = $("#SelectGrabEmp option:selected").text();
                var idTipo    = $("#SelectHSEmp option:selected").data('id');
                var largo     = parseFloat(document.getElementById('LargoGrab').value);
                var ancho     = parseFloat(document.getElementById('AnchoGrab').value);
                var ubicacion = $("#SelectUbiGrabEmp option:selected").text();
                var nulo1 = document.getElementById('SelectGrabEmp').value;
                var nulo2 = document.getElementById('SelectUbiGrabEmp').value;

                if (nulo1 == 'selected' || nulo2 == 'selected' ) {

                    document.getElementById('alerterror').innerHTML = alertDiv;

                } else {

                    document.getElementById('alerterror').innerHTML = "";

                    var tr  = '<tr><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: '+ tipo +', Medidas: '+ largo +'x'+ ancho +', Ubicacion: '+ ubicacion +'</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                    arrPapeles.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo, "Largo": largo, "Ancho": ancho, "ubicacion": ubicacion});

                    $('#acabados').modal('hide');

                    $('#' + tabla).append(tr);

                    vacioModalAcabados();
                }
            break;

            case "Suaje":

                var tipo   = $("#SelectSuajeEmp option:selected").text();
                var idTipo = $("#SelectHSEmp option:selected").data('id');
                var largo  = parseFloat(document.getElementById('LargoSuaje').value);
                var ancho  = parseFloat(document.getElementById('AnchoSuaje').value);
                var nulo1 = document.getElementById('SelectSuajeEmp').value;

                if (nulo1 == 'selected') {

                    document.getElementById('alerterror').innerHTML = alertDiv;

                } else {

                    document.getElementById('alerterror').innerHTML = "";

                    var tr  = '<tr><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: '+ tipo +', Medidas: '+ largo +'x'+ ancho +'</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                    arrPapeles.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo, "LargoSuaje": largo, "AnchoSuaje": ancho});

                    $('#acabados').modal('hide');

                    $('#' + tabla).append(tr);

                    vacioModalAcabados();
                }
            break;

            case "Corte Laser":

                var tipo   = $("#SelectLaserEmp option:selected").text();
                var idTipo = $("#SelectHSEmp option:selected").data('id');
                var nulo1  = document.getElementById('SelectLaserEmp').value;

                if (nulo1 == 'selected')  {

                    document.getElementById('alerterror').innerHTML = alertDiv;

                } else {

                    document.getElementById('alerterror').innerHTML = "";

                    var tr = '<tr><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: ' + tipo + '</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                    arrPapeles.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo});

                    $('#acabados').modal('hide');

                    $('#' + tabla).append(tr);

                    vacioModalAcabados();
                }
            break;

            case "Barniz UV":

                var tipo   = $("#SelectBarnizUVEmp option:selected").text();
                var idTipo = $("#SelectHSEmp option:selected").data('id');
                var largo  = parseFloat(document.getElementById('LargoBarUVEmp').value);
                var ancho  = parseFloat(document.getElementById('AnchoBarUVEmp').value);
                var nulo1  = document.getElementById('SelectBarnizUVEmp').value;

                if (nulo1 == 'selected') {

                    document.getElementById('alerterror').innerHTML = alertDiv;

                } else {

                    document.getElementById('alerterror').innerHTML = "";

                    if(tipo == "Registro Mate" || tipo == "Registro Brillante") {

                        var tr  = '<tr><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: ' +  tipo + ', Medidas: ' + largo + 'x' + ancho +'</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                        arrPapeles.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo, "Largo": largo, "Ancho": ancho});
                    } else {

                        var tr  = '<tr><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: ' +  tipo + '</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                        arrPapeles.push({"Tipo_acabado": opAcb, "tipoGrabado": tipo, "Largo": null, "Ancho": null});
                    }

                    $('#acabados').modal('hide');

                    $('#' + tabla).append(tr);

                    vacioModalAcabados();
                }
            break;

            case "Pegados Especiales":

                var tipoEspeciales   = $("#SelectEspecialesEmp option:selected").text();
                var idtipoEspeciales = $("#SelectHSEmp option:selected").data('id');
                var nulo1 = document.getElementById('SelectEspecialesEmp').value;

                if (nulo1 == 'selected') {

                    document.getElementById('alerterror').innerHTML = alertDiv;

                } else {

                    document.getElementById('alerterror').innerHTML = "";

                    var acb  = '<tr><td style="text-align: left;" class="textAcb">' + opAcb +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: '+ tipoEspeciales +'</span></td><td class="' + tabla + ' img_delete delete"></td></tr>';

                    $('#acabados').modal('hide');

                    $('#' + tabla).append(acb);

                    vacioModalAcabados();
                }
            break;
        }
    }

	delBtnSec(tabla,index){

        this.desactivarBtn();
		var impAcb = tabla.slice('4','7');
		var seccion = tabla.slice('7');
        
		this._secciones.find( function(sec){

	    	if( sec['siglas'].indexOf(seccion) == 0 ) {
	    		
	    		sec['a'+impAcb].splice(index,1);
	    		return true;
	    	}
	    });
	}

    delBtnAcc(index){

        this.desactivarBtn();
        this._accesorios.splice(index,1);
    }

    delBtnBan(index){

        this.desactivarBtn();
        this._bancos.splice(index,1);
    }

    delBtnCie(index){

        this.desactivarBtn();
        this._cierres.splice(index,1);
    }

    appndMsgError(error){

        var divError = $("#modError").html();
        
        if( divError !== undefined ){

            $("#modError").remove();
        }
        var btnError = `

            <div id="modError">
                <a class="btn btn-danger" data-toggle="collapse" href="#ModmsgError" role="button" aria-expanded="false" aria-controls="ModmsgError">
                        Ver mas...
                </a>
                <div class="collapse" id="ModmsgError">
                    <div class="card card-body" id="txtError">
                        
                    </div>
                </div>
            </div>
        `;
        $("#modBody").append(btnError);
        $("#txtError").html(error);
    }

    showModError(proceso) {

        $("#txtContenido").html("No existe el costo para el proceso: " + proceso + " con este tiraje.");

        // $("#modalError").modal("show");
        $('#modalError').modal({backdrop: 'static', keyboard: false});
    }
    showModCorrecto(texto) {

        $("#txtContCorrecto").html(texto);

        $('#modalCorrecto').modal({backdrop: 'static', keyboard: false});
    }

    revisarPropiedades(variable, texto){

        if( variable == null || variable == "" || variable == undefined ){

            this.showModError("");
            $("#txtContenido").html();
            $("#txtContenido").html("Ingrese " + texto);
            return false;
        }
    }

    showLoading(){

        $("#modLoading").show();
    }

    hideLoading(){

        $("#modLoading").hide();
    }

    activarBtn() {

        $("#btnImprimir").prop("disabled",false);
        $("#btnActG").prop("disabled",false);
        $("#btnCalculadora").prop("disabled",false);
    }


    desactivarBtn() {
        
        $("#btnImprimir").prop("disabled",true);
        $("#btnActG").prop("disabled",true);
        $("#btnCalculadora").prop("disabled",true);
    }

    changeData(url){
        var direccion = this._url + url;
        $("#dataForm").prop("action","");
        $("#dataForm").prop("action", direccion);
        this.imgInfo= `<img style="width: 20px; height: 20px;" src="${this._url}public/img/info-warning-icon.png" />`;

        /* Función para que se alargue el div de medidas. */
        let width = parseFloat($(".div-izquierdo").css("width"))

        if( width < 120 ){

            $("#divContentI").css("z-index","9");
            $(".div-izquierdo").css("width","45%");
            $(".divImgC").css("width","45%");
            $(".div-buttons").css("width","45%");
            $("#divContentI").css("width","45%");

            $("#divContentI").hover( function(){

                $("#divContentI").css("width","100%");
            }, function(){

                $("#divContentI").css("width","45%");
            });
        }
    }

    divSecciones(titulo, idOpt, seccion, imagen, activa){

        var boton = 
        `
            <!-- Mismo papel para todos -->
            <div class="custom-control custom-checkbox mr-sm-2">
            
                <input type="checkbox" name="btnCheckPaper" id="btnCheckPaper" class="custom-control-input" onclick="caja.chkPaper()">
                <label class="custom-control-label" for="btnCheckPaper"style="font-size: 15px; cursor: pointer;" class="btn btn-outline-primary">Mismo Papel P/Todos</label>
            </div>
        </div>
        `
        var check = activa ? boton : '</div><br>';
        
        //cambie caja.nvaImp='seccion' deberia estar divisionesImp
        //cambie caja.chkPaper deberia estar chkPaper();
        //divisionesAcb();
        var divSeccion = `
            <div class="divgral">
                <div id="img` + seccion + `" class="secciones divContenido">
                    <img src="` + imagen + `"  style="width: 40%;">
                    <br>
                    <label class="lblTituloSec">` + titulo + `</label>
                </div>
                <br>
                <div>
                    <select class="chosen forros" name="` + idOpt +`" id="` + idOpt + `" tabindex="9" required>
                        <option selected disabled>Elegir tipo de papel</option>` + this._papeles + `
                    </select>
                ` + check + `
                <div>
                    <button type="button" class="btn btn-block btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#Impresiones" onclick="caja.nvaImp='` + seccion + `'"><img border="0" src="` + this._url + `public/img/add.png" style="width: 15px;"> Impresiones
                    </button>
                    <div class="container divimpresiones">
                        <table class="table">
                            <tbody id="listImp` + seccion + `">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <button type="button" class="btn btn-block btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#acabados" onclick="caja.nvaAcb='` + seccion + `'"><img border="0" src="` + this._url + `public/img/add.png" style="width: 15px;"> Acabados
                    </button>
                    <div class="container divacabados">
                        <table class="table">
                            <tbody id=listAcb` + seccion + `>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>`;

        $("#divDerecho").append(divSeccion);
        $(".chosen").chosen({width: "100%",no_results_text: "Ups! No hay resultados para."});
    }

    divSeccionesA(titulo, idOpt, seccion, imagen,activa, idPapel){
        
        var boton = 
        `
            <!-- Mismo papel para todos -->
            <div class="custom-control custom-checkbox mr-sm-2">
            
                <input type="checkbox" name="btnCheckPaper" id="btnCheckPaper" class="custom-control-input" onclick="caja.chkPaper()">
                <label class="custom-control-label" for="btnCheckPaper"style="font-size: 15px; cursor: pointer;" class="btn btn-outline-primary">Mismo Papel P/Todos</label>
            </div>
        </div>
        `
        var check = activa ? boton : '</div><br>';
        
        var divSeccion = `
            <div class="divgral">
                <div id="img` + seccion + `" class="secciones divContenido">
                    <img src="` + imagen + `"  style="width: 40%;">
                    <br>
                    <label class="lblTituloSec">` + titulo + `</label>
                </div>
                <br>
                <div>
                    <select class="chosen forros" name="` + idOpt +`" id="` + idOpt + `" tabindex="9" required>
                        <option selected disabled>Elegir tipo de papel</option>` + this._papeles + `
                    </select>
                ` + check + `
                <div>
                    <button type="button" class="btn btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#Impresiones" onclick="caja.nvaImp='` + seccion + `'"><img border="0" src="` + this._url + `public/img/add.png" style="width: 7%;"> Impresiones
                    </button>
                    <div class="container divimpresiones">
                        <table class="table">
                            <tbody id="listImp` + seccion + `">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <button type="button" class="btn btn-outline-primary chkSize btn-sm text-left" data-toggle="modal" data-target="#acabados" onclick="caja.nvaAcb='` + seccion + `'"><img border="0" src="` + this._url + `public/img/add.png" style="width: 7%;"> Acabados
                    </button>
                    <div class="container divacabados">
                        <table class="table">
                            <tbody id=listAcb` + seccion + `>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>`;

        $("#divDerecho").append(divSeccion);
        $("#" + idOpt + " option[value='" + idPapel +"']").prop("selected",true);
        $(".chosen").chosen({width: "100%",no_results_text: "Ups! No hay resultados para."});
    }

    appendResumen(tableresumen){

        var tablaResumen = 
        `
            <div id="resumentodocaja" style="display: none; background: #fff; width: 100%; height: ${heightDisplay}px; transition: transform .5s;">

                <div class="bg-primary d-flex justify-content-end">
                    
                    <button type="button" id="btnQuitarResumen" class="btn btn-primary"><i class="bi bi-x-circle-fill"></i></button>
                </div>

                <div class="d-flex justify-content-around bg-primary text-white">
                    <label>Sección</label>
                    <label>Adiciones</label>
                    <label>Subtotal</label>
                    <label>Total</label>
                </div>

                
                <div style="overflow: auto; height:80%;">

                    <table class="table tableresumenn" id="ResumenCostos" style="width:100%;height:100%">

                        <thead id="resumenHead"></thead>

                        <tbody id="resumenPapeles"></tbody>

                        ` + tableresumen + `

                        <tbody id="resumenEncuadernacion"></tbody>

                        <tbody id="resumenMensajeria"></tbody>

                        <tbody id="resumenEmpaque"></tbody>

                        <tbody id="resumenBancos"></tbody>

                        <tbody id="resumenCierres"></tbody>

                        <tbody id="resumenAccesorios"></tbody>

                        <tbody id="resumenOtros"></tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-start" style="height: 50px; width:100%; align-items: center">
                    <img class="m-1" src="`+ this._url +`public/img/henpp.png" style="width: 11%;"><small>Todos los derechos reservados. Historias En Papel 2019.</small>
                </div>
            </div>
        `;
        $("body").append(tablaResumen);
        $("#resumentodocaja").css("transform","translateY(" + heightDisplay + "px)");
    }

    constructSec(){
        this._cliente = this.getIdClient();
        var i = 0;
        var tableresumen = ""
        this._secciones.forEach( function(sec){
            
            var toggle = false;
            if ( i == 0 ) toggle = true; i++;
            tableresumen += `
                <tbody id="resumen` + sec['siglas'] + `">
                    <!-- -->
                </tbody>`;
            this.divSecciones(sec['titulo'], sec['option'] ,sec['siglas'], sec['img'], toggle);
        }.bind(this));
        this.appendResumen(tableresumen);
    }

    prinCie( cierres ){

        if( cierres !== undefined && cierres !== null ){

            for (var i = 0; i < cierres.length; i++) {

                var tr ="";
                var opCie = cierres[i]['Tipo_cierre'];
                switch(opCie){

                    case "Iman":

                        var numpares = cierres[i]['numpares'];

                        tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Numero de Pares: '+ numpares +'</span></td><td class="img_delete delCie"></td></tr>';
                        this._cierres.push({"Tipo_cierre": opCie, "numpares": numpares, "largo": null, "ancho": null, "tipo": null, "color": null});
                    break;
                    case "Liston":

                        var LarListon = cierres[i]['largo'];
                        var AnchListon = cierres[i]['ancho'];
                        var tipoListon = cierres[i]['tipo'];
                        var colorListon = cierres[i]['color'];
                        tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Largo: '+ LarListon +', Ancho: '+ AnchListon +', Tipo: '+ tipoListon +', Color: '+ colorListon +' </span></td><td class="img_delete delCie"></td></tr>';
                        this._cierres.push({"Tipo_cierre": opCie, "numpares": 1, "largo": LarListon, "ancho": AnchListon, "tipo": tipoListon, "color": colorListon});

                    break;
                    case "Marialuisa":

                        tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Se agrego un cierre Marialuisa</span></td><td class="img_delete delCie"></td></tr>';
                        this._cierres.push({"Tipo_cierre": opCie, "numpares": 1, "largo": null, "ancho": null, "tipo": null, "color": null});

                    break;
                    case "Suaje calado":

                        var LarSuajCal = cierres[i]['largo'];
                        var AnchSuajCal = cierres[i]['ancho'];
                        var tipoSuajCal = cierres[i]['tipo'];
                        tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Largo: '+ LarSuajCal +', Ancho: '+ AnchSuajCal +', Tipo: '+ tipoSuajCal +'</span></td><td class="img_delete delCie"></td></tr>';
                        this._cierres.push({"Tipo_cierre": opCie, "numpares": 1, "largo": LarSuajCal, "ancho": AnchSuajCal, "tipo": tipoSuajCal, "color": null});

                    break;
                    case "Velcro":

                        var numpares = cierres[i]['numpares'];
                        tr = '<tr><td style="text-align: left;">' + opCie +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Numero de Pares: '+ numpares +'</span></td><td class="img_delete delCie"></td></tr>';
                        this._cierres.push({"Tipo_cierre": opCie, "numpares": numpares, "largo": null, "ancho": null, "tipo": null, "color": null});

                    break;
                }
                $('#listcierres').append(tr);
            }
        }
    }

    prinAcc( accesorios ){

        if( accesorios !== undefined && accesorios !== null ){

            for (var i = 0; i < accesorios.length; i++) {

                var tr ="";
                var nombreAccesorio = accesorios[i]['Tipo_accesorio'];
                switch(nombreAccesorio){

                    case "Lengueta de Liston":

                        var largo = accesorios[i]['Largo'];
                        var ancho = accesorios[i]['Ancho'];
                        var color = accesorios[i]['Color'];
                        var precio = accesorios[i]['costo_unit_accesorio'];
                        
                        tr = '<tr><td style="text-align: left;">' + nombreAccesorio +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Largo: ' + largo + ' Ancho: ' + ancho + ' Color: ' + color + '</span></td><td class="img_delete delAcc"></td></tr>';
                        this._accesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": largo, "Ancho": ancho, "Color": color, "Herraje": null, "Precio": precio});
                    break;
                    case "Herraje":

                        var herraje = accesorios[i]['Tipo'];
                        var precio = accesorios[i]['costo_unit_accesorio'];
                        tr = '<tr><td style="text-align: left;">' + nombreAccesorio + '</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Herraje: ' + herraje + '</span></td><td class="img_delete delAcc"></td></tr>';

                        this._accesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": null, "Ancho": null, "Color": null, "Herraje": herraje, "Precio": precio});

                    break;
                    case "Ojillos":

                        var precio = accesorios[i]['costo_unit_accesorio'];
                        tr = '<tr><td style="text-align: left;">' + nombreAccesorio + '</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Se agrego un accesorio Ojillo.</span></td><td class="img_delete delAcc"></td></tr>';

                        this._accesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": null, "Ancho": null, "Color": null, "Herraje": null, "Precio": precio});

                    break;
                    case "Resorte":

                        var largo = accesorios[i]['Largo'];
                        var ancho = accesorios[i]['Ancho'];
                        var color = accesorios[i]['Color'];
                        var precio = accesorios[i]['costo_unit_accesorio'];
                        tr = '<tr><td style="text-align: left;">' + nombreAccesorio +'</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Largo: ' + largo + ' Ancho: ' + ancho + ' Color: ' + color + '</span></td><td class="img_delete delAcc"></td></tr>';

                        this._accesorios.push({"Tipo_accesorio": nombreAccesorio, "Largo": largo, "Ancho": ancho, "Color": color, "Herraje": null, "Precio": precio});

                    break;
                }
                $('#listaccesorios').append(tr);
            }
        }
    }

    prinBan( bancos ){

        if( bancos !== undefined && bancos !== null ){

            for (var i = 0; i < bancos.length; i++) {

                var opBan = bancos[i]['Tipo_banco'];
                var tr = "";
                
                if( opBan === 'Carton' || opBan === 'Eva' || opBan === 'Espuma' || opBan === 'Empalme Banco' ){

                    var LargoMBanco = bancos[i]['largo'];
                    var AnchoMBanco = bancos[i]['ancho'];
                    var ProfundidadMBanco = bancos[i]['profundidad'];
                    var LLevaSuajeM = bancos[i]['Suaje'];
                    tr  = '<tr><td style="text-align: left;">Banco</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: '+ opBan +', Largo: '+ LargoMBanco +', Ancho: '+ AnchoMBanco +', Profundidad: '+ ProfundidadMBanco +', Suaje: '+ LLevaSuajeM +'</span></td><td class="img_delete delBan"></td></tr>';
                    this._bancos.push({"Tipo_banco": opBan, "largo": LargoMBanco, "ancho": AnchoMBanco, "Profundidad": ProfundidadMBanco, "Suaje": LLevaSuajeM});
                }else if( opBan === 'Cartulina Suajada' ){

                    var LargoMBanco = bancos[i]['largo'];
                    var AnchoMBanco = bancos[i]['ancho'];
                    var ProfundidadMBanco = bancos[i]['profundidad'];
                    tr  = '<tr><td style="text-align: left;">Banco</td><td class="CellWithComment">' + this.imgInfo + '<span class="CellComment">Tipo: '+ opBan +', Largo: '+ LargoMBanco +', Ancho: '+ AnchoMBanco +', Profundidad: '+ ProfundidadMBanco +'</span></td><td class="img_delete delBan"></td></tr>';
                    this._bancos.push({"Tipo_banco": opBan, "largo": LargoMBanco, "ancho": AnchoMBanco, "Profundidad": ProfundidadMBanco, "Suaje": null});
                }
                $('#listbancoemp').append(tr);
            }
        }
    }
}