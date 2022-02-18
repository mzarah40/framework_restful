<main> 
	<h1 class="text-center mt-3">Criador de Crud PHP</h1>
	<hr />
	<div class="container-fluid">
		
		<br>
		<div class="card bg-success text-white">
			<div class="card-header">Informações do Formulário</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-2 col-sm-12">
						Nome, Label:<br>
						<input type="text" name="name_label" class="form-control">
					</div>
					<div class="col-md-2 col-sm-12">
						Enctype:<br>
						<select name="enctype" class="form-control">
							<option value="">x-www-url-encoded</option>
							<option value="multipart/form-data">multipart/form-data</option>
						</select>
					</div>
					<div class="col-md-2 col-sm-12">
						OnSubmit:<br>
						<input type="text" name="onsubmit" placeholder="JavaScript" class="form-control" />
					</div>
					<div class="col-md-1 col-sm-12">
						Method:<br>
						<select name="method" class="form-control">
							<option value="POST">POST</option>
							<option value="GET">GET</option>
							<option value="PUT">PUT</option>
							<option value="PATCH">PATCH</option>
							<option value="DELETE">DELETE</option>
						</select>
					</div>
					<div class="col-md-2 col-sm-12">
						Action(URL Destino):<br>
						<input type="text" name="action" class="form-control" />
					</div>
					<div class="col-md-1 col-sm-12">
						Class:<br>
						<input type="text" name="class" class="form-control" placeholder="form-horizontal" value="form-horizontal" />
					</div>
					<div class="col-md-2 col-sm-12">
						Skin:<br>
						<select name="skin" class="form-control">
							<option value="">Clean</option>
							<option value="bg-dark">Dark</option>
							<option value="bg-success">Verde</option>
							<option value="bg-info">Light Azul</option>
							<option value="bg-primary">Azul</option>
							<option value="bg-warning">Laranja</option>
							<option value="bg-danger">Vermelho</option>
						</select>
					</div>
				</div><!-- fim de row -->
			</div><!-- fim de card-body -->
		</div><!-- fim de bg-success -->
		<br>

		<div class="card bg-info text-white">
			<div class="card-header">Campos:</div>
			<div class="card-body">

				<div class="row" id="fields">
					
					<div class="row" style="margin-left:50px">
					<div class="col-md-1 col-sm-12">
						Tipo:<br>
						<select name="tipo[]" class="form-control"> 
							<option name="text">Text</option>
							<option name="select">Select</option>
							<option name="number">Number</option>
							<option name="date">Date</option>
							<option name="hidden">Hidden</option>
							<option name="textarea">TextArea</option>
							<option name="submit">Submit</option>
							<option name="button">Button</option>
							<option name="radio">Radio</option>
							<option name="checkbox">Checkbox</option>
							<option name="email">E-mail</option>
							<option name="color">Color</option>
							<option name="file">File</option>
							<option name="password">Password</option>
						</select>
					</div>
					<div class="col-md-1 col-sm-12" title="Caracteristicas do campo separadas por vírgula. Dados: Name, Label, Id, Tipo de dado, Comprimento. ( Exemplo: nome, Nome, nome, VARCHAR, 255 )">
						Caracteristicas:
						<input type="text" name="nome[]" placeholder="Nome do Campo" class="form-control">
					</div>
					<div class="col-md-1 col-sm-12">
						Value: <br>
						<input type="text" name="value[]" placeholder="Value" class="form-control" title="Valor se houver" />
					</div>
					<div class="col-md-1 col-sm-12" title="Número de colunas deste campo no formulário HTML">
						Colunas:<br>
						<select name="colunas[]" class="form-control">
							<option value="">0 col</option>
							<option value="1">1 col</option>
							<option value="2">2 col</option>
							<option value="3">3 col</option>
							<option value="4">4 col</option>
							<option value="5">5 col</option>
							<option value="6">6 col</option>
							<option value="7">7 col</option>
							<option value="8">8 col</option>
							<option value="9">9 col</option>
							<option value="10">10 col</option>
							<option value="11">11 col</option>
							<option value="12">12 col</option>
						</select>
					</div>
					<div class="col-md-1 col-sm-12">
						Máscara:<br>
						<select name="mascara[]" class="form-control">
							<option value="">Escolha</option>
							<option value="date">Data</option>
							<option value="money">Monetário</option>
							<option value="cpf">CPF</option>
							<option value="cnpj">CNPJ</option>
							<option value="numero">Sómente Números</option>
						</select>
					</div>
					<div class="col-md-1 col-sm-12">
						Habilitado ? <br>
						<select name="habilitado[]" class="form-control">
							<option value="">Habilitado</option>
							<option value="disabled">Desabilitado</option>
						</select>
					</div>	
					<div class="col-md-1 col-sm-12">
						Evento: <br>
						<select name="evento[]" class="form-control">
							<option value="">Evento</option>
							<option value="onblur=">onBlur</option>
							<option value="onkeyup=">onKeyUp</option>
							<option value="onkeypress=">onKeyPress</option>
							<option value="onchange=">onChange</option>
							<option value="onclick=">onClick</option>
							<option value="oncheck=">onCheck</option>
							<option value="onfocus=">onFocus</option>
						</select>
					</div>
					<div class="col-md-1 col-sm-12">
						JavaScript: <br>
						<input type="text" name="javascript[]" placeholder="JavaScript" class="form-control" />
					</div>
					<div class="col-md-1 col-sm-12">
						Class: <br>
						<input type="text" name="class[]" placeholder="Classe" class="form-control" value="form-control" />
					</div>
					<div class="col-md-1 col-sm-12">
						MaxLength: <br>
						<input type="number" name="maxlength[]" placeholer="MaxLength" class="form-control" />
					</div>
					<div class="col-md-1 col-sm-12">
						Obrigatório ? <br>
						<select name="obrigatorio[]" class="form-control">
							<option value="required">Obrigatório</option>
							<option value="">Não Obrigatório</option>
						</select>
					</div>
					<div class="col-md-1 col-sm-12">
						<br>
						<input type="checkbox" name="visualizar_na_grid[]" value="sim" title="Visualizar na Grid">
						<a href="#" onClick="javascript:add();return false;" class="badge badge-warning">+</a>&nbsp;
					</div>

					</div><!-- fecha row -->


				
				</div>
			</div>
		</div><!-- end card bg-info -->
	</div>
</main>