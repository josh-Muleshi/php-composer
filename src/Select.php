<?php

namespace App;
use App\HTMLElement;

class Select extends HTMLElement
{
    public function __construct(
        private string $name,
        private array $options = [],
        private array $attributs = [],
    )
    {}

    private function view(string $options, string $attributs): string
    {
        return '<select name="'. $this->name .'" '. $attributs .'">'. $options . '</select>';
    }

    private function getAttribut(): string
    {
        $attributs = "";
        foreach ($this->attributs as $key => $attribut) {
            $attributs .= ''. $key .'=' . $attribut . ' ';
        }
        return $attributs;
    }

    private function getOptions(): string
    {
        $options = "";
        foreach ($this->options as $key => $option) {
            $options .= '<option value="'. $key.'">'. $option .'</option>';
        }
        return $options;
    }

    #[\Override]
    public function render(): string
    {
        $options = $this->getOptions();
        $attributs = $this->getAttribut();
        return $this->view($options, $attributs);
    }

    public function __toString(): string
    {
        return $this->render();
    }
}