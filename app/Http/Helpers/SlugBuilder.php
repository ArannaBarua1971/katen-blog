<?php

namespace App\Http\Helpers;

trait SlugBuilder
{
    public function getSlug($req, $model, $commonName)
    {
        $sameThingFound = $model::where('slug', 'Like', '%'.$req->$commonName.'%')->count();
        $slug = str($req->$commonName)->slug();

        if ($sameThingFound) {
            $sameThingFound = $sameThingFound + 1;
            $slug = $slug.'-'.($sameThingFound);
        }

        return $slug;
    }
}
