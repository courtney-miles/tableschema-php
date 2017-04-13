<?php namespace frictionlessdata\tableschema;


class SchemaValidationError {

    const LOAD_FAILED=1;
    const SCHEMA_VIOLATION=8;

    public function __construct($code, $extraDetails=null)
    {
        $this->code = $code;
        $this->extraDetails = $extraDetails;
    }

    public function getMessage()
    {
        switch ($this->code) {
            case self::LOAD_FAILED:
                return "Failed to load from the given descriptor: {$this->extraDetails}";
            case self::SCHEMA_VIOLATION:
                return $this->extraDetails;
            default:
                throw new \Exception("Invalid schema validation code: {$this->code}");
        }
    }

    public static function getErrorMessages($validationErrors)
    {
        return implode(", ", array_map(function($validation_error){
            return $validation_error->getMessage();
        }, $validationErrors));
    }

}