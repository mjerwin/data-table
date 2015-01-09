<?php


namespace MJErwin\DataTable\Column;

use MJErwin\DataTable\Button\Button;
use MJErwin\DataTable\Button\DeleteButton;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class ButtonContainerColumn extends AbstractColumn
{
    protected $buttons = [];
    protected $sorting_enabled = false;

    function __construct()
    {
        $this->setDataKey('buttons');
    }


    public function addButton(Button $button)
    {
        $this->buttons[] = $button;
    }


    public function getButtons()
    {
        return $this->buttons;
    }

    public function render($value, $row_data)
    {
        $result = '<div class="btn-group">';

        foreach($this->getButtons() as $button){
            if(!$button->isShowable($row_data))
            {
                continue;
            }

            $result .= $button->render($row_data);
        }

        $result .= '</div>';

        return $result;
    }

} 