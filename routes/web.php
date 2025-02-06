<?php
// all web routes goes here
$router->get('/dd', 'app/Controllers/Web/Dashboard/DdController')->only('auth');
