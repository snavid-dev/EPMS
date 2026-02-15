<div class="row">
    <div class="col-lg-12">
        <div class="element-wrapper">
            <div class="element-box">
                <form id="profile" enctype="multipart/form-data">
                    <div class="form-desc">
                        برای ویرایش جزئیات پروفایل لطفا قسمت های مربوطه را تغییر دهید
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for=""> عکس</label>
                                <input name="users_file" class="form-control" type="file" autocomplete="off" />
                                <input name="old_photo" class="form-control" type="hidden" value="<?= $single[0]['photo'] ?>" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">نام</label><input name="first_name" value="<?= $single[0]['fname'] ?>" class="form-control" placeholder="نام" type="text" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">نام خانوادگی</label><input name="last_name" value="<?= $single[0]['lname'] ?>" class="form-control" placeholder="نام خانوادگی" type="text" autocomplete="off" />
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
                                    <input value="<?= $single[0]['username'] ?>" class="form-control" placeholder="نام کاربری" type="text" disabled autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">نوع حساب</label>
                                <select class="form-control" disabled>
                                    <option value="admin" <?= ($single[0]['role'] == 'admin') ? 'selected' : '' ?>>مدیر</option>
                                    <option value="user" <?= ($single[0]['role'] == 'user') ? 'selected' : '' ?>>کاربر</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">وضعیت</label>
                                <select class="form-control" disabled>
                                    <option value="P" <?= ($single[0]['status'] == 'P') ? 'selected' : '' ?>>معلق</option>
                                    <option value="A" <?= ($single[0]['status'] == 'A') ? 'selected' : '' ?>>پذیرفته شده</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">رمز عبور قدیمی</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                    <input name="password" class="form-control" type="password" placeholder="رمز عبور قدیمی" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for=""> رمز عبور</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                    <input name="password_new" class="form-control" type="password" placeholder="رمز عبور" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
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
                        <button class="btn btn-primary" type="button" onclick="xhrSubmit('profile', '<?= base_url() . (($this->session->userdata($this->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . '/update_profile' ?>', '', '', '', true)"> بروز رسانی</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>