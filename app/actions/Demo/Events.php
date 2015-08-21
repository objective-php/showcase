<?php

namespace Poc\Action\Demo;

use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

class Events {

	public function __invoke(WorkflowEvent $event)
	{

		$eventsHandler = $event->getApplication()->getEventsHandler();

		// prevent default renderer from triggering
		$event->getWorkflow()->unbind('render');

		// bind 1000 callbacks
		$callback = function($event) use(&$count) {
			$count++;
		};

		for($i = 0; $i < 30; $i++)
		{
			$eventsHandler->bind('demo.events.*', $callback);
		}


		// trigger 100 events
		$startedAt = microtime(true);
		for($i=0; $i < 10; $i++)
		{
			$eventsHandler->trigger('demo.events.' . $this->generateRandomEventName());
		}
		$stoppedAt = microtime(true);

		$elapsedTime = $stoppedAt - $startedAt;

		echo "It took " . round($elapsedTime, 3) . " seconds to trigger $count callbacks";
	}


	protected function generateRandomEventName()
	{
		
	    $character_set_array = array();
	    $character_set_array[] = array('count' => 7, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
	    $character_set_array[] = array('count' => 1, 'characters' => '0123456789');
	    $temp_array = array();
	    foreach ($character_set_array as $character_set) {
	        for ($i = 0; $i < $character_set['count']; $i++) {
	            $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
	        }
	    }
	    shuffle($temp_array);
	    return implode('', $temp_array);
	}
	

}
