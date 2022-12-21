<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul>
                    <li style="margin-top:50px !important;margin-left:30px !important;">
                        <a class="btn-floating red accent-2" href="<?php echo base_url('admin/reset_prediksi'); ?>" onclick="return confirm('Yakin ingin me-reset data..&nbsp;?')"><i class="material-icons medium z-depth-2" style="padding-right:1.5px !important;">cached</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:50px;">
        <div class="col s12">
            <div id="table-datatables">
                <table id="data-table-simple" class="centered display" cellspacing="0">
                    <thead class="light-blue lighten-1 white-text">
                    <span class="mdi mdi-cog-counterclockwise" style="margin-left:0px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_hasil_prediksi'); ?></b></span> 
                    <tr>
                        <th>ID</th>           
                        <th>Nama</th> 
                        <th>Desa</th> 
                        <th>Alamat</th>
                        <th>Keputusan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admin as $row): ?>
                            <tr>
                                <td><?php echo $row->nik; ?></td>
                                <td><?php echo $row->nama; ?></td>
                                <td><?php echo $row->desa; ?></td>
                                <td><?php echo $row->alamat; ?></td>
                                <td><?php echo $row->keputusan_hasil; ?></td>
                                <td><a href="<?php echo base_url(); ?>admin/hapus_prediksi/<?php echo $row->id; ?>" onclick="return confirm('Yakin ingin menghapus <?php echo $row->nama;?>&nbsp;?')" class="btn-floating red"><i class="material-icons white-text">delete</i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>

</div>
</div>

