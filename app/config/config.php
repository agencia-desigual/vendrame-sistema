<?php

// URL base do site.
defined('BASE_URL') OR define('BASE_URL', 'http://localhost/git/vendrame-sistema/');
//defined('BASE_URL') OR define('BASE_URL', 'http://sistema.oticavendrame.com.br/');

// URL base do storange
//defined('BASE_STORAGE') OR define('BASE_STORAGE', 'http://localhost/git/vendrame-sistema/storage/');
defined('BASE_STORAGE') OR define('BASE_STORAGE', 'http://sistema.oticavendrame.com.br/storage/');

// Session | Caso deseje que a session seja iniciada em todas as páginas
// Apenas mude a constante para true.
defined("OPEN_SESSION") OR define('OPEN_SESSION', true);