<?php
include '../class/connect.php';
include '../class/form.php';
include '../class/resizeImg.php';
$judul = 'Menu';
if(!empty(filter_input(0,"edit"))){
    $ubahGambar = "";
    if(!empty($_FILES["file"]["tmp_name"])){
        $q = $pdo->prepare("SELECT MenuGambar,MenuUnggulan FROM menu WHERE MenuID='".filter_input(0,'edit')."' LIMIT 0,1");
        $q->execute();
        $d = $q->fetch();
        unlink($dir.$d['MenuGambar']);
        unlink($dir.str_replace('.','_Thumb.',$d['MenuGambar']));
        if($d['MenuUnggulan']==1){
            unlink($dir.str_replace('.','_Unggulan.',$d['MenuGambar']));
        }
        $img = new imageEdit();
        $file = $img->imgRename($_FILES["file"]["tmp_name"],filter_input(0,"MenuNama"));
        move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$file) or die("upload gagal cuk");
        $img->imgResize($dir.$file,$dir.$img->imgThumb($file),500,500);
        $ubahGambar = "MenuGambar='".$file."',";
    }
    $q = $pdo->prepare("UPDATE menu SET "
                . "MenuNama='".filter_input(0,"MenuNama")."',"
                .$ubahGambar
                . "MenuHarga='".filter_input(0,"MenuHarga")."',"
                . "MenuKategori='".filter_input(0,"MenuKategori")."',"
                . "MenuDiskripsi='".filter_input(0,"MenuDiskripsi")."',"
                . "MenuUser='".filter_input(2,"login")."'"
                . " WHERE MenuID='".filter_input(0,"edit")."'");
    $q->execute();
    if(!empty(filter_input(0,'MenuUnggulan'))){
        $q = $pdo->prepare("SELECT MenuGambar FROM menu WHERE MenuID='".filter_input(0,'edit')."' LIMIT 0,1");
        $q->execute();
        $d = $q->fetch();
        $img = new imageEdit();
        $img->imgResize($dir.$d['MenuGambar'],$dir.str_replace('.','_Unggulan.',$d['MenuGambar']),800,300);
        $q1 = $pdo->prepare("UPDATE menu SET "
                . "MenuUnggulan='".filter_input(0,"MenuUnggulan")."'"
                . " WHERE MenuID='".filter_input(0,"edit")."'");
        $q1->execute();
    }
    header('location:viewMenu.php?suksesedit=1');
}
else if(!empty(filter_input(0,"submit"))){
    $img = new imageEdit();
    $file = $img->imgRename($_FILES["file"]["tmp_name"],filter_input(0,"MenuNama"));
    move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$file) or die("upload gagal cuk");
    $img->imgResize($dir.$file,$dir.$img->imgThumb($file),500,500);
    $menuUnggul1 = "";
    $menuUnggul2 = "";
    if(!empty(filter_input(0,'MenuUnggulan'))){
        $img->imgResize($dir.$file,$dir.str_replace('.','_Unggulan.',$file),800,300);
        $menuUnggul1 = ",MenuUnggulan";
        $menuUnggul2 = ",'".filter_input(0,"MenuUnggulan")."'";
    }
    $q = $pdo->prepare("INSERT INTO menu "
                . "(MenuNama,MenuHarga,MenuGambar,MenuUser,MenuDiskripsi,MenuKategori".$menuUnggul1.") "
                . "VALUES("
                . "'".filter_input(0,"MenuNama")."',"
                . "'".filter_input(0,"MenuHarga")."',"
                . "'".$file."',"
                . "'".filter_input(2,"login")."',"
                . "'".filter_input(0,"MenuDiskripsi")."',"
                . "'".filter_input(0,"MenuKategori")."'"
                . $menuUnggul2
                . ")");
    $q->execute();
    header('location:viewMenu.php?sukses=1');
}
if(!empty(filter_input(1,'edit'))){
    $q = $pdo->prepare("SELECT * FROM menu WHERE MenuID='".filter_input(1,'edit')."' LIMIT 0,1");
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
                <form action="" method="POST" id="menuForm" class="form-horizontal" enctype="multipart/form-data">
                    <?php
                    if(empty($d['MenuNama'])){ $d['MenuNama']="";}
                    if(empty($d['MenuHarga'])){ $d['MenuHarga']="";}
                    if(empty($d['MenuKategori'])){ $d['MenuKategori']="";}
                    if(empty($d['MenuDiskripsi'])){ $d['MenuDiskripsi']="";}
                    if(empty($d['MenuUnggulan'])){ $d['MenuUnggulan']="";}
                    $form = new form();
                    $form->formInput("MenuNama","text","Nama Menu",60,4,true,$d['MenuNama']);
                    $form->formInput("MenuHarga","text","Harga Menu",40,4,true,$d['MenuHarga']);
                    $kategori = array('makanan','minuman');
                    $form->formRadio("MenuKategori","Kategori",$kategori,true,$d['MenuKategori']);
                    $form->formFile("file","Gambar Menu");
                    $form->formArea("MenuDiskripsi","Diskripsi",40,5,null,$d['MenuDiskripsi']);
                    $form->formCheckboxSingle('MenuUnggulan','Unggulan',true,null,$d['MenuUnggulan']);
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