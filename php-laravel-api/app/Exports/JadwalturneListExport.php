<?php 

namespace App\Exports;
use App\Models\JadwalTurne;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class JadwalturneListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(JadwalTurne::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Lokasi',
			'Tanggal',
			'Hari',
			'Jam Mulai',
			'Jam Selesai'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->lokasi,
			$record->tanggal,
			$record->hari,
			$record->jam_mulai,
			$record->jam_selesai
        ];
    }
}
