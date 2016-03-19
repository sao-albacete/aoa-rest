<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 9/03/16
 * Time: 23:38
 */
namespace Aoa\Controller;

use Aoa\Service\FamiliaServiceInterface;
use Aoa\Transformer\FamiliaTransformer;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Resource\Collection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class FamiliaController
 * @author viktorKhan
 * @link https://github.com/viktorKhan
 */
class FamiliaController extends AbstractController
{
    /**
     * @var FamiliaServiceInterface
     */
    private $familiaService;
    /**
     * @var FractalManager
     */
    private $fractalManager;

    public function __construct(FamiliaServiceInterface $familiaService, FractalManager $fractalManager)
    {
        $this->familiaService = $familiaService;
        $this->fractalManager = $fractalManager;
    }

    /**
     * Get all familias
     *
     * @param ServerRequestInterface|Request $request
     * @param ResponseInterface|Response $response
     * @param array $args
     * @return ResponseInterface|static
     */
    public function getAll(Request $request, Response $response, array $args)
    {
        $responseBody = [];
        $responseStatus = 200;

        try {

            $familias = $this->familiaService->findAll();

            $resource = new Collection($familias, new FamiliaTransformer());

            $responseBody = $this->fractalManager->createData($resource)->toArray()['data'];

        } catch (\Exception $e) {
            $responseBody = ['error' => 'UNKNOWN_ERROR'];
            $responseStatus = 500;

            $this->logger->error('{method} Unknown error ocurred getting familias. Exception: {exception}', [
                'method' => __METHOD__,
                'exception' => $e
            ]);
        } finally {
            return $response->withJson($responseBody, $responseStatus);
        }
    }
}
