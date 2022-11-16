<?php

namespace Beauty\Modules\Common\Objects\CrmProduct;

class CrmSaleStatus
{
    private const REPLACE = 'replace';
    private const COMPLETED = 'completed';
    private const PARTIAL_PAID = 'partialPaid';
    private const RETURNED = 'returned';
    private const UNPAID = 'unpaid';
    private const CANCEL = 'cancel';

    private const STATUS_KEYS = [
        self::REPLACE,
        self::COMPLETED,
        self::PARTIAL_PAID,
        self::RETURNED,
        self::UNPAID,
        self::CANCEL,
    ];

    private const STATUS_KEYS_STORE = [
        self::COMPLETED,
        self::UNPAID,
    ];

    public static function all(): array
    {
        return [
            self::REPLACE => __('crm_products.replace'),
            self::COMPLETED => __('crm_products.completed'),
            self::PARTIAL_PAID => __('crm_products.partialPaid'),
            self::RETURNED => __('crm_products.returned'),
            self::UNPAID => __('crm_products.unpaid'),
            self::CANCEL => __('crm_products.cancel'),
        ];
    }
    public static function keys(): array
    {
        return self::STATUS_KEYS;
    }
    public static function keysStore(): array
    {
        return self::STATUS_KEYS_STORE;
    }
    public static function completed(): string
    {
        return self::COMPLETED;
    }
    public static function replace(): string
    {
        return self::REPLACE;
    }
    public static function partialPaid(): string
    {
        return self::PARTIAL_PAID;
    }
    public static function returned(): string
    {
        return self::RETURNED;
    }
    public static function unpaid(): string
    {
        return self::UNPAID;
    }
    public static function cancel(): string
    {
        return self::CANCEL;
    }
}

function rules(): array
{
    $user = auth('api')->user();
    $profile = new Profile($user);
    $profile = $profile->profile();
    $rule = 'profileID,' . $profile->profileID;
    return [
        'adminID' => [
            'required',
            'integer',
            'exists:users,userID',
        ],
        'clientID' => [
            'nullable',
            'integer',
            'exists:clients,clientID,' . $rule,
        ],
        'stockID' => [
            'required',
            'integer',
            'exists:crm_stocks,id,' . $rule,
        ],
        'status' => [
            'string',
            Rule::in(CrmSaleStatus::keysStore()),
            ],
        'products' => 'required',
        'products.*.productID' => [
            'required',
            'integer',
            'min:1',
            'exists:crm_products,id,' . $rule,
        ],
        'products.*.price' => [
            'required',
            'integer',
            'min:0',
        ],
        'products.*.quantity' => [
            'required',
            'integer',
            'min:0',
        ],
        'products.*.userID' => [
            'required',
            'integer',
            'min:1',
            'exists:users,userID',
        ],
        'products.*.type' => [
            'string',
            Rule::in(CrmStockProductType::keys()),
            ],
    ];
}
