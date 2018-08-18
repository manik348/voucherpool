<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="This is a simple voucher management tool with web service integration for validating vouchers.">
    <title>VoucherPool - Voucher Management Tool | <?php echo $title; ?></title>
    <!-- Bootstrap core CSS-->
    <link href="<?php echo Uri::create('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?php echo Uri::create('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="<?php echo Uri::create('assets/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo Uri::create('assets/css/sb-admin.css'); ?>" rel="stylesheet">
    <!-- Favicon image -->
    <link rel="icon" type="image/png" href="<?php echo Uri::create('assets/favicon.png'); ?>"/>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo Uri::create('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo Uri::create('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo Uri::create('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo Uri::create('assets/vendor/chart.js/Chart.min.js'); ?>"></script>
    <script src="<?php echo Uri::create('assets/vendor/datatables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo Uri::create('assets/vendor/datatables/dataTables.bootstrap4.js'); ?>"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<div id="loader">
    <div>
        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br>
        <p>Loading...</p>
    </div>
</div>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo Uri::create(""); ?>"><img class="img-logo"
                                                                       src="<?php echo Uri::create('assets/favicon.png'); ?>">
        VoucherPool</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item <?php if (\Uri::segment(1) == '') echo "active" ?>" data-toggle="tooltip"
                data-placement="right" title="Dashboard">
                <a class="nav-link" href="<?php echo Uri::create(""); ?>">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item <?php if (\Uri::segment(1) == 'recipients') echo "active" ?>" data-toggle="tooltip"
                data-placement="right" title="Recipients">
                <a class="nav-link" href="<?php echo Uri::create("recipients"); ?>">
                    <i class="fa fa-fw fa-users"></i>
                    <span class="nav-link-text">Recipients</span>
                </a>
            </li>
            <li class="nav-item <?php if (\Uri::segment(1) == 'offers') echo "active" ?>" data-toggle="tooltip"
                data-placement="right" title="Offers">
                <a class="nav-link" href="<?php echo Uri::create("offers"); ?>">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="nav-link-text">Offers</span>
                </a>
            </li>
            <li class="nav-item <?php if (\Uri::segment(1) == 'vouchers') echo "active" ?>" data-toggle="tooltip"
                data-placement="right" title="Vouchers">
                <a class="nav-link" href="<?php echo Uri::create("vouchers"); ?>">
                    <i class="fa fa-fw fa-ticket"></i>
                    <span class="nav-link-text">Vouchers</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">

    <div class="container-fluid">

        <?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success">
                <strong><i class="fa fa-check"></i> Success</strong>
                <p class="m-0 p-0">
                    <?php echo \Session::get_flash('success'); ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if (Session::get_flash('error')): ?>
            <div class="alert alert-danger">
                <strong><i class="fa fa-warning"></i> Error</strong>
                <p class="m-0 p-0">
                    <?php echo implode('</p><p>', e((array)Session::get_flash('error'))); ?>
                </p>
            </div>
        <?php endif; ?>

        <?php echo $content; ?>
    </div>

    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center text-muted">
                <small><b>VoucherPool</b></small>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- Common Modals -->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center"><i class="fa fa-question-circle fa-4x"></i><br>
                        Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="yes">Yes</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom scripts for this page-->
    <script src="<?php echo Uri::create('assets/js/sb-admin-datatables.js'); ?>"></script>
    <script src="<?php echo Uri::create('assets/js/sb-admin-charts.js'); ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo Uri::create('assets/js/sb-admin.js'); ?>"></script>

</div>
</body>

</html>