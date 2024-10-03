<?php
session_start();
include('../connection.php');
$id = $_SESSION['id'];
$name = $_SESSION['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];
    $actual_return_date = $_POST['actual_return_date'];
    $fine_calculated = $_POST['fine_calculated'];
    $fine_paid = isset($_POST['fine_paid']) ? 1 : 0;
    $remarks = $_POST['remarks'];

    // Insert transaction into database
    $sql = "INSERT INTO transactions (book_name, author, issue_date, return_date, actual_return_date, fine_calculated, fine_paid, remarks)
            VALUES ('$book_name', '$author', '$issue_date', '$return_date', '$actual_return_date', '$fine_calculated', '$fine_paid', '$remarks')";

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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Library Management System</title>
    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/custom_style.css?ver=1.1" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <style>
        form {
          width: 800px;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 150px;
            margin-right: 170px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  
          
  <h4>Library Management System</h4>

          
  <formi class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
     <span >Welcome, <?php echo $name; ?></span>
    </formi>

  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">
   
   
  
      
        <a class="dropdown-item" href="logout.php" >Logout</a>
     
  </ul>

</nav>

<div id="wrapper">
    <?php include('include/side-bar.php'); ?>

    <div class="form-container">
        <div class="card-header">
            <i class="fa fa-info-circle"></i> Transaction Details
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <label for="book_name">Enter Book Name:</label>
            <input type="text" id="book_name" name="book_name" required>

            <label for="author">Enter Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="issue_date">Issue Date:</label>
            <input type="date" id="issue_date" name="issue_date" required>

            <label for="return_date">Return Date:</label>
            <input type="date" id="return_date" name="return_date" required>

            <label for="actual_return_date">Actual Return Date:</label>
            <input type="date" id="actual_return_date" name="actual_return_date">

            <label for="fine_calculated">Fine Calculated:</label>
            <input type="number" id="fine_calculated" name="fine_calculated" value="0" readonly>

            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"></textarea>

            <div class="buttons">
                <button type="submit">Confirm</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById("actual_return_date").addEventListener("change", calculateFine);

    function calculateFine() {
        const returnDate = new Date(document.getElementById("return_date").value);
        const actualReturnDate = new Date(document.getElementById("actual_return_date").value);
        const finePerDay = 10; 

        if (actualReturnDate && returnDate) {
            const timeDifference = actualReturnDate.getTime() - returnDate.getTime();
            const daysLate = Math.ceil(timeDifference / (1000 * 3600 * 24));
            const fine = daysLate > 0 ? daysLate * finePerDay : 0;
            document.getElementById("fine_calculated").value = fine;
        }
    }
</script>

</body>
</html>
