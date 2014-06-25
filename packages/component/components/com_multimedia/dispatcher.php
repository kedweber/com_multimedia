<?php

class ComMultimediaDispatcher extends ComDefaultDispatcher
{
    protected function _initialize(KConfig $config)
    {
    	$config->append(array(
    		'controller' => 'videos'
        ));

        parent::_initialize($config);
    }
}