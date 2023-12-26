
<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$result=array('error'=>false);
$result['message']="";


//connect to database

$host_name="localhost";
$host_user="root";
$host_pass="";
$host_db="employees_table";

$connection =mysqli_connect($host_name,$host_user,$host_pass,$host_db);

if(isset($connection)){
   $result["is_db_connected"]=true;
   $result["connection_msg"]="Successfully Connected!";
}
else{
    $result["is_db_connected"]=false;
    $result["connection_msg"]="Not Connected!";
 }


// ********************************************************** CRUD Operations************************************************************************

//Actions
$action="";
if(isset($_GET['action'])){
    $action=$_GET['action'];
}


//Create
if($action=="create"){
// Validate user input
$name = $_POST['name'];
$department = $_POST['department'];
$region = $_POST['region'];
$education = $_POST['education'];
$gender = $_POST['gender'];
$channel = $_POST['channel'];
$no_of_training = $_POST['no_of_training'];
$age = $_POST['age'];
$rate = $_POST['rate'];
$service = $_POST['service'];
$awards = $_POST['awards'];
$average_score = $_POST['average_score'];
$average_montly_hours = $_POST['average_montly_hours'];

// Use prepared statement to insert user input into database
$stmt = $connection->prepare("INSERT INTO employees (name, department, region, education, gender, recruitment_channel, no_of_trainings, age, previous_year_rating, length_of_service, awards_won, avg_training_score, average_montly_hours) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssiiiisii", $name, $department, $region, $education, $gender, $channel, $no_of_training, $age, $rate, $service, $awards, $average_score, $average_montly_hours);
$stmt->execute();

// Check if query was successful
if ($stmt->affected_rows > 0) {
  $result['success'] = true;
  $result['message'] = 'Employee added successfully';

} else {
  $result['success'] = false;
  $result['message'] = 'Failed to add employee';
}
}

// **********************************************************************************************************************************


//ReadAll for specific emploees

if($action=="readAll"){

  if (isset($_GET['id'])) {

    // Get the ID parameter from the POST request
  $id = $_GET['id'];

$sql=mysqli_query($connection,"SELECT * FROM employees WHERE id =$id");
$empArr=array();
while($rows=mysqli_fetch_assoc($sql)){
    array_push($empArr,$rows);
}
$result['allEmployeesData']=$empArr;
}}


//Read

if ($action == "read") {
  $sql = mysqli_query($connection, "SELECT * FROM employees");
  $sql_no_of_rows = mysqli_num_rows($sql);
  if ($sql_no_of_rows < 1) {
    $result['message'] = "No Employees Added";
    $result['error'] = true;
  }

  $empArr = array();
  while ($rows = mysqli_fetch_assoc($sql)) {
    array_push($empArr, $rows);
  }
  $result['employees'] = $empArr;
}

// **********************************************************************************************************************************
  //Update
  if ($action == "update") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $region = $_POST['region'];
        $channel = $_POST['channel'];
        $service = $_POST['service'];
        $average_montly_hours = $_POST['average_montly_hours'];
        $rate = $_POST['rate'];
        $education = $_POST['education'];
        $awards = $_POST['awards'];
        $no_of_training = $_POST['no_of_training'];
        $average_score = $_POST['average_score'];

        $query = "UPDATE employees SET
        name='$name',
        age='$age',
        gender='$gender',
        department='$department',
        education='$education',
        region='$region',
        recruitment_channel='$channel',
        length_of_service='$service',
        average_montly_hours='$average_montly_hours',
        previous_year_rating='$rate',
        awards_won='$awards',
        no_of_trainings='$no_of_training',
        avg_training_score='$average_score'
        WHERE id={$id}";
        echo "SQL query: $query";

      $sql=mysqli_query($connection, $query);

        if (!$sql) {
            $result['error'] = true;
            $result['message'] = "Error updating employee: " . mysqli_error($connection);
        } else {
            if (mysqli_affected_rows($connection) > 0) {
                $result['success'] = true;
                $result['message'] = "Employee updated successfully";
            } else {
                $result['error'] = true;
                $result['message'] = "Employee details are already up to date";
            }
        }

      }


}
  // Update promoted

if ($action == "updatePromoted") {
  $putData = json_decode(file_get_contents('php://input'), true);
  error_log("putData: " . print_r($putData, true));

  if (isset($putData['id']) && isset($putData['is_promoted'])) {

    $id = $putData['id'];
    $isPromoted = $putData['is_promoted'];
    $sql = mysqli_query($connection, "UPDATE employees SET is_promoted ='$isPromoted' WHERE id='$id'");
    if ($sql) {
      $result["message"] = "Promoted status updated successfully";
      $result["error"] = false;
      $result["is_promoted"] = $isPromoted;
    } else {
      $result["message"] = "Error updating promoted status";
      $result["error"] = true;
    }
  } else {
    $result["message"] = "id or is_promoted field is missing from the request";
    $result["error"] = true;
  }
}

// ***************************************************************************************************************************************

//Delete



  if($action=="delete"){

      $id = $_POST['id'];
    // Delete the employee record
    $sql = "DELETE FROM employees WHERE id = $id";

    // Execute the query
    if (mysqli_query($connection, $sql)) {
      // If the query was successful, return a success message
      echo "Employee record deleted successfully";
    } else {
      // If the query failed, return an error message with the reason
      echo "Error deleting employee record: " . mysqli_error($connection);
    }
  }



//DeleteAll

if($action=="deleteAll"){

$sql=mysqli_query($connection,"DELETE FROM employees");
}


// **********************************************************************************************************************************

//Search
if($action=="search"){
  $keyword= $_POST['keyword'];
    $sql=mysqli_query($connection, "SELECT * FROM employees WHERE name like '%$keyword%'");
    $empArr=array();
    while($rows=mysqli_fetch_assoc($sql)){
    array_push($empArr,$rows);
    }

    $result['employees']=$empArr;
  }


// ***************************************************** Visualization *****************************************************************************


//fetching department

if($action=="department"){
  $query = "SELECT department, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY department";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['department']=$empArr;
}

// **********************************************************************************************************************************


//fetching region

if($action=="region"){
  $query = "SELECT region, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY region";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['region']=$empArr;
}

// **********************************************************************************************************************************

//fetching education

if($action=="education"){
  $query = "SELECT education, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY education";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['education']=$empArr;
}

// **********************************************************************************************************************************

//fetching gender

if($action=="gender"){
  $query = "SELECT gender, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY gender";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['gender']=$empArr;
}
 // **********************************************************************************************************************************

//fetching nof of trainings

if($action=="no_of_trainings"){
  $query = "SELECT no_of_trainings, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY no_of_trainings";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['no_of_trainings']=$empArr;
}
// **********************************************************************************************************************************

//fetching age

if($action=="age"){
  $query = "SELECT age, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY age";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['age']=$empArr;
}

// **********************************************************************************************************************************

// fetching rate

if($action=="rate"){
  $query = "SELECT previous_year_rating, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY previous_year_rating";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['rate']=$empArr;
}

// **********************************************************************************************************************************

// fetching service

if($action=="length_of_service"){
  $query = "SELECT length_of_service, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY length_of_service";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['length_of_service']=$empArr;
}

// **********************************************************************************************************************************

// fetching awards

if($action=="awards_won"){
  $query = "SELECT awards_won, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY awards_won";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['awards_won']=$empArr;
}

// **********************************************************************************************************************************

// fetching score

if($action=="avg_training_score"){
  $query = "SELECT avg_training_score, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY avg_training_score";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['avg_training_score']=$empArr;
}

// **********************************************************************************************************************************

// fetching recruitment channel

if($action=="recruitment_channel"){
  $query = "SELECT recruitment_channel, SUM(is_promoted=1) AS promoted, SUM(is_promoted=0) AS not_promoted FROM employees GROUP BY recruitment_channel";
  $sql=mysqli_query($connection, $query);
  $empArr=array();
  while($rows=mysqli_fetch_assoc($sql)){
  array_push($empArr,$rows);
  }

  $result['recruitment_channel']=$empArr;
}

// **********************************************************************************************************************************

//overview summary of promoted employees
if($action=="summary"){
$query= "SELECT COUNT(*) AS total_employees,
       SUM(is_promoted = 1) AS total_promoted,
       SUM(is_promoted = 0) AS total_not_promoted,
       (SUM(is_promoted = 1) / COUNT(*)) * 100 AS promotion_percentage,
       (SUM(is_promoted = 0) / COUNT(*)) * 100 AS non_promotion_percentage
FROM employees";

$sql=mysqli_query($connection, $query);
$empArr=array();
while($rows=mysqli_fetch_assoc($sql)){
array_push($empArr,$rows);
}
$result['summary']=$empArr;
}
// **********************************************************************************************************************************

//fetchin is promoted that equals to 1

if ($action == "promoted") {
  $query = "SELECT name AS name, department AS department FROM employees WHERE is_promoted = 1";
  $sql=mysqli_query($connection, $query);
$empArr=array();
while($rows=mysqli_fetch_assoc($sql)){
array_push($empArr,$rows);
}
$result['promoted']=$empArr;
}

// **********************************************************************************************************************************



echo json_encode($result);
mysqli_close($connection);

?>



