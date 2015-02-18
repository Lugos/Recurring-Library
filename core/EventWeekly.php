<?php
require_once('Event.php');
/*	
Class for working with events that recur weekly
*/
class EventWeekly extends Event{
		private $iID;
		private $sName='test';
    	private $sType;
    	private $dStartDate;
    	private $dEndDate ;
    	private $iRepetitions;
    	private $iRepeatEvery=1;
    	private $aWeekDay;


    	function __construct($eventObject) {
			$this->setID(1);

			$this->setTypeEvent($eventObject->type);
			if(isset($eventObject->startDate)){
				$this->setStartDate($eventObject->startDate);
			}else{
				$now = new DateTime();			
				$this->setStartDate($now);
			}

			if(isset($eventObject->name)){
				$this->setName($eventObject->name);
			}
			
			
			if(isset($eventObject->endDate)){
				$this->setEndDate($eventObject->endDate);
			}
			if(isset($eventObject->RepeatEvery)){
				$this->setRepeatEvery($eventObject->RepeatEvery);
			}

			if(isset($eventObject->day)){
				$this->setWeekDay($eventObject->day);
			}else{				
				$day = $this->getDayOfWeek($eventObject->startDate);			
	    		$this->setWeekDay($day);	    		
			}


			if(isset($eventObject->repetitions) && $eventObject->repetitions>=1 ){
				$this->setRepetitions($eventObject->repetitions);
				if(!isset($eventObject->endDate)){
					
					$i=$this->getRepeatEvery()+$this->getRepetitions();			
					$startDate = clone $this->getStartDate();
					$endDate = $startDate->add(new DateInterval('P'.$i.'W'));
					$this->setEndDate($endDate);
				}
			}else{
				$this->setRepetitions(999999);
				if(!isset($eventObject->endDate)){

					if($this->getRepeatEvery()>=1){						
						$endDate = clone $this->getStartDate();
						$endDate->add(new DateInterval('P1Y')); // Move to 1 year from start
						$this->setEndDate($endDate);
					}else{						
						$endDate = clone $this->getStartDate();
						$this->setEndDate($endDate);
					}
					
				}
				
			}

		
		

    }

    public function save(){
    	//save data to database 
    }
    

    //set
    private function setID($ID) {
   	 	$this->iID = $ID;
 	}

 	private function setName($sName){
 		$this->sName = $sName;
 	}

 	private function setTypeEvent($type){
 		$this->sType = $type;
 	}

 	private function setStartDate($StartDate){
 		$this->dStartDate = $StartDate;
 		
 	}

 	private function setEndDate($EndDate){
 		$this->dEndDate = $EndDate;
 	}

 	private function setRepetitions($repetitions){
 		$this->iRepetitions = $repetitions;
 	}

 	private function setRepeatEvery($repeat){
 		$this->iRepeatEvery = $repeat;
 	}

 	private function setWeekDay($sWeekDay){
 		$this->aWeekDay = $sWeekDay;

 	}

 	//get
 	public function getID() {
    	return $this->iID;
  	}

  	public function getName(){
  		return $this->sName;
  	}

  	public function getTypeEvent(){
 		return $this->sType;
 	}

 	public function getStartDate(){
 		return $this->dStartDate;
 	}

 	public function getEndDate(){
 		return $this->dEndDate;
 	}

 	public function getRepetitions(){
 		return $this->iRepetitions;
 	}

 	public function getRepeatEvery(){
 		return $this->iRepeatEvery;
 	}

 	public function getWeekDay(){
 		return $this->aWeekDay;
 	}

 	public function getDayOfWeek($date)
	{	
		
		$data = array();
		switch ($date->format('D')) {
			case 'Mon':
				$data[] = 'monday';
				break;
		 	case 'Tue':
		 		$data[] = 'tuesday';
		 		break;
		 	case 'Wed':
		 		$data[] = 'wednesday';
		 		break;
		 	case 'Thu':
		 		$data[] = 'thursday';
		 		break;
		 	case 'Fri':
		 		$data[] = 'friday';
		 		break;
		 	case 'Sat':
		 		$data[] = 'saturday';
		 		break;
		 	case 'Sun':
		 		$data[] = 'sunday';
		 		break;
		 	default:
		 		$data[] = 'monday';
		 		break;
		 }
		 return $data;
	}



	}