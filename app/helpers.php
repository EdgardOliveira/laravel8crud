<?php

use App\Models\Visita;
use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

if (!function_exists('formatarDataHora')){
    function formatarDataHora($data, $formatacao = 'd/m/Y')
    {
        // Utiliza a classe de Carbon para converter ao formato de data ou hora desejado
        return Carbon\Carbon::parse($data)->format($formatacao);
    }
}

if (!function_exists('registrarVisita')){
    /**
     * @param $pagina a ser registrada ou ter seu acesso incrementado
     * @return o registro visita
     */
    function registrarVisita($pagina)
    {
        //Insere um registro com o nome da página ou atualiza (incrementando os acessos ) dela
        return $visita = Visita::updateOrCreate(
            ['pagina' => $pagina], //registra a página, senão existir
            ['acessos' => DB::raw('acessos+1')] //existe... então incrementa
        );
    }
}

if (!function_exists('registrarVisitante')){
    /**
     * @param $dadosVisitante
     * @param $ip
     * @param $navegador
     */
    function registrarVisitante($dadosVisitante, $ip, $navegador, $visita){

        $visitante = new Visitante([
            'navegador' => $navegador,
            'ip' => $ip,
            'pais' => $dadosVisitante['pais'],
            'uf' => $dadosVisitante['uf'],
            'localidade' => $dadosVisitante['localidade'],
            'bairro' => $dadosVisitante['bairro'],
            'latitude' => $dadosVisitante['latitude'],
            'longitude' => $dadosVisitante['longitude'],
            'visita_id' => $visita->id
        ]);
        $visitante->save();
    }
}

if (!function_exists('verificarIp')){
    function verificarIp(){
        $ip = $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # when behind cloudflare
            ?? $_SERVER['HTTP_X_FORWARDED']
            ?? $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['HTTP_FORWARDED']
            ?? $_SERVER['HTTP_FORWARDED_FOR']
            ?? $_SERVER['REMOTE_ADDR']
            ?? '0.0.0.0';

        if ($ip === '127.0.0.1')
            $ip = verificarIpPublico();

        return $ip;
    }
}

if (!function_exists('verificarIpPublico')){
    /**
     * Solução IPIFy
     * @return ip público
     * {
    "ip": "191.30.221.236"
    }
     */
    function verificarIpPublico(){
        $url = "https://api.ipify.org?format=json";
        $response = Http::get($url);
        $ipPublico = json_decode($response->body());
        return $ipPublico->ip;
    }
}

if (!function_exists('verificarIpWhoIs')){
    /**
     * @param $ip a ser verificado
     * @return array com dados sobre o ip
     * {
    "ip": "191.30.221.236",
    "success": true,
    "type": "IPv4",
    "continent": "América do Sul",
    "continent_code": "SA",
    "country": "Brasil",
    "country_code": "BR",
    "country_flag": "https://cdn.ipwhois.io/flags/br.svg",
    "country_capital": "Brasília",
    "country_phone": "+55",
    "country_neighbours": "SR,PE,BO,UY,GY,PY,GF,VE,CO,AR",
    "region": "Amazonas",
    "city": "Manaus",
    "latitude": "-3.1190275",
    "longitude": "-60.0217314",
    "asn": "AS10429",
    "org": "TELEFÔNICA BRASIL S.A",
    "isp": "TELEFÔNICA BRASIL S.A",
    "timezone": "America/Boa_Vista",
    "timezone_name": "Amazon Standard Time",
    "timezone_dstOffset": "0",
    "timezone_gmtOffset": "-14400",
    "timezone_gmt": "GMT -4:00",
    "currency": "Brazilian Real",
    "currency_code": "BRL",
    "currency_symbol": "$",
    "currency_rates": "5.351",
    "currency_plural": "Brazilian reals",
    "completed_requests": 27
    }
     */
    function verificarIpWhoIs($ip){
        $url = "http://ipwhois.app/json/{$ip}?lang=pt-BR";
        $ip = consultarUrl($url);

        $ipWhois = array([
            'pais' => $ip->country,
            'uf' => $ip->region,
            'localidade' => $ip->city,
            'bairro' => 'Não retorna',
            'latitude' => $ip->latitude,
            'longitude' => $ip->longitude,
        ]);

        return $ipWhois[0];
    }
}

if (!function_exists('verificarLatlong')){
    /**
     * https://nominatim.org/release-docs/develop/api/Reverse/
     * @param $latitude
     * @param $longitude
     * @return array com dados sobre a latitude e longitude consultada
     * {
    "place_id": 21817707,
    "licence": "Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright",
    "osm_type": "node",
    "osm_id": 2313056101,
    "lat": "-3.1190345",
    "lon": "-60.0215775",
    "display_name": "Lindopan, Rua Silva Ramos, Centro, Manaus, Microrregião de Manaus, Região Geográfica Intermediária de Manaus, Amazonas, Região Norte, 69000-000, Brasil",
    "address": {
    "shop": "Lindopan",
    "road": "Rua Silva Ramos",
    "suburb": "Centro",
    "city_district": "Manaus",
    "city": "Manaus",
    "municipality": "Microrregião de Manaus",
    "state_district": "Região Geográfica Intermediária de Manaus",
    "state": "Amazonas",
    "region": "Região Norte",
    "postcode": "69000-000",
    "country": "Brasil",
    "country_code": "br"
    },
    "boundingbox": [
    "-3.1190845",
    "-3.1189845",
    "-60.0216275",
    "-60.0215275"
    ]
    }
     */
    function verificarLatlong($latitude, $longitude){
        $url = "http://nominatim.openstreetmap.org/reverse?lat={$latitude}&lon={$longitude}&format=json&limit=1";
        $resp = consultarUrl($url);

        $ipNominatim= array([
            'pais' => $resp->address->country,
            'uf' => $resp->address->state,
            'localidade' => $resp->address->city,
            'bairro' => $resp->address->suburb,
            'latitude' => $resp->lat,
            'longitude' => $resp->lon,
        ]);

        return $ipNominatim[0];
    }
}

if (!function_exists('consultarUrl')){
    /**
     * Recebe uma url, pega o corpo retornado em JSON e converte em array
     * @param $url
     * @return array com dados de uma url
     */
    function consultarUrl($url){
        $response = Http::get($url);
        $resp = json_decode($response->body());
        return $resp;
    }
}

if (!function_exists('registrarAcesso')){
    function registrarAcesso($pagina, Request $request)
    {
        //Registrar a visita e retornar o registro
        $visita = registrarVisita($pagina);

        //Verificar o ip do cliente
        $ip = verificarIp();

        //Verificar dados por IP
        $dadosVisitante = verificarIpWhoIs($ip);

        registrarVisitante($dadosVisitante, $ip, $request->userAgent(), $visita);
    }

}






