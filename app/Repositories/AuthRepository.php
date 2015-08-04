<?php namespace App\Repositories;

// models 
use App\User;

// library 
use Auth;
use Validator;
use Illuminate\Http\Request;

class AuthRepository extends BaseRepository {

	/**
	 * The Tag instance.
	 *
	 * @var App\User
	 */
	protected $user;

	/**
	 * Create a new BlogRepository instance.
	 *
	 * @param  App\Models\Post $post
	 * @param  App\Models\Tag $tag
	 * @param  App\Models\Comment $comment
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function postLogin($request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        // prevent login 
        if ($validator->fails()) {
            // get the error messages from the validator
            $response = array(
                'status' => false,
                'data' => $validator->errors(),
                );
            dd($request);
            return $response;
        }

        // if validation passes this code will execute
        if (Auth::attempt($request->all())) {
            $user = Auth::user();

            $response = array(
                'status' => true,
                'data' => $user->toJson()
                );

            return $response;
        }

    }
}