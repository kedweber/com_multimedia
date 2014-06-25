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

class ComMultimediaAdapterExternalYoutube extends KObject
{
    /**
     * @var object|null
     */
    protected $_state = null;

    /**
     * @param KConfig $config
     */
    public function __construct(KConfig $config = null)
    {
        parent::__construct($config);

        $this->_state = $config->state;
    }

    /**
     * @return object
     */
    public function getItem()
    {
        $data = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$this->_state->resource_id.'?v=2&alt=jsonc'))->data;

        $row = $this->getService('com://admin/multimedia.database.row.video');

        $row->setData(array(
            'resource_id' => $this->_state->resource_id,
            'title' => $data->title,
            'description' => $data->description,
            'thumbnails' => array(
                'small' => $data->thumbnail->sqDefault,
                'large' => $data->thumbnail->hqDefault,
            ),
            '_new'  => false
        ));

        return $row;
    }
}