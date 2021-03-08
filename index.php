<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="img/fav.ico">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<meta charset="UTF-8"><title>Xderm Mini Gui versi</title>
<style>
body {
  display:flex; flex-direction:column; justify-content:center;
  min-height:0vh; color:black; background-color:white;
}
.btn {
  -moz-appearance: none;
  cursor: pointer;
  align-items: center;
}
.btn:hover, .btn:focus {
  color: white;
  outline: 0;
}
.third {
  border: 2px ridge #f54c7d;
  border-radius: 15px;
  color: white;
  margin: 5px;
  min-width: 90px;
  height: 40px;
  box-shadow: 0 0 40px 40px black inset, 0 0 0 0 black;
  transition: all 150ms ease-in-out;
}
.third:hover {
  border-color: black;
  color: #f54c7d;
}
.profile {
  border: 2px ridge #f54c7d;
  border-radius: 5px;
  color: white;
  height: 30px;
  box-shadow: 0 0 40px 40px black inset, 0 0 0 0 black;
  transition: all 150ms ease-in-out;
}
.profile:hover {
  border-color: black;
  color: #f54c7d;
}
.col-md-4 {
  text-align: center;
  font-family: cursive; color: black;
  border: 4px ridge #f54c7d;
  border-radius: 15px;
  align-items: center;
  width: 420px;
  height: 50px;
}
.col-butt {
  text-align: center;
  align-items: center;
}
.inline-block {
  display: inline-block;
  text-align: left;
  margin: 5px;
  top: 0px;
}
.textarea {
  align-items: center;
  width: 420px;
}
.text {
  align-items: center;
  width: 410px;
}
</style>
<script>
function shipping_calc() {
  var val = document.getElementById("idconf").value;
 if (val === "config1") {
   var data = document.getElementById("isi1").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config2") {
   var data = document.getElementById("isi2").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config3") {
   var data = document.getElementById("isi3").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config4") {
   var data = document.getElementById("isi4").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config5") {
   var data = document.getElementById("isi5").value;
   document.getElementById("isi").value= data;
 }
}
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                url: "screenlog.0",
		cache: false,
                success: function(result) {
		    $("#log").html(result);
                }
            });
        $(document).ready(function() {
                $.ajaxSetup({ cache: false });
                        });
                var textarea = document.getElementById("log");
                textarea.scrollTop = textarea.scrollHeight;
        }, 1000);
    });
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<body style="text-align:center">
<center>
<img src="img/image.png" width: 80%></a>
</center>
       <form method="post">
<center><table align="center"><tr><td class="col-butt">
<input type="submit" name="button1" class="btn third"  id="strp"
        value="<?php echo exec('cat log/st') ?>"/>
<input type="submit" name="button3" class="btn third" id="logg"
        value="Log"/>
<input type="submit" name="button2" class="btn third" id="config"
        value="Config"/>
<input type="submit" name="button4" class="btn third" id="update"
        value="Update"/>
</td></tr></center>
</table>
</form>
<?php
  exec('cat /var/update.xderm',$z);
    if ($z[0]) {
 if ( $z[0] != '2.3' ){
echo '<pre><h3 style="color:#f54c7d">New versi GUI Detected, Please Update!!</h3></pre>';
};
    };
  if (isset($_POST['button1'])) {
  exec('cat log/st',$o);
if ( $o[0] == 'Start' ) {
 exec('killall -q xderm-mini');
 exec('echo > screenlog.0');
 exec('chmod +x xderm-mini');
 exec('screen -L -dmS gua ./xderm-mini start');
 exec('echo Stop > log/st');
echo '<script>
  document.getElementById("strp").value="Stop";
</script>';
 } else {
 exec('killall -q xderm-mini');
 exec('echo > screenlog.0');
 exec('chmod +x xderm-mini');
 exec('screen -L -dmS gu ./xderm-mini stop');
 exec('echo Start > log/st');
echo '<script>
  document.getElementById("strp").value="Start";
</script>';
}
  }
  if (isset($_POST['button2'])) {
  exec('echo > screenlog.0');
  }
  if (isset($_POST['button4'])) {
  exec('killall -q xderm-mini');
  exec('echo > screenlog.0');
  exec('chmod +x xderm-mini');
  exec('screen -L -dmS upd ./xderm-mini update');
  }
  if (isset($_POST['button3'])) {
  exec('cp log/log.txt screenlog.0 2>/dev/null');
  }
?>
<table align="center"><tr><td class="col-md-4"><div class="inline-block"><pre>
<?php
 if (isset($_POST['simpan'])) {
 $config=$_POST['configbox'];
 $conf=$_POST['profile'];
 $use_dns=$_POST['use_dns'];
 $use_stunnel=$_POST['use_stunnel'];
 if ($use_stunnel <> 'yes' ){$use_stunnel='no';}
 if ($use_dns <> 'yes' ){$use_dns='no';}
 exec('echo "'.$config.'" > config/'.$conf);
 exec('sed -i \'s/\r$//g\' config/'.$conf);
 exec('sed -i \':a;N;$!ba;s/\n\n//g\' config/'.$conf);
 exec('echo -e "use_dns='.$use_dns.'" > config/dns');
 exec('echo "'.$config.'" > config.txt');
 exec('sed -i \'s/\r$//g\' config.txt');
 exec('sed -i \':a;N;$!ba;s/\n\n//g\' config.txt');
 exec('echo "'.$use_stunnel.'" > config/stun');
 exec('echo "'.$conf.'" > config/default');
 exec('echo "Config telah di update." > screenlog.0');
 exec('echo "\''.$conf.'\' Menjadi default Config. !" >> screenlog.0');
$use_boot=$_POST['use_boot'];
if ($use_boot <> 'yes' ){ exec('./xderm-mini disable');
} else { exec('./xderm-mini enable'); }
 exec("cat config/default",$default);
 }
if($_POST['button2']){
exec("cat config/config.list|awk 'NR==1'",$ada);
$ada=$ada[0];
if ($ada) {
exec("cat config/default",$default);
$default=$default[0];
 if ($default) {
echo '<div class="textarea"><center>';
echo "<h4><center><b>profile that is active now: $default</b></center></h4><p>";
$data = file_get_contents("config/$default");
echo "<textarea class='text' name='configbox' id='isi' placeholder='Masukkan config disini' rows='15' cols='50'>$data</textarea>";
 } else {
$data = file_get_contents("config.txt");
echo "<textarea class='text' name='configbox' id='isi' placeholder='Masukkan config disini' rows='15' cols='50'>$data</textarea>";
 }
$data1 = file_get_contents("config/config1");
echo "<textarea name='configbox1' id='isi1' rows='3' cols='10' style='display:none;'>$data1</textarea>";
$data2 = file_get_contents("config/config2");
echo "<textarea name='configbox2' id='isi2' rows='3' cols='10' style='display:none;'>$data2</textarea>";
$data3 = file_get_contents("config/config3");
echo "<textarea name='configbox3' id='isi3' rows='3' cols='10' style='display:none;'>$data3</textarea>";
$data4 = file_get_contents("config/config4");
echo "<textarea name='configbox4' id='isi4' rows='3' cols='10' style='display:none;'>$data4</textarea>";
$data5 = file_get_contents("config/config5");
echo "<textarea name='configbox5' id='isi5' rows='3' cols='10' style='display:none;'>$data5</textarea>";
} else {
exec("mkdir -p config;touch config/config.list config/config1 config/config2");
exec("touch config/config3 config/config4 config/config5");
exec("echo config1 >> config/config.list");
exec("echo config2 >> config/config.list");
exec("echo config3 >> config/config.list");
exec("echo config4 >> config/config.list");
exec("echo config5 >> config/config.list");
exec("echo config1 >> config/default");
$data = file_get_contents("config.txt");
echo "<textarea name='configbox' id='isi' rows='15' cols='60'>$data</textarea>";
$config=$_POST['configbox'];
$conf=$_POST['profile'];
exec('echo "'.$config.'" > config/'.$conf);
exec('sed -i \'s/\r$//g\' config/'.$conf);
exec('sed -i \':a;N;$!ba;s/\n\n//g\' config/'.$conf);
};
echo "<h4 style='color:#f54c7d'><center><b>* Mode 0=SSL * Mode 1=VMESS * Mode 2=TROJAN *</b></center></h4><p>";
echo '<div class="form-box"><center>';
echo '<select class="btn profile" name="profile" id="idconf" onchange="shipping_calc()">';
exec("cat config/config.list",$list);
exec("cat config/default",$default);
$default=$default[0];
$x=0;
while($x<count($list)){
if ( $default == $list[$x] ){
echo "<option value=\"$list[$x]\" selected>$list[$x]</option>";
} else {
echo "<option value=\"$list[$x]\">$list[$x]</option>";}
  $x++;}
echo '<form method="post"'>
exec("cat config/stun|awk 'NR==1'",$stun);
  if (!$stun[0]) { exec("echo yes > config/stun"); }
 if ( $stun[0] == "yes"){
echo '<input type="checkbox" name="use_stunnel" value="yes" checked>Stunnel'; }
else {
echo '<input type="checkbox" name="use_stunnel" value="yes">Stunnel'; }
exec("cat config/dns|awk -F '=' '{print $2}'",$dns);
if ( $dns[0] == "yes"){
echo '<input type="checkbox" name="use_dns" value="yes" checked>DNS-Resolver'; }
else {
exec("echo 'use_dns=no' > config/dns");
echo '<input type="checkbox" name="use_dns" value="yes">DNS-Resolver'; }
exec("touch /etc/rc.local");
exec("cat /etc/rc.local 2>/dev/null|grep xderm|grep button|awk '{print $2}'|awk 'NR==1'",$boot);
 if ($boot[0]) {
echo '<input type="checkbox" name="use_boot" value="yes" checked>ON-Boot'; }
else {
echo '<input type="checkbox" name="use_boot" value="yes">ON-Boot'; }
echo '<input type="submit" name="simpan" class="btn profile" value="Simpan"/></form></div>';
} else {
echo '<div id="log" class="scroll"></div></pre></div>';
}
?>
</td></tr>
</table></head><center><h7><b>Current versi GUI 2.3 Copyright &copy</b></h7></center>
</html>
