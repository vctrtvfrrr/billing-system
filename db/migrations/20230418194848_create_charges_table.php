<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateChargesTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up(): void
    {
        $table = $this->table('charges');

        $table
            ->addColumn('debt_id', 'integer', ['signed' => false])
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('government_id', 'string', ['limit' => 11])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('debt_amount', 'decimal', ['precision' => 2, 'signed' => false])
            ->addColumn('debt_due_date', 'date')
            ->addTimestamps()
            ->create()
        ;
    }

    /**
     * Migrate Down.
     */
    public function down(): void
    {
        $table = $this->table('charges')->drop();
        $table->save();
    }
}
