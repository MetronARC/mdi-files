<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Main routes
$routes->get('/', 'Pages::index');
$routes->get('sop', 'Pages::sop');
$routes->get('orders', 'Pages::orders');

// Document routes
$routes->post('document/store', 'Document::store');
$routes->get('document/list', 'Document::list');
$routes->post('document/view', 'Document::view');
$routes->post('document/delete', 'Document::delete');

// Project routes
$routes->get('project/getProjectCodes', 'Project::getProjectCodes');
$routes->post('project/get-project-status', 'Project::getProjectStatus');
$routes->post('project/update-project-status', 'Project::updateProjectStatus');
$routes->post('project/get-project-details', 'Project::getProjectDetails');
$routes->post('project/getProjectDocuments', 'Project::getProjectDocuments');
$routes->post('project/viewDocument', 'Project::viewDocument');
$routes->post('project/upload-document', 'Project::uploadDocument');
$routes->post('project/create-with-document', 'Project::createProjectWithDocument');
$routes->post('project/deleteDocument', 'Project::deleteDocument');