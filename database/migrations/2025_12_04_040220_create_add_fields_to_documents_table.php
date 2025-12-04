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
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('documents', 'document_type')) {
                $table->string('document_type')->after('user_id'); // birth_certificate or death_certificate
            }
            if (!Schema::hasColumn('documents', 'file_path')) {
                $table->string('file_path')->after('document_type');
            }
            if (!Schema::hasColumn('documents', 'status')) {
                $table->string('status')->default('pending')->after('file_path'); // pending, approved, rejected
            }
            if (!Schema::hasColumn('documents', 'data_json')) {
                $table->json('data_json')->nullable()->after('status'); // To hold resident info
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn(['user_id']);
            }
            $table->dropColumn(['document_type', 'file_path', 'status', 'data_json']);
        });
    }
};