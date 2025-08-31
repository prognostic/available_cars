<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    // EXAMPLE http://127.0.0.1:8000/available-cars?time=2025-10-04%2010:30:00
    // EXAMPLE http://127.0.0.1:8000/available-cars?time=2025-10-04%2010:30:00&car_model=1
    // EXAMPLE http://127.0.0.1:8000/available-cars?time=2025-10-04%2010:30:00&comfort_category=first
    // EXAMPLE http://127.0.0.1:8000/available-cars?time=2025-10-04%2010:30:00&car_model=1&comfort_category=first

    // список доступных текущему пользователю на запланированное время автомобилей 
    // с возможностью фильтрации по модели, по категории комфорта
    function available_cars(Request $request) {
        $exactDatetime = Carbon::parse($request->query('time'));
        $car_model = $request->query('car_model');
        $comfort_category = $request->query('comfort_category');

        // смотрим есть ли поездки на запланированное время
        $rides = Ride::where("departure_time", $exactDatetime)->get();
        // исключаем из списка доступных машин те, что зарезервированы
        // $available_cars = Car::where("id", "!=", $rides->pluck('car_id'))->get();
        $query = [['cars.id', '!=', $rides->pluck('car_id')]];
        
        if (isset($car_model)) {
            $query[] = ['car_models.id', $car_model];
        }

        if (isset($comfort_category)) {
            $query[] = ['car_models.comfort_category', $comfort_category];
        }

        $available_cars = DB::table('cars')
            ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')
            ->where($query)
            ->get();

        return $available_cars;
    }
}
