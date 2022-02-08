<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Report Stock
    <small>Laporan Stok</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-bar-chart"></i> Report Sales</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header" style="padding-bottom:5px; padding-top:5px;">
                  <h4 class="m-0">Filter Data</h4>
                  <div class="box-tools pull-right">
                    <button  type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body row" style="padding-top:0">
                  <form action="<?= base_url('report/stock'); ?>" method="POST">

                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal != null ? $tanggal : null?>"> 
                      </div>
                    </div>

                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label for="sd">s/d</label>
                        <input type="date" class="form-control" id="sd" name="sd" value="<?= $sd != null ? $sd : null?>"> 
                      </div>
                    </div>

                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label for="type">Tipe</label>
                        <select class="form-control" name="type" id="type">
                            <option selected="selected" value="">Semua</option>
                            <option <?= $type ==  'in' ? 'selected="selected"' : null;?> value="in">Masuk <sub>(In)</sub></option>
                            <option <?= $type ==  'out' ? 'selected="selected"' : null;?> value="out">Keluar <sub>(Out)</sub></option>
                        </select> 
                      </div>
                    </div>

                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label for="pemasok">Pemasok</label>
                        <select class="form-control select2" style="width: 100%;" id="id_customer" name="pemasok">
                          <option selected="selected" value="">Semua</option>
                          <option <?= $pemasok ==  'null' ? 'selected="selected"' : null;?> value="null">Tidak ada</option>
                          <?php foreach($pemasok2 as $row) : ?>
                            <option <?= $pemasok ==  $row['id_supplier'] ? 'selected="selected"' : null;?> value="<?= $row['id_supplier'] ?>"><?= $row['name'] ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </div>
                    </div>

                    <div class="col-md-12 col-xs-12 ">
                      <button type="submit" name="filter" value="print" id="print" class="btn btn-success btn-xs" onclick="$('form').attr('target', '_blank');">
                        <i class="fa fa-print"></i>
                        Cetak
                      </button>
                      <button type="submit" class="pull-right btn btn-xs btn-primary" name="filter" value="filter" onclick="$('form').attr('target', '');">
                        <i class="fa fa-filter"></i>
                        Filter
                      </button>
                      <a class="pull-right mr-2 btn btn-xs btn-default" href="<?= base_url('report/stock'); ?>">Reset</a>
                    </div>

                  </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box box-primary">
                <?= $this->session->flashdata('message'); ?>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Tipe</th>
                                <th>Tanggal</th>
                                <th>Pengguna</th>
                                <th>Pemasok</th>
                                <th>Nama Barang</th>
                                <th>Stock Awal</th>
                                <th>Sisa Stock</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($report as $row) : ?>
                            <tr>
                                <th><?= $i++ ?></th>
                                <td class="text-center <?= $row['type'] == "in"? 'bg-success' : 'bg-danger' ?>" > <?= $row['type'] ?></td>
                                <td><i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['date'])); ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['supplier_name'] == null ? 'Tidak ada' :  $row['supplier_name']?></td>
                                <td><?= $row['item_name'] ?></td>
                                <td><?= $row['qty'] ?></td>
                                <td><?= $row['stock'] ?></td>
                                <td class="text-center">
                                  <button id="detail" data-target="#modal-detail" data-toggle="modal" class="btn btn-default btn-sm"
                                    data-type="<?= $row['type'] ?>"
                                    data-date="<?= date('d-m-Y', strtotime($row['date'])) ?>"
                                    data-username="<?= ucfirst($row['username']) ?>"
                                    data-supplier="<?= $row['supplier_name'] == null ? 'Tidak ada' :  $row['supplier_name'] ?>"
                                    data-detail="<?= $row['detail'] ?>"
                                    data-itemname="<?= $row['item_name'] ?>"
                                    data-purchaseprice="<?= rupiah($row['purchase_price']) ?>"
                                    data-qty="<?= $row['qty'] ?>"
                                    data-qty="<?= $row['stock'] ?>"
                                    data-totalprice="<?= rupiah($row['total_price']) ?>"
                                    data-note="<?= $row['note'] ?>"
                                    data-idstock="<?= $row['id_stock'] ?>"
                                  >
                                    <i class="fa fa-eye"></i>
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
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Detail Stok</h5>
      </div>

      <div class="modal-body table-responsive">
        <table class="table table-bordered no-margin">
          <tbody>
            <tr>
              <th style="width: 20%">Tipe</th>
              <td style="width: 30%"><b><span id="type2"></span></b></td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td><b><span id="date2"></span></b></td>
            </tr>
            <tr>
              <th>Pengguna</th>
              <td><b><span id="username2"></span></b></td>
            </tr>
            <tr>
              <th>Pemasok</th>
              <td><b><span id="supplier2"></span></b></td>
            </tr>
            <tr>
              <th>Detail</th>
              <td><b><span id="detail2"></span></b></td>
            </tr>
            <tr>
              <th>Nama Barang</th>
              <td><b><span id="itemname2"></span></b></td>
            </tr>
            <tr>
              <th>Harga Beli</th>
              <td><b><span id="purchaseprice2"></span></b></td>
            </tr>
            <tr>
              <th>Stock</th>
              <td><b><span id="qty2"></span></b></td>
            </tr>
            <tr>
              <th>Total Harga</th>
              <td><b><span id="totalprice2"></span></b></td>
            </tr>
            <tr>
              <th>Catatan</th>
              <td><b><span id="note2"></span></b></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).on("click", "#detail", function () {
     var type = $(this).data('type');
     $("#type2").text(type)
     if(type == "in"){
         $("#type2").css("color", "green");
     }else{
         $("#type2").css("color", "red");
     }
     $("#date2").text($(this).data('date'))
     $("#username2").text($(this).data('username'))
     $("#supplier2").text($(this).data('supplier'))
     $("#detail2").text($(this).data('detail'))
     $("#itemname2").text($(this).data('itemname'))
     
     $("#qty2").text($(this).data('qty'))

     var pp = $(this).data('purchaseprice')
     var tp = $(this).data('totalprice')

     if( pp == "Rp. 0"){
         pp = "-"
     }

     if( tp == "Rp. 0"){
         tp = "-"
     }

     $("#purchaseprice2").text(pp)
     $("#totalprice2").text(tp)

     $("#note2").text($(this).data('note'))

});
</script>