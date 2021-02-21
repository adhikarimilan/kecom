<?php
if (! function_exists('time_date_diff')) {
    function time_date_diff($prev_time) {
        $now=strtotime(date("Y-m-d h:i:sa"));
        $then=strtotime($prev_time);
        $sec_diff=$now-$then;
        if($sec_diff<60)
        echo $sec_diff ."sec ago";
        else if($sec_diff<3600)
        echo round($sec_diff/60) ." min ago";
        else if($sec_diff<86400)
        echo round($sec_diff/3600) ." hours ago";
        else if($sec_diff<2592000)
        echo round($sec_diff/86400) ." days ago";
        else if($sec_diff<31104000)
        echo round($sec_diff/2592000) ." months ago";
        else 
        echo round($sec_diff/31104000) ." years ago";   
    }
}
if (! function_exists('print_hello')) {
    function print_hello() {
        return "Hello";
    }
}