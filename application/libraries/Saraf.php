<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Saraf
{
  public function __construct()
  {
  }
  public function currency()
  {
    $currency = array(
      'a' => 'افغانی',
      't' => 'تومان',
      "tch" => "تومان چک",
    );
    return $currency;
  }

  public function info()
  {
    $info = array(
      'name' => 'صرافی محمد نعیم بلوچ',
      'phone' => "+93 787 37 85 20 - +93 796 92 42 68"
    );
    return $info;
  }

  public function get_currency($currency)
  {
    switch ($currency) {
      case 'a':
        return 'افغانی';
      case 'd':
        return 'دالر';
      case 't':
        return 'تومان';
      case 'dar':
        return 'درهم';
      case 'k':
        return 'کلدار';
        case 'tch':
            return 'تومان چک';
      default:
        return 'افغانی';
        break;
    }
  }

  public function customer_name($name, $fname, $page = '')
  {
    $fullname = $name;
    if ($fname !== '') {
      $fullname .= ' - ';
      $fullname .= $fname;
    }
    if ($page !== '' && $page !== '0') {
      $fullname .= ' (';
      $fullname .= $page;
      $fullname .= ')';
    }

    return $fullname;
  }
}
