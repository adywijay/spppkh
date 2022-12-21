<div class="card-panel">
    <div class="row">
        <div class="col s12 m4 l3"></div>
        <div class="col s12 m12 l6">
            <ul id="task-card" class="collection with-header" style="border-radius:9px;">
                <li class="collection-header light-blue accent-2">
                    <h4 class="task-card-title center">Form Penambahan Atribut</h4>
                </li>
                <?php echo validation_errors(); ?>
                <?php echo form_open_multipart('admin/tambah_atribut'); ?>
                <div class="row">
                    <br/>
                    <div class="input-field col s12">
                        <label class="red-text">Atribut *</label>
                        <input name="atribut" type="text" placeholder="&nbsp;">
                    </div>
                    <div class="input-field col s12">
                        <label class="red-text">Nilai Atribut *</label>
                        <input name="nilai_atribut" type="text" placeholder="&nbsp;">
                    </div>
                    <div class="input-field col s12">
                        <label class="red-text">Keterangan Nilai *</label>
                        <input name="ket_nilai" type="text" placeholder="&nbsp;">
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l3">
                            <label class="red-text">Atribut Aktif...? *</label>
                            <p>
                                <input type="radio" id="y" name="aktif" value="y" />
                                <label for="y">Ya</label>
                            </p>
                            <p>
                                <input type="radio" id="t" name="aktif" value="t" />
                                <label for="t">Tidak</label>
                            </p>
                        </div>
                        <div class="col s12 m6 l3">
                            <label class="red-text">Status Atribut</label>
                            <p>
                                <input type="radio" id="label" name="status" value="label" />
                                <label for="label">Label</label>
                            </p>
                            <p>
                                <input type="radio" id="non_label" name="status" value="non_label" checked />
                                <label for="non_label">Non.Label</label>
                            </p>
                        </div>
                    </div>
                    <div class="input-field col s8">
                        <button class="btn waves-effect gradient-45deg-light-blue-cyan right" type="submit" name="action">Simpan</button>
                    </div>
                </div>
                </form>
            </ul>
        </div>
    </div>
    <div class="col s12 m4 l3"></div>
</div>
</div>
</div>
<footer class="page-footer light-blue accent-2 col-s12">
    <div class="footer-copyright">
        <div class="container">
            <span class="brand-logo center" style="position: relative;">Copyright ©
                <script type="text/javascript">
                    document.write(new Date().getFullYear());
                </script></span>
        </div>
    </div>
</footer>