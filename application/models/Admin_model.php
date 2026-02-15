<?php

class Admin_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function get_users()
  {
    return $this->db->get('users')->result_array();
  }

  public function insert_user($data = array())
  {
    $log = $this->db->insert('users', $data);
    $id = $this->db->insert_id();

    return array($log, $id);
  }

  public function delete_user($data = array())
  {
    return $this->db->delete('users', array('id' => $data['id']));
  }
  public function get_customers_by_users_id($id)
  {
    return $this->db->get_where('customers', array('users_id' => $id))->result_array();
  }

  public function get_balance_sheet_by_users_id($id)
  {
    return $this->db->get_where('balance_sheet', array('users_id' => $id))->result_array();
  }
  public function get_loan_by_users_id($id)
  {
    return $this->db->get_where('loan', array('users_id' => $id))->result_array();
  }

  public function get_customers()
  {
    return $this->db->query("SELECT customers.*, users.fname AS 'firstname', users.lname AS 'lastname' FROM customers INNER JOIN users ON customers.users_id = users.id  ORDER BY customers.id DESC")->result_array();
  }

  public function insert_customer($data = array())
  {
    $log = $this->db->insert('customers', $data);
    $id = $this->db->insert_id();

    return array($log, $id);
  }

  public function get_balance_sheet_by_customer_id($id)
  {
    return $this->db->get_where('balance_sheet', array('customers_id' => $id))->result_array();
  }

  public function delete_customer($where = array())
  {
    return $this->db->delete('customers', $where);
  }
  public function single_customer($where = array())
  {
    return $this->db->get_where('customers', $where)->result_array();
  }

  public function update_customer($data, $id)
  {
    return $this->db->update('customers', $data, array('id' => $id));
  }

  public function user_by_customer_id($id)
  {
    return $this->db->query("SELECT users.fname, users.lname FROM `customers` INNER JOIN users ON customers.users_id = users.id WHERE customers.id = $id")->result_array();
  }

  public function user_by_balance_id($id)
  {
    return $this->db->query("SELECT users.fname, users.lname FROM `balance_sheet` INNER JOIN users ON balance_sheet.users_id = users.id WHERE balance_sheet.id = $id")->result_array();
  }

  public function get_balance_sheet()
  {
    $date = $this->mylibrary->getCurrentShamsiDate()['date'];
    return $this->db->query("SELECT `balance_sheet`.*, users.fname AS 'firstname', users.lname AS 'lastname', customers.name, customers.fname FROM `balance_sheet` INNER JOIN `users` ON balance_sheet.users_id = users.id INNER JOIN customers ON balance_sheet.customers_id = customers.id WHERE DATE(`balance_sheet`.`shamsi`) BETWEEN DATE('" . $date . "') AND DATE('" . $date . "')  
        ORDER BY `balance_sheet`.`id` DESC")->result_array();
  }

  public function get_report_balance_sheet($extra = null)
  {
    if (is_null($extra)) {
      $extra = "DATE(shamsi) = DATE('" . $this->mylibrary->getCurrentShamsiDate()['date'] . "')";
    }

    return $this->db->query("SELECT `balance_sheet`.*,  customers.name, customers.fname, customers.page, users.fname AS 'first_name', users.lname AS 'last_name' FROM `balance_sheet` INNER JOIN `customers` ON balance_sheet.customers_id = customers.id INNER JOIN `users` ON `balance_sheet`.users_id = users.id WHERE " . $extra . " ORDER BY `balance_sheet`.`shamsi` ASC;")->result_array();
  }

  public function insert_receipt($data = array())
  {
    $log = $this->db->insert('balance_sheet', $data);
    $id = $this->db->insert_id();

    return array($log, $id);
  }

  public function get_customer_balance($customer_id = null)
  {
    return $this->db->query("SELECT SUM(cr) AS 'cr', SUM(dr) AS 'dr', currency FROM `balance_sheet` WHERE customers_id = '$customer_id' GROUP BY currency;")->result_array();
  }

  public function customer_by_balance_id($id = null)
  {
    return $this->db->query("SELECT customers.name, customers.fname, customers.page FROM `balance_sheet` INNER JOIN customers ON balance_sheet.customers_id = customers.id WHERE balance_sheet.id = $id")->result_array();
  }

  public function delete_balance($where)
  {
    return $this->db->delete('balance_sheet', $where);
  }
  public function single_balance($where = array())
  {
    return $this->db->get_where('balance_sheet', $where)->result_array();
  }

  public function get_loan()
  {
    return $this->db->query("SELECT loan.*, users.fname, users.lname FROM `loan` INNER JOIN users ON loan.users_id = users.id")->result_array();
  }

  public function update_balance($data, $id)
  {
    return $this->db->update('balance_sheet', $data, array('id' => $id));
  }

  public function insert_loan($data = array())
  {
    $log = $this->db->insert('loan', $data);
    $id = $this->db->insert_id();

    return array($log, $id);
  }
  public function delete_loan($where = array())
  {
    return $this->db->delete('loan', $where);
  }
  public function single_loan($where = array())
  {
    return $this->db->get_where('loan', $where)->result_array();
  }

  public function update_loan($data = array(), $id)
  {
    return $this->db->update('loan', $data, array('id' => $id));
  }

  public function user_by_loan_id($id)
  {
    return $this->db->query("SELECT users.fname, users.lname FROM `loan` INNER JOIN users ON loan.users_id = users.id WHERE loan.id = $id")->result_array();
  }

  public function sum_loan()
  {
    return $this->db->query("SELECT SUM(price) AS 'sum_price', currency FROM `loan` GROUP BY currency ORDER BY currency ASC;")->result_array();
  }
  public function users_dr_balance()
  {
    return $this->db->query("SELECT customers.name, customers.fname, `balance_sheet`.currency, SUM(`balance_sheet`.cr) AS 'sum_cr', SUM(`balance_sheet`.dr) AS 'sum_dr' FROM balance_sheet INNER JOIN customers ON balance_sheet.customers_id = customers.id GROUP BY balance_sheet.customers_id, balance_sheet.currency  ORDER BY balance_sheet.customers_id DESC;")->result_array();
  }

  public function balance_currency()
  {
    return $this->db->query("SELECT SUM(cr) AS 'cr', SUM(dr) AS 'dr', balance_sheet.currency FROM balance_sheet GROUP BY currency;")->result_array();
  }


  public function single_user($id)
  {
    return $this->db->get_where('users', array('id' => $id))->result_array();
  }

  public function update_user($data = array(), $id)
  {
    return $this->db->update('users', $data, array('id' => $id));
  }

  public function change_user_status($staus, $where = array())
  {
    return $this->db->update('users', array('status'=>$staus), $where);
  }

  public function count_balance()
    {
      $date = $this->mylibrary->getCurrentShamsiDate()['date'];
        return $this->db->query("SELECT * FROM `balance_sheet` WHERE shamsi = '$date'")->result_array();
    }
}
