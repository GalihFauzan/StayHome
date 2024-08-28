<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand">
                <!-- Logo icon -->
                <a href="index.html">
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
                        <img src="../assets/images/logo.jpeg" width="150" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="../assets/images/logo.jpeg" width="150" alt="homepage" class="light-logo" />
                    </b>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                <!-- Notification -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i data-feather="bell" class="svg-icon"></i></span>

                        <span class="badge badge-primary notify-no rounded-circle">
                            <?php
                            // Menghubungkan ke file koneksi dan fungsi
                            include "../assets/conn/koneksi.php";
                            // Query untuk mengambil data invoice
                            $query = "SELECT invoice.id_invoice, invoice.tanggal_invoice, user.*, kamar.kamar, invoice.jumlah_invoice FROM invoice INNER JOIN user ON invoice.id_user = user.id_user INNER JOIN kamar ON user.id_kamar = kamar.id_kamar WHERE invoice.status = 'Belum Dibayar'";
                            // Eksekusi query
                            $result = mysqli_query($conn, $query);

                            $total = mysqli_num_rows($result);

                            // Menampilkan total
                            echo $total;
                            ?>

                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" style="width: 300px;">
                        <ul class="list-style-none">
                            <li>
                                <?php
                                include "../assets/conn/koneksi.php";
                                $query = "SELECT invoice.id_invoice, invoice.tanggal_invoice, user.*, kamar.kamar, invoice.jumlah_invoice FROM invoice INNER JOIN user ON invoice.id_user = user.id_user INNER JOIN kamar ON user.id_kamar = kamar.id_kamar WHERE invoice.status = 'Belum Dibayar'";
                                $result = mysqli_query($conn, $query);
                                while ($d = mysqli_fetch_assoc($result)) {
                                ?>
                                    <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="btn btn-success text-white rounded-circle btn-circle"><i data-feather="calendar" class="text-white"></i></span>
                                        <div class="w-75 d-inline-block v-middle pl-2">
                                            <h6 class="message-title mb-0 mt-1"><?php echo $d['nama_user']; ?></h6>
                                            <span class="font-12 text-nowrap d-block text-muted text-truncate"> <?php echo $d['tanggal_invoice']; ?></span>
                                            <span class="font-12 text-nowrap d-block text-muted">No Kamar : <?php echo $d['kamar']; ?></span>
                                        </div>
                                    </a>
                                <?php } ?>
                            </li>
                            <li>
                                <a class="nav-link pt-3 text-center text-dark" href="index.php?page=5">
                                    <strong>Check all notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
                <!-- End Notification -->
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->


            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        include "../assets/conn/koneksi.php";
                        // Ambil ID dari parameter URL atau session atau cara lain yang sesuai
                        $id = $_SESSION['id']; // Pastikan Anda mendapatkan ID dengan cara yang benar

                        // Eksekusi query untuk mendapatkan data petugas berdasarkan ID
                        $query = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas='$id'");

                        // Periksa apakah query berhasil dan ada data yang ditemukan
                        if ($query && mysqli_num_rows($query) > 0) {
                            // Ambil data petugas dari hasil query
                            $d = mysqli_fetch_assoc($query);
                        ?>
                            <img src="../assets/foto/<?php echo $d['foto']; ?>" class="rounded-circle" width="40">
                        <?php
                        } else {
                        ?>

                            <img src="../assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="40">
                        <?php
                        }
                        ?>
                        <!-- <img src="../assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="40"> -->
                        <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span class="text-dark"><?php echo $_SESSION['nama']; ?></span>
                    </a>

                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>