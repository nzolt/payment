<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'PNY CS900 2.5" Internal SSD - 240 GB',
                'group' => 'ssd',
                'size' => '240 GB',
                'price' => 26.00,
                'info' => ['SATA III', 'Up to 6 Gbps', 'Read speed: up to 535 MB/s', 'Write speed: up to 500 MB/s'],
            ],
            [
                'name' => 'PNY CS900 2.5" Internal SSD - 500 GB',
                'group' => 'ssd',
                'size' => '500 GB',
                'price' => 38.00,
                'info' => ['SATA III', 'Up to 6 Gbps', 'Read speed: up to 535 MB/s', 'Write speed: up to 500 MB/s'],
            ],
            [
                'name' => 'SAMSUNG EVO 860 2.5" Internal SSD - 250 GB',
                'group' => 'ssd',
                'size' => '250 GB',
                'price' => 39.00,
                'info' => ['SATA III', 'Up to 6 Gbps', 'Hardware encryption', 'Read speed: up to 550 MB/s', 'Write speed: up to 525 MB/s'],
            ],
            [
                'name' => 'SAMSUNG EVO 860 2.5" Internal SSD - 500 GB',
                'group' => 'ssd',
                'size' => '500 GB',
                'price' => 46.00,
                'info' => ['SATA III', 'Up to 6 Gbps', 'Hardware encryption', 'Read speed: up to 550 MB/s', 'Write speed: up to 525 MB/s',],
            ],
            [
                'name' => 'SAMSUNG 970 Evo Plus M.2 Internal SSD - 250 GB',
                'group' => 'ssd',
                'size' => '250 GB',
                'price' => 43.00,
                'info' => ['PCIe 3.0', 'Hardware encryption', 'Read speed: up to 3500 MB/s', 'Write speed: up to 2300 MB/s'],
            ],
            [
                'name' => 'INTEL Core™ i7-10700K Unlocked Processor',
                'group' => 'cpu',
                'architecture' => 'intel',
                'price' => 329.00,
                'info' => ['Socket: LGA 1200', 'Frequency: 3.8 GHz overclockable', 'Turbo Boost: 5.1 GHz', 'Octa-core', 'Cache: 16 MB',]
            ],
            [
                'name' => 'AMD Ryzen 7 3700X Processor',
                'architecture' => 'amd',
                'group' => 'cpu',
                'price' => 299.00,
                'info' => ['Includes RGB CPU cooler', 'Socket: AM4', 'Frequency: 3.6 GHz', 'Turbo Core: 4.4 GHz', 'Octa-core']
            ],
            [
                'name' => 'M100 Fibre Broadband',
                'group' => 'internet',
                'subscription' => true,
                'month contract' => 18,
                'price' => 29.00,
                'info' => ['Average download speeds of 108Mbps', 'Average upload speeds of 10Mbps', 'For busy households with 5-9 devices']
            ],
            [
                'name' => 'M200 Fibre Broadband',
                'group' => 'internet',
                'subscription' => true,
                'month contract' => 18,
                'price' => 35.00,
                'info' => ['Average download speeds of 213Mbps', 'Average upload speeds of 20Mbps', 'For busy households with 10+ devices']
            ]
        ];

        foreach($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
