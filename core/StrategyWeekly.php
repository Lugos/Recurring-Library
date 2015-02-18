<?php
require_once('StrategyInterface.php');

class StrategyWeekly implements StrategyInterface
{
    //concrete strategy of generating events
    public function showEventDay($eventObject, $reportObject = NULL)
    {
        $day     = $eventObject->getWeekDay();
        $step    = $eventObject->getRepeatEvery();
        $unit    = 'W';
        $aReturn = array();
        $sName   = $eventObject->getName();
        foreach ($day as $value) {
            $day   = $value;
            $dow   = $day;
            $start = clone $eventObject->getStartDate();
            $end   = clone $eventObject->getEndDate();
            $start->modify($dow);
            $end->modify("+23 hours");
            $interval = new DateInterval("P{$step}{$unit}");
            $period   = new DatePeriod($start, $interval, $end);
            $iCount   = $eventObject->getRepetitions();
            $i        = 0;
            foreach ($period as $date) {
                $i++;                
                if (is_object($reportObject)) {
                    if ($reportObject->startReportDate->format('Y-m-d') <= $date->format('Y-m-d') && $date->format('Y-m-d') <= $reportObject->endReportDate->format('Y-m-d')) {
                        $aReturn[] = $date;
                    } else if ($date->format('Y-m-d') > $reportObject->endReportDate->format('Y-m-d')) {
                        break;
                    }
                } else {
                    $aReturn[] = $date;
                }
                if ($i == $iCount) {
                    break;
                }
            }
        }
        return $aReturn;
        
        
        
    }
}


?>