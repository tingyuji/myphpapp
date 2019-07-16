<html>
<head>
<meta charset="utf-8">
<title>try</title>
</head>
<body>
<?php
    function paramsdata(){
//        "alerts": [
//            {
//              "status": "<resolved|firing>",
//              "labels": <object>,
//              "annotations": <object>,
//              "startsAt": "<rfc3339>",
//              "endsAt": "<rfc3339>",
//              "generatorURL": <string> // identifies the entity that caused the alert
//            },
//            ...
//          ]
        $eachData = array("status"=>"high","annotations"=>array("description"=>"高级警告"));
        $alerts = array($eachData);
        $alerts = json_encode($alerts);
//        echo $alerts;
        return $alerts;
    }
?>
<form action="getinfo.php" method="post">
名字: <textarea name="alerts" rows="5" cols="40"><?php echo paramsdata();?></textarea>
年龄: <input type="text" name="age">
<input type="submit" value="提交">
</form>

</body>
</html>