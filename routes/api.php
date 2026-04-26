
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/save-teacher-data', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'data_received' => $request->all()
    ]);
});