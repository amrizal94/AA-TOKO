<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Pemasok
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('supplier'); ?>"><i class="fa fa-users"></i> Data Pemasok</a></li>
    <li class="noselect">Edit Pemasok</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= base_url('supplier'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="shadow-sm">
                    <form action="<?= base_url('supplier/edit/'.$supplier['id_supplier']); ?>" method="post">
                      <div class="form-group row">
                        <div class="col-xs-12 col-md-7">
                            <label for="fullname">Nama<sup>*</sup></label>
                            <input type="hidden" name="id_supplier" value="<?= $supplier['id_supplier'] ?>">
                            <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $supplier['name']; ?>">
                            <?= form_error('fullname', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-md-5">
                            <label for="phone">No Telepon<sup>*</sup></label>
                            <input type="number" id="phone" name="phone" class="form-control" value="<?= $supplier['phone']; ?>">
                            <?= form_error('phone', '<small style="color:red"">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-12 col-md-6">
                            <label for="address">Alamat<sup>*</sup></label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control" ><?= $supplier['address']; ?></textarea>
                            <?= form_error('address', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" ><?= $supplier['description']; ?></textarea>
                            <?= form_error('description', '<small style="color:red"">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-12 col-md-3 pull-right">
                            <button type="submit" class="btn btn-success btn-block form-control">Ubah</button>
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