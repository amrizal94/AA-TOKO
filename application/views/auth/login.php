<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?= $title; ?></title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/AdminLTE.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/iCheck/square/blue.css">

  

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/main.css">

  <link rel="shortcut icon" href="<?= base_url('assets/favicon.ico'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->



  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition  bg-gradient-primary">

<div class="login-box" style="margin-top: 0px; padding-top: 120px">

  



  <!-- /.login-logo -->

  <div class="login-box-body">

    <div class="row text-center mb-3">

      <h1 class="mb-0 mt-0"><b><?= $setting['shop_name'] ?></b></h1>

      <small>Alamat: <?= $setting['address'] ?></small> <br>

      <small>Telp: <?= $setting['telp'] ?></small>

    </div>



    <p class="login-box-msg mb-0 pb-1">Silahkan login terlebih dahulu.</p>

    <?= $this->session->flashdata('message'); ?>

    



    <form action="<?= base_url('auth'); ?>" method="post">

      <div class="form-group has-feedback">

        <input type="username" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>">

        <span class="glyphicon glyphicon-user form-control-feedback"></span>

        <?= form_error('username', '<small style="color:red"">', '</small>') ?>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" name="password" placeholder="Password">

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        <?= form_error('password', '<small style="color:red"">', '</small>') ?>

      </div>

      <div class="row">

        <div class="col-xs-12">

          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-shopping-cart"></i> &nbsp;L O G I N</button>

        </div>

      </div>

    </form>

  </div>

  <!-- /.login-box-body -->

</div>

<!-- /.login-box -->



<!-- jQuery 3 -->

<script src="<?= base_url('assets'); ?>/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->

<script src="<?= base_url('assets'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- iCheck -->

<script src="<?= base_url('assets'); ?>/plugins/iCheck/icheck.min.js"></script>

<script>

  $(function () {

    $('input').iCheck({

      checkboxClass: 'icheckbox_square-blue',

      radioClass: 'iradio_square-blue',

      increaseArea: '20%' /* optional */

    });

  });

</script>

</body>

</html>

