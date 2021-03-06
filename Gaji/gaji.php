<?php
function num($rp){
if($rp!=0){
 $hasil = number_format($rp, 2, '.', ',');
 }
 else{
 $hasil=0;
 }
return $hasil;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Data</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../asset/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../asset/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../asset/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../asset/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../asset/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../asset/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../asset/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="../asset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../asset/plugins/iCheck/square/blue.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AFR</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI PENGGAJIAN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <h4 align=center>SISTEM PENGGAJIAN KARYAWAN</h4>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include("sidebar.php"); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Karyawan</a></li>
        <li class="active">Gaji Karyawan</li>
      </ol>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Gaji</h3>
        </div>
        <!--Button Input Gaji-->
        <div class="box-footer">
           <button type="submit" class="btn btn-primary" data-toggle="modal"  data-target="#modal-default" ><b>+</b> Input Gaji</button>
         </div>  
      
        <!-- data-table -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Gaji</th>
              <th>Nama Karyawan</th>
              <th>Tanggal Gaji</th>
              <th>Jabatan</th>
              <th>Tunjangan Jabatan</th>
              <th>Potongan Gaji</th>
              <th>Gaji Bersih</th>
              <th> Action </th>
            </tr>
            </thead>
            <tbody>

              <?php
                  require '../controller/controllerCrudGaji.php';
                  $modelGaji=new modelGaji();
                  $modelGaji -> select();
                  $modelGaji -> selectPegawai();
                  $modelGaji -> selectGaji();
                  $modelGaji -> selectPotongan();
                  $modelGaji -> selectTunjangan();
                  $dataGaji = $modelGaji->getData();
                  $dataJabatan = $modelGaji->getDataGaji();
                  $dataPegawai = $modelGaji->getDataPegawai();
                  $dataPotongan = $modelGaji->getDataPotongan();
                  $dataTunjangan = $modelGaji->getDataTunjangan();
                  foreach ($dataGaji as $key) 
                  {

                $tanggal        = $key['tanggal_gaji'];     
                $tgl            = explode('-',$tanggal);
                $tgl_gaji  = $tgl[2]."-".$tgl[1]."-".$tgl[0];

                    ?>

            <tr>
              <td><?= $key['id_gaji']; ?></td>
              <td><?= $key['nama_pegawai']; ?></td>
              <td><?= $tgl_gaji; ?></td>
              <td><?= $key['nama_gaji']; ?></td>
              <td><?= $key['nama_tunjangan']; ?></td>
              <td><?php
                  if($key['id_potongan']!=3){
                    echo $key['nama_potongan']; ?> = <?= $key['jumlah_potongan']; ?></td>
                  <?php
                  }else{
                    echo $key['nama_potongan'];
                  }
              ?>
              <td><?php
              $gaji_kotor=$key['jumlah_datagaji'];
              $tunjangan=$key['jumlah_tunjangan'];
              $potongan=$key['jumlah_potongan'];
              $gaji_bersih=$gaji_kotor+$tunjangan-$potongan;
              echo "Rp. ".num($gaji_bersih);
              ?></td>
              <td>
                <a class="btn btn-social-icon" title="potongan"><i class="fa fa-scissors"data-toggle="modal" href="potongan.html" disabled ></i></a>
                <a class="btn btn-social-icon" title="edit"><i class="fa fa-edit"data-toggle="modal" href="#"></i></a>
                <a class="btn btn-social-icon" title="hapus" ><i class="fa fa-bitbucket"data-toggle="modal" href="#"></i></a>
              </td>
            </tr>
            <?php
          }
            ?>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
    </section>
    </section>
    <!-- /.content -->
  </div>


  <!--modal-->
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Input Gaji Karyawan</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="../proses/prosesInsertGaji.php?aksi=tambah" method="post" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                <label for="exampleInputEmail1">Nama Pegawai</label>
                <select class="form-control" name="pegawai">
                  <option>-- Pilih Pegawai --</option>
                  
                  <?php
                  foreach ($dataPegawai as $key) 
                  { 
                    ?>
                <option><?= $key['id_pegawai'];?>/<?= $key['nama_pegawai'];?></option>
                <?php
                }
                ?>
                </select>
              </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Tanggal</label>
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="tgl" >
                </div>
              </div>
              <div class="form-group has-feedback">
                <label for="exampleInputEmail1">Jabatan</label>
                <select class="form-control" name="jabatan">
                  <option>-- Pilih Jabatan --</option>
                  
                  <?php
                  foreach ($dataJabatan as $key2) 
                  { 
                    ?>
                <option><?= $key2['id_dataGaji'];?>/<?= $key2['nama_gaji'];?>/<?= $key2['jumlah_datagaji'];?></option>
                <?php
                }
                ?>
                </select>
              </div>
              <div class="form-group has-feedback">
                <label for="exampleInputEmail1">Tunjangan</label>
                <select class="form-control" name="tunjangan">
                  <option>-- Pilih Tunjangan --</option>
                  
                  <?php
                  foreach ($dataTunjangan as $key) 
                  { 
                    ?>
                <option><?= $key['id_tunjangan'];?>/<?= $key['nama_tunjangan'];?></option>
                <?php
                }
                ?>
                </select>
              </div>
              <div class="form-group has-feedback">
                <label for="exampleInputEmail1">Potongan Gaji</label>
                <select class="form-control" name="potongan">
                  <option>-- Pilih Potongan --</option>
                  
                  <?php
                  foreach ($dataPotongan as $key) 
                  { 
                    ?>
                <option><?= $key['id_potongan'];?>/<?= $key['nama_potongan'];?></option>
                <?php
                }
                ?>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

      </div>












  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../asset/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../asset/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../asset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../asset/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../asset/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../asset/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../asset/dist/js/demo.js"></script>
<!-- page script -->
<script src="../asset/plugins/iCheck/icheck.min.js"></script>
<script src="../asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script>
          $(function () {
            //Date picker
            $('#datepicker').datepicker({
              autoclose: true
            })
          });
        </script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
