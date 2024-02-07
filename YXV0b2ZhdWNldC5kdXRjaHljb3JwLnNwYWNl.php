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

eval(str_replace('name_host',"dutchycorp",str_replace('example',"autofaucet.dutchycorp.space",'const host="https://example/",sc="name_host",cookie_only="cookie_example",mode="dutchy";')));


DATA:
$u_a = new_save("user-agent")["user-agent"];
$u_c = new_save(host)[explode("/", host)[2]];

#$r = base_run(host."coin_roll.php");

c();
$x = 0;
home:
$x++;
$r = base_run(host. "dashboard.php");#die(print_r($r));
if ($r["status"] == 403){
    print m."cloudflare!".n;
    new_save(host, true);
    goto DATA;
} elseif ($r["account"]){
    print m."cookie expired!".n;
    new_save(host, true);
    goto DATA;
}
if ($x == 1){
    c().asci(sc).ket("username",$r["username"]);
    ket("balance",$r["balance"]);
    line();
    print n;
}

menu:
ket(1, "shortlinks", 2, "faucet");
$p = tx("number", 1);
if ($p == 1) {
    goto shortlinks;
} elseif ($p == 2) {
    goto roll;
} else {
    goto menu;
}
print n;
shortlinks:
while(true){
    $r = base_run(host."shortlinks-wall.php");
    
    if ($r["status"] == 403){
        print m."cloudflare!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["account"]){
        print m."cookie expired!".n;
        new_save(host, true);
        goto DATA;
    }
    $bypas = visit_short($r);
    
    if ($bypas == "refresh"){
        continue;
    } elseif (!$bypas){
        goto roll;
    }
    $r1 = base_run($bypas);
   
    if (preg_match('#added#is',$r1["notif"][0])){
        text_line(h.$r1["notif"][0]);
        ket("balance",$r1["balance"]).line();
    } else {
        print m.$r1["notif"][0];
        r();
    }
}

roll:
while(true) {
    $r = base_run(host."roll.php");
    
    if ($r["status"] == 403){
        print m."cloudflare!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["account"]){
        print m."cookie expired!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["timer"] > 20) {
        #tmr(1, $r["timer"]);
        #continue;
        goto coin_roll;
    }
    $rsp = [
        $r["token"][1][1] => $r["token"][2][1]
    ];
    $cap = babi($r["token"][2][0]);
    
    if (!$cap) {
        continue;
    }
    $data = http_build_query(array_merge($cap, $rsp));
    $r1 = base_run(host."roll.php", $data);
    
    if (preg_match('#number#is',$r1["notif"][1])){
        print h.$r1["notif"][1].n;
        line();
        ket("balance",$r1["balance"]).line();
    } else {
        print m."Invalid Captcha!";
        r();
    }
}

coin_roll:
while(true) {
    $r = base_run(host."coin_roll.php");

    if ($r["status"] == 403){
        print m."cloudflare!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["account"]){
        print m."cookie expired!".n;
        new_save(host, true);
        goto DATA;
    } elseif ($r["timer"] > 20) {
        tmr(1, $r["timer"]);
        goto roll;
    }
    $rsp = [
        $r["token"][1][1] => $r["token"][2][1]
    ];
    $cap = babi($r["token"][2][0]);
    
    if (!$cap) {
        continue;
    }
    $data = http_build_query(array_merge($cap, $rsp));
    $r1 = base_run(host."coin_roll.php", $data);
    
    if (preg_match('#number#is',$r1["notif"][1])){
        print h.$r1["notif"][1].n;
        line();
        ket("balance",$r1["balance"]).line();
    } else {
        print m."Invalid Captcha!";
        r();
    }
}






/*
exit;
#########ptc babi
$r = base_run(host."ptc/wall.php");
$r1 = base_run(host.$r["id"]);

#die(print_r($r1));
L($r1["timer"]);
$rsp = [
    "hash" => $r1["token"][2][1],
    explode('"', $r1["token"][1][1])[0] => ""
];
$cap = babi($r1["token"][2][0]);

$data = http_build_query(array_merge($cap, $rsp));
#base_run($r1["url1"]);
$r2 = base_run(host."ptc/set-ptc-settings.php?viewadurl=".explode("=", $r["id"])[1], $data);

#$r = base_run(host."ptc/wall.php");
print_r($r2); #exit;
print urldecode (host.str_replace($r["id"], "ptc/set-ptc-settings.php?viewadurl=".explode("=", $r["id"])[1], $r["id"])).n;
die(file_put_contents("instan.html",$r1["res"]));
die();

$r1 = base_run(host.$r["id"]);
goto shortlinks;


*/






auto:
$r = base_run(host);#die(print_r($r));
if ($r["status"] == 403){
  print m."cloudflare!".n;
  new_save(host, true);
  goto DATA;
} elseif ($r["account"]){
  print m."cookie expired!".n;
  new_save(host, true);
  goto DATA;
} elseif (!$r["token"]){
  goto auto;
}
$rsp = array("coins" => "usdt");
$data = data_post($r["token"], "null");
$n = 0;
while(true){
  $n++;
  if ($n == 2){
    unset($data);
  }
  if (diff_time(2, "7:01") == 1){
    goto home;
  }
  $r = base_run(host."start", $data);
  if ($r["status"] == 403){
    print m."cloudflare!".n;
    new_save(host, true);
    goto DATA;
  } elseif ($r["account"]){
    print m."cookie expired!".n;
    new_save(host, true);
    goto DATA;
  } elseif (!$r["timer"]){
    continue;
  }
  tmr(2, $r["timer"]);
  $js = base_run(host."internal-api/payout/")["json"];
  if ($js->success == true){
    ket("balance",number_format($js->balance)." ACP");
    ket("reward",$js->logs->USDT." Satoshi USDT");
    ket("time_left",$js->time_left);
    line();
  }
}

function base_run($url, $data = 0, $xml = 0, $boundary = 0){
    global $host;
    $header = head($xml, $boundary);
    $r = curl($url,$header,$data,true,false);
    unset($header);
    #$r[1] = file_get_contents("instan.html");
    #die(file_put_contents("instan.html",$r[1]));
    $json = json_decode(base64_decode($r[1]));
    
    if (!$json){
        $json = $r[2];
    }
    preg_match_all('#name="up" value="(.*?)"#is', $r[1], $visit);
    preg_match_all('/font-color(.*?)</', str_replace(');">', '', $r[1]), $name);
    preg_match_all('#(>)(\d+\/+\d+)(<)#is', trimed($r[1]), $left);
    preg_match('/M\.toast\({html:\'(.*?)\'/', str_replace(" ", "", html_entity_decode($r[1])), $notif);
    preg_match('#<center><p>Lucky (.*?)</div>#is',$r[1],$notif2);
    
    preg_match('#window.open[(]"(.*?)"#is', trimed($r[1]), $location);
    preg_match("#(Login using cwallet or Faucetpay)#is",$r[1],$account);
    preg_match_all('#(Your DUTCHY: <br><b>|username: ")(.*?)("|&)#is',$r[1],$info);
    #die(print_r($info));
    preg_match_all("#'href', '/(.*?)'#is",$r[1],$id);
    preg_match_all('#" name="(.*?)" value="(.*?)"#is',$r[1],$token);
    preg_match('#var (timeleft|timer) = (.*?);#is',$r[1],$timer);
    print p;
    return [
        "status" => $r[0][1]["http_code"],
        "account" => $account,
        "res" => $r[1],
        "json" => $json,
        "visit" => $visit[1],
        "left" => $left[2],
        "name" => $name[1],
        "notif" => [ltrim(strip_tags($notif[1])), str_replace("You", n."You", strip_tags($notif2[0]))],
        "username" => $info[2][1],
        "balance" => $info[2][0],
        "id" => $id[1][0],
        "token" => $token,
        "timer" => $timer[2],
        "url1" => $location[1],
        "url" => $r[0][0]["location"]
    ];
}



function dutchy($r, $id) {
    $dom = new DOMDocument;
    $dom->loadHTML($r);
    $antibotElement = $dom->getElementById('antibotsl'.$id);
    $antibotFormElement = $antibotElement->getElementsByTagName('form')->item(0);
    $antibotPath = $antibotFormElement->getAttribute('action');
    return str_replace(["&antibot", "/"], "", $antibotPath);
    /*$data[] = str_replace(["&antibot", "/"], "", $antibotPath);
    $antibotInputs = $dom->getElementsByTagName('p');
    #die(print_r($antibotInputs));
    #$antibotIcon = null;
    
    foreach ($antibotInputs as $input) {
        if (strpos($input->textContent, "Select") !== false) {
            $antibotIcon[] = $input->getElementsByTagName('span')->item(0)->textContent;
        }

    }
    
    #die(print_r($antibotIcon));
    $data[] = $antibotIcon;
    return $data;*/
}

function babi($tk) {
    $eol = "\n";
    $boundary = "------WebKitFormBoundary";
    $content = 'Content-Disposition: form-data; name="payload"';
    
   #h while (true) {
        $code = az_num(16);
        $data = '';
        $data .= $boundary . $code . $eol;
        $data .= $content . $eol . $eol;
        $data .= base64_encode(json_encode(["i" => round(microtime(true) * 1000) * 2, "a" => 1, "t" => "dark", "tk" => $tk, "ts" => round(microtime(true) * 1000)])) . $eol;
        $data .= $boundary . $code . '--';
        $r = base_run(host . "lib/iconcaptcha/captcha-request.php", $data, 1, $code);

        if ($r["status"] == 403) {
            print m . "there is an error!!";
            sleep(1);
            r();
            return "";
        }
        $id = $r["json"]->id;
        $r = base_run(host . "lib/iconcaptcha/captcha-request.php?payload=" . base64_encode(json_encode(["i" => $id, "tk" => $tk,  "ts" => round(microtime(true) * 1000)])));
        
        if ($r["status"] == 403) {
            print p . "no captcha wait!";
            L(60);
            r();
            return "";
        }
        
        for ($i = 0; $i < 5; $i++) {
            $coordinate = coordinate($r["res"], $i);
            if ($coordinate["x"]) {
                break;
            }
        }
        
        if (!$coordinate["x"]) {
            return "";
        }
        
        $microtime = ["ts" => round(microtime(true) * 1000)];
        $load = ["i", "x", "y", "w", "a", "tk"];
        $pay = [$id, $coordinate["x"], $coordinate["y"], 320, 2, $tk];
        
        $answer = array_combine($load, $pay);
        $answer_enc = json_encode(array_merge($answer, $microtime));

        $code1 = az_num(16);
        $data1 = '';
        $data1 .= $boundary . $code1 . $eol;
        $data1 .= $content . $eol . $eol;
        $data1 .= base64_encode($answer_enc) . $eol;
        $data1 .= $boundary . $code1 . '--';
        
        $r = base_run(host . "lib/iconcaptcha/captcha-request.php", $data1, 1, $code1);
        
        if ($r["status"] == 200) {
            return [
                "_iconcaptcha-token" =>
                 $tk,
                "ic-hf-se" => join(',', [$answer["x"], $answer["y"], $answer["w"]]),
                "ic-hf-id" => $id,
                "ic-hf-hp" => ""
            ];
        } else {
          print p . "error captcha not solve";
          sleep(2);
          r();
          return "";
        #}
        
    }
}

