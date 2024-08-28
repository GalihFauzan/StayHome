<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
    <div class="col-lg-4 auth-box bg-white">
        <div class="p-3">
            <div class="text-center">
                <img src="assets/images/logo.jpg" style="width: 200px;" alt="wrapkit">
            </div>
            <form class="mt-4" action="scr_booking.php" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="form-group">
                            <label class="text-dark" for="uname">NIK</label>
                            <input class="form-control" name="nik" type="number" required>
                        </div> -->
                        <div class="form-group">
                            <label class="text-dark" for="uname">Email</label>
                            <input class="form-control" name="email" type="email" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" for="uname">No Hp</label>
                            <input class="form-control" name="telp" type="number" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" for="uname">Nama Lengkap</label>
                            <input class="form-control" name="nama" type="text" pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi yang diperbolehkan" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" for="uname">Password</label>
                            <input class="form-control" name="password" type="password" minlength="8" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark">Alamat</label>
                            <textarea name="alamat" class="form-control" id=""></textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Type Pembayaran</label>
                            <select name="id_bayar" class="form-control" id="pembayaran" onchange="updateTextBox()">
                                <?php
                                include "assets/conn/koneksi.php";
                                $query = mysqli_query($conn, "SELECT * FROM biaya");
                                while ($d = mysqli_fetch_assoc($query)) {
                                ?>
                                    <option value="<?php echo $d['id']; ?>"><?php echo number_format($d['tarif'], 0, ',', '.'); ?>/<?php echo $d['ket']; ?>(DP:<?php echo number_format($d['dp'], 0, ',', '.'); ?>)</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Keterangan</label>
                            <select name="ket" class="form-control">
                                <option value="Bayar DP">Bayar DP</option>
                                <option value="Bayar Full">Bayar Full</option>
                                <option value="Tidak Bayar">Tidak Bayar</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-dark">Booking Sekarang</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>