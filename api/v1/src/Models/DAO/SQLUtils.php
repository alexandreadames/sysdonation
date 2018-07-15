<?php 

namespace App\Models\DAO;

class SQLUtils {

	//Dev Enviroment
		const HOSTNAME = "127.0.0.1";
		const USERNAME = "root";
		const PASSWORD = "";
		const DBNAME = "db_sysdonation";
	
	//Production in SiteGround
		//const HOSTNAME = "localhost";
		/*const HOSTNAME = "146.66.103.172";
		const USERNAME = "alex5278_sysdon";
		const PASSWORD = "*RSNVH-l@TzF";
		const DBNAME = "alex5278_sysdonation";*/

	private $conn;

	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".SQLUtils::DBNAME.";host=".SQLUtils::HOSTNAME, 
			SQLUtils::USERNAME,
			SQLUtils::PASSWORD
		);

	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		//if return is 0 there is a problem...
		return $stmt->rowCount();

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>