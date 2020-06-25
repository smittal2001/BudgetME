<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="HomePage.js"></script>
    <title>Hello, world!</title>
  </head>
  <body>
<button type="button" class="btn btn-warning" name = "Logout"><a href = "LoginPage.php">Log Out</a></button>
    <div class="jumbotron  bg-success">
  <h1 style= "color:rgb(255, 255, 255);" class="display-4">Transactions</h1>

  <p class="lead"> </p>
  <hr class="my-4">
  <ul class="nav justify-content-center">
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link active" href="HomePage.php">Section</a>
  </li>
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link" href="transaction.php">Transactions</a>
  </li>
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a style= "color:rgb(255, 255, 255);" class="nav-link" href="#">Link</a>
  </li>
</ul>
</div>
<?php
session_start();
$server = 'localhost';

$user = 'root';

$pass = 'usbw';

$db = 'BudgetMe';

$conn = new mysqli($server, $user, $pass, $db);

if($conn->connect_error)
{

die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT transactions.section, transactions.amount, transactions.payee FROM transactions WHERE transactions.userid=".$_SESSION['id'];
  $result = $conn->query($sql);
    echo "<div class = 'container'>";
    echo "<table class='table'>";
    echo "<thead>";
      echo  "<tr>";
      echo    "<th scope='col'>#</th>";
        echo "<th scope='col'>Payee</th>";
        echo "<th scope='col'>Section</th>"  ;
        echo  "<th scope='col'>Amount Paid</th>";
        echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      $count = 1;
    while ($row = $result->fetch_assoc())
    {
      $payee = $row["payee"];
      $section = $row["section"];
      $amount = $row["amount"];

          echo "<tr>";
            echo "<th scope='row'>".$count."</th>";
            echo "<td>".$payee."</td>";
            echo "<td>".$section."</td>";
            echo "<td>$".$amount."</td>";
          echo "</tr>";

          $count++;
    }
    echo "</tbody>";
  echo "</table>";
     ?>

<button type="button" class="btn btn-warning" name = "Logout"><a href = "addTransactions.php">Add Transaction</a></button>

</div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="addSection.php" method="post">
              <div class="form-group">
                  <textarea name="tweetMaker" class="form-control"></textarea>
              </div>
              <button class="btn btn-outline-primary float-right" type="submit">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
