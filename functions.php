 <?php include "db.php"; ?>

<?php 

function createRecord(){

global $connection;
if (isset($_POST['submit'])) {

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);

$hashFormat = "$2y$10$";
$salt = "icanissueyouwithabook22";
$hashF_and_salt = $hashFormat . $salt;

$password = crypt($password, $hashF_and_salt);


$query = "INSERT INTO users(username, password)";
$query .= "VALUES ('$username', '$password')";


$result = mysqli_query($connection, $query);

if (!$result) {

  die("Query FAILED". mysqli_error());
} else {

	echo "Record Created";
}

}

}



function readRecords(){
global $connection;

$query = "SELECT * FROM users";



$result = mysqli_query($connection, $query);

if (!$result) {

  die("Query FAILED");
}


while ($row = mysqli_fetch_assoc($result)) {


  print_r($row);

}

}





function showAllData() {

global $connection;

$query = "SELECT * FROM users";



$result = mysqli_query($connection, $query);

if (!$result) {

  die("Query FAILED");
}

while ($row = mysqli_fetch_assoc($result)) {

  $id = $row['id'];

   echo "<option value='$id'>$id</option>";  
  
}
}


function updateTable(){

if (isset($_POST['submit'])) {

global $connection;

$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];


$query = "UPDATE users SET ";
$query .= "username = '$username', ";
$query .= "password = '$password' ";
$query .= "WHERE id = '$id' ";


$results = mysqli_query($connection, $query);

if (!$results) {

  die("Query FAILED". mysqli_error($connection));

}else {

	echo "Record Updated";
}

}
}



function deleteRow(){

if (isset($_POST['submit'])) {

global $connection;

$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];


$query = "DELETE FROM users ";
$query .= "WHERE id = '$id' ";


$results = mysqli_query($connection, $query);

if (!$results) {

  die("Query FAILED". mysqli_error($connection));

} else {

	echo "Record Deleted";
}

}

}


?>
