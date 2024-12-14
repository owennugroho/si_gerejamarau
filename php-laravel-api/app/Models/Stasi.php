<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Stasi extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'stasi';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_stasi';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["nama_stasi","desa","alamat","deskripsi","umat_laki","umat_perempuan","total_umat","foto_gereja","foto_tanah","tanggal_input"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				nama_stasi LIKE ?  OR 
				desa LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
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
			"nama_stasi", 
			"desa", 
			"alamat", 
			"deskripsi", 
			"umat_laki", 
			"umat_perempuan", 
			"total_umat", 
			"foto_gereja", 
			"foto_tanah", 
			"tanggal_input", 
			"id_stasi" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"nama_stasi", 
			"desa", 
			"alamat", 
			"deskripsi", 
			"umat_laki", 
			"umat_perempuan", 
			"total_umat", 
			"foto_gereja", 
			"foto_tanah", 
			"tanggal_input", 
			"id_stasi" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_stasi", 
			"nama_stasi", 
			"desa", 
			"alamat", 
			"deskripsi", 
			"umat_laki", 
			"umat_perempuan", 
			"total_umat", 
			"tanggal_input", 
			"foto_gereja", 
			"foto_tanah" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_stasi", 
			"nama_stasi", 
			"desa", 
			"alamat", 
			"deskripsi", 
			"umat_laki", 
			"umat_perempuan", 
			"total_umat", 
			"tanggal_input", 
			"foto_gereja", 
			"foto_tanah" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nama_stasi", 
			"desa", 
			"alamat", 
			"deskripsi", 
			"umat_laki", 
			"umat_perempuan", 
			"total_umat", 
			"foto_gereja", 
			"foto_tanah", 
			"tanggal_input", 
			"id_stasi" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
