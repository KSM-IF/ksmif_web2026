<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class UserLog
{
    function userLogin(Request $req){
        try{
            $username = $req->input('username');
            $passwd   = $req->input('password');
            if(strlen($username)<1 || strlen($passwd)<1) throw new Exception("Username or Password is empty", 0);
            $login = Auth::attempt(['username'=>$username, 'password'=>$passwd],true);
            if($login){ 
                /** @var \App\Models\User $user */
                $user  = Auth::user();
                $token = $user->createToken('login')->plainTextToken;
                $data  = [
                    'user' => $user,
                    'token'=> $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60,
                    'redirected' => "/dashboard/editMember"
                    ];
            }else{throw new Exception("Invalid username or password",0);}
            // return redirect("/dashboard/editMember",302)->with($data);
            return response()->json($data);
        }catch(Exception $ex){
            $data = ['err' => $ex->getMessage()];
            if($ex->getCode() == 0) return response()->json($data);
            return view("errors.{$ex->getCode()}",compact($data));
        }
    }

    function editMember(Request $req){
        try{
            $periode = $req->query('periode');
            $divisi  = $req->query('divisi');
            $data = [];
            $member = User::query()
                            ->join('members', 'users.id', '=', 'members.users_id')
                            ->select('users.*', 'members.*', 'users.id as user_id', 'members.id as member_id');

            if(!$periode && !$divisi){
                $now = (time() <= strtotime('01-10-2026')) ? '2025':'2026';
                $member->where('period', $now);
            }else{
                $member->where('period', $periode);
                if($divisi != 'ALL') $member->where('division', $divisi);
                $data += [
                    'tahun' => $periode,
                    'divisi'=> $divisi
                ];
            }
            $hasil       = $member->get();
            $allPeriode  = Members::pluck('period')->unique()->toArray();
            $allDivision = ['ALL','BPH', 'IRD', 'PRD', 'HRDD', 'CDD'];
            $data += [
                'userLogin'  => Auth::user(),
                'member'     => $hasil,
                'allPeriode' => $allPeriode,
                'allDivision'=> $allDivision,
            ];
            return view('dashboard.editMember', compact('data'));
            // return response()->json($data);
        }catch(Exception $ex){
            $data = ['err' => $ex->getMessage()];
            return view("errors.{$ex->getCode()}",compact('data'));
        }
    }

    function editMemberGetData(Request $req){
        try{
            $id = $req->query('id');
            $user = User::with('members')
                    ->find($id);
            $data = ['user' => $user];
            return response()->json($data);
        }catch(Exception $ex){
            $data = ['err' => $ex->getMessage()];
            return view("errors.{$ex->getCode()}",compact('data'));
        }
    }

   function editMemberPatch(Request $req){
        try{
            $id       = $req->query('id');
            $memberId = $req->query('member-id');

            if($req->filled('id')){
                $username = $req->input('username');
                $full_name= $req->input('fullname');
                $nrp      = $req->input('nrp');
                $email    = $req->input('email');
                $status   = $req->input('status');
                
                $user = User::find($id);
                $user->username = $username;
                $user->full_name= $full_name;
                $user->NRP      = $nrp;
                $user->email    = $email;
                $user->status   = (bool)$status;

                $tes = $user->save();

                return response()->json($tes);
                
            } else if($req->filled('member-id')){
                $periode = $req->input('periode');
                $division= $req->input('division');
                $photo   = $req->file('photo');
                $role    = $req->input('role');
                
                $gdFolder  = env('GD_FOLDER_PHOTO');
                $uploadUrl = env('GD_UPLOAD_PHOTO');
                $deleteUrl = env('GD_DELETE_PHOTO');

                $member = Members::find($memberId);
                $member->period   = $periode;
                $member->division = $division;
                $member->role     = $role;
                
                if($photo){
                    if (!$gdFolder)  throw new \Exception('GD_FOLDER_PHOTO tidak ditemukan :(');
                    if (!$uploadUrl) throw new \Exception('GD_UPLOAD_PHOTO tidak ditemukan :(');
                    if (!$deleteUrl) throw new \Exception('GD_DELETE_PHOTO tidak ditemukan :(');
                    
                    $user     = User::find($member->users_id);
                    $namaFile = "{$user->NRP}-{$periode}";

                    
                    $response = Http::withOptions(['allow_redirects' => true])
                        ->timeout(60)
                        ->asJson()
                        ->post($uploadUrl, [
                            'fileName'   => $namaFile,
                            'fileBase64' => base64_encode($photo->getContent()),
                            'folderId'   => $gdFolder,
                            'mimeType'   => $photo->getMimeType() ?: 'image/*',
                    ]);

                    $result = $response->json();

                    if (!$response->successful() || empty($result['success'])) {
                        $errorMsg = $result['error'] ?? $response->body();
                        throw new \Exception("GAS Error (Status: {$response->status()}): " . $errorMsg);
                    }

                    if (!blank($member->display_photo)) {
                        Http::withOptions(['allow_redirects' => true])
                            ->timeout(60)
                            ->asJson()
                            ->post($deleteUrl, [
                                'fileId' => $member->display_photo
                        ]);
                    }

                    $member->display_photo = $result['fileId'];
                }

                $member->save();

                $data = [
                    'status' => "berhasil update data",
                    'photo'  => $photo ? true : false
                ];
                return response()->json($data);
            }
        }catch(\Exception $ex){
            $data = ['err' => $ex->getMessage()];
            return response()->json($data, 500);
        }
    }

    function deleteUserData(Request $req){
        try {
            if($req->filled('id')){
                $id = $req->query('id');
                $user = User::find($id);
                if($user){
                    $member = Members::where('users_id',$user->id)->get();
                    foreach($member as $i){
                        $i->delete();
                    }
                    $user->delete();
                }else throw new Exception("Cannot find users", 400);
                $data = ['user' => $user,
                         'member' => $member,
                         'status' => true
                        ];
                return response()->json($data);
            }else if($req->filled('member-id')){
                $id = $req->query('member-id');
                $member = Members::find($id);
                $deleteUrl = env('GD_DELETE_PHOTO');
                
                $responseHapus = Http::timeout(60)
                            ->asJson()
                            ->post($deleteUrl,[
                                'fileId'   => $member->display_photo
                ]);

                $member->delete();
                $data = ['status'=> 'DATA BERHASIL DIHAPUS!!',];
                return response()->json($data);
            }
        } catch (Exception $ex) {
            $data = ['err' => $ex->getMessage()];
            return view("errors.{$ex->getCode()}",compact('data'));
        }
    }

    function addMemberData(Request $req){
        try{
            $member  = new Members;
            $usrId   = $req->input('usrId');
            $periode = $req->input('periode');
            $divisi  = $req->input('division');
            $role    = $req->input('role');
            $photo   = $req->file('photo');
            $gdFolder  = env('GD_FOLDER_PHOTO');
            $uploadUrl = env('GD_UPLOAD_PHOTO');
            $data    = [];

            $member->users_id = $usrId;
            $member->period   = $periode;
            $member->division = $divisi;
            $member->role     = $role;
            

            if($photo){
                if (!$gdFolder)  throw new \Exception('GD_FOLDER_PHOTO tidak ditemukan :(');
                if (!$uploadUrl) throw new \Exception('GD_UPLOAD_PHOTO tidak ditemukan :(');
                
                $user     = User::find($member->users_id);
                $namaFile = "{$user->NRP}-{$periode}";

                $response = Http::timeout(60)
                            ->asJson()
                            ->post($uploadUrl, [
                                'fileName'   => $namaFile,
                                'fileBase64' => base64_encode($photo->getContent()),
                                'folderId'   => $gdFolder,
                                'mimeType'   => $photo->getMimeType() ?: 'image/*',
                        ]);

                $result = $response->json();
                if (!$response->successful() || !($result['success'] ?? false)) {
                    throw new \Exception(
                        $result['error'] ?? 'Apps Script gagal memproses file'
                    );
                }

                $data['res']=$result;
                $member->display_photo = $result['fileId'];
            }
            $member->save();
            $data += ['status' => "data member berhasil di tambahkan"];
            return response()->json($data);
        }catch(Exception $ex){
            $data = ['err' => $ex->getMessage()];
            return response()->json($data, 500);
        }
    }
}
