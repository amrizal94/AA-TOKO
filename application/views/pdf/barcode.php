<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode <?= $item['barcode'] ?></title>
     <style>
        *{
            margin:0;
            padding:0;
        }
        .qr{
            margin: 0.1cm 0 0 0.1cm;
        }
        p{
            font-size:14px;
        }
        table td{
            padding-right: 25px;
        }
        .qr{
            padding-bottom: 7px;
        }
    </style>
</head>
<body>
<table>
    <?php for ($ii=0; $ii <10 ; $ii++) { ?>
    <tr>
        <?php for ($i=0; $i <6 ; $i++) { ?>
            <td>
                <div class="qr">
                    <?php 
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($item['barcode'], $generator::TYPE_CODE_128)) . '">';
                    ?>
                <p align="center"><?= $item['barcode']. "  " . $item['name']?><br><?= rupiah($item['price']) ?></p>
                </div>
            </td>
        <?php } ?>
    </tr>
    <?php } ?>
</table>
</body>
</html>