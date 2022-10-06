<?php
include "./includes/header.php";
session_start();





$conn = mysqli_connect("localhost", "root", "", "e-commerce-website-php");
$result = mysqli_query($conn, " SELECT * FROM users where id=" . $_SESSION['id']);
$row = mysqli_fetch_assoc($result);
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$address = $row['address'];
$telephone = $row['telephone'];
$email = $row['email'];
?>
<?php

if (isset($_POST['submit'])) {
  $sql = "INSERT INTO order_details (user_id,total)
  VALUES (" . $_SESSION['id'] . "," . $_SESSION['sum'] + 10 . ")";
  if (mysqli_query($conn, $sql)) {
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  $result = mysqli_query($conn, " SELECT MAX( id ) FROM order_details;");
  $row = mysqli_fetch_assoc($result);

  foreach ($_SESSION['nondublicate'] as $k => $v) {
    $secondSql = "INSERT INTO order_items (order_id,product_id,amount)
      VALUES (" . $row['MAX( id )'] . "," . $k . "," . $v . ")";
    mysqli_query($conn, $secondSql);
    echo "0";
  }
  unset($_SESSION['cart']);
  header('Location:./store.php?order=success');
  echo "success";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./includes/bootstrap-5.2.1-dist/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .row {
      display: -ms-flexbox;
      /* IE10 */
      display: flex;
      -ms-flex-wrap: wrap;
      /* IE10 */
      flex-wrap: wrap;
      margin: 0 -16px;
    }

    .col-back {
      background-color: #f2f2f2;
      border: 1px solid lightgrey;
    }

    .col-25 {
      -ms-flex: 25%;
      /* IE10 */
      flex: 25%;
    }

    .col-50 {
      -ms-flex: 50%;
      /* IE10 */
      flex: 50%;
    }

    .col-75 {
      -ms-flex: 75%;
      /* IE10 */
      flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
      padding: 0 16px;
    }

    .container {

      padding: 5px 20px 15px 20px;

      border-radius: 3px;
    }

    input[type=text] {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    label {
      margin-bottom: 10px;
      display: block;
    }

    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    .btn {
      background-color: #04AA6D;
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }

    .btn:hover {
      background-color: #45a049;
    }

    span.price {
      float: right;
      color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
      .row {
        flex-direction: column-reverse;
      }

      .col-25 {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<div class="container mt-5">
  <div class="row ">
    <div class="col-75 col-back">
      <div class="container">
        <form action="" method="post">

          <div class="row">
            <div class="col-50 ">
              <h3>Billing Address</h3>

              <label for="fname"><i class="fa fa-user"></i> First Name</label>
              <input type="text" id="fname" name="firstname" placeholder="First Name" value="<?php echo $first_name ?>" disabled>


              <label for="lname"><i class="fa fa-user"></i> Last Name</label>
              <input type="text" id="lname" name="lasttname" placeholder="Last Name" value="<?php echo $last_name ?>" disabled>

              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="address" placeholder="Jordan Amman ,Street" value="<?php echo $address ?>" disabled>


              <label for="tele"><i class="fa fa-institution"></i> Telephone</label>
              <input type="text" id="city" name="telephone" placeholder="+9627777" value="<?php echo $telephone ?>" disabled>


              <label for="email"><i class="fa fa-envelope"></i> Email</label>
              <input type="text" id="email" name="email" placeholder="mail@example.com" value="<?php echo $email ?>" disabled>
              <input type="text" id="success" name="success"  value="true" hidden>
              <input type="submit" value="Continue to checkout" name="submit" class="btn">
        </form>
      </div>
    </div>


  </div>
</div>

</div>