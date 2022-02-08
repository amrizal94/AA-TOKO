<html mozNoMarginBoxes mozDisallowSelectionPrint>
<head>
    <title>Laporan Penjualan</title>
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
        #tb1 th{
            background-color: #ddd;
            padding: 3px 5px;
            font-size: 14px;
        }
        #tb1 td{
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
        <td class="tgl">Tanggal Cetak : <?= date('d-m-Y') ?></td>
    </tr>
    <?php if ($pelanggan) { ?>
    <tr>
        <td class="lap">Pelanggan : <?= $pelanggan ?></td>
    </tr>
    <?php } ?>
</table>

<table border="1" cellpading="0" cellspacing="0" id="tb1">
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice</th>
            <th>Tanggal</th>
            <th style="text-align:left">Pelanggan</th>
            <th style="text-align:right">Total Harga</th>
            <th style="text-align:right">Diskon</th>
            <th>Catatan</th>
            <th style="text-align:right">Total Bayar</th>
        </tr>
    </thead>
    <tbody>
       <?php $i=1; $jumlah=0 ;foreach($report as $row) :  $jumlah += $row['final_price'];?>
        <tr>
            <th><?= $i++ ?></th>
            <td><?= $row['invoice'] ?></td>
            <td><i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($row['date'])); ?></td>
            <td style="text-align:left"><?= $row['customer_name'] == null ? 'Umum' :  $row['customer_name']?></td>
            <td style="text-align:right"><?= rupiah($row['total_price']) ?></td>
            <td style="text-align:right"><?= rupiah($row['discount']) ?></td>
            <td style="text-align:left"><?= $row['note'] ?></td>
            <td style="text-align:right"><?= rupiah($row['final_price']) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="7"> TOTAL </th>
            <th style="text-align:right"><?= rupiah($jumlah) ?></th>
        </tr>
    </tbody>
</table>
</body>
</html>