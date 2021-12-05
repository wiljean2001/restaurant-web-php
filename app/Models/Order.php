<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'date', 'table_id', 'user_id'];
    public function dish_Orders()
    {
        // Relacion de uno a muchos entre Order y Dish_order
        // return $this->hasMany(Dish_order::class);
        return $this->hasMany(Dish_order::class);
    }
    public function drink_Orders()
    {
        return $this->hasMany(Drink_order::class);
    }
    public function spirit_Orders()
    {
        return $this->hasMany(Spirit_order::class);
    }

    // Sin usar
    public function tables()
    {
        // Relacion de uno a muchos entre Order y Table
        return $this->belongsTo(Table::class, 'table_id');
    }

    //      Resultados
    /**
     * >>> Order::with('dish_Orders.dishes')->get()                                                                                                                               
     *[!] Aliasing 'Order' to 'App\Models\Order' for this Tinker session.
     *=> Illuminate\Database\Eloquent\Collection {#4784
     * all: [
     *    App\Models\Order {#4590
     *    id: 1,
     *     date: "2021-12-01",
     *     created_at: "2021-12-01 08:52:22",
     *     updated_at: "2021-12-01 08:52:22",
     *     table_id: 1,
     *     user_id: null,
     *     dish_Orders: Illuminate\Database\Eloquent\Collection {#4843
     *     all: [
     *         App\Models\Dish_order {#4849
     *           id: 1,
     *           quantify: 2,
     *           price: 119.7,
     *           created_at: "2021-12-01 08:52:53",
     *           updated_at: "2021-12-01 08:52:53",
     *           dish_id: 1,
     *           order_id: 1,
     *           dishes: Illuminate\Database\Eloquent\Collection {#4859
     *             all: [
     *               App\Models\Dish {#4862
     *                 id: 1,
     *                 name: "Voluptatibus saepe",
     *                 price: 59.85,
     *                 description: "Voluptatibus saepe",
     *                 stock: 232,
     *                 created_at: "2021-12-01 08:38:08",
     *                 updated_at: "2021-12-01 08:38:08",
     *                 pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4861
     *                   dish_id: 1,
     *                   id: 1,
     *                 },
     *               },
     *             ],
     *           },
     *         },
     *       ],
     *     },
     *   },
     */
}
