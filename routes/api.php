<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;
use App\Http\Controllers\TcpController;
use App\Http\Controllers\InventaryController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseColumnController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\RegCashController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\SublargestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// LOGIN
Route::post('login', [AppController::class, 'login'])->name('login');
// OBLIGATIONS
Route::get('obligations', [AppController::class, 'getObligations'])->name('Get Obligations');
// TCP
Route::get('tcp', [TcpController::class, 'index'])->name('TCP Index');
Route::get('tcplist', [TcpController::class, 'tcpList'])->name('TCP List');
Route::get('provinceslist', [TcpController::class, 'provincesList'])->name('TCP Provinces List');
Route::get('citieslist/{province}', [TcpController::class, 'citiesList'])->name('TCP Cities List');
Route::post('createTcp', [TcpController::class, 'store'])->name('TCP Store');
Route::post('updateTcp', [TcpController::class, 'update'])->name('TCP Update');
Route::post('deleteTcp', [TcpController::class, 'delete'])->name('TCP Delete');
// AFT
Route::get('aft/{tcp}', [InventaryController::class, 'index'])->name('AFT Index');
Route::get('aftgrouplist', [InventaryController::class, 'aftgroupList'])->name('AFT Group List');
Route::post('createAft', [InventaryController::class, 'store'])->name('AFT Store');
Route::post('updateAft', [InventaryController::class, 'update'])->name('AFT Update');
Route::post('deleteAft', [InventaryController::class, 'delete'])->name('AFT Delete');
Route::get('pdfAft/{id_tcp}', [InventaryController::class, 'pdfAft'])->name('AFT Pdf');
// ENTRY
Route::get('entryday/{tcp}/{month}/{year}', [EntryController::class, 'indexDay'])->name('Day Entry Index');
Route::get('entrymonth/{tcp}/{year}', [EntryController::class, 'indexMonth'])->name('Month Entry Index');
Route::post('createEntry', [EntryController::class, 'store'])->name('Entry Store');
Route::post('updateEntry', [EntryController::class, 'update'])->name('Entry Update');
Route::post('deleteEntry', [EntryController::class, 'delete'])->name('Entry Delete');
Route::get('pdfEntry/{id_tcp}/{year}', [EntryController::class, 'pdfEntry'])->name('Entry Pdf');
// EXPENSE
Route::get('expenseday/{tcp}/{month}/{year}', [ExpenseController::class, 'indexDay'])->name('Day Expense Index');
Route::get('expensemonth/{tcp}/{year}', [ExpenseController::class, 'indexMonth'])->name('Month Expense Index');
Route::post('createExpense', [ExpenseController::class, 'store'])->name('Expense Store');
Route::post('updateExpense', [ExpenseController::class, 'update'])->name('Expense Update');
Route::post('deleteExpense', [ExpenseController::class, 'delete'])->name('Expense Delete');
Route::get('pdfExpense/{id_tcp}/{year}', [ExpenseController::class, 'pdfExpense'])->name('Expense Pdf');
// EXPENSE COLUMNS
Route::get('expensecolumn/{tcp}', [ExpenseColumnController::class, 'index'])->name('Expense Columns Index');
Route::post('createExpensecolumn', [ExpenseColumnController::class, 'store'])->name('Expense Columns Store');
Route::post('updateExpensecolumn', [ExpenseColumnController::class, 'update'])->name('Expense Columns Update');
Route::post('destroyExpensecolumn', [ExpenseColumnController::class, 'destroy'])->name('Expense Columns Delete');
// TAX
Route::get('taxmonthly/{tcp}/{year}', [TaxController::class, 'index'])->name('Monthly Tax Index');
Route::post('createTax', [TaxController::class, 'store'])->name('Tax Store');
Route::post('updateTax', [TaxController::class, 'update'])->name('Tax Update');
// STATES FINANCE
Route::get('resultstate/{tcp}/{year}', [StatesController::class, 'resultState'])->name('Result State Index');
Route::get('situationstate/{tcp}/{year}', [StatesController::class, 'situationState'])->name('Situation State Index');
Route::post('updateStatesCell', [StatesController::class, 'updateModelOption'])->name('Model Option Store/Update');
Route::get('pdfStates', [StatesController::class, 'pdfStates'])->name('Financial States Pdf');
// REG CASH BOX
Route::get('regcash/{tcp}/{month}/{year}', [RegCashController::class, 'regCash'])->name('Register Cash Box Index');
Route::post('updateRegcashCell', [RegCashController::class, 'updateModelOption'])->name('Register Cash Model Option Store/Update');
Route::post('regcash/saldstart', [RegCashController::class, 'storeSald'])->name('Sald Start Store/Update');
Route::get('pdfRegcash', [RegCashController::class, 'pdfRegcash'])->name('Cash Register Pdf');
// RECEIPTS
Route::get('pdfPurchaseReceipts/{id_tcp}', [ReceiptController::class, 'pdfPurchaseReceipts'])->name('Purchase Receipts Pdf');
Route::get('pdfReceipts', [ReceiptController::class, 'pdfReceipts'])->name('Operations Receipts Pdf');
// SUBLARGEST
Route::get('sublargest/{tcp}/{account}/{month}/{year}', [SublargestController::class, 'sublargest'])->name('Sublargest Account Index');
Route::post('updateCashBankAccount', [SublargestController::class, 'updateCashBankAccount'])->name('Sublargest Cash Bank Account Store/Update');
Route::post('deleteOperationBankCash', [SublargestController::class, 'deleteOperationBankCash'])->name('Sublargest Cash Bank Remove Operation');
Route::get('pdfSublargest', [SublargestController::class, 'pdfSublargest'])->name('Sublargest Current Pdf');
