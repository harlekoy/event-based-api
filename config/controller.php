<?php

return [
    'pre' => [
        'POST' => ['creating', 'saving'],
        'PATCH' => ['updating', 'saving'],
        'DELETE' => ['deleting'],
    ],
    'post' => [
        'POST' => ['created', 'saved'],
        'PATCH' => ['updated', 'saved'],
        'DELETE' => ['deleted'],
    ],
];