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
$r = base_run(host. "dashboard");#die(print_r($r));
if($r["status"] == 403){
  print m."cloudflare!".n;
  new_save(host, true);
  goto DATA;
} elseif($r["account"]){
  print m."cookie expired!".n;
  new_save(host, true);
  goto DATA;
}
if($x == 1){
  c().asci(sc).ket("username",$r["username"]);
  ket("balance",$r["balance"]);
  line();
  print n;
}
goto shortlinks;

if($r["claim_reward"] >= 1){
  print k."wait claimed reward levels".n;
  line();
  L(5);
  goto claim_reward;
} else {
  L(5);
  goto daily_task;
}



claim_reward:
while(true){
  $r = base_run(host."levels");
  if($r["status"] == 403){
    print m."cloudflare!".n;
    new_save(host, true);
    goto DATA;
  } elseif($r["account"]){
    print m."cookie expired!".n;
    new_save(host, true);
    goto DATA;
  } elseif(!$r["tasks_level"][0]){
    goto daily_task;
  }
  L(5);
  $r1 = base_run(host.$r["tasks_level"][0]);
  if(preg_match('#suc#is',$r1["notif"])){
    print text_line(h.$r1["notif"]);
  } else {
    print m.$r1["notif"];
    r();
  }
}

daily_task:
$r = base_run(host."tasks");
#die(file_put_contents("response_body.html",$r["res"]));
if($r["status"] == 403){
  print m."cloudflare!".n;
  new_save(host, true);
  goto DATA;
} elseif($r["account"]){
  print m."cookie expired!".n;
  new_save(host, true);
  goto DATA;
}
$b = -1;
while(true){
  $b++;
  if(!$r["mark"][$b]){
    goto shortlinks;
  }
  if(preg_match('#disabled#is',$r["mark"][$b])){
    continue;
  }
  L(5);
  $r1 = base_run(host.$r["tasks_level"][$b]);
  if(preg_match('#suc#is',$r1["notif"])){
    print text_line(h.$r1["notif"]);
  } else {
    print m.$r1["notif"];
    r();
  }
}




shortlinks:
while(true){
  $r = base_run(host."links/?crypto=LTC&processor=ccpayment");
  if($r["status"] == 403){
    print m."cloudflare!".n;
    new_save(host, true);
    goto DATA;
  } elseif($r["account"]){
    print m."cookie expired!".n;
    new_save(host, true);
    goto DATA;
  }
  $bypas = visit_short($r);
  if($bypas == "refresh"){
    continue;
  } elseif(!$bypas){exit;
    goto auto;
  }
  $r1 = base_run($bypas);
  if(preg_match('#been#is',$r1["notif"])){
    text_line(h.$r1["notif"]);
    ket("balance",$r1["balance"]).line();
  } else {
    print m.$r1["notif"];
    r();
  }
}


auto:
$r = base_run(host);#die(print_r($r));
if($r["status"] == 403){
  print m."cloudflare!".n;
  new_save(host, true);
  goto DATA;
} elseif($r["account"]){
  print m."cookie expired!".n;
  new_save(host, true);
  goto DATA;
} elseif(!$r["token"]){
  goto auto;
}
$rsp = array("coins" => "usdt");
$data = data_post($r["token"], "null");
$n = 0;
while(true){
  $n++;
  if($n == 2){
    unset($data);
  }
  if(diff_time(2, "7:01") == 1){
    goto home;
  }
  $r = base_run(host."start", $data);
  if($r["status"] == 403){
    print m."cloudflare!".n;
    new_save(host, true);
    goto DATA;
  } elseif($r["account"]){
    print m."cookie expired!".n;
    new_save(host, true);
    goto DATA;
  } elseif(!$r["timer"]){
    continue;
  }
  tmr(2, $r["timer"]);
  $js = base_run(host."internal-api/payout/")["json"];
  if($js->success == true){
    ket("balance",number_format($js->balance)." ACP");
    ket("reward",$js->logs->USDT." Satoshi USDT");
    ket("time_left",$js->time_left);
    line();
  }
}

function base_run($url, $data = 0, $xml = 0){
    global $host;
    $header = head_fire($xml);
    $r = curl($url,$header,$data,true,false);
    unset($header);
    #$r[1] = file_get_contents("instan.html");
    #die(file_put_contents("response_body.html",$r[1]));
    $json = json_decode(base64_decode($r[1]));
    
    if (!$json){
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
  preg_match('#(retry after|back after) ([0-9]*) (seconds|minutes)#is',$r[1],$timer);
  preg_match("#(Login using cwallet or Faucetpay)#is",$r[1],$account);
  preg_match_all('#(class="fs-4 fw-8 mb-6 text-white">|class="col-6 text-black text-center">|class="col-6 bg-warning text-black">)(.*?)<#is',$r[1],$info);
  
  preg_match('#Claim Rewards (.*?)<#is',$r[1],$claim_reward);
  preg_match_all('#<a href="/((levels?[a-zA-Z0-9-=?&]*claim[a-zA-Z0-9-=&]*)|(tasks?[a-z-\/]*collect[0-9-\/]*))#is',$r[1],$tasks_level);
  preg_match_all('#\d+/\d+#is',str_replace(['</span>','<bstyle="color:#00b8a5">'],"",trimed($r[1])),$part);
  preg_match_all('#class="btn waves-effect waves-light collect(.*?)"#is',$r[1],$mark);
  preg_match("#captcha-recaptcha','(.*?)'#is",$r[1],$recaptcha);
  preg_match("#captcha-hcaptcha','(.*?)'#is",$r[1],$hcaptcha);  
  preg_match('#challenge.script(.*?)k=(.*?)"#is',$r[1],$solvemedia);
  preg_match_all('#<input name="(.*?)" type="radio" id="select-(.*?)"#is',$r[1],$type);
  
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
    "timer" => $timer[2],
    "notif" => $notif,
    "claim_reward" => preg_replace("/[^0-9]/","",$claim_reward[1]),
    "tasks_level" => $tasks_level[1],
    "mark" => $mark[0],
    "private_solvemedia" => $solve,
    "recaptcha" => $recaptcha[1],
    "hcaptcha" => $hcaptcha[1],
    "type" => $type,
    "url1" => $location[1],
    "url" => $r[0][0]["location"]
    ];
}

function head_fire($xml = false){
  global $u_a, $u_c;
  $header = array();
  $header[] = "Host: ".explode("/",host)[2];
  $header[] = "referer: ".host;
  $header[] = "user-agent: ".$u_a;
  if($xml){
    $header[] = "x-requested-with: XMLHttpRequest";
  }
  if($u_c){
    $header[] = "cookie: ".$u_c;
  }
  return $header;
}
