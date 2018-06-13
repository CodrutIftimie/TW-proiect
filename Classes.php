<?php

class LinkParameter {
    private $argument;
    private $value;

    public function __construct($argument, $value) {
        $this->argument = $argument;
        $this->value = $value;
    }

    public function modifyArgument($newValue) {
        $this->value = $newValue;
    }

    public function getArgument() {
        return $this->argument;
    }

    public function getValue() {
        return $this->value;
    }

    public function toString() {
        return $this->argument . "=" . $this->value;
    }
}

class LinkBuilder {
    private $array;
    private $values;

    public function __construct() {
        $this->array = array();
        $this->values = 0;
    }

    public function append(LinkParameter $parameter) {
        $this->array[$this->values] = $parameter;
        $this->values++;
    }

    public function remove($argument) {
        $index = 0;
        for($index=0; $index < $this->values; $index++) {
            if($this->array[$index]->getArgument() == $argument) 
                break;
        }
        for($index2 = $index; $index2 < $this->values-1; $index2++)
            $this->array[$index2] = $this->array[$index2+1];
        unset($this->array[$this->values-1]);
        $this->values--;
    }

    public function getArgumentValue($argument) {
        for($index=0; $index < $this->values; $index++)
            if($this->array[$index]->getArgument() == $argument) {
                return $this->array[$index]->getValue();
            }
        return "";
    }

    public function getArrayValues($argument) {
        $thisArgument;
        if($argument == 1) {
            $thisArgument="ig%5B%5D";
        } else if ($argument == 2) $thisArgument="pk%5B%5D";
        else $thisArgument="mc%5B%5D";
        $valuess = array();
        for($index=0; $index < $this->values; $index++)
            if($thisArgument == $this->array[$index]->getArgument() && $this->array[$index]->getValue()!="") {
                $valuess[] = $this->array[$index]->getValue();
            }
        return $valuess;
    }

    public function modifyArgument($argument,$newValue) {
        $found = 0;
        for($index=0; $index < $this->values; $index++)
            if($this->array[$index]->getArgument() == $argument) {
                $this->array[$index]->modifyArgument($newValue);
                $found = 1;
                break;
            }
        if($found==0)
            $this->append(new LinkParameter($argument,$newValue));
    }

    public function getObject() {
        return $this;
    }

    public function toString() {
        $link = "?";
        foreach($this->array as $x) {
            $link = $link . $x->toString() . "&";
        }
        return substr($link,0,-1);
    }

}

function getFullValue($argument) {
    switch($argument) {
        case "h2o" : return "water";
        case "tmt" : return "tomatoes";
        case "veg" : return "vegetables";
        case "meat" : return "meat";
        case "fish" : return "fish";
        case "chs" : return "cheese";
        case "frt" : return  "fruits";

        case "cbb" : return "carboard";
        case "mtb" : return "metal";
        case "pb" : return "plastic";
        case "jar" : return "jar";
        case "btl" : return "bottle";
        case "csr" : return "casserole";
        case "env" : return "envelope";

        case "mcv" : return "microwave";
        case "gsc" : return "gascooker";
        case "bld" : return "blender";
        
        default : return $argument;
    }
}
?>