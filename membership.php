<?php
session_start();
include('connection.php');
$success = false; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $membership_type = $_POST['membership_type'];
    $membership_duration = $_POST['membership_duration'];

    // Validate email uniqueness
    $email_check_query = "SELECT * FROM members WHERE email = '$email'";
    $result = $conn->query($email_check_query);
    if ($result->num_rows > 0) {
        die("A member with this email already exists.");
    }

    // Validate phone uniqueness
    $phone_check_query = "SELECT * FROM members WHERE phone = '$phone'";
    $result = $conn->query($phone_check_query);
    if ($result->num_rows > 0) {
        die("A member with this phone number already exists.");
    }

    // Set expiration date based on membership duration
    $membership_date = date('Y-m-d'); // Current date

    if ($membership_duration == '6_months') {
        $expiration_date = date('Y-m-d', strtotime('+6 months'));
    } elseif ($membership_duration == '1_year') {
        $expiration_date = date('Y-m-d', strtotime('+1 year'));
    } elseif ($membership_duration == '2_years') {
        $expiration_date = date('Y-m-d', strtotime('+2 years'));
    }

    // Insert member into database
    $sql = "INSERT INTO members (name, email, phone, address, membership_type, membership_date, expiration_date) 
            VALUES ('$name', '$email', '$phone', '$address', '$membership_type', '$membership_date', '$expiration_date')";

    if ($conn->query($sql) === TRUE) {
        // Display success message or redirect to success page
        $success = true;
        // header('Location: success.php'); // Uncomment if you have a success page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
  <style>
  form {
            width: 800px;
            margin-left: 150px;
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
<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  
          
  <h4>Library Management System</h4>

         
  <formi class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
   <span >Welcome </span>
  </formi>

  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">
   
   
  
      
        <a class="dropdown-item" href="logout.php" >Logout</a>
     
  </ul>

</nav>
  <div id="wrapper">

    <?php include('include/side-bar.php'); ?>
    
   
<div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i>
            Membership Details</div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>
        <!-- Full Name -->
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required placeholder="Enter your full name"><br>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email address"><br>

        <!-- Phone Number -->
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required placeholder="Enter your phone number"><br>

        <!-- Address -->
        <label for="address">Address:</label>
        <textarea id="address" name="address" required placeholder="Enter your address"></textarea><br>

        <!-- Membership Type -->
        <label for="membership_type">Membership Type:</label>
        <select id="membership_type" name="membership_type" required>
            <option value="Regular">Regular</option>
            <option value="Premium">Premium</option>
        </select><br>

        <!-- Membership Duration (default is 6 months) -->
        <label for="membership_duration">Membership Duration:</label>
        <select id="membership_duration" name="membership_duration" required>
            <option value="6_months" selected>6 Months</option>
            <option value="1_year">1 Year</option>
            <option value="2_years">2 Years</option>
        </select><br>

        <!-- Submit Button -->
        <button type="submit">Add Member</button>
        </div>
    </form>
</div>
    <?php if ($success): ?>
        <script>
            alert("New membership added successfully!");
        </script>
    <?php endif; ?>
</body>
</html>
