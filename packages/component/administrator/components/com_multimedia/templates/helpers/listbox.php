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

    public function adapters($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'value' => 'value',
            'text' => 'text',
            'name' => 'adapter',
            'options' => array(
                array(
                    'text' => 'Please select your adapter',
                    'value' => null
                ),
                array(
                    'text' => 'YouTube',
                    'value' => 'youtube'
                ),
                array(
                    'text' => 'Vimeo',
                    'value' => 'vimeo'
                )
            )
        ));

        return parent::optionlist($config);
    }
}
