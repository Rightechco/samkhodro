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
        $array = [
            'name',
            'title',
            'logo',
            'about',
            'address',
            'email',
            'fanavari',
            'etemad',
            'number',
            'number2',
            'facebook',
            'instagram',
            'twitter',
            'telegram',
            'imagePopUp',
            'titlePopUp',
            'addressPopUp',
            'popUpStatus',
            'descriptionPopUp',
            'buttonPopUp',
            'minifySource',
            'headerColor',
            'sideColor',
            'frontStatus',
            'titleSeo',
            'keyword',
            'aboutSeo',
            'h1Seo',
            'metaSeo',
            'zarinpal',
            'zibal',
            'idpay',
            'nextpay',
            'terminalBeh',
            'userBeh',
            'passwordBeh',
            'keySadad',
            'merchantSadad',
            'terminalSadad',
            'messageAuth',
            'messageSuccess',
            'messageSuggest',
            'messageCancel',
            'messageBack',
            'messageManager',
            'messageCounseling',
            'userSms',
            'passSms',
            'ghasedak',
            'kaveKey',
            'typeSms',
            'userFaraz',
            'passFaraz',
            'numberFaraz',
            'headScript',
            'bodyScript',
        ];
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('value')->nullable();
            $table->timestamps();
        });
        foreach ($array as $item) {
            DB::table('settings')->insert(
                array(
                    'key' => $item,
                    'value' => null,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
