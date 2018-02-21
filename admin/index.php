<?php
include '../class/connect.php';
include '../class/form.php';
if(!empty(filter_input(2,"login"))){
    $judul = "Halaman Admin";
}else{
    $judul = "Login dulu bro...";
}
if(!empty(filter_input(0,"submit"))){
    $q = $pdo->query("SELECT username FROM admin "
            . "WHERE username='".filter_input(0,"username")."' "
            . "AND password=MD5('".filter_input(0,"password")."')");
    if($q->rowCount()!=0){
        if(!empty(filter_input(0,"ingat"))){
            $habis = time()+3*24*3600;
        }else{
            $habis = null;
        }
        setcookie("login",filter_input(0,"username"),$habis);
        header("location:index.php");
    }else{
        header("location:index.php?gagal=1");
    }
}else if(!empty(filter_input(1,"logout"))){
    setcookie("login","");
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Informasi Kependudukan Desa</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $judul;?></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php
                if(!empty(filter_input(2,"login"))){ include 'nav.php'; } 
                ?>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <?php
                if(empty(filter_input(2,"login"))){
                ?>
                <form action="" method="POST" id="loginForm">
                    <?php
                    if(!empty(filter_input(1,"gagal"))){
                    ?>
                    <div class="row">
                        <div class="col-lg-12 label-warning">Agan tidak terdaftar atau salah password gan</div>
                    </div>
                    <?php } ?>
                    <?php
                    $form = new form();
                    $form->formInput("username","text","Username","40","2",true);
                    $form->formInput("password","password","Password","40","2",true);
                    $form->formCheckboxSingle("ingat","Ingat Saya","1");
                    $form->formSubmit("submit","login");
                    ?>
                </form>
                <?php 
                }else{ 
                ?>
                <h2>Hello <?php echo filter_input(2,"login"); ?></h2>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/jquery.validate.min.js" type="text/javascript"></script>
    <script>$("#loginForm").validate();</script>
</body>
</html>