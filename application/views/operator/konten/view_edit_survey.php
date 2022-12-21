<div class="container">
    <div class="row">
        <div class="col s12 m4 l2"></div>
        <div class="col s12 m4 l8 white" style="border-radius:10px;">
            <ul id="task-card" class="collection with-header" style="border-radius:9px;">
                <li class="collection-header light-blue accent-2">
                    <h4 class="task-card-title center">Edit Hasil Input Survey</h4>
                </li>
                 <?php echo form_open('operator/action_edit');?>
                    <div class="card-content container">
                        <div class="row">
                            <div class="col s12">
                                <div class="row"> 
                                    <div class="input-field col s6">
                                        <input type="text" placeholder="&nbsp;" name="nik" class="validate" value="<?php echo $operator['nik']; ?>"/>
                                        <label for="nik" class="red-text">NIK *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" placeholder="&nbsp;" name="id" class="validate" disabled value="<?php echo $operator['id']; ?>"/>
                                        <label for="id" class="red-text">No.Survey *</label>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="input-field col s12">
                                        <input type="text" placeholder="&nbsp;" name="nama" class="validate" value="<?php echo $operator['nama']; ?>"/>
                                        <label for="nama" class="red-text">Nama Calon Survey *</label>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="input-field col s12">
                                        <input type="text" placeholder="&nbsp;" name="kecamatan" class="validate" disabled value="<?php echo $operator['kecamatan']; ?>"/>
                                        <label for="kecamatan" class="red-text">Kecamatan *</label>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="input-field col s12">
                                        <input type="text" placeholder="&nbsp;" name="kabupaten" class="validate" disabled value="<?php echo $operator['kabupaten']; ?>"/>
                                        <label for="kabupaten" class="red-text">Kabupaten *</label>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="input-field col s12">
                                        <input type="text" placeholder="&nbsp;" name="propinsi" class="validate" disabled value="<?php echo $operator['propinsi']; ?>"/>
                                        <label for="propinsi" class="red-text">Propinsi *</label>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="input-field col s12">
                                        <input type="text" placeholder="&nbsp;" name="desa" class="validate" value="<?php echo $operator['desa']; ?>"/>
                                        <label for="" class="red-text">Desa *</label>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="input-field col s12">
                                        <input type="text" placeholder="&nbsp;" name="alamat" class="validate" value="<?php echo $operator['alamat']; ?>"/>
                                        <label for="" class="red-text">Alamat *</label>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="input-field col s6">
                                        <input type="text" placeholder="&nbsp;" name="jml_art" class="validate" value="<?php echo $operator['jml_art']; ?>"/>
                                        <label for="" class="red-text">Jumlah ART *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" placeholder="&nbsp;" name="jml_keluarga" class="validate" value="<?php echo $operator['jml_keluarga']; ?>"/>
                                        <label for="" class="red-text">Jumlah Keluarga *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="sta_lahan" class="validate" value="<?php echo $operator['sta_lahan']; ?>"/>
                                        <label for="" class="red-text">Status Lahan *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="" class="validate" value="<?php echo $operator['sta_bangunan']; ?>"/>
                                        <label for="" class="red-text">Status Bangunan *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ls_lantai" class="validate" value="<?php echo $operator['ls_lantai']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Luas Lantai *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="jns_lantai" class="validate" value="<?php echo $operator['jns_lantai']; ?>"/>
                                        <label for="" class="red-text">Jenis Lantai *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="jns_dinding" class="validate" value="<?php echo $operator['jns_dinding']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Jenis Dinding *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="knds_dinding" class="validate" value="<?php echo $operator['knds_dinding']; ?>"/>
                                        <label for="" class="red-text">Kondisi Dinding *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="jns_atap" class="validate" value="<?php echo $operator['jns_atap']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Jenis Atap *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="knds_atap" class="validate" value="<?php echo $operator['knds_atap']; ?>"/>
                                        <label for="" class="red-text">Kondisi Atap *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="jml_kamar" class="validate" value="<?php echo $operator['jml_kamar']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Jumlah Kamar *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="smb_air_minum" class="validate" value="<?php echo $operator['smb_air_minum']; ?>"/>
                                        <label for="" class="red-text">Sumber Air Minum *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="cmdp_air_minum" class="validate" value="<?php echo $operator['cmdp_air_minum']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Cara Mendapat Air Minum *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="smb_penerangan" class="validate" value="<?php echo $operator['smb_penerangan']; ?>"/>
                                        <label for="" class="red-text">Sumber Penerangan *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="dy_listrik" class="validate" value="<?php echo $operator['dy_listrik']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Daya Listrik *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="bb_masak" class="validate" value="<?php echo $operator['bb_masak']; ?>"/>
                                        <label for="" class="red-text">Bahan Bakar Masak *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="fasbab" class="validate" value="<?php echo $operator['fasbab']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Fasil BAB *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="jns_kloset" class="validate" value="<?php echo $operator['jns_kloset']; ?>"/>
                                        <label for="" class="red-text">Jenis Kloset *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="tp_akhir" class="validate" value="<?php echo $operator['tp_akhir']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Tempat Pembuangan Akhir *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="ada_kulkas" class="validate" value="<?php echo $operator['ada_kulkas']; ?>"/>
                                        <label for="" class="red-text">Ada kulkas *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ada_ac" class="validate" value="<?php echo $operator['ada_ac']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Ada AC *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="ada_pemanas" class="validate" value="<?php echo $operator['ada_pemanas']; ?>"/>
                                        <label for="" class="red-text">Ada Pemanas *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ada_telepon" class="validate" value="<?php echo $operator['ada_telepon']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Ada Telepon *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="ada_tgas" class="validate" value="<?php echo $operator['ada_tgas']; ?>"/>
                                        <label for="" class="red-text">Ada Tabung Gas > 5 KG *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ada_tv" class="validate" value="<?php echo $operator['ada_tv']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Ada Televisi *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="ada_emas" class="validate" value="<?php echo $operator['ada_emas']; ?>"/>
                                        <label for="" class="red-text">Ada Emas 10 gram / Penghasilan Setara Berat Emas *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ada_komputer" class="validate" value="<?php echo $operator['ada_komputer']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Ada Komputer / Laptop *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="ada_sepeda" class="validate" value="<?php echo $operator['ada_sepeda']; ?>"/>
                                        <label for="" class="red-text">Ada Sepeda (Onthel) *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ada_motor" class="validate" value="<?php echo $operator['ada_motor']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Ada Motor *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="ada_mobil" class="validate" value="<?php echo $operator['ada_mobil']; ?>"/>
                                        <label for="" class="red-text">Ada Mobil *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ada_ast_tbergerak" class="validate" value="<?php echo $operator['ada_ast_tbergerak']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Ada Aset Tak Bergerak *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="luas_ast_tbergerak" class="validate" value="<?php echo $operator['luas_ast_tbergerak']; ?>"/>
                                        <label for="" class="red-text">Luas Aset Tak Bergerak *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="ada_rumah_lain" class="validate" value="<?php echo $operator['ada_rumah_lain']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Ada Rumah Lain *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="jml_kambing" class="validate" value="<?php echo $operator['jml_sapi']; ?>"/>
                                        <label for="" class="red-text">Jumlah Sapi *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="" class="validate" value="<?php echo $operator['jml_kambing']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Jumlah Kambing *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="sta_art_usaha" class="validate" value="<?php echo $operator['sta_art_usaha']; ?>"/>
                                        <label for="" class="red-text">Status ART Usaha *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="sta_kks" class="validate" value="<?php echo $operator['sta_kks']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Status Kartu Keluarga Sehat (SKKS) *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="sta_kip" class="validate" value="<?php echo $operator['sta_kip']; ?>"/>
                                        <label for="" class="red-text">Status Kartu Indonesia Pintar (SKIP) *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="sta_bpjsm" class="validate" value="<?php echo $operator['sta_bpjsm']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Status BPJSM *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="sta_jamsotek" class="validate" value="<?php echo $operator['sta_jamsotek']; ?>"/>
                                        <label for="" class="red-text">Status JAMSOSTEK *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="sta_asuransi_lain" class="validate" value="<?php echo $operator['sta_asuransi_lain']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Status Asuransi Kesehatan Lain *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="sta_rasta" class="validate" value="<?php echo $operator['sta_rasta']; ?>"/>
                                        <label for="" class="red-text">Status RASTA *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="" class="validate" value="<?php echo $operator['sta_kur']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Kredit Usaha Rakyat *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="ls_lahan" class="validate" value="<?php echo $operator['ls_lahan']; ?>"/>
                                        <label for="" class="red-text">Luas Lahan *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;"type="text" name="percentile" class="validate" value="<?php echo $operator['percentile']; ?>"/>
                                        <label for="luas_ast_tbergerak" class="red-text">Percentile *</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="&nbsp;" type="text" name="sta_keberadaan_art" class="validate" value="<?php echo $operator['sta_keberadaan_art']; ?>"/>
                                        <label for="" class="red-text">Status Keberadaan ART *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                    </div>
                                    <div class="input-field col s4">
                                        <input class="center" placeholder="&nbsp;" type="text" disabled value="<?php echo $operator['id_akun']; ?>" name="id_akun" class="validate" style="margin-left: 10px;"/><p style="margin-left:67px !important;"><?php echo $operator['tgl_input']; ?></p>
                                        <label for="id_akun" class="center teal-text" style="margin-left:85px !important;">ID Petugas Survey *</label>
                                        <br/>
                                        <button class=" center light-blue lighten-2 btn previous-step"style="margin-left:85px !important;" input type="submit">Update</button>
                                    </div>
                                    <div class="input-field col s4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            </ul>
        </div>
    </div>
    <div class="col s12 m4 l2"></div>
</div>

<!-- div tutup untuk footer ------------------------------------------------------------------------------------->
</div>
</div>
