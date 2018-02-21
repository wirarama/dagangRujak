<?php
include '../class/connect.php';
include '../class/form.php';
include '../class/resizeImg.php';
$judul = 'Konten';
if(!empty(filter_input(0,"edit"))){
    $ubahGambar = "";
    if(!empty($_FILES["file"]["tmp_name"])){
        $q = $pdo->prepare("SELECT KontenGambar FROM konten WHERE KontenID='".filter_input(0,'edit')."' LIMIT 0,1");
        $q->execute();
        $d = $q->fetch();
        unlink($dir.$d['KontenGambar']);
        unlink($dir.str_replace('.','_Thumb.',$d['KontenGambar']));
        $img = new imageEdit();
        $file = $img->imgRename($_FILES["file"]["tmp_name"],'Konten_'.filter_input(0,"KontenNama"));
        move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$file) or die("upload gagal cuk");
        $img->imgResize($dir.$file,$dir.$img->imgThumb($file),500,500);
        $ubahGambar = "KontenGambar='".$file."',";
    }
    $q = $pdo->prepare("UPDATE konten SET "
                . "KontenNama='".filter_input(0,"KontenNama")."',"
                .$ubahGambar
                . "KontenDiskripsi='".filter_input(0,"KontenDiskripsi")."'"
                . " WHERE KontenID='".filter_input(0,"edit")."'");
    $q->execute();
    header('location:viewKonten.php?suksesedit=1');
}
else if(!empty(filter_input(0,"submit"))){
    $img = new imageEdit();
    $file = $img->imgRename($_FILES["file"]["tmp_name"],'Konten_'.filter_input(0,"KontenNama"));
    move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$file) or die("upload gagal cuk");
    $img->imgResize($dir.$file,$dir.$img->imgThumb($file),500,500);
    $q = $pdo->prepare("INSERT INTO konten "
                . "(KontenNama,KontenGambar,KontenDiskripsi) "
                . "VALUES("
                . "'".filter_input(0,"KontenNama")."',"
                . "'".$file."',"
                . "'".filter_input(0,"KontenDiskripsi")."'"
                . ")");
    $q->execute();
    header('location:viewKonten.php?sukses=1');
}
if(!empty(filter_input(1,'edit'))){
    $q = $pdo->prepare("SELECT * FROM konten WHERE KontenID='".filter_input(1,'edit')."' LIMIT 0,1");
    $q->execute();
    $d = $q->fetch();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Input <?php echo $judul; ?></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <header>
                <?php include 'nav.php'; ?>
            </header>
            <main>
                <form action="" method="POST" id="kontenForm" class="form-horizontal" enctype="multipart/form-data">
                    <?php
                    if(empty($d['KontenNama'])){ $d['KontenNama']="";}
                    if(empty($d['KontenDiskripsi'])){ $d['KontenDiskripsi']="";}
                    $form = new form();
                    $form->formInput("KontenNama","text","Nama Konten",60,4,true,$d['KontenNama']);
                    $form->formFile("file","Gambar Konten");
                    $form->formArea("KontenDiskripsi","Diskripsi",40,5,null,$d['KontenDiskripsi']);
                    if(!empty(filter_input(1,'edit'))){ $form->formHidden("edit",filter_input(1,'edit')); }
                    $form->formSubmit("submit","Kirim");
                    ?>
                </form>
            </main>
            <footer>
                copyright 2017
            </footer>
        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.validate.min.js"></script>
        <script>
            $("#userForm").validate();
        </script>
    </body>
</html>