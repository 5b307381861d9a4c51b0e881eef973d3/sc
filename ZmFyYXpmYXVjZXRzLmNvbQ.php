<?php


if (!$eval) {
    eval(str_replace('<?php', "", get_e("build_index.php")));
    eval(str_replace('<?php', "", get_e("shortlink_index.php")));
}


eval(str_replace('name_host', explode(".", 'farazfaucets.com')[0], str_replace('example', 'farazfaucets.com', 'const host="https://example/",sc="name_host",bearer_only="bearer_example";')));



DATA:
$u_a = save("useragent");
$bearer = save(bearer_only);

$r = base_run(host . "api/pages/dashboard", "{}", 1);
#die(print_r($r));
if ($r["status"] == 403) {
    print m . sc . " cloudflare!" . n;
    unlink(cookie_only);
    goto DATA;
} elseif ($r["login"]) {
    print m . sc . $r["json"]->msg . n;
    unlink(bearer_only);
    goto DATA;
}
    
c() . asci(sc).ket("email", $r["json"]->referral_statistics->username);
ket("balance", $r["json"]->wallet_balance[2]->balance);
line();
print n;

while (true) {
    $r = base_run(host . "api/shortlink/get-shortlinks", "{}", 1);
    
    if ($r["status"] == 403) {
        print m . sc . " cloudflare!" . n;
        unlink(cookie_only);
        goto DATA;
    } elseif ($r["login"]) {
        print m . sc . $r["json"]->msg . n;
        unlink(bearer_only);
        goto DATA;
    }
    $bypass = bypass_shortlinks_faras($r["json"]);

    if ($bypass == "refresh") {
        continue;
    } elseif ($bypass["end"] == 1) {
        tmr(2, min($bypass["reset"]));
        continue;
    }
    base_run($bypass["link"]);
    $data = json_encode(["shortlink_key" => explode("Shortlinks/", $bypass["link"])[1]]);
    $r1 = base_run(host . "api/shortlink/verify-shortlink", $data, 1)["json"];
    if ($r1->type == "success") {
        print h.$r1->type;
        #msg
        r();
        
        ket("reward", $bypass["reward"]);
        line();
    }
}






function base_run($url, $data = 0, $json = 0) {
    $header = h_tk($json);
    $r = curl($url, $header, $data, true, false);
    unset($header);
    #$r[1] = file_get_contents("bitmun.html");
    #die(file_put_contents("asu.html",$r[1]));
    
    preg_match("#(please login)#is", $r[1], $login);
    

    return [
        "status" => $r[0][1]["http_code"],
        "res" => $r[1],
        "json" => $r[2],
        "login" => $login[0]
    ];
}





function bypass_shortlinks_faras($r) {
    $file_name = "control";
    $control = file($file_name);
    if (!$control[0]) {
        $control = ["tolol"];
    }
    $config = config();

    $shortlinks = $r->shortlinks;
    if (!$shortlinks[1]->id) {
        return "refresh";
    }
    $count = count($config) + count($shortlinks);
    
    for ($i = 0; $i < $count; $i++) {
        $shortlink_limit = $shortlinks[$i]->shortlink_limit;
        $shortlink_available = $shortlinks[$i]->shortlink_available;
        $id = $shortlinks[$i]->id;
        $name = remove_emoji($shortlinks[$i]->shortlink);
        $reward = $shortlinks[$i]->reward;
        $wait_time[] = $shortlinks[$i]->wait_time;

        for ($s = 0; $s < $count; $s++) {
          if (trimed(strtolower($name)) == trimed(strtolower($control[$s])) || $shortlink_available == 0) {
              goto next;
          }
        }
        
        for ($z = 0; $z < $count; $z++) {
          if (trimed(strtolower($name)) == trimed(strtolower($config[$z]))) {
             goto upload;
          }
        }

        next:
    }
    return [
        "end" => 1,
        "reset" => $wait_time
    ];
    upload:
    $data = json_encode(["shortlink_id" => $id, "coin" => "LTC"]);
    $js = base_run(host . "api/shortlink/generate-shortlink", $data, 1)["json"];

    if ($js->type == "success") {
        print h . $js->msg;
        r();
        ket_line("", $name, "left", $shortlink_available ."/". $shortlink_limit);
        ket("", k . $js->shortlink_url).line();

        for ($h = 0; $h < 3; $h++) {
            $bypass_shortlinks = bypass_shortlinks($js->shortlink_url);

            if (preg_match("#(http)#is", $bypass_shortlinks)) {
                return [
                    "link" => $bypass_shortlinks,
                    "reward" => $reward
                ];
            }
        }
    } else {
        print m . $js->res;
        r();
        return "refresh";
    }
}



function h_tk($json = 0) {
    global $u_a, $u_c, $bearer;
    $header[] = 'Host: farazfaucets.com';
    $header[] = 'user-agent: Mozilla/5.0 (Linux; Android 13; M2012K11AG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.80 Mobile Safari/537.36';
    if ($json) {
       $header[] = 'authorization: '.$bearer;
       $header[] = 'content-type: application/json';
       $header[] = 'accept: */*';
    }
    $header[] = 'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
    return $header;
}


