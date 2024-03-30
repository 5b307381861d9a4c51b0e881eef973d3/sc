<?php

memek:
if (!file_get_contents("link_sl.php")) {
    print p.base64_decode("ZmlsZSBpbmNsdWRlIHRpZGFrIGRpIHRlbXVrYW4gYnVhdGxhaCBmaWxlIChsaW5rX3NsLnBocCkgdG9sb2wKCmNvbnRvaDoKCjxwaHAKCiRhcnJheSA9IGFycl9yYW5kKFsKICAgIFsicmV2Y3V0Lm5ldCIsICJhcGlrZXltdSJdLAogICAgWyJjdXRsaW5rLnh5eiIsICJhcGlrZXltdSJdLAogICAgWyJiaXRhZC5vcmciLCAiYXBpa2V5bXUiXSwKICAgIFsidXJsY3V0LnBybyIsICJhcGlrZXltdSJdLAogICAgWyJmYWhvLnVzIiwgImFwaWtleW11Il0sCiAgICBbImlubGlua3Mub25saW5lIiwgImFwaWtleW11Il0KXSk7").n;
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
    $r = bypass_shortlinks($only_sl);

    if ($r->status == "success") {
        print_r($r);
    } else {
        print m."invalid!".n;
    }
    line();
    $nomor++;
}