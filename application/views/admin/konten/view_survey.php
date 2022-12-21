<!-- START CONTENT -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="container">
                    <div class="section">
                       	<ul>
                            <li>
                                <a class="btn-floating teal accent-4" href="<?php echo base_url('tambah_master'); ?>"><i class="material-icons medium z-depth-2" style="padding-right: 5px !important;">person_add</i></a>
                                <a class="btn-floating red accent-4" href="<?php echo base_url('admin/kosongkan_survey'); ?>"onclick="return confirm('Yakin ingin mereset data&nbsp;?')"><i class="material-icons medium z-depth-2 white-text" style="padding-right:2px !important;">history</i></a>
                                <span class="mdi mdi-cog-counterclockwise" style="margin-left: 30px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_master'); ?></b></span> 
                            </li>
                        </ul>
                        <div id="table-datatables">
                            <table id="data-table-simple" class="centered display" cellspacing="0">
                                <thead class="blue lighten-2 white-text">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Desa</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                foreach ($admin as $kolom) {
                                    ?>
                                <tbody class="white">
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $kolom->nama; ?></td>
                                            <td><?php echo $kolom->desa; ?></td>
                                            <td><?php echo $kolom->alamat; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/detail_survey/<?php echo $kolom->id; ?>"><i class="mdi mdi-24px mdi-eye green-text"></i></a>
                                                <a href="<?php echo base_url(); ?>admin/hapus_survey/<?php echo $kolom->id; ?>" onclick="return confirm('Yakin ingin menghapus <?php echo $kolom->nama;?>&nbsp;?')"><i class="mdi mdi-24px mdi-account-remove red-text"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTENT -->
</div>
</div>
