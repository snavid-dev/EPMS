<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mylibrary
{

  private  function div($a, $b)
  {
    return (int) ($a / $b);
  }

  public function hash($field)
  {
        return md5(md5(md5($field) . md5('CdsaffddsafyBOrGTfge$cdasfh')) . 'CyBbgjnuhOrGTe$ch');
  }

  public function hash_session($session)
  {
    return md5(md5(md5($session) . md5('Csdfddsf1234nm xasfgsfh')) . 'CyBOrGsfbnbvcxfsde$ch');
  }

  public function elsewise($status, $equal, $if, $else)
  {
    if ($status == $equal) {
      return $if;
    } else {
      return $else;
    }
  }

  public function btn_group($buttons = null)
  {
    $template = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">' . $buttons . '</div>';
    return $template;
  }

  public function generateBtnDelete($id, $urls, $classname, $icon)
  {

    $url = base_url($urls);
    $btns = '<button type="button" onclick="xhrDelete(' . $id . ', `' . $url . '`)" class="btn btn-secondary ' . $classname . '"><i class="fa fa-' . $icon . '"></i></button>';
    return $btns;
  }

  public function generateBtnStatus($id, $urls, $classname, $icon)
  {

    $url = base_url($urls);
    $btns = '<button type="button" onclick="change_status(' . $id . ', `' . $url . '`)" class="btn btn-secondary ' . $classname . '"><i class="fa fa-' . $icon . '"></i></button>';
    return $btns;
  }


  public function generateBtnUpdate($id, $fun_name, $modalId,$classname, $icon)
  {

    $btns = '<button class="btn btn-secondary ' . $classname . '" onclick="'. $fun_name .'(' . $id . ')"  data-target="#'. $modalId .'" data-toggle="modal"><i class="fa fa-' . $icon . '"></i></button>';
    return $btns;
  }

  public function getCurrentShamsiDate()
  {
    $dateTime = explode(' ', date("Y-m-d H:i:s"));
    $date = explode('-', $dateTime[0]);

    $date = $this->gregorian_to_jalali($date[0], $date[1], $date[2], "/");
    $dateupdate = explode('/', $date);

    $year = $dateupdate[0];
    $month = ($dateupdate[1] > 9) ? $dateupdate[1] : '0' . $dateupdate[1];
    $day = ($dateupdate[2] > 9) ? $dateupdate[2] : '0' . $dateupdate[2];


    $dateupdate = $year . '/' . $month . '/' . $day;

    $time = explode(':', $dateTime[1]);
    $hours = $time[0];
    $minets = $time[1];
    $seconds = $time[2];

    $ampm = $hours >= 12 ? 'PM' : 'AM';
    $hours = $hours % 12;
    $hours = $hours ? $hours : 12;
    $time = $hours . ':' . $minets . ':' . $seconds . ' ' . $ampm;
    return array('date' => $dateupdate, 'time' => $time);
  }

  private  function gregorian_to_jalali($g_y, $g_m, $g_d, $str)
  {
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;

    $g_day_no = 365 * $gy + $this->div($gy + 3, 4) - $this->div($gy + 99, 100) + $this->div($gy + 399, 400);

    for ($i = 0; $i < $gm; ++$i)
      $g_day_no += $g_days_in_month[$i];
    if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
      /* leap and after Feb */
      $g_day_no++;
    $g_day_no += $gd;

    $j_day_no = $g_day_no - 79;

    $j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
    $j_day_no = $j_day_no % 12053;

    $jy = 979 + 33 * $j_np + 4 * $this->div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */

    $j_day_no %= 1461;

    if ($j_day_no >= 366) {
      $jy += $this->div($j_day_no - 1, 365);
      $j_day_no = ($j_day_no - 1) % 365;
    }

    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
      $j_day_no -= $j_days_in_month[$i];
    $jm = $i + 1;
    $jd = $j_day_no + 1;
    if ($str)
      return $jy . '/' . $jm . '/' . $jd;
    return array($jy, $jm, $jd);
  }
  public  function getCurrentShamsiDate_back()
  {
    $dateTime = explode(' ', date("Y-m-d H:i:s"));
    $date = explode('-', $dateTime[0]);

    $date = $this->gregorian_to_jalali($date[0], $date[1], $date[2], "/");
    $dateupdate = explode('/', $date);

    $year = $dateupdate[0];
    $month = ($dateupdate[1] > 9) ? $dateupdate[1] : '0' . $dateupdate[1];
    $day = ($dateupdate[2] > 9) ? $dateupdate[2] : '0' . $dateupdate[2];


    $dateupdate = $year . '_' . $month . '_' . $day;

    $time = explode(':', $dateTime[1]);
    $hours = $time[0];
    $minets = $time[1];
    $seconds = $time[2];

    $ampm = $hours >= 12 ? 'PM' : 'AM';
    $hours = $hours % 12;
    $hours = $hours ? $hours : 12;
    $time = $hours . ':' . $minets . ':' . $seconds . ' ' . $ampm;
    return array('date' => $dateupdate, 'time' => $time);
  }

  public function check_theme()
  {
    if (!isset($_COOKIE['color'])) {
      setcookie('color', 'light', time() + (86400 * 30), "/");
    }

    if (!isset($_COOKIE['menu'])) {
      setcookie('menu', 'top', time() + (86400 * 30), "/");
    }

    if (!isset($_COOKIE['full_screen'])) {
      setcookie('full_screen', true, time() + (86400 * 30), "/");
    }
  }

  public static function themes($theme)
  {
    switch ($theme) {
      case 'dark':
        setcookie('color', 'dark', time() + (86400 * 30), "/");
        header('Location: ../');
        break;

      case 'light':
        setcookie('color', 'light', time() + (86400 * 30), "/");
        header('Location: ../');
        break;

      case 'full_screen':
        setcookie('full_screen', true, time() + (86400 * 30), "/");
        header('Location: ../');
        break;

      case 'border_less':
        setcookie('full_screen', 'border_less', time() + (86400 * 30), "/");
        header('Location: ../');
        break;

      case 'right':
        setcookie('menu', 'right', time() + (86400 * 30), "/");
        header('Location: ../');
        break;

      case 'top':
        setcookie('menu', 'top', time() + (86400 * 30), "/");
        header('Location: ../');
        break;


      default:
        setcookie('color', 'light', time() + (86400 * 30), "/");
        header('Location: ../');
        break;
    }
  }

  public function script_datepicker()
  {
      return $x = "
  document.addEventListener('DOMContentLoaded', function () {
    jalaliDatepicker.startWatch();
  });";
  }
}
