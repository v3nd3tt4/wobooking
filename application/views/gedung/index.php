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
                        <h4 class="header-title mb-0">Gedung</h4>
                        <a href="<?=base_url()?>gedung/tambah" class="btn btn-primary"><i class="ti-plus"></i> Tambah</a>
                    </div>

                    <hr/>
                    <div class="table-responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Gedung</th>
                                    <th>No Telpon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;foreach($data_gedung->result() as $row_gedung){?>
                                    <tr>
                                        <td><?=$no?>.</td>
                                        <td><img src="<?=base_url()?>file_upload/<?=$row_gedung->gambar?>" class="img-responsive" style="max-width:250px"/></td>
                                        <td><?=$row_gedung->nama_gedung?></td>
                                        <td><?=$row_gedung->no_telp?></td>
                                        <th>
                                            <a href="<?=base_url()?>gedung/hapus/<?=$row_gedung->id_gedung?>" onclick="return confirm('are you sure?')" class="btn btn-xs btn-danger" ><i class="fa fa-remove"></i> Hapus</a>
                                            <a href="<?=base_url()?>gedung/edit/<?=$row_gedung->id_gedung?>" class="btn btn-xs btn-success" onclick="if(!confirm(\'Anda yakin mengedit data ini?\')) return false;"><i class="fa fa-pencil"></i> Edit</a>

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