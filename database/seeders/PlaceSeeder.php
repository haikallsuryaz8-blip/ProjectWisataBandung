<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Place::create([
            'name' => 'Gunung Tangkuban Perahu',
            'description' => 'Gunung berapi aktif yang terkenal dengan kawahnya yang indah. Tempat yang sempurna untuk hiking, menikmati pemandangan alam, dan menjelajahi berbagai kawah yang mengesankan. Suasana sejuk dan asri membuat tempat ini ideal untuk liburan keluarga.',
            'location' => 'Lembang, Bandung',
            'category' => 'Gunung',
            'rating' => 4.8,
            'visitors' => 125000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Kawah Putih',
            'description' => 'Danau kawah dengan air berwarna putih kehijauan yang unik dan memukau. Dikelilingi oleh hutan pinus yang sejuk dan menyegarkan. Objek wisata yang populer dengan pemandangan alam yang spektakuler, cocok untuk fotografi dan relaksasi.',
            'location' => 'Ciwidey, Bandung',
            'category' => 'Danau',
            'rating' => 4.7,
            'visitors' => 98000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Taman Hutan Raya Ir. H. Djuanda',
            'description' => 'Taman hutan terbesar di Jawa Barat dengan berbagai atraksi menarik seperti camping, outbound, dan pemandangan hutan yang hijau. Memiliki area play ground, museum, dan berbagai fasilitas rekreasi untuk segala usia.',
            'location' => 'Dago Pakar, Bandung',
            'category' => 'Taman',
            'rating' => 4.5,
            'visitors' => 156000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Situ Patenggang',
            'description' => 'Situ (danau) indah dengan air jernih dan suasana tenang yang menenangkan. Cocok untuk piknik, bersantai, dan menikmati keindahan alam. Tersedia fasilitas perahu dan berbagai aktivitas air yang menyenangkan untuk pengunjung.',
            'location' => 'Ciwidey, Bandung',
            'category' => 'Danau',
            'rating' => 4.6,
            'visitors' => 87000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Curug Cimahi',
            'description' => 'Air terjun yang menyegarkan dengan debit air yang cukup besar dan pemandangan alam yang menakjubkan. Tempat yang bagus untuk berenang, trekking, dan berfoto. Air yang jernih dan sejuk membuat lokasi ini ideal untuk piknik keluarga.',
            'location' => 'Cimahi, Bandung',
            'category' => 'Air Terjun',
            'rating' => 4.4,
            'visitors' => 76000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Tebing Keraton',
            'description' => 'Tebing batu dengan pemandangan alam yang spektakuler dan menawan. Lokasi yang sempurna untuk hiking, climbing, dan fotografi. Pemandangan dari atas tebing menampilkan panorama Kota Bandung dan area sekitarnya yang indah.',
            'location' => 'Wetan, Bandung',
            'category' => 'Tebing',
            'rating' => 4.6,
            'visitors' => 65000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Cicaheum Valley',
            'description' => 'Lembah yang indah dengan alam yang masih alami dan asri. Tempat yang nyaman untuk berwisata, berpiknik, dan menikmati kesegaran udara gunung. Tersedia berbagai fasilitas wisata dan spot foto yang menarik untuk pengunjung.',
            'location' => 'Cicaheum, Bandung',
            'category' => 'Lembah',
            'rating' => 4.5,
            'visitors' => 54000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Curug Dago',
            'description' => 'Air terjun yang cantik dan indah dengan air yang jernih. Memiliki kolam alami yang sempurna untuk berenang dan bermain air. Lokasi tersembunyi ini menawarkan pengalaman alam yang segar dan menyegarkan jauh dari kebisingan kota.',
            'location' => 'Dago, Bandung',
            'category' => 'Air Terjun',
            'rating' => 4.3,
            'visitors' => 42000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Ranca Upas',
            'description' => 'Padang rumput yang luas dengan pemandangan alam yang menakjubkan dan menenangkan. Lokasi yang sempurna untuk camping, piknik keluarga, dan menikmati suasana alam yang tenang. Tersedia berbagai aktivitas outdoor yang menarik.',
            'location' => 'Ranca Upas, Bandung',
            'category' => 'Padang Rumput',
            'rating' => 4.4,
            'visitors' => 71000,
            'image' => null,
        ]);

        Place::create([
            'name' => 'Taman Strawberry Lembang',
            'description' => 'Taman buah dengan pengalaman petik langsung buah strawberry yang segar. Tempat yang cocok untuk keluarga dengan berbagai aktivitas edukatif dan menyenangkan. Selain strawberry, ada juga buah-buahan lainnya dan berbagai fasilitas wisata.',
            'location' => 'Lembang, Bandung',
            'category' => 'Perkebunan',
            'rating' => 4.5,
            'visitors' => 89000,
            'image' => null,
        ]);
    }
}
