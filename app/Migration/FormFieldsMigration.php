<?php 

require_once "Connection.php";

class FormFieldsMigration
{

	private $sql;
	private $mysql;

	public function __construct() {

		$this->mysql = Connection::getInstance();

		$this->sql = "

			CREATE TABLE IF NOT EXISTS forms_items(
				id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			    id_forms INT(20) NOT NULL,
			    tipo VARCHAR(255) NOT NULL,
			    nome VARCHAR(100),
			    label VARCHAR(100),
			    id_html VARCHAR(110),
			    value VARCHAR(255),
			    colunas VARCHAR(100),
			    mascara VARCHAR(100),
			    habilitado VARCHAR(90),
			    evento VARCHAR(50),
			    javascript VARCHAR(150),
			    class VARCHAR(255),
			    maxlength TEXT,
			    obrigatorio VARCHAR(20),
			    FOREIGN KEY (id_forms) REFERENCES forms(id) ON DELETE CASCADE
			);
	
		";
	}

	public function run() {

		$this->mysql->execute($this->sql);

	}
}


$firstMigration = new FormFieldsMigration();
$firstMigration->run();