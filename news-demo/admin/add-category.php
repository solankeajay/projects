<?php include "header.php"; 

if(isset($_POST['save'])) {
    include "config.php";

    $cat = mysqli_real_escape_string($conn, $_POST['cat']);

    $sql = "INSERT INTO `category`(`category_name`) VALUES ('$cat')";

    if (mysqli_multi_query($conn, $sql)) {
        header("Location: $hostname/admin/category.php");
    } else {
        echo "<div class='alert alert-danger'>Query failed.</div>";
    }

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
