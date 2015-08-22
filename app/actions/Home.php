<?php
    
    namespace Showcase\Action;

    class Home
    {
        public function __invoke()
        {
            return [
                'layout' => ['pageTitle' => 'Objective PHP Showcase']
            ];
        }
    }