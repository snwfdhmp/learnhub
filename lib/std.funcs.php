<?

function activeIf($view) {
    if($GLOBALS['active_view'] == $view)
        echo "class='active'";
}


function time2str($ts)
{
    if(!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if($diff == 0)
        return 'Maintenant';
    elseif($diff > 0)
    {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 15) return "A l'instant";
            if($diff < 60) return "Il y a quelques secondes";
            if($diff < 120) return 'Il y a une minute';
            if($diff < 3600) return 'Il y a '.floor($diff / 60) . ' minutes';
            if($diff < 5400) return 'Il y a une heure';
            if($diff < 86400) return 'Il y a environ '.floor($diff / 3600) . ' heures';
        }
        if($day_diff == 1) return 'Hier';
        if($day_diff < 7) return 'Il y a ' . $day_diff . ' jours';
        if($day_diff < 31) return 'Il y a '.ceil($day_diff / 7) . ' semaines';
        if($day_diff < 60) return 'Il y a un mois';
        return date('F Y', $ts);
    }
    else
    {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 120) return 'in a minute';
            if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
            if($diff < 7200) return 'in an hour';
            if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
        }
        if($day_diff == 1) return 'Tomorrow';
        if($day_diff < 4) return date('l', $ts);
        if($day_diff < 7 + (7 - date('w'))) return 'next week';
        if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
        if(date('n', $ts) == date('n') + 1) return 'next month';
        return date('F Y', $ts);
    }
}
?>