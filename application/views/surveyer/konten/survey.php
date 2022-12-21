<!-- START CONTENT -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="container">
                    <div class="section">
                       	<ul>
                            <li>
                                <a class="btn-floating teal accent-4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Tambah Survey" href="<?php echo base_url('survey'); ?>"><i class="material-icons medium z-depth-2" style="padding-right: 5px !important;">person_add</i></a>
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
                                foreach ($surveyer as $kolom) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $kolom->nama; ?></td>
                                            <td><?php echo $kolom->desa; ?></td>
                                            <td><?php echo $kolom->alamat; ?></td>
                                            <td>
                                                <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Lihat Detail" href="<?php echo base_url() ?>surveyer/detail_survey/<?php echo $kolom->id; ?>"><i class="mdi mdi-24px mdi-eye blue-text"></i></a>
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
