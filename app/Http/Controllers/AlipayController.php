<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AlipayController extends Controller
{
    public function Alipay()
    {
        $alipay = app('alipay.mobile');
        $alipay->setOutTradeNo('E5324364234');
        $alipay->setTotalFee('0.01');
        $alipay->setSubject('小米4');
        $alipay->setBody('商品：支付宝支付测试');

        //返回签名后的支付参数给支付宝移动端的SDK
        DB::table('test')->insert(['orderInfo' => $alipay->getPayPara()]);
    }

    //支付宝异步通知支付结果
    public function AliPayNotify(Request $request)
    {
        if(!app('alipay.mobile')->verify()){
            Log::notice('Alipay notify post data verification fail.',[
                'data' => $request->instance()->getContent()
            ]);

            return 'fail';
        }

        switch ($request->input('trade_status','')){
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                Log::debug('Alipay notify post data verification success.',[
                    'out_trade_no' => $request->input('out_trade_no',''),
                    'trade_no' => $request->input('trade_no','')
                ]);
                break;
        }

        return 'success';
    }

}
