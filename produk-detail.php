<?php
$koneksi = new mysqli('localhost','root','','nwind');

$ProductID = $_GET['idProduct'];
$query = "SELECT * FROM products WHERE ProductID = $ProductID ";
$hasil = mysqli_query($koneksi,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk</title>
</head>
<body>
  <?php
  if(mysqli_num_rows($hasil)>0){
    $data = mysqli_fetch_array($hasil); ?>
    <h1>Detail Produk <?=$data['ProductName']?></h1>
    <ul>
      <li>ProductID: <?=$data['ProductID']?></li>
      <li>ProductName: <?=$data['ProductID']?></li>
      <li>UnitPrice: <?=$data['UnitPrice']?></li>
      <li>QuantityPerUnit: <?=$data['QuantityPerUnit']?></li>
    </ul>

    <h2>Jumlah</h2>
    <form action="checkout.php" method="post">
      <input type="hidden" name="ProductID" value="<?=$data['ProductID']?>">
      <input type="number" name="jumlah" value="1">
      <button type="submit" name="beli">Beli</button>
    </form>
    <?php
  }
  ?>
</body>
</html>