<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kasir
    <small>Penjualan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="sales"><i class="fa fa-shopping-cart"></i> Kasir</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content" id="sales">
  <?= $this->session->flashdata('message'); ?>

  <div class="row">

    <div class="col-xs-12 col-md-4">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-sm va-m mw-42">
            <tbody>
              <tr>
                <th>Tanggal</th>
                <td>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right tgl_sale" id="datepicker"  name="date" value="<?= date('d-m-Y') ?>">
                  </div>
                </td>
              </tr>

              <tr>
                <th>Kasir</th>
                <td>
                  <div class="input-group ">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-bold" id="user" name="user" value="<?= $this->fungsi->user_login()['name']; ?>" readonly>
                  </div>
                </td>
              </tr>

              <tr class="s2">
                <th>Pelanggan</th>
                <td>
                    <select class="form-control select2" style="width: 100%;" id="id_customer">
                      <option selected="selected" value="">Umum</option>
                      <?php foreach($customer as $row) : ?>
                        <option value="<?= $row['id_customer'] ?>"><?= $row['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-md-4">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-sm va-m mw-42">
            <tbody>
              <tr>
                <th>Barcode</th>
                <td>
                  <div class="input-group">
                  <input type="hidden" id="id_item">
                  <input type="hidden" id="price">
                  <input type="hidden" id="stock">
                  <input type="hidden" id="qty_cart">
                    <div class="input-group-addon">
                      <i class="fa fa-barcode"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="barcode" name="barcode" autofocus autocomplete="off" data-toggle="modal" data-target="#modal-item">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                          <i class="fa fa-search"></i>
                        </button>
                    </span>
                  </div>
                </td>
              </tr>

              <tr>
                <th>Jumlah</th>
                <td>
                  <div class="input-group ">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-numeric-asc"></i>
                    </div>
                    <input type="number" class="form-control pull-right" id="qty" name="qty" value="1">
                  </div>
                </td>
              </tr>

              <tr>
                <th></th>
                <td>
                  <button class="btn btn-primary" id="add_cart" type="button">
                    <i class="fa fa-cart-plus"></i> Tambah
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-md-4 mh-160">
      <div class="box box-widget ">
        <div class="box-body table-responsive">
          <table class="table table-sm va-m mw-42">
            <tbody>
              <tr>
                <th>Invoice</th>
                <td class="text-right text-bold"><?= $invoice ?></td>
              </tr>

              <tr rowspan="2">
                <th colspan="2" class="text-right"><span class="total-bayar" id="total-bayar" >Rp. 0</span></th>
              </tr>


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir row -->

  <div class="row">
    <div class="col col-md-12">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped table-hover ">
            <thead>
              <tr>
                <td>#</td>
                <td>Barcode</td>
                <td>Barang</td>
                <td class="text-right">Harga</td>
                <td class="text-right">Jumlah</td>
                <td class="text-right">Diskon</td>
                <td class="text-right">Total</td>
                <td class="text-center">Aksi</td>
              </tr>
            </thead>
            <tbody id="cart_table">
            <?php $this->view('sale/cart_data'); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir row -->

  <div class="row">
    <div class="col col-md-3">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-sm va-m mw-42">
            <tbody>
              <tr>
                <th>Sub Total</th>
                <td>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="sub_total" name="sub_total" readonly>
                  </div>
                </td>
              </tr>

              <tr>
                <th>Diskon</th>
                <td>
                <div class="row">
                  <div class="col-xs-8 pr-0">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                      </div>
                      <input type="text" class="form-control pull-right text-bold" id="discount" name="discount" value="Rp. 0">
                    </div>
                  </div>
                  <div class="col-xs-4 pl-0 ">
                    <input type="text" class="form-control px-2 align-center text-bold" placeholder="   %" id="persen" name="persen">
                  </div>
                </div>
                </td>
              </tr>

              <tr class="s2">
                <th>Total Bayar</th>
                 <td>
                  <div class="input-group ">
                    <div class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-bold" id="grand_total" name="grand_total" readonly >
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    
    <div class="col col-md-3">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-sm va-m mw-42">
            <tbody>
              <tr>
                <th>Bayar</th>
                <td>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-bold" id="cash" name="cash" value="Rp. 0">
                  </div>
                </td>
              </tr>

              <tr>
                <th>Kembalian</th>
                <td>
                  <div class="input-group ">
                    <div class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-bold change-s" id="change" name="change" readonly>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col col-md-3">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-sm va-m mw-42">
            <tbody>
              <tr>
                <th>Note</th>
                <td>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-sticky-note-o"></i>
                    </div>
                    <textarea id="note" class="form-control" cols="30" rows="5"></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col col-md-3">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-sm va-m mw-42">
            <tbody>
              <tr>
                <td>
                  <button id="cancel-payment" class="btn btn-danger btn-block"><i class="fa fa-times"></i> Batal</button>
                  <button id="process-payment" class="btn btn-success btn-block" ><i class="fa fa-send"></i> Proses Pembayaran</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- akhir row -->

</section>


<!-- Modal tambah barang -->
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
                    <th>Gambar</th>
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
                    <td><center><img src="<?= base_url('assets/image/barang/') . $row['image'] ?>" class="img-thumbnail" style="max-height:70px;"></center></td>
                    <td><?= $row['barcode'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['name_unit'] ?></td>
                    <td class="text-right"><?= rupiah($row['price']) ?></td>
                    <td class="text-right"><?= $row['stock'] ?></td>
                    <td>
                      <?php if($row['stock'] != 0): ?>
                        <button class="btn btn-xs btn-info" id="pilih-barang" 
                        data-id_item="<?= $row['id_item'] ?>" 
                        data-barcode="<?= $row['barcode'] ?>" 
                        data-stock="<?= $row['stock'] ?>" 
                        data-price="<?= $row['price'] ?>" 
                        >
                            <i class="fa fa-check"></i> Pilih
                        </button>
                      <?php endif; ?>
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



<!-- Modal edit barang -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-editcart">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Produk Barang</h4>
      </div>
      <div class="modal-body ">
         <div class="form-group row">
              <input type="hidden" id="id_cart2" name="id_cart2" value=""> 
              <input type="hidden" id="stock2" name="stock2" value=""> 
            <div class="col-xs-12 col-md-4">
              <label for="barcode2">Barcode<sup>*</sup></label>
              <input type="text" id="barcode2" name="barcode2" class="form-control" value="" readonly>
              <?= form_error('barcode2', '<small style="color:red"">', '</small>') ?>
            </div>
            <div class="col-xs-12 col-md-8">
              <label for="name_item2">Nama Barang<sup>*</sup></label>
              <input type="text" id="name_item2" name="name_item2" class="form-control" value="" readonly>
              <?= form_error('name_item2', '<small style="color:red"">', '</small>') ?>
            </div>
          </div>
         <div class="form-group row">
            <div class="col-xs-12 col-md-8">
              <label for="price2">Harga<sup>*</sup></label>
              <input type="text" id="price2" name="price2" class="form-control" value="" autocomplete="off">
              <?= form_error('price2', '<small style="color:red"">', '</small>') ?>
            </div>
            <div class="col-xs-12 col-md-4">
              <label for="qty2">Jumlah<sup>*</sup></label>
              <input type="number" id="qty2" name="qty2" class="form-control" value="" >
              <?= form_error('qty2', '<small style="color:red"">', '</small>') ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xs-12">
              <label for="total2">Total harga<sup>*</sup></label>
              <input type="text" id="total2" name="total2" class="form-control" value="" readonly>
              <?= form_error('total2', '<small style="color:red"">', '</small>') ?>
            </div>
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-8">
                  <label for="discount_item2">Diskon</label>
                  <input type="text" id="discount_item2" name="discount_item2" class="form-control" value="" autocomplete="off">
                </div>
                <div class="col-xs-4">
                  <label for="persen2">Persen</label>
                  <input type="text" id="persen2" name="persen2"  class="form-control" placeholder="%" autocomplete="off">
                </div>
              <?= form_error('discount_item2', '<small style="color:red"">', '</small>') ?>
              </div>
            </div>
            <div class="col-xs-12">
              <label for="total3">Total Bayar<sup>*</sup></label>
              <input type="text" id="total3" name="total3" class="form-control" value="" readonly>
              <?= form_error('total3', '<small style="color:red"">', '</small>') ?>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="edit_cart">Edit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
		
    var rupiah = document.getElementById('cash');
    var discount = document.getElementById('discount');
    var price2 = document.getElementById('price2');
    var discount_item2 = document.getElementById('discount_item2');
    

    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
		discount.addEventListener('keyup', function(e){
			discount.value = formatRupiah(this.value, 'Rp. ');
		});
		price2.addEventListener('keyup', function(e){
			price2.value = formatRupiah(this.value, 'Rp. ');
		});
		discount_item2.addEventListener('keyup', function(e){
			discount_item2.value = formatRupiah(this.value, 'Rp. ');
		});
 
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
    
    function rupiahToInt(rupiah) {
      var hasil = rupiah.replace(/[^,\d]/g, '').toString();
      return parseInt(hasil);
    }

    function angka(angka) {
      var hasil = angka.replace(/[^,\d]/g, '').toString();
      return parseInt(hasil);
    }

</script>
<script>
$(document).ready(function () {
  $(document).on('click', '#pilih-barang', function () {
    var id_item = $(this).data('id_item');
    var barcode = $(this).data('barcode');
    var stock = $(this).data('stock');
    var price = $(this).data('price');

    $('#id_item').val(id_item);
    $('#barcode').val(barcode);
    $('#stock').val(stock);
    $('#price').val(price);
    
    $('#modal-item').modal('hide');
    get_cart_qty(barcode)
  })

  calculate()
})

function get_cart_qty(barcode) {
  $('#cart_table tr').each(function () {
    // var qty_cart = $(this).find("td").eq(4).html()
    var qty_cart = $("#cart_table td.barcode:contains('" + barcode + "')").parent().find("td").eq(4).html()
    if (qty_cart != null) {
      $('#qty_cart').val(qty_cart)
    }else{
      $('#qty_cart').val(0)
    }
      
  })
  
}

$(document).on('click', '#add_cart', function () {
  var id_item = $('#id_item').val()
  var price = $('#price').val()
  var stock = $('#stock').val()
  var qty = $('#qty').val()
  var qty_cart = $('#qty_cart').val()

  if(id_item == ''){
    alert('Barang belum dipilih')
    $('#barcode').focus()
  } else if(parseInt(qty) < 1){
    alert('Jumlah belum diisi')
    $('#qty').focus()
  }else if(parseInt(qty) > parseInt(stock)){
    alert('Jumlah melebihi stok')
    $('#qty').focus()
  }else if( (parseInt(stock) - parseInt(qty_cart)) == 0){
    alert('Stok kosong')
    $('#qty').focus()
  }else if( (parseInt(stock) - parseInt(qty_cart)) < parseInt(qty)){
    alert('Stok kelebihan maksimal = '+ (parseInt(stock) - parseInt(qty_cart)))
    $('#qty').focus()
  } else{
    $.ajax({
      type: 'POST',
      url: '<?= site_url('sale/process')?>',
      data: {'add_cart' : true, 'id_item' : id_item, 'price' : price, 'qty' : qty},
      dataType: 'json',
      success: function (result) {
        if (result.success == true) {
          $('#qty').val('1')
          $('#barcode').val('')
          $('#stock').val(0)
          $('#qty_cart').val(0)
          $('#id_item').val('')
          $('#price').val(0) 
          $('#barcode').focus()
          
          
          $('#cart_table').load('<?= site_url('sale/cart_data')?>', function () {
             calculate()
          })
        }else{
          alert('Gagal menambah barang ke keranjang')
        }
      }
    })
  }
})

$(document).on('click', '#del_cart', function () {
  if (confirm('Apakah anda yakin?')) {
    var id_cart = $(this).data('id_cart');

    $.ajax({
      type: 'POST',
      url: '<?= site_url('sale/cart_del')?>',
      data: {'id_cart' : id_cart},
      dataType: 'json',
      success: function (result) {
        if(result.success == true){
          $('#qty').val('1')
          $('#barcode').val('')
          $('#barcode').focus()
          
          $('#cart_table').load('<?= site_url('sale/cart_data')?>', function () {
             calculate()
              $('#qty').val('1')
              $('#barcode').val('')
              $('#stock').val(0)
              $('#qty_cart').val(0)
              $('#id_item').val('')
              $('#price').val(0) 
              $('#barcode').focus()
          })
        }else{
          alert('Gagal menghapus barang')
        }
      }
    })
    
  }
})

// edit cart
$(document).ready(function () {
  $(document).on('click', '#update_cart', function () {
    var id_cart = $(this).data('id_cart2');
    var barcode = $(this).data('barcode2');
    var name_item = $(this).data('name_item2');
    var price = $(this).data('price2');
    var stock = $(this).data('stock2');
    var qty = $(this).data('qty2');
    var discount_item = $(this).data('discount_item2');
    var harga_baru
    if(discount_item != null){
      harga_baru = price-discount_item;
    }else{
      harga_baru = price;
      discount_item = 0;
    }
    var total = $(this).data('total2');

    
    
    $('#id_cart2').val(id_cart);
    $('#barcode2').val(barcode);
    $('#name_item2').val(name_item);
    $('#price2').val(formatRupiah((price.toString()), 'Rp. '));
    $('#stock2').val(stock);
    $('#qty2').val(qty);
    $('#discount_item2').val(formatRupiah(discount_item.toString(), 'Rp. ') );
    $('#total2').val( formatRupiah((price*qty).toString(), 'Rp. ') );
    $('#total3').val( formatRupiah( (harga_baru*qty).toString(), 'Rp. ' ) );
    
    $('#modal-item').modal('hide');
  })
})

function count_edit_modal() {
  var price = rupiahToInt(($('#price2').val()))
  var qty = $('#qty2').val()
  var discount_item = rupiahToInt(($('#discount_item2').val()))
  var total_harga = price*qty
  $('#total2').val(formatRupiah(total_harga.toString(), 'Rp. '));

  var total_bayar = (price-discount_item)*qty
  if( total_bayar < 0 ){
    total_bayar = 'Diskon melebihi harga'
  }else{
    total_bayar = formatRupiah(total_bayar.toString(), 'Rp. ')
  }
  $('#total3').val(total_bayar);

}

$(document).on('keyup mouseup', '#price2, #qty2, #discount_item2', function() {
  count_edit_modal()
})

$(document).on('click', '#edit_cart', function () {
  var id_cart = $('#id_cart2').val()
  var price2 = rupiahToInt($('#price2').val())
  var qty2 = $('#qty2').val()
  var stock2 = $('#stock2').val()
  var discount_item2 = rupiahToInt($('#discount_item2').val())
  $('#persen2').val('')
  if(discount_item2 == ''){
    discount_item2=0
  }
  var total2 =rupiahToInt($('#total2').val())
  var total3 = rupiahToInt($('#total3').val())

  if(parseInt(price2) < 1 || price2 == ''){
    alert('Harga tidak boleh kosong')
    $('#price2').focus()
  } else if(parseInt(qty2) < 1 || parseInt(qty2) == ''){
    alert('Jumlah belum diisi')
    $('#qty2').focus()
  }else if(parseInt(qty2) > parseInt(stock2)){
    alert('Jumlah melebihi stok, stok saat ini = ' + stock2)
    $('#qty2').focus()
  }else{
    $.ajax({
      type: 'POST',
      url: '<?= site_url('sale/process')?>',
      data: {'edit_cart' : true, 'id_cart' : id_cart, 'price' : price2, 'qty' : qty2, 'discount_item' : discount_item2, 'total2' : total2, 'total3' : total3},
      dataType: 'json',
      success: function (result) {
        if (result.success == true) {
          $('#qty').val('1')
          $('#barcode').val('')
          $('#stock').val(0)
          $('#qty_cart').val(0)
          $('#id_item').val('')
          $('#price').val(0) 
          $('#barcode').focus()
          
          $('#cart_table').load('<?= site_url('sale/cart_data')?>', function () {
             calculate()
          })

        $('#modal-editcart').modal('hide');
        }else{
          alert('Data keranjang tidak ada yang berubah')
        }
      }
    })
  }
})

function calculate() {
  var sub_total = 0;
  $('#cart_table tr').each(function () {
    sub_total += parseInt( rupiahToInt(($(this).find('#total').text())) )
  })
  isNaN(sub_total) ? $('#sub_total').val('Rp. 0') : $('#sub_total').val(formatRupiah((sub_total.toString()), 'Rp. '))

  var discount = $('#discount').val()
  var grand_total = sub_total-(rupiahToInt(discount))

  if(isNaN(grand_total)){
    $('#total-bayar').text('Rp. 0')
    $('#grand_total').val('Rp. 0')
  }else{
    grand_total2 = formatRupiah(grand_total.toString(), 'Rp. ')
    $('#total-bayar').text(grand_total2+',-')
    $('#grand_total').val(grand_total2)
  }

  var cash = rupiahToInt($('#cash').val())
  if (cash != 0) {
    kembalian = cash-grand_total
    if(kembalian < 0){
      kembalian = 'Uang Kurang'
    }else if(kembalian == 0){
      kembalian = 'Rp.0'
    }
    else{
      kembalian = formatRupiah(kembalian.toString(), 'Rp. ')
    }
    $('#change').val(kembalian)
  }else{
    $('#change').val('Rp. 0')
  }
  
  var change = $('#change').val()
   if (change < 0 || cash == '') {
    $('#process-payment').addClass("disabled");
  }else{
    $('#process-payment').removeClass('disabled')
  }

}

$(document).on('keyup mouseup', '#discount, #cash', function() {
  calculate()
})

// disc
$(document).on('change', '#discount', function () {
  var sub_total = rupiahToInt($('#sub_total').val())
  var discount = rupiahToInt($('#discount').val())
  var persen = (discount/sub_total) * 100

  $('#persen').val(persen + ' %')
})

$(document).on('change', '#discount_item2', function () {
  var sub_total = rupiahToInt($('#price2').val())
  var discount = rupiahToInt($('#discount_item2').val())
  var persen = (discount/sub_total) * 100

  $('#persen2').val(persen + ' %')
})

// persen
$(document).on('change', '#persen', function () {
  var sub_total = rupiahToInt($('#sub_total').val())
  var discount = 0
  var persen = angka($('#persen').val())

  $('#persen').val(persen + ' %')
  
  discount = (persen*sub_total)/100
  $('#discount').val(formatRupiah(discount.toString(), 'Rp. '))
  $('#discount').keyup()
})

$(document).on('change', '#persen2', function () {
  var sub_total = rupiahToInt($('#price2').val())
  var discount = 0
  var persen = angka($('#persen2').val())

  $('#persen2').val(persen + ' %')
  
  discount = (persen*sub_total)/100
  $('#discount_item2').val(formatRupiah(discount.toString(), 'Rp. '))
  $('#discount_item2').keyup()
})

$(document).on("click", '#persen, #persen2', function () {
   $(this).select();
});

// process payment
$(document).on('click', '#process-payment', function () {
  var date = $('#datepicker').val()
  var id_customer = $('#id_customer').val()
  var sub_total = rupiahToInt($('#sub_total').val())
  var discount = rupiahToInt($('#discount').val())
  var grand_total = rupiahToInt($('#grand_total').val())
  var cash = rupiahToInt($('#cash').val())
  var change = $('#change').val()
  if(change == "Uang Kurang"){
    change = -1
  }else if(change == "Rp. 0"){
    change = 0
  }else{
    change = rupiahToInt(change)
  }
  var note = $('#note').val()

  if(sub_total < 1){
    alert('Belum ada barang yang dipilih')
    $('#barcode').focus()
  }else if(cash < 1){
    alert('Jumlah uang belum diinput')
    $('#cash').focus()
  }else if(change < 0){
    alert('Jumlah uang kurang')
    $('#cash').focus()
  }else{
    if(confirm('Yakin proses transaksi ini?')){
      $.ajax({
        type: 'POST',
        url: '<?= site_url('sale/process')?>',
        data: {'process-payment' : true, 'id_customer' : id_customer, 'sub_total' : sub_total, 'discount' : discount, 'grand_total' : grand_total, 'cash' : cash, 'change' : change, 'note' : note, 'date' : date},
        dataType: 'json',
        success: function (result) {
          if(result.success == true){
            alert('Transaksi berhasil')
            window.open('<?= site_url('sale/cetak/')?>'  + result.id_sale, '_blank')
          }else{
            alert('Transaksi gagal')
          }
          location.href='<?= site_url('sale')?>'
        }
      })
    }
  }
})

// Cancel payment
$(document).on('click', '#cancel-payment', function () {
  if (confirm('Apakah anda yakin?')) {
    $.ajax({
      type: 'POST',
      url: '<?= site_url('sale/cart_del')?>',
      data: {'cancel_payment' : true},
      dataType: 'json',
       success: function (result) {
          if(result.success == true){
             $('#cart_table').load('<?= site_url('sale/cart_data')?>', function () {
             calculate()
          })
          }
        }
    })
    $('#discount').val(0)
    $('#cash').val(0)
    $('#note').val('')
    $('#persen').val('')
    $('#id_customer').val('').change()
    $('#barcode').val('')
    $('#barcode').focus()
  }
})
 
</script>
<!-- bootstrap datepicker -->
<script src="<?= base_url('assets'); ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
//Date picker
  $('#datepicker').datepicker({
    autoclose: true
  })
</script>

