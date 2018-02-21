<?php
include '../class/connect.php';
$judul = 'Menu';
$dir = '../uploads/';
$cari = "";
if(!empty(filter_input(1,"submit"))){
    $cari = "WHERE MenuNama like'%".filter_input(1,"cari")."%' ";
}
if(!empty(filter_input(1,"hapus"))){
    $q = $pdo->prepare("SELECT MenuGambar,MenuUnggulan FROM menu WHERE MenuID='".filter_input(1,"hapus")."' LIMIT 0,1");
    $q->execute();
    $d = $q->fetch();
    unlink($dir.$d['MenuGambar']);
    unlink($dir.str_replace('.','_Thumb.',$d['MenuGambar']));
    if($d['MenuUnggulan']==1){
        unlink($dir.str_replace('.','_Unggulan.',$d['MenuGambar']));
    }
    $qhapus = $pdo->prepare("DELETE FROM menu WHERE MenuID='".filter_input(1,"hapus")."'");
    $qhapus->execute();
    header('location:view'.$judul.'.php?suksesHapus=1');
}
$q = $pdo->prepare("SELECT * FROM menu ".$cari." ORDER BY MenuNama DESC");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View <?php echo $judul; ?></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <header>
                <?php include 'nav.php'; ?>
            </header>
            <main>
                <div class="row">
                    <div class="col-sm-6"><a href="form<?php echo $judul; ?>.php" class="btn btn-primary">Input <?php echo $judul; ?> Baru</a></div>
                    <div class="col-sm-6">
                        <form action="" method="GET" class="form-inline right">
                            <input name="cari" size="30" placeholder="isiin kata kunci bro" value="<?php echo filter_input(1,"cari"); ?>"><input type="submit" value="cari" name="submit">
                        </form>
                    </div>
                </div>
                <?php
                if(!empty(filter_input(1,"sukses"))){
                ?>
                <div class="label-success"><?php echo $judul; ?> Berhasil Diinput boss!!</div>
                <?php } else if(!empty(filter_input(1,"sukses"))){
                ?>
                <div class="label-success"><?php echo $judul; ?> Berhasil Diedit boss!!</div>
                <?php } ?>
                
                <table class="table-responsive table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Diskripsi</th>
                        <th>Gambar</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $q->execute();
                    while ($d = $q->fetch()){
                    ?>
                    <tr>
                        <td><?php echo $d['MenuNama']; ?></td>
                        <td><?php echo $d['MenuHarga']; ?></td>
                        <td><?php echo $d['MenuKategori']; ?></td>
                        <td><?php echo $d['MenuDiskripsi']; ?></td>
                        <td><?php if(!empty($d['MenuGambar'])){ ?><img src="<?php echo $dir.str_replace(".","_Thumb.",$d['MenuGambar']); ?>" alt="<?php echo $d['MenuNama']; ?>" style="width:100px;"><?php } ?></td>
                        <td><a href="form<?php echo $judul; ?>.php?edit=<?php echo $d['MenuID'];?>" class="glyphicon glyphicon-edit"></a></td>
                        <td><a href="view<?php echo $judul; ?>.php?hapus=<?php echo $d['MenuID'];?>" class="glyphicon glyphicon-erase"></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </main>
            <footer>
                copyright 2017
            </footer>
        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>