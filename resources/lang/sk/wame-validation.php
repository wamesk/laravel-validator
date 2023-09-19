<?php

return [
    "validation" => "{1} Validácia má :count chybu|[2,4] Validácia má :count chyby|[5,*] Validácia má :count chýb",

    "exists" => "Enita s týmto parametrom :attribute neexistuje",
    "soft_deleted" => "Enita s týmto parametrom :attribute bola vymazaná",

    "integer" => "Parameter :attribute musí byť integer.",
    "string" => "Parameter :attribute musí byť string.",
    "array" => "Parameter :attribute musí byť pole.",
    "email" => "Parameter :attribute musí byť email v správnom tvare.",

    "dns" => [
      "mx" => [
          "exist" => "Doména :domain nie je platná.",
          "disabled" => "Doména :domain nie je povolená."
      ]
    ],

    "min" => [
        "array" => "Parameter :attribute musí byť minimálne :min položiek.",
        "file" => "Parameter :attribute musí byť minimálne :min kilobytov.",
        "numeric" => "Parameter :attribute musí byť minimálne :min.",
        "string" => "Parameter :attribute musí mať minimálne :min znakov.",
    ],

    "max" => [
        "array" => "Parameter :attribute môže byť maximálne :max položiek.",
        "file" => "Parameter :attribute môže byť maximálne :max kilobytes.",
        "numeric" => "Parameter :attribute môže byť maximálne :max.",
        "string" => "Parameter :attribute môže mať maximálne :max znakov.",
    ],
];
