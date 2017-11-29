<!DOCTYPE html>
<html>
<head>	
	<!--Google Fontsからフォントを参照する!-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/earlyaccess/mplus1p.css" rel="stylesheet" />
	<!--CSS!-->
	<style type="text/css">
		/*時刻表示*/
		.time {
		 font-family: "Open Sans Condensed";
		 font-size: 6vw;
		 text-shadow: 2px 2px 1px #f4ffff,
           		     -2px 2px 1px #f4ffff,
           		      2px -2px 1px #f4ffff,
             		 -2px -2px 1px #f4ffff;
		 transform: scale(1,2.0);
		 letter-spacing: 12px;
	 	 height: 950px;
		 display: flex;
		 align-items: center;
	 	 justify-content: center;
		}
		/*submitボタンをテキストのみにする*/
		.select {
		 color: rgba(255,255,255,0.8);
   		 font-family: "Rounded Mplus 1c";
		 border:none;
		 background-color:transparent;
		}

		/*Webサイト立ち上げ時の背景画像の設定*/
		html,body:first-child:before {
		 overflow: hidden;
    	 background-image: url("tokyo.jpg");
		}
		/*POSTされた値で背景画像を設定*/
		<?php if(isset($_POST['america']) != NULL) { ?>
			html,body:first-child:before {
    		 background-image: url("america.jpg");
			}
		<?php }elseif(isset($_POST['china']) != NULL) { ?>
			html,body:first-child:before {
    		 background-image: url("china.jpg");
			}
		<?php }elseif(isset($_POST['russia']) != NULL) { ?>
			html,body:first-child:before {
    		 background-image: url("russia.jpg");
			}
		<?php }elseif(isset($_POST['england']) != NULL) { ?>
			html,body:first-child:before {
    		 background-image: url("england.jpg");
			}
		<?php }elseif(isset($_POST['france']) != NULL) { ?>
			html,body:first-child:before {
    		 background-image: url("france.jpg");
			}
		<?php }else { ?>
			html,body:first-child:before {
    		 background-image: url("tokyo.jpg");
			}
		<?php } ?>
 
 		/*半透明なグラデーションの設定*/
		body:before {
		 content: "";
		 position: absolute;
		 top: 0;
		 left: 0;
		 display: block;
		 width: 100%;
	 	 height: 100%;
		 background-color: rgba(255,255,255,0.3);
		}

		#nav-drawer {
  		 position: relative;
		}

		/*チェックボックス等は非表示に*/
		.nav-unshown {
  	 	 display:none;
		}

		/*アイコンのスペース*/
		#nav-open {
   		 display: inline-block;
  		 width: 30px;
  		 height: 22px;
  		 vertical-align: top;
		}

		/*ハンバーガーアイコンをCSSだけで表現*/
		#nav-open span, #nav-open span:before, #nav-open span:after {
  		 position: absolute;
  		 height: 3px;/*線の太さ*/
  		 width: 25px;/*長さ*/
  		 z-index: 9998;
  		 border-radius: 3px;
  		 background: white;
  		 display: block;
  		 content: '	';
  		 cursor: pointer;
		}
		#nav-open span:before {
  		 bottom: -8px;
		}
		#nav-open span:after {
  		 bottom: -16px;
		}

		/*閉じる用の薄いカバー*/
		#nav-close {
  		 display: none;/*はじめは隠しておく*/
  		 position: fixed;
  		 z-index: 99;
  		 top: 0;/*全体に広がるように*/
   		 left: 0;
  		 width: 100%;
  		 height: 100%;
  		 background: rgba(0, 0, 0, 0.001);
  		 opacity: 0;
  		 transition: .3s ease-in-out;
		}

		/*中身*/
		#nav-content {
  		 overflow: auto;
  		 position: fixed;
  		 top: 0;
  		 left: 0;
  		 z-index: 9999;/*最前面に*/
  		 width: 40%;/*右側に隙間を作る（閉じるカバーを表示）*/
  		 max-width: 200px;/*最大幅（調整してください）*/
  		 height: 100%;
  		 background: rgba(0,0,0,0.2);/*背景色*/
  		 transition: .3s ease-in-out;/*滑らかに表示*/
         -webkit-transform: translateX(1000%);
  		 transform: translateX(1000%);/*右に隠しておく*/
		}

		/*チェックが入ったらもろもろ表示*/
		#nav-input:checked ~ #nav-close {
  		 display: block;/*カバーを表示*/
		}

		#nav-input:checked ~ #nav-content {
         -webkit-transform: translateX(0%);
  		 transform: translateX(860%);/*中身を表示（左へスライド）*/
  		 box-shadow: 6px 0 25px rgba(0,0,0,.15);
		}

	</style>

	<!--JavaScript!-->
	<script type="text/Javascript">
		<?php
		$dif = 0;
		//POSTされた値で時差を設定
		if(isset($_POST['america']) != NULL) {
			$dif = -14;		
		}elseif(isset($_POST['china']) != NULL) {
			$dif = -1;		
		}elseif(isset($_POST['russia']) != NULL) {
			$dif = -6;		
		}elseif(isset($_POST['england']) != NULL) {
			$dif = -9;		
		}elseif(isset($_POST['france']) != NULL) {
			$dif = -8;		
		}



		?>
		var clock = function() {
			var dif = <?php echo $dif; ?>;
			var japan= (new Date()).getTime();
  	  		var dateObj = new Date(japan + dif*60*60*1000),
        		dateYear = dateObj.getFullYear(),
        		dateMonth = dateObj.getMonth() + 1,
        		dateDay = dateObj.getDate(),
        		dateWeek = dateObj.getDay(),
        		timeHour = dateObj.getHours(),
        		timeMinutes = dateObj.getMinutes(),
        		timeSeconds = dateObj.getSeconds(),
        		weekNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        		displayElement = document.getElementById("RealtimeClock"),
        		str = '';
 
	    	// 一桁の場合は0を追加
   		 	if (timeHour < 10) timeHour = '0' + timeHour;
	    	if (timeMinutes < 10) timeMinutes = '0' + timeMinutes;
    		if (timeSeconds < 10) timeSeconds = '0' + timeSeconds;

    		// 文字列の結合
    		str  = dateYear + ' / ' + dateMonth + ' / ' + dateDay + ' / ' + '' + weekNames[dateWeek] + ' ';
    		str += timeHour + ':' + timeMinutes + ':' + timeSeconds ;
 
    		// 出力
    		if (displayElement) displayElement.innerHTML = str;

	 
    		// 繰り返し実行
    		setTimeout(clock, 100);
		};
	 
		// 実行
		clock();
	</script>

	<title>RealTimeWorldClock</title>
</head>
<body>
	<header>
 	 	<div id="nav-drawer">
     		<input id="nav-input" type="checkbox" class="nav-unshown">
      		<label id="nav-open" for="nav-input"><span></span></label>
     		<label class="nav-unshown" id="nav-close" for="nav-input"></label>
    		<div id="nav-content"><center><br>
    			<form method="POST" action="world_clock.php">
    				<input class="select" type="submit" name="japan" value="日本/Tokyo"><br>
    				<input class="select" type="submit" name="america" value="アメリカ/Newyork"><br>
    				<input class="select" type="submit" name="china" value="中国/Beijing"><br>
    				<input class="select" type="submit" name="russia" value="ロシア/Moscow"><br>
    				<input class="select" type="submit" name="england" value="イギリス/London"><br>
    				<input class="select" type="submit" name="france" value="フランス/Paris"><br></center>
    			</form>
    		</div>
 		 </div>
	</header>
	<div id="RealtimeClock" class="time"></div>
</body>
</html>