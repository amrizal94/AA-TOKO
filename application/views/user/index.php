<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data
    <small>Pengguna</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-user"></i> Data Pengguna</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <?= $this->session->flashdata('message'); ?>
                    <a href="<?= base_url('user/tambah'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>JK</th>
                                <th>Alamat</th>
                                <th>Level</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($users as $row) : ?>
                            <tr>
                                <th><?= $i++ ?></th>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['sex'] ?></td>
                                <td><?= $row['address'] ?></td>
                                <td><?php if($row['level'] == 1 ){ echo 'Admin'; }else{echo'Kasir'; }?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('user/edit/').$row['id_user']; ?>" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <?php if($row['username'] != $this->session->userdata('username') && $row['username'] != 'admin') :?>
                                    <button id="hapus-user" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-hapus" data-id="<?= $row['id_user'] ?>" data-name="<?= $row['name'] ?>">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                    <?php endif; ?>
                                </td> 
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->


<div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Yakin ingin menghapus data ?<span id="modal-name"></span>?</h5>
      </div>
      <div class="modal-footer">
        <form id="form-hapus" action="<?= base_url('user/hapus'); ?>" method="post">
            
            <input type="hidden" name="id_user" id="modal_id_user" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).on("click", "#hapus-user", function () {
     var id_user = $(this).data('id');
     var name = $(this).data('name');
     $("#modal_id_user").val( id_user );
     $("#modal-name").text( name );
});
</script>