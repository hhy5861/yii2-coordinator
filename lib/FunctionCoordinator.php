<?php

namespace mike\coordinator;

use yii\base\Component;
use yii\base\InvalidConfigException;

class FunctionCoordinator  extends Component implements ICoordinator
{
    /**
     * @var
     */
    public $function;

    /**
     * @throws InvalidConfigException
     */
    public function init() {
        parent::init();

        if (!$this->function or !is_callable($this->function)) {
            throw new InvalidConfigException("Please set callable function for coordinator component");
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function execute(array $data) {
        $result = [];

        foreach ($data as $value) {
            $result[] = call_user_func($this->function, $value);
        }

        return array_unique($result);
    }
}