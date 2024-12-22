<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToProductCustomizationsAndCustomizationIdToOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // إضافة عمود status إلى جدول product_customization
        Schema::table('products', function (Blueprint $table) {
            $table->enum('status', ['pending', 'ready', 'shipped'])->default('pending');
        });

        // إضافة عمود customization_id إلى جدول order_items
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('customization_id')->nullable();
            $table->foreign('customization_id')->references('id')->on('product_customization');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // التراجع عن التعديلات في حالة الرجوع للخلف
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['customization_id']);
            $table->dropColumn('customization_id');
        });
    }
}