<?php $this->load->view('layouts/header'); ?>

<?php
$custom = [
    'id_custom' => 1,
    'label' => 'Custom Outfit',
    'title' => 'Custom Family Uniform',
    'desc' => 'Wujudkan pakaian keluarga yang serasi, sopan, nyaman, dan elegan untuk berbagai momen spesial.',
    'hero_img' => 'custom-family.png',

    'features' => [
        [
            'icon' => 'fa-solid fa-palette',
            'text' => 'Pilihan Warna'
        ],
        [
            'icon' => 'fa-solid fa-ruler',
            'text' => 'Ukuran Custom'
        ],
        [
            'icon' => 'fa-solid fa-people-roof',
            'text' => 'Couple Family'
        ],
        [
            'icon' => 'fa-solid fa-scissors',
            'text' => 'Desain Eksklusif'
        ],
    ],

    'reference_title' => 'Referensi Style Family Outfit Yang Dapat Dicustom',

    'references' => [
        [
            'name' => 'Ied Outfit',
            'desc' => 'Busana keluarga serasi untuk hari raya dengan tampilan sopan dan hangat.',
            'img' => 'custom-family-1.png'
        ],
        [
            'name' => 'Kondangan Outfit',
            'desc' => 'Setelan keluarga untuk menghadiri acara pernikahan atau pesta formal.',
            'img' => 'custom-family-4.png'
        ],
        [
            'name' => 'Formal Outfit',
            'desc' => 'Tampilan keluarga rapi dan elegan untuk acara resmi atau foto keluarga.',
            'img' => 'custom-family-2.png'
        ],
        [
            'name' => 'Batik / Kebaya Outfit',
            'desc' => 'Paduan batik dan kebaya modern untuk keluarga yang tetap sopan dan berkelas.',
            'img' => 'custom-family-3.png'
        ],
    ],

    'fabric_title' => 'Pilihan Bahan Family Outfit',

    'fabric_desc' => 'Pilih bahan yang nyaman, rapi, dan sesuai dengan kebutuhan acara keluarga spesial.',

    'fabrics' => [
            [
                'img' => 'bahan_katun.png'
            ],
            [
                'img' => 'bahan_linen.png'
            ],
            [
                'img' => 'bahan_batik.png'
            ],
            [
                'img' => 'bahan_maxmara.png'
            ],
    ],

    'price_list' => [
        [
            'fabric' => 'Katun Premium',
            's' => 'IDR 180.000',
            'm' => 'IDR 200.000',
            'l' => 'IDR 225.000',
            'xl' => 'IDR 250.000'
        ],
        [
            'fabric' => 'Linen',
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
            'fabric' => 'Maxmara',
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