<?php 

namespace App\Exports;
use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class InventarisListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Inventaris::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Nama Barang',
			'Lokasi Barang',
			'Kode Barang',
			'Kategori Barang',
			'Tanggal Memperoleh',
			'Tanggal Input'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->nama_barang,
			$record->lokasi_barang,
			$record->kode_barang,
			$record->kategori_barang,
			$record->tanggal_memperoleh,
			$record->tanggal_input
        ];
    }
}
