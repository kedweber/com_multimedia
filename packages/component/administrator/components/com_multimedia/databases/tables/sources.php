<?php

class ComMultimediaDatabaseTableSources extends KDatabaseTableDefault
{
    public function _initialize(KConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'com://admin/translations.database.behavior.translatable',
                'com://admin/moyo.database.behavior.creatable'
            )
        ));

        parent::_initialize($config);
    }
}