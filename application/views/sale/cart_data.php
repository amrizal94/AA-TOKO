<?php 
$n=1; 
if($cart->num_rows() > 0):
    foreach($cart->result_array() as $row) : ?>
    <tr>
        <td><?= $n++; ?></td>
        <td class="barcode"><?= $row['barcode']; ?></td>
        <td><?= $row['name_item']; ?></td>
        <td class="text-right"><?= rupiah($row['price_cart']); ?></td>
        <td class="text-right"><?= $row['qty']; ?></td>
        <td class="text-right"><?= rupiah($row['discount_item']); ?></td>
        <td class="text-right" id="total"><b><?= rupiah($row['total']); ?></b></td>
        <td class="text-center" width="100px">  
            <button id="update_cart" data-toggle="modal" data-target="#modal-editcart" class="btn btn-primary btn-xs btn-flat"
                    data-id_cart2 = "<?= $row['id_cart'] ?>"
                    data-barcode2 = "<?= $row['barcode'] ?>"
                    data-name_item2 = "<?= $row['name_item'] ?>"
                    data-price2 = "<?= $row['price'] ?>"
                    data-stock2 = "<?= $row['stock'] ?>"
                    data-qty2 = "<?= $row['qty'] ?>"
                    data-discount_item2 = "<?= $row['discount_item'] ?>"
                    data-total2 = "<?= $row['total'] ?>"
                    >
            <i class="fa fa-pencil"></i>
            </button>

            <button id="del_cart" data-id_cart="<?= $row['id_cart'] ?>" class="btn btn-danger btn-xs btn-flat">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
    <?php endforeach; ?>

<?php else: ?>
<tr>
    <td colspan="9" class="text-center">Data barang belum ada</td>
</tr>
<?php endif; ?>