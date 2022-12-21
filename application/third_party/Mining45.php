<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mining45
 *
 * @author Ady
 */
class Mining45 extends CI_Controller {

    function format_decimal($value) {
        return round($value, 3);
    }

//fungsi utama
    function proses_DT($parent, $kasus_cabang1, $kasus_cabang2) {
        echo "cabang 1<br>";
        $this->pembentukan_tree($parent, $kasus_cabang1);
        echo "cabang 2<br>";
        $this->pembentukan_tree($parent, $kasus_cabang2);
    }

//fungsi proses dalam suatu kasus data
    function pembentukan_tree($n_parent, $kasus) {
        $n_parent = "";
        $kondisi_keputusan_asli ="";
        $cek = $this->cek_heterohomogen('keputusan_asli', $kondisi);
        $get_atribut = $this->db->get('tbl_atribut')->result();
        if (!empty($n_parent) AND empty($kasus)) {
            $kondisi = $n_parent . " AND " . $kasus;   
        } else {
            $kondisi = $kasus;
        }
        echo $kondisi . "<br>";
        if ($cek == 'homogen') {
            echo "<br>LEAF ||";
            $sql_keputusan = $this->db->select('*')->distinct('keputusan_asli')->where($kondisi)->get('tbl_data_latih');
            $row_keputusan = $sql_keputusan->result_array();
            $keputusan = $row_keputusan[0];
            //insert atau lakukan pemangkasan cabang
            $this->pangkas($n_parent, $kasus, $keputusan);
        }//jika data masih heterogen
        else if ($cek == 'heterogen') {
            if ($kondisi != '') {
                $kondisi_keputusan_asli = $kondisi . " AND ";
            }
            $a = "YA";
            $b = "TIDAK";
            $sqla = $this->db->where('keputusan_asli',$a)->get('tbl_data_latih')->num_rows();
            $sqlb = $this->db->where('keputusan_asli',$b)->get('tbl_data_latih')->num_rows();
            $jml_ya = $sqla;
            $jml_tidak = $sqlb;
            $jml_total = $sqla + $sqlb;
            echo "Jumlah Data = " . $jml_total . "<br>";
            echo "Jumlah YA = " . $sqla . "<br>";
            echo "Jumlah TIDAK = " . $sqlb . "<br>";
            
            $entropy_all = $this->hitung_entropy($jml_ya, $jml_tidak);
            echo "Entropy All = " . $entropy_all . "<br>";

                $nilai_jml_art = array();
                $nilai_jml_art1 = $this->cek_nilaiAtribut('jml_art', $kondisi);
                $jmlArt = count($nilai_jml_art1);
                //------------------------------------------------------------------1
                $nilai_jml_keluarga = array();
                $nilai_jml_keluarga1 = $this->cek_nilaiAtribut('jml_keluarga', $kondisi);
                $jmlKeluarga = count($nilai_jml_keluarga1);
                //------------------------------------------------------------------2
                $nilai_sta_bangunan = array();
                $nilai_sta_bangunan1 = $this->cek_nilaiAtribut('sta_bangunan', $kondisi);
                $jmlStaBangunan = count($nilai_sta_bangunan1);
                //------------------------------------------------------------------3
                $nilai_sta_lahan = array();
                $nilai_sta_lahan1 = $this->cek_nilaiAtribut('sta_lahan', $kondisi);
                $jmlStaLahan = count($nilai_sta_lahan1);
                //------------------------------------------------------------------4
                $nilai_jns_lantai = array();
                $nilai_jns_lantai1 = $this->cek_nilaiAtribut('jns_lantai', $kondisi);
                $jmlJnsLantai = count($nilai_jns_lantai1);
                //------------------------------------------------------------------5
                $nilai_jns_dinding = array();
                $nilai_jns_dinding1 = $this->cek_nilaiAtribut('jns_dinding', $kondisi);
                $jmlJnsDinding = count($nilai_jns_dinding1);
                //------------------------------------------------------------------6
                $nilai_knds_dinding = array();
                $nilai_knds_dinding1 = $this->cek_nilaiAtribut('knds_dinding', $kondisi);
                $jmlKndsDinding = count($nilai_knds_dinding1);
                //------------------------------------------------------------------7
                $nilai_jns_atap = array();
                $nilai_jns_atap1 = $this->cek_nilaiAtribut('jns_atap', $kondisi);
                $jmlJnsAtap = count($nilai_jns_atap1);
                //------------------------------------------------------------------8
                $nilai_knds_atap = array();
                $nilai_knds_atap1 = $this->cek_nilaiAtribut('knds_atap', $kondisi);
                $jmlKndsAtap = count($nilai_knds_atap1);
                //------------------------------------------------------------------9
                $nilai_smb_air_minum = array();
                $nilai_smb_air_minum1 = $this->cek_nilaiAtribut('smb_air_minum', $kondisi);
                $jmlSmbAir = count($nilai_smb_air_minum1);
                //------------------------------------------------------------------10
                $nilai_cmdp_air_minum = array();
                $nilai_cmdp_air_minum1 = $this->cek_nilaiAtribut('cmdp_air_minum', $kondisi);
                $jmlCmdpAir = count($nilai_cmdp_air_minum1);
                //------------------------------------------------------------------11
                $nilai_smb_penerangan = array();
                $nilai_smb_penerangan1 = $this->cek_nilaiAtribut('smb_penerangan', $kondisi);
                $jmlPenerangan = count($nilai_smb_penerangan1);
                //------------------------------------------------------------------12
                $nilai_dy_listrik = array();
                $nilai_dy_listrik1 = $this->cek_nilaiAtribut('dy_listrik', $kondisi);
                $jmlDyListrik = count($nilai_dy_listrik1);
                //------------------------------------------------------------------13
                $nilai_bb_masak = array();
                $nilai_bb_masak1 = $this->cek_nilaiAtribut('bb_masak', $kondisi);
                $jmlBbm = count($nilai_bb_masak1);
                //------------------------------------------------------------------14
                $nilai_fasbab = array();
                $nilai_fasbab1 = $this->cek_nilaiAtribut('fasbab', $kondisi);
                $jmlFasbab = count($nilai_fasbab1);
                //------------------------------------------------------------------15
                $nilai_jns_kloset = array();
                $nilai_jns_kloset1 = $this->cek_nilaiAtribut('jns_kloset', $kondisi);
                $jmlJnsKloset = count($nilai_jns_kloset1);
                //------------------------------------------------------------------16
                $nilai_tp_akhir = array();
                $nilai_tp_akhir1 = $this->cek_nilaiAtribut('tp_akhir', $kondisi);
                $jmlTpAkhir = count($nilai_tp_akhir1);
                //------------------------------------------------------------------17
                $nilai_sta_art_usaha = array();
                $nilai_sta_art_usaha1 = $this->cek_nilaiAtribut('sta_art_usaha', $kondisi);
                $jmlStSartu = count($nilai_sta_art_usaha1);
                //------------------------------------------------------------------18
                $nilai_sta_kks = array();
                $nilai_sta_kks1 = $this->cek_nilaiAtribut('sta_kks', $kondisi);
                $jmlStaKks = count($nilai_sta_kks1);
                //------------------------------------------------------------------19
                $nilai_sta_kip = array();
                $nilai_sta_kip1 = $this->cek_nilaiAtribut('sta_kip', $kondisi);
                $jmlStaKip = count($nilai_sta_kip1);
                //------------------------------------------------------------------20
                $nilai_sta_kis = array();
                $nilai_sta_kis1 = $this->cek_nilaiAtribut('sta_kis', $kondisi);
                $jmlStaKis = count($nilai_sta_kis1);
                //------------------------------------------------------------------21
                $nilai_sta_bpjsm = array();
                $nilai_sta_bpjsm1 = $this->cek_nilaiAtribut('sta_bpjsm', $kondisi);
                $jmlStaBpjsm = count($nilai_sta_bpjsm1);
                //------------------------------------------------------------------22
                $nilai_sta_jamsotek = array();
                $nilai_sta_jamsotek1 = $this->cek_nilaiAtribut('sta_jamsotek', $kondisi);
                $jmlJamsostek = count($nilai_sta_jamsotek1);
                //------------------------------------------------------------------23
                $nilai_sta_asuransi_lain = array();
                $nilai_sta_asuransi_lain1 = $this->cek_nilaiAtribut('sta_asuransi_lain', $kondisi);
                $jmlAsuransi = count($nilai_sta_asuransi_lain1);
                //------------------------------------------------------------------24
                $nilai_sta_rasta = array();
                $nilai_sta_rasta1 = $this->cek_nilaiAtribut('sta_rasta', $kondisi);
                $jmlRasta = count($nilai_sta_rasta1);
                //------------------------------------------------------------------25
                $nilai_sta_kur = array();
                $nilai_sta_kur1 = $this->cek_nilaiAtribut('sta_kur', $kondisi);
                $jmlSkur = count($nilai_sta_kur1);
                //------------------------------------------------------------------26
                $nilai_sta_keberadaan_art = array();
                $nilai_sta_keberadaan_art1 = $this->cek_nilaiAtribut('sta_keberadaan_art', $kondisi);
                $jmlSkbar = count($nilai_sta_keberadaan_art1);
                //------------------------------------------------------------------27
                $this->db->query("TRUNCATE tbl_gain");
//
//            echo "<table class='table table-bordered table-striped  table-hover'>";
//            echo "<tr><th>Nilai Atribut</th> <th>Jumlah data</th> <th>Jumlah Sanguin</th> <th>Jumlah Koleris</th> "
//            . "<th>Jumlah Melankolis</th> <th>Jumlah Plegmatis</th> <th>Entropy</th> <th>Gain</th><tr>";
            //hitung gain atribut KATEGORIKAL
                    //------------------------------------------- PROSES PERHITUNGAN GAIN
        //------------------------------------------- Jumlah ART
                    if($jmlArt!=1){
                        $NA1Jart="jml_art='$nilai_jml_art[0]'";
                        $NA2Jart="";
                        $NA3Jart="";
                        if($jmlArt==2){
                             $NA2Jart="jml_art='$nilai_jml_art[1]'";
                        }elseif ($jmlArt==3){
                             $NA2Jart="jml_art='$nilai_jml_art[1]'";
                             $NA3Jart="jml_art='$nilai_jml_art[2]'";
                        }				
                        $this->hitung_gain($kondisi ,"jml_art", $entropy_all , $NA1Jart, $NA2Jart, $NA3Jart, "" , "", "", "", "", "", "", "", "");
                     }
                     //--------------------------------------- Jumlah Keluarga
                        $this->hitung_gain($kondisi, "jml_keluarga", $entropy_all, "jml_keluarga='KCL'", "jml_keluarga='BSR'", "", "", "", "", "", "", "", "", "", "");
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
                        $this->hitung_gain($kondisi , "sta_bangunan" , $entropy_all , $NA1Stbn , $NA2Stbn , $NA3Stbn , $NA4Stbn , $NA5Stbn, "", "", "", "", "", "", "");
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
                        $this->hitung_gain($kondisi , "sta_lahan" , $entropy_all , $NA1Stlhn , $NA2Stlhn , $NA3Stlhn , $NA4Stlhn ,"", "", "", "", "", "", "", "");
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
                        $this->hitung_gain($kondisi , "jns_lantai" , $entropy_all , $NA1Jslti , $NA2Jslti , $NA3Jslti, $NA4Jslti ,$NA5Jslti, $NA6Jslti , $NA7Jslti , $NA8Jslti, $NA9Jslti ,$NA10Jslti,"","");
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
                            $this->hitung_gain($kondisi , "jns_dinding" , $entropy_all , $NA1Jsddg , $NA2Jsddg , $NA3Jsddg, $NA4Jsddg ,$NA5Jsddg, $NA6Jsddg , $NA7Jsddg, "", "", "", "", "", "", "");
                        }
                        //-----------------------------------------------> Kondisi Dinding
                        $this->hitung_gain($kondisi, "knds_dinding", $entropy_all, "knds_dinding='BKT'", "knds_dinding='JKR'", "", "", "", "", "", "", "", "", "", "");
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
                            $this->hitung_gain($kondisi , "jns_atap" , $entropy_all , $NA1Jsatp , $NA2Jsatp , $NA3Jsatp, $NA4Jsatp ,$NA5Jsatp, $NA6Jsatp , $NA7Jsatp , $NA8Jsatp, $NA9Jsatp ,$NA10Jsatp,"","");
                        }
                      //------------------------------------------------------------> Kondisi Atap 
                        $this->hitung_gain($kondisi, "knds_atap", $entropy_all, "knds_atap='BKT'", "knds_atap='JKR'", "", "", "", "", "", "", "", "", "", "");
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
                            $this->hitung_gain($kondisi , "smb_air_minum" , $entropy_all , $NA1Smbr , $NA2Smbr , $NA3Smbr, $NA4Smbr ,$NA5Smbr, $NA6Smbr , $NA7Smbr , $NA8Smbr, $NA9Smbr ,$NA10Smbr, $NA11Smbr, $NA12Smbr);
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
                            $this->hitung_gain($kondisi , "cmdp_air_minum" , $entropy_all , $NA1Cmda , $NA2Cmda , $NA3Cmda , $NA4Cmda ,"", "", "", "", "", "", "", "");
                        }
                      if($jmlPenerangan!=1){
                        $NA1Spn="smb_penerangan='$nilai_smb_penerangan[0]'";
                        $NA2Spn="";
                        $NA3Spn="";
                        if($jmlPenerangan==2){
                             $NA2Spn="smb_penerangan='$nilai_smb_penerangan[1]'";
                        }elseif ($jmlPenerangan==3){
                             $NA2Spn="smb_penerangan='$nilai_smb_penerangan[1]'";
                             $NA3Spn="smb_penerangan='$nilai_smb_penerangan[2]'";
                        }				
                        $this->hitung_gain($kondisi ,"smb_penerangan", $entropy_all , $NA1Spn, $NA2Spn, $NA3Spn, "" , "", "", "", "", "", "", "", "");
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
                            $this->hitung_gain($kondisi , "dy_listrik" , $entropy_all , $NA1Dy , $NA2Dy , $NA3Dy, $NA4Dy ,$NA5Dy, $NA6Dy, "", "", "", "", "", "");
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
                            $this->hitung_gain($kondisi , "bb_masak" , $entropy_all , $NA1Bbm , $NA2Bbm , $NA3Bbm, $NA4Bbm ,$NA5Bbm, $NA6Bbm , $NA7Bbm , $NA8Bbm, $NA9Bbm,"","","");
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
                            $this->hitung_gain($kondisi , "fasbab" , $entropy_all , $NA1Fbb , $NA2Fbb , $NA3Fbb , $NA4Fbb ,"", "", "", "", "", "", "", "");
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
                            $this->hitung_gain($kondisi , "jns_kloset" , $entropy_all , $NA1Jkls , $NA2Jkls , $NA3Jkls , $NA4Jkls ,"", "", "", "", "", "", "", "");
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
                            $this->hitung_gain($kondisi , "tp_akhir" , $entropy_all , $NA1Tpa , $NA2Tpa , $NA3Tpa, $NA4Tpa ,$NA5Tpa, $NA6Tpa, "", "", "", "", "", "", "","");
                        }
                     //----------------------------------------------> SARTU
                        $this->hitung_gain($kondisi, "sta_art_usaha", $entropy_all, "sta_art_usaha='YA'", "sta_art_usaha='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //-----------------------------------------------> SKKS
                        $this->hitung_gain($kondisi, "sta_kks", $entropy_all, "sta_kks='YA'", "sta_kks='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //------------------------------------------------> SKIP
                        $this->hitung_gain($kondisi, "sta_kip", $entropy_all, "sta_kip='YA'", "sta_kip='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //------------------------------------------------> SKIS
                        $this->hitung_gain($kondisi, "sta_kis", $entropy_all, "sta_kis='YA'", "sta_kis='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //-----------------------------------------------> BPJSM 
                        $this->hitung_gain($kondisi, "sta_bpjsm", $entropy_all, "sta_bpjsm='YA'", "sta_bpjsm='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //----------------------------------------------> Jamsostek
                        $this->hitung_gain($kondisi, "sta_jamsotek", $entropy_all, "sta_jamsotek='YA'", "sta_jamsotek='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //-----------------------------------------------> Asuransi 
                        $this->hitung_gain($kondisi, "sta_asuransi_lain", $entropy_all, "sta_asuransi_lain='YA'", "sta_asuransi_lain='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //--------------------------------------------------> RASTA 
                        $this->hitung_gain($kondisi, "sta_rasta", $entropy_all, "sta_rasta='YA'", "sta_rasta='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                     //---------------------------------------------------> SKUR 
                        $this->hitung_gain($kondisi, "sta_kur", $entropy_all, "sta_kur='YA'", "sta_kur='TIDAK'", "", "", "", "", "", "", "", "", "", "");
                       if($jmlSkbar!=1){//---------------------------------------------------------> Sta Keberadaan ART
                        $NA1Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[0]'";
                        $NA2Keberadaan="";
                        $NA3Keberadaan="";
                        $NA4Keberadaan="";
                        $NA5Keberadaan="";
                        $NA6Keberadaan="";
                            if($jmlSkbar==2){
                                    $NA2Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                            }elseif($jmlSkbar==3){
                                    $NA2Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                            }elseif($jmlSkbar==4){
                                    $NA2Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                                    $NA4Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[3]'";
                            }elseif($jmlSkbar==5){
                                    $NA2Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                                    $NA4Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[3]'";
                                    $NA5Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[4]'";
                            }elseif($jmlSkbar==6){
                                    $NA2Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[1]'";
                                    $NA3Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[2]'";
                                    $NA4Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[3]'";
                                    $NA5Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[4]'";
                                    $NA6Keberadaan="sta_keberadaan_art='$nilai_sta_keberadaan_art[5]'";
                            }
                            $this->hitung_gain($kondisi , "sta_keberadaan_art" , $entropy_all , $NA1Keberadaan , $NA2Keberadaan , $NA3Keberadaan, $NA4Keberadaan ,$NA5Keberadaan, $NA6Keberadaan, "", "", "", "", "", "");
                        }
                    echo "</table>";
//                    $sql_max = $this->db->query("SELECT MAX(gain) FROM tbl_gain");
//                    $row_max = $sql_max->result_array();
//                    $max_gain = $row_max['0'];
//                    $sql = $this->db->query("SELECT * FROM tbl_gain WHERE gain=$max_gain");
//                    $row = $sql->result_array();
//                    $atribut = $row['0'];
                    //max($nilai_sta_keberadaan_art)
                    echo "Atribut terpilih = " . $atribut . ", dengan nilai gain = " . $max_gain . "<br>";
                    echo "<br>================================<br>";
                    //ambil nilai gain terBesar
                    $sql_max = $this->db->query("SELECT MAX(gain) FROM tbl_gain");
                    $row_max = $sql_max->result_array();
                    $max_gain = $row_max[0];
                    $sql = $this->db->select_max('gain')->get('tbl_gain')->result();
                    foreach ($sql as $value) {
                    echo "Atribut terpilih = " .$max_gain . ", dengan Nilai Gain = " .$value->gain. "<br>";
                    echo "<br>================================<br>";
                    }
//                    echo "Atribut terpilih = " . $sql. ", dengan nilai gain = " . $max_gain . "<br>";
//                    echo "<br>================================<br>";

            //jika max gain = 0 perhitungan dihentikan dan mengambil keputusan
            if ($max_gain == 0) {
                echo "<br>LEAF ";
                $ambil_atribut = $get_atribut;
                foreach ($ambil_atribut as $atribut)
                //insert atau lakukan pemangkasan cabang
                   $this->pangkas($n_parent, $kasus, $keputusan);
            }
            //jika max_gain >0 lanjut..
            else {
                switch ($atribut) { 
                    case($atribut == "jml_art"):
                        if ($jmlArt == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jml_art', $max_gain, $nilai_jml_art[0], $nilai_jml_art[1], $nilai_jml_art[2], '', '','','','','','','','');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlInstansi == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_jml_art[0]')", "($atribut='$nilai_jml_art[1]')");
                        } //-----------------------------> Jumlah ART var.atrb = 3
                    break;
                
                    case($atribut == "jml_keluarga"):
                        $this->proses_DT($kondisi, "($atribut='KCL')", "($atribut='BSR')");
                    break;//----------------------------------> Jumlah Keluarga var.atrb = 2
            
                    case ($atribut == "sta_bangunan") :
                        if ($jmlStaBangunan == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'sta_bangunan', $max_gain, $nilai_sta_bangunan[0], $nilai_sta_bangunan[1], $nilai_sta_bangunan[2], $nilai_sta_bangunan[3], $nilai_sta_bangunan[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlStaBangunan == 4) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'sta_bangunan', $max_gain, $nilai_sta_bangunan[0], $nilai_sta_bangunan[1], $nilai_sta_bangunan[2], $nilai_sta_bangunan[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlStaBangunan == 3) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'sta_bangunan', $max_gain, $nilai_sta_bangunan[0], $nilai_sta_bangunan[1], $nilai_sta_bangunan[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlStaBangunan == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_sta_bangunan[0]')", "($atribut='$nilai_sta_bangunan[1]')");
                        }//-----------------------------------------------------------> Status Bangunan
                    break;
                    
                    case ($atribut == "sta_lahan") :
                        if ($jmlStaLahan == 4) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'sta_lahan', $max_gain, $nilai_sta_lahan[0], $nilai_sta_lahan[1], $nilai_sta_lahan[2], $nilai_sta_lahan[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlStaLahan == 3) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'sta_lahan', $max_gain, $nilai_sta_lahan[0], $nilai_sta_lahan[1], $nilai_sta_lahan[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlStaLahan == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_sta_lahan[0]')", "($atribut='$nilai_sta_lahan[1]')");
                        }//-------------------------------------------------------> Status Lahan
                    break;
                    case($atribut == "jns_lantai") :
                        if ($jmlJnsLantai == 10) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], $nilai_jns_lantai[3], $nilai_jns_lantai[4], $nilai_jns_lantai[5], $nilai_jns_lantai[6], $nilai_jns_lantai[7], $nilai_jns_lantai[8], $nilai_jns_lantai[9]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]')");
                        } elseif ($jmlJnsLantai == 9) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], $nilai_jns_lantai[3], $nilai_jns_lantai[4], $nilai_jns_lantai[5], $nilai_jns_lantai[6], $nilai_jns_lantai[7], $nilai_jns_lantai[8]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");
                        } elseif ($jmlJnsLantai == 8) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], $nilai_jns_lantai[3], $nilai_jns_lantai[4], $nilai_jns_lantai[5], $nilai_jns_lantai[6], $nilai_jns_lantai[7]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");
                        } elseif ($jmlJnsLantai == 7) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], $nilai_jns_lantai[3], $nilai_jns_lantai[4], $nilai_jns_lantai[5], $nilai_jns_lantai[6]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");
                        } elseif ($jmlJnsLantai == 6) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], $nilai_jns_lantai[3], $nilai_jns_lantai[4], $nilai_jns_lantai[5]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                        } elseif ($jmlJnsLantai == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], $nilai_jns_lantai[3], $nilai_jns_lantai[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlJnsLantai == 4) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], $nilai_jns_lantai[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlJnsLantai == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_lantai', $max_gain, $nilai_jns_lantai[0], $nilai_jns_lantai[1], $nilai_jns_lantai[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlJnsLantai == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_jns_lantai[0]')", "($atribut='$nilai_jns_lantai[1]')");
                        }
                break;
                case($atribut == "jns_dinding") :
                        if ($jmlJnsDinding == 7) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_dinding', $max_gain, $nilai_jns_dinding[0], $nilai_jns_dinding[1], $nilai_jns_dinding[2], $nilai_jns_dinding[3], $nilai_jns_dinding[4], $nilai_jns_dinding[5], $nilai_jns_dinding[6]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");
                        } elseif ($jmlJnsDinding == 6) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_dinding', $max_gain, $nilai_jns_dinding[0], $nilai_jns_dinding[1], $nilai_jns_dinding[2], $nilai_jns_dinding[3], $nilai_jns_dinding[4], $nilai_jns_dinding[5]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                        } elseif ($jmlJnsDinding == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_dinding', $max_gain, $nilai_jns_dinding[0], $nilai_jns_dinding[1], $nilai_jns_dinding[2], $nilai_jns_dinding[3], $nilai_jns_dinding[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlJnsDinding == 4) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_dinding', $max_gain, $nilai_jns_dinding[0], $nilai_jns_dinding[1], $nilai_jns_dinding[2], $nilai_jns_dinding[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlJnsDinding == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_dinding', $max_gain, $nilai_jns_dinding[0], $nilai_jns_dinding[1], $nilai_jns_dinding[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlJnsDinding == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_jns_dinding[0]')", "($atribut='$nilai_jns_dinding[1]')");
                        }
                break;
                    
                case ($atribut == "knds_dinding") :
                        $this->proses_DT($kondisi, "($atribut='BKT')", "($atribut='JKR')");
                break;
                
                case ($atribut == "jns_atap") :
                        if ($jmlJnsAtap == 10) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], $nilai_jns_atap[3], $nilai_jns_atap[4], $nilai_jns_atap[5], $nilai_jns_atap[6], $nilai_jns_atap[7], $nilai_jns_atap[8], $nilai_jns_atap[9]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]')");
                        } elseif ($jmlJnsAtap == 9) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], $nilai_jns_atap[3], $nilai_jns_atap[4], $nilai_jns_atap[5], $nilai_jns_atap[6], $nilai_jns_atap[7], $nilai_jns_atap[8]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");
                        } elseif ($jmlJnsAtap == 8) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], $nilai_jns_atap[3], $nilai_jns_atap[4], $nilai_jns_atap[5], $nilai_jns_atap[6], $nilai_jns_atap[7]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");
                        } elseif ($jmlJnsAtap == 7) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], $nilai_jns_atap[3], $nilai_jns_atap[4], $nilai_jns_atap[5], $nilai_jns_atap[6]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");
                        } elseif ($jmlJnsAtap == 6) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], $nilai_jns_atap[3], $nilai_jns_atap[4], $nilai_jns_atap[5]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                        } elseif ($jmlJnsAtap == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], $nilai_jns_atap[3], $nilai_jns_atap[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlJnsAtap == 4) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], $nilai_jns_atap[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlJnsAtap == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_atap', $max_gain, $nilai_jns_atap[0], $nilai_jns_atap[1], $nilai_jns_atap[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlJnsAtap == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_jns_atap[0]')", "($atribut='$nilai_jns_atap[1]')");
                        }
                break;
                    
                case($atribut == "knds_atap") :
                        $this->proses_DT($kondisi, "($atribut='BKT')", "($atribut='JKR')");
                break;
            
                case ($atribut == "smb_air_minum") :
                        if ($jmlSmbAir == 12) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4], $nilai_smb_air_minum[5], $nilai_smb_air_minum[6], $nilai_smb_air_minum[7], $nilai_smb_air_minum[8], $nilai_smb_air_minum[9], $nilai_smb_air_minum[10], $nilai_smb_air_minum[11]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]' OR $atribut='$exp_cabang[9]' OR $atribut='$exp_cabang[10]')");
                        } elseif ($jmlSmbAir == 11) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4], $nilai_smb_air_minum[5], $nilai_smb_air_minum[6], $nilai_smb_air_minum[7], $nilai_smb_air_minum[8], $nilai_smb_air_minum[9], $nilai_smb_air_minum[10]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]' OR $atribut='$exp_cabang[9]')");
                        } elseif ($jmlSmbAir == 10) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4], $nilai_smb_air_minum[5], $nilai_smb_air_minum[6], $nilai_smb_air_minum[7], $nilai_smb_air_minum[8], $nilai_smb_air_minum[9]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]' OR $atribut='$exp_cabang[8]')");
                        } elseif ($jmlSmbAir == 9) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4], $nilai_smb_air_minum[5], $nilai_smb_air_minum[6], $nilai_smb_air_minum[7], $nilai_smb_air_minum[8]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");
                        } elseif ($jmlSmbAir == 8) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4], $nilai_smb_air_minum[5], $nilai_smb_air_minum[6], $nilai_smb_air_minum[7]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");
                        } elseif ($jmlSmbAir == 7) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4], $nilai_smb_air_minum[5], $nilai_smb_air_minum[6]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");
                        } elseif ($jmlSmbAir == 6) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4], $nilai_smb_air_minum[5]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                        } elseif ($jmlSmbAir == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], $nilai_smb_air_minum[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlSmbAir == 4) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], $nilai_smb_air_minum[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlSmbAir == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_air_minum', $max_gain, $nilai_smb_air_minum[0], $nilai_smb_air_minum[1], $nilai_smb_air_minum[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlSmbAir == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_smb_air_minum[0]')", "($atribut='$nilai_smb_air_minum[1]')");
                        }
                break;
                
                case($atribut == "cmdp_air_minum") :
                        if ($jmlCmdpAir == 4) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'cmdp_air_minum', $max_gain, $nilai_cmdp_air_minum[0], $nilai_cmdp_air_minum[1], $nilai_cmdp_air_minum[2], $nilai_cmdp_air_minum[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlCmdpAir == 3) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'cmdp_air_minum', $max_gain, $nilai_cmdp_air_minum[0], $nilai_cmdp_air_minum[1], $nilai_cmdp_air_minum[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlCmdpAir == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_cmdp_air_minum[0]')", "($atribut='$nilai_cmdp_air_minum[1]')");
                        }//-------------------------------------------------------> 
                break;
                
                case ($atribut == "smb_penerangan") :
                        if ($jmlPenerangan == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'smb_penerangan', $max_gain, $nilai_smb_penerangan[0], $nilai_smb_penerangan[1], $nilai_smb_penerangan[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlInstansi == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_jml_art[0]')", "($atribut='$nilai_jml_art[1]')");
                        } //-----------------------------> Jumlah ART var.atrb = 3
                break;
                
                case ($atribut == "dy_listrik") :
                        if ($jmlDyListrik == 6) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'dy_listrik', $max_gain, $nilai_dy_listrik[0], $nilai_dy_listrik[1], $nilai_dy_listrik[2], $nilai_dy_listrik[3], $nilai_dy_listrik[4], $nilai_dy_listrik[5]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                        } elseif ($jmlDyListrik == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'dy_listrik', $max_gain, $nilai_dy_listrik[0], $nilai_dy_listrik[1], $nilai_dy_listrik[2], $nilai_dy_listrik[3], $nilai_dy_listrik[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlDyListrik == 4) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'dy_listrik', $max_gain, $nilai_dy_listrik[0], $nilai_dy_listrik[1], $nilai_dy_listrik[2], $nilai_dy_listrik[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlDyListrik == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'dy_listrik', $max_gain, $nilai_dy_listrik[0], $nilai_dy_listrik[1], $nilai_dy_listrik[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlDyListrik == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_dy_listrik[0]')", "($atribut='$nilai_dy_listrik[1]')");
                        }
                break;
                
                case ($atribut == "bb_masak") :
                        if ($jmlBbm == 9) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'bb_masak', $max_gain, $nilai_bb_masak[0], $nilai_bb_masak[1], $nilai_bb_masak[2], $nilai_bb_masak[3], $nilai_bb_masak[4], $nilai_bb_masak[5], $nilai_bb_masak[6], $nilai_bb_masak[7], $nilai_bb_masak[8]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]' OR $atribut='$exp_cabang[7]')");
                        } elseif ($jmlBbm == 8) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'bb_masak', $max_gain, $nilai_bb_masak[0], $nilai_bb_masak[1], $nilai_bb_masak[2], $nilai_bb_masak[3], $nilai_bb_masak[4], $nilai_bb_masak[5], $nilai_bb_masak[6], $nilai_bb_masak[7]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]' OR $atribut='$exp_cabang[6]')");
                        } elseif ($jmlBbm == 7) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'bb_masak', $max_gain, $nilai_bb_masak[0], $nilai_bb_masak[1], $nilai_bb_masak[2], $nilai_bb_masak[3], $nilai_bb_masak[4], $nilai_bb_masak[5], $nilai_bb_masak[6]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]' OR $atribut='$exp_cabang[5]')");
                        } elseif ($jmlBbm == 6) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'bb_masak', $max_gain, $nilai_bb_masak[0], $nilai_bb_masak[1], $nilai_bb_masak[2], $nilai_bb_masak[3], $nilai_bb_masak[4], $nilai_bb_masak[5]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                        } elseif ($jmlBbm == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'bb_masak', $max_gain, $nilai_bb_masak[0], $nilai_bb_masak[1], $nilai_bb_masak[2], $nilai_bb_masak[3], $nilai_bb_masak[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlBbm == 4) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'bb_masak', $max_gain, $nilai_bb_masak[0], $nilai_bb_masak[1], $nilai_bb_masak[2], $nilai_bb_masak[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlBbm == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'bb_masak', $max_gain, $nilai_bb_masak[0], $nilai_bb_masak[1], $nilai_bb_masak[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlBbm == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_bb_masak[0]')", "($atribut='$nilai_bb_masak[1]')");
                        }
                break;
                
                case ($atribut == "fasbab") :
                    if ($jmlFasbab == 4) {
                        //hitung rasio
                        $cabang = array();
                        $cabang1 = $this->hitung_rasio($kondisi, 'fasbab', $max_gain, $nilai_fasbab[0], $nilai_fasbab[1], $nilai_fasbab[2], $nilai_fasbab[3], '');
                        $exp_cabang = explode(" , ", $cabang[1]);
                        $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                    } elseif ($jmlFasbab == 3) {
                        //hitung rasio
                        $cabang = array();
                        $cabang1 = $this->hitung_rasio($kondisi, 'fasbab', $max_gain, $nilai_fasbab[0], $nilai_fasbab[1], $nilai_fasbab[2], '', '');
                        $exp_cabang = explode(" , ", $cabang[1]);
                        $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                    } elseif ($jmlFasbab == 2) {
                        $this->proses_DT($kondisi, "($atribut='$nilai_fasbab[0]')", "($atribut='$nilai_fasbab[1]')");
                    }//-------------------------------------------------------> 
                break;
                
                case ($atribut == "jns_kloset") :
                        if ($jmlJnsKloset == 4) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_kloset', $max_gain, $nilai_jns_kloset[0], $nilai_jns_kloset[1], $nilai_jns_kloset[2], $nilai_jns_kloset[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlJnsKloset == 3) {
                            //hitung rasio
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'jns_kloset', $max_gain, $nilai_jns_kloset[0], $nilai_jns_kloset[1], $nilai_jns_kloset[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlJnsKloset == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_jns_kloset[0]')", "($atribut='$nilai_jns_kloset[1]')");
                        }//-------------------------------------------------------> 
                break;
                    
                case ($atribut == "tp_akhir") :
                        if ($jmlTpAkhir == 6) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'tp_akhir', $max_gain, $nilai_tp_akhir[0], $nilai_tp_akhir[1], $nilai_tp_akhir[2], $nilai_tp_akhir[3], $nilai_tp_akhir[4], $nilai_tp_akhir[5]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                        } elseif ($jmlTpAkhir == 5) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'tp_akhir', $max_gain, $nilai_tp_akhir[0], $nilai_tp_akhir[1], $nilai_tp_akhir[2], $nilai_tp_akhir[3], $nilai_tp_akhir[4]);
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                        } elseif ($jmlTpAkhir == 4) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'tp_akhir', $max_gain, $nilai_tp_akhir[0], $nilai_tp_akhir[1], $nilai_tp_akhir[2], $nilai_tp_akhir[3], '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                        } elseif ($jmlTpAkhir == 3) {
                            $cabang = array();
                            $cabang1 = $this->hitung_rasio($kondisi, 'tp_akhir', $max_gain, $nilai_tp_akhir[0], $nilai_tp_akhir[1], $nilai_tp_akhir[2], '', '');
                            $exp_cabang = explode(" , ", $cabang[1]);
                            $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                        } elseif ($jmlTpAkhir == 2) {
                            $this->proses_DT($kondisi, "($atribut='$nilai_tp_akhir[0]')", "($atribut='$nilai_tp_akhir[1]')");
                        }
                break;
                
                case ($atribut == "sta_art_usaha") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_kks") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_kip") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_kis") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_bpjsm") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_jamsotek") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_asuransi_lain") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_rasta") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_kur") :
                        $this->proses_DT($kondisi, "($atribut='YA')", "($atribut='TIDAK')");
                break;
            
                case ($atribut == "sta_keberadaan_art") :
                    if ($jmlSkbar == 6) {
                        $cabang = array();
                        $cabang1 = $this->hitung_rasio($kondisi, 'sta_keberadaan_art', $max_gain, $nilai_sta_keberadaan_art[0], $nilai_sta_keberadaan_art[1], $nilai_sta_keberadaan_art[2], $nilai_sta_keberadaan_art[3], $nilai_sta_keberadaan_art[4], $nilai_sta_keberadaan_art[5]);
                        $exp_cabang = explode(" , ", $cabang[1]);
                        $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]' OR $atribut='$exp_cabang[4]')");
                    } elseif ($jmlSkbar == 5) {
                        $cabang = array();
                        $cabang1 = $this->hitung_rasio($kondisi, 'sta_keberadaan_art', $max_gain, $nilai_sta_keberadaan_art[0], $nilai_sta_keberadaan_art[1], $nilai_sta_keberadaan_art[2], $nilai_sta_keberadaan_art[3], $nilai_sta_keberadaan_art[4]);
                        $exp_cabang = explode(" , ", $cabang[1]);
                        $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]' OR $atribut='$exp_cabang[3]')");
                    } elseif ($jmlSkbar == 4) {
                        $cabang = array();
                        $cabang1 = $this->hitung_rasio($kondisi, 'sta_keberadaan_art', $max_gain, $nilai_sta_keberadaan_art[0], $nilai_sta_keberadaan_art[1], $nilai_sta_keberadaan_art[2], $nilai_sta_keberadaan_art[3], '');
                        $exp_cabang = explode(" , ", $cabang[1]);
                        $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]' OR $atribut='$exp_cabang[2]')");
                    } elseif ($jmlSkbar == 3) {
                        $cabang = array();
                        $cabang1 = $this->hitung_rasio($kondisi, 'sta_keberadaan_art', $max_gain, $nilai_sta_keberadaan_art[0], $nilai_sta_keberadaan_art[1], $nilai_sta_keberadaan_art[2], '', '');
                        $exp_cabang = explode(" , ", $cabang[1]);
                        $this->proses_DT($kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                    } elseif ($jmlSkbar == 2) {
                        $this->proses_DT($kondisi, "($atribut='$nilai_sta_keberadaan_art[0]')", "($atribut='$nilai_sta_keberadaan_art[1]')");
                    }
                    break;
                    default :"";
            }
        }
    }
}

//==============================================================================
//fungsi cek nilai atribut
    function cek_nilaiAtribut($field, $kondisi) {
        //sql disticnt		
        //$hasil = array();
        if ($kondisi == '') {
            $sql = $this->db->query("SELECT DISTINCT($field) FROM tbl_data_latih");
        } else {
            $sql = $this->db->query("SELECT DISTINCT($field) FROM tbl_data_latih WHERE $kondisi");
        }
        $hasil = $sql->result_array();
        return $hasil;
    }

//fungsi cek heterogen data
    function cek_heterohomogen($field, $kondisi) {
        //sql disticnt
        if ($kondisi == '') {
            $sql = $this->db->query("SELECT DISTINCT($field) FROM tbl_data_latih");
        } else {
            $sql = $this->db->query("SELECT DISTINCT($field) FROM tbl_data_latih WHERE $kondisi");
        }
        if ($sql->num_rows() == 1) {
            $nilai = "homogen";
        } else {
            $nilai = "heterogen";
        }
        return $nilai;
    }

//fungsi menghitung jumlah data
    function jumlah_data($kondisi) {
        if ($kondisi == '') {
            $sql = "SELECT * FROM tbl_data_latih $kondisi";
        } else {
            $sql = "SELECT * FROM tbl_data_latih WHERE $kondisi";
        }
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        return $jml;
    }

//fungsi pemangkasan cabang
    function pangkas($parent, $kasus, $leaf) {
        $sql_in = "INSERT INTO tbl_keputusan "
                . "(parent,akar,keputusan)"
                . " VALUES (\"$parent\" , \"$kasus\" , \"$leaf\")";
      $this->db->query($sql_in);
        echo "Keputusan = " . $leaf . "<br>================================<br>";
    }

//fungsi menghitung gain
 public function hitung_gain($kasus , $atribut , $ent_all , $kondisi1 , $kondisi2 , $kondisi3 , $kondisi4 , $kondisi5 , $kondisi6, $kondisi7 , $kondisi8 , $kondisi9 , $kondisi10, $kondisi11, $kondisi12){
		$data_kasus = '';
        if ($kasus != '') {
            $data_kasus = $kasus . " AND ";
        }
        //untuk atribut 2 nilai atribut	
        if ($kondisi3 == '') {
            $j_ya1    = $this->jumlah_data("$data_kasus keputusan_asli='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2));
        }
        //untuk atribut 3 nilai atribut
        else if ($kondisi4 == '') {
            $j_ya1    = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2  = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3));
        }
        //untuk atribut 4 nilai atribut
        else if ($kondisi5 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4));
        }
        else if ($kondisi6 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5));
        }
        else if ($kondisi7 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            $j_ya6 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi6");
            $j_tidak6 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi6");
            $jml6 = $j_ya6 + $j_tidak6;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $ent6 = $this->hitung_entropy($j_ya6, $j_tidak6);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5)+ (($jml6 / $jml_total) * $ent6));
        }
        else if ($kondisi8 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            $j_ya6 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi6");
            $j_tidak6 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi6");
            $jml6 = $j_ya6 + $j_tidak6;
            
            $j_ya7 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi7");
            $j_tidak7 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi7");
            $jml7 = $j_ya7 + $j_tidak7;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6 + $jml7;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $ent6 = $this->hitung_entropy($j_ya6, $j_tidak6);
            $ent7 = $this->hitung_entropy($j_ya7, $j_tidak7);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7));
        }
        else if ($kondisi9 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            $j_ya6 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi6");
            $j_tidak6 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi6");
            $jml6 = $j_ya6 + $j_tidak6;
            
            $j_ya7 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi7");
            $j_tidak7 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi7");
            $jml7 = $j_ya7 + $j_tidak7;
            
            $j_ya8 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi8");
            $j_tidak8 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi8");
            $jml8 = $j_ya8 + $j_tidak8;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6 + $jml7 + $jml8;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $ent6 = $this->hitung_entropy($j_ya6, $j_tidak6);
            $ent7 = $this->hitung_entropy($j_ya7, $j_tidak7);
            $ent8 = $this->hitung_entropy($j_ya8, $j_tidak8);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7) + (($jml8 / $jml_total) * $ent8));
        }
        else if ($kondisi10 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            $j_ya6 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi6");
            $j_tidak6 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi6");
            $jml6 = $j_ya6 + $j_tidak6;
            
            $j_ya7 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi7");
            $j_tidak7 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi7");
            $jml7 = $j_ya7 + $j_tidak7;
            
            $j_ya8 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi8");
            $j_tidak8 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi8");
            $jml8 = $j_ya8 + $j_tidak8;
            
            $j_ya9 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi9");
            $j_tidak9 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi9");
            $jml9 = $j_ya9 + $j_tidak9;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6 + $jml7 + $jml8 + $jml9;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $ent6 = $this->hitung_entropy($j_ya6, $j_tidak6);
            $ent7 = $this->hitung_entropy($j_ya7, $j_tidak7);
            $ent8 = $this->hitung_entropy($j_ya8, $j_tidak8);
            $ent9 = $this->hitung_entropy($j_ya9, $j_tidak9);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7) + (($jml8 / $jml_total) * $ent8) + (($jml9 / $jml_total) * $ent9));
        }
        else if ($kondisi11 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            $j_ya6 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi6");
            $j_tidak6 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi6");
            $jml6 = $j_ya6 + $j_tidak6;
            
            $j_ya7 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi7");
            $j_tidak7 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi7");
            $jml7 = $j_ya7 + $j_tidak7;
            
            $j_ya8 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi8");
            $j_tidak8 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi8");
            $jml8 = $j_ya8 + $j_tidak8;
            
            $j_ya9 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi9");
            $j_tidak9 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi9");
            $jml9 = $j_ya9 + $j_tidak9;
            
            $j_ya10 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi10");
            $j_tidak10 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi10");
            $jml10 = $j_ya10 + $j_tidak10;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6 + $jml7 + $jml8 + $jml9 + $jml10;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $ent6 = $this->hitung_entropy($j_ya6, $j_tidak6);
            $ent7 = $this->hitung_entropy($j_ya7, $j_tidak7);
            $ent8 = $this->hitung_entropy($j_ya8, $j_tidak8);
            $ent9 = $this->hitung_entropy($j_ya9, $j_tidak9);
            $ent10 = $this->hitung_entropy($j_ya10, $j_tidak10);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7) + (($jml8 / $jml_total) * $ent8) + (($jml9 / $jml_total) * $ent9) + (($jml10 / $jml_total) * $ent10));
        }
        else if ($kondisi12 == '') {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            $j_ya6 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi6");
            $j_tidak6 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi6");
            $jml6 = $j_ya6 + $j_tidak6;
            
            $j_ya7 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi7");
            $j_tidak7 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi7");
            $jml7 = $j_ya7 + $j_tidak7;
            
            $j_ya8 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi8");
            $j_tidak8 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi8");
            $jml8 = $j_ya8 + $j_tidak8;
            
            $j_ya9 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi9");
            $j_tidak9 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi9");
            $jml9 = $j_ya9 + $j_tidak9;
            
            $j_ya10 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi10");
            $j_tidak10 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi10");
            $jml10 = $j_ya10 + $j_tidak10;
            
            $j_ya11 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi11");
            $j_tidak11 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi11");
            $jml11 = $j_ya11 + $j_tidak11;
            
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6 + $jml7 + $jml8 + $jml9 + $jml0 + $jml11;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $ent6 = $this->hitung_entropy($j_ya6, $j_tidak6);
            $ent7 = $this->hitung_entropy($j_ya7, $j_tidak7);
            $ent8 = $this->hitung_entropy($j_ya8, $j_tidak8);
            $ent9 = $this->hitung_entropy($j_ya9, $j_tidak9);
            $ent10 = $this->hitung_entropy($j_ya10, $j_tidak10);
            $ent11 = $this->hitung_entropy($j_ya11, $j_tidak11);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7) + (($jml8 / $jml_total) * $ent8) + (($jml9 / $jml_total) * $ent9) + (($jml10 / $jml_total) * $ent10) + (($jml11 / $jml_total) * $ent11));
        }
        //untuk atribut 5 nilai atribut	
        else {
            $j_ya1 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi1");
            $j_tidak1 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi1");
            $jml1 = $j_ya1 + $j_tidak1;
            
            $j_ya2 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi2");
            $j_tidak2 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi2");
            $jml2 = $j_ya2 + $j_tidak2;
            
            $j_ya3 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi3");
            $j_tidak3 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi3");
            $jml3 = $j_ya3 + $j_tidak3;
            
            $j_ya4 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi4");
            $j_tidak4 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi4");
            $jml4 = $j_ya4 + $j_tidak4;
            
            $j_ya5 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi5");
            $j_tidak5 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi5");
            $jml5 = $j_ya5 + $j_tidak5;
            
            $j_ya6 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi6");
            $j_tidak6 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi6");
            $jml6 = $j_ya6 + $j_tidak6;
            
            $j_ya7 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi7");
            $j_tidak7 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi7");
            $jml7 = $j_ya7 + $j_tidak7;
            
            $j_ya8 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi8");
            $j_tidak8 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi8");
            $jml8 = $j_ya8 + $j_tidak8;
            
            $j_ya9 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi9");
            $j_tidak9 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi9");
            $jml9 = $j_ya9 + $j_tidak9;
            
            $j_ya10 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi10");
            $j_tidak10 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi10");
            $jml10 = $j_ya10 + $j_tidak10;
            
            $j_ya11 = $this->jumlah_data("$data_kasus keputusan_asli ='YA' AND $kondisi11");
            $j_tidak11 = $this->jumlah_data("$data_kasus keputusan_asli ='TIDAK' AND $kondisi11");
            $jml11 = $j_ya11 + $j_tidak11;
            //hitung entropy masing-masing kondisi
            $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6 + $jml7 + $jml8 + $jml9 + $jml0 + $jml11;
            $ent1 = $this->hitung_entropy($j_ya1, $j_tidak1);
            $ent2 = $this->hitung_entropy($j_ya2, $j_tidak2);
            $ent3 = $this->hitung_entropy($j_ya3, $j_tidak3);
            $ent4 = $this->hitung_entropy($j_ya4, $j_tidak4);
            $ent5 = $this->hitung_entropy($j_ya5, $j_tidak5);
            $ent6 = $this->hitung_entropy($j_ya6, $j_tidak6);
            $ent7 = $this->hitung_entropy($j_ya7, $j_tidak7);
            $ent8 = $this->hitung_entropy($j_ya8, $j_tidak8);
            $ent9 = $this->hitung_entropy($j_ya9, $j_tidak9);
            $ent10 = $this->hitung_entropy($j_ya10, $j_tidak10);
            $ent11 = $this->hitung_entropy($j_ya11, $j_tidak11);
            $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7) + (($jml8 / $jml_total) * $ent8) + (($jml9 / $jml_total) * $ent9) + (($jml10 / $jml_total) * $ent10) + (($jml11 / $jml_total) * $ent11));
        }
        //desimal 3 angka dibelakang koma
        $gain = round($gain, 3);
        if ($gain > 0) {
            echo "Gain " . $atribut . " = " . $gain . "<br>";
        }
        $this->db->query("INSERT INTO tbl_gain VALUES ('','1','$atribut','$gain')");
 }
//fungsi menghitung entropy
    function hitung_entropy($nilai1, $nilai2) {
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
public function hitung_rasio($kasus , $atribut , $gain ,$nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6, $nilai7, $nilai8, $nilai9, $nilai10, $nilai11, $nilai12){				
    $data_kasus = '';
    if($kasus!=''){
            $data_kasus = $kasus." AND ";
    }
    //menentukan jumlah nilai
            $jmlNilai=12;
            if($nilai12==''){
                 $jmlNilai=11;
            }
            if($nilai11==''){
                 $jmlNilai=10;
            }
            if($nilai10==''){
                 $jmlNilai=9;
            }
            if($nilai9==''){
                 $jmlNilai=8;
            }
            if($nilai8==''){
                 $jmlNilai=7;
            }
            if($nilai7==''){
                 $jmlNilai=6;
            }
            if($nilai6==''){
                 $jmlNilai=5;
            }
            if($nilai5==''){
                 $jmlNilai=4;
            }
            //jika nilai 4 kosong maka nilai atribut-nya 3
            if($nilai4==''){
                 $jmlNilai=3;				
            }						
            $this->db->query("TRUNCATE tbl_rasio_gain");		
		if($jmlNilai==3){
                $opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
                $opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
                $tot_opsi1=$opsi11+$opsi12;
                $opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
                $opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
                $tot_opsi2=$opsi21+$opsi22;
                $opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
                $opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
                $tot_opsi3=$opsi31+$opsi32;			
                //hitung split info
                $opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
                $opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
                $opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
                //desimal 3 angka dibelakang koma
                $opsi1a = round($opsi1,3);
                $opsi2a = round($opsi2,3);
                $opsi3a = round($opsi3,3);										
                //hitung rasio
                $rasio1 = $gain/$opsi1a;
                $rasio2 = $gain/$opsi2a;
                $rasio3 = $gain/$opsi3a;
                //desimal 3 angka dibelakang koma
                $rasio1a = round($rasio1,3);
                $rasio2a = round($rasio2,3);
                $rasio3a = round($rasio3,3);
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
                $this->db->query("INSERT INTO tbl_rasio_gain VALUES 
                                        ('' , 'opsi1' , '$nilai1' , '$nilai2' , '$nilai3' , '$rasio1'),
                                        ('' , 'opsi2' , '$nilai2' , '$nilai3' , '$nilai1' , '$rasio2'),
                                        ('' , 'opsi3' , '$nilai3' , '$nilai1 , '$nilai2' , '$rasio3')");
            }
//            else if($jmlNilai==4){
//                    $opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//                    $opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//                    $tot_opsi1=$opsi11+$opsi12;
//                    $opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai1')");
//                    $opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//                    $tot_opsi2=$opsi21+$opsi22;
//                    $opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//                    $opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//                    $tot_opsi3=$opsi31+$opsi32;
//                    $opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//                    $opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//                    $tot_opsi4=$opsi41+$opsi42;
//
//                    //hitung split info
//                    $opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//                    $opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//                    $opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//                    $opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));			
//                    //desimal 3 angka dibelakang koma
//                    $opsi1 = round($opsi1,3);
//                    $opsi2 = round($opsi2,3);
//                    $opsi3 = round($opsi3,3);
//                    $opsi4 = round($opsi4,3);
//
//                    //hitung rasio
//                    $rasio1 = $gain/$opsi1;
//                    $rasio2 = $gain/$opsi2;
//                    $rasio3 = $gain/$opsi3;
//                    $rasio4 = $gain/$opsi4;
//                    //desimal 3 angka dibelakang koma
//                    $rasio1 = round($rasio1,3);
//                    $rasio2 = round($rasio2,3);
//                    $rasio3 = round($rasio3,3);
//                    $rasio4 = round($rasio4,3);
//                    //cetak					
//                    echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi11.
//                            "<br>jumlah ".$nilai1." = ".$opsi12.
//                            "<br>Split = ".$opsi1.
//                            "<br>Rasio = ".$rasio1."<br>";
//                    echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai1." = ".$opsi21.
//                            "<br>jumlah ".$nilai2." = ".$opsi22.
//                            "<br>Split = ".$opsi2.
//                            "<br>Rasio = ".$rasio2."<br>";
//                    echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai1."/".$nilai2." = ".$opsi31.
//                            "<br>jumlah ".$nilai3." = ".$opsi32.
//                            "<br>Split = ".$opsi3.
//                            "<br>Rasio = ".$rasio3."<br>";
//                    echo "Opsi 4 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//                            "<br>jumlah ".$nilai4." = ".$opsi42.
//                            "<br>Split = ".$opsi4.
//                            "<br>Rasio = ".$rasio4."<br>";			
//
//                    //insert 
//                    $this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//                                            ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4' , '$rasio1'),
//                                            ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai1' , '$rasio2'),
//                                            ('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai1 , $nilai2' , '$rasio3'),
//                                            ('' , 'opsi4' , '$nilai4' , '$nilai1 , $nilai2 , $nilai3' , '$rasio4')");
//            }   
//            else if($jmlNilai==5){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//			
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";	
//			
//			//insert 
//			$this->db->query("INSERT INTO rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai1' , '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai1 , $nilai2' , '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai1 , $nilai2 , $nilai3' , '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , '$rasio5')");
//		}
//                else if($jmlNilai==6){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//                        $opsi61 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4'OR $atribut='$nilai5')");
//			$opsi62 = $this->jumlah_data("$data_kasus $atribut='$nilai6'");
//			$tot_opsi6=$opsi61+$opsi62;
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//                        $opsi6 = (-($opsi61/$tot_opsi6)*(log(($opsi61/$tot_opsi6),2))) + (-($opsi62/$tot_opsi6)*(log(($opsi62/$tot_opsi6),2)));
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//                        $opsi6 = round($opsi6,3);
//			
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//                        $rasio6 = $gain/$opsi6;
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//                        $rasio6 = round($rasio6,3);
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai6."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai6."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";
//                        echo "Opsi 6 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi61.
//				"<br>jumlah ".$nilai6." = ".$opsi62.
//				"<br>Split = ".$opsi6.
//				"<br>Rasio = ".$rasio6."<br>";	
//			
//			//insert 
//			$this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , $nilai6' , '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6' , $nilai1' , '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai1' , $nilai2' , '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai1 , $nilai2' , $nilai3' , '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai1 , $nilai2 , $nilai3' , $nilai4' , '$rasio5'),
//                                                ('' , 'opsi6' , '$nilai6' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , $nilai5' , '$rasio6')");
//		}
//                else if($jmlNilai==7){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7')");
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//                        $opsi61 = $this->jumlah_data("$data_kasus ($atribut='$nilai7' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
//			$opsi62 = $this->jumlah_data("$data_kasus $atribut='$nilai6'");
//			$tot_opsi6=$opsi61+$opsi62;
//                        $opsi71 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
//			$opsi72 = $this->jumlah_data("$data_kasus $atribut='$nilai7'");
//			$tot_opsi7=$opsi71+$opsi72;
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//                        $opsi6 = (-($opsi61/$tot_opsi6)*(log(($opsi61/$tot_opsi6),2))) + (-($opsi62/$tot_opsi6)*(log(($opsi62/$tot_opsi6),2)));
//                        $opsi7 = (-($opsi71/$tot_opsi7)*(log(($opsi71/$tot_opsi7),2))) + (-($opsi72/$tot_opsi7)*(log(($opsi72/$tot_opsi7),2)));
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//                        $opsi6 = round($opsi6,3);
//                        $opsi7 = round($opsi7,3);
//			
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//                        $rasio6 = $gain/$opsi6;
//                        $rasio7 = $gain/$opsi7;
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//                        $rasio6 = round($rasio6,3);
//                        $rasio7 = round($rasio7,3);
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai6."/".$nilai7."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai7."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";
//                        echo "Opsi 6 : <br>jumlah ".$nilai7."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi61.
//				"<br>jumlah ".$nilai6." = ".$opsi62.
//				"<br>Split = ".$opsi6.
//				"<br>Rasio = ".$rasio6."<br>";
//                        echo "Opsi 7 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6." = ".$opsi71.
//				"<br>jumlah ".$nilai7." = ".$opsi72.
//				"<br>Split = ".$opsi7.
//				"<br>Rasio = ".$rasio7."<br>";	
//			
//			//insert 
//			$this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , $nilai6' , $nilai7' , '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6' , $nilai7' , $nilai1' , '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai7' , $nilai1' , $nilai2' , '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai7 , $nilai1' , $nilai2' , $nilai3' , '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai7 , $nilai1 , $nilai2' , $nilai3' , $nilai4' , '$rasio5'),
//                                                ('' , 'opsi6' , '$nilai6' , '$nilai7 , $nilai1 , $nilai2 , $nilai3' , $nilai4' , $nilai5' , '$rasio6'),
//                                                ('' , 'opsi7' , '$nilai7' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , $nilai5' , $nilai5' , '$rasio6')");
//		}
//                else if($jmlNilai==8){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8')");                       
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//                        $opsi61 = $this->jumlah_data("$data_kasus ($atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
//			$opsi62 = $this->jumlah_data("$data_kasus $atribut='$nilai6'");
//			$tot_opsi6=$opsi61+$opsi62;
//                        $opsi71 = $this->jumlah_data("$data_kasus ($atribut='$nilai8' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
//			$opsi72 = $this->jumlah_data("$data_kasus $atribut='$nilai7'");
//			$tot_opsi7=$opsi71+$opsi72;
//			$opsi81 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7')");
//			$opsi82 = $this->jumlah_data("$data_kasus $atribut='$nilai8'");
//			$tot_opsi8=$opsi81+$opsi82;
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//                        $opsi6 = (-($opsi61/$tot_opsi6)*(log(($opsi61/$tot_opsi6),2))) + (-($opsi62/$tot_opsi6)*(log(($opsi62/$tot_opsi6),2)));
//                        $opsi7 = (-($opsi71/$tot_opsi7)*(log(($opsi71/$tot_opsi7),2))) + (-($opsi72/$tot_opsi7)*(log(($opsi72/$tot_opsi7),2)));
//			$opsi8 = (-($opsi81/$tot_opsi8)*(log(($opsi81/$tot_opsi8),2))) + (-($opsi82/$tot_opsi8)*(log(($opsi82/$tot_opsi8),2)));
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//                        $opsi6 = round($opsi6,3);
//                        $opsi7 = round($opsi7,3);
//			$opsi8 = round($opsi8,3);
//
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//                        $rasio6 = $gain/$opsi6;
//                        $rasio7 = $gain/$opsi7;
//			$rasio8 = $gain/$opsi8;
//
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//                        $rasio6 = round($rasio6,3);
//                        $rasio7 = round($rasio7,3);
//			$rasio8 = round($rasio8,3);
//
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai7."/".$nilai8."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";
//                        echo "Opsi 6 : <br>jumlah ".$nilai7."/".$nilai8."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi61.
//				"<br>jumlah ".$nilai6." = ".$opsi62.
//				"<br>Split = ".$opsi6.
//				"<br>Rasio = ".$rasio6."<br>";
//                        echo "Opsi 7 : <br>jumlah ".$nilai8."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6." = ".$opsi71.
//				"<br>jumlah ".$nilai7." = ".$opsi72.
//				"<br>Split = ".$opsi7.
//				"<br>Rasio = ".$rasio7."<br>";
//			echo "Opsi 8 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7." = ".$opsi81.
//				"<br>jumlah ".$nilai8." = ".$opsi82.
//				"<br>Split = ".$opsi8.
//				"<br>Rasio = ".$rasio8."<br>";	
//			
//			//insert 
//			$this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , $nilai6' , $nilai7' , $nilai8' , '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6' , $nilai7' , $nilai8' , $nilai1' , '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai8' , $nilai8' , $nilai1' , $nilai2' , '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai7 , $nilai1' , $nilai1' , $nilai2' , $nilai3' , '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai7 , $nilai8 , $nilai2' , $nilai2' , $nilai3' , $nilai4' , '$rasio5'),
//                                                ('' , 'opsi6' , '$nilai6' , '$nilai7 , $nilai8 , $nilai1 , $nilai3' , $nilai3' , $nilai4' , $nilai5' , '$rasio6'),
//                                                ('' , 'opsi7' , '$nilai7' , '$nilai8 , $nilai1 , $nilai2 , $nilai4' , $nilai4' , $nilai5' , $nilai6' , '$rasio7'),
//						('' , 'opsi8' , '$nilai8' , '$nilai1 , $nilai2 , $nilai3 , $nilai5' , $nilai5' , $nilai6' , $nilai7' , '$rasio8')");
//																				
//		}
//
//
//else if($jmlNilai==9){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9')");                       
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//                        $opsi61 = $this->jumlah_data("$data_kasus ($atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
//			$opsi62 = $this->jumlah_data("$data_kasus $atribut='$nilai6'");
//			$tot_opsi6=$opsi61+$opsi62;
//                        $opsi71 = $this->jumlah_data("$data_kasus ($atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
//			$opsi72 = $this->jumlah_data("$data_kasus $atribut='$nilai7'");
//			$tot_opsi7=$opsi71+$opsi72;
//			$opsi81 = $this->jumlah_data("$data_kasus ($atribut='$nilai9' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7')");
//			$opsi82 = $this->jumlah_data("$data_kasus $atribut='$nilai8'");
//			$tot_opsi8=$opsi81+$opsi82;
//			$opsi91 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8')");
//			$opsi92 = $this->jumlah_data("$data_kasus $atribut='$nilai9'");
//			$tot_opsi9=$opsi91+$opsi92;
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//                        $opsi6 = (-($opsi61/$tot_opsi6)*(log(($opsi61/$tot_opsi6),2))) + (-($opsi62/$tot_opsi6)*(log(($opsi62/$tot_opsi6),2)));
//                        $opsi7 = (-($opsi71/$tot_opsi7)*(log(($opsi71/$tot_opsi7),2))) + (-($opsi72/$tot_opsi7)*(log(($opsi72/$tot_opsi7),2)));
//			$opsi8 = (-($opsi81/$tot_opsi8)*(log(($opsi81/$tot_opsi8),2))) + (-($opsi82/$tot_opsi8)*(log(($opsi82/$tot_opsi8),2)));
//			$opsi9 = (-($opsi91/$tot_opsi9)*(log(($opsi91/$tot_opsi9),2))) + (-($opsi92/$tot_opsi9)*(log(($opsi92/$tot_opsi9),2)));
//
//
//
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//                        $opsi6 = round($opsi6,3);
//                        $opsi7 = round($opsi7,3);
//			$opsi8 = round($opsi8,3);
//			$opsi9 = round($opsi9,3);
//
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//                        $rasio6 = $gain/$opsi6;
//                        $rasio7 = $gain/$opsi7;
//			$rasio8 = $gain/$opsi8;
//			$rasio9 = $gain/$opsi9;
//
//			
//
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//                        $rasio6 = round($rasio6,3);
//                        $rasio7 = round($rasio7,3);
//			$rasio8 = round($rasio8,3);
//			$rasio9 = round($rasio9,3);
//
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";
//                        echo "Opsi 6 : <br>jumlah ".$nilai7."/".$nilai8."/".$nilai9."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi61.
//				"<br>jumlah ".$nilai6." = ".$opsi62.
//				"<br>Split = ".$opsi6.
//				"<br>Rasio = ".$rasio6."<br>";
//                        echo "Opsi 7 : <br>jumlah ".$nilai8."/".$nilai9."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6." = ".$opsi71.
//				"<br>jumlah ".$nilai7." = ".$opsi72.
//				"<br>Split = ".$opsi7.
//				"<br>Rasio = ".$rasio7."<br>";
//			echo "Opsi 8 : <br>jumlah ".$nilai1."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7." = ".$opsi81.
//				"<br>jumlah ".$nilai8." = ".$opsi82.
//				"<br>Split = ".$opsi8.
//				"<br>Rasio = ".$rasio8."<br>";
//			echo "Opsi 9 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8." = ".$opsi91.
//				"<br>jumlah ".$nilai9." = ".$opsi92.
//				"<br>Split = ".$opsi9.
//				"<br>Rasio = ".$rasio9."<br>";		
//			
//			//insert 
//			$this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9' , '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai1' , '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai7' , $nilai8' , $nilai9' , $nilai1' , $nilai2' , '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai7 , $nilai8' , $nilai9' , $nilai1' , $nilai2' , $nilai3' , '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai7 , $nilai8 , $nilai9' , $nilai1' , $nilai2' , $nilai3' , $nilai4' , '$rasio5'),
//                                                ('' , 'opsi6' , '$nilai6' , '$nilai7 , $nilai8 , $nilai9 , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5' , '$rasio6'),
//                                                ('' , 'opsi7' , '$nilai7' , '$nilai8 , $nilai9 , $nilai1 , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6' , '$rasio7'),
//						('' , 'opsi8' , '$nilai8' , '$nilai9 , $nilai1 , $nilai2 , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7' , '$rasio8'),
//						('' , 'opsi9' , '$nilai9' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8' , '$rasio9')");
//																				
//		}
//
//
//
//else if($jmlNilai==10){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10')");                       
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//                        $opsi61 = $this->jumlah_data("$data_kasus ($atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
//			$opsi62 = $this->jumlah_data("$data_kasus $atribut='$nilai6'");
//			$tot_opsi6=$opsi61+$opsi62;
//                        $opsi71 = $this->jumlah_data("$data_kasus ($atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
//			$opsi72 = $this->jumlah_data("$data_kasus $atribut='$nilai7'");
//			$tot_opsi7=$opsi71+$opsi72;
//			$opsi81 = $this->jumlah_data("$data_kasus ($atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7')");
//			$opsi82 = $this->jumlah_data("$data_kasus $atribut='$nilai8'");
//			$tot_opsi8=$opsi81+$opsi82;
//			$opsi91 = $this->jumlah_data("$data_kasus ($atribut='$nilai10' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8')");
//			$opsi92 = $this->jumlah_data("$data_kasus $atribut='$nilai9'");
//			$tot_opsi9=$opsi91+$opsi92;
//			$opsi101 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9')");
//			$opsi102 = $this->jumlah_data("$data_kasus $atribut='$nilai10'");
//			$tot_opsi10=$opsi101+$opsi102;
//
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//                        $opsi6 = (-($opsi61/$tot_opsi6)*(log(($opsi61/$tot_opsi6),2))) + (-($opsi62/$tot_opsi6)*(log(($opsi62/$tot_opsi6),2)));
//                        $opsi7 = (-($opsi71/$tot_opsi7)*(log(($opsi71/$tot_opsi7),2))) + (-($opsi72/$tot_opsi7)*(log(($opsi72/$tot_opsi7),2)));
//			$opsi8 = (-($opsi81/$tot_opsi8)*(log(($opsi81/$tot_opsi8),2))) + (-($opsi82/$tot_opsi8)*(log(($opsi82/$tot_opsi8),2)));
//			$opsi9 = (-($opsi91/$tot_opsi9)*(log(($opsi91/$tot_opsi9),2))) + (-($opsi92/$tot_opsi9)*(log(($opsi92/$tot_opsi9),2)));
//			$opsi10 = (-($opsi101/$tot_opsi101)*(log(($opsi101/$tot_opsi101),2))) + (-($opsi102/$tot_opsi10)*(log(($opsi102/$tot_opsi10),2)));
//
//
//
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//                        $opsi6 = round($opsi6,3);
//                        $opsi7 = round($opsi7,3);
//			$opsi8 = round($opsi8,3);
//			$opsi9 = round($opsi9,3);
//			$opsi10 = round($opsi10,3);
//
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//                        $rasio6 = $gain/$opsi6;
//                        $rasio7 = $gain/$opsi7;
//			$rasio8 = $gain/$opsi8;
//			$rasio9 = $gain/$opsi9;
//			$rasio10 = $gain/$opsi9;
//
//			
//
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//                        $rasio6 = round($rasio6,3);
//                        $rasio7 = round($rasio7,3);
//			$rasio8 = round($rasio8,3);
//			$rasio9 = round($rasio9,3);
//			$rasio10 = round($rasio10,3);
//
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";
//                        echo "Opsi 6 : <br>jumlah ".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi61.
//				"<br>jumlah ".$nilai6." = ".$opsi62.
//				"<br>Split = ".$opsi6.
//				"<br>Rasio = ".$rasio6."<br>";
//                        echo "Opsi 7 : <br>jumlah ".$nilai8."/".$nilai9."/".$nilai10."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6." = ".$opsi71.
//				"<br>jumlah ".$nilai7." = ".$opsi72.
//				"<br>Split = ".$opsi7.
//				"<br>Rasio = ".$rasio7."<br>";
//			echo "Opsi 8 : <br>jumlah ".$nilai9."/".$nilai10."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7." = ".$opsi81.
//				"<br>jumlah ".$nilai8." = ".$opsi82.
//				"<br>Split = ".$opsi8.
//				"<br>Rasio = ".$rasio8."<br>";
//		       echo "Opsi 9 : <br>jumlah ".$nilai10."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8." = ".$opsi91.
//				"<br>jumlah ".$nilai9." = ".$opsi92.
//				"<br>Split = ".$opsi9.
//				"<br>Rasio = ".$rasio9."<br>";
//		       echo "Opsi 10 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9." = ".$opsi101.
//				"<br>jumlah ".$nilai10." = ".$opsi102.
//				"<br>Split = ".$opsi10.
//				"<br>Rasio = ".$rasio10."<br>";			
//			
//			//insert 
//			$this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', $nilai1' , '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai7' , $nilai8' , $nilai9' , $nilai10' , $nilai1' , $nilai2', '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai7 , $nilai8' , $nilai9' , $nilai10' , $nilai1' , $nilai2' , $nilai3', '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai7 , $nilai8 , $nilai9' , $nilai10' , $nilai1' , $nilai2' , $nilai3' , $nilai4', '$rasio5'),
//                                                ('' , 'opsi6' , '$nilai6' , '$nilai7 , $nilai8 , $nilai9 , $nilai10' , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5' , '$rasio6'),
//                                                ('' , 'opsi7' , '$nilai7' , '$nilai8 , $nilai9 , $nilai10 , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6' , '$rasio7'),
//						('' , 'opsi8' , '$nilai8' , '$nilai9 , $nilai10 , $nilai1 , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7' , '$rasio8'),
//						('' , 'opsi9' , '$nilai9' , '$nilai10 , $nilai1 , $nilai2 , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8' , '$rasio9'),
//						('' , 'opsi10' , '$nilai10' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9' , '$rasio10')");
//																				
//		}
//
//
//else if($jmlNilai==11){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11')");                       
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//                        $opsi61 = $this->jumlah_data("$data_kasus ($atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
//			$opsi62 = $this->jumlah_data("$data_kasus $atribut='$nilai6'");
//			$tot_opsi6=$opsi61+$opsi62;
//                        $opsi71 = $this->jumlah_data("$data_kasus ($atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
//			$opsi72 = $this->jumlah_data("$data_kasus $atribut='$nilai7'");
//			$tot_opsi7=$opsi71+$opsi72;
//			$opsi81 = $this->jumlah_data("$data_kasus ($atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7')");
//			$opsi82 = $this->jumlah_data("$data_kasus $atribut='$nilai8'");
//			$tot_opsi8=$opsi81+$opsi82;
//			$opsi91 = $this->jumlah_data("$data_kasus ($atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8')");
//			$opsi92 = $this->jumlah_data("$data_kasus $atribut='$nilai9'");
//			$tot_opsi9=$opsi91+$opsi92;
//			$opsi101 = $this->jumlah_data("$data_kasus ($atribut='$nilai11' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9')");
//			$opsi102 = $this->jumlah_data("$data_kasus $atribut='$nilai10'");
//			$tot_opsi10=$opsi101+$opsi102;
//			$opsi111 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10')");
//			$opsi112 = $this->jumlah_data("$data_kasus $atribut='$nilai11'");
//			$tot_opsi11=$opsi111+$opsi112;
//
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//                        $opsi6 = (-($opsi61/$tot_opsi6)*(log(($opsi61/$tot_opsi6),2))) + (-($opsi62/$tot_opsi6)*(log(($opsi62/$tot_opsi6),2)));
//                        $opsi7 = (-($opsi71/$tot_opsi7)*(log(($opsi71/$tot_opsi7),2))) + (-($opsi72/$tot_opsi7)*(log(($opsi72/$tot_opsi7),2)));
//			$opsi8 = (-($opsi81/$tot_opsi8)*(log(($opsi81/$tot_opsi8),2))) + (-($opsi82/$tot_opsi8)*(log(($opsi82/$tot_opsi8),2)));
//			$opsi9 = (-($opsi91/$tot_opsi9)*(log(($opsi91/$tot_opsi9),2))) + (-($opsi92/$tot_opsi9)*(log(($opsi92/$tot_opsi9),2)));
//			$opsi10 = (-($opsi101/$tot_opsi101)*(log(($opsi101/$tot_opsi101),2))) + (-($opsi102/$tot_opsi10)*(log(($opsi102/$tot_opsi10),2)));
//			$opsi11 = (-($opsi111/$tot_opsi111)*(log(($opsi111/$tot_opsi111),2))) + (-($opsi112/$tot_opsi10)*(log(($opsi112/$tot_opsi11),2)));
//
//
//
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//                        $opsi6 = round($opsi6,3);
//                        $opsi7 = round($opsi7,3);
//			$opsi8 = round($opsi8,3);
//			$opsi9 = round($opsi9,3);
//			$opsi10 = round($opsi10,3);
//			$opsi11 = round($opsi11,3);
//
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//                        $rasio6 = $gain/$opsi6;
//                        $rasio7 = $gain/$opsi7;
//			$rasio8 = $gain/$opsi8;
//			$rasio9 = $gain/$opsi9;
//			$rasio10 = $gain/$opsi10;
//			$rasio11 = $gain/$opsi11;
//
//			
//
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//                        $rasio6 = round($rasio6,3);
//                        $rasio7 = round($rasio7,3);
//			$rasio8 = round($rasio8,3);
//			$rasio9 = round($rasio9,3);
//			$rasio10 = round($rasio10,3);
//			$rasio11 = round($rasio11,3);
//
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";
//                        echo "Opsi 6 : <br>jumlah ".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi61.
//				"<br>jumlah ".$nilai6." = ".$opsi62.
//				"<br>Split = ".$opsi6.
//				"<br>Rasio = ".$rasio6."<br>";
//                        echo "Opsi 7 : <br>jumlah ".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6." = ".$opsi71.
//				"<br>jumlah ".$nilai7." = ".$opsi72.
//				"<br>Split = ".$opsi7.
//				"<br>Rasio = ".$rasio7."<br>";
//			echo "Opsi 8 : <br>jumlah ".$nilai9."/".$nilai10."/".$nilai11."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7." = ".$opsi81.
//				"<br>jumlah ".$nilai8." = ".$opsi82.
//				"<br>Split = ".$opsi8.
//				"<br>Rasio = ".$rasio8."<br>";
//		       echo "Opsi 9 : <br>jumlah ".$nilai10."/".$nilai11."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8." = ".$opsi91.
//				"<br>jumlah ".$nilai9." = ".$opsi92.
//				"<br>Split = ".$opsi9.
//				"<br>Rasio = ".$rasio9."<br>";
//		       echo "Opsi 10 : <br>jumlah ".$nilai11."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9." = ".$opsi101.
//				"<br>jumlah ".$nilai10." = ".$opsi102.
//				"<br>Split = ".$opsi10.
//				"<br>Rasio = ".$rasio10."<br>";
//		      echo "Opsi 11 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10." = ".$opsi111.
//				"<br>jumlah ".$nilai11." = ".$opsi102.
//				"<br>Split = ".$opsi11.
//				"<br>Rasio = ".$rasio11."<br>";				
//			
//			//insert 
//			$this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', $nilai11', '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', $nilai11' , $nilai1', '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai7' , $nilai8' , $nilai9' , $nilai10' , $nilai11' , $nilai1', $nilai2', '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai7 , $nilai8' , $nilai9' , $nilai10' , $nilai11' , $nilai1' , $nilai2', $nilai3', '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai7 , $nilai8 , $nilai9' , $nilai10' , $nilai11' , $nilai1' , $nilai2' , $nilai3', $nilai4', '$rasio5'),
//                                                ('' , 'opsi6' , '$nilai6' , '$nilai7 , $nilai8 , $nilai9 , $nilai10' , $nilai11' , $nilai1' , $nilai2' , $nilai3' , $nilai4', $nilai5', '$rasio6'),
//                                                ('' , 'opsi7' , '$nilai7' , '$nilai8 , $nilai9 , $nilai10 , $nilai11' , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6', '$rasio7'),
//						('' , 'opsi8' , '$nilai8' , '$nilai9 , $nilai10 , $nilai11 , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7', '$rasio8'),
//						('' , 'opsi9' , '$nilai9' , '$nilai10 , $nilai11 , $nilai1 , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8', '$rasio9'),
//						('' , 'opsi10' , '$nilai10' , '$nilai11 , $nilai1 , $nilai2 , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9', '$rasio10'),
//						('' , 'opsi11' , '$nilai11' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', '$rasio11')");
//																				
//		}
//
//else if($jmlNilai==12){
//			$opsi11 = $this->jumlah_data("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12')");                       
//			$opsi12 = $this->jumlah_data("$data_kasus $atribut='$nilai1'");
//			$tot_opsi1=$opsi11+$opsi12;
//			$opsi21 = $this->jumlah_data("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1')");
//			$opsi22 = $this->jumlah_data("$data_kasus $atribut='$nilai2'");
//			$tot_opsi2=$opsi21+$opsi22;
//			$opsi31 = $this->jumlah_data("$data_kasus ($atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2')");
//			$opsi32 = $this->jumlah_data("$data_kasus $atribut='$nilai3'");
//			$tot_opsi3=$opsi31+$opsi32;
//			$opsi41 = $this->jumlah_data("$data_kasus ($atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3')");
//			$opsi42 = $this->jumlah_data("$data_kasus $atribut='$nilai4'");
//			$tot_opsi4=$opsi41+$opsi42;
//			$opsi51 = $this->jumlah_data("$data_kasus ($atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4')");
//			$opsi52 = $this->jumlah_data("$data_kasus $atribut='$nilai5'");
//			$tot_opsi5=$opsi51+$opsi52;
//                        $opsi61 = $this->jumlah_data("$data_kasus ($atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5')");
//			$opsi62 = $this->jumlah_data("$data_kasus $atribut='$nilai6'");
//			$tot_opsi6=$opsi61+$opsi62;
//                        $opsi71 = $this->jumlah_data("$data_kasus ($atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6')");
//			$opsi72 = $this->jumlah_data("$data_kasus $atribut='$nilai7'");
//			$tot_opsi7=$opsi71+$opsi72;
//			$opsi81 = $this->jumlah_data("$data_kasus ($atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7')");
//			$opsi82 = $this->jumlah_data("$data_kasus $atribut='$nilai8'");
//			$tot_opsi8=$opsi81+$opsi82;
//			$opsi91 = $this->jumlah_data("$data_kasus ($atribut='$nilai10' OR $atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8')");
//			$opsi92 = $this->jumlah_data("$data_kasus $atribut='$nilai9'");
//			$tot_opsi9=$opsi91+$opsi92;
//			$opsi101 = $this->jumlah_data("$data_kasus ($atribut='$nilai11' OR $atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9')");
//			$opsi102 = $this->jumlah_data("$data_kasus $atribut='$nilai10'");
//			$tot_opsi10=$opsi101+$opsi102;
//			$opsi111 = $this->jumlah_data("$data_kasus ($atribut='$nilai12' OR $atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai4' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10')");
//			$opsi112 = $this->jumlah_data("$data_kasus $atribut='$nilai11'");
//			$tot_opsi12=$opsi121+$opsi122;
//			$opsi121 = $this->jumlah_data("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2' OR $atribut='$nilai3' OR $atribut='$nilai4' OR $atribut='$nilai5' OR $atribut='$nilai6' OR $atribut='$nilai7' OR $atribut='$nilai8' OR $atribut='$nilai9' OR $atribut='$nilai10' OR $atribut='$nilai11')");
//			$opsi122 = $this->jumlah_data("$data_kasus $atribut='$nilai12'");
//			$tot_opsi12=$opsi121+$opsi122;
//
//			
//			//hitung split info
//			$opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
//			$opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
//			$opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
//			$opsi4 = (-($opsi41/$tot_opsi4)*(log(($opsi41/$tot_opsi4),2))) + (-($opsi42/$tot_opsi4)*(log(($opsi42/$tot_opsi4),2)));
//			$opsi5 = (-($opsi51/$tot_opsi5)*(log(($opsi51/$tot_opsi5),2))) + (-($opsi52/$tot_opsi5)*(log(($opsi52/$tot_opsi5),2)));
//                        $opsi6 = (-($opsi61/$tot_opsi6)*(log(($opsi61/$tot_opsi6),2))) + (-($opsi62/$tot_opsi6)*(log(($opsi62/$tot_opsi6),2)));
//                        $opsi7 = (-($opsi71/$tot_opsi7)*(log(($opsi71/$tot_opsi7),2))) + (-($opsi72/$tot_opsi7)*(log(($opsi72/$tot_opsi7),2)));
//			$opsi8 = (-($opsi81/$tot_opsi8)*(log(($opsi81/$tot_opsi8),2))) + (-($opsi82/$tot_opsi8)*(log(($opsi82/$tot_opsi8),2)));
//			$opsi9 = (-($opsi91/$tot_opsi9)*(log(($opsi91/$tot_opsi9),2))) + (-($opsi92/$tot_opsi9)*(log(($opsi92/$tot_opsi9),2)));
//			$opsi10 = (-($opsi101/$tot_opsi101)*(log(($opsi101/$tot_opsi101),2))) + (-($opsi102/$tot_opsi10)*(log(($opsi102/$tot_opsi10),2)));
//			$opsi11 = (-($opsi111/$tot_opsi111)*(log(($opsi111/$tot_opsi111),2))) + (-($opsi112/$tot_opsi11)*(log(($opsi112/$tot_opsi11),2)));
//			$opsi12 = (-($opsi121/$tot_opsi121)*(log(($opsi121/$tot_opsi121),2))) + (-($opsi122/$tot_opsi12)*(log(($opsi122/$tot_opsi12),2)));
//
//
//
//			//desimal 3 angka dibelakang koma
//			$opsi1 = round($opsi1,3);
//			$opsi2 = round($opsi2,3);
//			$opsi3 = round($opsi3,3);
//			$opsi4 = round($opsi4,3);
//			$opsi5 = round($opsi5,3);
//                        $opsi6 = round($opsi6,3);
//                        $opsi7 = round($opsi7,3);
//			$opsi8 = round($opsi8,3);
//			$opsi9 = round($opsi9,3);
//			$opsi10 = round($opsi10,3);
//			$opsi11 = round($opsi11,3);
//			$opsi12 = round($opsi12,3);
//
//
//			//hitung rasio
//			$rasio1 = $gain/$opsi1;
//			$rasio2 = $gain/$opsi2;
//			$rasio3 = $gain/$opsi3;
//			$rasio4 = $gain/$opsi4;
//			$rasio5 = $gain/$opsi5;
//                        $rasio6 = $gain/$opsi6;
//                        $rasio7 = $gain/$opsi7;
//			$rasio8 = $gain/$opsi8;
//			$rasio9 = $gain/$opsi9;
//			$rasio10 = $gain/$opsi10;
//			$rasio11 = $gain/$opsi11;
//			$rasio12 = $gain/$opsi12;
//
//			
//
//			//desimal 3 angka dibelakang koma
//			$rasio1 = round($rasio1,3);
//			$rasio2 = round($rasio2,3);
//			$rasio3 = round($rasio3,3);
//			$rasio4 = round($rasio4,3);
//			$rasio5 = round($rasio5,3);
//                        $rasio6 = round($rasio6,3);
//                        $rasio7 = round($rasio7,3);
//			$rasio8 = round($rasio8,3);
//			$rasio9 = round($rasio9,3);
//			$rasio10 = round($rasio10,3);
//			$rasio11 = round($rasio11,3);
//			$rasio12 = round($rasio12,3);
//
//			//cetak
//			echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12." = ".$opsi11.
//				"<br>jumlah ".$nilai1." = ".$opsi12.
//				"<br>Split = ".$opsi1.
//				"<br>Rasio = ".$rasio1."<br>";
//			echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1." = ".$opsi21.
//				"<br>jumlah ".$nilai2." = ".$opsi22.
//				"<br>Split = ".$opsi2.
//				"<br>Rasio = ".$rasio2."<br>";
//			echo "Opsi 3 : <br>jumlah ".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2." = ".$opsi31.
//				"<br>jumlah ".$nilai3." = ".$opsi32.
//				"<br>Split = ".$opsi3.
//				"<br>Rasio = ".$rasio3."<br>";
//			echo "Opsi 4 : <br>jumlah ".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3." = ".$opsi41.
//				"<br>jumlah ".$nilai4." = ".$opsi42.
//				"<br>Split = ".$opsi4.
//				"<br>Rasio = ".$rasio4."<br>";
//			echo "Opsi 5 : <br>jumlah ".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4." = ".$opsi51.
//				"<br>jumlah ".$nilai5." = ".$opsi52.
//				"<br>Split = ".$opsi5.
//				"<br>Rasio = ".$rasio5."<br>";
//                        echo "Opsi 6 : <br>jumlah ".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5." = ".$opsi61.
//				"<br>jumlah ".$nilai6." = ".$opsi62.
//				"<br>Split = ".$opsi6.
//				"<br>Rasio = ".$rasio6."<br>";
//                        echo "Opsi 7 : <br>jumlah ".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6." = ".$opsi71.
//				"<br>jumlah ".$nilai7." = ".$opsi72.
//				"<br>Split = ".$opsi7.
//				"<br>Rasio = ".$rasio7."<br>";
//			echo "Opsi 8 : <br>jumlah ".$nilai9."/".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7." = ".$opsi81.
//				"<br>jumlah ".$nilai8." = ".$opsi82.
//				"<br>Split = ".$opsi8.
//				"<br>Rasio = ".$rasio8."<br>";
//		       echo "Opsi 9 : <br>jumlah ".$nilai10."/".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8." = ".$opsi91.
//				"<br>jumlah ".$nilai9." = ".$opsi92.
//				"<br>Split = ".$opsi9.
//				"<br>Rasio = ".$rasio9."<br>";
//		       echo "Opsi 10 : <br>jumlah ".$nilai11."/".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9." = ".$opsi101.
//				"<br>jumlah ".$nilai10." = ".$opsi102.
//				"<br>Split = ".$opsi10.
//				"<br>Rasio = ".$rasio10."<br>";
//		      echo "Opsi 11 : <br>jumlah ".$nilai12."/".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10." = ".$opsi111.
//				"<br>jumlah ".$nilai11." = ".$opsi102.
//				"<br>Split = ".$opsi11.
//				"<br>Rasio = ".$rasio11."<br>";
//		      echo "Opsi 12 : <br>jumlah ".$nilai1."/".$nilai2."/".$nilai3."/".$nilai4."/".$nilai5."/".$nilai6."/".$nilai7."/".$nilai8."/".$nilai9."/".$nilai10."/".$nilai11." = ".$opsi121.
//				"<br>jumlah ".$nilai12." = ".$opsi122.
//				"<br>Split = ".$opsi12.
//				"<br>Rasio = ".$rasio12."<br>";				
//			
//			//insert 
//			$this->db->query("INSERT INTO tbl_rasio_gain VALUES 
//						('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3 , $nilai4 , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', $nilai11', $nilai12', '$rasio1'),
//						('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai4 , $nilai5 , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', $nilai11' , $nilai12', $nilai1', '$rasio2'),
//						('' , 'opsi3' , '$nilai3' , '$nilai4 , $nilai5 , $nilai6 , $nilai7' , $nilai8' , $nilai9' , $nilai10' , $nilai11' , $nilai12', $nilai1', $nilai2', '$rasio3'),
//						('' , 'opsi4' , '$nilai4' , '$nilai5 , $nilai6 , $nilai7 , $nilai8' , $nilai9' , $nilai10' , $nilai11' , $nilai12' , $nilai1', $nilai2', $nilai3', '$rasio4'),
//						('' , 'opsi5' , '$nilai5' , '$nilai6 , $nilai7 , $nilai8 , $nilai9' , $nilai10' , $nilai11' , $nilai12' , $nilai1' , $nilai2', $nilai3', $nilai4', '$rasio5'),
//                                                ('' , 'opsi6' , '$nilai6' , '$nilai7 , $nilai8 , $nilai9 , $nilai10' , $nilai11' , $nilai12' , $nilai1' , $nilai2' , $nilai3', $nilai4', $nilai5', '$rasio6'),
//                                                ('' , 'opsi7' , '$nilai7' , '$nilai8 , $nilai9 , $nilai10 , $nilai11' , $nilai12' , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5', $nilai6', '$rasio7'),
//						('' , 'opsi8' , '$nilai8' , '$nilai9 , $nilai10 , $nilai11 , $nilai12' , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6', $nilai7', '$rasio8'),
//						('' , 'opsi9' , '$nilai9' , '$nilai10 , $nilai11 , $nilai12 , $nilai1' , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7', $nilai8', '$rasio9'),
//						('' , 'opsi10' , '$nilai10' , '$nilai11 , $nilai12 , $nilai1 , $nilai2' , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8', $nilai9', '$rasio10'),
//						('' , 'opsi11' , '$nilai11' , '$nilai12 , $nilai1 , $nilai2 , $nilai3' , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9', $nilai10', '$rasio11'),
//						('' , 'opsi11' , '$nilai12' , '$nilai1 , $nilai2 , $nilai3 , $nilai4' , $nilai5' , $nilai6' , $nilai7' , $nilai8' , $nilai9' , $nilai10', $nilai11', '$rasio12')");
//																				
//		}

        $sql_max = $this->db-query("SELECT MAX(rasio_gain) FROM tbl_rasio_gain");
        $row_max = $sql_max->result_array();
        $max_rasio = $row_max['0'];
        $sql = $this->db-query("SELECT * FROM rasio_gain WHERE rasio_gain=$max_rasio");
        $row = $sql->result_array();
        $opsiMax = array();
        $opsiMax[0] = $row[2];
        $opsiMax[1] = $row[3];
        echo "<br>=========================<br>";
        return $opsiMax;
    }

    function klasifikasi($db_object, $n_jenis_kelamin, $n_usia, $n_sekolah, $n_jawaban_a, $n_jawaban_b, $n_jawaban_c, $n_jawaban_d) {

        $sql = $db_object->db_query("SELECT * FROM t_keputusan");
        $keputusan = $id_rule_keputusan = "";
        while ($row = $db_object->db_fetch_array($sql)) {
            //menggabungkan parent dan akar dengan kata AND
            if ($row['parent'] != '') {
                $rule = $row['parent'] . " AND " . $row['akar'];
            } else {
                $rule = $row['akar'];
            }
            //mengubah parameter
            $rule = str_replace("<=", " k ", $rule);
            $rule = str_replace("=", " s ", $rule);
            $rule = str_replace(">", " l ", $rule);
            //mengganti nilai
            $rule = str_replace("jenis_kelamin", "'$n_jenis_kelamin'", $rule);
            $rule = str_replace("usia", "'$n_usia'", $rule);
            $rule = str_replace("sekolah", "'$n_sekolah'", $rule);
            $rule = str_replace("jawaban_a", "'$n_jawaban_a'", $rule);
            $rule = str_replace("jawaban_b", "$n_jawaban_b", $rule);
            $rule = str_replace("jawaban_c", "$n_jawaban_c", $rule);
            $rule = str_replace("jawaban_d", "$n_jawaban_d", $rule);
            //menghilangkan '
            $rule = str_replace("'", "", $rule);
            //explode and
            $explodeAND = explode(" AND ", $rule);
            $jmlAND = count($explodeAND);
            //menghilangkan ()
            $explodeAND = str_replace("(", "", $explodeAND);
            $explodeAND = str_replace(")", "", $explodeAND);
            //deklarasi bol
            $bolAND = array();
            $n = 0;
            while ($n < $jmlAND) {
                //explode or
                $explodeOR = explode(" OR ", $explodeAND[$n]);
                $jmlOR = count($explodeOR);
                //deklarasi bol
                $bol = array();
                $a = 0;
                while ($a < $jmlOR) {
                    //pecah  dengan spasi
                    $exrule2 = explode(" ", $explodeOR[$a]);
                    $parameter = $exrule2[1];
                    if ($parameter == 's') {
                        //pecah  dengan s
                        $explodeRule = explode(" s ", $explodeOR[$a]);
                        //nilai true false						
                        if ($explodeRule[0] == $explodeRule[1]) {
                            $bol[$a] = "Benar";
                        } else if ($explodeRule[0] != $explodeRule[1]) {
                            $bol[$a] = "Salah";
                        }
                    } else if ($parameter == 'k') {
                        //pecah  dengan k
                        $explodeRule = explode(" k ", $explodeOR[$a]);
                        //nilai true false
                        if ($explodeRule[0] <= $explodeRule[1]) {
                            $bol[$a] = "Benar";
                        } else {
                            $bol[$a] = "Salah";
                        }
                    } else if ($parameter == 'l') {
                        //pecah dengan s
                        $explodeRule = explode(" l ", $explodeOR[$a]);
                        //nilai true false
                        if ($explodeRule[0] > $explodeRule[1]) {
                            $bol[$a] = "Benar";
                        } else {
                            $bol[$a] = "Salah";
                        }
                    }
                    $a++;
                }
                //isi false
                $bolAND[$n] = "Salah";
                $b = 0;
                while ($b < $jmlOR) {
                    //jika $bol[$b] benar bolAND benar
                    if ($bol[$b] == "Benar") {
                        $bolAND[$n] = "Benar";
                    }
                    $b++;
                }
                $n++;
            }
            //isi boolrule
            $boolRule = "Benar";
            $a = 0;
            while ($a < $jmlAND) {
                //jika ada yang salah boolrule diganti salah
                if ($bolAND[$a] == "Salah") {
                    $boolRule = "Salah";
                    break;
                }
                $a++;
            }
            if ($boolRule == "Benar") {
                $keputusan = $row['keputusan'];
                $id_rule_keputusan = $row['id'];
                break;
            }
            //jika tidak ada rule yang memenuhi kondisi data uji 
            //maka ambil rule paling bawah(ambil konisi yg paling panjang)????....
            if ($keputusan == '') {
                $que = $db_object->db_query("SELECT parent FROM t_keputusan");
                $jml = array();
                $exParent = array();
                $i = 0;
                while ($row_baris = $db_object->db_fetch_array($que)) {
                    $exParent = explode(" AND ", $row_baris['parent']);
                    $jml[$i] = count($exParent);
                    $i++;
                }
                $maxParent = max($jml);
                $sql_query = $db_object->db_query("SELECT * FROM t_keputusan");
                while ($row_bar = $db_object->db_fetch_array($sql_query)) {
                    $explP = explode(" AND ", $row_bar['parent']);
                    $jmlT = count($explP);
                    if ($jmlT == $maxParent) {
                        $keputusan = $row_bar['keputusan'];
                        $id_rule[$it] = $row_bar['id'];
                        $id_rule_keputusan = $row_bar['id'];
                        break;
                    }
                }
            }
        }//end loop t_keputusan

        return array('keputusan' => $keputusan, 'id_rule' => $id_rule_keputusan);
    }

}
