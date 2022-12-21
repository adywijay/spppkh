<div class="container">
    <div class="row">
        <div class="col s12 m4 l2"></div>
        <div class="col s12 m4 l8 white" style="border-radius:10px;">
            <ul id="task-card" class="collection with-header" style="border-radius:9px;">
                <li class="collection-header light-blue accent-2">
                    <h4 class="task-card-title center">Detail Hasil Input Survey</h4>
                </li>
                <div class="card-content container">
                    <div class="row">
                        <div class="col s12">
                            <div class="row"> 
                                <div class="input-field col s6">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['nik']; ?>"/>
                                    <label for="" class="red-text">NIK *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" placeholder="&nbsp;" disabled value="00<?php echo $admin['id']; ?>"/>
                                    <label for="" class="red-text">No.Survey *</label>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="input-field col s12">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['nama']; ?>"/>
                                    <label for="" class="red-text">Nama Calon Survey *</label>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="input-field col s12">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['kecamatan']; ?>"/>
                                    <label for="" class="red-text">Kecamatan *</label>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="input-field col s12">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['kabupaten']; ?>"/>
                                    <label for="" class="red-text">Kabupaten *</label>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="input-field col s12">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['propinsi']; ?>"/>
                                    <label for="" class="red-text">Propinsi *</label>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="input-field col s12">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['desa']; ?>"/>
                                    <label for="" class="red-text">Desa *</label>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="input-field col s12">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['alamat']; ?>"/>
                                    <label for="" class="red-text">Alamat *</label>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="input-field col s6">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['jml_art']; ?>"/>
                                    <label for="" class="red-text">Jumlah ART *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" placeholder="&nbsp;" disabled value="<?php echo $admin['jml_keluarga']; ?>"/>
                                    <label for="" class="red-text">Jumlah Keluarga *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['sta_lahan']; ?>"/>
                                    <label for="" class="red-text">Status Lahan *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['sta_bangunan']; ?>"/>
                                    <label for="" class="red-text">Status Bangunan *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ls_lantai']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Luas Lantai *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['jns_lantai']; ?>"/>
                                    <label for="" class="red-text">Jenis Lantai *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['jns_dinding']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Jenis Dinding *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['knds_dinding']; ?>"/>
                                    <label for="" class="red-text">Kondisi Dinding *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['jns_atap']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Jenis Atap *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['knds_atap']; ?>"/>
                                    <label for="" class="red-text">Kondisi Atap *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['jml_kamar']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Jumlah Kamar *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['smb_air_minum']; ?>"/>
                                    <label for="" class="red-text">Sumber Air Minum *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['cmdp_air_minum']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Cara Mendapat Air Minum *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['smb_penerangan']; ?>"/>
                                    <label for="" class="red-text">Sumber Penerangan *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['dy_listrik']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Daya Listrik *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['bb_masak']; ?>"/>
                                    <label for="" class="red-text">Bahan Bakar Masak *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['fasbab']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Fasil BAB *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['jns_kloset']; ?>"/>
                                    <label for="" class="red-text">Jenis Kloset *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['tp_akhir']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Tempat Pembuangan Akhir *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['ada_kulkas']; ?>"/>
                                    <label for="" class="red-text">Ada kulkas *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ada_ac']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Ada AC *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['ada_pemanas']; ?>"/>
                                    <label for="" class="red-text">Ada Pemanas *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ada_telepon']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Ada Telepon *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['ada_tgas']; ?>"/>
                                    <label for="" class="red-text">Ada Tabung Gas > 5 KG *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ada_tv']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Ada Televisi *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['ada_emas']; ?>"/>
                                    <label for="" class="red-text">Ada Emas 10 gram / Penghasilan Setara Berat Emas *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ada_komputer']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Ada Komputer / Laptop *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['ada_sepeda']; ?>"/>
                                    <label for="" class="red-text">Ada Sepeda (Onthel) *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ada_motor']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Ada Motor *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['ada_mobil']; ?>"/>
                                    <label for="" class="red-text">Ada Mobil *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ada_ast_tbergerak']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Ada Aset Tak Bergerak *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['luas_ast_tbergerak']; ?>"/>
                                    <label for="" class="red-text">Luas Aset Tak Bergerak *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['ada_rumah_lain']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Ada Rumah Lain *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['jml_sapi']; ?>"/>
                                    <label for="" class="red-text">Jumlah Sapi *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['jml_kambing']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Jumlah Kambing *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['sta_art_usaha']; ?>"/>
                                    <label for="" class="red-text">Status ART Usaha *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['sta_kks']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Status Kartu Keluarga Sehat (SKKS) *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['sta_kip']; ?>"/>
                                    <label for="" class="red-text">Status Kartu Indonesia Pintar (SKIP) *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['sta_bpjsm']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Status BPJSM *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['sta_jamsotek']; ?>"/>
                                    <label for="" class="red-text">Status JAMSOSTEK *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['sta_asuransi_lain']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Status Asuransi Kesehatan Lain *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['sta_rasta']; ?>"/>
                                    <label for="" class="red-text">Status RASTA *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['sta_kur']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Kredit Usaha Rakyat *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['ls_lahan']; ?>"/>
                                    <label for="" class="red-text">Luas Lahan *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;"type="text" disabled value="<?php echo $admin['percentile']; ?>"/>
                                    <label for="luas_ast_tbergerak" class="red-text">Percentile *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input placeholder="&nbsp;" type="text" disabled value="<?php echo $admin['sta_keberadaan_art']; ?>"/>
                                    <label for="" class="red-text">Status Keberadaan ART *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                </div>
                                <div class="input-field col s4">
                                    <input class="center" placeholder="&nbsp;" type="text" value="<?php echo $admin['id_akun']; ?>" disabled style="margin-left: 10px;"/><p style="margin-left:67px !important;"><?php echo $admin['tgl_input']; ?></p>
                                    <label for="id_akun" class="center teal-text" style="margin-left:85px !important;">ID Petugas Survey *</label>
                                    <br/>
                                    <a class=" center light-blue lighten-2 btn previous-step"style="margin-left:85px !important;" href="<?php echo site_url('manajemen_master');?>">OK</a>
                                </div>
                                <div class="input-field col s4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <div class="col s12 m4 l2"></div>
</div>

<!-- div tutup untuk footer ------------------------------------------------------------------------------------->
</div>
</div>
