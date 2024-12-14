<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components Data Contoller
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Controller
 */
class Components_dataController extends Controller{
	public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }
	/**
     * check if username value already exist in User
	 * @param string $value
     * @return bool
     */
	function user_username_exist(Request $request, $value){
		$exist = DB::table('user')->where('username', $value)->value('username');   
		if($exist){
			return "true";
		}
		return "false";
	}
	/**
     * check if email value already exist in User
	 * @param string $value
     * @return bool
     */
	function user_email_exist(Request $request, $value){
		$exist = DB::table('user')->where('email', $value)->value('email');   
		if($exist){
			return "true";
		}
		return "false";
	}
	/**
	* linechart_pertumbuhanstasi Model Action
	* @return array
	*/
	function linechart_pertumbuhanstasi(Request $request){
		$chart_data  = [];
		$sqltext = "SELECT 
    COUNT(*) AS number_of_entries,
    YEAR(tanggal_input) AS year
FROM 
    stasi
GROUP BY 
    YEAR(tanggal_input)
ORDER BY 
    year ASC;
";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'year');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'number_of_entries'),
			'label' => "Jumlah",
			'backgroundColor' =>  random_color(), 
			'borderColor' =>  random_color(), 
			'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	/**
	* barchart_totalumat Model Action
	* @return array
	*/
	function barchart_totalumat(Request $request){
		$chart_data  = [];
		$sqltext = "SELECT YEAR(s.tanggal_input) AS year_of_tanggal_input, SUM(s.total_umat) AS sum_of_total_umat
FROM stasi AS s
GROUP BY YEAR(s.tanggal_input);";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'year_of_tanggal_input');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'sum_of_total_umat'),
			'label' => "Total Umat",
			'backgroundColor' =>  random_color(), 
			'borderColor' =>  random_color(), 
			'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
}
