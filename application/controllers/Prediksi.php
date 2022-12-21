<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Prediksi
 *
 * @author Ady
 */
class Prediksi extends CI_Controller {

    public function klasifikasi() {
        $get_data = $this->db->where('keputusan_hasil', NULL)->get('tbl_hasil_prediksi');
        $keluaran = $get_data->result_array();
        $notif_error = $get_data->num_rows();
        if ($notif_error <= 0) {
            echo "<script>alert('Tidak Ada Data Input Survey Baru..!');</script>";
            redirect('prediksi', 'refresh');
        }
        foreach ($keluaran as $baris) {
            $hasil = $this->proses_prediksi($baris['jml_art'], $baris['jml_keluarga'], $baris['sta_lahan'], $baris['sta_bangunan'], $baris['jns_lantai'], $baris['jns_dinding'], $baris['knds_dinding'], $baris['jns_atap'], $baris['knds_atap'], $baris['smb_air_minum'], $baris['cmdp_air_minum'], $baris['smb_penerangan'], $baris['dy_listrik'], $baris['bb_masak'], $baris['fasbab'], $baris['jns_kloset'], $baris['tp_akhir'], $baris['sta_art_usaha'], $baris['sta_kks'], $baris['sta_kip'], $baris['sta_kis'], $baris['sta_bpjsm'], $baris['sta_jamsotek'], $baris['sta_asuransi_lain'], $baris['sta_rasta'], $baris['sta_kur'], $baris['sta_keberadaan_art']);

            $sql_in_hasil = "UPDATE tbl_hasil_prediksi SET keputusan_hasil='" . $hasil['keputusan'] . "',id_rule=" . $hasil['id_rule'] . " WHERE id_master=" . $baris['id_master'] . " ";
            $notif = $this->db->query($sql_in_hasil);
            if ($notif == TRUE) {
                echo "<script>alert('Prediksi Berhasil..!');</script>";
                redirect('prediksi', 'refresh');
            }
        }
    }

    public function proses_prediksi($jml_art, $jml_keluarga, $sta_lahan, $sta_bangunan, $jns_lantai, $jns_dinding, $knds_dinding, $jns_atap, $knds_atap, $smb_air_minum, $cmdp_air_minum, $smb_penerangan, $dy_listrik, $bb_masak, $fasbab, $jns_kloset, $tp_akhir, $sta_art_usaha, $sta_kks, $sta_kip, $sta_kis, $sta_bpjsm, $sta_jamsotek, $sta_asuransi_lain, $sta_rasta, $sta_kur, $sta_keberadaan_art) {
        $sql = $this->db->query("SELECT * FROM tbl_keputusan");
        $jml = $sql->num_rows();
        if($jml<=0){
         echo "<script>alert('Keputusan Belum Terbentuk..! Silahkan Melakukan Proses Mining..!');</script>";
         redirect('dtlatih', 'refresh');  
        }
        $baris = $sql->result_array();
        $keputusan = $id_rule_keputusan = "";
        foreach ($baris as $row) {
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
            $rule = str_replace("jml_art", "'$jml_art'", $rule);
            $rule = str_replace("jml_keluarga", "'$jml_keluarga'", $rule);
            $rule = str_replace("sta_lahan", "'$sta_lahan'", $rule);
            $rule = str_replace("sta_bangunan", "'$sta_bangunan'", $rule);
            $rule = str_replace("jns_lantai", "'$jns_lantai'", $rule);
            $rule = str_replace("jns_dinding", "'$jns_dinding'", $rule);
            $rule = str_replace("knds_dinding", "'$knds_dinding'", $rule);
            $rule = str_replace("jns_atap ", "'$jns_atap'", $rule);
            $rule = str_replace("knds_atap", "'$knds_atap'", $rule);
            $rule = str_replace("smb_air_minum", "'$smb_air_minum'", $rule);
            $rule = str_replace("cmdp_air_minum", "'$cmdp_air_minum'", $rule);
            $rule = str_replace("smb_penerangan", "'$smb_penerangan'", $rule);
            $rule = str_replace("dy_listrik", "'$dy_listrik'", $rule);
            $rule = str_replace("bb_masak", "'$bb_masak'", $rule);
            $rule = str_replace("fasbab", "'$fasbab'", $rule);
            $rule = str_replace("jns_kloset", "'$jns_kloset'", $rule);
            $rule = str_replace("tp_akhir", "'$tp_akhir'", $rule);
            $rule = str_replace("sta_art_usaha", "'$sta_art_usaha'", $rule);
            $rule = str_replace("sta_kks", "'$sta_kks'", $rule);
            $rule = str_replace("sta_kip", "'$sta_kip'", $rule);
            $rule = str_replace("sta_kis", "'$sta_kis'", $rule);
            $rule = str_replace("sta_bpjsm", "'$sta_bpjsm'", $rule);
            $rule = str_replace("sta_jamsotek", "'$sta_jamsotek'", $rule);
            $rule = str_replace("sta_asuransi_lain", "'$sta_asuransi_lain'", $rule);
            $rule = str_replace("sta_rasta", "'$sta_rasta'", $rule);
            $rule = str_replace("sta_kur", "'$sta_kur'", $rule);
            $rule = str_replace("sta_keberadaan_art", "'$sta_keberadaan_art'", $rule);
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
                $que = $this->db->query("SELECT parent FROM tbl_keputusan");
                $init = $que->result_array();
                $jml = array();
                $exParent = array();
                $i = 0;
                foreach ($init as $row_baris) {
                    $exParent = explode(" AND ", $row_baris['parent']);
                    $jml[$i] = count($exParent);
                    $i++;
                }
                $maxParent = max($jml);
                $sql_query = $this->db->query("SELECT * FROM tbl_keputusan");
                $get = $sql_query->result_array();
                foreach ($get as $row_bar) {
                    $explP = explode(" AND ", $row_bar['parent']);
                    $jmlT = count($explP);
                    if ($jmlT == $maxParent) {
                        $keputusan = $row_bar['keputusan'];
                        $id_rule = $row_bar['id'];
                        $id_rule_keputusan = $row_bar['id'];
                        break;
                    }
                }
            }
        }//end loop t_keputusan

        return array('keputusan' => $keputusan, 'id_rule' => $id_rule_keputusan);
    }
}
