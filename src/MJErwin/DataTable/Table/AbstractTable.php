<?php


namespace MJErwin\DataTable\Table;

use MJErwin\DataTable\Column\AbstractColumn;
use View;


/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
abstract class AbstractTable
{
    protected $columns = [];
    protected $classes = [];
    protected $searching_enabled = true;
    protected $sorting_enabled = true;
    protected $language_options = [];
    protected $length_menu_options;
    protected $page_length;
    protected $row_attributes = [];
    protected $length_menu_enabled = true;

    /**
     * @param AbstractColumn $column
     */
    public function addColumn(AbstractColumn $column)
    {
        $this->columns[] = $column;
    }

    public function addClass($class)
    {
        $this->classes[$class] = $class;
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param array $classes
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }

    public function getClassesAsString()
    {
        return implode(' ', $this->classes);
    }

    public function getSearchingEnabled()
    {
        return $this->searching_enabled;
    }

    public function setSearchingEnabled($enabled)
    {
        $this->searching_enabled = "{$enabled}";
    }

    public function getSortingEnabled()
    {
        return $this->sorting_enabled;
    }

    public function setSortingEnabled($enabled)
    {
        $this->sorting_enabled = "{$enabled}";
    }

    public function getArrangedData()
    {
        $data = $this->getData();
        $columns = $this->getColumns();

        $table_data = [];

        foreach($data as $row_id => $row)
        {
            $table_data[$row_id]['tr_id'] = 'table-row-' . (isset($row['id']) ? $row['id'] : $row_id);
            $table_data[$row_id]['attr'] = $this->getRowAttributes($row);

            foreach($columns as $column)
            {
                $value = isset($row[$column->getDataKey()]) ? $row[$column->getDataKey()] : null;
                $search_value = isset($row[$column->getSearchValueDataKey()]) ? $row[$column->getSearchValueDataKey()] : null;
                $order_value = isset($row[$column->getOrderValueDataKey()]) ? $row[$column->getOrderValueDataKey()] : null;

                $table_data[$row_id]['columns'][] = [
                    'name' => $column->getName(),
                    'value' => $column->render($value, $row),
                    'search_value' => $search_value,
                    'order_value' => $order_value,
                ];
            }
        }

        return $table_data;
    }

    abstract function getData();

    /**
     * @return AbstractColumn[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    public function getRowAttributes($row)
    {
        $row_attr = [];

        foreach($this->row_attributes as $key => $value)
        {
            $row_attr[$key] = preg_replace_callback('/\{\$([a-zA-Z0-9_]*)\}/', function ($matches) use ($row)
            {
                return isset($row[$matches[1]]) ? $row[$matches[1]] : null;
            }, $value);
        }

        return $row_attr;
    }

    /**
     * @param array $row_attributes
     */
    public function setRowAttributes($row_attributes)
    {
        $this->row_attributes = $row_attributes;
    }

    public function getColumnSortingData()
    {
        $column_sort_data = [];

        foreach($this->getColumns() as $column)
        {
            $column_sort_data[] = $column->getSortingEnabled();
        }

        return $column_sort_data;
    }

    public function getDefaultSortingData()
    {
        $default_sorting_data = [];

        foreach($this->getColumns() as $index => $column)
        {
            if ($column->getDefaultSorting())
            {
                $default_sorting_data[$index] = $column->getDefaultSorting();
            }
        }

        return $default_sorting_data;
    }

    /**
     * @return array
     */
    public function getLanguageOptions()
    {
        return $this->language_options;
    }

    /**
     * @param array $language_options
     */
    public function setLanguageOptions($language_options)
    {
        $this->language_options = $language_options;
    }

    public function addLanguageOption($key, $value)
    {
        $this->language_options[$key] = $value;
    }

    public function render()
    {
        return View::make('data-table::table', [
            'table' => $this,
        ]);
    }

    public function setProcessingLanguageText($text)
    {
        $this->language_options['processing'] = $text;
    }

    public function setSearchLanguageText($text)
    {
        $this->language_options['search'] = $text;
    }

    public function setLengthMenuLanguageText($text)
    {
        $this->language_options['lengthMenu'] = $text;
    }


    public function setInfoLanguageText($text)
    {
        $this->language_options['info'] = $text;
    }

    public function setInfoEmptyLanguageText($text)
    {
        $this->language_options['infoEmpty'] = $text;
    }

    public function setInfoFilteredLanguageText($text)
    {
        $this->language_options['infoFiltered'] = $text;
    }

    public function setInfoPostFixLanguageText($text)
    {
        $this->language_options['infoPostFix'] = $text;
    }

    public function setLoadingRecordsLanguageText($text)
    {
        $this->language_options['loadingRecords'] = $text;
    }

    public function setZeroRecordsLanguageText($text)
    {
        $this->language_options['zeroRecords'] = $text;
    }

    public function setEmptyTableLanguageText($text)
    {
        $this->language_options['emptyTable'] = $text;
    }

    public function setPaginateFirstLanguageText($text)
    {
        $this->language_options['paginate']['first'] = $text;
    }

    public function setPaginatePreviousLanguageText($text)
    {
        $this->language_options['paginate']['previous'] = $text;
    }

    public function setPaginateNextLanguageText($text)
    {
        $this->language_options['paginate']['next'] = $text;
    }

    public function setPaginateLastLanguageText($text)
    {
        $this->language_options['paginate']['last'] = $text;
    }

    public function setAriaSortAscendingLanguageText($text)
    {
        $this->language_options['aria']['sortAscending'] = $text;
    }

    public function setAriaSortDescendingLanguageText($text)
    {
        $this->language_options['aria']['sortDescending'] = $text;
    }

    /**
     * @return array
     */
    public function getLengthMenuOptions()
    {
        return $this->length_menu_options;
    }

    /**
     * @param array $length_menu_options
     */
    public function setLengthMenuOptions($length_menu_options)
    {
        $this->length_menu_options = $length_menu_options;
    }

    /**
     * @return int
     */
    public function getPageLength()
    {
        return $this->page_length;
    }

    /**
     * @param int $page_length
     */
    public function setPageLength($page_length)
    {
        $this->page_length = $page_length;
    }

    /**
     * @return boolean
     */
    public function isLengthMenuEnabled()
    {
        return $this->length_menu_enabled;
    }

    /**
     * @param boolean $length_menu_enabled
     */
    public function setLengthMenuEnabled($length_menu_enabled)
    {
        $this->length_menu_enabled = $length_menu_enabled;
    }
} 