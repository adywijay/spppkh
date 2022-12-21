<?php
//$a = $this->survey_model->count_by();
$dasbor = $this->akun_model->get_by_sesi();
?>
<section id="content">
    <div class="container">
        <div id="work-collections">
            <div class="row">
                <div class="col s12 m12 l3"></div>
                <div class="col s12 m12 l6">
                    <div id="flight-card" class="card white" style="border-radius:9px;">
                        <div class="gradient-45deg-light-blue-cyan"></div>
                        <ul>
                            <!--Modal Demo-->
                            <div id="modals-demo" class="section">
                                <div class="row"  style="margin-bottom:4px;">
                                    <div class="col s12 m8 l9">
                                        <p style="padding-left: 8px;"><a class="waves-effect waves-light btn modal-trigger  light-blue" href="#modal1">Petunjuk&nbsp;<i class="material-icons small" style="margin-bottom: 5px;">help_outline</i></a></p>
                                        <div id="modal1" class="modal" style="border-radius:3px !important; margin-top:4px;">
                                            <div class="modal-content">
                                                <p class="justify">Selamat datang <b><?php echo $this->session->userdata('username'); ?></b>&nbsp;di Sistem Prediksi Penerimaan Bantuan Program Keluarga Harapan (SPPPKH), anda masuk sistem sebagai Surveyer.
                                                    pengisian data survey sesuai data manual form<blockquote>Verifikasi dan Validasi Data dari KEMSOS</blockquote> jika mengalami kendala dalam pengisian, silahkan menghubungi bagian admin pelayanan kelurahan
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" class="waves-effect waves-light light-blue white-text btn-flat modal-action modal-close left" style="margin-left:320px;">Mengerti</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($dasbor as $f) { ?>
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
                    <a href="<?php echo site_url('tampil_survey'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content  green white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i>Data (Input Survey) Masuk</p>
                                <h4 class="card-stats-number center" style="margin-right:20px;"><i class="mdi mdi-account-badge-horizontal-outline"></i>&nbsp;&nbsp;<?php echo $this->survey_model->count_by(); ?></h4>
                                </p>
                            </div>
                            <div class="card-action  green darken-2">
                                <div id="clients-bar" class="center-align">

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--work collections end-->
<!-- START CONTENT -->

<!-- END CONTENT -->
</div>
</div>
