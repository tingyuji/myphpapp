<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx4f81c66e3afd08c7", "0ec10ed2b46b5404e27417ec10d8c424");
$signPackage = $jssdk->GetSignPackage();
echo '<pre>';
print_r($signPackage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  微信示例
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
        'updateAppMessageShareData',
	'updateTimelineShareData'
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
      wx.updateAppMessageShareData({
          title: '分享标题', // 分享标题
          desc: '分享描述', // 分享描述
          link: 'http://www.xiaomutong.com.cn/sample.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
          imgUrl: 'http://www.xiaomutong.com.cn/assets/icon64_appwx_logo.png', // 分享图标
          success: function () {
              // 设置成功
		setTimeout(function(){ alert("Hello"); }, 3000);
          }
      })
    wx.updateTimelineShareData({ 
        title: '分享标题', // 分享标题
        link: 'http://www.xiaomutong.com.cn/sample.php', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://www.xiaomutong.com.cn/assets/icon64_appwx_logo.png', // 分享图标
        success: function () {
          // 设置成功
setTimeout(function(){ alert("Hello"); }, 3000);
        }
    })
  });
</script>
</html>
