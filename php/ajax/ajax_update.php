<?php

include('../config.php');
$dom = $db_c->query('SELECT * FROM '.DBP.'domain');
while($d = mysqli_fetch_array($dom)) {
    
    $domain = $d['domain'];
    
    $path = '../../cache/' . substr($domain, 0, 3) . '/';
    generate_cache($path, $domain);

}
echo json_encode(array('cd'=>'success'));
function generate_cache($path, $domain)
{
    if (!is_dir($path)) {
        mkdir($path, 0755);
    }

    $page = postSomething(array('domain' => $domain), 'http://site.job/php/generate_template.php', $resp = 10);
    if ($page[0] != '404') {
        $fp = fopen($path . $domain . '.html', 'w');
        fwrite($fp, $page);
        fclose($fp);
    }
}

function postSomething($data, $url, $resp = 10)
{
    $query = http_build_query($data);
    $contextData = array(
        'method' => 'POST',
        'header' => "Connection: close\r\n" .
            "Content-Type: application/x-www-form-urlencoded\r\n" .
            "Content-Length: " . strlen($query) . "\r\n",
        'content' => $query);
    if ($resp != 0) {
        $contextData['timeout'] = $resp;
    }

    $context = stream_context_create(array('http' => $contextData));

    $result = file_get_contents(
        $url,
        false,
        $context);

    return $result;
}