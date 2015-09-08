<?php
session_start();
putenv("S3_BUCKET=audio.pulseplanet.com");
putenv("AWS_ACCESS_KEY_ID=AKIAJO6PYW6AQWWYUN7Q");
putenv("AWS_SECRET_ACCESS_KEY=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");
//require('../../vendor/autoload.php');
require '../../aws/aws-autoloader.php';
use Aws\S3\S3Client;
ini_set('date.timezone','America/Los_Angeles');
error_reporting(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="robots" content="noindex">
<meta name="googlebot" content="noindex">

<style>
body{font-size:14pt;line-height:18pt;}
header{margin:50px auto;clear:both;width:50%;text-align:center;font-family:sans-serif;color:white;}
header{font-size:1.2em;font-weight:bold;}
div{margin:0px auto;width:50%;text-align:center;}
div a{font-size:1.2em;}
div#top{height:150px;width:100%;margin-top:0px !important;margin-bottom:20px;text-align:center;position:relative;}
div.title{position:absolute;font-size:2em;color:white;font-weight:bold;width:100%;height:50px;top:0px;left:0;text-align:center;}
body{padding:0;margin:0;background-color:#5d8795;font-family:sans-serif;}
#downloadlink{margin-top:50px !important;}
div, header{border:0px dotted white;}
.formclass{height:20px;width:200px;}
.login{margin-top:110px;}
.title img{max-height:175px;}
.notice{margin-top:100px;z-index:99;border:0px dotted  white;font-size:3vh;color:white;width:100%;height:auto;margin-top:20px;text-align:center;font-weight:bold;}
</style>
</head>
<body>
<div id="top">
  <div class="title"><img alt="logo" width="50%" src="http://www.pulseplanet.com/globalimages/logo.gif"/></div>
</div>

<?php


$ipfile="ipaddresses.txt";
$ipfile="ipaddresses.txt";
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
if($_POST){$stationletters = $_POST['stationletters'];
//$_SESSION['stationletters'] = $stationletters;
}
//print($_SESSION['stationletters']);
file_put_contents($ipfile, $ip . ' | ' . date('Y-m-d H:i:s') . ' | ' . $stationletters . PHP_EOL, FILE_APPEND | LOCK_EX);

/*******begin move code**********/

$docroot= getenv('DOCUMENT_ROOT');
$docrootarray=split("\/",$docroot);
array_pop($docrootarray);
$coreroot=implode("/",$docrootarray);


//echo $coreroot;
//echo '<br>' . $docroot;
//echo '<hr>';
foreach( glob('/var/www/vhosts/pulseplanet.com/httpdocs/msp/POPweekzip/Pop*.*') as $file )
    {
    
    //echo $file . '<br>';
        unlink($file);
    }
    
    foreach( glob('/var/www/vhosts/pulseplanet.com/httpdocs/msp/POPweek/POP*.*') as $file2 )
    {
    
   // echo $file2 . ' ZIP <br>';
        unlink($file2);
    }
    
    //exit;
include($docroot . "/classes/Class.Database.public.inc");
include($docroot . "/classes/Smarty/libs/Smarty.class.php");
$server= getenv('DATABASE_SERVER');
//if($_GET['testday']){$testday=$_GET['testday'];echo ' testday is from url';}else{

//$testday="2015-02-27";
$testday = date('Y-m-d');
echo $testday;

//}
//exit;
$testdaytimestamp=strtotime($testday);
$year = substr($testday,0,4);
$previousyear = $year - 1;
$nextyear = $year + 1;
//echo '<h1> timestamp ' . $testdaytimestamp . 'Year: ' . $year . '  previousyear: ' . $previousyear . '</h1>';
//echo '<hr>';
$start_date = $testday;
$day_in_week = strtotime($testday);
echo '<br>Day in week: ' . $day_in_week . '<br>';
echo "Then you can adjust this value to Sunday (as a starting place you can guarantee that you can find):";
echo "Find that day's day of the week (value of 0-6)";
echo '<br><b>Test day is: ' . $testday . '</b>';
$week = strftime("%U" ,strtotime($testday));  //this gets you the week number starting Sunday
//global $week;
echo '<h4>Week number ' . $week + 1 . ' (note that week 08 is the 9th week of the year.  The year starts with week 00</h4>';
$obj=new Database($host="127.0.0.1", $db="pulseplanet", $user="adminpulse", $pwd="m0nkey@z00");
$obj2=new Database($host="127.0.0.1", $db="pulseplanet", $user="adminpulse", $pwd="m0nkey@z00");
$weeknumberdb = $week + 1;
echo '<h4>Week number from database: ' .  $weeknumberdb . '</h4>';
echo '<hr>';
//exit;
if($week == 0){
$myquery="SELECT * from dailies where WEEK(AirDate)=(0) AND (YEAR(AirDate)=$year)";}
else{$myquery="SELECT * from dailies where WEEK(AirDate)=($weeknumberdb) AND (YEAR(AirDate)=$year)";}
echo '<h4>' . $myquery . '</h4>';
 $obj2->query($myquery);
while($obj2->nextRecord()){
$POP = $obj2->getField("POP");
$AirDate = $obj2->getField("AirDate");
$filedate=date("dMy",strtotime($AirDate));
$textday = date ("D",strtotime($AirDate));
$textday2 = 'Pop' . strtoupper($textday) . '.mp3';
$textday3 = 'Pop' . strtoupper($textday);
//$file = "/var/www/vhosts/pulseplanet.com/httpdocs/dailymp3/$filedate.mp3";
$myfile1="$filedate.mp3";
$myfile2="$textday3.mp3";
$signed=createsignedurl($myfile1,'dailymp3');
//$file = "http://audio.pulseplanet.com/dailymp3/$filedate.mp3";
echo " <b>Quick check to verify that the file exists</b> ";
echo $signed;
//exit;
// $newfile = "/var/www/vhosts/pulseplanet.com/httpdocs/msp/POPweekzip/$textday3.mp3";
$newfile = "/var/www/vhosts/pulseplanet.com/httpdocs/msp/POPweekzip/$filedate.mp3";
$newfile2 = "/var/www/vhosts/pulseplanet.com/httpdocs/msp/POPweekzip/" . $textday3 . '-' . ($week + 1) . '.mp3';
echo '<hr>';
echo $newfile;
echo '<br>';
echo $newfile2;
//exit;
//copy($file,$newfile);
//rename($newfile, $newfile2);
//if (copy($file, $newfile)) {
 //   echo "copied";
//}else{echo "problem with copy command";}
echo "$file $newfile<br>";}
echo $file . ' copy to ' . $newfile . '<br>';

 
$source="$docroot/msp/POPweekzip";
echo $source . '<br>';
$destination="$docroot/msp/POPweek/POPweek".($week+1). '.zip';
echo $destination;
//zipData($source, $destination);

    /********end move code**********/


echo '<h1>' . $_SESSION['stationletters'] . ' week: ' . ($week + 2) . '</h1>';?>
<header>Get your weekly dose of Pulse of the Planet</header>
<div class="notice">"Each week's programs are uploaded every Saturday morning at 7 AM Eastern time."</div>
<div id="downloadlink"><a href="<?php
echo "POPweek" . ($week+2) . '.zip';
?>">Download this week's mp3 files</a></div>

<?php

 
/***FUNCTION for zipping a folder*******/
function zipData($source, $destination) {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new ZipArchive();
                if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    if (is_dir($source)) {
                        $iterator = new RecursiveDirectoryIterator($source);
                        // skip dot files while iterating
                        $iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
                        $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = realpath($file);
                            if (is_dir($file)) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }

function createsignedurl($myfile,$key){
$bucket = 'audio.pulseplanet.com';
$keyname = $key . '/' . $myfile;
// Instantiate the client.
$s3 = S3Client::factory(array(
        'profile' => 'myprofile',
        'key' => 'AKIAJO6PYW6AQWWYUN7Q',
        'secret' => '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'));
/*$cmd = $s3->getCommand('GetObject', [
    'Bucket' => $bucket,
    'Key'    => $keyname
]);*/
$signedUrl = $s3->getObjectUrl($bucket, $keyname, '+1440 minutes');
return $signedUrl;
}

 ?>
</body></html>
