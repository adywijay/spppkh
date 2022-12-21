</body>

</html>
<!-- END FOOTER -->
<script type="text/javascript" src="<?php echo base_url();?>template/vendors/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/js/custom-script.js"></script>
<script type="text/javascript">
    function digi() {
  var date = new Date(),
      hour = date.getHours(),
      minute = checkTime(date.getMinutes()),
      ss = checkTime(date.getSeconds());

  function checkTime(i) {
    if( i < 10 ) {
      i = "0" + i;
    }
    return i;
  }

if ( hour > 12 ) {
  hour = hour - 12;
  if ( hour == 12 ) {
    hour = checkTime(hour);
  document.getElementById("tt").innerHTML = hour+":"+minute+":"+ss+" AM";
  }
  else {
    hour = checkTime(hour);
    document.getElementById("tt").innerHTML = hour+":"+minute+":"+ss+" PM";
  }
}
else {
  document.getElementById("tt").innerHTML = hour+":"+minute+":"+ss+" AM";;
}
var time = setTimeout(digi,1000);
}
</script>