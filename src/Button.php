<?php
namespace App;
use App\HTMLElement;

class Button extends HTMLElement {
    public function __construct(private string $type, string $content, array $attributes = []) {
        parent::__construct('button', array_merge($attributes, [
            'type' => $type
        ]), $content);
    }
}