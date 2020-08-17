<?php

use App\Comment;
use App\Company;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersCollection;
use App\Image;
use App\Room;
use App\City;
use App\User;
use App\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

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

Route::get('/cap2', function () {
    /*
    $user = DB::select('select * from users where id = ?', [1]);
    $users = DB::connection('sqlite')->select('select * from users');

    dump("mysql", $user);
    dump("sqlite", $users);

    $pdo = DB::connection(/*'sqlite'* /)->getPdo();
    $users = $pdo->query('select * from users')->fetchAll();

    dump("mysql", $users);

    $result = DB::select('select * from users where id = ? and name = ?', [1, 'Brain Hermann']);
    dump("result", $result);

    $result = DB::select('select * from users where id = :id', ['id' => 1]);
    dump("result", $result);

    DB::insert('insert into users (name, email, password) values (?,?,?)', ['Inserted Name', 'email@fdf.com', 'passwd']);

    $affected = DB::update('update users set email = "updatedeemail@email.com" where email = ?', ['email@fdf.com']);
    dump("affected", $affected);

    $deleted = DB::delete('delete from users where id = ?', [4]);
    dump($deleted);

    $result = \App\User::all();
    */

    /*    DB::transaction(function () {

            try {
                DB::table('users')->delete();
                $result = DB::table('users')->where('id', 4)->update(['email' => 'none']);
                /* $result = DB::table('users')->where('id', 3)->update(['email' => 'none@none.none']); * /

                if(!$result) {
                    throw new \Exception;
                }

            }catch (\Exception $e) {
                DB::rollBack();
            }

        }, 5); //option second argument, how many times a transaction should be reattempted

        $result = DB::table('users')->select()->get();

        dump($result); */

    $users = DB::table('users')->get();
    $comments = DB::table('comments')->get();

    /*    dump(factory(App\Comment::class,3)->make());
        dump(factory(App\Comment::class,3)->create());*/

    dump($users, $comments);

    return view('welcome');
});

Route::get('/cap3', function () {

    // $users = DB::table('users')->get();
    // $users = DB::table('users')->pluck('email');
    // $user = DB::table('users')->where('name', 'Mrs. Odie Metz')->first();
    // $user = DB::table('users')->where('name', 'Mrs. Odie Metz')->value('email');
    // $user = DB::table('users')->find(1);

    // $comments= DB::table('comments')->select('content as comment_content')->get();
    // $comments= DB::table('comments')->select('user_id')->distinct()->get();

    // $result = DB::table('comments')->count();
    // $result = DB::table('comments')->max('user_id');
    // $result = DB::table('comments')->sum('user_id');
    // min, avg

    // $result = DB::table('comments')->where('content', 'content')->exists();
    // $result = DB::table('comments')->where('content', 'content')->doesntExist();


    // $result = DB::table('rooms')->get();
    // $result = DB::table('rooms')->where('price','<',200)->get(); // = like, etc.

    // $result = DB::table('rooms')->where([
    //     ['room_size', '2'],
    //     ['price', '<', '400'],
    // ])->get();

    //  $result = DB::table('rooms')
    //     ->where('room_size' ,'2')
    //     ->orWhere('price', '<' ,'400')
    //     ->get();

    // $result = DB::table('rooms')
    //    ->where('price', '<' ,'400')
    //    ->orWhere(function($query) {
    //        $query->where('room_size', '>' ,'1')
    //            ->where('room_size', '<' ,'4');
    //    })
    //    ->get();


    // $result = DB::table('rooms')
    //         ->whereBetween('room_size',[1,3]) // whereNotBetween
    //         ->get();

    // $result = DB::table('rooms')
    //         ->whereNotIn('id',[1,2,3]) // whereIn
    //         ->get();
    // whereNull('column')  whereNotNull
    // whereDate('created_at', '2020-05-13')
    // whereMonth('created_at', '5')
    // whereDay('created_at', '13')
    // whereYear('created_at', '2020')
    // whereTime('created_at', '=', '12:25:10')
    // whereColumn('column1', '>', 'column2')
    // whereColumn([
    //     ['first_name', '=', 'last_name'],
    //     ['updated_at', '>', 'created_at']
    // ]

/*    $result = DB::table('users')
        ->whereExists(function ($query) {
            $query->select('id')
                ->from('reservations')
                ->whereRaw('reservations.user_id = users.id')
                ->where('check_in', '=', '2020-08-06')
                ->limit(1);
        })
        ->get();*/

/*     $result = DB::table('users')
                 ->whereJsonContains('meta->skills', 'Laravel')
                 ->get();*/

/*    $result = DB::table('users')
        ->where('meta->settings->site_language', 'en')
        ->get();*/

    // $result = DB::table('comments')->paginate(3); // other statements like where clause are also possible
    // simplePaginate(3);

    // dump($result->items());

    // $result = DB::statement('ALTER TABLE comments ADD FULLTEXT fulltext_index(content)'); // MySQL >= 5.6

    // $result = DB::statement('ALTER TABLE comments ADD FULLTEXT fulltext_index(content)'); // MySQL >= 5.6
    // $result = DB::table('comments')
    //     ->whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", ['inventore'])
    //     ->get();

    // $result = DB::table('comments')
    //    ->where("content", 'like', '%inventore%')
    //    ->get();

    // $result = DB::table('comments')
    // // ->where("content", 'like', '%inventore%')
    // ->whereRaw("content LIKE '%inventore%'") // be careful about SQL injections!
    // // ->where(DB::raw("content LIKE '%inventore%'")) // not working because where() needs two parameters
    // ->get();

    // $result = DB::table('comments')
    //     // ->select(DB::raw('count(user_id) as number_of_comments, users.name'))
    //     ->selectRaw('count(user_id) as number_of_comments, users.name',[])
    //     ->join('users','users.id','=','comments.user_id')
    //     ->groupBy('user_id')
    //     ->get();

    // whereRaw / orWhereRaw
    // havingRaw / orHavingRaw
    // orderByRaw
    // groupByRaw

    // $result = DB::table('comments')
    //             ->orderByRaw('updated_at - created_at DESC')
    //             ->get();

    // $result = DB::table('users')
    //    ->selectRaw('LENGTH(name) as name_lenght, name')
    //    ->orderByRaw('LENGTH(name) DESC')
    //    ->get();

    // $result = DB::table('users')
    //             ->orderBy('name', 'desc')
    //             ->get();

    // $result = DB::table('users')
    //             ->latest() // created_at default
    //             ->first();

    // $result = DB::table('users')
    //             // ->inRandomOrder()
    //             ->orderByRaw('RAND()')
    //             ->first();

    // $result = DB::table('comments')
    //             ->selectRaw('count(id) as number_of_5stars_comments, rating')
    //             ->groupBy('rating')
    //             ->having('rating', '=', 5)
    //             ->get();

    // $result = DB::table('comments')
    //             ->skip(5)
    //             ->take(5)
    //             ->get();

    // $result = DB::table('comments')
    //    ->offset(5)
    //    ->limit(5)
    //   ->get();

    // $room_id = null;
    // when execute always the first argument is valid value
    // $result = DB::table('reservations')
    //             ->when($room_id, function($query, $room_id) {
    //                  return $query->where('room_id', $room_id);
    //             })
    //             ->get();


    // $sortBy = null;
    // when = first argument have value execute first function, if null execute second function
    // $result = DB::table('rooms')
    //                 ->when($sortBy, function ($query, $sortBy) {
    //                     return $query->orderBy($sortBy);
    //                 }, function ($query) {
    //                     return $query->orderBy('price');
    //                 })
    //                 ->get();

    // $result = DB::table('comments')->orderBy('id')->chunk(2, function ($comments) {
    //     foreach ($comments as $comment)
    //     {
    //         if($comment->id == 5) return false;
    //     }
    // });

    // $result = DB::table('comments')->orderBy('id')->chunkById(5, function ($comments) {
    //     foreach ($comments as $comment)
    //     {
    //        DB::table('comments')
    //             ->where('id', $comment->id)
    //             ->update(['rating' => null]);
    //     }
    // }); // useful for administration tasks


    /**
     * Joins
     */

/*    $result = DB::table('reservations')
             ->join('rooms','reservations.room_id', '=', 'rooms.id')
             ->join('users','reservations.user_id', '=', 'users.id')
             ->where('rooms.id', '>', 3)
             ->where('users.id', '>', 1)
             ->get();*/

    // $result = DB::table('reservations')
    //         ->join('rooms', function($join) {
    //             $join->on('reservations.room_id', '=', 'rooms.id')
    //             ->where('rooms.id', '>', 3);
    //         })
    //         ->join('users', function($join) {
    //             $join->on('reservations.user_id', '=', 'users.id')
    //             ->where('users.id', '>', 1);
    //         })
    //         ->get();


    // $rooms = DB::table('rooms')
    //         ->where('id', '>', 3);

    // $users = DB::table('users')
    //         ->where('id', '>', 1);

    // $result = DB::table('reservations')
    //     ->joinSub($rooms, 'rooms', function ($join) {
    //         $join->on('reservations.room_id', '=', 'rooms.id');
    //     })
    //     ->joinSub($users, 'users', function ($join) {
    //         $join->on('reservations.user_id', '=', 'users.id');
    //     })
    //     ->get();


    // $result = DB::table('rooms')
    //         ->leftJoin('reservations','rooms.id', '=', 'reservations.room_id')
    //         ->selectRaw('room_size, count(reservations.id) as reservations_count')
    //         ->groupBy('room_size')
    //         ->orderByRaw('count(reservations.id) DESC')
    //         ->get();

    // $result = DB::table('rooms')
    //         ->leftJoin('reservations','rooms.id', '=', 'reservations.room_id')
    //         ->selectRaw('room_size, price, count(reservations.id) as reservations_count')
    //         ->groupBy('room_size','price')
    //         ->get();

    // $result = DB::table('rooms')
    //         ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
    //         ->leftJoin('cities', 'reservations.city_id', '=', 'cities.id')
    //         ->selectRaw('room_size, count(reservations.id) as reservations_count, cities.name')
    //         ->groupBy('room_size','cities.name')
    //         ->orderByRaw('count(reservations.id) DESC')
    //         ->get();

/*
    $result = DB::table('rooms')
        ->crossJoin('cities')
        ->leftJoin('reservations', function($join){
            $join->on('rooms.id', '=', 'reservations.room_id')
                ->on('cities.id','=','reservations.city_id');
        })
        // ->selectRaw('room_size, count(reservations.id) as reservations_count, cities.name')
        ->selectRaw('count(reservations.id) as reservations_count, cities.name')
        ->groupBy(/*'room_size',* /'cities.name')
        ->orderByRaw('count(reservations.id) DESC')
        // ->orderBy('rooms.room_size', 'DESC')
        ->get();
*/

    /**
     * Union
     */
    // $users = DB::table('users')
    //         ->select('name');

    // $result = DB::table('cities')
    //         ->select('name')
    //         ->union($users)
    //         ->get();

/*    $room = DB::table('comments')
        ->select('rating as rating_or_room_id','id', DB::raw('"comments" as type_of_activity'))
        ->where('user_id',2);

    $result = DB::table('reservations')
        ->select('room_id as rating_or_room_id', 'id', DB::raw('"reservation" as type_of_activity'))
        ->union($room)
        ->where('user_id',2)
        ->get();*/

    /**
     * Inserts
     */
    // DB::table('rooms')->insert([
    // ['room_number' => 1, 'room_size' => 1, 'price' =>1, 'description' => 'new description 1'],
    // ['room_number' => 2, 'room_size' => 2, 'price' =>2, 'description' => 'new description 2']
    // ]);

/*    $id = DB::table('rooms')->insertGetId(
        ['room_number' => 3, 'room_size' => 3, 'price' =>3, 'description' => 'new description 3'],
    );

    $result = DB::table('rooms')
        ->get();

    dump($result, $id);*/

    /**
     * Updates
     */
    // $affected = DB::table('rooms')
    //           ->where('id', 2)
    //           ->update(['price' => 222]);

    // $affected = DB::table('users')
    //           ->where('id', 1)
    //           ->update(['meta->settings->site_language' => 'es']);

    // $affected = DB::table('rooms')->increment('price', 20);

/*    $affected = DB::table('rooms')->decrement('price', 10, ['description' => 'new description']);

    $result = DB::table('rooms')
        ->get();

    dump($result, $affected);*/

    /**
     * Deletes
     */
    // DB::table('rooms')->where('id', '>', 10)->delete();
    // DB::table('rooms')->delete();
    // DB::table('rooms')->insert(['room_number'=>1, 'room_size'=>2, 'price'=>100, 'description'=>'desc']);
    // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    // DB::table('rooms')->truncate();
    // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

/*    $result = DB::table('rooms')
        ->get();

    dump($result);*/


    // $result = DB::table('rooms')
    //             ->sharedLock() // If you query for something and later want to update/insert related data (within transaction). Other sessions can read, but cannot  modify
    //             ->find(1);

    $result = DB::table('rooms')
        ->where('room_size',3)
        ->lockForUpdate() //  Other sessions cannot read, cannot  modify
        ->get()
        // ->dd()
        // ->dump()
    ;

    return view('welcome');
});

Route::get('/cap4', function () {


    // $result = DB::table('rooms')
    //             ->where('room_size',3)
    //             ->get();

    // $result = Room::where('room_size',3)
    //             ->get();

    // $result = Room::get(); // all()
    // $result = Room::where('price', '<', 400)
    //                 ->get();

    // $result = User::select('name','email')
    //     ->addSelect(['worst_rating' => Comment::select('rating')
    //     ->whereColumn('user_id', 'users.id')
    //     ->orderBy('rating', 'asc')
    //     ->limit(1)
    //     ])->get()->toArray();

    // $result = User::orderByDesc(  // asc default without 'Desc' part
    //     Reservation::select('check_in')
    //         ->whereColumn('user_id','users.id')
    //         ->orderBy('check_in','desc') // asc default without argument
    //         ->limit(1)
    //     )->select('id','name')->get()->toArray();

    /*
    $result = Reservation::chunk(2, function ($reservations) {
        foreach ($reservations as $reservation) {
            echo $reservation->id;
        }
    }); */
    // uses less memory than get() and cursor() but takes longer than get() and cursor(), the bigger chunk set is the less time a query takes but memory usage increases

    // foreach (Room::cursor() as $reservation) {
    //     echo $reservation->id;
    // } // takes faster than get() and chunk() but uses more memory than chunk() (not as much as get() method)


    // $result = User::find(1); // [1,2,3] does not work with Query Builder
    // $result = User::where('email','like', '%@%')->first();


    // $result = User::where('email','like', '%@email2.com')->firstOr(function() {
    //         User::where('id',1)->update(['email'=>'email@email2.com']);
    // });

    // $result = User::findOrFail(100); // firstOrFail also possible

    // $result = Comment::max('rating'); //  count, max, min, avg, sum

    /**
     * Scopes
     */

//     $result = Comment::all();
//     $result = Comment::withoutGlobalScope('rating')->get();
//    $result = Comment::rating(1)->get();


    // $result = Comment::all()->toArray();
    // $result = Comment::all()->count();
    // $result = Comment::all()->toJson();

//    $comments = Comment::all();
//
//    $result = $comments->reject(function ($comment) {
//        return $comment->rating < 3;
//    });
    // ->map(function ($comment) {
    //     return $comment->content;
    // });

//    $result = $comments->diff($result);

    /**
     * Insert
     */
    // $comment = new Comment();
    // $comment->user_id = 1;
    // $comment->rating = 5;
    // $comment->content = 'comment content';
    // $result = $comment->save();

//    $result = Comment::create([
//        'user_id' => 1,
//        'rating' => 5,
//        'content' => 'comment content',
//    ]);

    /**
     * Update
     */
    // $comment = Comment::find(1);
    // $comment->user_id = 1;
    // $comment->rating = 5;
    // $comment->content = 'comment content updated';
    // $result = $comment->save();

//    $result = Room::where('price', '<', 200)
//        ->update(['price' => 250]);

    /**
     * Delete
     */
    // $flight = Comment::find(1);
    // $result = $flight->delete();

    // $result = Comment::destroy([1]);

    // $result = Comment::where('rating', 1)->delete();

    // $result = Comment::withTrashed()->get(); // onlyTrashed()
    // $result = Comment::withTrashed()->restore(); // onlyTrashed()

//    $result = Comment::where('rating', 1)->forceDelete();

//    $result = Comment::all();

    /**
     * Accessors
     */
    // $result = Comment::find(1);

    // dump($result->rating);
    // dump($result->who_what);

    /**
     * Mutators
     */
//    $result = Comment::find(2);
//    $result->rating = 4;
//    $result->save();
//
//    dump($result->rating);

    /**
     * Casting
     */
    $result = User::select([
        'users.*',
        'last_commented_at' => Comment::selectRaw('MAX(created_at)')
            ->whereColumn('user_id', 'users.id')
    ])->withCasts([
        'last_commented_at' => 'datetime:Y-m-d' // date and datetime works only for array or json result
    ])->get()->toJson();

    dump($result);

    return view('welcome');
});

Route::get('/cap5', function () {

    /**
     * One to One
     */
    // $result = User::find(1);
//    $result = Address::find(1);

    // dump($result->address->street, $result->address->number);
//    dump($result->user->name);

    /**
     * OneToMany
     */
    // $result = User::find(1);
    // $result = Comment::find(1);

    // dump($result->user->name);
    // dump($result->comments);

    /**
     * ManyToMany
     */
//    // $result = City::find(1);
//    $result = Room::where('room_size', 3)->get();
//
//    // dump($result->rooms);
//    // dump($result->cities);
//    foreach($result as $rooms)
//    {
//        foreach($rooms->cities as $city)
//        {
//            // echo $city->name . '<br>';
//            // echo $city->pivot->room_id . '<br>';
//            dump($city->pivot->created_at);
//        }
//    }

    /**
     * HasOneThrough
     */
//    $result = Comment::find(5);
//
//    dump($result->country->name);
    /**
     * HasManyThrough
     */
//    $result = Company::find(2);
//
//    dump($result->reservations);
    /**
     * One To One Polymorphic
     */
    // $result = User::find(3);
//    $result = Image::find(10);
//
//    // dump($result->image);
//    dump($result->imageable);
    /**
     * One To Many Polymorphic
     */
//    $result = Room::find(6);
//     $result = Comment::find(1);

//    dump($result->comments);
//    dump($result->commentable);
    /**
     * Many To Many Polymorphic
     */
    // $result = User::find(1);
//    $result = Room::find(4);
//
//    // dump($result->likedImages, $result->likedRooms);
//    dump($result->likes);

    /**
     * Using withCount Querying and Counting
     */
    // $result = User::find(1)->comments()
    //             ->where('rating', '>', 3)
    //             ->orWhere('rating', '<', 2)
    //             ->get();
    // $result = User::find(1)->comments()
    //             ->where(function($query){
    //                 return $query->where('rating', '>', 3)
    //                         ->orWhere('rating', '<', 2);
    //             })
    //             ->get();

    // $result = App\User::has('comments', '>=', 6)->get();
    // $result = App\Comment::has('user.address')->get();


    // $result = App\User::whereHas('comments', function ($query) {
    //     $query->where('rating', '>', 2);
    // }, '>=', 2)->get();

    // $result = App\User::doesntHave('comments')->get(); // ->orDoesntHave

    // $result = App\User::whereDoesntHave('comments', function ($query) {
    //     $query->where('rating', '<', 2);
    // })->get(); // ->orWhereDoesntHave

    // $result = App\Reservation::whereDoesntHave('user.comments', function ($query) {
    //     $query->where('rating', '<', 2);
    // })->get(); // more realistic scenario: give me all posts written by users who rated by at lest 3 stars

    // $result = App\User::withCount('comments')->get();

//    $result = App\User::withCount([
//        'comments',
//        'comments as negative_comments_count' => function ($query) {
//            $query->where('rating', '<=', 2);
//        },
//    ])->get();
//
//    dump($result[0]->comments_count,$result[0]->negative_comments_count);

    /**
     * Querying and Couting Polymorphic
     */
    // $result = App\Comment::whereHasMorph(
    //     'commentable',
    //     ['App\Image', 'App\Room'],
    //     function ($query, $type) {

    //         if ($type === 'App\Room')
    //         {
    //             $query->where('room_size', '>', 2);
    //             $query->orWhere('room_size', '<', 2);
    //         }
    //         if ($type === 'App\Image')
    //         {
    //             $query->where('path', 'like', '%lorem%');
    //         }

    //     }
    // )->get();

    // $result = Comment::with(['commentable' => function ($morphTo) {
    //     $morphTo->morphWithCount([
    //         Room::class => ['comments'],
    //         Image::class => ['comments'],
    //     ]);
    // }])->find(3);

//    $result = Comment::find(3)
//        ->loadMorphCount('commentable', [
//            Room::class => ['comments'],
//            Image::class => ['comments'],
//        ]);
//
//    dump($result);
    /**
     * Insert, Update, Delete related Model
     */
    // $user = User::find(1);
    // $result = $user->address()->delete();
    // $result = $user->address()->saveMany([   // save(new Address)
    //     new Address(['number' => 1, 'street' => 'street', 'country' => 'USA'])
    // ]);

    // $result = $user->address()->createMany([ // create()
    //     ['number' => 2, 'street' => 'street2', 'country' => 'Mexico']
    // ]);

    // $user = User::find(2);
    // $address = Address::find(2);
    // $address->user()->associate($user);
    // $result = $address->save();

    // $address->user()->dissociate();
    // $result = $address->save();

    // $room = Room::find(1);
    // $result = $room->cities()->attach(1);
    // $result = $room->cities()->detach([1]); // without argument all cities will be detached

//    $comment = Comment::find(1);
//    $comment->content = 'Edit to this comment!';
//    $result = $comment->save();
//
//    dump($result);
    /**
     * Create custom model for pivot table for many to many relationship
     */
//    $city = City::find(1);
//    $result = $city->rooms()->attach(1);
//
//    dump($result);

    /**
     * Lazy and Eager loading of models
     */
    // $result = User::all();
    // $result = User::with(['address' => function($query){
    //     $query->where('street', 'like', '%Garden');
    // }])->get(); // ['address', 'otherRelation']

    // foreach($result as $user)
    // {
    //     echo "{$user->address->street} <br>";
    // }

    // $result = Reservation::with('user.address')->get();

    // foreach($result as $reservation)
    // {
    //     echo "{$reservation->user->address->street} <br>";
    // }

    // lazy-eager loading:
    // $result = User::all();
    // $result->load('address');  // address => function($query) {...}

    // eager loading nested polimorphic relations
    // $result = Image::with(['imageable' => function ($morphTo) {
    //     $morphTo->morphWith([
    //         User::class => ['likedImages']
    //     ]);
    // }])->get();


//    // lazy-eager loading nested polimorphic relations
//    $result = Image::with('imageable')
//        ->get();
//    $result->loadMorph('imageable', [User::class => ['likedImages']]);
//
//    dump($result);

    return view('welcome');
});

Route::get('/cap6', function () {

    /**
     * Compare perfomance
     */
     // $result = User::with('comments')->get();

//    $result = DB::table('users')->join('comments', 'users.id', '=', 'comments.user_id')->get();

//    $result = DB::select('select * from `users` inner join `comments` on `users`.`id` = `comments`.`user_id`');

    // $result = DB::statement('DROP TABLE addresses');
    // $result = DB::statement('ALTER TABLE rooms ADD INDEX index_name (price)');

    /**
     * When to use raw database expressions
     */
    // $result = DB::table('comments')
    // ->selectRaw('count(rating) as rating_count, rating') // and other aggregate functions like avg, sum, max, min, etc.
    // ->groupBy('rating')
    // ->orderBy('rating_count', 'desc')
    // ->get();

    // $result = DB::table('rooms')
    // ->orderByRaw('sqrt(room_number)')
    // ->get();

    // $result = DB::table('comments')
    // ->select('content')
    // ->selectRaw('CASE WHEN rating = 5 THEN "Very good" WHEN rating = 1 THEN "Very bad" ELSE "ok" END as text_rating')
    // ->get();

    // $result = Reservation::select('*')
    //         ->selectRaw('DATEDIFF(check_out, check_in) as nights')
    //         ->orderBy('nights', 'DESC')
    //         ->get();

    $additional_fee = 10;
    $result = Room::selectRaw("room_size, room_number, price + $additional_fee as final_price")->get();


    dump($result);
});

Route::get('/cap7', function () {
    /**
     * Redis
     * docker run --name redis -p 6379:6379 -d -t redis:alpine
     */
    // strings
//     $result = Redis::set('key', 'value');
//     $result = Redis::get('key');
//     $result = Redis::del('key');
    // $result = Redis::exists('key');
    // $result = Redis::incr('counter'); // decr()

    // lists (like arrays)
    // Redis::lpush('data','lvalue');  // lpop, rpop
    Redis::rpush('data','rvalue');
    // $result = Redis::llen('data');
    $result = Redis::lrange('data', 0, 2);

    dump($result);
});

Route::get('/cap8', function () {
    /**
     * APIs
     */

    // $result = User::with('comments')->get()->makeVisible('password')->toArray(); // makeHidden()
    // $result = User::with('comments')->get()->toJson();

    //return $result = new UserResource(User::find(1));
    //return  UserResource::collection(User::all());

    //return $result = new UsersCollection(User::all());

//    return $result = new UsersCollection(User::with('address','comments')->get());

    return $result = new UsersCollection(User::with('address','comments')->paginate(1));
});
