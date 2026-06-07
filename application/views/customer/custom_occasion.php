<?php $this->load->view('layouts/header'); ?>

<?php
$custom = [
    'id_custom' => 3,
    'label' => 'Custom Outfit',
    'title' => 'Custom Occasion Wear',
    'desc' =>'Wujudkan outfit spesial dengan desain elegan, detail eksklusif, dan sentuhan personal untuk setiap momen berharga.',
    'hero_img' => 'custom-occasion.png',
    
    'features' => [
        [
           'icon' => 'fa-solid fa-gem',
            'text' => 'Elegant Details'
        ],
        [
            'icon' => 'fa-solid fa-ruler-combined',
            'text' => 'Custom Size'
        ],
        [
            'icon' => 'fa-solid fa-wand-magic-sparkles',
            'text' => 'Exclusive Design'
        ],
        [
            'icon' => 'fa-solid fa-champagne-glasses',
            'text' => 'Special Occasion'
        ],
    ],

    'reference_title' => 'Referensi Style Occasion Wear Yang Dapat Dicustom',

    'references' => [
        [
            'img' => 'custom-occasion-1.png',
            'name' =>'Engagement Kebaya',
            'desc' =>'Kebaya elegan dengan detail modern untuk acara engagement dan intimate celebration.'
        ],

        [
            'img' => 'custom-occasion-4.png',
            'name' => 'Formal Elegant Dress',
            'desc' => 'Dress formal dengan siluet mewah dan tampilan anggun untuk wedding guest maupun gala.'
        ],

        [
            'img' => 'custom-occasion-3.png',
            'name' => 'Graduation Outfit',
            'desc' => 'Outfit wisuda modern dan classy yang dirancang untuk tampil elegan di hari spesialmu.'
        ],

        [
            'img' => 'custom-occasion-2.png',
            'name' => 'Bridesmaid Dress',
            'desc' => 'Gaun bridesmaid serasi dengan pilihan warna dan desain yang dapat disesuaikan.'
        ],
    ],

    'fabric_title' => 'Pilihan Bahan Occasion Outfit',

    'fabric_desc' => 'Pilih bahan yang nyaman, rapi, dan sesuai dengan kebutuhan dan memberi kesan profesional.',

    'fabrics' => [
            [
                'img' => 'bahan_silk.png'
            ],
            [
                'img' => 'bahan_brokat.png'
            ],
            [
                'img' => 'bahan_organza.png'
            ],
            [
                'img' => 'bahan_tulle.png'
            ],
    ],

     'price_list' => [
        [
            'fabric' => 'Silk Satin Premium',
            's' => 'IDR 420.000',
            'm' => 'IDR 460.000',
            'l' => 'IDR 510.000',
            'xl' => 'IDR 560.000'
        ],

        [
            'fabric' => 'Brokat Premium',
            's' => 'IDR 500.000',
            'm' => 'IDR 560.000',
            'l' => 'IDR 620.000',
            'xl' => 'IDR 690.000'
        ],
        [
            'fabric' => 'Organza',
            's' => 'IDR 450.000',
            'm' => 'IDR 490.000',
            'l' => 'IDR 540.000',
            'xl' => 'IDR 590.000'
        ],
         [
            'fabric' => 'Tulle Premium',
            's' => 'IDR 350.000',
            'm' => 'IDR 390.000',
            'l' => 'IDR 430.000',
            'xl' => 'IDR 470.000'
        ],
        ],
    ];
?>

<?php $this->load->view('customer/partials/custom_detail', ['custom' => $custom]); ?>

<?php $this->load->view('layouts/footer'); ?>