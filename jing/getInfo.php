<?php
//    $description = $_POST["alerts"][0]["annotations"]["description"];
      $alerts = $_POST["alerts"];
      $alerts = json_decode($alerts,true);
      print_r($alerts[0]);
      $description = $alerts[0]["annotations"]["description"];
      echo $description;
        $params = array('msgtype' => 'text','text' => array('content' => $description, 'mentioned_list' => ["@all"]));
        $params = json_encode($params);
        echo $params;
        $url = "https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=27d655ee-ecab-4c7f-8355-6c2626634411";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);  //是否post请求
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json; charset=utf-8'));
    echo '<br />111<br />';
    $response = curl_exec($ch);
    echo '111';
    echo $response;
    curl_close($ch);

?>
