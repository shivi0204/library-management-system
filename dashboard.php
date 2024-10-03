<?php
session_start();
$name = $_SESSION['user_name'];
$id = $_SESSION['id'];
include 'connection.php';

// Check if the user is logged in
if (empty($name)) {
    header("Location: index.php"); 
    exit;
}

// Get total available books
$select_book = mysqli_query($conn, "SELECT COUNT(*) FROM tbl_book WHERE availability = 1");
if (!$select_book) {
    die("Error executing query: " . mysqli_error($conn));
}
$total_book = mysqli_fetch_row($select_book);

// Get the number of books issued by the user
$issued_book_query = mysqli_query($conn, "SELECT COUNT(*) FROM tbl_issue WHERE user_id = '$id' AND status = 1");
if (!$issued_book_query) {
    die("Error executing query: " . mysqli_error($conn));
}
$issued_book = mysqli_fetch_row($issued_book_query);

// Get the membership count for the user
$membership_query = mysqli_query($conn, "SELECT COUNT(*) FROM members WHERE name = '$name' ");
if (!$membership_query) {
    die("Error executing query: " . mysqli_error($conn));
}
$membership = mysqli_fetch_row($membership_query);

include('include/header.php'); ?>

<div id="wrapper">
    <?php include('include/side-bar.php'); ?>

    <div id="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
            </ol>

            <div class="row">
                <div class="col-sm-4">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body total">
                            <div class="widget-summary">
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Books</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $total_book[0]; ?></strong><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-sm-4">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body issued">
                            <div class="widget-summary">
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Books Issued</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $issued_book[0]; ?></strong><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-sm-4">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body issued">
                            <div class="widget-summary">
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Membership</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $membership[0]; ?></strong><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>
