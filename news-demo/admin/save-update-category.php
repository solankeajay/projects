<?php 

    if(isset($_POST['sumbit'])) {
        include "config.php";

        $sql = "UPDATE `category` SET `category_name`='{$_POST['cat_name']}' WHERE category_id = {$_POST['cat_id']}";

        $result = mysqli_query($conn, $sql) or die("Query Failed. " . mysqli_error($conn));

        if ($result) {
            header("location: $hostname/admin/category.php");
        } else {
            echo "Query Failed";
        }
    }

?>