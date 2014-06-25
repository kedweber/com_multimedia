<?php
/**
 * Com
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ...
 * @uses        Com_
 */
 
defined('KOOWA') or die('Protected resource');

class ComMultimediaTemplateHelperListbox extends ComDefaultTemplateHelperListbox
{
    /**
     * @param array $config
     * @return string
     */
    public function sources($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'model'    => 'sources',
            'value'    => 'title',
            'text'     => 'title',
            'name'     => 'source',
            'deselect' => false,
        ));

        return parent::_listbox($config);
    }
}