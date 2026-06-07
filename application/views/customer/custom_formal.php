<?php $this->load->view('layouts/header'); ?>

<?php
$custom = [
    'id_custom' => 2,
    'label' => 'Custom Outfit',
    'title' => 'Custom Formal Wear',
    'desc' => 'Desain pakaian formal sesuai kebutuhan kantor, perusahaan, maupun acara profesional dengan sentuhan modern.',
    'hero_img' => 'custom-office.png',

    'features' => [
        [
            'icon' => 'fa-solid fa-user-tie',
            'text' => 'Professional Look'
        ],
        [
            'icon' => 'fa-solid fa-ruler-combined',
            'text' => 'Custom Size'
        ],
        [
            'icon' => 'fa-solid fa-building',
            'text' => 'Corporate Identity'
        ],
        [
            'icon' => 'fa-solid fa-scissors',
            'text' => 'Exclusive Tailoring'
        ],
    ],

    'reference_title' => 'Referensi Style Office Wear Yang Dapat Dicustom',

    'references' => [
        [
            'img' => 'custom-office-1.png',
            'name' => 'Tailored Suit',
            'desc' => 'Setelan jas modern dengan potongan rapi dan elegan untuk tampilan profesional.'
        ],

        [
            'img' => 'custom-office-2.png',
            'name' => 'Corporate Batik',
            'desc' => 'Batik custom dengan desain eksklusif untuk perusahaan atau acara formal.'
        ],

        [
            'img' => 'custom-office-3.png',
            'name' => 'Office Uniform',
            'desc' => 'Seragam kantor dengan desain modern, nyaman, dan tetap profesional.'
        ],

        [
            'img' => 'custom-office-4.png',
            'name' => 'PDH Uniform',
            'desc' => 'Pakaian dinas custom dengan detail rapi dan tampilan formal yang elegan.'
        ],
    ],

    'fabric_title' => 'Pilihan Bahan Office Outfit',

    'fabric_desc' => 'Pilih bahan yang nyaman, rapi, dan sesuai dengan kebutuhan dan memberi kesan profesional.',

    'fabrics' => [
            [
                'img' => 'bahan_wool.png'
            ],
            [
                'img' => 'bahan_tropical.png'
            ],
            [
                'img' => 'bahan_batik_2.png'
            ],
            [
                'img' => 'bahan_twill.png'
            ],
    ],

    'price_list' => [
        [
            'fabric' => 'Wool Premium',
            's' => 'IDR 180.000',
            'm' => 'IDR 200.000',
            'l' => 'IDR 225.000',
            'xl' => 'IDR 250.000'
        ],
        [
            'fabric' => 'Tropical Wool',
            's' => 'IDR 200.000',
            'm' => 'IDR 225.000',
            'l' => 'IDR 250.000',
            'xl' => 'IDR 280.000'
        ],
        [
            'fabric' => 'Batik Premium',
            's' => 'IDR 250.000',
            'm' => 'IDR 280.000',
            'l' => 'IDR 320.000',
            'xl' => 'IDR 350.000'
        ],
        [
            'fabric' => 'Microfiber Premium',
            's' => 'IDR 230.000',
            'm' => 'IDR 260.000',
            'l' => 'IDR 295.000',
            'xl' => 'IDR 325.000'
        ],
        ],
    ];
?>

<?php $this->load->view('customer/partials/custom_detail', ['custom' => $custom]); ?>

<?php $this->load->view('layouts/footer'); ?>