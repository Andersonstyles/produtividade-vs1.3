<?php
class Activity extends Model {
    protected static $tableName = 'activity';
    protected static $columns = [
        'id',
        'date',
        'punctuation',
        'protocol',
        'type',
        'applicant',
        'supervisor',
        'tax_code'
        
    ];

    public function insert() {
        $this->validate();
        return parent::insert();
    }

    public function update() {
        $this->validate();
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->protocol) {
            $errors['protocol'] = 'O protocolo é um campo obrigatório.';
        }
        if(!$this->punctuation) {
            $errors['punctuation'] = 'A pontuação é um campo obrigatório.';
        }
       
        if(!$this->applicant) {
            $errors['applicant'] = 'O requerente é um campo obrigatório.';
        }
        if(!$this->type) {
            $errors['type'] = 'O tipo é um campo obrigatório.';
        }
        if(!$this->tax_code) {
            $errors['tax_code'] = 'O ID do usuário é um campo obrigatório.';
        }

        if(!$this->date) {
            $errors['date'] = 'Data do processo é um campo obrigatório.';
        } elseif(!DateTime::createFromFormat('Y-m-d', $this->date)) {
            $errors['date'] = 'Data do processo deve seguir o padrão dd/mm/aaaa.';
        }
        
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

}