<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
    use HasFactory;
    protected $fillable=[
        'bill_id',
        'product_id',
        'qty',
        'price',
        'total',
        'varriantion',
        'extras',
        'addons'
    ];

    public function getbill(){
        return $this->belongsTo(Bill::class,'bill_id');
    }
    public function getproduct(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function displayVariants()
    {

        $variantData = [];
        $variants = json_decode($this->varriantion);

        if (json_last_error() === JSON_ERROR_NONE && is_array($variants)) {
            foreach ($variants as $variant) {
                if (!isset($variantData[$variant->attribute_name])) {
                    $variantData[$variant->attribute_name] = [];
                }
                $variantData[$variant->attribute_name][] = $variant->varriation_name;
            }

            // $html = '<ul class="list-unstyled p-0 m-0">';
            $html = '';
            foreach ($variantData as $attribute => $values) {
                if($values!=" "){

                    $html .= '<small>' . ucfirst($attribute) . ': ' . implode(', ', $values) . '</small><br>';
                }
            }
            // $html .= '</ul>';

            return $html;
        } else {
            return ''; // Return an empty string if the field is not valid JSON
        }
    }

    public function displayExtras()
{
    $extrasData = [];
    $extras = json_decode($this->extras);

    if (json_last_error() === JSON_ERROR_NONE && is_array($extras)) {
        $html = '<ul class="list-unstyled p-0 m-0">';
        foreach ($extras as $extra) {
              $extrasData[] ='<small>'.  $extra->extra_name . '</small>';
        }
        $html .= '</ul>';


        return '<small>Extra</small>: ' . implode(', ', $extrasData);
    } else {
        return ''; // Return an empty string if the field is not valid JSON
    }
}



public function displayAddons()
{
    $addonsData = [];
    $addons = json_decode($this->addons);

    if (json_last_error() === JSON_ERROR_NONE && is_array($addons)) {
        $html = '<ul class="list-unstyled p-0 m-0">';
        foreach ($addons as $addon) {
            $addonsData[] ='<small>'. $addon->addon_name . '</small>';
        }
        $html .= '</ul>';

        return '<small>Addons:</small> ' . implode(', ', $addonsData)."<br>";
    } else {
        return ''; // Return an empty string if the field is not valid JSON
    }
}



// json



public function getVariants()
{
    // $variantData = [];
    // $variants = json_decode($this->varriantion);

    // if (json_last_error() === JSON_ERROR_NONE && is_array($variants)) {
    //     foreach ($variants as $variant) {
    //         if (!isset($variantData[$variant->attribute_name])) {
    //             $variantData[$variant->attribute_name] = [];
    //         }
    //         $variantData[$variant->attribute_name][] = [$variant->varriation_name];
    //     }


    //     return $variantData;
    // } else {
    //     return ''; // Return an empty string if the field is not valid JSON
    // }


if($this->varriantion == ""){
   return $this->varriantion =[];

}else{

    return json_decode($this->varriantion);
}
// if($res == ""){
//     return [];
// }else{
//     $res;
// }

}

public function getExtras()
{
// $extrasData = [];
// $extras = json_decode($this->extras);

// if (json_last_error() === JSON_ERROR_NONE && is_array($extras)) {

//     foreach ($extras as $extra) {
//           $extrasData[] =[$extra->extra_name ];
//     }


//     return  $extrasData;
// } else {
//     return ''; // Return an empty string if the field is not valid JSON
// }


return json_decode($this->extras);



}



public function getAddons()
{
// $addonsData = [];
// $addons = json_decode($this->addons);

// if (json_last_error() === JSON_ERROR_NONE && is_array($addons)) {

//     foreach ($addons as $addon) {
//         $addonsData[] =[$addon->addon_name];
//     }

//     return  $addonsData;
// } else {
//     return ''; // Return an empty string if the field is not valid JSON
// }

return json_decode($this->addons);
}




}
