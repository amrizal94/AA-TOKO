<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ubah Kategori
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('category'); ?>"><i class="fa fa-cubes"></i> Data Kategori</a></li>
    <li class="noselect">Ubah Kategori</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= base_url('category'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="shadow-sm">
                    <form action="<?= base_url('category/edit/'.$category['id_category']); ?>" method="post">
                      <div class="form-group ">
                          <label for="fullname">Nama Kategori<sup>*</sup></label>
                          <input type="hidden" name="id_category" value="<?= $category['id_category'] ?>">  
                          <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $category['name']; ?>">
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