<?php

return [
    "validation" => "{1} Validácia má :count chybu|[2,4] Validácia má :count chyby|[5,*] Validácia má :count chýb",

    "exists" => "Enita s týmto parametrom :attribute neexistuje",
    "soft_deleted" => "Enita s týmto parametrom :attribute bola vymazaná",

    "integer" => "Parameter :attribute musí byť integer.",

    "min" => [
        "numeric" => "Parameter :attribute musí byť minimálne :min.",
        "string" => "Parameter :attribute musí mať minimálne :min znakov.",
    ],

    "max" => [
        "numeric" => "Parameter :attribute môže byť maximálne :max.",
        "string" => "Parameter :attribute môže mať maximálne :max znakov.",
    ],
];
