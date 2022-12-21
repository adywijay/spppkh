<section id="content">
    <div class="container">
        <div class="row">
            <?php
            $query = $this->db->query("SELECT * FROM tbl_data_uji");
            $id_rule = array();
            $it = 0;
            $get_data = $query->result_array();
            foreach ($get_data as $bar) {
                $jml_art = $bar['jml_art'];
                $jml_keluarga = $bar['jml_keluarga'];
                $sta_lahan = $bar['sta_lahan'];
                $sta_bangunan = $bar['sta_bangunan'];
                $jns_lantai = $bar['jns_lantai'];
                $jns_dinding = $bar['jns_dinding'];
                $knds_dinding = $bar['knds_dinding'];
                $jns_atap = $bar['jns_atap'];
                $knds_atap = $bar['knds_atap'];
                $smb_air_minum = $bar['smb_air_minum'];
                $cmdp_air_minum = $bar['cmdp_air_minum'];
                $smb_penerangan = $bar['smb_penerangan'];
                $dy_listrik = $bar['dy_listrik'];
                $bb_masak = $bar['bb_masak'];
                $fasbab = $bar['fasbab'];
                $jns_kloset = $bar['jns_kloset'];
                $tp_akhir = $bar['tp_akhir'];
                $sta_art_usaha = $bar['sta_art_usaha'];
                $sta_kks = $bar['sta_kks'];
                $sta_kip = $bar['sta_kip'];
                $sta_kis = $bar['sta_kis'];
                $sta_bpjsm = $bar['sta_bpjsm'];
                $sta_jamsotek = $bar['sta_jamsotek'];
                $sta_asuransi_lain = $bar['sta_asuransi_lain'];
                $sta_rasta = $bar['sta_rasta'];
                $sta_kur = $bar['sta_kur'];
                $sta_keberadaan_art = $bar['sta_keberadaan_art'];

                $sql = $this->db->query("SELECT * FROM tbl_keputusan");
                $base = $sql->result_array();
                $keputusan = "";
                foreach ($base as $row) {
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
                        }
                        $a++;
                    }
                    if ($boolRule == "Benar") {
                        $keputusan = $row['keputusan'];
                        $id_rule[$it] = $row['id'];
                    }
                    if ($keputusan == '') {
                        $que = $this->db->query("SELECT parent FROM tbl_keputusan");
                        $jml = array();
                        $exParent = array();
                        $i = 0;
                        $sql = $que->result_array();
                        foreach ($sql as $row_baris) {
                            $exParent = explode(" AND ", $row_baris['parent']);
                            $jml[$i] = count($exParent);
                            $i++;
                        }
                        $maxParent = max($jml);
                        $sql_query = $this->db->query("SELECT * FROM tbl_keputusan");
                        $data = $sql_query->result_array();
                        foreach ($data as $row_bar) {
                            $explP = explode(" AND ", $row_bar['parent']);
                            $jmlT = count($explP);
                            if ($jmlT == $maxParent) {
                                $keputusan = $row_bar['keputusan'];
                                //print_r($keputusan);
                                $id_rule[$it] = $row_bar['id'];
                            }
                        }
                    }
                }
                $it++;
                $this->db->query("UPDATE tbl_data_uji SET keputusan_hasil='$keputusan' WHERE id=" . $bar['id'] . "");
            }
            ?>
            <div class="row" style="margin-top:50px !important;">
                <div class="s12" style="margin-top: 20px !important;margin-left:20px !important;">
                    <div id="table-datatables">
                        <table id="data-table-simple" class="centered display" cellspacing="0">
                            <thead class="light-blue lighten-1 white-text">
                            <span class="mdi mdi-cog-counterclockwise" style="margin-left:0px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_data_uji'); ?></b></span> 
                            <tr>
                                <th>ID</th>           
                                <th>JART</th> 
                                <th>JK</th> 
                                <th>STBN</th> 
                                <th>STLN</th> 
                                <th>LI</th> 
                                <th>DG</th> 
                                <th>KIDG</th> 
                                <th>AP</th> 
                                <th>KAP</th> 
                                <th>SAM</th> 
                                <th>CPAM</th> 
                                <th>SPN</th> 
                                <th>DA</th> 
                                <th>BBMK</th> 
                                <th>FBB</th> 
                                <th>KLT</th> 
                                <th>BTA</th> 
                                <th>SARTU</th> 
                                <th>SKKS</th> 
                                <th>SKIP</th> 
                                <th>SKIS</th> 
                                <th>SBPJSM</th> 
                                <th>SJSK</th> 
                                <th>SAL</th> 
                                <th>SRA</th> 
                                <th>SKUR</th> 
                                <th>SKRT</th> 
                                <th>Keputusan_Asli</th>
                                <th>Keputusan_Prediksi</th>
                                <th>Id_rule</th>
                                <th>Ketepatan</th>
                                </thead>
                            <tbody>
                                <?php
                                foreach ($admin as $row) {
                                    $no = 1;
                                    if ($row->keputusan_asli == $row->keputusan_hasil) {
                                        $ketepatan = "Benar";
                                    } else {
                                        $ketepatan = "Salah";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $row->nik; ?></td>
                                        <td><?php echo $row->jml_art; ?></td>
                                        <td><?php echo $row->jml_keluarga; ?></td>
                                        <td><?php echo $row->sta_bangunan; ?></td>
                                        <td><?php echo $row->sta_lahan; ?></td>
                                        <td><?php echo $row->jns_lantai; ?></td>
                                        <td><?php echo $row->jns_dinding; ?></td>
                                        <td><?php echo $row->knds_dinding; ?></td>
                                        <td><?php echo $row->jns_atap; ?></td>
                                        <td><?php echo $row->knds_atap; ?></td>
                                        <td><?php echo $row->smb_air_minum; ?></td>
                                        <td><?php echo $row->cmdp_air_minum; ?></td>
                                        <td><?php echo $row->smb_penerangan; ?></td>
                                        <td><?php echo $row->dy_listrik; ?></td>
                                        <td><?php echo $row->bb_masak; ?></td>
                                        <td><?php echo $row->fasbab; ?></td>
                                        <td><?php echo $row->jns_kloset; ?></td>
                                        <td><?php echo $row->tp_akhir; ?></td>
                                        <td><?php echo $row->sta_art_usaha; ?></td>
                                        <td><?php echo $row->sta_kks; ?></td>
                                        <td><?php echo $row->sta_kip; ?></td>
                                        <td><?php echo $row->sta_kis; ?></td>
                                        <td><?php echo $row->sta_bpjsm; ?></td>
                                        <td><?php echo $row->sta_jamsotek; ?></td>
                                        <td><?php echo $row->sta_asuransi_lain; ?></td>
                                        <td><?php echo $row->sta_rasta; ?></td>
                                        <td><?php echo $row->sta_kur; ?></td>
                                        <td><?php echo $row->sta_keberadaan_art; ?></td>
                                        <td><?php echo $row->keputusan_asli; ?></td>
                                        <td><?php echo $row->keputusan_hasil; ?></td>
                                        <td><?php echo $id_rule[$no - 1]; ?></td>
                                        <td>
                                            <?php
                                            if ($ketepatan == 'Salah') {
                                                echo "<b>" . $ketepatan . "</b>";
                                            } else {
                                                echo $ketepatan;
                                            }
                                            ?>
                                        </td>

                                    </tr>
                                    <?php $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
//perhitungan akurasi
            $que = $this->db->query("SELECT * FROM tbl_data_uji");
            $jumlah = $que->num_rows();
            $get = $que->result_array();
            $TP = 0;
            $FN = 0;
            $TN = 0;
            $FP = 0;
            $kosong = 0;
            foreach ($get as $row) {
                $asli = $row['keputusan_asli'];
                $prediksi = $row['keputusan_hasil'];
                if ($asli == 'YA' & $prediksi == 'YA') {
                    $TP++;
                } else if ($asli == 'YA' & $prediksi == 'TIDAK') {
                    $FN++;
                } else if ($asli == 'TIDAK' & $prediksi == 'TIDAK') {
                    $TN++;
                } else if ($asli == 'TIDAK' & $prediksi == 'YA') {
                    $FP++;
                } else if ($prediksi == '') {
                    $kosong++;
                }
            }
            $tepat = ($TP + $TN);
            $tidak_tepat = ($FP + $FN + $kosong);
            $akurasi = (($tepat / $jumlah) * 100);
            $laju_error = (($tidak_tepat / $jumlah) * 100);
            $sensitivitas = (($TP / ($TP + $FN)) * 100);
            $spesifisitas = (($TN / ($FP + $TN)) * 100);

            $akurasi = round($akurasi, 2);
            $laju_error = round($laju_error, 2);
            $sensitivitas = round($sensitivitas, 2);
            $spesifisitas = round($spesifisitas, 2);


    echo "<center><h4>";
    echo "Jumlah data yang diprediksi: $jumlah<br>";
    echo "Jumlah data yang diprediksi tepat: $tepat<br>";
    echo "Jumlah data yang diprediksi tidak tepat: $tidak_tepat<br>";
            if ($kosong != 0) {
                echo "Jumlah data yang prediksinya kosong: $kosong<br></h4>";
            }
            echo "<h2>AKURASI = $akurasi %<br>";
            echo "LAJU ERROR = $laju_error %<br></h2>";
            echo "<h4>TP: $TP | TN: $TN | FP: $FP | FN: $FN<br></h4>";
            echo "<h2>SENSITIVITAS = $sensitivitas %<br>";
            echo "SPESIFISITAS = $spesifisitas %<br>";
            echo "</h2></center>";
 
            ?>   

        </div>
    </div>



</section>
</div>
</div>
<!--<footer class="page-footer light-blue accent-2 col-s12">
    <div class="footer-copyright">
        <div class="container">
            <span class="brand-logo center" style="position: relative;">Copyright ©
                <script type="text/javascript">
                    document.write(new Date().getFullYear("Y"));
                </script></span>
        </div>
    </div>
</footer>-->