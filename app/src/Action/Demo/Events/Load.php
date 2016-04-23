<?php

	namespace Showcase\Action\Demo\Events;

	use ObjectivePHP\Application\Action\RenderableAction;
	use ObjectivePHP\Application\Action\Parameter\NumericParameter;
	use ObjectivePHP\Application\ApplicationInterface;
	use ObjectivePHP\Application\Workflow\Event\WorkflowEvent;

	class Load extends RenderableAction
	{


		public function run(ApplicationInterface $app)
		{

			$eventsHandler = $app->getEventsHandler();

			// bind callbacks
			$callback = function ($event) use (&$count)
			{
				$count++;
			};


			$callbacks = $this->getParam('callbacks', 100);

			for ($i = 0; $i < $callbacks; $i++)
			{
				$eventsHandler->bind('demo.events.*', $callback);
			}


			// trigger events
			$triggers  = $this->getParam('triggers', 100);
			$startedAt = microtime(true);
			for ($i = 0; $i < $triggers; $i++)
			{
				$eventName = 'demo.events.' . $this->generateRandomEventName();
				$eventsHandler->trigger($eventName);
			}


			$stoppedAt = microtime(true);

			$elapsedTime = round($stoppedAt - $startedAt, 3) * 1000;

			return
				[
					'callbacks.ran'    => $count,
					'events.triggered' => $triggers,
					'callbacks.bound'  => $callbacks,
					'time.elapsed'     => $elapsedTime,
					'page.title'       => 'Events demo'
				];


		}


		protected function generateRandomEventName()
		{

			$character_set_array   = [];
			$character_set_array[] = ['count' => 7, 'characters' => 'abcdefghijklmnopqrstuvwxyz'];
			$character_set_array[] = ['count' => 1, 'characters' => '0123456789'];
			$temp_array            = [];
			foreach ($character_set_array as $character_set)
			{
				for ($i = 0; $i < $character_set['count']; $i++)
				{
					$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
				}
			}

			return implode('', $temp_array);
		}


	}
