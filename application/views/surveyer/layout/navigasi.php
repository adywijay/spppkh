<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- Navbar Mobile -->
<?php
$dasbor = $this->akun_model->get_by_sesi();
?>
<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav" class="activator">
    <ul id="nav-mobile" class="side-nav collapsible leftside-navigation">
        <li class="grey lighten-3">
            <?php foreach ($dasbor as $f) { ?>
                <div class="row">
                    <div class="col s4 m4 l4">
                        <img src="<?php echo base_url() ?>template/upload/profil/<?php echo $f->foto; ?>" class="circle valign image-login center nav-posisi-foto">
                    </div>
                </div>
            <?php } ?>
        </li>
        <ul class="collapsible" data-collapsible="accordion">
            <li class="bold">
                <div class="collapsible-header"><i class="mdi mdi-database"></i>Data Survey</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="<?php echo site_url('survey') ?>"><span class="mdi mdi-24px mdi-account-check"></span>&nbsp;Input Data Survey</a></li>
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
                <?php foreach ($dasbor as $f) { ?>
                    <li class="grey lighten-3">
                        <div class="row">
                            <div class="col s4 m4 l4">
                                <img src="<?php echo base_url() ?>template/upload/profil/<?php echo $f->foto; ?>" class="circle valign image-login center nav-posisi-foto">
                            </div>
                        </div>
                    <?php } ?>
                </li>
                <ul class="collapsible" data-collapsible="accordion">
                    <li class="bold">
                        <div class="collapsible-header"><i class="mdi mdi-database"></i>Data Survey</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo site_url('survey') ?>"><span class="mdi mdi-24px mdi-account-check"></span>&nbsp;Input Data Survey</a></li>
                            </ul>
                        </div>
                    </li>
<!--                    <li class="bold">
                        <div class="collapsible-header"><i class="mdi mdi-alert-circle-check-outline"></i>Petunjuk Pengisian</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href=""><span class="mdi mdi-24px mdi-account-check"></span>&nbsp;Input Form Survey</a></li>
                            </ul>
                        </div>
                    </li>-->
                </ul>
            </ul>
        </aside>
