<?php
$ci = get_instance();
?>
<?php
// find loan from each currency
$loans = array();
if (count($loan) !== 0) {
  foreach ($loan as $l) {
    foreach ($ci->saraf->currency() as $key => $value) :
      if ($key == $l['currency']) {
        $loans[$key] = $l['sum_price'];
      }
    endforeach;
  }
}
// end find


?>
<div class="element-box">
  <div class="form-header">
    <div class="row">
      <div class="col-md-12 mb-10">
        <div class="text-left">
          <a href="javascript:void(0)" class="mr-2 mb-2 btn btn-info btn-lg" onclick="chart()">گزارش کلی <i class="fa fa-pie-chart"></i></a>
          <a href="javascript:void(0)" class="mr-2 mb-2 btn btn-success btn-lg" onclick="tables()">حساب های مالی <i class="fa fa-users"></i></a>
          <a href="<?= base_url() . 'admin/reports/' ?>" class="mr-2 mb-2 btn btn-primary btn-lg">گزارشات <i class="os-icon os-icon-newspaper"></i></a>
          <a href="<?= base_url() . 'admin/print_report_all' ?>" target="_blank" class="mr-2 mb-2 btn btn-danger btn-lg" id="print_chart">چاپ <i class="fa fa-print"></i></a>
          <a href="<?= base_url() . 'admin/print_report_dr' ?>" target="_blank" class="mr-2 mb-2 btn btn-danger btn-lg" id="print_users" style="display: none;">چاپ <i class="fa fa-print"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive" id="chart">
    <table class="table table-bordered table-striped">
      <thead>
        <?php foreach ($balances as $currency) : ?>
          <th style="font-size: 2rem;;" colspan="2"><?= $ci->saraf->get_currency($currency['currency']) ?></th>
        <?php endforeach; ?>
      </thead>
      <tbody style="font-size: 1.4rem;">
        <tr>

          <?php foreach ($balances as $currency) : ?>
            <td>
              مجموعه رسیدات <?= $ci->saraf->get_currency($currency['currency']) ?>
            </td>
            <td class="text-center">
              مجموعه بردهای <?= $ci->saraf->get_currency($currency['currency']) ?>
            </td>
          <?php endforeach; ?>

        </tr>
        <tr>

          <?php foreach ($balances as $currencies) : ?>

            <td class="english">
              <?= $currencies['cr'] ?>
            </td>
            <td class="english">
              <?php
              if (isset($loans[$currencies['currency']])) {
                echo number_format($currencies['dr'] + $loans[$currencies['currency']]);
              } else {
                echo number_format($currencies['dr']);
              }
              ?>
            </td>
          <?php endforeach; ?>

        </tr>
        <tr>
          <?php
          if (count($balances) !== 0) {
            $sum = array();
            $sum = array();

            foreach ($balances as $currency) {
              foreach ($ci->saraf->currency() as $key => $value) {
                if ($currency['currency'] == $key) {
                  if (isset($loans[$key])) {
                    $sum[$key] = $currency['cr'] - ($currency['dr'] + $loans[$key]);
                  } else {
                    $sum[$key] = $currency['cr'] - $currency['dr'];
                  }
                }
              }
            }
          } else {
            foreach ($ci->saraf->currency() as $key => $value) {
              $sum[$key] = 0;
            }
          }
          ?>

          <?php foreach ($sum as $key => $value) : ?>
            <td colspan="2" class="english <?= ($value <= 0) ? 'green' : '' ?>"><bdo dir="ltr"><?= number_format($value); ?></bdo></td>
          <?php endforeach; ?>
        </tr>

      </tbody>
    </table>
  </div>
  <div class="table-responsive" id="tables" style="display: none;">
    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">

      <!-- <table class="table table-bordered" id="table"> -->
      <thead>
        <tr>
          <th>
            شماره
          </th>
          <th>
            نام
          </th>
          <th>
            نام پدر
          </th>
          <th>
            واحد پولی
          </th>
          <th>
            مقدار
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $sum_dr_a = 0;
        $i = 1;
        foreach ($opds as $opd) :
          $x = $opd['sum_cr'] - $opd['sum_dr'];
        ?>
          <tr>
            <td class="english">
              <?= $i ?>
            </td>
            <td>
              <?= $opd['name'] ?>
            </td>
            <td>
              <?= $opd['fname'] ?>
            </td>
            <td><?= $ci->saraf->get_currency($opd['currency']) ?></td>
            <td class="english <?= ($x < 0) ? 'red' : '' ?>"><bdo dir="ltr"><?= number_format($x) ?></bdo></td>
          </tr>
          <?php $sum_dr_a += $x;
          $i++; ?>
        <?php

        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

<script>
  function chart() {
    $('#chart').show();
    $('#tables').hide();
    $('#print_chart').show();
    $('#print_users').hide();
  }

  function tables() {
    $('#chart').hide();
    $('#tables').show();
    $('#print_chart').hide();
    $('#print_users').show();

  }
</script>