<?php

namespace App\Http\Controllers\Debug;

use App\Services\RapidApiVehicleService;

class TestController
{
    public function testApi()
    {
        $service = new RapidApiVehicleService();
        
        echo "<h2>Testing RapidAPI Vehicle Service</h2>";
        echo "<h3>1. Getting Brands...</h3>";
        
        $brands = $service->getBrandsList();
        echo "<p>Brands count: " . count($brands) . "</p>";
        
        if (count($brands) > 0) {
            echo "<h4>First 10 Brands:</h4>";
            echo "<ul>";
            foreach ($brands->take(10) as $brand) {
                echo "<li>ID: {$brand['id']}, Name: {$brand['name']}</li>";
            }
            echo "</ul>";
            
            // Test getting models for first brand
            echo "<h3>2. Getting Models for First Brand...</h3>";
            $firstBrand = $brands->first();
            $models = $service->getModelsList($firstBrand['id']);
            echo "<p>Models count: " . count($models) . "</p>";
            
            if (count($models) > 0) {
                echo "<h4>First 5 Models:</h4>";
                echo "<ul>";
                foreach ($models->take(5) as $model) {
                    echo "<li>ID: {$model['id']}, Name: {$model['name']}</li>";
                }
                echo "</ul>";
            }
        } else {
            echo "<p style='color: red;'>No brands found! Check logs for error details.</p>";
        }
    }
}
