<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JadwalTurne extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'jadwal_turne';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_jadwal';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = ["lokasi","tanggal","hari","jam_mulai","jam_selesai"];
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				lokasi LIKE ?  OR 
				hari LIKE ?  OR 
				id_jadwal LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
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
			"lokasi", 
			"tanggal", 
			"hari", 
			"jam_mulai", 
			"jam_selesai", 
			"id_jadwal" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"lokasi", 
			"tanggal", 
			"hari", 
			"jam_mulai", 
			"jam_selesai", 
			"id_jadwal" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_jadwal", 
			"lokasi", 
			"tanggal", 
			"hari", 
			"jam_mulai", 
			"jam_selesai" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_jadwal", 
			"lokasi", 
			"tanggal", 
			"hari", 
			"jam_mulai", 
			"jam_selesai" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"lokasi", 
			"tanggal", 
			"hari", 
			"jam_mulai", 
			"jam_selesai", 
			"id_jadwal" 
		];
	}
	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
