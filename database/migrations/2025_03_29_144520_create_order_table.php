<?php

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
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->integer('vendor_id')->nullable(); 
        $table->integer('rider_id')->nullable();
        $table->decimal('total_price', 10, 2);
        $table->enum('status', ['pending', 'preparing', 'assigned', 'ready', 'pickedup', 'completed', 'canceled'])->default('pending'); 
        $table->string('payment_method')->default('cash'); 
        $table->text('delivery_address'); 
        $table->text('notes')->nullable();
        $table->string('restaurant');  
        $table->timestamp('placed_at')->useCurrent(); 
        $table->timestamps(); 
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
