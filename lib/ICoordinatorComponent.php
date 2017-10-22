<?php

namespace mike\coordinator;

interface ICoordinatorComponent
{
    /**
     * @param array $db
     * @param $data
     * @return mixed
     */
    public function getShard(array $db, $data);
}