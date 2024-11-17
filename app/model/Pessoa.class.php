<?php
/**
 * Pessoa Active Record
 */
class Pessoa extends TRecord
{
    const TABLENAME  = 'pessoa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   = 'serial';

    /**
     * Constructor
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo');
        parent::addAttribute('nome_completo');
        parent::addAttribute('razao_social');
        parent::addAttribute('cpf');
        parent::addAttribute('cnpj');
        parent::addAttribute('email');
        parent::addAttribute('telefone');
        parent::addAttribute('endereco_completo');
        parent::addAttribute('cidade');
        parent::addAttribute('estado');
        parent::addAttribute('cep');
        parent::addAttribute('data_cadastro');
    }
}
