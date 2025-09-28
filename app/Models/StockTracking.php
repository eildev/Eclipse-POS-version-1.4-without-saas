<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTracking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function racks()
    {
        return $this->belongsTo(WarehouseRack::class, 'rack_id');
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variant_id');
    }
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function reference()
    {
        $modelMap = [
            'sale' => \App\Models\Sale::class,
            'purchase' => \App\Models\Purchase::class,
            'return' => \App\Models\Returns::class,
            'damage' => \App\Models\Damage::class,
            'stock_transfer' => \App\Models\StockTransfer::class,
            'stock_adjustment' => \App\Models\StockAdjustment::class,
            'quick_purchase' => \App\Models\Purchase::class,
            'opening_stock' => \App\Models\Product::class,
            'bulk_update' => \App\Models\Product::class,
        ];

        $modelClass = $modelMap[$this->reference_type] ?? \App\Models\Product::class; // Default to Product if invalid

        return $this->belongsTo($modelClass, 'reference_id');
    }
}
