<?php

class Person extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var integer
     */
    public $state;

    /**
     *
     * @var string
     */
    public $sex;

    /**
     *
     * @var string
     */
    public $address;

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
        $this->setSource("Person");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Person';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Person[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Person
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
