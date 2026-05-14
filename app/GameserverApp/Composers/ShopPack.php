<?php
namespace GameserverApp\Composers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use GameserverApp\Api\Client;

class ShopPack
{
    private $api;

    public function __construct()
    {
        $this->api = app(Client::class);
    }

    public function compose(View $view)
    {
        $id = $view->getData()['value'];

        try {
            $data = Cache::remember('shop_pack_' . $id, now()->addMinutes(config('gameserverapp.cache.shop_pack_ttl', 10)), function () use ($id) {
                return $this->api->shopItem($id);
            });
        } catch(\Throwable $e) {
            $data = false;
        }

        $view->with([
            'shopPack' => $data
        ]);
    }
}