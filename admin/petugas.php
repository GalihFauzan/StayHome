<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Petugas</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=4">Petugas</a>
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
                                    <th>Nama Petugas</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>No Hp</th>

                                    <th width=150px>Aksi</th>
                                </thead>
                                <?php
                                include '../assets/conn/koneksi.php';
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM petugas");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['nama_petugas']; ?></td>
                                        <td><?php echo $d['username']; ?></td>
                                        <td><?php echo $d['email']; ?></td>
                                        <td><?php echo $d['telp']; ?></td>

                                        <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>
                                            <a href="backend/hapus_petugas.php?id_petugas=<?php echo $d['id_petugas']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Ubah  -->
                                    <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="card-title">Ubah Kamar</h4>
                                                    </div>
                                                </div>
                                                <form action="backend/ubah_petugas.php" method="post" enctype="multipart/form-data">
                                                    <div class=" modal-body">
                                                        <!-- Grid System untuk dua kolom -->
                                                        <div class="row">

                                                            <div class="col-lg-6">
                                                                <!-- Isi formulir di kolom pertama -->
                                                                <input type="hidden" name="id" value="<?php echo $d['id_petugas']; ?>">
                                                                <div class="form-group">
                                                                    <label for="nama petugas">Nama Petugas</label>
                                                                    <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?php echo $d['nama_petugas']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="username">username</label>
                                                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $d['username']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $d['email']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_hp">No Hp/Telp</label>
                                                                    <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $d['telp']; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="password">Password</label>
                                                                    <div class="input-group">
                                                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $d['password']; ?>">
                                                                    </div>
                                                                </div>
                                                                <!-- Isi formulir di kolom pertama -->

                                                                <div class="form-group">
                                                                    <label for="foto">Foto</label>
                                                                    <input type="hidden" class="form-control-file" id="foto" name="old_foto" value="<?php echo $d['foto']; ?>">
                                                                    <input type="file" class="form-control-file" id="foto" name="foto[]" multiple />
                                                                    <img src="../assets/foto/<?php echo $d['foto']; ?>" width="200" alt="Gambar" class="rounded mt-2">

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
                        <h4 class="card-title">Data Petugas</h4>
                    </div>
                </div>
                <form action="backend/tambah_petugas.php" id="resetbuku" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <!-- Grid System untuk dua kolom -->
                        <div class="row">

                            <div class="col-lg-6">
                                <!-- Isi formulir di kolom pertama -->
                                <div class="form-group">
                                    <label for="nama petugas">Nama Petugas</label>
                                    <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Masukkan nama petugas">
                                </div>
                                <div class="form-group">
                                    <label for="username">username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No Hp/Telp</label>
                                    <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukkan no hp">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                    </div>
                                </div>
                                <!-- Isi formulir di kolom pertama -->

                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto[]" multiple />

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