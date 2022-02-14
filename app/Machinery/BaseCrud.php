<?php  

namespace App\Machinery;

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

	public function up (array $fields ) 
	{

		$this->fields = $fields;

		$sql  = "CREATE TABLE IF NOT EXISTS " . $this->table . " ( id INT NOT NULL AUTO_INCREMENT, ";
		
		$count = 0;

		foreach ($this->fields['name'] as $index => $value) {

			$sql .= " " . $value . " " . $this->fields['type'][$count] . "(" . $this->fields['size'][$count] . ") " . $this->fields['nullable'][$count] . ",";

			$count++;

		}

		$sql = substr($sql, 0, -1);

		$sql .= ", PRIMARY KEY(id) );";
	
	}

	public function down () 
	{
		$sql  = " TRUNCATE " . $this->table "; ";
		$sql .= " DROP TABLE " . $this->table . "; ";
	}


	public function make_view (int $idForm) 
	{

	}

	public function make_controller () 
	{
		$this->controller = '

			<?php  

			namespace App\Controller;

			use App\Security\Csrf;
			use App\Model\\' . ucfirst($this->name) . 'Model;
			use App\Helper\View;
			use App\Helper\SessionInitHelper;
			use Sys\Request\Request;

			class ' . ucfirst($this->name) . 'Controller  
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

				public function update (int $id)
				{

				}';

				foreach ( $this->fields['name'] as $idx => $val ) {
					'
					public function get'.ucfirst($val).' () 
					{

						return $this->'$val';
					}

					public function set'.ucfirst($val).' ($valor) 
					{
						$this->'$val' = $valor;
					}

				'
				}
				'

			}';



	}

}