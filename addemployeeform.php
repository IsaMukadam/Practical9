<!-- 
I have made some changes
ha ha ha
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Employee Entry</title>
</head>
<body>
<h1>Admin Employee Entry</h1>

<?php
if(isset($_POST["employee_name"])){
	// get database connection
	include_once '../config/database.php';
	 
	// instantiate  object
	include_once '../User/addemployeedata.php';

	$database = new Database();
	$db = $database->getConnection();
	 
	$employee = new Employee($db);

	// set employee property values
	$employee->employee_name = $_POST['employee_name'];
	$employee->employee_salary = $_POST['employee_salary'];
	$employee->employee_age = $_POST['employee_age'];

	// create the user
	if($employee->addEmployee()){
		/*
		$user_arr=array(
			"status" => true,
			"message" => "Successfully Signup!",
			"id" => $employee->id,
			"employee_name" => $employee->employee_name
		);
		*/
		echo "New Employee named" +  + "Added!";
	}
	else{
		/*
		$user_arr=array(
			"status" => false,
			"message" => "Employee already exists!"
		);
		*/
		echo "Employee already Exists!";
	}
	
	// print_r(json_encode($user_arr));
	
	echo "<br><br><a href='addemployeeform.php'>Submit Another Employee</a>";
}else{
?>


<!--Get the data from the user, data should be hidden from the URL using POST method. -->
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
   Enter Employee Name:<br/>
   <input type="text" name="employee_name" /><br>
   <br/>
   Enter Employee Salary:<br/>
   <input type="text" name="employee_salary" /><br>
   <br/>
   Enter Employee Age:<br/>
   <input type="text" name="employee_age" /><br>
   <br/>
   <input type="submit" value="Register" />
 </form>
 </body>
 <?php
}
?>