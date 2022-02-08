<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Stock Out
    <small>Stok Keluar</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-sign-out"></i> Data Stock Out</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <?= $this->session->flashdata('message'); ?>
                    <a href="<?= base_url('stock/out/tambah'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th>Detail</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($stock as $row) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $row['barcode'] ?></td>
                                    <td><?= $row['name_item'] ?></td>
                                    <td><?= $row['detail'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td>
                                        <i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['date'])); ?> 
                                    </td>
                                    <td class="text-center">
                                        <a id="detail_bm" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail"
                                            data-barcode="<?= $row['barcode'] ?>"
                                            data-name_item="<?= $row['name_item'] ?>"
                                            data-name_supplier="<?= $row['name_supplier'] ?>"
                                            data-date="<?= date('d-m-Y', strtotime($row['date'])) ?>"
                                            data-name_user="<?= $row['name_user'] ?>"
                                            data-qty="<?= $row['qty'] ?>"
                                            data-detail="<?= $row['detail'] ?>"
                                        
                                        >
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button id="hapus-stock" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-hapus" data-id="<?= $row['id_stock'] ?>" data-iditem="<?= $row['id_item'] ?>" data-name="<?= $row['name_item'] ?>" data-qty="<?= $row['qty'] ?>">
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



<div class="modal fade" tabindex="-1" role="dialog" id="modal-detail">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail barang masuk</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped table-hover" id="table1">
                <tr>
                    <th>Barcode</th>
                    <td>:</td>
                    <td><span id="barcode"></span></td>
                </tr>
                <tr>
                    <th>Nama barang</th>
                    <td>:</td>
                    <td><span id="name_item"></span></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>:</td>
                    <td><span id="qty"></span></td>
                </tr>
                <tr>
                    <th>Detail</th>
                    <td>:</td>
                    <td><span id="detail"></span></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td><span id="date"></span></td>
                </tr>
                <tr>
                    <th>Nama yang menginput data</th>
                    <td>:</td>
                    <td><span id="name_user"></span></td>
                </tr>
        </table>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <!-- <button type="button" class="btn btn-primary">Pilih</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
$(document).ready(function () {
    $(document).on('click', '#detail_bm', function () {
        var barcode = $(this).data('barcode');
        var name_item = $(this).data('name_item');
        var name_supplier = $(this).data('name_supplier');
        var name_user = $(this).data('name_user');
        var detail = $(this).data('detail');
        var qty = $(this).data('qty');
        var date = $(this).data('date');

        $('#barcode').text(barcode);
        $('#name_item').text(name_item);
        $('#name_user').text(name_user);
        $('#name_supplier').text(name_supplier);
        $('#qty').text(qty);
        $('#detail').text(detail);
        $('#date').text(date);

    })
})

</script>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Yakin ingin menghapus data <span id="modal-name"></span>?</h5>
      </div>
      <div class="modal-footer">
        <form id="form-hapus" action="<?= base_url('stock/hapus_stock_out'); ?>" method="post">
            
            <input type="hidden" name="id_stock" id="modal_id_stock" >
            <input type="hidden" name="qty" id="modal_qty" >
            <input type="hidden" name="id_item" id="modal_id_item" >

            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).on("click", "#hapus-stock", function () {
     var id_stock = $(this).data('id');
     var id_item = $(this).data('iditem');
     var qty = $(this).data('qty');
     var name = $(this).data('name');
     $("#modal_id_stock").val( id_stock );
     $("#modal-name").text( name );
     $("#modal_qty").val( qty );
     $("#modal_id_item").val( id_item );
});
</script>