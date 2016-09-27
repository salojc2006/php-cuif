<?php

class Console {
    static private $_outPointer = null;
    static private $_staticCurosorPosX = 0;
    static private $_staticCurosorPosY = 0;
    static public function Clear() {
        self::_seq('2J');
    }
    static public function SetPos($x,$y) {
        self::_seq("{$y};{$x}f");
    }
    static public function Write($text, $x=null, $y=null) {
        if ($x !==null&&$y!==null){
            self::SetPos($x, $y);
        }
        self::_out($text);
    }
    static public function SaveCursorPos() {
        self::_seq('s');
    }
    static public function RestoreCursorPos() {
        self::_seq('u');
    }
    static public function Color($code) {
        self::_seq("{$code}m");
    }
    static public function HideCursor() {
        system("tput civis");
    }
    static public function ShowCursor() {
        system("tput cnorm");
    }
    
    static public function SetStaticCursorPos($x, $y) {
        self::$_staticCurosorPosX = $x;
        self::$_staticCurosorPosY = $y;
    }
    static public function ShowCursorStatic() {
        if (self::$_staticCurosorPosX === null || self::$_staticCurosorPosY === null) {
            self::HideCursor();
        } else {
            self::ShowCursor();
            self::Color('5');
            self::SetPos(self::$_staticCurosorPosX, self::$_staticCurosorPosY);
            self::Color('0');
        }
    }
    static private function _seq($seq) {
        self::_out("\e[{$seq}");
    }
    static private function _getOutPointer() {
        if (self::$_outPointer===NULL) {
            self::$_outPointer = fopen('php://stdout', 'w');
        }
        return self::$_outPointer;
    }
    static private function _out($str) {
        fwrite(self::_getOutPointer(), $str);
    }
}