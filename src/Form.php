<?php
namespace App;
use App\HTMLElement;

class Form extends HTMLElement {
    private $elements = [];

    public function __construct(private string $action, private string $method = 'POST', array $attributes = []) {
        parent::__construct('form', array_merge($attributes, [
            'action' => $action,
            'method' => $method,
            'enctype' => 'multipart/form-data'
        ]), null);
    }

    public function addElement($element) {
        $this->elements[] = $element;
    }

    public function render() {
        $content = '';
        foreach ($this->elements as $element) {
            $content .= $element->render();
        }
        return "<{$this->tag}{$this->getAttributes()}>{$content}</{$this->tag}>";
    }
}