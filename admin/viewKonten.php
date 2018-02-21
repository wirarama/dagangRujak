<?php
include '../class/connect.php';
$judul = 'Konten';
$cari = "";
if(!empty(filter_input(1,"submit"))){
    $cari = "WHERE KontenNama like'%".filter_input(1,"cari")."%' ";
}
if(!empty(filter_input(1,"hapus"))){
    $q = $pdo->prepare("SELECT KontenGambar FROM konten WHERE KontenID='".filter_input(1,"hapus")."' LIMIT 0,1");
    $q->execute();
    $d = $q->fetch();
    unlink($dir.$d['KontenGambar']);
    unlink($dir.str_replace('.','_Thumb.',$d['KontenGambar']));
    $qhapus = $pdo->prepare("DELETE FROM konten WHERE KontenID='".filter_input(1,"hapus")."'");
    $qhapus->execute();
    header('location:view'.$judul.'.php?suksesHapus=1');
}
$q = $pdo->prepare("SELECT * FROM konten ".$cari." ORDER BY KontenNama DESC");
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
                        <td><?php echo $d['KontenNama']; ?></td>
                        <td><?php echo $d['KontenDiskripsi']; ?></td>
                        <td><?php if(!empty($d['KontenGambar'])){ ?><img src="<?php echo $dir.str_replace(".","_Thumb.",$d['KontenGambar']); ?>" alt="<?php echo $d['KontenNama']; ?>" style="width:100px;"><?php } ?></td>
                        <td><a href="form<?php echo $judul; ?>.php?edit=<?php echo $d['KontenID'];?>" class="glyphicon glyphicon-edit"></a></td>
                        <td><a href="view<?php echo $judul; ?>.php?hapus=<?php echo $d['KontenID'];?>" class="glyphicon glyphicon-erase"></a></td>
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