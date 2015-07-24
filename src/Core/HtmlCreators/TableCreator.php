<?php
/**
 * @file: TableCreator.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - TableCreator
 */

namespace Core\HtmlCreators;


class TableCreator
{
    /**
     * @var array
     */
    private $_data = [];
    /**
     * @var array|null
     */
    private $_attributes;
    /**
     * @var bool
     */
    private $_header;
    /**
     * @var string
     */
    private $_ifEmpty;
    /**
     * @var null
     */
    private $_rowClass;
    /**
     * @var array
     */
    private $_columns;

    /**
     * @param array $data
     * @param null $attributes
     */
    public function __construct($data, $attributes = null)
    {
        $this->_data = $data;
        $this->_rowClass = null;
        $this->_header = false;
        $this->_ifEmpty = '';
        $this->_columns = [];
        $this->_attributes = isset($attributes) ? $attributes : [];
    }

    /**
     * @param $column
     * @param null $title
     * @param null $format
     * @param null $attributes
     * @return $this
     */
    public function show($column, $title = null, $format = null, $attributes = null)
    {
        $attributes = isset($attributes) ? $attributes : [];
        $this->_columns[$column] = array('title' => isset($title) ? $title : $column, 'attributes' => $attributes);
        if (isset($format) && !empty($this->_data)) {
            if (is_array($format)) {
                foreach ($this->_data as &$row) {
                    $row[$column] = isset($format[$row[$column]]) ? $format[$row[$column]] : $row[$column];
                }
            } else {
                foreach ($this->_data as &$row) {
                    preg_match_all('/@\[([^\]]+)\]/', $format, $matches);
                    $value = $format;
                    for ($i = 0; $i < count($matches[0]); $i++) {
                        if (isset($row[$matches[1][$i]])) {
                            $value = str_replace($matches[0][$i], $row[$matches[1][$i]], $value);
                        }
                    }
                    $row[$column] = $value;
                }
            }
        }
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function header($value)
    {
        $this->_header = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function ifEmpty($value)
    {
        $this->_ifEmpty = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function rows()
    {
        $this->_rowClass = func_get_args();
        return $this;
    }

    /**
     * @return $this
     */
    public function out()
    {
        echo $this->_render();
        return $this;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->_render();
    }

    /**
     * @return string
     */
    private function _render()
    {
        if (empty($this->_data)) {
            return $this->_ifEmpty;
        }
        if (empty($this->_columns)) {
            foreach (reset($this->_data) as $key => $item) {
                $this->_columns[$key] = ['title' => $key, 'attributes' => []];
            }
        }
        $attributes = '';
        foreach ($this->_attributes as $key => $item) {
            $attributes .= " {$key}=\"{$item}\"";
        }
        $out = "<table{$attributes}>";
        if ($this->_header) {
            $out .= '<tr>';
            foreach ($this->_columns as $item) {
                $out .= '<th>' . $item['title'] . '</th>';
            }
            $out .= '</tr>';
        }
        if (isset($this->_rowClass)) {
            $rowClass = reset($this->_rowClass);
        } else {
            $rowClass = '';
        }
        foreach ($this->_data as $row) {
            $out .= '<tr' . ($rowClass ? " class=\"{$rowClass}\"" : '') . '>';
            foreach ($this->_columns as $column => $item) {
                $attributes = '';
                foreach ($item['attributes'] as $key => $subItem) {
                    $attributes .= " {$key}=\"{$subItem}\"";
                }
                $out .= "<td{$attributes}>";
                $out .= $row[$column];
                $out .= '</td>';
            }
            $out .= '</tr>';
            if (isset($this->_rowClass)) {
                $rowClass = next($this->_rowClass);
                if ($rowClass === false) $rowClass = reset($this->_rowClass);
            }
        }
        $out .= '</table>';
        return $out;
    }
}