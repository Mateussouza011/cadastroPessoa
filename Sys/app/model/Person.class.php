<?php

class Person extends TRecord {
    const TABLENAME = "pessoas";
    const PRIMARYKEY= "id";
    const IDPOLICY =  'max';

    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        if ($id !== NULL || $callObjectLoad !== TRUE){
            parent::__construct($id, $callObjectLoad);
            parent::addAttribute('nome_completo');
            parent::addAttribute('razao_social');
            parent::addAttribute('tipo');
            parent::addAttribute('cpf');
            parent::addAttribute('cnpj');
            parent::addAttribute('email');
            parent::addAttribute('telefone');
            parent::addAttribute('endereco_completo');
        }
    }
    public function get_pessoa(): mixed{
        return $this->nome_completo;
    }

}