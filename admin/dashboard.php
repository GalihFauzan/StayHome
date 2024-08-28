<?php
include "../assets/conn/koneksi.php";
$query = mysqli_query($conn, "
    SELECT tanggal_pembayaran, SUM(jumlah_pembayaran) AS total_pembayaran
    FROM pembayaran
    GROUP BY tanggal_pembayaran
    ORDER BY tanggal_pembayaran ASC
");
$data = [];
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
} else {
    echo "Data tidak ditemukan!";
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php?page=1">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card-group">
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">
                                    <?php
                                    // Menghubungkan ke file koneksi
                                    include "../assets/conn/koneksi.php";
                                    // Mendefinisikan query
                                    $query = "SELECT SUM(jumlah_pembayaran) AS total FROM pembayaran";
                                    // Melakukan query ke database
                                    $result = mysqli_query($conn, $query);
                                    // Mengambil hasil query
                                    $row = mysqli_fetch_assoc($result);
                                    // Menampilkan total pembayaran
                                    $total = $row['total'];
                                    echo number_format($total, 0, ',', '.');
                                    ?>
                                </h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Pendapatan Bulanan</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                <?php
                                include "../assets/conn/koneksi.php";
                                $query = mysqli_query($conn, "SELECT COUNT(id_kamar) AS total 
                                FROM user 
                                WHERE id_kamar IS NOT NULL AND id_kamar <> ''");
                                $result = mysqli_fetch_assoc($query);
                                $total = $result['total'];
                                echo $total;
                                ?>
                            </h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Kamar Terisi
                            </h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="home"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                <?php
                                include "../assets/conn/koneksi.php";
                                // Query untuk mendapatkan data user dan kamar
                                $query = mysqli_query($conn, "SELECT kamar.* FROM kamar LEFT JOIN user ON kamar.id_kamar = user.id_kamar WHERE user.id_kamar IS NULL");
                                // Periksa apakah query berhasil
                                if ($query) {
                                    // Hitung jumlah total baris dari hasil query
                                    $total = mysqli_num_rows($query);
                                    echo $total;
                                } else {
                                    // Jika query gagal, tampilkan pesan error
                                    echo "0";
                                }
                                ?>
                            </h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Kamar Kosong
                            </h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="home"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium"><?php
                                                                            // Menghubungkan ke file koneksi dan fungsi
                                                                            include "../assets/conn/koneksi.php";
                                                                            // Query untuk mengambil data invoice
                                                                            $today = date('Y-m-d'); // Tanggal hari ini
                                                                            $first_day_of_month = date('Y-m-01'); // Hari pertama bulan ini
                                                                            $query = "SELECT * FROM invoice WHERE status = 'Belum Dibayar' AND tanggal_invoice <= '$today'";
                                                                            // Eksekusi query
                                                                            $result = mysqli_query($conn, $query);
                                                                            $total = mysqli_num_rows($result);
                                                                            // Menampilkan total
                                                                            echo $total;
                                                                            ?></h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Penyewa Belum Bayar</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="users"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="150"></canvas>
                        <script>
                            // Ambil data dari PHP
                            var data = <?php echo json_encode($data); ?>;
                            // Parsing data untuk digunakan dalam Chart.js
                            var labels = [];
                            var values = [];
                            data.forEach(function(row) {
                                labels.push(row.tanggal_pembayaran);
                                values.push(row.total_pembayaran);
                            });
                            // Membuat grafik menggunakan Chart.js
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line', // tipe grafik bisa diganti: bar, pie, dll.
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Jumlah Pembayaran',
                                        data: values,
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End First Cards -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Sales Charts Section -->
        <!-- *************************************************************** -->

        <!-- *************************************************************** -->
        <!-- End Top Leader Table -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Data Booking</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered table-hover">
                                <thead>
                                    <th width=20px>No</th>
                                    <th>Nama Penyewa</th>
                                    <!-- <th>NIK</th> -->
                                    <th>No Hp</th>
                                    <th>Kamar</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tarif</th>
                                    <th>Keterangan</th>
                                    <th width=150px>Aksi</th>
                                </thead>
                                <?php
                                include '../assets/conn/koneksi.php';
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT user.*,biaya.* from user INNER JOIN biaya ON user.id_bayar=biaya.id where id_kamar=''");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['nama_user']; ?></td>
                                        <!-- <td><?php echo $d['nik']; ?></td> -->
                                        <td><?php echo $d['telp']; ?></td>
                                        <td><?php echo $d['id_kamar']; ?></td>
                                        <td><?php echo $d['tgl_sewa']; ?></td>
                                        <td><?php echo $d['tarif']; ?></td>
                                        <td><?php echo $d['keterangan']; ?></td>
                                        <td><a href="#" data-toggle="modal" data-target="#tampilkanDataModal<?php echo $no; ?>" class="btn btn-warning m-1"><i class="far fa-edit text-white"></i></a>
                                            <a href="backend/hapus_booking.php?id_user=<?php echo $d['id_user']; ?>" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Ubah  -->
                                    <div class=" modal fade" id="tampilkanDataModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center">
                                                        <h4 class="card-title">Konfirmasi Penyewa</h4>
                                                    </div>
                                                </div>
                                                <form action="backend/ubah_booking.php" method="post">
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
                                                                <!-- <div class="form-group">
                                                                    <label for="nik">NIK</label>
                                                                    <input type="number" class="form-control" id="nik" name="nik" value="<?php echo $d['nik']; ?>">
                                                                </div> -->
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $d['email']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat</label>
                                                                    <textarea name="alamat" class="form-control" id="" rows="3"><?php echo $d['nama_user']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <!-- Isi formulir di kolom pertama -->
                                                                <div class="form-group">
                                                                    <label for="no hp">No Hp/Telp</label>
                                                                    <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $d['telp']; ?>">
                                                                </div>
                                                                <?php
                                                                include '../assets/conn/koneksi.php';
                                                                $data = mysqli_query($conn, "SELECT kamar.* FROM kamar LEFT JOIN user ON kamar.id_kamar = user.id_kamar WHERE user.id_kamar IS NULL");
                                                                ?>
                                                                <div class="form-group">
                                                                    <label for="kamar">Kamar</label>
                                                                    <select class="form-control" id="kamar" name="kamar">

                                                                        <?php while ($row = mysqli_fetch_array($data)) { ?>
                                                                            <option value="<?php echo $row['id_kamar']; ?>"><?php echo $row['kamar']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">Password</label>
                                                                    <div class="input-group">
                                                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $d['password']; ?>">
                                                                    </div>
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