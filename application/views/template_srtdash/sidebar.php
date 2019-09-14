<!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="logo">
                <a href="<?=base_url()?>srtdash">
                    <h1 style="color: #fff">WO</h1>
                    <!-- <img src="<?=base_url()?>assets_srtdash/images/icon/logo.png" alt="logo"> -->
                </a>
            </div>
        </div>
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <li class="active"><a href="<?=base_url()?>srtdash"><i class="ti-map-alt"></i> <span>dashboard</span></a></li>
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Master Data</span></a>
                            <ul class="collapse">
                                <li <?=@$link == 'user' ? 'class="active"' : ''?>><a href="<?=base_url()?>user">User</a></li>
                                <li <?=@$link == 'gedung' ? 'class="active"' : ''?>><a href="<?=base_url()?>gedung">Gedung</a></li>
                                <li <?=@$link == 'transaksi' ? 'class="active"' : ''?>><a href="<?=base_url()?>transaksi">Laporan</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
<!-- sidebar menu area end -->
