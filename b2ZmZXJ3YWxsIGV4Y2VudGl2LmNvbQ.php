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

$host = "excentiv.com";
ket(1, "new url", 2, "old url");
$tx = tx("number", 1);
if ($tx == 1) {
   new_save($host, true);
}

DATA:
$u_a = new_save("user-agent")["user-agent"];
$url = new_save($host)[$host];

parse_str(str_replace("?", "&", $url), $out);
$key = $out["key"];
$userid = $out["userid"];

if (stripos($url, "userid") === false) {
    new_save($host, true);
    print m."masukan url dengan benar!".n;
    goto DATA;
}


eval(str_replace('name_host', explode(".", "excentiv.com")[0], str_replace('example', "excentiv.com", 'const host="https://example/",sc="name_host",cookie_only="cookie_example",mode="vie_free";')));

c().asci(sc);
ket("userid", $userid, "key", $key).line();
print n;

while(true) {
    unlink($host);
    $r = base_run(host."offerwall/links?key=$key&userid=$userid");    
    
    if ($r["status"] == 403) {
        die(m."cloudflare!".n);
    } elseif ($r["status"] == 200) {        
        $bypas = visit_short($r);

        if ($bypas == "refresh" || $bypas == "skip") {
            continue;
        } elseif (!$bypas) {
            die(lah(1, "sl"));
        }
        $r1 = base_run($bypas);
        
        if (stripos($r1["notif"], "congratulations") !== false) {
            text_line(h . $r1["notif"]);
        } else {
            print m.$r1["notif"];
            r();
        }                
    }    
}



function base_run($url, $data = 0, $xml = 0) {
    $header = head_offer($xml);
    $r = curl($url, $header, $data,true,"ofer.txt");
    unset($header);
    #$r[1] = file_get_contents("bitmun.html");
    #die(file_put_contents("bitmun.html", $r[1]));
    $json = json_decode(base64_decode($r[1]));
 
    if (!$json) {
        $json = $r[2];
    }
    $dom = new DOMDocument;
    $dom->loadHTML($r[1]);
    $elements = $dom->getElementsByTagName('div');

    foreach ($elements as $element) {
        if ($element->getAttribute('class') === 'card grow items-center p-4 sm:p-5') {
            $viewCount = $element->getElementsByTagName('span')[0]->textContent;

            if (stripos($viewCount, "view") !== false) {
                $name[] = trim($element->getElementsByTagName('h3')[0]->textContent);
                $link[] = $element->getElementsByTagName('button')[0]->getAttribute('value');
                $left[] = preg_replace("/[^0-9]/", "", $viewCount);
            }
        }
    }

    foreach ($elements as $element) {
        $notif_find = $element->textContent;

        if (stripos($notif_find, "congratulations") !== false || stripos($notif_find, "invalid") !== false) {
            $notif = trim($notif_find);
        }
    }

    return [
        "r" => $r[0][2],
        "status" => $r[0][1]["http_code"],
        "res" => $r[1],
        "json" => $json,
        "url1" => $r[0][0]["location"],
        "name" => $name,
        "left" => $left,
        "visit" => $link,
        "notif" => $notif
    ];
}

function head_offer($xml = 0) {
    global $u_a;
    $header = array();
    
    if ($xml) {
        $header[] = "x-requested-with: XMLHttpRequest";
    }
    
    if (!$u_a) {
        $u_a = user_agent();
    }
    $header[] = "user-agent: ".$u_a;
    return $header;
}
