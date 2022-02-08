<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pengaturan
    <small>Toko</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-wrench"></i> Pengaturan Toko</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-xs-12 col-md-7">
            <div class="box box-primary">
                <div class="box-header">
                    <?= $this->session->flashdata('message'); ?>
                    <h2>Toko Anda</h2>
                </div>
                <div class="box-body">
                    <form action="<?= base_url('user/setting'); ?>" method="POST">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <label for="shop_name">Nama Toko</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                            <input type="hidden" name="id_setting" value="<?= $setting['id_setting'] ?>">
                                <input type="text" id="shop_name" name="shop_name" class="form-control mb-2" value="<?= $setting['shop_name'] ?>" autocomplete="off">
                                <?= form_error('shop_name', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label for="shop_owner">Pemilik</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" id="shop_owner" name="shop_owner" class="form-control mb-2" value="<?= $setting['shop_owner'] ?>" autocomplete="off">
                                <?= form_error('shop_owner', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label for="telp">No Telp.</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" id="telp" name="telp" class="form-control mb-2" value="<?= $setting['telp'] ?>" autocomplete="off"> 
                                <?= form_error('telp', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label for="address">Alamat</label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <input type="text" id="address" name="address" class="form-control mb-2" value="<?= $setting['address'] ?>" autocomplete="off">
                                <?= form_error('address', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label for="initials_invoice">Inisial Struk</label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <input inlength="2" maxlength="2" type="text" id="initials_invoice" name="initials_invoice" class="form-control mb-2" value="<?= $setting['initials_invoice'] ?>" autocomplete="off">
                                <?= form_error('initials_invoice', '<small style="color:red"">', '</small>') ?>
                            </div>
                            <div class="col-xs-12 col-md-7">
                                <p title="EP: inisial Struk (Harus 2 huruf); 200719: tanggal (tahun, bulan, tanggal); 0001: Counter harian">Hasil = <span class="text-primary"><?= $setting['initials_invoice'] ?></span><span class="text-danger"><?= date('ymd') ?></span><span class="text-success">0001</span></p>
                            </div>
                            <div class="col-xs-12 col-md-12">
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-send"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script>    
$(function() {
    $('#initials_invoice').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });
});
</script>