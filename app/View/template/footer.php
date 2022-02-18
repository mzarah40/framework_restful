	<input type="hidden" id="field_id" value="1" />
	<script src="<?=BASE_URL?>assets/js/jquery.js"></script>
	<script src="<?=BASE_URL?>assets/css/bootstrap/js/bootstrap.min.js"></script>
	<script>


	var formulario = (id) => {


		var frm =  '<hr><div class="row" id="campo'+id+'" style="margin-left:50px;">';
		    frm += '<div class="col-md-1 col-sm-12">';
			frm += '	Tipo:<br>';
			frm += '	<select name="tipo[]" class="form-control">';
			frm += '		<option name="text">Text</option>';
			frm += '		<option name="select">Select</option>';
			frm += '		<option name="number">Number</option>';
			frm += '	    <option name="date">Date</option>';
			frm += '		<option name="hidden">Hidden</option>';
			frm += '		<option name="textarea">TextArea</option>';
			frm += '		<option name="submit">Submit</option>';
			frm += '		<option name="button">Button</option>';
			frm += '		<option name="radio">Radio</option>';
			frm += '		<option name="checkbox">Checkbox</option>';
			frm += '		<option name="email">E-mail</option>';
			frm += '		<option name="color">Color</option>';
			frm += '		<option name="file">File</option>';
			frm += '		<option name="password">Password</option>';
			frm += '	</select>';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12" title="Caracteristicas do campo separadas por vírgula. Dados: Name, Label, Id, Tipo de dado, Comprimento. ( Exemplo: nome, Nome, nome, VARCHAR, 255 )">';
			frm += '	Caracteristicas:<br>';
			frm += '	<input type="text" name="nome[]" placeholder="Nome do Campo" class="form-control">';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	Value: <br>';
			frm += '	<input type="text" name="value[]" placeholder="Value" class="form-control" title="Valor se houver" />';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12" title="Número de colunas deste campo no formulário HTML">';
			frm += '	Colunas:<br>';
			frm += '	<select name="colunas[]" class="form-control">';
			frm += '		<option value="0">0 col</option>';
			frm += '		<option value="1">1 col</option>';
			frm += '		<option value="2">2 col</option>';
			frm += '		<option value="3">3 col</option>';
			frm += '		<option value="4">4 col</option>';
			frm += '		<option value="5">5 col</option>';
			frm += '		<option value="6">6 col</option>';
			frm += '		<option value="7">7 col</option>';
			frm += '		<option value="8">8 col</option>';
			frm += '		<option value="9">9 col</option>';
			frm += '		<option value="10">10 col</option>';
			frm += '		<option value="11">11 col</option>';
			frm += '		<option value="12">12 col</option>';
			frm += '	</select>';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	Máscara:<br>';
			frm += '	<select name="mascara[]" class="form-control">';
			frm += '		<option value="">Escolha</option>';
			frm += '		<option value="date">Data</option>';
			frm += '		<option value="money">Monetário</option>';
			frm += '		<option value="cpf">CPF</option>';
			frm += '		<option value="cnpj">CNPJ</option>';
			frm += '        <option value="numero">Sómente Números</option>';
			frm += '	</select>';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	Habilitado ? <br>';
			frm += '	<select name="habilitado[]" class="form-control">';
			frm += '		<option value="">Habilitado</option>';
			frm += '		<option value="disabled">Desabilitado</option>';
			frm += '	</select>';
			frm += '</div>';	
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	Evento: <br>';
			frm += '	<select name="evento[]" class="form-control">';
			frm += '		<option value="">Evento</option>';
			frm += '		<option value="onblur=">onBlur</option>';
			frm += '		<option value="onkeyup=">onKeyUp</option>';
			frm += '		<option value="onkeypress=">onKeyPress</option>';
			frm += '		<option value="onchange=">onChange</option>';
			frm += '		<option value="onclick=">onClick</option>';
			frm += '        <option value="oncheck=">onCheck</option>';
			frm += '		<option value="onfocus=">onFocus</option>'
			frm += '	</select>';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	JavaScript: <br>';
			frm += '	<input type="text" name="javascript[]" placeholder="JavaScript" class="form-control" />';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	Class: <br>';
			frm += '	<input type="text" name="class[]" placeholder="Classe" class="form-control" value="form-control" />';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	MaxLength: <br>';
			frm += '	<input type="number" name="maxlength[]" placeholer="MaxLength" class="form-control" />';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	Obrigatório ? <br>';
			frm += '	<select name="obrigatorio[]" class="form-control">';
			frm += '		<option value="required">Obrigatório</option>';
			frm += '		<option value="">Não Obrigatório</option>';
			frm += '	</select>';
			frm += '</div>';
			frm += '<div class="col-md-1 col-sm-12">';
			frm += '	<br>';
			frm += '<input type="checkbox" name="visualizar_na_grid[]" value="sim" title="Visualizar na Grid">';
			frm += '	<a href="#" onClick="add();return false;" class="badge badge-warning">+</a>&nbsp;';
			frm += '	<a href="#" onClick="del('+id+');return false;" class="badge badge-danger">&nbsp;-&nbsp;</a>';
			frm += '</div>';
			frm += '</div>';

	
			return frm;
	};


	var add = () => {
		var id = gE('field_id').value;
		var formul = formulario(id);
		$("#fields").append(formul);
		id++;
		gE('field_id').value = id;
	};

	var del = (id) => {
		var child = gE("campo"+id);
		gE("fields").removeChild(child);
	};

	var gE = (id) => {
		return document.getElementById(id);
	};
	</script>
</body>
</html>