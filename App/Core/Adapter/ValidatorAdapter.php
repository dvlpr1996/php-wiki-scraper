<?php

namespace app\Core\Adapter;

use Rakit\Validation\Validator;

class ValidatorAdapter
{
    protected $rules;
    protected $validation;
    protected $errors;
    protected Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator;
    }

    public function validate($validateClassName)
    {
        $this->validateRulesSetter($validateClassName);
        $this->validation = $this->validator->validate($_POST, $this->rules);
        return $this->validationErrors($this->validation);
    }

    private function validateRulesSetter($validateClassName)
    {
        $this->rules = (new $validateClassName)->validateRules();
    }

    private function validationErrors($validation)
    {
        if ($validation->fails()) {
            $this->errors = $this->validation->errors();
            return $this->errors->all(':message');
        }
        return null;
    }
}
