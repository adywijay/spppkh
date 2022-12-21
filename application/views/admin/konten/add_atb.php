<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <?php echo form_open_multipart('admin/cek'); ?>
                <div class="row">
                    <div class="file-field input-field col s6">
                        <input class="file-path validate" type="text" placeholder="Import File Excel (.XLS)"/>
                        <div class="btn gradient-45deg-light-blue-cyan">
                            <input type="file" name="file"/>
                            <span>File</span>
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <button class="btn waves-effect btn-floating teal accent-4 left btn tooltipped"data-position="bottom" data-delay="50" data-tooltip="Import" type="submit"><i class="mdi mdi-file-import"></i></button>
                        &nbsp;&nbsp;&nbsp;<a class="btn tooltipped waves-effect btn-floating teal accent-4 center" data-position="bottom" data-delay="50" data-tooltip="Mining" href="<?php echo site_url('admin/dtree'); ?>"><i class="mdi mdi-settings-transfer-outline"></i></a>
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
                                <th>Atribut</th> 
                                <th>Nilai Atribut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admin as $x) : ?>
                                <tr>
                                    <td><?php echo $x->id; ?></td>
                                    <td><?php echo $x->atribut; ?></td>
                                    <td><?php echo $x->nilai_atribut; ?></td>
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

