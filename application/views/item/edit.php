<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Barang
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('item'); ?>"><i class="fa fa-cubes"></i> Data Barang</a></li>
    <li class="noselect">edit Barang</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= base_url('item'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="shadow-sm">
                  <?= form_open_multipart('item/edit/'. $item['id_item']) ?>
                      <div class="form-group row">
                        <div class="col-xs-12 col-md-7">
                          <label for="barcode">Barcode<sup>*</sup></label>
                          <input type="hidden" name="id_item" value="<?= $item['id_item'] ?>"> 
                            <input type="hidden" name="nama-gambar" value="<?= $item['image']; ?>">
                          <input type="text" id="barcode" name="barcode" class="form-control" value="<?= $item['barcode']; ?>" readonly>
                          <?= form_error('barcode', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-md-5">
                          <label for="image">Foto</label>
                          <img class="img-thumbnail" src="<?= base_url('assets/image/barang/').$item['image']; ?>" alt="">
                          <input type="file" name="image" id="image" class="form-control">
                          <?php if($item['image']): ?>
                          <div class="alert alert-warning py-2 m-0 alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              Kosongkan jika tidak ingin diganti
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-12 col-md-9">
                          <label for="fullname">Nama barang<sup>*</sup></label>
                          <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $item['name']; ?>">
                          <?= form_error('fullname', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-md-3">
                          <label for="price">Harga<sup>*</sup></label>
                          <input type="number" id="price" name="price" class="form-control" value="<?= $item['price']; ?>">
                          <?= form_error('price', '<small style="color:red"">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                      <div class="col-xs-12 col-md-6">
                        <label for="category">Kategori<sup>*</sup></label>
                          <select name="category" id="category" class="form-control">
                            <option value="">-Pilih Kategori-</option>
                            <?php foreach($category as $row) : ?>
                              <option value="<?= $row['id_category'] ?>"  <?= $item['id_category'] == $row['id_category'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        <?= form_error('category', '<small style="color:red"">', '</small>') ?>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <label for="unit">Kategory<sup>*</sup></label>
                          <select name="unit" id="unit" class="form-control">
                            <option value="">-Pilih Satuan-</option>
                            <?php foreach($unit as $row) : ?>
                              <option value="<?= $row['id_unit'] ?>" <?= $item['id_unit'] == $row['id_unit'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        <?= form_error('unit', '<small style="color:red"">', '</small>') ?>
                      </div>
                         
                      </div>
                      

                      <div class="form-group row">
                        <div class="col-xs-12 col-md-3 pull-right">
                            <button type="submit" class="btn btn-success btn-block form-control">Edit</button>
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