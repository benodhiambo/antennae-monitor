<?php
namespace App\Logs;


class LogProcessor
{
    function isLocalIPAddress()
    {
        $IPAddress = request()->server('REMOTE_ADDR');
        if( !filter_var($IPAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) )
        {
            return "local machine";
        }else{
            return $IPAddress;
        }
    }

    public function __invoke(array $record)
    {
        $record['extra'] = [
            'user_id' => auth()->user() ? auth()->user()->id : NULL,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT')
        ];
        return $record;
    }
}