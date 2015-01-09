<?php


namespace MJErwin\DataTable\Column;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class DateTimeColumn extends AbstractColumn
{
    protected $format = 'd/m/Y';

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }


    public function render($value, $row_data)
    {
        if($value == null)
        {
            return '';
        }

        if(!$value instanceof \DateTime){
            $value = new \DateTime($value);
        }

        return $value->format($this->getFormat());
    }

} 