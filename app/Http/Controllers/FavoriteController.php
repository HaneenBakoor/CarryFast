<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    use ApiResponseTrait;

    public function addToFavourite(string $type, string $id)
    {
        $user = Auth::user();

        if (! $user) {
            return $this->unauthorized("لا يمكنك الإضافة للمفضلة لأنك غير مسجل دخول");
        }

        $modelClass = match ($type) {
            'restaurant' => \App\Models\Restaurant::class,
            'dish' => \App\Models\Dish::class,
            default => null,
        };

        if (! $modelClass) {
            return $this->errorResponse('نوع غير مدعوم');
        }

        $model = $modelClass::findOrFail($id);

        $fav = Favorite::where([
            'user_id'          => $user->id,
            'favoritable_type' => $modelClass,
            'favoritable_id'   => $model->id,
        ])->first();
        if ($fav) {
            return $this->errorResponse("تمت اضافتة للمفضلة مسبقا");
        }

        Favorite::create([
            'user_id'          => $user->id,
            'favoritable_type' => $modelClass,
            'favoritable_id'   => $model->id,
        ]);

        return $this->successResponse('تمت الإضافة للمفضلة');
    }

    public function deleteFromFavourite(string $type, string $id)
    {
        $user = Auth::user();

        if (! $user) {
            return $this->unauthorized();
        }

        $modelClass = match ($type) {
            'restaurant' => \App\Models\Restaurant::class,
            'dish' => \App\Models\Dish::class,
            default => null,
        };

        if (! $modelClass) {
            return $this->errorResponse('نوع غير مدعوم');
        }

        $model = $modelClass::findOrFail($id);

        $fav = Favorite::where([
            'user_id'          => $user->id,
            'favoritable_type' => $modelClass,
            'favoritable_id'   => $model->id,
        ])->first();
        if (! $fav) {
            return $this->notFound();
        }
        $fav->delete();

        return $this->successResponse("تمت الازالة من المفضلة بنجاح");
    }

    public function getDishFavorite()
    {
        $user      = Auth::user();
        $summeries = Favorite::where([
            'user_id'          => $user->id,
            'favoritable_type' => \App\Models\Dish::class,
        ])->with('favoritable')->get();
        $data = $summeries->map(function ($v) {
            return [
                'id'   => $v->favoritable->id ?? null,
                'name' => $v->favoritable->name ?? null,
                'image' => $v->favoritable->image ?? null,
            ];
        });

        return $this->successResponse($data);
    }

    public function getRestaurantsFavorite()
    {
        $user = Auth::user();
        $videos = Favorite::where([
            'user_id'          => $user->id,
            'favoritable_type' => \App\Models\Restaurant::class,
        ])->with('favoritable')->get();

        $data = $videos->map(function ($v) {
            return [
                 'id'   => $v->favoritable->id ?? null,
                'name' => $v->favoritable->name ?? null,
                'image' => $v->favoritable->image ?? null,
            ];
        });
        return $this->successResponse($data);
    }

}
