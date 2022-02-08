<html mozNoMarginBoxes mozDisallowSelectionPrint>
<head>
    <title>Laporan Stok</title>
    <style>
        html{
            font-family: "Times New Roman", Times, serif;
        }
        *{
            margin: 0;
            padding: 0;
        }
        table{
            width: 100%;
            margin: 10px;
            text-align: center;
        }
        #tb1 th,
        #tb2 th
        {
            background-color: #ddd;
            padding: 3px 5px;
            font-size: 14px;
        }
        #tb1 td,
        #tb2 td
        {
            padding: 3px 5px;
            font-size: 12px;
        }
        .header h1{
            text-align: center;
            margin-top: 10px;
            font-size: 26px;
        }
        .header h5{
            text-align: center;
            font-size: 12px;
        }
        .lap{
            margin-top: 10px;
            font-size: 14px;
            text-decoration: underline;
            text-align: left;
        }
        .tgl{
            font-size: 14px;
            margin-right: 10px;
            text-align: right;
        }
        p{
            font-size: 14px;
       }

    </style>
</head>
<body>
<div class="header">
    <h1><?= $setting['shop_name'] ?></h1>
    <h5><?= $setting['address'] ?><br>
        Telp. <?= $setting['telp'] ?>    
    </h5>
</div>
<table>
    <tr>
        <td class="lap"><?= $lap ?></td>
        <td class="tgl">Tanggal: <?= date('d-m-Y') ?></td>
    </tr>
    <?php if ($pemasok) { ?>
    <tr>
        <td class="lap">pemasok : <?= $pemasok ?></td>
    </tr>
    <?php } ?>
</table>

<?php 
    $cekin = 0;
    $cekout = 0;
    
    foreach($report as $row) {
        if($row['type'] == "in"){
            $cekin++;
        }else{
            $cekout++;
        }
    }
    
    if($cekin > 0 ) :
?>

<p align="center">Data Barang Masuk</p>
<table border="1" cellpading="0" cellspacing="0" id="tb1">
    <thead>
        <tr>
            <th>#</th>
            <th>Tipe</th>
            <th>Tanggal</th>
            <th style="text-align:left">Pengguna</th>
            <th style="text-align:left">Pemasok</th>
            <th style="text-align:left">Detail</th>
            <th style="text-align:left">Nama Barang</th>
            <th style="text-align:right">Harga Beli</th>
            <th style="text-align:right">Sisa Stock</th>
            <th style="text-align:right">Stock Awal</th>
            <th style="text-align:right">Total Harga</th>
            <th style="text-align:left">Catatan</th>
        </tr>
    </thead>
    <tbody>
       <?php $i=1; $jumlah=0; $qty2 = 0; foreach($report as $row) :  $jumlah += $row['total_price'];$qty2 += $row['qty'];?>
       <?php if($row['type'] == 'in'): ?>
        <tr>
            <th><?= $i++ ?></th>
            <td><?= $row['type'] ?></td>
            <td><i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['date'])); ?></td>
            <td style="text-align:left"><?= $row['username'] ?></td>
            <td style="text-align:left"><?= $row['supplier_name'] == null ? 'Tidak ada' :  $row['supplier_name']?></td>
            <td style="text-align:left"><?= $row['detail'] ?></td>
            <td style="text-align:left"><?= $row['item_name'] ?></td>
            <td style="text-align:right"><?= $row['purchase_price'] == 'Rp. 0' ? '0' : rupiah($row['purchase_price']) ?></td>
            <td style="text-align:right"><?= $row['stock'] ?></td>
            <td style="text-align:right"><?= $row['qty'] ?></td>
            <td style="text-align:right"><?= $row['total_price'] == 'Rp. 0' ? '0' : rupiah($row['total_price']) ?></td>
            <td style="text-align:left"><?= $row['note'] ?></td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <th colspan="9"> TOTAL </th>
            <th style="text-align:right"><?= $qty2 ?></th>
            <th style="text-align:right"><?= rupiah($jumlah) ?></th>
            <th></th>
        </tr>
    </tbody>
</table>

<?php 
    endif;
    if($cekout > 0) :
?>
<p align="center">Data Barang Keluar</p>
<table border="1" cellpading="0" cellspacing="0" id="tb2">
    <thead>
        <tr>
            <th>#</th>
            <th>Tipe</th>
            <th>Tanggal</th>
            <th style="text-align:left">Pengguna</th>
            <th style="text-align:left">Detail</th>
            <th style="text-align:left">Nama Barang</th>
            <th style="text-align:right">Stock Keluar</th>
            <th style="text-align:left">Catatan</th>
        </tr>
    </thead>
    <tbody>
       <?php $i=1; $qty3=0; foreach($report as $row) :  $qty3 += $row['qty'];?>
       <?php if($row['type'] == 'out'): ?>
        <tr>
            <th><?= $i++ ?></th>
            <td><?= $row['type'] ?></td>
            <td><i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['date'])); ?></td>
            <td style="text-align:left"><?= $row['username'] ?></td>
            <td style="text-align:left"><?= $row['detail'] ?></td>
            <td style="text-align:left"><?= $row['item_name'] ?></td>
            <td style="text-align:right"><?= $row['qty'] ?></td>
            <td style="text-align:left"><?= $row['note'] ?></td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <th colspan="6"> TOTAL </th>
            <th style="text-align:right"><?= $qty3 ?></th>
            <th></th>
        </tr>
    </tbody>
</table>
<?php endif; ?>
</body>
</html>