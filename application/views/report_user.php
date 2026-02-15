<?php
$ci = get_instance();
?>
<div class="element-box">
  <div class="form-header">
    <div class="row">
      <div class="col-md-12">
        <form action="<?= base_url() . 'admin/print_users_report' ?>" target="_blank" method="POST">
          <div class="row">
            <div class="col-md-4    ">
              <div class="form-group">
                <label class="label-date" for="">حساب مالی </label>
                <select name="customer" class="form-control select2 customer" dir="rtl" onchange="reports()">
                  <option value="">نام</option>
                  <?php foreach ($customers as $name) : ?>
                    <option value="<?= $name['id'] ?>"><?= $ci->saraf->customer_name($name['name'], $name['fname'], $name['page']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="label-date" for="">واحد پولی</label>
                <select class="form-control currency select2" dir="rtl" name="currency" onchange="reports()">
                  <option value="">واحد پولی</option>
                  <?php foreach ($ci->saraf->currency() as $key => $value) : ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
                </select>
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
        <?php $i = 1;
        foreach ($ci->saraf->currency() as $key => $value) :
          $balance = 0;
        ?>
          <?php if ($i % 2 == 1) : ?>
            <tr class="borderless">
            <?php endif; ?>
            <td>
              مجموعه
            </td>
            <td><?= $value ?></td>
            <td class="english"><bdo dir="ltr"><span class="number <?= ($balance < 0) ? 'red' : '' ?>"><?= number_format($balance) ?></span></bdo></td>
            <?php if ($i % 2 == 1) : ?>
            <td></td>
            <?php endif; ?>
            <?php if ($i % 2 == 0) : ?>
            </tr>
          <?php endif; ?>
        <?php $i++;
        endforeach; ?>

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
          <tr class="<?= $ci->mylibrary->elsewise($opd['type'], '0', '', 'bg-yellow') ?>">
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
    let customer = $('.customer').val();
    let currency = $('.currency').val();



    $.ajax({
      url: "<?= base_url() ?>admin/report_users_ajax",
      type: 'POST',
      data: {
        customer: customer,
        currency: currency
      },
      success: function(response) {
        var field = JSON.parse(response);
        $('#table').html(field['result']);

        <?php foreach($ci->saraf->currency() as $key => $value): ?>
        var <?= $key ?>_class = '';
        if (field["balance_<?= $key ?>"] < 0) {
          <?= $key ?>_class = 'red';
        }
        $("#val_<?= $key ?>").html(`<bdo dir="ltr" class="${<?= $key ?>_class}">${field['balance_<?= $key ?>']}</bdo>`);
        <?php endforeach; ?>
      }
    })
  }
</script>