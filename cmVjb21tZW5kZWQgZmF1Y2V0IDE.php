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
    eval(str_replace('= 90;', "= 30;", str_replace('<?php', "", str_replace("request_captcha", $reques[$inp], get_e("shortlink_index.php")))));
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
    "whoopyrewards.com",
    "feyorra.site",
    "kiddyearner.com",
    "free-ltc-info.com",
    "faucet-bit.com",
    "claimercorner.xyz/web",
    "cryptobigpay.online",
    "allfaucets.site",
    "almasat.net",
    "earn-pepe.com",
    "tronpayz.com",
    "earnfeyonline.online"
];

for ($i = 0; $i < count($web); $i++) {
    if ($web[$i]) {
        ket($i + 1, $web[$i]);
    }
}
#$p = 2;
$p = tx("number", 1);
$host = $web[$p - 1];
if (!$host) {
    goto go;
}


eval(str_replace('name_host', explode(".", $host)[0], str_replace('example', $host, 'const host="https://example/",sc="name_host",cookie_only="cookie_example",mode="vie_free";')));



awalan:
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
#$r = base_run(host . "links");die(print_r($r));
dashboard:
$redirect = "dashboard";
$r = base_run(host . "dashboard");
$link = $r["link"];
if (preg_match("#newzcrypt.xyz#is", $host)) {
    $link = ["https://newzcrypt.xyz/links"];
}

#die(print_r($link));

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

#die(print_r($link));
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
        if (preg_match("#(whoopyrewards.com|keforcash.com|claimcoin.in|faucetcrypto.net|banfaucet.com|bitsfree.net|888satoshis.com|earn-pepe.com|free-ltc-info.com)#is", host)) {
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
        if (preg_match("#rsshort.com#is", $r["url"])) {
            unset($dark[0][$i]);
            continue;
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
    date_default_timezone_set('Asia/Jakarta');
    print c.date('Y-m-d H:i:s').n;
    lah(2, $redirect);
    goto awalan;
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
        date_default_timezone_set('Asia/Jakarta');
        print c.date('Y-m-d H:i:s').n;
        lah();
        goto awalan;
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
        eval(str_replace("request_captcha",  "multibot", '$cap = request_captcha($methode, $r[$methode], host);'));
        
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
            } elseif ($redirect == "achievement") {
                goto achievement;
            } elseif ($redirect == "shortlinks") {
                goto shortlinks;
            } elseif ($redirect == "auto") {
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
    $r = curl($url, $header, $data, true);
    unset($header);
    #$r[1] = file_get_contents("f.html");
    #die(file_put_contents("instan.html", $r[1]));
    preg_match("#Just a moment#is", $r[1], $cf);
    #preg_match("#(login)#is", str_replace(["Login every", "login with", "Daily Login", "timewall.io/users/login"], "", $r[1]), $register);
    preg_match("#(>login<|>Signin<)#is", trimed($r[1]), $register);
    preg_match("#(antibotlink)#is", $r[1], $antb);
    preg_match("#(Protecting faucet|Daily limit reached|for Auto Faucet)#is", $r[1], $limit);
    preg_match("#firewall#is", $r[1], $firewall);
    preg_match("#(Failed to generate this link|Invalid Keys|Clear the browser cache and cookies.Disable any ad blocker.No proxy)#is", str_replace("scription INVA", "", $r[1]), $failed);
    preg_match('#"g-recaptcha" data-sitekey="(.*?)"#is', $r[1], $recaptchav2);
    preg_match('#h-captcha" data-sitekey="(.*?)"#is', $r[1], $hcaptcha);
    preg_match('#grecaptcha.execute"(.*?)"#is', str_replace("(", "", $r[1]), $recaptchav3);
    preg_match('#(class="font-size-15 text-truncate p-0 m-0">|class="font-medium">|class="m-b-0"><strong>|class="d-none d-lg-inline-flex">|class="fa-solid fa-user-graduate me-2"></i>|class="text-primary"><p>|user-name-text">|fw-semibold">|key="t-henry">|class="font-size-15 text-truncate">)(.*?)(<)#is', str_replace(["#", 'flex">Notifications', 'key="t-henry">Setting'], "", $r[1]), $username);
    preg_match_all('#(<option selected disabled>|color:FFFFFF;font-size:20px">|<p class="text-muted p-0 m-0">|<h6 class="text-gray-700 rajdhani-600 mb-0 lh-18 ms-0 font-sm dark-text">|<h5 >|<h5 class="font-15">|<h6>|class="text-muted font-weight-normal mb-0 w-100 text-truncate">|class="mb-2">|class="text-muted font-weight-medium">|class="">|class="text-muted mb-2">)(.*?)<(.*?)>([a-zA-Z0-9-, .]*)<#is', str_replace(["'", "Account", "#"], "", $r[1]), $bal);
    
    for ($i = 0; $i < 30; $i++) {
        if (trim(strtolower($bal[2][$i])) == "balance") {
            $balance = "".$bal[4][$i]."";
            break;
        }
    }
    if (!$balance) {
        preg_match('#(<h2 class="mb-2 number-font">|<h3 class="mb-4 mt-8">|<div class="text-3xl font-medium leading-8 mt-6">|<div class="balance">\n<p>|<div class="top-balance">\n<p>|class="acc-amount"><i class="fas fa-coins"></i>|class="acc-amount"><i class="fas fa-coins"></i>|class="fas fa-dollar-sign"></i>|<option selected=>)(.*?)(<)#is', str_replace("'","", $r[1]), $ball);
        $balance = $ball[2];
    }

    preg_match_all('#hidden" name="(.*?)" value="(.*?)"#', str_replace('name="anti', '', $r[1]), $t_cs);

    preg_match('#(timer|wait*)( = *)(\d+)#is', $r[1], $tmr);
    if (preg_match("#(keforcash.com)#is", host)) {
        $Attribute = "card border p-0";
    } elseif (preg_match("#(faucetspeedbtc.com)#is", host)) {
        $Attribute = "card bg-metallic";
    } elseif (preg_match("#(coinpayz.xyz)#is", host)) {
        $Attribute = "card card-body text-center bg-metallic";
    } elseif (preg_match("#(claimcoin.in|insfaucet.xyz|chillfaucet.in|queenofferwall.com|liteearn.com|hatecoin.me|wincrypt2.com|nobitafc.com|bitupdate.info|newzcrypt.xyz|hfaucet.com|mezo.live|claimcash.cc|cashbux.work|claimbitco.in|litefaucet.in|cryptoviefaucet.com|freebinance.top|faucetcrypto.net|freesolana.top|bitsfree.net|888satoshis.com|earnfreebtc.io|bambit.xyz|whoopyrewards.com|faucet-bit.com|cryptobigpay.online|allfaucets.site|almasat.net|tronpayz.com|earnfeyonline.online)#is", host)) {
        $Attribute = "card card-body text-center";
    } elseif (preg_match("#(fundsreward.com)#is", host)) {
        $Attribute = "card card-body text-center bg-secondary rounded";
    } elseif (preg_match("#(feyorra.top|claimtrx.com)#is", host)) {
        $Attribute = "col-md-6 col-lg-4 mb-3 mb-lg-0";
    } elseif (preg_match("#(kiddyearner.com)#is", host)) {
        $Attribute = "claim-card";
    } elseif (preg_match("#(banfaucet.com)#is", host)) {
        $Attribute = "col-lg-6 col-xl-4";
    } elseif (preg_match("#(bitmonk.me)#is", host)) {
        $Attribute = "col-xxl-3 col-sm-6 project-card";
    } elseif (preg_match("#(free-ltc-info.com)#is", host)) {
        $Attribute = "zoom-in box p-5";
    } elseif (preg_match("#(feyorra.site|earn-pepe.com)#is", host)) {
        $Attribute = "row flex-grow-1 align-items-center justify-content-between";
    } elseif (preg_match("#(claimercorner.xyz/web)#is", host)) {
        $Attribute = "card card-body";
    }
    
    
    
    if (preg_match("#(".$Attribute.")#is", $r[1])) {
        $dom = new DOMDocument;
        $dom->loadHTML(str_replace('Remaining', '', $r[1]));
        $entries = $dom->getElementsByTagName('div');
        
        foreach ($entries as $key => $entry) {
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
                
                if (!$claimCountNode) {
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
    preg_match_all('#(>|\n)(-?\d+\/\d+)#is', trimed(str_replace([str_split('({['), "Available View:"], '', $r[1])), $count);#die(print_r($count));
    
    preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $r[1], $u_r);
    preg_match_all("#(https?:\/\/" . sc . "[a-z\/.-]*)(\/auto|\/faucet|\/ptc|\/links|\/shortlinks|\/achievements)#is", str_replace("/plugin/auto", "", $r[1]), $link);
    preg_match_all("#(fas fa-exclamation-circle></i>|alert-borderless'>|Toast.fire|Swal.fire|swal[(]|`success`)(.*?)(<)#is", str_replace('"', '', $r[1]), $notif_1);
    
    foreach ($notif_1[2] as $notif_2) {
    
        $keywords = array(
            "been",
            "invalid",
            "key",
            "success",
            "failed"
        );

        if (multi_strpos($notif_2, $keywords)) {
            preg_match_all('#(title|html|text):(.*?)(,|\n})#is', $notif_2, $notif_3);
            
            if (!$notif_3[2][0]) {
                $notif_3 = $notif_1;
            }
            
            foreach ($notif_3[2] as $notif_4) {

                if (multi_strpos($notif_4, $keywords)) {
                    $notif = ltrim(preg_replace("/[^a-zA-Z0-9-!. ]/", "", $notif_4));
                }
            }
        }
    }
    preg_match_all("#(https?:\/\/[a-z0-9\/.-]*)(verify|ptc\/view|achievements\/claim|firewall*)(\/?[a-z0-9\/-]*)(.*?)#is", $r[1], $redirect);
    if (!$count[2][2]) {
        
        if ($name[2]) {
            for ($i = 0; $i < count($name); $i++) {
                preg_match_all('#disabled>Claim<|">claim<#is', trimed($r[1]), $mmk);
                if (strpos($mmk[0][$i], '"') !== false) {
                    $memek[] = "9999/9999";
                } else {
                    $memek[] = "0/1";
                }
            }
            $count[2] = $memek;
        }
    }
    return [
        "status" => $r[0][1]["http_code"],
        "res" => $r[1],
        "t" => $r[0][1],
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