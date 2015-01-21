<?php


namespace MJErwin\DataTable\Button;

/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 */
class Button
{

    protected $id;
    protected $text = '';
    protected $classes = ['btn'];
    protected $link;
    protected $attributes = [];
    protected $row_data = [];
    protected $icon_class;
    protected $only_show_with_fields = [];
    protected $only_show_without_fields = [];

    protected function replaceVariablesWithRowValues($string)
    {
        return preg_replace_callback('/\{\$([a-zA-Z0-9_]*)\}/', function ($matches){
            return isset($this->row_data[$matches[1]]) ? $this->row_data[$matches[1]] : null;
        }, $string);
    }

    public function addClass($class)
    {
        $this->classes[$class] = $class;
    }

    /**
     * @param array $classes
     */
    public function setClasses($classes)
    {
        foreach($classes as $class){
            $this->addClass($class);
        }
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }

    public function getClassesAsString()
    {
        return implode(' ', $this->classes);
    }

    public function addDataAttribute($key, $value)
    {
        $this->attributes['data-' . $key] = $value;
    }

    /**
     * @param array $data_attributes
     */
    public function setDataAttributes($data_attributes)
    {
        foreach($data_attributes as $key => $value){
            $this->addDataAttribute($key, $value);
        }
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        array_walk($this->attributes, function (&$value){
            $value = $this->replaceVariablesWithRowValues($value);
        });

        return $this->attributes;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        $link = $this->replaceVariablesWithRowValues($this->link);
        return $link;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->replaceVariablesWithRowValues($this->text);
    }

    /**
     * @param mixed $icon_class
     */
    public function setIconClass($icon_class)
    {
        $this->icon_class = $icon_class;
    }

    /**
     * @return mixed
     */
    public function getIconClass()
    {
        return $this->icon_class;
    }

    public function render($row_data)
    {
        $this->row_data = $row_data;

        $attrs = [
            'id' => $this->getId(),
            'class' => $this->getClassesAsString(),
            'href' => $this->getLink(),
        ];

        $attributes = array_merge($this->getAttributes(), $attrs);

        $tag = $this->getLink() ? 'a' : 'button';

        $element = '';
        $element .= "<{$tag} ";

        foreach($attributes as $key => $value){
            $element .= "{$key}=\"{$value}\"";
        }

        $element .= ">";

        if($this->getIconClass()){
            $element .= '<i class="' . $this->getIconClass() . '"></i> ';
        }

        $element .= $this->getText();
        $element .= "</{$tag}>";

        return $element;
    }

    /**
     * @param array $only_show_with_fields
     */
    public function setOnlyShowWithFields($only_show_with_fields)
    {
        $this->only_show_with_fields = $only_show_with_fields;
    }

    /**
     * @return array
     */
    public function getOnlyShowWithFields()
    {
        return $this->only_show_with_fields;
    }

    /**
     * @param string $field_name
     */
    public function addOnlyShowWithField($field_name)
    {
        $this->only_show_with_fields[] = $field_name;
    }

    /**
     * @param array $only_show_without_fields
     */
    public function setOnlyShowWithoutFields($only_show_without_fields)
    {
        $this->only_show_without_fields = $only_show_without_fields;
    }

    /**
     * @return array
     */
    public function getOnlyShowWithoutFields()
    {
        return $this->only_show_without_fields;
    }

    /**
     * @param string $field_name
     */
    public function addOnlyShowWithoutField($field_name)
    {
        $this->only_show_without_fields[] = $field_name;
    }

    public function isShowable($row_data)
    {
        foreach($this->getOnlyShowWithFields() as $field){
            if(!isset($row_data[$field]) || !$row_data[$field]){
                return false;
            }
        }

        foreach($this->getOnlyShowWithoutFields() as $field){
            if(isset($row_data[$field]) && $row_data[$field]){
                return false;
            }
        }

        return true;
    }

}