<?php

namespace FinancialControl\Action;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractAction
{
    /**
     * Store input data for use in the method run
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
     * Responsible by run the actions
     * 
     * @author Rodrigo Cunha
     */
    abstract public function run();
}