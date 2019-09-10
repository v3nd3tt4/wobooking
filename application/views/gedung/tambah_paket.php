<div class="main-content-inner">
    <!-- sales report area start -->
    <div class="sales-report-area mt-5 mb-5">
        
    </div>
    <!-- sales report area end -->
    <!-- overview area start -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Tambah Paket</h4>
                        <a href="<?=base_url()?>gedung/paket/<?=$id_gedung?>">Back</a>
                    </div>

                    <hr/>
                    <form method="POST" action="<?=base_url()?>gedung/store_paket">
                        <div class="form-group">
                            <label>Nama Paket:</label>
                            <input type="hidden" name="id_gedung" value="<?=$id_gedung?>">
                            <input type="text" name="nama_paket" class="form-control" required />
                        </div>
                        <table id="table_ket" class="table table-striped table-ket">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Keterangan</h4>
                    </div>

                    <hr/>
                        <div class="form-group">
                            <label>Nama Paket:</label>
                            <input type="text" name="keterangan" class="keterangan form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Harga Paket:</label>
                            <input type="number" name="harga_keterangan" class="harga_keterangan form-control" required />
                        </div>
                        
                        <button type="button" class="btn btn-danger btn-tambah-ket"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <!-- overview area end -->
</div>