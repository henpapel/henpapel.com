<style type="text/css">

	@keyframes rotate {
		from {transform: rotate(1deg);}
    	to {transform: rotate(360deg);}
    }

	@-webkit-keyframes rotate {
		from {-webkit-transform: rotate(1deg);}
  		to {-webkit-transform: rotate(360deg);}
  	}
  	
	.imgr{
	    -webkit-animation: 2s rotate linear infinite;
	    animation: 2s rotate linear infinite;
	    -webkit-transform-origin: 50% 50%;
	    transform-origin: 50% 50%;
	}
	.posicion{

		position: absolute;
		display: block;
		width: 100%;
		height: 100%;
	}
	.mod{
		color: #fff;
		font-size: 30px;
		display: flex;
		align-items: center;
		justify-content: center; 
 		position: fixed; 
 		z-index: 1; 
 		padding-top: 100px; 
 		left: 0;
 		top: 0;
 		width: 100%; 
 		height: 100%; 
 		overflow: auto;
 		background-color: rgba(0,0,0,0.7); 
	}
	table{
		border-collapse: collapse;
		width: 100%;
		padding: 0px;
		margin: 0px;
	}
	.idInit{

		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.btnPrinc{
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
		width: 25%;
		height: 25%;
		float: left;
	}
	.menu-left{
		background-color: #2A3F54;
		position: absolute;
		display: block;
		width: 15%;
		height: 92%;
		overflow: auto;
		overflow-x: hidden;
	}
	.menu-s{
		align-items: center;
		justify-content: center;
		background-color: #2A3F54;
		position: fixed;
		width: 80%;
		height: 95%;
		overflow: auto;
		overflow-x: hidden;
	}
	.menu-right{
		position: relative;
		display: block;
		width: 84%;
		height: 90%;
		float: right;
		overflow: auto;
		overflow-y: hidden;
	}
	body{
		display: block;
  		flex-direction: column;
  		overflow-y: hidden;
  		width: 100%;
  		height: 100%;
	}
	.boton{
		width:100%;
		height:60px;
		text-align: left;
		display: block;	
		background-color: #2A3F54;
		color: #fff;
		font-size: 16px;
		border: none;
		cursor: pointer;
	}

	.boton:hover {
		background: #fff;
		color: #000;
	}
	.boton2{
		background: #556D85;
		width:100%;
		height:30px;
		border: none;
		color: #DEDEDE;
		font-size: 14px;
		cursor: pointer;
		text-align:left;
		padding-left: 15%;
	}

	.boton2:hover{
		background: #fff;
		color: #000;
	}
	ul{
		list-style: none;
		margin: 0px;
	}
	li{
		list-style: none;
	}
	.formulario{
		margin-left: auto;
		margin-right: auto;
		width: 98%;
		display: block;
		height: 98%;
		margin-top: 1%;
		margin-bottom: 1%;
		border: 1px solid rgb(0,0,0,.2); 
		border-radius: 9px;
		background: #46607B;
		text-align: center;
		padding-top: 50px;
		overflow: auto;
	}
	h4, input, select, label{
		margin-bottom: 0px;
		font-size: 17px;
		margin-top: 5px;
		border: none;
		border-radius: 2px;
		color: #212939;
		width: 120px;
		text-align: center;
	}
	h4{
		text-align: left;	
	}
	.btnModificar{
		cursor: pointer;
		width: 300px;
		height: 35px;
		background: #272B34;
		color: #fff;
		border: none;
		border-radius: 9px;
		margin-bottom: 10px;
	}
	.btnModificar:hover{
		background: #2F3541;
	}
	p{
		margin-top: 20px;
		color: #212939;
		font-size: 25px;
		font-weight: bold;
		margin-bottom: 20px;
	}
	.titulo{
		margin-top: 40px;
		display: flex;
		justify-content: center;
		align-items: center;
		background: #46607B;
		border-radius: 9px;
		margin-left: 10%;
		margin-right: 10%;
		width: 80%;
		height: 60px;
		margin-bottom: 40px;	
	}
	.seccion{
		display: flex;
		justify-content: center;
		align-items: center;
		
		border-radius: 9px;
		margin-left: 1%;
		margin-right: 1%;
		width: 98%;
		height: auto;
		margin-bottom: 15px;
	}
	.seccion p, h4, label{
		color: #D9D9D9;
	}

	.aForms{

		display: none;
		height: 100%;
		width: 100%;
		overflow: auto;

	}
	.fmCompleto{

		height: 90%;
		width: 100%;
		display: block;
	}
</style>

<div class="posicion">

	<div class="menu-left">
		<button id="btnCor" name="btnCor" class="boton" onclick="switchForm('Corte','formC','C');">Corte</button>
		<button class="boton" onclick="show('idOffset')">Offset</button>
		<div id="idOffset" style="display: none;">

			<button id="btnOffN" name="btnOffN" class="boton2" onclick="switchForm(' Offset Normal','formOff','N');">Normal</button>

			<button id="btnOffP" name="btnOffP" class="boton2" onclick="switchForm('Offset Pantone','formOff','P');">Pantone</button>

			<button id="btnOffM" name="btnOffM" class="boton2" onclick="switchForm('Offset Maquila','formOff','M');">Maquila</button>

			<button id="btnOffMP" name="btnOffMP" class="boton2" onclick="switchForm(' Offset Maquila Pantone','formOff','MP');">Maquila Pantone</button>
		</div>
		<button class="boton" onclick="show('idSerigrafia'); ">Serigrafia</button>
		<div id="idSerigrafia" style="display: none;">

			<button id="btnSerN" name="btnSerN" class="boton2" onclick="switchForm(' Serigrafia Normal','formSer','N');">Normal</button>

			<button id="btnSerP" name="btnSerP" class="boton2" onclick="switchForm('Serigrafia Pantone','formSer','P');">Pantone</button>
		</div>
		<button id="btnDig" name="btnDig" class="boton" onclick="switchForm('Digital','formDig','D');">Digital</button>

		<button id="btnLam" name="btnLam" class="boton" onclick="switchForm('Laminado','formLam','L')">Laminado</button>
		
		<button id="btnCL" name="btnCL" class="boton" onclick="switchForm('Corte Laser','formCL','CL')">Corte Laser</button>
		
		<button class="boton" onclick="show('idHotStamping')">Hot Stamping</button>
		<div id="idHotStamping" style="display: none;">

			<button id="btnHotH" name="btnHotH" class="boton2" onclick="switchForm('Hot Stamping H','formHS','H')">H</button>
			<button id="btnHotH1" name="btnHotH1" class="boton2" onclick="switchForm('Hot Stamping H1','formHS','HG1')">HG1</button>
			<button id="btnHotH2" name="btnHotH2" class="boton2" onclick="switchForm('Hot Stamping H2','formHS','HG2')">HG2</button>
		</div>
		<button class="boton" onclick="show('idGrabado')">Grabado</button>
		<div id="idGrabado" style="display: none;">
			<button id="btnGraG1" name="" class="boton2" onclick="switchForm('Grabado G1','formG','G1')">G1</button>
			<button id="btnGraG2" name="" class="boton2" onclick="switchForm('Grabado G2','formG','G2')">G2</button>
		</div>
		<button id="btnSua" name="btnSua" class="boton" onclick="switchForm('Suaje','formS','S')">Suaje</button>
		<button id="btnEnc" name="btnEnc" class="boton" onclick="switchForm('Encuadernacion','formEnc','enc')">Encuadernacion</button>
		<button id="btnRan" name="btnRan" class="boton" onclick="switchForm('Ranurado','formRan','ran')">Ranurado</button>
	</div>

	<div class="menu-right">

		<div class="titulo">

			<p id="txtTitulo" style="color: #fff;">Procedimientos</p>
		</div>

		<div id="principal" style="display: none;" class="mod">
			<img id="rotate1" class="imgr" style="width: 80px; height: 80px;" src="<?= URL?>public/img/cargando.png">
			Cargando...
		</div>

		<div id="formPrincipal" class="fmCompleto">
			
			<form id="formAction" class="fmCompleto" action="" method="POST">
				<div id="formulario" class="formulario">
					<div id="contenidoF" style="display: none;">
						
					</div>
				</div>
				<input type="text" id="tipoProceso" name="tipoProceso" style="display: none">
			</form>
		</div>

		<div id="formC" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcCor/">
				
				<div class="seccion" id="LamCor">

					<table>
						<tr>
							<td align="center">
								<h4>Costo por Millar:</h4>
							</td>
							<td align="center">
								<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosCor" name="txtCosCor" placeholder="Costo Unitario"><label> MXN</label>
							</td>
							<td style="display: none;">
								<input type="text" id="txtIdCorte" name="txtIdCorte">
							</td>
						</tr>

					</table>

				</div>
				<input type="submit" onclick="opacidad();" name="btnAceptarCor" value="Modificar" class="btnModificar">
		</div>

		<div id="idInit" class="idInit">
			<div class="btnPrinc">
				
			</div>
			<div class="btnPrinc">
				<span class="codigo">
					<button id="btnImpresion" style="border:none; background: #fff;">
					<img src="<?=URL?>public/img/impresion.png"></button>
				</span>
			</div>
			<div class="btnPrinc">
				
			</div>
		</div>

		<div id="formOff" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcOff/">
			
			<div class="seccion" id="Lamina">

				<table>
					<tr>
						<th align="center" colspan="2">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Lamina</p>
						</th>
					</tr>
					<tr>
						<td align="center">
							<h4>Costo Por Color:</h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosOffLam" name="txtCosOffLam" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdLamOffset" name="txtIdLamOffset">
						</td>
					</tr>
				</table>
			</div>

			<div class="seccion" id="Arreglo">
				<table>
					<tr>
						<th align="center" colspan="2">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Arreglo</p>
						</th>
					</tr>
					<tr>
						<td align="center">
							<h4>Costo Por Color:</h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosOffArr" name="txtCosOffArr" placeholder="Costo Unitario"><label> MXN</label>
						</td>
					</tr>
					<tr>
						<td align="center">
							<h4 id="lblTirMin">Tiraje Minimo: </h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtTirMinOff" name="txtTirMinOff" placeholder="Ingrese Tiraje Minimo">
						</td>
					</tr>
					<tr>
						<td align="center">
							<h4 id="lblTirMax">Tiraje Maximo: </h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtTirMaxOff" name="txtTirMaxOff" placeholder="Ingrese Tiraje Maximo">
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdArrOffset" name="txtIdArrOffset">
						</td>
					</tr>
					
				</table>
			</div>

			<div class="seccion" id="Tiro">
				<table>
					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Tiro</p>
						</th>
					</tr>
					
					<tr>
						<td align="center">
							<h4 id="lblCosMillCol">Costo Por Millar Por Color:</h4>
						</td>
						<td align="center" colspan="2">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosOffTir" name="txtCosOffTir" placeholder="Costo Unitario"><label id="lblCosMillCol1"> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdTirOffset1" name="txtIdTirOffset1">
						</td>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 id="lblRanOff" style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4 id="lblPreOff" style="text-align: center;">Precio</h4>
						</th>
					</tr>
					<tr>
						<th id="lblMinOff" align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 id="lblMaxOff" style="text-align: center;">Max</h4>
						</th>
					</tr>

					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangOff11" name="txtRangOff11" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangOff12" name="txtRangOff12" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniOff1" name="txtCosUniOff1" placeholder="Precio Frente"><label id="lblTirOff1"> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdTirOffset2" name="txtIdTirOffset2">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangOff21" name="txtRangOff21" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangOff22" name="txtRangOff22" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniOff2" name="txtCosUniOff2" placeholder="Precio Frente"><label id="lblTirOff2"> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdTirOffset3" name="txtIdTirOffset3">
						</td>	 
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangOff31" name="txtRangOff31" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangOff32" name="txtRangOff32" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniOff3" name="txtCosUniOff3" placeholder="Precio Frente"><label id="lblTirOff3"> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdTirOffset4" name="txtIdTirOffset4">
						</td> 
					</tr>
				</table>


				<input type="text" id="usuarioOff" name="usuarioOff" value="<?=$_SESSION['id_usuario']?>" style="display: none">	
			</div>
			<input type="submit" onclick="opacidad();" name="btnAceptarOff" value="Modificar" class="btnModificar">
		</div>

		<div id="formSer" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcSer/">
			
			<div class="seccion" id="ArregloSer">
				<table>
				<tr>
					<th align="center" colspan="3">
						<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Arreglo</p>
					</th>
				</tr>
				<tr>
					<td align="center">
						<h4>Costo Por Color:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosSerArr" name="txtCosSerArr" placeholder="Costo Unitario"><label> MXN</label>
					</td>
					<td style="display: none;">
						<input type="text" id="txtIdArrSerigrafia" name="txtIdArrSerigrafia">
					</td>
				</tr>
				</table>
			</div>
			<div class="seccion" id="TiroSer">
				<table>
				<tr>
					<th align="center" colspan="3">
						<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Tiro</p>
					</th>
				</tr>
				<tr>
					<th align="center" colspan="2">
						<h4 id="lblRanSer" style="text-align: center;">Rango</h4>
					</th>
					<th align="center">
						<h4 id="lblPreSer" style="text-align: center;">Precio</h4>
					</th>
				</tr>
				<tr>
					<th id="lblMinSer" align="center">
						<h4 style="text-align: center;">Min</h4>
					</th>
					<th align="center">
						<h4 id="lblMaxSer" style="text-align: center;">Max</h4>
					</th>
				</tr>

				<tr>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;"  type="text" id="txtRangSer11" name="txtRangSer11" placeholder="Rango">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangSer12" name="txtRangSer12" placeholder="Rango">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniSer1" name="txtCosUniSer1" placeholder="Precio Frente"><label> MXN</label>
					</td>
					<td style="display: none;">
						<input type="text" id="txtIdTirSerigrafia1" name="txtIdTirSerigrafia1">
					</td> 
				</tr>
				<tr>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangSer21" name="txtRangSer21" placeholder="Rango">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangSer22" name="txtRangSer22" placeholder="Rango">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniSer2" name="txtCosUniSer2" placeholder="Precio Frente"><label> MXN</label>
					</td>
					<td style="display: none;">
						<input type="text" id="txtIdTirSerigrafia2" name="txtIdTirSerigrafia2">
					</td> 
				</tr>
				<tr>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangSer31" name="txtRangSer31" placeholder="Rango">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangSer32" name="txtRangSer32" placeholder="Rango">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniSer3" name="txtCosUniSer3" placeholder="Precio Frente"><label> MXN</label>
					</td>
					<td style="display: none;">
						<input type="text" id="txtIdTirSerigrafia3" name="txtIdTirSerigrafia3">
					</td>
				</tr>
				<tr>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangSer41" name="txtRangSer41" placeholder="Rango 4">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangSer42" name="txtRangSer42" placeholder="Rango 4">
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniSer4" name="txtCosUniSer4" placeholder="Precio Frente"><label> MXN</label>
					</td>
					<td style="display: none;">
						<input type="text" id="txtIdTirSerigrafia4" name="txtIdTirSerigrafia4">
					</td>
				</tr>
				</table>

				<input type="text" id="usuarioSer" name="usuarioSer" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();" name="btnAceptarSer" value="Modificar" class="btnModificar">	
		</div>

		<div id="formDig" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcDig/">
			
			<div class="seccion" id="ArregloDig">
				<table>
					<tr>
						<th colspan="2" align="center">
							
						</th>
						<th colspan="2" align="center">
							<h4 style="text-align: center;">Carta</h4>
						</th>
						<th colspan="2" align="center">
							<h4 style="text-align: center;">Doble Carta</h4>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2" style="border-right: 1px solid;">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4>Frente</h4>
						</th>
						<th align="center" style="border-right: 1px solid;">
							<h4>Frente Vuelta</h4>
						</th>
						<th align="center">
							<h4>Frente</h4>
						</th>
						<th align="center">
							<h4>Frente Vuelta</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center" style="border-right: 1px solid;">
							<h4 style="text-align: center;">Max</h4>
						</th>
						<th colspan="2" style="border-right: 1px solid;">
							
						</th>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMinDig1" name="txtRanMinDig1" placeholder="Rango">
						</td>
						<td align="center" style="border-right: 1px solid;">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMaxDig1" name="txtRanMaxDig1" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosFreDig11" name="txtCosFreDig11" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFreDigital1" name="txtIdFreDigital1">
						</td>
						<td align="center" style="border-right: 1px solid;">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosVueDig11" name="txtCosVueDig11" placeholder="Precio Vuelta"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdVueDigital1" name="txtIdVueDigital1">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosFreDig12" name="txtCosFreDig12" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFreDigital2" name="txtIdFreDigital2">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosVueDig12" name="txtCosVueDig12" placeholder="Precio Vuelta"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdVueDigital2" name="txtIdVueDigital2">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMinDig2" name="txtRanMinDig2" placeholder="Rango">
						</td>
						<td align="center" style="border-right: 1px solid;">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMaxDig2" name="txtRanMaxDig2" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosFreDig21" name="txtCosFreDig21" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFreDigital3" name="txtIdFreDigital3">
						</td>
						<td align="center" style="border-right: 1px solid;">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosVueDig21" name="txtCosVueDig21" placeholder="Precio Vuelta"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdVueDigital3" name="txtIdVueDigital3">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosFreDig22" name="txtCosFreDig22" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFreDigital4" name="txtIdFreDigital4">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosVueDig22" name="txtCosVueDig22" placeholder="Precio Vuelta"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdVueDigital4" name="txtIdVueDigital4">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMinDig3" name="txtRanMinDig3" placeholder="Rango">
						</td>
						<td align="center" style="border-right: 1px solid;">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMaxDig3" name="txtRanMaxDig3" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosFreDig31" name="txtCosFreDig31" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFreDigital5" name="txtIdFreDigital5">
						</td>
						<td align="center" style="border-right: 1px solid;">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosVueDig31" name="txtCosVueDig31" placeholder="Precio Vuelta"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdVueDigital5" name="txtIdVueDigital5">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosFreDig32" name="txtCosFreDig32" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFreDigital6" name="txtIdFreDigital6">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosVueDig32" name="txtCosVueDig32" placeholder="Precio Vuelta"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdVueDigital6" name="txtIdVueDigital6">  
						</td>
					</tr>

				</table>

				<input type="text" id="usuarioDig" name="usuarioDig" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();" name="btnAceptarDig" value="Modificar" class="btnModificar">
		</div>
		
		<div id="formLam" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcLam/">
			
			<div class="seccion" id="ArregloDig">
				<table>
					<tr>
						<th>
							
						</th>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4>Costo Por m2</h4>
						</th>
					</tr>
					<tr>
						<th>
							
						</th>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>
					<tr>
						<td align="right"><h4>Mate</h4></td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMinLam1" name="txtRanMinLam1" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMaxLam1" name="txtRanMaxLam1" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosLam1" name="txtCosLam1" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdLam1" name="txtIdLam1">
						</td>
					</tr>
					<tr>
						<td align="right"><h4>Soft Touch</h4></td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMinLam2" name="txtRanMinLam2" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMaxLam2" name="txtRanMaxLam2" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosLam2" name="txtCosLam2" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdLam2" name="txtIdLam2">
						</td>
					</tr>
					<tr>
						<td align="right"><h4>Anti Scratch</h4></td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMinLam3" name="txtRanMinLam3" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMaxLam3" name="txtRanMaxLam3" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosLam3" name="txtCosLam3" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdLam3" name="txtIdLam3">
						</td>
					</tr>
					<tr>
						<td align="right"><h4>Superadherente</h4></td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMinLam4" name="txtRanMinLam4" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRanMaxLam4" name="txtRanMaxLam4" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosLam4" name="txtCosLam4" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdLam4" name="txtIdLam4">
						</td>
					</tr>

				</table>

				<input type="text" id="usuarioLam" name="usuarioLam" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();" name="btnAceptarDig" value="Modificar" class="btnModificar">
		</div>

		<div id="formCL" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcCorLas/">
			
			<div class="seccion" style="width: 80%;">
				<table style="table-layout: fixed;">
					
					<tr>
						<th></th>

						<th align="center" colspan="2">
							<h4 style="text-align: center;">Figura</h4>
						</th>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Ranura</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Personalizada</h4>
						</th>
					</tr>
					<tr>
						<th></th>
						<th align="center">
							<h4 style="text-align: center;">Sencilla</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Detallada</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Sencilla</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Detallada</h4>
						</th>
						<th align="center">
							
						</th>
					</tr>
					<tr>
						<th><h4 style="text-align: right;">Tiempo</h4></th>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasT1" name="txtCosCorLasT1" placeholder="Tiempo">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasT2" name="txtCosCorLasT2" placeholder="Tiempo">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasT3" name="txtCosCorLasT3" placeholder="Tiempo">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasT4" name="txtCosCorLasT4" placeholder="Tiempo">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasT5" name="txtCosCorLasT5" placeholder="Tiempo">
						</td>
					</tr>
					<tr>
						<th><h4 style="text-align: right;">Costo Unitario:</h4></th>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasC1" name="txtCosCorLasC1" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdSenLaser1" name="txtIdSenLaser1">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasC2" name="txtCosCorLasC2" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdDetLaser1" name="txtIdDetLaser1">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasC3" name="txtCosCorLasC3" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdSenLaser2" name="txtIdSenLaser2">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasC4" name="txtCosCorLasC4" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdDetLaser2" name="txtIdDetLaser2">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosCorLasC5" name="txtCosCorLasC5" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdPerLaser" name="txtIdPerLaser">
						</td>
					</tr>	
					
				</table>
			</div>
			<input type="submit" onclick="opacidad();"  name="btnAceptarCorLas" value="Modificar" class="btnModificar">
		</div>

		<div id="formHS" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcHotStam/">
			
			<div class="seccion" id="HotStamPlac">
				<table>
				<tr>
					<th align="center" colspan="3">
						<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Placa</p>
					</th>
				</tr>
				<tr>
					<td align="center">
						<h4>Costo Por cm2:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosHotPlac" name="txtCosHotPlac" placeholder="Costo Unitario"><label> MXN</label>
					</td>
				</tr>
				<tr>
					<td align="center">
						<h4>Tamaño Minimo:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtTamHot" name="txtTamHot" placeholder="Tamaño Minimo"><label> cm2</label>	
					</td>
					<td style="display:none;">
						<input type="text" id="txtIdPlaHS" name="txtIdPlaHS">
					</td>
				</tr>

				</table>
			</div>
			<div class="seccion" id="HotStamPel">
				<table>
				<tr>
					<th align="center" colspan="3">
						<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Pelicula</p>
					</th>
				</tr>
				<tr>
					<td align="center">
						<h4>Costo Por cm2:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosHotPel" name="txtCosHotPel" placeholder="Costo Unitario"><label> MXN</label>
					</td>
					<td style="display:none;">
						<input type="text" id="txtIdPelHS" name="txtIdPelHS">
					</td>
				</tr>
				</table>
			</div>
			<div class="seccion" id="HotStamArr">
				<table>
				<tr>
					<th align="center" colspan="3">
						<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Arreglo</p>
					</th>
					
				</tr>
				<tr>
					<td align="center">
						<h4>Costo:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosHotArr" name="txtCosHotArr" placeholder="Costo Unitario"><label> MXN</label>
					</td>
					<td style="display:none;">
						<input type="text" id="txtIdArrHS" name="txtIdArrHS">
					</td>
				</tr>
				</table>
			</div>
			<div class="seccion" id="HotStamTir">
				<table>
					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Tiro</p>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Precio</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMinHot1" name="txtMinHot1" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMaxHot1" name="txtMaxHot1" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosHot1" name="txtCosHot1" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdTirHS1" name="txtIdTirHS1">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMinHot2" name="txtMinHot2" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMaxHot2" name="txtMaxHot2" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosHot2" name="txtCosHot2" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdTirHS2" name="txtIdTirHS2">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMinHot3" name="txtMinHot3" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMaxHot3" name="txtMaxHot3" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosHot3" name="txtCosHot3" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdTirHS3" name="txtIdTirHS3">
						</td>
					</tr>
				</table>

				<input type="text" id="usuarioHot" name="usuarioHot" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();" id="btnAceptarHot" name="btnAceptarHot" value="Modificar" class="btnModificar">
		</div>

		<div id="formG" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcGra/">
			
			<div class="seccion" id="HotStamPlac">
				<table>
				<tr>
					<th align="center" colspan="3">
						<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Placa</p>
					</th>
				</tr>
				<tr>
					<td align="center">
						<h4>Costo por cm2:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosGraPlac" name="txtCosGraPlac" placeholder="Costo Unitario"><label> MXN</label>
					</td>
				</tr>
				<tr>
					<td align="center">
						<h4>Tamaño Minimo:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtTamGra" name="txtTamGra" placeholder="Tamaño Minimo"><label> cm2</label>	
					</td>
					<td style="display:none;">
						<input type="text" id="txtIdPlaG" name="txtIdPlaG">
					</td>
				</tr>
				</table>
			</div>
			<div class="seccion" id="HotStamArr">
				<table>
				<tr>
					<th align="center" colspan="3">
						<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Arreglo</p>
					</th>
				</tr>
				<tr>
					<td align="center">
						<h4>Costo:</h4>
					</td>
					<td align="center">
						<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosGraArr" name="txtCosGraArr" placeholder="Costo Unitario"><label> MXN</label>
					</td>
					<td style="display:none;">
						<input type="text" id="txtIdArrG" name="txtIdArrG">
					</td>
				</tr>
				</table>
			</div>
			<div class="seccion" id="HotStamTir">
				<table>
					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Tiro</p>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Precio</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMinGra1" name="txtMinGra1" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMaxGra1" name="txtMaxGra1" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosGra1" name="txtCosGra1" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdTirG1" name="txtIdTirG1">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMinGra2" name="txtMinGra2" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMaxGra2" name="txtMaxGra2" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosGra2" name="txtCosGra2" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdTirG2" name="txtIdTirG2">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMinGra3" name="txtMinGra3" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtMaxGra3" name="txtMaxGra3" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosGra3" name="txtCosGra3" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdTirG3" name="txtIdTirG3">
						</td>
					</tr>
				</table>

				<input type="text" id="usuarioGra" name="usuarioGra" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();"  name="btnAceptarHot" value="Modificar" class="btnModificar">
		</div>
				
		<div id="formS" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcSua/">
			
			<div class="seccion" id="ArregloDig">
				<table>
					
					<tr>
						<th></th>
						<th align="center">
							<h4 style="text-align: center;">P. Minimo</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Tiro</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Arreglo</h4>
						</th>

						<th align="center">
							<h4 style="text-align: center;">Costo</h4>
						</th>
					</tr>
					</tr>
					<tr>
						<td align="right"><h4>Perimetral</h4></td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtPerimetro1" name="txtPerimetro1" placeholder="P. Minimo">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtTiro1" name="txtTiro1" placeholder="Figura"><label> MXN</label>
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtArreglo1" name="txtArreglo1" placeholder="Arreglo"><label> MXN</label>
						</td>

						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosto1" name="txtCosto1" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdPerSuaje" name="txtIdPerSuaje">
						</td>
					</tr>
					<tr>
						<td align="right"><h4>Figura</h4></td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtPerimetro2" name="txtPerimetro2" placeholder="P. Minimo">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtTiro2" name="txtTiro2" placeholder="Figura"><label> MXN</label>
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtArreglo2" name="txtArreglo2" placeholder="Arreglo"><label> MXN</label>
						</td>

						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosto2" name="txtCosto2" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display:none;">
							<input type="text" id="txtIdFigSuaje" name="txtIdFigSuaje">
						</td>
					</tr>
				</table>

				<input type="text" id="usuarioSua" name="usuarioSua" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();" name="btnAceptarDig" value="Modificar" class="btnModificar">
		</div>

		<div id="formEnc" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcEnc/">
			
			<div class="seccion">
				<table>
					
					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Perforado para imán y puesta de imán</p>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Precio</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>

					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;"  type="text" id="txtRangEnc11" name="txtRangEnc11" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangEnc12" name="txtRangEnc12" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniEnc1" name="txtCosUniEnc1" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdEnc1" name="txtIdEnc1">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangEnc21" name="txtRangEnc21" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangEnc22" name="txtRangEnc22" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniEnc2" name="txtCosUniEnc2" placeholder="Precio Frente"><label> MXN</label>
						</td>

						<td style="display: none;">
							<input type="text" id="txtIdEnc2" name="txtIdEnc2">
						</td>
					</tr>

					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Empalme del Cajón</p>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Precio</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>

					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;"  type="text" id="txtRangEC11" name="txtRangEC11" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangEC12" name="txtRangEC12" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniEC1" name="txtCosUniEC1" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdEC1" name="txtIdEC1">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangEC21" name="txtRangEC21" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangEC22" name="txtRangEC22" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniEC2" name="txtCosUniEC2" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdEC2" name="txtIdEC2">
						</td>
					</tr>

					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Forrado del Cajón</p>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Precio</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>

					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;"  type="text" id="txtRangFC11" name="txtRangFC11" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangFC12" name="txtRangFC12" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniFC1" name="txtCosUniFC1" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFC1" name="txtIdFC1">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangFC21" name="txtRangFC21" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangFC22" name="txtRangFC22" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniFC2" name="txtCosUniFC2" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdFC2" name="txtIdFC2">
						</td>
					</tr>

					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Puesta de Banco</p>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Precio</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>

					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;"  type="text" id="txtRangPB11" name="txtRangPB11" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangPB12" name="txtRangPB12" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniPB1" name="txtCosUniPB1" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdPB1" name="txtIdPB1">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangPB21" name="txtRangPB21" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRangPB22" name="txtRangPB22" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCosUniPB2" name="txtCosUniPB2" placeholder="Precio Frente"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdPB2" name="txtIdPB2">
						</td>
					</tr>

					<tr>
						<td align="center">
							<h4>Despunte de esquinas para Cajón</h4>
						</td>
						<td align="center">
							<h4>C. Unitario:</h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosDEC" name="txtCosDEC" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdDEC" name="txtIdDEC">
						</td>
					</tr>

					<tr>
						<td align="center">
							<h4>Arreglo de Forrado de Cajón</h4>
						</td>
						<td align="center">
							<h4>C. Unitario:</h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosAFC" name="txtCosAFC" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdAFC" name="txtIdAFC">
						</td>
					</tr>

					<tr>
						<td align="center">
							<h4>Encajada</h4>
						</td>
						<td align="center">
							<h4>C. Unitario:</h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosEn" name="txtCosEn" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdEn" name="txtIdEn">
						</td>
					</tr>

					<tr>
						<td align="center">
							<h4>Domi</h4>
						</td>
						<td align="center">
							<h4>C. Unitario:</h4>
						</td>
						<td align="center">
							<input style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosD" name="txtCosD" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdDomi" name="txtIdDomi">
						</td>
					</tr>
				</table>

				<input type="text" id="usuarioEnc" name="usuarioEnc" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();" name="btnAceptarDig" value="Modificar" class="btnModificar">
		</div>

		<div id="formRan" class="aForms" data-action="<?php echo URL?>modificaprocesos/updateProcRan/">
			
			<div class="seccion">

				<table>

					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Arreglo</p>
						</th>
					</tr>
					<tr>
						<td align="center" colspan="2">
							<h4>Precio Unitario:</h4>
						</td>
						<td align="left">
							<input align="left" style="width: 60px;" onkeyup="asignaNum();" type="text" id="txtCosArr" name="txtCosArr" placeholder="Costo Unitario"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtIdArr" name="txtIdArr">
						</td>
					</tr>
					<tr>
						<th align="center" colspan="3">
							<p style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Por Ranura</p>
						</th>
					</tr>
					<tr>
						<th align="center" colspan="2">
							<h4 style="text-align: center;">Rango</h4>
						</th>
						<th align="center">
							<h4>Precio</h4>
						</th>
					</tr>
					<tr>
						<th align="center">
							<h4 style="text-align: center;">Min</h4>
						</th>
						<th align="center">
							<h4 style="text-align: center;">Max</h4>
						</th>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan11" name="txtRan11" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan12" name="txtRan12" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCos1" name="txtCos1" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtId1" name="txtId1">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan21" name="txtRan21" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan22" name="txtRan22" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCos2" name="txtCos2" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtId2" name="txtId2">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan31" name="txtRan31" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan32" name="txtRan32" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCos3" name="txtCos3" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtId3" name="txtId3">
						</td>
					</tr>
					<tr>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan41" name="txtRan41" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtRan42" name="txtRan42" placeholder="Rango">
						</td>
						<td align="center">
							<input onkeyup="asignaNum();" style="width: 60px;" type="text" id="txtCos4" name="txtCos4" placeholder="Costo"><label> MXN</label>
						</td>
						<td style="display: none;">
							<input type="text" id="txtId4" name="txtId4">
						</td>
					</tr>
				</table>

				<input type="text" id="usuario" name="usuario" value="<?=$_SESSION['id_usuario']?>" style="display: none">
			</div>
			<input type="submit" onclick="opacidad();" name="btnAceptarRan" value="Modificar" class="btnModificar">
		</div>
	</div>
</div>

<script>
	var a=0;
	var b;
	lblRangOff1  = document.getElementById('lblRangOff1');
	lblRangOff2  = document.getElementById('lblRangOff2');
	lblTirMin    = document.getElementById('lblTirMin');
	lblTirMax    = document.getElementById('lblTirMax');
	lbltxtTitulo = document.getElementById('txtTitulo');
	divLamina    = document.getElementById('Lamina');
	divArreglo   = document.getElementById('Arreglo');
	divTiro      = document.getElementById('Tiro');
	rotate       = document.getElementById('rotate1');
	prin         = document.getElementById('principal');

	function switchForm(text,form,tipoProceso){
		
		if (a==0) {
			
			var contenido = $("#"+form).html();
			$("#contenidoF").hide();
			$("#contenidoF").empty();
			$("#contenidoF").append(contenido);
			$("#contenidoF").show("slow");
			$("#txtTitulo").html(text);
			$("#tipoProceso").val(tipoProceso);
			var url = $("#"+form).data("action");
			setURL(url);
		}
		else{
			var opcion = confirm("Ha Hecho un Cambio. ¿Realmente Quiere Salir?");
    		if (opcion == true) {
    			a=0;
        		switchForm(text,form,tipoProceso);
			}
		}

	}

	function setURL(url){

		$("#formAction").prop("action",url);
	}

	$("#btnOffN").click(function() {
		if(a==0){
		$("#Arreglo").show();
		$("#Lamina").show();
		$("#lblTirOff1").hide();
		$("#lblTirOff2").hide();
		$("#lblTirOff3").hide();
		$("#lblTirMin").show();
		$("#lblTirMax").show();
		$("#txtTirMinOff").show();
		$("#txtTirMaxOff").show();

		$("#txtCosOffTir").show();
		$("#lblCosMillCol").show();
		$("#lblCosMillCol1").show();

		$("#txtRangOff11").hide();
		$("#txtRangOff12").hide();
		$("#txtRangOff22").hide();
		$("#txtRangOff32").hide();
		$("#txtCosUniOff1").hide();
		$("#txtCosUniOff2").hide();
		$("#txtCosUniOff3").hide();
		$("#txtRangOff21").hide();		
		$("#txtRangOff31").hide();
		$("#lblMinOff").hide();
		$("#lblMaxOff").hide();
		$("#lblRanOff").hide();
		$("#lblPreOff").hide();

		$("#txtTirMinOff").val("<?= $procesosOffset['Arreglo']['tiraje_minimo']?>");
		$("#txtTirMaxOff").val("<?= $procesosOffset['Arreglo']['tiraje_maximo']?>");
		$("#txtCosOffLam").val("<?= $procesosOffset['Laminas']['costo_unitario']?>");
		$("#txtCosOffArr").val("<?= $procesosOffset['Arreglo']['costo_unitario']?>");
		$("#txtCosOffTir").val("<?= $procesosOffset['Tiro']['costo_unitario']?>");
		$("#txtIdLamOffset").val("<?= $procesosOffset['Laminas']['id_offset']?>");
		$("#txtIdArrOffset").val("<?= $procesosOffset['Arreglo']['id_offset']?>");
		$("#txtIdTirOffset1").val("<?= $procesosOffset['Tiro']['id_offset']?>");
		}
	});

	$("#btnOffP").click(function() {
		if(a==0){
		$("#Arreglo").show();
		$("#Lamina").show();
		$("#lblTirMin").hide();
		$("#lblTirMax").hide();
		$("#txtTirMinOff").hide();
		$("#txtTirMaxOff").hide();
		$("#lblTirOff1").hide();
		$("#lblTirOff2").hide();
		$("#lblTirOff3").hide();
		$("#txtCosOffTir").show();
		$("#lblCosMillCol").show();
		$("#lblCosMillCol1").show();

		$("#txtRangOff11").hide();
		$("#txtRangOff12").hide();
		$("#txtRangOff22").hide();
		$("#txtRangOff32").hide();
		$("#txtCosUniOff1").hide();
		$("#txtCosUniOff2").hide();
		$("#txtCosUniOff3").hide();
		$("#txtRangOff21").hide();		
		$("#txtRangOff31").hide();
		$("#lblMinOff").hide();
		$("#lblMaxOff").hide();
		$("#lblRanOff").hide();
		$("#lblPreOff").hide();

		$("#txtCosOffTir").val("<?= $procesosOffset['Tiro Pantone']['costo_unitario']?>");
		$("#txtCosOffArr").val("<?= $procesosOffset['Arreglo de Pantone']['costo_unitario']?>");
		$("#txtCosOffLam").val("<?= $procesosOffset['Laminas Pantone']['costo_unitario']?>");
		$("#txtIdLamOffset").val("<?= $procesosOffset['Laminas Pantone']['id_offset']?>");
		$("#txtIdArrOffset").val("<?= $procesosOffset['Arreglo de Pantone']['id_offset']?>");
		$("#txtIdTirOffset1").val("<?= $procesosOffset['Tiro Pantone']['id_offset']?>");
		}
	});

	$("#btnOffM").click(function(){
		if(a==0){
		$("#Lamina").show();
		$("#Arreglo").show();
		$("#txtCosOffTir").hide();
		$("#lblCosMillCol").hide();
		$("#lblCosMillCol1").hide();

		$("#lblTirOff1").show();
		$("#lblTirOff2").show();
		$("#lblTirOff3").show();

		$("#lblTirMin").hide();
		$("#lblTirMax").hide();
		$("#txtTirMinOff").hide();
		$("#txtTirMaxOff").hide();

		$("#txtRangOff11").show();
		$("#txtRangOff12").show();
		$("#txtRangOff22").show();
		$("#txtRangOff32").show();
		$("#txtCosUniOff1").show();
		$("#txtCosUniOff2").show();
		$("#txtCosUniOff3").show();
		$("#txtRangOff21").show();		
		$("#txtRangOff31").show();
		$("#lblMinOff").show();
		$("#lblMaxOff").show();
		$("#lblRanOff").show();
		$("#lblPreOff").show();

		$("#txtCosOffLam").val("<?= $procesosOffset['Maquila Lamina']['costo_unitario']?>");
		$("#txtCosOffArr").val("<?= $procesosOffset['Maquila Arreglo']['costo_unitario']?>");
		$("#txtRangOff11").val("<?= $procesosOffset['Maquila1']['tiraje_minimo']?>");
		$("#txtRangOff12").val("<?= $procesosOffset['Maquila1']['tiraje_maximo']?>");
		$("#txtRangOff21").val("<?= $procesosOffset['Maquila2']['tiraje_minimo']?>");
		$("#txtRangOff22").val("<?= $procesosOffset['Maquila2']['tiraje_maximo']?>");
		$("#txtRangOff31").val("<?= $procesosOffset['Maquila3']['tiraje_minimo']?>");
		$("#txtRangOff32").val("<?= $procesosOffset['Maquila3']['tiraje_maximo']?>");
		$("#txtCosUniOff1").val("<?= $procesosOffset['Maquila1']['costo_unitario']?>");
		$("#txtCosUniOff2").val("<?= $procesosOffset['Maquila2']['costo_unitario']?>");
		$("#txtCosUniOff3").val("<?= $procesosOffset['Maquila3']['costo_unitario']?>");
		$("#txtIdLamOffset").val("<?= $procesosOffset['Maquila Lamina']['id_offset']?>");
		$("#txtIdArrOffset").val("<?= $procesosOffset['Maquila Arreglo']['id_offset']?>");
		$("#txtIdTirOffset2").val("<?= $procesosOffset['Maquila1']['id_offset']?>");
		$("#txtIdTirOffset3").val("<?= $procesosOffset['Maquila2']['id_offset']?>");
		$("#txtIdTirOffset4").val("<?= $procesosOffset['Maquila3']['id_offset']?>");
		}
	});

	$("#btnOffMP").click(function(){
		if(a==0){
		$("#Lamina").show();
		$("#Arreglo").show();
		$("#txtCosOffTir").hide();
		$("#lblCosMillCol").hide();
		$("#lblCosMillCol1").hide();

		$("#lblTirOff1").show();
		$("#lblTirOff2").show();
		$("#lblTirOff3").show();

		$("#lblTirMin").hide();
		$("#lblTirMax").hide();
		$("#txtTirMinOff").hide();
		$("#txtTirMaxOff").hide();

		$("#txtRangOff11").show();
		$("#txtRangOff12").show();
		$("#txtRangOff22").show();
		$("#txtRangOff32").show();
		$("#txtCosUniOff1").show();
		$("#txtCosUniOff2").show();
		$("#txtCosUniOff3").show();
		$("#txtRangOff21").show();		
		$("#txtRangOff31").show();
		$("#lblMinOff").show();
		$("#lblMaxOff").show();
		$("#lblRanOff").show();
		$("#lblPreOff").show();

		$("#txtCosOffArr").val("<?= $procesosOffset['Maquila Arreglo Pantone']['costo_unitario']?>");
		$("#txtRangOff11").val("<?= $procesosOffset['Maquila Pantone1']['tiraje_minimo']?>");
		$("#txtRangOff12").val("<?= $procesosOffset['Maquila Pantone1']['tiraje_maximo']?>");
		$("#txtRangOff21").val("<?= $procesosOffset['Maquila Pantone2']['tiraje_minimo']?>");
		$("#txtRangOff22").val("<?= $procesosOffset['Maquila Pantone2']['tiraje_maximo']?>");
		$("#txtRangOff31").val("<?= $procesosOffset['Maquila Pantone3']['tiraje_minimo']?>");
		$("#txtRangOff32").val("<?= $procesosOffset['Maquila Pantone3']['tiraje_maximo']?>");
		$("#txtCosUniOff1").val("<?= $procesosOffset['Maquila Pantone1']['costo_unitario']?>");
		$("#txtCosUniOff2").val("<?= $procesosOffset['Maquila Pantone2']['costo_unitario']?>");
		$("#txtCosUniOff3").val("<?= $procesosOffset['Maquila Pantone3']['costo_unitario']?>");
		$("#txtCosOffLam").val("<?= $procesosOffset['Maquila Lamina Pantone']['costo_unitario']?>");
		$("#txtIdLamOffset").val("<?= $procesosOffset['Maquila Lamina Pantone']['id_offset']?>");
		$("#txtIdArrOffset").val("<?= $procesosOffset['Maquila Arreglo Pantone']['id_offset']?>");
		$("#txtIdTirOffset2").val("<?= $procesosOffset['Maquila Pantone1']['id_offset']?>");
		$("#txtIdTirOffset3").val("<?= $procesosOffset['Maquila Pantone2']['id_offset']?>");
		$("#txtIdTirOffset4").val("<?= $procesosOffset['Maquila Pantone3']['id_offset']?>");
		}
	});

	$("#btnCor").click(function(){
		if (a==0) {

			$("#txtCosCor").val("<?= $procesosOffset['Corte']['costo_unitario']?>");
			$("#txtIdCorte").val("<?= $procesosOffset['Corte']['id_offset']?>");
		}
	});

	$("#btnSerN").click(function(){
		if(a==0){

			$("#txtRangSer11").val("<?= $procesosSerigrafia['cantidad1']['tiraje_minimo']?>");
			$("#txtRangSer12").val("<?= $procesosSerigrafia['cantidad1']['tiraje_maximo']?>");
			$("#txtRangSer21").val("<?= $procesosSerigrafia['cantidad2']['tiraje_minimo']?>");
			$("#txtRangSer22").val("<?= $procesosSerigrafia['cantidad2']['tiraje_maximo']?>");
			$("#txtRangSer31").val("<?= $procesosSerigrafia['cantidad3']['tiraje_minimo']?>");
			$("#txtRangSer32").val("<?= $procesosSerigrafia['cantidad3']['tiraje_maximo']?>");
			$("#txtRangSer41").val("<?= $procesosSerigrafia['cantidad4']['tiraje_minimo']?>");
			$("#txtRangSer42").val("<?= $procesosSerigrafia['cantidad4']['tiraje_maximo']?>");
			$("#txtCosSerArr").val("<?= $procesosSerigrafia['Arreglo']['costo_unitario']?>");
			$("#txtCosUniSer1").val("<?= $procesosSerigrafia['cantidad1']['costo_unitario']?>");
			$("#txtCosUniSer2").val("<?= $procesosSerigrafia['cantidad2']['costo_unitario']?>");
			$("#txtCosUniSer3").val("<?= $procesosSerigrafia['cantidad3']['costo_unitario']?>");
			$("#txtCosUniSer4").val("<?= $procesosSerigrafia['cantidad4']['costo_unitario']?>");
			$("#txtIdArrSerigrafia").val("<?= $procesosSerigrafia['Arreglo']['id_proc_serigrafia']?>");
			$("#txtIdTirSerigrafia1").val("<?= $procesosSerigrafia['cantidad1']['id_proc_serigrafia']?>");
			$("#txtIdTirSerigrafia2").val("<?= $procesosSerigrafia['cantidad2']['id_proc_serigrafia']?>");
			$("#txtIdTirSerigrafia3").val("<?= $procesosSerigrafia['cantidad3']['id_proc_serigrafia']?>");
			$("#txtIdTirSerigrafia4").val("<?= $procesosSerigrafia['cantidad4']['id_proc_serigrafia']?>");
		}
	});

	$("#btnSerP").click(function(){
		if(a==0){
		<?php
			$i=0;
			foreach ( $procesosSerigrafia as $proc ) {
				$nombre=$proc['nombre'];
			}
		?>

		$("#txtRangSer11").val("<?= $procesosSerigrafia['cantidad Pantone1']['tiraje_minimo']?>");
		$("#txtRangSer12").val("<?= $procesosSerigrafia['cantidad Pantone1']['tiraje_maximo']?>");
		$("#txtRangSer21").val("<?= $procesosSerigrafia['cantidad Pantone2']['tiraje_minimo']?>");
		$("#txtRangSer22").val("<?= $procesosSerigrafia['cantidad Pantone2']['tiraje_maximo']?>");
		$("#txtRangSer31").val("<?= $procesosSerigrafia['cantidad Pantone3']['tiraje_minimo']?>");
		$("#txtRangSer32").val("<?= $procesosSerigrafia['cantidad Pantone3']['tiraje_maximo']?>");
		$("#txtRangSer41").val("<?= $procesosSerigrafia['cantidad Pantone4']['tiraje_minimo']?>");
		$("#txtRangSer42").val("<?= $procesosSerigrafia['cantidad Pantone4']['tiraje_maximo']?>");
		$("#txtCosSerArr").val("<?= $procesosSerigrafia['Arreglo Pantone']['costo_unitario']?>");
		$("#txtCosUniSer1").val("<?= $procesosSerigrafia['cantidad Pantone1']['costo_unitario']?>");
		$("#txtCosUniSer2").val("<?= $procesosSerigrafia['cantidad Pantone2']['costo_unitario']?>");
		$("#txtCosUniSer3").val("<?= $procesosSerigrafia['cantidad Pantone3']['costo_unitario']?>");
		$("#txtCosUniSer4").val("<?= $procesosSerigrafia['cantidad Pantone4']['costo_unitario']?>");
		$("#txtIdArrSerigrafia").val("<?= $procesosSerigrafia['Arreglo Pantone']['id_proc_serigrafia']?>");
		$("#txtIdTirSerigrafia1").val("<?= $procesosSerigrafia['cantidad Pantone1']['id_proc_serigrafia']?>");
		$("#txtIdTirSerigrafia2").val("<?= $procesosSerigrafia['cantidad Pantone2']['id_proc_serigrafia']?>");
		$("#txtIdTirSerigrafia3").val("<?= $procesosSerigrafia['cantidad Pantone3']['id_proc_serigrafia']?>");
		$("#txtIdTirSerigrafia4").val("<?= $procesosSerigrafia['cantidad Pantone4']['id_proc_serigrafia']?>");
		}
	});

	$("#btnDig").click(function(){
		if(a==0){

			$("#txtRanMinDig1").val("<?= $digital['Frente Carta'][1]['tiraje_minimo']?>");
			$("#txtRanMaxDig1").val("<?= $digital['Frente Carta'][1]['tiraje_maximo']?>");
			$("#txtCosFreDig11").val("<?= $digital['Frente Carta'][1]['costo_unitario']?>");
			$("#txtCosVueDig11").val("<?= $digital['Vuelta Carta'][1]['costo_unitario']?>");
			$("#txtCosFreDig12").val("<?= $digital['Frente Doble Carta'][1]['costo_unitario']?>");
			$("#txtCosVueDig12").val("<?= $digital['Vuelta Doble Carta'][1]['costo_unitario']?>");
			$("#txtRanMinDig2").val("<?= $digital['Frente Carta'][2]['tiraje_minimo']?>");
			$("#txtRanMaxDig2").val("<?= $digital['Frente Carta'][2]['tiraje_maximo']?>");
			$("#txtCosFreDig21").val("<?= $digital['Frente Carta'][2]['costo_unitario']?>");
			$("#txtCosVueDig21").val("<?= $digital['Vuelta Carta'][2]['costo_unitario']?>");
			$("#txtCosFreDig22").val("<?= $digital['Frente Doble Carta'][2]['costo_unitario']?>");
			$("#txtCosVueDig22").val("<?= $digital['Vuelta Doble Carta'][2]['costo_unitario']?>");
			$("#txtRanMinDig3").val("<?= $digital['Frente Carta'][3]['tiraje_minimo']?>");
			$("#txtRanMaxDig3").val("<?= $digital['Frente Carta'][3]['tiraje_maximo']?>");
			$("#txtCosFreDig31").val("<?= $digital['Frente Carta'][3]['costo_unitario']?>");
			$("#txtCosVueDig31").val("<?= $digital['Vuelta Carta'][3]['costo_unitario']?>");
			$("#txtCosFreDig32").val("<?= $digital['Frente Doble Carta'][3]['costo_unitario']?>");
			$("#txtCosVueDig32").val("<?= $digital['Vuelta Doble Carta'][3]['costo_unitario']?>");
			$("#txtIdFreDigital1").val("<?= $digital['Frente Carta'][1]['id_proc_digital']?>");
			$("#txtIdFreDigital2").val("<?= $digital['Frente Doble Carta'][1]['id_proc_digital']?>");
			$("#txtIdFreDigital3").val("<?= $digital['Frente Carta'][2]['id_proc_digital']?>");
			$("#txtIdFreDigital4").val("<?= $digital['Frente Doble Carta'][2]['id_proc_digital']?>");
			$("#txtIdFreDigital5").val("<?= $digital['Frente Carta'][3]['id_proc_digital']?>");
			$("#txtIdFreDigital6").val("<?= $digital['Frente Doble Carta'][3]['id_proc_digital']?>");
			$("#txtIdVueDigital1").val("<?= $digital['Vuelta Carta'][1]['id_proc_digital']?>");
			$("#txtIdVueDigital2").val("<?= $digital['Vuelta Doble Carta'][1]['id_proc_digital']?>");
			$("#txtIdVueDigital3").val("<?= $digital['Vuelta Carta'][2]['id_proc_digital']?>");
			$("#txtIdVueDigital4").val("<?= $digital['Vuelta Doble Carta'][2]['id_proc_digital']?>");
			$("#txtIdVueDigital5").val("<?= $digital['Vuelta Carta'][3]['id_proc_digital']?>");
			$("#txtIdVueDigital6").val("<?= $digital['Vuelta Doble Carta'][3]['id_proc_digital']?>");

		}
	});

	$("#btnHotH").click( function(){
		if(a==0){

			$("#txtCosHotPlac").val("<?= $procesosHotStamping['Placa']['precio_unitario']?>");
			$("#txtCosHotArr").val("<?= $procesosHotStamping['Arreglo']['precio_unitario']?>");
			$("#txtCosHotPel").val("<?= $procesosHotStamping['Pelicula']['precio_unitario']?>");
			$("#txtMinHot1").val("<?= $procesosHotStamping['Estampado1']['tiraje_minimo']?>");
			$("#txtMaxHot1").val("<?= $procesosHotStamping['Estampado1']['tiraje_maximo']?>");
			$("#txtMinHot2").val("<?= $procesosHotStamping['Estampado2']['tiraje_minimo']?>");
			$("#txtMaxHot2").val("<?= $procesosHotStamping['Estampado2']['tiraje_maximo']?>");
			$("#txtMinHot3").val("<?= $procesosHotStamping['Estampado3']['tiraje_minimo']?>");
			$("#txtMaxHot3").val("<?= $procesosHotStamping['Estampado3']['tiraje_maximo']?>");
			$("#txtCosHot1").val("<?= $procesosHotStamping['Estampado1']['precio_unitario']?>");
			$("#txtCosHot2").val("<?= $procesosHotStamping['Estampado2']['precio_unitario']?>");
			$("#txtCosHot3").val("<?= $procesosHotStamping['Estampado3']['precio_unitario']?>");
			$("#txtTamHot").val("<?= $procesosHotStamping['Placa']['tamano_minimo_placa']?>");
			$("#txtIdPlaHS").val("<?= $procesosHotStamping['Placa']['id_hotstamping']?>");
			$("#txtIdArrHS").val("<?= $procesosHotStamping['Arreglo']['id_hotstamping']?>");
			$("#txtIdPelHS").val("<?= $procesosHotStamping['Pelicula']['id_hotstamping']?>");
			$("#txtIdTirHS1").val("<?= $procesosHotStamping['Estampado1']['id_hotstamping']?>");
			$("#txtIdTirHS2").val("<?= $procesosHotStamping['Estampado2']['id_hotstamping']?>");
			$("#txtIdTirHS3").val("<?= $procesosHotStamping['Estampado3']['id_hotstamping']?>");
		}
	});

	$("#btnHotH1").click( function(){
		if(a==0){

			$("#txtCosHotPlac").val("<?= $procesosHotStamping['HG1 Placa']['precio_unitario']?>");
			$("#txtCosHotArr").val("<?= $procesosHotStamping['HG1 Arreglo']['precio_unitario']?>");
			$("#txtCosHotPel").val("<?= $procesosHotStamping['HG1 Pelicula']['precio_unitario']?>");
			$("#txtMinHot1").val("<?= $procesosHotStamping['HG1 Estampado1']['tiraje_minimo']?>");
			$("#txtMaxHot1").val("<?= $procesosHotStamping['HG1 Estampado1']['tiraje_maximo']?>");
			$("#txtMinHot2").val("<?= $procesosHotStamping['HG1 Estampado2']['tiraje_minimo']?>");
			$("#txtMaxHot2").val("<?= $procesosHotStamping['HG1 Estampado2']['tiraje_maximo']?>");
			$("#txtMinHot3").val("<?= $procesosHotStamping['HG1 Estampado3']['tiraje_minimo']?>");
			$("#txtMaxHot3").val("<?= $procesosHotStamping['HG1 Estampado3']['tiraje_maximo']?>");
			$("#txtCosHot1").val("<?= $procesosHotStamping['HG1 Estampado1']['precio_unitario']?>");
			$("#txtCosHot2").val("<?= $procesosHotStamping['HG1 Estampado2']['precio_unitario']?>");
			$("#txtCosHot3").val("<?= $procesosHotStamping['HG1 Estampado3']['precio_unitario']?>");
			$("#txtTamHot").val("<?= $procesosHotStamping['Placa']['tamano_minimo_placa']?>");
			$("#txtIdPlaHS").val("<?= $procesosHotStamping['HG1 Placa']['id_hotstamping']?>");
			$("#txtIdArrHS").val("<?= $procesosHotStamping['HG1 Arreglo']['id_hotstamping']?>");
			$("#txtIdPelHS").val("<?= $procesosHotStamping['HG1 Pelicula']['id_hotstamping']?>");
			$("#txtIdTirHS1").val("<?= $procesosHotStamping['HG1 Estampado1']['id_hotstamping']?>");
			$("#txtIdTirHS2").val("<?= $procesosHotStamping['HG1 Estampado2']['id_hotstamping']?>");
			$("#txtIdTirHS3").val("<?= $procesosHotStamping['HG1 Estampado3']['id_hotstamping']?>");
		}
	});

	$("#btnHotH2").click( function(){
		if(a==0){

			$("#txtCosHotPlac").val("<?= $procesosHotStamping['HG2 Placa']['precio_unitario']?>");
			$("#txtCosHotArr").val("<?= $procesosHotStamping['HG2 Arreglo']['precio_unitario']?>");
			$("#txtCosHotPel").val("<?= $procesosHotStamping['HG2 Pelicula']['precio_unitario']?>");
			$("#txtMinHot1").val("<?= $procesosHotStamping['HG2 Estampado1']['tiraje_minimo']?>");
			$("#txtMaxHot1").val("<?= $procesosHotStamping['HG2 Estampado1']['tiraje_maximo']?>");
			$("#txtMinHot2").val("<?= $procesosHotStamping['HG2 Estampado2']['tiraje_minimo']?>");
			$("#txtMaxHot2").val("<?= $procesosHotStamping['HG2 Estampado2']['tiraje_maximo']?>");
			$("#txtMinHot3").val("<?= $procesosHotStamping['HG2 Estampado3']['tiraje_minimo']?>");
			$("#txtMaxHot3").val("<?= $procesosHotStamping['HG2 Estampado3']['tiraje_maximo']?>");
			$("#txtCosHot1").val("<?= $procesosHotStamping['HG2 Estampado1']['precio_unitario']?>");
			$("#txtCosHot2").val("<?= $procesosHotStamping['HG2 Estampado2']['precio_unitario']?>");
			$("#txtCosHot3").val("<?= $procesosHotStamping['HG2 Estampado3']['precio_unitario']?>");
			$("#txtTamHot").val("<?= $procesosHotStamping['HG2 Placa']['tamano_minimo_placa']?>");
			$("#txtIdPlaHS").val("<?= $procesosHotStamping['HG2 Placa']['id_hotstamping']?>");
			$("#txtIdArrHS").val("<?= $procesosHotStamping['HG2 Arreglo']['id_hotstamping']?>");
			$("#txtIdPelHS").val("<?= $procesosHotStamping['HG2 Pelicula']['id_hotstamping']?>");
			$("#txtIdTirHS1").val("<?= $procesosHotStamping['HG2 Estampado1']['id_hotstamping']?>");
			$("#txtIdTirHS2").val("<?= $procesosHotStamping['HG2 Estampado2']['id_hotstamping']?>");
			$("#txtIdTirHS3").val("<?= $procesosHotStamping['HG2 Estampado3']['id_hotstamping']?>");
		}
	});

	$("#btnGraG1").click( function(){
		if(a==0){

			$("#txtCosGraPlac").val("<?= $procesosGrabado['G1 Placa']['precio_unitario']?>");
			$("#txtCosGraArr").val("<?= $procesosGrabado['G1 Arreglo']['precio_unitario']?>");
			$("#txtMinGra1").val("<?= $procesosGrabado['G1 Estampado1']['tiraje_minimo']?>");
			$("#txtMaxGra1").val("<?= $procesosGrabado['G1 Estampado1']['tiraje_maximo']?>");
			$("#txtMinGra2").val("<?= $procesosGrabado['G1 Estampado2']['tiraje_minimo']?>");
			$("#txtMaxGra2").val("<?= $procesosGrabado['G1 Estampado2']['tiraje_maximo']?>");
			$("#txtMinGra3").val("<?= $procesosGrabado['G1 Estampado3']['tiraje_minimo']?>");
			$("#txtMaxGra3").val("<?= $procesosGrabado['G1 Estampado3']['tiraje_maximo']?>");
			$("#txtCosGra1").val("<?= $procesosGrabado['G1 Estampado1']['precio_unitario']?>");
			$("#txtCosGra2").val("<?= $procesosGrabado['G1 Estampado2']['precio_unitario']?>");
			$("#txtCosGra3").val("<?= $procesosGrabado['G1 Estampado3']['precio_unitario']?>");
			$("#txtTamGra").val("<?= $procesosGrabado['G1 Placa']['tamano_minimo_placa']?>");
			$("#txtIdPlaG").val("<?= $procesosGrabado['G1 Placa']['id_grabado']?>");
			$("#txtIdArrG").val("<?= $procesosGrabado['G1 Arreglo']['id_grabado']?>");
			$("#txtIdTirG1").val("<?= $procesosGrabado['G1 Estampado1']['id_grabado']?>");
			$("#txtIdTirG2").val("<?= $procesosGrabado['G1 Estampado2']['id_grabado']?>");
			$("#txtIdTirG3").val("<?= $procesosGrabado['G1 Estampado3']['id_grabado']?>");
		}
	});

	$("#btnCL").click( function(){
		if(a==0){

			$("#txtCosCorLasT1").val("<?= $procesosLaser['Figura Sencilla']['tiempo_requerido']?>");
			$("#txtCosCorLasT2").val("<?= $procesosLaser['Figura Detallada']['tiempo_requerido']?>");
			$("#txtCosCorLasT3").val("<?= $procesosLaser['Ranura Sencilla']['tiempo_requerido']?>");
			$("#txtCosCorLasT4").val("<?= $procesosLaser['Ranura Detallada']['tiempo_requerido']?>");
			$("#txtCosCorLasT5").val("<?= $procesosLaser['Personalizado']['tiempo_requerido']?>");
			$("#txtCosCorLasC1").val("<?= $procesosLaser['Figura Sencilla']['costo_unitario']?>");
			$("#txtCosCorLasC2").val("<?= $procesosLaser['Figura Detallada']['costo_unitario']?>");
			$("#txtCosCorLasC3").val("<?= $procesosLaser['Ranura Sencilla']['costo_unitario']?>");
			$("#txtCosCorLasC4").val("<?= $procesosLaser['Ranura Detallada']['costo_unitario']?>");
			$("#txtCosCorLasC5").val("<?= $procesosLaser['Personalizado']['costo_unitario']?>");
			$("#txtIdSenLaser1").val("<?= $procesosLaser['Figura Sencilla']['id_proc_corte_laser']?>");
			$("#txtIdSenLaser2").val("<?= $procesosLaser['Ranura Sencilla']['id_proc_corte_laser']?>");
			$("#txtIdDetLaser1").val("<?= $procesosLaser['Figura Detallada']['id_proc_corte_laser']?>");
			$("#txtIdDetLaser2").val("<?= $procesosLaser['Ranura Detallada']['id_proc_corte_laser']?>");
			$("#txtIdPerLaser").val("<?= $procesosLaser['Personalizado']['id_proc_corte_laser']?>");
		}
	});

	$("#btnGraG2").click( function(){
		if(a==0){

			$("#txtCosGraPlac").val("<?= $procesosGrabado['G2 Placa']['precio_unitario']?>");
			$("#txtCosGraArr").val("<?= $procesosGrabado['G2 Arreglo']['precio_unitario']?>");
			$("#txtMinGra1").val("<?= $procesosGrabado['G2 Estampado1']['tiraje_minimo']?>");
			$("#txtMaxGra1").val("<?= $procesosGrabado['G2 Estampado1']['tiraje_maximo']?>");
			$("#txtMinGra2").val("<?= $procesosGrabado['G2 Estampado2']['tiraje_minimo']?>");
			$("#txtMaxGra2").val("<?= $procesosGrabado['G2 Estampado2']['tiraje_maximo']?>");
			$("#txtMinGra3").val("<?= $procesosGrabado['G2 Estampado3']['tiraje_minimo']?>");
			$("#txtMaxGra3").val("<?= $procesosGrabado['G2 Estampado3']['tiraje_maximo']?>");
			$("#txtCosGra1").val("<?= $procesosGrabado['G2 Estampado1']['precio_unitario']?>");
			$("#txtCosGra2").val("<?= $procesosGrabado['G2 Estampado2']['precio_unitario']?>");
			$("#txtCosGra3").val("<?= $procesosGrabado['G2 Estampado3']['precio_unitario']?>");
			$("#txtTamGra").val("<?= $procesosGrabado['G2 Placa']['tamano_minimo_placa']?>");
			$("#txtIdPlaG").val("<?= $procesosGrabado['G2 Placa']['id_grabado']?>");
			$("#txtIdArrG").val("<?= $procesosGrabado['G2 Arreglo']['id_grabado']?>");
			$("#txtIdTirG1").val("<?= $procesosGrabado['G2 Estampado1']['id_grabado']?>");
			$("#txtIdTirG2").val("<?= $procesosGrabado['G2 Estampado2']['id_grabado']?>");
			$("#txtIdTirG3").val("<?= $procesosGrabado['G2 Estampado3']['id_grabado']?>");
		}
	});

	$("#btnSua").click( function(){
		if(a==0){
			
			$("#txtCosto1").val("<?= $procesosSuaje['Perimetral']['costo_unitario']?>");
			$("#txtCosto2").val("<?= $procesosSuaje['Figura']['costo_unitario']?>");
			$("#txtTiro1").val("<?= $procesosSuaje['Tiro']['costo_unitario']?>");
			$("#txtTiro2").val("<?= $procesosSuaje['Tiro Figura']['costo_unitario']?>");
			$("#txtArreglo1").val("<?= $procesosSuaje['Arreglo']['costo_unitario']?>");
			$("#txtArreglo2").val("<?= $procesosSuaje['Arreglo Figura']['costo_unitario']?>");
			$("#txtPerimetro1").val("<?= $procesosSuaje['Perimetral']['perimetro_minimo']?>");
			$("#txtPerimetro2").val("<?= $procesosSuaje['Figura']['perimetro_minimo']?>");
			$("#txtIdPerSuaje").val("<?= $procesosSuaje['Perimetral']['id_suaje']?>");
			$("#txtIdFigSuaje").val("<?= $procesosSuaje['Figura']['id_suaje']?>");
		}
	});

	$("#btnLam").click(function(){
		if(a==0){

			$("#txtCosLam1").val("<?= $procesosLaminado['Mate']['costo_unitario']?>");
			$("#txtCosLam2").val("<?= $procesosLaminado['Soft Touch']['costo_unitario']?>");
			$("#txtCosLam3").val("<?= $procesosLaminado['Anti Scratch']['costo_unitario']?>");
			$("#txtCosLam4").val("<?= $procesosLaminado['Superadherente']['costo_unitario']?>");
			$("#txtRanMinLam1").val("<?= $procesosLaminado['Mate']['tiraje_minimo']?>");
			$("#txtRanMinLam2").val("<?= $procesosLaminado['Soft Touch']['tiraje_minimo']?>");
			$("#txtRanMinLam3").val("<?= $procesosLaminado['Anti Scratch']['tiraje_minimo']?>");
			$("#txtRanMinLam4").val("<?= $procesosLaminado['Superadherente']['tiraje_minimo']?>");
			$("#txtRanMaxLam1").val("<?= $procesosLaminado['Mate']['tiraje_maximo']?>");
			$("#txtRanMaxLam2").val("<?= $procesosLaminado['Soft Touch']['tiraje_maximo']?>");
			$("#txtRanMaxLam3").val("<?= $procesosLaminado['Anti Scratch']['tiraje_maximo']?>");
			$("#txtRanMaxLam4").val("<?= $procesosLaminado['Superadherente']['tiraje_maximo']?>");
			$("#txtIdLam1").val("<?= $procesosLaminado['Mate']['id_proc_laminado']?>");
			$("#txtIdLam2").val("<?= $procesosLaminado['Soft Touch']['id_proc_laminado']?>");
			$("#txtIdLam3").val("<?= $procesosLaminado['Anti Scratch']['id_proc_laminado']?>");
			$("#txtIdLam4").val("<?= $procesosLaminado['Superadherente']['id_proc_laminado']?>");
		}
	});

	$("#btnEnc").click(function(){

		if( a == 0 ){

			//Perforado para iman y puesta de iman
			$("#txtRangEnc11").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][0]['tiraje_minimo']?>");
			$("#txtRangEnc12").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][0]['tiraje_maximo']?>");
			$("#txtRangEnc21").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][1]['tiraje_minimo']?>");
			$("#txtRangEnc22").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][1]['tiraje_maximo']?>");
			$("#txtCosUniEnc1").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][0]['precio_unitario']?>");
			$("#txtCosUniEnc2").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][1]['precio_unitario']?>");

			$("#txtIdEnc1").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][0]['id_encuadernacion']?>");
			$("#txtIdEnc2").val("<?= $procesosEncuadernacion['Perforado para iman y puesta de iman'][1]['id_encuadernacion']?>");

			//Empalme cajon
			$("#txtRangEC11").val("<?= $procesosEncuadernacion['Empalme de cajon'][0]['tiraje_minimo']?>");
			$("#txtRangEC12").val("<?= $procesosEncuadernacion['Empalme de cajon'][0]['tiraje_maximo']?>");
			$("#txtRangEC21").val("<?= $procesosEncuadernacion['Empalme de cajon'][1]['tiraje_minimo']?>");
			$("#txtRangEC22").val("<?= $procesosEncuadernacion['Empalme de cajon'][1]['tiraje_maximo']?>");
			$("#txtCosUniEC1").val("<?= $procesosEncuadernacion['Empalme de cajon'][0]['precio_unitario']?>");
			$("#txtCosUniEC2").val("<?= $procesosEncuadernacion['Empalme de cajon'][1]['precio_unitario']?>");

			$("#txtIdEC1").val("<?= $procesosEncuadernacion['Empalme de cajon'][0]['id_encuadernacion']?>");
			$("#txtIdEC2").val("<?= $procesosEncuadernacion['Empalme de cajon'][1]['id_encuadernacion']?>");

			//Forrado cajon
			$("#txtRangFC11").val("<?= $procesosEncuadernacion['Forrado de cajon'][0]['tiraje_minimo']?>");
			$("#txtRangFC12").val("<?= $procesosEncuadernacion['Forrado de cajon'][0]['tiraje_maximo']?>");
			$("#txtRangFC21").val("<?= $procesosEncuadernacion['Forrado de cajon'][1]['tiraje_minimo']?>");
			$("#txtRangFC22").val("<?= $procesosEncuadernacion['Forrado de cajon'][1]['tiraje_maximo']?>");
			$("#txtCosUniFC1").val("<?= $procesosEncuadernacion['Forrado de cajon'][0]['precio_unitario']?>");
			$("#txtCosUniFC2").val("<?= $procesosEncuadernacion['Forrado de cajon'][1]['precio_unitario']?>");

			$("#txtIdFC1").val("<?= $procesosEncuadernacion['Forrado de cajon'][0]['id_encuadernacion']?>");
			$("#txtIdFC2").val("<?= $procesosEncuadernacion['Forrado de cajon'][1]['id_encuadernacion']?>");

			//Puesta de banco
			$("#txtRangPB11").val("<?= $procesosEncuadernacion['Puesta de banco'][0]['tiraje_minimo']?>");
			$("#txtRangPB12").val("<?= $procesosEncuadernacion['Puesta de banco'][0]['tiraje_maximo']?>");
			$("#txtRangPB21").val("<?= $procesosEncuadernacion['Puesta de banco'][1]['tiraje_minimo']?>");
			$("#txtRangPB22").val("<?= $procesosEncuadernacion['Puesta de banco'][1]['tiraje_maximo']?>");
			$("#txtCosUniPB1").val("<?= $procesosEncuadernacion['Puesta de banco'][0]['precio_unitario']?>");
			$("#txtCosUniPB2").val("<?= $procesosEncuadernacion['Puesta de banco'][1]['precio_unitario']?>");

			$("#txtIdPB1").val("<?= $procesosEncuadernacion['Puesta de banco'][0]['id_encuadernacion']?>");
			$("#txtIdPB2").val("<?= $procesosEncuadernacion['Puesta de banco'][1]['id_encuadernacion']?>");
			
			//Despunte de esquina para cajon
			$("#txtIdDEC").val("<?= $procesosEncuadernacion['Despunte de esquinas para cajon']['id_encuadernacion']?>");
			$("#txtCosDEC").val("<?= $procesosEncuadernacion['Despunte de esquinas para cajon']['precio_unitario']?>");

			//Arreglo de Forrado de Cajon
			$("#txtIdAFC").val("<?= $procesosEncuadernacion['Arreglo de Forrado de cajon']['id_encuadernacion']?>");
			$("#txtCosAFC").val("<?= $procesosEncuadernacion['Arreglo de Forrado de cajon']['precio_unitario']?>");

			//Encajada
			$("#txtIdEn").val("<?= $procesosEncuadernacion['Encajada']['id_encuadernacion']?>");
			$("#txtCosEn").val("<?= $procesosEncuadernacion['Encajada']['precio_unitario']?>");
			
			//Domi
			$("#txtIdDomi").val("<?= $procesosEncuadernacion['Domi']['id_encuadernacion']?>");
			$("#txtCosD").val("<?= $procesosEncuadernacion['Domi']['precio_unitario']?>");
		}
	});

	$("#btnRan").click(function(){

		if( a == 0 ){

			//Arreglo

			$("#txtIdArr").val("<?= $procesosRanurado[0]['id_ranurado']?>");
			$("#txtCosArr").val("<?= $procesosRanurado[0]['precio_unitario']?>");

			//Por Ranura
			$("#txtRan11").val("<?= $procesosRanurado['Por Ranura'][0]['tiraje_minimo']?>");
			$("#txtRan12").val("<?= $procesosRanurado['Por Ranura'][0]['tiraje_maximo']?>");
			$("#txtRan21").val("<?= $procesosRanurado['Por Ranura'][1]['tiraje_minimo']?>");
			$("#txtRan22").val("<?= $procesosRanurado['Por Ranura'][1]['tiraje_maximo']?>");

			$("#txtRan31").val("<?= $procesosRanurado['Por Ranura'][2]['tiraje_minimo']?>");
			$("#txtRan32").val("<?= $procesosRanurado['Por Ranura'][2]['tiraje_maximo']?>");
			$("#txtRan41").val("<?= $procesosRanurado['Por Ranura'][3]['tiraje_minimo']?>");
			$("#txtRan42").val("<?= $procesosRanurado['Por Ranura'][3]['tiraje_maximo']?>");

			$("#txtCos1").val("<?= $procesosRanurado['Por Ranura'][0]['precio_unitario']?>");
			$("#txtCos2").val("<?= $procesosRanurado['Por Ranura'][1]['precio_unitario']?>");
			$("#txtCos3").val("<?= $procesosRanurado['Por Ranura'][2]['precio_unitario']?>");
			$("#txtCos4").val("<?= $procesosRanurado['Por Ranura'][3]['precio_unitario']?>");

			$("#txtId1").val("<?= $procesosRanurado['Por Ranura'][0]['id_ranurado']?>");
			$("#txtId2").val("<?= $procesosRanurado['Por Ranura'][1]['id_ranurado']?>");
			$("#txtId3").val("<?= $procesosRanurado['Por Ranura'][2]['id_ranurado']?>");
			$("#txtId4").val("<?= $procesosRanurado['Por Ranura'][3]['id_ranurado']?>");
		}
	});

	function opacidad(){

		prin.style.display="flex";
	}

	function show(obj){

		formSwitch=document.getElementById(obj);
		$("#idOffset").hide("Normal");
		$("#idSerigrafia").hide("Normal");
		$("#idDigital").hide("Normal");
		$("#idLaminado").hide("Normal");
		$("#idGrabado").hide("Normal");
		$("#idHotStamping").hide("Normal");
		$("#idSuaje").hide("Normal");
		if (formSwitch.style.display=="none") {

			$(formSwitch).show("Normal");
		}
	}
	
	function asignaNum(){

		a=1;
	}

	function validaNumericos(event) {

	    if(event.charCode >= 48 && event.charCode <= 57){
	      return true;
	     }
	     return false;        
	}

	$("#btnImpresion").click( function(){

		var ventana = window.open("<?=URL?>modificaprocesos/imprProcesos", "Impresion", "width=600, height=600");
		return true;
	});
</script>