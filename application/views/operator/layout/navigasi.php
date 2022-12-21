<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- Navbar Mobile -->
<?php
$dasbor = $this->akun_model->get_by_sesi();
?>
<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav" class="activator">
    <ul id="nav-mobile" class="side-nav collapsible leftside-navigation">
        <li class="grey lighten-3">
            <div class="row">
                <?php foreach ($dasbor as $f){ ?>
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
                      <li><a href="<?php echo base_url('#'); ?>"><span class="mdi mdi-24px mdi-state-machine"></span>&nbsp;Mining Data</a></li>
                  </ul>
              </div>
          </li>-->
            <li class="bold">
                <div class="collapsible-header"><i class="mdi mdi-database"></i>Manajemen Data</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="<?php echo site_url('data_survey'); ?>"><span class="mdi mdi-24px mdi-account-check"></span>&nbsp;Data Survey</a></li>
                    </ul>
                </div>
            </li>
            <li class="bold">
                <div class="collapsible-header"><i class="mdi mdi-chart-arc"></i>Prediksi</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="<?php echo base_url('prediksi_operator') ?>;"><span class="mdi mdi-24px mdi-chart-scatter-plot-hexbin"></span>&nbsp;Hasil Prediksi</a></li>
                        <li><a href="<?php echo base_url('layak_operator'); ?>"><span class="mdi mdi-24px mdi-account-heart"></span>&nbsp;Layak Menerima</a></li>
                        <li><a href="<?php echo base_url('cadangan_operator'); ?>"><span class="mdi mdi-24px mdi-account-question"></span>&nbsp;Tidak Menerima</a></li>
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
                                <li><a href="<?php echo base_url('data_survey') ?>"><span class="mdi mdi-24px mdi-account-check"></span>&nbsp;Data Survey</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold">
                        <div class="collapsible-header"><i class="mdi mdi-chart-arc"></i>Prediksi</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('prediksi_operator'); ?>"><span class="mdi mdi-24px mdi-chart-scatter-plot-hexbin"></span>&nbsp;Hasil Prediksi</a></li>
                                <li><a href="<?php echo base_url('layak_operator'); ?>"><span class="mdi mdi-24px mdi-account-heart"></span>&nbsp;Layak Menerima</a></li>
                                <li><a href="<?php echo base_url('cadangan_operator'); ?>"><span class="mdi mdi-24px mdi-account-question"></span>&nbsp;Tidak Menerima</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </ul>
        </aside>
