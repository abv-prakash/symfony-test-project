<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
	/**
	 * [numberAction description]
	 * @return [type] [description]
	 * @Route("/lucky/number")
	 */
	public function numberAction(){

		$number = rand(0,100);
		return new Response('<html><body>Lucky number: '.$number.'</body></html>');
	}

	/**
	 * [apiNumberAction description]
	 * @return [type] [description]
	 * @Route("/api/lucky/number")
	 */
	public function apiNumberAction(){

		$data = array(
				'luckyNumber' => rand(0,100), "NextNumber" => rand(101,200),
			);

		//return new Response(
		//	json_encode($data),200,array('Content-Type' => 'application/json')
		//	);
		
		return new JsonResponse($data);

	}

	/**
	 * [numberAction description]
	 * @param  [type] $count [description]
	 * @return [type]        [description]
	 * @Route("/lucky/number/{count}")
	 */
	public function numberListAction($count){

		$numbers = array();
		for ($i =0; $i < $count; $i++){
			$numbers[] = rand(0,100);
		}

		$numbersList = implode(", ", $numbers);

		$html = $this->container->get('templating')->render
		('/lucky/number.html.twig', array("luckyNumbersList" => $numbersList));

		return new Response($html);

		// return new Response("<html>
		// <head>
		// 	<title>zend_version(oid)</title>
		// </head>
		// <body>
		// Numbers List: ". $numbersList . "
		// </body>
		// </html>");


	}
}