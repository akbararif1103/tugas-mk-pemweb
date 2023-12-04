<?php
$koneksi = new mysqli('localhost','root','','nwind');

$CategoryID = $_GET['idKategori'];
$query = "SELECT * FROM products WHERE CategoryID = $CategoryID";
$hasil = mysqli_query($koneksi,$query);
$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
</head>
<body>
<h1>Daftar Produk</h1>

<table border="1">
    <tr>
        <td>NO</td>
        <td>Nama Produk</td>
        <td>Unit Price</td>
    </tr>
    <?php
    if(mysqli_num_rows($hasil)>0){
        while($data = mysqli_fetch_array($hasil)){
            ?>
            <tr>
                <td><?=$i?></td>
                <td><a href="produk-detail.php?idProduct=<?=$data['ProductID']?>"><?=$data['ProductName']?></a></td>
                <td><?=$data['UnitPrice']?></td>
            </tr>
            <?php
            $i++;
        }
    }
    ?>
    <tr>

    </tr>
    <?php
    ?>
</table>
</body>
</html>