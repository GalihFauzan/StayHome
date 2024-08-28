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
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=6">Pembayaran</a>
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
                <div class="page-header mb-3">
                    <div class="d-flex align-items-center">
                        <a href="index.php?page=9" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-list"></i>
                            Detail Pembayaran
                        </a>
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered table-hover">
                                <thead>
                                    <th width=20px>No</th>
                                    <th>ID Invoice</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Metode</th>
                                    <th width=100px>Aksi</th>
                                </thead>
                                <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT user.nama_user,kamar.kamar,invoice.id_invoice,invoice.tanggal_invoice,invoice.status,invoice.jumlah_invoice,pembayaran.id_pembayaran,pembayaran.metode,pembayaran.tanggal_pembayaran,pembayaran.jumlah_pembayaran FROM user INNER JOIN kamar ON user.id_kamar=kamar.id_kamar INNER JOIN invoice ON invoice.id_user=user.id_user INNER JOIN pembayaran ON pembayaran.id_invoice=invoice.id_invoice where invoice.status='Lunas'");
                                while ($d = mysqli_fetch_assoc($query)) {

                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['id_invoice']; ?></td>
                                        <td><?php echo $d['tanggal_pembayaran']; ?></td>
                                        <td><?php echo number_format($d['jumlah_pembayaran'], 0, ',', '.'); ?></td>
                                        <td><?php echo $d['metode']; ?></td>
                                        <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>

                                        </td>
                                    </tr>
                                    <!-- Modal Ubah  -->
                                    <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="card-title">Ubah Pembayaran</h4>
                                                    </div>
                                                </div>
                                                <form action="backend/ubah_pembayaran.php" method="post" enctype="multipart/form-data">
                                                    <div class=" modal-body">
                                                        <!-- Grid System untuk dua kolom -->
                                                        <div class="row">

                                                            <div class="col-lg-6">
                                                                <!-- Isi formulir di kolom pertama -->
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id_invoice" value="<?php echo $d['id_invoice']; ?>">
                                                                    <input type="hidden" name="id_pembayaran" value="<?php echo $d['id_pembayaran']; ?>">
                                                                    <label for="tanggal_invoice">Tanggal Invoice</label>
                                                                    <input type="date" class="form-control" name="tgl_invoice" value="<?php echo $d['tanggal_invoice']; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">

                                                                    <label for="nama_penyewa">Nama Penyewa</label>
                                                                    <input type="text" class="form-control" name="nama_penyewa" value="<?php echo $d['nama_user']; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kamar">Kamar</label>
                                                                    <input type="text" class="form-control" name="kamar" value="<?php echo $d['kamar']; ?>" readonly>
                                                                </div>
                                                              <div class="form-group">
                                                                                <label for="bayar">Jumlah Invoice</label>
                                                                                <input type="number" class="form-control" name="jumlah_invoice" value="<?php echo $d['jumlah_invoice']; ?>" readonly>
                                                                            </div>



                                                                <div class="form-group">
                                                                    <label for="tanggal bayar">Tanggal Pembayaran</label>
                                                                    <input type="date" class="form-control" id="tgl_bayar" name="tanggal_pembayaran" value="<?php echo $d['tanggal_pembayaran']; ?>">
                                                                </div>
                                                              <div class="form-group">
                                                                    <label for="">Jumlah Pembayaran</label>
                                                                    <input type="number" class="form-control" name="jumlah_pembayaran" value="<?php echo $d['jumlah_pembayaran']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="">Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option value="<?php echo $d['status']; ?>"><?php echo $d['status']; ?></option>
                                                                        <option value="Lunas">Lunas</option>
                                                                        <option value="Belum Dibayar">Belum Dibayar</option>

                                                                    </select>
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
                                    <!-- Akhir Modal Ubah  -->
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>