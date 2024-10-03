<?php 
session_start();
include ('connection.php');
$name = $_SESSION['user_name'];
$ids = $_SESSION['id'];
$id = $_GET['id'];

// Delete issued book entry
$delete_book = mysqli_query($conn, "DELETE FROM tbl_issue WHERE book_id='$id' AND user_id='$ids'");

// Get the issue date
$select_issue_date = mysqli_query($conn, "SELECT issue_date FROM tbl_issue WHERE book_id='$id' AND user_id='$ids'");
$issue_date_row = mysqli_fetch_row($select_issue_date);
$issue_date = $issue_date_row[0];

// Calculate the return date (15 days after the issue date)
$return_date = date('Y-m-d', strtotime($issue_date . ' + 15 days'));

// Insert into tbl_return
$return_book = mysqli_query($conn, "INSERT INTO tbl_return (book_id, user_id, user_name, return_date) 
    VALUES ('$id', '$ids', '$name', '$return_date')");

// Update book quantity
$select_quantity = mysqli_query($conn, "SELECT quantity FROM tbl_book WHERE id='$id'");
$number = mysqli_fetch_row($select_quantity);
$count = $number[0];
$count = $count + 1;
$update_book = mysqli_query($conn, "UPDATE tbl_book SET quantity='$count' WHERE id='$id'");

// Update issue status
$update_issue_status = mysqli_query($conn, "UPDATE tbl_issue SET status=0 WHERE book_id='$id'");

if ($update_book > 0) {
    ?>
    <script type="text/javascript">
    alert("Book returned successfully.");
    window.location.href="issued-book.php";
    </script>
    <?php
}
?>
