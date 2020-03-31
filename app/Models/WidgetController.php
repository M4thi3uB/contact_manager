<?php


namespace Slim\App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Psr\Log\LoggerInterface;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class WidgetController
{
    private $view;
    private $logger;
    protected $table;

    public function __construct(
        Twig $view,
        LoggerInterface $logger,
        Builder $table
    )
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->table = $table;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $widgets = $this->table->get();

        $this->view->render($response, 'app/index.twig', [
            'widgets' => $widgets
        ]);

        return $response;
    }
}