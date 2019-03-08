<?php

namespace Vault\Vault;

use Carbon\Carbon;

class TimeRange
{
    protected $periodOfTime;

    /**
     * Construct a time range from two time strings that are parsed by Carbon
     *
     * @param string  $from  date and time
     * @param string  $to    date and time
     */
    public function __construct(string $from, string $to)
    {
        
        // Parse the from and to strings
        $fromTime = Carbon::parse($from);
        $toTime = Carbon::parse($to);
        
        // Convert them to a CarbonInterval for storage
        $this->periodOfTime = $fromTime->diffAsCarbonInterval($toTime);
    }
    
    /**
     * Provide the time range in a human readable format, such as "1 hour ago"
     *
     * @return string
     */
    public function humanReadable(): string
    {
        return $this->periodOfTime->forHumans() . " ago";
    }
}
