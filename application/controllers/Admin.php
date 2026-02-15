<?php

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model');
    if (!$this->session->userdata($this->mylibrary->hash_session('logged_in'))) {
      $this->session->set_flashdata('er_msg', 'برای دسترسی به صفحه درخواست شده لطفا وارد شوید!');
      redirect(base_url());
    }
    $user = $this->Admin_model->single_user($this->session->userdata($this->mylibrary->hash_session('u_id')))[0];
    if (ucwords($user['status']) == 'P') {
      $this->session->set_userdata($this->mylibrary->hash_session('logged_in'),false);
      $this->session->set_flashdata('er_msg', 'برای دسترسی به صفحه درخواست شده لطفا وارد شوید!');
      redirect(base_url());
    }
  }

  public function theme($theme = null)
  {
    if (is_null($theme)) {
      redirect(base_url('admin/'));
    }
    $this->mylibrary->themes($theme);
  }

  public function index()
  {
    $data['title'] = "خانه";
    $data['page'] = "dashboard";
    $data['balancess'] = $this->Admin_model->balance_currency();
    $data['customers'] = $this->Admin_model->get_customers();
    $data['loan'] = $this->Admin_model->sum_loan();
    $data['script'] = $this->mylibrary->script_datepicker();
    $data['count_balance'] = count($this->Admin_model->count_balance());
    $data['count_customers'] = count($this->Admin_model->get_customers());
    $this->load->view('header', $data);
    $this->load->view('index', $data);
    $this->load->view('footer', $data);
  }

  public function users()
  {
    $data['title'] = "کاربران";
    $data['page'] = "users";
    $data['users'] = $this->Admin_model->get_users();

    $this->load->view('header', $data);
    $this->load->view('users', $data);
    $this->load->view('footer');
  }

  public function insert_user()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('name', 'name', 'trim|required', array('required' => 'قسمت نام الزامیست'));
    $this->form_validation->set_rules('lname', 'lname', 'trim|required', array('required' => 'قسمت نام خانواده گی الزامیست'));
    $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]', array('required' => 'قسمت نام خانواده گی الزامیست', 'is_unique' => 'نام کاربری قبلا ثبت شده است'));
    $this->form_validation->set_rules('type', 'type', 'trim|required', array('required' => 'قسمت نوعیت حساب الزامیست'));
    $this->form_validation->set_rules('password', 'password', 'trim|required', array('required' => 'قسمت رمز عبور الزامیست'));
    $this->form_validation->set_rules('confirm', 'confirm', 'trim|required|matches[password]', array('required' => 'قسمت تکرار رمز عبور الزامیست', 'matches' => 'تکرار رمز عبور با رمز عبور باید یکسان باشد'));
    if ($this->form_validation->run()) {
      $datas = array(
        'fname' => $this->input->post('name'),
        'lname' => $this->input->post('lname'),
        'role' => $this->input->post('type'),
        'username' => $this->input->post('username'),
        'status' => $this->input->post('status'),
        'password' => $this->mylibrary->hash($this->input->post('password')),
        'uniqid' => uniqid()
      );
      $insert = $this->Admin_model->insert_user($datas);
      if ($insert[0]) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'کاربر جدید موفقانه اضافه شد';
        $data['alert']['type'] = 'success';

        $data['id'] = $insert[1];

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($insert[1], 'admin/delete_user', 'mr-left-0 btn-danger btn-group-right', 'trash');
        if ($datas['status'] == 'A') {
          $btns .= $this->mylibrary->generateBtnDelete($insert[1], 'admin/pending_user', 'mr-left-0 btn-info btn-group-left', 'clock-o');
        } else {
          $btns .= $this->mylibrary->generateBtnDelete($insert[1], 'admin/accept_user', 'mr-left-0 btn-info btn-group-left', 'check');
        }
        $data['tr'] = array(
          $datas['fname'],
          $datas['lname'],
          $datas['username'],
          $this->mylibrary->elsewise($datas['status'], 'A', "<span class='bg-green'>پذیرفته شده</span>", "<span class='bg-red'>انتظار</span>"),
          $this->mylibrary->elsewise($datas['role'], 'admin', 'مدیر', 'کاربر'),
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }

  public function accept_user()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('record', 'record', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $datas = array(
        'id' => $this->input->post('record')
      );
      $record = $this->input->post('record');
      if ($record == $this->session->userdata($this->mylibrary->hash_session('u_id'))) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'شما مجاز به ویرایش وضعیت حساب خود نیستید!!';
        $data['alert']['type'] = 'error';
        print_r(json_encode($data));
        exit;
      }
      $status = 'A';
      if ($this->Admin_model->change_user_status($status, $datas)) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'وضعیت کاربر موفقانه تغییر یافت';
        $data['alert']['type'] = 'success';


        $data['id'] = $record;

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($record, 'admin/delete_user', 'mr-left-0 btn-danger btn-group-right', 'trash');
        if ($status == 'A') {
          $btns .= $this->mylibrary->generateBtnStatus($record, 'admin/pending_user', 'mr-left-0 btn-info btn-group-left', 'clock-o');
        }else {
          $btns .= $this->mylibrary->generateBtnStatus($record, 'admin/accept_user', 'mr-left-0 btn-info btn-group-left', 'check');
        }
        $user = $this->Admin_model->single_user($record)[0];

        $data['tr'] = array(
          $user['fname'],
          $user['lname'],
          $user['username'],
          $this->mylibrary->elsewise($user['status'], 'A', "<span class='bg-green'>پذیرفته شده</span>", "<span class='bg-red'>انتظار</span>"),
          $this->mylibrary->elsewise($user['role'], 'admin', 'مدیر', 'کاربر'),
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }

  public function pending_user()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('record', 'record', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $datas = array(
        'id' => $this->input->post('record')
      );
      $record = $this->input->post('record');
      if ($record == $this->session->userdata($this->mylibrary->hash_session('u_id'))) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'شما مجاز به ویرایش وضعیت حساب خود نیستید!!';
        $data['alert']['type'] = 'error';
        print_r(json_encode($data));
        exit;
      }
      $status = 'P';
      if ($this->Admin_model->change_user_status($status, $datas)) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'وضعیت کاربر موفقانه تغییر یافت';
        $data['alert']['type'] = 'success';


        $data['id'] = $record;

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($record, 'admin/delete_user', 'mr-left-0 btn-danger btn-group-right', 'trash');
        if ($status == 'A') {
          $btns .= $this->mylibrary->generateBtnStatus($record, 'admin/pending_user', 'mr-left-0 btn-info btn-group-left', 'clock-o');
        }else {
          $btns .= $this->mylibrary->generateBtnStatus($record, 'admin/accept_user', 'mr-left-0 btn-info btn-group-left', 'check');
        }
        $user = $this->Admin_model->single_user($record)[0];

        $data['tr'] = array(
          $user['fname'],
          $user['lname'],
          $user['username'],
          $this->mylibrary->elsewise($user['status'], 'A', "<span class='bg-green'>پذیرفته شده</span>", "<span class='bg-red'>انتظار</span>"),
          $this->mylibrary->elsewise($user['role'], 'admin', 'مدیر', 'کاربر'),
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }

  public function delete_user()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('record', 'record', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $datas = array(
        'id' => $this->input->post('record')
      );
      $record = $this->input->post('record');
      if ($record == $this->session->userdata($this->mylibrary->hash_session('u_id'))) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'شما مجاز به حذف حساب خود نیستید!!';
        $data['alert']['type'] = 'error';
        print_r(json_encode($data));
        exit;
      }

      if ($record == $this->session->userdata($this->mylibrary->hash_session('u_id'))) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'شما مجاز به حذف حساب خود نیستید!!';
        $data['alert']['type'] = 'error';
        print_r(json_encode($data));
        exit;
      }
      $count_customer = count($this->Admin_model->get_customers_by_users_id($record));
      $count_loan = count($this->Admin_model->get_loan_by_users_id($record));
      $count_balance = count($this->Admin_model->get_balance_sheet_by_users_id($record));


      if ($count_customer > 0 || $count_balance > 0 || $count_loan > 0) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'شما مجاز به حذف حسابیکه اطلاعات قبلا ثبت کرده را ندارید!!';
        $data['alert']['type'] = 'error';
        print_r(json_encode($data));
        exit;
      }
      if ($this->Admin_model->delete_user($datas)) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'کاربر موفقانه حذف شد';
        $data['alert']['type'] = 'success';
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function customers()
  {
    $data['title'] = "حساب های مالی";
    $data['page'] = "customers";
    $data['customers'] = $this->Admin_model->get_customers();

    $this->load->view('header', $data);
    $this->load->view('customers/index', $data);
    $this->load->view('footer');
  }

  public function transfer()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('from', 'from', 'trim|required', array('required' => 'قسمت از حساب الزامیست'));
    $this->form_validation->set_rules('to', 'to', 'trim|required', array('required' => 'قسمت به حساب الزامیست'));
    $this->form_validation->set_rules('currency', 'currency', 'trim|required', array('required' => 'قسمت واحد پولی الزامیست'));
    $this->form_validation->set_rules('price', 'price', 'trim|required|is_natural_no_zero', array('required' => 'قسمت مبلغ الزامیست', 'is_natural_no_zero' => 'قسمت مبلغ باید عدد باشد'));
    if ($this->form_validation->run()) {

      $from_person = $this->Admin_model->single_customer(array('id' => $this->input->post('from')))[0];
      $to_person = $this->Admin_model->single_customer(array('id' => $this->input->post('to')))[0];

      $details = 'بابت انتقال پول از حساب (';
      $details .= $from_person['name'];
      $details .= ' - ';
      $details .= $from_person['fname'];
      $details .= ') به حساب (';
      $details .= $to_person['name'];
      $details .= ' - ';
      $details .= $to_person['fname'];
      $details .= ')';


      $data_from = array();

      $data_from['dr'] = $this->input->post('price');
      $data_from['currency'] = $this->input->post('currency');
      $data_from['shamsi'] = $this->mylibrary->getCurrentShamsiDate()['date'];
      $data_from['users_id'] = $this->session->userdata($this->mylibrary->hash_session('u_id'));
      $data_from['customers_id'] = $this->input->post('from');
      $data_from['remark'] = $details;


      $data_to = array();

      $data_to['cr'] = $this->input->post('price');
      $data_to['currency'] = $this->input->post('currency');
      $data_to['shamsi'] = $this->mylibrary->getCurrentShamsiDate()['date'];
      $data_to['users_id'] = $this->session->userdata($this->mylibrary->hash_session('u_id'));
      $data_to['customers_id'] = $this->input->post('to');
      $data_to['remark'] = $details;




      if ($this->Admin_model->insert_receipt($data_from)[0] && $this->Admin_model->insert_receipt($data_to)[0]) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'انتقال موفقانه انجام شد';
        $data['alert']['type'] = 'success';
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function delete_customer()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('record', 'record', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $datas = array(
        'id' => $this->input->post('record')
      );
      $record = $this->input->post('record');
      $count_balance = count($this->Admin_model->get_balance_sheet_by_customer_id($record));


      if ($count_balance > 0) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'شما مجاز به حذف حساب مالی که رسیدات مالی داشته باشد را ندارید!!';
        $data['alert']['type'] = 'error';
        print_r(json_encode($data));
        exit;
      }
      if ($this->Admin_model->delete_customer($datas)) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'حساب مالی موفقانه حذف شد';
        $data['alert']['type'] = 'success';
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }

  public function single_customer()
  {
    $this->form_validation->set_rules('slug', 'slug', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $data = array();
      $record = $this->input->post('slug');
      $datas = array(
        'id' => $record
      );
      $customer = $this->Admin_model->single_customer($datas);


      if (count($customer) > 0) {
        $data['type'] = 'success';
        $data['content'] = array(
          'slug' => $customer[0]['id'],
          'name' => $customer[0]['name'],
          'fname' => $customer[0]['fname'],
          'lname' => $customer[0]['lname'],
          'phone1' => $customer[0]['phone1'],
          'phone2' => $customer[0]['phone2'],
          'address' => $customer[0]['address'],
        );
      } else {
        $data['type'] = 'error';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      $data['type'] = 'error';
      $data['alert']['title'] = 'خطا';
      $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
      $data['alert']['type'] = 'error';
    }

    print_r(json_encode($data));
  }

  public function update_customers()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('slug', 'slug', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    $this->form_validation->set_rules('name', 'name', 'trim|required', array('required' => 'قسمت نام حساب مالی الزامیست'));
    $this->form_validation->set_rules('fname', 'fname', 'trim');
    $this->form_validation->set_rules('lname', 'lname', 'trim');
    $this->form_validation->set_rules('address', 'address', 'trim');
    if ($this->input->post('oldpage') == $this->input->post('page')) {
      $this->form_validation->set_rules('page', 'page', 'trim');
    } else {
      $this->form_validation->set_rules('page', 'page', 'trim|is_unique[customers.page]', array('is_unique' => 'صفحه وارد شده به حساب مالی دیگری ثبت شده است'));
    }

    if ($this->input->post('oldphone1') == $this->input->post('phone1')) {
      $this->form_validation->set_rules('phone1', 'phone1', 'trim');
    } else {
      $this->form_validation->set_rules('phone1', 'phone1', 'trim|is_unique[customers.phone1]', array('is_unique' => 'شماره تماس قبلا ثبت شده است'));
    }
    if ($this->input->post('oldphone2') == $this->input->post('phone2')) {
      $this->form_validation->set_rules('phone2', 'phone2', 'trim');
    } else {
      $this->form_validation->set_rules('phone2', 'phone2', 'trim|is_unique[customers.phone2]', array('is_unique' => 'شماره تماس ۲ که وارد نموده اید قبلا ثبت شده است'));
    }
    if ($this->form_validation->run()) {
      $id = $this->input->post('slug');
      $datas = array(
        'name' => $this->input->post('name'),
        'fname' => $this->input->post('fname'),
        'lname' => $this->input->post('lname'),
        'phone1' => $this->input->post('phone1'),
        'phone2' => $this->input->post('phone2'),
        'address' => $this->input->post('address'),
        'page' => $this->input->post('page')
      );
      $update = $this->Admin_model->update_customer($datas, $id);
      if ($update) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'حساب مالی موفقانه ویرایش گردید';
        $data['alert']['type'] = 'success';

        $data['id'] = $id;

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($id, 'admin/delete_customer', 'mr-left-0 btn-danger btn-group-right', 'trash');
        $btns .= $this->mylibrary->generateBtnUpdate($id, 'edit_customer', 'editModal', 'mr-left-0 btn-info btn-group-left', 'edit');

        $user = $this->Admin_model->user_by_customer_id($id)[0];

        $fullname = $user['fname'] . ' ' . $user['lname'];
        $data['tr'] = array(
          $datas['name'],
          $datas['fname'],
          $datas['lname'],
          $datas['phone1'],
          $datas['phone2'],
          $datas['page'],
          $datas['address'],
          $fullname,
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function receipt()
  {
    $data['title'] = "رسیدات ثبت شده";
    $data['page'] = "receipt";
    $data['customers'] = $this->Admin_model->get_customers();
    $data['receipt'] = $this->Admin_model->get_balance_sheet();
    $data['script'] = $this->mylibrary->script_datepicker();
    $this->load->view('header', $data);
    $this->load->view('receipt', $data);
    $this->load->view('footer');
  }

  public function insert_receipt()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required|is_natural_no_zero', array('required' => 'قسمت حساب مالی الزامیست', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    $this->form_validation->set_rules('type', 'type', 'trim|required', array('required' => 'قسمت نوعیت الزامیست'));
    $this->form_validation->set_rules('price', 'price', 'trim|required', array('required' => 'قسمت مبلغ الزامیست'));
    $this->form_validation->set_rules('desc', 'desc', 'trim');
    $this->form_validation->set_rules('types', 'types', 'trim');
    $this->form_validation->set_rules('date', 'date', 'trim|required', array('required' => 'قسمت تاریخ الزامیست'));
    $this->form_validation->set_rules('currency', 'currency', 'trim|required', array('required' => 'قسمت واحد الزامیست'));
    if ($this->form_validation->run()) {
      $price = $this->input->post('price');
      if ($this->input->post('type') == 'cr') {
        $cr = $price;
        $dr = 0;
      } else {
        $dr = $price;
        $cr = 0;
      }
      $datas = array(
        'customers_id' => $this->input->post('customer_id'),
        'dr' => $dr,
        'cr' => $cr,
        'shamsi' => $this->input->post('date'),
        'currency' => $this->input->post('currency'),
        'remark' => $this->input->post('desc'),
        'type' => $this->input->post('types'),
        'users_id' => $this->session->userdata($this->mylibrary->hash_session('u_id'))
      );

      if ($this->input->post('types') == 1) {
        $balances = $this->Admin_model->get_customer_balance($datas['customers_id']);
        $remarks = '';
        $type = $this->input->post('type');
        foreach ($balances as $balance) {
          if ($this->input->post('currency') == $balance['currency']) {
            if ($type == 'cr') {
              $balance['cr'] += $price;
            } elseif ($type == 'dr') {
              $balance['dr'] += $price;
            }
          }
          $final_balance = number_format($balance['cr'] - $balance['dr']);

          $remarks .= "مجموعه ";
          $remarks .= $this->saraf->get_currency($balance['currency']);
          $remarks .= " (";
          $remarks .= $final_balance;
          $remarks .= ") ";
        }
        $datas['remark'] .= ' ';
        $datas['remark'] .= $remarks;
      }
      $insert = $this->Admin_model->insert_receipt($datas);
      if ($insert[0]) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'رسید مالی جدید موفقانه اضافه شد';
        $data['alert']['type'] = 'success';

        $id = $insert[1];
        $data['id'] = $id;
        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($insert[1], 'admin/delete_receipt', 'mr-left-0 btn-danger btn-group-right', 'trash');
        $btns .= $this->mylibrary->generateBtnUpdate($insert[1], 'edit_receipt', 'editModal', 'mr-left-0 btn-info btn-group-left', 'edit');

        $customer = $this->Admin_model->customer_by_balance_id($id)[0];
        $data['tr'] = array(
          $this->saraf->customer_name($customer['name'], $customer['fname'], $customer['page']),
          $this->mylibrary->elsewise($this->input->post('type'), 'cr', 'رسید', 'برد'),
          $this->mylibrary->elsewise($this->input->post('type'), 'cr', $cr, $dr),
          $this->saraf->get_currency($this->input->post('currency')),
          $datas['shamsi'],
          $this->session->userdata($this->mylibrary->hash_session('u_fullname')),
          $datas['remark'],
          $this->mylibrary->btn_group($btns)
        );
        if ($this->input->post('types') == 1) {
          $data['class'] = 'bg-yellow';
        }
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }

  public function delete_receipt()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('record', 'record', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $datas = array(
        'id' => $this->input->post('record')
      );

      if ($this->Admin_model->delete_balance($datas)) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'رسید مالی موفقانه حذف شد';
        $data['alert']['type'] = 'success';
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function single_receipt()
  {
    $this->form_validation->set_rules('slug', 'slug', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $data = array();
      $record = $this->input->post('slug');
      $datas = array(
        'id' => $record
      );
      $balance = $this->Admin_model->single_balance($datas);


      if (count($balance) > 0) {
        $data['type'] = 'success';

        if ($balance[0]['dr'] == 0) {
          $price = $balance[0]['cr'];
          $type = 'cr';
        } else {
          $price = $balance[0]['dr'];
          $type = 'dr';
        }
        $data['content'] = array(
          'slug' => $balance[0]['id'],
          'customers_id' => $balance[0]['customers_id'],
          'price' => $price,
          'shamsi' => $balance[0]['shamsi'],
          'type' => $type,
          'types' => $balance[0]['type'],
          'currency' => $balance[0]['currency'],
          'remark' => $balance[0]['remark'],
        );
      } else {
        $data['type'] = 'error';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      $data['type'] = 'error';
      $data['alert']['title'] = 'خطا';
      $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
      $data['alert']['type'] = 'error';
    }

    print_r(json_encode($data));
  }

  public function update_receipt()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required|is_natural_no_zero', array('required' => 'قسمت حساب مالی الزامیست', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    $this->form_validation->set_rules('type', 'type', 'trim|required', array('required' => 'قسمت نوعیت الزامیست'));
    $this->form_validation->set_rules('price', 'price', 'trim|required', array('required' => 'قسمت مبلغ الزامیست'));
    $this->form_validation->set_rules('desc', 'desc', 'trim');
    $this->form_validation->set_rules('types', 'types', 'trim');
    $this->form_validation->set_rules('date', 'date', 'trim|required', array('required' => 'قسمت تاریخ الزامیست'));
    $this->form_validation->set_rules('currency', 'currency', 'trim|required', array('required' => 'قسمت واحد الزامیست'));
    if ($this->form_validation->run()) {
      $price = $this->input->post('price');
      if ($this->input->post('type') == 'cr') {
        $cr = $price;
        $dr = 0;
      } else {
        $dr = $price;
        $cr = 0;
      }
      $datas = array(
        'customers_id' => $this->input->post('customer_id'),
        'dr' => $dr,
        'cr' => $cr,
        'shamsi' => $this->input->post('date'),
        'currency' => $this->input->post('currency'),
        'remark' => $this->input->post('desc'),
        'type' => $this->input->post('types'),
      );
      $id = $this->input->post('slug');
      $update = $this->Admin_model->update_balance($datas, $id);
      if ($update) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'رسیدات مالی موفقانه ویرایش گردید';
        $data['alert']['type'] = 'success';

        $data['id'] = $id;

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($id, 'admin/delete_receipt', 'mr-left-0 btn-danger btn-group-right', 'trash');
        $btns .= $this->mylibrary->generateBtnUpdate($id, 'edit_receipt', 'editModal', 'mr-left-0 btn-info btn-group-left', 'edit');

        $customer = $this->Admin_model->customer_by_balance_id($id)[0];
        $user = $this->Admin_model->user_by_balance_id($id)[0];
        $fullname = $user['fname'] . ' ' . $user['lname'];
        $data['tr'] = array(
          $this->saraf->customer_name($customer['name'], $customer['fname'], $customer['page']),
          $this->mylibrary->elsewise($this->input->post('type'), 'cr', 'رسید', 'برد'),
          $price,
          $this->saraf->get_currency($this->input->post('currency')),
          $datas['shamsi'],
          $fullname,
          $datas['remark'],
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function report_receipt()
  {
    $this->form_validation->set_rules('from', 'from', 'trim|required', array('required' => 'قسمت از تاریخ الزامیست'));
    $this->form_validation->set_rules('to', 'to', 'trim|required', array('required' => 'قسمت الی تاریخ الزامیست'));
    if ($this->form_validation->run()) {
      $data = array();
      $from = $this->input->post('from');
      $to = $this->input->post('to');
      $extra = "DATE(shamsi) BETWEEN DATE('$from') AND DATE('$to') ";
      $balance = $this->Admin_model->get_report_balance_sheet($extra);


      if (count($balance) > 0) {
        $data['type'] = 'success';
        $data['tr'] = array();
        $data['id'] = array();
        $data['class'] = array();
        $number = 1;
        foreach ($balance as $receipt) {
          $btns = '';

          $btns .= $this->mylibrary->generateBtnDelete($receipt['id'], 'admin/delete_receipt', 'mr-left-0 btn-danger btn-group-right', 'trash');
          $btns .= $this->mylibrary->generateBtnUpdate($receipt['id'], 'edit_receipt', 'editModal', 'mr-left-0 btn-info btn-group-left', 'edit');

          $data['id'][] = $receipt['id'];
          $data['tr'][] = array(
            $number,
            $this->saraf->customer_name($receipt['name'], $receipt['fname'], $receipt['page']),
            $this->mylibrary->elsewise($receipt['dr'], 0, 'رسید', 'برد'),
            $this->mylibrary->elsewise($receipt['dr'], 0, $receipt['cr'], $receipt['dr']),
            $this->saraf->get_currency($receipt['currency']),
            $receipt['shamsi'],
            $receipt['first_name'] . ' ' . $receipt['last_name'],
            $receipt['remark'],
            $this->mylibrary->btn_group($btns)
          );
          if ($receipt['type'] == 1) {
            $data['class'][] = 'bg-yellow';
          } else {
            $data['class'][] = '';
          }
          $number++;
        }
      } else {
        $data['type'] = 'error';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      $data['type'] = 'error';
      $data['alert']['title'] = 'خطا';
      $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
      $data['alert']['type'] = 'error';
    }

    print_r(json_encode($data));
  }

  public function loan()
  {
    $data['title'] = "قرضه های کوچک";
    $data['page'] = "loan";
    $data['customers'] = $this->Admin_model->get_loan();
    $data['receipt'] = $this->Admin_model->get_balance_sheet();
    $data['script'] = $this->mylibrary->script_datepicker();
    $this->load->view('header', $data);
    $this->load->view('loan', $data);
    $this->load->view('footer');
  }

  public function insert_loan()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('name', 'name', 'trim|required', array('required' => 'قسمت نام الزامیست'));
    $this->form_validation->set_rules('phone', 'phone', 'trim');
    $this->form_validation->set_rules('date', 'date', 'trim|required', array('required' => 'قسمت تاریخ الزامیست'));
    $this->form_validation->set_rules('price', 'price', 'trim|required', array('required' => 'قسمت مقدار الزامیست'));
    $this->form_validation->set_rules('currency', 'currency', 'trim|required', array('required' => 'قسمت واحد الزامیست'));
    $this->form_validation->set_rules('remarks', 'remarks', 'trim');
    if ($this->form_validation->run()) {
      $datas = array(
        'name' => $this->input->post('name'),
        'phone' => $this->input->post('phone'),
        'date' => $this->input->post('date'),
        'price' => $this->input->post('price'),
        'currency' => $this->input->post('currency'),
        'remarks' => $this->input->post('remarks'),
        'users_id' => $this->session->userdata($this->mylibrary->hash_session('u_id'))
      );
      $insert = $this->Admin_model->insert_loan($datas);
      if ($insert[0]) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'قرضه کوچک موفقانه اضافه شد';
        $data['alert']['type'] = 'success';

        $data['id'] = $insert[1];

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($insert[1], 'admin/delete_loan', 'mr-left-0 btn-success btn-group-right', 'check');
        $btns .= $this->mylibrary->generateBtnUpdate($insert[1], 'edit_loan', 'editModal', 'mr-left-0 btn-info btn-group-left', 'edit');

        $data['tr'] = array(
          $datas['name'],
          $datas['phone'],
          $datas['date'],
          $datas['price'],
          $this->saraf->get_currency($datas['currency']),
          $this->session->userdata($this->mylibrary->hash_session('u_fullname')),
          $datas['remarks'],
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function delete_loan()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('record', 'record', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $datas = array(
        'id' => $this->input->post('record')
      );
      if ($this->Admin_model->delete_loan($datas)) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'قرضه کوچک موفقانه پرداخت شد!';
        $data['alert']['type'] = 'success';
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }

  public function single_loan()
  {
    $this->form_validation->set_rules('slug', 'slug', 'trim|required|is_natural_no_zero', array('required' => 'کدام مشکلی پیش آمده است', 'is_natural_no_zero' => 'کدام مشکلی پیش آمده است'));
    if ($this->form_validation->run()) {
      $data = array();
      $record = $this->input->post('slug');
      $datas = array(
        'id' => $record
      );
      $customer = $this->Admin_model->single_loan($datas);


      if (count($customer) > 0) {
        $data['type'] = 'success';
        $data['content'] = array(
          'slug' => $customer[0]['id'],
          'name' => $customer[0]['name'],
          'phone' => $customer[0]['phone'],
          'date' => $customer[0]['date'],
          'price' => $customer[0]['price'],
          'currency' => $customer[0]['currency'],
          'remarks' => $customer[0]['remarks'],
        );
      } else {
        $data['type'] = 'error';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      $data['type'] = 'error';
      $data['alert']['title'] = 'خطا';
      $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
      $data['alert']['type'] = 'error';
    }

    print_r(json_encode($data));
  }

  public function update_loan()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('name', 'name', 'trim|required', array('required' => 'قسمت نام الزامیست'));
    $this->form_validation->set_rules('phone', 'phone', 'trim');
    $this->form_validation->set_rules('date', 'date', 'trim|required', array('required' => 'قسمت تاریخ الزامیست'));
    $this->form_validation->set_rules('price', 'price', 'trim|required', array('required' => 'قسمت مقدار الزامیست'));
    $this->form_validation->set_rules('currency', 'currency', 'trim|required', array('required' => 'قسمت واحد الزامیست'));
    $this->form_validation->set_rules('remarks', 'remarks', 'trim');
    if ($this->form_validation->run()) {
      $datas = array(
        'name' => $this->input->post('name'),
        'phone' => $this->input->post('phone'),
        'date' => $this->input->post('date'),
        'price' => $this->input->post('price'),
        'currency' => $this->input->post('currency'),
        'remarks' => $this->input->post('remarks'),
        'users_id' => $this->session->userdata($this->mylibrary->hash_session('u_id'))
      );
      $id = $this->input->post('slug');
      $update = $this->Admin_model->update_loan($datas, $id);
      if ($update) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'قرضه کوچک موفقانه ویرایش گردید';
        $data['alert']['type'] = 'success';

        $data['id'] = $id;

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($id, 'admin/delete_loan', 'mr-left-0 btn-success btn-group-right', 'check');
        $btns .= $this->mylibrary->generateBtnUpdate($id, 'edit_loan', 'editModal', 'mr-left-0 btn-info btn-group-left', 'edit');

        $user = $this->Admin_model->user_by_loan_id($id)[0];
        $fullname = $user['fname'] . ' ' . $user['lname'];
        $data['tr'] = array(
          $datas['name'],
          $datas['phone'],
          $datas['date'],
          $datas['price'],
          $this->saraf->get_currency($datas['currency']),
          $fullname,
          $datas['remarks'],
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function report_user()
  {
    $data['title'] = "گزارش حساب های مالی";
    $data['page'] = "report_user";
    $data['balances'] = $this->Admin_model->get_report_balance_sheet();
    $data['customers'] = $this->Admin_model->get_customers();
    $data['script'] = $this->mylibrary->script_datepicker();
    $this->load->view('header', $data);
    $this->load->view('report_user', $data);
    $this->load->view('footer');
  }


  public function report_users_ajax()
  {
    $extra = null;
    if (!empty($this->input->post('customer'))) {
      $extra .= "balance_sheet.customers_id = '" . $this->input->post('customer') . "' ";
    }
    if (!empty($this->input->post('currency'))) {
      $extra .= "AND balance_sheet.currency = '" . $this->input->post('currency') . "' ";
    }

    $result = $this->Admin_model->get_report_balance_sheet($extra);






    $x = "<table class='table table-bordered'  id='table'>
      <thead>";
    $i = 1;
    foreach ($this->saraf->currency() as $key => $value) :
      if ($i % 2 == 1) {
        $x .= "<tr class='borderless'>";
      }
      $x .= "<td>مجموعه</td><td>";
      $x .= $value;
      $x .= "</td><td id='val_";
      $x .= $key;
      $x .= "' class='english'>";
      $x .= "</td>";
      if ($i % 2 == 1) {
        $x .= "<td></td>";
      }
      if ($i % 2 == 0) {
        $x .= "</tr>";
      }
      $i++;
    endforeach;
    $x .= "<tr>
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
      <tbody>";
    $sum = array();
    foreach ($this->saraf->currency() as $keys => $values) {
      $sum['cr_' . $keys] = 0;
      $sum['dr_' . $keys] = 0;
    }
    $i = 1;
    foreach ($result as $opd) :
      $x .= "<tr class='";
      if ($opd['type'] == 1) {
        $x .= "bg-yellow";
      }
      $x .= "'>
                  <td class='english'>";
      $x .= $i;
      $x .= "</td>
                  <td class='english'>";
      $x .= $opd['shamsi'];
      $x .= "</td>
                  <td>";
      $x .= $opd['name'];
      $x .= " - ";
      $x .= $opd['fname'];
      $x .= "</td>
                  <td>";
      $x .= $this->saraf->get_currency($opd['currency']);

      $x .= "</td>
                  <td class='english'>";
      if (!empty($opd['cr'])) {
        $x .= number_format($opd['cr']);
      } else {
        $x .= "0";
      }
      $x .= "</td>
                  <td class='english'>";
      if (!empty($opd['dr'])) {
        $x .= number_format($opd['dr']);
      } else {
        $x .= "0";
      }
      $x .= "</td>
                  <td>";
      $x .= mb_strimwidth($opd['remark'], 0, 110, '...');
      $x .= "</td>
              </tr>";
      foreach ($this->saraf->currency() as $key => $value) {
        if ($opd['currency'] == $key) {
          $sum['cr_' . $key] += $opd['cr'];
          $sum['dr_' . $key] += $opd['dr'];
        }
      }

      $i++;
    endforeach;
    foreach ($this->saraf->currency() as $key => $value) :
      $balance = $sum['cr_' . $key] - $sum['dr_' . $key];
    endforeach;
    $x .= "</tbody>
      <tfoot>";


    foreach ($this->saraf->currency() as $key => $value) :
      $balance = $sum['cr_' . $key] - $sum['dr_' . $key];
      $arr['balance_' . $key] = $sum['cr_' . $key] - $sum['dr_' . $key];
      $x .= "<tr>
              <td>
                  مجموعه
              </td>
              <td>";
      $x .= $value;
      $x .= "</td>
              <td></td>
              <td></td>
              <td class='english'>";
      $x .= number_format($sum['cr_' . $key]);
      $x .= "</td>
              <td class='english'>";
      $x .= number_format($sum['dr_' . $key]);
      $x .= "</td>
              <td class='english'><bdo dir='ltr'><span class='number ";
      if ($balance < 0) {
        $x .= "red";
      } else {
        $x .= "";
      }
      $x .= "'>";
      $x .= number_format($balance);
      $x .= "</span></bdo></td>
          </tr>";

    endforeach;


    $x .= "</tfoot>
      </table>";

    $arr['result'] = $x;
    print_r(json_encode($arr));
  }


  public function print_users_report()
  {
    $extra = null;
    if (!empty($this->input->post('customer'))) {
      $extra .= "balance_sheet.customers_id = '" . $this->input->post('customer') . "' ";
    }
    if (!empty($this->input->post('currency'))) {
      $extra .= "AND balance_sheet.currency = '" . $this->input->post('currency') . "' ";
    }

    $result = $this->Admin_model->get_report_balance_sheet($extra);
    if (!empty($_POST['customer'])) {
      $data = $this->Admin_model->single_customer(array('id' => $_POST['customer']));
      $data['title'] = $this->saraf->customer_name($data[0]['name'], $data[0]['fname']);
    }
    $data['opds'] = $result;
    $this->load->view('print_report_users', $data);
  }


  public function reports()
  {
    $data['title'] = "گزارش رسیدات مالی";
    $data['page'] = "reports";
    $data['balances'] = $this->Admin_model->get_report_balance_sheet();
    $data['customers'] = $this->Admin_model->get_customers();
    $data['script'] = $this->mylibrary->script_datepicker();
    $this->load->view('header', $data);
    $this->load->view('report_receipt', $data);
    $this->load->view('footer');
  }


  public function report_ajax()
  {
    $extra = null;
    $from = $this->input->post('from_date');
    $to = $this->input->post('to_date');
    $customer = $this->input->post('customer');
    $currency = $this->input->post('currency');
    if (isset($from) && isset($to)) {
      $extra .= "DATE(balance_sheet.shamsi) BETWEEN DATE('$from') AND DATE('$to') ";
      if (!empty($customer)) {
        $extra .= "AND balance_sheet.customers_id = '$customer' ";
      }
      if (!empty($currency)) {
        $extra .= "AND balance_sheet.currency = '$currency' ";
      }
    }

    $result = $this->Admin_model->get_report_balance_sheet($extra);


    $x = "<table class='table table-bordered'  id='table'>
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
        <tbody>";
    $sum = array();
    foreach ($this->saraf->currency() as $keys => $values) {
      $sum['cr_' . $keys] = 0;
      $sum['dr_' . $keys] = 0;
    }
    $i = 1;
    foreach ($result as $opd) :
      $x .= "<tr class='";
      if ($opd['type'] == 1) {
        $x .= "bg-yellow";
      }
      $x .= "'>
                    <td class='english'>";
      $x .= $i;
      $x .= "</td>
                    <td class='english'>";
      $x .= $opd['shamsi'];
      $x .= "</td>
                    <td>";
      $x .= $this->saraf->customer_name($opd['name'], $opd['fname']);
      $x .= "</td>
                    <td>";
      $x .= $this->saraf->get_currency($opd['currency']);

      $x .= "</td>
                    <td class='english'>";
      if (!empty($opd['cr'])) {
        $x .= number_format($opd['cr']);
      } else {
        $x .= "0";
      }
      $x .= "</td>
                    <td class='english'>";
      if (!empty($opd['dr'])) {
        $x .= number_format($opd['dr']);
      } else {
        $x .= "0";
      }
      $x .= "</td>
                    <td>";
      $x .= mb_strimwidth($opd['remark'], 0, 110, '...');
      $x .= "</td>
                </tr>";
      foreach ($this->saraf->currency() as $key => $value) {
        if ($opd['currency'] == $key) {
          $sum['cr_' . $key] += $opd['cr'];
          $sum['dr_' . $key] += $opd['dr'];
        }
      }


      $i++;
    endforeach;
    $x .= "</tbody>
        <tfoot>";


    foreach ($this->saraf->currency() as $key => $value) :
      $balance = $sum['cr_' . $key] - $sum['dr_' . $key];

      $x .= "<tr>
                <td>
                    مجموعه
                </td>
                <td>";
      $x .= $value;
      $x .= "</td>
                <td></td>
                <td></td>
                <td class='english'>";
      $x .= number_format($sum['cr_' . $key]);
      $x .= "</td>
                <td class='english'>";
      $x .= number_format($sum['dr_' . $key]);
      $x .= "</td>
                <td class='english'><bdo dir='ltr'><span class='number ";
      if ($balance < 0) {
        $x .= "red";
      } else {
        $x .= "";
      }
      $x .= "'>";
      $x .= number_format($balance);
      $x .= "</span></bdo></td>
            </tr>";

    endforeach;


    $x .= "</tfoot>
        </table>";

    echo $x;
  }


  public function print_report()
  {
    $extra = null;
    $from = $this->input->post('from_date');
    $to = $this->input->post('to_date');
    $customer = $this->input->post('customer');
    $currency = $this->input->post('currency');
    if (isset($from) && isset($to)) {
      $extra .= "DATE(balance_sheet.shamsi) BETWEEN DATE('$from') AND DATE('$to') ";
      if (!empty($customer)) {
        $extra .= "AND balance_sheet.customers_id = '$customer' ";
      }
      if (!empty($currency)) {
        $extra .= "AND balance_sheet.currency = '$currency' ";
      }
    }

    $result = $this->Admin_model->get_report_balance_sheet($extra);
    $data['title'] = 'گزارش رسیدات مالی از تاریخ ' . $from . ' الی ' . $to;
    $data['from'] = $from;
    $data['to'] = $to;
    $data['opds'] = $result;
    $this->load->view('print_report_receipt', $data);
  }


  public function reports_all()
  {
    $data['loan'] = $this->Admin_model->sum_loan();
    $data['opds'] = $this->Admin_model->users_dr_balance();
    $data['balances'] = $this->Admin_model->balance_currency();
    $data['page'] = 'reports_all';
    $data['title'] = 'گزارش کلی';
    $this->load->view('header', $data);
    $this->load->view('reports_all', $data);
    $this->load->view('footer', $data);
  }

  public function print_report_all()
  {
    $data['loan'] = $this->Admin_model->sum_loan();
    $data['title'] = 'گزارشات کلی';
    $data['balances'] = $this->Admin_model->balance_currency();
    $this->load->view('print_all', $data);
  }

  public function print_report_dr()
  {
    $data['title'] = 'گزارش کلی حسابات مالی';
    $data['opds'] = $this->Admin_model->users_dr_balance();
    $this->load->view('print_user_dr', $data);
  }

  public function insert_customers()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('name', 'name', 'trim|required', array('required' => 'قسمت نام حساب مالی الزامیست'));
    $this->form_validation->set_rules('fname', 'fname', 'trim');
    $this->form_validation->set_rules('lname', 'lname', 'trim');
    $this->form_validation->set_rules('address', 'address', 'trim');
    $this->form_validation->set_rules('page', 'page', 'trim|is_unique[customers.page]', array('is_unique' => 'صفحه وارد شده به حساب مالی دیگری ثبت شده است'));
    $this->form_validation->set_rules('phone1', 'phone1', 'trim|is_unique[customers.phone1]', array('is_unique' => 'شماره تماس قبلا ثبت شده است'));
    $this->form_validation->set_rules('phone2', 'phone2', 'trim|is_unique[customers.phone2]', array('is_unique' => 'شماره تماس ۲ که وارد نموده اید قبلا ثبت شده است'));
    if ($this->form_validation->run()) {
      $datas = array(
        'name' => $this->input->post('name'),
        'fname' => $this->input->post('fname'),
        'lname' => $this->input->post('lname'),
        'phone1' => $this->input->post('phone1'),
        'phone2' => $this->input->post('phone2'),
        'address' => $this->input->post('address'),
        'page' => $this->input->post('page'),
        'users_id' => $this->session->userdata($this->mylibrary->hash_session('u_id'))
      );
      $insert = $this->Admin_model->insert_customer($datas);
      if ($insert[0]) {
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'حساب مالی جدید موفقانه اضافه شد';
        $data['alert']['type'] = 'success';

        $data['id'] = $insert[1];

        $btns = '';

        $btns .= $this->mylibrary->generateBtnDelete($insert[1], 'admin/delete_customer', 'mr-left-0 btn-danger btn-group-right', 'trash');
        $btns .= $this->mylibrary->generateBtnUpdate($insert[1], 'edit_customer', 'editModal', 'mr-left-0 btn-info btn-group-left', 'edit');

        $data['tr'] = array(
          $datas['name'],
          $datas['fname'],
          $datas['lname'],
          $datas['phone1'],
          $datas['phone2'],
          $datas['page'],
          $datas['address'],
          $this->session->userdata($this->mylibrary->hash_session('u_fullname')),
          $this->mylibrary->btn_group($btns)
        );
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }

  public function profile()
  {
    $data['title'] = 'پروفایل';
    $data['page'] = 'پروفایل';
    $data['single'] = $this->Admin_model->single_user($this->session->userdata($this->mylibrary->hash_session('u_id')));
    $this->load->view('header', $data);
    $this->load->view('profile', $data);
    $this->load->view('footer', $data);
  }


  public function update_profile()
  {
    $data = array('type' => 'form_error', 'messages' => array());
    $this->form_validation->set_rules('first_name', 'first_name', 'trim|required', array('required' => 'قسمت نام الزامیست'));
    $this->form_validation->set_rules('last_name', 'last_name', 'trim');
    if ($this->input->post('password') !== '') {
      $this->form_validation->set_rules('password', 'password', 'trim');
      $this->form_validation->set_rules('password_new', 'password_new', 'trim|required', array('required' => 'قسمت رمز عبور جدید الزامیست'));
      $this->form_validation->set_rules('confirm', 'confirm', 'trim|matches[password_new]|required', array('matches' => 'قسمت تکرار رمز عبور  باید با رمز عبور جدید برابر باشد', 'required' => 'قسمت تکرار رمز عبور الزامیست'));
    }
    if ($this->form_validation->run()) {
      $datas = array(
        'fname' => $this->input->post('first_name'),
        'lname' => $this->input->post('last_name'),
      );
      if ($this->input->post('password') !== '') {
        $user = $this->Admin_model->single_user($this->session->userdata($this->mylibrary->hash_session('u_id')))[0];
        if ($this->mylibrary->hash($this->input->post('password')) == $user['password']) {
          $datas['password'] = $this->mylibrary->hash($this->input->post('password_new'));
        } else {
          $data['type'] = 'error';
          $data['alert']['title'] = 'خطا';
          $data['alert']['text'] = 'رمز عبور قدیمی اشتباه است';
          $data['alert']['type'] = 'error';
          print_r(json_encode($data));
          exit();
        }

        if (!empty($_FILES['users_file']['name'])) {
					$config = array(
						'upload_path' => './assets/user_images/',
						'allowed_types' => 'gif|jpg|png|jpeg',
						'encrypt_name' => true,
						'remove_spaces' => true,
						'detect_mime' => true
					);
					$this->load->library('upload', $config);

					// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
					$this->upload->initialize($config);

					if ($this->upload->do_upload('users_file')) {
						if ($this->input->post('old_photo') !== "default.png") {
							unlink('assets/user_images/' . $this->input->post('old_photo'));
						}
						$data['photo'] = $this->upload->data('file_name');
						$this->session->set_userdata($this->mylibrary->hash_session('u_photo'), $this->upload->data('file_name'));
					} else {
						$this->session->set_flashdata('er_msg', $this->upload->display_errors());
					}
				}

      }
      $update = $this->Admin_model->update_user($datas, $this->session->userdata($this->mylibrary->hash_session('u_id')));
      if ($update) {
        $fullname = $datas['fname'] . ' ' . $datas['lname'];
        $sesdata = array(
          $this->mylibrary->hash_session('u_fullname') => $fullname,
        );
        $this->session->set_userdata($sesdata);
        $data['type'] = 'success';
        $data['alert']['title'] = 'موفقیت';
        $data['alert']['text'] = 'پروفایل موفقانه ویرایش گردید';
        $data['alert']['type'] = 'success';
      } else {
        $data['type'] = 'success';
        $data['alert']['title'] = 'خطا';
        $data['alert']['text'] = 'کدام مشکلی پیش آمده است!';
        $data['alert']['type'] = 'error';
      }
    } else {
      foreach ($_POST as $key => $value) {
        if (form_error($key) !== '') {
          $error = form_error($key);
          $data['messages'][] = substr($error, 3, -4);
        }
      }
    }

    print_r(json_encode($data));
  }


  public function logout()
  {
    session_destroy();
    redirect(base_url());
  }
}
