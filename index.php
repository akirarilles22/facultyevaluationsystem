<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php 
    if(!isset($_SESSION['login_id']))
        header('location:login.php');
    include 'db_connect.php';
    ob_start();
    if(!isset($_SESSION['system'])){
        $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
        foreach($system as $k => $v){
            $_SESSION['system'][$k] = $v;
        }
    }
    ob_end_flush();
    include 'header.php' 
?>
<head>
    <!-- ... Other meta tags and scripts ... -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css">
    <style>
        /* Custom styles for the light theme */
        body {
            background-color: #f2f2f2; /* Light gray background */
            color: #333; /* Dark gray text color */
        }

        .login-card-body {
            background-color: #fff; /* White background for the login card */
            border-radius: 5px; /* Rounded corners for the login card */
        }

        .btn-primary {
            background-color: #007bff; /* Light blue color for primary buttons */
            border-color: #007bff; /* Border color for primary buttons */
            color: #fff; /* White text color for primary buttons */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue color on hover for primary buttons */
            border-color: #0056b3; /* Border color on hover for primary buttons */
        }

        .content-header {
            background-color: #f8f9fa; /* Light gray background for content header */
            padding: 10px; /* Add some padding to the content header */
        }

        /* Add more custom styles for other elements as needed */

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include 'topbar.php' ?>
        <?php include $_SESSION['login_view_folder'].'sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body text-white">
                </div>
            </div>
            <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?php echo $title ?></h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                    <hr class="border-primary">
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php 
                        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                        if(!file_exists($_SESSION['login_view_folder'].$page.".php")){
                            include '404.html';
                        }else{
                            include $_SESSION['login_view_folder'].$page.'.php';
                        }
                    ?>
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
            <!-- Add modals and other elements here as needed -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline-block">
                <b><?php echo $_SESSION['system']['name'] ?></b>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <!-- Bootstrap -->
    <?php include 'footer.php' ?>
</body>
</html>
