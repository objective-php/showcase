<?php

namespace Showcase\Action\Demo\Events;

use ObjectivePHP\Application\Action\AbstractAction;
use ObjectivePHP\Application\Action\Param\NumericParameter;
use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;
use ObjectivePHP\Primitives\Numeric\Numeric;

class Load extends AbstractAction {

	public function expects()
	{
		return
		[
			new NumericParameter('callbacks'),
			new NumericParameter('triggers')
		];
	}

	public function run(WorkflowEvent $event)
	{

		$eventsHandler = $event->getApplication()->getEventsHandler();

		// prevent default renderer from triggering
		// $event->getWorkflow()->unbind('render');

		// bind 1000 callbacks
		$callback = function($event) use(&$count) {
			$count++;
		};


		$callbacks = $this->getParam('callbacks', 100);
		$triggers = $this->getParam('triggers', 100);

		for($i = 0; $i < $callbacks; $i++)
		{
			$eventsHandler->bind('demo.events.*', $callback);
		}


		// trigger 100 events
		$startedAt = microtime(true);
		for($i=0; $i < $triggers; $i++)
		{
			$eventsHandler->trigger('demo.events.' . $this->generateRandomEventName());
		}
		$stoppedAt = microtime(true);

		$elapsedTime = round($stoppedAt - $startedAt, 3) * 1000;

		return
		[
			'ranCallbacks' => $count,
			'triggers' => $triggers,
			'boundCallbacks' => $callbacks,
			'elapsedTime' => $elapsedTime,
			'layout' => [
				'pageTitle' => 'Events demo'
			]
		];


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
