<?php namespace App\Http\Controllers;

trait DateInterval {

    function calculateInterval($datetime)
    {
        $datetime1 = date_create(date('Y-m-d H:i:s'));
        $datetime2 = date_create($datetime);
        $time_interval = date_diff($datetime1, $datetime2);

        $years = (int)$time_interval->format('%y');
        $months = (int)$time_interval->format('%m');
        $days = (int)$time_interval->format('%d');
        $hours = (int)$time_interval->format('%h');
        $minutes = (int)$time_interval->format('%i');
        $seconds = (int)$time_interval->format('%s');

        if ($years) {

           $interval = $years.' years ago';
        } elseif ($months) {

            $interval = $months.' months ago';
        } elseif ($days) {

            $interval = $days.' days ago';
        } elseif ($hours) {

            $interval = $hours.' hours ago';
        } elseif ($minutes) {

            $interval = $minutes.' minutes ago';
        } elseif ($seconds) {

            $interval = $seconds.' seconds ago';
        }
        else {
            $interval = 'Just now';
        }

        return $interval;
    }
}