<?php

namespace App\EnounServices;

use stdClass;

class EnounServices
{
    protected $repository;

    public function __construct()
    {

    }


    public function getAll() : array
    {
       return $this->repository->getAll();
    }


    public function findOne(string $id) : stdClass|null // pode retorna um stdClass ou null
    {
        return $this->repository->findOne($id);
    }

    public function new() : stdClass|null 
    {
        return $this->repository->new();
    }

    public function update(string $id) : stdClass|null
    {
        return $this->repository->update($id);
    }

    public function delete(string $id):void
    {
        return $this->repository->delete($id);
    }
    

}