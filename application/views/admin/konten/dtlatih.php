<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <?php echo form_open_multipart('admin/upload_file'); ?>
                <div class="row">
                    <div class="file-field input-field col s6">
                        <input class="file-path validate" type="text" placeholder="Import File Excel (.XLS)"/>
                        <div class="btn gradient-45deg-light-blue-cyan">
                            <input type="file" name="file"/>
                            <span>File</span>
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <button class="btn waves-effect btn-floating teal accent-4 left btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Import" type="submit"><i class="mdi mdi-file-import"></i></button>
                        &nbsp;&nbsp;&nbsp;<a class="btn tooltipped waves-effect btn-floating teal accent-4 center" data-position="bottom" data-delay="50" data-tooltip="Mining" href="<?php echo site_url('mining1/tes'); ?>" target="_blank"><i class="mdi mdi-settings-transfer-outline"></i></a>
                        &nbsp;&nbsp;&nbsp;<a class="btn tooltipped waves-effect btn-floating red center" data-position="right" data-delay="50" data-tooltip="Reset Data" onclick="return confirm('Yakin ingin mereset data&nbsp;?')"><i class="mdi mdi-history"></i></a>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
        <div class="row" style="margin-top:50px;">
            <div class="col s12 m6">
                <div id="table-datatables">
                    <table id="data-table-simple" class="centered display" cellspacing="0">
                        <thead class="light-blue lighten-1 white-text">
                            <span class="mdi mdi-cog-counterclockwise" style="margin-left:0px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_data_latih'); ?></b></span> 
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
                                <th>Keputusan</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($admin as $row): ?>
                                <tr>
                                    <td><?php echo $row->nik;?></td>
                                    <td><?php echo $row->jml_art;?></td>
                                    <td><?php echo $row->jml_keluarga;?></td>
                                    <td><?php echo $row->sta_bangunan;?></td>
                                    <td><?php echo $row->sta_lahan;?></td>
                                    <td><?php echo $row->jns_lantai;?></td>
                                    <td><?php echo $row->jns_dinding;?></td>
                                    <td><?php echo $row->knds_dinding;?></td>
                                    <td><?php echo $row->jns_atap;?></td>
                                    <td><?php echo $row->knds_atap;?></td>
                                    <td><?php echo $row->smb_air_minum;?></td>
                                    <td><?php echo $row->cmdp_air_minum;?></td>
                                    <td><?php echo $row->smb_penerangan;?></td>
                                    <td><?php echo $row->dy_listrik;?></td>
                                    <td><?php echo $row->bb_masak;?></td>
                                    <td><?php echo $row->fasbab;?></td>
                                    <td><?php echo $row->jns_kloset;?></td>
                                    <td><?php echo $row->tp_akhir;?></td>
                                    <td><?php echo $row->sta_art_usaha;?></td>
                                    <td><?php echo $row->sta_kks;?></td>
                                    <td><?php echo $row->sta_kip;?></td>
                                    <td><?php echo $row->sta_kis;?></td>
                                    <td><?php echo $row->sta_bpjsm;?></td>
                                    <td><?php echo $row->sta_jamsotek;?></td>
                                    <td><?php echo $row->sta_asuransi_lain;?></td>
                                    <td><?php echo $row->sta_rasta;?></td>
                                    <td><?php echo $row->sta_kur;?></td>
                                    <td><?php echo $row->sta_keberadaan_art;?></td>
                                    <td><?php echo $row->keputusan_asli;?></td>
                                </tr>
                                <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
</div>

