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
                                        افزودن کاربر
                                    </h4>
                                    <div class="onboarding-text">
                                        برای افزودن کاربر جدید مشخصات ذیل را وارد کنید!
                                    </div>
                                    <form id="add_user">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for=""> عکس</label><input name="photo" class="form-control" type="file" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="">نام</label><input name="name" class="form-control" placeholder="نام" type="text" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="">نام خانوادگی</label><input name="lname" class="form-control" placeholder="نام خانوادگی" type="text" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="">نام کاربری</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                @
                                                            </div>
                                                        </div>
                                                        <input name="username" class="form-control" placeholder="نام کاربری" type="text" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="">نوع حساب</label>
                                                    <select name="type" class="form-control">
                                                        <option value="">انتخاب</option>
                                                        <option value="admin" selected>مدیر</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="">وضعیت</label>
                                                    <select name="status" class="form-control">
                                                        <option value="">انتخاب</option>
                                                        <option value="P">معلق</option>
                                                        <option value="A">پذیرفته شده</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for=""> رمز عبور</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-lock"></i>
                                                            </div>
                                                        </div>
                                                        <input name="password" class="form-control" type="password" placeholder="رمز عبور" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">تکرار رمز عبور</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fa fa-lock"></i>
                                                            </div>
                                                        </div>
                                                        <input name="confirm" class="form-control" placeholder="تکرار رمز عبور" type="password" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-buttons-w">
                                            <button class="btn btn-primary" type="button" onclick="xhrSubmit('add_user', '<?= base_url() . ('admin/insert_user') ?>', 'users', 'onboardingWideFormModal')"> افزودن</button>
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
        <table id="dataTable1" width="100%" class="table table-striped table-lightfont users">
            <thead>
                <tr>
                    <th>شماره</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>نام کاربری</th>
                    <th>وضعیت</th>
                    <th>نوعیت حساب</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>شماره</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>نام کاربری</th>
                    <th>وضعیت</th>
                    <th>نوعیت حساب</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1;
                foreach ($users as $user) : ?>
                    <tr id="<?= $user['id'] ?>">
                        <td class="english"><?= $i ?></td>
                        <td><?= ucwords($user['fname']) ?></td>
                        <td><?= ucwords($user['lname']) ?></td>
                        <td><?= ucwords($user['username']) ?></td>
                        <td><span class="bg-<?= ($user['status'] == 'P') ? 'red' : 'green' ?>"><?= ($user['status'] == 'P') ? 'انتظار' : 'پذیرفته شده' ?></span></td>
                        <td><?= ($user['role'] == 'admin') ? 'مدیر' : 'کاربر' ?></td>

                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" onclick="xhrDelete('<?= $user['id'] ?>', '<?= base_url('admin/delete_user') ?>')"  class="btn btn-secondary mr-left-0 btn-danger btn-group-right"><i class="fa fa-trash"></i></button>
                                <?php if ($user['status'] == 'A') : ?>
                                    <button onclick="change_status(<?= $user['id'] ?>, '<?= base_url('admin/pending_user/')?>')" class="btn btn-secondary mr-left-0 btn-info btn-group-left"><i class="fa fa-clock-o"></i></button>
                                <?php else : ?>
                                    <button onclick="change_status(<?= $user['id'] ?>, '<?= base_url('admin/accept_user/')?>')" class="btn btn-secondary mr-left-0 btn-info btn-group-left"><i class="fa fa-check"></i></button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>