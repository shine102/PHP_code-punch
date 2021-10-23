<?php

namespace app\core\form;

use app\core\Model;

class Field 
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUM = 'number';
    public const TYPE_FILE = 'file';
    public string $type;
    public Model $model;
    public string $attribute; 

    public function __construct(\app\core\Model $model, string $attribute)
    {

        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
    }

    public function __toString()
    {
        return sprintf('
        <div class="mb-3">
        <label  class="form-label">%s</label>
        <input type="%s" name="%s" value="%s" class="form-control %s" required>
        <div class="invalid-feedback">
        %s
        </div>
        </div>
        ', $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute));
    }

    public function passwordField(){
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    public function numberField(){
        $this->type = self::TYPE_NUM;
        return $this;
    }   
}