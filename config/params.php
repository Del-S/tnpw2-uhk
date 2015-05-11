<?php

return [
    'adminEmail' => 'david@sucharda.cz',
    'postMetaForm' => [
        'SEO Informace' => [
            'seo_title' => ['type' => 'text', 'label' => 'SEO titulek' ],
            'seo_keywords' => ['type' => 'text', 'label' => 'SEO klíčová slova' ],
            'seo_description' => ['type' => 'textarea', 'label' => 'SEO popis' ],
        ]
    ],
    'menuSettings' => [
        ['label' => 'Úvod', 'url' => ['/index']],
        ['label' => 'Novinky', 'url' => ['category/novinky']],
        ['label' => 'Zajímavosti', 'url' => ['category/zajimavosti']],
        ['label' => 'Soutěže', 'url' => ['category/souteze']],
        ['label' => 'Akce', 'url' => ['category/akce']],
        ['label' => 'O nás', 'url' => ['post/o-nas']],
        ['label' => 'Kontakty', 'url' => ['post/kontakty']],
    ],
    'menuFooterSettings' => [
        ['label' => 'Úvod', 'url' => ['/index']],
        ['label' => 'O nás', 'url' => ['post/o-nas']],
        ['label' => 'Kontakty', 'url' => ['post/kontakty']],
    ],
    'webName' => 'Blog',
    'sidebar' => [
        'enabled' => true,
        'widgets' => [
            'category' => 'Kategorie',
        ]
    ],
    'recentPosts' => 10,
    'categoryPosts' => 3,
    'sliderPosts' => false, 
    'sliderImages' => [
        '1' => [
            'url' => '/tnpw2/web/uploads/beautiful_nature_landscape_05_hd_picture.jpg',
            'label' => 'Slider image 1',
        ],
        '2' => [
            'url' => '/tnpw2/web/uploads/slider2.jpg',
            'label' => 'Slider image 2',
        ],
        '3' => [
            'url' => '/tnpw2/web/uploads/beautiful_nature_landscape_05_hd_picture.jpg',
            'label' => 'Slider image 3',
        ],
    ],
];
