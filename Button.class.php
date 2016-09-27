<?php

class Button extends VisualObject {
    public $x = 0;
    public $y = 0;
    public $width = null;
    public $label = null;
    public $onPress = null;
    public function input($tecla, $teclaHex) {
        if ($teclaHex==Input::KEY_RETURN) {
            call_user_func($this->onPress);
        }
    }
    
    public function render() {
		list($x,$y) = $this->getAbsolutePosition();
        if ($this->width==null) {
            $this->width = strlen($this->label)+2;
        }
        if ($this->_focus) {
            Console::Color('7');
        }
        Console::Write('[' . str_pad($this->label, $this->width, ' ', STR_PAD_BOTH) . ']', $x, $y);
        Console::Color('0');
    }
    
}
