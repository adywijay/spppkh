<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l9">
                <p style="margin-top:25px;margin-right:20px;">Jumlah Keputusan /<i>(Rule)</i> :&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_keputusan'); ?></b> </p>
                <a class="btn waves-effect gradient-45deg-light-blue-cyan left tooltipped" style="margin-top:25px;margin-right:20px;" data-position="bottom" data-delay="50" data-tooltip="Hapus Keputusan" onclick="return confirm('Yakin ingin mereset data&nbsp;?')" href="<?php echo base_url('admin/reset_keputusan');?>"><i class="mdi mdi-delete-circle"></i> Hapus Keputusan</a>
                <a class="btn waves-effect gradient-45deg-light-blue-cyan left" style="margin-top:25px;margin-right:20px; " href="<?php echo site_url('admin/cek_pra_ujirule');?>"><i class="mdi mdi-hexagon-multiple"></i> Uji Keputusan</a>
                <a class="btn waves-effect gradient-45deg-light-blue-cyan left" style="margin-top:25px;margin-right:20px; " href="<?php echo site_url('tree');?>"><i class="mdi mdi-fullscreen"></i> Detail Keputusan</a>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:50px;">
        <div class="col s12">
            <div id="table-datatables">
                <table id="data-table-simple" class="centered display" cellspacing="0"  style="border-radius: 3px;">
                    <thead class="light-blue lighten-1 white-text">
                        <tr>
                            <th>No</th>
                            <th>Keputusan</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($admin as $row) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="justify">
                                    <?php
                                    echo "IF ";
                                    if ($row->parent != '') {
                                        echo $row->parent . " AND ";
                                    }
                                    echo $row->akar . " THEN Penerimaan = " . $row->keputusan;
                                    ?>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
</section>

