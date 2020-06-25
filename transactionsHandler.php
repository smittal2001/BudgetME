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

$payee = $_POST["payee"];
$section = $_POST["section"];
$amount = $_POST["amount"];
$balance = $amount;
//join databases to make balance work, cant get amount using current sql variable
$sql2 = "SELECT sections.type, sections.userid, transactions.section, transactions.amount FROM transactions INNER JOIN sections ON sections.userid=transactions.userid";
//$sql = "SELECT * FROM sections WHERE sections.userid=".$_SESSION['id'];
$result = $conn->query($sql2);
while ($row = $result->fetch_assoc())
{

  if($row["userid"] === $userid  && $row["section"] === $section)
  {
  //$lim = $row["lim"];
  //$amt = $row["amount"];
  //echo $amt;
  //$balance = $balance + $amt;
  }
}

$sql = "INSERT INTO transactions (payee, userid,  amount, section) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siis",$payee,$userid,$amount,$section);
$stmt->execute();
header("Location: http://localhost:8080/PHP/BudgetME/transactions.php");
?>
