<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ubah Unit
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('unit'); ?>"><i class="fa fa-th"></i> Data Unit</a></li>
    <li class="noselect">Ubah Unit</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= base_url('unit'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="shadow-sm">
                    <form action="<?= base_url('unit/edit/'.$unit['id_unit']); ?>" method="post">
                      <div class="form-group ">
                          <label for="fullname">Nama Unit<sup>*</sup></label>
                          <input type="hidden" name="id_unit" value="<?= $unit['id_unit'] ?>">  
                          <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $unit['name']; ?>">
                          <?= form_error('fullname', '<small style="color:red"">', '</small>') ?>
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