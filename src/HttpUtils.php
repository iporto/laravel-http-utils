<?php

namespace IPorto\HttpUtils;

use Illuminate\Http\Client\Response;

class HttpUtils
{
    /**
     * Converte uma requisição HTTP do Laravel para um comando curl equivalente
     * 
     * @param \Illuminate\Http\Client\Response $response A resposta da requisição HTTP
     * @return string O comando curl equivalente
     */
    public function toCurl(Response $response): string
    {
        // Acessa o objeto de requisição a partir da resposta
        $request = $response->transferStats->getRequest();
        
        // Obtém o método HTTP
        $method = $request->getMethod();
        
        // Obtém a URL completa
        $url = (string) $request->getUri();
        
        // Inicia o comando curl
        $curl = "curl ";
        
        // Adiciona a flag do método HTTP se não for GET
        if ($method !== 'GET') {
            $curl .= "-X {$method} ";
        }
        
        // Obtém os headers
        $headers = $request->getHeaders();
        
        // Adiciona cada header ao comando curl
        foreach ($headers as $name => $values) {
            foreach ($values as $value) {
                $curl .= "-H '{$name}: {$value}' ";
            }
        }
        
        // Obtém o corpo da requisição (se houver)
        $body = (string) $request->getBody();
        if (!empty($body)) {
            $curl .= "-d '{$body}' ";
        }
        
        // Adiciona a URL
        $curl .= "'{$url}'";
        
        return $curl;
    }
    
    // Você pode adicionar outros métodos úteis relacionados a HTTP aqui
    // Por exemplo:
    
    /**
     * Extrai os headers da resposta em um formato legível
     * 
     * @param \Illuminate\Http\Client\Response $response
     * @return array
     */
    public function getResponseHeaders(Response $response): array
    {
        return $response->headers();
    }
    
    /**
     * Calcula o tempo de resposta
     * 
     * @param \Illuminate\Http\Client\Response $response
     * @return float|null
     */
    public function getResponseTime(Response $response): ?float
    {
        if (isset($response->transferStats)) {
            return $response->transferStats->getTransferTime();
        }
        
        return null;
    }
}