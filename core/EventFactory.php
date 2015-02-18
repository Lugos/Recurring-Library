<?php 

class EventFactory 
{
 public static function build($eventObject)
  {
    $event = $eventObject->type;
    $eventClass = "Event" . ucwords($event);
    if(class_exists($eventClass))
    {
      return new $eventClass($eventObject);
    }
    else {
      throw new Exception("Invalid event type given.");
    }
  }
}