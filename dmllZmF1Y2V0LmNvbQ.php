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


eval(str_replace('name_host', explode(".", 'viefaucet.com')[0], str_replace('example', 'viefaucet.com', 'const host="https://example/",sc="name_host",bearer_only="bearer_example";')));

#$r = json_decode(file_get_contents("vie.html"));
#exit(print_r($r));
DATA:
$u_a = save("useragent");
$bearer = save(bearer_only);

$r = base_run(host . "api/user/me", 0, 1);
#die(print_r($r));
if ($r["status"] == 403) {
    print m . sc . " cloudflare!" . n;
    unlink(cookie_only);
    goto DATA;
} /*elseif ($r["login"]) {
    print m . sc . $r["json"]->msg . n;
    unlink(bearer_only);
    goto DATA;
}*/

c() . asci(sc).ket("username", $r["json"]->user->username);
ket("balance", $r["json"]->user->balance);
line();
print n;
#exit;
while (true) {
    $r = base_run(host . "api/link", 0, 1);
    
    if ($r["status"] == 403) {
        print m . sc . " cloudflare!" . n;
        unlink(cookie_only);
        goto DATA;
    }/* elseif ($r["login"]) {
        print m . sc . $r["json"]->msg . n;
        unlink(bearer_only);
        goto DATA;
    }*/
    $bypass = bypass_shortlinks_vie($r["json"]);
    
    if ($bypass == "refresh") {
        continue;
    } elseif ($bypass["end"] == 1) {
        die("tunggu updatenya tolol udah kafir nyusahin loe kontol".n);
        tmr(2, max($bypass["reset"]));
        continue;
    }
    base_run($bypass["link"]);
    $data = json_encode(["secret" => $bypass["id"]]);
    $r1 = base_run(host . "api/link/verify", $data, 1)["json"];

    if ($r1->reward == 200) {
        ket("reward", $r1->msg);
        line();
        $r = base_run(host . "api/user/me", 0, 1);
        ket("balance", $r["json"]->user->balance);
        line();
        
    }
}




function base_run($url, $data = 0, $json = 0) {
    $header = h_vie($json);
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





function bypass_shortlinks_vie($r) {
    $file_name = "control";
    $control = file($file_name);
    if (!$control[0]) {
        $control = ["tolol"];
    }
    $config = config();

    $links = $r->links;
    if (!$links[1]->_id) {
        return "refresh";
    }
    $count = count($config) + count($links);

    for ($i = 0; $i < $count; $i++) {
        $id = $links[$i]->_id;
        $maxView = $links[$i]->maxView;
        $avgDuration = $links[$i]->avgDuration;
        $name = remove_emoji($links[$i]->name);
        $history = $r->history;
        for ($s = 0; $s < $count; $s++) {
          if (trimed(strtolower($name)) == trimed(strtolower($control[$s]))) {
              goto next;
          }
        }

        for ($j = 0; $j < $count; $j++) {
          if ($id == $history[$j]->_id) {
              if ($history[$j]->count == $maxView) {
                  goto next;
              }
          }
        }

        for ($z = 0; $z < $count; $z++) {
          if (trimed(strtolower($name)) == trimed(strtolower($config[$z]))) {
             for ($j = 0; $j < $count; $j++) {
                 if ($id == $history[$j]->_id) {
                    $passed = $history[$j]->count;
                 }
             }
             goto upload;
          }
        }

        next:
    }
    return [
        "end" => 1,
        "reset" => $wait_time
    ];
    upload: #die(print_r($name));
    $time = time() + $avgDuration;
    $status = base_run(host . "app/link/go/".$id);

    if ($status["status"] >= 201 ) {
        return "refresh";
    }
    $js = base_run(host . "api/link/".$id, 0, 1)["json"];
    if (!$passed) {
        $passed = "0";
    }
    if ($js->result) {
        ket_line("", $name, "passed", $passed);
        ket("", k . $js->result).line();

        for ($h = 0; $h < 5; $h++) {
            if (!$js->result) {
                return "refresh";
            }
            $bypass_shortlinks = bypass_shortlinks($js->result);

            if (preg_match("#(http)#is", $bypass_shortlinks)) {
                L($time - time() + 1);
                return [
                    "link" => $bypass_shortlinks,
                    "id" => explode("link/", $bypass_shortlinks)[1]
                ];
            }
        }
    } else {
        return "refresh";
    }
}



function h_vie($json = 0) {
    global $u_a, $u_c, $bearer;
    $header[] = 'Host: viefaucet.com';
    $header[] = 'user-agent: '.$u_a;
    
    if ($json) {
       $header[] = 'authorization: '.$bearer;
       $header[] = 'content-type: application/json';
       $header[] = 'accept: application/json, text/plain, */*';
    } else {
        $header[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
    }
    
    $header[] = 'referer: https://viefaucet.com/';
    $header[] = 'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
    return $header;
}
