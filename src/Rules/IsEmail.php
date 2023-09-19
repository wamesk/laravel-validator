<?php

namespace Wame\Validator\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Cache;

class IsEmail implements InvokableRule
{

    /** @var array  */
    protected array $blacklistedDomains = [];

    public function __construct(protected bool $domainMustExist = false, protected bool $disableTempMail = false) {
        $this->blacklistedDomains = Cache::remember('TempEmailBlackList', 60 * 10, function () {
            $data = @file_get_contents('https://gist.githubusercontent.com/saaiful/dd2b4b34a02171d7f9f0b979afe48f65/raw/2ad5590be72b69a51326b3e9d229f615e866f2e5/blocklist.txt');
            if ($data) {
                return array_filter(array_map('trim', explode("\n", $data)));
            }
            return [];
        });
    }

    public function __invoke($attribute, $value, $fail): void
    {
        // Check basic email format using regular expression
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $fail(__('wame-validation.email'));
        }

        // Split email into local part and domain
        list($localPart, $domain) = explode('@', $value);

        if ($this->disableTempMail) {
            if (in_array($domain, $this->blacklistedDomains)) {
                $fail(__('wame-validation.dns.mx.disabled', ['domain' => $domain]));
            }
        }

        if ($this->domainMustExist) {
            // Check domain existence using DNS
            if (!checkdnsrr($domain, 'MX')) {
                $fail(__('wame-validation.dns.mx.exist', ['domain' => $domain]));
            }
        }
    }
}
