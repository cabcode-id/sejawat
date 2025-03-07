<?php

namespace App\Imports;

use App\Models\DetailbankpgModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;

class BankpgImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{

    public function __construct($kode)
    {
        $this->kode = $kode;
    }

    public function rules(): array
    {
        return [
            'soal' => ['required'],
            'pg_1' => ['required'],
            'pg_2' => ['required'],
            'pg_3' => ['required'],
            'pg_4' => ['required'],
            'pg_5' => ['required'],
            'jawaban' => ['required'],
            'pembahasan' => ['required'],
            'pembahasan_full' => ['nullable'],
            'tipe_soal' => ['required']
        ];
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DetailbankpgModel([
            'kode' => $this->kode,
            'soal' => $row['soal'],
            'pg_1' => 'A. ' . $row['pg_1'],
            'pg_2' => 'B. ' . $row['pg_2'],
            'pg_3' => 'C. ' . $row['pg_3'],
            'pg_4' => 'D. ' . $row['pg_4'],
            'pg_5' => 'E. ' . $row['pg_5'],
            'jawaban' => $row['jawaban'],
            'pembahasan' => $row['pembahasan'],
            'pembahasan_full' => $row['pembahasan_full'] ?? '',
            'tipe_soal' => $row['tipe_soal']
        ]);
    }
}
