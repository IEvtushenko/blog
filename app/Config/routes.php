<?php

return array(
    'about' => ['controller' => 'Main', 'action' => 'about'],
    'search' => ['controller' => 'News', 'action' => 'search'],
    '^$' => ['controller' => 'News', 'action' => 'index'],
    '^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' => []
);