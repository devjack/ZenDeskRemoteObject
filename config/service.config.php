<?php

return array(
    'abstract_factories' => array(
        'ZenDesk\Factory\ServiceAbstractFactory' => 'ZenDesk\Factory\ServiceAbstractFactory',
    ),
    'factories' => array(
        'ZenDesk\Rest\Client' => 'ZenDesk\Rest\Client\ClientFactory',
        'ZenDesk\Rest\Remote' => 'ZenDesk\Rest\Client\RemoteFactory',
    ),
);
