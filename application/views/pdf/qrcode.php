<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QrCode <?= $item['barcode'] ?></title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        .qr{
            margin: 0.5cm 0 0 0.1cm;
        }
        p{
            font-size:14px;
        }
    </style>
</head>
<body>
    <table>
        <?php for ($ii=0; $ii < 5; $ii++) { ?>
        <tr>
            <?php for ($i=0; $i < 5; $i++) { ?>
                <td>
                    <div class="qr">
                        <img style="max-width:4cm;" src="assets/image/qrcode/<?= $item['barcode'] ?>.png">
                        <p align="center"><?= $item['barcode']. " " . $item['name']?><br><?= rupiah($item['price']) ?></p>
                    </div>
                </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
    
</body>
</html>