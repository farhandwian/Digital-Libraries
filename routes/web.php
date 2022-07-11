<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//dari ecommerce

//Route::get('/', 'HomeController@index')->name('home.index');

//ori

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

//Route::post('/register','Auth\RegisterController@store')->name('register.store');

// Home page untuk user
Route::get('/', 'PageController@index');

# routing untuk nampilin buku secara umum
Route::get('/search', 'PageController@search');

#routing untuk detail buku
Route::get('/buku/biblio/{biblio:id}', 'PageController@show');
#routing untuk mengajukan sewa dari customer
Route::post('/buku/biblio/{koleksi:id}', 'TransaksiController@ajukanSewa')->name('transaksi.ajukanSewa');

#routing untuk review
Route::post('/buku/biblio/review/{biblio:id}', 'ReviewController@store');

Route::get('/dashboard/user/diPinjam','DashboardUserController@index')->name('dashboardUser.index');
Route::get('/dashboard/user/ajukanPinjam','DashboardUserController@ajukanPinjam')->name('dashboardUser.ajukanPinjam');
Route::get('/dashboard/user/riwayat','DashboardUserController@riwayat')->name('dashboardUser.riwayat');

#routing untuk dashboard admin
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');




Auth::routes();


Route::middleware('auth')->group(function(){
    #buku biblio dan koleksi
    #Route::resource('/buku','BukuController')->middleware('privilege:admin');
    Route::get('/buku/biblio','BiblioController@index')->name('buku.indexBiblio')->middleware('privilege:admin');
    Route::get('/buku/koleksi','KoleksiController@index')->name('buku.indexKoleksi')->middleware('privilege:admin');
    
    Route::get('/create-biblio','BiblioController@create')->name('buku.createBiblio')->middleware('privilege:admin');
    Route::get('/create-koleksi/{biblio:id}','KoleksiController@create')->name('buku.createKoleksi')->middleware('privilege:admin');
    Route::post('/store-biblio','BiblioController@store')->name('buku.storeBiblio')->middleware('privilege:admin');
    Route::post('/store-koleksi','KoleksiController@store')->name('buku.storeKoleksi')->middleware('privilege:admin');
    
    Route::get('/edit-biblio/{biblio:id}','BiblioController@edit')->name('buku.editBiblio')->middleware('privilege:admin');
    //Route::get('/edit-koleksi/{koleksi:id}','KoleksiController@edit')->name('buku.editKoleksi')->middleware('privilege:admin');
    Route::post('/update-biblio/{id}','BiblioController@update')->name('buku.updateBiblio')->middleware('privilege:admin');
    Route::post('/update-koleksi/{id}','KoleksiController@update')->name('buku.updateKoleksi')->middleware('privilege:admin');
    
    Route::delete('/delete-biblio/{id}','BiblioController@delete')->name('buku.deleteBiblio')->middleware('privilege:admin');
    Route::delete('/delete-koleksi/{id}','KoleksiController@delete')->name('buku.deleteKoleksi')->middleware('privilege:admin');
    
    Route::get('/search-biblio','BiblioController@search')->name('buku.searchBiblio')->middleware('privilege:admin');
    Route::get('/search-koleksi','KoleksiController@search')->name('buku.searchKoleksi')->middleware('privilege:admin');
    //Route::get('/buku-detail/{id}','BukuController@detail')->name('buku.detailBiblio')->middleware('privilege:admin');
    //Route::get('/buku-detail/{id}','BukuController@detail')->middleware('privilege:admin');
    
    

    #anggota
    Route::resource('/anggota','AnggotaController')->middleware('privilege:admin');
    Route::get('/create-anggota','AnggotaController@create')->name('anggota.create')->middleware('privilege:admin');
    Route::post('/store-anggota','AnggotaController@store')->name('anggota.store')->middleware('privilege:admin');
    
    Route::get('/edit-anggota/{anggota:id}','AnggotaController@edit')->name('anggota.edit')->middleware('privilege:admin');
    Route::put('/update-anggota/{id}','AnggotaController@update')->name('anggota.update')->middleware('privilege:admin');
    
    Route::get('/anggota-search','AnggotaController@search')->name('anggota.search')->middleware('privilege:admin');
    
    #transaksi
    Route::resource('/transaksi','TransaksiController')->middleware('privilege:admin');
    Route::get('/transaksi-edit/{transaksi:id}','TransaksiController@edit')->name('transaksi.edit')->middleware('privilege:admin');
    Route::post('/transaksi-update/{transaksi:id}','TransaksiController@update')->name('transaksi.update')->middleware('privilege:admin');
    Route::get('/transaksi-searchPeminjaman','TransaksiController@searchPeminjaman')->name('transaksi.searchPeminjaman')->middleware('privilege:admin');
    Route::get('/transaksi-searchPengembalian','TransaksiController@searchPengembalian')->name('transaksi.searchPengembalian')->middleware('privilege:admin');
    Route::post('/transaksi-action/{transaksi:id}','TransaksiController@action')->name('transaksi.action')->middleware('privilege:admin');
    Route::post('/transaksi-denda/{transaksi:id}','TransaksiController@denda')->name('transaksi.denda')->middleware('privilege:admin');
    
    #riwayat
    Route::resource('/riwayat','HistoryController')->middleware('privilege:admin');
    Route::get('/riwayat-search','HistoryController@search')->name('history.search')->middleware('privilege:admin');
    Route::get('/all','HistoryController@showAll')->name('riwayat.all')->middleware('privilege:admin');
    Route::get('/laporan','LaporanController@index')->name('laporan.index')->middleware('privilege:admin');
    Route::get('/buku-pdf','LaporanController@bukuPdf')->name('buku.pdf')->middleware('privilege:admin');
    Route::get('/buku-excel','LaporanController@bukuExcel')->name('buku.excel')->middleware('privilege:admin');
    Route::get('/transaksi-pdf','LaporanController@transaksiPdf')->name('transaksi.pdf')->middleware('privilege:admin');
    Route::get('/transaksi-excel','LaporanController@transaksiExcel')->name('transaksi.excel')->middleware('privilege:admin');
    Route::resource('/petugas','PetugasController');
});