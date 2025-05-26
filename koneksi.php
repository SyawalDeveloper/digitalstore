<?php
// Koneksi ke database
session_start();
$conn = mysqli_connect("localhost", "root", "", "digital_store");

// Tambah barang baru
if(isset($_POST['addnewbarang'])){
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "INSERT INTO stock (nama_barang, harga, stock) values ('$nama_barang', '$harga', '$stock')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

// Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $quantity = $_POST['quantity'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * from stock where id_barang= '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$quantity;

    $addtomasuk = mysqli_query($conn,"INSERT INTO masuk (id_barang, keterangan, quantity) values ('$barangnya', '$penerima', '$quantity')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' where id_barang='$barangnya'");

    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

// Menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $quantity = $_POST['quantity'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * from stock where id_barang= '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stocksekarang = $ambildatanya['stock'];

    if($stocksekarang >= $quantity){

    
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$quantity;

    $addtokeluar = mysqli_query($conn,"INSERT INTO keluar (id_barang, penerima, quantity) values ('$barangnya', '$penerima', '$quantity')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' where id_barang='$barangnya'");

    if($addtokeluar&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
    } else {
        // kalau barang tdk cukup
        echo'
        <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href="keluar.php";
        </script>
            ';
    }
}




//  update info barang
if(isset($_POST['updatebarang'])){
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    $update = mysqli_query($conn, "UPDATE stock set nama_barang='$nama_barang', harga='$harga' where id_barang ='$id_barang'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

// Hapus barang dari stock 
if(isset($_POST['hapusbarang'])){
    $id_barang = $_POST['id_barang'];

    $hapus = mysqli_query($conn, "DELETE FROM stock where id_barang='$id_barang'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Mengubah data barang masuk 
if(isset($_POST['updatebarangmasuk'])){
    $id_barang = $_POST['id_barang'];
    $id_masuk = $_POST['id_masuk'];
    $deskripsi = $_POST['keterangan'];
    $quantity = $_POST['quantity'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock where id_barang='$id_barang'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];

    $quantitysekarang = mysqli_query($conn, "SELECT *FROM masuk where id_masuk='$id_masuk'");
    $quantitynya = mysqli_fetch_array($quantitysekarang);
    $quantitysekarang = $quantitynya['quantity'];

    if($quantity>$quantitysekarang){
        $selisih = $quantity - $quantitysekarang;
        $kurangin = $stocksekarang + $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock set stock='$kurangin' where id_barang='$id_barang'");
        $update = mysqli_query($conn, "UPDATE masuk set quantity='$quantity', keterangan='$deskripsi' where id_masuk='$id_masuk'");
            if($kuranginstoknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    } else {
        $selisih = $quantitysekarang - $quantity;
        $kurangin = $stocksekarang - $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock set stock='$kurangin'where id_barang='$id_barang'");
        $updatenya = mysqli_query($conn, "UPDATE masuk set quantity='$quantity', keterangan='$deskripsi' where id_masuk='$id_masuk'");
            if($kurangistoknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    }
}


// Menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $id_barang = $_POST['id_barang'];
    $quantity = $_POST['quantity'];
    $id_masuk = $_POST['id_masuk'];


    $getdatastock = mysqli_query($conn, "SELECT * FROM stock where id_barang='$id_barang'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock-$quantity;

    $update = mysqli_query($conn, "UPDATE stock SET stock ='$selisih' where id_barang='$id_barang'");
    $hapusdata = mysqli_query($conn, "DELETE FROM masuk where id_masuk='$id_masuk'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}

// Mengubah data barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $id_barang = $_POST['id_barang'];
    $id_keluar = $_POST['id_keluar'];
    $penerima = $_POST['penerima'];
    $quantity = $_POST['quantity'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock where id_barang='$id_barang'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];

    $quantitysekarang = mysqli_query($conn, "SELECT *FROM keluar where id_keluar='$id_keluar'");
    $quantitynya = mysqli_fetch_array($quantitysekarang);
    $quantitysekarang = $quantitynya['quantity'];

    if($quantity>$quantitysekarang){
        $selisih = $quantity - $quantitysekarang;
        $kurangin = $stocksekarang - $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock set stock='$kurangin' where id_barang='$id_barang'");
        $update = mysqli_query($conn, "UPDATE keluar set quantity='$quantity', penerima='$penerima' where id_keluar='$id_keluar'");
            if($kuranginstoknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'Gagal';
                header('location:keluar.php');
            }
    } else {
        $selisih = $quantitysekarang - $quantity;
        $kurangin = $stocksekarang + $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock set stock='$kurangin'where id_barang='$id_barang'");
        $updatenya = mysqli_query($conn, "UPDATE keluar set quantity='$quantity', penerima='$penerima' where id_keluar='$id_keluar'");
            if($kurangistoknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'Gagal';
                header('location:keluar.php');
            }
    }
}


// Menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $id_barang = $_POST['id_barang'];
    $quantity = $_POST['quantity'];
    $id_keluar = $_POST['id_keluar'];


    $getdatastock = mysqli_query($conn, "SELECT * FROM stock where id_barang='$id_barang'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock+$quantity;

    $update = mysqli_query($conn, "UPDATE stock SET stock ='$selisih' where id_barang='$id_barang'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar where id_keluar='$id_keluar'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}



?>