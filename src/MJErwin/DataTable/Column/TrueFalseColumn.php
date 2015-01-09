<?php


namespace MJErwin\DataTable\Column;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class TrueFalseColumn extends AbstractColumn
{
    public function render($value, $row_data)
    {
        $icon_class = $value ? 'fa-check' : 'fa-times';

        return "<i class='fa {$icon_class}'></i>";
    }

} 