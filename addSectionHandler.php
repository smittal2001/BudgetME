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
$userid = $_SESSION["id"];

$type = $_POST["type"];
$lim = $_POST["lim"];
$sql = "INSERT INTO sections (userid, type, lim) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi",$userid,$type,$lim);
$stmt->execute();
header("Location: http://localhost:8080/PHP/BudgetME/HomePage.php");
?>
