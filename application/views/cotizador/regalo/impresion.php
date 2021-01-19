<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="<?php echo URL; ?>public/js/libs/jquery.min.js"></script>
<script src="<?php echo URL; ?>public/js/libs/jquery-ui.min.js"></script>
<script src="<?php echo URL; ?>public/js/mi.jquery.tools.min.js"></script>
<?php
	function actual_date () {  
	    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
	    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
	    $year_now = date ("Y");  
	    $month_now = date ("n");  
	    $day_now = date ("j");  
	    $week_day_now = date ("w");  
	    $date = "Ciudad de México a" . " " . $day_now . " de " . $months[$month_now] . " de " . $year_now;   
	    return $date;    
	} 
?>
<style type="text/css">

	p{
		margin: 0px;
		margin-bottom: 5px;

	}

	.f-negrita{

		font-weight: bold;
	}

	header{
		position: relative;
		width: 100%;
	}

	.cabezera{
		position: relative;
		width: 100%;
	}

	.propiedades{
    	width: 100%;
		margin: 0px;
		padding: 0px;
	}
	.propiedades h4{
		margin-top: 5px;
		margin-bottom: 5px;
	}
	h4{
		margin: auto;
		margin-bottom: 10px;

	}

	*{
		margin: 20px;
		font-family: "Arial";
		font-size: 11px;
		background: #fff;
	}
	p{
		color: #000;
		text-align: left;
		font-size: 11px;
	}
	.imagen_logo{
    	background-size: 100% 100%;	
    	background-repeat: no-repeat;
    	float: left;
    	width: 50%;
	}
	.contenedor_logo{
		width: 100%;
    	height: 100px;
    	padding: 0px;
    	margin: 0px;
    	margin-bottom: 50px;
	}

	footer{
		float: left;
		position: relative;
		width: 100%;
		margin: 0px;
		padding: 0px;
	}

	.tablaHeader{
		float:right;
		margin: 0px;
		margin-top: 40px;
		margin-right: 50px;
	}
	.precio-imagen{
		float: right;
		margin: 0px;
		padding: 0px;
	}
	.tablaPrecios{
		text-align: center;
		width: 300px;
		height: auto;
		position: static;
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 0px;
		padding: 0px;

	}
	.tablaPrecios p{
		text-align: center;
	}	
	.propiedades_caja{
		float: left;
		position: relative;
		width: 50%;
		margin: 0px;
		padding: 0px;
		display: inline-block;
		position: static;
	}
	.imagen_caja{
		background-repeat: no-repeat;
		width: 300px;
		margin: 0px;
		padding: 0px;
		position:static;
		display: flex;
		justify-content: center;
	}
</style>

<body style="width: 100%; height: 100%; background: #fff;  position: relative; padding: 0px; margin: 0px; overflow-x: hidden;">
	<header class="contenedor_logo">
		<div class="imagen_logo">

			<img src="<?=URL ;?>public/img/logo-hp-con-mini1.png" style="width: 25%;">
		</div>
		<div class="tablaHeader">
			
			<p><?= actual_date(); ?></p>
			<p id="lblCotizacion"></p>
		</div>
	</header>

	<div style="margin: 0px; padding: 0px;">
		<h4 id="lblTienda"></h4>
		<h4 style="margin-bottom: 30px;">Atención</h4>
		<p id="lblCliente"></p>
		<p style="margin-bottom: 30px;">Aprovecho para saludarle y así mismo para enviarle la siguiente cotización de acuerdo a las especifiaciones indicadas.</p>
	</div>
	
	<hr>
	<div class="propiedades">

		<div id="detCaja" class="propiedades_caja">

		</div>

		<div class="precio-imagen">
			<div class="tablaPrecios">
				<table style="position: static;">
					<tr>
						<td>
							<p>Cantidad</p>
						</td>
						<td>
							<p>C. Unitario</p>
						</td>
						<td>
							<p>Total</p>
						</td>
					</tr>
					<tr>
						<td style="border-right: 1px solid;">
							<p class="f-negrita" id="lblTiraje" style="margin-right: 10px;">0</p>
						</td>
						<td style="border-right: 1px solid;">
							<p class="f-negrita" id="lblCUnitario">$0.00</p>
						</td>
						<td>
							<p class="f-negrita" id="lblCTotal" style="margin-left: 10px;">$0.00</p>
						</td>
					</tr>
				</table>
			</div>

			<div id="imagen_caja" class="imagen_caja"></div>
			<div style="margin: 0px; padding:0px;">
				<!--<table style="padding: 0px; margin:0px;">
					<tr>
						<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>

						<td align="center" id="medidas" style="text-align: center;"></td>
					</tr>
				</table>-->
				<div id="medidas" style="margin:0px; padding:0px;margin-left: 100px;"></div>
			</div>
		</div>
	</div>

	<footer>
		<br>
		<p>
			Puede cambiar SIN PREVIO AVISO debido a la volatilidad del dolar
		</p>
		<p>Los precios antes mencionados no incluen I.V.A.</p>
		<hr>
		<p class="f-negrita">Formatos Aceptados:</p>
		<p>InDesign, Illustrator, Photoshop, Page Maker, CorelDraw. Se requiere autorización de arte.</p>
		<p>Esperando la presente le sea de utilidad, quedo a sus órdenes en espera de su atenta respuesta.</p>
	</footer>
</body>
<script type="text/javascript">
	/*window.print();
	window.addEventListener("afterprint", function(){
    	
    	this.close();
	}, false);*/
	try{
		var aJson = [];
		aJson = JSON.parse(localStorage.getItem('js_respuesta'));
		
		console.log(aJson);
		$("#detCaja").empty();

		var cUnitario = parseFloat(aJson['costo_odt'] / aJson['tiraje'] ).toFixed(2);

		$("#lblCUnitario").html("$"+cUnitario);

		$("#lblCotizacion").html(`Cotizacion: <label class='f-negrita'>${aJson.nomb_odt}</label>`);

		$("#lblCTotal").html(`$${aJson.costo_odt}`);
		
		$("#lblTiraje").html(`${aJson.tiraje}`);

		$("#lblTienda").html(`Empresa: ${aJson.id_tienda}`);

		$("#lblCliente").html(`${aJson.nombre_cliente}`);

		$("#detCaja").append('<p>Producto</p>');

		appndPapel(aJson['papel_Emp']);

		appndImpresion(aJson.aImpEmp);
		appndAcabado(aJson.aAcbEmp);

		appndPapel(aJson['papel_EmpTap']);

		appndImpresion(aJson.aImpEmpTap);
		appndAcabado(aJson.aAcbEmpTap);

		appndPapel(aJson['papel_FCaj']);

		appndImpresion(aJson.aImpFCaj);
		appndAcabado(aJson.aAcbFCaj);

		appndPapel(aJson['papel_FTap']);

		appndImpresion(aJson.aImpFTap);
		appndAcabado(aJson.aAcbFTap);

		let img = "";
		switch (aJson.modelo) {
						
			case 1:
				img = "<img src='<?=URL?>public/img/tapa.png'style='width: 90%; height: auto; margin: 0px; padding: 0px'>";
			break;
			case 2:
				img = "<img src='<?=URL?>public/img/2.png'style='width:90%; height: auto; margin: 0px; padding: 0px'>";
			break;
			case 3:
				img = "<img src='<?=URL?>public/images/libro/libro.jpeg'style='width:90%; height: auto; margin: 0px; padding: 0px'>";
			break;
			case 4:
				img = "<img src='<?=URL?>public/img/4.png'style='width:90%; height: auto; margin: 0px; padding: 0px'>";
			break;
			case 5:
				img = "<img src='<?=URL?>public/images/marco/marcointerno.jpeg'style='width:90%; height: auto; margin: 0px; padding: 0px'>";
			break;
			case 6:
				img = "<img src='<?=URL?>public/images/cerillera/cerillera.jpeg'style='width:90%; height: auto; margin: 0px; padding: 0px'>";
			break;
			case 7:
				img = "<img src='<?=URL?>public/images/vino/vino.jpeg'style='width:90%; height: auto; margin: 0px; padding: 0px'>";
			break;
		}

		$("#imagen_caja").append(img);
		
		function nombModelo(modelo){

			let model = parseInt(modelo);
			switch(model){

				case 1:
					return "Almeja"
				break;
				case 2:
					return "Circular"
				break;
				case 3:
					return "Libro"
				break;
				case 4:
					return "Regalo"
				break;
			}
		}

		$("#medidas").append(`<p>Tipo: ${nombModelo(aJson.modelo)}.</p>`);

		$("#medidas").append(`<p class="text-center" style="margin: 0px; padding:0px;">Tamaño: ${aJson.base} x ${aJson.alto} <br> Profundidad cajón: ${aJson.profundidad_cajon} <br> Profundidad tapa: ${aJson.profundidad_tapa}</p>`);

		function appndPapel( arrPapel ){

			var tr = `<p class="f-negrita">Papel interior del cajón forrado en: ${arrPapel.nombre_papel}</p>;`
			$("#detCaja").append(tr);
		}

		function appndImpresion( aImp ){

			if ( aImp == undefined ) return false;
	    	if ( aImp['Offset'] !== undefined ) var offset        = aImp['Offset'];
	    	if ( aImp['maquila'] !== undefined ) var offsetMaquila = aImp['maquila'];
	    	if ( aImp['Digital'] !== undefined ) var digital       = aImp['Digital'];
	    	if ( aImp['Serigrafia'] !== undefined )var serigrafia    = aImp['Serigrafia'];

	    	if( offset !== undefined ){

	    		for( var i = 0; i< offset.length; i++ ){

	    			var tipo   = offset[i]['tipo_offset'];
					var tintas = offset[i]['num_tintas'];

					var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Impresion Offset Tipo: ${tipo}, Tintas: ${tintas}</p>`;
					$("#detCaja").append(tr);
	    		}
	    	}

	    	if( digital ){

	    		for( var i = 0; i< digital.length; i++ ){

	    			var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Impresion Digital</p>';
	    			$("#detCaja").append(tr);
	    		}
	    	}

	    	if( serigrafia ){

	    		for( var i = 0; i< serigrafia.length; i++ ){

		    		var tipo   = serigrafia[i]['tipo'];
					var tintas = serigrafia[i]['num_tintas'];

					var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Impresion Serigrafia Tipo: ${tipo}, Tintas:  ${tintas} </p>`;
					$("#detCaja").append(tr);
				}
	    	}
		}

		function appndAcabado( aAcb ){

			if ( aAcb == undefined ) return false;

			var barniz      = aAcb['Barniz_UV'];
		    var laser       = aAcb['Corte_Laser'];
		    var grabado     = aAcb['Grabado'];
		    var hotStamping = aAcb['HotStamping'];
		    var laminado    = aAcb['Laminado'];
		    var suaje       = aAcb['Suaje'];

		    if( barniz !== undefined ){

		    	for( var i = 0; i< barniz.length; i++ ){

		    		var tipo   = barniz[i]['tipoGrabado'];

					if( tipo == "Registro Mate" || tipo == "Registro Brillante" ){

						var largo = barniz[i]['Largo'];
						var ancho = barniz[i]['Ancho'];

						var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Acabado Barniz UV Tipo: ${tipo}, Largo: ${largo} , Ancho: ${ancho} </p>`;
					}else{

						var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Acabado Barniz UV Tipo: ${tipo} </p>`;
					}
					$("#detCaja").append(tr);
				}
		    }

		    if( laser !== undefined ){

		    	for( var i = 0; i< laser.length; i++ ){

		    		var tipo   = laser[i]['tipo_grabado'];
					var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Acabado corte laser Tipo: ${tipo} </p>`;
					$("#detCaja").append(tr);
				}
		    }

		    if( grabado !== undefined ){

		    	for( var i = 0; i< grabado.length; i++ ){

					var tipo      = grabado[i]['tipoGrabado'];
					var largo     = grabado[i]['Largo'];
					var ancho     = grabado[i]['Ancho'];
					var ubicacion = grabado[i]['ubicacion'];

					var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Acabado grabado Tipo: ${tipo}, Largo: ${largo}, Ancho: ${ancho}, Ubicación: ${ubicacion}</p>`;
					$("#detCaja").append(tr);
				}
		    }

		    if( hotStamping !== undefined ){

		    	for( var i = 0; i< hotStamping.length; i++ ){

					var tipo  = hotStamping[i]['tipoGrabado'];
					var largo = hotStamping[i]['Largo'];
					var ancho = hotStamping[i]['Ancho'];
					var color = hotStamping[i]['Color'];

					var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Acabado hot stamping Tipo: ${tipo}, Largo: ${largo}, Ancho: ${ancho}, Color: ${color}</p>`;

					$("#detCaja").append(tr);
				}
		    }

		    if( laminado !== undefined ){

		    	for( var i = 0; i< laminado.length; i++ ){

					var tipo = laminado[i]['tipoGrabado'];

					var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Acabado laminado Tipo: ${tipo}</p>`;
					$("#detCaja").append(tr);
				}
		    }

		    if( suaje !== undefined ){

		    	for( var i = 0; i< suaje.length; i++ ){

					var tipo  = suaje[i]['tipoGrabado'];
					var largo = suaje[i]['Largo'];
					var ancho = suaje[i]['Ancho'];
					var tr = `<p style="margin-bottom: 5px; margin-left: 10px;">Acabado suaje Tipo: ${tipo}, Largo: ${largo}, Ancho: ${ancho}</p>`;
					
					$("#detCaja").append(tr);
				}
		    }
		}
	}catch(e){

		console.log("No se logro obtener el array \n\n" + e);
	}
</script>
