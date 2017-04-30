<?php
/**
 *管理员操作界面
 */
function calDays($date1, $date2)        /*计算两天之间隔了多少天*/
{
    $time1 = strtotime($date1);
    $time2 = strtotime($date2);
    return (($time2 - $time1) / 86400 - 1);
}

function whichWeek($days)               /*计算当前是第几周*/
{
    if (($days / 7) >= floor($days / 7)) {
        return floor($days / 7) + 1;
    } else {
        return (int)($days / 7);
    }
}

?>
<?php
require('../possess/mysql.php');
session_start();
if ($_SESSION['ID'] == false) {
    header("location:../possess/login.php");
}
$adminID = $_SESSION['ID'];
$date = date('y-m-d');
$day = array('日', '一', '二', '三', '四', '五', '六');
$firstDay = mysqli_fetch_array(mysqli_query($con, 'select * from TheFirstDay'));
$firstDay = $firstDay[0] . '-' . $firstDay[1] . '-' . $firstDay[2];//第一天的日期格式化
$days = calDays($firstDay, $date);      /*当天和本学期第一天中间隔了多少天*/
$whichWeek = whichWeek($days);          /*当前是第几周*/
if (date("w") != 0) {
    $mysqlZJ = date("w") . "%";
} else {
    $mysqlZJ = 7 . "%";
}
$sql_innovation = "select * from innovation 
                      WHERE JSXM='$username' 
                      AND find_in_set('$whichWeek',SKZCMX) 
                      AND SKSJ like '$mysqlZJ' ";
$result = mysqli_query($con, $sql_innovation);
?>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员操作界面</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div align="center"><img src="../head.jpg" width="550"/>
</div>
<br/><br/>
<div align="left" style="margin-left: 20%">
    <?php
    echo "<p><span style='font-weight: bold;font-size: 110%'>" . $adminID . "</span> 管理员, 您好。 <button class=\"btn btn-danger\" onclick='window.location.href=\"../possess/off.php\"'>点此注销</button></p>";
    ?>
    <p>今天是 第<span
                style="text-decoration-line: underline"> <?php echo "&nbsp" . $whichWeek . " " ?></span><?php echo "周 周" . $day[date("w")] . '&nbsp;&nbsp;;' ?></span>
    </p>
    <ul class="list-group">
        <li>
            <button class="btn btn-primary" onclick=" window.location.href='../tch/teacher.php'">查看您当前有课/可直接控制的教室
            </button>
        </li>
        <br>
        <li>
            <button class="btn btn-primary" onclick=" window.location.href='admin-query.php'">查看所有老师的操作记录</button>
        </li>
        <br>
        <li>
            <button class="btn btn-primary" onclick=" window.location.href='admin-setDate.php'">设置本学期的第一天</button>
        </li>
        <br>
        <li>
            <button class="btn btn-primary" onclick=" window.location.href='admin-setClass.php'">
                给老师开放临时的教室控制权限(限当天设置当天有效)
            </button>
        </li>
    </ul>
</div>
<div style="background-color: grey;width: 100%;text-align:left">
<pre
        style="position: fixed;margin: 0 auto;bottom: 0;width: 100%; font-family: 幼圆; color: white;font-size: medium;background-color: grey;">
<span style="color: red;font-weight: bold;font-size: 140%;">注意：</span>
1.每周从周一开始计算;
2.若当前周次为负数(如-2),则为开学前倒数第2周;
</pre>
</div>
</body>
</html>