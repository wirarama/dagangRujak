<?php
include 'class/connect.php';
include 'class/form.php';
if(empty(filter_input(1,'konten'))){
    $menu = "";
    if(!empty(filter_input(1,'menu'))){
        $menu = "WHERE MenuID='".filter_input(1,'menu')."'";
    }else if(!empty(filter_input(1,'kat'))){
        $menu = "WHERE MenuKategori='".filter_input(1,'kat')."'";
    }
    $q = $pdo->prepare("SELECT * FROM menu ".$menu." ORDER BY MenuNama DESC");
}else{
    $q = $pdo->prepare("SELECT * FROM konten WHERE KontenNama='".filter_input(1,'konten')."'");
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

    <title>DagangRujakGo</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $pathUsr; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $pathUsr; ?>css/styleweb.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php include 'webNav.php'; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        <?php if(empty(filter_input(1,'menu')) && empty(filter_input(1,'kat')) && empty(filter_input(1,'konten'))){
            include 'webAnim.php';
        } ?>
            <?php
            if(!empty(filter_input(1,'kat'))){
                echo '<h2>'.ucfirst(filter_input(1,'kat')).'</h2>';
                $q1 = $pdo->prepare("SELECT * FROM konten WHERE KontenNama='".filter_input(1,'kat')."'");
                                $q1->execute();
                    while ($d1 = $q1->fetch()){
                        ?>
                    <div class="col-sm-12 full">  
                                <p><?php echo $d1['KontenDiskripsi']; ?></p>
                            </div>
            
            <?php
                    }
            }
            ?>
                <div class="row">
                    <?php
                    $q->execute();
                    while ($d = $q->fetch()){
                        if(!empty(filter_input(1,'menu'))){
                            //detail menu
                    ?>
                    <div>
                        <div class="col-sm-6">
                            <img src="<?php echo $dirUsr.str_replace(".","_Thumb.",$d['MenuGambar']); ?>" alt="<?php echo $d['MenuNama']; ?>" class="img-responsive img-thumbnail">
                        </div>
                        <div class="col-sm-6">
                            <h4><?php echo $d['MenuNama']; ?></h4>
                            <h5>Rp. <?php echo number_format($d['MenuHarga'],2,',','.'); ?></h5>
                            <p><?php echo $d['MenuDiskripsi']; ?></p>
                            <?php
                            if(!empty(filter_input(2,'loginMember'))){
                                require_once 'formOrder.php';
                            }
                            ?>
                        </div>   
                    </div>
                    <?php 
                        }else if(!empty(filter_input(1,'konten'))){
                            //ditail konten
                    ?>
                    <div>
                        <div class="col-sm-6">
                            <img src="<?php echo $dirUsr.str_replace(".","_Thumb.",$d['KontenGambar']); ?>" alt="<?php echo $d['KontenNama']; ?>" class="img-responsive img-thumbnail">
                        </div>
                        <div class="col-sm-6">
                            <h4><?php echo $d['KontenNama']; ?></h4>
                            <p><?php echo $d['KontenDiskripsi']; ?></p>
                        </div>
                    </div>
                            
                    <?php
                        }else{
                            //menu thumbnails
                            ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="<?php echo $dirUsr.str_replace(".","_Thumb.",$d['MenuGambar']); ?>" alt="<?php echo $d['MenuNama']; ?>">
                            <div class="caption">
                                <h4 class="judulMenu"><a href="index.php?menu=<?php echo $d['MenuID']; ?>"><?php echo $d['MenuNama']; ?></a></h4>
                                <h5 class="hargaMenu">Rp. <?php echo number_format($d['MenuHarga'],2,',','.'); ?></h5>
                                <button type="button" class="btn btn-primary btn-lg belanja">Beli</button>
                                <div class="idMenu" style="display:none;"><?php echo $d['MenuID']; ?></div>
                                <div class="diskripsiMenu" style="display:none;"><?php echo $d['MenuDiskripsi']; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } 
                    ?> 
                </div>
            <?php
            if(filter_input(1,'konten')=='Register'){
                require_once 'formRegister.php';
            }else if(filter_input(1,'konten')=='Login'){
                require_once 'formLogin.php';
            }else if(filter_input(1,'konten')=='keranjang'){
                require_once 'keranjang.php';
            }
            ?>
        </div>
    </div>
    <!-- /.container -->

    <div class="container">

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Stikom 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <?php require_once 'modalBeli.php'; ?>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script>
        <?php
        if(filter_input(1,'konten')=='Register'){
            ?>
            $("#registerForm").validate({
                rules: {
                    MemberPassword: "required",
                    MemberPasswordConfirm: {
                      equalTo: "#MemberPassword"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            $('#sukses').html(response);
                        }            
                    });
                }
            });
            <?php
        }else if(filter_input(1,'konten')=='Login'){
            ?>
            $("#loginForm").validate();
            <?php
        }else{
            ?>
            $(".belanja").click(function(){
                $('.modal-title').html($(this).siblings('.judulMenu').text());
                $('.modal-menu-harga').html($(this).siblings('.hargaMenu').text());
                $('.modal-menu-gambar').attr('src',$(this).parent().prev().attr('src'));
                $('.modal-menu-diskripsi').html($(this).siblings('.diskripsiMenu').text());
                $('#item').val($(this).siblings('.idMenu').text());
                $('#belanja').modal('show');
            });
            <?php
        }
        ?>
    </script>
</body>

</html>