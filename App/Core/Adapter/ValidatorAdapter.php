<?php

namespace app\Core\Adapter;

use Rakit\Validation\Validation;
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

    public function validate(string $validateClassName)
    {
        $this->validateRulesSetter($validateClassName);
        $this->validation = $this->validator->validate($_POST, $this->rules);
        return $this->validationErrors($this->validation);
    }

    private function validateRulesSetter(string $validateClassName)
    {
        $this->rules = (new $validateClassName)->validateRules();
    }

    private function validationErrors(Validation $validation)
    {
        if ($validation->fails()) {
            $this->errors = $this->validation->errors();
            return $this->errors->all(':message');
        }
        return null;
    }
}
