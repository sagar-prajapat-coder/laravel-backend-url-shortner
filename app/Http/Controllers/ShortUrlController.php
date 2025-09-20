<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShortUrlController extends Controller
{
    public function index(Request $request){
        $user = $request->user();

        if($user->role->name === 'SuperAdmin'){
            $urls = ShortUrl::latest()->paginate(15);
        } elseif($user->role->name === 'Admin'){
            $urls = ShortUrl::where('company_id', $user->company_id)->latest()->paginate(15);
        } else {
            $urls = ShortUrl::where('created_by', $user->id)->latest()->paginate(15);
        }
        return view('short-urls.index', compact('urls'));
    }

    public function store(Request $request){
        $request->validate(['original_url'=>'required|url']);

        $user = $request->user();
        $code = Str::random(6);

        $su = ShortUrl::create([
            'code' => $code,
            'original_url' => $request->original_url,
            'created_by' => $user->id,
            'company_id' => $user->company_id,
            'is_public' => $request->has('is_public') ? true : false,
        ]);

        return redirect()->route('short-urls.index')->with('success','Short URL created: '.url("/r/{$su->code}"));
    }

    public function resolve($code){
        $su = ShortUrl::where('code',$code)->firstOrFail();
        if(!$su->is_public){
            abort(404);
        }
        return redirect()->away($su->original_url);
    }

    public function download(Request $request){
        $user = $request->user();

        if($user->role->name === 'SuperAdmin'){
            $query = ShortUrl::query();
        } elseif($user->role->name === 'Admin'){
            $query = ShortUrl::where('company_id', $user->company_id);
        } else {
            $query = ShortUrl::where('created_by', $user->id);
        }

        $response = new StreamedResponse(function() use($query){
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['code','original_url','created_by','company_id','is_public','created_at']);
            foreach($query->cursor() as $row){
                fputcsv($handle, [$row->code, $row->original_url, $row->created_by, $row->company_id, $row->is_public, $row->created_at]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="shorturls.csv"',
        ]);

        return $response;
    }
}
