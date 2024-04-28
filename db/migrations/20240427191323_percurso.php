<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Percurso extends AbstractMigration
{
    // migration da única tabela necessária para esta aplicação, foi utilizado o Phinx para registrar a migração e aplicar a criação da tabela e/ou alterações
    // para qualquer alteração neste arquivo, utilize o comando 'vendor/bin/phinx migrate' no terminal do windows ou 'vendor\bin\phinx migrate' no linux
    // https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
    public function change(): void
    {
        $table = $this->table('percursos');
        $table->addColumn('cep_origem', 'string')
              ->addColumn('cep_destino', 'string')
              ->addColumn('distancia_total', 'string')
              ->addColumn('criado_em', 'datetime')
              ->addColumn('editado_em', 'datetime')
              ->create();
    }
}
