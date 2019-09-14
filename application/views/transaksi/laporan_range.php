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
                        <h4 class="header-title mb-0">Laporan</h4>
                        <a href="<?=base_url()?>transaksi/">Back</a>
                    </div>
                    <hr/>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <td>Dari</td>
                                <td>: <?=$from?></td>
                            </tr>
                            <tr>
                                <td>Sampai</td>
                                <td>: <?=$end?></td>
                            </tr>
                        </table>
                        <br/><br/>
                        <!-- <button class="btn btn-success" onclick="printData()"><i class="fa fa-print"></i> Cetak</button><br/><br/> -->
                        <table class="table table-striped" id="printTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pemesan</th>
                                    <th>Keterangan</th>
                                    <th>Gedung</th>
                                    <th>Paket</th>
                                    <th>Status</th>
                                    <th>Total Harga Paket</th>
                                    <th>Sudah dibayar</th>
                                    <th>Status Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;
                                
                                    foreach($data_transaksi->result() as $row){
                                        $tot = 0;
                                        
                                        $query_ket = $this->db->query("select * from tb_keterangan where id_paket = '".$row->id_paket."'");
                                        foreach ($query_ket->result() as  $value2) {
                                            $tot += $value2->harga_ket;
                                        }

                                        // $query_ket2 =  $this->db->query("select sum(jumlah_bayar) as tot from tb_transaksi where id_pesan_gedung = '".$row->id_pesan."' group by id_pesan_gedung");
                                        $query_ket2 =  $this->db->query("select * from tb_transaksi where id_pesan_gedung = '".$row->id_pesan."'");
                                        $tot2 = 0;
                                        foreach ($query_ket2->result() as $value3) {
                                            $tot2  += $value3->jumlah_bayar;
                                        }
                                        
                                    ?>
                                    <tr>
                                        <td><?=$no++?>.</td>
                                        <td><?=$row->tanggal_sewa?></td>
                                        <td><?=$row->nama_pemesan?></td>
                                        <td><?=$row->keterangan?></td>
                                        <td><?=$row->nama_gedung?></td>
                                        <td><?=$row->nama_paket?></td>
                                        <td><?=$row->status?></td>
                                        <td>Rp. <?=number_format($tot, 0, ',', '.')?></td>
                                        <td>Rp. <?=@number_format($tot2, 0, ',', '.')?></td>
                                        <td>
                                            <?php 
                                                if($row->status_pembayaran == 'Sudah Lunas'){
                                                    $cl = 'btn-success';
                                                }else{
                                                    $cl = 'btn-danger';
                                                }
                                            ?>
                                            
                                            <button class="btn btn-sm <?=$cl?>"><?=$row->status_pembayaran?></button>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- overview area end -->
</div>
<script type="text/javascript">
    function printData()
    {
       var divToPrint=document.getElementById("printTable");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }
</script>