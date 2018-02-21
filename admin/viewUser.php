<?php
include '../class/connect.php';
$judul = 'Admin';
$cari = "";
if(!empty(filter_input(1,"submit"))){
    $cari = "WHERE alamat like'%".filter_input(1,"cari")."%' "
            . "OR username like'%".filter_input(1,"cari")."%' "
            . "OR email like'%".filter_input(1,"cari")."%'";
}
if(!empty(filter_input(1,"hapus"))){
    $qhapus = $pdo->prepare("DELETE FROM user WHERE id='".filter_input(1,"hapus")."'");
    $qhapus->execute();
}
$q = $pdo->prepare("SELECT * FROM user ".$cari." ORDER BY username DESC");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Admin</title>
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
                    <div class="col-sm-6"><a href="formAdmin.php" class="btn btn-primary">Input Admin Baru</a></div>
                    <div class="col-sm-6">
                        <form action="" method="GET" class="form-inline right">
                            <input name="cari" size="30" placeholder="isiin kata kunci bro" value="<?php echo filter_input(1,"cari"); ?>"><input type="submit" value="cari" name="submit">
                        </form>
                    </div>
                </div>
                <?php
                if(!empty(filter_input(1,"sukses"))){
                ?>
                <div class="label-success">Admin Berhasil Diinput boss!!</div>
                <?php } else if(!empty(filter_input(1,"sukses"))){
                ?>
                <div class="label-success">Admin Berhasil Diedit boss!!</div>
                <?php } ?>
                
                <table class="table-responsive table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>E-mail</th>
                        <th>Hobi</th>
                        <th>Makanan</th>
                        <th>Status</th>
                        <th>Profile</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $q->execute();
                    while ($d = $q->fetch()){
                    ?>
                    <tr>
                        <td><?php echo $d['username']; ?></td>
                        <td><a href="mailto:<?php echo $d['email']; ?>"><?php echo $d['email']; ?></a></td>
                        <td><?php echo $d['hobi']; ?></td>
                        <td><?php echo $d['makanan']; ?></td>
                        <td><?php echo $d['status']; ?></td>
                        <td><?php echo $d['profil']; ?></td>
                        <td><a href="formAdmin.php?edit=<?php echo $d['id'];?>" class="glyphicon glyphicon-edit"></a></td>
                        <td><a href="viewAdmin.php?hapus=<?php echo $d['id'];?>" class="glyphicon glyphicon-erase"></a></td>
                        <!--<td><input type="checkbox" value="<?php echo $d['id']; ?>" name="hapusMassal[]"></td>-->
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