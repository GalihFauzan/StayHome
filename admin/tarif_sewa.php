<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Tarif Sewa</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=10">Tarif Sewa</a>
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
                                    <th>Tarif</th>
                                    <th>Biaya DP</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>

                                </thead>
                                <?php
                                include "../assets/conn/koneksi.php";

                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM biaya");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo number_format($d['tarif'], 0, ',', '.'); ?></td>
                                        <td><?php echo number_format($d['dp'], 0, ',', '.'); ?></td>
                                        <td><?php echo $d['ket']; ?></td>
                                        <td>
                                            <a href="backend/hapus_tarif.php?id=<?php echo $d['id']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Ubah  -->

                                    <!-- Akhir Modal Ubah  -->
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--Modal Tambah  -->
    <div class=" modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
        <div class="modal-dialog modal-lg-6" role="document">
            <div class="modal-content">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tarif Sewa</h4>
                    </div>
                </div>
                <form action="backend/tambah_tarif.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="jenis">Tarif Sewa</label>
                                    <input type="number" class="form-control" id="tarif" name="tarif">
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Biaya DP</label>
                                    <input type="number" class="form-control" id="dp" name="dp">
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Keterangan</label>
                                    <input type="text" class="form-control" id="ket" name="ket">
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