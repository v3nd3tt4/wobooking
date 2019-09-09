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
                        <h4 class="header-title mb-0">Tambah Gedung</h4>
                        
                    </div>

                    <hr/>
                    <form method="POST" action="<?=base_url()?>gedung/store" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Gedung:</label>
                            <input type="text" name="nama" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>No. Telp:</label>
                            <input type="text" name="no_telp" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Gambar:</label>
                            <input type="file" name="gambar" class="form-control" required />
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