<?php
$ci = get_instance();
?>
<div class="element-box">
  <div class="form-header">
    <div class="row">
      <div class="col-md-12">
        <form action="<?= base_url() . 'admin/print_report' ?>" method="POST" target="_blank">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label class="label-date" for="">از تاریخ</label>
                <div class="">
                  <input name="from_date" value="<?= $ci->mylibrary->getCurrentShamsiDate()['date'] ?>" data-jdp type="text" class="form-control english from_date" id="test-date-id" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="label-date" for="">الی تاریخ</label>
                <div class="">
                  <input name="to_date" value="<?= $ci->mylibrary->getCurrentShamsiDate()['date'] ?>" data-jdp type="text" class="form-control english to_date" id="test-date-id2" autocomplete="off">
                  <input name="idjf" value="" type="hidden" class="form-control" id="shamsi-date" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="label-date" for="">حساب مالی </label>
                <select name="customer" class="form-control select2 customer" dir="rtl">
                  <option value="">نام</option>
                  <?php foreach ($customers as $name) : ?>
                    <option value="<?= $name['id'] ?>"><?= $ci->saraf->customer_name($name['name'], $name['fname'], $name['page']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="label-date" for="">واحد پولی</label>
                <select class="form-control currency select2" dir="rtl" name="currency">
                  <option value="">واحد پولی</option>
                  <?php foreach ($ci->saraf->currency() as $key => $value) : ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-2 mb-10">
              <div class="form-group">
                <button type="button" class="btn btn-outline-primary btn-rel full-width" onclick="reports()">گزارش</button>
              </div>
            </div>
            <div class="col-md-2 mb-10">
              <div class="form-group">
                <button type="submit" class="btn btn-outline-danger btn-rel full-width">چاپ</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="table-responsive" id="tables">
    <table class="table table-bordered" id="table">
      <thead>
        <tr>
          <th>
            شماره
          </th>
          <th>
            تاریخ
          </th>
          <th>
            حساب مالی
          </th>
          <th>
            واحد پولی
          </th>
          <th>
            رسید
          </th>
          <th>
            برد
          </th>
          <th>
            تفصیلات
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sum = array();
        foreach ($ci->saraf->currency() as $keys => $values) {
          $sum['cr_' . $keys] = 0;
          $sum['dr_' . $keys] = 0;
        }

        $i = 1;
        foreach ($balances as $opd) : ?>
          <tr class="<?= ($opd['type'] == 1) ? 'bg-yellow' : '' ?>">
            <td class="english">
              <?= $i ?>
            </td>
            <td class="english">
              <?= $opd['shamsi'] ?>
            </td>
            <td>
              <?= $ci->saraf->customer_name($opd['name'], $opd['fname']) ?>
            </td>
            <td><?= $ci->saraf->get_currency($opd['currency']) ?></td>
            <td class="english"><?= (!empty($opd['cr'])) ? number_format($opd['cr']) : 0 ?></td>
            <td class="english"><?= (!empty($opd['dr'])) ? number_format($opd['dr']) : 0 ?></td>
            <td><?= mb_strimwidth($opd['remark'], 0, 110, '...') ?></td>
          </tr>
        <?php

          foreach ($ci->saraf->currency() as $key => $value) {
            if ($opd['currency'] == $key) {
              $sum['cr_' . $key] += $opd['cr'];
              $sum['dr_' . $key] += $opd['dr'];
            }
          }


          $i++;
        endforeach;
        ?>
      </tbody>
      <tfoot>
        <?php foreach ($ci->saraf->currency() as $key => $value) :
          $balance = $sum['cr_' . $key] - $sum['dr_' . $key];
        ?>
          <tr>
            <td>
              مجموعه
            </td>
            <td><?= $value ?></td>
            <td></td>
            <td></td>
            <td class="english"><?= number_format($sum['cr_' . $key]) ?></td>
            <td class="english"><?= number_format($sum['dr_' . $key]) ?></td>
            <td class="english"><bdo dir="ltr"><span class="number <?= ($balance < 0) ? 'red' : '' ?>"><?= number_format($balance) ?></span></bdo></td>
          </tr>
        <?php endforeach; ?>
      </tfoot>
    </table>
  </div>
</div>
</div>

<script>
  function reports() {
    let from_date = $('.from_date').val();
    let to_date = $('.to_date').val();
    let customer = $('.customer').val();
    let currency = $('.currency').val();
    $.ajax({
      url: "<?= base_url() ?>admin/report_ajax",
      type: 'POST',
      data: {
        from_date: from_date,
        to_date: to_date,
        customer: customer,
        currency: currency
      },
      success: function(response) {
        $('#table').html(response);
      }
    })
  }
</script>