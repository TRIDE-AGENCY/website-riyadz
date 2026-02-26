<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'site_title'         => 'Riyadz Aqsha',
            'site_url'           => 'https://riyadzaqsha.com',
            'site_logo'          => 'logo.png',
            'site_favicon'       => 'favicon.png',

            'email'              => 'halo@riyadzaqsha.com',
            'instagram'          => 'https://instagram.com/riyadzaqsha',
            'linkedin'           => 'https://linkedin.com/in/riyadzaqsha',

            'meta_title'         => 'Riyadz Aqsha',
            'meta_description'   => 'Seorang Apoteker 💊 yang percaya bahwa ilmu & profesi adalah amal jariah, seorang Penulis ✍️ yang menjadikan kata sebagai jalan ibadah dan inspirasi, serta seorang Pengusaha 🤝 yang meyakini bahwa kebermanfaatan adalah inti dari setiap usaha.',
            'meta_keywords'      => 'Riyadz Aqsha, Apoteker, Penulis, Pengusaha, Apoteker Indonesia, Penulis Inspiratif, Pengusaha Muslim, Tokoh Inspiratif, Personal Branding, Amal Jariah, Edukasi, Bisnis Bermanfaat',

            'og_title'           => 'Riyadz Aqsha',
            'og_description'     => 'Seorang Apoteker 💊 yang percaya bahwa ilmu & profesi adalah amal jariah, seorang Penulis ✍️ yang menjadikan kata sebagai jalan ibadah dan inspirasi, serta seorang Pengusaha 🤝 yang meyakini bahwa kebermanfaatan adalah inti dari setiap usaha.',
            'og_image'           => 'og-image.jpg',

            'api_tinymce_key'    => 'x9rlvoood10xkxwd58t9wmyo3dns64y134pe5u7we2v6cq61',
            'ga_property_id'     => '517166003',
            'ga_measurement_id'  => 'G-1C59NEQZJ3',
        ]);
    }
}
