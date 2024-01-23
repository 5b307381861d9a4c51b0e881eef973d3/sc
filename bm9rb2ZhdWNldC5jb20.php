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


eval(str_replace('name_host', explode(".", 'nokofaucet.com')[0], str_replace('example', 'api.nokofaucet.com', 'const host="https://example/",sc="name_host",bearer_only="bearer_example";')));

#$r = json_decode(file_get_contents("vie.html"));die(bypass_shortlinks_noko($r));
#die(print_r($r));
DATA:
$u_a = save("useragent");
$bearer = save(bearer_only);

$r = base_run(host . "api/auth/me", 0, 1);
#die(print_r($r));
if ($r["status"] >= 201) {
    print m . $r["json"]->message . n;
    unlink(bearer_only);
    goto DATA;
}

c() . asci(sc).ket("username", $r["json"]->username);
ket("balance", $r["json"]->balance);
line();
print n;
#exit;
while (true) {
    $r = base_run(host . "api/shortlink/getPagnigation?keyword=&page=1&perPage=40&sortDate=undefined&sortBy=undefined&paginationVersion=2", 0, 1);
    
    if ($r["status"] >= 201) {
        print m . $r["json"]->message . n;
        unlink(bearer_only);
        goto DATA;
    }
    $bypass = bypass_shortlinks_noko($r["json"]);
    
    if ($bypass == "refresh") {
        continue;
    } elseif ($bypass["end"] == 1) {die(m."you are banned".n);
        tmr(2, time() - $bypass["reset"]);
        continue;
    }
    base_run($bypass["link"]);
    $data = json_encode(["key" => $bypass["id"]]);
    $r1 = base_run(host . "api/shortlink/verify-shortlink", $data, 1)["json"];
    #die(print_r($r1));
    if (strpos($r1->message, "Claim") !== false) {
        print h . $r1->message;
        r();
        $r = base_run(host . "api/auth/me", 0, 1);
       
         if ($r["status"] >= 201) {
            print m . $r["json"]->message . n;
            unlink(bearer_only);
            goto DATA;
        }
        ket("balance", $r["json"]->balance);
        line();
        
    }
}




function base_run($url, $data = 0, $json = 0) {
    $header = h_noko($json);
    $r = curl($url, $header, $data, true, false);
    unset($header);
    #$r[1] = file_get_contents("bitmun.html");
    #die(file_put_contents("asu.html",$r[1]));
    
    preg_match("#(please login)#is", $r[1], $login);
    

    return [
        "status" => $r[0][1]["http_code"],
        "res" => $r[1],
        "json" => $r[2],
        "login" => $login[0],
        "url" => $r[0][0]["location"],
    ];
}





function bypass_shortlinks_noko($r) {
    $file_name = "control";
    $control = file($file_name);
    
    if (!$control[0]) {
        $control = ["tolol"];
    }
    $config = config();

    $data = $r->data;
    #die(print_r($data));
    if (!$data[1]->_id) {
        return "refresh";
    }
    $count = count($config) + count($data);

    for ($i = 0; $i < $count; $i++) {
        $id = $data[$i]->_id;
        $view_per_day = $data[$i]->view_per_day;
        $title = remove_emoji($data[$i]->title);
        $remain_view = $data[$i]->remain_view;
        $updatedAt = $data[$i]->updatedAt;
        
        for ($s = 0; $s < $count; $s++) {
        
            if (trimed(strtolower($title)) == trimed(strtolower($control[$s]))) {                
                goto next;
            }
          
            if (trimed(strtolower($title)) == trimed(strtolower($config[$s]))) {
            
                if ($remain_view == 0) {
                $claim = strtotime($updatedAt);
                                
                    if ($claim >= 10) {
                        $times[] = $claim;
                    }
                    goto next;
                }
                goto upload;
            }
        }
        next:
    }
    return [
        "end" => 1,
        "reset" => date(min($times), strtotime("tomorrow"))
    ];
    upload:
    #die(print_r($title));
    $js = base_run(host . "api/shortlink/generate/".$id, 0, 1)["json"];
    
    if ($js->url) {
        ket_line("", $title, "left", $remain_view."/".$view_per_day);
        ket("", k . $js->url).line();

        for ($h = 0; $h < 5; $h++) {
        
            if (!$js->url) {
                return "refresh";
            }
            $bypass_shortlinks = bypass_shortlinks($js->url);

            if (preg_match("#(http)#is", $bypass_shortlinks)) {
                return [
                    "link" => $bypass_shortlinks,
                    "id" => explode("link/", $bypass_shortlinks)[1]
                ];
            }
        }
        
        if (strpos($bypass_shortlinks, "http") === false) {
            return "refresh";
        }
    } else {
        return "refresh";
    }
}



function h_noko($json = 0) {
    global $u_a, $bearer;

    $header[] = 'user-agent: '.$u_a;
    
    if ($json) {
       $header[] = 'authorization: '.$bearer;
       $header[] = 'content-type: application/json';
       $header[] = 'accept: application/json, text/plain, */*';
    } else {
        $header[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
    }    
    $header[] = 'accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
    return $header;
}
