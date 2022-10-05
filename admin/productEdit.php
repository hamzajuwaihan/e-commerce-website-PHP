<?php

include "includes\connect.php";
session_start();
if (isset($_SESSION['Role'])) {
  if ($_SESSION['Role'] !== 'Admin') {
    header('Location:./403.php');
  }
} else {
  if ($_SESSION['Role'] !== 'Admin') {
    header('Location:./403.php');
  }
}
$id = $_POST['productID'];

$pname = $_POST['productName'];
$desc = $_POST['description'];
$sku = $_POST['sku'];
$catgory = $_POST['category'];
$price = $_POST['price'];
$discountId = null;
$author = $_POST['author'];
$modAt = date('Y-m-d h:m:s');

if (mysqli_connect_error()) {
    die('Connection Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
} else {
    $sel = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
    $sl = mysqli_fetch_assoc($sel);
    $created = $sl['created_at'];
    echo $created;

    $update = "UPDATE products SET name = ?, description = ?, SKU = ?, price = ?, discount_id = ?, created_at = ?, modified_at = ?, author = ?, image = ?, category_id = ? WHERE id = '$id'";

    $statement = $conn->prepare($update);

    // File name
    $filename = $_FILES['image']['name'];

    // Location
    $target_file = 'images/' . $filename;

    // file extension
    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);

    $file_extension = strtolower($file_extension);

    // Valid image extension
    $valid_extension = array("png", "jpeg", "jpg");

    if (in_array($file_extension, $valid_extension)) {
        // Upload file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Execute query
            $statement->bind_param("ssiiissssi", $pname, $desc, $sku, $price, $discountId, $created, $modAt, $author, $filename, $catgory);
            // 'ssiiissssi', 'Legends & Latte', 'This program is...', '692', '20', NULL, '2022-10-01 22:0...', '2022-10-03 03:1...', 'Travis Baldree', '1664651307-1.jp...', '4')

            // such a weird error. everything is correct according to me 
            $statement->execute();
?>
            <script>
                alert("Product Updated Successfully");
                window.location.href = "addproducts.php";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Failed to update product, please try again!");
                window.location.href = "addproducts.php";
            </script>
<?php
        }
    }
}
?>