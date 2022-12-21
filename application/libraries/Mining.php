<?php if(! defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan'); 

class Mining {
    var $CI = NULL;
	public function __construct() {
	$this->CI =& get_instance();
        pembentukan_tree("","");
    }
    function proses_DT($parent, $kasus_cabang1, $kasus_cabang2) {
        pembentukan_tree($parent, $kasus_cabang1);
        echo "cabang 1<br>";
        pembentukan_tree($parent, $kasus_cabang2);
        echo "cabang 2<br>";
    }
    function pangkas($PARENT, $KASUS, $LEAF){
        $sql_pangkas = $this->CI->db->query("SELECT * FROM tbl_keputusan WHERE parent=\"$PARENT\" AND keputusan=\"$LEAF\"");
        $row_pangkas = $sql_pangkas->result_array();
        $jml_pangkas = $sql_pangkas->num_rows();
        //jika keputusan dan parent belum ada maka insert
        if ($jml_pangkas == 0) {
            return $this->CI->db->query("INSERT INTO tbl_keputusan (parent,akar,keputusan)VALUES (\"$PARENT\" , \"$KASUS\" , \"$LEAF\")");
        }
        //jika keputusan dan parent sudah ada maka delete
            else {
        return $this->CI->db->query("DELETE FROM tbl_keputusan WHERE id='$row_pangkas[0]'");

        $exPangkas = explode(" AND ", $PARENT);
        $jmlEXpangkas = count($exPangkas);
        $temp = array();
        for ($a = 0; $a < ($jmlEXpangkas - 1); $a++) {
            $temp[$a] = $exPangkas[$a];
        }
        $imPangkas = implode(" AND ", $temp);
        $akarPangkas = $exPangkas[$jmlEXpangkas - 1];

        $que_pangkas = $this->CI->db->query("SELECT * FROM tbl_keputusan WHERE parent=\"$imPangkas\" AND keputusan=\"$LEAF\"");
        $baris_pangkas = $que_pangkas->result_array();
        $jumlah_pangkas = $que_pangkas->num_rows();

        if ($jumlah_pangkas == 0) {
            return $this->CI->db->query("INSERT INTO tbl_keputusan (parent,akar,keputusan)VALUES (\"$imPangkas\" , \"$akarPangkas\" , \"$LEAF\")");
            //mysql_query("UPDATE pohon_keputusan SET parent=\"$imPangkas\" , akar=\"$akarPangkas\" , keputusan=\"$LEAF\" WHERE id=\"$row_pangkas[0]\"");
        } else {
            $this->pangkas($imPangkas, $akarPangkas, $LEAF);
        }
    }
        echo "Keputusan = " . $LEAF . "<br>================================<br>";
    }

    function pembentukan_tree($N_parent , $kasus){
        if($N_parent!=''){
                $kondisi = $N_parent." AND ".$kasus;
        }else{
                $kondisi = $kasus;
        }		
        echo $kondisi."<br>";
        //--------------------------------------------> cek data heterogen / homogen???
        $cek = $this->cek_heterohomogen('keputusan_asli',$kondisi);		
        if($cek=='homogen'){
            echo "<br>LEAF ";
            $sql_keputusan = $this->CI->db->query("SELECT DISTINCT(keputusan_asli) FROM tbl_data_latih WHERE $kondisi");
            $row_keputusan = $sql_keputusan->result_array();	
            $keputusan = $row_keputusan['0'];
            //-----------------------------------> insert atau lakukan pemangkasan cabang
            $this->pangkas($N_parent , $kasus , $keputusan);
        }   //-----------------------------------> jika data masih heterogen
        elseif($cek=='heterogen'){
                //cek jumlah data
            $jumlah = jumlah_data($kondisi);				
            if($jumlah<8){
                    echo "<br>LEAF ";
                    $Nya = $kondisi." AND keputusan_asli='YA'";
                    $Ntidak = $kondisi." AND keputusan_asli='TIDAK'";
                    $jumlahYa = jumlah_data("$Nya");
                    $jumlahTidak = jumlah_data("$Ntidak");				
                    if($jumlahYa <= $jumlahTidak){
                            $keputusan = 'TIDAK';
                    }else{
                            $keputusan = 'YA';
                    }				
                    //------------------------------------------> insert atau lakukan pemangkasan cabang
                    $this->pangkas($N_parent , $kasus , $keputusan);		
            }
                //lakukan perhitungan
            else{			
                    //------------------------------------------> jika kondisi tidak kosong kondisi_keputusan_asli=tambah and
                    $kondisi_keputusan_asli='';
                    if($kondisi!=''){
                    $kondisi_keputusan_asli=$kondisi." AND ";
                    }
                    $jml_ya = jumlah_data("$kondisi_keputusan_asli keputusan_asli='YA'");
                    $jml_tidak = jumlah_data("$kondisi_keputusan_asli keputusan_asli='TIDAK'");
                    $jml_total = $jml_ya + $jml_tidak;
                    echo "Jumlah data = ".$jml_total."<br>";
                    echo "Jumlah Ya = ".$jml_ya."<br>";
                    echo "Jumlah Tidak = ".$jml_tidak."<br>";

                    //hitung entropy semua
                    $entropy_all = hitung_entropy($jml_ya , $jml_tidak);
                    echo "Entropy = ".$entropy_all."<br>";

                    $nilai_jml_art = array();
                    $nilai_jml_art = cek_nilaiAtribut('jml_art',$kondisi);								
                    $jmlArt = count($nilai_jml_art);
                    //------------------------------------------------------------------1
                    $nilai_jml_keluarga= array();
                    $nilai_jml_keluarga = cek_nilaiAtribut('jml_keluarga',$kondisi);								
                    $jmlKeluarga = count($nilai_jml_keluarga);
                    //------------------------------------------------------------------2
                    $nilai_sta_bangunan = array();
                    $nilai_sta_bangunan = cek_nilaiAtribut('sta_bangunan',$kondisi);								
                    $jmlStaBangunan = count($nilai_sta_bangunan);
                    //------------------------------------------------------------------3
                    $nilai_sta_lahan = array();
                    $nilai_sta_lahan = cek_nilaiAtribut('sta_lahan',$kondisi);								
                    $jmlStaLahan = count($nilai_sta_lahan);
                    //------------------------------------------------------------------4
                    $nilai_jns_lantai = array();
                    $nilai_jns_lantai = cek_nilaiAtribut('jns_lantai',$kondisi);								
                    $jmlJnsLantai = count($nilai_jns_lantai);
                    //------------------------------------------------------------------5
                    $nilai_jns_dinding = array();
                    $nilai_jns_dinding = cek_nilaiAtribut('jns_dinding',$kondisi);								
                    $jmlJnsDinding = count($nilai_jns_dinding);
                    //------------------------------------------------------------------6
                    $nilai_knds_dinding = array();
                    $nilai_knds_dinding = cek_nilaiAtribut('knds_dinding',$kondisi);								
                    $jmlKndsDinding = count($nilai_knds_dinding);
                    //------------------------------------------------------------------7
                    $nilai_jns_atap  = array();
                    $nilai_jns_atap  = cek_nilaiAtribut('jns_atap',$kondisi);
                    $jmlJnsAtap = count($nilai_jns_atap);
                    //------------------------------------------------------------------8
                    $nilai_knds_atap = array();
                    $nilai_knds_atap = cek_nilaiAtribut('knds_atap',$kondisi);
                    $jmlKndsAtap = count($nilai_knds_atap);
                    //------------------------------------------------------------------9
                    $nilai_smb_air_minum = array();
                    $nilai_smb_air_minum  = cek_nilaiAtribut('smb_air_minum',$kondisi);
                    $jmlSmbAir = count($nilai_smb_air_minum);
                    //------------------------------------------------------------------10
                    $nilai_cmdp_air_minum = array();
                    $nilai_cmdp_air_minum  = cek_nilaiAtribut('cmdp_air_minum',$kondisi);
                    $jmlCmdpAir = count($nilai_cmdp_air_minum);
                    //------------------------------------------------------------------11
                    $nilai_smb_penerangan = array();
                    $nilai_cmdp_air_minum  = cek_nilaiAtribut('cmdp_air_minum',$kondisi);
                    $jmlCmdpAir = count($nilai_cmdp_air_minum);
                    //------------------------------------------------------------------12
                    $nilai_dy_listrik = array();
                    $nilai_dy_listrik  = cek_nilaiAtribut('dy_listrik',$kondisi);
                    $jmlDyListrik = count($nilai_dy_listrik);
                    //------------------------------------------------------------------13
                    $nilai_bb_masak = array();
                    $nilai_bb_masak  = cek_nilaiAtribut('bb_masak',$kondisi);
                    $jmlBbm = count($nilai_bb_masak);
                    //------------------------------------------------------------------14
                    $nilai_fasbab = array();
                    $nilai_fasbab  = cek_nilaiAtribut('fasbab',$kondisi);
                    $jmlFasbab = count($nilai_fasbab);
                    //------------------------------------------------------------------15
                    $nilai_jns_kloset = array();
                    $nilai_jns_kloset  = cek_nilaiAtribut('jns_kloset',$kondisi);
                    $jmlJnsKloset= count($nilai_jns_kloset);
                    //------------------------------------------------------------------16
                    $nilai_tp_akhir = array();
                    $nilai_tp_akhir = cek_nilaiAtribut('tp_akhir',$kondisi);
                    $jmlTpAkhir = count($nilai_tp_akhir);
                    //------------------------------------------------------------------17
                    $nilai_sta_art_usaha = array();
                    $nilai_sta_art_usaha = cek_nilaiAtribut('sta_art_usaha',$kondisi);
                    $jmlStSartu = count($nilai_sta_art_usaha);
                    //------------------------------------------------------------------18
                    $nilai_sta_kks = array();
                    $nilai_sta_kks = cek_nilaiAtribut('sta_kks',$kondisi);
                    $jmlStaKks = count($nilai_sta_kks);
                    //------------------------------------------------------------------19
                    $nilai_sta_kip = array();
                    $nilai_sta_kip = cek_nilaiAtribut('sta_kip',$kondisi);
                    $jmlStaKip = count($nilai_sta_kip);
                    //------------------------------------------------------------------20
                    $nilai_sta_kis = array();
                    $nilai_sta_kis = cek_nilaiAtribut('sta_kis',$kondisi);
                    $jmlStaKis = count($nilai_sta_kis);
                    //------------------------------------------------------------------21
                    $nilai_sta_bpjsm = array();
                    $nilai_sta_bpjsm = cek_nilaiAtribut('sta_bpjsm',$kondisi);
                    $jmlStaBpjsm = count($nilai_sta_bpjsm);
                    //------------------------------------------------------------------22
                    $nilai_sta_jamsotek = array();
                    $nilai_sta_jamsotek = cek_nilaiAtribut('sta_jamsotek',$kondisi);
                    $jmlJamsostek = count($nilai_sta_jamsotek);
                    //------------------------------------------------------------------23
                    $nilai_sta_asuransi_lain = array();
                    $nilai_sta_asuransi_lain = cek_nilaiAtribut('asuransi_lain',$kondisi);
                    $jmlAsuransi = count($nilai_sta_asuransi_lain);
                    //------------------------------------------------------------------24
                    $nilai_sta_rasta = array();
                    $nilai_sta_rasta = cek_nilaiAtribut('sta_rasta',$kondisi);
                    $jmlRasta = count($nilai_sta_rasta);
                    //------------------------------------------------------------------25
                    $nilai_sta_kur = array();
                    $nilai_sta_kur = cek_nilaiAtribut('sta_kur',$kondisi);
                    $jmlSkur = count($nilai_sta_kur);
                    //------------------------------------------------------------------26
                    $nilai_sta_keberadaan_art = array();
                    $nilai_sta_keberadaan_art = cek_nilaiAtribut('sta_keberadaan_art',$kondisi);
                    $jmlSkbar = count($nilai_sta_keberadaan_art);
                    //------------------------------------------------------------------27
//-------------------------------------------------------------------------------------------------------> hitung gain atribut
                    return $this->CI->db->query("TRUNCATE tbl_gain");
                     if($jmlArt!=1){//------------------------------------------- Jumlah ART
                        $NA1Jart="jml_art='$nilai_jml_art[0]'";
                        $NA2Jart="";
                        $NA3Jart="";
                        if($jmlArt==2){
                             $NA2Jart="jml_art='$nilai_jml_art[1]'";
                        }elseif ($jmlArt==3){
                             $NA2Jart="jml_art='$nilai_jml_art[1]'";
                             $NA3Jart="jml_art='$nilai_jml_art[2]'";
                        }				
                        hitung_gain($kondisi ,"jml_art", $entropy_all , $NA1Jart, $NA2Jart, $NA3Jart, "" , "");
                     }
                     if($jmlKeluarga!=1){//--------------------------------------- Jumlah Keluarga
                        $NA1Jkga = "jml_keluarga='$nilai_jml_keluarga[0]'";
                        $NA2Jkga = "jml_keluarga='$nilai_jml_keluarga[1]'";
                        hitung_gain($kondisi, "status", $entropy_all, $NA1Jkga, $NA2Jkga, "", "", "");
                     }
                     if($jmlStaBangunan!=1){//------------------------------------ Sta. Bangunan 
                        $NA1Stbn="sta_bangunan='$nilai_sta_bangunan[0]'";
                        $NA2Stbn="";
                        $NA3Stbn="";
                        $NA4Stbn="";
                        $NA5Stbn="";
                            if($jmlStaBangunan==2){
                                    $NA2Stbn="sta_bangunan='$nilai_sta_bangunan[1]'";
                            }elseif($jmlStaBangunan==3){
                                    $NA2Stbn="sta_bangunan='$nilai_sta_bangunan[1]'";
                                    $NA3Stbn="sta_bangunan='$nilai_sta_bangunan[2]'";
                            }elseif($jmlStaBangunan==4){
                                    $NA2Stbn="sta_bangunan='$nilai_sta_bangunan[1]'";
                                    $NA3Stbn="sta_bangunan='$nilai_sta_bangunan[2]'";
                                    $NA4Stbn="sta_bangunan='$nilai_sta_bangunan[3]'";
                            }elseif($jmlStaBangunan==5){
                                    $NA2Stbn="sta_bangunan='$nilai_sta_bangunan[1]'";
                                    $NA3Stbn="sta_bangunan='$nilai_sta_bangunan[2]'";
                                    $NA4Stbn="sta_bangunan='$nilai_sta_bangunan[3]'";
                                    $NA5Stbn="sta_bangunan='$nilai_sta_bangunan[4]'";
                            }
                        hitung_gain($kondisi , "sta_bangunan" , $entropy_all , $NA1Stbn , $NA2Stbn , $NA3Stbn , $NA4Stbn , $NA5Stbn);
                     }
                     if($jmlStaLahan!=1){//------------------------------------ Sta. Lahan
                        $NA1Stlhn="sta_lahan='$nilai_sta_lahan[0]'";
                        $NA2Stlhn="";
                        $NA3Stlhn="";
                        $NA4Stlhn="";
                            if($jmlStaLahan==2){
                                    $NA2Stlhn="sta_lahan='$nilai_sta_lahan[1]'";
                            }elseif($jmlStaLahan==3){
                                    $NA2Stlhn="sta_lahan='$nilai_sta_lahan[1]'";
                                    $NA3Stlhn="sta_lahan='$nilai_sta_lahan[2]'";
                            }elseif($jmlStaLahan==4){
                                    $NA2Stlhn="sta_lahan='$nilai_sta_lahan[1]'";
                                    $NA3Stlhn="sta_lahan='$nilai_sta_lahan[2]'";
                                    $NA4Stlhn="sta_lahan='$nilai_sta_lahan[3]'";
                            }
                        hitung_gain($kondisi , "sta_lahan" , $entropy_all , $NA1Stlhn , $NA2Stlhn , $NA3Stlhn , $NA4Stlhn ,"");
                     }
                     if($jmlJnsLantai!=1){//--------------------------------------------> Jenis Lantai 
                        $NA1Jslti="jns_lantai='$nilai_jns_lantai[0]'";
                        $NA2Jslti="";
                        $NA3Jslti="";
                        $NA4Jslti="";
                        $NA5Jslti="";
                        $NA6Jslti="";
                        $NA7Jslti="";
                        $NA8Jslti="";
                        $NA9Jslti="";
                        $NA10Jslti="";
                            if($jmlJnsLantai==2){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                            }elseif($jmlJnsLantai==3){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                            }elseif($jmlJnsLantai==4){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                                    $NA4Jslti="jns_lantai='$nilai_jns_lantai[3]'";
                            }elseif($jmlJnsLantai==5){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                                    $NA4Jslti="jns_lantai='$nilai_jns_lantai[3]'";
                                    $NA5Jslti="jns_lantai='$nilai_jns_lantai[4]'";
                            }elseif($jmlJnsLantai==6){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                                    $NA4Jslti="jns_lantai='$nilai_jns_lantai[3]'";
                                    $NA5Jslti="jns_lantai='$nilai_jns_lantai[4]'";
                                    $NA6Jslti="jns_lantai='$nilai_jns_lantai[5]'";
                            }elseif($jmlJnsLantai==7){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                                    $NA4Jslti="jns_lantai='$nilai_jns_lantai[3]'";
                                    $NA5Jslti="jns_lantai='$nilai_jns_lantai[4]'";
                                    $NA6Jslti="jns_lantai='$nilai_jns_lantai[5]'";
                                    $NA7Jslti="jns_lantai='$nilai_jns_lantai[6]'";
                            }elseif($jmlJnsLantai==8){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                                    $NA4Jslti="jns_lantai='$nilai_jns_lantai[3]'";
                                    $NA5Jslti="jns_lantai='$nilai_jns_lantai[4]'";
                                    $NA6Jslti="jns_lantai='$nilai_jns_lantai[5]'";
                                    $NA7Jslti="jns_lantai='$nilai_jns_lantai[6]'";
                                    $NA8Jslti="jns_lantai='$nilai_jns_lantai[7]'";
                            }elseif($jmlJnsLantai==9){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                                    $NA4Jslti="jns_lantai='$nilai_jns_lantai[3]'";
                                    $NA5Jslti="jns_lantai='$nilai_jns_lantai[4]'";
                                    $NA6Jslti="jns_lantai='$nilai_jns_lantai[5]'";
                                    $NA7Jslti="jns_lantai='$nilai_jns_lantai[6]'";
                                    $NA8Jslti="jns_lantai='$nilai_jns_lantai[7]'";
                                    $NA9Jslti="jns_lantai='$nilai_jns_lantai[8]'";
                            }elseif($jmlJnsLantai==10){
                                    $NA2Jslti="jns_lantai='$nilai_jns_lantai[1]'";
                                    $NA3Jslti="jns_lantai='$nilai_jns_lantai[2]'";
                                    $NA4Jslti="jns_lantai='$nilai_jns_lantai[3]'";
                                    $NA5Jslti="jns_lantai='$nilai_jns_lantai[4]'";
                                    $NA6Jslti="jns_lantai='$nilai_jns_lantai[5]'";
                                    $NA7Jslti="jns_lantai='$nilai_jns_lantai[6]'";
                                    $NA8Jslti="jns_lantai='$nilai_jns_lantai[7]'";
                                    $NA9Jslti="jns_lantai='$nilai_jns_lantai[8]'";
                                    $NA10Jslti="jns_lantai='$nilai_jns_lantai[9]'";
                            }
                        hitung_gain($kondisi , "jns_lantai" , $entropy_all , $NA1Jslti , $NA2Jslti , $NA3Jslti, $NA4Jslti ,$NA5Jslti, $NA6Jslti , $NA7Jslti , $NA8Jslti, $NA9Jslti ,$NA10Jslti);
                     }
                     if($jmlJnsDinding!=1){//----------------------------------------------> Jenis Dinding
                        $NA1Jsddg="jns_dinding='$nilai_jns_dinding[0]'";
                        $NA2Jsddg="";
                        $NA3Jsddg="";
                        $NA4Jsddg="";
                        $NA5Jsddg="";
                        $NA6Jsddg="";
                        $NA7Jsddg="";
                            if($jmlJnsDinding==2){
                                    $NA2Jsddg="jns_dinding='$nilai_jns_dinding[1]'";
                            }elseif($jmlJnsDinding==3){
                                    $NA2Jsddg="jns_dinding='$nilai_jns_dinding[1]'";
                                    $NA3Jsddg="jns_dinding='$nilai_jns_dinding[2]'";
                            }elseif($jmlJnsDinding==4){
                                    $NA2Jsddg="jns_dinding='$nilai_jns_dinding[1]'";
                                    $NA3Jsddg="jns_dinding='$nilai_jns_dinding[2]'";
                                    $NA4Jsddg="jns_dinding='$nilai_jns_dinding[3]'";
                            }elseif($jmlJnsDinding==5){
                                    $NA2Jsddg="jns_dinding='$nilai_jns_dinding[1]'";
                                    $NA3Jsddg="jns_dinding='$nilai_jns_dinding[2]'";
                                    $NA4Jsddg="jns_dinding='$nilai_jns_dinding[3]'";
                                    $NA5Jsddg="jns_dinding='$nilai_jns_dinding[4]'";
                            }elseif($jmlJnsDinding==6){
                                    $NA2Jsddg="jns_dinding='$nilai_jns_dinding[1]'";
                                    $NA3Jsddg="jns_dinding='$nilai_jns_dinding[2]'";
                                    $NA4Jsddg="jns_dinding='$nilai_jns_dinding[3]'";
                                    $NA5Jsddg="jns_dinding='$nilai_jns_dinding[4]'";
                                    $NA6Jsddg="jns_dinding='$nilai_jns_dinding[5]'";
                            }elseif($jmlJnsDinding==7){
                                    $NA2Jsddg="jns_dinding='$nilai_jns_dinding[1]'";
                                    $NA3Jsddg="jns_dinding='$nilai_jns_dinding[2]'";
                                    $NA4Jsddg="jns_dinding='$nilai_jns_dinding[3]'";
                                    $NA5Jsddg="jns_dinding='$nilai_jns_dinding[4]'";
                                    $NA6Jsddg="jns_dinding='$nilai_jns_dinding[5]'";
                                    $NA7Jsddg="jns_dinding='$nilai_jns_dinding[6]'";
                            }
                            hitung_gain($kondisi , "jns_dinding" , $entropy_all , $NA1Jsddg , $NA2Jsddg , $NA3Jsddg, $NA4Jsddg ,$NA5Jsddg, $NA6Jsddg , $NA7Jsddg);
                        }
                     if($jmlKndsDinding!=1){//-----------------------------------------------> Kondisi Dinding
                        $NA1Kddg = "knds_dinding='$nilai_knds_dinding[0]'";
                        $NA2Kddg = "knds_dinding='$nilai_knds_dinding[1]'";
                        hitung_gain($kondisi, "knds_dinding", $entropy_all, $NA1Kddg, $NA2Kddg, "", "", "");
                        }
                     if($jmlJnsAtap!=1){//---------------------------------------------------> Jenis Atap 
                        $NA1Jsatp="jns_atap='$nilai_jns_atap[0]'";
                        $NA2Jsatp="";
                        $NA3Jsatp="";
                        $NA4Jsatp="";
                        $NA5Jsatp="";
                        $NA6Jsatp="";
                        $NA7Jsatp="";
                        $NA8Jsatp="";
                        $NA9Jsatp="";
                        $NA10Jsatp="";
                            if($jmlJnsAtap==2){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                            }elseif($jmlJnsAtap==3){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                            }elseif($jmlJnsAtap==4){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                                    $NA4Jsatp="jns_atap='$nilai_jns_atap[3]'";
                            }elseif($jmlJnsAtap==5){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                                    $NA4Jsatp="jns_atap='$nilai_jns_atap[3]'";
                                    $NA5Jsatp="jns_atap='$nilai_jns_atap[4]'";
                            }elseif($jmlJnsAtap==6){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                                    $NA4Jsatp="jns_atap='$nilai_jns_atap[3]'";
                                    $NA5Jsatp="jns_atap='$nilai_jns_atap[4]'";
                                    $NA6Jsatp="jns_atap='$nilai_jns_atap[5]'";
                            }elseif($jmlJnsAtap==7){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                                    $NA4Jsatp="jns_atap='$nilai_jns_atap[3]'";
                                    $NA5Jsatp="jns_atap='$nilai_jns_atap[4]'";
                                    $NA6Jsatp="jns_atap='$nilai_jns_atap[5]'";
                                    $NA7Jsatp="jns_atap='$nilai_jns_atap[6]'";
                            }elseif($jmlJnsAtap==8){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                                    $NA4Jsatp="jns_atap='$nilai_jns_atap[3]'";
                                    $NA5Jsatp="jns_atap='$nilai_jns_atap[4]'";
                                    $NA6Jsatp="jns_atap='$nilai_jns_atap[5]'";
                                    $NA7Jsatp="jns_atap='$nilai_jns_atap[6]'";
                                    $NA8Jsatp="jns_atap='$nilai_jns_atap[7]'";
                            }elseif($jmlJnsAtap==9){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                                    $NA4Jsatp="jns_atap='$nilai_jns_atap[3]'";
                                    $NA5Jsatp="jns_atap='$nilai_jns_atap[4]'";
                                    $NA6Jsatp="jns_atap='$nilai_jns_atap[5]'";
                                    $NA7Jsatp="jns_atap='$nilai_jns_atap[6]'";
                                    $NA8Jsatp="jns_atap='$nilai_jns_atap[7]'";
                                    $NA9Jsatp="jns_atap='$nilai_jns_atap[8]'";
                            }elseif($jmlJnsAtap==10){
                                    $NA2Jsatp="jns_atap='$nilai_jns_atap[1]'";
                                    $NA3Jsatp="jns_atap='$nilai_jns_atap[2]'";
                                    $NA4Jsatp="jns_atap='$nilai_jns_atap[3]'";
                                    $NA5Jsatp="jns_atap='$nilai_jns_atap[4]'";
                                    $NA6Jsatp="jns_atap='$nilai_jns_atap[5]'";
                                    $NA7Jsatp="jns_atap='$nilai_jns_atap[6]'";
                                    $NA8Jsatp="jns_atap='$nilai_jns_atap[7]'";
                                    $NA9Jsatp="jns_atap='$nilai_jns_atap[8]'";
                                    $NA10Jsatp="jns_atap='$nilai_jns_atap[9]'";
                            }
                            hitung_gain($kondisi , "jns_atap" , $entropy_all , $NA1Jsatp , $NA2Jsatp , $NA3Jsatp, $NA4Jsatp ,$NA5Jsatp, $NA6Jsatp , $NA7Jsatp , $NA8Jsatp, $NA9Jsatp ,$NA10Jsatp);
                        }
                     if($jmlKndsAtap!=1){//------------------------------------------------------------> Kondisi Atap 
                        $NA1Kndstp = "knds_atap='$nilai_knds_atap[0]'";
                        $NA2Kndstp = "knds_atap='$nilai_knds_atap[1]'";
                        hitung_gain($kondisi, "knds_atap", $entropy_all, $NA1Kndstp, $NA2Kndstp, "", "", "");
                        }
                     if($jmlSmbAir!=1){//--------------------------------------------------------------> Sumber Air Minum
                        $NA1Smbr="smb_air_minum='$nilai_smb_air_minum[0]'";
                        $NA2Smbr="";
                        $NA3Smbr="";
                        $NA4Smbr="";
                        $NA5Smbr="";
                        $NA6Smbr="";
                        $NA7Smbr="";
                        $NA8Smbr="";
                        $NA9Smbr="";
                        $NA10Smbr="";
                        $NA11Smbr="";
                        $NA12Smbr="";
                            if($jmlSmbAir==2){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                            }elseif($jmlSmbAir==3){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                            }elseif($jmlSmbAir==4){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                            }elseif($jmlSmbAir==5){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                            }elseif($jmlSmbAir==6){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                                    $NA6Smbr="smb_air_minum='$nilai_smb_air_minum[5]'";
                            }elseif($jmlSmbAir==7){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                                    $NA6Smbr="smb_air_minum='$nilai_smb_air_minum[5]'";
                                    $NA7Smbr="smb_air_minum='$nilai_smb_air_minum[6]'";
                            }elseif($jmlSmbAir==8){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                                    $NA6Smbr="smb_air_minum='$nilai_smb_air_minum[5]'";
                                    $NA7Smbr="smb_air_minum='$nilai_smb_air_minum[6]'";
                                    $NA8Smbr="smb_air_minum='$nilai_smb_air_minum[7]'";
                            }elseif($jmlSmbAir==9){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                                    $NA6Smbr="smb_air_minum='$nilai_smb_air_minum[5]'";
                                    $NA7Smbr="smb_air_minum='$nilai_smb_air_minum[6]'";
                                    $NA8Smbr="smb_air_minum='$nilai_smb_air_minum[7]'";
                                    $NA9Smbr="smb_air_minum='$nilai_smb_air_minum[8]'";
                            }elseif($jmlSmbAir==10){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                                    $NA6Smbr="smb_air_minum='$nilai_smb_air_minum[5]'";
                                    $NA7Smbr="smb_air_minum='$nilai_smb_air_minum[6]'";
                                    $NA8Smbr="smb_air_minum='$nilai_smb_air_minum[7]'";
                                    $NA9Smbr="smb_air_minum='$nilai_smb_air_minum[8]'";
                                    $NA10Smbr="smb_air_minum='$nilai_smb_air_minum[9]'";
                            }elseif($jmlSmbAir==11){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                                    $NA6Smbr="smb_air_minum='$nilai_smb_air_minum[5]'";
                                    $NA7Smbr="smb_air_minum='$nilai_smb_air_minum[6]'";
                                    $NA8Smbr="smb_air_minum='$nilai_smb_air_minum[7]'";
                                    $NA9Smbr="smb_air_minum='$nilai_smb_air_minum[8]'";
                                    $NA10Smbr="smb_air_minum='$nilai_smb_air_minum[9]'";
                                    $NA11Smbr="smb_air_minum='$nilai_smb_air_minum[10]'";
                            }elseif($jmlSmbAir==12){
                                    $NA2Smbr="smb_air_minum='$nilai_smb_air_minum[1]'";
                                    $NA3Smbr="smb_air_minum='$nilai_smb_air_minum[2]'";
                                    $NA4Smbr="smb_air_minum='$nilai_smb_air_minum[3]'";
                                    $NA5Smbr="smb_air_minum='$nilai_smb_air_minum[4]'";
                                    $NA6Smbr="smb_air_minum='$nilai_smb_air_minum[5]'";
                                    $NA7Smbr="smb_air_minum='$nilai_smb_air_minum[6]'";
                                    $NA8Smbr="smb_air_minum='$nilai_smb_air_minum[7]'";
                                    $NA9Smbr="smb_air_minum='$nilai_smb_air_minum[8]'";
                                    $NA10Smbr="smb_air_minum='$nilai_smb_air_minum[9]'";
                                    $NA11Smbr="smb_air_minum='$nilai_smb_air_minum[10]'";
                                    $NA12Smbr="smb_air_minum='$nilai_smb_air_minum[11]'";
                            }
                            hitung_gain($kondisi , "smb_air_minum" , $entropy_all , $NA1Smbr , $NA2Smbr , $NA3Smbr, $NA4Smbr ,$NA5Smbr, $NA6Smbr , $NA7Smbr , $NA8Smbr, $NA9Smbr ,$NA10Smbr, $NA11Smbr, $NA12Smbr);
                        }
                     if($jmlCmdpAir!=1){//-------------------------------------------------> Cara Peroleh Air
                        $NA1Cmda="cmdp_air_minum='$nilai_cmdp_air_minum[0]'";
                        $NA2Cmda="";
                        $NA3Cmda="";
                        $NA4Cmda="";
                            if($jmlCmdpAir==2){
                                    $NA2Cmda="cmdp_air_minum='$nilai_cmdp_air_minum[1]'";
                            }elseif($jmlCmdpAir==3){
                                    $NA2Cmda="cmdp_air_minum='$nilai_cmdp_air_minum[1]'";
                                    $NA3Cmda="cmdp_air_minum='$nilai_cmdp_air_minum[2]'";
                            }elseif($jmlCmdpAir==4){
                                    $NA2Cmda="cmdp_air_minum='$nilai_cmdp_air_minum[1]'";
                                    $NA3Cmda="cmdp_air_minum='$nilai_cmdp_air_minum[2]'";
                                    $NA4Cmda="cmdp_air_minum='$nilai_cmdp_air_minum[3]'";
                            }
                            hitung_gain($kondisi , "cmdp_air_minum" , $entropy_all , $NA1Cmda , $NA2Cmda , $NA3Cmda , $NA4Cmda ,"");
                        }
                     if($jmlDyListrik!=1){//---------------------------------------------------------> Daya Listrik
                        $NA1Dy="dy_listrik='$nilai_dy_listrik[0]'";
                        $NA2Dy="";
                        $NA3Dy="";
                        $NA4Dy="";
                        $NA5Dy="";
                        $NA6Dy="";
                            if($jmlDyListrik==2){
                                    $NA2Dy="dy_listrik='$nilai_dy_listrik[1]'";
                            }elseif($jmlDyListrik==3){
                                    $NA2Dy="dy_listrik='$nilai_dy_listrik[1]'";
                                    $NA3Dy="dy_listrik='$nilai_dy_listrik[2]'";
                            }elseif($jmlDyListrik==4){
                                    $NA2Dy="dy_listrik='$nilai_dy_listrik[1]'";
                                    $NA3Dy="dy_listrik='$nilai_dy_listrik[2]'";
                                    $NA4Dy="dy_listrik='$nilai_dy_listrik[3]'";
                            }elseif($jmlDyListrik==5){
                                    $NA2Dy="dy_listrik='$nilai_dy_listrik[1]'";
                                    $NA3Dy="dy_listrik='$nilai_dy_listrik[2]'";
                                    $NA4Dy="dy_listrik='$nilai_dy_listrik[3]'";
                                    $NA5Dy="dy_listrik='$nilai_dy_listrik[4]'";
                            }elseif($jmlDyListrik==6){
                                    $NA2Dy="dy_listrik='$nilai_dy_listrik[1]'";
                                    $NA3Dy="dy_listrik='$nilai_dy_listrik[2]'";
                                    $NA4Dy="dy_listrik='$nilai_dy_listrik[3]'";
                                    $NA5Dy="dy_listrik='$nilai_dy_listrik[4]'";
                                    $NA6Dy="dy_listrik='$nilai_dy_listrik[5]'";
                            }
                            hitung_gain($kondisi , "dy_listrik" , $entropy_all , $NA1Dy , $NA2Dy , $NA3Dy, $NA4Dy ,$NA5Dy, $NA6Dy);
                        }
                     if($jmlBbm!=1){//----------------------------------------------------> BBM
                        $NA1Bbm="bb_masak='$nilai_bb_masak[0]'";
                        $NA2Bbm="";
                        $NA3Bbm="";
                        $NA4Bbm="";
                        $NA5Bbm="";
                        $NA6Bbm="";
                        $NA7Bbm="";
                        $NA8Bbm="";
                        $NA9Bbm="";
                            if($jmlSmbAir==2){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                            }elseif($jmlSmbAir==3){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                                    $NA3Bbm="bb_masak='$nilai_bb_masak[2]'";
                            }elseif($jmlSmbAir==4){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                                    $NA3Bbm="bb_masak='$nilai_bb_masak[2]'";
                                    $NA4Bbm="bb_masak='$nilai_bb_masak[3]'";
                            }elseif($jmlSmbAir==5){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                                    $NA3Bbm="bb_masak='$nilai_bb_masak[2]'";
                                    $NA4Bbm="bb_masak='$nilai_bb_masak[3]'";
                                    $NA5Bbm="bb_masak='$nilai_bb_masak[4]'";
                            }elseif($jmlSmbAir==6){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                                    $NA3Bbm="bb_masak='$nilai_bb_masak[2]'";
                                    $NA4Bbm="bb_masak='$nilai_bb_masak[3]'";
                                    $NA5Bbm="bb_masak='$nilai_bb_masak[4]'";
                                    $NA6Bbm="bb_masak='$nilai_bb_masak[5]'";
                            }elseif($jmlSmbAir==7){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                                    $NA3Bbm="bb_masak='$nilai_bb_masak[2]'";
                                    $NA4Bbm="bb_masak='$nilai_bb_masak[3]'";
                                    $NA5Bbm="bb_masak='$nilai_bb_masak[4]'";
                                    $NA6Bbm="bb_masak='$nilai_bb_masak[5]'";
                                    $NA7Bbm="bb_masak='$nilai_bb_masak[6]'";
                            }elseif($jmlSmbAir==8){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                                    $NA3Bbm="bb_masak='$nilai_bb_masak[2]'";
                                    $NA4Bbm="bb_masak='$nilai_bb_masak[3]'";
                                    $NA5Bbm="bb_masak='$nilai_bb_masak[4]'";
                                    $NA6Bbm="bb_masak='$nilai_bb_masak[5]'";
                                    $NA7Bbm="bb_masak='$nilai_bb_masak[6]'";
                                    $NA8Bbm="bb_masak='$nilai_bb_masak[7]'";
                            }elseif($jmlSmbAir==9){
                                    $NA2Bbm="bb_masak='$nilai_bb_masak[1]'";
                                    $NA3Bbm="bb_masak='$nilai_bb_masak[2]'";
                                    $NA4Bbm="bb_masak='$nilai_bb_masak[3]'";
                                    $NA5Bbm="bb_masak='$nilai_bb_masak[4]'";
                                    $NA6Bbm="bb_masak='$nilai_bb_masak[5]'";
                                    $NA7Bbm="bb_masak='$nilai_bb_masak[6]'";
                                    $NA8Bbm="bb_masak='$nilai_bb_masak[7]'";
                                    $NA9Bbm="bb_masak='$nilai_bb_masak[8]'";
                            }
                            hitung_gain($kondisi , "bb_masak" , $entropy_all , $NA1Bbm , $NA2Bbm , $NA3Bbm, $NA4Bbm ,$NA5Bbm, $NA6Bbm , $NA7Bbm , $NA8Bbm, $NA9Bbm);
                        }
                     if($jmlFasbab!=1){//-------------------------------------------------------------> Fasilbab
                        $NA1Fbb="fasbab='$nilai_fasbab[0]'";
                        $NA2Fbb="";
                        $NA3Fbb="";
                        $NA4Fbb="";
                            if($jmlFasbab==2){
                                    $NA2Fbb="fasbab='$nilai_fasbab[1]'";
                            }elseif($jmlFasbab==3){
                                    $NA2Fbb="fasbab='$nilai_fasbab[1]'";
                                    $NA3Fbb="fasbab='$nilai_fasbab[2]'";
                            }elseif($jmlFasbab==4){
                                    $NA2Fbb="fasbab='$nilai_fasbab[1]'";
                                    $NA3Fbb="fasbab='$nilai_fasbab[2]'";
                                    $NA4Fbb="fasbab='$nilai_fasbab[3]'";
                            }
                            hitung_gain($kondisi , "fasbab" , $entropy_all , $NA1Fbb , $NA2Fbb , $NA3Fbb , $NA4Fbb ,"");
                        }
                     if($jmlJnsKloset!=1){//--------------------------------------------------------> Jenis Kloset
                        $NA1Jkls="jns_kloset='$nilai_jns_kloset[0]'";
                        $NA2Jkls="";
                        $NA3Jkls="";
                        $NA4Jkls="";
                            if($jmlJnsKloset==2){
                                    $NA2Jkls="jns_kloset='$nilai_jns_kloset[1]'";
                            }elseif($jmlJnsKloset==3){
                                    $NA2Jkls="jns_kloset='$nilai_jns_kloset[1]'";
                                    $NA3Jkls="jns_kloset='$nilai_jns_kloset[2]'";
                            }elseif($jmlJnsKloset==4){
                                    $NA2Jkls="jns_kloset='$nilai_jns_kloset[1]'";
                                    $NA3Jkls="jns_kloset='$nilai_jns_kloset[2]'";
                                    $NA4Jkls="jns_kloset='$nilai_jns_kloset[3]'";
                            }
                            hitung_gain($kondisi , "jns_kloset" , $entropy_all , $NA1Jkls , $NA2Jkls , $NA3Jkls , $NA4Jkls ,"");
                        }
                     if($jmlTpAkhir!=1){//--------------------------------------------------------------> Tp Akhir
                        $NA1Tpa="tp_akhir='$nilai_tp_akhir[0]'";
                        $NA2Tpa="";
                        $NA3Tpa="";
                        $NA4Tpa="";
                        $NA5Tpa="";
                        $NA6Tpa="";
                            if($jmlTpAkhir==2){
                                    $NA2Tpa="tp_akhir='$nilai_tp_akhir[1]'";
                            }elseif($jmlTpAkhir==3){
                                    $NA2Tpa="tp_akhir='$nilai_tp_akhir[1]'";
                                    $NA3Tpa="tp_akhir='$nilai_tp_akhir[2]'";
                            }elseif($jmlTpAkhir==4){
                                    $NA2Tpa="tp_akhir='$nilai_tp_akhir[1]'";
                                    $NA3Tpa="tp_akhir='$nilai_tp_akhir[2]'";
                                    $NA4Tpa="tp_akhir='$nilai_tp_akhir[3]'";
                            }elseif($jmlTpAkhir==5){
                                    $NA2Tpa="tp_akhir='$nilai_tp_akhir[1]'";
                                    $NA3Tpa="tp_akhir='$nilai_tp_akhir[2]'";
                                    $NA4Tpa="tp_akhir='$nilai_tp_akhir[3]'";
                                    $NA5Tpa="tp_akhir='$nilai_tp_akhir[4]'";
                            }elseif($jmlTpAkhir==6){
                                    $NA2Tpa="tp_akhir='$nilai_tp_akhir[1]'";
                                    $NA3Tpa="tp_akhir='$nilai_tp_akhir[2]'";
                                    $NA4Tpa="tp_akhir='$nilai_tp_akhir[3]'";
                                    $NA5Tpa="tp_akhir='$nilai_tp_akhir[4]'";
                                    $NA6Tpa="tp_akhir='$nilai_tp_akhir[5]'";
                            }
                            hitung_gain($kondisi , "tp_akhir" , $entropy_all , $NA1Tpa , $NA2Tpa , $NA3Tpa, $NA4Tpa ,$NA5Tpa, $NA6Tpa);
                        }
                     if($jmlStSartu!=1){//----------------------------------------------> SARTU
                        $NA1Sartu = "sta_art_usaha='$nilai_sta_art_usaha[0]'";
                        $NA2Sartu = "sta_art_usaha='$nilai_sta_art_usaha[1]'";
                        hitung_gain($kondisi, "sta_art_usaha", $entropy_all, $NA1Sartu, $NA2Sartu, "", "", "");
                        }
                     if($jmlStaKks!=1){//-----------------------------------------------> SKKS
                        $NA1Skks = "sta_kks='$nilai_sta_kks[0]'";
                        $NA2Skks = "sta_kks='$nilai_sta_kks[1]'";
                        hitung_gain($kondisi, "sta_kks", $entropy_all, $NA1Skks, $NA2Skks, "", "", "");
                        }
                     if($jmlStaKip!=1){//------------------------------------------------> SKIP
                        $NA1Skip = "sta_kip='$nilai_sta_kip[0]'";
                        $NA2Skip = "knds_atap='$nilai_sta_kip[1]'";
                        hitung_gain($kondisi, "sta_kip", $entropy_all, $NA1Skip, $NA2Skip, "", "", "");
                        }
                     if($jmlStaKis!=1){//------------------------------------------------> SKIS
                        $NA1Skis = "sta_kis='$nilai_sta_kis[0]'";
                        $NA2Skis = "sta_kis='$nilai_sta_kis[1]'";
                        hitung_gain($kondisi, "sta_kis", $entropy_all, $NA1Skis, $NA2Skis, "", "", "");
                        }
                     if($jmlStaBpjsm!=1){//-----------------------------------------------> BPJSM 
                        $NA1Bpjs = "sta_bpjsm='$nilai_sta_bpjsm[0]'";
                        $NA2Bpjs = "sta_bpjsm='$nilai_sta_bpjsm[1]'";
                        hitung_gain($kondisi, "sta_bpjsm", $entropy_all, $NA1Bpjs, $NA2Bpjs, "", "", "");
                        }
                     if($jmlJamsostek!=1){//----------------------------------------------> Jamsostek
                        $NA1Jamsos = "sta_jamsotek='$nilai_sta_jamsotek[0]'";
                        $NA2Jamsos = "sta_jamsotek='$nilai_sta_jamsotek[1]'";
                        hitung_gain($kondisi, "sta_jamsotek", $entropy_all, $NA1Jamsos, $NA2Jamsos, "", "", "");
                        }
                     if($jmlAsuransi!=1){//-----------------------------------------------> Asuransi 
                        $NA1Asuransi = "sta_asuransi_lain='$nilai_sta_asuransi_lain[0]'";
                        $NA2Asuransi = "sta_asuransi_lain='$nilai_sta_asuransi_lain[1]'";
                        hitung_gain($kondisi, "sta_asuransi_lain", $entropy_all, $NA1Asuransi, $NA2Asuransi, "", "", "");
                        }
                     if($jmlRasta!=1){//--------------------------------------------------> RASTA 
                        $NA1Rasta = "sta_rasta='$nilai_sta_rasta[0]'";
                        $NA2Rasta = "sta_rasta='$nilai_sta_rasta[1]'";
                        hitung_gain($kondisi, "sta_rasta", $entropy_all, $NA1Rasta, $NA2Rasta, "", "", "");
                        }
                     if($jmlSkur!=1){//---------------------------------------------------> SKUR 
                        $NA1Kur = "sta_kur='$nilai_sta_kur[0]'";
                        $NA2Kur = "sta_kur='$nilai_sta_kur[1]'";
                        hitung_gain($kondisi, "sta_kur", $entropy_all, $NA1Kur, $NA2Kur, "", "", "");
                        }
                     if($jmlSkbar!=1){
                        $NA1Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[0]'";
                        $NA2Skbrt="";
                        $NA3Skbrt="";
                        $NA4Skbrt="";
                        $NA5Skbrt="";
                        $NA6Skbrt="";
                            if($jmlSkbar==2){
                                    $NA2Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                            }elseif($jmlSkbar==3){
                                    $NA2Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                            }elseif($jmlSkbar==4){
                                    $NA2Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                                    $NA4Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[3]'";
                            }elseif($jmlSkbar==5){
                                    $NA2Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                                    $NA4Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[3]'";
                                    $NA5Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[4]'";
                            }elseif($jmlSkbar==6){
                                    $NA2Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                                    $NA4Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[3]'";
                                    $NA5Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[4]'";
                                    $NA6Skbrt="sta_keberadaan_art='$nilai_sta_keberadaan_art[5]'";
                            }
                            hitung_gain($kondisi , "sta_keberadaan_art" , $entropy_all , $NA1Skbrt , $NA2Skbrt , $NA3Skbrt, $NA4Skbrt ,$NA5Skbrt, $NA6Skbrt);
                        }//---------------------------------------------------------------------> sta_keberadaan_art
                        //-------------------------------------------------------------------------------------------------------ambil nilai gain tertinggi
                        $sql_max = $this->CI->db->query("SELECT MAX(gain) FROM tbl_gain");
                        $row_max = $sql_max->result_array();	
                        $max_gain = $row_max['0'];
                        
                        $sql = $this->CI->db->query("SELECT * FROM tbl_gain WHERE gain=$max_gain");
                        $row = $sql->result_array();	
                        $atribut = $row['1'];
                        echo "Atribut terpilih = ".$atribut.", dengan nilai gain = ".$max_gain."<br>";					
                        echo "<br>================================<br>";
                        //----------------------------------------------------------------> percabangan jika nilai atribut lebih dari 2 hitung rasio terlebih dahulu
                        if($atribut=="jml_art"){ 
                            if($jmlArt==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jml_art',$max_gain,$nilai_jml_art[0],$nilai_jml_art[1],$nilai_jml_art[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->proses_DT($kondisi , "($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");						
                            }
                            elseif($jmlInstansi==2){
                                $this->proses_DT($kondisi , "($atribut='$nilai_jml_art[0]')" , "($atribut='$nilai_jml_art[1]')");
                            } //-----------------------------> Jumlah ART var.atrb = 3
                        }
                        elseif($atribut=="jml_keluarga"){					
                                $this->proses_DT($kondisi , "($atribut='KCL')","($atribut='BSR')");										
			}//----------------------------------> Jumlah Keluarga var.atrb = 2
                        elseif($atribut=="sta_bangunan"){
                            if($jmlStaBangunan==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'sta_bangunan',$max_gain,$nilai_sta_bangunan[0],$nilai_sta_bangunan[1],$nilai_sta_bangunan[2],$nilai_sta_bangunan[3],$nilai_sta_bangunan[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlStaBangunan==4){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'sta_bangunan',$max_gain,$nilai_sta_bangunan[0],$nilai_sta_bangunan[1],$nilai_sta_bangunan[2],$nilai_sta_bangunan[3],'');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlStaBangunan==3){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'sta_bangunan',$max_gain,$nilai_sta_bangunan[0],$nilai_sta_bangunan[1],$nilai_sta_bangunan[2],'','');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlStaBangunan==2){
                                    $this->proses_DT($kondisi,"($atribut='$nilai_sta_bangunan[0]')" , "($atribut='$nilai_sta_bangunan[1]')");
                            }//-----------------------------------------------------------> Status Bangunan
                        }
                        elseif($atribut=="sta_lahan"){
                            if($jmlStaLahan==4){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'sta_lahan',$max_gain,$nilai_sta_lahan[0],$nilai_sta_lahan[1],$nilai_sta_lahan[2],$nilai_sta_lahan[3],'');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlStaLahan==3){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'sta_lahan',$max_gain,$nilai_sta_lahan[0],$nilai_sta_lahan[1],$nilai_sta_lahan[2],'','');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlStaLahan==2){
                                    $this->proses_DT($kondisi,"($atribut='$nilai_sta_lahan[0]')" , "($atribut='$nilai_sta_lahan[1]')");
                            }//-------------------------------------------------------> Status Lahan
                        }
                        elseif($atribut=="jns_lantai"){
                            if($jmlJnsLantai==10){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],$nilai_jns_lantai[3],$nilai_jns_lantai[4],$nilai_jns_lantai[5],$nilai_jns_lantai[6],$nilai_jns_lantai[7],$nilai_jns_lantai[8],$nilai_jns_lantai[9]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]')");						
                            }
                            elseif($jmlJnsLantai==9){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],$nilai_jns_lantai[3],$nilai_jns_lantai[4],$nilai_jns_lantai[5],$nilai_jns_lantai[6],$nilai_jns_lantai[7],$nilai_jns_lantai[8]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");						
                            }
                            elseif($jmlJnsLantai==8){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],$nilai_jns_lantai[3],$nilai_jns_lantai[4],$nilai_jns_lantai[5],$nilai_jns_lantai[6],$nilai_jns_lantai[7]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");						
                            }
                            elseif($jmlJnsLantai==7){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],$nilai_jns_lantai[3],$nilai_jns_lantai[4],$nilai_jns_lantai[5],$nilai_jns_lantai[6]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");						
                            }
                            elseif($jmlJnsLantai==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],$nilai_jns_lantai[3],$nilai_jns_lantai[4],$nilai_jns_lantai[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlJnsLantai==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],$nilai_jns_lantai[3],$nilai_jns_lantai[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlJnsLantai==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],$nilai_jns_lantai[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlJnsLantai==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_lantai',$max_gain,$nilai_jns_lantai[0],$nilai_jns_lantai[1],$nilai_jns_lantai[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlJnsLantai==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_jns_lantai[0]')" , "($atribut='$nilai_jns_lantai[1]')");
                            }
                        }
                        elseif($atribut=="jns_dinding"){
                            if($jmlJnsDinding==7){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_dinding',$max_gain,$nilai_jns_dinding[0],$nilai_jns_dinding[1],$nilai_jns_dinding[2],$nilai_jns_dinding[3],$nilai_jns_dinding[4],$nilai_jns_dinding[5],$nilai_jns_dinding[6]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");						
                            }
                            elseif($jmlJnsDinding==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_dinding',$max_gain,$nilai_jns_dinding[0],$nilai_jns_dinding[1],$nilai_jns_dinding[2],$nilai_jns_dinding[3],$nilai_jns_dinding[4],$nilai_jns_dinding[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlJnsDinding==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_dinding',$max_gain,$nilai_jns_dinding[0],$nilai_jns_dinding[1],$nilai_jns_dinding[2],$nilai_jns_dinding[3],$nilai_jns_dinding[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlJnsDinding==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_dinding',$max_gain,$nilai_jns_dinding[0],$nilai_jns_dinding[1],$nilai_jns_dinding[2],$nilai_jns_dinding[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlJnsDinding==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_dinding',$max_gain,$nilai_jns_dinding[0],$nilai_jns_dinding[1],$nilai_jns_dinding[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlJnsDinding==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_jns_dinding[0]')" , "($atribut='$nilai_jns_dinding[1]')");
                            }
                        }
                        elseif($atribut=="knds_dinding"){					
                                $this->proses_DT($kondisi , "($atribut='BKT')","($atribut='JKR')");										
			}
                        elseif($atribut=="jns_atap"){
                            if($jmlJnsAtap==10){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],$nilai_jns_atap[3],$nilai_jns_atap[4],$nilai_jns_atap[5],$nilai_jns_atap[6],$nilai_jns_atap[7],$nilai_jns_atap[8],$nilai_jns_atap[9]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]')");						
                            }
                            elseif($jmlJnsAtap==9){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],$nilai_jns_atap[3],$nilai_jns_atap[4],$nilai_jns_atap[5],$nilai_jns_atap[6],$nilai_jns_atap[7],$nilai_jns_atap[8]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");						
                            }
                            elseif($jmlJnsAtap==8){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],$nilai_jns_atap[3],$nilai_jns_atap[4],$nilai_jns_atap[5],$nilai_jns_atap[6],$nilai_jns_atap[7]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");						
                            }
                            elseif($jmlJnsAtap==7){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],$nilai_jns_atap[3],$nilai_jns_atap[4],$nilai_jns_atap[5],$nilai_jns_atap[6]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");						
                            }
                            elseif($jmlJnsAtap==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],$nilai_jns_atap[3],$nilai_jns_atap[4],$nilai_jns_atap[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlJnsAtap==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],$nilai_jns_atap[3],$nilai_jns_atap[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlJnsAtap==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],$nilai_jns_atap[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlJnsAtap==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'jns_atap',$max_gain,$nilai_jns_atap[0],$nilai_jns_atap[1],$nilai_jns_atap[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlJnsAtap==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_jns_atap[0]')" , "($atribut='$nilai_jns_atap[1]')");
                            }
                        }
                        elseif($atribut=="knds_atap"){					
                                $this->proses_DT($kondisi , "($atribut='BKT')","($atribut='JKR')");										
			}
                        elseif($atribut=="smb_air_minum"){
                            if($jmlSmbAir==12){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4],$nilai_smb_air_minum[5],$nilai_smb_air_minum[6],$nilai_smb_air_minum[7],$nilai_smb_air_minum[8],$nilai_smb_air_minum[9],$nilai_smb_air_minum[10],$nilai_smb_air_minum[11]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]' OR $atribut='$exp_cabang[9]' OR $atribut='$exp_cabang[10]')");						
                            }
                            elseif($jmlSmbAir==11){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4],$nilai_smb_air_minum[5],$nilai_smb_air_minum[6],$nilai_smb_air_minum[7],$nilai_smb_air_minum[8],$nilai_smb_air_minum[9],$nilai_smb_air_minum[10]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]' OR $atribut='$exp_cabang[9]')");						
                            }
                            elseif($jmlSmbAir==10){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4],$nilai_smb_air_minum[5],$nilai_smb_air_minum[6],$nilai_smb_air_minum[7],$nilai_smb_air_minum[8],$nilai_smb_air_minum[9]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]')");						
                            }
                            elseif($jmlSmbAir==9){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4],$nilai_smb_air_minum[5],$nilai_smb_air_minum[6],$nilai_smb_air_minum[7],$nilai_smb_air_minum[8]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");						
                            }
                            elseif($jmlSmbAir==8){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4],$nilai_smb_air_minum[5],$nilai_smb_air_minum[6],$nilai_smb_air_minum[7]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");						
                            }
                            elseif($jmlSmbAir==7){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4],$nilai_smb_air_minum[5],$nilai_smb_air_minum[6]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");						
                            }
                            elseif($jmlSmbAir==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4],$nilai_smb_air_minum[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlSmbAir==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],$nilai_smb_air_minum[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlSmbAir==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],$nilai_smb_air_minum[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlSmbAir==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'smb_air_minum',$max_gain,$nilai_smb_air_minum[0],$nilai_smb_air_minum[1],$nilai_smb_air_minum[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlSmbAir==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_smb_air_minum[0]')" , "($atribut='$nilai_smb_air_minum[1]')");
                            }
                        }
                        elseif($atribut=="cmdp_air_minum"){
                            if($jmlCmdpAir==4){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'cmdp_air_minum',$max_gain,$nilai_cmdp_air_minum[0],$nilai_cmdp_air_minum[1],$nilai_cmdp_air_minum[2],$nilai_cmdp_air_minum[3],'');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlCmdpAir==3){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'cmdp_air_minum',$max_gain,$nilai_cmdp_air_minum[0],$nilai_cmdp_air_minum[1],$nilai_cmdp_air_minum[2],'','');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlCmdpAir==2){
                                    $this->proses_DT($kondisi,"($atribut='$nilai_cmdp_air_minum[0]')" , "($atribut='$nilai_cmdp_air_minum[1]')");
                            }//-------------------------------------------------------> 
                        }
                        elseif($atribut=="dy_listrik"){
                            if($jmlDyListrik==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'dy_listrik',$max_gain,$nilai_dy_listrik[0],$nilai_dy_listrik[1],$nilai_dy_listrik[2],$nilai_dy_listrik[3],$nilai_dy_listrik[4],$nilai_dy_listrik[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlDyListrik==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'dy_listrik',$max_gain,$nilai_dy_listrik[0],$nilai_dy_listrik[1],$nilai_dy_listrik[2],$nilai_dy_listrik[3],$nilai_dy_listrik[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlDyListrik==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'dy_listrik',$max_gain,$nilai_dy_listrik[0],$nilai_dy_listrik[1],$nilai_dy_listrik[2],$nilai_dy_listrik[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlDyListrik==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'dy_listrik',$max_gain,$nilai_dy_listrik[0],$nilai_dy_listrik[1],$nilai_dy_listrik[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlDyListrik==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_dy_listrik[0]')" , "($atribut='$nilai_dy_listrik[1]')");
                            }
                        }
                        elseif($atribut=="bb_masak"){
                            if($jmlBbm==9){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'bb_masak',$max_gain,$nilai_bb_masak[0],$nilai_bb_masak[1],$nilai_bb_masak[2],$nilai_bb_masak[3],$nilai_bb_masak[4],$nilai_bb_masak[5],$nilai_bb_masak[6],$nilai_bb_masak[7],$nilai_bb_masak[8]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");						
                            }
                            elseif($jmlBbm==8){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'bb_masak',$max_gain,$nilai_bb_masak[0],$nilai_bb_masak[1],$nilai_bb_masak[2],$nilai_bb_masak[3],$nilai_bb_masak[4],$nilai_bb_masak[5],$nilai_bb_masak[6],$nilai_bb_masak[7]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");						
                            }
                            elseif($jmlBbm==7){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'bb_masak',$max_gain,$nilai_bb_masak[0],$nilai_bb_masak[1],$nilai_bb_masak[2],$nilai_bb_masak[3],$nilai_bb_masak[4],$nilai_bb_masak[5],$nilai_bb_masak[6]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");						
                            }
                            elseif($jmlBbm==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'bb_masak',$max_gain,$nilai_bb_masak[0],$nilai_bb_masak[1],$nilai_bb_masak[2],$nilai_bb_masak[3],$nilai_bb_masak[4],$nilai_bb_masak[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlBbm==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'bb_masak',$max_gain,$nilai_bb_masak[0],$nilai_bb_masak[1],$nilai_bb_masak[2],$nilai_bb_masak[3],$nilai_bb_masak[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlBbm==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'bb_masak',$max_gain,$nilai_bb_masak[0],$nilai_bb_masak[1],$nilai_bb_masak[2],$nilai_bb_masak[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlBbm==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'bb_masak',$max_gain,$nilai_bb_masak[0],$nilai_bb_masak[1],$nilai_bb_masak[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlBbm==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_bb_masak[0]')" , "($atribut='$nilai_bb_masak[1]')");
                            }
                        }
                        elseif($atribut=="fasbab"){
                            if($jmlFasbab==4){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'fasbab',$max_gain,$nilai_fasbab[0],$nilai_fasbab[1],$nilai_fasbab[2],$nilai_fasbab[3],'');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlFasbab==3){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'fasbab',$max_gain,$nilai_fasbab[0],$nilai_fasbab[1],$nilai_fasbab[2],'','');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlFasbab==2){
                                    $this->proses_DT($kondisi,"($atribut='$nilai_fasbab[0]')" , "($atribut='$nilai_fasbab[1]')");
                            }//-------------------------------------------------------> 
                        }
                        elseif($atribut=="jns_kloset"){
                            if($jmlJnsKloset==4){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'jns_kloset',$max_gain,$nilai_jns_kloset[0],$nilai_jns_kloset[1],$nilai_jns_kloset[2],$nilai_jns_kloset[3],'');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlJnsKloset==3){
                                    //hitung rasio
                                    $cabang = array();
                                    $cabang = hitung_rasio($kondisi , 'jns_kloset',$max_gain,$nilai_jns_kloset[0],$nilai_jns_kloset[1],$nilai_jns_kloset[2],'','');
                                    $exp_cabang = explode(" , ",$cabang[1]);
                                    $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlJnsKloset==2){
                                    $this->proses_DT($kondisi,"($atribut='$nilai_jns_kloset[0]')" , "($atribut='$nilai_jns_kloset[1]')");
                            }//-------------------------------------------------------> 
                        }
                        elseif($atribut=="tp_akhir"){
                            if($jmlTpAkhir==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'tp_akhir',$max_gain,$nilai_tp_akhir[0],$nilai_tp_akhir[1],$nilai_tp_akhir[2],$nilai_tp_akhir[3],$nilai_tp_akhir[4],$nilai_tp_akhir[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlTpAkhir==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'tp_akhir',$max_gain,$nilai_tp_akhir[0],$nilai_tp_akhir[1],$nilai_tp_akhir[2],$nilai_tp_akhir[3],$nilai_tp_akhir[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlTpAkhir==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'tp_akhir',$max_gain,$nilai_tp_akhir[0],$nilai_tp_akhir[1],$nilai_tp_akhir[2],$nilai_tp_akhir[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlTpAkhir==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'tp_akhir',$max_gain,$nilai_tp_akhir[0],$nilai_tp_akhir[1],$nilai_tp_akhir[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlTpAkhir==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_tp_akhir[0]')" , "($atribut='$nilai_tp_akhir[1]')");
                            }
                        }
                        elseif($atribut=="sta_art_usaha"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_kks"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_kip"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_kis"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_bpjsm"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_jamsotek"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_asuransi_lain"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_rasta"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_kur"){					
                                $this->proses_DT($kondisi , "($atribut='YA')","($atribut='TIDAK')");										
			}
                        elseif($atribut=="sta_keberadaan_art"){
                            if($jmlSkbar==6){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'sta_keberadaan_art',$max_gain,$nilai_sta_keberadaan_art[0],$nilai_sta_keberadaan_art[1],$nilai_sta_keberadaan_art[2],$nilai_sta_keberadaan_art[3],$nilai_sta_keberadaan_art[4],$nilai_sta_keberadaan_art[5]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");						
                            }
                            elseif($jmlSkbar==5){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'sta_keberadaan_art',$max_gain,$nilai_sta_keberadaan_art[0],$nilai_sta_keberadaan_art[1],$nilai_sta_keberadaan_art[2],$nilai_sta_keberadaan_art[3],$nilai_sta_keberadaan_art[4]);
                                $exp_cabang = explode(" , ",$cabang[1]);						
                                $this->$this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");						
                            }
                            elseif($jmlSkbar==4){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'sta_keberadaan_art',$max_gain,$nilai_sta_keberadaan_art[0],$nilai_sta_keberadaan_art[1],$nilai_sta_keberadaan_art[2],$nilai_sta_keberadaan_art[3],'');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                            }
                            elseif($jmlSkbar==3){
                                $cabang = array();
                                $cabang = hitung_rasio($kondisi , 'sta_keberadaan_art',$max_gain,$nilai_sta_keberadaan_art[0],$nilai_sta_keberadaan_art[1],$nilai_sta_keberadaan_art[2],'','');
                                $exp_cabang = explode(" , ",$cabang[1]);
                                $this->proses_DT($kondisi,"($atribut='$cabang[0]')","($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                            }
                            elseif($jmlSkbar==2){
                                $this->proses_DT($kondisi,"($atribut='$nilai_sta_keberadaan_art[0]')" , "($atribut='$nilai_sta_keberadaan_art[1]')");
                            }
                        }
		    }
		}
        }
    function cek_nilaiAtribut($field , $kondisi){
        $hasil = array();
        if($kondisi==''){
                $sql = $this->CI->db->query("SELECT DISTINCT($field) FROM tbl_data_latih");					
        }else{
                $sql = $this->CI->db->query("SELECT DISTINCT($field) FROM tbl_data_latih WHERE $kondisi");					
        }
        $a=0;
        while($row = $sql->result_array()){
                $hasil[$a] = $row['0'];
                $a++;
        }	
        return $hasil;
    }	
	//fungsi cek heterogen data
    function cek_heterohomogen($field , $kondisi){
        //sql disticnt
        if($kondisi==''){
                $sql = $this->CI->db->query("SELECT DISTINCT($field) FROM tbl_data_latih");					
        }else{
                $sql = $this->CI->db->query("SELECT DISTINCT($field) FROM tbl_data_latih WHERE $kondisi");					
        }
        //jika jumlah data 1 maka homogen
        if ($sql->num_rows == 1) {                      
                $nilai = "homogen";
        }else{
                $nilai = "heterogen";
        }		
        return $nilai;
    }	
	//fungsi menghitung jumlah data
    function jumlah_data($kondisi){
            //sql
            if($kondisi==''){
                    $sql = $this->CI->db->query("SELECT COUNT(*) FROM tbl_data_latih $kondisi");	
            }else{
                    $sql = $this->CI->db->query("SELECT COUNT(*) FROM tbl_data_latih WHERE $kondisi");						
            }		
            $row = $sql->result_array();	
            $jml = $row['0'];
            return $jml;
    }
	//fungsi menghitung gain
function hitung_gain($kasus , $atribut , $ent_all , $kondisi1 , $kondisi2 , $kondisi3 , $kondisi4 , $kondisi5){
        $data_kasus = '';
        if($kasus!=''){
                $data_kasus = $kasus." AND ";
        }
        //untuk atribut 2 nilai atribut	
        if($kondisi3==''){
                $j_tinggi1 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi1");
                $j_rendah1 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi1");
                $jml1 = $j_tinggi1 + $j_rendah1;
                $j_tinggi2 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi2");
                $j_rendah2 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi2");
                $jml2 = $j_tinggi2 + $j_rendah2;
                //hitung entropy masing-masing kondisi
                $jml_total = $jml1 + $jml2;
                $ent1 = hitung_entropy($j_tinggi1 , $j_rendah1);
                $ent2 = hitung_entropy($j_tinggi2 , $j_rendah2);
                $gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2));
        }
        //untuk atribut 3 nilai atribut
        else if($kondisi4==''){
                $j_tinggi1 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi1");
                $j_rendah1 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi1");
                $jml1 = $j_tinggi1 + $j_rendah1;
                $j_tinggi2 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi2");
                $j_rendah2 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi2");
                $jml2 = $j_tinggi2 + $j_rendah2;
                $j_tinggi3 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi3");
                $j_rendah3 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi3");
                $jml3 = $j_tinggi3 + $j_rendah3;
                //hitung entropy masing-masing kondisi
                $jml_total = $jml1 + $jml2 + $jml3;
                $ent1 = hitung_entropy($j_tinggi1 , $j_rendah1);
                $ent2 = hitung_entropy($j_tinggi2 , $j_rendah2);
                $ent3 = hitung_entropy($j_tinggi3 , $j_rendah3);			
                $gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2) 
                                        + (($jml3/$jml_total)*$ent3));				
        }
        //untuk atribut 4 nilai atribut
        else if($kondisi5==''){
                $j_tinggi1 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi1");
                $j_rendah1 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi1");
                $jml1 = $j_tinggi1 + $j_rendah1;
                $j_tinggi2 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi2");
                $j_rendah2 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi2");
                $jml2 = $j_tinggi2 + $j_rendah2;
                $j_tinggi3 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi3");
                $j_rendah3 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi3");
                $jml3 = $j_tinggi3 + $j_rendah3;
                $j_tinggi4 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi4");
                $j_rendah4 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi4");
                $jml4 = $j_tinggi4 + $j_rendah4;
                //hitung entropy masing-masing kondisi
                $jml_total = $jml1 + $jml2 + $jml3+$jml4;
                $ent1 = hitung_entropy($j_tinggi1 , $j_rendah1);
                $ent2 = hitung_entropy($j_tinggi2 , $j_rendah2);
                $ent3 = hitung_entropy($j_tinggi3 , $j_rendah3);
                $ent4 = hitung_entropy($j_tinggi4 , $j_rendah4);
                $gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2)
                                        + (($jml3/$jml_total)*$ent3) + (($jml4/$jml_total)*$ent4));				
        }
        //untuk atribut 5 nilai atribut	
        else{
                $j_tinggi1 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi1");
                $j_rendah1 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi1");
                $jml1 = $j_tinggi1 + $j_rendah1;
                $j_tinggi2 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi2");
                $j_rendah2 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi2");
                $jml2 = $j_tinggi2 + $j_rendah2;
                $j_tinggi3 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi3");
                $j_rendah3 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi3");
                $jml3 = $j_tinggi3 + $j_rendah3;
                $j_tinggi4 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi4");
                $j_rendah4 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi4");
                $jml4 = $j_tinggi4 + $j_rendah4;
                $j_tinggi5 = jumlah_data("$data_kasus ipk='tinggi' AND $kondisi5");
                $j_rendah5 = jumlah_data("$data_kasus ipk='rendah' AND $kondisi5");
                $jml5 = $j_tinggi5 + $j_rendah5;
                //hitung entropy masing-masing kondisi
                $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5;
                $ent1 = hitung_entropy($j_tinggi1 , $j_rendah1);
                $ent2 = hitung_entropy($j_tinggi2 , $j_rendah2);
                $ent3 = hitung_entropy($j_tinggi3 , $j_rendah3);
                $ent4 = hitung_entropy($j_tinggi4 , $j_rendah4);
                $ent5 = hitung_entropy($j_tinggi5 , $j_rendah5);
                $gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2) 
                                        + (($jml3/$jml_total)*$ent3) + (($jml4/$jml_total)*$ent4) + (($jml5/$jml_total)*$ent5));			
        }
        //desimal 3 angka dibelakang koma
        $gain = round($gain,3);	
        if($gain>0){
                echo "Gain ".$atribut." = ".$gain."<br>";
        }		
        mysql_query("INSERT INTO gain VALUES ('','$atribut','$gain')");
}
//fungsi menghitung entropy
    function hitung_entropy($nilai1 , $nilai2){
        $total = $nilai1 + $nilai2;
        //jika salah satu nilai 0, maka entropy 0
        if($nilai1==0 or $nilai2==0){
                $entropy = 0;
        }else{
                $entropy = (-($nilai1/$total)*(log(($nilai1/$total),2))) + (-($nilai2/$total)*(log(($nilai2/$total),2)));
        }		
        //desimal 3 angka dibelakang koma
        $entropy = round($entropy, 3);	
        return $entropy;
}
//fungsi hitung rasio
    function hitung_rasio($kasus , $atribut , $gain , $nilai1 , $nilai2 , $nilai3 , $nilai4 , $nilai5){				
        $data_kasus = '';
        if($kasus!=''){
                $data_kasus = $kasus." AND ";
        }
        //menentukan jumlah nilai
                $jmlNilai=5;
                //jika nilai 5 kosong maka nilai atribut-nya 4
                if($nilai5==''){
                        $jmlNilai=4;
                }
                //jika nilai 4 kosong maka nilai atribut-nya 3
                if($nilai4==''){
                        $jmlNilai=3;				
                }						
        mysql_query("TRUNCATE rasio_gain");		
        if($jmlNilai==3){
                $opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
                $opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
                $tot_opsi1=$opsi11+$opsi12;
                $opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
                $opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
                $tot_opsi2=$opsi21+$opsi22;
                $opsi31 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
                $opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
                $tot_opsi3=$opsi31+$opsi32;			
                //hitung split info
                $opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
                $opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
                $opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
                //desimal 3 angka dibelakang koma
                $opsi1 = round($opsi1,3);
                $opsi2 = round($opsi2,3);
                $opsi3 = round($opsi3,3);										
                //hitung rasio
                $rasio1 = $gain/$opsi1;
                $rasio2 = $gain/$opsi2;
                $rasio3 = $gain/$opsi3;
                //desimal 3 angka dibelakang koma
                $rasio1 = round($rasio1,3);
                $rasio2 = round($rasio2,3);
                $rasio3 = round($rasio3,3);
                //cetak
                echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3." = ".$opsi11.
                        "<br>jumlah ".$nilai1." = ".$opsi12.
                        "<br>Split = ".$opsi1.
                        "<br>Rasio = ".$rasio1."<br>";
                echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai1." = ".$opsi21.
                        "<br>jumlah ".$nilai2." = ".$opsi22.
                        "<br>Split = ".$opsi2.
                        "<br>Rasio = ".$rasio2."<br>";
                echo "Opsi 3 : <br>jumlah ".$nilai1."/".$nilai2." = ".$opsi31.
                        "<br>jumlah ".$nilai3." = ".$opsi32.
                        "<br>Split = ".$opsi3.
                        "<br>Rasio = ".$rasio3."<br>";

                //insert 
                mysql_query("INSERT INTO rasio_gain VALUES 
                                        ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasio1'),
                                        ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasio2'),
                                        ('' , 'opsi3' , '$nilai3' , '$nilai1 , $nilai2' , '$rasio3')");
        }
        else if($jmlNilai==4){
                $opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
                $opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
                $tot_opsi1=$opsi11+$opsi12;
                $opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai1')");
                $opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
                $tot_opsi2=$opsi21+$opsi22;
                $opsi31 = jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai1' OR $atribut='$nilai2')");
                $opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
                $tot_opsi3=$opsi31+$opsi32;
                $opsi41 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
                $opsi42 = jumlah_data("$data_kasus $atribut='$nilai4'");
                $tot_opsi4=$opsi41+$opsi42;

                //hitung split info
                $opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
                $opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
                $opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
                $opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));			
                //desimal 3 angka dibelakang koma
                $opsi1 = round($opsi1,3);
                $opsi2 = round($opsi2,3);
                $opsi3 = round($opsi3,3);
                $opsi4 = round($opsi4,3);

                //hitung rasio
                $rasio1 = $gain/$opsi1;
                $rasio2 = $gain/$opsi2;
                $rasio3 = $gain/$opsi3;
                $rasio4 = $gain/$opsi4;
                //desimal 3 angka dibelakang koma
                $rasio1 = round($rasio1,3);
                $rasio2 = round($rasio2,3);
                $rasio3 = round($rasio3,3);
                $rasio4 = round($rasio4,3);
                //cetak					
                echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi11.
                        "<br>jumlah ".$nilai1." = ".$opsi12.
                        "<br>Split = ".$opsi1.
                        "<br>Rasio = ".$rasio1."<br>";
                echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai1." = ".$opsi21.
                        "<br>jumlah ".$nilai2." = ".$opsi22.
                        "<br>Split = ".$opsi2.
                        "<br>Rasio = ".$rasio2."<br>";
                echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai1."/".$nilai2." = ".$opsi31.
                        "<br>jumlah ".$nilai3." = ".$opsi32.
                        "<br>Split = ".$opsi3.
                        "<br>Rasio = ".$rasio3."<br>";
                echo "Opsi 4 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
                        "<br>jumlah ".$nilai4." = ".$opsi42.
                        "<br>Split = ".$opsi4.
                        "<br>Rasio = ".$rasio4."<br>";			

                //insert 
                mysql_query("INSERT INTO rasio_gain VALUES 
                                        ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4' , '$rasio1'),
                                        ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai1' , '$rasio2'),
                                        ('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai1 , $nilai2' , '$rasio3'),
                                        ('' , 'opsi4' , '$nilai4' , '$nilai1 , $nilai2 , $nilai3' , '$rasio4')");
        }else if($jmlNilai==5){
                $opsi11 = jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
                $opsi12 = jumlah_data("$data_kasus $atribut='$nilai1'");
                $tot_opsi1=$opsi11+$opsi12;
                $opsi21 = jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai1')");
                $opsi22 = jumlah_data("$data_kasus $atribut='$nilai2'");
                $tot_opsi2=$opsi21+$opsi22;
                $opsi31 = jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai1' OR $atribut='$nilai2')");
                $opsi32 = jumlah_data("$data_kasus $atribut='$nilai3'");
                $tot_opsi3=$opsi31+$opsi32;
                $opsi41 = jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
                $opsi42 = jumlah_data("$data_kasus $atribut='$nilai4'");
                $tot_opsi4=$opsi41+$opsi42;
                $opsi51 = jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
                $opsi52 = jumlah_data("$data_kasus $atribut='$nilai5'");
                $tot_opsi5=$opsi51+$opsi52;

                //hitung split info
                $opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
                $opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
                $opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
                $opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
                $opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
                //desimal 3 angka dibelakang koma
                $opsi1 = round($opsi1,3);
                $opsi2 = round($opsi2,3);
                $opsi3 = round($opsi3,3);
                $opsi4 = round($opsi4,3);
                $opsi5 = round($opsi5,3);

                //hitung rasio
                $rasio1 = $gain/$opsi1;
                $rasio2 = $gain/$opsi2;
                $rasio3 = $gain/$opsi3;
                $rasio4 = $gain/$opsi4;
                $rasio5 = $gain/$opsi5;
                //desimal 3 angka dibelakang koma
                $rasio1 = round($rasio1,3);
                $rasio2 = round($rasio2,3);
                $rasio3 = round($rasio3,3);
                $rasio4 = round($rasio4,3);
                $rasio5 = round($rasio5,3);
                //cetak
                echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi11.
                        "<br>jumlah ".$nilai1." = ".$opsi12.
                        "<br>Split = ".$opsi1.
                        "<br>Rasio = ".$rasio1."<br>";
                echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai1." = ".$opsi21.
                        "<br>jumlah ".$nilai2." = ".$opsi22.
                        "<br>Split = ".$opsi2.
                        "<br>Rasio = ".$rasio2."<br>";
                echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai1."/".$nilai2." = ".$opsi31.
                        "<br>jumlah ".$nilai3." = ".$opsi32.
                        "<br>Split = ".$opsi3.
                        "<br>Rasio = ".$rasio3."<br>";
                echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
                        "<br>jumlah ".$nilai4." = ".$opsi42.
                        "<br>Split = ".$opsi4.
                        "<br>Rasio = ".$rasio4."<br>";
                echo "Opsi 5 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
                        "<br>jumlah ".$nilai5." = ".$opsi52.
                        "<br>Split = ".$opsi5.
                        "<br>Rasio = ".$rasio5."<br>";	

                //insert 
                mysql_query("INSERT INTO rasio_gain VALUES 
                                        ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , '$rasio1'),
                                        ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai1' , '$rasio2'),
                                        ('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai1 , $nilai2' , '$rasio3'),
                                        ('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai1 , $nilai2 , $nilai3' , '$rasio4'),
                                        ('' , 'opsi5' , '$nilai5' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , '$rasio5')");
        }
        $sql_max = mysql_query("SELECT MAX(rasio_gain) FROM rasio_gain");
        $row_max = mysql_fetch_array($sql_max);	
        $max_rasio = $row_max['0'];
        $sql = mysql_query("SELECT * FROM rasio_gain WHERE rasio_gain=$max_rasio");
        $row = mysql_fetch_array($sql);	
        $opsiMax = array();
        $opsiMax[0] = $row[2];
        $opsiMax[1] = $row[3];		
        echo "<br>=========================<br>";
        return $opsiMax;		
	}
}
