<?php 

function timeago ($time) {
    $curtime = date('Y-m-d H:i:s');
    $diff = strtotime($curtime) - strtotime($time);
    
    if($diff > 3600*24) {
        $ret = date('d-m-Y H:i:s', strtotime($time));
    } else if($diff > 3600) {
        $ret = round($diff/3600) . ' Hours ago';
    } else {
        $ret = round($diff/60) . ' Minutes ago';
    }
    echo $ret;
  }