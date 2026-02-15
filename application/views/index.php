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
<!-- Content Start -->

<div class="content-i">
  <div class="content-box">
    <div class="row pt-2">
      <div class="col-12 col-sm-4 col-xxl-4">
        <a class="element-box el-tablo centered trend-in-corner larger" data-target="#onboardingWideFormModal" data-toggle="modal">
          <div class="label titr">
            حساب های مالی
          </div>
          <div class="value">
            <img src="<?= base_url() . 'assets/' ?>img/bigicon8.png" alt="">
          </div>
          <div class="trending trending-up">
            <span class="english" id="count_customer"><?= $count_customers ?></span>
          </div>
        </a>
      </div>

      <div class="col-12 col-sm-4 col-xxl-4">
        <a class="element-box el-tablo centered trend-in-corner larger" data-target="#Receipt" data-toggle="modal">
          <div class="label titr">
            دریافت و پرداخت امروز
          </div>
          <div class="value">
            <img src="<?= base_url() . 'assets/' ?>img/bigicon9.png" alt="">
          </div>
          <div class="trending trending-up">
            <span class="english" id="count_balance"><?= $count_balance ?></span>
          </div>

        </a>
      </div>
      <div class="col-12 col-sm-4 col-xxl-4">
        <a class="element-box el-tablo centered trend-in-corner larger" data-target="#users" data-toggle="modal">
          <div class="label titr">
            انتقال پول
          </div>
          <div class="value">
            <img src="<?= base_url() . 'assets/' ?>img/bigicon10.png" alt="">
          </div>
          <div class="trending trending-up">
            <span class="english"><?= 0 ?></span>
          </div>
        </a>
      </div>
    </div>



    <div class="row pt-2">
      <?php foreach ($balancess as $balance) :  ?>
        <div class="col-12 col-sm-6 col-xxl-6">
          <a class="element-box el-tablo centered trend-in-corner larger" href="javascript:void(0)">
            <div class="label" style="font-size: 1.7rem; font-weight: 900; color: black;">
              <?= $ci->saraf->get_currency($balance['currency']) ?>
            </div>

            <?php
            if (isset($loans[$balance['currency']])) {
              $balances = $balance['cr'] - ($balance['dr'] + $loans[$balance['currency']]);
            } else {
              $balances = $balance['cr'] - $balance['dr'];
            }

            ?>
            <div class="value <?= ($balances < 0) ? 'green' : '' ?>">
              <bdo dir="ltr" class="english"><?= number_format($balances)  ?></bdo>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row pt-2">
      <div class="col-12 col-sm-12 col-xxl-12">
        <a class="element-box el-tablo centered trend-in-corner larger" href="<?= base_url() ?>admin/reports" target="_blank">
          <div class="value">
            گزارشات
          </div>
        </a>
      </div>
    </div>



    <!-- Content End -->

    <!-- Customer Start -->

    <div class="onboarding-modal modal fade animated" id="onboardingWideFormModal" role="dialog" style="display: none;" aria-hidden="true">


      <div class="modal-dialog modal-lg modal-centered" role="document">
        <div class="modal-content text-center">

          <button aria-label="Close" class="close" data-dimdiss="modal" onclick="modal_close()" type="button"><span class="os-icon os-icon-close"></span></button>
          <div class="onboarding-media">
            <img alt="" src="<?= base_url() . 'assets/' ?>img/logo-<?= ($_COOKIE['color'] !== 'dark') ? 'big' : 'white' ?>.png" width="200px">
          </div>
          <div class="onboarding-content with-gradient">
            <h4 class="onboarding-title">
              افزودن حساب مالی
            </h4>
            <div class="onboarding-text">
              برای افزودن حساب مالی جدید مشخصات ذیل را وارد کنید!
            </div>
            <form id="insert">
              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">نام</label>
                    <input class="form-control" name="name" placeholder="نام" type="text" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">نام پدر</label>
                    <input class="form-control" name="fname" placeholder="نام پدر" type="text" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">تخلص</label>
                    <input class="form-control" name="lname" placeholder="تخلص" type="text" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">شماره تماس 1</label>
                    <input class="form-control english" name="phone1" placeholder="شماره تماس 1" type="number" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">شماره تماس 2</label>
                    <input class="form-control english" name="phone2" placeholder="شماره تماس 2" type="number" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">صفحه</label>
                    <input class="form-control english" name="page" placeholder="صفحه" type="number" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">آدرس</label>
                    <textarea name="address" class="form-control" rows="2" autocomplete="off"></textarea>

                  </div>
                </div>


                <div class="col-md-12">
                  <div class="form-buttons-w">
                    <button class="btn btn-primary" type="button" onclick="Submit('insert', '<?= base_url() . ('admin/insert_customers') ?>', '', 'count_customer')">ثبت و ادامه</button>
                    <button class="btn btn-primary" type="button" onclick="Submit('insert', '<?= base_url() . ('admin/insert_customers') ?>', 'onboardingWideFormModal', 'count_customer')"> ثبت</button>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- User Start -->

    <div class="onboarding-modal modal fade animated" id="users" role="dialog" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-centered" role="document">
        <div class="modal-content text-center">
          <button aria-label="Close" class="close" data-dimdiss="modal" onclick="modal_close('users')" type="button"><span class="os-icon os-icon-close"></span></button>
          <div class="onboarding-media">
            <img alt="" src="<?= base_url() . 'assets/' ?>img/logo-<?= ($_COOKIE['color'] !== 'dark') ? 'big' : 'white' ?>.png" width="200px">
          </div>
          <div class="onboarding-content with-gradient">
            <h4 class="onboarding-title">
              انتقال پول
            </h4>
            <div class="onboarding-text">
              برای انتقال پول مشخصات ذیل را وارد کنید!
            </div>
            <form id="add_user">

              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="">از حساب</label>
                    <select name="from" class="form-control select2" dir="rtl">
                      <option value="">انتخاب</option>
                      <?php foreach ($customers as $customer) : ?>
                        <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?> - <?= $customer['fname'] ?> (<?= $customer['page'] ?>)</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="">به حساب</label>
                    <select name="to" class="form-control select2" dir="rtl">
                      <option value="">انتخاب</option>
                      <?php foreach ($customers as $customer) : ?>
                        <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?> - <?= $customer['fname'] ?> (<?= $customer['page'] ?>)</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">مبلغ</label>
                    <input type="number" name="price" class="form-control english" placeholder="مبلغ">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="">واحد پولی</label>
                    <select name="currency" class="form-control">
                      <option value="">انتخاب</option>
                      <?php foreach ($ci->saraf->currency() as $key => $value) : ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-buttons-w">
                <button class="btn btn-primary" type="button" onclick="Submit('add_user', '<?= base_url() . ('admin/transfer') ?>', 'users')">تائید</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Receipt Start -->


    <div class="onboarding-modal modal fade animated" id="Receipt" role="dialog" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-centered" role="document">
        <div class="modal-content text-center">
          <button aria-label="Close" class="close" data-dimdiss="modal" onclick="modal_close('Receipt')" type="button"><span class="os-icon os-icon-close"></span></button>
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
            <form id="insert_receipt">
              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">حساب مالی</label>

                    <select name="customer_id" class="form-control select2" dir="rtl">
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
                      <input type="text" name="date" value="<?= $ci->mylibrary->getCurrentShamsiDate()['date']; ?>" data-jdp class="form-control english text-left" autocomplete="off">
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
                    <select name="currency" class="form-control select2" dir="rtl">
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
                    <button class="btn btn-primary" type="button" onclick="Submit('insert_receipt', '<?= base_url() . ('admin/insert_receipt') ?>', '', 'count_customer')">ثبت و ادامه</button>
                    <button class="btn btn-primary" type="button" onclick="Submit('insert_receipt', '<?= base_url() . ('admin/insert_receipt') ?>', 'Receipt', 'count_balance')">ثبت</button>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      function Submit(from_id, action, modalClass = 'onboardingWideFormModal', numClass = '', extraFunction = '', reload = false, btnAction = '.none', timeOut = 1000) {
        var formData = new FormData($("#" + from_id)[0]);
        $(btnAction).attr("disabled", true);
        $.ajax({
          url: action,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        }).then(function(data) {
          var field = JSON.parse(data);
          if (field['type'] == 'success') {
            $(btnAction).attr("disabled", false);
            init_PNotify(field['alert']['title'], field['alert']['text'], field['alert']['type']);
            $('#' + from_id).trigger("reset");

            if (numClass !== '') {
              let sum = Number($(`#${numClass}`).html());
              $(`#${numClass}`).html(sum + 1);
            }
            $(`#${modalClass}`).modal('hide');
            if (reload) {
              setTimeout(() => {
                window.location.reload();
              }, timeOut);
            }
          } else {
            $(btnAction).attr("disabled", false);
            if (field['type'] == "form_error") {
              for (let step = 0; step < field['messages'].length; step++) {

                init_PNotify('خطا', field['messages'][step], 'error');
              }
            }
          }
        });
      }
    </script>

    <script>
      // document.addEventListener("DOMContentLoaded", function() {
      //   jalaliDatepicker.startWatch();
      // });
    </script> 