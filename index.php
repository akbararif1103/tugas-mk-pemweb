<?php
$koneksi = new mysqli('localhost','root','','nwind');

$query = "SELECT * FROM categories";
$hasil = mysqli_query($koneksi,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori Produk</title>
</head>
<body>
    <h1>Daftar Kategori Produk</h1>

    <table border="1">
        <tr>
            <td>NO</td>
            <td>Nama Kategori Produk</td>
        </tr>
        <?php
        if(mysqli_num_rows($hasil)>0){
            while($data = mysqli_fetch_array($hasil)){
                ?>
                <tr>
                    <td><?=$data['CategoryID']?></td>
                    <td><a href="produk.php?idKategori=<?=$data['CategoryID']?>"><?=$data['CategoryName']?></a></td>
                </tr>
                <?php
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