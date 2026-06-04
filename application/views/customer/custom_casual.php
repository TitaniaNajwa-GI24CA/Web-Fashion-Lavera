<?php $this->load->view('layouts/header'); ?>

<?php
$custom = [
    'label' => 'Custom Outfit',
    'title' => 'Custom Casual Wear',
    'desc' => 'Buat outfit casual custom yang nyaman, stylish, dan cocok untuk komunitas, kampus, brand, maupun kebutuhan seragam santai.',
    'hero_img' => 'custom-casual.png',

    'features' => [
        [
            'icon' => 'fa-solid fa-shirt',
            'text' => 'Casual Style'
        ],
        [
            'icon' => 'fa-solid fa-ruler-combined',
            'text' => 'Custom Size'
        ],
        [
            'icon' => 'fa-solid fa-pen-ruler',
            'text' => 'Custom Design'
        ],
        [
            'icon' => 'fa-solid fa-layer-group',
            'text' => 'Premium Fabric'
        ],
    ],

    'reference_title' => 'Referensi Style Casual Wear Yang Dapat Dicustom',

    'references' => [
        [
            'img' => 'custom-casual-1.png',
            'name' => 'Custom Jacket',
            'desc' => 'Jaket custom dengan desain stylish untuk komunitas, kampus, maupun brand.'
        ],
        [
            'img' => 'custom-casual-2.png',
            'name' => 'Custom T-Shirt',
            'desc' => 'T-shirt custom yang ringan, nyaman, dan cocok untuk kebutuhan harian maupun promosi.'
        ],
        [
            'img' => 'custom-casual-3.png',
            'name' => 'Custom Polo',
            'desc' => 'Polo shirt rapi dan casual, cocok untuk seragam komunitas atau event.'
        ],
        [
            'img' => 'custom-casual-4.png',
            'name' => 'Custom Hoodie',
            'desc' => 'Hoodie nyaman dengan detail desain, warna, dan logo yang bisa disesuaikan.'
        ],
    ],

    'fabric_title' => 'Pilihan Bahan Casual Outfit',

    'fabric_desc' => 'Pilih bahan yang nyaman, kuat, dan sesuai untuk kebutuhan casual wear custom.',

    'fabrics' => [
        [
            'img' => 'bahan_canvas.png'
        ],
        [
            'img' => 'bahan_fleece.png'
        ],
        [
            'img' => 'bahan_pique.png'
        ],
        [
            'img' => 'bahan_cotton.png'
        ],
    ],

    'price_list' => [
        [
            'fabric' => 'Canvas Premium',
            's' => 'IDR 220.000',
            'm' => 'IDR 250.000',
            'l' => 'IDR 280.000',
            'xl' => 'IDR 315.000'
        ],
        [
            'fabric' => 'Fleece Premium',
            's' => 'IDR 210.000',
            'm' => 'IDR 240.000',
            'l' => 'IDR 275.000',
            'xl' => 'IDR 310.000'
        ],
        [
            'fabric' => 'Pique Cotton Premium',
            's' => 'IDR 145.000',
            'm' => 'IDR 165.000',
            'l' => 'IDR 185.000',
            'xl' => 'IDR 210.000'
        ],
        [
            'fabric' => 'Cotton Combed Premium',
            's' => 'IDR 120.000',
            'm' => 'IDR 140.000',
            'l' => 'IDR 160.000',
            'xl' => 'IDR 185.000'
        ],
    ],
];
?>

<?php $this->load->view('customer/partials/custom_detail', ['custom' => $custom]); ?>

<?php $this->load->view('layouts/footer'); ?>