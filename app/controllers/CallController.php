<?php

class CallController extends ControllerBase
{
    protected $table;
    protected $table_condition;
    
    use DataTableControllerTraitExt;

    public function initialize()
    {
        parent::initialize();

    }

    public function indexAction(){}
    
}
