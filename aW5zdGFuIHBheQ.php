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
    eval(str_replace('<?php', "", str_replace("request_captcha", $reques[$inp], get_e("shortlink_index.php"))));
}


go_home:
c();
$web = [
    "cryptofuture.co.in",
    "freeltc.fun",
    "earnsolana.xyz",
    "claim88.fun",
    "earncryptowrs.in",
    "onlyfaucet.com",
    "claimcoins.net",
    "doge25.in",
    "chillfaucet.in",
    "zoomfaucet.com",
    "altcryp.com",
    "flashfaucet.xyz"
];
  
for ($i = 0; $i < count($web); $i++) {

    if ($web[$i]) {
        ket($i + 1, $web[$i]);
    }
}

$p = tx("number", 1);
$host = $web[$p - 1];

if (!$host) {
  goto go_home;
}

/*if ($host == "doge25.in" || $host == "onlyfaucet.com" || $host == "claimcoins.net" || $host == "chillfaucet.in" || $host == "zoomfaucet.com" || $host == "altcryp.com" || $host == "earncryptowrs.in" || $host == "chillfaucet.in") {
    $cancel = 1;
}*/
$cancel = 1;
eval(str_replace('name_host', explode(".", $host)[0],str_replace('example',  $host,'const host="https://example/",sc="name_host",cookie_only="cookie_example",mode="vie_free";')));



re_DATA:
ket("", "methode", 1, "cookie", 2, "login");
$mt = tx("number", 1);
if ($mt == 1) {
    $u_a = new_save("user-agent")["user-agent"];
    $cookie = new_save(host)[explode("/", host)[2]];
} elseif ($mt >= 2) {
    print p."wait login!";
    r();
} else {
    goto re_DATA;
}
DATA:
$email = new_save("email")["email"];
$r = base_run(host);#die(print_r($r));

if ($r["status"] == 403) {
    die(m."banned IP please airplane mode for a moment");
} elseif (!$r["login"]) {
    goto home;
}
$t = $r["token"];
$array = array("wallet" => $email);

if ($r["cap"][1][0]) {
    $cap = multibot($r["cap"][1][0], $r["cap"][2][0], host);
    $array = array_merge($array, 
        array("captcha" => "turnstile", "cf-turnstile-response" => $cap)
    );
}

$data = data_post($t, "null", $array);
$r = base_run(host."auth/login", $data);

if ($r["login"]) {
    unlink(cookie_only);
    if ($mt == 1) {
        new_save(host, true);
    }
    goto DATA;
}
print $r["notif"];
r();
      
      
home:

if($host == "claimcoins.net"){
  $link = "https://claimcoins.net/links/currency/ltc";
  goto bn;
}

for ($i = 0; $i < count($r["links"][0]); $i++) {
    if ($r["links"][0][$i]) {
        ket($i+1, $r["links"][0][$i]);
    }
}

$p = tx("number", 1);
$host = $r["links"][0][$p - 1];

if (!$host) {
    goto DATA;
}
$link = $r["links"][1][$p - 1];
bn:
c().asci(sc).ket("email", $email, "", $host).line();

links:
while(true) {
    if ($mt == 1) {
        $cookie = new_save(host)[explode("/", host)[2]];
    }
    $r1 = base_run($link);#die(file_put_contents("instan.html", $r1["res"]));
    #die(print_r($r1));
    if ($r1["firewall"] || $r1["login"]) {
        unlink(cookie_only);
        if ($mt == 1) {
            new_save(host, true);
            goto DATA;
        }
        print m . "Firewall!";
        r();
        $r = base_run(host);
        $t = $r["token"];
        $array = array("wallet" => $email);
        
        if ($r["cap"][1][0]) {
            $cap = multibot($r["cap"][1][0], $r["cap"][2][0], host);
            $array = array_merge($array, 
                array("captcha" => "turnstile", "cf-turnstile-response" => $cap)
            );
        }
        $data = data_post($t, "null", $array);
        $r = base_run(host."auth/login", $data);
        continue;
    } elseif ($r1["status"] == 403) {
        print m . sc . " cloudflare!" . n;
        unlink(cookie_only);
        if ($mt == 1) {
            new_save(host, true);
        }
        goto re_DATA;
    } elseif ($r1["login"]) {
        unlink(cookie_only);
        if ($mt == 1) {
            new_save(host, true);
        }
        goto DATA;
    } elseif ($r1["empty"]) {
        print m."devnya Rungkat ganti coin aja".n;
        goto home;
    } else {
        print p."hallo kafir!";
        r();
    }
    $t = time() + 90;
    $bypass = visit_short($r1, $cancel);
   
    if ($bypass == "refresh" || $bypass == "skip") {
        continue;
    } elseif (!$bypass) {
        $r1 = base_run($link);
      
        if ($r1["login"]) {
            continue;
        }
        lah(2,"shortlinks");
        goto home;
    }
    $t1 = time();
   
    if ($t - $t1 >= 1) {
        L($t - $t1);
    }
    $r1 = base_run($bypass);#die(file_put_contents("instan.html", $r1["res"]));
    
    if ($r1["login"]) {
        continue;
    } 
    
    if (preg_match("#(suc|sen|hast)#is", $r1["notif"])) {
        text_line(h.$r1["notif"]);
    } else {
        print m.$r1["notif"];
        r();
    }
}


      




function base_run($url, $data = 0) {
    global $cookie, $u_a;
    if ($cookie) {
        $text_cookie = $cookie;
        $user_agent = $u_a;
    } else {
        $text_cookie_jar = cookie_only;
        $user_agent = user_agent();
    }
    $header = ["user-agent: ".$user_agent];
    $r = curl($url, $header, $data, true, $text_cookie_jar, $text_cookie);
    unset($header);
    #$r[1] = file_get_contents("instan.html");
    #die(file_put_contents("instan.html", $r[1]));
    $json = json_decode(base64_decode($r[1]));
    
    if (!$json) {
        $json = $r[2];
    }
    #preg_match("#(>Login<|Enter Your Faucet)#is", $r[1], $login);
    preg_match("#(>login<|>Signin<)#is", trimed($r[1]), $login);
    preg_match("#empty<#is", $r[1], $empty);
    preg_match_all('#<input type="hidden" name="(.*?)" id="token" value="(.*?)">#is', str_replace('name="anti', '', $r[1]), $token);
    preg_match_all("#(fas fa-exclamation-circle></i>|alert-borderless'>|Toast.fire|Swal.fire|swal[(])(.*?)(<)#is", str_replace(['"'], '', $r[1]), $notif_1);
    
    foreach ($notif_1[2] as $notif_2) {
        $keywords = array(
            "been",
            "`success`",
            "invalid",
            "key",
            "success"
        );
        if (multi_strpos($notif_2, $keywords)) {
            preg_match_all('#(title|html):(.*?)(,|\n})#is', $notif_2, $notif_3);
            
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
    
    if (strlen($r[1]) >= 1000) {
        $dom = new DOMDocument;
        $dom->loadHTML($r[1]);
        $linksss = $dom->getElementsByTagName('a');
    
        foreach ($linksss as $linkss) {
            $links = $linkss->getAttribute('href');
            
            if (strpos($links, "currency") !== false) {
                $link[] = $links;
                $l_name1 = $linkss->parentNode->parentNode->getElementsByTagName('h2')->item(0);
                $list[] = $l_name1 ? $l_name1->textContent : ($linkss ? $linkss->nodeValue : '');
            }
        }
   
        if ($list[0]) {
   
            for ($i = 0; $i < count($link); $i++) {
  
                if (preg_match("#(link)#is", $link[$i])) {
                    if (strpos($link[$i], "http") === false) {
                        $host = host."/";
                    }
                    $lin[] = str_replace("///", "/", $host.$link[$i]);#print_r($lin);
                    $tl[] = $list[$i];
                }
            }
            $methode["links"] = [
            array_filter($tl),
            array_filter($lin)];
        } else {
            $methode = [1 => 2];
        }
    }
    if (!$lin[0]) {
       $methode = [1 => 2];
    }
    preg_match_all('#[a-z]*:\/\/[a-zA-Z0-9\/-\/.-]*\/go\/?[a-zA-Z0-9\/-\/.]*#is', $r[1], $visit);
    preg_match_all('#>(\d+\/+\d+)#is', str_replace("-", "", trimed($r[1])), $left);
    preg_match_all('#(class="card-title mt-0 text-white">|class="card-title mt-0">)(.*?)<#is', str_replace('mt-0">Your', "", $r[1]), $name);
    #die(print_r($name));
    preg_match("#firewall#is", $r[1], $firewall);
    preg_match_all('#="(cf-turnstile)" data-sitekey="(.*?)"#is', $r[1], $cap);
  
     print p;
     return array_merge([
         "status" => $r[0][1]["http_code"],
         "r" => $r[0][2],
         "login" => $login[1],
         "empty" => $empty[0],
         "res" => $r[1],
         "token" => $token,
         "name" => $name[2],
         "visit" => $visit[0],
         "left" => $left[1],
         "url1" => $r[0][0]["location"],
         "notif" => $notif,
         "firewall" => $firewall[0],
         "cap" => $cap
     ], $methode);
}
#cf-turnstile

#<h4 class="card-title mt-0 text-white">Clk.sh</h4>