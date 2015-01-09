<?php


namespace MJErwin\DataTable\Column;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class NumberColumn extends AbstractColumn
{
    public function render($value, $row_data)
    {
        return $value;
    }

} 