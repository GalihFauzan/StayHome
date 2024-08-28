<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pembayaran</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=2">Pembayaran</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                        <option selected>Aug 19</option>
                        <option value="1">July 19</option>
                        <option value="2">Jun 19</option>
                    </select>
                </div>
            </div> -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- <div class="page-header mb-3">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambahDataModal">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
                    </div>
                </div> -->
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered table-hover">
                                <thead>
                                    <th width=20px>No</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Kamar</th>
                                    <th>Total Tagihan</th>
                                    <th width=100px>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php
                                    include "../assets/conn/koneksi.php";
                                    include "../admin/function.php"; // Menghubungkan ke file fungsi

                                    $id = $_SESSION['id'];
                                    $no = 1;
                                    $query = mysqli_query($conn, "SELECT invoice.id_invoice, invoice.tanggal_invoice, user.*, kamar.kamar, invoice.jumlah_invoice 
                                    FROM invoice 
                                    INNER JOIN user ON invoice.id_user = user.id_user 
                                    INNER JOIN kamar ON user.id_kamar = kamar.id_kamar 
                                    WHERE user.id_user ='$id' AND invoice.status != 'Lunas'");
                                    while ($d = mysqli_fetch_assoc($query)) {

                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['tanggal_invoice']; ?></td>
                                            <td><?php echo $d['nama_user']; ?></td>
                                            <td><?php echo $d['kamar']; ?></td>
                                            <td><?php echo number_format($d['jumlah_invoice'], 0, ',', '.'); ?></td>
                                            <td><a href="index.php?page=6&id_invoice=<?php echo $d['id_invoice']; ?>" target="_blank" id="pay-button" class=" btn btn-success m-1">Bayar</a>

                                            </td>

                                        </tr>
                                        <!-- Modal Ubah  -->

                                        <!-- Akhir Modal Ubah  -->
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>