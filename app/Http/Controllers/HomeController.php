<?php

namespace App\Http\Controllers;

use App\Events\UserConnected;
use App\Http\Traits\CreateChannelInformation;
use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Token;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    use CreateChannelInformation;
    /**
     * @var
     */
    private  $posts;
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = collect();
        $posts = '';
        if (\Auth::check()) {
            $user = \Auth::user();
            $user->load('followers.user.profile_information', 'notifications','followers.user.personal_information', 'playlists.playlist_post.post.comments', 'payment_methods.biling_information', 'payment_ip_data');
        }

        return view('home', compact('posts', 'user'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexPaginate()
    {
        $user = collect();
        $posts = Post::with('views', 'shares', 'votes.user', 'likes.user', 'user.followers.user.profile_information', 'user.followers.user.personal_information', 'user.personal_information', 'comments.user.personal_information', 'comments.user.profile_information', 'comments.comments.user.personal_information', 'comments.comments.user.profile_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.profile_information.members', 'user.profile_information.releases', 'user.channel_information.tiers', 'user.supports.user', 'user.rewards.user', 'user.payment_methods.biling_information')->latest()->paginate(4);
        if (\Auth::check()) {
            $user = \Auth::user();
            $user->load('channel_information.tiers','followers.user.profile_information', 'followers.user.personal_information', 'playlists.playlist_post.post.comments', 'payment_methods.biling_information');
        }

        return response()->json([
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostsFilters(Request $request){
        $this->posts = [];
        if($request->genres !== null){
            collect($request->genres)->each(function($genre) {
                Post::with('views', 'shares', 'votes.user', 'likes.user', 'user.followers.user.profile_information', 'user.followers.user.personal_information', 'user.personal_information', 'comments.user.personal_information', 'comments.user.profile_information', 'comments.comments.user.personal_information', 'comments.comments.user.profile_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.profile_information.members', 'user.profile_information.releases', 'user.channel_information.tiers', 'user.supports.user', 'user.rewards.user', 'user.payment_methods.biling_information')->whereGenre($genre)->orderBy('created_at', 'DESC')->each(function($post){
                    if(!in_array( $post, $this->posts)) {
                        array_push($this->posts, $post);
                    }
                });

            });
        }
        if($request->categories !== null){
            collect($request->categories)->each(function($category){
                Post::with('views', 'shares', 'votes.user', 'likes.user', 'user.followers.user.profile_information', 'user.followers.user.personal_information', 'user.personal_information', 'comments.user.personal_information', 'comments.user.profile_information', 'comments.comments.user.personal_information', 'comments.comments.user.profile_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.profile_information.members', 'user.profile_information.releases', 'user.channel_information.tiers', 'user.supports.user', 'user.rewards.user', 'user.payment_methods.biling_information')->whereCategory($category)->orderBy('created_at', 'DESC')->each(function($post){
                    if(!in_array( $post, $this->posts)){
                        array_push($this->posts, $post);
                    }
                });
            });
        }

        return response()->json([
            'posts' => $this->posts
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('login', ['is_login_view' => \Auth::check()]);
    }

    /**
     * @param string $type
     * @param string $subscription_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register($type = 'Index', $subscription_type = '')
    {
        return view('register', ['type' => $type, 'subscription_type' => $subscription_type]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function help()
    {
        return view('extras.help');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('extras.about');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function carrers()
    {
        return view('extras.carrers');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('extras.terms');
    }

    /**
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function suggestions()
    {
        return view('extras.suggestions');
    }

    /**
     * @param Token
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPost($token)
    {
        $post = Post::with('views', 'shares', 'votes.user', 'likes.user', 'user.followers.user.profile_information', 'user.followers.user.personal_information', 'user.personal_information', 'comments.user.personal_information', 'comments.user.profile_information', 'comments.comments.user.personal_information', 'comments.comments.user.profile_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.profile_information.members', 'user.profile_information.releases', 'user.channel_information.tiers', 'user.supports.user', 'user.rewards.user', 'user.payment_methods.biling_information')->whereToken($token)->first();
        return view('post.view', ['post' => $post, 'user' => \Auth::check() ? \Auth::user()->load('personal_information')->first() : '{}']);
    }

    /**
     * @param string $type
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPostingMovile($type = 'text')
    {
        return view('post.public-post-movile', ['type' => $type]);
    }

    /**
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchView(){
        return view('search');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $result = User::whereHas('personal_information', function ($query) use ($request) {
            $query->where('full_name', 'like', "%{$request->search_body}%");
        })->orWhereHas('profile_information', function ($query) use ($request) {
            $query->where('artistic_name', 'like', "%{$request->search_body}%");
        })->with('personal_information', 'profile_information')->get();

        return response()->json([
            'result' => $result
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfoUrl(Request $request)
    {
        $url = $request->url;

        $content = file_get_contents($url, true);
        $content_tags = get_meta_tags($url);
        $meta_name  =  strpos($content, "<meta property=\"og:description\" content") ?  strpos($content, "<meta property=\"og:description\" content") : strpos($content, "<meta name=\"description\" content");
        $meta_title =  strpos($content, "<meta property=\"og:title\"");
        $meta_image =  strpos($content, "<meta property=\"og:image:url\" content") ? strpos($content, "<meta property=\"og:image:url\" content") : strpos($content, "<meta property=\"og:image\" content") ;

        $string_description = substr($content, $meta_name, 200);
        $string_title       = substr($content, $meta_title, 200);
        $string_image       = substr($content, $meta_image, 500);

        return response()->json([
            'description' => $string_description,
            'title'       => $string_title,
            'image'       => $string_image,
            'url'         => $url,
            'content'     => $content_tags
        ]);
    }

//    public function updateChannelInformation(Request $request)
//    {
//        \DB::beginTransaction();
//        try {
//            \App\Models\User\User::with('channel_information')->doesntHave('channel_information')->where('subscription_type', 'CONTRIBUTOR')->each(function($user) use ($request){
//
//                $this->saveChannelInformation($user, $request);
//            });
//            \DB::commit();
//            return response()->json([
//                'updated' => true,
//                'errors' => null,
//                'query' => \App\Models\User\User::with('channel_information')->doesntHave('channel_information')->where('subscription_type', 'CONTRIBUTOR')->get()
//            ]);
//        }catch (\Exception $e){
//            return response()->json([
//                'updated' => true,
//                'errors' => $e->getMessage()
//            ]);
//        }
//
//    }
}
