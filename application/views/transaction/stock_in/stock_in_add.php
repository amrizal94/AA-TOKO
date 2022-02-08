<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah Stock In
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('stock/in'); ?>"><i class="fa fa-sign-in"></i> Data Stock In</a></li>
    <li class="noselect">Tambah Stock In</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= base_url('stock/in'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="shadow-sm">
                    <form action="<?= base_url('stock/in/tambah'); ?>" method="post">
                        <div class="form-group row">
                            <div class="col xs-12 col-md-5">
                                <label for="tanggal">Tanggal<sup>*</sup></label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php if(set_value('tanggal')){echo set_value('tanggal');}else{echo date('Y-m-d');}  ?>">
                                <?= form_error('tanggal', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col xs-12 col-md-7">
                                <div>
                                    <label for="barcode">Barcode</label>
                                </div>
                                <div class="form-group input-group">
                                    <input type="hidden" name="id_item" id="id_item" value="<?= set_value('id_item'); ?>">
                                    <input type="text" name="barcode" id="barcode" value="<?= set_value('barcode'); ?>" class="form-control" autocomplete="off" autofocus data-toggle="modal" data-target="#modal-item">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                    <?= form_error('barcode', '<small style="color:red"">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="name_item">Nama Barang<sup>*</sup></label>
                            <input type="type" id="name_item" name="name_item" class="form-control" value="<?= set_value('name_item'); ?>" readonly>
                            <?= form_error('name_item', '<small style="color:red"">', '</small>') ?>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12 col-md-6">
                                <label for="name_unit">Satuan barang<sup>*</sup></label>
                                <input type="text" id="name_unit" name="name_unit" class="form-control" value="<?= set_value('name_unit'); ?>" readonly>
                                <?= form_error('name_unit', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="stok_awal">Stok Barang<sup>*</sup></label>
                                <input type="number" id="stok_awal" name="stok_awal" class="form-control" value="<?= set_value('stok_awal'); ?>" readonly>
                                <?= form_error('stok_awal', '<small style="color:red"">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12 col-md-6">
                                <label for="detail">Detail<sup>*</sup></label>
                                <input type="type" id="detail" name="detail" class="form-control" value="<?= set_value('detail'); ?>">
                                <?= form_error('detail', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="note">Catatan</label>
                                <input type="type" id="note" name="note" class="form-control" value="<?= set_value('note'); ?>">
                                <?= form_error('note', '<small style="color:red"">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12 col-md-4">
                            <label for="supplier">Supplier</label>
                                <select name="supplier" id="supplier" class="form-control">
                                    <option value="">-Pilih Suplier</option>
                                        <?php foreach($supplier as $row) : ?>
                                             <option value="<?= $row['id_supplier'] ?>"  <?= set_value('supplier') == $row['id_supplier'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                        <?php endforeach; ?>
                                </select>
                                <?= form_error('supplier', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label for="purchase_price">Harga Beli<sup>*</sup></label>
                                <input type="number" id="purchase_price" name="purchase_price" class="form-control" value="<?= set_value('purchase_price'); ?>" min="0">
                                <?= form_error('purchase_price', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label for="qty">Jumlah<sup>*</sup></label>
                                <input type="number" id="qty" name="qty" class="form-control text-center" value="<?= set_value('qty'); ?>" min="0">
                                <?= form_error('qty', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label for="total_price">Total Harga<sup>*</sup></label>
                                <input type="number" id="total_price" name="total_price" class="form-control" value="<?= set_value('total_price'); ?>" min="0">
                                <?= form_error('total_price', '<small style="color:red"">', '</small>') ?>
                            </div>
                        </div>
                        


                        <div class="form-group row">
                            <div class="col-xs-12 col-md-3 pull-right">
                                <button type="submit" class="btn btn-success btn-block form-control">Tambah</button>
                            </div>
                            <div class="col-xs-12 col-md-3 pull-right">
                                <button type="reset" class="btn btn-default btn-block form-control">Reset</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal-item">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Produk Barang</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped table-hover" id="table1">
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($item as $row) : ?>
                <tr>
                    <td><?= $row['barcode'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['name_unit'] ?></td>
                    <td class="text-right"><?= rupiah($row['price']) ?></td>
                    <td class="text-right"><?= $row['stock'] ?></td>
                    <td>
                        <button class="btn btn-xs btn-info" id="pilih-barang" 
                        data-id_item="<?= $row['id_item'] ?>" 
                        data-barcode="<?= $row['barcode'] ?>" 
                        data-name="<?= $row['name'] ?>" 
                        data-name_unit="<?= $row['name_unit'] ?>" 
                        data-stock="<?= $row['stock'] ?>" 
                        >
                            <i class="fa fa-check"></i> Pilih
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>    
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary">Pilih</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$(document).ready(function () {
    $(document).on('click', '#pilih-barang', function () {
        var id_item = $(this).data('id_item');
        var barcode = $(this).data('barcode');
        var name = $(this).data('name');
        var name_unit = $(this).data('name_unit');
        var stock = $(this).data('stock');

        $('#id_item').val(id_item);
        $('#barcode').val(barcode);
        $('#name_item').val(name);
        $('#name_unit').val(name_unit);
        $('#stok_awal').val(stock);

        $('#modal-item').modal('hide');
    })
})

$(document).on('keyup mouseup', '#qty, #purchase_price', function() {
  count_total()
})


function count_total() {
  var purchase_price = $('#purchase_price').val()
  var qty = $('#qty').val()

  var total_bayar = purchase_price*qty;
  $('#total_price').val(total_bayar);

}
</script>