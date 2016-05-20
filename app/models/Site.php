<?php
namespace App\Models;
class Site extends \Phalcon\Mvc\Model
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
    public $title;

    /**
     *
     * @var string
     */
    public $title_des;

    /**
     *
     * @var string
     */
    public $about_me;

    /**
     *
     * @var integer
     */
    public $account_id;

    /**
     *
     * @var integer
     */
    public $createtime;

    /**
     *
     * @var integer
     */
    public $updatetime;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("Site");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Site';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Site[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Site
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
