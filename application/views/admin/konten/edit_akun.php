<div class="card-panel">
    <div class="row">
        <div class="col s12 m4 l3"></div>
        <div class="col s12 m12 l6">
            <ul id="task-card" class="collection with-header" style="border-radius:9px;">
                <li class="collection-header light-blue accent-2">
                    <h4 class="task-card-title center">Form Perubahan Akun</h4>
                </li>
                 <?php echo form_open_multipart('admin/ubah_akun');?>
                    <div class="row">
                        <br/>
                        <div class="disabled col s12">
                            <label for="id_akun" class="red-text">ID Akun *</label>
                            <input name="id_akun" type="text" placeholder="&nbsp;" class="validate" value="<?php echo $admin['id_akun'];?>" disabled/>
                        </div>
                        <div class="input-field col s12">
                            <label for="nama" class="red-text">Nama Lengkap *</label>
                            <input name="nama" type="text" placeholder="&nbsp;" class="validate" value="<?php echo $admin['nama'];?>"/>
                        </div>
                        <div class="input-field col s12">
                            <label for="username"class="red-text">Username *</label>
                            <input type="text" name="username" placeholder="&nbsp;" class="validate" value="<?php echo $admin['username'];?>"/>
                        </div>
                         <?php
                        $a = date("iszA");
                        ?>
                        <div class="col s12">
                            <label class="black-text">Password Anda &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><h6 class="gradient-45deg-purple-light-blue center"><?php echo"$a"; ?></h6></b></label>
                        </div>
                        <div class="input-field col s12">
                            <label for="token" class="red-text">Password *</label>
                            <input type="text" name="token" placeholder="&nbsp;" class="validate" value="<?php echo $admin['token'];?>"/>
                        </div>
                        <div class="input-field col s12">
                            <label for="retype_password" class="red-text">Retype Password *</label>
                            <input type="password" name="retype_password" placeholder="&nbsp;" class="validate"/>
                        </div>
                        <div class="input-field col s12">
                            <label for="no_telp" class="red-text">No.Telp Aktif *</label>
                            <input type="text" name="no_telp" placeholder="&nbsp;" class="validate"  value="<?php echo $admin['no_telp'];?>"/>
                        </div>
                        <div class="input-field col s12">
                            <label for="curl" class="red-text">Jabatan *</label>
                            <input type="text" name="jabatan" placeholder="&nbsp;" value="<?php echo $admin['jabatan'];?>"/>
                        </div>
                        <div class="col s12">
                            <label for="id_akses" class="red-text">Hak Akses *</label>
                            <select class="error browser-default validate" name="id_akses" placeholder="&nbsp;"/>
                            <option value="1" <?php if ($admin['id_akses'] == 1) {
                                echo "selected";
                            }; ?>>Surveyer</option>
                            <option value="2" <?php if ($admin['id_akses'] == 2) {
                                echo "selected";
                            }; ?>>Operator</option>
                            <option value="3" <?php if ($admin['id_akses'] == 3) {
                                echo "selected";
                            }; ?>>Administrator</option>
                            </select>
                        </div>
                         <div class="divider"></div>
                        <div class="row">
                            <div class="col s12 m6 center">
                                <input type="file" name="userfile" id="input-file-now" class="dropify" placeholder="Pilih Foto Apabila Ingin Merubah"/>
                            </div>
                            <div class="col s12 m6 center">
                                <p class="center red-text">pas photo 3 X 4 * </p>
                                <blockquote class="left">ukuran <b>max 2 mb</b></blockquote>
                            </div>
                            <br/>
                            <div class="col s12" style="margin-top:20px;">
                                <label for="status" class="red-text">Status *</label>
                                <p>
                                    <input name="status" type="radio" id="non_aktif" value="0"<?php echo $admin['status'];?> class="validate" checked=""/>
                                    <label for="non_aktif">Non.Aktif</label>
                                </p>
                                <p>
                                    <input name="status" type="radio" id="aktif"  value="1"<?php echo $admin['status'];?> class="validate"/>
                                    <label for="aktif">Aktif</label>
                                </p>
                            </div>
                        </div>
                        <div class="input-field col s8">
                            <button class="btn waves-effect gradient-45deg-light-blue-cyan right" type="submit" name="action">Simpan</button>
                        </div>
                    </div>
                 <?php
                 echo form_close();
                 ?>
            </ul>
        </div>
    </div>
    <div class="col s12 m4 l3"></div>
</div>
</div>
</div>
