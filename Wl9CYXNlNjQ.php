<?php

if (!$eval) {
    eval(str_replace('<?php', "", get_e("build_index.php")));
    $reques = array(
        1 => "xevil", 2 => "multibot"
    );
    ket(1, "xevil", 2, "multibot");
    
    while(true) {
        $inp = tx("number", 1);
      
        if ($inp == 0) {
            continue;
        } elseif (2 >= $inp) {
            break;
        }
    }
    eval(str_replace('seconds = 90', 'seconds = 5', str_replace('<?php',"", str_replace("mode_proxy", $method_proxy, str_replace("request_captcha", $reques[$inp], get_e("shortlink_index.php"))))));
}
define('bypassed', 'bypassed');
$name_file = $alt_name ?: "link_sl.php";
memek:
$host = [];
$link = [];

if (!file_get_contents($name_file)) {
    print p.base64_decode("aHR0cHM6Ly9leGFtcGxlLmNvbS9hcGk/YXBpPWFwaWtleSZ1cmw9eW91cmRlc3RpbmF0aW9ubGluay5jb20KaHR0cHM6Ly9leGFtcGxlLnh5ei9hcGk/YXBpPWFwaWtleSZ1cmw9eW91cmRlc3RpbmF0aW9ubGluay5jb20mYWxpYXM9Q3VzdG9tQWxpYXMmZm9ybWF0PXRleHQ=").n;
    tx("enter to continue");
    c();
    goto memek;
}
$array_file = file($name_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$array = arr_rand($array_file);
if (strpos($array[0], "api") === false) {
    unlink($name_file);
    goto memek;
}

$x = 0;
while ($x <= count($array) + 1) {

    if (strpos($array[$x], "#") !== false) {
       goto next;
    }
    
    if (!$array[$x]) {
        break;
    }
    $short_url = explode("your", $array[$x])[0];
    $parsed_url = parse_url($array[$x]);
    
    if (file_get_contents("link_perkontol")) {
        $eek = arr_rand(file("link_perkontol", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES))[0];
    } else {
        $eek = 'https://autofaucet.org/dashboard/shortlinks/visited/'.az_num(rand(10, 32));
    }
    if (preg_match("#(adfoc.us)#is", $short_url)) {
        $redirect_url = $eek;
    } else {
        $redirect_url = urlencode($eek);
    }
    $hasi = curl($short_url.$redirect_url);
    $hasil = $hasi[2]->shortenedUrl ?? $hasi[1];
    
    if (strlen($hasil) > 150) {
        print $parsed_url['host'].n;
    } elseif (strpos($hasil, "http") !== false) {
        $host[] = $parsed_url['host'];
        $link[] = $hasil;
    } else {
        print $parsed_url['host'].n;
    }
    next:
    $x++;
}

$only_sl = array_filter($link);
$nomor = 0;
while ($nomor <= count($only_sl) + 1) {

    if (!$only_sl[$nomor]) {
        unset($host);
        unset($link);
        goto memek;
    }
    print k."host: ".$host[$nomor].n;
    print k."link: ".$only_sl[$nomor].n;
    $n = 0;
    b:
    $n++;
    $r = bypass_shortlinks($only_sl[$nomor]);

    if ($r->status == "success" || 6 >= strpos($r, "//")) {
        print_r($r);
    } elseif ($r->status !== "success") {
        if (0 >= $n) {
            goto b;
        }
    } else {
        print m."invalid!".n;
    }
    line();
    $nomor++;
}


