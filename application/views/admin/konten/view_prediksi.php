<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul>
                    <li style="margin-top:50px !important;margin-left:30px !important;">
                        <a class="btn-floating teal accent-4" href="<?php echo base_url('proses_prediksi'); ?>"><i class="material-icons medium z-depth-2" style="padding-right:1.5px !important;">loop</i></a>
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
                    <span class="mdi mdi-cog-counterclockwise" style="margin-left:0px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->where('keputusan_hasil', NULL)->get('tbl_hasil_prediksi')->num_rows(); ?></b></span> 
                    <tr>
                        <th>ID</th>           
                        <th>Nama</th> 
                        <th>Desa</th> 
                        <th>Alamat</th>
                    </tr>
                    </thead>
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
                </table>
            </div>
        </div>
    </div>
</div>
</section>

</div>
</div>

