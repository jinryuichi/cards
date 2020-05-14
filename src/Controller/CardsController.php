<?php
// src/Controller/ArticlesController.php
namespace App\Controller;


class CardsController extends AppController
{

    	public function index()
	{

	//	$this->viewBuilder()->setLayout('cards');

	}	

	
    	public function cards($n = null)
    	{


	$cards = $this->Cards->find()->toArray();

	$this->viewBuilder()->setLayout('ajax');


	shuffle($cards);

	$player_num = (int) $n;
	$players = array();

	if(! $player_num)
	{
	    exit();
	}

	while($player_num > 0)
	{
	    $players[] = array();
	    $player_num--;
	}


	while( sizeof($cards) > 0  )
	{
    
    
	    foreach($players as $key => $val)
	    {
	        if(sizeof($cards) > 0 )
	        {
	            $card = array_shift($cards);
	            $players[$key][] = $card->code;
	        }

	    }

	}

	echo json_encode($players);


    	}


}


