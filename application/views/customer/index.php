<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Pelanggan
    <small>Pelanggan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Data Pelanggan</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <?= $this->session->flashdata('message'); ?>
                    <a href="<?= base_url('customer/tambah'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Ditambah</th>
                                <th>Diupdate</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($customer as $row) : ?>
                            <tr>
                                <th><?= $i++ ?></th>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['sex'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= $row['address'] ?></td>
                                <td>
                                    <i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['created'])); ?> &nbsp;
                                    <i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($row['created'])); ?>
                                </td>
                                <td>
                                <?php if($row['updated'] != $row['created']): ?>
                                    <i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['updated'])); ?> &nbsp;
                                    <i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($row['updated'])); ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('customer/edit/').$row['id_customer']; ?>" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button id="hapus-customer" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-hapus" data-id="<?= $row['id_customer'] ?>" data-name="<?= $row['name'] ?>">
                                        <i class="fa fa-trash"></i> 
                                    </button>
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
        <form id="form-hapus" action="<?= base_url('customer/hapus'); ?>" method="post">
            
            <input type="hidden" name="id_customer" id="modal_id_customer" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).on("click", "#hapus-customer", function () {
     var id_customer = $(this).data('id');
     var name = $(this).data('name');
     $("#modal_id_customer").val( id_customer );
     $("#modal-name").text( name );
});
</script>