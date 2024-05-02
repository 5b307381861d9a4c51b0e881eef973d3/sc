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
memek:
if (!file_get_contents("link_sl.php")) {
    print p.base64_decode("PD9waHAgJGxpbmsgPSBhcnJheSgpOwkbGlzdF9hcnJheSA9IFsNCgkJWyJkb21haW4iLCAiYXBpa2V5Il0sDQoJWyJkb21haW4iLCAiYXBpa2V5Il0sDQoJWyJkb21haW4iLCAiYXBpa2V5Il0sDQoJWyJkb21haW4iLCAiYXBpa2V5Il0sDQoJXTsNCg==").n;
    tx("enter to continue");
    c();
    goto memek;
}
include("link_sl.php");
if (!$array[0][1] || !$array[0][0]) {
    unlink("link_sl.php");
    goto memek;
}
$x = 0;
while ($x <= count($array)) {

    
    if (!$array[$x][1]) {
        break;
    }
    
    foreach ($list_array as $index => $item) {
        if ($item[0] == $array[$x][0]) {
            $id = $index + 10001;
            break;
        }
    }
    $hasil = curl("https://".$array[$x][0]."/api?api=".$array[$x][1]."&url=".urlencode('https://autofaucet.org/dashboard/shortlinks/visited/'.az_num(rand(10, 32))))[2];
    
    if($hasil->status == "success") {
        $link[] = $hasil->shortenedUrl;
    }
    $x++;
}

$url = array_filter($link);
$nomor = 0;
while ($nomor <= count($url)) {
    $only_sl = trimed($url[$nomor]);
    
    if (!$only_sl) {
        unset($link);
        goto memek;
    }
    print k."host: ".$array[$nomor][0].n;
    print k."link: ".$only_sl.n;
    $n = 0;
    b:
    $n++;
    $r = bypass_shortlinks($only_sl);
    
    if ($r->status !== "success") {
        if (0 >= $n) {
            goto b;
        }
    }
    if ($r->status == "success") {
        print_r($r);
    } else {
        print m."invalid!".n;
    }
    line();
    $nomor++;
}
