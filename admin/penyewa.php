<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Penyewa</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=2">Penyewa</a>
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
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambahDataModal">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered table-hover">
                                <thead>
                                    <th width=20px>No</th>
                                    <th>Nama Penyewa</th>
                                    <th>No Hp</th>
                                    <th>Kamar</th>
                                    <th>Tanggal Sewa</th>
                                    <th width=150px>Aksi</th>
                                </thead>
                                <?php
                                include '../assets/conn/koneksi.php';
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT user.*,kamar.*,biaya.* FROM user INNER JOIN kamar ON user.id_kamar =kamar.id_kamar INNER JOIN biaya ON user.id_bayar=biaya.id");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['nama_user']; ?></td>
                                        <td><?php echo $d['telp']; ?></td>
                                        <td><?php echo $d['kamar']; ?></td>
                                        <td><?php echo $d['tgl_sewa']; ?></td>
                                        <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>
                                            <a href="backend/hapus_penyewa.php?id_user=<?php echo $d['id_user']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Ubah  -->
                                    <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="card-title">Ubah Penyewa</h4>
                                                    </div>
                                                </div>
                                                <form action="backend/ubah_penyewa.php" method="post">
                                                    <div class=" modal-body">
                                                        <!-- Grid System untuk dua kolom -->
                                                        <div class="row">

                                                            <div class="col-lg-6">
                                                                <!-- Isi formulir di kolom pertama -->
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id" value="<?php echo $d['id_user']; ?>">
                                                                    <label for="nama penyewa">Nama Penyewa</label>
                                                                    <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" value="<?php echo $d['nama_user']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $d['email']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">Password</label>
                                                                    <div class="input-group">
                                                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $d['password']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat</label>
                                                                    <textarea name="alamat" class="form-control" id="" rows="3"><?php echo $d['nama_user']; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no hp">No Hp/Telp</label>
                                                                    <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $d['telp']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <!-- Isi formulir di kolom pertama -->

                                                                <?php
                                                                include '../assets/conn/koneksi.php';
                                                                $data = mysqli_query($conn, "SELECT kamar.* FROM kamar LEFT JOIN user ON kamar.id_kamar = user.id_kamar WHERE user.id_kamar IS NULL");
                                                                ?>
                                                                <div class="form-group">
                                                                    <label for="kamar">Kamar</label>
                                                                    <select class="form-control" id="kamar" name="kamar">
                                                                        <option value="<?php echo $d['id_kamar']; ?>"><?php echo $d['kamar']; ?></option>
                                                                        <?php while ($row = mysqli_fetch_array($data)) { ?>
                                                                            <option value="<?php echo $row['id_kamar']; ?>"><?php echo $row['kamar']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Type Pembayaran</label>
                                                                    <select class="form-control" name="pembayaran" id="">
                                                                        <option value="<?php echo $d['id_bayar']; ?>"><?php echo number_format($d['tarif'], 0, ',', '.'); ?>/<?php echo $d['ket']; ?></option>
                                                                        <?php
                                                                        include "../assets/conn/koneksi.php";
                                                                        $data = mysqli_query($conn, "SELECT * FROM biaya");
                                                                        while ($row = mysqli_fetch_assoc($data)) {
                                                                        ?>
                                                                            <option value="<?php echo $row['id']; ?>"><?php echo number_format($row['tarif'], 0, ',', '.'); ?>/<?php echo $row['ket']; ?> (DP:<?php echo number_format($row['dp'], 0, ',', '.'); ?>)</option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Keterangan</label>
                                                                    <select name="ket" class="form-control">
                                                                        <option value="Bayar DP">Bayar DP</option>
                                                                        <option value="Bayar Full">Bayar Full</option>
                                                                        <option value="Tidak Bayar">Tidak Bayar</option>
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
                                <?php
                                } ?>
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
                        <h4 class="card-title">Data Penyewa</h4>
                    </div>
                </div>
                <form action="backend/tambah_penyewa.php" id="resetbuku" method="post">
                    <div class=" modal-body">
                        <!-- Grid System untuk dua kolom -->
                        <div class="row">

                            <div class="col-lg-6">
                                <!-- Isi formulir di kolom pertama -->
                                <div class="form-group">
                                    <label for="nama penyewa">Nama Penyewa</label>
                                    <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" placeholder="Masukkan nama penyewa">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukkan 16 digit NIK">
                                </div> -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                        <!-- <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="" rows="3" placeholder="Masukan alamat"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="no hp">No Hp/Telp</label>
                                    <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukkan no hp">
                                </div>


                            </div>
                            <div class="col-lg-6">
                                <!-- Isi formulir di kolom pertama -->
                                <?php
                                include '../assets/conn/koneksi.php';
                                $data = mysqli_query($conn, "SELECT kamar.* FROM kamar LEFT JOIN user ON kamar.id_kamar = user.id_kamar WHERE user.id_kamar IS NULL ");
                                ?>
                                <div class="form-group">
                                    <label for="kamar">Kamar</label>
                                    <select class="form-control" id="kamar" name="kamar">
                                        <?php while ($d = mysqli_fetch_array($data)) { ?>
                                            <option value="<?php echo $d['id_kamar']; ?>"><?php echo $d['kamar']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Type Pembayaran</label>
                                    <select class="form-control" name="pembayaran" id="">
                                        <option value="">--Pilih Pembayaran--</option>
                                        <?php
                                        include "../assets/conn/koneksi.php";
                                        $query = mysqli_query($conn, "SELECT * FROM biaya");
                                        while ($d = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $d['id']; ?>"><?php echo number_format($d['tarif'], 0, ',', '.'); ?>/<?php echo $d['ket']; ?> (DP:<?php echo number_format($d['dp'], 0, ',', '.'); ?>)</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <select name="ket" class="form-control">
                                        <option value="Bayar DP">Bayar DP</option>
                                        <option value="Bayar Full">Bayar Full</option>
                                        <option value="Tidak Bayar">Tidak Bayar</option>
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