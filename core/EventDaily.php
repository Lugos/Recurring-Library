<?php

require_once('Event.php');
/*
	Class for working with events that recur daily
*/
class EventDaily extends Event{
	private $iID;
	private $sName='test';
    private $sType;
    private $dStartDate;
    private $dEndDate ;
    private $iRepetitions;
    private $iRepeatEvery=1; 
	
	function __construct($eventObject) {
		//default is one otherwise would be id column from the database
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

		if(isset($eventObject->repetitions) && $eventObject->repetitions>=1 ){
			$this->setRepetitions($eventObject->repetitions);
			
			if(!isset($eventObject->endDate)){
				//calculating the last repetition
				$i=$this->getRepeatEvery()*($this->getRepetitions()-1);			
				$startDate = clone $this->getStartDate();
				$endDate = $startDate->add(new DateInterval('P'.$i.'D'));
				$this->setEndDate($endDate);
			}
		}else{
			//without limit
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

}