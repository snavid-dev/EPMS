<div class="element-box">
    <div class="form-header">
        <div class="row">

            <div class="col-md-12">
                <div class="form-group text-left">

                    <button class="mr-2 mb-2 btn btn-primary btn-lg" data-target="#onboardingWideFormModal" data-toggle="modal" type="button">افزودن <i class="fa fa-plus"></i></button>

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
                                                    <button class="btn btn-primary" type="button" onclick="xhrSubmit('insert', '<?= base_url() . ('admin/insert_customers') ?>', 'customers', 'onboardingWideFormModal')"> ثبت</button>
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
        <table id="dataTable1" width="100%" class="table table-striped table-lightfont customers">
            <thead>
                <tr>
                    <th>شماره</th>
                    <th>نام</th>
                    <th>نام پدر</th>
                    <th>تخلص</th>
                    <th>شماره تماس 1</th>
                    <th>شماره تماس 2</th>
                    <th>صفحه</th>
                    <th>آدرس</th>
                    <th>کاربر</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>شماره</th>
                    <th>نام</th>
                    <th>نام پدر</th>
                    <th>تخلص</th>
                    <th>شماره تماس 1</th>
                    <th>شماره تماس 2</th>
                    <th>صفحه</th>
                    <th>آدرس</th>
                    <th>کاربر</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1;
                foreach ($customers as $customer) : ?>
                    <tr id="<?= $customer['id'] ?>">
                        <td class="english"><?= $i ?></td>
                        <td><?= ucwords($customer['name']) ?></td>
                        <td><?= ucwords($customer['fname']) ?></td>
                        <td><?= ucwords($customer['lname']) ?></td>
                        <td class="english"><bdo dir="ltr"><?= ucwords($customer['phone1']) ?></bdo></td>
                        <td class="english"><bdo dir="ltr"><?= ucwords($customer['phone2']) ?></bdo></td>
                        <td class="english"><bdo dir="ltr"><?= ucwords($customer['page']) ?></bdo></td>
                        <td><?= ucwords($customer['address']) ?></td>
                        <td><?= ucwords($customer['firstname']) . ' ' . ucwords($customer['lastname']) ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

                                <button onclick="xhrDelete(<?= $customer['id'] ?>, '<?= base_url('admin/delete_customer/') ?>')" class="btn btn-secondary mr-left-0 btn-danger btn-group-right"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-secondary mr-left-0 btn-info btn-group-left" onclick="edit_customer(<?= $customer['id'] ?>)" data-target="#editModal" data-toggle="modal"><i class="fa fa-edit"></i></button>
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
                    ویرایش حساب مالی
                </h4>
                <div class="onboarding-text">
                    برای ویرایش حساب مالی جدید مشخصات ذیل را وارد کنید!
                </div>
                <form id="update">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">نام</label>
                                <input class="form-control" name="name" placeholder="نام" id="name" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="slug" id="slug">
                                <label for="">نام پدر</label>
                                <input class="form-control" name="fname" placeholder="نام پدر" id="fname" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">تخلص</label>
                                <input class="form-control" name="lname" placeholder="تخلص" id="lname" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">شماره تماس 1</label>
                                <input type="hidden" name="oldphone1" id="oldphone1">
                                <input class="form-control english" name="phone1" id="phone1" placeholder="شماره تماس 1" type="number" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">شماره تماس 2</label>
                                <input type="hidden" name="oldphone2" id="oldphone2">
                                <input class="form-control english" name="phone2" id="phone2" placeholder="شماره تماس 2" type="number" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">صفحه</label>
                                <input type="hidden" name="oldpage" id="oldpage">
                                <input class="form-control english" name="page" id="page" placeholder="صفحه" type="number" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">آدرس</label>
                                <textarea name="address" class="form-control" id="address" rows="2" autocomplete="off"></textarea>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-buttons-w">
                                <button class="btn btn-primary" type="button" onclick="xhrUpdate('update', '<?= base_url() . ('admin/update_customers') ?>', 'editModal')"> بروزرسانی</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function edit_customer(slug = null) {
        // alert(slug);
        $.ajax({
            url: "<?= base_url('admin/single_customer') ?>",
            type: 'POST',
            data: {
                slug: slug
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result['type'] == 'success') {
                    var content = result['content'];
                    $('#slug').val(content['slug']);

                    $('#name').val(content['name']);
                    $('#fname').val(content['fname']);
                    $('#lname').val(content['lname']);
                    $('#oldphone1').val(content['phone1']);
                    $('#oldphone2').val(content['phone2']);
                    $('#phone1').val(content['phone1']);
                    $('#phone2').val(content['phone2']);
                    $('#page').val(content['page']);
                    $('#oldpage').val(content['page']);
                    $('#address').val(content['address']);
                } else if (result['type'] == 'error') {
                    init_PNotify(result['alert']['title'], result['alert']['text'], result['alert']['type']);
                }
            }
        })
    }
</script>