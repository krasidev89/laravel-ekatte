<?php

namespace App\Exports\Panel;

use App\Models\Municipality;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class MunicipalitiesExport extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
{
    /**
     * Bind value to a cell.
     *
     * @param Cell $cell Cell to bind value to
     * @param mixed $value Value to bind in cell
     *
     * @return bool
     */
    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'B') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('panel.municipalities.export', [
            'municipalities' => Municipality::with('district')->get()
        ]);
    }
}
