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
                        <h4 class="header-title mb-0">Validasi Pembayaran</h4>
                        <a onclick="window.history.go(-1); return false"; href="<?=base_url()?>transaksi/">Back</a>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form method="POST" action="<?=base_url()?>transaksi/store_validasi_trx">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td>File</td>
                                            <td><a target="_blank" href="<?=base_url()?>file_upload/<?=$data_bukti->row()->nama_file?>"><img src="<?=base_url()?>file_upload/<?=$data_bukti->row()->nama_file?>" style="max-width:250px"></a></td>
                                        </tr>
                                        <tr>
                                            <td>Type Transaksi</td>
                                            <td><?=$data_bukti->row()->type_transaksi?></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Bayar</td>
                                            <td><?=number_format($data_bukti->row()->jumlah_bayar, 0, ',', '.')?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Bayar</td>
                                            <td><?=$data_bukti->row()->tanggal_bayar?></td>
                                        </tr>
                                        <tr>
                                            <td>Validasi</td>
                                            <td>
                                                <input type="hidden" name="id_transaksi" value="<?=$data_bukti->row()->id_transaksi?>">
                                                <input type="hidden" name="type_transaksi" value="<?=$data_bukti->row()->type_transaksi?>">
                                                <input type="hidden" name="id_pesan_gedung" value="<?=$data_bukti->row()->id_pesan_gedung?>">
                                                <select class="form-control" name="validasi">
                                                    <option value="">--pilih--</option>
                                                    <option value="Valid" <?=$data_bukti->row()->status_bayar == 'Valid'? 'selected' : ''?>>valid</option>
                                                    <option value="Tidak Valid" <?=$data_bukti->row()->status_bayar == 'Tidak Valid'? 'selected' : ''?>>Tidak Valid</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <br/><br/>
</div>
