<?php

namespace mike\coordinator;

interface ICoordinator
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data);
}