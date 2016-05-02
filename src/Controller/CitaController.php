<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 18/03/16
 * Time: 13:23
 */
namespace Aoa\Controller;

use Aoa\Service\CitaServiceInterface;
use Aoa\Transformer\CitaTransformer;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CitaControllerFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class CitaController extends AbstractController
{
    /**
     * @var CitaServiceInterface
     */
    private $citaService;
    /**
     * @var FractalManager
     */
    private $fractalManager;

    public function __construct(CitaServiceInterface $citaService, FractalManager $fractalManager)
    {
        $this->citaService = $citaService;
        $this->fractalManager = $fractalManager;
    }

    /**
     * Get all citas
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

            // Get params
            $order = [];
            if (isset($args['order'])) {
                $order = [$args['order'] => 'ASC'];
            }
            $citas = $this->citaService->findAll($order);

            $resource = new Collection($citas, new CitaTransformer());

            $responseBody = $this->fractalManager->createData($resource)->toArray()['data'];

        } catch (\Exception $e) {
            $responseBody = ['error' => 'UNKNOWN_ERROR'];
            $responseStatus = 500;

            $this->logger->error('{method} Unknown error ocurred getting citas. Exception: {exception}', [
                'method' => __METHOD__,
                'exception' => $e
            ]);
        } finally {
            return $response->withJson($responseBody, $responseStatus);
        }
    }

    /**
     * Get one cita by id
     *
     * @param ServerRequestInterface|Request $request
     * @param ResponseInterface|Response $response
     * @param array $args
     * @return ResponseInterface|static
     */
    public function getById(Request $request, Response $response, array $args)
    {
        $responseBody = [];
        $responseStatus = 200;

        try {

            $cita = $this->citaService->findOneById($args['id']);

            $resource = new Item($cita, new CitaTransformer());

            $responseBody = $this->fractalManager->createData($resource)->toArray()['data'];

        } catch (\Exception $e) {
            $responseBody = ['error' => 'UNKNOWN_ERROR'];
            $responseStatus = 500;

            $this->logger->error('{method} Unknown error ocurred getting cita by id. Exception: {exception}', [
                'method' => __METHOD__,
                'exception' => $e
            ]);
        } finally {
            return $response->withJson($responseBody, $responseStatus);
        }
    }
}
