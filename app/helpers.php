<?php

use Illuminate\Support\Facades\DB;

function active_class($path, $active = 'active')
{
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function is_active_route($path)
{
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

function show_class($path)
{
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

function countFeedback($id)
{
    $totals = DB::table('feedback')
    ->where('pertanyaan_id', $id)
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when jawaban_id = 1 then 1 end) as baik")
    ->selectRaw("count(case when jawaban_id = 2 then 1 end) as sedang")
    ->selectRaw("count(case when jawaban_id = 3 then 1 end) as kurang")
    ->first();

    return $totals;
}