<?php

use App\Models\Installment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('installment_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Installment::class, 'installment_id')->constrained()->cascadeOnDelete();
            $table->integer('installment_number');
            $table->date('due_date');
            $table->date('payment_date')->nullable();
            $table->string('payment_ref')->nullable();
            $table->integer('penalty')->default(0);
            $table->integer('rebate')->default(0);
            $table->integer('monthly_installment_paid')->default(0);
            $table->integer('monthly_principal_paid')->default(0);
            $table->integer('monthly_interest_paid')->default(0);
            $table->integer('penalty_paid')->default(0);
            $table->integer('overdue')->default(0);
            $table->integer('balance_wo_penalty')->default(0);
            $table->integer('balance_w_penalty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installment_ledgers');
    }
};
