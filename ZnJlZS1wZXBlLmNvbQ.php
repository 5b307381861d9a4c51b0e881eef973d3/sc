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

eval(str_replace('name_host',explode(".","free-pepe.com")[0],str_replace('example',"free-pepe.com",'const host="https://example/",sc="name_host",cookie_only="cookie_example",mode="vie_free";')));


DATA:
$u_a = new_save("user-agent")["user-agent"];
$u_c = new_save(host)[explode("/", host)[2]];



c();
$x = 0;
home:
$x++;
$r = base_run(host."dashboard");#die(print_r($r));
if ($r["status"] == 403) {
    print m."cloudflare!".n;
    new_save(host, true);
    goto DATA;
} elseif ($r["account"]) {
    print m."cookie expired!".n;
    new_save(host, true);
    goto DATA;
}
if ($x == 1) {
    c().asci(sc).ket("username",$r["username"]);
    ket("balance",$r["balance"]);
    line();
    print n;
}


awalan:
ket(1, "ptc", 2, "shortlinks");
$tx = tx("number", 1);
if ($tx == 1) {
   goto ads;
} elseif ($tx == 2) {
   goto shortlinks;
} else {
    goto awalan;
}
print n;


ads:
while(true) {
    $r = base_run(host."ads");
    #die(print_r($r));
    if ($r["status"] == 403) {
        print m."cloudflare!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["account"]) {
        print m."cookie expired!".n;
        new_save(host, true);
        goto DATA;
    } elseif (!$r["ptc"]) {
        goto iframe;
    }
    $r1 = base_run($r["ptc"]);
    L($r1["timer"]);
    $t = $r1["token"];
    $data = data_post($t, "one");
    $r2 = base_run(host."ads/antibot", $data);
    $token = $r2["json"]->token;
    
    if (!$token) {
        continue;
    }
    print h.$r2["json"]->message;
    r();
    $method = "recaptchav2";
    $cap = multibot($method, $r1[$method], host);
    
    if (!$cap) {
        continue;
    }
    
    $data = http_build_query(array(
        "captcha" => $method,
        "g-recaptcha-response" => $cap,
        $t[1][1] => $t[2][1],
        $t[1][0] => $token
    ));
    
    $r3 = base_run(str_replace("ads/view", "ads/verify", $r["ptc"]), $data);
  
    if (preg_match('#suc#is',$r3["notif"])) {
        print text_line(h.$r3["notif"]);
    } else {
        print m.$r3["notif"];
        r();
    }
  
}

iframe:
while(true) {
    $r = base_run(host."iframe");
    
    if ($r["status"] == 403) {
        print m."cloudflare!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["account"]) {
        print m."cookie expired!".n;
        new_save(host, true);
        goto DATA;
    } elseif (!$r["ptc"]) {
        goto achievements;
    }
    $r1 = base_run($r["ptc"]);
    L($r1["timer"]);
    $method = "recaptchav2";
    $cap = multibot($method, $r1[$method], host);
    
    if (!$cap) {
        continue;
    }
    $rsp = array(
        "captcha" => $method,
        "g-recaptcha-response" => $cap
    );
    $data = data_post($r1["token"], "one", $rsp);
    $r2 = base_run(str_replace("ads_ifr/frame", "ptc/verify", $r["ptc"]), $data);
  
    if (preg_match('#suc#is',$r2["notif"])) {
        print text_line(h.$r2["notif"]);
    } else {
        print m.$r2["notif"];
        r();
    }
  
}

shortlinks:
while(true) {
    $r = base_run(host."links/?crypto=LTC&processor=ccpayment");
    
    if ($r["status"] == 403) {
        print m."cloudflare!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["account"]) {
        print m."cookie expired!".n;
        new_save(host, true);
        goto DATA;
    }
    $bypas = visit_short($r);
    
    if ($bypas == "refresh") {
        continue;
    } elseif (!$bypas) {
        goto achievements;
    }
    $r1 = base_run($bypas);
    
    if (preg_match('#been#is',$r1["notif"])) {
        text_line(h.$r1["notif"]);
        ket("balance",$r1["balance"]).line();
    } else {
        print m.$r1["notif"];
        r();
    }
}

achievements:
$r = base_run(host."achievements");

if ($r["status"] == 403) {
    print m."cloudflare!".n;
    new_save(host, true);
    goto DATA;
} elseif ($r["account"]) {
    print m."cookie expired!".n;
    new_save(host, true);
    goto DATA;
}

for ($v = 0; $v < count($r["count"]); $v++) {

     if (explode("/", $r["count"][$v])[0] >= explode("/", $r["count"][$v])[1]) {
        $t = $r["token"];
        
        if ($t) {
            $data = data_post($t, "null");
        }
        $r1 = base_run($r["redirect"][$v], $data);

        if (preg_match('#been#is',$r1["notif"])) {
            text_line(h.$r1["notif"]);
            ket("balance",$r1["balance"]).line();
        }
        goto achievements;
     }
}
goto awalan;
function base_run($url, $data = 0, $xml = 0) {
    global $host;
    $header = head($xml);
    $r = curl($url,$header,$data,true,false);
    unset($header);
    #$r[1] = file_get_contents("instan.html");
    #die(file_put_contents("instan.html",$r[1]));
    $json = json_decode(base64_decode($r[1]));
    
    if (!$json) {
        $json = $r[2];
    }
  
    preg_match_all("#(fas fa-exclamation-circle></i>|alert-borderless'>|Toast.fire|Swal.fire|swal[(]|`success`)(.*?)(<)#is", str_replace('"', '', $r[1]), $notif_1);
    
    if (strpos($r[1], "mb-1 badge font-medium bg-light-warning text-warning") !== false) {
        $dom = new DOMDocument;
        $dom->loadHTML($r[1]);
        $xpath = new DOMXPath($dom);
        $urls = $xpath->query('//a[@class="btn btn-danger w-100 bg-danger text-black"]/@href');
        $titles = $xpath->query('//h3[@class=" font-large mt-0"]');
        $claimcountLefts = $xpath->query('//span[@class="mb-1 badge font-medium bg-light-warning text-warning"]');
      
        foreach ($titles as $key => $title) {
            $name[] = $titles[$key]->nodeValue;
            $left[] = $claimcountLefts[$key]->nodeValue;
            $visit[] = $urls[$key]->nodeValue;

        }
    }

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
    
    preg_match('/location\.href\s*=\s*["\']([^"\']+)["\'];/', $r[1], $location);
  
    preg_match_all('#<input type="hidden" name="(.*?)" value="(.*?)">#is',$r[1],$token);
    preg_match('#var timer = (.*?);#is',$r[1],$timer);
    preg_match("#(Login using cwallet or Faucetpay)#is",$r[1],$account);
    preg_match_all('#(class="fs-4 fw-8 mb-6 text-white">|class="col-6 text-black text-center">|class="col-6 bg-warning text-black">)(.*?)<#is',$r[1],$info);
    preg_match("#window.location = '(.*?)'#is",$r[1],$ptc);
    preg_match('#g-recaptcha" data-sitekey="(.*?)"#is', $r[1],$recaptchav2);
    preg_match_all("#(https?:\/\/[a-z0-9\/.-]*)(verify|ptc\/view|achievements\/claim|firewall*)(\/?[a-z0-9\/-]*)(.*?)#is", $r[1], $redirect);
    preg_match_all('#class="(fafa-times|farfa-check-circle)"></i>(.*?)<#is', trimed($r[1]), $count);
    print p;
    return [
        "account" => $account,
        "res" => $r[1],
        "json" => $json,
        "visit" => $visit,
        "left" => $left,
        "name" => $name,
        "username" => ltrim(rtrim($info[2][0])),
        "balance" => ltrim(rtrim($info[2][1]))." / ".ltrim(rtrim($info[2][2])),
        "token" => $token,
        "timer" => $timer[1],
        "notif" => $notif,
        "ptc" => $ptc[1],
        "recaptchav2" => $recaptchav2[1],
        "url1" => $location[1],
        "url" => $r[0][0]["location"],
        "redirect" => $redirect[0],
        "count" => $count[2]
    ];
}
