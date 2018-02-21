<?php
include '../class/connect.php';
include '../class/form.php';
include '../class/resizeImg.php';
$judul = 'upload file';
//echo getcwd();
if(!empty(filter_input(0,"submit"))){
    $total = count($_FILES['file']['name']);
    $img = new imageEdit();
    for($i=0;$i<$total;$i++){
        $file = basename($_FILES['file']['name'][$i],$img->imgRename($_FILES['file']['name'][$i]));
        move_uploaded_file($_FILES['file']["tmp_name"][$i],$dir.$file) or die("upload gagal cuk");
        $img->imgResize($dir.$file,$dir.$img->imgThumb($file),500,500);
    }
    header('location:uploadFile.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>File Upload</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Input User</h1>
                <?php include 'nav.php'; ?>
            </header>
            <main>
                <form action="" method="POST" id="userForm" class="form-horizontal" enctype="multipart/form-data">
                    <?php
                    $form = new form();
                    $form->formInput("filename","text","File Name",40,5,true);
                    $form->formFile("file","File",true);
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
            $("#uploadForm").validate();
        </script>
    </body>
</html>
