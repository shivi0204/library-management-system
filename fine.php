<?php
session_start();
include('connection.php');    // Your database name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $serial_no = $_POST['serial_no'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];
    $actual_return_date = $_POST['actual_return_date'];
    $fine_calculated = $_POST['fine_calculated'];
    $fine_paid = isset($_POST['fine_paid']) ? 1 : 0;
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO transactions (book_name, author, serial_no, issue_date, return_date, actual_return_date, fine_calculated, fine_paid, remarks)
            VALUES ('$book_name', '$author', '$serial_no', '$issue_date', '$return_date', '$actual_return_date', '$fine_calculated', '$fine_paid', '$remarks')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Library Management System</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/custom_style.css?ver=1.1" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">
</head>
<body >

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  
          
  <h4>Library Management System</h4>

         
  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-2 my-2 my-md-0">
   <span >Welcome</span>
  </form>

  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-1">
      <a class="dropdown-item" href="logout.php" >Logout</a>
     
  </ul>

</nav>
<!-- Sidebar -->
 <navi >
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
      <li class="nav-item ">
        <a class="nav-link " href="book.php" style="color: white;">
          <i class="fa fa-book"></i>
          <span>Books Details</span>
        </a>
        
      </li>
       <li class="nav-item ">
        <a class="nav-link " href="issued-book.php" style="color: white;">
          <i class="fa fa-book"></i>
          <span>Issued Books </span>
        </a>
        
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="membership.php" style="color: white;">
          <i class="fa fa-book"></i>
          <span>Membership </span>
        </a>
        
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="fine.php" style="color: white;">
          <i class="fa fa-book"></i>
          <span>Fine </span>
        </a>
        
      </li>
    
    </ul>
   
    <div class="form-container">
        <h2>Transactions</h2>
        <form action="submit.php" method="POST">
            <label for="book_name">Enter Book Name:</label>
            <input type="text" id="book_name" name="book_name" required>
            
            <label for="author">Enter Author:</label>
            <input type="text" id="author" name="author" required>
            
            <label for="serial_no">Serial No:</label>
            <input type="text" id="serial_no" name="serial_no" required>
            
            <label for="issue_date">Issue Date:</label>
            <input type="date" id="issue_date" name="issue_date" required>
            
            <label for="return_date">Return Date:</label>
            <input type="date" id="return_date" name="return_date" required>
            
            <label for="actual_return_date">Actual Return Date:</label>
            <input type="date" id="actual_return_date" name="actual_return_date">
            
            <label for="fine_calculated">Fine Calculated:</label>
            <input type="number" id="fine_calculated" name="fine_calculated" value="0" readonly>
            
            <label for="fine_paid">Fine Paid:</label>
            <input type="checkbox" id="fine_paid" name="fine_paid">
            
            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"></textarea>
            
            <div class="buttons">
                <button type="submit">Confirm</button>
            </div>
        </form>
        
    </div>
 </navi>
</body>
</html>
