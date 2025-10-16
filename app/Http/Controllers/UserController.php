<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Tingkat;
use App\Models\Wilayah;
use App\Models\UserProfile;
use App\Notifications\SendDefaultPasswordNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $loggedInUser = auth()->user();
        $authRole = $loggedInUser->roles->first()->name;
        $profile = $loggedInUser->profile;
    
        // Ambil user beserta profile dan role
        $query = User::with(['profile', 'roles']);
    
        if ($authRole === 'Admin') {
            // Admin bisa lihat semua
            $users = $query->get();

            $totalUser = $query->count();
            $totalAdmin = User::whereHas('roles', function($q) {
                $q->whereIn('name', ['Admin', 'Admin Provinsi', 'Admin Kabupaten']);
            })->count();
            
            $totalOperator = User::whereHas('roles', function($q) {
                $q->whereIn('name', ['Operator Provinsi', 'Operator Kabupaten']);
            })->count();

            $totalVerified = User::whereNotNull('email_verified_at')->count();

            //untuk kebutuhan Filter
            $tingkats = Tingkat::all();
            $roles = Role::all();
            $wilayahList = Wilayah::all();
        }
        elseif ($authRole === 'Admin Provinsi') {
            $provId = $profile->wilayah_id;
    
            // Hanya lihat user yang:
            // - role-nya Operator Provinsi atau Admin Kabupaten
            // - wilayahnya adalah provinsi sendiri ATAU anak kabupaten dari provinsi
            $users = (clone $query)->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['Operator Provinsi', 'Admin Kabupaten']);
                })
                ->whereHas('profile', function ($q) use ($provId) {
                    $q->where('wilayah_id', $provId)
                      ->orWhereIn('wilayah_id', function ($subQuery) use ($provId) {
                          $subQuery->select('id')->from('wilayah')->where('id_parent', $provId);
                      });
                })->get();
            
            $totalUser = $users->count();
            $totalAdmin = (clone $query)->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['Admin Kabupaten']);
                })
                ->whereHas('profile', function ($q) use ($provId) {
                    $q->where('wilayah_id', $provId)
                    ->orWhereIn('wilayah_id', function ($subQuery) use ($provId) {
                        $subQuery->select('id')->from('wilayah')->where('id_parent', $provId);
                    });
                })->count();

            $totalOperator = (clone $query)->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['Operator Provinsi']);
                })
                ->whereHas('profile', function ($q) use ($provId) {
                    $q->where('wilayah_id', $provId)
                    ->orWhereIn('wilayah_id', function ($subQuery) use ($provId) {
                        $subQuery->select('id')->from('wilayah')->where('id_parent', $provId);
                    });
                })->count();

            $totalVerified = (clone $query)->whereHas('roles', function ($q) {
                    $q->whereIn('name', ['Operator Provinsi', 'Admin Kabupaten']);
                })
                ->whereHas('profile', function ($q) use ($provId) {
                    $q->where('wilayah_id', $provId)
                    ->orWhereIn('wilayah_id', function ($subQuery) use ($provId) {
                        $subQuery->select('id')->from('wilayah')->where('id_parent', $provId);
                    });
                })
                ->whereNotNull('email_verified_at')
                ->count();

                //Kebutuhan Filter
                $tingkats = Tingkat::whereIn('id', [2, 3])->get(); // Provinsi, Kab/Kota
                $roles = Role::whereIn('name', ['Operator Provinsi', 'Admin Kabupaten'])->get();
                $wilayahList = Wilayah::where(function ($q) use ($provId) {
                    $q->where('id', $provId)->orWhere('id_parent', $provId);
                })->get();
        }
        elseif ($authRole === 'Admin Kabupaten') {
            // Lihat user dengan role Operator Kabupaten di wilayahnya sendiri
            $kabId = $profile->wilayah_id;
    
            $users = (clone $query)->whereHas('roles', function ($q) {
                    $q->where('name', 'Operator Kabupaten');
                })
                ->whereHas('profile', function ($q) use ($kabId) {
                    $q->where('wilayah_id', $kabId);
                })->get();

            $totalUser = $users->count();
            $totalAdmin = '-';
            $totalOperator = (clone $query)->whereHas('roles', function ($q) {
                    $q->where('name', 'Operator Kabupaten');
                })
                ->whereHas('profile', function ($q) use ($kabId) {
                    $q->where('wilayah_id', $kabId);
                })
                ->count();
                
            $totalVerified = (clone $query)->whereHas('roles', function ($q) {
                    $q->where('name', 'Operator Kabupaten');
                })
                ->whereHas('profile', function ($q) use ($kabId) {
                    $q->where('wilayah_id', $kabId);
                })
                ->whereNotNull('email_verified_at')
                ->count();

            

                //Kebutuhan filter
                $tingkats = Tingkat::where('id', 3)->get(); // Kab/Kota
                $roles = Role::where('name', 'Operator Kabupaten')->get();
                $wilayahList = Wilayah::where('id', $kabId)->get();
        }
        else {
            // Role Operator
            $users = collect();
        }
        return view('siantik.user.userList', 
            compact('users', 'tingkats', 'roles', 'wilayahList', 
                    'totalUser', 'totalAdmin', 'totalOperator',
                    'totalVerified'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', auth()->user());

        $authUser = auth()->user();

        $authRole = $authUser->getRoleNames()->first(); // Misal: 'Admin Provinsi'
        $profile = $authUser->profile;

        $roles = collect();
        $tingkats = collect();
        $wilayahList = collect();

        // ==== ADMIN ====
        if ($authRole === 'Admin') {
            $roles = Role::all();
            $tingkats = Tingkat::all();
            $wilayahList = Wilayah::all();
        }

        // ==== ADMIN PROVINSI ====
        elseif ($authRole === 'Admin Provinsi') {
            // Role yang bisa ditambahkan
            $roles = Role::whereIn('name', ['Operator Provinsi', 'Admin Kabupaten'])->get();

            // Tingkat hanya Provinsi & Kab/Kota
            $tingkats = Tingkat::whereIn('id', [2, 3])->get();

            // Wilayah hanya provinsinya sendiri dan kabupaten/kota di bawahnya
            $provId = $profile->wilayah_id;

            $wilayahList = Wilayah::where(function ($query) use ($provId) {
                $query->where('id', $provId)
                    ->orWhere('id_parent', $provId);
            })->get();
        }

        // ==== ADMIN KABUPATEN ====
        elseif ($authRole === 'Admin Kabupaten') {
            $roles = Role::where('name', 'Operator Kabupaten')->get();
            $tingkats = Tingkat::where('id', 3)->get();

            // Wilayah hanya kabupaten/kota miliknya sendiri
            $wilayahList = Wilayah::where('id', $profile->wilayah_id)->get();
        }

        return view('siantik.user.addUser', compact('roles', 'tingkats', 'wilayahList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cek otorisasi role dulu
        $authUser = auth()->user();
        $authRole = $authUser->getRoleNames()->first();
        $profile = $authUser->profile;

        // Daftar role yang boleh dibuat oleh masing-masing
        $allowedRoleNames = match($authRole) {
            'Admin' => ['Admin', 'Admin Provinsi', 'Operator Provinsi', 'Admin Kabupaten', 'Operator Kabupaten'],
            'Admin Provinsi' => ['Operator Provinsi', 'Admin Kabupaten'],
            'Admin Kabupaten' => ['Operator Kabupaten'],
            default => [],
        };

        // Ambil nama role dari ID
        $roleModel = Role::findOrFail($request->role); // ID → Role model
        $roleName = $roleModel->name;

        // Bandingkan berdasarkan nama
        if (!in_array($roleName, $allowedRoleNames)) {
            abort(403, 'Anda tidak diizinkan menetapkan role ini.');
        }
        //end cek Otorisasi

        // dd($request);

        $request->validate([
            'role' => 'required',
            'tingkat' => 'required',
            'wilayah' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|string|max:20|unique:user_profiles,nip',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'role' => 'required|exists:roles,id',
            'tingkat' => 'required|exists:tingkat,id',
            'wilayah' => 'required|exists:wilayah,id',
            'jabatan' => 'required|string|max:255',
            'satker' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Buat user dengan default password
            $password = Str::random(10);
            $hashPassword = Hash::make($password);
            // dd($hashPassword);
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $hashPassword,
                'plain_password' => $password,
                'status' => 'aktif',
                'email_verified_at' => null,
            ]);

            // Kirim notifikasi ke email
            $user->notify(new SendDefaultPasswordNotification($password));

            // Assign role
            $roleName = \Spatie\Permission\Models\Role::findOrFail($request->role)->name;
            $user->assignRole($roleName);

            // Buat profil pengguna
            $user->profile()->create([
                'nip' => $request->nip,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'tingkat_id' => $request->tingkat,
                'wilayah_id' => $request->wilayah,
                'jabatan' => $request->jabatan,
                'satker' => $request->satker,
            ]);

            // (Optional) Kirim email aktivasi jika diminta
            if ($request->has('send_email')) {
                event(new Registered($user));
            }


            DB::commit();

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan' . ($request->has('send_email') ? ' dan email verifikasi telah dikirim.' : '.'));
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $userToEdit = User::with('roles', 'profile')->findOrFail($id);

        //memberikan akses sesuai UserPolicy
        $this->authorize('update', $userToEdit);

        $authUser = auth()->user();
        $authRole = $authUser->getRoleNames()->first(); // Misal: 'Admin Provinsi'
        $profile = $authUser->profile;

        $roles = collect();
        $tingkats = collect();
        $wilayahList = collect();

        // ==== ADMIN ====
        if ($authRole === 'Admin') {
            $roles = Role::all();
            $tingkats = Tingkat::all();
            $wilayahList = Wilayah::all();
        }

        // ==== ADMIN PROVINSI ====
        elseif ($authRole === 'Admin Provinsi') {
            // Role yang bisa ditambahkan
            $roles = Role::whereIn('name', ['Operator Provinsi', 'Admin Kabupaten'])->get();

            // Tingkat hanya Provinsi & Kab/Kota
            $tingkats = Tingkat::whereIn('id', [2, 3])->get();

            // Wilayah hanya provinsinya sendiri dan kabupaten/kota di bawahnya
            $provId = $profile->wilayah_id;

            $wilayahList = Wilayah::where(function ($query) use ($provId) {
                $query->where('id', $provId)
                    ->orWhere('id_parent', $provId);
            })->get();
        }

        // ==== ADMIN KABUPATEN ====
        elseif ($authRole === 'Admin Kabupaten') {
            $roles = Role::where('name', 'Operator Kabupaten')->get();
            $tingkats = Tingkat::where('id', 3)->get();

            // Wilayah hanya kabupaten/kota miliknya sendiri
            $wilayahList = Wilayah::where('id', $profile->wilayah_id)->get();
        }

        return view('siantik.user.editUser', compact('userToEdit', 'roles', 'tingkats', 'wilayahList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Cek Authenticated user
        $authUser = auth()->user();
        $authRole = $authUser->getRoleNames()->first();
        $profile = $authUser->profile;

        // Role yang diizinkan
        $allowedRoleNames = match($authRole) {
            'Admin' => ['Admin', 'Admin Provinsi', 'Operator Provinsi', 'Admin Kabupaten', 'Operator Kabupaten'],
            'Admin Provinsi' => ['Operator Provinsi', 'Admin Kabupaten'],
            'Admin Kabupaten' => ['Operator Kabupaten'],
            default => [],
        };

        // Ambil nama role dari ID yang dikirim
        $roleModel = Role::findOrFail($request->role);
        $roleName = $roleModel->name;

        if (!in_array($roleName, $allowedRoleNames)) {
            abort(403, 'Anda tidak diizinkan mengatur role ini.');
        }
        // End cek

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nip' => 'required|string|max:20|unique:user_profiles,nip,' . $id . ',user_id',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'role' => 'required|exists:roles,id',
            'tingkat' => 'required|exists:tingkat,id',
            'wilayah' => 'required|exists:wilayah,id',
            'jabatan' => 'required|string|max:255',
            'satker' => 'required|string|max:255',
        ]);

        // VALIDASI RELASI ROLE - TINGKAT - WILAYAH
        $roleId = $request->input('role');
        $tingkatId = $request->input('tingkat');
        $wilayahId = $request->input('wilayah');

        // Mapping role ke tingkat_wilayah
        $roleToTingkatWilayah = [
            1 => 0, // Pusat
            2 => 1, 3 => 1, // Provinsi
            4 => 2, 5 => 2, // Kab/Kota
        ];

        $expectedTingkat = [
            0 => 1, // Pusat
            1 => 2, // Provinsi
            2 => 3, // Kab/Kota
        ];

        $wilayah = Wilayah::findOrFail($wilayahId);

        $expectedWilayahTingkat = $roleToTingkatWilayah[$roleId] ?? null;
        $expectedTingkatId = $expectedTingkat[$expectedWilayahTingkat] ?? null;

        if (
            $wilayah->tingkat_wilayah != $expectedWilayahTingkat ||
            $tingkatId != $expectedTingkatId
        ) {
            return back()->withErrors(['wilayah' => 'Wilayah tidak sesuai dengan role/tingkat.'])->withInput();
        }

        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);

            // Update Role
            $roleName = \Spatie\Permission\Models\Role::findOrFail($request->role)->name;
            $user->syncRoles([$roleName]);

            // Update atau buat profile (jika belum ada)
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => $request->nip,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'tingkat_id' => $request->tingkat,
                    'wilayah_id' => $request->wilayah,
                    'jabatan' => $request->jabatan,
                    'satker' => $request->satker,
                ]
            );

            if ($request->has('send_email')) {
                // Reset status verifikasi email
                $user->email_verified_at = null;
                $user->save();
            
                // Kirim ulang email verifikasi
                $user->notify(new SendDefaultPasswordNotification($user->plain_password));
                event(new Registered($user));
            }

            DB::commit();

            return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // softdelete
        $user->delete();

        return redirect()->route('user.index')->with('successHapus', 'Pengguna berhasil dihapus');
    }


    public function getData(Request $request)
        {
            try {
                $loggedInUser = auth()->user();
                $authRole = $loggedInUser->roles->first()->name;
                $profile = $loggedInUser->profile;

                $query = User::with(['profile.wilayah', 'roles']);

                if ($authRole === 'Admin') {
                    // Admin lihat semua
                } elseif ($authRole === 'Admin Provinsi') {
                    $provId = $profile->wilayah_id;
                    $query = $query->whereHas('roles', fn($q) =>
                        $q->whereIn('name', ['Operator Provinsi', 'Admin Kabupaten'])
                    )->whereHas('profile', fn($q) => 
                        $q->where('wilayah_id', $provId)
                        ->orWhereIn('wilayah_id', function ($sub) use ($provId) {
                            $sub->select('id')->from('wilayah')->where('id_parent', $provId);
                        })
                    );
                } elseif ($authRole === 'Admin Kabupaten') {
                    $kabId = $profile->wilayah_id;
                    $query = $query->whereHas('roles', fn($q) =>
                        $q->where('name', 'Operator Kabupaten')
                    )->whereHas('profile', fn($q) =>
                        $q->where('wilayah_id', $kabId)
                    );
                } else {
                    return DataTables::of(collect())->make(true);
                }

                if ($request->filled('filter_tingkat')) {
                    $query->whereHas('profile', function ($q) use ($request) {
                        $q->where('tingkat_id', $request->filter_tingkat);
                    });
                }

                if ($request->filled('filter_wilayah')) {
                    $query->whereHas('profile.wilayah', function ($q) use ($request) {
                        $q->where('id', $request->filter_wilayah);
                    });
                }

                if ($request->filled('filter_role')) {
                    $query->whereHas('roles', function ($q) use ($request) {
                        $q->where('name', $request->filter_role);
                    });
                }

                if ($request->filled('filter_status')) {
                    $query->where('status', $request->filter_status);
                }

                if ($request->filled('search_text')) {
                    $search = $request->search_text;
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhereHas('profile', fn($p) => $p->where('nip', 'like', "%$search%"));
                    });
                }

                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('wilayah', fn($user) => $user->profile->wilayah->satker ?? '-')
                    ->addColumn('role', fn($user) => $user->roles->first()->name ?? '-')
                    ->addColumn('user', fn($user) => view('siantik.user._partials.nama_email', compact('user'))->render())
                    ->addColumn('nip', fn($user) => $user->profile->nip ?? '-')
                    ->addColumn('jabatan', fn($user) => $user->profile->jabatan ?? '-')
                    ->addColumn('satker', fn($user) => $user->profile->satker ?? '-')
                    ->addColumn('status', function ($user){
                        $statusClass = $user->status === 'aktif' 
                            ? 'badge-light-success' 
                            : 'badge-light-danger';

                        return '<div class="badge fw-bolder '.$statusClass.'">'.$user->status.'</div>';
                    })
                    ->addColumn('verifikasi', function ($user) {
                        return $user->email_verified_at
                            ? '<span class="badge badge-light-success">Terverifikasi</span>'
                            : '<span class="badge badge-light-danger">Belum Verifikasi</span>';
                    })
                    ->addColumn('aksi', fn($user) => view('siantik.user._partials.aksi', compact('user'))->render())
                    ->rawColumns(['user', 'status', 'verifikasi', 'aksi'])
                    ->make(true);
            } catch (\Throwable $e) {
                Log::error('Get DataTables Error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage()
                ], 500);
            }
        }

}
