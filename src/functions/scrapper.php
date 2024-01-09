<?php

require "vendor/autoload.php";

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

function crawlAmLeiloeiro($url)
{
    $data = [];
    $visitedUrls = [];

    $browser = new HttpBrowser(HttpClient::create());

    try {
        $crawler = $browser->request('GET', $url);

        $crawler->filter('.hover\:shadow-2xl.transition-all.ease-in.shadow-zinc-100.shadow-sm.dark\:shadow-zinc-800.dark\:bg-gradient-to-t.dark\:from-zinc-800.dark\:to-zinc-800.border-\[1px\].bg-white.dark\:border-zinc-800.mb-2.rounded-md.md\:m-0.m-2.group')->each(
            function ($node) use ($browser, &$data) {
                $href = $node->filter("a")->link()->getUri();

                if ($href) {
                    $crawlerLote = $browser->request("GET", $href);
                    $nodesLote = $crawlerLote->filter('.hover\:shadow-2xl.transition-all.ease-in.shadow-zinc-100.shadow-sm.dark\:shadow-zinc-800.dark\:bg-gradient-to-t.dark\:from-zinc-800.dark\:to-zinc-800.border-\[1px\].bg-white.dark\:border-zinc-800.mb-2.rounded-md.md\:m-0.m-2.group');

                    $countNodesLote = $nodesLote->count();

                    if ($countNodesLote > 0) {
                        $nodesLote->each(
                            function ($nodeLote) use ($browser, &$data) {
                                $hrefItem = $nodeLote->filter("a")->link()->getUri();

                                $crawlerItemInfo = $browser->request("GET", $hrefItem);
                                echo "Coletando dados de $hrefItem\n";

                                if ($crawlerItemInfo->filter('td.py-3.px-4 span')->count() > 0) {
                                    $dataPrimeiroLote = $crawlerItemInfo->filter('td.py-3.px-4 span')->text();
                                    $dataSegundoLote = $crawlerItemInfo->filter('td.py-3.px-4 span')->nextAll()->text();

                                    $dataPrimeiroLote = str_replace("1º. LEILÃO:", "", $dataPrimeiroLote);
                                    $dataSegundoLote = str_replace("2º. LEILÃO:", "", $dataSegundoLote);

                                    $valor = $crawlerItemInfo->filter('tbody tr:contains("Valor da avaliação:") td.py-3.px-4')->text();

                                    $data[] = [
                                        "urlItem" => $hrefItem,
                                        "valor" => $valor,
                                        "dataPrimeiroLote" => $dataPrimeiroLote,
                                        "dataSegundoLote" => $dataSegundoLote,
                                    ];
                                } else {
                                    echo "Nenhum dado encontrado para $hrefItem\n";
                                }
                            }
                        );
                    } else {
                        echo "Nenhum lote encontrado para $href\n";
                    }
                }
            }
        );
    } catch (\Exception $e) {
        echo "Erro: " . $e->getMessage() . "\n";
        echo "Trace: " . $e->getTraceAsString() . "\n";
    }

    return $data;
}