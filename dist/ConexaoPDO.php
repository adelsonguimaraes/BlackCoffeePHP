<?php

class Conexao{	
	private $con;
	private $server = '';
    private $port = '';
    private $db = '';
    private $user = '';
    private $pass = '';

	protected function __construct(){

		try{
            $this->con = new PDO('mysql:host='.$this->server.';port='.$this->port.';dbname='.$this->db, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die( $e->getMessage() );
        }
		
	}
	
	public static function getInstance(){
		static $instance = null;
		if (null === $instance){
			$instance = new static();			
		}
		return $instance;
	}
	
	public function getConexao(){
		$this->con->query("SET NAMES 'utf8'");
        $this->con->query('SET character_set_connection=utf8');
        $this->con->query('SET character_set_client=utf8');
        // $this->con->query(('SET character_set_result=utf8');
		return $this->con;
	}

}

$con = Conexao::getInstance()->getConexao();

$stmt = $con->prepare("SELECT * FROM cidade WHERE idestado = :idestado");
$stmt->bindValue(':idestado', 3); // amazonas
$stmt->execute();
while($row = $stmt->fetch()){//PDO::FETCH_OBJ
	echo $row['nome'] . '<br>';
}

?>