<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");

$wechatObj = new wechatCallbackapiTest("wx4f81c66e3afd08c7","0ec10ed2b46b5404e27417ec10d8c424");

//$wechatObj->valid();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest{
    private $appId;
    private $appSecret;
 
    public function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }    
  public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
          echo $echoStr;
          exit;
        }
    }

    public function responseMsg()
    {
    //get post data, May be due to the different environments
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
    if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $msgType=strtolower($postObj->MsgType);

                
                $event=strtolower($postObj->Event);   


                $time = time();

                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";  
                $imageTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";                              

                $newsTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                          <item>
                          <Title><![CDATA[%s]]></Title>
                          <Description><![CDATA[%s]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                          </item>
                          </Articles>
                          </xml>";

                $newsTpl2="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                          <item>
                          <Title><![CDATA[赚米吧登陆提示]]></Title>
                          <Description><![CDATA[本系统一次登陆永久有效]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                          </item>
                          </Articles>
                          </xml>";

                $imgTpl="<xml>
                          <ToUserName><![CDATA[toUser]]></ToUserName>
                          <FromUserName><![CDATA[fromUser]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[image]]></MsgType>
                          <Image>
                          <MediaId><![CDATA[%s]]></MediaId>
                          </Image>
                          </xml>";     



                switch($msgType){
                  
                   case "text":
                              $openid=$fromUsername;
                              
                              $keyword=trim($keyword)."";
                              switch ($keyword) {

                                  case '666':
                                   
//                                    $msgType = "text";
//                                    $message=""."\n\n";
//                                    $message.="<a href='http://www.fangdan8.com/qr/qrcode.php?openid=".$openid."'>☞☞点击完成绑定</a>";
//                                    $message.=""."\n\n";
//                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);

                                    $url='http://www.xiaomutong.com.cn/some.php';
                                    $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx899170e5653af0cf&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                    $PicUrl ='';
                                    $message.=$url2;
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    //$contentStr.=$url2;
                                    //$msgType2 = "news";
                                    //$resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);

                                    echo $resultStr;
                                    break; 
                                 



                                default:

                                 



                                    $message="您的消息已收到，";
                                    $message.=  "\n";
                                    $message.="我们会尽快安排客服跟您取得联系";
                                    $message.=  "\n\n"; 


                                    $message.="---------------";
                                    $message.=  "\n\n"; 
                                    $message.="温馨提示："; 
                                    $message.=  "\n\n"; 
                             

                                    $message.="如需咨询请扫码联系小时光";
                                    $message.="\n\n";
                                    $message.="http://img.fangdan8.com/o_1bet9tock6ad1ftpmtb1k141l6f9.jpeg";
                                    $message.="\n\n";
                                    $message.="\n\n";


                                    $msgType='text';
                                    
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    echo $resultStr; 

                          
                                  

                                                          
                               }
                   
      
                   break;

                }                                        
                if(!empty( $keyword )){
                  $msgType = "text";
                  $message = "<a href='#' >无法识别</a>";
                  $message.=  "\n\n";
                  
                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                  echo $resultStr;
                }else{
                  echo "Input something...";
                }

        }else {
          echo "";
          exit;
        }
    }

    public function sendGetData($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
    public function sendPostData($url,$curlPost){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
    public function send_template_message($template){
             $token=$this->getAccessToken();
             $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;        
             $res=$this->sendPostData($url,$template);
             return  json_decode($res,true);

    }
  private function checkSignature()
  {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
            
    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    
    if( $tmpStr == $signature ){
      return true;
    }else{
      return false;
    }
  }

      public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //$url='http://tel.xsdcm.cn/sample.php';

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
          "appId"     => $this->appId,
          "nonceStr"  => $nonceStr,
          "timestamp" => $timestamp,
          "url"       => $url,
          "signature" => $signature,
          "rawString" => $string
        );
        return $signPackage; 
      }

      private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
          $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
      }

      private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("jsapi_ticket.php"));
        if ($data->expire_time < time()) {
          $accessToken = $this->getAccessToken();
          // 如果是企业号用以下 URL 获取 ticket
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
          $res = json_decode($this->httpGet($url));
          $ticket = $res->ticket;
          if ($ticket) {
            $data->expire_time = time() + 7000;
            $data->jsapi_ticket = $ticket;
            $this->set_php_file("jsapi_ticket.php", json_encode($data));
          }
        } else {
          $ticket = $data->jsapi_ticket;
        }

        return $ticket;
      }


      private function getRealIpAddr(){
          if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
          {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
          }
          elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
          {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
          }
          else
          {
            $ip=$_SERVER['REMOTE_ADDR'];
          }
          return $ip;
      }
      private function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("access_token.php"));
        if ($data->expire_time < time()) {
          // 如果是企业号用以下URL获取access_token
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
          $res = json_decode($this->httpGet($url));
          $access_token = $res->access_token;
          if ($access_token) {
            $data->expire_time = time() + 7000;
            $data->access_token = $access_token;
            $this->set_php_file("access_token.php", json_encode($data));
          }
        } else {
          $access_token = $data->access_token;
        }
        return $access_token;
      }

      private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
      }

      private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
      }
      private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
      }    
}

?>
