<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=8">Pengaturan</a>
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
                        <!-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambahDataModal">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button> -->
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered table-hover">
                                <thead>
                                    <th width=20px>No</th>
                                    <th>Judul</th>
                                    <th>Informasi</th>

                                    <th width=100px>Aksi</th>
                                </thead>
                                <?php
                                include "../assets/conn/koneksi.php";
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM pengaturan");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['judul']; ?></td>
                                        <td><?php echo $d['informasi']; ?></td>

                                        <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>

                                        </td>
                                    </tr>
                                    <!-- Modal Ubah  -->
                                    <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="card-title">Pengaturan</h4>
                                                    </div>
                                                </div>
                                                <form action="backend/ubah_pengaturan.php" method="post">
                                                    <div class=" modal-body">
                                                        <!-- Grid System untuk dua kolom -->
                                                        <div class="row">

                                                            <div class="col-lg">
                                                                <!-- Isi formulir di kolom pertama -->
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                                                                    <label for="Judul">Judul</label>
                                                                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $d['judul']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="informasi">Informasi</label>
                                                                    <textarea name="info" class="form-control" id="mytextarea"><?php echo $d['informasi']; ?></textarea>
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
    <!-- Place the first <script> tag in your HTML's <head> -->