<?php

// declare(strict_types=1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

require_once 'vendor/autoload.php';
require 'Services/ContactService.php';
require 'Services/VideoService.php';
require 'Database/db.php';

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/ping', function ($request, $response) {
        $output = ['msg' => 'RESTful API works, active and online!'];
        return $response->withJson($output, 200, JSON_PRETTY_PRINT);
    });

    $app->get('/Videos', function ($request, $response) {

        $service = new VideoService();
        $data = $service->getAllVideo();


        return $response->withJson($data, 200)
            ->withHeader('Content-type', 'application/json');
    });


    $app->post('/Videos/add', function ($request,$response){
        $json = json_decode($request->getBody());
        $sendername= $json->sendername;
        $videourl = $json->videourl;
        $timendateupload = '';

        $service = new VideoService();
        $dbs = $service->insertVideo($sendername,$videourl,$timendateupload);

        $data = array(
            "insertStatus"=> $dbs->status,
            "errorMessage"=> $dbs->error
        );
        return $response->withJson($data, 200)
        ->withHeader('Content-type', 'application/json');
    });

    $app->post('/Videos/addByForm', function ($request, $response) {

        //form data
        $json = $request->getParsedBody();
        $sendername = $json['sendername'];
        $videourl = $json['videourl'];
        $timendateupload = '';
        
        $service = new VideoService();
        $dbs = $service->insertVideo($sendername, $videourl,$timendateupload);
    
        $data = array(
            "insertStatus" => $dbs->status,
            "errorMessage" => $dbs->error
        );
    
        
        return $response->withJson($data, 200)
            ->withHeader('Content-type', 'application/json');
    });





    //PART ADY -CONTACTS

    $app->get('/Contacts', function ($request, $response) {

        $service = new ContactService();
        $data = $service->getAllContacts();


        return $response->withJson($data, 200)
            ->withHeader('Content-type', 'application/json');
    });

    $app->get('/allContacts', function ($request, $response) {

        $service = new ContactService();
        $data = $service->getAllContacts();
    
    
        return $this->view->render($response, 'home.php', $data);
    });

    $app->post('/Contacts/add', function ($request, $response) {

        //form data
        $json = json_decode($request->getBody());
        $name = $json->name;
        $phonenum = $json->phonenum;
        $email = $json->email;

        $service = new ContactService();
        $dbs = $service->insertContact($name, $phonenum, $email);

        $data = array(
            "insertStatus" => $dbs->status,
            "errorMessage" => $dbs->error
        );


        return $response->withJson($data, 200)
            ->withHeader('Content-type', 'application/json');
    });

    $app->post('/Contacts/addByForm', function ($request, $response) {

        //form data
        $json = $request->getParsedBody();
        $name = $json['name'];
        $phonenum = $json['phonenum'];
        $email = $json['email'];
        
        $service = new ContactService();
        $dbs = $service->insertContact($name, $email, $phonenum);
    
        $data = array(
            "insertStatus" => $dbs->status,
            "errorMessage" => $dbs->error
        );
    
        
        return $response->withJson($data, 200)
            ->withHeader('Content-type', 'application/json');
    });
  
};