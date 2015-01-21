<?php


namespace MJErwin\DataTable\Column;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class BooleanColumn extends AbstractColumn
{
    /** @var string */
    protected $true_value = 'true';
    /** @var string */
    protected $false_value = 'false';

    public function render($value, $row_data)
    {
        return $value ? $this->getTrueValue() : $this->getFalseValue();
    }

    /**
     * @return string
     */
    public function getFalseValue()
    {
        return $this->false_value;
    }

    /**
     * @param string $false_value
     */
    public function setFalseValue($false_value)
    {
        $this->false_value = $false_value;
    }

    /**
     * @return string
     */
    public function getTrueValue()
    {
        return $this->true_value;
    }

    /**
     * @param string $true_value
     */
    public function setTrueValue($true_value)
    {
        $this->true_value = $true_value;
    }


} 