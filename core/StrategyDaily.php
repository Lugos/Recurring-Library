<?php
require_once('StrategyInterface.php');


class StrategyDaily implements StrategyInterface
{
    //concrete strategy of generating events
    public function showEventDay($eventObject, $reportObject = NULL)
    {
        $step  = $eventObject->getRepeatEvery();
        $unit  = 'D';
        $start = $eventObject->getStartDate();
        $end   = $eventObject->getEndDate();
        $sName = $eventObject->getName();
        $end->modify("+23 hours");
        $interval = new DateInterval("P{$step}{$unit}");
        $period   = new DatePeriod($start, $interval, $end);
        $iCount   = $eventObject->getRepetitions();
        $i        = 0;
        $aReturn  = array();
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
        
        return $aReturn;
        
        
        
        
    }
}


?>