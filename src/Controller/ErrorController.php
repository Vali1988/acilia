<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends BaseController
{
	public function showAction(Request $request,  $exception)
	{
		$statusCode = (method_exists($exception, 'getStatusCode')) ?
			$exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
		$data = [
			'message' => $exception->getMessage(),
			'code' => $statusCode
		];

		$view = $this->view($data, $statusCode);
		$view->getContext()->enableMaxDepth();
		return $this->handleView($view);
	}
}