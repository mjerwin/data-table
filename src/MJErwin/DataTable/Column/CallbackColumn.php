<?php


namespace MJErwin\DataTable\Column;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class CallbackColumn extends AbstractColumn
{

    protected $callback;

    function __construct($callback = null)
    {
        if($callback)
        {
            $this->setCallback($callback);
        }
    }

    /**
     * @param mixed $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }


    public function render($value, $row_data)
    {
        return call_user_func($this->callback, $row_data);
    }
}