<div class="main-content-inner">
    <!-- sales report area start -->
    <div class="sales-report-area mt-5 mb-5">
        
    </div>
    <!-- sales report area end -->
    <!-- overview area start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Tambah User</h4>
                        <a href="<?=base_url()?>user" >Back</a>
                    </div>

                    <hr/>
                    <form method="POST" action="<?=base_url()?>user/store">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" name="nama" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>No. HP:</label>
                            <input type="number" name="no_hp" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <select class="form-control" name="jk" required>
                                <option value="">--pilih--</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level:</label>
                            <select class="form-control" name="level" required>
                                <option value="">--pilih--</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ALamat:</label>
                            <textarea class="form-control" name="alamat"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- overview area end -->
</div>