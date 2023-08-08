<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD("配置_橙鸭笔记系统V2","欢迎使用橙鸭笔记系统","/index.php","","");?>

<?php
if(file_exists("SqlPass.ordylandata")){
    header("Location: index.php");
    exit();
}

if(isset($_POST["submit"])){
    $host = $_POST["host"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $database = $_POST["database"];
    
    $file = fopen("SqlPass.ordylandata", "w");
    fwrite($file, $host."\n");
    fwrite($file, $username."\n");
    fwrite($file, $password."\n");
    fwrite($file, $database."\n");
    fclose($file);
    
    header("Location: index.php"); //跳转到index页面
    exit();
}

//如果没有提交，则显示4个文本框
?>
连接数据库:
    <form method="post" action="">
        <label>主机名:</label>
        <input type="text" name="host"><br>
        <label>用户名:</label>
        <input type="text" name="username"><br>
        <label>密码:</label>
        <input type="password" name="password"><br>
        <label>数据库名:</label>
        <input type="text" name="database"><br>
        <input type="submit" name="submit" value="提交">
    </form>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
