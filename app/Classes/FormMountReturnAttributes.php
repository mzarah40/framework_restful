<?php  

namespace App\Classes;

class FormMountReturnAttributes
{
	private $requested;
	private $formAttributes = [];
	private $vetInput = ['text','number','date','hidden','email','color','file','password'];
	private $formFields;
	private $form;

	public function __construct ()
	{
		if (isset($_REQUEST)) {

			unset($_REQUEST['url']);
			unset($_REQUEST['csrf']);


			$this->requested = $_REQUEST;


		} else {

			$this->requested = false;

		}
	}


	public function form_build ()
	{
		
		if ( $this->requested ) {

			// tag form
			
			list($name, $label) = explode(",", $this->requested['name_label']);

			$this->formAttributes['name']     = $name;
			$this->formAttributes['label']    = $label;
			$this->formAttributes['enctype']  = $this->requested['enctype'];
			$this->formAttributes['onsubmit'] = $this->requested['onsubmit'];
			$this->formAttributes['method']   = $this->requested['method'];
			$this->formAttributes['action']   = $this->requested['action'];
			$this->formAttributes['class']    = $this->requested['class'];
			$this->formAttributes['skin']     = $this->requested['skin'];

			$this->form  = '<div class="card ' . $this->formAttributes['skin'] . '"><div class="card-header">' . $this->formAttributes['label'] . '</div><div class="card-body>';
			$this->form .= '<form name="' . $this->formAttributes['name'] . '" class="' . $this->formAttributes['class'] . '" ';

			if ($this->formAttributes['enctype']) {
				$this->form .= ' enctype="' . $this->formAttributes['enctype'] . '" ';
			}

			if ($this->formAttributes['onsubmit']) {
				$this->form .= ' onSubmit="' . $this->formAttributes['onsubmit'] . '" ';
			}

			if ($this->formAttributes['method']) {
				$this->form .= ' method="' . $this->formAttributes['method'] . '" ';
			}

			if ($this->formAttributes['action']) {
				$this->form .= ' action="' . $this->formAttributes['action'] . '"';
			}

			$this->form .= '>';

			// tag dos campos

			$contador = 0;

			foreach ( $this->requested['tipo'] as $index => $value ) 
			{

				// preenchendo os campos

				$this->formFields['tipo'][$contador]        = $this->requested['tipo'][$contador];
				$this->formFields['nome'][$contador]        = $this->requested['nome'][$contador];
				$this->formFields['label'][$contador]       = $this->requested['label'][$contador];
				$this->formFields['value'][$contador]       = $this->requested['value'][$contador];
				$this->formFields['colunas'][$contador]     = $this->requested['colunas'][$contador];
				$this->formFields['mascara'][$contador]     = $this->requested['mascara'][$contador];
				$this->formFields['habilitado'][$contador]  = $this->requested['habilitado'][$contador];
				$this->formFields['evento'][$contador]      = $this->requested['evento'][$contador];
				$this->formFields['javascript'][$contador]  = $this->requested['javascript'][$contador];
				$this->formFields['class'][$contador]       = $this->requested['class'][$contador];
				$this->formFields['maxlength'][$contador]   = $this->requested['maxlength'][$contador];
				$this->formFields['obrigatorio'][$contador] = $this->requested['obrigatorio'][$contador];
				
				if ( $this->requested['colunas'][$contador] ) {
					$this->form .= '<div class="col-md-' . $this->requested['colunas'][$contador] . ' col-sm-12">';
				}

				// name do campo
				list($name, $label, $id) = explode(",", $this->requested['nome'][$contador]);

				// vetor dos DOM que vai input


				if ( in_array( $this->requested['tipo'][$contador], $this->vetInput) ) 
				{
					$this->form .= $label . ':<br><input type="' 
								. $this->requested['tipo'][$contador] . ' name="' . trim($name) . '" id="' . trim($id) . '" value="' . $this->requested['value'][$contador] . '" ' . $this->requested['evento'][$contador] . '"' . $this->requested['javascript'][$contador] .'" ' . $this->requested['habilitado'][$contador] . ' class="' . $this->requested['class'][$contador]. '" placeholder="'.$label.'" maxlength="' . $this->requested['maxlength'] . '" ' . $this->requested['obrigatorio'][$contador] . '>';
				}
				

				switch ($this->requested['tipo'][$contador])
				{
					case "select":
						$this->form .= $label . ':<br><select name="' . trim($name) . '" id="' . trim($id) . '" ' . $this->requested['evento'][$contador] . '"' . $this->requested['javascript'][$contador] .'" ' . $this->requested['habilitado'][$contador] . ' class="' . $this->requested['class'][$contador]. '" ' . $this->requested['obrigatorio'][$contador] . '><option>Preencha os Options</option></select>';
						break;
					case "textarea":
						$this->form .= $label . ':<br><textarea name="' . trim($name) . '" id="' . trim($id) . '" ' . $this->requested['evento'][$contador] . '"' . $this->requested['javascript'][$contador] .'" ' . $this->requested['habilitado'][$contador] . ' class="' . $this->requested['class'][$contador]. '" ' . $this->requested['obrigatorio'][$contador];
						break;
					case "submit":
						$this->form .= '<button type="submit" id="' . trim($id) . '" ' . $this->requested['evento'][$contador] . '"' . $this->requested['javascript'][$contador] .'" ' . $this->requested['habilitado'][$contador] . ' class="' . $this->requested['class'][$contador]. '">' . $label . '</button>';
						break;
					case "button":
						$this->form .= '<button type="button" id="' . trim($id) . '" ' . $this->requested['evento'][$contador] . '"' . $this->requested['javascript'][$contador] .'" ' . $this->requested['habilitado'][$contador] . ' class="' . $this->requested['class'][$contador]. '">' . $label . '</button>';
						break;
					case "radio":
						$this->form .= '<input type="radio" name="' . trim($name) . $this->requested['evento'][$contador] . '"' . $this->requested['javascript'][$contador] . '" id="' . trim($id) . '" class="' . $this->requested['class'][$contador] . '" value="' . $this->requested['value'][$contador] . '" '.$this->requested['obrigatorio'][$contador].'>&nbsp;<label for="' . trim($id) . '">' . $label . '</label>';
						break;
					case "checkbox":
						$this->form .= '<input type="checkbox" name="' . trim($name) . $this->requested['evento'][$contador] . '"' . $this->requested['javascript'][$contador] . '" id="' . trim($id) . '" class="' . $this->requested['class'][$contador] . '" value="' . $this->requested['value'][$contador] . '" '.$this->requested['obrigatorio'][$contador].'>&nbsp;<label for="' . trim($id) . '">' . $label . '</label>';
						break;

				}


				if ( $this->requested['colunas'][$contador] ) {
					$this->form .= '</div>';
				}

				$contador++;
			}


			$this->form .= '</form>';
		
		}

		
	}

	public function getFormsAttributes () : array 
	{
		return $this->formAttributes;
	}

	public function getFormsFields () : array 
	{
		return $this->formFields;
	}

	public function getForm () : string 
	{
		return $this->form;
	}

}