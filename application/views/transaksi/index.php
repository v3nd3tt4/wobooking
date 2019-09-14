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
                        <h4 class="header-title mb-0">Transaksi</h4>
                    </div>

                    <hr/>
                    <form method="POST" action="<?=base_url()?>transaksi/laporan_range">
                        <div class="form-group">
                            <label>Dari:</label>
                            <input type="date" class="form-control" name="first_date" required>
                        </div>
                        <div class="form-group">
                            <label>Sampai:</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-danger" value="cek">Cek</button>
                        <button type="submit" name="submit" class="btn btn-primary" value="cetak">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- overview area end -->
</div>