<?php
class PersonForm extends TStandardForm
{
    protected $form;

    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder('form_person');
        $this->form->setFormTitle('Cadastro de Pessoa');
        
        $id = new TEntry('id');
        $tipo = new TCombo('tipo');
        $nome_completo = new TEntry('nome_completo');
        $razao_social = new TEntry('razao_social');
        $cpf = new TEntry('cpf');
        $cnpj = new TEntry('cnpj');
        $email = new TEntry('email');
        $telefone = new TEntry('telefone');
        $endereco_completo = new TText('endereco_completo');
        
        $tipo->addItems(['Fisico' => 'Físico', 'Juridico' => 'Jurídico']);
        
        $id->setEditable(FALSE);
        $cpf->setMask('999.999.999-99');
        $cnpj->setMask('99.999.999/9999-99');
        
        $this->form->addFields([new TLabel('ID')], [$id]);
        $this->form->addFields([new TLabel('Tipo')], [$tipo]);
        $this->form->addFields([new TLabel('Nome Completo')], [$nome_completo]);
        $this->form->addFields([new TLabel('Razão Social')], [$razao_social]);
        $this->form->addFields([new TLabel('CPF')], [$cpf]);
        $this->form->addFields([new TLabel('CNPJ')], [$cnpj]);
        $this->form->addFields([new TLabel('Email')], [$email]);
        $this->form->addFields([new TLabel('Telefone')], [$telefone]);
        $this->form->addFields([new TLabel('Endereço Completo')], [$endereco_completo]);
        
        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addAction('Limpar', new TAction([$this, 'onClear']), 'fa:eraser red');
        
        parent::setDatabase('cadastro_pessoas');
        parent::setActiveRecord('Person');
        
        $this->form->addField($id);
        $this->form->addField($tipo);
        $this->form->addField($nome_completo);
        $this->form->addField($razao_social);
        $this->form->addField($cpf);
        $this->form->addField($cnpj);
        $this->form->addField($email);
        $this->form->addField($telefone);
        $this->form->addField($endereco_completo);
        
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add($this->form);
        
        parent::add($vbox);
    }

    public function onSave($param)
    {
        try
        {
            $data = $this->form->getData();
            
            if ($data->tipo == 'Fisico' && empty($data->cpf))
            {
                throw new Exception('CPF é obrigatório para Pessoa Física');
            }
            if ($data->tipo == 'Juridico' && empty($data->cnpj))
            {
                throw new Exception('CNPJ é obrigatório para Pessoa Jurídica');
            }
            
            TTransaction::open('cadastro_pessoas');
            
            $person = new Person;
            $person->fromArray((array) $data);
            $person->store();
            
            TTransaction::close();
            
            $this->form->setData($person);
            new TMessage('info', 'Registro salvo com sucesso');
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }

    public function onClear($param)
    {
        $this->form->clear();
    }
}
?>