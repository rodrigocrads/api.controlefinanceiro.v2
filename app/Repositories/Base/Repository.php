<?php

namespace FinancialControl\Repositories\Base;

use FinancialControl\Models\IFilterMapper;
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
        $model = $this->find($id);

        if ($model) {
            $model->fill($array);
            if ($model->save()) return $model;
        }

        return null;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        $model = $this->find($id);

        if ($model) return $model->delete();

        return false;
    }

    public function all(array $filters = [])
    {
        if (empty($filters) || !$this->model instanceof IFilterMapper)
            return $this->model->all();

        return $this->withFilter($filters);
    }

    private function withFilter(array $filters)
    {
        $query = $this->model;
        $filtersMapper = $this->model->getFiltersMapper();

        foreach ($filters as $filterKey => $filterValue) {
            $mapConfig = $filtersMapper[$filterKey] ?? [];
            
            if (empty($mapConfig)) continue;
            
            if ($mapConfig['operator'] === 'like') {
                $query = $query->where($mapConfig['field'], $mapConfig['operator'], '%' . $filterValue . '%');
                continue;
            }

            $query = $query->where($mapConfig['field'], $mapConfig['operator'], $filterValue);
        }

        return $query->get();
    }
}
