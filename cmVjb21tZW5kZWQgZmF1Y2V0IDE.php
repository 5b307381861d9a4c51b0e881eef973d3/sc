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
    eval(str_replace('<?php',"",str_replace("request_captcha", $reques[$inp], get_e("shortlink_index.php"))));
}



go:
c();

$web = [
    "keforcash.com",
    "claimcoin.in",
    "faucetspeedbtc.com",
    "coinpayz.xyz",
    "insfaucet.xyz",
    "bitmonk.me",
    "queenofferwall.com",
    "liteearn.com",
    "hatecoin.me",
    "fundsreward.com",
    "wincrypt2.com",
    "nobitafc.com",
    "bitupdate.info",
    "newzcrypt.xyz",
    "claimcash.cc",
    "cashbux.work",
    "claimbitco.in",
    "litefaucet.in",
    "cryptoviefaucet.com",
    "freebinance.top",
    "faucetcrypto.net",
    "freesolana.top",
    #"trxking.xyz",
    #"ourcoincash.xyz",
    "feyorra.top",
    "claimtrx.com",
    "bitsfree.net",
    "888satoshis.com",
    "earnfreebtc.io",
    "bambit.xyz",
    "whoopyrewards.com",
    "feyorra.site",
    "kiddyearner.com",
    "free-ltc-info.com",
    "banfaucet.com",
];

for ($i = 0; $i < count($web); $i++) {
    if ($web[$i]) {
        ket($i + 1, $web[$i]);
    }
}
#$p = 2;
$p = preg_replace("/[^0-9]/", "", trim(tx("number")));
$host = $web[$p - 1];
if (!$host) {
    goto go;
}

eval(str_replace('name_host', explode(".", $host)[0], str_replace('example', $host, 'const host="https://example/",sc="name_host",cookie_only="cookie_example",mode="vie_free";')));




ket(1, "new cookie", 2, "old cookie (jika tersedia)");
$tx = tx("number", 1);
if ($tx == 1) {
   new_save(host, true);
}
DATA:
$u_a = new_save("user-agent")["user-agent"];
$u_c = new_save(host)[explode("/", host)[2]];
#die(print_r($new_save));

#$u_a = save("useragent");
#$u_c = save(cookie_only);
#$r = base_run(host."links");die(print_r($r));
/*$t = $r["token_csrf"];
print "https://rscaptcha.com/captcha/getimage?token=".explode('"', $t[2][2])[0].n.n;//L(6);
$img = curl("https://rscaptcha.com/captcha/getimage?token=".explode('"', $t[2][2])[0], h_rs())[1];
#die(print_r($img));
for ($i = 0; $i < 5; $i++) {
            $cap = coordinate($img, $i);
            if ($cap["x"]) {
                break;
            }
        }

$data = http_build_query([
explode('"', $t[1][0])[0] => explode('"', $t[2][0])[0],
"captcha" => "rscaptcha",
explode('"', $t[1][1])[0] => explode('"', $t[2][1])[0],
explode('"', $t[1][2])[0] => explode('"', $t[2][2])[0],
"rscaptcha_response" => $cap["ans"]
]);

$rr = base_run("https://claimtrx.com/faucet/verify", $data);

print($data);
die(print_r($r["res"]));*/
//$r = base_run(host."links");$bypass = new_visit($r);die(print_r($bypass));

dashboard:
$redirect = "dashboard";
$r = base_run(host . "dashboard");
$link = $r["link"];
#die(print_r($r));

//goto faucet;
if ($r["status"] == 403) {
    print m . sc . " cloudflare!" . n;
    new_save(host, true);
    goto DATA;
} elseif ($r["register"]) {
    print m . sc . " cookie expired!" . n;
    new_save(host, true);
    goto DATA;
} elseif ($r["firewall"]) {
    print m . "Firewall!";
    r();
    goto firewall;
}

c().asci(sc);

if ($r["username"]) {
    ket("username", $r["username"]);
}

ket("balance", $r["balance"]).line();
#goto auto;



shortlinks:
$redirect = "shortlinks";

for ($i = 0; $i <= count($link); $i++) {
    if (preg_match("#(link)#is", $link[$i])) {
        $shortlinks = $link[$i];
        break;
    }
}

if (!$shortlinks) {
    lah(2, $redirect);
    L(5);
    goto achievement;
}

$n = 0;

while (true) {
    $n++;
    $r = base_run($shortlinks);#die(print_r($r));
    if (!$r["res"]) {
        continue;
    }
    if ($n == 1) {
        if (preg_match("#http#is", $r["visit"][0])) {
            $dark[] = $r["visit"];
        }
    }
    if (!$dark[0][0]) {
        unset($dark);
    }

    if ($r["status"] == 403) {
        if (preg_match("#(keforcash.com|claimcoin.in|faucetcrypto.net|banfaucet.com|bitsfree.net|888satoshis.com)#is", host)) {
            if (preg_match("#http#is", $dark[0][0])) {
                ket("info", m . "selamat datang di pasar gelap") . line();
                goto dark;
            }
        }
        print m . sc . " cloudflare!" . n;
        new_save(host, true);
        unset($dark);
        goto DATA;
    } elseif ($r["register"]) {
        print m . sc . " cookie expired!" . n;
        new_save(host, true);
        unset($dark);
        goto DATA;
    } elseif ($r["firewall"]) {
        print m . "Firewall!";
        r();
        unset($dark);
        goto firewall;
    }
    if (!$r["left"][0]) {
        goto achievement;
    }
    $bypas = visit_short($r);

    if ($bypas == "refresh" || $bypas == "skip") {
        goto shortlinks;
    } elseif (!$bypas) {
        lah(1, $redirect);
        //die("nunggu update fitur lagi");
        L(5);
        goto achievement;
    }
    if (preg_match("#(feyorra.top|claimtrx.com)#is", host)) {
        L(25);
    }
    $r1 = base_run($bypas);
    #die(print_r($r1));
    
    if (preg_match("#(good|suc|been)#is", $r1["notif"]) == true) {
        text_line(h . $r1["notif"]);
        if ($r1["balance"]) {
            ket("balance", $r1["balance"]);
            line();
        }
    }
}

dark:
for ($i = 0; $i < count($dark[0]); $i++) {
  # print_r($dark[0]);
    if ($dark[0][$i]) {
        $r = base_run($dark[0][$i]);

        if (!$r["url"]) {
            unset($dark[0][$i]);
            continue;
        }
        if (preg_match("#_rsshort.com#is", $r["url"])) {
            $xxnx = 7;
        } else {
            $xxnx = 5;
        }
        
        ket("url", $r["url"]) . line();
        
        for ($h = 0; $h < $xxnx; $h++) {
            $bypas = bypass_shortlinks($r["url"], 1);
            if (preg_match("#(refresh|skip)#is", $bypas)) {
                break;
            }
        }

        #print_r($dark);

        if ($bypas == "skip") {
            unset($dark[0][$i]);
            continue;
        } elseif ($bypas == "refresh") {
            print m . "invalid bypass" . n;
            goto dark;
        } elseif (!$bypas) {
            goto achievement;
        }

        #base_run(str_replace("/back","/verify", $bypas));
        base_run($bypas);
        $r1 = base_run(host . "dashboard");
        
        print h."oke mantap kafir".n;
        if (preg_match("#(good|suc|been)#is", $r1["notif"]) == true) {
            text_line(h . $r1["notif"]);
            if ($r1["balance"]) {
                ket("balance", $r1["balance"]);
            }
        }
        line();
        goto dark;
        
    }
}


achievement:
$redirect = "achievements";

for ($i = 0; $i <= count($link); $i++) {
    if (preg_match("#(ach)#is", $link[$i])) {
        $achievements = $link[$i];
        break;
    }
}
if (preg_match("#(free-ltc-info.com|bitmonk.me)#is", host)) {
    goto auto;
}
if (!$achievements) {
    lah(2, $redirect);
    L(5);
    goto auto;
}
$r = base_run($achievements);
#die(print_r($r));
if ($r["status"] == 403) {
    print m . sc . " cloudflare!" . n;
    new_save(host, true);
    goto DATA;
} elseif ($r["register"]) {
    print m . sc . " cookie expired!" . n;
    new_save(host, true);
    goto DATA;
} elseif ($r["firewall"]) {
    print m . "Firewall!";
    r();
    goto firewall;
}

for ($v = 0; $v < count($r["count"]); $v++) {
     if (explode("/", $r["count"][$v])[0] >= explode("/", $r["count"][$v])[1]) {
        $t = $r["token_csrf"];
        if ($t) {
            $data = data_post($t, "null");
        }
        $r1 = base_run($r["redirect"][$v], $data);
        if ($r1["firewall"]) {
            print m . "Firewall!";
            r();
            goto firewall;
        }

        if (preg_match("#(good|suc|been)#is", $r1["notif"])) {
            text_line(h . $r1["notif"]);

            if ($r1["balance"]) {
                ket("balance", $r1["balance"]);
                line();
                L(5);
            }
           
        }
        goto achievement;
    }
}


auto:
$redirect = "auto";

for ($i = 0; $i <= count($link); $i++) {
    if (preg_match("#(auto)#is", $link[$i])) {
        $auto = $link[$i];
        break;
    }
}

if (!$auto) {
    die(lah(2, $redirect));
}

while (true) {
    $r = base_run($auto);

    if ($r["status"] == 403) {
        print m . sc . " cloudflare!" . n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["register"]) {
        print m . sc . " cookie expired!" . n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["firewall"]) {
        print m . "Firewall!";
        r();
        goto firewall;
    }

    if ($r["limit"]) {
        die(lah());
    }

    if ($r["timer"]) {
        tmr(2, $r["timer"]);
        $t = $r["token_csrf"];
        $data = data_post($t, "null");

        if (!$r["redirect"][0]) {
            $verify = $auto . "/verify";
        } else {
            $verify = $r["redirect"][0];
        }

        $r1 = base_run($verify, $data);

        if ($r1["firewall"]) {
            print m . "Firewall!";
            r();
            goto firewall;
        }

        if (preg_match("#(good|suc|been)#is", $r1["notif"])) {
            text_line(h . $r1["notif"]);

            if ($r1["balance"]) {
                ket("balance", $r1["balance"]);
                line();
            }
        }
    }
}



firewall:
while (true) {
    #die("firewall butuh update sc");
    $r = base_run(host . "firewall");

    $t = $r["token_csrf"];
    
    if ($t[2][1]) {
    
        for ($i = 0; $i <= count($t[1]); $i++) {
        
            if (preg_match("#(hcaptcha|recaptchav2|recaptchav3)#is", $t[2][$i])) {
                $methode = $t[2][$i];
                break;
            }
        }
        
        if (!$methode) {
            goto firewall;
        }
        fire:
        eval(str_replace("request_captcha",  $reques[$inp], '$cap = request_captcha($methode, $r[methode], host);'));
        
        if (!$cap) {
            goto fire;
        }
        $rsp = ["g-recaptcha-response" => $cap];

        $data = data_post($t, "two", $rsp);

        $r1 = base_run($r["redirect"][0], $data);

        if (!$r1["firewall"]) {
            print p . "bypass firewall successfull" . n;
            line();

            if ($redirect == "dashboard") {
                goto dashboard;
            } /*elseif ($redirect == "ptc") {
                goto ptc;
            } elseif ($redirect == "faucet") {
                goto faucet;
            } */elseif ($redirect == "auto") {
                goto auto;
            }
        } else {
            print m . "invalid captcha!";
            r();
        }
    }
}


function base_run($url, $data = 0) {
    $header = head();#die(print_r($header));
    $r = curl($url, $header, $data, true, false);
    unset($header);
    #$r[1] = file_get_contents("asu.html");
    #die(file_put_contents("asu.html", $r[1]));
    preg_match("#Just a moment#is", $r[1], $cf);
    preg_match("#(login)#is", str_replace(["Login every", "login with", "Daily Login", "timewall.io/users/login"], "", $r[1]), $register);
    preg_match("#(antibotlink)#is", $r[1], $antb);
    preg_match("#(Protecting faucet|Daily limit reached|for Auto Faucet)#is", $r[1], $limit);
    preg_match("#firewall#is", $r[1], $firewall);
    preg_match("#(Failed to generate this link|Invalid Keys|Clear the browser cache and cookies.Disable any ad blocker.No proxy)#is", str_replace("scription INVA", "", $r[1]), $failed);
    preg_match('#"g-recaptcha" data-sitekey="(.*?)"#is', $r[1], $recaptchav2);
    preg_match('#h-captcha" data-sitekey="(.*?)"#is', $r[1], $hcaptcha);
    preg_match('#grecaptcha.execute"(.*?)"#is', str_replace("(", "", $r[1]), $recaptchav3);
    preg_match('#(class="font-medium">|class="m-b-0"><strong>|class="d-none d-lg-inline-flex">|class="fa-solid fa-user-graduate me-2"></i>|class="text-primary"><p>|user-name-text">|fw-semibold">|key="t-henry">|class="font-size-15 text-truncate">)(.*?)(<)#is', str_replace(["#", 'flex">Notifications'], "", $r[1]), $username);
    preg_match_all('#(<h6 class="text-gray-700 rajdhani-600 mb-0 lh-18 ms-0 font-sm dark-text">|<h5 >|<h5 class="font-15">|<h6>|class="text-muted font-weight-normal mb-0 w-100 text-truncate">|class="mb-2">|class="text-muted font-weight-medium">|class="">|class="text-muted mb-2">)(.*?)<(.*?)>([a-zA-Z0-9-, .]*)<#is', str_replace(["'", "Account"], "", $r[1]), $bal);

    for ($i = 0; $i < 30; $i++) {
        if (trim(strtolower($bal[2][$i])) == "balance") {
            $balance = $bal[4][$i];
            break;
        }
    }
    if (!$balance) {
        preg_match('#(<div class="text-3xl font-medium leading-8 mt-6">|<div class="balance">\n<p>|<div class="top-balance">\n<p>|class="acc-amount"><i class="fas fa-coins"></i>|class="acc-amount"><i class="fas fa-coins"></i>|class="fas fa-dollar-sign"></i>|<option selected=>)(.*?)(<)#is', str_replace("'","", $r[1]), $ball);
        $balance = $ball[2];
    }

    preg_match_all('#hidden" name="(.*?)" value="(.*?)"#', str_replace('name="anti', '', $r[1]), $t_cs);

    preg_match('#(timer|wait*)( = *)(\d+)#is', $r[1], $tmr);
    if(preg_match("#(keforcash.com)#is", host)){
        $Attribute = "card border p-0";
    } elseif(preg_match("#(faucetspeedbtc.com)#is", host)){
        $Attribute = "card bg-metallic";
    } elseif(preg_match("#(coinpayz.xyz)#is", host)){
        $Attribute = "card card-body text-center bg-metallic";
    } elseif(preg_match("#(claimcoin.in|insfaucet.xyz|chillfaucet.in|queenofferwall.com|liteearn.com|hatecoin.me|wincrypt2.com|nobitafc.com|bitupdate.info|newzcrypt.xyz|hfaucet.com|mezo.live|claimcash.cc|cashbux.work|claimbitco.in|litefaucet.in|cryptoviefaucet.com|freebinance.top|faucetcrypto.net|freesolana.top|bitsfree.net|888satoshis.com|earnfreebtc.io|bambit.xyz|whoopyrewards.com)#is", host)){
        $Attribute = "card card-body text-center";
    } elseif(preg_match("#(fundsreward.com)#is", host)){
        $Attribute = "card card-body text-center bg-secondary rounded";
    } elseif(preg_match("#(feyorra.top|claimtrx.com)#is", host)){
        $Attribute = "col-md-6 col-lg-4 mb-3 mb-lg-0";
    } elseif(preg_match("#(kiddyearner.com)#is", host)){
        $Attribute = "claim-card";
    } elseif(preg_match("#(banfaucet.com)#is", host)){
        $Attribute = "col-lg-6 col-xl-4";
    } elseif(preg_match("#(bitmonk.me)#is", host)){
        $Attribute = "col-xxl-3 col-sm-6 project-card";
    } elseif(preg_match("#(free-ltc-info.com)#is", host)){
        $Attribute = "zoom-in box p-5";
    } elseif(preg_match("#(feyorra.site)#is", host)){
        $Attribute = "row flex-grow-1 align-items-center justify-content-between";
    }
    
    
    
    
    if(preg_match("#(".$Attribute.")#is", $r[1])){
        $dom = new DOMDocument;
        $dom->loadHTML(str_replace('Remaining', '', $r[1]));
        $entries = $dom->getElementsByTagName('div');
        
        foreach ($entries as $entry) {
            $classAttribute = $entry->getAttribute('class');
            if (strpos($classAttribute, $Attribute) !== false) {
                $titleNodeH2 = $entry->getElementsByTagName('h2')->item(0);
                $titleNodeH3 = $entry->getElementsByTagName('h3')->item(0);
                $titleNodeH4 = $entry->getElementsByTagName('h4')->item(0);
                $titleNodeH5 = $entry->getElementsByTagName('h5')->item(0);
                $titleNodeH6 = $entry->getElementsByTagName('h6')->item(0);
                $name[] = $titleNodeH2 ? $titleNodeH2->nodeValue : ($titleNodeH3 ? $titleNodeH3->nodeValue : ($titleNodeH4 ? $titleNodeH4->nodeValue : ($titleNodeH5 ? $titleNodeH5->nodeValue : ($titleNodeH6 ? $titleNodeH6->nodeValue : ''))));
                $aTag = $entry->getElementsByTagName('a');
                
                if ($aTag->length > 0) {
                    $claimLink = $aTag->item(0)->getAttribute('href');
                    $claimCountNode = $aTag->item(0)->getElementsByTagName('span')->item(0);
                } else {
                    $buttonTag = $entry->getElementsByTagName('button');
                    
                    if ($buttonTag->length > 0) {
                        $claimCountNode = $buttonTag->item(0)->getElementsByTagName('span')->item(0);
                    }
                }
                
                if(!$claimCountNode){
                    $claimCountNode = $entry->getElementsByTagName('p')->item(0);
                }
                $claimCount = $claimCountNode ? trim($claimCountNode->nodeValue) : '';
                $visit[] = $claimLink;
                //$left[] = $claimCount;        
            }
        }
    } else {
        $name = [];
        $visit = [];
    }
    preg_match_all('#(>|\n)(\d+\/+\d+)#is', trimed(str_replace([str_split('({['), "Available View:", "-"], '', $r[1])), $count);
    
    preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $r[1], $u_r);
    preg_match_all("#(https?:\/\/" . sc . "[a-z\/.-]*)(\/auto|\/faucet|\/ptc|\/links|\/shortlinks|\/achievements)#is", $r[1], $link);
    preg_match_all("#(fas fa-exclamation-circle></i>|alert-borderless'>|Toast.fire|Swal.fire|swal[(]|`success`)(.*?)(<)#is", str_replace('"', '', $r[1]), $notif_1);
    
    foreach ($notif_1[2] as $notif_2) {
    
        if (strpos(strtolower($notif_2), "been") !== false || strpos(strtolower($notif_2), "invalid") !== false || strpos(strtolower($notif_2), "key") !== false || strpos(strtolower($notif_2), "success") !== false || strpos(strtolower($notif_2), "failed") !== false) {
            preg_match_all('#(title|html|text):(.*?)(,|\n})#is', $notif_2, $notif_3);
            
            if (!$notif_3[2][0]) {
                $notif_3 = $notif_1;
            }
            
            foreach ($notif_3[2] as $notif_4) {
                if (strpos(strtolower($notif_4), "been") !== false || strpos(strtolower($notif_4), "invalid") !== false || strpos(strtolower($notif_4), "key") !== false || strpos(strtolower($notif_4), "success") !== false || strpos(strtolower($notif_4), "failed") !== false) {
                    $notif = ltrim(preg_replace("/[^a-zA-Z0-9-!. ]/", "", $notif_4));
                }
            }
        }
    }
    /*if(preg_match("#(kiddyearner.com)#is", host)){
        $r[1] = str_replace("Swal.fire", "memek", $r[1]);
    }
    preg_match("#(alert-borderless'>|Swal.fire|swal[(])(.*?)(<)#is", $r[1], $n);
    preg_match_all('#(title|text|icon):(.*?)(,|\n})#is', $r[1], $nn);

    if (!$n[2]) {
        $n[2] = $nn[2][0] . $nn[2][1];
    }
    
    preg_match('#(`success`|babitolol)(.*?)([)])#is', $r[1], $nnn);

    if (!$n[2]) {
        $n[2] = $nnn[2];
    }
    #toastr[`success`](`0.00003050
    */

    preg_match_all("#(https?:\/\/[a-z0-9\/.-]*)(verify|ptc\/view|achievements\/claim|firewall*)(\/?[a-z0-9\/-]*)(.*?)#is", $r[1], $redirect);

    return [
        "status" => $r[0][1]["http_code"],
        "res" => $r[1],
        "r" => $r[0][2],
        "register" => $register[1],
        "antb" => $antb[1],
        "cookie" => set_cookie($r[0][2]),
        "cloudflare" => $cf,
        "firewall" => $firewall[0],
        "limit" => $limit[0],
        "recaptchav2" => $recaptchav2[1],
        "recaptchav3" => $recaptchav3[1],
        "hcaptcha" => $hcaptcha[1],
        "username" => preg_replace("/[^a-zA-Z0-9]/", "", $username[2]),
        "balance" => ltrim(strip_tags($balance)),
        "timer" => $tmr[3],
        "token_csrf" => $t_cs,
        "name" => $name,
        "visit" => $visit,
        "left" => $count[2],
        "count" => $count[2],
        "notif" => $notif,
        "url" => $u_r[0],
        "link" => array_merge(array_unique($link[0])),
        "url1" => $r[0][0]["location"],
        "url2" => $r[0][1]["url"],
        "failed" => $failed[1],
        "redirect" => $redirect[0],
    ];
}

function h_x() {
    global $u_a, $u_c;
    $header = array();
    if (!$u_a) {
        $u_a = user_agent();
    }
    $header[] = "user-agent: " . $u_a;
    if ($u_c) {
        $header[] = "cookie: " . $u_c;
    }
    return $header;
}
#https://rscaptcha.com/captcha/getimage?token=YLxN8ziwPrlBJOAn3ZWRmesUa


function h_rs() {
    global $u_a;
    $header[] = 'Host: rscaptcha.com';
$header[] = 'sec-ch-ua: "Chromium";v="93", " Not;A Brand";v="99"';
$header[] = 'user-agent: Mozilla/5.0 (Linux; Android 13; M2012K11AG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.14 Mobile Safari/537.36';
$header[] = 'accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8';
$header[] = 'sec-fetch-site: cross-site';
$header[] = 'sec-fetch-mode: no-cors';
$header[] = 'sec-fetch-dest: image';
$header[] = 'referer: https://claimtrx.com/';
//$header[] = 'accept-encoding: gzip, deflate, br';
$header[] = 'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
    return $header;
}

#<h5 class="mb-0">Login</h5>cash.cc
#class="btn btn-warning">Login</a>win
#class="primary-btn">Login</a>hate
#<span class="mb-0">Login</span>insta
#class="btn btn--medium btn--orange"><span>LOGIN<payz
#>Login<