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
                        <h4 class="header-title mb-0">Paket</h4>
                        <a href="<?=base_url()?>gedung/tambah_paket/<?=$id_gedung?>" class="btn btn-primary"><i class="ti-plus"></i> Tambah</a>
                    </div>

                    <hr/>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <tr>
                                        <td>Nama Gedung</td>
                                        <td><?=$data_gedung->row()->nama_gedung?></td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td><?=$data_gedung->row()->no_telp?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?=$data_gedung->row()->alamat?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <center>
                            <img src="<?=base_url()?>file_upload/<?=$data_gedung->row()->gambar?>" class="img-responsive" style="max-width:250px"/>
                            </center>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="table-responsive">
                        <table  id="myTable"  class="table table-striped table-border">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Harga Paket</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;foreach($data_paket->result() as $row_paket){?>
                                    <tr>
                                        <td><?=$no?>.</td>
                                        <td><?=$row_paket->nama_paket?></td>
                                        <td><?=$row_paket->harga_paket?></td>
                                        <th>
                                            <a href="<?=base_url()?>gedung/hapus_paket/<?=$row_paket->id_paket?>" onclick="return confirm('are you sure?')" class="btn btn-xs btn-danger" ><i class="fa fa-remove"></i> Hapus</a>
                                            <a href="<?=base_url()?>gedung/edit_paket/<?=$row_paket->id_gedung?>/<?=$row_paket->id_paket?>" class="btn btn-xs btn-success" onclick="if(!confirm(\'Anda yakin mengedit data ini?\')) return false;"><i class="fa fa-pencil"></i> Edit</a>
                                        </th>
                                    </tr>
                                <?php $no++;}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- overview area end -->
</div>