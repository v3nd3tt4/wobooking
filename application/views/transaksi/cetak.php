<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script type="text/javascript">
        var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet){
      style.styleSheet.cssText = css;
    } else {
      style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);

    window.print();

    </script>
    <style type="text/css">
        table, th, td
        {
          border-collapse:collapse;
          border: 1px solid black;/*
          width:100%;*/
          padding: 1px;
          /*text-align:right;*/
        }
    </style>
    
</head>
<body>
    <center>
    <h2>Laporan</h2>
    </center>
    <hr/>
    <center>
        <table>
            <tr>
                <td>Dari: <?=$from?> Sampai: <?=$end?> </td>
            </tr>
            
        </table>
    </center>
    <br/><br/>
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
                    <td><?=$row->status_pembayaran?></td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</body>
</html>