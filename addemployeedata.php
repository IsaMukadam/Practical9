<?php
class Employee{ 
	// object properties
    public $id;
    public $employee_name;
    public $employee_salary;
	public $employee_age;
	
    // Make database connection and also check the table name
    private $conn;
	private $table_name = "employee";
	
// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
		function addEmployee(){
			// Checking if employee already exists and then adding the employee to the database if they don't
			if($this->isAlreadyExist()){
						return false;
					}
			// query to insert record
			$query = "INSERT INTO
						" . $this->table_name . "
					SET
						employee_name=:employee_name, employee_salary=:employee_salary, employee_age=:employee_age";
			// prepare query
			$stmt = $this->conn->prepare($query);
		
			// sanitize
			$this->employee_name=htmlspecialchars(strip_tags($this->employee_name));
			$this->employee_salary=htmlspecialchars(strip_tags($this->employee_salary));
			$this->employee_age=htmlspecialchars(strip_tags($this->employee_age));
	
			// bind values
			$stmt->bindParam(":employee_name", $this->employee_name);
			$stmt->bindParam(":employee_salary", $this->employee_salary);
			$stmt->bindParam(":employee_age", $this->employee_age);
			
			// execute query
			if($stmt->execute()){
				$this->id = $this->conn->lastInsertId();
				return true;
			}
		
			return false;
		}
		
// Function to check if employee already exists
function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                employee_name='".$this->employee_name."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
}
}
?>

