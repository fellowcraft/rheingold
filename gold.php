<?php
/*
flags:
-w   writes to file
*/

// --------------------- cryptographically secure seeding ----------------------
$iseed1 = random_int(1,2147483562);
$iseed2 = random_int(1,2147483398); 
stats_rand_setall($iseed1,$iseed2);

// --------------------- orc ---------------------------------------------------
$orchestra = '
sr = 44100
kr =  4410
ksmps = 10
nchnls = 2
galeft  init 0
garight init 0

instr 1
idur            = p3
iamp            = ampdbfs(p4)
ifreq           = p5   ;  1x - negative backwards - def 1
iat             = p6
irel            = p7
ipanStart       = p8
ipanEnd         = p9
iskiptime       = p10
irevSend        = p11
; iprnd           = p12
; iat2            = p13
; irel2           = p14
kpan    linseg  ipanStart, idur, ipanEnd
kAmpEnv linseg  0, iat,  iamp, irel,  0
aAmpEnv interp  kAmpEnv

;kModEnv linseg  0, iat2, iamp, irel2, 0
;                                                      1x     sec       wrap
aIn  diskin2 "/home/frank/Music/WAV/rtm.wav", ifreq, iskiptime, 1
aLeft  = aIn * kpan       * aAmpEnv
aRight = aIn * (1 - kpan) * aAmpEnv 

outs aLeft, aRight 

galeft    =         galeft  +  aIn * kpan       * irevSend
garight   =         garight +  aIn * (1 - kpan) * irevSend
endin

instr 99                           ; global reverb ----------------------------
irvbtime    =        p4
aleft,  aleft  reverbsc  galeft,  galeft, irvbtime, 18000, sr, 0.8, 1 
aright, aright reverbsc  garight, garight,irvbtime, 18000, sr, 0.8, 1 
outs   aright,   aleft              
galeft    =    0
garight   =    0 
endin
';
// --------------------- init vars ---------------------------------------------
$TT  = 300;
$Events = 3000;
// --------------------------- sco head ----------------------------------------
$scoreHeader =  '; Reverb
i99     0   '.$TT.'    0.9 '.PHP_EOL.PHP_EOL;

// --------------------------- main p1-px fields -------------------------------
function p2() {
Global $TT;
return stats_rand_gen_iuniform(1,$TT);
}
$TDur = 1;
function idur() {
Global $TDur;
$TDur = round(stats_rand_gen_funiform(0.3,3),1); 
return $TDur;
}

function iamp() {
return stats_rand_gen_iuniform(-127,-87);
}

function ifreq() {
return round(stats_rand_gen_funiform(.8,1.2),3); 
}

function iat() {
Global $TDur;
return round($TDur*0.25,2);
}

function irel() {
Global $TDur;
return round($TDur*0.75-0.03,2);
}


function ipanStart() {
return round(stats_rand_gen_funiform(0,1),2); 
}

function ipanEnd() {
return round(stats_rand_gen_funiform(0,1),2); 
}

function iskiptime() {
return round(stats_rand_gen_funiform(0,60*60*2+31),2); 
}

function irevSend() {
return round(stats_rand_gen_funiform(0,0.3),2); 
//return 0;
}


// ---------------------------------- generate data ----------------------------
$scoreData = '';
function gen_scoreData($Events){

if($Events == 0) exit;

Global $scoreData;
$P=5;

for($i=0;$i<$Events;$i++) {
$scoreData = $scoreData.
"i1 ".
str_pad(p2(),$P) ." ".
str_pad(idur(),$P) ." ".
str_pad(iamp(),$P+1) ." ".
str_pad(ifreq(),$P) ." ".
str_pad(iat(),$P) ." ".
str_pad(irel(),$P) ." ".
str_pad(ipanStart(),$P) ." ".
str_pad(ipanEnd(),$P) ." ".
str_pad(iskiptime(),$P+2) ." ".
str_pad(irevSend(),$P) ." ".
PHP_EOL
;
}
}

// ----------------------------------------------------------------------------

gen_scoreData($Events);

// ----------------------------------------------------------------------------

$csd = "<CsoundSynthesizer>
<CsOptions>
</CsOptions>
<CsInstruments>"
.$orchestra.
"</CsInstruments>
<CsScore>"
.$scoreHeader
.$scoreData."
e 
</CsScore>
</CsoundSynthesizer>";


// ----------------------------------- exit options ---------------------------

function write_to_file() {
global $csd;
$Now = New DateTime();
$filename = $Now->Format('YmdHis').'.csd';
$myfile = fopen($filename, "w") or die("Unable to open file!");
fwrite($myfile, $csd);
fclose($myfile);
}

function display() {
global $csd;
echo $csd;
}

if (isset($argv[1])) {
foreach($argv as $arg) { 
if($arg == "-w") {
write_to_file(); } 
} 
} else {
display(); }

?>
