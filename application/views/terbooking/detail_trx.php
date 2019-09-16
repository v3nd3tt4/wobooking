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
                        <h4 class="header-title mb-0">Detail Transaksi</h4>
                        <a href="<?=base_url()?>transaksi/">Back</a>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>Nama Gedung</td>
                                        <td><?=$data_transaksi->row()->nama_gedung?></td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td><?=$data_transaksi->row()->no_telp?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?=$data_transaksi->row()->alamat?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <center>
                            <img src="<?=base_url()?>file_upload/<?=$data_transaksi->row()->gambar?>" class="img-responsive" style="max-width:250px"/>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <br/><br/>
    <!-- overview area end -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Detail Pemesan</h4>
                    </div>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>Pemesan</td>
                                <td>: <?=$data_transaksi->row()->nama_pemesan?></td>
                            </tr>
                            <tr>
                                <td>Tanggal pesan</td>
                                <td>: <?=$data_transaksi->row()->tanggal_sewa?></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>: <?=$data_transaksi->row()->keterangan?></td>
                            </tr>
                            <tr>
                                <td>Status Pemesanan</td>
                                <td>: 
                                    <?php 
                                        if($data_transaksi->row()->status == 'pending'){
                                            $cl = 'btn-warning';
                                        }else if($data_transaksi->row()->status == 'expired'){
                                            $cl = 'btn-danger';
                                        }else if($data_transaksi->row()->status == 'ordered'){
                                            $cl = 'btn-success';
                                        }
                                    ?>
                                    <button class="btn btn-sm <?=$cl?>"><?=$data_transaksi->row()->status?></button>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>: <?php 
                                        if($data_transaksi->row()->status_pembayaran == 'Sudah Lunas'){
                                            $cl = 'btn-success';
                                        }else{
                                            $cl = 'btn-danger';
                                        }
                                    ?>
                                    <button class="btn btn-sm <?=$cl?>"><?=$data_transaksi->row()->status_pembayaran?></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Bukti Bayar</h4>
                    </div>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bukti</th>
                                    <th>Jenis</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php $no=1;foreach($data_bukti->result() as $row_bukti){?>
                                    <tr>
                                        <td><?=$no?>.</td>
                                        <td><a target="_blank" href="<?=base_url()?>file_upload/<?=$row_bukti->nama_file?>"><img src="<?=base_url()?>file_upload/<?=$row_bukti->nama_file?>" style="max-width:250px"></a></td>
                                        <td><?=$row_bukti->type_transaksi?></td>
                                        <td>Rp. <?=number_format($row_bukti->jumlah_bayar,0, ',', '.')?></td>
                                        <td><?=$row_bukti->tanggal_bayar?></td>
                                        <td><?=$row_bukti->status_bayar?></td>
                                    </tr>
                                <?php $no++;}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
