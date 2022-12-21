<!-- START CONTENT -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="container">
                    <div class="section">
                       	<ul>
                            <li>
                                <span class="mdi mdi-cog-counterclockwise" style="margin-left: 30px !important;">Total Data :&nbsp;&nbsp;&nbsp;<b class="red-text"><?php echo $this->akun_model->count_petugas_sv(); ?></b></span> 
                            </li>
                        </ul>
                        <div id="table-datatables">
                            <table id="data-table-simple" class="centered display" cellspacing="0">
                                <thead class="blue lighten-2 white-text">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>No.Telp</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($operator as $kolom) :
                                    ?>
                                <tbody class="white">
                                        <tr>
                                            <td><?php echo $kolom->id_akun; ?></td>
                                            <td><?php echo $kolom->nama; ?></td>
                                            <td><?php echo $kolom->no_telp; ?></td>
                                            <td><?php echo $kolom->jabatan; ?></td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    endforeach;
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
