<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\DatabaseRule;
use Illuminate\Support\Traits\Conditionable;

class CheckStock implements Rule
{
    
    protected $product_id;

    protected $stock_type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($stock_type, $product_id)
    {
        $this->stock_type = $stock_type;
        $this->product_id = $product_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->stock_type == 'general'){
            return DB::table('product_stocks')->where('product_id', $this->product_id)->count() === 0;
        }

        if($this->stock_type == 'color'){
            return DB::table('product_stocks')->where('product_id', $this->product_id)->whereNull('size')->count() === 0;
        }

        if($this->stock_type == 'size'){
            return DB::table('product_stocks')->where('product_id', $this->product_id)->whereNull('color')->count() === 0;
        }

        if($this->stock_type == 'color_size'){
            return DB::table('product_stocks')->where('product_id', $this->product_id)->whereNull('color')->whereNull('size')->count() === 0;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->stock_type == 'general'){
            return 'Product General Stock Present!';
        }

        if($this->stock_type == 'color'){
            return 'Adding Color Stock Is Not Allowed!';
        }

        if($this->stock_type == 'size'){
            return 'Adding Size Stock Is Not Allowed!';
        }

        if($this->stock_type == 'color_size'){
            return 'Adding Color & Size Stock Is Not Allowed!';
        }
    }
}
