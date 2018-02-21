<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Dagang Rujak Go</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php?kat=makanan">Makanan</a>
                    </li>
                    <li>
                        <a href="index.php?kat=minuman">Minuman</a>
                    </li>
                    <li>
                        <a href="index.php?konten=Tentang">Tentang</a>
                    </li>
                    <li>
                        <a href="index.php?konten=Kontak">Kontak</a>
                    </li>
                    <?php
                    if(empty(filter_input(2,'loginMember'))){
                    ?>
                    <li>
                        <a href="index.php?konten=Register">Register</a>
                    </li>
                    <li>
                        <a href="index.php?konten=Login">Login</a>
                    </li>
                    <?php
                    }else{
                        $qmember = $pdo->prepare("SELECT MemberID FROM member "
                        . "WHERE MemberNama='".filter_input(2,"loginMember")."'");
                        $qmember->execute();
                        $dmember = $qmember->fetch();
                        $qkeranjang = $pdo->query("SELECT keranjang.ID FROM item,keranjang "
                        . "WHERE keranjang.member='".$dmember['MemberID']."' "
                        . "AND keranjang.status='lagiBelanja' "
                        . "AND keranjang.ID=item.keranjang");
                    ?>
                    <li>
                        <a href="index.php?konten=keranjang">Keranjang(<?php echo $qkeranjang->rowCount(); ?>)</a>
                    </li>
                    <li>
                        <a href="prosesForm.php?logout=1">Logout</a>
                    </li>
                    <?php
                    } 
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
