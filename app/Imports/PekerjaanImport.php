<?php

namespace App\Imports;

use App\Models\Pekerjaan;
use App\Models\Tender;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PekerjaanImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $row['no_pr'] = (string) $row['no_pr'];
        $row['volume'] = (string) $row['volume'];
        $row['harga'] = floatval($row['harga']);

        $tender = Tender::where('no_pr',  $row['no_pr'])->first();

        return new Pekerjaan([
            'tender_id' => $tender->id,
            'pekerjaan' => $row['uraian_pekerjaan'],
            'volume' => $row['volume'],
            'satuan' => $row['satuan'],
            'harga' => $row['harga'],
            'keterangan' => $row['keterangan'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.no_pr' => 'required|numeric',
            '*.satuan' => 'required|max:255',
            '*.uraian_pekerjaan' => 'required|max:255',
            '*.volume' => 'required|numeric',
            '*.harga' => 'required|numeric',
            '*.keterangan' => 'max:16000000',
        ];
    }
}
