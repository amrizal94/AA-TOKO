<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    BarCode QrCode Barang
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('item'); ?>"><i class="fa fa-cubes"></i> Data Barang</a></li>
    <li class="noselect">BarCode QrCode</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        BarCode Generator <i class="fa fa-barcode"></i>
                    </h3>
                    <a href="<?= base_url('item'); ?>" class="btn btn-primary pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                    <?php 
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($item['barcode'], $generator::TYPE_CODE_128)) . '">';
                    ?>
                    <p><?= $item['barcode'] ?></p> 
                    <a target="_blank" href="<?= base_url('item/barcode_print/'.$item['id_item']); ?>" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        QRCode Generator <i class="fa fa-qrcode"></i>
                    </h3>
                </div>
                <div class="box-body">
                    <?php 
                    $qrCode = new Endroid\QrCode\QrCode($item['barcode']);
                    $qrCode->writeFile('assets/image/qrcode/'.$item['barcode'].'.png');
                    ?>
                    <img class="image-fluid" style="max-width:130px;" src="<?= base_url('assets/image/qrcode/'.$item['barcode'].'.png'); ?>" alt="">
                    <p><?= $item['barcode'] ?></p> 
                    <a target="_blank" href="<?= base_url('item/qrcode_print/'.$item['id_item']); ?>" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- /.content -->