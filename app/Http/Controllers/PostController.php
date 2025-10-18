<?php

namespace App\Http\Controllers;

use Faker\Factory; 
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    // show the home page with all blog posts
    public function index() {
       $posts = BlogPost::latest()->filter(request(['search', 'category', 'author', 'tag']))->paginate(12);
        // Get the latest posts for the hero section
        $latestPosts = BlogPost::latest()->take(3)->get();
        return view('blog.posts.index', compact('posts', 'latestPosts'));
    }
   

    // show filtered blog posts (search, category, author, tag)
    public function filtered(Request $request) {
        $posts = BlogPost::latest()
            ->filter($request->only(['search', 'category', 'author', 'tag']))
            ->paginate(12);

        return view('blog.content', compact('posts'));
    }


   // show single blog post
   public function show($id) {
       $post = BlogPost::findOrFail($id);

       // Get previous post (smaller ID)
       $prevPost = BlogPost::where('id', '<', $post->id)->orderBy('id', 'desc')->first();

       // Get next post (larger ID)
       $nextPost = BlogPost::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

         // Return the view with the post and navigation
       return view('blog.posts.show', compact('post', 'prevPost', 'nextPost'));
   }
   
   //manage blog posts in admin
    public function manage() { 
        // $posts = BlogPost::latest()->get();
        //get logged in user blog post
        $userPosts = auth()->user()->blogposts()->latest()->paginate(10);
        // return the view with posts
        return view('admin.posts.show', compact('userPosts')); 
    }

    // parse, upload image and save new blog entry to db
    public function store(Request $request) {

        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'category' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:1048576',
            'content' => 'required'
        ]);

        if($request->hasFile('featured_image')) {

            // store the image in public storage
            $formFields["featured_image"] = $request->file("featured_image")->store("featured_images", "public");
        }

        // get author name from the authenticated user
        $formFields["author"] = auth()->user()->name;

        // user id
        $formFields["user_id"] = auth()->user()->id;

        BlogPost::create($formFields);

        return redirect('/admin/posts/manage')->with('success', 'Post created successfully!');
    }


    // edit blog post form
    public function edit($id) {
        $post = BlogPost::findOrFail($id);
        // Get all categories for the dropdown
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    
    // update blog post 
    public function update(Request $request , $id) {
        // validate the request
        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'category' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:1048576',
            'content' => 'required'
        ]);

        $post = BlogPost::findOrFail($id);

        if ($request->hasFile('featured_image')) {
            // Get the existing image path
            $existingImagePath = $post->featured_image;

            // Store the new image
            $formFields["featured_image"] = $request->file("featured_image")->store("featured_images", "public");

            // Delete the existing image
            if ($existingImagePath && Storage::disk('public')->exists($existingImagePath)) {
                Storage::disk('public')->delete($existingImagePath);
            } 
        }

        $post->update($formFields);

        return redirect('/admin/posts/manage')->with('success', 'Post Updated successfully!');
    }

    // delete blog post
    public function destroy($id) {
        $post = BlogPost::findOrFail($id);

        // Delete the featured image if it exists
        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();
        return redirect('/admin/posts/show')->with('success', 'Post deleted successfully!');
    }

}
