<?php
$ci = get_instance();
?>
<div class="element-box">
  <div class="form-header">
    <div class="row">
      <div class="col-md-6">
        <form action="#" method="POST">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="label-date" for="">از تاریخ</label>
                <div class="">
                  <input name="from_date" value="<?= $ci->mylibrary->getCurrentShamsiDate()['date'] ?>" data-jdp type="text" class="form-control english" id="test-date-id" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="label-date" for="">الی تاریخ</label>
                <div class="">
                  <input name="to_date" value="<?= $ci->mylibrary->getCurrentShamsiDate()['date'] ?>" data-jdp type="text" class="form-control english" id="test-date-id2" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-10">
              <div class="form-group">
                <button type="button" class="btn btn-primary btn-rel" onclick="report()">گزارش</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-6 mb-10">
        <div class="text-left">
          <button class="mr-2 mb-2 btn btn-primary btn-lg" data-target="#onboardingFormModal" data-toggle="modal" type="button">افزودن <i class="fa fa-plus"></i></button>
          <div class="onboarding-modal modal fade animated" id="onboardingFormModal" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-centered" role="document">
              <div class="modal-content text-center">
                <button aria-label="Close" class="close" data-dimdiss="modal" onclick="modal_close()" type="button"><span class="os-icon os-icon-close"></span></button>
                <div class="onboarding-media">
                  <img alt="" src="<?= base_url() . 'assets/' ?>img/logo-<?= ($_COOKIE['color'] !== 'dark') ? 'big' : 'white' ?>.png" width="200px">
                </div>
                <div class="onboarding-content with-gradient">
                  <h4 class="onboarding-title">
                    افزودن رسیدات
                  </h4>
                  <div class="onboarding-text">
                    برای افزودن رسیدات جدید مشخصات ذیل را وارد کنید!
                  </div>
                  <form id="insert">
                    <div class="row">

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">حساب مالی</label>

                          <select name="customer_id" id="customersOld" class="form-control select2" dir="rtl">
                            <option value="">حساب مالی</option>
                            <?php foreach ($customers as $customer) : ?>
                              <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?> - <?= $customer['fname'] ?> (<?= $customer['page'] ?>)</option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                      </div>

                      <div class="col-md-4">
                        <div class="form-group">

                          <label for="">نوعیت</label>
                          <select name="type" class="form-control" dir="rtl">
                            <option value="">نوعیت</option>
                            <option value="cr">رسید</option>
                            <option value="dr">برد</option>

                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">مبلغ</label>
                          <input class="form-control english" name="price" placeholder="مبلغ" type="number" min="0">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">تاریخ</label>
                          <div class="">
                            <input type="text" name="date" value="<?= $ci->mylibrary->getCurrentShamsiDate()['date'] ?>" data-jdp class="form-control english text-left" id="shamsi-date" autocomplete="off">
                          </div>
                        </div>
                      </div>





                      <div class="col-md-4">
                        <div class="form-group">

                          <label for="">تصفیه حساب؟</label>
                          <select name="types" class="form-control" dir="rtl">
                            <option value="0" selected>خیر</option>
                            <option value="1">بله</option>

                          </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">

                          <label for="">واحد</label>
                          <select name="currency" class="form-control select2" id="currencyOld" dir="rtl">
                            <option value="">واحد</option>
                            <?php foreach ($ci->saraf->currency() as $key => $value) : ?>
                              <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>




                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">تفصیلات</label>
                          <textarea name="desc" class="form-control" rows="6"></textarea>

                        </div>
                      </div>


                      <div class="col-md-12">
                        <div class="form-buttons-w">
                          <button class="btn btn-primary" type="button" onclick="xhrSubmit('insert', '<?= base_url() . ('admin/insert_receipt') ?>', 'receipt', '')"> ثبت و ادامه</button>
                          <button class="btn btn-primary" type="button" onclick="xhrSubmit('insert', '<?= base_url() . ('admin/insert_receipt') ?>', 'receipt', 'onboardingFormModal')">ثبت</button>
                        </div>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table id="dataTable1" width="100%" class="table table-striped table-lightfont receipt">
      <thead>
        <tr>
          <th>شماره</th>
          <th>حساب مالی</th>
          <th>نوعیت</th>
          <th>مقدار</th>
          <th>واحد پولی</th>
          <th>تاریخ</th>
          <th>کاربر</th>
          <th>تفصیلات</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>شماره</th>
          <th>حساب مالی</th>
          <th>نوعیت</th>
          <th>مقدار</th>
          <th>واحد پولی</th>
          <th>تاریخ</th>
          <th>کاربر</th>
          <th>تفصیلات</th>
          <th>عملیات</th>
        </tr>
      </tfoot>
      <tbody>
        <?php $i = 1;
        foreach ($receipt as $opd) : ?>
          <tr id="<?= $opd['id'] ?>" class="<?= ($opd['type'] == 1) ? 'bg-yellow' : ''  ?>">
            <td class="english"><?= $i ?></td>
            <td><a href="<?= base_url() . 'admin/single_customer/' . $opd['customers_id'] ?>" target="_blank"><?= ucwords($opd['name']) ?> - <?= ucwords($opd['fname']) ?></a></td>
            <td><?= ($opd['dr'] == 0) ? 'رسید' : 'برد' ?></td>
            <td class="english"><?= ($opd['dr'] == 0) ? number_format($opd['cr']) : number_format($opd['dr']) ?></td>
            <td><?= $this->saraf->get_currency($opd['currency']) ?></td>
            <td class="english"><?= ucwords($opd['shamsi']) ?></td>
            <td><?= ucwords($opd['firstname']) . ' ' . ucwords($opd['lastname']) ?></td>
            <td><?= mb_strimwidth($opd['remark'], 0, 110, '...') ?></td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <button onclick="xhrDelete(<?= $opd['id'] ?>, '<?= base_url('admin/delete_receipt/') ?>')" class="btn btn-secondary mr-left-0 btn-danger btn-group-right"><i class="fa fa-trash"></i></button>
                <button class="btn btn-secondary mr-left-0 btn-info btn-group-left" onclick="edit_receipt(<?= $opd['id'] ?>)" data-target="#editModal" data-toggle="modal"><i class="fa fa-edit"></i></button>
              </div>
            </td>
          </tr>
        <?php
          $i++;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

<div class="onboarding-modal modal fade animated" id="editModal" role="dialog" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-centered" role="document">
    <div class="modal-content text-center">
      <button aria-label="Close" class="close" data-dimdiss="modal" onclick="modal_close('editModal')" type="button"><span class="os-icon os-icon-close"></span></button>
      <div class="onboarding-media">
        <img alt="" src="<?= base_url() . 'assets/' ?>img/logo-<?= ($_COOKIE['color'] !== 'dark') ? 'big' : 'white' ?>.png" width="200px">
      </div>
      <div class="onboarding-content with-gradient">
        <h4 class="onboarding-title">
          ویرایش رسیدات مالی
        </h4>
        <div class="onboarding-text">
          برای ویرایش رسیدات مالی مشخصات ذیل را وارد کنید!
        </div>
        <form id="update">
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label for="">حساب مالی</label>

                <select name="customer_id" id="customers_id" class="form-control select2" dir="rtl">
                  <option value="">حساب مالی</option>
                  <?php foreach ($customers as $customer) : ?>
                    <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?> - <?= $customer['fname'] ?> (<?= $customer['page'] ?>)</option>
                  <?php endforeach; ?>
                </select>
              </div>

            </div>

            <div class="col-md-4">
              <div class="form-group">

                <label for="">نوعیت</label>
                <select name="type" id="type" class="form-control" dir="rtl">
                  <option value="">نوعیت</option>
                  <option value="cr">رسید</option>
                  <option value="dr">برد</option>

                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="">مبلغ</label>
                <input class="form-control english" name="price" id="price" placeholder="مبلغ" type="number" min="0">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="">تاریخ</label>
                <div class="">
                  <input type="text" name="date" data-jdp class="form-control english text-left" id="shamsi-date2" autocomplete="off">
                </div>
              </div>
            </div>





            <div class="col-md-4">
              <div class="form-group">

                <label for="">تصفیه حساب؟</label>
                <input type="hidden" name="slug" id="slug">
                <select name="types" class="form-control" id="types" dir="rtl">
                  <option value="0" selected>خیر</option>
                  <option value="1">بله</option>

                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">

                <label for="">واحد</label>
                <select name="currency" class="form-control select2" id="currency" dir="rtl">
                  <option value="">واحد</option>
                  <?php foreach ($ci->saraf->currency() as $key => $value) : ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>




            <div class="col-md-12">
              <div class="form-group">
                <label for="">تفصیلات</label>
                <textarea name="desc" class="form-control" id="remark" rows="6"></textarea>

              </div>
            </div>


            <div class="col-md-12">
              <div class="form-buttons-w">
                <button class="btn btn-primary" type="button" onclick="xhrUpdate('update', '<?= base_url() . ('admin/update_receipt') ?>', 'editModal')">بروزرسانی</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function edit_receipt(slug = null) {
    $.ajax({
      url: "<?= base_url('admin/single_receipt') ?>",
      type: 'POST',
      data: {
        slug: slug
      },
      success: function(response) {
        let customersOld = $("#customersOld").html();
        let currencyOld = $("#currencyOld").html();
        var result = JSON.parse(response);
        if (result['type'] == 'success') {
          var content = result['content'];
          $('#slug').val(content['slug']);
          let customers = customersOld;
          customers = customers.replace(`value="${content['customers_id']}"`, `value="${content['customers_id']}" selected`)
          $('#customers_id').html(customers);
          $('#price').val(content['price']);
          $('#shamsi-date2').val(content['shamsi']);
          let currency = currencyOld;
          currency = currency.replace(`value="${content['currency']}"`, `value="${content['currency']}" selected`)
          $('#type').val(content['type']);
          $('#types').val(content['types']);
          $('#currency').html(currency);
          $('#remark').val(content['remark']);
        } else if (result['type'] == 'error') {
          init_PNotify(result['alert']['title'], result['alert']['text'], result['alert']['type']);
        }
      }
    })
  }

  function report() {
    let from = $('#test-date-id').val();
    let to = $('#test-date-id2').val();

    $.ajax({
      url: "<?= base_url('admin/report_receipt') ?>",
      type: 'POST',
      data: {
        from: from,
        to: to
      },
      success: function(response) {
        let result = JSON.parse(response);
        let table = $('#dataTable1').DataTable();
        table.clear();
        let tr = result['tr'];
        for (let index = 0; index < tr.length; index++) {
          var rows = table.row.add(tr[index]).node();
          rows.id = result['id'][index];
          if (result['class'][index] !== '') {
            $(rows).addClass(result['class'][index]);
          }
        }
        table.draw();
      }
    })
  }
</script>