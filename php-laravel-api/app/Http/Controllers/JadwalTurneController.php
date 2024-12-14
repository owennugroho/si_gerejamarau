<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalTurneAddRequest;
use App\Http\Requests\JadwalTurneEditRequest;
use App\Models\JadwalTurne;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JadwalturneListExport;
use Exception;
class JadwalTurneController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = JadwalTurne::query();
		if($request->search){
			$search = trim($request->search);
			JadwalTurne::search($query, $search);
		}
		$orderby = $request->orderby ?? "jadwal_turne.id_jadwal";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $this->paginate($query, JadwalTurne::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = JadwalTurne::query();
		$record = $query->findOrFail($rec_id, JadwalTurne::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(JadwalTurneAddRequest $request){
		$modeldata = $request->validated();
		
		//save JadwalTurne record
		$record = JadwalTurne::create($modeldata);
		$rec_id = $record->id_jadwal;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(JadwalTurneEditRequest $request, $rec_id = null){
		$query = JadwalTurne::query();
		$record = $query->findOrFail($rec_id, JadwalTurne::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
			$record->update($modeldata);
		}
		return $this->respond($record);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = JadwalTurne::query();
		$query->whereIn("id_jadwal", $arr_id);
		$query->delete();
		return $this->respond($arr_id);
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ListJadwalTurneReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(JadwalTurne::exportListFields());
			return view("reports.jadwalturne-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(JadwalTurne::exportListFields());
			$pdf = PDF::loadView("reports.jadwalturne-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
	}
}
