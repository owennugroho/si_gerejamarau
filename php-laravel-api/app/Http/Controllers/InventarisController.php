<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventarisAddRequest;
use App\Http\Requests\InventarisEditRequest;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventarisListExport;
use Exception;
class InventarisController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$query = Inventaris::query();
		if($request->search){
			$search = trim($request->search);
			Inventaris::search($query, $search);
		}
		$orderby = $request->orderby ?? "inventaris.id_inventaris";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a single field name
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $this->paginate($query, Inventaris::listFields());
		return $this->respond($records);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Inventaris::query();
		$record = $query->findOrFail($rec_id, Inventaris::viewFields());
		return $this->respond($record);
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add(InventarisAddRequest $request){
		$modeldata = $request->validated();
		
		//save Inventaris record
		$record = Inventaris::create($modeldata);
		$rec_id = $record->id_inventaris;
		return $this->respond($record);
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(InventarisEditRequest $request, $rec_id = null){
		$query = Inventaris::query();
		$record = $query->findOrFail($rec_id, Inventaris::editFields());
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
		$query = Inventaris::query();
		$query->whereIn("id_inventaris", $arr_id);
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
		$filename = "ListInventarisReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Inventaris::exportListFields());
			return view("reports.inventaris-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Inventaris::exportListFields());
			$pdf = PDF::loadView("reports.inventaris-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
	}
}
