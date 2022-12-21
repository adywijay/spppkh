<?php
$db = $this->db->select('tahun')->get('tbl_hasil_prediksi');
$hasil = $db->result();
?>
<section id="content">
    <div class="container">
        <div class="row">
            <?php echo form_open_multipart('layak'); ?>
            <div class="row">
                <div class="col s12 m12 l3 center">
                    <label for="tahun" class="red-text">&nbsp;</label>
                    <select class="error browser-default validate" name="tahun" placeholder="&nbsp;"/>
                    <option class="center" disabled selected>Pilih Tahun</option>
                    <?php
                    for ($i = date('Y'); $i >= date('Y')-10; $i-= 1) {
                        echo"<option value = '$i'> $i </option>";
                    }
                    ?>
                    </select>   
                </div>
                <div class="input-field col s12 m12 l3 center">
                    <button class="btn waves-effect gradient-45deg-light-blue-cyan center" type="submit" name="submit" style="margin-top: 10px !important;">Tampil</button>  
                </div>
                <div class="input-field col s12 m12 l3">
                </div>
                <div class="input-field col s12 m12 l3">
                </div>
            </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
    <div class="row" style="margin-top:50px;">
        <div class="col s12">
            <div id="table-datatables">
                <table id="data-table-simple" class="centered display" cellspacing="0">
                    <thead class="light-blue lighten-1 white-text">
                    <span class="mdi mdi-cog-counterclockwise" style="margin-left:0px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php $this->db->where('tahun', $this->input->post('tahun'));$this->db->where('keputusan_hasil','YA');echo $this->db->get('tbl_hasil_prediksi')->num_rows(); ?></b></span> 
                    <tr>
                        <th>ID</th>           
                        <th>Nama</th> 
                        <th>Desa</th> 
                        <th>Alamat</th>
                    </tr>
                    </thead>
                    <?php
                    $kondisi = $this->input->post('tahun');
                    if ($kondisi == NULL) {
                        ?>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    <?php } else { ?>
                        <tbody>
                            <?php foreach ($admin as $row): ?>
                                <tr>
                                    <td><?php echo $row->nik; ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->desa; ?></td>
                                    <td><?php echo $row->alamat; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
<!--                        <div class="fixed-action-btn horizontal">
                                <a class="btn-floating btn-large blue blue lighten-1">
                                    <i class="large material-icons">pages</i>
                                </a>
                                <ul>
                                    <li><a class="btn-floating blue tooltipped center" data-position="top" data-delay="50" data-tooltip="Cetak" href="<?php echo base_url();?>print_layak_ok<?php echo"$kondisi"; ?>"><i class="mdi mdi-printer"></i></a></li>
                                </ul>
                            </div>-->
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
</section>

</div>
</div>

