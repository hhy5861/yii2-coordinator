<?php

namespace mike\coordinator;

use yii\base\Component;
use yii\base\InvalidCallException;
use yii\redis\Connection;

class RedisCoordinator extends Component implements ICoordinator
{
    /**
     * @var
     */
    public $hashName;
    /**
     * @var
     */
    public $connect;
    /**
     * @var
     */
    private $db;

    /**
     * @throws InvalidConfigException
     * @throws \yii\base\InvalidConfigException
     */
    public function init() {
        parent::init();

        if (!$this->hashName) {
            throw new InvalidCallException("Please set hashName for coordinator component");
        }

        if (!$this->connect) {
            throw new InvalidConfigException("Please set connect for coordinator component");
        }

        $this->db = \Yii::createObject($this->connect);

        if (!$this->db instanceof Connection) {
            throw new InvalidConfigException("Component coordinator not implements redis Connection interface.");
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function execute(array $data) {
        $result = [];

        if (!$data) {
            return $result;
        }

        array_unshift($data, $this->hashName);
        $result = $this->db->executeCommand('hmget', $data);

        return array_unique($result);
    }
}