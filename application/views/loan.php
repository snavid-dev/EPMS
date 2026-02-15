<?php
$ci = get_instance();
?>
<div class="element-box">
  <div class="form-header">
    <div class="row">

      <div class="col-md-12">
        <div class="form-group text-left">

          <button class="mr-2 mb-2 btn btn-primary btn-lg" data-target="#onboardingWideFormModal" data-toggle="modal" type="button">افزودن <i class="fa fa-plus"></i></button>
          <a href="javascript:void(0)" onclick="window.open('<?= base_url() . 'admin/print_loan' ?>')" class="mr-2 mb-2 btn btn-danger btn-lg" id="print_users">چاپ <i class="fa fa-print"></i></a>


          <div class="onboarding-modal modal fade animated" id="onboardingWideFormModal" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-centered" role="document">
              <div class="modal-content text-center">
                <button aria-label="Close" class="close" data-dimdiss="modal" onclick="modal_close()" type="button"><span class="os-icon os-icon-close"></span></button>
                <div class="onboarding-media">
                  <img alt="" src="<?= base_url() . 'assets/' ?>img/logo-<?= ($_COOKIE['color'] !== 'dark') ? 'big' : 'white' ?>.png" width="200px">
                </div>
                <div class="onboarding-content with-gradient">
                  <h4 class="onboarding-title">
                    افزودن قرضه های کوچک
                  </h4>
                  <div class="onboarding-text">
                    برای افزودن قرضه های کوچک جدید مشخصات ذیل را وارد کنید!
                  </div>
                  <form id="insert">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">نام</label>
                          <input class="form-control" name="name" placeholder="نام" type="text" autocomplete="off">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">شماره تماس</label>
                          <input class="form-control english" name="phone" placeholder="شماره تماس" type="number" autocomplete="off">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">تاریخ</label>
                          <input class="form-control english" name="date" value="<?= $ci->mylibrary->getCurrentShamsiDate()['date'] ?>" data-jdp type="text" id="test-date-id" autocomplete="off">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">مقدار</label>
                          <input class="form-control english" name="price" placeholder="مقدار" type="number" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">واحد پولی</label>
                          <select name="currency" id="currencyOld" class="form-control">
                            <?php foreach ($ci->saraf->currency() as $key => $value) : ?>
                              <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">تفصیلات</label>
                          <textarea name="remarks" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-buttons-w">
                          <button class="btn btn-primary" type="button" onclick="xhrSubmit('insert', '<?= base_url() . ('admin/insert_loan') ?>', 'loan', 'onboardingWideFormModal', )"> ثبت</button>
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
    <table id="dataTable1" width="100%" class="table table-striped table-lightfont loan">
      <thead>
        <tr>
          <th>شماره</th>
          <th>نام</th>
          <th>شماره تماس</th>
          <th>تاریخ</th>
          <th>مقدار</th>
          <th>واحد پولی</th>
          <th>کاربر</th>
          <th>تفصیلات</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>شماره</th>
          <th>نام</th>
          <th>شماره تماس</th>
          <th>تاریخ</th>
          <th>مقدار</th>
          <th>واحد پولی</th>
          <th>کاربر</th>
          <th>تفصیلات</th>
          <th>عملیات</th>
        </tr>
      </tfoot>
      <tbody>
        <?php $i = 1;
        $sum_a = $sum_t = 0;
        foreach ($customers as $customer) :
          if ($customer['currency'] == 'a') {
            $sum_a += $customer['price'];
          } elseif ($customer['currency'] == 't') {
            $sum_t += $customer['price'];
          }
        ?>
          <tr id="<?= $customer['id'] ?>">
            <td class="english"><?= $i ?></td>
            <td><?= ucwords($customer['name']) ?></td>
            <td class="english"><bdo dir="ltr"><?= ucwords($customer['phone']) ?></bdo></td>
            <td class="english"><bdo dir="ltr"><?= ucwords($customer['date']) ?></bdo></td>
            <td class="english"><bdo dir="ltr"><?= number_format($customer['price']) ?></bdo></td>
            <td><?= $ci->saraf->get_currency($customer['currency']) ?></td>
            <td><?= ucwords($customer['fname']) . ' - ' . ucwords($customer['lname']) ?></td>
            <td><?= $customer['remarks'] ?></td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <button onclick="xhrDelete(<?= $customer['id'] ?>, '<?= base_url('admin/delete_loan/') ?>')" class="btn btn-secondary mr-left-0 btn-success btn-group-right"><i class="fa fa-check"></i></button>
                <button class="btn btn-secondary mr-left-0 btn-info btn-group-left" onclick="edit_loan(<?= $customer['id'] ?>)" data-target="#editModal" data-toggle="modal"><i class="fa fa-edit"></i></button>
              </div>
            </td>
          </tr>
        <?php
          $i++;
        endforeach; ?>
      </tbody>
      <tfoot>
        <tr>

          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            مجموعه
          </td>
          <td>افغانی</td>
          <td class="english"><bdo dir="ltr"><span class="number "><?= number_format($sum_a) ?></span></bdo></td>
        </tr>
        <tr>

          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            مجموعه
          </td>
          <td>تومان</td>
          <td class="english"><bdo dir="ltr"><span class="number "><?= number_format($sum_t) ?></span></bdo></td>
        </tr>
      </tfoot>
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
          ویرایش قرضه های کوچک
        </h4>
        <div class="onboarding-text">
          برای ویرایش قرضه های کوچک جدید مشخصات ذیل را وارد کنید!
        </div>
        <form id="update">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="">نام</label>
                <input class="form-control" name="name" id="name" placeholder="نام" type="text" autocomplete="off">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">شماره تماس</label>
                <input class="form-control english" name="phone" id="phone" placeholder="شماره تماس" type="number" autocomplete="off">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="">تاریخ</label>
                <input class="form-control english" name="date" data-jdp type="text" id="shamsi-date" autocomplete="off">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="">مقدار</label>
                <input class="form-control english" name="price" id="price" placeholder="مقدار" type="number" autocomplete="off">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">واحد پولی</label>
                <input type="hidden" name="slug" id="slug">
                <select name="currency" id="currency" class="form-control">
                  <?php foreach ($ci->saraf->currency() as $key => $value) : ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="">تفصیلات</label>
                <textarea name="remarks" id="remarks" cols="30" rows="4" class="form-control"></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-buttons-w">
                <button class="btn btn-primary" type="button" onclick="xhrUpdate('update', '<?= base_url() . ('admin/update_loan') ?>')"> بروزرسانی</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function edit_loan(slug = null) {
    $.ajax({
      url: "<?= base_url('admin/single_loan') ?>",
      type: 'POST',
      data: {
        slug: slug
      },
      success: function(response) {
        let currencyOld = $("#currencyOld").html();
        var result = JSON.parse(response);
        if (result['type'] == 'success') {
          var content = result['content'];
          $('#slug').val(content['slug']);
          $('#price').val(content['price']);
          $('#shamsi-date').val(content['date']);
          let currency = currencyOld;
          currency = currency.replace(`value="${content['currency']}"`, `value="${content['currency']}" selected`)
          $('#phone').val(content['phone']);
          $('#currency').html(currency);
          $('#name').val(content['name']);
          $('#remarks').val(content['remarks']);
        } else if (result['type'] == 'error') {
          init_PNotify(result['alert']['title'], result['alert']['text'], result['alert']['type']);
        }
      }
    })
  }
</script>