<?php

namespace Modules\Icommercepayu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Icommerce\Entities\PaymentMethod;

class IcommercepayuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $options['init'] = "Modules\Icommercepayu\Http\Controllers\Api\IcommercePayuApiController";
        $options['mainimage'] = null;
        $options['merchantid'] = "508029";
        $options['apilogin'] = "pRRXKOl8ikMmt9u";
        $options['apikey'] = "4Vj8eK4rloUd272L48hsrarnUA";
        $options['accountid'] = "512321";
        $options['mode'] = "sandbox";
        $options['test'] = 1;

        $titleTrans = 'icommercepayu::icommercepayus.single';
        $descriptionTrans = 'icommercepayu::icommercepayus.description';
        
        foreach (['en', 'es'] as $locale) {

            if($locale=='en'){
                $params = array(
                    'title' => trans($titleTrans),
                    'description' => trans($descriptionTrans),
                    'name' => config('asgard.icommercepayu.config.paymentName'),
                    'status' => 0,
                    'options' => $options
                );

                $paymentMethod = PaymentMethod::create($params);
                
            }else{

                $title = trans($titleTrans,[],$locale);
                $description = trans($descriptionTrans,[],$locale);

                $paymentMethod->translateOrNew($locale)->title = $title;
                $paymentMethod->translateOrNew($locale)->description = $description;

                $paymentMethod->save();
            }

        }// Foreach

    }
}