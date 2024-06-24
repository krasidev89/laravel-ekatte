<?php

namespace App\Exports\Panel;

use App\Models\Region;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RegionsExport implements FromView, ShouldAutoSize
{
    /**
     * @return View
     */
    public function view(): View
    {
        return view('panel.regions.export', [
            'regions' => Region::all()
        ]);
    }
}
