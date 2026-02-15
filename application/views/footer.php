<!--------------------
              START - Chat Popup Box
              -------------------->
<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
  (function() {
    var s1 = document.createElement("script"),
      s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/5ebc47f2967ae56c521986b2/default';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();
</script>
 -->
<!--End of Tawk.to Script-->
<!--------------------
              END - Chat Popup Box
              -------------------->
</div>
</div>
</div>
</div>
<div class="display-type"></div>
</div>
<script src="<?= base_url() . 'assets/' ?>bower_components/jquery/dist/jquery.min.js"></script>

<!-- <script src="<?= base_url() . 'assets/' ?>bower_components\datePickerJalali\dist\kamadatepicker.min.js"></script> -->

<script type="text/javascript" src="https://canin-cdn.cyborgtech.co/assets/plugins/jalalidatepicker/jalalidatepicker.min.js"></script>


<script src="<?= base_url() . 'assets/' ?>bower_components/popper.js/dist/umd/popper.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/moment/moment.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/chart.js/dist/Chart.min.js"></script>


<script src="https://canin-cdn.cyborgtech.co/assets/plugins/select2/select2.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/ckeditor/ckeditor.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap-validator/dist/validator.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/dropzone/dist/dropzone.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/editable-table/mindmup-editabletable.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/tether/dist/js/tether.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/slick-carousel/slick/slick.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/util.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/alert.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/button.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/carousel.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/collapse.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/dropdown.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/modal.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/tab.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/tooltip.js"></script>

<script src="<?= base_url() . 'assets/' ?>bower_components/bootstrap/js/dist/popover.js"></script>

<script src="<?= base_url() . 'assets/' ?>js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() . 'assets/' ?>js/demo_customizer.js?version=4.4.0"></script>

<!-- Pnotify -->
<script src="<?= base_url() ?>assets/js/pnotify.js"></script>

<script src="<?= base_url() ?>assets/js/pnotify.buttons.js"></script>

<script src="<?= base_url() ?>assets/js/pnotify.nonblock.js"></script>


<script src="<?= base_url() . 'assets/' ?>js/main.js?version=4.4.0"></script>

<script src="<?= base_url() . 'assets/' ?>js/custom.js?version=4.4.0"></script>


<script>
  <?php if (isset($_SESSION['er_msg'])) : ?>
    init_PNotify("خطا!", "<?= $_SESSION['er_msg'] ?>", "error");
  <?php endif; ?>
</script>

<?php if (isset($script)) : ?>
  <script>
    <?= $script ?>
  </script>
<?php endif; ?>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
  (function() {
    var s1 = document.createElement("script"),
      s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/662df2e9a0c6737bd131ceda/1hshnpoq4';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();
</script>
<!--End of Tawk.to Script-->

</body>

</html>