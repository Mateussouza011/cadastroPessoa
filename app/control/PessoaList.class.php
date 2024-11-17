<?php
/**
 * PessoaList
 */
class PessoaList extends TPage
{
    protected $datagrid; // Datagrid
    protected $pageNavigation; // Pagination

    use Adianti\Base\AdiantiStandardListTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setDatabase('my_database'); // Nome do banco de dados
        $this->setActiveRecord('Pessoa'); // Classe Active Record
        $this->setDefaultOrder('id', 'asc'); // Ordenação padrão

        // Criação do Datagrid
        $this->datagrid = new TDataGrid;

        // Colunas do Datagrid
        $col_id = new TDataGridColumn('id', 'ID', 'center', '10%');
        $col_tipo = new TDataGridColumn('tipo', 'Tipo', 'center', '15%');
        $col_nome_completo = new TDataGridColumn('nome_completo', 'Nome Completo', 'left', '20%');
        $col_razao_social = new TDataGridColumn('razao_social', 'Razão Social', 'left', '20%');
        $col_email = new TDataGridColumn('email', 'Email', 'left', '20%');
        $col_telefone = new TDataGridColumn('telefone', 'Telefone', 'center', '15%');

        // Adiciona as colunas ao datagrid
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_tipo);
        $this->datagrid->addColumn($col_nome_completo);
        $this->datagrid->addColumn($col_razao_social);
        $this->datagrid->addColumn($col_email);
        $this->datagrid->addColumn($col_telefone);

        // Ações do Datagrid
        $actionEdit = new TDataGridAction(['PessoaForm', 'onEdit'], ['id' => '{id}']);
        $actionDelete = new TDataGridAction([$this, 'onDelete'], ['id' => '{id}']);

        $this->datagrid->addAction($actionEdit, 'Editar', 'fa:edit blue');
        $this->datagrid->addAction($actionDelete, 'Excluir', 'fa:trash red');

        // Criar o model do datagrid
        $this->datagrid->createModel();

        // Adiciona paginação
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));

        // Container
        $panel = new TPanelGroup('Listagem de Pessoas');
        $panel->add($this->datagrid);
        $panel->addFooter($this->pageNavigation);

        parent::add($panel);
    }

    /**
     * Delete a record
     */
    public function onDelete($param)
    {
        $action = new TAction([$this, 'Delete']);
        $action->setParameters($param); // Pass parameters to the delete function

        new TQuestion('Deseja realmente excluir o registro?', $action);
    }

    public function Delete($param)
    {
        try {
            TTransaction::open('my_database');
            $pessoa = Pessoa::find($param['id']);

            if ($pessoa) {
                $pessoa->delete();
            }

            TTransaction::close();
            $this->onReload();
            new TMessage('info', 'Registro excluído com sucesso');
        } catch (Exception $e) {
            TTransaction::rollback();
            new TMessage('error', $e->getMessage());
        }
    }
}
