<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="container">
                    <div class="section">
                       	<ul>
                            <li>
                                <a class="btn-floating red accent-4" href="<?php echo base_url('admin/kosongkan_akses'); ?>"onclick="return confirm('Yakin ingin mereset data&nbsp;?')"><i class="material-icons medium z-depth-2 white-text" style="padding-right:2px !important;">history</i></a>
                                <span class="mdi mdi-cog-counterclockwise" style="margin-left: 30px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->db->count_all('tbl_akses'); ?></b></span> 
                            </li>
                        </ul>
                        <div id="table-datatables">
                            <table id="data-table-simple" class="centered display" cellspacing="0">
                                <thead class="light-blue accent-2 white-text">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Akses</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php foreach ($admin as $baris) : ?>
                                    <tbody>
                                        
                                            <td><?php echo $baris->id_akses;?></td>
                                            <td><?php echo $baris->nama_akses;?></td>
                                            <td>
                                                <a href="<?php echo base_url() ?>admin/detail_edit/<?php echo $baris->id_akses; ?>"><i class="mdi mdi-24px mdi-account-edit blue-text"></i></a>
                                                <a href="<?php echo base_url() ?>admin/hapus_akses/<?php echo $baris->id_akses; ?>" onclick="return confirm('Yakin ingin menghapus <?php echo $baris->nama_akses;?>&nbsp;?')"><i class="mdi mdi-24px mdi-account-remove red-text"></i></a>
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
</section>
<section id="content">
    <div class="container">
        <div id="mail-app" class="section"> 
            <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
                <a class="btn-floating btn-large teal accent-4 modal-trigger" href="#modal1">
                    <i class="material-icons">add_circle</i>
                </a>
            </div>
            <div id="modal1" class="modal" style="border-radius:5px;">
                <div class="modal-content">
                    <nav class="light-blue accent-2">
                        <div class="nav-wrapper">
                            <div class="left col s12 m5 l12">
                                <ul>
                                    <li><a href="#!" class="email-menu"><i class="mdi modal-action modal-close  mdi-close"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="model-email-content">
                    <div class="row">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open_multipart('admin/tampil_akses'); ?>
                        <div class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="nama_akses" name="nama_akses" type="text" class="validate" placeholder="&nbsp;">
                                    <label for="nama_akses">Nama Akses</label>
                                </div>
                                <div class="input-field col s12 center">
                                    <button type="submit" class="btn btn-floating teal accent-4"><i class="mdi mdi-content-save-all"></i></button>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
</div>
<footer class="page-footer light-blue accent-2 col-s12">
    <div class="footer-copyright">
        <div class="container">
            <span class="brand-logo center" style="position: relative;">Copyright ©&nbsp;<?php echo(date("Y")); ?></span>
        </div>
    </div>
</footer>