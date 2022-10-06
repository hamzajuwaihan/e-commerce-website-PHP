<?php
include('includes/header.php');
include("./includes/connect.php");
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
?>

<div id="wrapper">
    <?php include('./includes/sidebar.php'); ?>

    <!-- begain of content  -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include('./includes/navbar-top.php'); ?>


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>

                <!-- Content Row -->
                <h2 class="text-center mt-5"> Categories </h2>
                <div class="container-fluid">
                    <table class="table table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Order profit</th>
                                
                            </tr>
                        <tbody>
                            <?php
                            $sqltable = "SELECT * FROM order_details";
                            if ($result = mysqli_query($conn, $sqltable)) {
                                if (mysqli_num_rows($result) > 0) {

                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['id'];
                                        $total = $row['total'];

                                        echo "<tr>
                            <td> $id  </td>
                            <td>$$total </td>";
                                        //echo ' <td> <a href="read.php?id=' . $row['id'] . '" ><span class="fa fa-eye"></span></a> </td>';
                                       

                                        echo "</tr>";
                                    }

                                    mysqli_free_result($result);
                                } else {
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                            ?>
                        </tbody>
                        </thead>

                    </table>

                </div>

            </div>
        </div>



    </div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2022</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>


</div>




<?php include('./includes/footer.php'); ?>