<?php

namespace FinancialControl\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Throwable;

class MigrateVariableExpensesAndRevenuesCommand extends Command
{
/**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:variableExpensesAndRevenenues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate variables expenses and revenues data to financial transactions table';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->info('Iniciando a migração');
            DB::beginTransaction();

            $variableExpenses = DB::table('variable_expenses')->get();
            $this->info('Encontrados: '. $variableExpenses->count() .' registros de despesas para migrar');

            $variableRevenues = DB::table('variable_revenues')->get();
            $this->info('Encontrados: '. $variableRevenues->count() .' registros de receitas para migrar');

            /** @var Collection */
            $expensesToSave = $variableExpenses->map(function ($item) {
                return $this->buildFinancialTransactionFrom($item, 'expense');
            });
    
            /** @var Collection */
            $revenuesToSave = $variableRevenues->map(function ($item) {
                return $this->buildFinancialTransactionFrom($item, 'revenue');
            });
    
            $allToSave = $expensesToSave->merge($revenuesToSave);
    
            $this->info('Realizando a criação dos registros em lote.');
            DB::table('financial_transactions')->insert($allToSave->all());

            DB::commit();
            $this->info('Migração finalizada');
        } catch(Throwable $e) {
            $this->info('Erro::', $e->getMessage());

            $this->info('Realizando o rollback do banco de dados');
            DB::rollBack();
            $this->info('Rollback finalizado');
        }
    }

    private function buildFinancialTransactionFrom($variableExpenseOrRevenue, string $type): array
    {
        return [
            'type' => $type,
            'category_id' => $variableExpenseOrRevenue->category_id,
            'title' => $variableExpenseOrRevenue->title,
            'description' => $variableExpenseOrRevenue->description,
            'value' => $variableExpenseOrRevenue->value,
            'register_date' => $variableExpenseOrRevenue->register_date,
            'user_id' => $variableExpenseOrRevenue->user_id,
            'created_at' => $variableExpenseOrRevenue->created_at,
            'updated_at' => $variableExpenseOrRevenue->updated_at,
            'deleted_at' => $variableExpenseOrRevenue->deleted_at,
        ];
    }
}