<?

function date_human($item_date){
    // Create a human friendly date
    // Example: 'date_human("1 Sep 14");' would return 'today', 'yesterday', '10 days ago', etc
    $interval = date_diff(date_create(date('j M y')), date_create($item_date));
    $date_diff = $interval->format('%a');
    $date_data = str_replace('+', '', $interval->format('%R%a'));
    $date = '';
    if($date_data == 0){
        $date = 'today';
    }elseif($date_data == -1){
        $date = 'yesterday';
    }elseif($date_data < -1 && $date_data > -15){
        $date = $interval->format('%a').' day';
        if($date_diff != 1){
            $date .= 's';
        }
        $date .= ' ago';
    }else{
        $date .= $item_date;
    }
    return $date;
}

?>
