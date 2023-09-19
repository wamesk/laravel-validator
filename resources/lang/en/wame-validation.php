<?php

return [
    "validation" => "{1} Validation has :count error|[2,*] Validation has :count errors",

    "exists" => "Entity with this :attribute doesn't exist",
    "soft_deleted" => "Entity with this :attribute was deleted",

    "integer" => "The :attribute must be an integer.",
    "string" => "The :attribute must be a string.",
    "array" => "The :attribute must be an array.",
    "email" => "The :attribute parameter must be email in the correct format.",

    "min" => [
        "array" => "The :attribute must have at least :min items.",
        "file" => "The :attribute must be at least :min kilobytes.",
        "numeric" => "The :attribute must be at least :min.",
        "string" => "The :attribute must be at least :min characters.",
    ],

    "max" => [
        "array" => "The :attribute must not have more than :max items.",
        "file" => "The :attribute must not be greater than :max kilobytes.",
        "numeric" => "The :attribute must not be greater than :max.",
        "string" => "The :attribute must not be greater than :max characters.",
    ],
];
