<?php
session_start();
include ('../connection.php');
$name = $_SESSION['name'];
$id = $_SESSION['id'];
if(empty($id))
{
    header("Location: index.php"); 
}
if(isset($_REQUEST['sbt-book-btn']))
{
   
	$book_name = $_POST['book_name'];
    $category_name = $_POST['category_name'];
    $author_name = $_POST['author_name'];
    $quantity = $_POST['quantity'];
    $availability = $_POST['availability'];

    $insert_book = mysqli_query($conn,"insert into tbl_book set book_name='$book_name', category='$category_name', author='$author_name',quantity='$quantity', availability='$availability'");

    if($insert_book > 0)
    {
        ?>
<script type="text/javascript">
    alert("Book added successfully.")
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
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Add Book</a>
          </li>
          
        </ol>

  <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i>
            Submit Book Details</div>
             
            <form method="post" class="form-valide">
          <div class="card-body">
                                        <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="item">Book Name <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <input type="text" name="book_name" id="book_name" class="form-control" placeholder="Enter Book Name" required>
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
                                         while($row = mysqli_fetch_array($fetch_category)){
                                        ?>
                                        <option><?php echo $row['category_name']; ?></option>
                                    <?php } ?>
                                     </select>
                                </div>
                                  </div>    
                                       
                                                                            
                                   <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="price">Author <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <input type="text" name="author_name" id="author_name" class="form-control" placeholder="Enter Author Name" required>
                                       </div>
                                  </div> 
                                 
                                
                                  <div class="form-group row">
                                      <label class="col-lg-4 col-form-label" for="price">Quantity <span class="text-danger">*</span></label>
                                       <div class="col-lg-6">
                                      <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter Quantity" required>
                                       </div>
                                  </div>                                         
                           <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="status">Availability <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="availability" name="availability" required>
                                                    <option value="">Select Status</option>
                                                    <option  value="1">Available</option>
                                                    <option  value="0">Not Available</option>
                                                          
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" name="sbt-book-btn" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    
                                </div>
                                </form>
                            </div>
                        
    </div>
         
        </div>
     
 
 
 <?php include('include/footer.php'); ?>
