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
                        <h4 class="header-title mb-0">Edit User</h4>
                        <a href="<?=base_url()?>user" >Back</a>
                    </div>

                    <hr/>
                    <form method="POST" action="<?=base_url()?>user/update">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="hidden" name="id_user" value="<?=$data_user->row()->id_user?>">
                            <input type="text" name="nama" value="<?=$data_user->row()->nama?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="email" value="<?=$data_user->row()->email?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" placeholder="Isi jika hanya anda ingin mengubah password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>No. HP:</label>
                            <input type="number" name="no_hp" value="<?=$data_user->row()->no_hp?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <select class="form-control" name="jk" required>
                                <option value="">--pilih--</option>
                                <option value="Laki-Laki" <?=$data_user->row()->jenis_kelamin == 'Laki-Laki'? 'selected':''?>>Pria</option>
                                <option value="Perempuan" <?=$data_user->row()->jenis_kelamin == 'Perempuan'? 'selected':''?>>Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level:</label>
                            <select class="form-control" name="level" required>
                                <option value="">--pilih--</option>
                                <option value="Admin" <?=$data_user->row()->level == 'Admin'? 'selected':''?>>Admin</option>
                                <option value="User" <?=$data_user->row()->level == 'User'? 'selected':''?>>Guest</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ALamat:</label>
                            <textarea class="form-control" name="alamat"><?=$data_user->row()->alamat?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- overview area end -->
</div>