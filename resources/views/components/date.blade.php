@props(['date', 'type' => 'datetime', 'wrapped' => false])
@php
    $date_format = 'd M Y';
    $time_format = 'h:i A';
    $timezone = 'Europe/London';

    $formatted_datetime = '';

    if(auth()->user()){
        $date_format = auth()->user()->date_format;
        $time_format = auth()->user()->time_format;
        $timezone = auth()->user()->timezone;
    }
    $date = $date->timezone($timezone);

    switch ($type) {
        case 'date':
            $formatted_datetime = $date->format($date_format);
            break;
        case 'time':
            $formatted_datetime = $date->format($time_format);
            break;

        default:
            $formatted_datetime = $date->format($date_format . " " . $time_format);
            if($wrapped){
                $date_format = $date_format . "\\<\\b\\r\\>" . $time_format;
                $formatted_datetime = $date->format($date_format);
            }
        break;
    }
@endphp
<span {{ $attributes }}>{!! $formatted_datetime !!}</span>
