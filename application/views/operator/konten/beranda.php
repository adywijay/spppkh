<?php
$dasbor = $this->akun_model->get_by_sesi();
?>
<section id="content">
    <div class="container">
        <div id="card-stats">
            <div class="row mt-1">
                <div class="col s12 m6 l3">
                    <a href="<?php echo site_url('/data_survey'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content  green white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i>Data (Input Survey) Masuk</p>
                                <h4 class="card-stats-number" style="margin-top:20px !important;"><i class="mdi mdi-account-group"></i>&nbsp;&nbsp;<?php echo $this->db->count_all('tbl_master') ?></h4>
                            </div>
                            <div class="card-action  green darken-2">
                                <div id="clients-bar" class="center-align"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="<?php echo site_url('prediksi_operator'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content pink lighten-1 white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i>Hasil Prediksi</p>
                                <h4 class="card-stats-number" style="margin-top:20px !important;"><i class="mdi mdi-account-multiple-check"></i>&nbsp;&nbsp;<?php echo $this->db->count_all('tbl_hasil_prediksi');?></h4>
                            </div>
                            <div class="card-action pink darken-2">
                                <div id="clients-bar" class="center-align"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="<?php echo site_url('tampil_petugas'); ?>">
                        <div class="card hoverable" style="border-radius:2px;">
                            <div class="card-content blue-grey white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i>Petugas Survey Profit</p>
                                <p class="card-stats-number" style="margin-top:20px !important;"><i class="mdi mdi-account-badge-horizontal"></i>&nbsp;&nbsp;<?php echo $this->akun_model->count_petugas_sv(); ?></p>
                            </div>
                            <div class="card-action blue-grey darken-2">
                                <div id="clients-bar" class="center-align"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col s12 m6 l3">
                </div>
            </div>
        </div>
        <!-- //////////////////////////////////////////////////////////////////////////// -->
    </div>
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
                            <!--Modal Demo-->
                            <div id="modals-demo" class="section">
                                <div class="row"  style="margin-bottom:4px;">
                                    <div class="col s12 m8 l9">
                                        <p style="padding-left: 8px;"><a class="waves-effect waves-light btn modal-trigger  light-blue" href="#modal1">Petunjuk&nbsp;<i class="material-icons small" style="margin-bottom: 5px;">help_outline</i></a></p>
                                        <div id="modal1" class="modal" style="border-radius:3px !important; margin-top:4px;position: center;">
                                            <div class="modal-content">
                                                <p class="justify">Selamat datang <b><?php echo $this->session->userdata('username'); ?></b>&nbsp;di Sistem Prediksi Penerimaan Bantuan Program Keluarga Harapan (SPPPKH), anda masuk sistem sebagai <b><?php $z = $this->session->userdata('id_akses');if($z=='2'){echo"Operator";} ?></b>.
                                                    <blockquote></blockquote> jika mengalami kendala dalam pengoperasian, silahkan menghubungi bagian admin pelayanan kelurahan
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" class="waves-effect waves-light light-blue white-text btn-flat modal-action modal-close left" style="margin-left:320px;">Mengerti</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            <div class="col s12 m12 l3"></div>   
            </div>
        </div>
</section>
</div>
</div>
