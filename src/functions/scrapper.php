<?php

require "vendor/autoload.php";

use Goutte\Client;

function crawlAmLeiloeiro($url)
{
    $client = new Client();

    $data = [];

    $selector = '.hover\:shadow-2xl.transition-all.ease-in.shadow-zinc-100.shadow-sm.dark\:shadow-zinc-800.dark\:bg-gradient-to-t.dark\:from-zinc-800.dark\:to-zinc-800.border-\[1px\].bg-white.dark\:border-zinc-800.mb-2.rounded-md.md\:m-0.m-2.group';
    $crawler = $client->request('GET', $url);

    $crawler = $crawler->filter($selector)->each(
        function ($node) use ($client) {
            $href = $node->filter("a")->attr("href");
            if ($href) {
                $selectorLote = '.hover\:shadow-2xl.transition-all.ease-in.shadow-zinc-100.shadow-sm.dark\:shadow-zinc-800.dark\:bg-gradient-to-t.dark\:from-zinc-800.dark\:to-zinc-800.border-\[1px\].bg-white.dark\:border-zinc-800.mb-2.rounded-md.md\:m-0.m-2.group';
                $crawlerLote = $client->request("GET", $href);
                $nodesLote = $crawlerLote->filter($selectorLote);

                if ($nodesLote->count() > 0) {
                    $nodesLote->each(
                        function ($nodeLote) use ($client) {
                            $hrefItem = $nodeLote->filter("a")->attr("href");
                            echo "URL lote: $hrefItem\n";

                            $crawlerItemInfo = $client->request("GET", $hrefItem);

                            $dataPrimeiroLote = $crawlerItemInfo->filter('td.py-3.px-4 span')->text();
                            $dataSegundoLote = $crawlerItemInfo->filter('td.py-3.px-4 span')->nextAll()->text();
                            $valor = $crawlerItemInfo->filter('tbody tr:contains("Valor da avaliação:") td.py-3.px-4')->text();

                            echo "Valor: $valor\n";
                            echo "Data 1º lote: $dataPrimeiroLote\n";
                            echo "Data 2º lote: $dataSegundoLote\n";
                        }
                    );

                } else {
                    echo "Nenhum lote encontrado\n";
                }
                echo "----------------\n";
            }

        }
    )
    ;


    return $data;
}