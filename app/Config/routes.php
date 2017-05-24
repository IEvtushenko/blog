<?php

return array(
    'about' => ['controller' => 'Main', 'action' => 'about'],
    '^$' => ['controller' => 'News', 'action' => 'index'],
    '^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' => []
);