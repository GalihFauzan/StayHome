<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
    <div class="col-lg-4 auth-box bg-white">
        <div class="p-3">
            <div class="text-center">
                <img src="assets/images/logo.jpg" style="width: 200px;" alt="wrapkit">
            </div>
            <form class="mt-4" action="scr_login.php" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uname">Username</label>
                            <input class="form-control" name="username" type="text" placeholder="masukan email/telp" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="pwd">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="masukkan password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-dark">Login</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>