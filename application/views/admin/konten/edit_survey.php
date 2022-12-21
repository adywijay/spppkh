<div class="container">
    <div class="row">
        <div class="col s12 m4 l2"></div>
        <div class="col s12 m4 l8">
            <div class="card" style="border-radius:10px;">
                <div style="margin-bottom:0px auto;">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open_multipart('admin/edit_survey'.$admin['id']);?>
                    <ul class="stepper horizontal" id="horizontal">
                        <li class="step">
                            <div class="step-title waves-effect waves-dark">Lembar 1</div>
                            <div class="step-content">
                                <h4 class="header2 center" style="margin-top: 0.5px;margin-bottom: 10px;">Form Biodata & Pengenalan Tempat</h4>
                                <br/>
                                <div class="row">
                                    <div class="col s12">
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input placeholder="Nomor Nik (18) Digit" name="nik" type="text" class="validate" maxlength="18" required value="<?php echo $admin['nik']; ?>" />
                                                <label for="nik" class="red-text">Nik *</label>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input placeholder="Nama Calon Penerima Bantuan" name="nama" type="text" class="validate" required value="<?php echo $admin['nama']; ?>"/>
                                                <label for="nama" class="red-text">Nama *</label>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input name="kecamatan" type="text" disabled value="<?php echo $admin['kecamatan']; ?>"/>
                                                <label for="kecamatan" class="red-text">Kecamatan </label>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input name="kabupaten" type="text" disabled value="<?php echo $admin['kabupaten']; ?>"/>
                                                <label for="kabupaten" class="red-text">Kabupaten </label>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input name="propinsi" type="text" disabled value="<?php echo $admin['propinsi']; ?>"/>
                                                <label for="propinsi" class="red-text">Propinsi </label>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input placeholder="Desa" name="desa" type="text" class="validate" required value="<?php echo $admin['desa']; ?>"/>
                                                <label for="desa" class="red-text">Desa *</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" name="alamat" type="text" class="validate" required value="<?php echo $admin['alamat']; ?>"/>
                                                <label for="alamat" class="red-text">Alamat *</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="jml_art" type="number" class="validate" required value="<?php echo $admin['jml_art']; ?>"/>
                                                <label for="alamat" class="red-text">Jumlah ART *</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="jml_keluarga" type="number" class="validate" required value="<?php echo $admin['jml_keluarga']; ?>"/>
                                                <label for="jml_keluarga" class="red-text">Jumlah Keluarga*</label>
                                            </div>
                                            <div class="col s12 m8 l9 right">
                                                <div class="row">
                                                    <div class="col s12 m4" style="margin-left: 450px;">
                                                        <a class="btn-floating waves-effect teal accent-4 next-step"><i class="material-icons">chevron_right</i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- LEMBAR 2 ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <li class="step">
                            <div class="step-title waves-effect waves-dark">Lembar 2</div>
                            <div class="step-content">
                                <h4 class="header2 center" style="margin-top: 0.5px;margin-bottom: 10px;">Form Survey Keterangan Perumahan</h4>
                                <br/>
                                <div class="row">
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Status Lahan *</label>
                                                <p>
                                                    <input name="sta_lahan" type="radio" id="MI" value="MI" <?php echo ($admin['sta_lahan'] == 'MI' ? ' checked' : ''); ?>/>
                                                    <label for="MI">Milik Sendiri</label>
                                                </p>
                                                <p>
                                                    <input name="sta_lahan" type="radio" id="MOL" value="MOL" <?php echo ($admin['sta_lahan'] == 'MOL' ? ' checked' : ''); ?>/>
                                                    <label for="MOL">Milik Orang Lain</label>
                                                </p>
                                                <p>
                                                    <input name="sta_lahan" type="radio" id="TN" value="TN" <?php echo ($admin['sta_lahan'] == 'TN' ? ' checked' : ''); ?>/>
                                                    <label for="TN">Tanah Negara</label>
                                                </p>
                                                <p>
                                                    <input name="sta_lahan" type="radio" id="LN" value="LN" <?php echo ($admin['sta_lahan'] == 'LN' ? ' checked' : ''); ?>/>
                                                    <label for="LN">Lainnya</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Status Bangunan *</label>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="MSI" value="MSI" <?php echo ($admin['sta_bangunan'] == 'MSI' ? ' checked' : ''); ?>/>
                                                    <label for="MSI">Milik Sendiri</label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="KSA" value="KSA" <?php echo ($admin['sta_bangunan'] == 'KSA' ? ' checked' : ''); ?>/>
                                                    <label for="KSA">Kontrak / Sewa</label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="BSA" value="BSA" <?php echo ($admin['sta_bangunan'] == 'BSA' ? ' checked' : ''); ?>/>
                                                    <label for="BSA">Bebas Sewa</label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="DNS" value="DNS" <?php echo ($admin['sta_bangunan'] == 'DNS' ? ' checked' : ''); ?>/>
                                                    <label for="DNS">Dinas </label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="LN1" value="LN" <?php echo ($admin['sta_bangunan'] == 'LN' ? ' checked' : ''); ?>/>
                                                    <label for="LN1">Lainnya</label>
                                                </p>  
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Jenis Lantai *</label>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="MMG" value="MMG" <?php echo ($admin['jns_lantai'] == 'MMG' ? ' checked' : ''); ?>/>
                                                    <label for="MMG">Marmer / Granit</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="KMK" value="KMK" <?php echo ($admin['jns_lantai'] == 'KMK' ? ' checked' : ''); ?>/>
                                                    <label for="KMK">Keramik</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="PVPI" value="PVPI" <?php echo ($admin['jns_lantai'] == 'PVPI' ? ' checked' : ''); ?>/>
                                                    <label for="PVPI">Parket Vinil Permadani</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="UTT" value="UTT" <?php echo ($admin['sta_bangunan'] == 'UTT' ? ' checked' : ''); ?>/>
                                                    <label for="UTT">Ubin / Tegel / Teraso </label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="KPKT" value="KPKT" <?php echo ($admin['jns_lantai'] == 'KPKT' ? ' checked' : ''); ?>/>
                                                    <label for="KPKT">Kayu / Papan Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="SBM" value="SBM"  <?php echo ($admin['jns_lantai'] == 'SBM' ? ' checked' : ''); ?>/>
                                                    <label for="SBM">Sementara / Bata Merah</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="BMB" value="BMB"  <?php echo ($admin['jns_lantai'] == 'BMB' ? ' checked' : ''); ?>/>
                                                    <label for="BMB">Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="KPKR" value="KPKR"  <?php echo ($admin['jns_lantai'] == 'KPKR' ? ' checked' : ''); ?>/>
                                                    <label for="KPKR">Kayu / Papan Kualitas Rendah</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="TNH" value="TNH" <?php echo ($admin['jns_lantai'] == 'TNH' ? ' checked' : ''); ?> />
                                                    <label for="TNH">Tanah</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="LN8" value="LN"  <?php echo ($admin['jns_lantai'] == 'LN' ? ' checked' : ''); ?>/>
                                                    <label for="LN8">Lainnya</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Jenis Dinding *</label>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="TBK" value="TBK" <?php echo ($admin['jns_dinding'] == 'TBK' ? ' checked' : ''); ?>/>
                                                    <label for="TBK">Tembok</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="PABK" value="PABK" <?php echo ($admin['jns_dinding'] == 'PABK' ? ' checked' : ''); ?>/>
                                                    <label for="PABK">Plesteran Anyam Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="KYU" value="KYU" <?php echo ($admin['jns_dinding'] == 'KYU' ? ' checked' : ''); ?>/>
                                                    <label for="KYU">Kayu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="ABU" value="ABU" <?php echo ($admin['jns_dinding'] == 'ABU' ? ' checked' : ''); ?>/>
                                                    <label for="ABU">Anyaman Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="BKYU" value="BKYU" <?php echo ($admin['jns_dinding'] == 'BKYU' ? ' checked' : ''); ?>/>
                                                    <label for="BKYU">Batang Kayu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="BBU" value="BBU" <?php echo ($admin['jns_dinding'] == 'BBU' ? ' checked' : ''); ?>/>
                                                    <label for="BBU">Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="LN2" value="LN" <?php echo ($admin['jns_dinding'] == 'LN' ? ' checked' : ''); ?>/>
                                                    <label for="LN2">Lainnya</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Kondisi Dinding *</label>
                                                <p>
                                                    <input name="knds_dinding" type="radio" id="BKT" value="BKT" <?php echo ($admin['knds_dinding'] == 'BKT' ? ' checked' : ''); ?>/>
                                                    <label for="BKT">Bagus Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="knds_dinding" type="radio" id="JKR" value="JKR" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="JKR">Jelek Kualitas Rendah</label>
                                                </p>  
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Kondisi Atap *</label>
                                                <p>
                                                    <input name="knds_atap" type="radio" id="BKT1" value="BKT" <?php echo ($admin['knds_atap'] == 'BKT' ? ' checked' : ''); ?>/>
                                                    <label for="BKT1">Bagus Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="knds_atap" type="radio" id="JKR1" value="JKR" <?php echo ($admin['knds_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="JKR1">Jelek Kualitas Rendah</label>
                                                </p>    
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Jenis Atap *</label>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="BGB" value="BGB" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="BGB">Beton/Genting Beton</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="GKK" value="GKK" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="GKK">Genteng Keramik</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="GML" value="GML" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="GML">Genteng Metal</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="GTL" value="GTL" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="GTL">Genteng Tanah Liat</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="ASS" value="ASS" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="ASS">Asbes</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="SNG" value="SNG" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="SNG">Seng</label>
                                                </p>    
                                                <p>
                                                    <input name="jns_atap" type="radio" id="SRP" value="SRP" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="SRP">Sirap</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="BMB" value="BMB" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="BMB">Bambu</label>
                                                </p> 
                                                <p>
                                                    <input name="jns_atap" type="radio" id="JIDDR" value="JIDDR" <?php echo ($admin['jns_atap'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="JIDDR">Bagus Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="LN3" value="LN" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="LN3">Lainnya</label>
                                                </p>    
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Sumber Air Minum *</label>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="AKB" value="AKB" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="AKB">Air Kemasan Bermerk</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="AIU" value="AIU" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="AIU">Air Isi Ulang</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="LMN" value="LMN" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="LMN">Ledeng Meteran</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="LEN" value="LEN" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="LEN">Ledeng Eceran</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="SBP" value="SBP" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="SBP">Sumur / Bor Pompa</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="SNG" value="STG" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="STG">Sumur Terlindung</label>
                                                </p>    
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="STTG" value="STTG" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="STTG">Sumur Tak Terlindung</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="MAT" value="MAT" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="MAT">Mata Air Terlindung</label>
                                                </p> 
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="MATT" value="MATT" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="MATT">Mata Air Tak Terlindung</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="ASDW" value="ASDW" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="ASDW">Air Sungai Danau Waduk</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="AHN" value="AHN" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="AHN">Air Hujan</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="LN4" value="LN" <?php echo ($admin['knds_dinding'] == 'JKR' ? ' checked' : ''); ?>/>
                                                    <label for="LN4">Lainnya</label>
                                                </p>     
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="ls_lantai" type="text" class="validate" required value="<?php echo $admin['ls_lantai']; ?>"/>
                                                <label for="ls_lantai" class="red-text">Luas Lantai (M<sup>2</sup>) *</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="jml_kamar" type="number" class="validate" required value="<?php echo $admin['jml_kamar']; ?>"/>
                                                <label for="jml_kamar" class="red-text">Jumlah Kamar *</label>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Cara Memperoleh Air Minum *</label>
                                                <p>
                                                    <input name="cmdp_air_minum" type="radio" id="MEN" value="MEN" <?php echo ($admin['cmdp_air_minum'] == 'MEN' ? ' checked' : ''); ?>/>
                                                    <label for="MEN">Membeli Eceran</label>
                                                </p>
                                                <p>
                                                    <input name="cmdp_air_minum" type="radio" id="LGN" value="LGN" <?php echo ($admin['cmdp_air_minum'] == 'LGN' ? ' checked' : ''); ?>/>
                                                    <label for="LGN">Langganan</label>
                                                </p>
                                                <p>
                                                    <input name="cmdp_air_minum" type="radio" id="TMI" value="TMI" <?php echo ($admin['cmdp_air_minum'] == 'TMI' ? ' checked' : ''); ?>/>
                                                    <label for="TMI">Tidak Membeli</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Sumber Penerangan *</label>
                                                <p>
                                                    <input name="smb_penerangan" type="radio" id="LPLN" value="LPLN" <?php echo ($admin['smb_penerangan'] == 'LPLN' ? ' checked' : ''); ?>/>
                                                    <label for="LPLN">Listrik PLN</label>
                                                </p>
                                                <p>
                                                    <input name="smb_penerangan" type="radio" id="LNPLN" value="LNPLN" <?php echo ($admin['smb_penerangan'] == 'LNPLN' ? ' checked' : ''); ?>/>
                                                    <label for="LNPLN">Listrik Non PLN</label>
                                                </p>
                                                <p>
                                                    <input name="smb_penerangan" type="radio" id="BLK" value="BLK" <?php echo ($admin['smb_penerangan'] == 'BLK' ? ' checked' : ''); ?>/>
                                                    <label for="BLK">Bukan Listrik</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Daya Listrik *</label>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="450" value="450" <?php echo ($admin['dy_listrik'] == '450' ? ' checked' : ''); ?>/>
                                                    <label for="450">450 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="900" value="900" <?php echo ($admin['dy_listrik'] == '900' ? ' checked' : ''); ?>/>
                                                    <label for="900">900 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="1300" value="1300" <?php echo ($admin['dy_listrik'] == '1300' ? ' checked' : ''); ?>/>
                                                    <label for="1300">1300 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="2200" value="2200" <?php echo ($admin['dy_listrik'] == '2200' ? ' checked' : ''); ?>/>
                                                    <label for="2200">2200 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="2200>" value="2200>" <?php echo ($admin['dy_listrik'] == '2200>' ? ' checked' : ''); ?>/>
                                                    <label for="2200>">Lebih Dari 2200 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="TMN" value="TMN" <?php echo ($admin['dy_listrik'] == 'TMN' ? ' checked' : ''); ?>/>
                                                    <label for="TMN">Tanpa Meteran</label>
                                                </p>  
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Bahan Bakar Masak *</label>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="LSK" value="LSK" <?php echo ($admin['bb_masak'] == 'LSK' ? ' checked' : ''); ?>/>
                                                    <label for="LSK">Listrik</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="GS3KG1" value="GS>3KG" <?php echo ($admin['bb_masak'] == 'GS>3KG' ? ' checked' : ''); ?>/>
                                                    <label for="GS3KG1">Gas > 3KG</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="GS3KG" value="GS3KG" <?php echo ($admin['bb_masak'] == 'GS3KG' ? ' checked' : ''); ?>/>
                                                    <label for="GS3KG">Gas 3KG</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="GKBS" value="GKBS" <?php echo ($admin['bb_masak'] == 'GKBS' ? ' checked' : ''); ?>/>
                                                    <label for="GKBS">Gas Kota / Biogas</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="MTH" value="MTH" <?php echo ($admin['bb_masak'] == 'MTH' ? ' checked' : ''); ?>/>
                                                    <label for="MTH">Minyak Tanah</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="BRT" value="BRT" <?php echo ($admin['bb_masak'] == 'BRT' ? ' checked' : ''); ?>/>
                                                    <label for="BRT">Briket</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="ARG" value="ARG" <?php echo ($admin['bb_masak'] == 'ARG' ? ' checked' : ''); ?>/>
                                                    <label for="ARG">Arang</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="KYB" value="KYB" <?php echo ($admin['bb_masak'] == 'KYB' ? ' checked' : ''); ?>/>
                                                    <label for="KYB">Kayu Bakar</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="TMDR" value="TMDR" <?php echo ($admin['bb_masak'] == 'TMDR' ? ' checked' : ''); ?>/>
                                                    <label for="TMDR">Tidak Masak Dirumah</label>
                                                </p>  
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Fasil BAB *</label>
                                                <p>
                                                    <input name="fasbab" type="radio" id="SI" value="SI" <?php echo ($admin['fasbab'] == 'SI' ? ' checked' : ''); ?>/>
                                                    <label for="SI">Sendiri</label>
                                                </p>
                                                <p>
                                                    <input name="fasbab" type="radio" id="BA" value="BA" <?php echo ($admin['fasbab'] == 'BA' ? ' checked' : ''); ?>/>
                                                    <label for="BA">Bersama</label>
                                                </p>
                                                <p>
                                                    <input name="fasbab" type="radio" id="UM" value="UM" <?php echo ($admin['fasbab'] == 'UM' ? ' checked' : ''); ?>/>
                                                    <label for="UM">Umum</label>
                                                </p>
                                                <p>
                                                    <input name="fasbab" type="radio" id="TA" value="TA" <?php echo ($admin['fasbab'] == 'TA' ? ' checked' : ''); ?>/>
                                                    <label for="TA">Tidak Ada</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Jenis Kloset *</label>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="LAA" value="LAA" <?php echo ($admin['jns_kloset'] == 'LAA' ? ' checked' : ''); ?>/>
                                                    <label for="LAA">leher Angsa</label>
                                                </p>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="PGN" value="PGN" <?php echo ($admin['jns_kloset'] == 'PGN' ? ' checked' : ''); ?>/>
                                                    <label for="PGN">Plengsengan</label>
                                                </p>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="CGCK" value="CGCK" <?php echo ($admin['jns_kloset'] == 'CGCK' ? ' checked' : ''); ?>/>
                                                    <label for="CGCK">Cempluk / Cubluk</label>
                                                </p>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="TPI" value="TPI" <?php echo ($admin['jns_kloset'] == 'TPI' ? ' checked' : ''); ?>/>
                                                    <label for="TPI">Tidak Pakai</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Tempat Pembuangan Akhir *</label>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="TGI" value="TGI" <?php echo ($admin['tp_akhir'] == 'TGI' ? ' checked' : ''); ?>/>
                                                    <label for="TGI">Tangki</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="SPAL" value="SPAL" <?php echo ($admin['tp_akhir'] == 'SPAL' ? ' checked' : ''); ?>/>
                                                    <label for="SPAL">SPAL</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="LTH" value="LTH" <?php echo ($admin['tp_akhir'] == 'LTH' ? ' checked' : ''); ?>/>
                                                    <label for="LTH">Lubang Tanah</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="KSSDL" value="KSSDL" <?php echo ($admin['tp_akhir'] == 'KSSDL' ? ' checked' : ''); ?>/>
                                                    <label for="KSSDL">Kolam/Sawah/Sungai/Danau/Laut</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="PTLK" value="PTLK" <?php echo ($admin['tp_akhir'] == 'PTLK' ? ' checked' : ''); ?>/>
                                                    <label for="PTLK">Pantai/Tanah Lapang/Kebun</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="LN5" value="LN" <?php echo ($admin['tp_akhir'] == 'LN' ? ' checked' : ''); ?>/>
                                                    <label for="LN5">Lainnya</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col s12 m8 l9 right">
                                            <div class="row">
                                                <div class="col s12 m4" style="margin-left: 390px;">
                                                    <a class="btn-floating waves-effect teal accent-4 previous-step"><i class="material-icons">chevron_left</i></a>
                                                    <a class="btn-floating waves-effect teal accent-4 next-step"><i class="material-icons">chevron_right</i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- LEMBAR 3 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <li class="step">
                            <div class="step-title waves-effect waves-dark">Lembar 3</div>
                            <div class="step-content">
                                <div class="row">
                                    <h4 class="header2 center" style="margin-top: 0.5px;margin-bottom: 10px;">Form Survey Aset dan Keikutsertaan</h4>
                                    <br/>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Tabung Gas 5KG / Lebih *</label>
                                                    <p>
                                                        <input name="ada_tgas" type="radio" id="YA1" value="YA" <?php echo ($admin['ada_tgas'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA1">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_tgas" type="radio" id="TIDAK1" value="TIDAK" <?php echo ($admin['ada_tgas'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK1">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Lemari Es / Kulkas *</label>
                                                    <p>
                                                        <input name="ada_kulkas" type="radio" id="YA2" value="YA" <?php echo ($admin['ada_kulkas'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA2">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_kulkas" type="radio" id="TIDAK2" value="TIDAK" <?php echo ($admin['ada_kulkas'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK2">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada AC <sup>(Air Conditioner)</sup> *</label>
                                                    <p>
                                                        <input name="ada_ac" type="radio" id="YA3" value="YA" <?php echo ($admin['ada_ac'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA3">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_ac" type="radio" id="TIDAK3" value="TIDAK" <?php echo ($admin['ada_ac'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK3">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Pemanas Air *</label>
                                                    <p>
                                                        <input name="ada_pemanas" type="radio" id="YA4" value="YA" <?php echo ($admin['ada_pemanas'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA4">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_pemanas" type="radio" id="TIDAK4" value="TIDAK" <?php echo ($admin['ada_pemanas'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK4">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Telepon Rumah (PSTN) *</label>
                                                    <p>
                                                        <input name="ada_telepon" type="radio" id="YA5" value="YA" <?php echo ($admin['ada_telepon'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA5">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_telepon" type="radio" id="TIDAK5" value="TIDAK" <?php echo ($admin['ada_telepon'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK5">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Televisi *</label>
                                                    <p>
                                                        <input name="ada_tv" type="radio" id="YA6" value="YA" <?php echo ($admin['ada_tv'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA6">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_tv" type="radio" id="TIDAK6" value="TIDAK" <?php echo ($admin['ada_tv'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK6">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Emas / Tabungan senilai(10 gram emas) *</label>
                                                    <p>
                                                        <input name="ada_emas" type="radio" id="YA7" value="YA" <?php echo ($admin['ada_emas'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA7">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_emas" type="radio" id="TIDAK7" value="TIDAK" <?php echo ($admin['ada_emas'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK7">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Komputer / Laptop *</label>
                                                    <p>
                                                        <input name="ada_komputer" type="radio" id="YA8" value="YA" <?php echo ($admin['ada_komputer'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA8">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_komputer" type="radio" id="TIDAK8" value="TIDAK" <?php echo ($admin['ada_komputer'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK8">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Sepeda *</label>
                                                    <p>
                                                        <input name="ada_sepeda" type="radio" id="YA9" value="YA" <?php echo ($admin['ada_sepeda'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA9">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_sepeda" type="radio" id="TIDAK9" value="TIDAK" <?php echo ($admin['ada_sepeda'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK9">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Sepeda Motor *</label>
                                                    <p>
                                                        <input name="ada_motor" type="radio" id="YA10" value="YA" <?php echo ($admin['ada_motor'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA10">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_motor" type="radio" id="TIDAK10" value="TIDAK" <?php echo ($admin['ada_motor'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK10">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Mobil *</label>
                                                    <p>
                                                        <input name="ada_mobil" type="radio" id="YA11" value="YA" <?php echo ($admin['ada_mobil'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA11">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_mobil" type="radio" id="TIDAK11" value="TIDAK" <?php echo ($admin['ada_mobil'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK11">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Rumah Tempat Lain *</label>
                                                    <p>
                                                        <input name="ada_rumah_lain" type="radio" id="YA12" value="YA" <?php echo ($admin['ada_rumah_lain'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA12">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_rumah_lain" type="radio" id="TIDAK12" value="TIDAK" <?php echo ($admin['ada_rumah_lain'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK12">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status ART Usaha *</label>
                                                    <p>
                                                        <input name="sta_art_usaha" type="radio" id="YA13" value="YA" <?php echo ($admin['sta_art_usaha'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA13">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_art_usaha" type="radio" id="TIDAK13" value="TIDAK" <?php echo ($admin['sta_art_usaha'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK13">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu Keluarga Sejahtera(KKS) *</label>
                                                    <p>
                                                        <input name="sta_kks" type="radio" id="YA14" value="YA" <?php echo ($admin['sta_kks'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA14">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kks" type="radio" id="TIDAK14" value="TIDAK" <?php echo ($admin['sta_kks'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK14">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu Indonesia Pintar(KIP) *</label>
                                                    <p>
                                                        <input name="sta_kip" type="radio" id="YA15" value="YA" <?php echo ($admin['sta_kip'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA15">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kip" type="radio" id="TIDAK15" value="TIDAK" <?php echo ($admin['sta_kip'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK15">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu Indonesia Sehat(KIS) *</label>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="YA16" value="YA" <?php echo ($admin['sta_kis'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA16">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="TIDAK16" value="TIDAK" <?php echo ($admin['sta_kis'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK16">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status BPJS Mandiri *</label>
                                                    <p>
                                                        <input name="sta_bpjsm" type="radio" id="YA17" value="YA" <?php echo ($admin['sta_bpjsm'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA17">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_bpjsm" type="radio" id="TIDAK17" value="TIDAK" <?php echo ($admin['sta_bpjsm'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK17">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu JAMSOSTEK *</label>
                                                    <p>
                                                        <input name="sta_jamsotek" type="radio" id="YA18" value="YA" <?php echo ($admin['sta_jamsotek'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA18">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_jamsotek" type="radio" id="TIDAK18" value="TIDAK" <?php echo ($admin['sta_jamsotek'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK18">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Asuransi Kesehatan Lain *</label>
                                                    <p>
                                                        <input name="sta_asuransi_lain" type="radio" id="YA19" value="YA" <?php echo ($admin['sta_asuransi_lain'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA19">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_asuransi_lain" type="radio" id="TIDAK19" value="TIDAK" <?php echo ($admin['sta_asuransi_lain'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK19">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status RASKIN *</label>
                                                    <p>
                                                        <input name="sta_rasta" type="radio" id="YA20" value="YA" <?php echo ($admin['sta_rasta'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA20">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_rasta" type="radio" id="TIDAK20" value="TIDAK" <?php echo ($admin['sta_rasta'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK20">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Kredit Usaha Rakyat *</label>
                                                    <p>
                                                        <input name="sta_kur" type="radio" id="YA21" value="YA" <?php echo ($admin['sta_kur'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA21">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kur" type="radio" id="TIDAK21" value="TIDAK" <?php echo ($admin['sta_kur'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK21">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                  <label class="red-text">Status KIS *</label>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="YA30" value="YA" <?php echo ($admin['sta_kis'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA30">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="TIDAK30" value="TIDAK" <?php echo ($admin['sta_kis'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK30">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Keberadaan ART *</label>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="TDR" value="TDR" <?php echo ($admin['sta_keberadaan_art'] == 'TDR' ? ' checked' : ''); ?>/>
                                                        <label for="TDR">Tinggal Diruta</label>    
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="MNL" value="MNL" <?php echo ($admin['sta_keberadaan_art'] == 'MNL' ? ' checked' : ''); ?>/>
                                                        <label for="MNL">Meninggal</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="TTDRP" value="TTDRP" <?php echo ($admin['sta_keberadaan_art'] == 'TTDRP' ? ' checked' : ''); ?>/>
                                                        <label for="TTDRP">Tidak Tinggal Diruta</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="ARTB" value="ARTB" <?php echo ($admin['sta_keberadaan_art'] == 'ARTB' ? ' checked' : ''); ?>/>
                                                        <label for="ARTB">Anggota Rumah Tangga Baru</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="KPLT" value="KPLT" <?php echo ($admin['sta_keberadaan_art'] == 'KPLT' ? ' checked' : ''); ?>/>
                                                        <label for="KPLT">Kesalahan Prelist</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="TDN" value="TDN" <?php echo ($admin['sta_keberadaan_art'] == 'TDN' ? ' checked' : ''); ?>/>
                                                        <label for="TDN">Tidak Ditemukan</label>
                                                    </p>  
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Aset Tak Bergerak *</label>
                                                    <p>
                                                        <input name="ada_ast_tbergerak" type="radio" id="YA26" value="YA" <?php echo ($admin['ada_ast_tbergerak'] == 'YA' ? ' checked' : ''); ?>/>
                                                        <label for="YA26">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_ast_tbergerak" type="radio" id="TIDAK26" value="TIDAK" <?php echo ($admin['ada_ast_tbergerak'] == 'TIDAK' ? ' checked' : ''); ?>/>
                                                        <label for="TIDAK26">Tidak</label>
                                                    </p> 
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="ls_lahan" type="text" class="validate" required value="<?php echo $admin['ls_lahan']; ?>"/>
                                                    <label for="ls_lantai" class="red-text">Luas Lahan (M<sup>2</sup>) *</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="percentile" type="text" class="validate" required value="<?php echo $admin['percentile']; ?>"/>
                                                    <label for="percentile" class="red-text">Percentile *</label>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="jml_sapi" type="number" class="validate" required value="<?php echo $admin['jml_sapi']; ?>"/>
                                                    <label for="jml_sapi" class="red-text">Jumlah Sapi *</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="jml_kambing" type="number" class="validate" required value="<?php echo $admin['jml_kambing']; ?>"/>
                                                    <label for="jml_kambing" class="red-text">Jumlah Kambing/Domba *</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="luas_ast_tbergerak" type="text" class="validate" required value="<?php echo $admin['luas_ast_tbergerak']; ?>"/>
                                                    <label for="luas_ast_tbergerak" class="red-text">Luas Aset Tak Bergerak M<sup>2</sup> *</label>
                                                </div>
                                                <div class="input-field col s6" hidden>
                                                    <input placeholder="&nbsp;" name="id_akun" type="text" class="validate" required value="<?php echo $this->session->userdata('id_akun'); ?>"/>
                                                    <label for="id_akun" class="teal-text">ID.Surveyer *</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <br/>
                                        <div class="col s12 m8 l9 right">
                                            <div class="row">
                                                <div class="col s6">
                                                    <a class="btn-floating waves-effect teal accent-4 previous-step left" style="margin-left:110px;"><i class="material-icons">chevron_left</i></a>  
                                                </div>
                                                <div class="col s6">
                                                    <button class="btn cyan waves-effect waves-light center" type="submit" name="action">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </li>
                    </ul>
                    <?php form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m4 l2"></div>
</div>

<!-- div tutup untuk footer ------------------------------------------------------------------------------------->
</div>
</div>
