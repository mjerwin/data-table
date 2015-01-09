<?php


namespace MJErwin\DataTable\Button;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class DeleteButton extends Button
{
    /**
     * @var string $confirmation_text
     */
    protected $confirmation_text;

    function __construct()
    {
        $this->addDataAttribute('action', 'delete');
        $this->setText('Delete');
        $this->setIconClass('fa fa-trash-o');
    }

    /**
     * @param string $confirmation_text
     */
    public function setConfirmationText($confirmation_text)
    {
        $this->confirmation_text = $confirmation_text;
    }

    /**
     * @return string
     */
    public function getConfirmationText()
    {
        return $this->replaceVariablesWithRowValues($this->confirmation_text);
    }

    public function render($row_data)
    {
        $this->row_data = $row_data;

        $this->addDataAttribute('delete-confirmation-text', $this->replaceVariablesWithRowValues($this->confirmation_text));

        return parent::render($row_data);
    }
}