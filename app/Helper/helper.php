<?php
use Illuminate\Support\Str;
use App\Models\UserLog;

if (!function_exists('generateUniqueUrlKey')) {
    function generateUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Page ::where('url_key', $urlKey)->exists();
    }
}

if (!function_exists('generateUniqueidentifier')) {
    function generateUniqueidentifier($name)
    {
        $baseSlug = Str::slug($name);
        $identifier = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (identifierExists($identifier)) {
            $identifier = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $identifier;
    }
}

if (!function_exists('identifierExists')) {
    function identifierExists($identifier)
    {
        // Assuming Product is your model name
        return \App\Models\Block ::where('identifier', $identifier)->exists();
    }
}

function logintime(){
     $loginTime = UserLog:: orderBy('id','DESC')->limit('1')->where('user_id',Auth::user()->id)->first();
    return  $loginTime->created_at;
}

function lastLoginTime()
{
    $lastLoginTime = UserLog::orderBy('id', 'desc')
    ->where('user_id', Auth::user()->id)
    ->skip(1) // Skip the latest login
    ->take(1) // Take the second-to-last login
    ->pluck('created_at')
    ->first();
    // Now $lastLoginTime contains the last login time for the authenticated user
    return  "Last Login Time: " . ($lastLoginTime ? $lastLoginTime->diffForHumans() : "N/A");
}
    
if (!function_exists('productUniqueUrlKey')) {
    function productUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Product ::where('url_key', $urlKey)->exists();
    }
}
if (!function_exists('categoryUniqueUrlKey')) {
    function categoryUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming category is your model name
        return \App\Models\Category ::where('url_key', $urlKey)->exists();
    }
}

if (!function_exists('attrNameKey')) {
    function attrNameKey($name)
    {
        $baseSlug = Str::lower(Str::replace(' ', '_',$name));
        $nameKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (nameKeyExists($nameKey)) {
            $nameKey = $baseSlug . '_' . $counter;
            $counter++;
        }

        return $nameKey;
    }
}

if (!function_exists('nameKeyExists')) {
    function nameKeyExists($nameKey)
    {
        // Assuming attribute is your model name
        return \App\Models\Attribute ::where('name_key', $nameKey)->exists();
    }
}

