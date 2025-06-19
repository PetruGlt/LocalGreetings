<?php

class News
{
    public function fetchNews($feedURL, $limit = 10)
    {
        $items = [];

        try{
            $dom = new DOMDocument();
            $dom->load($feedURL);
            $xpath = new DOMXpath($dom);
            $rssItems = $xpath->query('/rss/channel/item');

            $count = 0;
            foreach ($rssItems as $news) {
                $linkElement = $news->getElementsByTagName('link')->item(0);
                if (!$linkElement) continue;

                $link = $linkElement->nodeValue;

                if (!str_starts_with($link, 'https://www.digi24.ro/stiri/sport/')) 
                    if (!str_starts_with($link, 'https://stirileprotv.ro/stiri/sport/')) 
                        if (!str_starts_with($link, 'https://observatornews.ro/sport/')) 
                            continue; 

                if ($count++ >= $limit) break;

                $items[] = [
                    'title' => $news->getElementsByTagName('title')->item(0)->nodeValue,
                    'description' => $news->getElementsByTagName('description')->item(0)->nodeValue,
                    'link' => $link
                ];
            }
        }
        catch(Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $items;
    }

}