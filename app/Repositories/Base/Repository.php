<?php

namespace FinancialControl\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

abstract class Repository implements IRepository
{
    /** @var Model */
    protected $model;

    public function __construct($model)
    {
        if (($model instanceof Model) === false) {
            throw new \Exception("Model is invalid");
        }

        $this->model = $model;
    }

    public function create(array $array)
    {
        return $this->model->create($array);
    }

    public function update(array $array, $id)
    {
        $m = $this->find($id);

        if ($m) {
            $m->fill($array);
            if ($m->save()) return $m;
        }

        return null;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        $m = $this->find($id);
    
        if ($m) return $m->delete();

        return false;
    }

    public function all()
    {
        return $this->model->all();
    }
}
