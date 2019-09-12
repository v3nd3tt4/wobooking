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
                        <h4 class="header-title mb-0">Edit Paket</h4>
                        <a href="<?=base_url()?>gedung/paket/<?=$id_gedung?>">Back</a>
                    </div>

                    <hr/>
                    <form method="POST" action="<?=base_url()?>gedung/update_paket">
                        <div class="form-group">
                            <label>Nama Paket:</label>
                            <input type="hidden" name="id_gedung" value="<?=$id_gedung?>">
                            <input type="hidden" name="id_paket" value="<?=$id_paket?>">
                            <input type="text" name="nama_paket" value="<?=$data_paket->row()->nama_paket?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Harga Paket:</label>
                            <input type="number" value="<?=$data_paket->row()->harga_paket?>" name="harga_paket" class="form-control" required />
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- overview area end -->
</div>