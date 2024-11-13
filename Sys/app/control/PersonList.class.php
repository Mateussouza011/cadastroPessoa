<?php
class PersonList extends TStandardList
{
    protected $datagrid;
    protected $pageNavigation;

    public function __construct()
    {
        parent::__construct();
        
        parent::setDatabase('cadastro_pessoas');
        parent::setActiveRecord('Person');
        parent::setDefaultOrder('id', 'asc');
        
        $this->datagrid = new TDataGrid;
        
        $column_id = new TDataGridColumn('id', 'ID', 'center', '10%');
        $column_tipo = new TDataGridColumn('tipo', 'Tipo', 'left', '20%');
        $column_nome_completo = new TDataGridColumn('nome_completo', 'Nome Completo', 'left', '30%');
        $column_razao_social = new TDataGridColumn('razao_social', 'Razão Social', 'left', '30%');
        
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_tipo);
        $this->datagrid->addColumn($column_nome_completo);
        $this->datagrid->addColumn($column_razao_social);
        
        $action_edit = new TDataGridAction(['PersonForm', 'onEdit'], ['id' => '{id}']);
        $action_delete = new TDataGridAction([$this, 'onDelete'], ['id' => '{id}']);
        
        $this->datagrid->addAction($action_edit, 'Editar', 'fa:edit blue');
        $this->datagrid->addAction($action_delete, 'Excluir', 'fa:trash red');
        
        $this->datagrid->createModel();
        
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        
        $panel = new TPanelGroup('Listagem de Pessoas');
        $panel->add($this->datagrid);
        $panel->addFooter($this->pageNavigation);
        
        parent::add($panel);
    }

    public function onDelete($param)
    {
        $action = new TAction([$this, 'Delete']);
        $action->setParameters($param);
        
        new TQuestion('Deseja realmente excluir o registro?', $action);
    }

    public function Delete($param)
    {
        try
        {
            TTransaction::open('cadastro_pessoas');
            
            $person = new Person($param['id']);
            $person->delete();
            
            TTransaction::close();
            
            $this->onReload();
            new TMessage('info', 'Registro excluído com sucesso');
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
}