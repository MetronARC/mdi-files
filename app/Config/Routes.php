<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Main routes
$routes->get('/', 'Pages::index');
$routes->get('sop', 'Pages::sop');

// Document routes
$routes->post('document/store', 'Document::store');
$routes->get('document/list', 'Document::list');
$routes->post('document/view', 'Document::view');
$routes->post('document/delete', 'Document::delete');