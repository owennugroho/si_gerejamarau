<?php 

namespace App\Exports;
use App\Models\Stasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class StasiListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Stasi::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Nama Stasi',
			'Desa',
			'Alamat',
			'Deskripsi',
			'Umat Laki',
			'Umat Perempuan',
			'Total Umat',
			'Foto Gereja',
			'Foto Tanah',
			'Tanggal Input'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->nama_stasi,
			$record->desa,
			$record->alamat,
			$record->deskripsi,
			$record->umat_laki,
			$record->umat_perempuan,
			$record->total_umat,
			$record->foto_gereja,
			$record->foto_tanah,
			$record->tanggal_input
        ];
    }
}
