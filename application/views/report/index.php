<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Laporan
    <small>Laporan Penjualan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-bar-chart"></i> Laporan Penjualan</a></li>
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
                <div class="box-body row">
                  <form action="<?= base_url('report'); ?>" method="POST">

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
                        <label for="pelanggan">Pelanggan</label>
                        <select class="form-control select2" style="width: 100%;" id="id_customer" name="pelanggan">
                          <option selected="selected" value="">Semua</option>
                          <option value="umum" <?= $pelanggan == 'umum' ? 'selected="selected"' : null?>>Umum</option>
                          <?php foreach($customer as $row) : ?>
                            <option <?= $pelanggan ==  $row['id_customer'] ? 'selected="selected"' : null;?> value="<?= $row['id_customer'] ?>"><?= $row['name'] ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </div>
                    </div>

                    
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label for="invoice">Invoice</label>
                        <select class="form-control select2" style="width: 100%;" id="invoice2" name="invoice">
                          <option selected="selected" value="">Semua</option>
                          <?php foreach($sale as $row) : ?>
                            <?php if($pelanggan): ?>
                              <?php if($pelanggan == $row['id_customer']) : ?>
                                <option <?= $invoice ==  $row['invoice'] ? 'selected="selected"' : null;?> value="<?= $row['invoice'] ?>"><?= $row['invoice'] ?></option>
                                <?php elseif($row['id_customer'] == null): ?>
                                  <option <?= $invoice ==  $row['invoice'] ? 'selected="selected"' : null;?> value="<?= $row['invoice'] ?>"><?= $row['invoice'] ?></option>
                              <?php endif ?>
                            <?php else: ?>
                              <option <?= $invoice ==  $row['invoice'] ? 'selected="selected"' : null;?> value="<?= $row['invoice'] ?>"><?= $row['invoice'] ?></option>
                            <?php endif ?>
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
                      <a class="pull-right mr-2 btn btn-xs btn-default" href="<?= base_url('report'); ?>">Reset</a>
                    </div>

                  </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box box-primary">
                <?= $this->session->flashdata('message'); ?>
                <!-- <div class="box-header">
                    <a href="<?= base_url('supplier/tambah'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
                </div> -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Total Bayar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php $i=1; foreach($report as $row) : ?>
                            <tr>
                                <th><?= $i++ ?></th>
                                <td><?= $row['invoice'] ?></td>
                                <td><i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['date'])); ?></td>
                                <td><?= $row['customer_name'] == null ? 'Umum' :  $row['customer_name']?></td>
                                <td><?= rupiah($row['total_price']) ?></td>
                                <td><?= rupiah($row['discount']) ?></td>
                                <td><?= rupiah($row['final_price']) ?></td>
                                <td class="text-center">
                                  <button id="detail" data-target="#modal-detail" data-toggle="modal" class="btn btn-default btn-sm"
                                    data-invoice="<?= $row['invoice'] ?>"
                                    data-date="<?= date('d-m-Y', strtotime($row['date'])) ?>"
                                    data-time="<?= substr($row['sale_created'], 11, 5)?>"
                                    data-customer="<?= $row['customer_name'] == null ? 'Umum' :  $row['customer_name'] ?>"
                                    data-total="<?= rupiah($row['total_price']) ?>"
                                    data-discount="<?= rupiah($row['discount']) ?>"
                                    data-grandtotal="<?= rupiah($row['final_price']) ?>"
                                    data-cash="<?= rupiah($row['cash']) ?>"
                                    data-remaining="<?= rupiah($row['remaining']) ?>"
                                    data-note="<?= $row['note'] ?>"
                                    data-cashier="<?= ucfirst($row['user_name']) ?>"
                                    data-idsale="<?= $row['id_sale'] ?>"
                                  >
                                    <i class="fa fa-eye"></i>
                                  </button>
                                  <a  target="_blank" href="<?= base_url('sale/cetak/').$row['id_sale']; ?>" class="btn btn-info btn-sm">
                                      <i class="fa fa-print"></i>
                                  </a>
                                  <form action="<?= base_url('report/hapus'); ?>" class="d-inline-block" method="post"> 
                                    <input type="hidden" name="id_sale" value="<?= $row['id_sale'] ?>">
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin, ingin menghapus <?= $row['invoice']?>?')">
                                          <i class="fa fa-trash"></i> 
                                      </button>
                                    </form>
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
        <h5 class="modal-title">Detail Penjualan</h5>
      </div>

      <div class="modal-body table-responsive">
        <table class="table table-bordered no-margin">
          <tbody>
            <tr>
              <th style="width: 20%">Invoice</th>
              <td style="width: 30%"><b><span id="invoice"></span></b></td>
              <th style="width: 20%">Pelanggan</th>
              <td style="width: 30%"><span id="cust"></span></td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td><span id="datetime"></span></td>
              <th>Kasir</th>
              <td><span id="cashier"></span></td>
            </tr>
            <tr>
              <th>Total</th>
              <td><span id="total"></span></td>
              <th>Tunai</th>
              <td class="bg-success"><span id="cash"></span></td>
            </tr>
            <tr>
              <th>Diskon</th>
              <td><span id="discount"></span></td>
              <th>Kembalian</th>
              <td class="bg-warning"><span id="change"></span></td>
            </tr>
            <tr>
              <th>Total Bayar</th>
              <td class="bg-info"><span id="grandtotal"></span></td>
              <th>Note</th>
              <td><span id="note"></span></td>
            </tr>
            <tr>
              <th>Barang</th>
              <td colspan="3"><span id="product"></span></td>
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
/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString();
      // Hapus 0 jika 0 pertama
      if(number_string.length > 1){
        while(number_string.charAt(0) === '0')
        {
        number_string = number_string.substr(1);
        }
      }
			var split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    
    
    $(document).on("click", "#detail", function () {
     $("#invoice").text($(this).data('invoice'))
     $("#cust").text($(this).data('customer'))
     $("#datetime").text($(this).data('date') + ' | ' + $(this).data('time'))
     $("#total").text($(this).data('total'))
     $("#discount").text($(this).data('discount'))
     $("#cash").text($(this).data('cash'))
     $("#change").text($(this).data('remaining'))
     $("#grandtotal").text($(this).data('grandtotal'))
     $("#note").text($(this).data('note'))
     $("#cashier").text($(this).data('cashier'))

      var product = '<table class="table table-sm no-margin bg-primary">'
      product += '<tr><th>Nama</th><th>Harga</th><th>Jumlah</th><th>Diskon</th><th>Toral</th></tr>'
      $.getJSON('<?=site_url('report/sale_product/')?>'+$(this).data('idsale'), function(data) {
        $.each(data, function (key, val) {
          product += '<tr><td>'+val.name+'</td><td>'+formatRupiah(val.price, 'Rp. ')+'</td><td>'+val.qty+'</td><td>'+formatRupiah(val.discount_item, 'Rp. ')+'</td><td>'+formatRupiah(val.total, 'Rp. ')+'</td></tr>'
        })
        product += '</table>'
        $('#product').html(product)
      })

});
</script>
