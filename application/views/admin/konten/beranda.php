<section id="content">
    <div class="container">
        <div id="card-stats">
            <div class="row mt-1">
                <div class="col s12 m6 l3">
                    <a href="<?php echo site_url('manajemen_akun'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content  green white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i>Akun Terdaftar</p>
                                <h4 class="card-stats-number" style="margin-top:20px !important;"><i class="mdi mdi-account-badge-alert"></i>&nbsp;&nbsp;<?php echo $this->db->count_all('tbl_akun') ?></h4>
                            </div>
                            <div class="card-action  green darken-2">
                                <div id="clients-bar" class="center-align"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="<?php echo site_url('prediksi'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content pink lighten-1 white-text">
                                <p class="card-stats-title"><i class=""></i>Data Belum Terprediksi</p>
                                <h4 class="card-stats-number" style="margin-top:20px !important;"><i class="material-icons">notifications</i>&nbsp;&nbsp;<?php echo $this->db->where('keputusan_hasil',NULL)->get('tbl_hasil_prediksi')->num_rows(); ?></h4>
                            </div>
                            <div class="card-action pink darken-2">
                                <div id="clients-bar" class="center-align"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="<?php echo site_url('dtlatih'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content blue-grey white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i>Total Data Latih</p>
                                <p class="card-stats-number" style="margin-top:20px !important;"><i class="mdi mdi-sigma"></i>&nbsp;&nbsp;<?php echo $this->db->count_all('tbl_data_latih') ?></p>
                            </div>
                            <div class="card-action blue-grey darken-2">
                                <div id="clients-bar" class="center-align"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="<?php echo site_url('dtuji'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content purple white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i>Total Data Uji</p>
                                <p class="card-stats-number" style="margin-top:20px !important;"><i class="mdi  mdi-chart-areaspline"></i>&nbsp;&nbsp;<?php echo $this->db->count_all('tbl_data_uji') ?></p>
                            </div>
                            <div class="card-action purple darken-2">
                                <div id="clients-bar" class="center-align"></div>
                            </div>
                        </div>
                    </a>
<!--                    <div class="card" style="border-radius:5px;">
                        <div class="card-content gradient-45deg-green-teal gradient-shadow white-text center">
                            <p class="card-stats-title center"><i class="mdi mdi-24px mdi-chart-areaspline"></i>&nbsp;Total Data Uji</p>
                            <h4 class="card-stats-number"></h4>
                            </p>
                        </div>
                        <div class="card-action white">
                            <div class="center-align"><a class="btn btn-floating light-blue btn" href="<?php echo base_url() ?>admin/tampil_dtuji"><i class="mdi mdi-open-in-app"></i></a></div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <!-- //////////////////////////////////////////////////////////////////////////// -->
    </div>
    <?php
    $dasbor = $this->akun_model->get_by_sesi();
    ?>
    <!--end container-->
    <!--work collections start-->
    <div id="work-collections">
        <div class="row">
            <div class="col s12 m12 l3"></div>
            <div class="col s12 m12 l6 img-bg">
                <div id="flight-card" class="card" style="border-radius:5px;">
                    <?php foreach ($dasbor as $f) { ?>
                        <div class="gradient-45deg-light-blue-cyan"></div>
                        <ul>
                            <li class="center">
                                <img src="<?php echo base_url() ?>template/upload/profil/<?php echo $f->foto; ?>" class="img-profil z-depth-4 hoverable"/>
                            </li>
                        </ul>
                        <!-- Profile feed  -->
                        <ul class="collection">
                            <li class="collection-item avatar">
                                <i class="material-icons blue lighten-1 circle">stars</i>
                                <span class="title">Nama Lengkap</span>
                                <br/><span class="ultra-small"><?php echo $f->nama; ?></span>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons blue lighten-1 circle">laptop</i>
                                <span class="title">Jabatan</span>
                                <br> <span class="ultra-small"><?php echo $f->jabatan; ?></span>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons blue lighten-1 circle">phone_iphone</i>
                                <span class="title">No.Telepon Aktif</span>
                                <br> <span class="ultra-small"><?php echo $f->no_telp; ?></span>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons blue lighten-1 circle">assignment_ind</i>
                                <span class="title">Status Akun</span>
                                <br><span class="task-cat teal accent-4" style="margin-right:20px !important; text-align:justify-all;">
                                    <?php
                                    if ($f->status == 1) {
                                        echo'<b class="white-text">' . 'Tervalidasi' . '</b>';
                                    }
                                    if ($f->status == 0) {
                                        echo'<b class="white-text">' . 'Non.Validasi' . '</b>';
                                    }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="col s12 m12 l3">
                <div id="card-alert" class="card light-blue darken-1">
                    <div class="card-content white-text">
                        <p class="center"><i class="mdi mdi-face-agent"></i> Selamat Bertugas <b class="white-text hoverable"><?php echo $this->session->userdata('username'); ?></b><blockquote class="center white-text">Jika anda melakukan mining ambilah proporsi 70% dari jumlah data latih untuk data training dan sisanya dijadikan sebagai data tes</blockquote></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>

<footer class="page-footer light-blue accent-2 col-s12">
    <div class="footer-copyright">
        <div class="container">
            <span class="brand-logo center" style="position: relative;">Copyright ©
                <script type="text/javascript">
                    document.write(new Date().getFullYear("Y"));
                </script></span>
        </div>
    </div>
</footer>
