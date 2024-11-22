<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontpageHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landingpagecms', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('userid');
            $table->text('tabfaviconfile');
            $table->text('faviconfile');
            $table->text('bannerimage');
            $table->text('description');
            $table->text('playstoreicon1');
            $table->text('playstoreicon2');
            $table->text('firstrowimage1');
            $table->text('firstrowheadtext1');
            $table->text('firstrowsubtext1');
            $table->text('firstrowimage2');
            $table->text('firstrowheadtext2');
            $table->text('firstrowsubtext2');
            $table->text('firstrowimage3');
            $table->text('firstrowheadtext3');
            $table->text('firstrowsubtext3');
            $table->text('secondrowimage1');
            $table->text('secondrowheadtext1');
            $table->text('secondrowimage2');
            $table->text('secondrowheadtext2');
            $table->text('secondrowimage3');
            $table->text('secondrowheadtext3');
            $table->text('footertextsub');
            $table->text('footercopytextsub');
            $table->text('footerlogo');
            $table->text('footerinstagramlink');
            $table->text('footerfacebooklink');
            $table->text('safety');
            $table->longText('safetytext');
            $table->text('serviceheadtext');
            $table->text('servicesubtext');
            $table->longText('serviceimage');
            $table->longText('privacy');
            $table->longText('dmv');
            $table->longText('complaince');
            $table->longText('terms');
            $table->text('frimage');
            $table->longText('frtext');
            $table->text('srimage');
            $table->longText('srtext');
            $table->text('trimage');
            $table->longText('trtext');
            $table->text('afrimage');
            $table->text('afrhtext');
            $table->text('afrstext');
            $table->text('asrtext');
            $table->text('asrimage1');
            $table->text('asrhtext1');
            $table->text('asrstext1');
            $table->text('asrimage2');
            $table->text('asrhtext2');
            $table->text('asrstext2');
            $table->text('asrimage3');
            $table->text('asrhtext3');
            $table->text('asrstext3');
            $table->text('atrhtext');
            $table->text('atrthtext1');
            $table->text('atrtimage1');
            $table->text('atrtstext1');
            $table->text('atrthtext2');
            $table->text('atrtimage2');
            $table->text('atrtstext2');
            $table->text('atrthtext3');
            $table->text('atrtimage3');
            $table->text('atrtstext3');
            $table->text('afrbimage');
            $table->text('afrlimage');
            $table->text('afrheadtext');
            $table->text('afrstext1');
            $table->text('afrstext2');
            $table->text('afrstext3');
            $table->text('afrstext4');
            $table->text('howbannerimage');
            $table->text('hfrht1');
            $table->text('hfrcimage1');
            $table->text('hfrht2');
            $table->text('hsrht1');
            $table->text('hsrcimage1');
            $table->text('hsrht2');
            $table->text('htrht1');
            $table->text('htrcimage1');
            $table->text('htrht2');
            $table->text('hforht1');
            $table->text('hforcimage1');
            $table->text('hforht2');
            $table->text('hfirht1');
            $table->text('hfircimage1');
            $table->text('hfirht2');
            $table->text('hsirht1');
            $table->text('hsircimage1');
            $table->text('hsirht2');
            $table->text('hserht1');
            $table->text('hsercimage1');
            $table->text('hserht2');
            $table->date('created_at');
            $table->date('updated_at');
            $table->Text('contactbanner');
            $table->longText('contacttext');
            $table->longText('contactmap');
            $table->Text('driverioslink');
            $table->Text('driverandroidlink');
            $table->Text('userioslink');
            $table->Text('userandroidlink');
            $table->Text('menucolor');
            $table->Text('menutextcolor');
            $table->Text('menutexthover');
            $table->Text('firstrowbgcolor');
            $table->Text('hdriverdownloadcolor');
            $table->Text('hownumberbgcolor');
            $table->Text('footerbgcolor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landingpagecms');
    }
}
