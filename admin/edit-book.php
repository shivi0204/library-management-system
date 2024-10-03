<?php
session_start();
include ('../connection.php');
$id = $_SESSION['id'];
$name = $_SESSION['name'];
if(empty($id))
{
    header("Location: index.php"); 
}
$id = $_GET['id'];
$fetch_query = mysqli_query($conn, "select * from tbl_book where id='$id'");
$row = mysqli_fetch_array($fetch_query);
if(isset($_REQUEST['save-book-btn']))
{
   
	$book_name = $_POST['book_name'];
    $category_name = $_POST['category_name'];
   
    $author_name = $_POST['author_name'];
    
    $quantity = $_POST['quantity'];
   
    $availability = $_POST['availability'];
            
    $update_book = mysqli_query($conn,"update tbl_book set book_name='$book_name', category='$category_name',  author='$author_name',  quantity='$quantity',   availability='$availability' where id='$id'");

    if($update_book > 0)
    {
?>
<script type="text/javascript">
    alert("Book updated successfully.");
    window.location.href='view-book.php';
</script>
<?php
}
}
?>
<?php include('include/header.php'); ?>
<div id="wrapper">
<?php include('include/side-bar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Edit Book</a>
          </li>
          
        </ol>

  <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i>
            Edit Details</div>
             
            <form method="post" class="form-valide">
          <div class="card-body">
  <div class="form-group row">
          <label class="col-lg-4 col-form-label" for="item">Book Name <span class="text-danger">*</span></label>
           <div class="col-lg-6">
          <input type="text" name="book_name" id="book_name" class="form-control" placeholder="Enter Book Name" required value="<?php echo $row['book_name']; ?>">
           </div>
      </div>         
          <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="leave-type">Category <span class="text-danger">*</span>
                </label>
    <div class="col-lg-6">
        <select class="form-control" id="category_name" name="category_name" required>
            <option value="">Select Category</option>
            <?php 
             $fetch_category = mysqli_query($conn, "select * from tbl_category where status=1");
             while($rows = mysqli_fetch_array($fetch_category)){
            ?>
 <option <?php if($rows['category_name']==$row['category']){ ?>
    selected="selected"; <?php } ?>><?php echo $rows['category_name'];?>
</option>
        <?php } ?>
         </select>
    </div>
      </div>    
          
          
      <div class="form-group row">
          <label class="col-lg-4 col-form-label" for="price">Author <span class="text-danger">*</span></label>
           <div class="col-lg-6">
          <input type="text" name="author_name" id="author_name" class="form-control" placeholder="Enter Author Name" required value="<?php echo $row['author'];?>">
           </div>
      </div> 
    
      <div class="form-group row">
          <label class="col-lg-4 col-form-label" for="price">Quantity <span class="text-danger">*</span></label>
           <div class="col-lg-6">
          <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter Number of Copy" required value="<?php echo $row['quantity'];?>">
           </div>
      </div>
     
      <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="status">availability <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <select class="form-control" id="availability" name="availability" required>
                        <option value="">Select Status</option>
                       <option value="1" <?php if($row['availability'] == 1) { ?> selected="selected"; <?php } ?>>Available</option>
                       <option value="0" <?php if($row['availability'] == 0) { ?> selected="selected"; <?php } ?>>Not Available</option>
                              
                    </select>
                </div>
            </div>     
                                
            <div class="form-group row">
                <div class="col-lg-8 ml-auto">
                    <button type="submit" name="save-book-btn" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>            
    </div>
</div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 <?php include('include/footer.php'); ?>
