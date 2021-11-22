<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Validator;


class ArtikelController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$artikel = Artikel::all();
		return response()->json([
			"success" => true,
			"message" => "Artikel List",
			"data" => $artikel
		]);
	}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'name' => 'required',
			'deskripsi' => 'required'
		]);

		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());       
		}
		$artikel = Artikel::create($input);
		return response()->json([
			"success" => true,
			"message" => "Artikel created successfully.",
			"data" => $artikel
		]);
	} 
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
	public function show($id)
	{
		$artikel = Artikel::find($id);
		if (is_null($artikel)) {
			return $this->sendError('Artikel not found.');
		}
		return response()->json([
			"success" => true,
			"message" => "Artikel retrieved successfully.",
			"data" => $artikel
		]);
	}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
	public function update(Request $request, Artikel $artikel)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'name' => 'required',
			'deskripsi' => 'required'
		]);
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());       
		}
		$artikel->name = $input['name'];
		$artikel->deskripsi = $input['deskripsi'];
		$artikel->save();
		return response()->json([
			"success" => true,
			"message" => "Artikel updated successfully.",
			"data" => $artikel
		]);
	}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
	public function destroy(Artikel $artikel)
	{
		$artikel->delete();
		return response()->json([
			"success" => true,
			"message" => "Artikel deleted successfully.",
			"data" => $artikel
		]);
	}
}
