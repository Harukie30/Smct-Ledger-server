<?php

use App\Models\Installment;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Location::class, "location_id")->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Installment::class, "installment_id")->constrained()->cascadeOnDelete();
            $table->date("payment_date");
            $table->string("document_number")->unique();
            $table->string("or_number");
            $table->integer("amount");
            $table->string("customer_name");
            $table->boolean("isrebatable")->default(false);
            $table->text("memo_description")->nullable();
            $table->string("invoice_number")->nullable();
            $table->string("generic_collector")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
