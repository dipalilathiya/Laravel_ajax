<?php
use App\Http\Controllers\admincontroller;
use Illuminate\Support\Facades\Route;

Route::get('/form',[admincontroller::class,'form'])->name('form');
Route::get('/view',[admincontroller::class,'view'])->name('view');
Route::get('/viewdata',[admincontroller::class,'viewdata'])->name('viewdata');
Route::post('/CreateData',[admincontroller::class,'register'])->name('reg');
Route::any('/delete',[admincontroller::class,'deleteData'])->name('deleteData');
Route::any('/edit',[admincontroller::class,'edit'])->name('edit');
Route::any('/editData',[admincontroller::class,'editData'])->name('editData');
Route::any('/search',[admincontroller::class,'search'])->name('search');
