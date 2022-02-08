<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Barang
    <small>Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-
    "></i> Data Barang</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <?= $this->session->flashdata('message'); ?>
                    <a href="<?= base_url('item/tambah'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table12">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barcode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Ditambah</th>
                                <th>Diupdate</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <!-- <tbody> -->
                            <!-- <?php $i=1; foreach($item as $row) : ?>
                            <tr>
                                <th><?= $i++ ?></th>
                                <td>
                                    <?= $row['barcode'] ?> <br>
                                    <a href="<?= base_url('item/barcode_qrcode/').$row['id_item']; ?>" class="btn btn-sm btn-info m-0 p-1">
                                        <i class="fa fa-barcode"></i> <i class="fa fa-qrcode"></i> Generator
                                    </a>
                                </td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['name_category'] ?></td>
                                <td><?= $row['name_unit'] ?></td>
                                <td><?= $row['price'] ?></td>
                                <td><?= $row['stock'] ?></td>
                                <td><img style="max-width:130px" class="img-thumbnail" src="<?= base_url('assets/image/barang/').$row['image']; ?>" alt=""></td>
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
                                    <a href="<?= base_url('item/edit/').$row['id_item']; ?>" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="<?= base_url('item/hapus'); ?>" class="d-inline-block" method="post"> 
                                    <input type="hidden" name="id_item" value="<?= $row['id_item'] ?>">
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin, ingin menghapus <?= $row['name']?>?')">
                                          <i class="fa fa-trash"></i> 
                                      </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(!$item): ?>
                            <tr>
                                <td colspan="11" class="text-center text-danger">Data tidak ada</td>
                            </tr>
                            <?php endif;?> -->
                        <!-- </tbody> -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->


<script>
  $(document).ready(function () {
    $('#table12').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
           "url": "<?= site_url('item/get_ajax')?>",
            "type": "POST",
        },
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Semua"]],
        "columnDefs": [
            {
                "targets": [5, 6],
                "className": 'text-right'
            },
            {
                "targets": [7, 10],
                "className": 'text-center'
            },
            {
                "targets": [0, 7, 8, 9, 10],
                "orderable": false
            }
        ],
        "order": [],
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
        }
    });
  });
</script>


<div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Yakin ingin menghapus data ? <span id="modal-name"></span>?</h5>
      </div>
      <div class="modal-footer">
        <form id="form-hapus" action="<?= base_url('item/hapus'); ?>" method="post">
            
            <input type="hidden" name="id_item" id="modal_id_item" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).on("click", "#hapus-item", function () {
     var id_item = $(this).data('id');
     var name = $(this).data('name');
     $("#modal_id_item").val( id_item );
     $("#modal-name").text( name );
});
</script>