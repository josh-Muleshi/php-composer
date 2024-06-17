<?php
namespace App;
use App\HTMLElement;

class Table extends HTMLElement {
    private $rows = [];

    public function __construct($attributes = []) {
        parent::__construct('table', $attributes, null);
    }

    public function addRow($row) {
        $this->rows[] = $row;
    }

    public function render() {
        $content = '';
        foreach ($this->rows as $row) {
            $content .= '<tr>';
            foreach ($row as $cell) {
                $content .= "<td>$cell</td>";
            }
            $content .= '</tr>';
        }
        return "<{$this->tag}{$this->getAttributes()}>{$content}</{$this->tag}>";
    }
}