<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('user'); ?>"><i class="fa fa-user"></i> Data Pengguna</a></li>
    <li class="noselect">Edit Pengguna</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <a href="<?= base_url('user'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="shadow-sm">
                    <form action="<?= base_url('user/edit/').$user['id_user']; ?>" method="post">
                      <div class="form-group">
                        <label for="fullname">Nama<sup>*</sup></label>
                        <input type="hidden" value="<?= $user['id_user'] ?>" name="id_user">
                        <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $user['name']; ?>">
                        <?= form_error('fullname', '<small style="color:red"">', '</small>') ?>
                      </div>
                      <div class="form-group">
                        <label for="username">Username<sup>*</sup></label>
                        <input type="text" id="username" name="username" class="form-control" value="<?= $user['username']; ?>">
                        <?= form_error('username', '<small style="color:red"">', '</small>') ?>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-6">
                          <label for="password">Password <sup>(Tidak wajib)</sup></label>
                          <input type="password" id="password" name="password" class="form-control">
                          <?= form_error('password', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-6">
                          <label for="password2">Ulangi Password<sup>*</sup></label>
                          <input type="password" id="password2" name="password2" class="form-control">
                          <?= form_error('password2', '<small style="color:red"">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="address">Alamat<sup>*</sup></label>
                        <textarea name="address" id="address" cols="30" rows="5" class="form-control" ><?= $user['address']; ?></textarea>
                        <?= form_error('address', '<small style="color:red"">', '</small>') ?>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-12 col-lg-4">
                          <label for="">Jenis Kelamin<sup>*</sup></label> <br>
                          <label class="radio-inline">
                            <input type="radio" name="sex" id="inlineRadio1" value="L" <?php if($user['sex'] == 'L' ) echo'checked' ?>> Laki-laki
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="sex" id="inlineRadio2" value="P" <?php if($user['sex'] == 'P' ) echo'checked' ?>> Perempuan
                          </label>
                          <br>
                        <?= form_error('sex', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                          <label for="level">Level<sup>*</sup></label>
                          <select name="level" id="level" class="form-control">
                            <option value="">Pilih</option>
                            <option value="1" <?php if($user['level'] == '1' ) echo 'selected' ?>>Admin</option>
                            <option value="2" <?php if($user['level'] =='2' ) echo 'selected' ?>>Kasir</option>
                          </select>
                        <?= form_error('level', '<small style="color:red"">', '</small>') ?>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                          <!-- <label for="" style="color:#fff">-</label> -->
                          <button type="submit" class="btn btn-success btn-block form-control">Ubah</button>
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