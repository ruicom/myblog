<?php
namespace App\Models;
class Account extends \Phalcon\Mvc\Model
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
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $role;

    /**
     *
     * @var integer
     */
    public $state;

    /**
     *
     * @var integer
     */
    public $sex;

    /**
     *
     * @var integer
     */
    public $file_id;

    /**
     *
     * @var string
     */
    public $birthday;

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
        $this->setSource("Account");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Account';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Account[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Account
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
