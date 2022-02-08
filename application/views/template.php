<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?= $title ?></title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- datepicker -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- select -->



  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/skins/_all-skins.min.css">

  <!-- Select2 -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/select2/dist/css/select2.min.css">



  <!--  -->

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  

  <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/main.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

  <link rel="shortcut icon" href="<?= base_url('assets/favicon.ico'); ?>">

  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition skin-blue sidebar-mini <?php if($menu == 'item' || $menu == 'sale'){echo"sidebar-collapse";} ?>">

<!-- Site wrapper -->

<div class="wrapper">



  <header class="main-header">

    <!-- Logo -->

    <a href="<?= base_url('dashboard'); ?>/" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini">MEONG</span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b>Toko</b>Meong</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

        <span class="sr-only">Toggle navigation</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

      </a>



      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          

          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <img src="<?= base_url('assets'); ?>/image/users/<?= $this->fungsi->user_login()['image'] ?>" class="user-image" alt="User Image">

              <span class="hidden-xs"><?= $this->fungsi->user_login()['username'] ?></span>

            </a>

            <ul class="dropdown-menu">

              <!-- User image -->

              <li class="user-header">

                <img src="<?= base_url('assets'); ?>/image/users/<?= $this->fungsi->user_login()['image'] ?>" class="img-circle" alt="User Image">

                <p>

                  <?= $this->fungsi->user_login()['name'] ?>

                  <small><?= $this->fungsi->user_login()['address'] ?></small>

                </p>

              </li>

              <!-- Menu Footer-->

              <li class="user-footer">

                <div class="">

                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-logout">

                    Log out

                  </button>

                </div>

              </li>

            </ul>

          </li>

         

        </ul>

      </div>

    </nav>

  </header>



  <!-- =============================================== -->



  <!-- Left side column. contains the sidebar -->

  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="<?= base_url('assets'); ?>/image/users/<?= $this->fungsi->user_login()['image'] ?>" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p><?= $this->fungsi->user_login()['name'] ?></p>

          <small><?php if($this->fungsi->user_login()['level'] == 1){echo "Admin";}else {echo "Kasir";} ?></small>

        </div>

      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

        <li class="<?php if($menu == 'dashboard')echo 'active'; ?>">

          <a href="<?= base_url('dashboard'); ?>">

            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

          </a>

        </li>

        <li class="<?php if($menu == 'suppliers')echo 'active'; ?>"> 

          <a href="<?= base_url('supplier'); ?>">

            <i class="fa fa-users"></i> <span>Pemasok</span>

          </a>

        </li>

        <li class="<?php if($menu == 'customers')echo 'active'; ?>"> 

          <a href="<?= base_url('customer'); ?>">

            <i class="fa fa-user"></i> <span>Pelanggan</span>

          </a>

        </li>

        <li class="treeview <?php if($menu == 'category' || $menu == 'unit' || $menu == 'item')echo 'active'; ?>">

          <a href="#">

            <i class="fa fa-th-large"></i>

            <span>Produk</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li  class="<?php if($menu == 'category')echo 'active'; ?>"><a href="<?= base_url('category'); ?>"><i class="fa fa-chevron-circle-right"></i> Kategori</a></li>

            <li  class="<?php if($menu == 'unit')echo 'active'; ?>"><a href="<?= base_url('unit'); ?>"><i class="fa fa-chevron-circle-right"></i> Unit</a></li>

            <li  class="<?php if($menu == 'item')echo 'active'; ?>"><a href="<?= base_url('item'); ?>"><i class="fa fa-chevron-circle-right"></i> Barang</a></li>

          </ul>

        </li>

        <li class="treeview <?php if ($this->uri->segment(2) == "in" || $this->uri->segment(2) == "out" || $menu == 'sale' ){echo "active";} ?>">

          <a href="#">

            <i class="fa fa-shopping-cart"></i>

            <span>Transaksi</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

               <li  class="<?php if($menu == 'sale')echo 'active'; ?>"><a href="<?= base_url('sale'); ?>"><i class="fa fa-chevron-circle-right"></i> Kasir</a></li>

               <li  class="<?php if ($this->uri->segment(2) == "in"){echo "active";} ?>"><a href="<?= base_url('stock/in'); ?>"><i class="fa fa-chevron-circle-right"></i> Masuk</a></li>

               <li  class="<?php if ($this->uri->segment(2) == "out"){echo "active";} ?>"><a href="<?= base_url('stock/out'); ?>"><i class="fa fa-chevron-circle-right"></i> Keluar</a></li>

          </ul>

        </li>

        <li class="treeview <?php if ($this->uri->segment(1) == "report"  ){echo "active";} ?>">

          <a href="#">

            <i class="fa fa-clipboard"></i>

            <span>Laporan</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li  class="<?php if($menu == 'sales')echo 'active'; ?>"><a href="<?= base_url('report'); ?>"><i class="fa fa-chevron-circle-right"></i> Penjualan</a></li>

            <li  class="<?php if($menu == 'stocks')echo 'active'; ?>"><a href="<?= base_url('report/stock'); ?>"><i class="fa fa-chevron-circle-right"></i> Stock</a></li>

          </ul>

        </li>

        <?php if ($this->fungsi->user_login()['level'] == "1"):?>

        <li class="header">PENGATURAN</li>

        <li class="<?php if($menu == 'user')echo 'active'; ?>">

          <a href="<?= base_url('user'); ?>">

            <i class="fa fa-user"></i> <span>Users</span>

          </a>

        </li>

        <li class="<?php if($menu == 'setting')echo 'active'; ?>">

          <a href="<?= base_url('user/setting'); ?>">

            <i class="fa fa-wrench"></i> <span>Pengaturan</span>

          </a>

        </li>

        <?php endif; ?>

      </ul>

    </section>

    <!-- /.sidebar -->

  </aside>



  <!-- =============================================== -->



<!-- jQuery 3 -->

<script src="<?= base_url('assets'); ?>/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Auto numeric -->

<script src="<?= base_url('assets'); ?>/bower_components/jquery/autoNumeric/autoNumeric.js"></script>



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <?php $this->load->view($content) ?>

  </div>

  

  <!-- Modal -->



  <div class="modal fade" id="modal-logout">

    <div class="modal-dialog lebar-25">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span></button>

          <h4 class="modal-title">Yakin ingin keluar?</h4>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>

          <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> Keluar</a>

        </div>

      </div>

      <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

  </div>



  <footer class="main-footer">

    <div class="pull-right hidden-xs">

      <b>Version</b> 1.0

    </div>

    <strong>Copyright &copy; <?= date('Y') ?> <a target="_blank" href="https://me.zoentech.my.id/">Abdul Ajiz</a>.</strong> All rights

    reserved.

  </footer>



  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

  <div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->



<!-- Bootstrap 3.3.7 -->

<script src="<?= base_url('assets'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Bootstrap 3.3.7 -->

<script src="<?= base_url('assets'); ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?= base_url('assets'); ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->



<!-- Select2 -->

<script src="<?= base_url('assets'); ?>/bower_components/select2/dist/js/select2.full.min.js"></script>



<script src="<?= base_url('assets'); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->

<script src="<?= base_url('assets'); ?>/bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->

<script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="<?= base_url('assets'); ?>/dist/js/demo.js"></script>



<script>

   $(function () {

    //Initialize Select2 Elements

    $('.select2').select2()

  })





  $(document).ready(function () {

    $('.sidebar-menu').tree()

  })

</script>



<script>

  $(document).ready(function () {

    $('#table1').dataTable({

      "iDisplayLength": 5,

      "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Semua"]],

      "pagingType": "full_numbers",

      "language": {

              "lengthMenu": "Tampilkan _MENU_ data per halaman",

              "zeroRecords": "Data tidak ada",

              "info": "Tampilkan halaman _PAGE_ dari _PAGES_",

              "infoEmpty": "Tidak ada data ditemukan",

              "infoFiltered": "(filtered from _MAX_ total records)",

              "search": "Cari",

              "paginate": {

                  "first":      "Awal",

                  "last":       "Akhir",

                  "next":       "&raquo;",

                  "previous":   "&laquo;"

              },

      },

      "columnDefs": [

            {

                "targets": [0],

                "orderable": false

            }

        ],

    })

  });

</script>

</body>

</html>

