<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<style type="text/css">
	
	.lineado{

		text-decoration-line: underline;
	}
</style>

<div class="container mt-2">
	<h1 class="text-center">ORDEN DE TRABAJO</h1>

	<div class="d-flex justify-content-between mt-2">
		
		<div class="">
			
		</div>

		<div>
			<img style="width: 220px;" src="<?=URL?>public/img/logo-hp-con-mini1.png">
		</div>

		<div>
			
			<h6 id="lblFolio">Folio: </h6>
			<h6 id="lblODTO">ODT original: </h6>	
		</div>
	</div>

	<div class="d-flex justify-content-between">

		<div>
			
			<h6 class="mt-2">vendedor: <label id="lblVendedor" class="lineado"></h6>	
		</div>
		<div>
			
		</div>

		<div>
			<p>Elabora: <label id="lblElabora" class="lineado">Lourdes</p>
			<h6>Fecha de Entrada: <label id="fEntrada" class="lineado">05-Feb</h6>	
		</div>
	</div>

	<div class="d-flex justify-content-around">
		
		<div>
			<h5>Compañia: <label id="lblCompania">Pernod Ricard</label></h5>
			<h6>Marca: <label id="lblMarca" class="lineado">Beefeater Refreshers</h6>
		</div>
		<div>
			<h6>Comprador: <label class="lineado" id="lblComprador"></label></h6>
			<h6>Usuario: <label id="lblUsuario" class="lineado"></label></h6>
		</div>
	</div>

	<div class="d-flex justify-content-between mt-5">
		
		<div class="">
			<h6>Entrega de Datos: <label id="lblEDatos" class="lineado">05-Feb</label> </h6>
			<h6>Entrega orig: <label id="lblEOrig" class="lineado">05-Feb</label></h6>
		</div>

		<div>
			<h6>Autorizar: <label id="lblAutorizar" class="lineado">10-Feb</label></h6>
		</div>

		<div>
			
			<h6>Entrega de producción: <label id="lblEProduccion" class="lineado">26-Feb</label></h6>
			<h6>Entrega clientes: <label id="lblCliente" class="lineado">01-Mar</label></h6>
		</div>
	</div>

	<div class="mt-5 d-flex justify-content-start">
		
		<div class="mx-4">
			<h6>Cantidad</h6>
			<h6 id="lblCantidad" class="lineado">555</h6>
		</div>
		<div class="container">
			<h6>Producto</h6>
			<label id="lblContenido"></label>
			<!--
			<h6>Aqui va toooodo el contenido</h6>
			<h6>ENTREGAMOS BOTELLA Y COPA PARA CHECAR SUAHE ESTRUCTURAL FIRMADO CON SUAJE PROBADO + PRUEBA DE COLOR FIRMADA.</h6>
			<h6 class="text-center">5 son para muestrarios por favor dar a lourdes</h6>
			-->
		</div>
	</div>

	<div class="d-flex justify-content-start">
		
		<div class="mx-4">
			
			<h6>Tintas o PMS: </h6>	
			<h6>OBSERVACIONES</h6>
		</div>

		<div>
			
			<h6><label class="lineado" id="lblTintas">...</label></h6>
			<h6><label id="lblObservaciones" class="lineado">...</label></h6>
		</div>
	</div>
</div>


<script type="text/javascript">
	
	let aJson = JSON.parse(localStorage.getItem('js_respuesta'));
	console.log(aJson)
	let contenido =
	`
		Estuche Beefeater "Regfreshers"<br>
		tamaño final ${aJson['base']} X ${aJson['alto']} X ${aJson['profundidad']} cm.<br>
		<label class="lineado font-weight-bold">Cajón:</label> tamaño ${aJson['base']} X ${aJson['alto']} X ${aJson['profundidad']} cm.<br>
		<label class="lineado">Empalme:</label> ${aJson['Papel_Empalme']['nombre_papel']}<br>
		<label class="lineado">Forro Exterior:</label> ${aJson['Papel_FCaj']['nombre_papel']}<br>

		<label class="lineado">Cartera:</label> ${aJson['Papel_FCar']['nombre_papel']}<br>
		<label class="lineado">Guarda:</label> ${aJson['Papel_Guarda']['nombre_papel']}<br>
	`
	$('#lblODTO').html('ODT ORIGINAL '+ aJson['nomb_odt']);
	$('#lblCantidad').html(''+aJson['tiraje']);
	$('#lblComprador').html(aJson['Nombre_cliente']);
	$('#lblUsuario').html(aJson['nomb_usuario']);
	
	$('#lblContenido').html(contenido);
</script>
