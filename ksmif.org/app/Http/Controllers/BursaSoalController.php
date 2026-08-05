<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Exception;
use App\Models\BursaSoal;
use App\Models\Matkul;
use App\Models\User;

class BursaSoalController
{
    function bursaSoal(){
        $bursaSoal = BursaSoal::with('matkul','users')->get();
	$matkul    = Matkul::get();
	$data 	   = [];

	if($bursaSoal->isNotEmpty()){
		$data += [
		'tahun' => $bursaSoal->pluck('tahun')->unique(),
		'bursaSoal'=> $bursaSoal
		];
	}else{
		$data += [
		'bursaSoal' => false
		];
	}

        $data+=['navbar'   => 'bursaSoal',
               'matkul'   => $matkul,
               'auth'     => Auth::user()
               ];
        return view('bursaSoal.bursaSoal', compact('data'));
         //return response()->json($data);
    }

    function bursaSoalBy(Request $req){
        $year   = $req->query('year');
        $matkul = $req->query('matkul');
        $search = $req->query('search');

        $bursaSoal = BursaSoal::query()->with('matkul');
        
        if($search){
            $keywords = explode(' ', $search);

            $bursaSoal->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('nama_file', 'LIKE', '%' . $word . '%');
                }
            });
        }

        if($matkul && $matkul != 'all'){
            $bursaSoal->where('matkul_id', $matkul);
        }else if($year && $year != 'all'){
            $bursaSoal->where('tahun', $year);
        }

        $data = [
            'result' => $bursaSoal->get()
        ];

        return response()->json($data);
    }

    function editBursa(){
        $matkul = Matkul::get();
        $bursaSoal = BursaSoal::with('matkul', 'users')->get();

        $dataBursa = [];
        foreach ($bursaSoal as $i) {
            $dataBursa[] = [
                'id'      => $i->id,
                'namaFile'=> $i->nama_file,
                'matkul'  => $i->matkul,
                'user'    => $i->users,
                'tipe'    => $i->tipe,
                'tahun'   => $i->tahun,
                'uploadAt'=> $i->updated_at
            ];
        }

        $tipe   = ['Quiz','UTS', 'UAS', 'Latihan'];
        $data = [
            'userLogin' => Auth::user(),
            'matkul'    => $matkul,
            'tipe'      => $tipe,
            'bursaSoal' => $dataBursa
            ];

        return view('dashboard.editBursa', compact('data'));
    }

    function uploadSoal(Request $req)
    {
        try {
            $req->validate([
                'file'     => 'required|file|mimes:pdf,doc,docx,jpg,png|max:20240',
                'namaFile' => 'required|string|max:255',
                'matkul'   => 'required|string|max:8',
                'tahun'    => 'required|digits:4',
                'tipe'     => 'required|in:UTS,UAS,Quiz,Latihan',
            ]);

            $file         = $req->file('file');
            $namaFile     = $req->input('namaFile');
            $uploader     = Auth::id();
            $matkul       = $req->input('matkul');
            $tahun        = $req->input('tahun');
            $tipe         = $req->input('tipe');
            $gdFolder     = env('GD_FOLDER_SOAL');
            $appScriptUrl = env('GD_UPLOAD_SOAL');

            if (!$gdFolder)     throw new \Exception('GD_FOLDER_ID tidak ditemukan :(');
            if (!$appScriptUrl) throw new \Exception('APPSCRIPT_URL tidak ditemukan :(');

            $response = Http::timeout(120)
                            ->asJson()
                            ->post($appScriptUrl, [
                                'fileName'   => $namaFile,
                                'fileBase64' => base64_encode($file->getContent()),
                                'folderId'   => $gdFolder,
                                'mimeType'   => $file->getMimeType() ?: 'application/octet-stream',
                            ]);

            $result = $response->json();

            if (!$response->successful() || !($result['success'] ?? false)) {
                throw new \Exception(
                    $result['error'] ?? 'Apps Script gagal memproses file'
                );
            }

            $bursaSoal = new BursaSoal();
            $bursaSoal->uploaded_by = $uploader;
            $bursaSoal->nama_file   = $namaFile;
            $bursaSoal->matkul_id   = $matkul;
            $bursaSoal->tahun       = $tahun;
            $bursaSoal->tipe        = $tipe;
            $bursaSoal->path        = $result['fileId'];
            $bursaSoal->save();

            return response()->json([
                'pesan' => 'Mantap bang! File sukses diupload :D',
                'file_id_drive' => $result['fileId'],
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'pesan' => 'Validasi gagal: '.implode(', ', $e->errors()),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Upload error: '.$e->getMessage());
            return response()->json(['pesan' => $e->getMessage(),], 500);
        }
    }
    
    function deleteSoal(Request $req){
        try{
            $id = $req->input('id');

            $bursaSoal = BursaSoal::find($id);
            $gdFolder     = env('GD_FOLDER_SOAL');
            $appScriptUrl = env('GD_DELETE_SOAL');

            if (!$gdFolder)     throw new \Exception('GD_FOLDER_ID tidak ditemukan :(');
            if (!$appScriptUrl) throw new \Exception('APPSCRIPT_URL tidak ditemukan :(');

            if(!$bursaSoal) throw new \Exception('data bursa soal tidak ditemukan !!');
            \Log::info("kirim path :".$bursaSoal->path);
            $response = Http::timeout(120)
                            ->asJson()
                            ->post($appScriptUrl,[
                                'fileId'   => $bursaSoal->path
                            ]);

            $result = $response->json();
            if (!$response->successful() || !($result['success'] ?? false)) {
                throw new \Exception(
                    $result['error'] ?? 'Apps Script gagal memproses file'
                );
            }

            $bursaSoal->delete();

            return response()->json([
                'pesan' => 'Mantap bang! File sukses dihapus :D',
                'file_id_drive' => $result['fileId'],
            ], 201);

        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'pesan' => 'Validasi gagal: '.implode(', ', $e->errors()),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Delete error: '.$e->getMessage());
            return response()->json(['pesan' => $e->getMessage(),], 500);
        }
    }
}
