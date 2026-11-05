<?php

use App\Models\Location;
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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Location::class,   'location_id')->constrained()->cascadeOnDelete() ;
            $table->string('internal_id');
            $table->string('customer_name');
            $table->string('so_number')->unique();
            $table->date('purchase_date');
            $table->date('first_due_date');
            $table->integer('term');
            $table->integer('monthly_installment');
            $table->integer('monthly_principal');
            $table->integer('monthly_interest');
            $table->integer('rebate_amount');
            $table->string('item');
            $table->string('item_class');
            $table->string('total_accounts_receivable');
            $table->integer('downpayment');
            $table->integer('financed_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
