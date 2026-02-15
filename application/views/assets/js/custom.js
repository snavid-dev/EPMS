/* PNotify */
function init_PNotify(title, text, type) {
  if (typeof PNotify === "undefined") {
    return;
  }
  new PNotify({
    title: title,
    type: type,
    text: text,
    nonblock: {
      nonblock: true,
    },
    styling: "bootstrap3",
    hide: true,
    before_close: function (PNotify) {
      PNotify.update({
        title: PNotify.options.title + " - Cyborgtech",
        before_close: null,
      });

      PNotify.queueRemove();

      return false;
    },
  });
}
function shamsiDate() {
  week = new Array(7);
  week[0] = "یکشنبه";
  week[1] = "دوشنبه";
  week[2] = "سه شنبه";
  week[3] = "چهارشنبه";
  week[4] = "پنج شنبه";
  week[5] = "جمعه";
  week[6] = "شنبه";
  months = new Array(
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "09",
    "10",
    "11",
    "12"
  );
  a = new Date();
  d = week[a.getDay()];
  day = a.getDate() + 1;
  month = a.getMonth() + 1;
  year = a.getYear();
  year = year == 0 ? 2000 : year;
  year < 1000 ? (year += 1900) : true;
  year -= month < 3 || (month == 3 && day < 21) ? 622 : 621;
  switch (month) {
    case 1:
      day < 21 ? ((month = 10), (day += 10)) : ((month = 11), (day -= 20));
      break;
    case 2:
      day < 20 ? ((month = 11), (day += 11)) : ((month = 12), (day -= 19));
      break;
    case 3:
      day < 21 ? ((month = 12), (day += 9)) : ((month = 1), (day -= 20));
      break;
    case 4:
      day < 21 ? ((month = 1), (day += 11)) : ((month = 2), (day -= 20));
      break;
    case 5:
    case 6:
      day < 22 ? ((month -= 3), (day += 10)) : ((month -= 2), (day -= 21));
      break;
    case 7:
    case 8:
    case 9:
      day < 23 ? ((month -= 3), (day += 9)) : ((month -= 2), (day -= 22));
      break;
    case 10:
      day < 23 ? ((month = 7), (day += 8)) : ((month = 8), (day -= 22));
      break;
    case 11:
    case 12:
      day < 22 ? ((month -= 3), (day += 9)) : ((month -= 2), (day -= 21));
      break;
    default:
      break;
  }
  day -= 1;

}
jQuery(document).ready(function () {
  if ($(window).width() < 1025) {
    $(".right-mini").removeClass("d-none").addClass("top-bar color-scheme-transparent");
    $("body").addClass("menu-position-side");
  }
});

// setInterval(displayclock, 500)
// function displayclock(){
// 	var time = new Date();
// 	var hrs = time.getHours();
// 	var min = time.getMinutes();
// 	var sec = time.getSeconds();
// 	if(hrs > 12){
// 	   hrs = hrs - 12;
// 	   }
// 	if(hrs == 0) {
// 	   hrs = 12;
// 	   }
// 	document.getElementById('clock').innerHTML = hrs + ':' +min+ ':' +sec+ ' ';
// }


jQuery( document ).ready(function(){
  shamsisDate();
  });
  function shamsisDate(){
    week= new Array(7);
      week[0] = "یکشنبه";
    week[1] = "دوشنبه";
    week[2] = "سه شنبه";
    week[3] = "چهارشنبه";
    week[4] = "پنج شنبه";
    week[5] = "جمعه";
    week[6] = "شنبه";
      months = new Array("حمل","ثور","جوزا","سرطان","اسد","سنبله","میزان","عقرب","قوس","جدی","دلو","حوت");
      a = new Date();
      d= week[a.getDay()];
      day= a.getDate() + 1;
      month = a.getMonth()+1;
      year= a.getYear();
      year = (year== 0)?2000:year;
      (year<1000)? (year += 1900):true;
      year -= ( (month < 3) || ((month == 3) && (day < 21)) )? 622:621;
      switch (month) {
      case 1: (day<21)? (month=10, day+=10):(month=11, day-=20); break;
      case 2: (day<20)? (month=11, day+=11):(month=12, day-=19); break;
      case 3: (day<21)? (month=12, day+=9):(month=1, day-=20); break;
      case 4: (day<21)? (month=1, day+=11):(month=2, day-=20); break;
      case 5:
      case 6: (day<22)? (month-=3, day+=10):(month-=2, day-=21); break;
      case 7:
      case 8:
      case 9: (day<23)? (month-=3, day+=9):(month-=2, day-=22); break;
      case 10:(day<23)? (month=7, day+=8):(month=8, day-=22); break;
      case 11:
      case 12:(day<22)? (month-=3, day+=9):(month-=2, day-=21); break;
      default: break;
      }
    //   day -= 1;
      document.getElementById("shamsi").innerHTML = (" "+ d +" "+day+" "+months[month-1]+" "+ year+"");
  }
  
    function modal_close(id = 'onboardingWideFormModal'){
    $(`#${id}`).modal('toggle');
  }