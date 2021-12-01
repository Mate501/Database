<?php

use Petrik\Simpleplayer\Zene;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app){
    $app->get('/Zenek',function(Request $request, Response $response){
        $Zenek = Zene::all();
        $kimenet = $Zenek->toJson();

        $response ->getBody()->write($kimenet);
        return $response->withHeader('Content-type','application/json');
    });

    $app->post('/Zenek',function(Request $request, Response $response){
        $input = json_decode($request->getBody(),true);
        $Zene = Zene::create($input);
        $Zene->save();

        $kimenet = $Zene->toJson();

        $response->getBody()->write($kimenet);

        return $response
        ->withStatus(201)
        ->withHeader('Content-type','application/json');
    });

    $app->delete('/Zenek/{id}', function(Request $request, Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész számnak kell legyen!']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);

        }
        $Zene = Zene::find($args['id']);
        if ($Zene === null) {
            $ki = json_encode(['error' => 'Nincsen ilyen ID-jű Zene']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $Zene->delete();
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(204);
    });
    $app->put('/Zenek/{id}',function(Request $request,Response $response,array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész számnak kell legyen!']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);

        }
        $Zene = Zene::find($args['id']);
        if ($Zene === null) {
            $ki = json_encode(['error' => 'Nincsen ilyen ID-jű Zene']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $input = json_decode($request->getBody(),true);
        $Zene->fill($input);
        $Zene->save();
        $response->getBody()->write($Zene->toJson());
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
    });

    $app->get('/Zenek/{id}',function(Request $request,Response $response,array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész számnak kell legyen!']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);

        }
        $Zene = Zene::find($args['id']);
        if ($Zene === null) {
            $ki = json_encode(['error' => 'Nincsen ilyen ID-jű Zene']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $response->getBody()->write($Zene->toJson());
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
    });
};