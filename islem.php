<?php 
try {
	$baglanti = new PDO("mysql:host=localhost; dbname=barkod", 'root' ,'');
} 
catch (PDOException $e) {
	echo $e->getMessage();
}
// /bağlantı***************
// urun ekleme********************
if (isset($_POST['urunekle'])) {
    $kaydet = $baglanti->prepare("INSERT INTO urunler SET
    urunadi=:urunadi,
    urunbarkodu=:urunbarkodu,
    urunfiyati=:urunfiyati
    ");
    $insert = $kaydet->execute(array(
        'urunadi'=>$_POST['ad'],
        'urunbarkodu'=>$_POST['barkod'],
        'urunfiyati'=>$_POST['fiyat']
    ));
    if ($insert) {
        header("Location:index.php?yuklenme=basarili");
    }
    else {
        header("Location:index.php?yuklenme=basarisiz");
    }
}
// /urun ekleme***************************

// urunduzenleme***********************
if (isset($_POST['urunduzenle'])){
    $duzenle = $baglanti->prepare("UPDATE urunler set
    urunadi=:urunadi,
    urunbarkodu=:urunbarkodu,
    urunfiyati=:urunfiyati
    WHERE id={$_POST['id']}
    ");
    $update = $duzenle->execute(array(
        'urunadi'=>$_POST['ad'],
        'urunbarkodu'=>$_POST['barkod'],
        'urunfiyati'=>$_POST['fiyat']
    ));
    if ($update) {
        header("Location:index.php?yuklenme=basarili");
    }
    else {
        header("Location:index.php?yuklenme=basarisiz");
    }

}
if (isset($_GET['urunsil'])) {
    $sil = $baglanti->prepare("DELETE from urunler WHERE id=:id");
    $sil->execute(array(
        'id'=>$_GET['id']
    ));
    if ($sil) {
        header("Location:index.php?yuklenme=basarili");
    }
    else {
        header("Location:index.php?yuklenme=basarisiz");
    }
}

// Barkod kısmı*************


if (isset($_POST['satis'])) {
    $delete = $baglanti->prepare("DELETE FROM alisveris");
    $delete->execute();
    if ($delete) {
        header("Location:index.php");
    }
}

if (isset($_GET['satis_urunsil'])) {
    $sil = $baglanti->prepare("DELETE from alisveris WHERE satis_id=:satis_id");
    $sil->execute(array(
        'satis_id'=>$_GET['id']
    ));
    if ($sil) {
        header("Location:alisveris.php");
    }
    else {
        header("Location:alisveris.php");
    }
    
}
if (isset($_POST['tumunusil'])) {
    header("Location:alisveris.php");
}

if (isset($_GET['renkkaydet'])) {
    $duzenle = $baglanti->prepare("UPDATE arkaplanrengi SET
    renk=:renk
    ");
    $update = $duzenle->execute(array(
        'renk'=>$_GET['renk']
    ));
    if ($update) {
        header("Location:index.php");
    }
    else {
        header("Location:index.php");
    }
    
}

?>
