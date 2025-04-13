<?php

use App\Kernel;


require_once '/Users/nabyzakariatoure/Desktop/admin/appt-cmr/vendor/autoload_runtime.php';


return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
