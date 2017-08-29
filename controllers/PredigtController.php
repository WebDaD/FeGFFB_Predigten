<?php
declare(strict_types=1);
namespace FeGFFB\Predigten\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
class PredigtController
{
    public function getPredigt(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("This is a predigt with Slug '" . $request->getAttribute("slug") . "'!");
        return $response;
    }

    public function getPredigten(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = array(
            array(
                'slug'=>'numvber_1',
                'title' => 'Nuimber 1'
            ),
            array(
                'slug'=>'numvber_2',
                'title' => 'Nuimber 2'
            )
        );
        $response->getBody()->write(json_encode($data));
        return $response;
    }

    public function test() {
        echo "test";
        return null;
    }
}

?>