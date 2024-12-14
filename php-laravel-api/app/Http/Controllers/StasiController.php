<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StasiAddRequest;
use App\Http\Requests\StasiEditRequest;
use App\Models\Stasi;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StasiListExport;
use Exception;
class StasiController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Stasi::query();
		if($request->search){
			$search = trim($request->search);
			Stasi::search($query, $search);
		}
		$orderby = $request->orderby ?? "stasi.id_stasi";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $this->paginate($query, Stasi::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Stasi::query();
		$record = $query->findOrFail($rec_id, Stasi::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(StasiAddRequest $request){
		$modeldata = $request->validated();
		
		if( array_key_exists("foto_gereja", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto_gereja'], "foto_gereja");
			$modeldata['foto_gereja'] = $fileInfo['filepath'];
		}
		
		if( array_key_exists("foto_tanah", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto_tanah'], "foto_tanah");
			$modeldata['foto_tanah'] = $fileInfo['filepath'];
		}
		
		//save Stasi record
		$record = Stasi::create($modeldata);
		$rec_id = $record->id_stasi;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(StasiEditRequest $request, $rec_id = null){
		$query = Stasi::query();
		$record = $query->findOrFail($rec_id, Stasi::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $request->validated();
		
		if( array_key_exists("foto_gereja", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto_gereja'], "foto_gereja");
			$modeldata['foto_gereja'] = $fileInfo['filepath'];
		}
		
		if( array_key_exists("foto_tanah", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['foto_tanah'], "foto_tanah");
			$modeldata['foto_tanah'] = $fileInfo['filepath'];
		}
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
		$query = Stasi::query();
		$query->whereIn("id_stasi", $arr_id);
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
		$filename = "ListStasiReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Stasi::exportListFields());
			return view("reports.stasi-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Stasi::exportListFields());
			$pdf = PDF::loadView("reports.stasi-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
	}
}
