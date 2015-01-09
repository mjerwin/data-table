<?php


namespace MJErwin\DataTable\Column;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
abstract class AbstractColumn
{
    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

    protected $name;
    protected $data_key;
    protected $sorting_enabled = true;
    protected $default_sorting = null;
    protected $search_value_data_key;
    protected $order_value_data_key;


    /**
     * @param string $data_key
     */
    public function setDataKey($data_key)
    {
        $this->data_key = $data_key;
    }

    /**
     * @return string
     */
    public function getDataKey()
    {
        return $this->data_key;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param boolean $sorting_enabled
     */
    public function setSortingEnabled($enabled)
    {
        $this->sorting_enabled = $enabled;
    }

    /**
     * @return boolean
     */
    public function getSortingEnabled()
    {
        return $this->sorting_enabled;
    }

    /**
     * @param string $default_sorting
     */
    public function setDefaultSorting($default_sorting)
    {
        $this->default_sorting = $default_sorting;
    }

    /**
     * @return string|null
     */
    public function getDefaultSorting()
    {
        return $this->default_sorting;
    }

    /**
     * @param mixed $order_value_data_key
     */
    public function setOrderValueDataKey($order_value_data_key)
    {
        $this->order_value_data_key = $order_value_data_key;
    }

    /**
     * @return mixed
     */
    public function getOrderValueDataKey()
    {
        return $this->order_value_data_key;
    }

    /**
     * @param mixed $search_value_data_key
     */
    public function setSearchValueDataKey($search_value_data_key)
    {
        $this->search_value_data_key = $search_value_data_key;
    }

    /**
     * @return mixed
     */
    public function getSearchValueDataKey()
    {
        return $this->search_value_data_key;
    }

    abstract public function render($value, $row_data);


} 