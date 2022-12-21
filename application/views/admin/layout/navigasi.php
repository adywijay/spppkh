<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- Navbar Mobile -->
<?php
$dasbor = $this->akun_model->get_by_sesi();
?>
<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav" class="activator">
    <ul id="nav-mobile" class="side-nav collapsible leftside-navigation">
        <li class="grey lighten-3">
            <?php foreach ($dasbor as $f){ ?>
                <div class="row">
                    <div class="col s4 m4 l4">
                        <img src="<?php echo base_url() ?>template/upload/profil/<?php echo $f->foto; ?>" class="circle valign image-login center nav-posisi-foto">
                    </div>
                </div>
            <?php } ?>
        </li>
        <ul class="collapsible" data-collapsible="accordion">
<!--          <li class="bold">
              <div class="collapsible-header"><i class="mdi mdi-help-circle"></i>Petunjuk</div>
              <div class="collapsible-body">
                  <ul>
                      <li><a href=""><span class="mdi mdi-24px mdi-state-machine"></span>&nbsp;Mining Data</a></li>
                  </ul>
              </div>
          </li>-->
            <li class="bold">
                <div class="collapsible-header"><i class="mdi mdi-database"></i>Manajemen Data</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="<?php echo base_url('manajemen_master'); ?>"><span class="mdi mdi-24px mdi-account-check"></span>&nbsp;Data Survey</a></li>
                        <li><a href="<?php echo base_url('manajemen_akun'); ?>"><span class="mdi mdi-24px mdi-account-multiple-plus"></span>&nbsp;Data Akun</a></li>
                        <li><a href="<?php echo base_url('akses'); ?>"><span class="mdi mdi-24px mdi-shield-account"></span>&nbsp;Data Akses</a></li>
                    </ul>
                </div>
            </li>
            <li class="bold">
                <div class="collapsible-header"><i class="mdi mdi-sigma"></i>Mining C4.5</div>
                <div class="collapsible-body">
                    <ul>
                        <!-- mdi-chart-bar-stacked -->
                        <li><a href="<?php echo base_url('dtlatih'); ?>"><span class="mdi mdi-24px mdi-clipboard-pulse"></span>&nbsp;Data Latih</a></li>
                        <li><a href="<?php echo base_url('dtuji'); ?>"><span class="mdi mdi-24px mdi-chart-bar-stacked "></span>&nbsp;Data Uji</a></li>
                        <li><a href="<?php echo base_url('keputusan'); ?>"><span class="mdi mdi-24px mdi-file-tree"></span>&nbsp;Pohon Keputusan</a></li>
                    </ul>
                </div>
            </li>
            <li class="bold">
                <div class="collapsible-header"><i class="mdi mdi-chart-arc"></i>Prediksi</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="<?php echo base_url('prediksi'); ?>"><span class="mdi mdi-24px mdi-chart-bell-curve-cumulative"></span>&nbsp;Olah Data Prediksi</a></li>
                        <li><a href="<?php echo base_url('hasil_prediksi'); ?>"><span class="mdi mdi-24px mdi-chart-pie"></span>&nbsp;Hasil Prediksi</a></li>
                        <li><a href="<?php echo base_url('central'); ?>"><span class="mdi mdi-24px mdi-database-search"></span>&nbsp;Central Prediksi</a></li>
                    </ul>
                </div>
            </li>
            <li class="bold">
                <div class="collapsible-header"><i class="mdi mdi-account-group"></i>Data Penerimaan</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="<?php echo base_url('layak'); ?>"><span class="mdi mdi-24px mdi-account-badge"></span>&nbsp;Layak Menerima</a></li>
                        <li><a href="<?php echo base_url('cadangan'); ?>"><span class="mdi mdi-24px mdi-account-question"></span>&nbsp;Tidak Menerima</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </ul>
</aside>
<!-- End Navbar Mobile -->
<!--Start Side Nav -->
<div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper activator">
        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="grey lighten-3">
                    <?php foreach ($dasbor as $f){ ?>
                        <div class="row">
                            <div class="col s4 m4 l4">
                                <img src="<?php echo base_url() ?>template/upload/profil/<?php echo $f->foto; ?>" class="circle valign image-login center nav-posisi-foto">
                            </div>
                        </div>
                    <?php } ?>
                </li>
                <ul class="collapsible" data-collapsible="accordion">
<!--                  <li class="bold">
                      <div class="collapsible-header"><i class="mdi mdi-help-circle"></i>Petunjuk</div>
                      <div class="collapsible-body">
                          <ul>
                              <li><a href=""><span class="mdi mdi-24px mdi-state-machine"></span>&nbsp;Mining Data</a></li>
                          </ul>
                      </div>
                  </li>-->
                    <li class="bold">
                        <div class="collapsible-header"><i class="mdi mdi-database"></i>Manajemen Data</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('manajemen_master'); ?>"><span class="mdi mdi-24px mdi-account-check"></span>&nbsp;Data Survey</a></li>
                                <li><a href="<?php echo base_url('manajemen_akun'); ?>"><span class="mdi mdi-24px mdi-account-multiple-plus"></span>&nbsp;Data Akun</a></li>
                                <li><a href="<?php echo base_url('akses'); ?>"><span class="mdi mdi-24px mdi-shield-account"></span>&nbsp;Data Akses</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold">
                        <div class="collapsible-header"><i class="mdi mdi-sigma"></i>Mining C4.5</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('dtlatih'); ?>"><span class="mdi mdi-24px mdi-clipboard-pulse"></span>&nbsp;Data Latih</a></li>
                                <li><a href="<?php echo base_url('dtuji'); ?>"><span class="mdi mdi-24px mdi-chart-bar-stacked "></span>&nbsp;Data Uji</a></li>
                                <li><a href="<?php echo base_url('keputusan'); ?>"><span class="mdi mdi-24px mdi-file-tree"></span>&nbsp;Pohon Keputusan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold">
                        <div class="collapsible-header"><i class="mdi mdi-chart-arc"></i>Prediksi</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('prediksi'); ?>"><span class="mdi mdi-24px mdi-chart-bell-curve-cumulative"></span>&nbsp;Olah Data Prediksi</a></li>
                                <li><a href="<?php echo base_url('hasil_prediksi'); ?>"><span class="mdi mdi-24px mdi-chart-pie"></span>&nbsp;Hasil Prediksi</a></li>
                                <li><a href="<?php echo base_url('central'); ?>"><span class="mdi mdi-24px mdi-database-search"></span>&nbsp;Central Prediksi</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold">
                        <div class="collapsible-header"><i class="mdi mdi-account-group"></i>Data Penerimaan</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('layak'); ?>"><span class="mdi mdi-24px mdi-account-badge"></span>&nbsp;Layak Menerima</a></li>
                                <li><a href="<?php echo base_url('cadangan'); ?>"><span class="mdi mdi-24px mdi-account-question"></span>&nbsp;Tidak Menerima</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </ul>
        </aside>
