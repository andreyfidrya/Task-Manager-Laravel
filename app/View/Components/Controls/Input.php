<?php

namespace App\View\Components\Controls;

use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $label; 
    public null|object|array $item;     
    public string $type; 
    public string $id;

    public bool $hasItem;
    public bool $oldExists; 
    public ?string $old;      

    /**
     * Create a new component instance.    
     * 
     * @return void
     */
    public function __construct(
        string $name, 
        string $label,
        null|object|array $item = null, 
        string $type = 'text',
        ?string $id = null,
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->item = $item;          
        $this->type = $type;
        
        if($id === null){
            $id = "field-$name";            
        }

        $this->id = $id;
        
        $this->hasItem = $this->item !== null;
        $oldParams = old();
        $this->oldExists = array_key_exists($name, $oldParams);
        $this->old =  $this->oldExists ? $oldParams[$name] : ''; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.controls.input');
    }
}
