<?php

	$counter = isset($_COOKIE{'visittimes'}) ? $_COOKIE{'visittimes'} : '';

	if(isset($counter)) $counter++;
	else $counter = 1;

	if($counter > 3) setcookie('visittimes',$counter,time()-60);
	else setcookie('visittimes',$counter);

?>

<!DOCTYPE html>
<html>
<head>
	<title>訪問回数カウンタ</title>
</head>
<body>
	<?php

		if($counter == 1){
			print"はじめまして！<br>";
		}elseif($counter == 2){
			print $counter."回目のご訪問ですね。<br>";
		}elseif($counter == 3){
			print $counter."回目のご訪問ですね。<br>";
			print "あなたのブラウザは ".$_SERVER{'HTTP_USER_AGENT'}."ですね。<br>";
		}else{
			print $counter."回目のご訪問ですね。<br>";
			print "次回訪問時に訪問回数がリセットされます。<br>";
		}

	?>

</body>
</html>