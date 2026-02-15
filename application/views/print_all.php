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

<html>

<head>
  <title><?= (isset($title)) ? $title : 'سایبورگ تک' ?></title>
  <link href="<?= base_url() . 'assets/' ?>favicon.png" rel="shortcut icon">

  <link rel="stylesheet" href="<?= base_url() ?>assets/css/rtl.css">
  <link rel="stylesheet" href="">
  <style>
    body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #FAFAFA;
      font: 12pt "Tahoma";
    }

    .page {
      /* min-height: 217.47mm; */
      width: 100%;
      /* padding: 5mm 20mm 5mm 5mm; */
      /* margin: 0mm auto; */
      border: 1px #D3D3D3 solid;
      background: white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
      /* padding: 1cm; */
      /* border: 5px red solid; */
      height: fit-content;
    }

    .company-extra.text-right {
      margin-right: 5px;
    }

    /* our custom css start here */
    .invoice-w {
      max-width: 100%;
      position: relative;
      overflow: hidden;
    }

    .invoice-w,
    .invoice-heading,
    .invoice-body,
    .invoice-footer {
      text-align: right;
      padding: 0 13px;
    }

    .invoice-w .infos {
      position: relative;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
      text-align: center;
    }

    .invoice-w .infos .info-1 {
      font-size: 1rem;
      width: 100%;
    }

    .invoice-w .infos .info-1 .company-name {
      font-size: 1.8rem;
      font-weight: 900;
    }

    .invoice-w .infos .info-1 .company-extra {
      /* font-size: 6rem; */
      color: black;
      /* margin-top: 1rem; */
    }

    .text-center {
      text-align: center !important;
    }

    .invoice-heading {
      border-top: solid;
      margin: 1rem 0;
      position: relative;
      z-index: 2;
    }

    /* h3,
		.h3,
		.invoice-date,
		.table.table-lightfont td,
		.form-group,
		.btn {
			font-size: 1.9rem;
			font-weight: 900;
		} */

    .invoice-date {
      direction: ltr;
    }

    .text-right {
      text-align: right !important;
    }

    .text-left {
      text-align: left !important;
    }

    .invoice-body {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
    }

    .invoice-table {
      width: 100%;
    }

    .important {
      z-index: 2;
    }

    .row {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      /* margin-right: -10px;
			margin-left: -10px; */
    }

    .col-md-12 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 100%;
      flex: 0 0 100%;
      max-width: 100%;
    }

    .col-1,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-10,
    .col-11,
    .col-12,
    .col,
    .col-auto,
    .col-sm-1,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-sm,
    .col-sm-auto,
    .col-md-1,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-md,
    .col-md-auto,
    .col-lg-1,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-lg,
    .col-lg-auto,
    .col-xl-1,
    .col-xl-2,
    .col-xl-3,
    .col-xl-4,
    .col-xl-5,
    .col-xl-6,
    .col-xl-7,
    .col-xl-8,
    .col-xl-9,
    .col-xl-10,
    .col-xl-11,
    .col-xl-12,
    .col-xl,
    .col-xl-auto,
    .col-xxl-1,
    .col-xxl-2,
    .col-xxl-3,
    .col-xxl-4,
    .col-xxl-5,
    .col-xxl-6,
    .col-xxl-7,
    .col-xxl-8,
    .col-xxl-9,
    .col-xxl-10,
    .col-xxl-11,
    .col-xxl-12,
    .col-xxl,
    .col-xxl-auto,
    .col-xxxl-1,
    .col-xxxl-2,
    .col-xxxl-3,
    .col-xxxl-4,
    .col-xxxl-5,
    .col-xxxl-6,
    .col-xxxl-7,
    .col-xxxl-8,
    .col-xxxl-9,
    .col-xxxl-10,
    .col-xxxl-11,
    .col-xxxl-12,
    .col-xxxl,
    .col-xxxl-auto,
    .col-xxxxl-1,
    .col-xxxxl-2,
    .col-xxxxl-3,
    .col-xxxxl-4,
    .col-xxxxl-5,
    .col-xxxxl-6,
    .col-xxxxl-7,
    .col-xxxxl-8,
    .col-xxxxl-9,
    .col-xxxxl-10,
    .col-xxxxl-11,
    .col-xxxxl-12,
    .col-xxxxl,
    .col-xxxxl-auto {
      position: relative;
      width: 100%;
      min-height: 1px;
      /* padding-right: 10px;
			padding-left: 10px; */
    }

    table tr td {
      text-align: center;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      font-weight: 900;
      border: 2px solid black;
      text-align: center;
      padding: 5px;
    }

    /* .element-wrapper {
			padding-bottom: 3rem;
		} */

    /* .element-box,
		.invoice-w,
		.big-error-w {
			padding: 1.5rem 1.5rem;
			margin-bottom: 1rem;
		} */

    h3,
    .h3,
    .invoice-date,
    .table.table-lightfont td,
    .form-group,
    .btn {
      font-size: 1rem;
      font-weight: 900;
    }

    /* .border-bottom {
			padding-bottom: 30px;
		} */


    tr.no-border td,
    tr.no-border th {
      border: none !important;
    }

    .col-md-2 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 16.6666666667%;
      flex: 0 0 16.6666666667%;
      max-width: 16.6666666667%;
    }

    .col-md-3 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 25%;
      flex: 0 0 25%;
      max-width: 25%;
    }

    .col-md-4 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 33.3333333333%;
      flex: 0 0 33.3333333333%;
      max-width: 33.3333333333%;
    }

    .col-md-8 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 66.6666666667%;
      flex: 0 0 66.6666666667%;
      max-width: 66.6666666667%;
    }

    .full-width {
      width: 100%;
    }

    .red {
      color: red;
    }

    p {
      margin-top: 0;
      margin-bottom: 1rem;
    }

    .col-md-5 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 41.6666666667%;
      flex: 0 0 41.6666666667%;
      max-width: 41.6666666667%;
    }

    .col-md-7 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 58.3333333333%;
      flex: 0 0 58.3333333333%;
      max-width: 58.3333333333%;
    }

    .col-md-6 {
      -webkit-box-flex: 0;
      -ms-flex: 0 0 50%;
      flex: 0 0 50%;
      max-width: 50%;
    }

    .element-box {
      direction: rtl;
      /* margin-right: 20px;
			margin-left: 20px; */
    }

    .form-group.row.text-center {
      border: solid 2px;
      border-top: 0;
    }

    .price {
      font-family: sans-serif;
    }

    tr.no-border td,
    tr.no-border th {
      border: none !important;
    }
  </style>
</head>

<body>
  <div class="book">
    <div class="page">
      <div class="subpage">
        <div class="invoice-w">
          <div class="infos">
            <div class="info-1">
              <div class="company-name">
                <?= $ci->saraf->info()['name'] ?>
              </div>
              <div class="company-extra text-center" style="font-size: 1rem; font-weight: 700;">
                شماره تماس :
                <bdo dir="ltr"><?= $ci->saraf->info()['phone'] ?></bdo>
              </div>
              <div class="company-extra text-center" style="font-size: 0.5rem; font-weight: 700;">
                (سیستم مدیریت صرافی سایبورگ تک)
              </div>
            </div>
          </div>
          <div class="invoice-heading">
            <div class="invoice-date text-left">
              <?= $ci->mylibrary->getCurrentShamsiDate()['date'] . ' ' . date('H:i:s') ?>
            </div>
            <div class="company-name" style="font-size: 1.2rem;">
              گزارشات کلی
            </div>
          </div>
          <div class="invoice-body">
            <div class="invoice-table  important" style="width: 100%;">
              <div class="row">
                <div class="col-md-12">
                  <div class="element-wrapper">
                    <div class="element-box">

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

                              <?php foreach ($balances as $currencies) :
                              ?>

                                <td>
                                  <?= $currencies['cr'] ?>
                                </td>
                                <td>
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
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url() . 'assets/' ?>bower_components/jquery/dist/jquery.min.js"></script>

  <script>
    jQuery(document).ready(function() {
      setTimeout(() => {
        window.print();
        self.close();
      }, 1000);
    });
  </script>
</body>

</html>