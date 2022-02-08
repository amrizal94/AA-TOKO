<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah Pelanggan
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('customer'); ?>"><i class="fa fa-users"></i> Data Pelanggan</a></li>
    <li class="noselect">Tambah Pelanggan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= base_url('customer'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="shadow-sm">
                    <form action="<?= base_url('customer/tambah'); ?>" method="post">
                      <div class="form-group row">
                        <div class="col-xs-12 col-md-7">
                            <label for="fullname">Nama<sup>*</sup></label>
                            <input type="text" id="fullname" name="fullname" class="form-control" value="<?= set_value('fullname'); ?>">
                            <?= form_error('fullname', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-md-5">
                            <label for="phone">No Telepon<sup>*</sup></label>
                            <input type="number" id="phone" name="phone" class="form-control" value="<?= set_value('phone'); ?>">
                            <?= form_error('phone', '<small style="color:red"">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-12 col-md-6">
                        <label for="">Jenis Kelamin<sup>*</sup></label> <br>
                          <label class="radio-inline">
                            <input type="radio" name="sex" id="inlineRadio1" value="L" <?php if(set_value('sex') == 'L' ) echo'checked' ?>> Laki-laki
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="sex" id="inlineRadio2" value="P" <?php if(set_value('sex') == 'P' ) echo'checked' ?>> Perempuan
                          </label>
                          <br>
                        <?= form_error('sex', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control" ><?= set_value('address'); ?></textarea>
                            <?= form_error('address', '<small style="color:red"">', '</small>') ?>
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