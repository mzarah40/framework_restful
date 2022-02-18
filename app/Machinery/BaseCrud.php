<?php  

namespace App\Machinery;

use App\Machinery\MakeClass;

class BaseCrud
{

	private $controller = "";
	private $model      = "";
	private $table      = "";
	private $fields     = "";

	public function __construct(string $table)
	{
		$this->table = $table;
	}

	public function make_sql ( array $fields ) : string 
	{

		$this->fields = $fields;

		$sql  = "CREATE TABLE IF NOT EXISTS " . $this->table . " ( id INT NOT NULL AUTO_INCREMENT, ";
		
		$counter = 0;

		foreach ($this->fields['name'] as $index => $value) {

			$sql .= " " . $value . " " . $this->fields['dbFieldType'][$counter] . "(" . $this->fields['size'][$counter] . ") " . $this->fields['nullable'][$counter] . ",";

			$counter++;

		}

		$sql = substr($sql, 0, -1);

		$sql .= ", PRIMARY KEY(id) );";
	
		return $sql;
	}

	public function down () 
	{
		$sql  = " TRUNCATE " . $this->table .";";
		$sql .= " DROP TABLE " . $this->table . "; ";
	}


	public function make_controller () 
	{
		$this->controller = '

			<?php  

			namespace App\Controller;

			use App\Security\Csrf;
			use App\Model\\' . ucfirst($this->table) . 'Model;
			use App\Helper\View;
			use App\Helper\SessionInitHelper;
			use Sys\Request\Request;

			class ' . ucfirst($this->table) . 'Controller  
			{
				private $model;

				';

				foreach ( $this->fields['name'] as $idx => $val ) {
			
					$this->controller .= ' private ' . $val . '; ';

				}
				'
				public function __construct()
				{
					SessionInitHelper::run();
					$this->model = new ' . $ucfirst($this->name) . 'Model();
				}

				public function index (string $msg="") 
				{
					return $this->model->all();
				}

				public function show (int $id)
				{
					$resultSet = $this->model->findById($id);
				}

				public function add () 
				{

				}

				public function insert ()
				{
					// cross site request forged
					if (!Csrf::run($_REQUEST["csrf"])) {
						throw new \Exception("Error. Token missed");
					}
		
					// recebendo a requisição e encriptando a senha
					$request = Request::run();
					
					if (isset($request["pass"]) {
						$request["pass"] = sha1($request["pass"])
					}

					// inserindo no banco de dados
					$this->model->insert($request);

					// retornando para index
					$this->index("Inserido com Sucesso");
				}

				public function update (array $values, int $id)
				{
					return $this->model->update($values, $id);
				}';

				foreach ( $this->fields['name'] as $idx => $val ) {
					$this->controller .= '
					public function get'.ucfirst($val).' () 
					{

						return $this->' . $val . ';
					}

					public function set'.ucfirst($val).' ($valor) 
					{
						$this->' . $val . ' = $valor;
					}

					';
				}
				

		$this->controller .= '
			}
		';

	}

	public function make_model ()
	{
		$this->model = '
			<?php 

			namespace App\Model;

			use App\Orm\FlashQuery;

			class ' . ucfirst($this->table) . 'Model
			{
				use \App\Machinery\TraitMachinery;

				private $flashQuery = null;
				private $table      = "' . $this->table . '";

				public function __construct () 
				{
					$this->flashQuery = new FlashQuery();
				}

				public function all () 
				{
					return $this->flashQuery->select([\'*\'])
											->from([$this->table])
											->get();
				}

				public function findById (int $id) 
				{
					if ( TraitMachinery::isNatural($id) ) {
						return $this->flashQuery->select(["*"])
												->from([$this->table])
												->where("id = \'" . $id . "\'")
												->get() 
					} else {
						return false;
					}
				}

				public function insert (array $values) 
				{
					return $this->flashQuery->insert($this->table, $values);
				}

				public function update (array $values, int $id)
				{
					if ( TraitMachinery::isNatural($id) ) {
						return $this->flashQuery->update($this->table, $values, $id);
					} else {
						return false;
					}
				}
			}';
	}

	public function makeRender (bool $attachment=false)  
	{
		$baseName   = ucfirst($this->table);
		$makeClass  = new MakeClass;
		MakeClass::make($baseName, $this->controller, "controller");
		MakeClass::make($baseName, $this->model, "model");

		$makeClass->compact($attachment);
	}

}