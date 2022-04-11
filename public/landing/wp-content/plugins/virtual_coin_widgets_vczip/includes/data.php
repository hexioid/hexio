<?php

defined( 'VCW_INDEX' ) or die( '' );

class VCW_Data
{

    static $data;
    static $db_data_name = 'vcw_data';
    static $db_update_name = 'vcw_last_update';
    static $update_interval = 60;

    public static function load()
    {
        register_activation_hook(VCW_INDEX, array(get_class(), 'onActivate') );

        $last_update = get_option(self::$db_update_name, false);
        $data = maybe_unserialize(get_option(self::$db_data_name, null));
        $time_now = time();

        if(!is_array($data)
            || !isset($data['cmc'])
            || !is_array($data['cmc'])
            || !isset($data['rates'])
            || !is_array($data['rates'])
            || $last_update === false
            || $time_now > $last_update + self::$update_interval){


            $cmc_data = self::getCMCData();
            $bitpay_data = self::getBitPayData();




            $data = self::parseData($cmc_data,$bitpay_data);

            if(is_array($data)){
                update_option(self::$db_data_name, maybe_serialize($data));
                update_option(self::$db_update_name, time());
            }
        }

        self::$data = $data;
    }

    public static function onActivate()
    {
        update_option(self::$db_update_name, 0);
    }

    protected static function requestGET($url){
        $ch = curl_init();
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    protected static function getCMCData()
    {
        $cmd_json = self::requestGET('https://api.coinmarketcap.com/v1/ticker/?limit=0');
        $cmc_data = json_decode($cmd_json, true);

        return is_array($cmc_data) ? $cmc_data : null;
    }

    protected static function getBitPayData()
    {
        $bitpay_json = self::requestGET('https://bitpay.com/api/rates');
        $bitpay_data = json_decode($bitpay_json, true);

        return is_array($bitpay_data) ? $bitpay_data : null;
    }

    protected static function parseData($cmc_data,$bitpay_data)
    {

        if(is_array($cmc_data) && is_array($bitpay_data)){

            $rates = array(
                'BTC' => '1'
            );

            $all = array();
            $usd_to_btc = 1;

            foreach ($bitpay_data as $currency){
                $code = $currency['code'];
                $rate = $currency['rate'];

                if($code !== 'BTC'){
                    $rates[$code] = $rate !== null ? number_format(floatval($rate),8,'.','') : null;
                }

                if($code === 'USD'){
                    $usd_to_btc = $rates[$code];
                }

                $all[] = array(
                    'code' => $code,
                    'name' => $currency['name']
                );
            }


            foreach ($cmc_data as $i => $crypto){
                $code = $crypto['symbol'];
                $price_btc = $crypto['price_btc'];
                $vol = $crypto['24h_volume_usd'];
                $mkt_cap = $crypto['market_cap_usd'];

                if($code !== 'BTC'){
                    $rates[$code] = $price_btc !== null ? number_format(1/floatval($price_btc),8,'.','') : null;

                    $all[] = array(
                        'code' => $code,
                        'name' => $crypto['name']
                    );
                }

                $cmc[$i]['volume_24h_btc'] = $vol !== null ? number_format(floatval($vol)/$usd_to_btc,8,'.','') : null;
                $cmc[$i]['market_cap_btc'] = $mkt_cap !== null ? number_format(floatval($mkt_cap)/$usd_to_btc,8,'.','') : null;


            }

            return array(
                'cmc' => $cmc_data,
                'rates' => $rates,
                'currencies' => $all
            );
        }

        return null;
    }
}

VCW_Data::load();