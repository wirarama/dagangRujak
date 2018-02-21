<div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                $q1 = $pdo->prepare("SELECT MenuGambar,MenuNama,MenuDiskripsi FROM menu WHERE MenuUnggulan='1' ORDER BY MenuNama ASC");
                                $q1->execute();
                                $imx = $q1->rowCount();
                                for($i=0;$i<$imx;$i++){
                                ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i==0){ ?>class="active"<?php } ?>></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                                $q1i = 0;
                                while ($d1 = $q1->fetch()){
                                ?>
                                <div class="item <?php if($q1i==0){ echo 'active'; } ?>">
                                    <img class="slide-image" src="<?php echo $dirUsr.str_replace('.','_Unggulan.',$d1['MenuGambar']); ?>" alt="">
                                    <div class="carousel-caption">
                                        <h1><?php echo $d1['MenuNama']; ?></h1>
                                        <p><?php echo $d1['MenuDiskripsi']; ?></p>
                                    </div>
                                </div>
                                <?php $q1i++; } ?>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>