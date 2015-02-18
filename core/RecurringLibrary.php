<?php
require_once('StrategyDaily.php');
require_once('StrategyWeekly.php');
/*
Creating an appropriate strategy for generating the days events depending on which type of repetition is forwarded
*/
class RecurringLibrary
{
    
    private $strategy = NULL;
    
    function __construct($eventObject)
    {
        switch ($eventObject->getTypeEvent()) {
            case "Daily":
                $this->strategy = new StrategyDaily();
                break;
            case "Weekly":
                $this->strategy = new StrategyWeekly();
                break;
        }
    }
    
    
    //generate all the days events
    public function showEventDay($eventObject, $objReport = NULL)
    {
        return $this->strategy->showEventDay($eventObject, $objReport);
    }
    
    
    
}