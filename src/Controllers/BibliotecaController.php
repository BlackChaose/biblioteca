<?php

namespace BlackChaose\Biblioteca\Controllers;

use BlackChaose\Biblioteca\Models\AttachedFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BlackChaose\Biblioteca\Models\Biblioteca;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BibliotecaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $arr = Biblioteca::with('attached_file')->get();
        // dd($arr);
        return view('vendor.biblioteca.biblioteca_list', ['arr' => $arr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_type = 'create';
        $biblioteca = new Biblioteca();
        return view('vendor.biblioteca.settings', ['form_type' => $form_type, 'biblioteca' => $biblioteca]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'string|min:3|max:255|required',
                'description' => 'string|min:0|max:255',
                'lang' => 'string|min:0|max:255',
                'author' => 'string|min:0|max:255',
            ]);

            if (empty($data)) {
                throw(new \Exception('Error! invalid form data!'));
            }
            $book = new Biblioteca($data);
            $res = $book->save();

            $result_code = 'ok';

            if (!empty($request->book_file)) {
                $destinationPathFolder = '/books/';
                $destinationPath = $destinationPathFolder . '_' . $book->id;

                $nf = Storage::disk('local')->putFile($destinationPath, $request->file('book_file'));

                $ff = new AttachedFile();
                $ff->bib_entity_id = $book->id;
                $ff->file_path = $nf;
                preg_match_all('/[a-zA-Z0-9]{1,}\.[a-zA-Z0-9]{1,3}$/m', $nf, $arr_filter);

                $file_save_name = $arr_filter[0][0];

                $ff->file_orig_name = $request->file('book_file')->getClientOriginalName();
                $ff->file_save_name = $file_save_name;
                $ff->save();

            }

        } catch (\Exception $e) {
            $res = $e->getMessage();
            //dd($e);
            $result_code = 'error';
        }
        $form_type = 'operation_result';
        return view('vendor.biblioteca.message', ['form_type' => $form_type, 'res' => $res, 'result_code' => $result_code]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Biblioteca::with('attached_file')->get()->where('id', '=', $id)->first();
        // dd($book);
        $form_type = "show";
        return view('vendor.biblioteca.settings', ['book' => $book, 'form_type' => $form_type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $biblioteca = Biblioteca::with('attached_file')->get()->find($id);
        $form_type = 'edit';
        //dd($biblioteca->attached_file[0]->file_path);
        return view('vendor.biblioteca.settings', ['form_type' => $form_type, 'biblioteca' => $biblioteca]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        try {
            $data = $request->validate([
                'name' => 'string|min:1|max:255|required',
                'description' => 'string|min:1|max:255|required',
                'lang' => 'string|min:1|max:100|required',
                'author' => 'string|min:1|max:255|required',
                'file_delete' => "string|min:4|max:5"
            ]);
            if (empty($data)) {
                throw(new \Exception('Error! invalid form data!'));
            }

            $book = Biblioteca::with('attached_file')->get()->find($id);
            $book->fill($data);
            $res = $book->save();

            if ($request['file_delete'] === "TRUE") {
                $af = AttachedFile::find($book->attached_file[0]->id);
                $af->delete();
            }

            $result_code = 'ok';

            if (!empty($request->book_file)) {

                $destinationPathFolder = 'books';
                $destinationPath = $destinationPathFolder . '_' . $book->id;
                $nf = Storage::disk('local')->putFile($destinationPath, $request->file('book_file'));
                $ff = new AttachedFile();
                $ff->bib_entity_id = $book->id;
                $ff->file_path = $nf;
                preg_match_all('/[a-zA-Z0-9]{1,}\.[a-zA-Z0-9]{1,3}$/m', $nf, $arr_filter);

                $file_save_name = $arr_filter[0][0];

                $ff->file_orig_name = $request->file('book_file')->getClientOriginalName();
                $ff->file_save_name = $file_save_name;

                $attached_file = $book->getRelation('attached_file')->first();
                if (!empty($attached_file)) {
                    $old_file = AttachedFile::find($attached_file->id);
                    $old_file->delete();
                }
                $ff->save();

            }

        } catch (\Exception $e) {
            $res = $e->getMessage();
            $result_code = 'error';
        }
        $form_type = 'operation_result';
        return view('vendor.biblioteca.message', ['form_type' => $form_type, 'res' => $res, 'result_code' => $result_code]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Biblioteca::with('attached_file')->get()->find($id);
            if (!empty($book->attached_file[0])) {
                $attached_file = AttachedFile::find($book->getRelation('attached_file')->first()->id);
                $attached_file->delete();
            }
            $book->delete();
            $result_code = 'ok';
            $res = "book was deleted!";
        } catch (\Exception $e) {
            $res = $e->getMessage();
            $result_code = 'error';
        }
        $form_type = 'operationa_result';
        return view('vendor.biblioteca.message', ['form_type' => $form_type, 'res' => $res, 'result_code' => $result_code]);
    }

    public function settings()
    {
        return view("vendor.biblioteca.settings");
    }

    public function getFileView($fileid)
    {
        $file = AttachedFile::find($fileid);
        return response()->file(storage_path('app/' . $file->file_path));
    }

    public function getFileDownload($fileid)
    {
        $file = AttachedFile::find($fileid);
        return Storage::disk('local')->download($file->file_path, $file->file_orig_name, []);

    }
}

