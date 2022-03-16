<?php require_once 'islem.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
    <!-- CSS Alanı -->
    <style>
        <?php   
        $renksor = $baglanti->prepare("SELECT * from arkaplanrengi");
        $renksor->execute();
        while ($renkcek = $renksor->fetch(PDO::FETCH_ASSOC)) { ?>
            
        * {
            background-color: <?php echo $renkcek['renk']; ?>;
            }
        <?php }?>
        .btn-dark {
            margin-top: 5px;
        }

        .barkodalani {
            background-color: lightpink;
            margin-top: 100px;
            height: 50px;
            text-align: center;
            margin-left: 300px;
        }

        #eklemepenceresi {
            width: 50%;
            text-align: center;
        }

        input {
            text-align: center;
            font-weight: bold;

        }

        #yesilpencere {
            display: none;
        }

        #kirmizipencere {
            display: none;
        }
    </style>
</head>

<body>
    <div>
        <?php
        if (@$_GET['yuklenme'] == "basarili") { ?>
            <div id="yesilpencere" class="container" style="margin-top:10px;width:50%;background-color:lightgreen;font-weight:bold;text-align:center;margin:0 auto;color:white;">
                Yüklenme başarılı!
            </div>
        <?php } elseif (@$_GET['yuklenme'] == "basarisiz") { ?>
            <div id="kirmizipencere" class="container" style="margin-top:10px;width:50%;background-color:red;font-weight:bold;text-align:center;margin:0 auto; color:white;">
                Yüklenme başarısız!
            </div>
        <?php } ?>
        <div class="eklemekabuk">
            <form method="GET">
                <div class="card-body container">
                    
                    <div class="form-group">
                        <input id="kutu" name="barkodkutusu" type="text" class="form-control" placeholder="Ürün barkodunu girmek için lütfen tıklayınız">
                        <br>
                    </div>
                </div>
            </form>
            <form method="POST">
                <div class="container">
                    <button class="btn btn-dark" name="satis">Satış Bitti</button>
                </div>
                <div class="container">
                    <button class="btn btn-dark" name="satis">Tümünü Sil</button>
                    <br>
                    <br>
                </div>
            </form>
            
            <?php
                        $urunsor = $baglanti->prepare("SELECT * from alisveris");
                        $urunsor->execute();
                        $toplam = 0;
                        while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                            $toplam = $toplam + $uruncek['satis_urunfiyati'];
                        }
                            
                        ?>

                
        
            
            <div class="container">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <?php
                        if (isset($_GET['barkodkutusu'])) {
                            $urunsor = $baglanti->prepare("SELECT * from urunler");
                            $urunsor->execute();
                            while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                                if ($uruncek['urunbarkodu'] == @$_GET['barkodkutusu']) {
                                    $kaydet = $baglanti->prepare("INSERT INTO alisveris SET
                                    satis_urunadi=:satis_urunadi,
                                    satis_urunbarkodu=:satis_urunbarkodu,
                                    satis_urunfiyati=:satis_urunfiyati
                                    ");
                                    $insert = $kaydet->execute(array(
                                        'satis_urunadi' => $uruncek['urunadi'],
                                        'satis_urunbarkodu' => $uruncek['urunbarkodu'],
                                        'satis_urunfiyati' => $uruncek['urunfiyati']
                                    ));
                                    header("Location:alisveris.php");
                                }
                            }
                        }
                        ?>
                        
                                    <tr>
                                        <th>Ürün Adı</th>
                                        <th>Barkodu</th>
                                        <th>Fiyatı</th>
                                        <th style="text-align: center; font-size: 20px;color:red;">TOPLAM=<?php echo $toplam ?>TL</th>
                                        <th></th>
                                    </tr>
                            
                    
                    </thead>
                    <tbody>

                        <?php
                        $urunsor = $baglanti->prepare("SELECT * from alisveris");
                        $urunsor->execute();
                        while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {?>
                            <tr>
                                <td><?php echo $uruncek['satis_urunadi'] ?></td>
                                <td><?php echo $uruncek['satis_urunbarkodu'] ?></td>
                                <td><?php echo $uruncek['satis_urunfiyati'] ?></td>
                                <td></td>
                                <td><a href="islem.php?satis_urunsil&id=<?php echo $uruncek['satis_id'] ?>"><button class=" btn btn-danger">Sil</button></a></td>
                            </tr>
                            
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- JS Alanı -->

        <script src="bootstrap.js"></script>
    </div>
    <script>
        $(document).ready(function() {
            if (window.location.href == "http://localhost/BarkodProgrami/index.php?yuklenme=basarili") {
                $("#yesilpencere").slideToggle(1000);
                $("#yesilpencere").slideToggle(1000);
            } else if (window.location.href == "http://localhost/BarkodProgrami/index.php?yuklenme=basarisiz") {
                $("#kirmizipencere").slideToggle(1000);
                $("#kirmizipencere").slideToggle(1000);
            }
        })
        
    </script>
</body>

</html>