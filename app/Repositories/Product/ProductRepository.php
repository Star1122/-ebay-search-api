<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    private $http;

    /**
     * CachedUserRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);

        $this->http = new Client;
    }

    /**
     * Get Team detail data
     *
     * @param $data
     * @return mixed
     * @throws GuzzleException
     */
    public function searchProduct($data)
    {
        $query = array_merge([
            'OPERATION-NAME' => 'findItemsByKeywords',
            'SERVICE-VERSION' => '1.0.0',
            'SECURITY-APPNAME' => config('ebay.app_id'),
            'RESPONSE-DATA-FORMAT' => 'JSON'
        ], $data);

        $response = $this->http->get(config('ebay.service_url'), [
            'query' => $query,
        ])->getBody()->getContents();

        $result = json_decode($response, true);

        if ($result['findItemsByKeywordsResponse'][0]['ack'][0] === 'Success') {
            $items = $result['findItemsByKeywordsResponse'][0]['searchResult'][0]['item'];

            $products = [];
            foreach ($items as $item) {
                $product = [
                    'provider' => 'ebay',
                    'item_id' => $item['itemId'][0],
                    'click_out_link' => $item['viewItemURL'][0],
                    'main_photo_url' => isset($item['galleryURL']) ? $item['galleryURL'][0] : '',
                    'price' => $item['sellingStatus'][0]['currentPrice'][0]['__value__'],
                    'price_currency' => $item['sellingStatus'][0]['currentPrice'][0]['@currencyId'],
                    'shipping_price' => $item['shippingInfo'][0]['shippingServiceCost'][0]['__value__'],
                    'title' => $item['title'][0],
                    'description' => $item['title'][0], // TODO: need to check
                    'valid_until' => $item['listingInfo'][0]['endTime'][0],
                    'brand' => $item['title'][0], // TODO: need to check
                ];
                $products[] = $product;
            }

            return $products;
        }

        return null;
    }
}
