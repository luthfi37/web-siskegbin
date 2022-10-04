<?php

namespace App\Imports;
use App\User;
use App\Anggotas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class AnggotasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $anggota = Anggotas::create([
            'nama'     => $row['Nama'],
            'pangkat'     => $row['Pangkat'],
            'jabatan'    => $row['Jabatan'],
            'desa'     => $row['Desa'],
            'nrp'    => $row['NRP'],
            'email'    => $row['Email'], 
            'password' => \Hash::make($row['Password']),
        ]);

        User::create([
            'name'     => $row['Nama'],
            'role_id' => '2',
            'anggota_id' => $anggota->anggota_id,
            'email'    => $row['Email'], 
            'password' => \Hash::make($row['Password']),
        ]);
    }
}
