<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Riwayat Pembayaran</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=3">Riwayat Pembayaran</a>
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
                        <!-- <a href="index.php?page=6" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-list"></i>
                            Data Pembayaran
                        </a> -->
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
                                $query = mysqli_query($conn, "SELECT user.id_user,user.nama_user,kamar.kamar,invoice.tanggal_invoice,invoice.status,pembayaran.id_pembayaran,pembayaran.tanggal_pembayaran,pembayaran.jumlah_pembayaran FROM user INNER JOIN kamar ON user.id_kamar=kamar.id_kamar INNER JOIN invoice ON invoice.id_user=user.id_user INNER JOIN pembayaran ON pembayaran.id_invoice=invoice.id_invoice where invoice.status='Lunas' and user.id_user=$_SESSION[id]");
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
                                        <td><a href="print_pembayaran.php?id_pembayaran=<?php echo $d['id_pembayaran']; ?>" target="_blank" class="btn btn-info"><i class="fa fa-print text-white"></i></a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>