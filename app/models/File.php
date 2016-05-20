<?php
namespace App\Models;
class File extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $path;

    /**
     *
     * @var integer
     */
    public $type;

    /**
     *
     * @var integer
     */
    public $filesize;

    /**
     *
     * @var integer
     */
    public $createtime;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("File");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'File';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return File[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return File
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
