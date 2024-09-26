<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('domains.index', function (BreadcrumbTrail $trail) {
    $trail->push('Domains');
});
Breadcrumbs::for('domains.create', function (BreadcrumbTrail $trail) {
    $trail->parent('Domains');
    $trail->push('Create', route('domains.index'));
});

// City Breadcrumbs
Breadcrumbs::for('city.index', function (BreadcrumbTrail $trail) {
    $trail->push('City List');
});

