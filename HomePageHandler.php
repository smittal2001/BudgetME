<?php
$server = 'localhost';

$user = 'root';

$pass = 'usbw';

$db = 'BudgetMe';

$conn = new mysqli($server, $user, $pass, $db);

if($conn->connect_error)
{

die("Connection Failed: " . $conn->connect_error);
}
session_start();
$sql = "SELECT * FROM sections WHERE sections.userid=".$_SESSION['id'];
$result = $conn->query($sql);

header("Location: http://localhost:8080/PHP/BudgetME/LoginPage.php");

?>
