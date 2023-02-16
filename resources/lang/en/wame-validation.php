<?php

return [
    "validation" => "{1} Validation has :count error|[2,*] Validation has :count errors",

    "exists" => "Entity with this :attribute doesn't exist",
    "soft_deleted" => "Entity with this :attribute was deleted",

    "integer" => "The :attribute must be an integer.",

    "min" => [
        "numeric" => "The :attribute must be at least :min.",
        "string" => "The :attribute must be at least :min characters.",
    ],

    "max" => [
        "numeric" => "The :attribute must not be greater than :max.",
        "string" => "The :attribute must not be greater than :max characters.",
    ],
];
