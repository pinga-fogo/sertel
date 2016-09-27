<?php

use Illuminate\Database\Seeder;

class RamalSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $master = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'User',
            'class' => 'master'
        ]);

        $technology = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'Tecnologia',
            'class' => 'type'
        ]);

        /* technology */

        $arr_ids = [];

        $children = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'SIP',
            'parent_id' => $technology->id,
            'class' => 'subtype'
        ]);

        $arr_ids[] = $children->id;

        $children = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'IAX2',
            'parent_id' => $technology->id,
            'class' => 'subtype'
        ]);

        $arr_ids[] = $children->id;

        $children = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'SIP&IAX2',
            'parent_id' => $technology->id,
            'class' => 'subtype'
        ]);

        $arr_ids[] = $children->id;

        $children = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'FXS',
            'parent_id' => $technology->id,
            'class' => 'subtype'
        ]);

        $arr_ids[] = $children->id;

        $children = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'PBX-LEGADO',
            'parent_id' => $technology->id,
            'class' => 'subtype'
        ]);

        $arr_ids[] = $children->id;

        foreach($arr_ids as $tec_id){

            /* application */
            $children = factory(\App\Models\RamalSetting::class)->create([
                'name' => 'PABX',
                'parent_id' => $tec_id,
                'form_key' => 'form_pabx',
                'class' => 'subtype'
            ]);


            $children = factory(\App\Models\RamalSetting::class)->create([
                'name' => 'DAC',
                'parent_id' => $tec_id,
                'class' => 'subtype'
            ]);
            $children = factory(\App\Models\RamalSetting::class)->create([
                'name' => 'URA',
                'parent_id' => $tec_id,
                'class' => 'subtype'
            ]);
            $children = factory(\App\Models\RamalSetting::class)->create([
                'name' => 'DISA',
                'parent_id' => $tec_id,
                'class' => 'subtype'
            ]);
            $children = factory(\App\Models\RamalSetting::class)->create([
                'name' => 'FAX',
                'parent_id' => $tec_id,
                'class' => 'subtype'
            ]);
            $children = factory(\App\Models\RamalSetting::class)->create([
                'name' => 'PORTEIRO',
                'parent_id' => $tec_id,
                'class' => 'subtype'
            ]);



        }

        $application = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'Aplicação',
            'class' => 'type'
        ]);

        $master = factory(\App\Models\RamalSetting::class)->create([
            'name' => 'Tronco',
            'class' => 'master'
        ]);




    }
}
