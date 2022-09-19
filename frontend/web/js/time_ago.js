

function get_period_string($seconds) {
    if ($seconds < 60) {
        if ($seconds == 0) $seconds = 1;
        $out = plural_form($seconds, ' секунду', ' секунды', ' секунд');
    } else if ($seconds < 60 * 60) {
        $period = Math.floor($seconds / 60);
        $out = plural_form($period, ' минуту', ' минуты', ' минут');
    } else if ($seconds < 60 * 60 * 24) {
        $period = Math.floor($seconds / (60 * 60));
        $out = plural_form($period, ' час', ' часа', ' часов');
    } else if ($seconds < 60 * 60 * 24 * 30) {
        $period = Math.ceil($seconds / (60 * 60 * 24));
        $out = plural_form($period, ' день', ' дня', ' дней');
    } else if ($seconds < 60 * 60 * 24 * 30 * 12) {
        $period = Math.floor($seconds / (60 * 60 * 24 * 30));
        $out = plural_form($period, ' месяц', ' месяца', ' месяцев');
    } else {
        $period = Math.floor($seconds / (60 * 60 * 24 * 30 * 12));
        $out = plural_form($period, ' год', ' года', ' лет');
    }
    return $out;
}



function plural_form($n, $form1, $form2, $form3) {
    $n1 = Math.abs($n) % 100;
    $n2 = $n1 % 10;
    if ($n1 > 10 && $n1 < 20) $out = $form3;
    else if ($n2 > 1 && $n2 < 5) $out = $form2;
    else if ($n2 == 1) $out = $form1;
    else $out = $form3;
    return $n + $out;
}


function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k).toFixed(prec);
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
if (!Date.now) {
    Date.now = function() {
        return new Date().getTime();
    }
}

function calculate_time_ago() {
    var current_timestamp = Math.floor(Date.now() / 1000);
   // console.log(localStorage);
  //  var localStorage['time_offset'] = 1;
  //  if (localStorage['time_offset']) {
  var x = new Date();
//var currentTimeZoneOffsetInHours = (x.getTimezoneOffset() / 60)+2;
//console.log(x.getTimezoneOffset());
            current_timestamp = current_timestamp - parseInt((x.getTimezoneOffset()+180)*60);
        $('.time_ago').each(function(i, item) {
            var time = current_timestamp - parseInt($(item).data('timestamp'));
            if (time < 0) return false;
            $(item).html(get_period_string(time) + ' назад');
        });
  //  }
}

calculate_time_ago();
setInterval(calculate_time_ago, 1000 * 60);
