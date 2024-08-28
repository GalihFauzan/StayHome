<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Keluhan</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=4">Keluhan</a>
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
                            Keluhan
                        </button>
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered table-hover">
                                <thead>
                                    <th width=20px>No</th>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Keluhan</th>
                                    <th>Status</th>
                                    <th width=100px>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php
                                    include "../assets/conn/koneksi.php";
                                    $id = $_SESSION['id'];
                                    $no = 1;
                                    $query = mysqli_query($conn, "SELECT * FROM pesan WHERE id_user='$id'");
                                    while ($d = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $d['tgl_pesan']; ?></td>
                                            <td><?php echo $d['judul']; ?></td>
                                            <td><?php echo $d['pesan']; ?></td>
                                            <td><?php
                                                if ($d['status'] == 'Menunggu Konfirmasi') {
                                                ?>
                                                    <span class="btn btn-danger btn-rounded"><?php echo $d['status']; ?></span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="btn btn-success btn-rounded"><?php echo $d['status']; ?></span>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="backend/hapus_pesan.php?id_pesan=<?php echo $d['id_pesan']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
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

    <!--Modal Tambah  -->
    <div class=" modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Kirim Pesan</h4>
                    </div>
                </div>
                <form action="backend/tambah_pesan.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                                    <label for="jenis">Judul</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul">
                                </div>
                                <div class="form-group">
                                    <label for="informasi">Keluhan</label>
                                    <textarea name="pesan" class="form-control" id="mytextarea"></textarea>
                                </div>
                                <div class="form-group">
                                    <?php
                                    include "../assets/conn/koneksi.php";
                                    $id = $_SESSION['id'];
                                    $data = mysqli_query($conn, "SELECT user.*,kamar.* from kamar INNER JOIN user ON  user.id_kamar=kamar.id_kamar where user.id_user='$id'");
                                    while ($d = mysqli_fetch_assoc($data)) {
                                    ?>
                                        <input type="hidden" name="id_kamar" value="<?php echo $d['id_kamar']; ?>">

                                    <?php  } ?>
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
    <!-- Akhir modal -->