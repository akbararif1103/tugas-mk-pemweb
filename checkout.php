<?php
session_start();
$koneksi = new mysqli('localhost', 'root', '', 'nwind');

if (isset($_POST["checkout"])) {
    session_destroy();
    header("refresh:0");
}

//mengecek tombol beli telah ditekan
if (isset($_POST['beli'])) {
    $ProductID = $_POST['ProductID'];
    $jumlah = $_POST['jumlah'];

    $query = "SELECT * FROM products WHERE ProductID = $ProductID";
    $hasil = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($hasil);

    //apakah sesi cart sudah ada
    if (isset($_SESSION['cart'])) {
        $kondisi = false;

        foreach ($_SESSION['cart'] as $i => $item) {
            if ($item['ProductID'] == $ProductID) {
                $_SESSION['cart'][$i]['Jumlah'] += $jumlah;
                $_SESSION['cart'][$i]['SubTotal'] = $_SESSION['cart'][$i]['Jumlah'] * $_SESSION['cart'][$i]['UnitPrice'];
                $kondisi = true;
            }
        }

        if ($kondisi == false) {
            $SubTotal = $data['UnitPrice'] * $jumlah;
            $index = count($_SESSION['cart']);
            $_SESSION['cart'][$index] = (array)[
                'ProductID' => $data['ProductID'],
                'ProductName' => $data['ProductName'],
                'UnitPrice' => $data['UnitPrice'],
                'Jumlah' => $jumlah,
                'SubTotal' => $SubTotal,
            ];
        }
    } else {
        $SubTotal = $data['UnitPrice'] * $jumlah;
        $_SESSION['cart'][0] = (array)[
            'ProductID' => $data['ProductID'],
            'ProductName' => $data['ProductName'],
            'UnitPrice' => $data['UnitPrice'],
            'Jumlah' => $jumlah,
            'SubTotal' => $SubTotal,
        ];
    }
}
$n = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckOut</title>
</head>

<body>
    <h1>Checkout</h1>

    <table border="1">
        <tr>
            <td>NO</td>
            <td>ProductID</td>
            <td>ProductName</td>
            <td>UnitPrice</td>
            <td>Jumlah</td>
            <td>SubTotal</td>
        </tr>
        <?php
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $data) { ?>
                <tr>
                    <td><?=$n?></td>
                    <td><?=$data['ProductID']?></td>
                    <td><?=$data['ProductName']?></td>
                    <td><?=$data['UnitPrice']?></td>
                    <td><?=$data['Jumlah']?></td>
                    <td><?=$data['SubTotal']?></td>
                </tr>
        <?php 
        $n++;
        $total += $data['SubTotal'];
        }
        }
        ?>

        <!-- menampilkan total biaya -->
        <tr>
            <td colspan="5">Total</td>
            <td><?=$total?></td>
        </tr>
    </table>
    <a href="index.php">Pilih Produk Lain</a>
    <br>
    <h4>CheckOut</h4>
    <form action="" method="post">
        <button type="submit" name="checkout">Checkout</button>
    </form>
</body>

</html>