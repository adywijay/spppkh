<!-- START CONTENT -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="container">
                    <div class="section">
                       	<ul>
                            <li>
                                <a class="btn-floating teal accent-4" href="<?php echo base_url(); ?>admin/tambah_atribut"><i class="material-icons medium z-depth-2" style="padding-right:2px !important;">add_circle_outline</i></a>
                                <a class="btn-floating red white-text" href="<?php echo base_url(); ?>admin/kosongkan_atribut"onclick="return confirm('Yakin ingin mereset data&nbsp;?')"><i class="material-icons medium z-depth-2" style="padding-right:1px !important;">history</i></a>
                                <span class="mdi mdi-cog-counterclockwise" style="margin-left: 30px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_atribut'); ?></b></span> 
                            </li>

                        </ul>
                        <div id="table-datatables">
                            <table id="data-table-simple" class="centered display" cellspacing="0">
                                <thead class="light-blue accent-2 white-text">
                                    <tr>
                                        <th>Id</th>
                                        <th>Atribut</th>
                                        <th>Nilai Atribut</th>
                                        <th>Ket Nilai</th>
                                        <th>Aktif</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php foreach ($admin as $baris) : ?>
                                    <tbody>
                                        
                                            <td><?php echo $baris->id;?></td>
                                            <td><?php echo $baris->atribut;?></td>
                                            <td><?php echo $baris->nilai_atribut;?></td>
                                            <td><?php echo $baris->ket_nilai;?></td>
                                            <td><?php echo $baris->aktif;?></td>
                                            <td><?php echo $baris->status;?></td>
                                            <td>
                                                    <a href="<?php echo base_url() ?>admin/edit_atribut/<?php echo $baris->id;?>"><i class="mdi mdi-24px mdi-comment-edit blue-text"></i></a>
                                                    <a href="<?php echo base_url() ?>admin/hapus_atribut/<?php echo $baris->id;?>"><i class="mdi mdi-24px mdi-delete blue-text"></i></a>
                                            </td>
                                        
                                    </tbody>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
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
