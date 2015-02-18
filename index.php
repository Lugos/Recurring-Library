<pre>
<?php
	require_once('core/EventFactory.php'); 
	require_once('core/RecurringLibrary.php'); 
	require_once('core/EventDaily.php'); 
	require_once('core/EventWeekly.php'); 
	
	//my example
	//$obj[] = (object) array('name' => 'Refactoring','type' => 'Daily', 'startDate' => new DateTime('2015-02-06'), 'RepeatEvery'=>1,'repetitions'=>3);
	//$obj[] = (object) array('name' => 'Refactoring','type' => 'Daily','startDate' => new DateTime('2015-02-06'));
    //$obj[] = (object) array('name' => 'Refactoring','type' => 'Daily', 'startDate' => new DateTime('2015-02-06'), 'RepeatEvery' => 5 , 'endDate'=>  new DateTime('2015-08-06'));
	//$obj[] = (object) array('type' => 'Daily', 'startDate' => new DateTime('2015-02-06'), 'RepeatEvery' => 5 , 'endDate'=>  new DateTime('2015-08-06'));
	//$obj[] = (object) array('type' => 'Daily', 'startDate' => new DateTime('2015-02-06'), 'RepeatEvery' => 1 );
	//$obj[] = (object) array('type' => 'Daily', 'startDate' => new DateTime('2015-02-06'),'repetitions'=>10);	
	//$obj[] = (object) array('name' => 'Lunch','type' => 'Weekly',  'startDate' =>  new DateTime('2015-02-17'),'repetitions' =>11);
	//$obj[] = (object) array('type' => 'Daily', 'repetitions' => 12 , 'name' => 'Meeting');	
	//Example from task
 	//$obj[]   = (object) array('name' => 'Task32','type' => 'Daily', 'endDate' => new DateTime('2015-08-10'));
	//$obj[]	 = (object) array('name' => 'Task64','type' => 'Daily', 'repetitions'=>5 );
	//$obj[]	 = (object) array('name' => 'Lunch','type' => 'Daily');
	//$obj[] = (object) array('name' => 'Lunch','type' => 'Weekly', 'day' => array(0=>'Monday',1=>'Wednesday', 2=>'Friday'),  'endDate' =>  new DateTime('2015-03-15'),'repetitions' =>11,'RepeatEvery'=>1);
	
	//First Example from task
	//$obj[] = (object) array('name' => 'Create new functionality','type' => 'Weekly', 'startDate'=> new DateTime('2015-01-06'),'repetitions' =>11);
	//$objReport = (object) array('startReportDate' => new DateTime('2015-03-01'), 'endReportDate'=>new DateTime('2015-03-31'));
	//Second example
	///$obj[] = (object) array('name' => 'Refactoring','type' => 'Daily', 'startDate'=> new DateTime('2015-01-06'),'endDate'=>new DateTime('2015-03-15'));
	//$objReport = (object) array('startReportDate' => new DateTime('2015-03-01'), 'endReportDate'=>new DateTime('2015-03-31'));
	//Third example from task
	$obj[] = (object) array('name' => 'Log error in Mongo','type' => 'Weekly', 'startDate'=> new DateTime('2015-01-06'),'day' => array(0=>'Monday',1=>'Wednesday', 2=>'Friday'));
	$objReport = (object) array('startReportDate' => new DateTime('2015-03-01'), 'endReportDate'=>new DateTime('2015-03-31'));



	$aReturn = array();
	foreach ($obj as $val) {
		$eventClass = EventFactory::build($val);
		$RecurringLibrary = new RecurringLibrary($eventClass);

		$aData = $RecurringLibrary->showEventDay($eventClass,$objReport);
		$aReturn = array_merge($aReturn, $aData);
	}
	sort($aReturn);
	var_dump($aReturn);
	

	
	

