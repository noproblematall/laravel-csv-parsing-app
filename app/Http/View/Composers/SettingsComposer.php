<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Settings;

class SettingsComposer
{
    public function compose(View $view)
    {
        $view->with('settings', Settings::first());
    }
}