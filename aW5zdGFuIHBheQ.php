<?php
/*error_reporting(0);


// Load HTML content
    $r[1] = file_get_contents("instan.html");
    $dom = new DOMDocument;
    $dom->loadHTML($r[1]);
    $linksss = $dom->getElementsByTagName('a');
    
    foreach ($linksss as $linkss) {
        $links = $linkss->getAttribute('href');
            
        if (strpos($links, "currency") !== false) {
            $link[] = $links;
            $list[] = $linkss->parentNode->parentNode->getElementsByTagName('h2')->item(0)->textContent;
        }
    }
    print_r($link);
    print_r($list);
exit;*/



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
  "chillfaucet.in"
  ];
  
for($i=0;$i<count($web);$i++){
  if($web[$i]){
    ket($i+1,$web[$i]);
  }
}

$p = preg_replace("/[^0-9]/","",trim(tx("number")));
$host = $web[$p-1];
if(!$host){
  goto go_home;
}

if($host == "onlyfaucet.com" || $host == "claimcoins.net"){
  $cancel = 1;
}

eval(str_replace('name_host',explode(".",$host)[0],str_replace('example',$host,'const host="https://example/",sc="name_host",cookie_only="cookie_example",mode="vie_free";')));
#die(print_r(curl($url,["referer:".$referer],0,true)));


DATA:
$email = save("email");
#<a href="https://claimcoins.net/links/currency/ltc"
$r = base_run(host);//die(print_r($r));
if($r["status"] == 403){
  die(m."banned IP please airplane mode for a moment");
} elseif(!$r["login"]){
  goto home;
}
$t = $r["token"];
$array = array("wallet" => $email);
$data = data_post($t, "null", $array);
$r = base_run(host."auth/login", $data);
if($r["login"]){
  unlink(cookie_only);
  goto DATA;
}
print $r["notif"];r();
      
      
home:
if($host == "claimcoins.net"){
  $link = "https://claimcoins.net/links/currency/ltc";
  goto bn;
}
ket(1, "shortlinks", 2, "faucet");
$pil = preg_replace("/[^0-9]/","",trim(tx("number")));
if($pil == 1){
  $type = "links";
} elseif($pil == 2){
  $type = "faucet";
} else {
  goto home;
}

go:
for($i=0;$i<count($r[$type][0]);$i++){
  if($r[$type][0][$i]){
    ket($i+1,$r[$type][0][$i]);
  }
}

$p = preg_replace("/[^0-9]/","",trim(tx("number")));
$host = $r[$type][0][$p-1];
if(!$host){
  goto go;
}
$link = $r[$type][1][$p-1];
bn:
c().asci(sc).ket("email",$email,"type",$host).line();
if($pil == 1){
  goto links;
} elseif($pil == 2){
  die("cooming soon");
}

links:
while(true){
  $r1 = base_run($link);
  #die(file_put_contents("instan.html",$r["res"]));
  #die(print_r($r1));
  if($r1["status"] == 403){
  die(m."banned IP please airplane mode for a moment");
  } elseif($r1["login"]){
    unlink(cookie_only);
    goto DATA;
  } elseif($r1["empty"]){
    print m."devnya Rungkat ganti coin aja".n;
    goto go;
  }
  $t = time()+90;
  $bypass = visit_short($r1, $cancel);
  if($bypass == "refresh" || $bypass == "skip"){
     continue;
   } elseif(!$bypass){
     $r1 = base_run($link);
     if($r1["login"]){
       continue;
     }
     lah(2,"shortlinks");
     if($host == "claimcoins.net"){
       exit;
     }
     goto home;
   }
   $t1 = time();
   if($t - $t1 >= 1){
     L($t - $t1);
   }
   $r1 = base_run($bypass);
   if($r1["login"]){
     continue;
   } 
   if(preg_match("#(suc|sent)#is",$r1["notif"])){
     text_line(h.$r1["notif"]);
   } else {
     print m.$r1["notif"];
     r();
   }
}


      




function base_run($url, $data = 0){
  $header = ["user-agent: ".user_agent()];
  $r = curl($url,$header,$data,true,cookie_only);
  unset($header);
  #$r[1] = file_get_contents("instan.html");
  #die(file_put_contents("instan.html",$r[1]));
  $json = json_decode(base64_decode($r[1]));
  if(!$json){
    $json = $r[2];
  }
  preg_match("#(>Login<|Enter Your Faucet)#is",$r[1],$login);
  preg_match("#empty<#is",$r[1],$empty);
  preg_match_all('#<input type="hidden" name="(.*?)" id="token" value="(.*?)">#is',str_replace('name="anti','',$r[1]),$token);
  preg_match_all('#(title|html):(.*?)(,)#is',str_replace("'","",$r[1]),$nn);
  /*if(preg_match_all('#<a class="(collapse-item|dropdown-item)" href="(.*?)">(.*?)</a>#is',$r[1],$coin)){*/
    $dom = new DOMDocument;
    $dom->loadHTML($r[1]);
    $linksss = $dom->getElementsByTagName('a');
    
    foreach ($linksss as $linkss) {
        $links = $linkss->getAttribute('href');
            
        if (strpos($links, "currency") !== false) {
            $link[] = $links;
            $list[] = $linkss->parentNode->parentNode->getElementsByTagName('h2')->item(0)->textContent;
        }
    }
    if ($list[0]){
    for($i = 0;$i<=count($link);$i++){
      if(preg_match("#(link)#is",$link[$i])){
        $lin[] = $link[$i];
        $tl[] = $list[$i];
      } else {
        $faucet[] = $link[$i];
        $tf[] = $list[$i];
      }
    }
    $methode["links"]= [array_filter($tl),array_filter($lin)];  
    $methode["faucet"] = [array_filter($tf),array_filter($faucet)];
  } else {
    $methode = [1=>2];
  }
  preg_match_all('#[a-z]*:\/\/[a-zA-Z0-9\/-\/.-]*\/go\/?[a-zA-Z0-9\/-\/.]*#is',$r[1],$visit);
  preg_match_all('#>(\d+\/+\d+)#is',trimed($r[1]),$left);
  preg_match_all('#class="card-title mt-0">(.*?)<#is',str_replace('mt-0">Your',"",$r[1]),$name);
  #die(print_r($name));
  
  
   print p;
   return array_merge([
     "r" => $r[0][2],
     "login" => $login[0],
     "empty" => $empty[0],
     "res" => $r[1],
     "token" => $token,
     "name" => $name[1],
     "visit" => $visit[0],
     "left" => $left[1],
     "url1" => $r[0][0]["location"],
     "notif" => $nn[2][0].$nn[2][1]
     ], $methode);
}

