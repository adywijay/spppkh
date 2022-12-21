<section id="content">
    <div class="container">
        <div class="row">
            <div class="s12" style="margin-top: 20px !important;margin-left: 50px;">
                <div class="container">

                    <?php
                    $base = $this->db->get('tbl_keputusan');
                    $jika = $base->num_rows();
                    if ($jika == 0) {
                        echo "<div id='card-alert' class='card red center'>
                                <div class='card-content white-text'>
                                    <p><i class='material-icons'>error_outline</i>&nbsp; Pohon Keputusan Belum Terbentuk atau Kosong</p>
                                        </div>
                                            </div>";
                    } else {
                        $que_sql = $this->db->query("SELECT id FROM tbl_keputusan");
                        $hasil = $que_sql->result_array();
                        $id = $hasil;
                        //print_r($id[0]);
                        $l = 0;
                        foreach ($hasil as $bar_row) {
                            $id[$l] = $bar_row['id'];
                            $l++;
                        }

                        $query = $this->db->query("SELECT * FROM tbl_keputusan ORDER BY(id)");
                        $a = $query->result_array();
                        $temp_rule = $a;
                        $temp_rule[0] = '';
                        //print_r($temp_rule);
                        $ll = 0; //variabel untuk iterasi id pohon keputusan
                        foreach ($a as $bar) {
                            //menampung rule
                            if ($bar['parent'] != '') {
                                $rule = $bar['parent'] . " AND " . $bar['akar'];
                            } else {
                                $rule = $bar['akar'];
                            }

                            $rule = str_replace("OR", "/", $rule);
                            //explode rule
                            $exRule = explode(" AND ", $rule);
                            $jml_ExRule = count($exRule);

                            //print_r($exRule);
                            $jml_temp = count($temp_rule);
                            //print_r($jml_temp);

                            $i = 0;
                            while ($i < $jml_ExRule) {
                                if ($temp_rule[$i] == $exRule[$i]) {
                                    $temp_rule[$i] = $exRule[$i];
                                    $exRule[$i] = "---- ";
                                } else {
                                    $temp_rule[$i] = $exRule[$i];
                                }

                                if ($i == ($jml_ExRule - 1)) {
                                    $t = $i;
                                    while ($t < $jml_temp) {
                                        $temp_rule[$t] = "";
                                        $t++;
                                    }
                                }

                                //jika terakhir tambah cetak keputusan
                                if ($i == ($jml_ExRule - 1)) {
                                    $strip = '';
                                    for ($x = 1; $x <= $i; $x++) {
                                        $strip = $strip . "---- ";
                                    }
                                    $sql_que = $this->db->query("SELECT keputusan FROM tbl_keputusan WHERE id=$id[$ll]");
                                    $hasil = $sql_que->result_array();
                                    foreach ($hasil as $baris) {
                                        $row_bar = $baris['keputusan'];
                                    }
                                    if (($exRule[$i] - 1) == "---- ") {
                                        echo "<font color='#920'><b>" . $exRule[$i] . "</b></font> <i>Maka Penerimaan = </i><strong>" . $row_bar . " (" . $id[$ll] . ")</strong>";
                                    } else if (($exRule[$i] - 1) != "---- ") {
                                        echo "<br>" . $strip . "<font color='#920'><b>" . $exRule[$i] . "</b></font> <i>Maka Penerimaan = </i><strong>" . $row_bar . "  (" . $id[$ll] . ")</strong>";
                                    }
                                }
                                //jika pertama
                                else if ($i == 0) {
                                    if ($ll == 1) {
                                        echo "<font color='#920'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                                    } else {
                                        echo "<font color='#920'><b>" . $exRule[$i] . " " . "</b></font> <b></b>";
                                    }
                                }
                                //jika ditengah
                                else {
                                    if ($exRule[$i] == "---- ") {
                                        echo $exRule[$i] . " ";
                                    } else {
                                        if (($exRule[$i] - 1) == "---- ") {
                                            echo "<font color='#920'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                                        } else {
                                            $strip = '';
                                            for ($x = 1; $x <= $i; $x++) {
                                                $strip = $strip . "---- ";
                                            }
                                            echo "<br>" . $strip . "<font color='#920'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                                        }
                                    }
                                }
                                $i++;
                            }
                            echo "<br>";
                            $ll++;
                        }
                    }
                    ?>
                    <br/>
                    <br/>
                </div>
            </div>
            <div class="fixed-action-btn horizontal">
                <a class="btn-floating btn-large blue blue lighten-1">
                    <i class="large material-icons">pages</i>
                </a>
                <ul>
                    <li><a class="btn-floating blue tooltipped center" data-position="top" data-delay="50" data-tooltip="Keputusan" href="<?php echo site_url('keputusan');?>"><i class="mdi mdi-file-tree"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
</div>
</div>
<footer class="page-footer light-blue accent-2 col-s12">
    <div class="footer-copyright">
        <div class="container">
            <span class="brand-logo center" style="position: relative;">Copyright ©
                <script type="text/javascript">
                    document.write(new Date().getFullYear("Y"));
                </script></span>
        </div>
    </div>
</footer>