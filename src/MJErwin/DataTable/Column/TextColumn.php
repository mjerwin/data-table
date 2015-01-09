<?php


namespace MJErwin\DataTable\Column;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class TextColumn extends AbstractColumn
{
    protected $truncate_length;

    /**
     * @param mixed $truncate_length
     */
    public function setTruncateLength($truncate_length)
    {
        $this->truncate_length = $truncate_length;
    }

    /**
     * @return mixed
     */
    public function getTruncateLength()
    {
        return $this->truncate_length;
    }


    public function render($value, $row_data)
    {
        if($this->getTruncateLength())
        {
            return tidy_truncate($value, $this->getTruncateLength());
        }

        return $value;
    }

} 