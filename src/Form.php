<?php

namespace App;
use App\HTMLElement;

class Form extends HTMLElement {

    private object $object;
    private array $contents;

    public function __construct(
        public array $data,
    ){}

    private function getAttributs(array $data): string 
    {
        $view = "";
        foreach($data as $key => $value){
            $view .= ''. $key .'=' . $value . ' ';
        }
        return $view;
    }

    public function addElement(object $object){
        $this->object = $object;
        $this->contents[] = $this->object;
    }

    private function content(array $contents){
        $content = "";
        foreach($contents as $value){
            $content .= $value.'<br>';
        }

        return $content;
    }

    #[\Override]
    public function render(): string
    {
        return '<form'. $this->getAttributs($this->data) .'>'. $this->content($this->contents) .'</form>';
    }
    
}