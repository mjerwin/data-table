<?php


namespace MJErwin\DataTable\Table;



/**
* @author Matthew Erwin <matthew.j.erwin@me.com>
*/
class ArrayTable extends AbstractTable {
    protected $data = [];

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

} 