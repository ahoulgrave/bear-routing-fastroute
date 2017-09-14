<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Class TestController
 */
class TestController {
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function testAction(Request $request): Response
    {
        return new Response(sprintf('Hello %s!', $request->get('name', 'Stranger')));
    }
}

$config = [
    'routing' => new \Bear\Routing\FastRouteAdapter([
        ['/group',[
            ['GET', '/[{name}]', [TestController::class, 'test']],
        ]],
        ['GET', '/[{name}]', [TestController::class, 'test']],
    ]),
    'service_manager' => [
        'services' => [
            TestController::class => new TestController(),
        ],
    ],
];

\Bear\App::init($config);
