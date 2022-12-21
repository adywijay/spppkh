<!-- START CONTENT -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="container">
                    <div class="section">
                       	<ul>
                            <li>
                                <a class="btn-floating teal accent-4" href="<?php echo base_url('tambah_akun'); ?>"><i class="material-icons medium z-depth-2" style="padding-right:5px !important;">person_add</i></a>
                                <a class="btn-floating red accent-4" href="<?php echo base_url('admin/kosongkan_akun'); ?>"onclick="return confirm('Yakin ingin mereset data akun&nbsp;?')"><i class="material-icons medium z-depth-2 white-text" style="padding-right:2px !important;">history</i></a>
                                <span class="mdi mdi-cog-counterclockwise" style="margin-left: 30px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_akun'); ?></b></span> 
                            </li>
                        </ul>
                        <div id="table-datatables">
                            <table id="data-table-simple" class="centered display" cellspacing="0">
                                <thead class="light-blue lighten-1 white-text">
                                    <tr>
                                        <th>No</th>
                                        <th>Hak Akses</th>
                                        <th>Nama</th>
                                        <th>Token</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                foreach ($admin as $b) {
                                if ($b->id_akun!=$this->session->userdata('id_akun')){   
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td>
                                            <?php
                                            if($b->id_akses == 1){
                                                echo '<b class="red-text">'.'Surveyer'.'</b>';
                                            }elseif($b->id_akses == 2) {
                                                echo '<b class="red-text">'.'Operator'.'</b>';
                                            }elseif($b->id_akses == 3) {
                                                echo '<b class="red-text">'.'Administrator'.'</b>';
                                            }
                                            //echo $b->id_akses; 
                                            ?>
                                        </td>
                                        <td><?php echo $b->nama;?></td>
                                        <td><?php echo $b->token;?></td>
                                        <td>
                                            <?php
                                            $c = $b->status;
                                            if($c==0){
                                                echo '<b class="red-text">'.'Non Validasi'.'</b>';   
                                            }
                                            if($c==1){
                                                echo '<b class="green-text">'.'Tervalidasi'.'</b>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php base_url();?>edit_akun/<?php echo $b->id_akun; ?>"><i class="mdi mdi-24px mdi-comment-edit blue-text"></i></a>
                                            <a href="<?php base_url();?>admin/hapus_akun/<?php echo $b->id_akun; ?>" onclick="return confirm('Yakin ingin menghapus <?php echo $b->nama;?>&nbsp;?')"><i class="mdi mdi-24px mdi-delete red-text"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                $i++;
                                }}
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
