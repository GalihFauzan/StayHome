<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Pembayaran</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=9">Detail Pembayaran</a>
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
                        <a href="index.php?page=6" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-list"></i>
                            Data Pembayaran
                        </a>
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered table-hover">
                                <thead>
                                    <th width=20px>No</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Nama Penyewa</th>
                                    <th>Kamar</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Status</th>
                                    <th width=100px>Aksi</th>
                                </thead>
                                <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT user.nama_user,kamar.kamar,invoice.tanggal_invoice,invoice.status,pembayaran.id_pembayaran,pembayaran.tanggal_pembayaran,pembayaran.jumlah_pembayaran FROM user INNER JOIN kamar ON user.id_kamar=kamar.id_kamar INNER JOIN invoice ON invoice.id_user=user.id_user INNER JOIN pembayaran ON pembayaran.id_invoice=invoice.id_invoice where invoice.status='Lunas'");
                                while ($d = mysqli_fetch_assoc($query)) {

                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['tanggal_invoice']; ?></td>
                                        <td><?php echo $d['tanggal_pembayaran']; ?></td>
                                        <td><?php echo $d['nama_user']; ?></td>
                                        <td><?php echo $d['kamar']; ?></td>
                                        <td><?php echo number_format($d['jumlah_pembayaran'], 0, ',', '.'); ?></td>
                                        <td><?php
                                            if ($d['status'] == 'Lunas') {
                                            ?>
                                                <span class="btn btn-success btn-rounded"><?php echo $d['status']; ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="btn btn-danger btn-rounded"><?php echo $d['status']; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        </td>
                                        <td><a href="../user/print_pembayaran.php?id_pembayaran=<?php echo $d['id_pembayaran']; ?>" class="btn btn-info"><i class="fa fa-print text-white"></i></a>

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
                                                                    <input type="number" class="form-control" name="jumlah_invoice" value="<?php echo number_format($d['jumlah_invoice'], 0, ',', '.'); ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal bayar">Tanggal Pembayaran</label>
                                                                    <input type="date" class="form-control" id="tgl_bayar" name="tanggal_pembayaran" value="<?php echo $d['tanggal_pembayaran']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Jumlah Pembayaran</label>
                                                                    <input type="number" class="form-control" name="jumlah_pembayaran" value="<?php echo number_format($d['jumlah_pembayaran'], 0, ',', '.'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">

                                                                <div class="form-group">
                                                                    <label for="metode">Metode Pembayaran</label>
                                                                    <select class="form-control" name="metode" id="">
                                                                        <option value="<?php echo $d['metode']; ?>"><?php echo $d['metode']; ?></option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="Qris">Qris</option>
                                                                        <option value="Transfer Bank">Transfer Bank</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="foto">Bukti</label>
                                                                    <input type="hidden" class="form-control-file" id="foto" name="old_foto" value="<?php echo $d['foto']; ?>">
                                                                    <input type="file" class="form-control-file" name="foto[]" multiple />
                                                                    <img src="../assets/bukti/<?php echo $d['foto']; ?>" width="200" alt="Gambar" class="rounded mt-2">
                                                                </div>
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

    <!-- Modal Tambah -->
    <div class=" modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Pembayaran</h4>
                    </div>
                </div>
                <form action="backend/tambah_pembayaran.php" id="resetbuku" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <!-- Grid System untuk dua kolom -->
                        <div class="row">

                            <div class="col-lg-6">
                                <!-- Isi formulir di kolom pertama -->
                                <div class="form-group">
                                    <label for="tanggal bayar">Tanggal Bayar</label>
                                    <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar">
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK">
                                    <input type="hidden" class="form-control" name="id_user">
                                </div>
                                <div class="form-group">
                                    <label for="nama_penyewa">Nama Penyewa</label>
                                    <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa">
                                </div>
                                <div class="form-group">
                                    <label for="kamar">Kamar</label>
                                    <input type="text" class="form-control" id="kamar" name="kamar">
                                    <input type="hidden" class="form-control" id="" name="id_kamar">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bayar">Jumlah Dibayar</label>
                                    <input type="number" class="form-control" id="bayar" name="jumlah_bayar" placeholder="Masukkan Nominal">
                                </div>
                                <div class="form-group">
                                    <label for="metode">Metode Pembayaran</label>
                                    <select class="form-control" name="metode" id="">

                                        <option value="Cash">Cash</option>
                                        <option value="Qris">Qris</option>
                                        <option value="Transfer Bank">Transfer Bank</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Bukti</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto[]" multiple />

                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="">
                                        <option value="Belum dibayar">Belum dibayar</option>
                                        <option value="Telah dibayar">Telah dibayar</option>
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
                    </div </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal-->