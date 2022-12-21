<body onload="digi()" class="latar-img">
     <div class="col-s12">
                <?php echo $this->session->flashdata('pesan');?>
            </div>
    <div id="login-page" class="row">
        <p id="tt" class="bold center white-text"></p>
        <div class="col s12 z-depth-4 card-panel light-blue lighten-5 z-depth-5" style="border-radius: 10px;">
             <?php echo validation_errors();?>
             <?php echo form_open_multipart('welcome/validasi');?>
            <div class="login-form">
                <div class="row">
                    <div class="input-field col s12 center">
                        <img clas="logo-img" src="<?php echo base_url();?>template/images/logo/PKH.png">
                        <p class="center login-form-text">Silahkan login dengan akun yang telah didaftarkan</p>
                        <hr>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi mdi-account mdi-36px prefix"></i>
                        <input name="username" type="text" placeholder="Nama Pengguna" class="validate" required>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi mdi-lock prefix"></i>
                        <input name="password" type="password" placeholder="Password" class="validate" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 center-align">
                        <button type="submit" class="btn btn-floating light-blue darken-1"><i class="mdi mdi-account-tie"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>