<?php
Class Zeit{
//
public function arbeitszeit($startzeit, $endzeit, $pause)
    {
    global $tot_time;

    $start_time = explode(":", $startzeit);
    $end_time = explode(":", $endzeit);
    $break = explode(":" ,$pause);

    $start_time_stamp = mktime($start_time[0], $start_time[1]);
    $end_time_stamp = mktime($end_time[0], $end_time[1]);
    $break_stamp = $break[0]+($break[1]/60);

    $time_difference = ($end_time_stamp - $start_time_stamp)/3600;
    $tot_time = $time_difference - ($break_stamp);
    //echo($tot_time);

        return $tot_time;
    }
}
