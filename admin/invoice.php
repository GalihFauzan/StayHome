<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Invoice</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=5">Invoice</a>
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
                                    include "function.php";
                                    $no = 1;
                                    $query = mysqli_query($conn, "SELECT invoice.id_invoice, invoice.tanggal_invoice, user.*, kamar.kamar, invoice.jumlah_invoice 
                                    FROM invoice 
                                    INNER JOIN user ON invoice.id_user = user.id_user 
                                    INNER JOIN kamar ON user.id_kamar = kamar.id_kamar 
                                    WHERE invoice.status = 'Belum Dibayar'");
                                    while ($d = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['tanggal_invoice']; ?></td>
                                            <td><?php echo $d['nama_user']; ?></td>
                                            <td><?php echo $d['kamar']; ?></td>
                                            <td><?php echo number_format($d['jumlah_invoice'], 0, ',', '.'); ?></td>
                                            <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-success m-1">Bayar</a>

                                            </td>

                                        </tr>
                                        <!-- Modal Ubah  -->
                                        <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="card-header">
                                                        <div class="d-flex align-items-center">
                                                            <h4 class="card-title">Bayar Invoice</h4>
                                                        </div>
                                                    </div>
                                                    <form action="backend/tambah_pembayaran.php" method="post" enctype="multipart/form-data">
                                                        <div class=" modal-body">
                                                            <!-- Grid System untuk dua kolom -->
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id" value="<?php echo $d['id_invoice']; ?>">

                                                                        <label for="tanggal_invoice">Tanggal Invoice</label>
                                                                        <input type="date" class="form-control" name="tgl_invoice" value="<?php echo $d['tanggal_invoice']; ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">
                                                                        <label for="nama_penyewa">Nama Penyewa</label>
                                                                        <input type="text" class="form-control" name="nama_penyewa" value="<?php echo $d['nama_user']; ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kamar">Kamar</label>
                                                                        <input type="text" class="form-control" name="kamar" value="<?php echo $d['kamar']; ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="bayar">Jumlah Invoice</label>
                                                                        <input type="text" class="form-control" name="jumlah_invoice" value="<?php echo number_format($d['jumlah_invoice'], 0, ',', '.'); ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tanggal bayar">Tanggal Pembayaran</label>
                                                                        <input type="date" class="form-control" id="tgl_bayar" name="tanggal_pembayaran" required>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="">Jumlah Pembayaran</label>
                                                                        <input type="number" class="form-control" name="jumlah_pembayaran" required>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="foto">Bukti</label>
                                                                        <input type="file" class="form-control-file" name="foto[]" multiple />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="btn-label">
                                                                    <i class="fa fa-undo-alt"></i> Batal</button>
                                                            <button type="submit" class="btn btn-success"><span class="btn-label">
                                                                    <i class="fa fa-save"></i> Simpan</span></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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