<?php

namespace App;
use App\HTMLElement;

class Radio extends HTMLElement
{
    
    public function __construct(
        private ?string $labe = null,
        private string $value,
        private bool $checked,
        private array $attributs = [],
    )
    {}

    private function view(string $attributs): string
    {
        $checked = $this->checked ?  ' checked ' : '';
        return '<label>'. $this->labe .'</label><input type="radio" '. $checked .' '. $attributs .'">'. $this->value . '</select>';
    }

    private function getAttribut(): string
    {
        $attributs = "";
        foreach ($this->attributs as $key => $attribut) {
            $attributs .= ''. $key .'=' . $attribut . ' ';
        }
        return $attributs;
    }

    public function render(): string
    {
        
        return $this->view($this->getAttribut());
    }

    public function __toString(): string
    {
        return $this->render();
    }
}