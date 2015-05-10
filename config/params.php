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
];
