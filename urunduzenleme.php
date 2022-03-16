<?php require_once 'islem.php';
$urunsor = $baglanti->prepare("SELECT * from urunler WHERE id=:id ");
$urunsor->execute(array(
    'id'=>$_GET['id']
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
    <style>
        input {
            text-align: center;
        }
        <?php   
        $renksor = $baglanti->prepare("SELECT * from arkaplanrengi");
        $renksor->execute();
        while ($renkcek = $renksor->fetch(PDO::FETCH_ASSOC)) { ?>
            
        * {
            background-color: <?php echo $renkcek['renk']; ?>;
            }
        <?php }?>
    </style>
</head>
<body>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-primary col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Ürün Düzenleme</h3>
                    </div>
                    <form action="islem.php" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <input value="<?php echo $uruncek['urunadi'] ?>" name="ad" type="text" class="form-control" placeholder="Ürün Adı">
                                <br>
                            </div>
                            <div class="form-group">
                                <input value="<?php echo $uruncek['urunbarkodu']?>" name="barkod" type="text" class="form-control" placeholder="Ürün Barkodu">
                                <br>
                            </div>
                            <div class="form-group">
                                <input value="<?php echo $uruncek['urunfiyati']?>" name="fiyat" type="text" class="form-control" placeholder="Ürün Fiyatı">
                                <br>
                            </div>
                            <div class="form-group">
                                <input value="<?php echo $uruncek['id']?>" name="id" type="hidden" class="form-control">
                                <br>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button name="urunduzenle" type="submit" class="btn btn-dark">Ürün Düzenle</button>
                        </div>
                    </form>
                </div>            
            </div>
        </div>
    </section>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="urunduzenleme.php"></script>
        
    <script src="bootstrap.js"></script>
</body>
</html>