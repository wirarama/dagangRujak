<table class="table-responsive table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Menu</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Sub Total</th>
    </tr>
    </thead>
    <tbody>
<?php
$qmember = $pdo->prepare("SELECT MemberID FROM member "
. "WHERE MemberNama='".filter_input(2,"loginMember")."'");
$qmember->execute();
$dmember = $qmember->fetch();
$qkeranjang = $pdo->query("SELECT menu.MenuNama,menu.MenuHarga,item.jumlah FROM item,keranjang,menu "
. "WHERE keranjang.member='".$dmember['MemberID']."' "
. "AND keranjang.status='lagiBelanja' "
. "AND keranjang.ID=item.keranjang AND item.item=menu.MenuID");
$qkeranjang->execute();
$total = 0;
$totalHarga = 0;
while($dkeranjang = $qkeranjang->fetch()){
    $subtotal = $dkeranjang['MenuHarga']*$dkeranjang['jumlah'];
    ?>
    <tr>
        <td><?php echo $dkeranjang['MenuNama']; ?></td>
        <td class="right">Rp. <?php echo number_format($dkeranjang['MenuHarga'],2,',','.'); ?></td>
        <td class="right"><?php echo $dkeranjang['jumlah']; ?></td>
        <td class="right">Rp. <?php echo number_format($subtotal,2,',','.'); ?></td>
    </tr>
    <?php
    $total += $dkeranjang['jumlah'];
    $totalHarga += $subtotal;
}
?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td class="right"><?php echo $total; ?></td>
            <td class="right">Rp. <?php echo number_format($totalHarga,2,',','.'); ?></td>
        </tr>
    </tfoot>
</table>