<?php require_once 'islem.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/all.css">
    
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

        .btn-dark{
            margin-top: 5px;
        }
        .barkodalani{
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
        .fa.fa-fill {
            cursor:pointer;
            
        }
        #window {
            border: 1px solid black;
            border-width: 3px;
            display:none;
            
            
        }
        #uygula {
            height:35px;
            width:100%;
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
                <div class="container" id="eklemepenceresi">
                    <a href="urunekleme.php"><button class="btn btn-dark">Ürün Ekleme Penceresini Aç</button></a>    
                </div>    
                <div class="container" id="eklemepenceresi">
                    <a href="alisveris.php"><button class="btn btn-dark">Alışveriş</button></a>    
                    <br>   
                    <br> 
                </div>
                <div class="container">
                    <table class="table table-dark table-striped table-hover">  
                        <label><span class="fill">
                                    <i class="fa fa-fill"></i>
                                        <div id="window">
                                            <form action="islem.php" method="GET">
                                                
                                                
                                                <input type="radio" value="maroon" name="renk">maroon
                                                <input type="radio" value="white" name="renk">white
                                                <input type="radio" value="pink" name="renk">pink
                                                <input type="radio" value="beiege" name="renk">beige
                                                <input type="radio" value="grey" name="renk">grey
                                                <input type="radio" value="orange" name="renk">orange
                                                <input type="radio" value="purple" name="renk">purple
                                                <input type="radio" value="olive" name="renk">olive
                                                </label>
                                                <button class="btn btn-dark" id="uygula" name="renkkaydet">uygula</button>
                                            </form>
                                        </div>
                                </span>
                        </label>          
                        <thead>
                            <tr class="baslik">
                                <th>Ürün Adı</th>
                                <th>Barkodu</th>
                                <th>Fiyatı</th>
                                <th></th>
                                <th></th>
                            </tr>  
                        </thead>         
                        <tbody>
                        
                        <?php   
                        $urunsor = $baglanti->prepare("SELECT * from urunler");
                        $urunsor->execute();
                        while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $uruncek['urunadi'] ?></td>
                                <td><?php echo $uruncek['urunbarkodu'] ?></td>
                                <td><?php echo $uruncek['urunfiyati'] ?></td>
                                <td><a href="urunduzenleme.php?id=<?php echo $uruncek['id'] ?>"><button class="btn btn-warning">Düzenle</button></a></td>
                                <td><a href="islem.php?urunsil&id=<?php echo $uruncek['id'] ?>""><button class="btn btn-danger">Sil</button></a></td>
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
            $(document).ready(function(){
                if (window.location.href == "http://localhost/BarkodProgrami/index.php?yuklenme=basarili") {
                    $("#yesilpencere").slideToggle(1000);
                    $("#yesilpencere").slideToggle(1000);
                }
                else if (window.location.href == "http://localhost/BarkodProgrami/index.php?yuklenme=basarisiz") {
                    $("#kirmizipencere").slideToggle(1000);
                    $("#kirmizipencere").slideToggle(1000);
                }
                
            })
            $(document).ready(function(){
                $(".fill").click(function(){
                    $("#window").slideDown();
                })
                $(".fill").dblclick(function(){
                    $("#window").slideUp();
                })
            })
            
        </script>
        
    </body>
</html>