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

class ComMultimediaAdapterExternalVimeo extends KObject
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
        $data = reset(json_decode(file_get_contents('http://vimeo.com/api/v2/video/'.$this->_state->resource_id.'.json')));

        $row = $this->getService('com://admin/multimedia.database.row.video');

        $row->setData(array(
            'resource_id' => $this->_state->resource_id,
            'title' => $data->title,
            'description' => $data->description,
            'source' => 'Vimeo',
            'url' => 'https://vimeo.com/'.$this->_state->resource_id,
            'thumbnail' => $data->thumbnail_medium,
            'thumbnails' => array(
                'small' => $data->thumbnail_small,
                'medium' => $data->thumbnail_medium,
                'large' => $data->thumbnail_large,
            ),
            'created_on' => $data->upload_date,
            '_new'  => false
        ));

        return $row;
    }

    public function getList()
    {
        $data = reset(json_decode(file_get_contents('http://vimeo.com/api/v2/video/'.$this->_state->resource_id.'.json')));

        $row = $this->getService('com://admin/multimedia.database.row.video');

        $row->setData(array(
            'resource_id' => $this->_state->resource_id,
            'title' => $data->title,
            'description' => $data->description,
            'thumbnails' => array(
                'small' => $data->thumbnail_small,
                'medium' => $data->thumbnail_medium,
                'large' => $data->thumbnail_large,
            ),
            '_new'  => false
        ));

        return $row;
    }
}