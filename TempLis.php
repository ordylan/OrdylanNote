<!--SUCCESS_GETaaaa-->

<?php
require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($onpass != "true"){
    exit( "<p>你还未登录! 功能使用将受限!<br><a href=\"/passport.php\">去登录</a>");
}
$sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
$conn= new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);

if ($conn->connect_error) {
  die("连接失败: " . $conn->connect_error);
}

function isComplete($conn, $id) {
  $sql = "SELECT complete FROM temptasks WHERE id=".$id;
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row["complete"];
  } else {
    return false;
  }
}

function getTasks($conn) {
  $sql = "SELECT * FROM temptasks ORDER BY subject, id";
  $result = $conn->query($sql);
  $tasks = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $tasks[] = $row;
    }
  }
  return $tasks;
}

function updateComplete($conn, $id, $complete) {
  $sql = "UPDATE temptasks SET complete=".$complete." WHERE id=".$id;
  $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $complete = $_POST["complete"];
  updateComplete($conn, $id, $complete);
}

$tasks = getTasks($conn);

echo "<a href=\"/internalPROJECT.php?1\" data-cp=\"no\">back</a><table>";
echo "<tr><th>科目</th><th>任务</th><th>状态</th></tr>";
$current_subject = "";
foreach ($tasks as $task) {
  if ($current_subject != $task["subject"]) {
    $current_subject = $task["subject"];
    echo "<tr><td colspan=\"3\"><strong>".$current_subject."</strong></td></tr>";
  }
  echo "<tr>";
  echo "<td></td>";
  echo "<td>".$task["name"]."</td>";
  if (isComplete($conn, $task["id"])) {
    echo '<td><input type="checkbox" disabled checked></td>';
  } else {
    echo '<td><form method="post"><input type="checkbox" onchange="this.form.submit()" name="complete" value="1"><input type="hidden" name="id" value="'.$task["id"].'"></form></td>';
  }
  echo "</tr>";
}
echo "</table>";


$conn->close();

?>
