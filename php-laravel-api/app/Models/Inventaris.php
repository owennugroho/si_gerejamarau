<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Inventaris extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'inventaris';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_inventaris';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["nama_barang","lokasi_barang","kode_barang","kategori_barang","tanggal_memperoleh","tanggal_input"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				nama_barang LIKE ?  OR 
				lokasi_barang LIKE ?  OR 
				kode_barang LIKE ?  OR 
				kategori_barang LIKE ?  OR 
				id_inventaris LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"nama_barang", 
			"lokasi_barang", 
			"kode_barang", 
			"kategori_barang", 
			"tanggal_memperoleh", 
			"tanggal_input", 
			"id_inventaris" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"nama_barang", 
			"lokasi_barang", 
			"kode_barang", 
			"kategori_barang", 
			"tanggal_memperoleh", 
			"tanggal_input", 
			"id_inventaris" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_inventaris", 
			"nama_barang", 
			"lokasi_barang", 
			"kode_barang", 
			"kategori_barang", 
			"tanggal_memperoleh", 
			"tanggal_input" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_inventaris", 
			"nama_barang", 
			"lokasi_barang", 
			"kode_barang", 
			"kategori_barang", 
			"tanggal_memperoleh", 
			"tanggal_input" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nama_barang", 
			"lokasi_barang", 
			"kode_barang", 
			"kategori_barang", 
			"tanggal_memperoleh", 
			"tanggal_input", 
			"id_inventaris" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
