<div class="container">
    <div class="row">
        <div class="col s12 m4 l2"></div>
        <div class="col s12 m4 l8">
            <div class="card" style="border-radius:10px;">
                <div style="margin-bottom:0px auto;">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open_multipart('surveyer/tambah_survey'); ?>
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
                                                <input placeholder="Nomor Nik (18) Digit" name="nik" type="text" class="validate" maxlength="18" required/>
                                                <label for="nik" class="red-text">Nik *</label>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input placeholder="Nama Calon Penerima Bantuan" name="nama" type="text" class="validate" required/>
                                                <label for="nama" class="red-text">Nama *</label>
                                            </div>
                                        </div>
                                        <div class="row" hidden> 
                                            <div class="input-field col s12">
                                                <input name="kecamatan" type="text" value="Slogohimo" />
                                                <label for="kecamatan" class="red-text">Kecamatan *</label>
                                            </div>
                                        </div>
                                        <div class="row" hidden> 
                                            <div class="input-field col s12">
                                                <input name="kabupaten" type="text" value="Wonogiri"/>
                                                <label for="kabupaten" class="red-text">Kabupaten *</label>
                                            </div>
                                        </div>
                                        <div class="row" hidden> 
                                            <div class="input-field col s12">
                                                <input name="propinsi" type="text" value="Jawa Tengah"/>
                                                <label for="propinsi" class="red-text">Propinsi *</label>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="input-field col s12">
                                                <input placeholder="Desa" name="desa" type="text" class="validate" required/>
                                                <label for="desa" class="red-text">Desa *</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" name="alamat" type="text" class="validate" required/>
                                                <label for="alamat" class="red-text">Alamat *</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="jml_art" type="number" class="validate" required/>
                                                <label for="alamat" class="red-text">Jumlah ART *</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="jml_keluarga" type="number" class="validate" required/>
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
                                                    <input name="sta_lahan" type="radio" id="MI" value="MI"/>
                                                    <label for="MI">Milik Sendiri</label>
                                                </p>
                                                <p>
                                                    <input name="sta_lahan" type="radio" id="MOL" value="MOL"/>
                                                    <label for="MOL">Milik Orang Lain</label>
                                                </p>
                                                <p>
                                                    <input name="sta_lahan" type="radio" id="TN" value="TN" />
                                                    <label for="TN">Tanah Negara</label>
                                                </p>
                                                <p>
                                                    <input name="sta_lahan" type="radio" id="LN" value="LN" />
                                                    <label for="LN">Lainnya</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Status Bangunan *</label>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="MSI" value="MSI"/>
                                                    <label for="MSI">Milik Sendiri</label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="KSA" value="KSA"/>
                                                    <label for="KSA">Kontrak / Sewa</label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="BSA" value="BSA" />
                                                    <label for="BSA">Bebas Sewa</label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="DNS" value="DNS" />
                                                    <label for="DNS">Dinas </label>
                                                </p>
                                                <p>
                                                    <input name="sta_bangunan" type="radio" id="LN1" value="LN" />
                                                    <label for="LN1">Lainnya</label>
                                                </p>  
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Jenis Lantai *</label>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="MMG" value="MMG"/>
                                                    <label for="MMG">Marmer / Granit</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="KMK" value="KMK"/>
                                                    <label for="KMK">Keramik</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="PVPI" value="PVPI" />
                                                    <label for="PVPI">Parket Vinil Permadani</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="UTT" value="UTT" />
                                                    <label for="UTT">Ubin / Tegel / Teraso </label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="KPKT" value="KPKT" />
                                                    <label for="KPKT">Kayu / Papan Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="SBM" value="SBM"  />
                                                    <label for="SBM">Sementara / Bata Merah</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="BMB" value="BMB"  />
                                                    <label for="BMB">Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="KPKR" value="KPKR"  />
                                                    <label for="KPKR">Kayu / Papan Kualitas Rendah</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="TNH" value="TNH"  />
                                                    <label for="TNH">Tanah</label>
                                                </p>
                                                <p>
                                                    <input name="jns_lantai" type="radio" id="LN8" value="LN"  />
                                                    <label for="LN8">Lainnya</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Jenis Dinding *</label>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="TBK" value="TBK"/>
                                                    <label for="TBK">Tembok</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="PABK" value="PABK"/>
                                                    <label for="PABK">Plesteran Anyam Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="KYU" value="KYU" />
                                                    <label for="KYU">Kayu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="ABU" value="ABU" />
                                                    <label for="ABU">Anyaman Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="BKYU" value="BKYU" />
                                                    <label for="BKYU">Batang Kayu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="BBU" value="BBU" />
                                                    <label for="BBU">Bambu</label>
                                                </p>
                                                <p>
                                                    <input name="jns_dinding" type="radio" id="LN2" value="LN" />
                                                    <label for="LN2">Lainnya</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Kondisi Dinding *</label>
                                                <p>
                                                    <input name="knds_dinding" type="radio" id="BKT" value="BKT"/>
                                                    <label for="BKT">Bagus Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="knds_dinding" type="radio" id="JKR" value="JKR"/>
                                                    <label for="JKR">Jelek Kualitas Rendah</label>
                                                </p>  
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Kondisi Atap *</label>
                                                <p>
                                                    <input name="knds_atap" type="radio" id="BKT1" value="BKT"/>
                                                    <label for="BKT1">Bagus Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="knds_atap" type="radio" id="JKR1" value="JKR"/>
                                                    <label for="JKR1">Jelek Kualitas Rendah</label>
                                                </p>    
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Jenis Atap *</label>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="BGB" value="BGB"/>
                                                    <label for="BGB">Beton/Genting Beton</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="GKK" value="GKK"/>
                                                    <label for="GKK">Genteng Keramik</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="GML" value="GML"/>
                                                    <label for="GML">Genteng Metal</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="GTL" value="GTL"/>
                                                    <label for="GTL">Genteng Tanah Liat</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="ASS" value="ASS"/>
                                                    <label for="ASS">Asbes</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="SNG" value="SNG"/>
                                                    <label for="SNG">Seng</label>
                                                </p>    
                                                <p>
                                                    <input name="jns_atap" type="radio" id="SRP" value="SRP"/>
                                                    <label for="SRP">Sirap</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="BMB" value="BMB"/>
                                                    <label for="BMB">Bambu</label>
                                                </p> 
                                                <p>
                                                    <input name="jns_atap" type="radio" id="JIDDR" value="JIDDR"/>
                                                    <label for="JIDDR">Bagus Kualitas Tinggi</label>
                                                </p>
                                                <p>
                                                    <input name="jns_atap" type="radio" id="LN3" value="LN"/>
                                                    <label for="LN3">Lainnya</label>
                                                </p>    
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Sumber Air Minum *</label>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="AKB" value="AKB"/>
                                                    <label for="AKB">Air Kemasan Bermerk</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="AIU" value="AIU"/>
                                                    <label for="AIU">Air Isi Ulang</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="LMN" value="LMN"/>
                                                    <label for="LMN">Ledeng Meteran</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="LEN" value="LEN"/>
                                                    <label for="LEN">Ledeng Eceran</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="SBP" value="SBP"/>
                                                    <label for="SBP">Sumur / Bor Pompa</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="STG" value="STG"/>
                                                    <label for="STG">Sumur Terlindung</label>
                                                </p>    
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="STTG" value="STTG"/>
                                                    <label for="STTG">Sumur Tak Terlindung</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="MAT" value="MAT"/>
                                                    <label for="MAT">Mata Air Terlindung</label>
                                                </p> 
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="MATT" value="MATT"/>
                                                    <label for="MATT">Mata Air Tak Terlindung</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="ASDW" value="ASDW"/>
                                                    <label for="ASDW">Air Sungai Danau Waduk</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="AHN" value="AHN"/>
                                                    <label for="AHN">Air Hujan</label>
                                                </p>
                                                <p>
                                                    <input name="smb_air_minum" type="radio" id="LN4" value="LN" class="validate"/>
                                                    <label for="LN4">Lainnya</label>
                                                </p>     
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="ls_lantai" type="text" class="validate" required/>
                                                <label for="ls_lantai" class="red-text">Luas Lantai (M<sup>2</sup>) *</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input placeholder="&nbsp;" name="jml_kamar" type="number" class="validate" required/>
                                                <label for="jml_kamar" class="red-text">Jumlah Kamar *</label>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Cara Memperoleh Air Minum *</label>
                                                <p>
                                                    <input name="cmdp_air_minum" type="radio" id="MEN" value="MEN"/>
                                                    <label for="MEN">Membeli Eceran</label>
                                                </p>
                                                <p>
                                                    <input name="cmdp_air_minum" type="radio" id="LGN" value="LGN"/>
                                                    <label for="LGN">Langganan</label>
                                                </p>
                                                <p>
                                                    <input name="cmdp_air_minum" type="radio" id="TMI" value="TMI"/>
                                                    <label for="TMI">Tidak Membeli</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Sumber Penerangan *</label>
                                                <p>
                                                    <input name="smb_penerangan" type="radio" id="LPLN" value="LPLN"/>
                                                    <label for="LPLN">Listrik PLN</label>
                                                </p>
                                                <p>
                                                    <input name="smb_penerangan" type="radio" id="LNPLN" value="LNPLN"/>
                                                    <label for="LNPLN">Listrik Non PLN</label>
                                                </p>
                                                <p>
                                                    <input name="smb_penerangan" type="radio" id="BLK" value="BLK"/>
                                                    <label for="BLK">Bukan Listrik</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Daya Listrik *</label>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="450" value="450"/>
                                                    <label for="450">450 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="900" value="900"/>
                                                    <label for="900">900 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="1300" value="1300"/>
                                                    <label for="1300">1300 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="2200" value="2200"/>
                                                    <label for="2200">2200 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="2200>" value="2200>"/>
                                                    <label for="2200>">Lebih Dari 2200 Watt</label>
                                                </p>
                                                <p>
                                                    <input name="dy_listrik" type="radio" id="TMN" value="TMN"/>
                                                    <label for="TMN">Tanpa Meteran</label>
                                                </p>  
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Bahan Bakar Masak *</label>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="LSK" value="LSK"/>
                                                    <label for="LSK">Listrik</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="GS3KG1" value="GS>3KG"/>
                                                    <label for="GS3KG1">Gas > 3KG</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="GS3KG" value="GS3KG"/>
                                                    <label for="GS3KG">Gas 3KG</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="GKBS" value="GKBS"/>
                                                    <label for="GKBS">Gas Kota / Biogas</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="MTH" value="MTH"/>
                                                    <label for="MTH">Minyak Tanah</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="BRT" value="BRT"/>
                                                    <label for="BRT">Briket</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="ARG" value="ARG"/>
                                                    <label for="ARG">Arang</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="KYB" value="KYB"/>
                                                    <label for="KYB">Kayu Bakar</label>
                                                </p>
                                                <p>
                                                    <input name="bb_masak" type="radio" id="TMDR" value="TMDR"/>
                                                    <label for="TMDR">Tidak Masak Dirumah</label>
                                                </p>  
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Fasil BAB *</label>
                                                <p>
                                                    <input name="fasbab" type="radio" id="SI" value="SI"/>
                                                    <label for="SI">Sendiri</label>
                                                </p>
                                                <p>
                                                    <input name="fasbab" type="radio" id="BA" value="BA"/>
                                                    <label for="BA">Bersama</label>
                                                </p>
                                                <p>
                                                    <input name="fasbab" type="radio" id="UM" value="UM"/>
                                                    <label for="UM">Umum</label>
                                                </p>
                                                <p>
                                                    <input name="fasbab" type="radio" id="TA" value="TA"/>
                                                    <label for="TA">Tidak Ada</label>
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <label class="red-text">Jenis Kloset *</label>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="LAA" value="LAA"/>
                                                    <label for="LAA">leher Angsa</label>
                                                </p>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="PGN" value="PGN"/>
                                                    <label for="PGN">Plengsengan</label>
                                                </p>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="CGCK" value="CGCK"/>
                                                    <label for="CGCK">Cempluk / Cubluk</label>
                                                </p>
                                                <p>
                                                    <input name="jns_kloset" type="radio" id="TPI" value="TPI"/>
                                                    <label for="TPI">Tidak Pakai</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="row">
                                            <div class="col s6">
                                                <label class="red-text">Tempat Pembuangan Akhir *</label>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="TGI" value="TGI"/>
                                                    <label for="TGI">Tangki</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="SPAL" value="SPAL"/>
                                                    <label for="SPAL">SPAL</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="LTH" value="LTH"/>
                                                    <label for="LTH">Lubang Tanah</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="KSSDL" value="KSSDL"/>
                                                    <label for="KSSDL">Kolam/Sawah/Sungai/Danau/Laut</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="PTLK" value="PTLK"/>
                                                    <label for="PTLK">Pantai/Tanah Lapang/Kebun</label>
                                                </p>
                                                <p>
                                                    <input name="tp_akhir" type="radio" id="LN5" value="LN"/>
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
                                                        <input name="ada_tgas" type="radio" id="YA1" value="YA"/>
                                                        <label for="YA1">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_tgas" type="radio" id="TIDAK1" value="TIDAK"/>
                                                        <label for="TIDAK1">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Lemari Es / Kulkas *</label>
                                                    <p>
                                                        <input name="ada_kulkas" type="radio" id="YA2" value="YA"/>
                                                        <label for="YA2">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_kulkas" type="radio" id="TIDAK2" value="TIDAK"/>
                                                        <label for="TIDAK2">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada AC <sup>(Air Conditioner)</sup> *</label>
                                                    <p>
                                                        <input name="ada_ac" type="radio" id="YA3" value="YA"/>
                                                        <label for="YA3">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_ac" type="radio" id="TIDAK3" value="TIDAK"/>
                                                        <label for="TIDAK3">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Pemanas Air *</label>
                                                    <p>
                                                        <input name="ada_pemanas" type="radio" id="YA4" value="YA"/>
                                                        <label for="YA4">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_pemanas" type="radio" id="TIDAK4" value="TIDAK"/>
                                                        <label for="TIDAK4">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Telepon Rumah (PSTN) *</label>
                                                    <p>
                                                        <input name="ada_telepon" type="radio" id="YA5" value="YA"/>
                                                        <label for="YA5">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_telepon" type="radio" id="TIDAK5" value="TIDAK"/>
                                                        <label for="TIDAK5">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Televisi *</label>
                                                    <p>
                                                        <input name="ada_tv" type="radio" id="YA6" value="YA"/>
                                                        <label for="YA6">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_tv" type="radio" id="TIDAK6" value="TIDAK"/>
                                                        <label for="TIDAK6">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Emas / Tabungan senilai(10 gram emas) *</label>
                                                    <p>
                                                        <input name="ada_emas" type="radio" id="YA7" value="YA"/>
                                                        <label for="YA7">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_emas" type="radio" id="TIDAK7" value="TIDAK"/>
                                                        <label for="TIDAK7">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Komputer / Laptop *</label>
                                                    <p>
                                                        <input name="ada_komputer" type="radio" id="YA8" value="YA"/>
                                                        <label for="YA8">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_komputer" type="radio" id="TIDAK8" value="TIDAK"/>
                                                        <label for="TIDAK8">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Sepeda *</label>
                                                    <p>
                                                        <input name="ada_sepeda" type="radio" id="YA9" value="YA"/>
                                                        <label for="YA9">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_sepeda" type="radio" id="TIDAK9" value="TIDAK"/>
                                                        <label for="TIDAK9">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Sepeda Motor *</label>
                                                    <p>
                                                        <input name="ada_motor" type="radio" id="YA10" value="YA"/>
                                                        <label for="YA10">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_motor" type="radio" id="TIDAK10" value="TIDAK"/>
                                                        <label for="TIDAK10">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Ada Mobil *</label>
                                                    <p>
                                                        <input name="ada_mobil" type="radio" id="YA11" value="YA"/>
                                                        <label for="YA11">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_mobil" type="radio" id="TIDAK11" value="TIDAK"/>
                                                        <label for="TIDAK11">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Rumah Tempat Lain *</label>
                                                    <p>
                                                        <input name="ada_rumah_lain" type="radio" id="YA12" value="YA"/>
                                                        <label for="YA12">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_rumah_lain" type="radio" id="TIDAK12" value="TIDAK"/>
                                                        <label for="TIDAK12">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status ART Usaha *</label>
                                                    <p>
                                                        <input name="sta_art_usaha" type="radio" id="YA13" value="YA"/>
                                                        <label for="YA13">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_art_usaha" type="radio" id="TIDAK13" value="TIDAK"/>
                                                        <label for="TIDAK13">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu Keluarga Sejahtera(KKS) *</label>
                                                    <p>
                                                        <input name="sta_kks" type="radio" id="YA14" value="YA"/>
                                                        <label for="YA14">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kks" type="radio" id="TIDAK14" value="TIDAK"/>
                                                        <label for="TIDAK14">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu Indonesia Pintar(KIP) *</label>
                                                    <p>
                                                        <input name="sta_kip" type="radio" id="YA15" value="YA"/>
                                                        <label for="YA15">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kip" type="radio" id="TIDAK15" value="TIDAK"/>
                                                        <label for="TIDAK15">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu Indonesia Sehat(KIS) *</label>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="YA16" value="YA"/>
                                                        <label for="YA16">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="TIDAK16" value="TIDAK"/>
                                                        <label for="TIDAK16">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status BPJS Mandiri *</label>
                                                    <p>
                                                        <input name="sta_bpjsm" type="radio" id="YA17" value="YA"/>
                                                        <label for="YA17">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_bpjsm" type="radio" id="TIDAK17" value="TIDAK"/>
                                                        <label for="TIDAK17">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status Kartu JAMSOSTEK *</label>
                                                    <p>
                                                        <input name="sta_jamsotek" type="radio" id="YA18" value="YA"/>
                                                        <label for="YA18">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_jamsotek" type="radio" id="TIDAK18" value="TIDAK"/>
                                                        <label for="TIDAK18">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Asuransi Kesehatan Lain *</label>
                                                    <p>
                                                        <input name="sta_asuransi_lain" type="radio" id="YA19" value="YA"/>
                                                        <label for="YA19">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_asuransi_lain" type="radio" id="TIDAK19" value="TIDAK"/>
                                                        <label for="TIDAK19">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status RASKIN *</label>
                                                    <p>
                                                        <input name="sta_rasta" type="radio" id="YA20" value="YA"/>
                                                        <label for="YA20">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_rasta" type="radio" id="TIDAK20" value="TIDAK"/>
                                                        <label for="TIDAK20">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Kredit Usaha Rakyat *</label>
                                                    <p>
                                                        <input name="sta_kur" type="radio" id="YA21" value="YA"/>
                                                        <label for="YA21">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kur" type="radio" id="TIDAK21" value="TIDAK"/>
                                                        <label for="TIDAK21">Tidak</label>
                                                    </p>   
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Status KIS *</label>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="YA30" value="YA"/>
                                                        <label for="YA30">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_kis" type="radio" id="TIDAK30" value="TIDAK"/>
                                                        <label for="TIDAK30">Tidak</label>
                                                    </p>   
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label class="red-text">Status Keberadaan ART *</label>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="TDR" value="TDR"/>
                                                        <label for="TDR">Tinggal Diruta</label>    
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="MNL" value="MNL"/>
                                                        <label for="MNL">Meninggal</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="TTDRP" value="TTDRP"/>
                                                        <label for="TTDRP">Tidak Tinggal Diruta</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="ARTB" value="ARTB"/>
                                                        <label for="ARTB">Anggota Rumah Tangga Baru</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="KPLT" value="KPLT"/>
                                                        <label for="KPLT">Kesalahan Prelist</label>
                                                    </p>
                                                    <p>
                                                        <input name="sta_keberadaan_art" type="radio" id="TDN" value="TDN"/>
                                                        <label for="TDN">Tidak Ditemukan</label>
                                                    </p>  
                                                </div>
                                                <div class="col s6">
                                                    <label class="red-text">Ada Aset Tak Bergerak *</label>
                                                    <p>
                                                        <input name="ada_ast_tbergerak" type="radio" id="YA26" value="YA"/>
                                                        <label for="YA26">Ya</label>
                                                    </p>
                                                    <p>
                                                        <input name="ada_ast_tbergerak" type="radio" id="TIDAK26" value="TIDAK"/>
                                                        <label for="TIDAK26">Tidak</label>
                                                    </p> 
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="ls_lahan" type="text" class="validate" required/>
                                                    <label for="ls_lantai" class="red-text">Luas Lahan (M<sup>2</sup>) *</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="percentile" type="text" class="validate" required/>
                                                    <label for="percentile" class="red-text">Percentile *</label>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="jml_sapi" type="number" class="validate" required/>
                                                    <label for="jml_sapi" class="red-text">Jumlah Sapi *</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="jml_kambing" type="number" class="validate" required/>
                                                    <label for="jml_kambing" class="red-text">Jumlah Kambing/Domba *</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input placeholder="&nbsp;" name="luas_ast_tbergerak" type="text" class="validate" required/>
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
