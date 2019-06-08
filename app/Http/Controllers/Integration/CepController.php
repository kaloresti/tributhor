<?php

namespace App\Http\Controllers\Integration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class CepController extends Controller
{
    protected $cep;
    protected $tipoResposta = "json";
    protected $url = "viacep.com.br/ws/";
    protected $cliente;

    public function __construct($cep)
    {
        $this->cep = $cep;
        $this->cliente = new Client(); 
    }

    public function getEndereco()
    {
        $endereco = $this->cliente->get("https://".$this->url.$this->cep."/".$this->tipoResposta);
        return json_decode($endereco->getBody());

    }
}


