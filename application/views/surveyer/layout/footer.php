<!-- START FOOTER -->
<footer class="page-footer fixed light-blue accent-2">
    <div class="footer-copyright">
        <div class="container">
            <span class="brand-logo center" style="position: relative;">Copyright © <?php echo (date("Y")); ?></span>
        </div>
    </div>
</footer>
</body>
</html>
<!-- END FOOTER -->
<!-- jQuery Library -->
<script type="text/javascript" src="<?php echo base_url();?>template/vendors/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/plugin/materialize/initial.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/js/custom-script.js"></script>
<!-- plug -->
    <script type="text/javascript" src="<?php echo base_url();?>template/js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>template/js/plugins/chartjs/chartjs-sample-chart.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>template/js/plugins/stepper/js/mstepper.min.js"></script>
<!-- end -->
<!-- data table -->
<script type="text/javascript" src="<?php echo base_url();?>template/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/js/plugins/data-tables/data-tables-script.js"></script>
<!-- end -->
<script type="text/javascript">
 var stepper = document.querySelector('.stepper');
   var stepperInstace = new MStepper(stepper, {
      // options
      firstActive: 0 // this is the default
   })
</script>
