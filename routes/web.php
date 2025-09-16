    <?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Mail;
    use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
    use Laravel\Fortify\Http\Controllers\NewPasswordController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\Auth\VerifyEmailController;
    use App\Http\Controllers\Auth\PasswordController;
    use App\Http\Controllers\Auth\CustomVerifyEmailController;
    use App\Http\Controllers\SoalController;
    use App\Http\Controllers\FormPenilaianController;
    use App\Http\Controllers\JadwalTahapanController;
    use App\Http\Controllers\FormPenilaianSatkerController;
    use App\Http\Controllers\SatkerMonitorController;
    use App\Http\Controllers\BantuanController;


    // Mengatur Ubah Password ketika Verifikasi
    Route::get('/email/verify/{id}/{hash}', [CustomVerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');


    //Route untuk login ketika gagal verifikasi dan ingin ke menu Login
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
    ])->group(function () {
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });




    //Route untuk menampilkan halaman setup OTP
    Route::middleware('auth')->group(function () {
        Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');

        Route::get('/two-factor/setup', function () {
            return view('profile.two-factor-authentication-form');
        })->name('two-factor.setup');

        // Route::view('/two-factor-challenge', 'auth.two-factor-challenge')
        // ->name('two-factor.login');
    });

    //Route untuk fitur setelah login dan akun sudah Verifikasi
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        'password.changed'
        // '2fa.gate'
    ])->group(function () {

        Route::get('/dashboard', [FormPenilaianSatkerController::class, 'showHome'])->name('dashboard');
        Route::get('/', [FormPenilaianSatkerController::class, 'showHome'])->name('dashboard');
        Route::get('/home', [FormPenilaianSatkerController::class, 'listFormSatker'])->name('home');
        Route::get('/chart-data/{formSatker}', [FormPenilaianSatkerController::class, 'chartData'])->name('chart.data');
        
        //Bantuan
        Route::resource('bantuan', BantuanController::class); 

        Route::middleware(['role:Admin|Admin Provinsi|Admin Kabupaten'])->group(function () {
            
            // Route untuk dataTable
            Route::get('/user/get-data', [UserController::class, 'getData'])->name('user.getData');
            
            Route::get('user/data', [UserController::class, 'getData'])->name('user.data');

            //Router sebelum pakai dataTables
            Route::resource('userList', UserController::class); 
        
            Route::resource('user', UserController::class); 
        });

        Route::middleware(['role:Admin'])->group(function () {
            //Form Penilaian
            Route::get('/formPenilaian/getFormPenilaian', [FormPenilaianController::class, 'getFormPenilaian'])->name('formPenilaian.getFormPenilaian');
            Route::resource('formPenilaian', FormPenilaianController::class);
            Route::get('formPenilaian/{id_formPenilaian?}/edit', [FormPenilaianController::class, 'edit'])->name('formPenilaian.editFormPenilaian');
            Route::put('formPenilaian/update/{id}', [FormPenilaianController::class, 'update'])->name('formPenilaianController.updateFormPenilaian');
            Route::post('/form-penilaian-satker/generate/{formPenilaianId}', [FormPenilaianController::class, 'generateForm'])->name('formPenilaianSatker.generate');
            Route::get('form-penilaian/create', [FormPenilaianController::class, 'create'])->name('formPenilaian.create');
            Route::post('form-penilaian', [FormPenilaianController::class, 'store'])->name('formPenilaian.store');

            //Soal
            Route::get('soal/data/{tahun?}', [SoalController::class, 'data'])->name('soal.data');
            Route::get('/soal/tahunSoal', [SoalController::class, 'getTahunSoal'])->name('soal.getTahunSoal');
            Route::resource('soal', SoalController::class);
            Route::post('tahun-soal', [SoalController::class, 'store'])->name('soal.store');
            Route::get('/tambah-soal/tambah/{id_tahun_soal}', [SoalController::class, 'createSoal'])->name('soal.addSoal');
            Route::post('soal', [SoalController::class, 'storeSoal'])->name('soal.storeSoal');
            Route::get('soal/{id?}/editSoal', [SoalController::class, 'editSoal'])->name('soal.editSoal');
            Route::put('soal/update/{id}', [SoalController::class, 'updateSoal'])->name('soal.updateSoal');
            Route::get('soal/{id?}', [SoalController::class, 'show'])->name('soal.showSoal');
            Route::delete('soal-delete/{id}', [SoalController::class, 'destroy'])->name('soal.destroy');

            //jawaban
            Route::get('soal/jawaban-view/{id_soal?}', [SoalController::class, 'showJawaban'])->name('soal.showJawaban');
            Route::get('soal/jawaban/{id_soal?}', [SoalController::class, 'getJawaban'])->name('soal.getJawaban');
            Route::get('jawaban/{id_jawaban?}/edit', [SoalController::class, 'editJawaban'])->name('jawaban.editJawaban');
            Route::put('jawaban/update/{id}', [SoalController::class, 'updateJawaban'])->name('jawaban.updateJawaban');

            
            //Jadwal Tahapan
            Route::get('/jadwal-tahapan/data', [JadwalTahapanController::class, 'getFormPenilaian'])->name('jadwal-tahapan.formPenilaian');
            Route::get('jadwal-tahapan/data/{id_form_penilaian?}', [JadwalTahapanController::class, 'getJadwalTahapan'])->name('jadwal-tahapan.getJadwalTahapan');
            Route::resource('jadwal-tahapan', JadwalTahapanController::class);

            //Dashboard List Satker
            Route::get('/satker', [SatkerMonitorController::class, 'index'])->name('satker.index');
            Route::get('/satker/data', [SatkerMonitorController::class, 'data'])->name('satker.data');
            Route::get('/satker/{formSatker}', [SatkerMonitorController::class, 'show'])->name('satker.show');

            Route::get('/satker/{formSatker}/chart',   [SatkerMonitorController::class, 'chartData'])->name('satker.chart');
            Route::get('/satker/{formSatker}/soal',    [SatkerMonitorController::class, 'soalData'])->name('satker.soal');
            Route::get('/satker/{formSatker}/jawaban', [SatkerMonitorController::class, 'jawabanData'])->name('satker.jawaban');

            Route::get('/statistik', [FormPenilaianSatkerController::class, 'showStatistik'])->name('home');

            //View Detail Modal Indikator
            Route::get('satker/jawaban/modal/{id_penilaian_jawaban}/{id_jawaban}', [SatkerMonitorController::class, 'getModalJawaban'])->name('satker.jawaban.modal');

            //Unlock Form Satker
            Route::post('/satkerMonitor/unlock/{id}', [SatkerMonitorController::class, 'unlockSatker'])->name('satkerMonitor.unlockSatker');

            
        });


        //Penilaian Satker
        Route::get('formPenilaianSatker/getFormPenilaianSatker', [FormPenilaianSatkerController::class, 'getFormPenilaianSatker'])->name('formPenilaianSatker.getFormPenilaianSatker');
        Route::resource('formPenilaianSatker', FormPenilaianSatkerController::class);

        // Untuk DataTables: Soal per tahun soal
        Route::get('formPenilaianSatker/penilaianSoal/{id_formPenilaianSatker}/soal', [FormPenilaianSatkerController::class, 'getPenilaianSoal'])->name('formPenilaianSatker.getPenilaianSoal');

        //Button Kembali untuk penilaian Soal
        Route::get('/formPenilaianSatker/penilaian-soal/{id_form_ps}',[FormPenilaianSatkerController::class, 'pagePenilaianSoal'])->name('formPenilaianSatker.getPenilaianSoalPage');

        // Untuk nested jawaban per soal
        Route::get('formPenilaianSatker/penilaianSoal/jawaban/{id_penilaian_soal}', [FormPenilaianSatkerController::class, 'getJawaban'])->name('formPenilaianSatker.getJawabanSoal');
        
        //Untun DataTablesJawaban
        Route::get('form-penilaian-satker/penilaianJawaban/{id_penilaianSoal}/jawaban', [FormPenilaianSatkerController::class, 'showPenilaianJawaban'])->name('formPenilaianSatker.getPenilaianJawaban');

        // Untuk nested jawaban per soal
        Route::get('formPenilaianSatker/penilaianSoal/jawaban/pilihan/{id_penilaianJawaban}', [FormPenilaianSatkerController::class, 'getPilihan'])->name('formPenilaianSatker.getPilihanJawaban');

        //generate soal dan jawaban
        Route::post('/form-penilaian-satker/{id}/generate', [FormPenilaianSatkerController::class, 'generateSoalJawaban'])->name('formPenilaianSatker.generateSoalJawaban');
        
        //Modal Penilaian Jawaban dan pilihan
        Route::get('formPenilaianSatker/modal-jawaban/{id_penilaianSoal}/{id_jawaban}', [FormPenilaianSatkerController::class, 'getModalJawaban'])->name('formPenilaianSatker.getModalJawaban');
        Route::post('/simpan-jawaban', [FormPenilaianSatkerController::class, 'simpanJawaban'])->name('formPenilaianSatker.simpanJawaban');

        //Kunci/submit form
        Route::post('/formPenilaianSatker/{id}/kunci', [FormPenilaianSatkerController::class, 'kunciForm'])->name('formPenilaianSatker.kunci');

        //Indek Kematangan dan predikat
        Route::get('/dashboard/summary/{formSatker}',[FormPenilaianSatkerController::class, 'summaryData'])->name('dashboard.summary');

        //Data Dashboard untuk aspek
        Route::get('/dashboard/soal-data/{formSatker}', [FormPenilaianSatkerController::class, 'tableSoalData'])->name('dashboard.soalData');

        //Data untuk Dashboard mengambil data Indikator
        Route::get('/dashboard/jawaban/{formSatker}', [FormPenilaianSatkerController::class, 'jawabanData'])->name('dashboard.jawaban');



    });

    //untuk reset Password
    Route::put('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.reset');

