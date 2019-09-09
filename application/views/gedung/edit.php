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
                        <h4 class="header-title mb-0">Edit Gedung</h4>
                        
                    </div>

                    <hr/>
                    <form method="POST" action="<?=base_url()?>gedung/update" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Gedung:</label>
                            <input type="hidden" name="id_gedung" value="<?=$data_gedung->row()->id_gedung?>">
                            <input type="text" name="nama" value="<?=$data_gedung->row()->nama_gedung?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>No. Telp:</label>
                            <input type="text" name="no_telp" value="<?=$data_gedung->row()->no_telp?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Gambar: </label>
                            <input type="file" name="gambar" class="form-control" />
                            <small>Isi jika anda ingin mengubah gambar</small>
                        </div>
                        <div class="form-group">
                            <label>Alamat:</label>
                            <textarea class="form-control" name="alamat"><?=$data_gedung->row()->alamat?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- overview area end -->
</div>