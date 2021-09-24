<?php

namespace FinancialControl\Actions;

abstract class AbstractAction
{
    /**
     * Store all input data for use in the method run
     * 
     * @author Rodrigo Cunha
     * @var array
     */
    protected $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Get input data by key
     * 
     * @author Rodrigo Cunha
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function get(string $key, $default = null)
    {
        return data_get($this->data, $key, $default);
    }

    /**
     * Get all input data
     * 
     * @author Rodrigo Cunha
     * @return array
     */
    protected function getAll(): array
    {
        return $this->data;
    }

    /**
     * Responsible by run the actions
     * 
     * @author Rodrigo Cunha
     */
    abstract public function run();
}