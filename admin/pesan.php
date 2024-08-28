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
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=7">Keluhan</a>
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
                                    <th>Tanggal</th>
                                    <th>Nama Pengirim</th>
                                    <th>Kamar</th>
                                    <th>Subjek</th>
                                    <th>Keluhan</th>
                                    <th>Status</th>
                                    <th width=100px>Aksi</th>
                                </thead>
                                <?php
                                include "../assets/conn/koneksi.php";

                                $no = 1;
                                $query = mysqli_query($conn, "SELECT user.*,kamar.*,pesan.* FROM pesan INNER JOIN user ON pesan.id_user = user.id_user INNER JOIN kamar ON kamar.id_kamar= pesan.id_kamar");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['tgl_pesan']; ?></td>
                                        <td><?php echo $d['nama_user']; ?></td>
                                        <td><?php echo $d['kamar']; ?></td>
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
                                        <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Ubah  -->
                                    <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="card-title">Keluhan</h4>
                                                    </div>
                                                </div>
                                                <form action="backend/ubah_pesan.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id_pesan" value="<?php echo $d['id_pesan']; ?>">
                                                                    <label for="jenis">Judul</label>
                                                                    <input type="text" class="form-control" name="judul" value="<?php echo $d['judul']; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="informasi">Keluhan</label>
                                                                    <textarea name="pesan" class="form-control" readonly><?php echo $d['pesan']; ?> </textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                                                        <option value="Selesai">Selesai</option>
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