<body onload="digi()" class="latar-img">
    <div id="login-page" class="row">
        <p id="tt" class="bold center white-text"></p>
        <div class="col s12 z-depth-4 card-panel light-blue lighten-5 z-depth-5" style="border-radius: 10px;">
            <form class="login-form">
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
                        <input id="username" type="text" placeholder="&nbsp;" required="required" class="validate">
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi mdi-lock prefix"></i>
                        <input id="password" type="password" placeholder="&nbsp;" required="required" class="validate">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 center-align">
                        <input type="submit" value="Masuk" class="btn waves-effect gradient-45deg-light-blue-cyan">
                    </div>
                </div>
            </form>
        </div>
    </div>