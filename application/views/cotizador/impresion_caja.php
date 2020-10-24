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
			<p>Cotizacion: <label class="f-negrita"><?= $aJson['nomb_odt']?></label></p>
		</div>
	</header>

	<div style="margin: 0px; padding: 0px;">
		<h4>Empresa: <?= $tienda ?></h4>
		<h4 style="margin-bottom: 30px;">Atención</h4>
		<p><?= $aJson['Nombre_cliente']?></p>
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
							<p class="f-negrita" style="margin-right: 10px;"><?= $aJson['tiraje']?></p>
						</td>
						<td style="border-right: 1px solid;">
							<p class="f-negrita" id="lblCUnitario">$<?= $aJson['tiraje']?></p>
						</td>
						<td>
							<p class="f-negrita" style="margin-left: 10px;">$<?= $aJson['costo_odt']?></p>
						</td>
					</tr>
				</table>
			</div>

			<div class="imagen_caja">
				<?php

					switch ($aJson['modelo']) {
						
						case '1':
							echo "<img src='" . URL . "public/img/tapa.png'style='width: 200px; display:block;'>";
						break;
						case '2':
							echo "<img src='" . URL . "public/img/2.png'style='width:90%; height: auto;'>";
						break;
						case '3':
							echo "<img src='" . URL . "public/images/libro/libro.jpeg'style='width:90%; height: auto;'>";
						break;
						case '4':
							echo "<img src='" . URL . "public/img/4.png'style='width:90%; height: auto;'>";
						break;
						case '5':
							echo "<img src='" . URL . "public/images/marco/marcointerno.jpeg'style='width:90%; height: auto;'>";
						break;
						case '6':
							echo "<img src='" . URL . "public/images/cerillera/cerillera.jpeg'style='width:90%; height: auto;'>";
						break;
						case '7':
							echo "<img src='" . URL . "public/images/vino/vino.jpeg'style='width:90%; height: auto;'>";
						break;
					}
				?>
			</div>
		</div>
	</div>

	<footer>
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
		aJson = <?=$aJson1?>;
		
		console.log(aJson);
		$("#detCaja").empty();

		var cUnitario = parseFloat(aJson['costo_odt'] / aJson['tiraje'] ).toFixed(2);

		$("#lblCUnitario").html("$"+cUnitario);

		$("#detCaja").append('<p>Producto</p>');
		
		$("#detCaja").append('<p>Caja: <?=$nombreModelo?>.</p>');

		$("#detCaja").append('<p class="f-negrita" style="margin-bottom: 20px;">Tamaño: <?=$aJson['base']?> x <?=$aJson['alto']?> x <?=$aJson['profundidad']?></p>');
			
		appndPapel(aJson['Papel_Empalme']);
		appndImpresion(aJson['OffEmp'],'offset');
		appndImpresion(aJson['DigEmp'],'digital');
		appndImpresion(aJson['SerEmp'],'serigrafia');
		appndAcabado(aJson['Barniz_UV'],'barniz uv');
		appndAcabado(aJson['Laser'],'corte laser');
		appndAcabado(aJson['Grabado'],'grabado');
		appndAcabado(aJson['HotStamping'],'hot stamping');
		appndAcabado(aJson['Laminado'],'laminado');
		appndAcabado(aJson['Suaje'],'suaje');

		appndPapel(aJson['Papel_FCaj']);
		appndImpresion(aJson['OffFCaj'],'offset');
		appndImpresion(aJson['DigFCaj'],'digital');
		appndImpresion(aJson['SerFCaj'],'serigrafia');
		appndAcabado(aJson['BarnizFcaj'],'barniz uv');
		appndAcabado(aJson['LaserFcaj'],'corte laser');
		appndAcabado(aJson['GrabadoFcaj'],'grabado');
		appndAcabado(aJson['HotStampingFcaj'],'hot stamping');
		appndAcabado(aJson['LaminadoFcaj'],'laminado');
		appndAcabado(aJson['SuajeFcaj'],'suaje');

		appndPapel(aJson['Papel_FCar']);
		appndImpresion(aJson['OffFCar'],'offset');
		appndImpresion(aJson['DigFCar'],'digital');
		appndImpresion(aJson['SerFCar'],'serigrafia');
		appndAcabado(aJson['BarnizFcar'],'barniz uv');
		appndAcabado(aJson['LaserFcar'],'corte laser');
		appndAcabado(aJson['GrabadoFcar'],'grabado');
		appndAcabado(aJson['HotStampingFcar'],'hot stamping');
		appndAcabado(aJson['LaminadoFcar'],'laminado');
		appndAcabado(aJson['SuajeFcar'],'suaje');

		appndPapel(aJson['Papel_Guarda']);
		appndImpresion(aJson['OffG'],'offset');
		appndImpresion(aJson['DigG'],'digital');
		appndImpresion(aJson['SerG'],'serigrafia');
		appndAcabado(aJson['BarnizG'],'barniz uv');
		appndAcabado(aJson['LaserG'],'corte laser');
		appndAcabado(aJson['GrabadoG'],'grabado');
		appndAcabado(aJson['HotStampingG'],'hot stamping');
		appndAcabado(aJson['LaminadoG'],'laminado');
		appndAcabado(aJson['SuajeG'],'suaje');

		function appndPapel( arrPapel ){

			var tr = '<p class="f-negrita">Papel interior del cajón forrado en: ' +arrPapel['nombre_papel'] + '</p>';
			$("#detCaja").append(tr);
		}

		function appndImpresion( arrImpresion, impresion ){

			if( arrImpresion == undefined || arrImpresion == "" || arrImpresion == null ) return false;

			for( var i = 0; i< arrImpresion.length; i++ ){

				switch(impresion){

					case "offset":

						var tipo   = arrImpresion[i]['tipo_offset'];
						var tintas = arrImpresion[i]['num_tintas'];

						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Impresion ' + impresion+" Tipo: " + tipo + ", Tintas: " + tintas + '</p>';
					break;
					case "digital":

						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Impresion ' + impresion + '</p>';
					break;
					case "serigrafia":
						
						var tipo   = arrImpresion[i]['tipo'];
						var tintas = arrImpresion[i]['num_tintas'];

						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Impresion ' + impresion+" Tipo: " + tipo + ", Tintas: " + tintas + '</p>';
					break;
				}
				$("#detCaja").append(tr);
			}
		}

		function appndAcabado( arrAcabado, impresion ){

			if( arrAcabado == undefined || arrAcabado == "" || arrAcabado == null ) return false;

			for( var i = 0; i< arrAcabado.length; i++ ){

				switch(impresion){

					case "barniz uv":

						var tipo   = arrAcabado[i]['tipoGrabado'];

						if( tipo == "Registro Mate" || tipo == "Registro Brillante" ){

							var largo = arrAcabado[i]['Largo'];
							var ancho = arrAcabado[i]['Ancho'];

							var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Acabado ' + impresion+" Tipo: " + tipo + ", Largo: " + largo + ', Ancho: ' + ancho + '</p>';
						}else{

							var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Acabado ' + impresion+" Tipo: " + tipo + '</p>';
						}
					break;
					case "corte laser":

						var tipo   = arrAcabado[i]['tipo_grabado'];
						var largo = arrAcabado[i]['Largo'];
						var ancho = arrAcabado[i]['Ancho'];
						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Acabado ' + impresion+" Tipo: " + tipo + ", Largo: " + largo + ', Ancho: ' + ancho + '</p>';
					break;
					case "grabado":
						
						var tipo   = arrAcabado[i]['tipoGrabado'];
						var largo = arrAcabado[i]['Largo'];
						var ancho = arrAcabado[i]['Ancho'];
						var ubicacion = arrAcabado[i]['ubicacion'];

						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Acabado ' + impresion+" Tipo: " + tipo + ", Largo: " + largo + ', Ancho: ' + ancho + ', Ubicación: ' + ubicacion + '</p>';
					break;
					case "hot stamping":
						
						var tipo   = arrAcabado[i]['tipoGrabado'];
						var largo = arrAcabado[i]['Largo'];
						var ancho = arrAcabado[i]['Ancho'];
						var color = arrAcabado[i]['Color'];

						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Acabado ' + impresion+" Tipo: " + tipo + ", Largo: " + largo + ', Ancho: ' + ancho + ', Color: ' + color + '</p>';
					break;
					case "laminado":
						
						var tipo   = arrAcabado[i]['tipoGrabado'];

						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Acabado ' + impresion+" Tipo: " + tipo + '</p>';
					break;
					case "suaje":
						
						var tipo   = arrAcabado[i]['tipoGrabado'];
						var largo = arrAcabado[i]['Largo'];
						var ancho = arrAcabado[i]['Ancho'];
						var tr = '<p style="margin-bottom: 5px; margin-left: 10px;">Acabado ' + impresion+" Tipo: " + tipo + ", Largo: " + largo + ', Ancho: ' + ancho + '</p>';
					break;
				}
				$("#detCaja").append(tr);
			}
		}
	}catch(e){

		console.log("No se logro obtener el array \n\n" + e);
	}
</script>
