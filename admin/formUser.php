<?php
include '../class/connect.php';
include '../class/form.php';
$judul = 'User';
if(!empty(filter_input(0,"edit"))){
    $makanan = implode(",",filter_input(0,"makanan",FILTER_DEFAULT,FILTER_REQUIRE_ARRAY));
    $passUbah = "";
    if(!empty(filter_input(0,"password"))){ $passUbah = "password=MD5('".filter_input(0,"password")."'),"; }
    $q = $pdo->prepare("UPDATE user SET "
                . "username='".filter_input(0,"username")."',"
                .$passUbah
                . "email='".filter_input(0,"email")."',"
                . "status='".filter_input(0,"status")."',"
                . "hobi='".filter_input(0,"hobi")."',"
                . "profil='".filter_input(0,"profil")."',"
                . "makanan='".$makanan."' WHERE id='".filter_input(0,"edit")."'");
    $q->execute();
    header('location:viewUser.php?suksesedit=1');
}
else if(!empty(filter_input(0,"submit"))){
    $makanan = implode(",",filter_input(0,"makanan",FILTER_DEFAULT,FILTER_REQUIRE_ARRAY));
    $q = $pdo->prepare("INSERT INTO user "
                . "(username,password,email,status,hobi,profil,makanan) "
                . "VALUES("
                . "'".filter_input(0,"username")."',"
                . "MD5('".filter_input(0,"password")."'),"
                . "'".filter_input(0,"email")."',"
                . "'".filter_input(0,"status")."',"
                . "'".filter_input(0,"hobi")."',"
                . "'".filter_input(0,"profil")."',"
                . "'".$makanan."')");
    $q->execute();
    header('location:viewUser.php?sukses=1');
}
if(!empty(filter_input(1,'edit'))){
    $q = $pdo->prepare("SELECT * FROM user WHERE id='".filter_input(1,'edit')."' LIMIT 0,1");
    $q->execute();
    $d = $q->fetch();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Input User</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <header>
                <?php include 'nav.php'; ?>
            </header>
            <main>
                <form action="" method="POST" id="userForm" class="form-horizontal">
                    <?php
                    if(empty($d['username'])){ $d['username']="";}
                    if(empty($d['password'])){ $d['password']="";}
                    if(empty($d['email'])){ $d['email']="";}
                    if(empty($d['status'])){ $d['status']="";}
                    if(empty($d['hobi'])){ $d['hobi']="";}
                    if(empty($d['makanan'])){ $d['makanan']="";}
                    if(empty($d['profil'])){ $d['profil']="";}
                    $form = new form();
                    $form->formInput("username","text","Username",60,4,true,$d['username']);
                    $form->formInput("password","password","Password",40,4,true);
                    $form->formInput("email","email","E-mail",50,10,true,$d['email']);
                    $status = array('single','punya pacar','sudah menikah','jomblo abadi');
                    $form->formRadio("status","Status",$status,true,$d['status']);
                    $hobi = array('sepak bola','moto GP','sepeda','memasak','berenang','tidur','menghilang');
                    $form->formSelect("hobi","Hobi",$hobi,true,$d['hobi']);
                    $makanan = array('sate','bakso','soto','mie','tipat cantok','rujak','tipat plecing');
                    $form->formCheckbox("makanan","Makanan Fav",$makanan,2,4,true, explode(',',$d['makanan']));
                    $form->formArea("profil","Profil",40,5,null,$d['profil']);
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
            $("#lihat").click(function(){
                if($("#password").attr("type")==="password"){
                    $("#password").attr("type","text");
                    $("#password").css('display','none');
                }else{
                    $("#password").attr("type","password");
                    $("#password").css('display','block');
                }
            });
            $("#userForm").validate();
        </script>
    </body>
</html>