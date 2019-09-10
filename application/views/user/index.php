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
                        <h4 class="header-title mb-0">Overview</h4>
                        <a href="<?=base_url()?>user/tambah" class="btn btn-primary"><i class="ti-plus"></i> Tambah</a>
                    </div>

                    <hr/>
                    <div class="table-responsive">
                            <table id="myTable" class="table table-stripped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;foreach($data_user->result() as $row_user){?>
                                        <tr>
                                            <td><?=$no?>.</td>
                                            <td><?=$row_user->nama?></td>
                                            <td><?=$row_user->email?></td>
                                            <td><?=$row_user->level?></td>
                                            <th>
                                                <a href="<?=base_url()?>user/hapus/<?=$row_user->id_user?>" onclick="return confirm('are you sure?')" class="btn btn-xs btn-danger" ><i class="fa fa-remove"></i> Hapus</a>
                                                <a href="<?=base_url()?>user/edit/<?=$row_user->id_user?>" class="btn btn-xs btn-success" onclick="if(!confirm(\'Anda yakin mengedit data ini?\')) return false;"><i class="fa fa-pencil"></i> Edit</a>

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