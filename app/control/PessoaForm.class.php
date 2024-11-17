<?php
/**
 * PessoaForm
 */
class PessoaForm extends TPage
{
    protected $form;

    use Adianti\Base\AdiantiStandardFormTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setDatabase(database: 'sistema_pessoas');  // Nome do banco de dados
        $this->setActiveRecord('Pessoa');  // Classe Active Record

        $this->form = new BootstrapFormBuilder('form_Pessoa');
        $this->form->setFormTitle('Cadastro de Pessoa');

        // Campos
        $id               = new TEntry('id');
        $tipo             = new TRadioGroup('tipo');
        $nome_completo    = new TEntry('nome_completo');
        $razao_social     = new TEntry('razao_social');
        $cpf              = new TEntry('cpf');
        $cnpj             = new TEntry('cnpj');
        $email            = new TEntry('email');
        $telefone         = new TEntry('telefone');
        $endereco_completo= new TEntry('endereco_completo');
        $cidade           = new TEntry('cidade');
        $estado           = new TCombo('estado');
        $cep              = new TEntry('cep');

        $id->setEditable(false);

        // Configuração dos campos
        $tipo->addItems(['Físico' => 'Pessoa Física', 'Jurídico' => 'Pessoa Jurídica']);
        $tipo->setLayout('horizontal');
        $estado->addItems([
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        ]);

        // Validações
        $tipo->addValidation('Tipo', new TRequiredValidator);
        $nome_completo->addValidation('Nome Completo', new TRequiredValidator);
        $email->addValidation('Email', new TEmailValidator);

        // Máscaras
        $cpf->setMask('000.000.000-00');
        $cnpj->setMask('00.000.000/0000-00');
        $cep->setMask('00000-000');

        // Ações do formulário
        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addAction('Novo', new TAction([$this, 'onEdit']), 'fa:plus blue');

        // Layout
        $this->form->addFields([new TLabel('Tipo')], [$tipo]);
        $this->form->addFields([new TLabel('Nome Completo')], [$nome_completo]);
        $this->form->addFields([new TLabel('Razão Social')], [$razao_social]);
        $this->form->addFields([new TLabel('CPF')], [$cpf]);
        $this->form->addFields([new TLabel('CNPJ')], [$cnpj]);
        $this->form->addFields([new TLabel('Email')], [$email]);
        $this->form->addFields([new TLabel('Telefone')], [$telefone]);
        $this->form->addFields([new TLabel('Endereço Completo')], [$endereco_completo]);
        $this->form->addFields([new TLabel('Cidade')], [$cidade]);
        $this->form->addFields([new TLabel('Estado')], [$estado]);
        $this->form->addFields([new TLabel('CEP')], [$cep]);

        parent::add($this->form);
    }
}
