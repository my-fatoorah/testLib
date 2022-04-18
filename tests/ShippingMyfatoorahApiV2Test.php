<?php

namespace MyFatoorah\Test;

use MyFatoorah\Library\ShippingMyfatoorahApiV2;

class ShippingMyfatoorahApiV2Test extends \PHPUnit\Framework\TestCase {

    private $apiKey      = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
    private $countryMode = 'KWT';
    private $isTest      = true;

//-----------------------------------------------------------------------------------------------------------------------------------------

    public function testGetShippingCountries() {
        $mfObj = new ShippingMyfatoorahApiV2($this->apiKey, $this->countryMode, $this->isTest);
        
        $json  = $mfObj->getShippingCountries();

        $this->assertEquals('AD', $json->Data[0]->CountryCode);
        $this->assertEquals('ANDORRA', $json->Data[0]->CountryName);
    }

//-----------------------------------------------------------------------------------------------------------------------------------------
    public function testGetShippingCities() {
        $mfObj = new ShippingMyfatoorahApiV2($this->apiKey, $this->countryMode, $this->isTest);
        
        $json  = $mfObj->getShippingCities(1, 'KW', 'ada');

        $this->assertEquals('KW', $json->Data->CountryCode);
        $this->assertEquals('ADAN', $json->Data->CityNames[0]);
        $this->assertEquals('SHUHADA', $json->Data->CityNames[1]);
    }

//-----------------------------------------------------------------------------------------------------------------------------------------
    public function testCalculateShippingCharge() {
        $mfObj = new ShippingMyfatoorahApiV2($this->apiKey, $this->countryMode, $this->isTest);
        
        $shippingData = [
            'ShippingMethod' => 1,
            'Items'          => [[
                'ProductName' => 'product',
                'Description' => 'product',
                'Weight' => 10,
                'Width' => 10,
                'Height' => 10,
                'Depth' => 10,
                'Quantity' => 1,
                'UnitPrice' => '17.234',
            ]],
            'CountryCode'    => 'KW',
            'CityName'       => 'adan',
            'PostalCode'     => '12345',
        ];

        $json = $mfObj->calculateShippingCharge($shippingData);
        $this->assertEquals('KD', $json->Data->Currency);
        $this->assertEquals(45.926, $json->Data->Fees);
        
        //test empty ProductName
        $shippingData1 = [
            'ShippingMethod' => 1,
            'Items'          => [[
                'ProductName' => '',
                'Description' => 'product',
                'Weight' => 10,
                'Width' => 10,
                'Height' => 10,
                'Depth' => 10,
                'Quantity' => 1,
                'UnitPrice' => '17.234',
            ]],
            'CountryCode'    => 'KW',
            'CityName'       => 'adan',
            'PostalCode'     => '12345',
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('model.Items[0].ProductName: The field Product Name (En) is mandatory.');
        $mfObj->calculateShippingCharge($shippingData1);
    }

//-----------------------------------------------------------------------------------------------------------------------------------------
}
