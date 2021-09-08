<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * function firstOrCreate()
     * @param Model $entity
     */

    protected $entity;
    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }
}
