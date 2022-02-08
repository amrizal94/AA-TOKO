<html mozNoMarginBoxes mozDisallowSelectionPrint>
<head>
    <title>Toko Meong - Print Nota</title>

    <style typa="text/css">
        html{ font-family : "verdana, arial"; }
        .content{
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }
        .title{
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }
        .head{
            margin-top: 5px;
            margin-bottom: 5px;
            padding-bottom: 10px;
            border-bottom: 1px dashed;
        }
        table{
            width: 100%;
            font-size: 12px;
        }
        .thanks{
            padding-top: 10px;
            font-size: 11px;
            text-align: center;
            border-top: 1px dashed;
        }
        @media print{
            @page{
                width: 80mm;
                margin: 0mm;
            }
        }
        table tr td{
            vertical-align: text-top;
        }
    </style>
</head>
<body onload="print()">
    <div class="content">
        <div class="title">
            <b><?= $setting_shop['shop_name'] ?></b>
            <br>
            <small><?= $setting_shop['address'] ?></small><br>
            <small>Telp. <?= $setting_shop['telp'] ?></small>
        </div>
        

        <div class="head">
            <table cellspacong="0" cellpadding="0">
                <tr>
                    <td style="width:120px">
                        <?php 
                        echo date('d/m/Y', strtotime($sale->date)). " ". date("H:i", strtotime($sale->sale_created));
                        ?>
                    </td>
                    <td>Kasir</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right">
                        <?= ucfirst($sale->user_name) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $sale->invoice ?>
                    </td>
                    <td>Pelanggan</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right">
                        <?= $sale->id_customer == null? "Umum" : ucfirst($sale->customer_name) ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacong="0" cellpadding="0">
                <tr>
                    <td style="min-width: 130px">Brg</td>
                    <td>Jml</td>
                    <td style="text-align:right;">Brg
                    <?php 
                     if($disc_jml == "ada"){
                        echo "<br><small>disc brg</small>";
                     }
                    ?>
                    </td>
                    <td style="text-align:right;">Total</td>
                </tr>
               
                <tr>
                    <td colspan="4" style="border-bottom:1px dashed; padding-top:5px;"></td>
                </tr>
                <?php 
                    foreach ($sale_detail as $key => $value) {
                    ?>
                        <tr>
                            <td ><?= $value->name ?></td>
                            <td style="text-align:right;"> 
                            <?= $value->qty ?>
                            </td>
                            <td style="text-align:right;">
                            <?php echo rupiah($value->price) . "<br>";
                                if($value->discount_item > 0){
                                    echo "<small>" . rupiah($value->discount_item) . "</small>";
                                }
                            
                            ?>
                            
                            </td>
                            <td style="text-align:right; width:60px"><?= rupiah(($value->price - $value->discount_item) * $value->qty) ?></td>
                        </tr>

                        <?php 
                        
                    }

                    ?>


                    <?php if($disc_jml == "tidak ada" && $sale->discount != 0) :?>


                    <?php endif; ?>

                    <?php if($sale->discount > 0) { ?>
                        
                        <tr>
                            <td colspan="4" style="border-bottom:1px dashed; padding-top:5px;"></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:right;padding-top:5px;">Total Harga</td>
                            <td style="text-align:right;padding-top:5px;"><?= rupiah($sale->total_price) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:right;padding:5px 0;">Diskon Pembelian</td>
                            <td style="text-align:right;padding:5px 0;"><?= rupiah($sale->discount) ?></td>
                        </tr>
                        <?php 
                    } ?>
                    <tr>
                        <td colspan="3" style="border-top:1px dashed; text-align:right; padding: 5px 0"><b>Total Bayar</b></td>
                        <td style="border-top:1px dashed; text-align:right; padding: 5px 0"><b><?= rupiah($sale->final_price) ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="border-top:1px dashed; text-align:right; padding: 5px 0">Tunai</td>
                        <td style="border-top:1px dashed; text-align:right; padding: 5px 0"><?= rupiah($sale->cash) ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:right;">Kembalian</td>
                        <td style="text-align:right;"><?= rupiah($sale->remaining) ?></td>
                    </tr>
            </table>
        </div>
        <div class="thanks">
            <b>Terima Kasih, Selamat belanja kembali.</b>
        </div>
    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script>
    function print(){
    let doc = new jsPDF('p','pt','a4');
    doc.addHTML(document.body,function() {
    doc.save(Date.now()+'.pdf');});
};
</script>