<?php
require 'koneksi.php';
require 'cek.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Keluar</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Syawal Development</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                                 barang Keluar
                            </a>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Kelola Admin
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
                                 Logout
                            </a>
                            
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="bg-white text-dark ">
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Digital Store - Barang Keluar</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Smart & Seamless Stock Management</li>
                        </ol>
                       
                        
                        <div class="card mb-4">
                            <div class="card-header text-dark">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Tambah Barang</button>
  
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Penerima</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM keluar k, stock s where s.id_barang = k.id_barang");
                                        while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                            $id_keluar = $data['id_keluar'];
                                            $id_barang = $data['id_barang'];
                                            $tanggal = $data['tanggal'];
                                            $nama_barang = $data['nama_barang'];
                                            $quantity = $data['quantity'];
                                            $penerima = $data['penerima'];
                                        ?>

                                        <tr>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= $nama_barang; ?></td>
                                            <td><?= $quantity; ?></td>
                                            <td><?= $penerima; ?></td>
                                            <td> 
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id_keluar; ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id_keluar; ?>">Delete</button>
                                            </td>
                                        </tr>

                                          <!-- Modal Edit -->
<div class="modal fade" id="edit<?= $id_keluar; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                    <input type="text" name="penerima" value="<?= $penerima; ?>" class="form-control" required><br>
                    <input type="number" name="quantity" value="<?= $quantity; ?>" class="form-control" required><br>
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                    <input type="hidden" name="id_keluar" value="<?= $id_keluar; ?>">
                    <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
                                    

<!-- Modal Delete -->
<div class="modal fade" id="delete<?= $id_keluar; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                    Apakah anda yakin ingin menghapus <?= $nama_barang; ?>
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                    <input type="hidden" name="quantity" value="<?= $quantity; ?>">
                    <input type="hidden" name="id_keluar" value="<?= $id_keluar; ?>">
                    <br>
                    <br>
                    <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
                </div>
            </form>
        </div>
        </div>
    </div>

                                        <?php
                                        };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Syawal Development</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang Keluar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
       <form method="POST">
      <div class="modal-body">
      <select name="barangnya" class="form-control">
            <?php
            $ambilsemuadatannya = mysqli_query($conn, "SELECT * from stock");
            while($fetcharray = mysqli_fetch_array($ambilsemuadatannya)){
                $nama_barang = $fetcharray['nama_barang'];
                $id_barang = $fetcharray['id_barang'];
                ?>

            <option value="<?= $id_barang; ?>"><?= $nama_barang; ?></option>


            <?php
            }
            ?>
        </select><br>
        
        <input type="number"  name="quantity" class="form-control" placeholder="Quantity" required><br>
        <input type="text" name="penerima" placeholder="Penerima" class="form-control" required><br>
        <button type="submit" class="btn btn-primary" name="addbarangkeluar">Submit</button>
      </div>
      </form>

    </div>
  </div>
</div>
</html>
